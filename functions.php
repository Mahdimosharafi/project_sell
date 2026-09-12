<?php
/** Matin Parto installable theme package. */
defined( 'ABSPATH' ) || exit;

function matin_parto_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'custom-logo', array( 'height' => 80, 'width' => 180, 'flex-height' => true, 'flex-width' => true ) );
    add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption', 'style', 'script' ) );
    register_nav_menus( array( 'primary' => __( 'منوی اصلی', 'matin-parto' ), 'footer' => __( 'منوی فوتر', 'matin-parto' ) ) );
}
add_action( 'after_setup_theme', 'matin_parto_setup' );

function matin_parto_enqueue_assets() {
    $uri = get_template_directory_uri();
    $dir = get_template_directory();
    $files = array(
        'matin-parto-style' => '/style.css',
        'matin-parto-main' => '/assets/css/main.css',
        'matin-parto-polish' => '/assets/css/header-footer-polish.css',
        'matin-parto-home' => '/assets/css/home.css',
    );
    $deps = array();
    foreach ( $files as $handle => $file ) {
        $path = $dir . $file;
        $version = file_exists( $path ) ? (string) filemtime( $path ) : '0.2.0';
        wp_enqueue_style( $handle, $uri . $file, $deps, $version );
        $deps = array( $handle );
    }
    $js = $dir . '/assets/js/main.js';
    wp_enqueue_script( 'matin-parto-main', $uri . '/assets/js/main.js', array(), file_exists( $js ) ? (string) filemtime( $js ) : '0.2.0', true );
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
