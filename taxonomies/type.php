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
		'show_in_quick_edit'	=> false, // added
		'meta_box_cb'			=> false, // added
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
			'name'                       => __( 'Types', 'feebas-theme' ),
			'singular_name'              => _x( 'Type', 'taxonomy general name', 'feebas-theme' ),
			'search_items'               => __( 'Search Types', 'feebas-theme' ),
			'popular_items'              => __( 'Popular Types', 'feebas-theme' ),
			'all_items'                  => __( 'All Types', 'feebas-theme' ),
			'parent_item'                => __( 'Parent Type', 'feebas-theme' ),
			'parent_item_colon'          => __( 'Parent Type:', 'feebas-theme' ),
			'edit_item'                  => __( 'Edit Type', 'feebas-theme' ),
			'update_item'                => __( 'Update Type', 'feebas-theme' ),
			'view_item'                  => __( 'View Type', 'feebas-theme' ),
			'add_new_item'               => __( 'Add New Type', 'feebas-theme' ),
			'new_item_name'              => __( 'New Type', 'feebas-theme' ),
			'separate_items_with_commas' => __( 'Separate types with commas', 'feebas-theme' ),
			'add_or_remove_items'        => __( 'Add or remove types', 'feebas-theme' ),
			'choose_from_most_used'      => __( 'Choose from the most used types', 'feebas-theme' ),
			'not_found'                  => __( 'No types found.', 'feebas-theme' ),
			'no_terms'                   => __( 'No types', 'feebas-theme' ),
			'menu_name'                  => __( 'Types', 'feebas-theme' ),
			'items_list_navigation'      => __( 'Types list navigation', 'feebas-theme' ),
			'items_list'                 => __( 'Types list', 'feebas-theme' ),
			'most_used'                  => _x( 'Most Used', 'type', 'feebas-theme' ),
			'back_to_items'              => __( '&larr; Back to Types', 'feebas-theme' ),
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
		1 => __( 'Type added.', 'feebas-theme' ),
		2 => __( 'Type deleted.', 'feebas-theme' ),
		3 => __( 'Type updated.', 'feebas-theme' ),
		4 => __( 'Type not added.', 'feebas-theme' ),
		5 => __( 'Type not updated.', 'feebas-theme' ),
		6 => __( 'Types deleted.', 'feebas-theme' ),
	];

	return $messages;
}

add_filter( 'term_updated_messages', 'type_updated_messages' );
