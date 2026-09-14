<?php
defined( 'ABSPATH' ) || exit;

require_once get_template_directory() . '/inc/home-content.php';

function matin_parto_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'custom-logo', array( 'height' => 80, 'width' => 180, 'flex-height' => true, 'flex-width' => true ) );
    add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption', 'style', 'script' ) );
    remove_theme_support( 'widgets-block-editor' );
    register_nav_menus( array( 'primary' => __( 'منوی اصلی', 'matin-parto' ), 'footer' => __( 'منوی فوتر', 'matin-parto' ) ) );
}
add_action( 'after_setup_theme', 'matin_parto_setup' );
add_filter( 'use_widgets_block_editor', '__return_false' );
add_filter( 'gutenberg_use_widgets_block_editor', '__return_false' );

function matin_parto_enqueue_assets() {
    wp_enqueue_style( 'matin-parto-style', get_stylesheet_uri(), array(), '2026.09.14' );
    wp_enqueue_style( 'matin-parto-main', get_template_directory_uri() . '/assets/css/main.css', array( 'matin-parto-style' ), '2026.09.14' );
    wp_enqueue_style( 'matin-parto-polish', get_template_directory_uri() . '/assets/css/header-footer-polish.css', array( 'matin-parto-main' ), '2026.09.14' );
    wp_enqueue_style( 'matin-parto-home', get_template_directory_uri() . '/assets/css/home.css', array( 'matin-parto-polish' ), '2026.09.14' );
    wp_enqueue_style( 'matin-parto-footer', get_template_directory_uri() . '/assets/css/footer-widgets.css', array( 'matin-parto-home' ), '2026.09.14' );
    wp_enqueue_style( 'matin-parto-layout-fixes', get_template_directory_uri() . '/assets/css/layout-fixes.css', array( 'matin-parto-footer' ), '2026.09.14' );
    wp_enqueue_style( 'matin-parto-cta-social', get_template_directory_uri() . '/assets/css/cta-social.css', array( 'matin-parto-layout-fixes' ), '2026.09.14' );

    $footer_hover_color = get_theme_mod( 'matin_parto_footer_hover_color', '#7b2636' );
    $footer_hover_color = sanitize_hex_color( $footer_hover_color );
    if ( ! $footer_hover_color ) { $footer_hover_color = '#7b2636'; }
    wp_add_inline_style( 'matin-parto-footer', ':root{--mp-footer-widget-hover:' . $footer_hover_color . ';}' );
    wp_enqueue_script( 'matin-parto-main', get_template_directory_uri() . '/assets/js/main.js', array(), '2026.09.14', true );
}
add_action( 'wp_enqueue_scripts', 'matin_parto_enqueue_assets' );

