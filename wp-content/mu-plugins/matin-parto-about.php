<?php
/**
 * Matin Parto — About page routing, settings and navigation.
 */
defined( 'ABSPATH' ) || exit;

function matin_parto_about_page_url() {
    $page = get_page_by_path( 'about' );
    if ( $page instanceof WP_Post ) {
        return get_permalink( $page );
    }
    $page = get_page_by_title( 'درباره من', OBJECT, 'page' );
    if ( $page instanceof WP_Post ) {
        return get_permalink( $page );
    }
    return home_url( '/about/' );
}

function matin_parto_about_ensure_page() {
    if ( get_page_by_path( 'about' ) ) {
        return;
    }
    $existing = get_page_by_title( 'درباره من', OBJECT, 'page' );
    if ( $existing instanceof WP_Post ) {
        return;
    }
    $page_id = wp_insert_post( array(
        'post_title'   => 'درباره من',
        'post_name'    => 'about',
        'post_status'  => 'publish',
        'post_type'    => 'page',
        'post_content' => '',
    ) );
    if ( $page_id && ! get_option( 'matin_parto_about_rewrite_flushed' ) ) {
        flush_rewrite_rules( false );
        update_option( 'matin_parto_about_rewrite_flushed', 1, false );
    }
}
add_action( 'init', 'matin_parto_about_ensure_page', 20 );

function matin_parto_about_template( $template ) {
    if ( ! is_page() ) {
        return $template;
    }
    $post = get_queried_object();
    if ( ! $post instanceof WP_Post ) {
        return $template;
    }
    $haystack = strtolower( $post->post_name . ' ' . $post->post_title );
    if ( false !== strpos( $haystack, 'about' ) || false !== strpos( $post->post_title, 'درباره' ) ) {
        $about_template = get_theme_file_path( 'page-about.php' );
        if ( file_exists( $about_template ) ) {
            return $about_template;
        }
    }
    return $template;
}
add_filter( 'template_include', 'matin_parto_about_template', 99 );

function matin_parto_about_assets() {
    if ( is_page() ) {
        $post = get_queried_object();
        if ( $post instanceof WP_Post && ( false !== strpos( strtolower( $post->post_name ), 'about' ) || false !== strpos( $post->post_title, 'درباره' ) ) ) {
            wp_enqueue_style( 'matin-parto-about-page', get_theme_file_uri( 'assets/css/about-page.css' ), array( 'matin-parto-cta-social' ), '2026.09.14-4' );
        }
    }
}
add_action( 'wp_enqueue_scripts', 'matin_parto_about_assets', 40 );

/* لینک‌های منوی هدر/فوتر که عنوانشان «درباره» است به همین صفحه می‌روند. */
function matin_parto_about_link_filter( $items, $args ) {
    if ( empty( $items ) || ! is_array( $items ) ) {
        return $items;
    }
    foreach ( $items as $item ) {
        if ( ! $item instanceof WP_Post ) {
            continue;
        }
        $title = wp_strip_all_tags( $item->title );
        if ( false !== strpos( $title, 'درباره' ) || false !== strpos( strtolower( $title ), 'about' ) ) {
            $item->url = matin_parto_about_page_url();
        }
    }
    return $items;
}
add_filter( 'wp_nav_menu_objects', 'matin_parto_about_link_filter', 20, 2 );

function matin_parto_about_customizer( $wp_customize ) {
    $wp_customize->add_section( 'matin_parto_about_images', array(
        'title'       => 'صفحه درباره من',
        'priority'    => 154,
        'description' => 'تمام تصاویر صفحه درباره من را از این بخش انتخاب کنید.',
    ) );

    $images = array(
        'hero'  => array( 'عکس اصلی معرفی', 'تصویر اصلی مدرس در ابتدای صفحه.' ),
        'video' => array( 'عکس بخش مسیر من', 'تصویر بزرگ بخش «چطور وارد دنیای آموزش شدم؟».' ),
        'story' => array( 'عکس داستان من', 'تصویر تکمیلی داستان و مسیر آموزش.' ),
        'extra' => array( 'تصویر اضافه صفحه', 'در صورت نیاز یک تصویر تمام‌عرض در پایین بخش‌ها.' ),
    );

    foreach ( $images as $key => $data ) {
        $setting = 'matin_parto_about_' . $key . '_image';
        $wp_customize->add_setting( $setting, array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
            'transport'         => 'refresh',
        ) );
        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $setting, array(
            'label'       => $data[0],
            'description' => $data[1],
            'section'     => 'matin_parto_about_images',
        ) ) );
    }
}
add_action( 'customize_register', 'matin_parto_about_customizer', 25 );
