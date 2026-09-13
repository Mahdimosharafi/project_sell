<?php
/** Matin Parto root theme bootstrap. */
defined( 'ABSPATH' ) || exit;

function matin_parto_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'custom-logo', array( 'height' => 80, 'width' => 180, 'flex-height' => true, 'flex-width' => true ) );
    add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption', 'style', 'script' ) );

    register_nav_menus( array(
        'primary' => __( 'منوی اصلی', 'matin-parto' ),
        'footer'  => __( 'منوی فوتر', 'matin-parto' ),
    ) );
}
add_action( 'after_setup_theme', 'matin_parto_setup' );

add_filter( 'use_widgets_block_editor', '__return_true' );
add_filter( 'gutenberg_use_widgets_block_editor', '__return_true' );

function matin_parto_enqueue_assets() {
    $base_dir = get_template_directory() . '/wp-content/themes/matin-parto';
    $base_uri = get_template_directory_uri() . '/wp-content/themes/matin-parto';
    $files = array(
        'matin-parto-style'    => '/style.css',
        'matin-parto-main'     => '/assets/css/main.css',
        'matin-parto-polish'   => '/assets/css/header-footer-polish.css',
        'matin-parto-home'     => '/assets/css/home.css',
        'matin-parto-footer'   => '/assets/css/footer-widgets.css',
        'matin-parto-rtl'      => '/rtl-fix.css',
        'matin-parto-final-ui' => '/assets/css/final-ui-fixes.css',
        'matin-parto-cta-social' => '/assets/css/cta-social-fix.css',
    );
    $deps = array();
    foreach ( $files as $handle => $file ) {
        $path = $base_dir . $file;
        if ( file_exists( $path ) ) {
            wp_enqueue_style( $handle, $base_uri . $file, $deps, (string) filemtime( $path ) );
            $deps = array( $handle );
        }
    }

    $hero_image  = esc_url( get_theme_mod( 'matin_parto_hero_image', '' ) );
    $video_image = esc_url( get_theme_mod( 'matin_parto_video_image', '' ) );
    $course_image = esc_url( get_theme_mod( 'matin_parto_course_image', '' ) );
    $cta_image   = esc_url( get_theme_mod( 'matin_parto_cta_image', '' ) );
    $backdrop    = esc_html( get_theme_mod( 'matin_parto_hero_backdrop_text', 'MATIN PARTO' ) );
    $custom_css  = ':root{--mp-hero-backdrop-text:"' . esc_attr( $backdrop ) . '";}';
    if ( $video_image ) {
        $custom_css .= '.mp-video-thumb,.mp-video-mini{background-image:url("' . $video_image . '") !important;}';
    }
    if ( $course_image ) {
        $custom_css .= '.mp-course-image{background-image:url("' . $course_image . '") !important;}';
    }
    if ( $cta_image ) {
        $custom_css .= '.mp-home-cta__person{background-image:url("' . $cta_image . '") !important;}';
        $custom_css .= '.mp-footer-cta__image{content:url("' . $cta_image . '") !important;}';
    }
    if ( $backdrop ) {
        $custom_css .= '.mp-hero__visual:before{content:var(--mp-hero-backdrop-text);position:absolute;z-index:1;right:2%;top:4%;font-family:Georgia,serif;font-size:clamp(38px,6vw,82px);font-weight:700;letter-spacing:3px;line-height:.9;color:rgba(60,48,51,.055);white-space:pre-line;pointer-events:none;}';
    }
    wp_add_inline_style( 'matin-parto-home', $custom_css );

    $js = $base_dir . '/assets/js/main.js';
    if ( file_exists( $js ) ) {
        wp_enqueue_script( 'matin-parto-main', $base_uri . '/assets/js/main.js', array(), (string) filemtime( $js ), true );
    }
}
add_action( 'wp_enqueue_scripts', 'matin_parto_enqueue_assets' );

function matin_parto_home_settings() {
    return array(
        'hero_image'         => get_theme_mod( 'matin_parto_hero_image', '' ),
        'video_image'        => get_theme_mod( 'matin_parto_video_image', '' ),
        'course_image'       => get_theme_mod( 'matin_parto_course_image', '' ),
        'cta_image'          => get_theme_mod( 'matin_parto_cta_image', '' ),
        'hero_backdrop_text' => get_theme_mod( 'matin_parto_hero_backdrop_text', 'MATIN PARTO' ),
        'hero_title'         => get_theme_mod( 'matin_parto_hero_title', 'آموزش زبان انگلیسی' ),
        'hero_subtitle'      => get_theme_mod( 'matin_parto_hero_subtitle', 'به صورت اصولی و قدم به قدم' ),
        'hero_text'          => get_theme_mod( 'matin_parto_hero_text', 'با یک سیستم ساده و کاربردی از پایه تا پیشرفته.' ),
        'hero_primary'       => get_theme_mod( 'matin_parto_hero_primary', 'شروع یادگیری' ),
    );
}

