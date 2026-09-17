<?php
/**
 * Template Name: تماس با ما (Matin Parto)
 * Description: صفحه تماس با ما — با هدر و فوتر اصلی سایت و چیدمان کامل راست‌به‌چپ.
 *
 * این فایل دیگر هدر/فوتر اختصاصی ندارد؛ دقیقاً مثل صفحه «درباره من» قالب کامل را
 * از wp-content/themes/matin-parto/page-contact.php بارگذاری می‌کند و آن قالب هم
 * از get_header() و get_footer() سایت استفاده می‌کند.
 */
defined( 'ABSPATH' ) || exit;

/* جلوگیری از رندر دوباره (مسیر اضطراری /contact/ و روتر index.php هر دو این فایل را صدا می‌زنند). */
if ( defined( 'MATIN_PARTO_CONTACT_RENDERED' ) ) {
    return;
}
define( 'MATIN_PARTO_CONTACT_RENDERED', true );

$matin_parto_contact_sources = array(
    get_template_directory() . '/wp-content/themes/matin-parto/page-contact.php',
    WP_CONTENT_DIR . '/themes/matin-parto/page-contact.php',
);

foreach ( $matin_parto_contact_sources as $matin_parto_contact_source ) {
    if ( $matin_parto_contact_source !== __FILE__ && file_exists( $matin_parto_contact_source ) ) {
        require $matin_parto_contact_source;
        return;
    }
}

/* فالبک: اگر قالب کامل پیدا نشد، دست‌کم هدر و فوتر اصلی سایت نمایش داده شود. */
get_header();
?>
<main class="mp-contact-page" dir="rtl">
    <section class="mp-container mp-contact-hero">
        <div class="mp-contact-hero__copy">
            <div class="mp-contact-kicker">تماس با ما <i></i></div>
            <h1>با ما در ارتباط باشید</h1>
            <p>برای ارتباط با ما می‌توانید از طریق ایمیل info@matinparto.com در تماس باشید.</p>
        </div>
    </section>
</main>
<?php
get_footer();
