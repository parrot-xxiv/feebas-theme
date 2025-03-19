<?php

// Enqueue Media Uploader Scripts only on the 'Frontend Settings' page
function enqueue_media_uploader($hook)
{
    // Check if we are on the 'frontend-settings' page
    if ($hook != 'toplevel_page_frontend-settings') {
        return;
    }

    wp_enqueue_media(); // Enqueue WordPress media library scripts
}
add_action('admin_enqueue_scripts', 'enqueue_media_uploader');

// Add Admin Menu Page
function add_frontend_settings_menu()
{
    add_menu_page(
        'Frontend Settings',        // 1. Page Title
        'Frontend Settings',        // 2. Menu Title
        'manage_options',      // 3. Capability
        'frontend-settings', // 4. Menu Slug
        'render_frontend_settings_page', // 5. Function to render the page content
        'dashicons-admin-generic', // 6. Icon
        30                      // 7. Position in the admin sidebar
    );
}
add_action('admin_menu', 'add_frontend_settings_menu');

// Render Admin Page Content
function render_frontend_settings_page()
{
    // Check user capabilities
    if (!current_user_can('manage_options')) {
        return;
    }

    // Save form data
    if (isset($_POST['frontendsettings_form_submit'])) {
        // Check if nonce exists first
        if (!isset($_POST['frontendsettings_form_nonce']) || !wp_verify_nonce($_POST['frontendsettings_form_nonce'], 'frontendsettings_form_action')) {
            wp_die('Invalid nonce');
        }
        // Save the ID of the image (not the URL)
        $banner_image_id = isset($_POST['_banner_image_id']) ? sanitize_text_field($_POST['_banner_image_id']) : '';
        update_option('_banner_image_id', $banner_image_id); // Save only the ID

        echo '<div class="notice notice-success"><p>Settings saved successfully!</p></div>';
    }

    // Get current values
    $banner_image_id = get_option('_banner_image_id', '');
    $banner_image_url = $banner_image_id ? wp_get_attachment_url($banner_image_id) : '';

    // Admin page HTML
?>
    <div class="wrap">
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>

        <form method="post" action="">
            <?php wp_nonce_field('frontendsettings_form_action', 'frontendsettings_form_nonce'); ?>

            <table class="form-table">
                <tr>
                    <th scope="row"><label for="banner_image">Banner Image</label></th>
                    <td>
                        <input hidden type="text" id="banner_image_id" name="_banner_image_id"
                            value="<?php echo esc_attr($banner_image_id); ?>" class="regular-text">
                        <input type="button" id="upload_button" class="button" value="Upload Image">
                        <?php if ($banner_image_url): ?>
                            <div id="image_preview" style="margin-top: 10px;">
                                <img src="<?php echo esc_url($banner_image_url); ?>" alt="Banner Image" style="max-width: 100%; height: auto;">
                            </div>
                        <?php endif; ?>
                    </td>
                </tr>
            </table>

            <p class="submit">
                <input type="submit" name="frontendsettings_form_submit" class="button button-primary"
                    value="Save Settings">
            </p>
        </form>
    </div>
    <script>
        // JavaScript to open media uploader
        jQuery(document).ready(function($) {
            var mediaUploader;

            $('#upload_button').click(function(e) {
                e.preventDefault();

                // If the uploader object has already been created, reopen the dialog
                if (mediaUploader) {
                    mediaUploader.open();
                    return;
                }

                // Create the media uploader
                mediaUploader = wp.media.frames.file_frame = wp.media({
                    title: 'Select or Upload a Banner Image',
                    button: {
                        text: 'Use this image'
                    },
                    multiple: false // Set to true to allow multiple images
                });

                // When an image is selected, set the input value to the image URL
                mediaUploader.on('select', function() {
                    var attachment = mediaUploader.state().get('selection').first().toJSON();
                    console.log(attachment)
                    $('#banner_image_id').val(attachment.id); // Save the image ID
                    $('#image_preview').html('<img src="' + attachment.url + '" alt="Banner Image" style="max-width: 100%; height: auto;">'); // Show the image preview
                });

                // Open the uploader dialog
                mediaUploader.open();
            });
        });
    </script>

<?php
}
