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
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div class="mp-site">
    <div class="mp-announcement" role="status">
        <div class="mp-announcement__inner">
            <span class="mp-announcement__icon" aria-hidden="true">ⓘ</span>
            <span>تسلط بر زبان انگلیسی، کلید موفقیت شماست!</span>
        </div>
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
                    <li><a href="<?php echo esc_url( home_url( '/#contact' ) ); ?>">تماس با ما</a></li>
                </ul>
            </nav>
            <div class="mp-header__actions">
                <a class="mp-account" href="<?php echo esc_url( wp_login_url() ); ?>">
                    <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 13a4 4 0 1 0 0-8 4 4 0 0 0 0 8Zm-7 7a7 7 0 0 1 14 0"/></svg>
                    <span>ورود / ثبت نام</span>
                </a>
                <a class="mp-icon-button" href="#" aria-label="جستجو"><svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="10.8" cy="10.8" r="6.2"/><path d="m16 16 4.2 4.2"/></svg></a>
                <a class="mp-icon-button" href="#" aria-label="سبد خرید"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M6 8h12l1 12H5L6 8Zm3 0a3 3 0 0 1 6 0"/></svg><span class="mp-badge">0</span></a>
            </div>
        </div>
    </header>
