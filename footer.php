<?php
defined( 'ABSPATH' ) || exit;

$footer_copyright = get_theme_mod( 'matin_parto_footer_copyright', 'ماتین پرتو © 2026' );
$footer_note      = get_theme_mod( 'matin_parto_footer_note', 'طراحی و توسعه با وردپرس' );
$privacy_url      = get_theme_mod( 'matin_parto_footer_privacy_url', '' );
$terms_url        = get_theme_mod( 'matin_parto_footer_terms_url', '' );
$footer_hover_color = sanitize_hex_color( get_theme_mod( 'matin_parto_footer_hover_color', '#7b2636' ) );
if ( ! $footer_hover_color ) {
    $footer_hover_color = '#7b2636';
}

$cta_image = esc_url( get_theme_mod( 'matin_parto_cta_image', '' ) );
$socials = array(
    'whatsapp'  => esc_url( get_theme_mod( 'matin_parto_social_whatsapp', '' ) ),
    'telegram'  => esc_url( get_theme_mod( 'matin_parto_social_telegram', '' ) ),
    'instagram' => esc_url( get_theme_mod( 'matin_parto_social_instagram', '' ) ),
    'youtube'   => esc_url( get_theme_mod( 'matin_parto_social_youtube', '' ) ),
);
?>

<style id="matin-parto-footer-hover-fix">
.mp-footer .mp-footer-column a:hover,
.mp-footer .mp-footer-column a:hover *,
.mp-footer .mp-footer-column a:focus-visible,
.mp-footer .mp-footer-column a:focus-visible *,
.mp-footer .mp-footer-column li:hover > a,
.mp-footer .mp-footer-column li:hover > a *,
.mp-footer .mp-footer-column .menu-item:hover > a,
.mp-footer .mp-footer-column .menu-item:hover > a *,
.mp-footer .mp-footer-column .menu-item > a:hover,
.mp-footer .mp-footer-column .menu-item > a:hover *,
.mp-footer .mp-footer-column nav a:hover,
.mp-footer .mp-footer-column nav a:hover *,
.mp-footer .mp-footer-column .widget a:hover,
.mp-footer .mp-footer-column .widget a:hover * {
    color: <?php echo esc_attr( $footer_hover_color ); ?> !important;
    -webkit-text-fill-color: <?php echo esc_attr( $footer_hover_color ); ?> !important;
    opacity: 1 !important;
}
</style>

