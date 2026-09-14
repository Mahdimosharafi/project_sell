<?php
defined( 'ABSPATH' ) || exit;

/*
 * صفحه درباره من/ما باید همیشه قالب اختصاصی خودش را بگیرد.
 * علاوه بر is_page، عنوان، slug و مسیر درخواست را هم بررسی می‌کنیم تا
 * اگر تنظیمات permalink یا کش/Rewrite متفاوت بود، صفحه دوباره عمومی نشود.
 */
$page        = is_page() ? get_queried_object() : null;
$page_title  = $page instanceof WP_Post ? wp_strip_all_tags( $page->post_title ) : '';
$page_slug   = $page instanceof WP_Post ? strtolower( (string) $page->post_name ) : '';
$request_uri = isset( $_SERVER['REQUEST_URI'] ) ? strtolower( wp_unslash( $_SERVER['REQUEST_URI'] ) ) : '';

$is_about_page = (
    ( is_page() && ( false !== strpos( $page_title, 'درباره' ) || false !== strpos( $page_title, 'معرفی' ) ) ) ||
    in_array( $page_slug, array( 'about', 'about-us', 'about-me', 'درباره', 'درباره-من', 'درباره-ما' ), true ) ||
    false !== strpos( $request_uri, '/about' ) ||
    false !== strpos( $request_uri, 'درباره' )
);

if ( $is_about_page ) {
    $about_template = get_theme_file_path( 'page-about.php' );
    if ( file_exists( $about_template ) ) {
        nocache_headers();
        include $about_template;
        return;
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
