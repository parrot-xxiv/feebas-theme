<?php

/**
 * Registers the `brand` taxonomy,
 * for use with 'camera'.
 */
function brand_init() {
	register_taxonomy( 'brand', [ 'camera' ], [
		'hierarchical'          => true, // Category=true
		'public'                => true,
		'show_in_nav_menus'     => true,
		'show_ui'               => true,
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
			'name'                       => __( 'Brands', 'custom-theme' ),
			'singular_name'              => _x( 'Brand', 'taxonomy general name', 'custom-theme' ),
			'search_items'               => __( 'Search Brands', 'custom-theme' ),
			'popular_items'              => __( 'Popular Brands', 'custom-theme' ),
			'all_items'                  => __( 'All Brands', 'custom-theme' ),
			'parent_item'                => __( 'Parent Brand', 'custom-theme' ),
			'parent_item_colon'          => __( 'Parent Brand:', 'custom-theme' ),
			'edit_item'                  => __( 'Edit Brand', 'custom-theme' ),
			'update_item'                => __( 'Update Brand', 'custom-theme' ),
			'view_item'                  => __( 'View Brand', 'custom-theme' ),
			'add_new_item'               => __( 'Add New Brand', 'custom-theme' ),
			'new_item_name'              => __( 'New Brand', 'custom-theme' ),
			'separate_items_with_commas' => __( 'Separate brands with commas', 'custom-theme' ),
			'add_or_remove_items'        => __( 'Add or remove brands', 'custom-theme' ),
			'choose_from_most_used'      => __( 'Choose from the most used brands', 'custom-theme' ),
			'not_found'                  => __( 'No brands found.', 'custom-theme' ),
			'no_terms'                   => __( 'No brands', 'custom-theme' ),
			'menu_name'                  => __( 'Brands', 'custom-theme' ),
			'items_list_navigation'      => __( 'Brands list navigation', 'custom-theme' ),
			'items_list'                 => __( 'Brands list', 'custom-theme' ),
			'most_used'                  => _x( 'Most Used', 'brand', 'custom-theme' ),
			'back_to_items'              => __( '&larr; Back to Brands', 'custom-theme' ),
		],
		'show_in_rest'          => true,
		'rest_base'             => 'brand',
		'rest_controller_class' => 'WP_REST_Terms_Controller',
	] );

}

add_action( 'init', 'brand_init' );

/**
 * Sets the post updated messages for the `brand` taxonomy.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `brand` taxonomy.
 */
function brand_updated_messages( $messages ) {

	$messages['brand'] = [
		0 => '', // Unused. Messages start at index 1.
		1 => __( 'Brand added.', 'custom-theme' ),
		2 => __( 'Brand deleted.', 'custom-theme' ),
		3 => __( 'Brand updated.', 'custom-theme' ),
		4 => __( 'Brand not added.', 'custom-theme' ),
		5 => __( 'Brand not updated.', 'custom-theme' ),
		6 => __( 'Brands deleted.', 'custom-theme' ),
	];

	return $messages;
}

add_filter( 'term_updated_messages', 'brand_updated_messages' );
