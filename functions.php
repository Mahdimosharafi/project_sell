<?php
/** Matin Parto installable package bootstrap. */
defined( 'ABSPATH' ) || exit;
function matin_parto_setup() {
    add_theme_support( 'title-tag' ); add_theme_support( 'post-thumbnails' );
    add_theme_support( 'custom-logo', array( 'height'=>80, 'width'=>180, 'flex-height'=>true, 'flex-width'=>true ) );
    add_theme_support( 'html5', array( 'search-form','gallery','caption','style','script' ) );
    register_nav_menus( array( 'primary'=>__( 'منوی اصلی','matin-parto' ), 'footer'=>__( 'منوی فوتر','matin-parto' ) ) );
}
add_action( 'after_setup_theme', 'matin_parto_setup' );
function matin_parto_enqueue_assets() {
    $uri = get_template_directory_uri() . '/wp-content/themes/matin-parto';
    $dir = get_template_directory() . '/wp-content/themes/matin-parto';
    $files = array('matin-parto-style'=>'/style.css','matin-parto-main'=>'/assets/css/main.css','matin-parto-polish'=>'/assets/css/header-footer-polish.css','matin-parto-home'=>'/assets/css/home.css');
    $deps = array();
    foreach ( $files as $handle=>$file ) { $path=$dir.$file; if(file_exists($path)){ wp_enqueue_style($handle,$uri.$file,$deps,(string)filemtime($path)); $deps=array($handle); } }
    $js=$dir.'/assets/js/main.js'; if(file_exists($js)){ wp_enqueue_script('matin-parto-main',$uri.'/assets/js/main.js',array(),(string)filemtime($js),true); }
}
add_action( 'wp_enqueue_scripts', 'matin_parto_enqueue_assets' );
function matin_parto_fallback_menu() {
    echo '<ul class="mp-nav__list">';
    echo '<li class="is-current"><a href="'.esc_url(home_url('/')).'">صفحه اصلی</a></li><li><a href="#courses">دوره‌های من</a></li><li><a href="#about">درباره‌ی من</a></li><li><a href="#videos">ویدئوهای آموزشی</a></li><li><a href="#blog">وبلاگ</a></li><li><a href="#contact">تماس با ما</a></li>';
    echo '</ul>';
}
