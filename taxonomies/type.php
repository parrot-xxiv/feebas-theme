<?php

/**
 * Registers the `type` taxonomy,
 * for use with 'camera'.
 */
function type_init() {
	register_taxonomy( 'type', [ 'camera' ], [
		'hierarchical'          => true, // updated to true
		'public'                => true,
		'show_in_nav_menus'     => true,
		'show_ui'               => true,
		'show_admin_column'     => true, // updated to true
		'query_var'             => true,
		'rewrite'               => true,
		'capabilities'          => [
			'manage_terms' => 'edit_posts',
			'edit_terms'   => 'edit_posts',
			'delete_terms' => 'edit_posts',
			'assign_terms' => 'edit_posts',
		],
		'labels'                => [
			'name'                       => __( 'Types', 'custom-theme' ),
			'singular_name'              => _x( 'Type', 'taxonomy general name', 'custom-theme' ),
			'search_items'               => __( 'Search Types', 'custom-theme' ),
			'popular_items'              => __( 'Popular Types', 'custom-theme' ),
			'all_items'                  => __( 'All Types', 'custom-theme' ),
			'parent_item'                => __( 'Parent Type', 'custom-theme' ),
			'parent_item_colon'          => __( 'Parent Type:', 'custom-theme' ),
			'edit_item'                  => __( 'Edit Type', 'custom-theme' ),
			'update_item'                => __( 'Update Type', 'custom-theme' ),
			'view_item'                  => __( 'View Type', 'custom-theme' ),
			'add_new_item'               => __( 'Add New Type', 'custom-theme' ),
			'new_item_name'              => __( 'New Type', 'custom-theme' ),
			'separate_items_with_commas' => __( 'Separate types with commas', 'custom-theme' ),
			'add_or_remove_items'        => __( 'Add or remove types', 'custom-theme' ),
			'choose_from_most_used'      => __( 'Choose from the most used types', 'custom-theme' ),
			'not_found'                  => __( 'No types found.', 'custom-theme' ),
			'no_terms'                   => __( 'No types', 'custom-theme' ),
			'menu_name'                  => __( 'Types', 'custom-theme' ),
			'items_list_navigation'      => __( 'Types list navigation', 'custom-theme' ),
			'items_list'                 => __( 'Types list', 'custom-theme' ),
			'most_used'                  => _x( 'Most Used', 'type', 'custom-theme' ),
			'back_to_items'              => __( '&larr; Back to Types', 'custom-theme' ),
		],
		'show_in_rest'          => true,
		'rest_base'             => 'type',
		'rest_controller_class' => 'WP_REST_Terms_Controller',
	] );

}

add_action( 'init', 'type_init' );

/**
 * Sets the post updated messages for the `type` taxonomy.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `type` taxonomy.
 */
function type_updated_messages( $messages ) {

	$messages['type'] = [
		0 => '', // Unused. Messages start at index 1.
		1 => __( 'Type added.', 'custom-theme' ),
		2 => __( 'Type deleted.', 'custom-theme' ),
		3 => __( 'Type updated.', 'custom-theme' ),
		4 => __( 'Type not added.', 'custom-theme' ),
		5 => __( 'Type not updated.', 'custom-theme' ),
		6 => __( 'Types deleted.', 'custom-theme' ),
	];

	return $messages;
}

add_filter( 'term_updated_messages', 'type_updated_messages' );
