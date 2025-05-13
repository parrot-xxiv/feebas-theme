<?php

/**
 * Template part for displaying the secondary footer.
 *
 * @package Custom_Theme
 */
?>

<footer id="secondary-footer" class="p-10 bg-[#151515] text-gray-300 py-12 relative z-10">
  <div class="container mx-auto grid md:grid-cols-2 gap-12">
    <!-- Left: Logo + Newsletter -->
    <div class="space-y-6">
      <!-- Logo or Site Title -->
      <div class="flex-shrink-0">
        <?php
        if (get_theme_mod('custom_logo')) {
          echo wp_get_attachment_image(get_theme_mod('custom_logo'), 'logo-large');
        } else {
          // Fallback to styled site title
          echo '<a href="' . esc_url(home_url('/')) . '" class="text-4xl font-[\'Brush\'] text-white">Lenso</a>';
        }
        ?>
      </div>

      <!-- Headline + Copy -->
      <div class="space-y-2">
        <h2 class="text-2xl font-semibold text-white">Keep up with us</h2>
        <p class="text-sm text-gray-400">Get new updates, offers and discounts.</p>
      </div>

      <!-- Newsletter Form -->
      <form class="bg-white flex md:w-96 max-w-xl overflow-hidden rounded-full shadow-lg" method="post" action="#">
        <input
          type="email"
          name="footer_email"
          required
          placeholder="<?php esc_attr_e('Enter Email Address', 'custom-theme'); ?>"
          class="flex-1 px-4 py-2 bg-white text-gray-800 placeholder-gray-400 focus:outline-none" />
        <button
          type="submit"
          class="px-4 py-2 bg-gradient-to-r from-orange-400 to-red-500 text-white font-medium rounded-full hover:opacity-90 transition">
          Sign Up
        </button>
      </form>

      <!-- Social Icons -->
      <div class="flex space-x-4">
        <a href="#" aria-label="Facebook" class="text-white hover:text-blue-500 transition">
          <!-- Facebook Icon -->
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
            <path d="M22 12.07C22 6.21 17.52 1.73 11.66 1.73S1.32 6.21 1.32 12.07c0 5.03 3.67 9.2 8.44 9.91v-7.02H7.34v-2.9h2.42V9.41c0-2.4 1.43-3.72 3.62-3.72 1.05 0 2.15.18 2.15.18v2.37h-1.22c-1.2 0-1.57.74-1.57 1.5v1.8h2.68l-.43 2.9h-2.25v7.02c4.77-.71 8.44-4.88 8.44-9.91z" />
          </svg>
        </a>
        <a href="#" aria-label="Instagram" class="text-white hover:text-pink-500 transition">
          <!-- Instagram Icon -->
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
            <path d="M7.75 2h8.5A5.75 5.75 0 0 1 22 7.75v8.5A5.75 5.75 0 0 1 16.25 22h-8.5A5.75 5.75 0 0 1 2 16.25v-8.5A5.75 5.75 0 0 1 7.75 2zm0 1.5A4.25 4.25 0 0 0 3.5 7.75v8.5A4.25 4.25 0 0 0 7.75 20.5h8.5a4.25 4.25 0 0 0 4.25-4.25v-8.5A4.25 4.25 0 0 0 16.25 3.5h-8.5zM12 7a5 5 0 1 1 0 10 5 5 0 0 1 0-10zm0 1.5a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7zm5.25-.75a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
          </svg>
        </a>
        <a href="#" aria-label="WhatsApp" class="text-white hover:text-green-500 transition">
          <!-- WhatsApp Icon -->
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
            <path d="M20.52 3.48A11.9 11.9 0 0 0 12 .1C5.51.1.1 5.51.1 12c0 2.1.55 4.1 1.6 5.85L0 24l6.4-1.6A11.9 11.9 0 0 0 12 23.9c6.49 0 11.9-5.41 11.9-11.9 0-3.18-1.24-6.15-3.38-8.52zM12 21.7c-1.82 0-3.6-.5-5.12-1.44l-.37-.23-3.8.96.99-3.7-.24-.38A9.7 9.7 0 0 1 2.3 12 9.7 9.7 0 0 1 12 2.3c5.35 0 9.7 4.35 9.7 9.7S17.35 21.7 12 21.7zm5.28-7.7c-.28-.14-1.66-.82-1.92-.92-.26-.1-.46-.14-.65.14-.18.28-.7.92-.85 1.1-.16.18-.32.2-.6.07s-1.3-.48-2.48-1.52c-.92-.82-1.54-1.84-1.72-2.12-.18-.28-.02-.43.13-.57.14-.14.32-.37.48-.56.16-.18.21-.3.32-.5.1-.18.05-.33-.03-.46-.08-.12-.65-1.57-.89-2.14-.23-.56-.47-.48-.65-.49-.18-.01-.38-.01-.58-.01-.2 0-.53.07-.8.33-.28.26-1.07 1.05-1.07 2.55s1.1 2.96 1.25 3.17c.14.2 2.16 3.3 5.24 4.63.73.316 1.3.505 1.75.647.74.24 1.41.2 1.94.12.59-.09 1.66-.68 1.9-1.34.24-.66.24-1.23.17-1.34-.07-.11-.26-.18-.54-.32z" />
          </svg>
        </a>
        <a href="#" aria-label="YouTube" class="text-white hover:text-red-500 transition">
          <!-- YouTube Icon -->
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
            <path d="M23.5 6.2a2.61 2.61 0 0 0-1.84-1.84C19.8 4 12 4 12 4s-7.8 0-9.66.36A2.61 2.61 0 0 0 .5 6.2 27.44 27.44 0 0 0 0 12a27.44 27.44 0 0 0 .5 5.8 2.61 2.61 0 0 0 1.84 1.84C4.2 20 12 20 12 20s7.8 0 9.66-.36a2.61 2.61 0 0 0 1.84-1.84A27.44 27.44 0 0 0 24 12a27.44 27.44 0 0 0-.5-5.8zM9.75 15.02V8.98L15.5 12l-5.75 3.02z" />
          </svg>
        </a>
      </div>
    </div>

    <!-- Right: Footer navigation -->
    <div class="space-y-4 text-sm">
      <h3 class="sr-only">Footer menu</h3>
      <?php
      // Hard-coded links to match your design; or register a 'footer' menu and swap these into wp_nav_menu()
      $links = [
        'About us'    => '/about-us',
        'Cameras'     => '/cameras',
        'New Updates' => '/new-updates',
        'Contact us'  => '/contact-us',
      ];
      echo '<ul class="flex flex-col space-y-2">';
      foreach ($links as $label => $url) {
        echo '<li><a href="' . esc_url(home_url($url)) . '" class="hover:text-white transition">'
          . esc_html($label) .
          '</a></li>';
      }
      echo '</ul>';
      ?>
    </div>
  </div>

  <!-- Bottom bar -->
  <div class="border-t border-gray-700 mt-12 pt-6">
    <div class="container mx-auto flex flex-col md:flex-row justify-between items-center text-xs text-gray-500 space-y-3 md:space-y-0">
      <p>&copy; <?php echo date('Y') . ' ' . esc_html(get_bloginfo('name')); ?></p>
      <div class="flex space-x-6">
        <a href="<?php echo esc_url(home_url('/terms-conditions')); ?>" class="hover:underline hover:text-white">Terms &amp; Conditions</a>
        <a href="<?php echo esc_url(home_url('/privacy-policy')); ?>" class="hover:underline hover:text-white">Privacy Policy</a>
        <a href="<?php echo esc_url(home_url('/services')); ?>" class="hover:underline hover:text-white">Services</a>
      </div>
    </div>
  </div>
</footer>

<?php wp_footer(); ?>