<?php
/**
 * Footer — Matin Parto.
 *
 * The newsletter block is intentionally fixed as part of the theme design.
 * The other footer columns are editable from Appearance > Widgets.
 */
defined( 'ABSPATH' ) || exit;

$footer_copyright = get_theme_mod( 'matin_parto_footer_copyright', 'ماتین پرتو © 2026' );
$footer_note      = get_theme_mod( 'matin_parto_footer_note', 'طراحی و توسعه با وردپرس' );
$privacy_url      = get_theme_mod( 'matin_parto_footer_privacy_url', '' );
$terms_url        = get_theme_mod( 'matin_parto_footer_terms_url', '' );
?>

<footer class="mp-footer" id="contact">
    <div class="mp-container">
        <?php if ( ! is_front_page() ) : ?>
            <section class="mp-footer-cta">
                <div class="mp-footer-cta__content">
                    <span class="mp-footer-cta__eyebrow">همین امروز شروع کنید!</span>
                    <h2>دسترسی به ده‌ها ویدئو و دوره آموزشی</h2>
                    <a class="mp-button mp-button--light" href="<?php echo esc_url( home_url( '/#courses' ) ); ?>">شروع یادگیری رایگان</a>
                </div>
                <div class="mp-footer-cta__figure" aria-hidden="true"><div class="mp-footer-cta__shape"></div><span class="mp-footer-cta__silhouette">M</span></div>
                <div class="mp-footer-cta__social">
                    <span>در شبکه‌های اجتماعی همراه باشید</span>
                    <small>محتوای رایگان، نکات آموزشی و اخبار دوره‌ها</small>
                    <div class="mp-socials"><a href="#" aria-label="اینستاگرام">◎</a><a href="#" aria-label="تلگرام">➤</a><a href="#" aria-label="یوتیوب">▶</a><a href="#" aria-label="شبکه اجتماعی">◉</a></div>
                </div>
            </section>
        <?php endif; ?>

        <section class="mp-footer-main">
            <!-- Newsletter is deliberately fixed and designed by the theme. -->
            <div class="mp-footer-column mp-footer-newsletter">
                <h3>در خبرنامه عضو شوید</h3>
                <p>برای دریافت جدیدترین مطالب و نکته‌های ویژه، ایمیل خود را وارد کنید.</p>
                <form class="mp-newsletter" action="#" method="post">
                    <label class="screen-reader-text" for="mp-newsletter-email">ایمیل</label>
                    <input id="mp-newsletter-email" type="email" name="email" placeholder="ایمیل خود را وارد کنید" required>
                    <button type="submit">عضویت</button>
                </form>
            </div>

            <div class="mp-footer-column">
                <?php if ( is_active_sidebar( 'footer-column-1' ) ) : ?>
                    <?php dynamic_sidebar( 'footer-column-1' ); ?>
                <?php else : ?>
                    <h3>دسته‌بندی‌ها</h3>
                    <a href="<?php echo esc_url( home_url( '/#courses' ) ); ?>">مکالمه</a>
                    <a href="<?php echo esc_url( home_url( '/#courses' ) ); ?>">گرامر</a>
                    <a href="<?php echo esc_url( home_url( '/#courses' ) ); ?>">لغات</a>
                    <a href="<?php echo esc_url( home_url( '/#courses' ) ); ?>">شنیداری</a>
                    <a href="<?php echo esc_url( home_url( '/#courses' ) ); ?>">آمادگی آزمون</a>
                <?php endif; ?>
            </div>

            <div class="mp-footer-column">
                <?php if ( is_active_sidebar( 'footer-column-2' ) ) : ?>
                    <?php dynamic_sidebar( 'footer-column-2' ); ?>
                <?php elseif ( has_nav_menu( 'footer' ) ) : ?>
                    <h3>دسترسی سریع</h3>
                    <?php wp_nav_menu( array( 'theme_location' => 'footer', 'container' => false, 'menu_class' => 'mp-footer-menu', 'fallback_cb' => false ) ); ?>
                <?php else : ?>
                    <h3>دسترسی سریع</h3>
                    <a href="<?php echo esc_url( home_url( '/#courses' ) ); ?>">دوره‌ها</a>
                    <a href="<?php echo esc_url( home_url( '/#videos' ) ); ?>">ویدئوهای آموزشی</a>
                    <a href="#">وبلاگ</a>
                    <a href="<?php echo esc_url( home_url( '/#about' ) ); ?>">درباره من</a>
                    <a href="#contact">تماس با ما</a>
                <?php endif; ?>
            </div>

            <div class="mp-footer-column mp-footer-about">
                <?php if ( is_active_sidebar( 'footer-column-3' ) ) : ?>
                    <?php dynamic_sidebar( 'footer-column-3' ); ?>
                <?php else : ?>
                    <h3>درباره من</h3>
                    <p>من با بیش از ۷ سال تجربه در آموزش زبان انگلیسی، در کنار شما هستم تا مسیر یادگیری را ساده و کاربردی دنبال کنید.</p>
                <?php endif; ?>

                <?php if ( is_active_sidebar( 'footer-social' ) ) : ?>
                    <div class="mp-footer-social-widget-area">
                        <?php dynamic_sidebar( 'footer-social' ); ?>
                    </div>
                <?php else : ?>
                    <div class="mp-footer-socials" aria-label="شبکه‌های اجتماعی">
                        <a href="#" aria-label="اینستاگرام">◎</a>
                        <a href="#" aria-label="تلگرام">➤</a>
                        <a href="#" aria-label="یوتیوب">▶</a>
                    </div>
                <?php endif; ?>
            </div>
        </section>

        <div class="mp-footer-bottom">
            <span><?php echo esc_html( $footer_copyright ); ?></span>
            <div>
                <?php if ( $privacy_url ) : ?><a href="<?php echo esc_url( $privacy_url ); ?>">حریم خصوصی</a><?php else : ?><span>حریم خصوصی</span><?php endif; ?>
                <?php if ( $terms_url ) : ?><a href="<?php echo esc_url( $terms_url ); ?>">قوانین و مقررات</a><?php else : ?><span>قوانین و مقررات</span><?php endif; ?>
            </div>
            <span><?php echo esc_html( $footer_note ); ?></span>
        </div>
    </div>
</footer>

<!-- Floating support is intentionally outside the footer and appears site-wide. -->
<a class="mp-support" href="#contact" aria-label="پشتیبانی آنلاین"><span>پشتیبانی آنلاین</span><span class="mp-support__icon">◌</span></a>
<?php wp_footer(); ?>
</body>
</html>
