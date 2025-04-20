<?php
/**
 * Template part for displaying the secondary footer.
 *
 * @package Custom_Theme
 */
?>

<footer id="secondary-footer" class="bg-gray-100 text-gray-700 py-8">
  <div class="container mx-auto grid md:grid-cols-2 gap-8">
    <div class="space-y-4">
      <div class="flex-shrink-0">
        <?php echo wp_get_attachment_image(get_theme_mod('custom_logo'), 'logo-large'); ?>
      </div>
      <p class="text-sm">Get new updates, offers and discounts</p>
      <form class="flex flex-col sm:flex-row sm:space-x-2" method="post" action="#">
        <input type="email" name="footer_email" required placeholder="<?php esc_attr_e( 'Enter your email', 'custom-theme' ); ?>" class="w-full p-2 border border-gray-300 rounded mb-2 sm:mb-0" />
        <button type="submit" class="p-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition-colors"><?php esc_html_e( 'Subscribe', 'custom-theme' ); ?></button>
      </form>
      <div class="flex space-x-4">
        <a href="#" aria-label="Facebook" class="hover:text-blue-600">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
            <path d="M22 12a10 10 0 1 0-11.5 9.9v-7h-2v-3h2v-2.3c0-2 1.2-3.1 3-3.1.9 0 1.8.2 1.8.2v2h-1c-1 0-1.3.7-1.3 1.4V12h2.3l-.4 3h-1.9v7A10 10 0 0 0 22 12z"/>
          </svg>
        </a>
        <a href="#" aria-label="Twitter" class="hover:text-blue-400">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
            <path d="M23 3a10.9 10.9 0 0 1-3.1.8 5.4 5.4 0 0 0 2.4-3 10.8 10.8 0 0 1-3.4 1.3A5.4 5.4 0 0 0 16.5 2c-3 0-5.4 2.4-5.4 5.4 0 .4 0 .8.1 1.2A15.4 15.4 0 0 1 2 3.2a5.4 5.4 0 0 0 1.7 7.2 5.3 5.3 0 0 1-2.4-.7v.1c0 2.5 1.8 4.6 4.2 5-.4.1-.8.2-1.3.2-.3 0-.6 0-.9-.1a5.4 5.4 0 0 0 5 3.8A10.8 10.8 0 0 1 1 19.6a15.3 15.3 0 0 0 8.3 2.4c10 0 15.5-8.3 15.5-15.5v-.7A11 11 0 0 0 23 3z"/>
          </svg>
        </a>
        <a href="#" aria-label="Instagram" class="hover:text-pink-500">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
            <path d="M7 2C4.2 2 2 4.2 2 7v10c0 2.8 2.2 5 5 5h10c2.8 0 5-2.2 5-5V7c0-2.8-2.2-5-5-5H7zm10 2c1.7 0 3 1.3 3 3v10c0 1.7-1.3 3-3 3H7c-1.7 0-3-1.3-3-3V7c0-1.7 1.3-3 3-3h10zm-5 3a5 5 0 1 0 0 10 5 5 0 0 0 0-10zm0 2a3 3 0 1 1 0 6 3 3 0 0 1 0-6zm4.5-.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
          </svg>
        </a>
      </div>
    </div>
    <div>
      <?php
      if ( has_nav_menu( 'footer' ) ) {
        wp_nav_menu( array(
          'theme_location' => 'footer', // defined in inc/navmenu.php
          'container'      => false,
          'menu_class'     => 'flex flex-col space-y-2 text-sm',
          'link_class'     => 'hover:text-gray-900',
        ) );
      }
      ?>
    </div>
  </div>
  <div class="border-t mt-8 pt-4">
    <div class="container mx-auto flex flex-col md:flex-row justify-between items-center text-xs text-gray-500 space-y-2 md:space-y-0">
      <p>&copy; <?php echo date( 'Y' ) . ' ' . esc_html( get_bloginfo( 'name' ) ); ?></p>
      <div class="flex space-x-4">
        <a href="<?php echo esc_url( home_url( '/terms-conditions' ) ); ?>" class="hover:underline"><?php esc_html_e( 'Terms & Conditions', 'custom-theme' ); ?></a>
        <a href="<?php echo esc_url( home_url( '/privacy-policy' ) ); ?>" class="hover:underline"><?php esc_html_e( 'Privacy Policy', 'custom-theme' ); ?></a>
      </div>
    </div>
  </div>
</footer>

<?php wp_footer(); ?>