<?php
/** Matin Parto root theme bootstrap. */
defined( 'ABSPATH' ) || exit;

function matin_parto_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'custom-logo', array( 'height' => 80, 'width' => 180, 'flex-height' => true, 'flex-width' => true ) );
    add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption', 'style', 'script' ) );
    remove_theme_support( 'widgets-block-editor' );

    register_nav_menus( array(
        'primary' => __( 'منوی اصلی', 'matin-parto' ),
        'footer'  => __( 'منوی فوتر', 'matin-parto' ),
    ) );
}
add_action( 'after_setup_theme', 'matin_parto_setup' );

// Make sure Appearance > Widgets opens the classic widget manager.
add_filter( 'use_widgets_block_editor', '__return_false' );
add_filter( 'gutenberg_use_widgets_block_editor', '__return_false' );

/** Load the working theme assets kept in the repository package. */
function matin_parto_enqueue_assets() {
    $base_dir = get_template_directory() . '/wp-content/themes/matin-parto';
    $base_uri = get_template_directory_uri() . '/wp-content/themes/matin-parto';
    $files = array(
        'matin-parto-style'   => '/style.css',
        'matin-parto-main'    => '/assets/css/main.css',
        'matin-parto-polish'  => '/assets/css/header-footer-polish.css',
        'matin-parto-home'    => '/assets/css/home.css',
        'matin-parto-footer'  => '/assets/css/footer-widgets.css',
    );
    $deps = array();
    foreach ( $files as $handle => $file ) {
        $path = $base_dir . $file;
        if ( file_exists( $path ) ) {
            wp_enqueue_style( $handle, $base_uri . $file, $deps, (string) filemtime( $path ) );
            $deps = array( $handle );
        }
    }
    $js = $base_dir . '/assets/js/main.js';
    if ( file_exists( $js ) ) {
        wp_enqueue_script( 'matin-parto-main', $base_uri . '/assets/js/main.js', array(), (string) filemtime( $js ), true );
    }
}
add_action( 'wp_enqueue_scripts', 'matin_parto_enqueue_assets' );

/** Footer controls in Appearance > Customize. */
function matin_parto_customize_register( $wp_customize ) {
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

// The actual footer widget registration and social widget live in the working theme package.
require_once get_template_directory() . '/wp-content/themes/matin-parto/inc/footer-widgets.php';

function matin_parto_fallback_menu() {
    echo '<ul class="mp-nav__list">';
    echo '<li class="is-current"><a href="' . esc_url( home_url( '/' ) ) . '">صفحه اصلی</a></li>';
    echo '<li><a href="#courses">دوره‌های من</a></li><li><a href="#about">درباره‌ی من</a></li><li><a href="#videos">ویدئوهای آموزشی</a></li><li><a href="#blog">وبلاگ</a></li><li><a href="#contact">تماس با ما</a></li>';
    echo '</ul>';
}
