<?php

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

class Camera_Admin_Manager
{
    private $post_type = 'camera';
    private $meta_key = '_camera_image';
    private $per_page = 10;

    public function __construct()
    {
        // Register hooks
        add_action('admin_menu', array($this, 'add_menu_page'));
        add_action('admin_enqueue_scripts', array($this, 'enqueue_scripts'));
        add_action('wp_ajax_search_camera_posts', array($this, 'ajax_search_posts'));
        add_action('wp_ajax_update_camera_image', array($this, 'ajax_update_image'));
        add_action('wp_ajax_remove_camera_image', array($this, 'ajax_remove_image'));
    }

    /**
     * Add admin menu page
     */
    public function add_menu_page()
    {
        add_menu_page(
            'Camera Manager',
            'Camera Manager',
            'manage_options',
            'camera-manager',
            array($this, 'render_admin_page'),
            'dashicons-camera',
            30
        );
    }

    /**
     * Enqueue scripts and styles
     */
    public function enqueue_scripts($hook)
    {
        if ('toplevel_page_camera-manager' !== $hook) {
            return;
        }

        wp_enqueue_media();
        wp_enqueue_style('camera-admin-css', get_theme_file_uri('/assets/css/camera-manager.css'), array(), '1.0');
        wp_enqueue_script('camera-admin-js', get_theme_file_uri('/assets/js/camera-manager.js'), array('jquery'), '1.0', true);

        wp_localize_script('camera-admin-js', 'camera_admin', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('camera_admin_nonce'),
            'select_image' => __('Select Image', 'camera-manager'),
            'use_image' => __('Use This Image', 'camera-manager')
        ));
    }

    /**
     * Render admin page content
     */
    public function render_admin_page()
    {
        // Security check
        if (!current_user_can('manage_options')) {
            wp_die(__('You do not have sufficient permissions to access this page.'));
        }

        // Get current page number
        $paged = isset($_GET['paged']) ? absint($_GET['paged']) : 1;

        // Get search query if present
        $search_query = isset($_GET['camera_search']) ? sanitize_text_field($_GET['camera_search']) : '';

        // Get camera posts with pagination
        $camera_posts = $this->get_camera_posts($paged, $search_query);

        // Calculate pagination data
        $total_posts = $camera_posts['total'];
        $total_pages = ceil($total_posts / $this->per_page);

?>


        <div class="wrap camera-manager-wrap">
            <h1><?php _e('Camera Manager', 'camera-manager'); ?></h1>

            <div class="camera-search-form">
                <form method="get">
                    <input type="hidden" name="page" value="camera-manager">
                    <input type="text" name="camera_search" value="<?php echo esc_attr($search_query); ?>" placeholder="<?php _e('Search by title...', 'camera-manager'); ?>">
                    <button type="submit" class="button"><?php _e('Search', 'camera-manager'); ?></button>
                    <?php if (!empty($search_query)) : ?>
                        <a href="<?php echo admin_url('admin.php?page=camera-manager'); ?>" class="button"><?php _e('Clear', 'camera-manager'); ?></a>
                    <?php endif; ?>
                </form>
            </div>
            <?php if ($total_pages > 1) : ?>
                <div class="camera-pagination">
                    <?php
                    echo paginate_links(array(
                        'base' => add_query_arg('paged', '%#%'),
                        'format' => '',
                        'prev_text' => __('&laquo; Previous'),
                        'next_text' => __('Next &raquo;'),
                        'total' => $total_pages,
                        'current' => $paged
                    ));
                    ?>
                </div>
            <?php endif; ?>
            <div class="camera-items-container">
                <table class="wp-list-table widefat fixed striped camera-items-table">
                    <thead>
                        <tr>
                            <th><?php _e('ID', 'camera-manager'); ?></th>
                            <th><?php _e('Title', 'camera-manager'); ?></th>
                            <th><?php _e('Current Image', 'camera-manager'); ?></th>
                            <th><?php _e('Actions', 'camera-manager'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($camera_posts['posts'])) : ?>
                            <?php foreach ($camera_posts['posts'] as $post) : ?>
                                <?php
                                $image_id = get_post_meta($post->ID, $this->meta_key, true);
                                $image_url = $image_id ? wp_get_attachment_image_url($image_id, 'thumbnail') : '';
                                ?>
                                <tr data-id="<?php echo $post->ID; ?>">
                                    <td><?php echo $post->ID; ?></td>
                                    <td>
                                        <a href="<?php echo get_edit_post_link($post->ID); ?>" target="_blank">
                                            <?php echo $post->post_title; ?>
                                        </a>
                                    </td>
                                    <td class="camera-image-cell">
                                        <?php if ($image_url) : ?>
                                            <div class="camera-image-preview">
                                                <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($post->post_title); ?>">
                                            </div>
                                        <?php else : ?>
                                            <span class="no-image"><?php _e('No image', 'camera-manager'); ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="camera-actions">
                                        <button class="button select-camera-image" data-id="<?php echo $post->ID; ?>">
                                            <?php echo $image_url ? __('Change Image', 'camera-manager') : __('Add Image', 'camera-manager'); ?>
                                        </button>

                                        <?php if ($image_url) : ?>
                                            <button class="button remove-camera-image" data-id="<?php echo $post->ID; ?>">
                                                <?php _e('Remove', 'camera-manager'); ?>
                                            </button>
                                        <?php endif; ?>

                                        <span class="spinner"></span>
                                        <div class="update-message"></div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="4"><?php _e('No camera posts found.', 'camera-manager'); ?></td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

        </div>
<?php
    }

    /**
     * Get camera posts with pagination and search
     */
    private function get_camera_posts($paged = 1, $search = '')
    {
        $args = array(
            'post_type' => $this->post_type,
            'posts_per_page' => $this->per_page,
            'paged' => $paged,
            'orderby' => 'title',
            'order' => 'ASC'
        );

        if (!empty($search)) {
            $args['s'] = $search;
        }

        $query = new WP_Query($args);

        return array(
            'posts' => $query->posts,
            'total' => $query->found_posts
        );
    }

    /**
     * AJAX handler for searching posts
     */
    public function ajax_search_posts()
    {
        // Verify nonce
        check_ajax_referer('camera_admin_nonce', 'nonce');

        // Check permissions
        if (!current_user_can('manage_options')) {
            wp_send_json_error('Permission denied');
        }

        $search = isset($_POST['search']) ? sanitize_text_field($_POST['search']) : '';
        $paged = isset($_POST['page']) ? absint($_POST['page']) : 1;

        $results = $this->get_camera_posts($paged, $search);

        $html = '';

        if (!empty($results['posts'])) {
            foreach ($results['posts'] as $post) {
                $image_id = get_post_meta($post->ID, $this->meta_key, true);
                $image_url = $image_id ? wp_get_attachment_image_url($image_id, 'thumbnail') : '';

                $html .= '<tr data-id="' . $post->ID . '">';
                $html .= '<td>' . $post->ID . '</td>';
                $html .= '<td><a href="' . get_edit_post_link($post->ID) . '" target="_blank">' . $post->post_title . '</a></td>';
                $html .= '<td class="camera-image-cell">';

                if ($image_url) {
                    $html .= '<div class="camera-image-preview">';
                    $html .= '<img src="' . esc_url($image_url) . '" alt="' . esc_attr($post->post_title) . '">';
                    $html .= '</div>';
                } else {
                    $html .= '<span class="no-image">' . __('No image', 'camera-manager') . '</span>';
                }

                $html .= '</td>';
                $html .= '<td class="camera-actions">';
                $html .= '<button class="button select-camera-image" data-id="' . $post->ID . '">';
                $html .= $image_url ? __('Change Image', 'camera-manager') : __('Add Image', 'camera-manager');
                $html .= '</button>';

                if ($image_url) {
                    $html .= '<button class="button remove-camera-image" data-id="' . $post->ID . '">';
                    $html .= __('Remove', 'camera-manager');
                    $html .= '</button>';
                }

                $html .= '<span class="spinner"></span>';
                $html .= '<div class="update-message"></div>';
                $html .= '</td>';
                $html .= '</tr>';
            }
        } else {
            $html .= '<tr><td colspan="4">' . __('No camera posts found.', 'camera-manager') . '</td></tr>';
        }

        $total_pages = ceil($results['total'] / $this->per_page);

        wp_send_json_success(array(
            'html' => $html,
            'total_pages' => $total_pages,
            'total_posts' => $results['total']
        ));
    }

    /**
     * AJAX handler for updating camera image
     */
    public function ajax_update_image()
    {
        // Verify nonce
        check_ajax_referer('camera_admin_nonce', 'nonce');

        // Check permissions
        if (!current_user_can('manage_options')) {
            wp_send_json_error('Permission denied');
        }

        $post_id = isset($_POST['post_id']) ? absint($_POST['post_id']) : 0;
        $image_id = isset($_POST['image_id']) ? absint($_POST['image_id']) : 0;

        if (!$post_id || !$image_id) {
            wp_send_json_error('Invalid parameters');
        }

        // Check if post exists and is of type 'camera'
        $post = get_post($post_id);
        if (!$post || $post->post_type !== $this->post_type) {
            wp_send_json_error('Invalid post');
        }

        // Check if attachment exists
        if (!wp_get_attachment_url($image_id)) {
            wp_send_json_error('Invalid attachment');
        }

        // Update post meta
        update_post_meta($post_id, $this->meta_key, $image_id);

        // Get image URL for response
        $image_url = wp_get_attachment_image_url($image_id, 'thumbnail');

        wp_send_json_success(array(
            'image_url' => $image_url,
            'message' => __('Image updated successfully', 'camera-manager')
        ));
    }

    /**
     * AJAX handler for removing camera image
     */
    public function ajax_remove_image()
    {
        // Verify nonce
        check_ajax_referer('camera_admin_nonce', 'nonce');

        // Check permissions
        if (!current_user_can('manage_options')) {
            wp_send_json_error('Permission denied');
        }

        $post_id = isset($_POST['post_id']) ? absint($_POST['post_id']) : 0;

        if (!$post_id) {
            wp_send_json_error('Invalid post ID');
        }

        // Check if post exists and is of type 'camera'
        $post = get_post($post_id);
        if (!$post || $post->post_type !== $this->post_type) {
            wp_send_json_error('Invalid post');
        }

        // Delete post meta
        delete_post_meta($post_id, $this->meta_key);

        wp_send_json_success(array(
            'message' => __('Image removed successfully', 'camera-manager')
        ));
    }
}

// Initialize the class
new Camera_Admin_Manager();
