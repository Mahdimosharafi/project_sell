<?php
defined( 'ABSPATH' ) || exit;

/* صفحه درباره: این قالب عمداً مستقیم page-about.php را اجرا می‌کند تا هیچ
 * محتوای قدیمی یا قالب عمومی وردپرس نتواند صفحه را جایگزین کند. */
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
        $about_template = get_theme_file_path( 'page-about.php' );
        if ( file_exists( $about_template ) ) {
            nocache_headers();
            include $about_template;
            return;
        }
    }
}

get_header();
?>
<main class="site-page" dir="rtl">
    <div class="mp-container">
        <?php while ( have_posts() ) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <h1><?php the_title(); ?></h1>
                <div class="entry-content"><?php the_content(); ?></div>
            </article>
        <?php endwhile; ?>
    </div>
</main>
<?php get_footer(); ?>
