<?php

require_once get_template_directory() . '/post-types/camera-metabox.php';

/**
 * Registers the `camera` post type.
 */
function camera_init()
{
	register_post_type(
		'camera',
		[
			'labels'                => [
				'name'                  => __('Cameras', 'feebas-theme'),
				'singular_name'         => __('Camera', 'feebas-theme'),
				'all_items'             => __('All Cameras', 'feebas-theme'),
				'archives'              => __('Camera Archives', 'feebas-theme'),
				'attributes'            => __('Camera Attributes', 'feebas-theme'),
				'insert_into_item'      => __('Insert into Camera', 'feebas-theme'),
				'uploaded_to_this_item' => __('Uploaded to this Camera', 'feebas-theme'),
				'featured_image'        => _x('Featured Image', 'camera', 'feebas-theme'),
				'set_featured_image'    => _x('Set featured image', 'camera', 'feebas-theme'),
				'remove_featured_image' => _x('Remove featured image', 'camera', 'feebas-theme'),
				'use_featured_image'    => _x('Use as featured image', 'camera', 'feebas-theme'),
				'filter_items_list'     => __('Filter Cameras list', 'feebas-theme'),
				'items_list_navigation' => __('Cameras list navigation', 'feebas-theme'),
				'items_list'            => __('Cameras list', 'feebas-theme'),
				'new_item'              => __('New Camera', 'feebas-theme'),
				'add_new'               => __('Add New', 'feebas-theme'),
				'add_new_item'          => __('Add New Camera', 'feebas-theme'),
				'edit_item'             => __('Edit Camera', 'feebas-theme'),
				'view_item'             => __('View Camera', 'feebas-theme'),
				'view_items'            => __('View Cameras', 'feebas-theme'),
				'search_items'          => __('Search Cameras', 'feebas-theme'),
				'not_found'             => __('No Cameras found', 'feebas-theme'),
				'not_found_in_trash'    => __('No Cameras found in trash', 'feebas-theme'),
				'parent_item_colon'     => __('Parent Camera:', 'feebas-theme'),
				'menu_name'             => __('Cameras', 'feebas-theme'),
			],
			'public'                => true,
			'hierarchical'          => false,
			'show_ui'               => true,
			'show_in_nav_menus'     => true,
			'supports'              => ['title'],
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


add_action('init', 'camera_init');

/**
 * Sets the post updated messages for the `camera` post type.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `camera` post type.
 */
function camera_updated_messages($messages)
{
	global $post;

	$permalink = get_permalink($post);

	$messages['camera'] = [
		0  => '', // Unused. Messages start at index 1.
		/* translators: %s: post permalink */
		1  => sprintf(__('Camera updated. <a target="_blank" href="%s">View Camera</a>', 'feebas-theme'), esc_url($permalink)),
		2  => __('Custom field updated.', 'feebas-theme'),
		3  => __('Custom field deleted.', 'feebas-theme'),
		4  => __('Camera updated.', 'feebas-theme'),
		/* translators: %s: date and time of the revision */
		5  => isset($_GET['revision']) ? sprintf(__('Camera restored to revision from %s', 'feebas-theme'), wp_post_revision_title((int) $_GET['revision'], false)) : false, // phpcs:ignore WordPress.Security.NonceVerification.Recommended
		/* translators: %s: post permalink */
		6  => sprintf(__('Camera published. <a href="%s">View Camera</a>', 'feebas-theme'), esc_url($permalink)),
		7  => __('Camera saved.', 'feebas-theme'),
		/* translators: %s: post permalink */
		8  => sprintf(__('Camera submitted. <a target="_blank" href="%s">Preview Camera</a>', 'feebas-theme'), esc_url(add_query_arg('preview', 'true', $permalink))),
		/* translators: 1: Publish box date format, see https://secure.php.net/date 2: Post permalink */
		9  => sprintf(__('Camera scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Camera</a>', 'feebas-theme'), date_i18n(__('M j, Y @ G:i', 'feebas-theme'), strtotime($post->post_date)), esc_url($permalink)),
		/* translators: %s: post permalink */
		10 => sprintf(__('Camera draft updated. <a target="_blank" href="%s">Preview Camera</a>', 'feebas-theme'), esc_url(add_query_arg('preview', 'true', $permalink))),
	];

	return $messages;
}

add_filter('post_updated_messages', 'camera_updated_messages');

/**
 * Sets the bulk post updated messages for the `camera` post type.
 *
 * @param  array $bulk_messages Arrays of messages, each keyed by the corresponding post type. Messages are
 *                              keyed with 'updated', 'locked', 'deleted', 'trashed', and 'untrashed'.
 * @param  int[] $bulk_counts   Array of item counts for each message, used to build internationalized strings.
 * @return array Bulk messages for the `camera` post type.
 */
function camera_bulk_updated_messages($bulk_messages, $bulk_counts)
{
	global $post;

	$bulk_messages['camera'] = [
		/* translators: %s: Number of Cameras. */
		'updated'   => _n('%s Camera updated.', '%s Cameras updated.', $bulk_counts['updated'], 'feebas-theme'),
		'locked'    => (1 === $bulk_counts['locked']) ? __('1 Camera not updated, somebody is editing it.', 'feebas-theme') :
			/* translators: %s: Number of Cameras. */
			_n('%s Camera not updated, somebody is editing it.', '%s Cameras not updated, somebody is editing them.', $bulk_counts['locked'], 'feebas-theme'),
		/* translators: %s: Number of Cameras. */
		'deleted'   => _n('%s Camera permanently deleted.', '%s Cameras permanently deleted.', $bulk_counts['deleted'], 'feebas-theme'),
		/* translators: %s: Number of Cameras. */
		'trashed'   => _n('%s Camera moved to the Trash.', '%s Cameras moved to the Trash.', $bulk_counts['trashed'], 'feebas-theme'),
		/* translators: %s: Number of Cameras. */
		'untrashed' => _n('%s Camera restored from the Trash.', '%s Cameras restored from the Trash.', $bulk_counts['untrashed'], 'feebas-theme'),
	];

	return $bulk_messages;
}

add_filter('bulk_post_updated_messages', 'camera_bulk_updated_messages', 10, 2);

// Add custom columns for weekly and daily prices
function add_camera_columns($columns)
{
	$new_columns = array();
	foreach ($columns as $key => $value) {
		$new_columns[$key] = $value;
		// Insert custom columns after the title column (or anywhere you prefer)
		if ('title' === $key) {
			$new_columns['weekly_price'] = __('Weekly Price', 'camera-list');
			$new_columns['daily_price']  = __('Daily Price', 'camera-list');
		}
	}
	return $new_columns;
}
add_filter('manage_camera_posts_columns', 'add_camera_columns');

// Display the custom column data
function camera_custom_column_content($column, $post_id) {
    switch ($column) {
        case 'daily_price':
            $daily_price = get_post_meta($post_id, '_camera_daily_price', true);
            if (!empty($daily_price)) {
                echo '$' . number_format((float)$daily_price, 2);
            } else {
                echo '—';
            }
            break;
            
        case 'weekly_price':
            $weekly_price = get_post_meta($post_id, '_camera_weekly_price', true);
            if (!empty($weekly_price)) {
                echo '$' . number_format((float)$weekly_price, 2);
            } else {
                echo '—';
            }
            break;
    }
}
add_action('manage_camera_posts_custom_column', 'camera_custom_column_content', 10, 2);

function remove_specific_quick_edit_fields(){
	$screen = get_current_screen();

	// You can limit this to a specific post type by uncommenting the next line
	// if (!$screen || $screen->post_type != 'camera') return;
	
	// Only run on edit.php for camera post type
    if (!$screen || $screen->base !== 'edit' || $screen->post_type !== 'camera') {
        return;
    }

?>
	<script type="text/javascript">
		jQuery(function($) {

			// Store the original inlineEditPost.edit function
			var originalInlineEdit = inlineEditPost.edit;

			// Override the edit function
			inlineEditPost.edit = function(id) {
				// Call the original function
				originalInlineEdit.apply(this, arguments);

				// Get the post ID
				var post_id = 0;
				if (typeof(id) == 'object') {
					post_id = parseInt(this.getId(id));
				}

				if (post_id > 0) {
					// Get the quick edit row
					var $editRow = $('#edit-' + post_id);

					// Remove date fields (includes date, time, and timestamp)
					$editRow.find('.inline-edit-date').hide();

					// Remove password field
					// $editRow.find('.inline-edit-password-input-wrap').hide();

					// This works
					$("input[class*='password']").each(function(i) {
						$(this).closest('div').remove();
					})

					// Remove status dropdown
					$editRow.find('.inline-edit-status').hide();
				}
			};
		});
	</script>
<?php
}
// Add JavaScript to remove specific quick edit fields
add_action('admin_footer', 'remove_specific_quick_edit_fields');

function add_camera_custom_meta_box() {
    add_meta_box(
        'camera_custom_buttons',
        __( 'Custom Actions', 'camera-list' ),
        'render_camera_custom_meta_box',
        'camera',
        'side', // or 'normal'
        'high'
    );
}
add_action( 'add_meta_boxes', 'add_camera_custom_meta_box' );

function render_camera_custom_meta_box( $post ) {
    ?>
    <div>
        <button type="button" class="button" onclick="myCustomAction()">Action 1</button>
        <button type="button" class="button" onclick="myOtherAction()">Action 2</button>
    </div>
    <script type="text/javascript">
    function myCustomAction() {
        alert('Action 1 triggered!');
        // Place your AJAX or other custom code here.
    }
    function myOtherAction() {
        alert('Action 2 triggered!');
        // Place your AJAX or other custom code here.
    }
    </script>
    <?php
}

