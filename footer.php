<?php
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
                <div class="mp-footer-cta__content"><span class="mp-footer-cta__eyebrow">همین امروز شروع کنید!</span><h2>دسترسی به ده‌ها ویدئو و دوره آموزشی</h2><a class="mp-button mp-button--light" href="<?php echo esc_url( home_url( '/#courses' ) ); ?>">شروع یادگیری رایگان</a></div>
                <div class="mp-footer-cta__figure" aria-hidden="true"><div class="mp-footer-cta__shape"></div><span class="mp-footer-cta__silhouette">M</span></div>
                <div class="mp-footer-cta__social"><span>در شبکه‌های اجتماعی همراه باشید</span><small>محتوای رایگان، نکات آموزشی و اخبار دوره‌ها</small></div>
            </section>
        <?php endif; ?>

        <section class="mp-footer-main">
            <!-- ثابت: خبرنامه از ابزارک‌ها مدیریت نمی‌شود. -->
            <div class="mp-footer-column mp-footer-newsletter">
                <h3>در خبرنامه عضو شوید</h3>
                <p>برای دریافت جدیدترین مطالب و نکته‌های ویژه، ایمیل خود را وارد کنید.</p>
                <form class="mp-newsletter" action="#" method="post">
                    <label class="screen-reader-text" for="mp-newsletter-email">ایمیل</label>
                    <input id="mp-newsletter-email" type="email" name="email" placeholder="ایمیل خود را وارد کنید" required>
                    <button type="submit">عضویت</button>
                </form>
            </div>

            <!-- فقط دسته‌بندی‌ها از ابزارک -->
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

            <!-- فقط دسترسی سریع از ابزارک -->
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

            <!-- درباره من + یک ابزارک واحد برای تمام شبکه‌های اجتماعی -->
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
