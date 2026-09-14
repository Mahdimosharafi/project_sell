<?php
/**
 * Matin Parto — force the About page template and its Customizer assets.
 * Loaded before the active theme, so the About page cannot fall back to the
 * generic WordPress page template.
 */
defined( 'ABSPATH' ) || exit;

function matin_parto_about_page_match() {
    if ( ! is_page() ) {
        return false;
    }
    $page = get_queried_object();
    if ( ! $page instanceof WP_Post ) {
        return false;
    }
    $title = wp_strip_all_tags( $page->post_title );
    $slug  = (string) $page->post_name;
    return false !== mb_strpos( $title, 'درباره' ) || false !== mb_strpos( $title, 'معرفی' ) || in_array( strtolower( $slug ), array( 'about', 'about-us', 'about-me', 'درباره', 'درباره-من', 'درباره-ما' ), true );
}

function matin_parto_force_about_template( $template ) {
    if ( ! matin_parto_about_page_match() ) {
        return $template;
    }
    $forced = WP_CONTENT_DIR . '/themes/matin-parto/page-about.php';
    return file_exists( $forced ) ? $forced : $template;
}
add_filter( 'template_include', 'matin_parto_force_about_template', 9999 );

function matin_parto_about_assets() {
    if ( ! matin_parto_about_page_match() ) {
        return;
    }
    $css = content_url( 'themes/matin-parto/assets/css/about-page.css' );
    wp_enqueue_style( 'matin-parto-about-forced', $css, array(), '2026.09.14.8' );
}
add_action( 'wp_enqueue_scripts', 'matin_parto_about_assets', 9999 );

function matin_parto_about_customizer( $customize ) {
    $customize->add_section( 'matin_parto_about_page', array(
        'title'       => 'صفحه درباره من',
        'priority'    => 145,
        'description' => 'تمام تصاویر صفحه درباره من را از این بخش انتخاب کنید.',
    ) );

    $items = array(
        'hero'  => array( 'عکس اصلی معرفی', 'عکس مدرس در بخش اول صفحه درباره من.' ),
        'video' => array( 'عکس بخش مسیر من', 'تصویر بخش «چطور وارد دنیای آموزش شدم؟».' ),
        'story' => array( 'عکس داستان / مسیر', 'تصویر داستان و مسیر آموزشی.' ),
        'extra' => array( 'تصویر اضافی صفحه', 'تصویر اختیاری برای بخش پایین صفحه.' ),
    );

    foreach ( $items as $key => $item ) {
        $setting = 'matin_parto_about_' . $key . '_image';
        $customize->add_setting( $setting, array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
            'transport'         => 'refresh',
        ) );
        $customize->add_control( new WP_Customize_Image_Control( $customize, $setting, array(
            'label'       => $item[0],
            'description' => $item[1],
            'section'     => 'matin_parto_about_page',
        ) ) );
    }
}
add_action( 'customize_register', 'matin_parto_about_customizer', 5 );

function matin_parto_about_links_to_page( $atts, $item, $args ) {
    if ( ! $item instanceof WP_Post ) {
        return $atts;
    }
    $title = wp_strip_all_tags( $item->title );
    if ( false !== mb_strpos( $title, 'درباره' ) || false !== mb_strpos( $title, 'معرفی' ) ) {
        $page = get_page_by_path( 'about' );
        if ( ! $page ) {
            $pages = get_pages( array( 'post_status' => 'publish', 'number' => 100 ) );
            foreach ( $pages as $candidate ) {
                if ( false !== mb_strpos( wp_strip_all_tags( $candidate->post_title ), 'درباره' ) ) {
                    $page = $candidate;
                    break;
                }
            }
        }
        if ( $page ) {
            $atts['href'] = get_permalink( $page->ID );
        }
    }
    return $atts;
}
add_filter( 'nav_menu_link_attributes', 'matin_parto_about_links_to_page', 9999, 3 );
