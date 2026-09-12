<?php
/** Installable package front-page bridge. */
defined( 'ABSPATH' ) || exit;
$source = get_template_directory() . '/wp-content/themes/matin-parto/front-page.php';
if ( file_exists( $source ) ) {
    require $source;
} else {
    get_header();
    echo '<main class="mp-home"><div class="mp-container mp-section"><h1>Matin Parto</h1></div></main>';
    get_footer();
}