function matin_parto_customize_register( $wp_customize ) {
    $wp_customize->add_section( 'matin_parto_home', array(
        'title'       => 'صفحه اصلی و تصاویر',
        'priority'    => 150,
        'description' => 'تصاویر صفحه اصلی و بخش پایانی را از اینجا انتخاب کنید.',
    ) );

    $image_controls = array(
        'matin_parto_hero_image'   => array( 'تصویر اصلی هیرو (خانم)', 'تصویر خانم در بخش اصلی صفحه' ),
        'matin_parto_video_image'  => array( 'تصویر ویدئوها', 'تصویر پیش‌فرض کارت‌های ویدئو' ),
        'matin_parto_course_image' => array( 'تصویر دوره‌ها', 'تصویر پیش‌فرض کارت‌های دوره' ),
        'matin_parto_cta_image'    => array( 'تصویر وسط بخش پایانی', 'این تصویر در مرکز باکس همین امروز شروع کنید نمایش داده می‌شود.' ),
    );
    foreach ( $image_controls as $setting_id => $labels ) {
        $wp_customize->add_setting( $setting_id, array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
            'transport'         => 'refresh',
        ) );
        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $setting_id, array(
            'label'       => $labels[0],
            'description' => $labels[1],
            'section'     => 'matin_parto_home',
        ) ) );
    }

    $text_controls = array(
        'matin_parto_hero_backdrop_text' => array( 'متن MATIN PARTO پشت تصویر', 'متن تزئینی پشت تصویر اصلی.', 'MATIN PARTO' ),
        'matin_parto_hero_title'         => array( 'عنوان اصلی', '', 'آموزش زبان انگلیسی' ),
        'matin_parto_hero_subtitle'      => array( 'زیرعنوان اصلی', '', 'به صورت اصولی و قدم به قدم' ),
        'matin_parto_hero_text'          => array( 'متن معرفی', '', 'با یک سیستم ساده و کاربردی از پایه تا پیشرفته.' ),
        'matin_parto_hero_primary'       => array( 'متن دکمه اصلی', '', 'شروع یادگیری' ),
    );
    foreach ( $text_controls as $setting_id => $control ) {
        $wp_customize->add_setting( $setting_id, array(
            'default'           => $control[2],
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        ) );
        $wp_customize->add_control( $setting_id, array(
            'label'       => $control[0],
            'description' => $control[1],
            'section'     => 'matin_parto_home',
            'type'        => 'text',
        ) );
    }

    /* Social links used by the bottom CTA. */
    $social_controls = array(
        'matin_parto_social_whatsapp'  => 'لینک واتساپ',
        'matin_parto_social_telegram'  => 'لینک تلگرام',
        'matin_parto_social_instagram' => 'لینک اینستاگرام',
        'matin_parto_social_youtube'   => 'لینک یوتیوب',
    );
    foreach ( $social_controls as $setting_id => $label ) {
        $wp_customize->add_setting( $setting_id, array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
            'transport'         => 'refresh',
        ) );
        $wp_customize->add_control( $setting_id, array(
            'label'       => $label,
            'description' => 'لینک کامل شبکه اجتماعی را وارد کنید.',
            'section'     => 'matin_parto_home',
            'type'        => 'url',
        ) );
    }

    $wp_customize->add_section( 'matin_parto_footer', array(
        'title'       => 'فوتر و پایین سایت',
        'priority'    => 160,
        'description' => 'محتوای ستون‌های اصلی فوتر را از بخش ابزارک‌ها مدیریت کنید.',
    ) );

    $wp_customize->add_setting( 'matin_parto_footer_copyright', array( 'default' => 'ماتین پرتو © 2026', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'matin_parto_footer_copyright', array( 'label' => 'متن کپی‌رایت', 'section' => 'matin_parto_footer', 'type' => 'text' ) );
    $wp_customize->add_setting( 'matin_parto_footer_note', array( 'default' => 'طراحی و توسعه با وردپرس', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'matin_parto_footer_note', array( 'label' => 'متن سمت چپ نوار پایینی', 'section' => 'matin_parto_footer', 'type' => 'text' ) );
    $wp_customize->add_setting( 'matin_parto_footer_privacy_url', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
    $wp_customize->add_control( 'matin_parto_footer_privacy_url', array( 'label' => 'لینک حریم خصوصی', 'section' => 'matin_parto_footer', 'type' => 'url' ) );
    $wp_customize->add_setting( 'matin_parto_footer_terms_url', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
    $wp_customize->add_control( 'matin_parto_footer_terms_url', array( 'label' => 'لینک قوانین و مقررات', 'section' => 'matin_parto_footer', 'type' => 'url' ) );
}
add_action( 'customize_register', 'matin_parto_customize_register' );

require_once get_template_directory() . '/wp-content/themes/matin-parto/inc/footer-widgets.php';
require_once get_template_directory() . '/wp-content/themes/matin-parto/inc/footer-widget-controls.php';

function matin_parto_fallback_menu() {
    echo '<ul class="mp-nav__list">';
    echo '<li class="is-current"><a href="' . esc_url( home_url( '/' ) ) . '">صفحه اصلی</a></li>';
    echo '<li><a href="#courses">دوره ها</a></li><li><a href="#about">درباره من</a></li><li><a href="#videos">ویدیو های آموزشی</a></li><li><a href="#blog">وبلاگ</a></li><li><a href="#contact">تماس با ما</a></li>';
    echo '</ul>';
}