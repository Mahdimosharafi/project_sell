<?php
defined( 'ABSPATH' ) || exit;
$footer_copyright = get_theme_mod( 'matin_parto_footer_copyright', 'ماتین پرتو © 2026' );
$footer_note = get_theme_mod( 'matin_parto_footer_note', 'طراحی و توسعه با وردپرس' );
$privacy_url = get_theme_mod( 'matin_parto_footer_privacy_url', '' );
$terms_url = get_theme_mod( 'matin_parto_footer_terms_url', '' );
$home_settings = function_exists( 'matin_parto_home_settings' ) ? matin_parto_home_settings() : array();
$footer_hover_color = ! empty( $home_settings['footer_hover_color'] ) ? sanitize_hex_color( $home_settings['footer_hover_color'] ) : '#8f3048';
$footer_hover_color = $footer_hover_color ? $footer_hover_color : '#8f3048';
?>
<style>
/* Footer layout, scale and widget-menu hover */
.mp-footer-main .mp-footer-about{order:1}
.mp-footer-main .mp-footer-categories{order:2}
.mp-footer-main .mp-footer-quick-links{order:3}
.mp-footer-main .mp-footer-newsletter{order:4}
.mp-footer-column h3,.mp-footer-column .widget-title{font-size:11px!important;line-height:1.7!important}
.mp-footer-column p,.mp-footer-column a,.mp-footer-widget li,.mp-footer-widget p{font-size:9px!important;line-height:1.9!important}
.mp-footer-column a,
.mp-footer-column .widget a,
.mp-footer-column .wp-block-list a,
.mp-footer-column .menu a{color:#746b6d!important;transition:color .2s ease,transform .2s ease!important}
.mp-footer-column a:hover,
.mp-footer-column a:focus-visible,
.mp-footer-column .widget a:hover,
.mp-footer-column .widget a:focus-visible,
.mp-footer-column .wp-block-list a:hover,
.mp-footer-column .wp-block-list a:focus-visible,
.mp-footer-column .menu a:hover,
.mp-footer-column .menu a:focus-visible{color:<?php echo esc_attr( $footer_hover_color ); ?>!important}
.mp-footer-column .widget ul li a:hover,
.mp-footer-column .wp-block-list li a:hover{transform:translateX(-2px)!important}
@media(max-width:820px){
  .mp-footer-column h3,.mp-footer-column .widget-title{font-size:10px!important}
  .mp-footer-column p,.mp-footer-column a,.mp-footer-widget li,.mp-footer-widget p{font-size:8px!important}
}
</style>
<footer class="mp-footer" id="contact">
<div class="mp-container">
<section class="mp-footer-main">
<div class="mp-footer-column mp-footer-newsletter"><h3>در خبرنامه عضو شوید</h3><p>برای دریافت جدیدترین مطالب و نکته‌های ویژه، ایمیل خود را وارد کنید.</p><div class="mp-newsletter"><input type="email" placeholder="ایمیل خود را وارد کنید"><button type="button">عضویت</button></div></div>
<div class="mp-footer-column mp-footer-categories"><h3>دسته‌بندی‌ها</h3><ul><li><a href="<?php echo esc_url( home_url( '/#courses' ) ); ?>">مکالمه</a></li><li><a href="<?php echo esc_url( home_url( '/#courses' ) ); ?>">گرامر</a></li><li><a href="<?php echo esc_url( home_url( '/#courses' ) ); ?>">لغات</a></li><li><a href="<?php echo esc_url( home_url( '/#courses' ) ); ?>">شنیداری</a></li><li><a href="<?php echo esc_url( home_url( '/#courses' ) ); ?>">آمادگی آزمون</a></li></ul></div>
<div class="mp-footer-column mp-footer-quick-links"><h3>دسترسی سریع</h3><ul><li><a href="<?php echo esc_url( home_url( '/#courses' ) ); ?>">دوره‌ها</a></li><li><a href="<?php echo esc_url( home_url( '/#videos' ) ); ?>">ویدئوهای آموزشی</a></li><li><a href="<?php echo esc_url( home_url( '/#blog' ) ); ?>">وبلاگ</a></li><li><a href="<?php echo esc_url( home_url( '/#about' ) ); ?>">درباره من</a></li><li><a href="#contact">تماس با ما</a></li></ul></div>
<div class="mp-footer-column mp-footer-about"><h3>درباره من</h3><p>من با بیش از ۷ سال تجربه در آموزش زبان انگلیسی، در کنار شما هستم تا مسیر یادگیری را ساده و کاربردی دنبال کنید.</p></div>
</section>
<div class="mp-footer-bottom"><span><?php echo esc_html( $footer_copyright ); ?></span><div><?php if ( $privacy_url ) : ?><a href="<?php echo esc_url( $privacy_url ); ?>">حریم خصوصی</a><?php else : ?><span>حریم خصوصی</span><?php endif; ?> <?php if ( $terms_url ) : ?><a href="<?php echo esc_url( $terms_url ); ?>">قوانین و مقررات</a><?php else : ?><span>قوانین و مقررات</span><?php endif; ?></div><span><?php echo esc_html( $footer_note ); ?></span></div>
</div>
</footer>
<a class="mp-support" href="#contact" aria-label="پشتیبانی آنلاین"><span>پشتیبانی آنلاین</span><span class="mp-support__icon">◌</span></a>
<?php wp_footer(); ?></body></html>
