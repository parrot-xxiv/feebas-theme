<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package _S_Boilerplate_Theme
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <div id="page" class="site">
        <a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'custom-theme'); ?></a>
        <!-- <header id="masthead" class="site-header">
            <nav id="site-navigation" class="main-navigation">
                <?php
                if (has_nav_menu('primary')) { // only if primary is checked
                    wp_nav_menu(
                        array(
                            'theme_location' => 'primary',
                            'menu_id'        => 'id-for-the-ul-tag',
                        )
                    );
                }
                ?>
            </nav>
        </header> -->
        <header id="masthead" class="site-header bg-gray-900 text-white p-4">
            <nav id="site-navigation" class="main-navigation container mx-auto">
                <?php
                if (has_nav_menu('primary')) { // only if primary is checked
                    wp_nav_menu(
                        array(
                            'theme_location' => 'primary',
                            'menu_id'         => 'id-for-the-ul-tag',
                            'container'       => false, // Don't wrap the menu in a div, just output the list
                            'menu_class'      => 'flex space-x-6', // Tailwind for horizontal layout of menu items
                            'link_class'      => 'text-white hover:text-yellow-400 transition-colors', // Style for menu links
                        )
                    );
                }
                ?>
            </nav><!-- #site-navigation -->
        </header><!-- #masthead -->