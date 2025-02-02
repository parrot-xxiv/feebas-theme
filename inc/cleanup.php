<?php

// function remove_wp_block_library_css() {
//     wp_dequeue_style('wp-block-library');
//     wp_dequeue_style('wp-block-library-theme');
//     wp_dequeue_style('wc-block-style'); // For WooCommerce block styles.
// }
// add_action('wp_enqueue_scripts', 'remove_wp_block_library_css', 100);

function disable_emojis() {
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_action('wp_mail', 'wp_staticize_emoji_for_email');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
}
add_action('init', 'disable_emojis');

function remove_wp_version() {
    remove_action('wp_head', 'wp_generator');
}
add_action('init', 'remove_wp_version');

// add_filter('show_admin_bar', '__return_false');

// function deregister_scripts() {
//     wp_deregister_script('jquery'); // Removes bundled jQuery. Add your own if needed.
// }
// add_action('wp_enqueue_scripts', 'deregister_scripts');

function clean_up_wp_head() {
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'wp_shortlink_wp_head');
    remove_action('wp_head', 'rest_output_link_wp_head');
    remove_action('wp_head', 'wp_oembed_add_discovery_links');
    remove_action('wp_head', 'rel_canonical');
}
add_action('init', 'clean_up_wp_head');

function disable_theme_support() {
    remove_theme_support('automatic-feed-links');
    remove_theme_support('post-formats');
    remove_theme_support('custom-header');
    remove_theme_support('custom-background');
    remove_theme_support('core-block-patterns');
}
add_action('after_setup_theme', 'disable_theme_support');

function remove_dashboard_widgets() {
    remove_meta_box('dashboard_quick_press', 'dashboard', 'side');
    remove_meta_box('dashboard_recent_drafts', 'dashboard', 'side');
    remove_meta_box('dashboard_secondary', 'dashboard', 'side');
    remove_meta_box('dashboard_activity', 'dashboard', 'normal');  // Activity Widget
    remove_meta_box('dashboard_right_now', 'dashboard', 'normal'); // At a Glance Widget
    remove_meta_box('dashboard_quick_press', 'dashboard', 'side'); // Quick Draft Widget
    remove_meta_box('dashboard_primary', 'dashboard', 'side');     // WordPress News Widget
}
add_action('wp_dashboard_setup', 'remove_dashboard_widgets');

function disable_rest_api() {
    add_filter('rest_authentication_errors', function($result) {
        if (!is_user_logged_in()) {
            return new WP_Error('rest_forbidden', 'REST API restricted.', ['status' => 401]);
        }
        return $result;
    });
}
add_action('init', 'disable_rest_api');

function unregister_default_widgets() {
    unregister_widget('WP_Widget_Pages');
    unregister_widget('WP_Widget_Calendar');
    unregister_widget('WP_Widget_Archives');
    unregister_widget('WP_Widget_Meta');
    unregister_widget('WP_Widget_Search');
    unregister_widget('WP_Widget_Text');
    unregister_widget('WP_Widget_Categories');
    unregister_widget('WP_Widget_Recent_Posts');
    unregister_widget('WP_Widget_Recent_Comments');
}
add_action('widgets_init', 'unregister_default_widgets');

function remove_default_post_type() {
    remove_menu_page('edit.php'); // Remove "Posts" from admin menu
}
add_action('admin_menu', 'remove_default_post_type');

function disable_comments_features() {
    // Disable support for comments and trackbacks in all post types
    foreach (get_post_types() as $post_type) {
        remove_post_type_support($post_type, 'comments');
        remove_post_type_support($post_type, 'trackbacks');
    }
}
add_action('init', 'disable_comments_features');

function remove_comments_admin_menu() {
    remove_menu_page('edit-comments.php'); // Removes "Comments" from admin menu
}
add_action('admin_menu', 'remove_comments_admin_menu');

function disable_comments_redirect() {
    if (is_admin() && isset($_GET['page']) && $_GET['page'] === 'edit-comments.php') {
        wp_redirect(admin_url());
        exit;
    }
}
add_action('admin_init', 'disable_comments_redirect');

function remove_admin_bar_comments() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('comments');
}
add_action('wp_before_admin_bar_render', 'remove_admin_bar_comments');
