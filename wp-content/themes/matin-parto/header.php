<?php
defined( 'ABSPATH' ) || exit;
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
<link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() . '/assets/css/final-ui-fixes.css?v=20260914-2' ); ?>">
<link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() . '/assets/css/header-footer-restore.css?v=20260915-1' ); ?>">
<link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() . '/assets/css/site-rtl-final.css?v=20260915-2' ); ?>">
<style id="matin-parto-live-rtl-final">
html,body{direction:rtl!important}body,.mp-site{direction:rtl!important;text-align:right!important}.mp-header{direction:rtl!important}.mp-header__inner{width:min(1180px,calc(100% - 96px))!important;height:91px!important;margin:0 auto!important;display:grid!important;grid-template-columns:1fr auto 1fr!important;grid-template-rows:1fr!important;align-items:center!important;direction:ltr!important}.mp-brand{position:static!important;grid-column:3!important;grid-row:1!important;width:170px!important;height:76px!important;transform:none!important;justify-self:end!important;direction:rtl!important}.mp-nav{position:static!important;grid-column:2!important;grid-row:1!important;transform:none!important;width:auto!important;justify-self:center!important;direction:rtl!important}.mp-nav__list{display:flex!important;flex-direction:row!important;align-items:center!important;justify-content:center!important;gap:31px!important;direction:rtl!important;margin:0!important;padding:0!important}.mp-nav__list li{margin:0!important;padding:0!important}.mp-nav__list a{direction:rtl!important;text-align:center!important}.mp-header__actions{position:static!important;grid-column:1!important;grid-row:1!important;justify-self:start!important;transform:none!important;display:flex!important;align-items:center!important;gap:8px!important;direction:ltr!important}.mp-account{direction:rtl!important}.mp-footer-main{direction:ltr!important}.mp-footer-main .mp-footer-newsletter{grid-column:1!important}.mp-footer-main .mp-footer-quick-links{grid-column:2!important}.mp-footer-main .mp-footer-categories{grid-column:3!important}.mp-footer-main .mp-footer-about{grid-column:4!important}.mp-footer-column,.mp-footer-column h3,.mp-footer-column p,.mp-footer-column a,.mp-footer-column ul{direction:rtl!important;text-align:right!important}.mp-footer-bottom{direction:rtl!important;text-align:right!important}.mp-contact-page,.mp-contact-page *{direction:rtl!important}.mp-contact-hero__grid{direction:ltr!important}.mp-contact-hero__copy{direction:rtl!important;text-align:right!important;order:2!important}.mp-contact-hero__visual{direction:rtl!important;order:1!important}
@media(max-width:820px){.mp-header__inner{width:calc(100% - 48px)!important;height:auto!important;min-height:82px!important;display:grid!important;grid-template-columns:1fr auto!important;grid-template-rows:auto auto!important}.mp-brand{grid-column:2!important;grid-row:1!important;width:145px!important;justify-self:end!important}.mp-header__actions{grid-column:1!important;grid-row:1!important;justify-self:start!important}.mp-nav{grid-column:1 / -1!important;grid-row:2!important;width:100%!important;justify-self:stretch!important}.mp-nav__list{justify-content:flex-start!important;overflow-x:auto!important;gap:22px!important}.mp-footer-main{grid-template-columns:repeat(2,1fr)!important;direction:rtl!important}.mp-footer-main .mp-footer-newsletter,.mp-footer-main .mp-footer-quick-links,.mp-footer-main .mp-footer-categories,.mp-footer-main .mp-footer-about{grid-column:auto!important}}
@media(max-width:560px){.mp-header__inner{width:calc(100% - 28px)!important;min-height:76px!important}.mp-brand{width:115px!important}.mp-footer-main{grid-template-columns:1fr!important}}
</style>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div class="mp-site">
    <div class="mp-announcement" role="status">
        <div class="mp-announcement__inner"><span class="mp-announcement__icon" aria-hidden="true">ⓘ</span><span>تسلط بر زبان انگلیسی، کلید موفقیت شماست!</span></div>
    </div>
    <header class="mp-header">
        <div class="mp-container mp-header__inner">
            <a class="mp-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="متین پارتو">
                <span class="mp-brand__latin">MATIN<br>PARTO</span>
                <span class="mp-brand__ornament" aria-hidden="true"><i></i><b></b><i></i></span>
                <span class="mp-brand__line">ENGLISH ACADEMY</span>
            </a>
            <nav class="mp-nav" aria-label="منوی اصلی">
                <ul class="mp-nav__list">
                    <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">صفحه اصلی</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/#courses' ) ); ?>">دوره ها</a></li>
                    <li class="<?php echo is_page( 'about' ) ? 'is-current' : ''; ?>"><a href="<?php echo esc_url( home_url( '/about/' ) ); ?>">درباره من</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/#videos' ) ); ?>">ویدیو های آموزشی</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/#blog' ) ); ?>">وبلاگ</a></li>
                    <li class="<?php echo ( trim( (string) wp_parse_url( $_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH ), '/' ) === 'contact' ) ? 'is-current' : ''; ?>"><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">تماس با ما</a></li>
                </ul>
            </nav>
            <div class="mp-header__actions">
                <a class="mp-account" href="<?php echo esc_url( wp_login_url() ); ?>"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 13a4 4 0 1 0 0-8 4 4 0 0 0 0 8Zm-7 7a7 7 0 0 1 14 0"/></svg><span>ورود / ثبت نام</span></a>
                <a class="mp-icon-button" href="#" aria-label="جستجو"><svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="10.8" cy="10.8" r="6.2"/><path d="m16 16 4.2 4.2"/></svg></a>
                <a class="mp-icon-button" href="#" aria-label="سبد خرید"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M6 8h12l1 12H5L6 8Zm3 0a3 3 0 0 1 6 0"/></svg><span class="mp-badge">0</span></a>
            </div>
        </div>
    </header>
