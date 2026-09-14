<?php
defined( 'ABSPATH' ) || exit;

/*
 * Route About pages to the dedicated About template.
 * The active WordPress install in this repository uses the root index.php,
 * so this check must happen before the generic page renderer below.
 */
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

    if ( $is_about ) {
        $about_template = WP_CONTENT_DIR . '/themes/matin-parto/page-about.php';
        if ( file_exists( $about_template ) ) {
            nocache_headers();
            include $about_template;
            return;
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
