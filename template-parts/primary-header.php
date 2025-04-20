<?php

/**
 * Template part for displaying the primary header.
 *
 * @package Custom_Theme
 */
?>

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