function matin_parto_customize_register( $wp_customize ) {
    $wp_customize->add_section( 'matin_parto_home_cta', array( 'title' => 'بنر «همین امروز شروع کنید»', 'priority' => 155, 'description' => 'تصویر مستقل بنر پایین صفحه اصلی را از اینجا انتخاب کنید.' ) );
    $wp_customize->add_setting( 'matin_parto_cta_image', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw', 'transport' => 'refresh' ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'matin_parto_cta_image', array( 'label' => 'عکس داخل کادر', 'section' => 'matin_parto_home_cta', 'description' => 'عکس داخل بخش وسط بنر پایین صفحه اصلی نمایش داده می‌شود. اندازه نمایش دسکتاپ ۲۵۰×۱۸۰ پیکسل است.' ) ) );

    $wp_customize->add_section( 'matin_parto_footer', array( 'title' => 'فوتر و پایین سایت', 'priority' => 160, 'description' => 'تنظیمات متن و ظاهر فوتر سایت.' ) );
    $wp_customize->add_setting( 'matin_parto_footer_copyright', array( 'default' => 'ماتین پرتو © 2026', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'matin_parto_footer_copyright', array( 'label' => 'متن کپی‌رایت', 'section' => 'matin_parto_footer', 'type' => 'text' ) );
    $wp_customize->add_setting( 'matin_parto_footer_note', array( 'default' => 'طراحی و توسعه با وردپرس', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'matin_parto_footer_note', array( 'label' => 'متن سمت چپ نوار پایینی', 'section' => 'matin_parto_footer', 'type' => 'text' ) );
    $wp_customize->add_setting( 'matin_parto_footer_privacy_url', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
    $wp_customize->add_control( 'matin_parto_footer_privacy_url', array( 'label' => 'لینک حریم خصوصی', 'section' => 'matin_parto_footer', 'type' => 'url' ) );
    $wp_customize->add_setting( 'matin_parto_footer_terms_url', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
    $wp_customize->add_control( 'matin_parto_footer_terms_url', array( 'label' => 'لینک قوانین و مقررات', 'section' => 'matin_parto_footer', 'type' => 'url' ) );
    $wp_customize->add_setting( 'matin_parto_footer_hover_color', array( 'default' => '#7b2636', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'refresh' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'matin_parto_footer_hover_color', array( 'label' => 'رنگ هاور فهرست فوتر', 'section' => 'matin_parto_footer', 'priority' => 50, 'description' => 'رنگ لینک‌های فهرست فوتر هنگام قرار گرفتن موس روی آن‌ها.' ) ) );
}
add_action( 'customize_register', 'matin_parto_customize_register' );

function matin_parto_register_widgets() {
    register_sidebar( array( 'name' => 'شبکه‌های اجتماعی', 'id' => 'matin-parto-social', 'description' => 'محتوای این ابزارک هم در بنر «همین امروز شروع کنید» و هم در فوتر نمایش داده می‌شود.', 'before_widget' => '<div id="%1$s" class="mp-widget mp-social-widget %2$s">', 'after_widget' => '</div>', 'before_title' => '<h3 class="widget-title">', 'after_title' => '</h3>' ) );
}
add_action( 'widgets_init', 'matin_parto_register_widgets' );

class Matin_Parto_Social_Widget extends WP_Widget {
    public function __construct() { parent::__construct( 'matin_parto_social', 'شبکه‌های اجتماعی ماتین پارتو', array( 'description' => 'عنوان، توضیح و لینک شبکه‌های اجتماعی را یک‌جا تنظیم کنید.' ) ); }
    public function widget( $args, $instance ) {
        $title = ! empty( $instance['title'] ) ? $instance['title'] : 'در شبکه‌های اجتماعی همراه باشید';
        $text = ! empty( $instance['text'] ) ? $instance['text'] : 'محتوای رایگان، نکات آموزشی و اخبار دوره‌ها';
        $networks = array( 'instagram', 'telegram', 'youtube', 'facebook' );
        echo $args['before_widget'] . '<div class="mp-social-widget__content"><b class="mp-social-widget__title">' . esc_html( $title ) . '</b><span class="mp-social-widget__text">' . esc_html( $text ) . '</span><div class="mp-social-icons" aria-label="شبکه‌های اجتماعی">';
        foreach ( $networks as $network ) {
            $url = ! empty( $instance[ $network ] ) ? $instance[ $network ] : '';
            if ( ! $url ) { continue; }
            echo '<a href="' . esc_url( $url ) . '" target="_blank" rel="noopener noreferrer" aria-label="' . esc_attr( ucfirst( $network ) ) . '" class="mp-social-icon mp-social-icon--' . esc_attr( $network ) . '">';
            echo function_exists( 'matin_parto_social_icon' ) ? matin_parto_social_icon( $network ) : '';
            echo '</a>';
        }
        echo '</div></div>' . $args['after_widget'];
    }
    public function form( $instance ) {
        $title = isset( $instance['title'] ) ? $instance['title'] : 'در شبکه‌های اجتماعی همراه باشید';
        $text = isset( $instance['text'] ) ? $instance['text'] : 'محتوای رایگان، نکات آموزشی و اخبار دوره‌ها';
        $labels = array( 'instagram' => 'اینستاگرام', 'telegram' => 'تلگرام', 'youtube' => 'یوتیوب', 'facebook' => 'فیسبوک' );
        echo '<p><label for="' . esc_attr( $this->get_field_id( 'title' ) ) . '">عنوان</label><input class="widefat" id="' . esc_attr( $this->get_field_id( 'title' ) ) . '" name="' . esc_attr( $this->get_field_name( 'title' ) ) . '" type="text" value="' . esc_attr( $title ) . '"></p>';
        echo '<p><label for="' . esc_attr( $this->get_field_id( 'text' ) ) . '">توضیح</label><textarea class="widefat" rows="3" id="' . esc_attr( $this->get_field_id( 'text' ) ) . '" name="' . esc_attr( $this->get_field_name( 'text' ) ) . '">' . esc_textarea( $text ) . '</textarea></p>';
        foreach ( $labels as $key => $label ) { $value = isset( $instance[ $key ] ) ? $instance[ $key ] : ''; echo '<p><label for="' . esc_attr( $this->get_field_id( $key ) ) . '">' . esc_html( $label ) . '</label><input class="widefat" id="' . esc_attr( $this->get_field_id( $key ) ) . '" name="' . esc_attr( $this->get_field_name( $key ) ) . '" type="url" placeholder="https://" value="' . esc_attr( $value ) . '"></p>'; }
    }
    public function update( $new_instance, $old_instance ) {
        $instance = array( 'title' => sanitize_text_field( $new_instance['title'] ?? '' ), 'text' => sanitize_text_field( $new_instance['text'] ?? '' ) );
        foreach ( array( 'instagram', 'telegram', 'youtube', 'facebook' ) as $key ) { $instance[ $key ] = esc_url_raw( $new_instance[ $key ] ?? '' ); }
        return $instance;
    }
}
function matin_parto_register_social_widget() { register_widget( 'Matin_Parto_Social_Widget' ); }
add_action( 'widgets_init', 'matin_parto_register_social_widget' );

function matin_parto_seed_social_widget() {
    if ( get_option( 'matin_parto_social_widget_migrated', false ) ) { return; }
    $sidebars = get_option( 'sidebars_widgets', array() );
    if ( ! empty( $sidebars['matin-parto-social'] ) ) { update_option( 'matin_parto_social_widget_migrated', 1 ); return; }
    $home = function_exists( 'matin_parto_home_settings' ) ? matin_parto_home_settings() : array();
    $instance = array( 'title' => 'در شبکه‌های اجتماعی همراه باشید', 'text' => 'محتوای رایگان، نکات آموزشی و اخبار دوره‌ها', 'instagram' => ! empty( $home['social_instagram'] ) ? $home['social_instagram'] : '', 'telegram' => ! empty( $home['social_telegram'] ) ? $home['social_telegram'] : '', 'youtube' => ! empty( $home['social_youtube'] ) ? $home['social_youtube'] : '', 'facebook' => ! empty( $home['social_facebook'] ) ? $home['social_facebook'] : '' );
    $widget_instances = get_option( 'widget_matin_parto_social', array() ); $number = 1; while ( isset( $widget_instances[ $number ] ) ) { $number++; }
    $widget_instances[ $number ] = $instance; update_option( 'widget_matin_parto_social', $widget_instances );
    $sidebars['matin-parto-social'] = array( 'matin_parto_social-' . $number ); update_option( 'sidebars_widgets', $sidebars ); update_option( 'matin_parto_social_widget_migrated', 1 );
}
add_action( 'widgets_init', 'matin_parto_seed_social_widget', 110 );

function matin_parto_footer_settings_menu() { add_theme_page( 'تنظیمات فوتر', 'تنظیمات فوتر', 'manage_options', 'matin-parto-footer', 'matin_parto_footer_settings_page' ); }
add_action( 'admin_menu', 'matin_parto_footer_settings_menu' );
function matin_parto_footer_settings_page() {
    if ( ! current_user_can( 'manage_options' ) ) { return; }
    if ( isset( $_POST['matin_parto_footer_save'] ) ) {
        check_admin_referer( 'matin_parto_footer_settings' );
        $color = isset( $_POST['matin_parto_footer_hover_color'] ) ? sanitize_hex_color( wp_unslash( $_POST['matin_parto_footer_hover_color'] ) ) : '#7b2636';
        set_theme_mod( 'matin_parto_footer_hover_color', $color ? $color : '#7b2636' );
        echo '<div class="notice notice-success is-dismissible"><p>تنظیمات فوتر ذخیره شد.</p></div>';
    }
    $color = get_theme_mod( 'matin_parto_footer_hover_color', '#7b2636' );
    ?>
    <div class="wrap" dir="rtl"><h1>تنظیمات فوتر</h1><p>رنگ هاور فهرست‌های فوتر را از اینجا انتخاب کنید.</p><form method="post"><?php wp_nonce_field( 'matin_parto_footer_settings' ); ?><table class="form-table" role="presentation"><tr><th scope="row"><label for="matin_parto_footer_hover_color">رنگ هاور فهرست فوتر</label></th><td><input type="color" id="matin_parto_footer_hover_color" name="matin_parto_footer_hover_color" value="<?php echo esc_attr( $color ); ?>"><code><?php echo esc_html( $color ); ?></code><p class="description">رنگی که با بردن موس روی لینک‌های فهرست فوتر نمایش داده می‌شود.</p></td></tr></table><p><button type="submit" name="matin_parto_footer_save" class="button button-primary">ذخیره تغییرات</button></p></form></div>
    <?php
}

function matin_parto_fallback_menu() {
    echo '<ul class="mp-nav__list">';
    echo '<li class="is-current"><a href="' . esc_url( home_url( '/' ) ) . '">صفحه اصلی</a></li>';
    echo '<li><a href="#courses">دوره‌های من</a></li><li><a href="#about">درباره‌ی من</a></li><li><a href="#videos">ویدئوهای آموزشی</a></li><li><a href="#blog">وبلاگ</a></li><li><a href="#contact">تماس با ما</a></li>';
    echo '</ul>';
}
