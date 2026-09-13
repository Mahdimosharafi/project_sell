<?php
defined( 'ABSPATH' ) || exit;
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
<style>
/* FINAL: exact geometric centering for search/cart icons inside their own squares */
.mp-header__actions .mp-icon-button {
  position: relative !important;
  width: 38px !important;
  height: 38px !important;
  min-width: 38px !important;
  min-height: 38px !important;
  padding: 0 !important;
  margin: 0 !important;
  display: grid !important;
  place-items: center !important;
  line-height: 0 !important;
  text-align: center !important;
  box-sizing: border-box !important;
}
.mp-header__actions .mp-icon-button svg {
  position: absolute !important;
  inset: 0 !important;
  width: 17px !important;
  height: 17px !important;
  margin: auto !important;
  transform: none !important;
  display: block !important;
  flex: none !important;
}
.mp-header__actions .mp-icon-button .mp-badge {
  position: absolute !important;
  inset: 2px 4px auto auto !important;
  width: 12px !important;
  height: 12px !important;
  margin: 0 !important;
  transform: none !important;
}
.mp-header__actions .mp-account {
  display: inline-flex !important;
  align-items: center !important;
  justify-content: center !important;
  line-height: 1 !important;
}
@media(max-width:560px){
  .mp-header__actions .mp-icon-button {
    width: 34px !important;
    height: 34px !important;
    min-width: 34px !important;
    min-height: 34px !important;
  }
  .mp-header__actions .mp-icon-button svg {
    width: 16px !important;
    height: 16px !important;
  }
}
</style>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div class="mp-site">
<div class="mp-announcement" role="status"><div class="mp-container mp-announcement__inner"><span class="mp-announcement__icon" aria-hidden="true">ⓘ</span><span>تسلط بر زبان انگلیسی، کلید موفقیت شماست!</span></div></div>
<header class="mp-header"><div class="mp-container mp-header__inner">
<a class="mp-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="متین پارتو">
<span class="mp-brand__latin">MATIN<br>PARTO</span>
<span class="mp-brand__ornament" aria-hidden="true"><i></i><b></b><i></i></span>
<span class="mp-brand__line">ENGLISH ACADEMY</span>
</a>
<nav class="mp-nav" aria-label="منوی اصلی">
<ul class="mp-nav__list">
<li class="is-current"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">صفحه اصلی</a></li>
<li><a href="#courses">دوره ها</a></li>
<li><a href="#about">درباره من</a></li>
<li><a href="#videos">ویدیو های آموزشی</a></li>
<li><a href="#blog">وبلاگ</a></li>
<li><a href="#contact">تماس با ما</a></li>
</ul>
</nav>
<div class="mp-header__actions">
<!-- Physical order: login/register, search, cart. -->
<a class="mp-account" href="<?php echo esc_url( wp_login_url() ); ?>"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 13a4 4 0 1 0 0-8 4 4 0 0 0 0 8Zm-7 7a7 7 0 0 1 14 0"/></svg><span>ورود / ثبت نام</span></a>
<a class="mp-icon-button" href="#" aria-label="جستجو"><svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="10.8" cy="10.8" r="6.2"/><path d="m16 16 4.2 4.2"/></svg></a>
<a class="mp-icon-button" href="#" aria-label="سبد خرید"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M6 8h12l1 12H5L6 8Zm3 0a3 3 0 0 1 6 0"/></svg><span class="mp-badge">0</span></a>
</div>
</div></header>
