<?php
defined( 'ABSPATH' ) || exit;

/*
 * صفحات وردپرس: صفحه «درباره» همیشه با قالب اختصاصی خودش رندر شود.
 * این فایل عمداً مستقل از MU Plugin است تا در هر نوع هاست/Deploy کار کند.
 */
if ( is_page() ) {
    $page = get_queried_object();
    $title = $page instanceof WP_Post ? wp_strip_all_tags( $page->post_title ) : '';
    $slug  = $page instanceof WP_Post ? (string) $page->post_name : '';

    if ( false !== strpos( $title, 'درباره' ) || false !== strpos( strtolower( $slug ), 'about' ) ) {
        $about_template = get_theme_file_path( 'page-about.php' );
        if ( file_exists( $about_template ) ) {
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
