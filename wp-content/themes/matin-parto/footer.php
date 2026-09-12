<?php
/**
 * Footer: Matin Parto reference layout.
 */

defined( 'ABSPATH' ) || exit;
?>

    <footer class="mp-footer" id="contact">
        <div class="mp-container">
            <section class="mp-footer-cta">
                <div class="mp-footer-cta__content">
                    <span class="mp-footer-cta__eyebrow">همین امروز شروع کنید!</span>
                    <h2>دسترسی به ده‌ها ویدئو و دوره آموزشی</h2>
                    <a class="mp-button mp-button--light" href="#courses">شروع یادگیری رایگان</a>
                </div>
                <div class="mp-footer-cta__figure" aria-hidden="true">
                    <div class="mp-footer-cta__shape"></div>
                    <span class="mp-footer-cta__silhouette">M</span>
                </div>
                <div class="mp-footer-cta__social">
                    <span>در شبکه‌های اجتماعی همراه باشید</span>
                    <small>محتوای رایگان، نکات آموزشی و اخبار دوره‌ها</small>
                    <div class="mp-socials">
                        <a href="#" aria-label="اینستاگرام">◎</a>
                        <a href="#" aria-label="تلگرام">➤</a>
                        <a href="#" aria-label="یوتیوب">▶</a>
                        <a href="#" aria-label="شبکه اجتماعی">◉</a>
                    </div>
                </div>
            </section>

            <section class="mp-footer-main">
                <div class="mp-footer-column mp-footer-newsletter">
                    <h3>خبرنامه</h3>
                    <p>برای دریافت نکات آموزشی و اطلاع از دوره‌های جدید عضو شوید.</p>
                    <form class="mp-newsletter" action="#" method="post">
                        <label class="screen-reader-text" for="mp-newsletter-email">ایمیل</label>
                        <input id="mp-newsletter-email" type="email" name="email" placeholder="ایمیل خود را وارد کنید" required>
                        <button type="submit">عضویت</button>
                    </form>
                </div>

                <div class="mp-footer-column">
                    <h3>دسته‌بندی‌ها</h3>
                    <a href="#">مکالمه</a>
                    <a href="#">گرامر</a>
                    <a href="#">لغات</a>
                    <a href="#">شنیداری</a>
                    <a href="#">آمادگی آزمون</a>
                </div>

                <div class="mp-footer-column">
                    <h3>دسترسی سریع</h3>
                    <?php
                    if ( has_nav_menu( 'footer' ) ) {
                        wp_nav_menu( array(
                            'theme_location' => 'footer',
                            'container'      => false,
                            'menu_class'     => 'mp-footer-menu',
                            'fallback_cb'    => false,
                        ) );
                    } else {
                        echo '<a href="#courses">دوره‌ها</a><a href="#videos">ویدئوهای آموزشی</a><a href="#blog">وبلاگ</a><a href="#about">درباره من</a><a href="#contact">تماس با من</a>';
                    }
                    ?>
                </div>

                <div class="mp-footer-column mp-footer-about">
                    <h3>درباره من</h3>
                    <p>من با بیش از ۷ سال تجربه در آموزش زبان انگلیسی، در کنار شما هستم تا مسیر یادگیری را ساده و کاربردی دنبال کنید.</p>
                    <div class="mp-footer-socials">
                        <a href="#" aria-label="اینستاگرام">◎</a>
                        <a href="#" aria-label="تلگرام">➤</a>
                        <a href="#" aria-label="یوتیوب">▶</a>
                    </div>
                </div>
            </section>

            <div class="mp-footer-bottom">
                <span>Matin Parto © 2026</span>
                <div>
                    <a href="#">حریم خصوصی</a>
                    <a href="#">قوانین و مقررات</a>
                </div>
                <span>طراحی و توسعه با وردپرس</span>
            </div>
        </div>
    </footer>

    <a class="mp-support" href="#contact" aria-label="پشتیبانی آنلاین">
        <span>پشتیبانی آنلاین</span>
        <span class="mp-support__icon">◌</span>
    </a>
</div>

<?php wp_footer(); ?>
</body>
</html>
