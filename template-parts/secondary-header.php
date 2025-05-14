<?php
/**
 * Template part for displaying the secondary header (responsive).
 *
 * @package Custom_Theme
 */
?>

<header id="secondary-header" class="bg-[#151515] shadow py-4 relative z-50">
  <div class="container mx-auto px-4 lg:px-0 flex items-center justify-between">
    <!-- Logo -->
    <a href="/" class="flex-shrink-0">
      <?php
      $custom_logo_id = get_theme_mod('custom_logo');
      if ($custom_logo_id) {
        echo wp_get_attachment_image($custom_logo_id, 'logo-small', false, [
          'class' => 'h-auto',
          'alt'   => get_bloginfo('name') . ' logo'
        ]);
      } else {
        echo '<a href="' . esc_url(home_url('/')) . '" rel="home" class="text-xl font-bold text-white">'
             . get_bloginfo('name') .
             '</a>';
      }
      ?>
    </a>

    <!-- Burger (mobile only) -->
    <div class="lg:hidden">
      <button id="burger-menu-button"
              aria-label="Toggle menu"
              aria-expanded="false"
              class="text-slate-50 hover:text-gray-400 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-slate-400 p-2 z-50">
        <!-- open icon -->
        <svg class="h-6 w-6 burger-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
        <!-- close icon -->
        <svg class="h-6 w-6 close-icon hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
        </svg>
      </button>
    </div>

    <!-- Desktop menu (centered) + icons -->
    <div class="hidden lg:flex lg:items-center lg:space-x-8 lg:flex-grow">
      <!-- Centered nav -->
      <nav class="flex-grow text-white flex justify-center" aria-label="Main navigation">
        <?php
        if (has_nav_menu('header')) {
          wp_nav_menu([
            'theme_location' => 'header',
            'container'      => false,
            'menu_class'     => 'flex space-x-8 items-center',
            'link_before'    => '<span class="hover:text-gray-400 transition-colors duration-200">',
            'link_after'     => '</span>',
            'fallback_cb'    => false,
          ]);
        }
        ?>
      </nav>
      <!-- Right icons -->
      <div class="flex items-center space-x-4">
        <a href="#" class="text-slate-50 hover:text-gray-400 transition-colors duration-200" aria-label="Search">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
          </svg>
        </a>
        <a href="#" class="text-slate-50 hover:text-gray-400 transition-colors duration-200" aria-label="User account">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M5.121 17.804A9 9 0 0112 3a9 9 0 016.879 14.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
          </svg>
        </a>
        <a href="#" class="text-slate-50 hover:text-gray-400 transition-colors duration-200" aria-label="Shopping cart">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l1.5 3m10.5-3L17 16m-10 4a1 1 0 100-2 1 1 0 000 2zm11 0a1 1 0 100-2 1 1 0 000 2z" />
          </svg>
        </a>
      </div>
    </div>
  </div>

  <!-- Mobile menu panel -->
  <div id="mobile-menu"
       class="lg:hidden absolute top-full left-0 right-0 bg-[#151515] shadow-lg z-40 overflow-hidden
              max-h-0 opacity-0 transition-[max-height,opacity] duration-300 ease-in-out">
    <div class="container mx-auto px-4 py-4">
      <!-- Mobile nav -->
      <nav class="text-white flex flex-col space-y-2 items-center" aria-label="Mobile navigation">
        <?php
        if (has_nav_menu('header')) {
          wp_nav_menu([
            'theme_location' => 'header',
            'container'      => false,
            'menu_class'     => 'flex flex-col space-y-2 items-center',
            'link_before'    => '<span class="hover:text-gray-400 transition-colors duration-200
                                     py-2 px-4 block w-full text-center rounded-md">',
            'link_after'     => '</span>',
            'fallback_cb'    => false,
          ]);
        }
        ?>
      </nav>
      <!-- Mobile icons -->
      <div class="flex justify-center items-center space-x-6 pt-4">
        <a href="#" class="text-slate-50 hover:text-gray-400 transition-colors duration-200" aria-label="Search">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
          </svg>
        </a>
        <a href="#" class="text-slate-50 hover:text-gray-400 transition-colors duration-200" aria-label="User account">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M5.121 17.804A9 9 0 0112 3a9 9 0 016.879 14.804M15 11a3 3 0 11-6 0 3 3 0 006 0z" />
          </svg>
        </a>
        <a href="#" class="text-slate-50 hover:text-gray-400 transition-colors duration-200" aria-label="Shopping cart">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l1.5 3m10.5-3L17 16m-10 4a1 1 0 100-2 1 1 0 000 2zm11 0a1 1 0 100-2 1 1 0 000 2z" />
          </svg>
        </a>
      </div>
    </div>
  </div>

  <!-- Toggle script -->
  <!-- Toggle Script -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const btn = document.getElementById('burger-menu-button');
      const menu = document.getElementById('mobile-menu');
      const burgerIcon = btn.querySelector('.burger-icon');
      const closeIcon = btn.querySelector('.close-icon');

      btn.addEventListener('click', function() {
        const expanded = btn.getAttribute('aria-expanded') === 'true';
        btn.setAttribute('aria-expanded', !expanded);
        burgerIcon.classList.toggle('hidden');
        closeIcon.classList.toggle('hidden');
        if (!expanded) {
          menu.style.maxHeight = menu.scrollHeight + 'px';
          menu.style.opacity = '1';
        } else {
          menu.style.maxHeight = '0';
          menu.style.opacity = '0';
        }
      });
    });
  </script>
</header>





