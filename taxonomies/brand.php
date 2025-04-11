<?php

/**
 * Registers the `brand` taxonomy,
 * for use with 'camera'.
 */
function brand_init()
{
	register_taxonomy('brand', ['camera'], [
		'hierarchical'          => true, // Category=true
		'public'                => true,
		'show_in_nav_menus'     => true,
		'show_ui'               => true,
		'show_in_quick_edit'	=> false, // added
		'meta_box_cb'			=> false, // added
		'show_admin_column'     => true, // updated
		'query_var'             => true,
		'rewrite'               => true,
		'capabilities'          => [
			'manage_terms' => 'edit_posts',
			'edit_terms'   => 'edit_posts',
			'delete_terms' => 'edit_posts',
			'assign_terms' => 'edit_posts',
		],
		'labels'                => [
			'name'                       => __('Brands', 'feebas-theme'),
			'singular_name'              => _x('Brand', 'taxonomy general name', 'feebas-theme'),
			'search_items'               => __('Search Brands', 'feebas-theme'),
			'popular_items'              => __('Popular Brands', 'feebas-theme'),
			'all_items'                  => __('All Brands', 'feebas-theme'),
			'parent_item'                => __('Parent Brand', 'feebas-theme'),
			'parent_item_colon'          => __('Parent Brand:', 'feebas-theme'),
			'edit_item'                  => __('Edit Brand', 'feebas-theme'),
			'update_item'                => __('Update Brand', 'feebas-theme'),
			'view_item'                  => __('View Brand', 'feebas-theme'),
			'add_new_item'               => __('Add New Brand', 'feebas-theme'),
			'new_item_name'              => __('New Brand', 'feebas-theme'),
			'separate_items_with_commas' => __('Separate brands with commas', 'feebas-theme'),
			'add_or_remove_items'        => __('Add or remove brands', 'feebas-theme'),
			'choose_from_most_used'      => __('Choose from the most used brands', 'feebas-theme'),
			'not_found'                  => __('No brands found.', 'feebas-theme'),
			'no_terms'                   => __('No brands', 'feebas-theme'),
			'menu_name'                  => __('Brands', 'feebas-theme'),
			'items_list_navigation'      => __('Brands list navigation', 'feebas-theme'),
			'items_list'                 => __('Brands list', 'feebas-theme'),
			'most_used'                  => _x('Most Used', 'brand', 'feebas-theme'),
			'back_to_items'              => __('&larr; Back to Brands', 'feebas-theme'),
		],
		'show_in_rest'          => true,
		'rest_base'             => 'brand',
		'rest_controller_class' => 'WP_REST_Terms_Controller',
	]);
}

add_action('init', 'brand_init');

/**
 * Sets the post updated messages for the `brand` taxonomy.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `brand` taxonomy.
 */
function brand_updated_messages($messages)
{

	$messages['brand'] = [
		0 => '', // Unused. Messages start at index 1.
		1 => __('Brand added.', 'feebas-theme'),
		2 => __('Brand deleted.', 'feebas-theme'),
		3 => __('Brand updated.', 'feebas-theme'),
		4 => __('Brand not added.', 'feebas-theme'),
		5 => __('Brand not updated.', 'feebas-theme'),
		6 => __('Brands deleted.', 'feebas-theme'),
	];

	return $messages;
}

add_filter('term_updated_messages', 'brand_updated_messages');
