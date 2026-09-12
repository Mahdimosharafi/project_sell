<?php
/**
 * Header — Matin Parto reference UI.
 */
defined( 'ABSPATH' ) || exit;
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div class="mp-site">
    <div class="mp-announcement" role="status">
        <div class="mp-container mp-announcement__inner">
            <span class="mp-announcement__icon" aria-hidden="true">ⓘ</span>
            <span>تسلط بر زبان انگلیسی، کلید موفقیت شماست!</span>
        </div>
    </div>

    <header class="mp-header">
        <div class="mp-container mp-header__inner">
            <div class="mp-header__actions">
                <a class="mp-account" href="<?php echo esc_url( wp_login_url() ); ?>">
                    <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 13a4 4 0 1 0 0-8 4 4 0 0 0 0 8Zm-7 7a7 7 0 0 1 14 0"/></svg>
                    <span>ورود / ثبت نام</span>
                </a>
                <a class="mp-icon-button" href="#" aria-label="سبد خرید">
                    <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M6 8h12l1 12H5L6 8Zm3 0a3 3 0 0 1 6 0"/></svg>
                    <span class="mp-badge">0</span>
                </a>
                <a class="mp-icon-button" href="#" aria-label="جستجو">
                    <svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="10.8" cy="10.8" r="6.2"/><path d="m16 16 4.2 4.2"/></svg>
                </a>
            </div>

            <nav class="mp-nav" aria-label="منوی اصلی">
                <?php
                if ( has_nav_menu( 'primary' ) ) {
                    wp_nav_menu( array(
                        'theme_location' => 'primary',
                        'container'      => false,
                        'menu_class'     => 'mp-nav__list',
                        'fallback_cb'    => 'matin_parto_fallback_menu',
                    ) );
                } else {
                    matin_parto_fallback_menu();
                }
                ?>
            </nav>

            <a class="mp-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="متین پارتو">
                <?php if ( has_custom_logo() ) : ?>
                    <?php the_custom_logo(); ?>
                <?php else : ?>
                    <span class="mp-brand__latin">MATIN<br>PARTO</span>
                    <span class="mp-brand__line">ENGLISH ACADEMY</span>
                <?php endif; ?>
            </a>
        </div>
    </header>
