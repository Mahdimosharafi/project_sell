<?php
defined( 'ABSPATH' ) || exit;

/* Route the dedicated About and Contact pages to their templates. */
if ( is_page() ) {
    $page = get_queried_object();
    $title = $page instanceof WP_Post ? wp_strip_all_tags( $page->post_title ) : '';
    $slug  = $page instanceof WP_Post ? strtolower( (string) $page->post_name ) : '';
    $uri   = isset( $_SERVER['REQUEST_URI'] ) ? strtolower( wp_unslash( $_SERVER['REQUEST_URI'] ) ) : '';

    $is_about = false !== strpos( $title, 'درباره' )
        || false !== strpos( $title, 'معرفی' )
        || in_array( $slug, array( 'about', 'about-us', 'about-me', 'درباره', 'درباره-من', 'درباره-ما' ), true )
        || false !== strpos( $uri, '/about' )
        || false !== strpos( $uri, 'درباره' );

    $is_contact = false !== strpos( $title, 'تماس' )
        || in_array( $slug, array( 'contact', 'contact-us', 'تماس', 'تماس-با-ما' ), true )
        || false !== strpos( $uri, '/contact' )
        || false !== strpos( $uri, 'تماس' );

    if ( $is_about ) {
        $about_templates = array(
            get_template_directory() . '/page-about.php',
            WP_CONTENT_DIR . '/themes/matin-parto/page-about.php',
            dirname( __FILE__ ) . '/wp-content/themes/matin-parto/page-about.php',
        );
        foreach ( $about_templates as $about_template ) {
            if ( file_exists( $about_template ) ) {
                nocache_headers();
                include $about_template;
                return;
            }
        }
    }

    if ( $is_contact ) {
        $contact_templates = array(
            get_template_directory() . '/page-contact.php',
            WP_CONTENT_DIR . '/themes/matin-parto/page-contact.php',
            dirname( __FILE__ ) . '/wp-content/themes/matin-parto/page-contact.php',
        );
        foreach ( $contact_templates as $contact_template ) {
            if ( file_exists( $contact_template ) ) {
                nocache_headers();
                include $contact_template;
                return;
            }
        }
    }
}

get_header();

if ( is_front_page() ) {
    get_template_part( 'front-page' );
} else {
    echo '<main class="mp-home"><div class="mp-container mp-section">';
    if ( have_posts() ) : while ( have_posts() ) : the_post();
        the_title( '<h1>', '</h1>' );
        the_content();
    endwhile; endif;
    echo '</div></main>';
}

get_footer();
