<?php

/**
 * Feebas Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Feebas_Theme
 */
if (! defined('FEEBAS_THEME_VERSION')) {
	// Replace the version number of the theme on each release.
	define('FEEBAS_THEME_VERSION', '1.0.0');
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function feebas_theme_setup()
{
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* composer run make-pot	
		*/
	load_theme_textdomain('feebas-theme', get_template_directory() . '/languages');

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support('title-tag');

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support('post-thumbnails');

	// This theme uses wp_nav_menu() in one location.
	// Register primary menu location
	register_nav_menus(array(
		'header' => 'Header Menu',
		'footer' => 'Footer Menu',
	));

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);

	add_image_size('logo-small', 100, 50, false);
	add_image_size('logo-large', 300, 150, false);
}
add_action('after_setup_theme', 'feebas_theme_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function feebas_theme_content_width()
{
	$GLOBALS['content_width'] = apply_filters('feebas_theme_content_width', 640);
}
add_action('after_setup_theme', 'feebas_theme_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function feebas_theme_widgets_init()
{
	register_sidebar(
		array(
			'name'          => esc_html__('Sidebar', 'feebas-theme'),
			'id'            => 'sidebar-1',
			'description'   => esc_html__('Add widgets here.', 'feebas-theme'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action('widgets_init', 'feebas_theme_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function feebas_theme_scripts()
{
	wp_enqueue_style('feebas-theme-style', get_theme_file_uri('/assets/css/style.css'), array(), FEEBAS_THEME_VERSION);
	wp_style_add_data('feebas-theme-style', 'rtl', 'replace');

	wp_enqueue_script('jquery');
}
add_action('wp_enqueue_scripts', 'feebas_theme_scripts');

/** 
 * Use require_once instead of require
 * Technically, your current use is fine since files are only loaded once. 
 * But require_once is safer if there's any chance of a file being included twice (like in testing, hooks, or reused functions).
 */

require_once get_template_directory() . '/inc/cleanup.php';
require_once get_template_directory() . '/inc/admin-page.php';
require_once get_template_directory() . '/post-types/camera.php';
require_once get_template_directory() . '/taxonomies/brand.php';
require_once get_template_directory() . '/taxonomies/type.php';
require_once get_template_directory() . '/ajax/camera-list.php';
