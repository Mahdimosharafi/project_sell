<?php
/**
 * Matin Parto — About page UI and Customizer controls.
 */
defined( 'ABSPATH' ) || exit;

function matin_parto_about_ui_assets() {
    if ( is_page_template( 'page-about.php' ) ) {
        wp_enqueue_style(
            'matin-parto-about-page',
            get_template_directory_uri() . '/assets/css/about-page.css',
            array( 'matin-parto-main', 'matin-parto-layout-fixes' ),
            '2026.09.15.2'
        );
    }
}
add_action( 'wp_enqueue_scripts', 'matin_parto_about_ui_assets', 40 );

function matin_parto_about_customizer( $wp_customize ) {
    $wp_customize->add_section( 'matin_parto_about_page', array(
        'title' => 'صفحه درباره من',
        'priority' => 150,
        'description' => 'تصاویر قابل ویرایش صفحه درباره من.',
    ) );

    $images = array(
        'matin_parto_about_hero_image' => array( 'عکس مدرس در بخش معرفی', 'تصویر اصلی مدرس در ابتدای صفحه درباره من.' ),
        'matin_parto_about_story_image' => array( 'تصویر بخش مسیر من', 'در صورت نداشتن ویدیوی معرفی، این تصویر نمایش داده می‌شود.' ),
        'matin_parto_about_video_image' => array( 'کاور ویدیوی معرفی', 'برای ویدیوی معرفی به‌عنوان تصویر شاخص/کاور استفاده می‌شود.' ),
        'matin_parto_about_extra_image' => array( 'تصویر اضافه صفحه', 'اختیاری؛ اگر انتخاب شود قبل از نظر زبان‌آموز نمایش داده می‌شود.' ),
    );

    foreach ( $images as $setting => $data ) {
        $wp_customize->add_setting( $setting, array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
            'transport' => 'refresh',
        ) );
        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $setting, array(
            'label' => $data[0],
            'description' => $data[1],
            'section' => 'matin_parto_about_page',
        ) ) );
    }
}
add_action( 'customize_register', 'matin_parto_about_customizer', 30 );
