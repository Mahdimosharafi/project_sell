<?php
/**
 * Header: Matin Parto reference layout.
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
            <span class="mp-announcement__icon" aria-hidden="true">◉</span>
            <span>تسلط بر زبان انگلیسی، کلید موفقیت شماست!</span>
        </div>
    </div>

    <header class="mp-header">
        <div class="mp-container mp-header__inner">
            <div class="mp-header__actions">
                <a class="mp-account" href="<?php echo esc_url( wp_login_url() ); ?>">
                    <span class="mp-account__icon" aria-hidden="true">♙</span>
                    <span>ورود / ثبت نام</span>
                </a>
                <a class="mp-icon-button" href="#" aria-label="سبد خرید">♧<span class="mp-badge">0</span></a>
                <a class="mp-icon-button" href="#" aria-label="جستجو">⌕</a>
            </div>

            <nav class="mp-nav" aria-label="منوی اصلی">
                <?php
                if ( has_nav_menu( 'primary' ) ) {
                    wp_nav_menu( array(
                        'theme_location' => 'primary',
                        'container'      => false,
                        'menu_class'     => 'mp-nav__list',
                        'fallback_cb'    => false,
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
