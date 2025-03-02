<?php

/**
 * Registers the `camera` post type.
 */
function camera_init() {
	register_post_type(
		'camera',
		[
			'labels'                => [
				'name'                  => __( 'Cameras', 'custom-theme' ),
				'singular_name'         => __( 'Camera', 'custom-theme' ),
				'all_items'             => __( 'All Cameras', 'custom-theme' ),
				'archives'              => __( 'Camera Archives', 'custom-theme' ),
				'attributes'            => __( 'Camera Attributes', 'custom-theme' ),
				'insert_into_item'      => __( 'Insert into Camera', 'custom-theme' ),
				'uploaded_to_this_item' => __( 'Uploaded to this Camera', 'custom-theme' ),
				'featured_image'        => _x( 'Featured Image', 'camera', 'custom-theme' ),
				'set_featured_image'    => _x( 'Set featured image', 'camera', 'custom-theme' ),
				'remove_featured_image' => _x( 'Remove featured image', 'camera', 'custom-theme' ),
				'use_featured_image'    => _x( 'Use as featured image', 'camera', 'custom-theme' ),
				'filter_items_list'     => __( 'Filter Cameras list', 'custom-theme' ),
				'items_list_navigation' => __( 'Cameras list navigation', 'custom-theme' ),
				'items_list'            => __( 'Cameras list', 'custom-theme' ),
				'new_item'              => __( 'New Camera', 'custom-theme' ),
				'add_new'               => __( 'Add New', 'custom-theme' ),
				'add_new_item'          => __( 'Add New Camera', 'custom-theme' ),
				'edit_item'             => __( 'Edit Camera', 'custom-theme' ),
				'view_item'             => __( 'View Camera', 'custom-theme' ),
				'view_items'            => __( 'View Cameras', 'custom-theme' ),
				'search_items'          => __( 'Search Cameras', 'custom-theme' ),
				'not_found'             => __( 'No Cameras found', 'custom-theme' ),
				'not_found_in_trash'    => __( 'No Cameras found in trash', 'custom-theme' ),
				'parent_item_colon'     => __( 'Parent Camera:', 'custom-theme' ),
				'menu_name'             => __( 'Cameras', 'custom-theme' ),
			],
			'public'                => true,
			'hierarchical'          => false,
			'show_ui'               => true,
			'show_in_nav_menus'     => true,
			'supports'              => [ 'title', 'editor' ],
			'has_archive'           => true,
			'rewrite'               => true,
			'query_var'             => true,
			'menu_position'         => null,
			'menu_icon'             => 'dashicons-admin-post',
			'show_in_rest'          => true,
			'rest_base'             => 'camera',
			'rest_controller_class' => 'WP_REST_Posts_Controller',
		]
	);

}

add_action( 'init', 'camera_init' );

/**
 * Sets the post updated messages for the `camera` post type.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `camera` post type.
 */
