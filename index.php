<?php
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
