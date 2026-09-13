<?php
defined( 'ABSPATH' ) || exit;

function matin_parto_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'custom-logo', array( 'height' => 80, 'width' => 180, 'flex-height' => true, 'flex-width' => true ) );
    add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption', 'style', 'script' ) );
    remove_theme_support( 'widgets-block-editor' );
    register_nav_menus( array( 'primary' => __( 'منوی اصلی', 'matin-parto' ), 'footer' => __( 'منوی فوتر', 'matin-parto' ) );
}
add_action( 'after_setup_theme', 'matin_parto_setup' );
add_filter( 'use_widgets_block_editor', '__return_false' );
add_filter( 'gutenberg_use_widgets_block_editor', '__return_false' );

function matin_parto_enqueue_assets() {
    wp_enqueue_style( 'matin-parto-style', get_stylesheet_uri(), array(), '2026.09.13' );
    wp_enqueue_style( 'matin-parto-main', get_template_directory_uri() . '/assets/css/main.css', array( 'matin-parto-style' ), '2026.09.13' );
    wp_enqueue_style( 'matin-parto-polish', get_template_directory_uri() . '/assets/css/header-footer-polish.css', array( 'matin-parto-main' ), '2026.09.13' );
    wp_enqueue_style( 'matin-parto-home', get_template_directory_uri() . '/assets/css/home.css', array( 'matin-parto-polish' ), '2026.09.13' );
    wp_enqueue_style( 'matin-parto-footer', get_template_directory_uri() . '/assets/css/footer-widgets.css', array( 'matin-parto-home' ), '2026.09.13' );
    wp_enqueue_script( 'matin-parto-main', get_template_directory_uri() . '/assets/js/main.js', array(), '2026.09.13', true );
}
add_action( 'wp_enqueue_scripts', 'matin_parto_enqueue_assets' );

function matin_parto_customize_register( $wp_customize ) {
    $wp_customize->add_section( 'matin_parto_footer', array( 'title' => 'فوتر و پایین سایت', 'priority' => 160 ) );
    $wp_customize->add_setting( 'matin_parto_footer_copyright', array( 'default' => 'ماتین پرتو © 2026', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'matin_parto_footer_copyright', array( 'label' => 'متن کپی‌رایت', 'section' => 'matin_parto_footer', 'type' => 'text' ) );
    $wp_customize->add_setting( 'matin_parto_footer_note', array( 'default' => 'طراحی و توسعه با وردپرس', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'matin_parto_footer_note', array( 'label' => 'متن سمت چپ نوار پایینی', 'section' => 'matin_parto_footer', 'type' => 'text' ) );
    $wp_customize->add_setting( 'matin_parto_footer_privacy_url', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
    $wp_customize->add_control( 'matin_parto_footer_privacy_url', array( 'label' => 'لینک حریم خصوصی', 'section' => 'matin_parto_footer', 'type' => 'url' ) );
    $wp_customize->add_setting( 'matin_parto_footer_terms_url', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
    $wp_customize->add_control( 'matin_parto_footer_terms_url', array( 'label' => 'لینک قوانین و مقررات', 'section' => 'matin_parto_footer', 'type' => 'url' ) );
    $wp_customize->add_setting( 'matin_parto_footer_hover_color', array( 'default' => '#8f3048', 'sanitize_callback' => 'sanitize_hex_color' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'matin_parto_footer_hover_color', array( 'label' => 'رنگ هاور فهرست فوتر', 'section' => 'matin_parto_footer', 'description' => 'رنگ لینک‌های فهرست فوتر هنگام قرار گرفتن موس روی آن‌ها.' ) ) );
}
add_action( 'customize_register', 'matin_parto_customize_register' );

function matin_parto_fallback_menu() {
    echo '<ul class="mp-nav__list">';
    echo '<li class="is-current"><a href="' . esc_url( home_url( '/' ) ) . '">صفحه اصلی</a></li>';
    echo '<li><a href="#courses">دوره‌های من</a></li><li><a href="#about">درباره‌ی من</a></li><li><a href="#videos">ویدئوهای آموزشی</a></li><li><a href="#blog">وبلاگ</a></li><li><a href="#contact">تماس با ما</a></li>';
    echo '</ul>';
}
