<?php

/**
 * Template part for displaying the secondary header.
 *
 * @package Custom_Theme
 */
?>

<header id="secondary-header" class="bg-[#151515] shadow py-4">
  <div class="container mx-auto grid grid-cols-3 items-center">
    <div class="flex-shrink-0">
      <?php // if ( function_exists( 'the_custom_logo' ) ) the_custom_logo(); 
      ?>
      <?php echo wp_get_attachment_image(get_theme_mod('custom_logo'), 'logo-small'); ?>
    </div>
    <nav class="justify-self-center text-white">
      <?php
      if (has_nav_menu('header')) {
        wp_nav_menu(array(
          'theme_location' => 'header', // defined in inc/navmenu.php
          'menu_class'     => 'flex space-x-6', // ul
          'link_before'     => '<span class="hover:text-gray-400">',
          'link_after'      => '</span>',
        ));
      }
      ?>
    </nav>
    <div class="flex justify-end items-center space-x-4">
      <!-- Search Icon -->
      <a href="#" class="text-slate-50 hover:text-gray-400">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
        </svg>
      </a>
      <!-- User Icon -->
      <a href="#" class="text-slate-50 hover:text-gray-400">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A9 9 0 0112 3a9 9 0 016.879 14.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
        </svg>
      </a>
      <!-- Cart Icon -->
      <a href="#" class="text-slate-50 hover:text-gray-400">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l1.5 3m10.5-3L17 16m-10 4a1 1 0 100-2 1 1 0 000 2zm11 0a1 1 0 100-2 1 1 0 000 2z" />
        </svg>
      </a>
    </div>
  </div>
</header>