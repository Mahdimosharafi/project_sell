<?php
defined( 'ABSPATH' ) || exit;

function matin_parto_register_testimonials() {
    register_post_type( 'mp_testimonial', array(
        'labels' => array(
            'name' => 'نظرات زبان‌آموزان', 'singular_name' => 'نظر زبان‌آموز', 'add_new' => 'افزودن نظر',
            'add_new_item' => 'افزودن نظر زبان‌آموز', 'edit_item' => 'ویرایش نظر زبان‌آموز', 'new_item' => 'نظر جدید',
            'view_item' => 'مشاهده نظر', 'search_items' => 'جستجوی نظرات', 'not_found' => 'نظری پیدا نشد', 'menu_name' => 'نظرات زبان‌آموزان',
        ),
        'public' => false, 'show_ui' => true, 'show_in_menu' => false, 'show_in_admin_bar' => true,
        'menu_icon' => 'dashicons-format-chat', 'supports' => array( 'title', 'editor', 'thumbnail' ), 'show_in_rest' => true,
        'has_archive' => false, 'capability_type' => 'post', 'map_meta_cap' => true,
    ) );
}
add_action( 'init', 'matin_parto_register_testimonials' );

function matin_parto_testimonials_admin_menu() {
    add_menu_page('نظرات زبان‌آموزان','نظرات زبان‌آموزان','edit_posts','matin-parto-testimonials','matin_parto_testimonials_admin_page','dashicons-format-chat',26);
}
add_action( 'admin_menu', 'matin_parto_testimonials_admin_menu', 20 );

function matin_parto_testimonials_admin_page() {
    if ( ! current_user_can( 'edit_posts' ) ) wp_die( esc_html__( 'دسترسی کافی ندارید.' ) );
    wp_safe_redirect( admin_url( 'edit.php?post_type=mp_testimonial' ) );
    exit;
}

function matin_parto_testimonial_meta_box() {
    add_meta_box('matin_parto_testimonial_details','اطلاعات نظر زبان‌آموز','matin_parto_testimonial_meta_box_html','mp_testimonial','side','high');
}
add_action( 'add_meta_boxes', 'matin_parto_testimonial_meta_box' );

function matin_parto_testimonial_meta_box_html( $post ) {
    wp_nonce_field( 'matin_parto_testimonial_details', 'matin_parto_testimonial_nonce' );
    $rating = max(1,min(5,absint(get_post_meta($post->ID,'_mp_testimonial_rating',true) ?: 5)));
    $course = get_post_meta($post->ID,'_mp_testimonial_course',true);
    ?>
    <p><label for="mp_testimonial_rating"><strong>امتیاز (ستاره)</strong></label>
    <select class="widefat" id="mp_testimonial_rating" name="mp_testimonial_rating">
    <?php for($i=5;$i>=1;$i--): ?><option value="<?php echo esc_attr($i); ?>" <?php selected($rating,$i); ?>><?php echo esc_html($i.' ستاره'); ?></option><?php endfor; ?>
    </select></p>
    <p><label for="mp_testimonial_course"><strong>نوع یادگیری / دوره</strong></label>
    <input class="widefat" type="text" id="mp_testimonial_course" name="mp_testimonial_course" value="<?php echo esc_attr($course); ?>" placeholder="مثلاً زبان‌آموز دوره مکالمه"></p>
    <p class="description">عکس زبان‌آموز را از «تصویر شاخص» انتخاب کنید و متن نظر را در ویرایشگر اصلی بنویسید.</p>
    <?php
}

function matin_parto_save_testimonial_meta( $post_id ) {
    if ( ! isset($_POST['matin_parto_testimonial_nonce']) || ! wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['matin_parto_testimonial_nonce'])),'matin_parto_testimonial_details') ) return;
    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return;
    if ( ! current_user_can('edit_post',$post_id) || 'mp_testimonial' !== get_post_type($post_id) ) return;
    $rating=max(1,min(5,isset($_POST['mp_testimonial_rating'])?absint($_POST['mp_testimonial_rating']):5));
    $course=isset($_POST['mp_testimonial_course'])?sanitize_text_field(wp_unslash($_POST['mp_testimonial_course'])):'';
    update_post_meta($post_id,'_mp_testimonial_rating',$rating); update_post_meta($post_id,'_mp_testimonial_course',$course);
}
add_action( 'save_post_mp_testimonial', 'matin_parto_save_testimonial_meta' );

function matin_parto_testimonial_admin_columns( $columns ) {
    return array('cb'=>$columns['cb'],'title'=>'نام زبان‌آموز','course'=>'نوع دوره / یادگیری','rating'=>'امتیاز','thumbnail'=>'عکس','date'=>'تاریخ');
}
add_filter( 'manage_mp_testimonial_posts_columns', 'matin_parto_testimonial_admin_columns' );
function matin_parto_testimonial_admin_column_content($column,$post_id){
    if('course'===$column) echo esc_html(get_post_meta($post_id,'_mp_testimonial_course',true));
    elseif('rating'===$column){$rating=max(1,min(5,absint(get_post_meta($post_id,'_mp_testimonial_rating',true)?:5)));echo esc_html(str_repeat('★',$rating));}
    elseif('thumbnail'===$column) echo has_post_thumbnail($post_id)?get_the_post_thumbnail($post_id,array(48,48),array('style'=>'width:48px;height:48px;object-fit:cover;border-radius:50%;')):'—';
}
add_action('manage_mp_testimonial_posts_custom_column','matin_parto_testimonial_admin_column_content',10,2);

