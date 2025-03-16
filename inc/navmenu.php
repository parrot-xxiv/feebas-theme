<?php 

function register_navmenu() {
  // Register primary menu location
  register_nav_menus(array(
    'primary' => 'Primary Menu',
    'footer' => 'Footer Menu',
  ));
}
add_action('after_setup_theme', 'register_navmenu');

