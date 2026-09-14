<?php
/** About page bridge for the installable package theme. */
defined( 'ABSPATH' ) || exit;
$source = get_template_directory() . '/wp-content/themes/matin-parto/page-about.php';
if ( file_exists( $source ) ) {
    require $source;
} else {
    get_header();
    echo '<main class="mp-about-page"><div class="mp-container mp-section"><h1>درباره من</h1></div></main>';
    get_footer();
}