<footer class="mp-footer" id="contact">
    <div class="mp-container">
        <?php if ( ! is_front_page() ) : ?>
            <section class="mp-footer-cta">
                <div class="mp-footer-cta__content">
                    <span class="mp-footer-cta__eyebrow">همین امروز شروع کنید!</span>
                    <h2>دسترسی به ده‌ها ویدئو و دوره آموزشی</h2>
                    <a class="mp-button mp-button--light" href="<?php echo esc_url( home_url( '/#courses' ) ); ?>">شروع یادگیری رایگان</a>
                </div>

                <div class="mp-footer-cta__figure" aria-label="تصویر بخش پایانی">
                    <?php if ( $cta_image ) : ?>
                        <img class="mp-footer-cta__image" src="<?php echo esc_url( $cta_image ); ?>" alt="تصویر بخش پایانی" loading="lazy">
                    <?php else : ?>
                        <div class="mp-footer-cta__shape"></div>
                        <span class="mp-footer-cta__silhouette">M</span>
                    <?php endif; ?>
                </div>

                <div class="mp-footer-cta__social">
                    <span>در شبکه‌های اجتماعی همراه باشید</span>
                    <small>محتوای رایگان، نکات آموزشی و اخبار دوره‌ها</small>
                    <div class="mp-footer-cta__social-links" aria-label="شبکه‌های اجتماعی">
                        <?php if ( $socials['whatsapp'] ) : ?>
                            <a class="mp-footer-cta__social-link" href="<?php echo esc_url( $socials['whatsapp'] ); ?>" target="_blank" rel="noopener noreferrer" aria-label="واتساپ">
                                <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 2a9.9 9.9 0 0 0-8.57 14.86L2 22l5.3-1.39A10 10 0 1 0 12 2Zm0 18a8 8 0 0 1-4.08-1.12l-.29-.17-3.15.83.84-3.07-.19-.31A8 8 0 1 1 12 20Zm4.37-5.96c-.24-.12-1.42-.7-1.64-.78-.22-.08-.38-.12-.54.12-.16.24-.62.78-.76.94-.14.16-.28.18-.52.06-1.4-.7-2.32-1.25-3.25-2.83-.24-.41.24-.38.69-1.26.08-.16.04-.3-.02-.42-.06-.12-.54-1.3-.74-1.78-.2-.47-.4-.4-.54-.41h-.46c-.16 0-.42.06-.64.3-.22.24-.84.82-.84 2s.86 2.32.98 2.48c.12.16 1.68 2.56 4.07 3.59 1.51.65 2.1.71 2.86.6.46-.07 1.42-.58 1.62-1.14.2-.56.2-1.04.14-1.14-.06-.1-.22-.16-.46-.28Z"/></svg>
                            </a>
                        <?php endif; ?>
                        <?php if ( $socials['telegram'] ) : ?>
                            <a class="mp-footer-cta__social-link" href="<?php echo esc_url( $socials['telegram'] ); ?>" target="_blank" rel="noopener noreferrer" aria-label="تلگرام">
                                <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M21.5 3.5 18.3 20c-.24 1.17-.88 1.46-1.78.91l-4.86-3.58-2.35 2.26c-.26.26-.48.48-.98.48l.35-4.95 9.01-8.14c.39-.35-.08-.55-.6-.2L6.24 13.72l-4.77-1.5c-1.04-.33-1.06-1.04.22-1.54L20.3 2.12c.87-.32 1.63.2 1.2 1.38Z"/></svg>
                            </a>
                        <?php endif; ?>
                        <?php if ( $socials['instagram'] ) : ?>
                            <a class="mp-footer-cta__social-link" href="<?php echo esc_url( $socials['instagram'] ); ?>" target="_blank" rel="noopener noreferrer" aria-label="اینستاگرام">
                                <svg viewBox="0 0 24 24" aria-hidden="true"><rect x="3" y="3" width="18" height="18" rx="5" fill="none" stroke="currentColor" stroke-width="2"/><circle cx="12" cy="12" r="4" fill="none" stroke="currentColor" stroke-width="2"/><circle cx="17.5" cy="6.5" r="1.2"/></svg>
                            </a>
                        <?php endif; ?>
                        <?php if ( $socials['youtube'] ) : ?>
                            <a class="mp-footer-cta__social-link" href="<?php echo esc_url( $socials['youtube'] ); ?>" target="_blank" rel="noopener noreferrer" aria-label="یوتیوب">
                                <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M21.6 7.2a2.9 2.9 0 0 0-2.04-2.05C17.76 4.65 12 4.65 12 4.65s-5.76 0-7.56.5A2.9 2.9 0 0 0 2.4 7.2 30 30 0 0 0 1.9 12a30 30 0 0 0 .5 4.8 2.9 2.9 0 0 0 2.04 2.05c1.8.5 7.56.5 7.56.5s5.76 0 7.56-.5a2.9 2.9 0 0 0 2.04-2.05 30 30 0 0 0 .5-4.8 30 30 0 0 0-.5-4.8ZM10 15.35v-6.7L15.8 12 10 15.35Z"/></svg>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </section>
        <?php endif; ?>

        <section class="mp-footer-main">
            <div class="mp-footer-column mp-footer-newsletter">
                <h3>در خبرنامه عضو شوید</h3>
                <p>برای دریافت جدیدترین مطالب و نکته‌های ویژه، ایمیل خود را وارد کنید.</p>
                <form class="mp-newsletter" action="#" method="post">
                    <label class="screen-reader-text" for="mp-newsletter-email">ایمیل</label>
                    <input id="mp-newsletter-email" type="email" name="email" placeholder="ایمیل خود را وارد کنید" required>
                    <button type="submit">عضویت</button>
                </form>
            </div>

            <div class="mp-footer-column mp-footer-categories">
                <?php if ( is_active_sidebar( 'footer-categories' ) ) : ?>
                    <?php dynamic_sidebar( 'footer-categories' ); ?>
                <?php else : ?>
                    <h3>دسته‌بندی‌ها</h3>
                    <a href="<?php echo esc_url( home_url( '/#courses' ) ); ?>">مکالمه</a>
                    <a href="<?php echo esc_url( home_url( '/#courses' ) ); ?>">گرامر</a>
                    <a href="<?php echo esc_url( home_url( '/#courses' ) ); ?>">لغات</a>
                    <a href="<?php echo esc_url( home_url( '/#courses' ) ); ?>">شنیداری</a>
                    <a href="<?php echo esc_url( home_url( '/#courses' ) ); ?>">آمادگی آزمون</a>
                <?php endif; ?>
            </div>

            <div class="mp-footer-column mp-footer-quick-links">
                <?php if ( is_active_sidebar( 'footer-quick-links' ) ) : ?>
                    <?php dynamic_sidebar( 'footer-quick-links' ); ?>
                <?php elseif ( has_nav_menu( 'footer' ) ) : ?>
                    <h3>دسترسی سریع</h3>
                    <?php wp_nav_menu( array( 'theme_location' => 'footer', 'container' => false, 'menu_class' => 'mp-footer-menu', 'fallback_cb' => false ) ); ?>
                <?php else : ?>
                    <h3>دسترسی سریع</h3>
                    <a href="<?php echo esc_url( home_url( '/#courses' ) ); ?>">دوره‌ها</a>
                    <a href="<?php echo esc_url( home_url( '/#videos' ) ); ?>">ویدئوهای آموزشی</a>
                    <a href="#">وبلاگ</a>
                    <a href="<?php echo esc_url( home_url( '/#about' ) ); ?>">درباره من</a>
                    <a href="#contact">تماس با من</a>
                <?php endif; ?>
            </div>

            <div class="mp-footer-column mp-footer-about">
                <?php if ( is_active_sidebar( 'footer-about' ) ) : ?>
                    <?php dynamic_sidebar( 'footer-about' ); ?>
                <?php else : ?>
                    <h3>درباره من</h3>
                    <p>من با بیش از ۷ سال تجربه در آموزش زبان انگلیسی، در کنار شما هستم تا مسیر یادگیری را ساده و کاربردی دنبال کنید.</p>
                <?php endif; ?>
            </div>
        </section>

        <div class="mp-footer-bottom">
            <span><?php echo esc_html( $footer_copyright ); ?></span>
            <div><?php if ( $privacy_url ) : ?><a href="<?php echo esc_url( $privacy_url ); ?>">حریم خصوصی</a><?php else : ?><span>حریم خصوصی</span><?php endif; ?> <?php if ( $terms_url ) : ?><a href="<?php echo esc_url( $terms_url ); ?>">قوانین و مقررات</a><?php else : ?><span>قوانین و مقررات</span><?php endif; ?></div>
            <span><?php echo esc_html( $footer_note ); ?></span>
        </div>
    </div>
</footer>

<a class="mp-support" href="#contact" aria-label="پشتیبانی آنلاین"><span>پشتیبانی آنلاین</span><span class="mp-support__icon">◌</span></a>
<?php wp_footer(); ?>
</body>
</html>
