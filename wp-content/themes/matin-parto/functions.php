<?php
/**
 * Matin Parto theme setup.
 */

defined( 'ABSPATH' ) || exit;

function matin_parto_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'custom-logo', array(
        'height'      => 80,
        'width'       => 180,
        'flex-height' => true,
        'flex-width'  => true,
    ) );
    add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption', 'style', 'script' ) );

    register_nav_menus( array(
        'primary' => __( 'منوی اصلی', 'matin-parto' ),
        'footer'  => __( 'منوی فوتر', 'matin-parto' ),
    ) );
}
add_action( 'after_setup_theme', 'matin_parto_setup' );

function matin_parto_enqueue_assets() {
    wp_enqueue_style(
        'matin-parto-style',
        get_stylesheet_uri(),
        array(),
        '0.1.0'
    );

    wp_enqueue_style(
        'matin-parto-main',
        get_template_directory_uri() . '/assets/css/main.css',
        array( 'matin-parto-style' ),
        '0.1.0'
    );

    wp_enqueue_script(
        'matin-parto-main',
        get_template_directory_uri() . '/assets/js/main.js',
        array(),
        '0.1.0',
        true
    );
}
add_action( 'wp_enqueue_scripts', 'matin_parto_enqueue_assets' );

function matin_parto_fallback_menu() {
    echo '<ul class="mp-nav__list">';
    echo '<li class="is-current"><a href="' . esc_url( home_url( '/' ) ) . '">صفحه اصلی</a></li>';
    echo '<li><a href="#courses">دوره‌های من</a></li>';
    echo '<li><a href="#about">درباره‌ی من</a></li>';
    echo '<li><a href="#videos">ویدئوهای آموزشی</a></li>';
    echo '<li><a href="#blog">وبلاگ</a></li>';
    echo '<li><a href="#contact">تماس با ما</a></li>';
    echo '</ul>';
}
