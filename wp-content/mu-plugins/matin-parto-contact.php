<?php
defined( 'ABSPATH' ) || exit;

/** Matin Parto contact page: customizer image slots, robust /contact/ route, form handler and site-wide contact links. */
add_action( 'customize_register', function( $wp_customize ) {
    $wp_customize->add_section( 'matin_parto_contact_page', array( 'title' => 'صفحه تماس با ما', 'priority' => 158, 'description' => 'فقط تصاویر صفحه تماس با ما را از این بخش انتخاب یا تغییر دهید.' ) );
    foreach ( array(
        'hero_image'  => array( 'تصویر مدرس در هدر', 'عکس اصلی بخش بالای صفحه.' ),
        'aside_image' => array( 'تصویر کارت کنار فرم', 'تصویر داخل کارت نقل‌قول کنار فرم تماس.' ),
        'map_image'   => array( 'تصویر نقشه و لوکیشن', 'تصویر نقشه بخش آدرس و لوکیشن.' ),
    ) as $key => $data ) {
        $wp_customize->add_setting( 'matin_parto_contact_' . $key, array( 'default' => '', 'sanitize_callback' => 'esc_url_raw', 'transport' => 'refresh' ) );
        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'matin_parto_contact_' . $key, array( 'label' => $data[0], 'description' => $data[1], 'section' => 'matin_parto_contact_page' ) ) );
    }
} );

function matin_parto_is_contact_request() {
    $path = isset( $_SERVER['REQUEST_URI'] ) ? trim( (string) wp_parse_url( wp_unslash( $_SERVER['REQUEST_URI'] ), PHP_URL_PATH ), '/' ) : '';
    return 'contact' === $path || 'contact' === basename( $path );
}

/* Run before the normal template resolver so /contact/ cannot become a 404 when no WP Page exists. */
add_action( 'template_redirect', function() {
    if ( ! matin_parto_is_contact_request() ) return;
    $template = get_theme_file_path( 'page-contact.php' );
    if ( ! file_exists( $template ) ) return;
    status_header( 200 );
    nocache_headers();
    include $template;
    exit;
}, 0 );

function matin_parto_contact_redirect( $status ) {
    $url = add_query_arg( 'contact', $status, home_url( '/contact/' ) ) . '#contact-form';
    wp_safe_redirect( $url );
    exit;
}
function matin_parto_handle_contact_form() {
    if ( ! isset( $_POST['matin_parto_contact_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['matin_parto_contact_nonce'] ) ), 'matin_parto_contact_form' ) ) matin_parto_contact_redirect( 'error' );
    $name = isset( $_POST['contact_name'] ) ? sanitize_text_field( wp_unslash( $_POST['contact_name'] ) ) : '';
    $email = isset( $_POST['contact_email'] ) ? sanitize_email( wp_unslash( $_POST['contact_email'] ) ) : '';
    $subject = isset( $_POST['contact_subject'] ) ? sanitize_text_field( wp_unslash( $_POST['contact_subject'] ) ) : '';
    $message = isset( $_POST['contact_message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['contact_message'] ) ) : '';
    if ( ! $name || ! is_email( $email ) || ! $subject || ! $message ) matin_parto_contact_redirect( 'error' );
    $body = "نام: {$name}\nایمیل: {$email}\nموضوع: {$subject}\n\nپیام:\n{$message}";
    $headers = array( 'Reply-To: ' . $name . ' <' . $email . '>' );
    matin_parto_contact_redirect( wp_mail( get_option( 'admin_email' ), 'پیام تماس با ما: ' . $subject, $body, $headers ) ? 'sent' : 'error' );
}
add_action( 'admin_post_matin_parto_contact', 'matin_parto_handle_contact_form' );
add_action( 'admin_post_nopriv_matin_parto_contact', 'matin_parto_handle_contact_form' );

/* Safety net for old #contact links and any header/footer link labelled تماس با ما. */
add_action( 'wp_footer', function() {
    $contact_url = esc_url( home_url( '/contact/' ) );
    echo '<script>(function(){var u=' . wp_json_encode( $contact_url ) . ';function route(){document.querySelectorAll("a").forEach(function(a){var t=(a.textContent||"").replace(/\\s+/g," ").trim(),h=a.getAttribute("href")||"";if(h==="#contact"||/\\#contact(?:$|-)/.test(h)||t==="تماس با ما")a.setAttribute("href",u);});}if(document.readyState==="loading")document.addEventListener("DOMContentLoaded",route);else route();document.addEventListener("click",function(e){var a=e.target.closest?a.target.closest("a"):null;if(!a)return;var t=(a.textContent||"").replace(/\\s+/g," ").trim(),h=a.getAttribute("href")||"";if(h==="#contact"||/\\#contact(?:$|-)/.test(h)||t==="تماس با ما"){e.preventDefault();window.location.href=u;}},true);})();</script>';
} );
