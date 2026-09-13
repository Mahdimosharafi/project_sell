<?php
defined( 'ABSPATH' ) || exit;

function matin_parto_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'custom-logo', array( 'height' => 80, 'width' => 180, 'flex-height' => true, 'flex-width' => true ) );
    add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption', 'style', 'script' ) );
    remove_theme_support( 'widgets-block-editor' );
    register_nav_menus( array( 'primary' => __( 'منوی اصلی', 'matin-parto' ), 'footer' => __( 'منوی فوتر', 'matin-parto' ) ) );
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
    wp_enqueue_style( 'matin-parto-layout-fixes', get_template_directory_uri() . '/assets/css/layout-fixes.css', array( 'matin-parto-footer' ), '2026.09.13.1' );

    $footer_hover_color = get_theme_mod( 'matin_parto_footer_hover_color', '#7b2636' );
    $footer_hover_color = sanitize_hex_color( $footer_hover_color );
    if ( ! $footer_hover_color ) {
        $footer_hover_color = '#7b2636';
    }
    wp_add_inline_style( 'matin-parto-footer', ':root{--mp-footer-widget-hover:' . $footer_hover_color . ';}' );

    wp_enqueue_script( 'matin-parto-main', get_template_directory_uri() . '/assets/js/main.js', array(), '2026.09.13', true );
}
add_action( 'wp_enqueue_scripts', 'matin_parto_enqueue_assets' );

function matin_parto_customize_register( $wp_customize ) {
    $wp_customize->add_section( 'matin_parto_footer', array(
        'title'       => 'فوتر و پایین سایت',
        'priority'    => 160,
        'description' => 'تنظیمات متن و ظاهر فوتر سایت.',
    ) );

    $wp_customize->add_setting( 'matin_parto_footer_copyright', array( 'default' => 'ماتین پرتو © 2026', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'matin_parto_footer_copyright', array( 'label' => 'متن کپی‌رایت', 'section' => 'matin_parto_footer', 'type' => 'text' ) );
    $wp_customize->add_setting( 'matin_parto_footer_note', array( 'default' => 'طراحی و توسعه با وردپرس', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'matin_parto_footer_note', array( 'label' => 'متن سمت چپ نوار پایینی', 'section' => 'matin_parto_footer', 'type' => 'text' ) );
    $wp_customize->add_setting( 'matin_parto_footer_privacy_url', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
    $wp_customize->add_control( 'matin_parto_footer_privacy_url', array( 'label' => 'لینک حریم خصوصی', 'section' => 'matin_parto_footer', 'type' => 'url' ) );
    $wp_customize->add_setting( 'matin_parto_footer_terms_url', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
    $wp_customize->add_control( 'matin_parto_footer_terms_url', array( 'label' => 'لینک قوانین و مقررات', 'section' => 'matin_parto_footer', 'type' => 'url' ) );

    // رنگ هاور فهرست فوتر: کنترل رنگ واقعی در سفارشی‌سازی وردپرس.
    $wp_customize->add_setting( 'matin_parto_footer_hover_color', array(
        'default'           => '#7b2636',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'matin_parto_footer_hover_color', array(
        'label'       => 'رنگ هاور فهرست فوتر',
        'section'     => 'matin_parto_footer',
        'priority'    => 50,
        'description' => 'رنگ لینک‌های فهرست فوتر هنگام قرار گرفتن موس روی آن‌ها.',
    ) ) );
}
add_action( 'customize_register', 'matin_parto_customize_register' );

function matin_parto_footer_settings_menu() {
    add_theme_page( 'تنظیمات فوتر', 'تنظیمات فوتر', 'manage_options', 'matin-parto-footer', 'matin_parto_footer_settings_page' );
}
add_action( 'admin_menu', 'matin_parto_footer_settings_menu' );

function matin_parto_footer_settings_page() {
    if ( ! current_user_can( 'manage_options' ) ) { return; }
    if ( isset( $_POST['matin_parto_footer_save'] ) ) {
        check_admin_referer( 'matin_parto_footer_settings' );
        $color = isset( $_POST['matin_parto_footer_hover_color'] ) ? sanitize_hex_color( wp_unslash( $_POST['matin_parto_footer_hover_color'] ) ) : '#7b2636';
        set_theme_mod( 'matin_parto_footer_hover_color', $color ? $color : '#7b2636' );
        echo '<div class="notice notice-success is-dismissible"><p>تنظیمات فوتر ذخیره شد.</p></div>';
    }
    $color = get_theme_mod( 'matin_parto_footer_hover_color', '#7b2636' );
    ?>
    <div class="wrap" dir="rtl">
        <h1>تنظیمات فوتر</h1>
        <p>رنگ هاور فهرست‌های فوتر را از اینجا انتخاب کنید.</p>
        <form method="post">
            <?php wp_nonce_field( 'matin_parto_footer_settings' ); ?>
            <table class="form-table" role="presentation">
                <tr>
                    <th scope="row"><label for="matin_parto_footer_hover_color">رنگ هاور فهرست فوتر</label></th>
                    <td>
                        <input type="color" id="matin_parto_footer_hover_color" name="matin_parto_footer_hover_color" value="<?php echo esc_attr( $color ); ?>">
                        <code><?php echo esc_html( $color ); ?></code>
                        <p class="description">رنگی که با بردن موس روی لینک‌های فهرست فوتر نمایش داده می‌شود.</p>
                    </td>
                </tr>
            </table>
            <p><button type="submit" name="matin_parto_footer_save" class="button button-primary">ذخیره تغییرات</button></p>
        </form>
    </div>
    <?php
}

function matin_parto_fallback_menu() {
    echo '<ul class="mp-nav__list">';
    echo '<li class="is-current"><a href="' . esc_url( home_url( '/' ) ) . '">صفحه اصلی</a></li>';
    echo '<li><a href="#courses">دوره‌های من</a></li><li><a href="#about">درباره‌ی من</a></li><li><a href="#videos">ویدئوهای آموزشی</a></li><li><a href="#blog">وبلاگ</a></li><li><a href="#contact">تماس با ما</a></li>';
    echo '</ul>';
}
