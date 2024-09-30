<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package businnesdrive
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="author" content="Oleksandr Dorobalo">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <div id="page" class="site">
        <a class="skip-link screen-reader-text"
            href="#primary"><?php esc_html_e('Skip to content', 'businnesdrive'); ?></a>

        <header id="masthead" class="header site-header <?php if (is_front_page())
            echo 'home'; ?>">
            <div class="header__wrapper container site-branding">
                <?php if (get_theme_mod('header_logo')): ?>
                    <a class="header__logo logo" href="<?php echo esc_url(home_url('/')); ?>"
                        title="<?php echo esc_attr(get_bloginfo('name')); ?>">

                        <picture>
                            <img class="logo__image" src="<?php echo esc_url(get_theme_mod('header_logo')); ?>"
                                alt="<?php bloginfo('name'); ?>">
                        </picture>
                        <span>games</span>
                    </a>
                <?php else:
                    if (function_exists('the_custom_logo')):
                        $custom_logo_id = get_theme_mod('custom_logo');
                        $logo = wp_get_attachment_image_src($custom_logo_id, 'full');

                        if ($logo): ?>
                            <a class="header__logo logo" href="<?php echo esc_url(home_url('/')); ?>"
                                title="<?php echo esc_attr(get_bloginfo('name')); ?>">
                                <picture>
                                    <img src="<?php echo esc_url($logo[0]); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>">
                                </picture>
                                <span>games</span>
                            </a>
                        <?php endif;
                    endif;
                endif; ?>

                <div class="header__search search">
                    <form method="get" class="search__form" id="search" role="search" action="">
                        <input type="search" class="search__field" placeholder="Search" value="" name="s">
                        <button class="search__submit icon" id="searchButton" type="submit">
                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M16.5 16.5L12.8807 12.8807M12.8807 12.8807C14.0871 11.6743 14.8333 10.0076 14.8333 8.16667C14.8333 4.48477 11.8486 1.5 8.16667 1.5C4.48477 1.5 1.5 4.48477 1.5 8.16667C1.5 11.8486 4.48477 14.8333 8.16667 14.8333C10.0076 14.8333 11.6743 14.0871 12.8807 12.8807Z"
                                    stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </button>
                    </form>
                </div>


                <button class="header__burger burger" id="burgerButton" aria-controls="primary-menu"
                    aria-expanded="false">
                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M16.5 16.5L12.8807 12.8807M12.8807 12.8807C14.0871 11.6743 14.8333 10.0076 14.8333 8.16667C14.8333 4.48477 11.8486 1.5 8.16667 1.5C4.48477 1.5 1.5 4.48477 1.5 8.16667C1.5 11.8486 4.48477 14.8333 8.16667 14.8333C10.0076 14.8333 11.6743 14.0871 12.8807 12.8807Z"
                            stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </button>
            </div><!-- .site-branding -->
        </header><!-- #masthead -->