<?php
/**
 * Matin Parto — About page videos.
 */
defined( 'ABSPATH' ) || exit;

function matin_parto_register_about_videos() {
    register_post_type( 'mp_video', array(
        'labels' => array(
            'name' => 'ویدیوها',
            'singular_name' => 'ویدیو',
            'add_new' => 'افزودن ویدیو',
            'add_new_item' => 'افزودن ویدیوی جدید',
            'edit_item' => 'ویرایش ویدیو',
            'new_item' => 'ویدیوی جدید',
            'view_item' => 'مشاهده ویدیو',
            'search_items' => 'جستجوی ویدیوها',
            'not_found' => 'ویدیویی پیدا نشد',
            'menu_name' => 'ویدیوها',
        ),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_admin_bar' => true,
        'menu_position' => 25,
        'menu_icon' => 'dashicons-video-alt3',
        'supports' => array( 'title', 'editor', 'thumbnail' ),
        'show_in_rest' => true,
        'has_archive' => true,
        'rewrite' => array( 'slug' => 'videos' ),
    ) );
}
add_action( 'init', 'matin_parto_register_about_videos' );

function matin_parto_video_meta_box() {
    add_meta_box( 'matin_parto_video_details', 'تنظیمات ویدیو', 'matin_parto_video_meta_box_html', 'mp_video', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'matin_parto_video_meta_box' );

function matin_parto_video_meta_box_html( $post ) {
    wp_nonce_field( 'matin_parto_video_details', 'matin_parto_video_nonce' );
    $url = get_post_meta( $post->ID, '_mp_video_url', true );
    $duration = get_post_meta( $post->ID, '_mp_video_duration', true );
    $level = get_post_meta( $post->ID, '_mp_video_level', true );
    ?>
    <p><label for="mp_video_url"><strong>آدرس ویدیو</strong></label></p>
    <input class="widefat" type="url" id="mp_video_url" name="mp_video_url" value="<?php echo esc_attr( $url ); ?>" placeholder="https://.../video.mp4">
    <p class="description">لینک مستقیم فایل MP4 را وارد کنید. تصویر شاخص به‌عنوان کاور ویدیو استفاده می‌شود.</p>
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-top:14px">
        <p><label for="mp_video_duration"><strong>مدت زمان</strong></label><input class="widefat" type="text" id="mp_video_duration" name="mp_video_duration" value="<?php echo esc_attr( $duration ); ?>" placeholder="مثلاً 12:45"></p>
        <p><label for="mp_video_level"><strong>سطح</strong></label><input class="widefat" type="text" id="mp_video_level" name="mp_video_level" value="<?php echo esc_attr( $level ); ?>" placeholder="مثلاً سطح متوسط"></p>
    </div>
    <?php
}

function matin_parto_save_video_meta( $post_id ) {
    if ( ! isset( $_POST['matin_parto_video_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['matin_parto_video_nonce'] ) ), 'matin_parto_video_details' ) ) return;
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) || 'mp_video' !== get_post_type( $post_id ) ) return;
    update_post_meta( $post_id, '_mp_video_url', esc_url_raw( wp_unslash( $_POST['mp_video_url'] ?? '' ) ) );
    update_post_meta( $post_id, '_mp_video_duration', sanitize_text_field( wp_unslash( $_POST['mp_video_duration'] ?? '' ) ) );
    update_post_meta( $post_id, '_mp_video_level', sanitize_text_field( wp_unslash( $_POST['mp_video_level'] ?? '' ) ) );
}
add_action( 'save_post_mp_video', 'matin_parto_save_video_meta' );

function matin_parto_get_about_video() {
    $q = new WP_Query( array(
        'post_type' => 'mp_video',
        'post_status' => 'publish',
        'posts_per_page' => 1,
        'orderby' => 'date',
        'order' => 'DESC',
        'no_found_rows' => true,
    ) );
    if ( ! $q->have_posts() ) return null;
    $q->the_post();
    $data = array(
        'id' => get_the_ID(),
        'title' => get_the_title(),
        'content' => wp_strip_all_tags( get_the_content() ),
        'url' => get_post_meta( get_the_ID(), '_mp_video_url', true ),
        'duration' => get_post_meta( get_the_ID(), '_mp_video_duration', true ),
        'level' => get_post_meta( get_the_ID(), '_mp_video_level', true ),
        'thumb' => get_post_thumbnail_id(),
    );
    wp_reset_postdata();
    return $data;
}
