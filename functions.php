<?php

include_once get_template_directory() . '/inc/cleanup.php';
include_once get_template_directory() . '/inc/enqueue.php';
include_once get_template_directory() . '/post-types/camera.php';


function my_theme_setup() {
    add_theme_support( 'align-wide' );
}

add_action( 'after_setup_theme', 'my_theme_setup' );