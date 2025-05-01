<?php
/**
 * Template part for displaying the secondary footer.
 *
 * @package Custom_Theme
 */
?>

<footer id="secondary-footer" class="bg-[#151515] text-gray-300 py-8">
  <div class="container mx-auto grid md:grid-cols-2 gap-8">
    <div class="space-y-4">
      <div class="flex-shrink-0">
        <?php echo wp_get_attachment_image(get_theme_mod('custom_logo'), 'logo-large'); ?>
      </div>
      <p class="text-sm text-gray-400">Get new updates, offers and discounts</p>
      <form class="flex flex-col sm:flex-row sm:space-x-2" method="post" action="#">
        <input type="email" name="footer_email" required placeholder="<?php esc_attr_e( 'Enter your email', 'custom-theme' ); ?>" class="w-full p-2 border border-gray-600 bg-[#1c1c1c] text-white rounded mb-2 sm:mb-0 placeholder-gray-400" />
        <button type="submit" class="p-2 bg-[#ff7f32] text-white rounded hover:bg-blue-700 transition-colors"><?php esc_html_e( 'Subscribe', 'custom-theme' ); ?></button>
      </form>
      <div class="flex space-x-4">
        <a href="#" aria-label="Facebook" class="hover:text-blue-400 text-gray-300">
          <!-- Facebook Icon -->
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
            <path d="..."/>
          </svg>
        </a>
        <a href="#" aria-label="Twitter" class="hover:text-blue-300 text-gray-300">
          <!-- Twitter Icon -->
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
            <path d="..."/>
          </svg>
        </a>
        <a href="#" aria-label="Instagram" class="hover:text-pink-400 text-gray-300">
          <!-- Instagram Icon -->
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
            <path d="..."/>
          </svg>
        </a>
      </div>
    </div>
    <div>
      <?php
      if ( has_nav_menu( 'footer' ) ) {
        wp_nav_menu( array(
          'theme_location' => 'footer',
          'container'      => false,
          'menu_class'     => 'flex flex-col space-y-2 text-sm text-gray-400',
          'link_class'     => 'hover:text-white',
        ) );
      }
      ?>
    </div>
  </div>
  <div class="border-t border-gray-700 mt-8 pt-4">
    <div class="container mx-auto flex flex-col md:flex-row justify-between items-center text-xs text-gray-500 space-y-2 md:space-y-0">
      <p>&copy; <?php echo date( 'Y' ) . ' ' . esc_html( get_bloginfo( 'name' ) ); ?></p>
      <div class="flex space-x-4">
        <a href="<?php echo esc_url( home_url( '/terms-conditions' ) ); ?>" class="hover:underline text-gray-400 hover:text-white"><?php esc_html_e( 'Terms & Conditions', 'custom-theme' ); ?></a>
        <a href="<?php echo esc_url( home_url( '/privacy-policy' ) ); ?>" class="hover:underline text-gray-400 hover:text-white"><?php esc_html_e( 'Privacy Policy', 'custom-theme' ); ?></a>
      </div>
    </div>
  </div>
</footer>

<?php wp_footer(); ?>