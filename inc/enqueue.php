<?php 

function load_assets() {
  wp_enqueue_style('maincss', get_theme_file_uri('/assets/css/style.css'));
}

add_action('wp_enqueue_scripts', 'load_assets');
