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

/**
 * Enqueue every theme stylesheet explicitly.
 * File modification times prevent old cached CSS from being served.
 */
function matin_parto_enqueue_assets() {
    $theme_dir = get_template_directory();
    $theme_uri = get_template_directory_uri();

    $style_path = $theme_dir . '/style.css';
    $main_path  = $theme_dir . '/assets/css/main.css';
    $polish_path = $theme_dir . '/assets/css/header-footer-polish.css';
    $home_path  = $theme_dir . '/assets/css/home.css';
    $script_path = $theme_dir . '/assets/js/main.js';

    wp_enqueue_style(
        'matin-parto-style',
        $theme_uri . '/style.css',
        array(),
        file_exists( $style_path ) ? filemtime( $style_path ) : '0.1.0'
    );

    wp_enqueue_style(
        'matin-parto-main',
        $theme_uri . '/assets/css/main.css',
        array( 'matin-parto-style' ),
        file_exists( $main_path ) ? filemtime( $main_path ) : '0.1.0'
    );

    wp_enqueue_style(
        'matin-parto-polish',
        $theme_uri . '/assets/css/header-footer-polish.css',
        array( 'matin-parto-main' ),
        file_exists( $polish_path ) ? filemtime( $polish_path ) : '0.1.0'
    );

    // Load homepage CSS unconditionally so it is still available when
    // WordPress is configured with a static Page instead of front-page.php.
    wp_enqueue_style(
        'matin-parto-home',
        $theme_uri . '/assets/css/home.css',
        array( 'matin-parto-polish' ),
        file_exists( $home_path ) ? filemtime( $home_path ) : '0.1.0'
    );

    wp_enqueue_script(
        'matin-parto-main',
        $theme_uri . '/assets/js/main.js',
        array(),
        file_exists( $script_path ) ? filemtime( $script_path ) : '0.1.0',
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
