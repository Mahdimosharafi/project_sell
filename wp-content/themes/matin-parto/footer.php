<?php
defined( 'ABSPATH' ) || exit;
$footer_copyright = get_theme_mod( 'matin_parto_footer_copyright', 'ماتین پرتو © 2026' );
$footer_note = get_theme_mod( 'matin_parto_footer_note', 'طراحی و توسعه با وردپرس' );
$privacy_url = get_theme_mod( 'matin_parto_footer_privacy_url', '' );
$terms_url = get_theme_mod( 'matin_parto_footer_terms_url', '' );
$footer_hover_color = get_theme_mod( 'matin_parto_footer_hover_color', '#7b2636' );
$footer_hover_color = sanitize_hex_color( $footer_hover_color );
$footer_hover_color = $footer_hover_color ? $footer_hover_color : '#7b2636';
$footer_home = function_exists( 'matin_parto_home_settings' ) ? matin_parto_home_settings() : array();
$footer_socials = array(
    'instagram' => ! empty( $footer_home['social_instagram'] ) ? $footer_home['social_instagram'] : '',
    'telegram'  => ! empty( $footer_home['social_telegram'] ) ? $footer_home['social_telegram'] : '',
    'youtube'   => ! empty( $footer_home['social_youtube'] ) ? $footer_home['social_youtube'] : '',
    'facebook'  => ! empty( $footer_home['social_facebook'] ) ? $footer_home['social_facebook'] : '',
);
?>
<style>
.mp-footer-main .mp-footer-about{order:1}
.mp-footer-main .mp-footer-categories{order:2}
.mp-footer-main .mp-footer-quick-links{order:3}
.mp-footer-main .mp-footer-newsletter{order:4}
.mp-footer-column h3,.mp-footer-column .widget-title{font-size:11px!important;line-height:1.7!important}
.mp-footer-column p,.mp-footer-column a,.mp-footer-widget li,.mp-footer-widget p{font-size:9px!important;line-height:1.9!important}
.mp-footer-column a,.mp-footer-column .widget a,.mp-footer-column .wp-block-list a,.mp-footer-column .menu a{color:#746b6d!important;-webkit-text-fill-color:#746b6d!important;transition:color .2s ease,transform .2s ease!important}
.mp-footer-column a:hover,.mp-footer-column a:focus-visible,.mp-footer-column .widget a:hover,.mp-footer-column .widget a:focus-visible,.mp-footer-column .wp-block-list a:hover,.mp-footer-column .wp-block-list a:focus-visible,.mp-footer-column .menu a:hover,.mp-footer-column .menu a:focus-visible{color:<?php echo esc_attr( $footer_hover_color ); ?>!important;-webkit-text-fill-color:<?php echo esc_attr( $footer_hover_color ); ?>!important}
.mp-footer-column .widget ul li a:hover,.mp-footer-column .wp-block-list li a:hover{transform:translateX(-2px)!important}
.mp-footer-main{direction:ltr!important}
.mp-footer-main .mp-footer-column{direction:rtl!important;text-align:right!important}
.mp-footer-main .mp-footer-about{grid-column:4!important;order:initial!important;justify-self:stretch!important}
.mp-footer-main .mp-footer-categories{grid-column:3!important;order:initial!important}
.mp-footer-main .mp-footer-quick-links{grid-column:2!important;order:initial!important}
.mp-footer-main .mp-footer-newsletter{grid-column:1!important;order:initial!important}
.mp-footer-social{direction:rtl!important;display:flex!important;align-items:center!important;justify-content:center!important;gap:10px!important;padding:18px 0 2px!important}
.mp-footer-social a{width:30px!important;height:30px!important;border:1px solid #d9c8ca!important;border-radius:50%!important;display:grid!important;place-items:center!important;color:#7b2636!important;text-decoration:none!important;transition:transform .2s ease,background .2s ease,color .2s ease!important}
.mp-footer-social a:hover,.mp-footer-social a:focus-visible{color:<?php echo esc_attr( $footer_hover_color ); ?>!important;background:#fff!important;transform:translateY(-2px)!important}
.mp-footer-social svg{width:15px!important;height:15px!important;fill:none!important;stroke:currentColor!important;stroke-width:1.7!important;stroke-linecap:round!important;stroke-linejoin:round!important}
.mp-footer-social .mp-social-icon--telegram svg,.mp-footer-social .mp-social-icon--youtube svg,.mp-footer-social .mp-social-icon--facebook svg{fill:currentColor!important;stroke:none!important}
@media(max-width:820px){
  .mp-footer-column h3,.mp-footer-column .widget-title{font-size:10px!important}
  .mp-footer-column p,.mp-footer-column a,.mp-footer-widget li,.mp-footer-widget p{font-size:8px!important}
  .mp-footer-main{direction:ltr!important}
  .mp-footer-main .mp-footer-about,.mp-footer-main .mp-footer-categories,.mp-footer-main .mp-footer-quick-links,.mp-footer-main .mp-footer-newsletter{grid-column:auto!important}
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
<?php if ( array_filter( $footer_socials ) && function_exists( 'matin_parto_social_icon' ) ) : ?>
<div class="mp-footer-social" aria-label="شبکه‌های اجتماعی">
    <?php foreach ( $footer_socials as $network => $url ) : if ( ! $url ) { continue; } ?>
        <a href="<?php echo esc_url( $url ); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php echo esc_attr( ucfirst( $network ) ); ?>" class="mp-social-icon mp-social-icon--<?php echo esc_attr( $network ); ?>"><?php echo matin_parto_social_icon( $network ); ?></a>
    <?php endforeach; ?>
</div>
<?php endif; ?>
<div class="mp-footer-bottom"><span><?php echo esc_html( $footer_copyright ); ?></span><div><?php if ( $privacy_url ) : ?><a href="<?php echo esc_url( $privacy_url ); ?>">حریم خصوصی</a><?php else : ?><span>حریم خصوصی</span><?php endif; ?> <?php if ( $terms_url ) : ?><a href="<?php echo esc_url( $terms_url ); ?>">قوانین و مقررات</a><?php else : ?><span>قوانین و مقررات</span><?php endif; ?></div><span><?php echo esc_html( $footer_note ); ?></span></div>
</div>
</footer>
<script>
(function(){
  var footerColor = <?php echo wp_json_encode( $footer_hover_color ); ?>;
  function bindFooterHover(){
    var links = document.querySelectorAll('.mp-footer .mp-footer-column li a, .mp-footer .mp-footer-column .menu a, .mp-footer .mp-footer-column nav a, .mp-footer .mp-footer-column .widget a, .mp-footer .mp-footer-column .wp-block-list a');
    links.forEach(function(link){
      if (link.dataset.mpHoverBound) return;
      link.dataset.mpHoverBound = '1';
      link.addEventListener('mouseenter', function(){
        this.style.setProperty('color', footerColor, 'important');
        this.style.setProperty('-webkit-text-fill-color', footerColor, 'important');
      });
      link.addEventListener('mouseleave', function(){
        this.style.removeProperty('color');
        this.style.removeProperty('-webkit-text-fill-color');
      });
    });
  }
  if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', bindFooterHover);
  else bindFooterHover();
})();
</script>
<a class="mp-support" href="#contact" aria-label="پشتیبانی آنلاین"><span>پشتیبانی آنلاین</span><span class="mp-support__icon">◌</span></a>
<?php wp_footer(); ?></body></html>