function camera_updated_messages( $messages ) {
	global $post;

	$permalink = get_permalink( $post );

	$messages['camera'] = [
		0  => '', // Unused. Messages start at index 1.
		/* translators: %s: post permalink */
		1  => sprintf( __( 'Camera updated. <a target="_blank" href="%s">View Camera</a>', 'custom-theme' ), esc_url( $permalink ) ),
		2  => __( 'Custom field updated.', 'custom-theme' ),
		3  => __( 'Custom field deleted.', 'custom-theme' ),
		4  => __( 'Camera updated.', 'custom-theme' ),
		/* translators: %s: date and time of the revision */
		5  => isset( $_GET['revision'] ) ? sprintf( __( 'Camera restored to revision from %s', 'custom-theme' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false, // phpcs:ignore WordPress.Security.NonceVerification.Recommended
		/* translators: %s: post permalink */
		6  => sprintf( __( 'Camera published. <a href="%s">View Camera</a>', 'custom-theme' ), esc_url( $permalink ) ),
		7  => __( 'Camera saved.', 'custom-theme' ),
		/* translators: %s: post permalink */
		8  => sprintf( __( 'Camera submitted. <a target="_blank" href="%s">Preview Camera</a>', 'custom-theme' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
		/* translators: 1: Publish box date format, see https://secure.php.net/date 2: Post permalink */
		9  => sprintf( __( 'Camera scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Camera</a>', 'custom-theme' ), date_i18n( __( 'M j, Y @ G:i', 'custom-theme' ), strtotime( $post->post_date ) ), esc_url( $permalink ) ),
		/* translators: %s: post permalink */
		10 => sprintf( __( 'Camera draft updated. <a target="_blank" href="%s">Preview Camera</a>', 'custom-theme' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
	];

	return $messages;
}

add_filter( 'post_updated_messages', 'camera_updated_messages' );

/**
 * Sets the bulk post updated messages for the `camera` post type.
 *
 * @param  array $bulk_messages Arrays of messages, each keyed by the corresponding post type. Messages are
 *                              keyed with 'updated', 'locked', 'deleted', 'trashed', and 'untrashed'.
 * @param  int[] $bulk_counts   Array of item counts for each message, used to build internationalized strings.
 * @return array Bulk messages for the `camera` post type.
 */
function camera_bulk_updated_messages( $bulk_messages, $bulk_counts ) {
	global $post;

	$bulk_messages['camera'] = [
		/* translators: %s: Number of Cameras. */
		'updated'   => _n( '%s Camera updated.', '%s Cameras updated.', $bulk_counts['updated'], 'custom-theme' ),
		'locked'    => ( 1 === $bulk_counts['locked'] ) ? __( '1 Camera not updated, somebody is editing it.', 'custom-theme' ) :
						/* translators: %s: Number of Cameras. */
						_n( '%s Camera not updated, somebody is editing it.', '%s Cameras not updated, somebody is editing them.', $bulk_counts['locked'], 'custom-theme' ),
		/* translators: %s: Number of Cameras. */
		'deleted'   => _n( '%s Camera permanently deleted.', '%s Cameras permanently deleted.', $bulk_counts['deleted'], 'custom-theme' ),
		/* translators: %s: Number of Cameras. */
		'trashed'   => _n( '%s Camera moved to the Trash.', '%s Cameras moved to the Trash.', $bulk_counts['trashed'], 'custom-theme' ),
		/* translators: %s: Number of Cameras. */
		'untrashed' => _n( '%s Camera restored from the Trash.', '%s Cameras restored from the Trash.', $bulk_counts['untrashed'], 'custom-theme' ),
	];

	return $bulk_messages;
}

add_filter( 'bulk_post_updated_messages', 'camera_bulk_updated_messages', 10, 2 );

// Add custom columns for weekly and daily prices
function add_camera_columns( $columns ) {
    $new_columns = array();
    foreach ( $columns as $key => $value ) {
        $new_columns[ $key ] = $value;
        // Insert custom columns after the title column (or anywhere you prefer)
        if ( 'title' === $key ) {
            $new_columns['weekly_price'] = __( 'Weekly Price', 'camera-list' );
            $new_columns['daily_price']  = __( 'Daily Price', 'camera-list' );
        }
    }
    return $new_columns;
}
add_filter( 'manage_camera_posts_columns', 'add_camera_columns' );

// Render the content for our custom columns
function render_camera_columns( $column, $post_id ) {
    if ( 'weekly_price' === $column ) {
        $weekly_price = get_post_meta( $post_id, 'weekly_price', true );
        echo $weekly_price ? esc_html( $weekly_price ) : '-';
    }
    if ( 'daily_price' === $column ) {
        $daily_price = get_post_meta( $post_id, 'daily_price', true );
        echo $daily_price ? esc_html( $daily_price ) : '-';
    }
}
add_action( 'manage_camera_posts_custom_column', 'render_camera_columns', 10, 2 );