function matin_parto_add_social_customizer($wp_customize){
    $wp_customize->add_section('matin_parto_social_links',array('title'=>'شبکه‌های اجتماعی','priority'=>150,'description'=>'لینک‌های شبکه‌های اجتماعی در بنر پایین صفحه اصلی.'));
    $socials=array('whatsapp'=>'واتساپ','telegram'=>'تلگرام','instagram'=>'اینستاگرام','youtube'=>'یوتیوب');
    foreach($socials as $key=>$label){
        $setting='matin_parto_social_'.$key;
        $wp_customize->add_setting($setting,array('default'=>'','sanitize_callback'=>'esc_url_raw','transport'=>'refresh'));
        $wp_customize->add_control($setting,array('label'=>'لینک '.$label,'section'=>'matin_parto_social_links','type'=>'url','description'=>'آدرس کامل لینک '.$label.' را وارد کنید.'));
    }
}
add_action('customize_register','matin_parto_add_social_customizer',20);

function matin_parto_social_icon($network){
    $icons=array(
        'whatsapp'=>'<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M20.5 11.7a8.3 8.3 0 0 1-12.2 7.1L4 20l1.3-4.1a8.3 8.3 0 1 1 15.2-4.2Z"/><path d="M9 8.4c.2-.4.4-.4.7-.4h.5c.2 0 .4.1.5.4l.7 1.7c.1.2.1.4-.1.6l-.5.6c.6 1.1 1.5 2 2.7 2.5l.5-.6c.2-.2.4-.2.6-.1l1.6.8c.3.1.4.3.3.6-.2.8-.9 1.4-1.8 1.4-3.2-.1-6.8-3.7-6.9-6.9 0-.2.1-.4.2-.6Z"/></svg>',
        'telegram'=>'<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M21 4 3.8 10.6c-.7.3-.7 1.2.1 1.5l4.4 1.6 1.7 5.1c.2.6 1 .7 1.4.2l2.5-3.1 4.4 3.2c.5.4 1.2.1 1.4-.5L22 5c.1-.7-.4-1.2-1-1Z"/><path d="m8.4 13.7 8.8-6.1-6.2 7.5"/></svg>',
        'instagram'=>'<svg viewBox="0 0 24 24" aria-hidden="true"><rect x="3.5" y="3.5" width="17" height="17" rx="4"/><circle cx="12" cy="12" r="4"/><circle cx="17.4" cy="6.8" r="1" fill="currentColor" stroke="none"/></svg>',
        'youtube'=>'<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M21 8.2a2.8 2.8 0 0 0-2-2C17.3 5.7 12 5.7 12 5.7s-5.3 0-7 .5a2.8 2.8 0 0 0-2 2A29 29 0 0 0 2.5 12 29 29 0 0 0 3 15.8a2.8 2.8 0 0 0 2 2c1.7.5 7 .5 7 .5s5.3 0 7-.5a2.8 2.8 0 0 0 2-2 29 29 0 0 0 .5-3.8 29 29 0 0 0-.5-3.8Z"/><path d="m10 9 5 3-5 3V9Z" fill="currentColor" stroke="none"/></svg>',
    ); return isset($icons[$network])?$icons[$network]:'';
}

/* همیشه چهار آیکون را رندر می‌کنیم؛ لینک تنظیم‌شده روی هرکدام اعمال می‌شود. */
function matin_parto_social_links_html($class=''){
    $socials=array('whatsapp'=>'واتساپ','telegram'=>'تلگرام','instagram'=>'اینستاگرام','youtube'=>'یوتیوب');
    echo '<div class="mp-home-social-links '.esc_attr($class).'" aria-label="شبکه‌های اجتماعی">';
    foreach($socials as $key=>$label){
        $url=get_theme_mod('matin_parto_social_'.$key,'');
        $href=$url?esc_url($url):'#';
        $extra=$url?'':' aria-disabled="true"';
        echo '<a class="mp-home-social-link mp-home-social-link--'.esc_attr($key).'" href="'.$href.'"'.($url?' target="_blank" rel="noopener noreferrer"':'').$extra.' aria-label="'.esc_attr($label).'">'.matin_parto_social_icon($key).'<span>'.esc_html($label).'</span></a>';
    }
    echo '</div>';
}

function matin_parto_get_testimonials($limit=3){
    return new WP_Query(array('post_type'=>'mp_testimonial','post_status'=>'publish','posts_per_page'=>absint($limit),'orderby'=>'date','order'=>'DESC','no_found_rows'=>true));
}
