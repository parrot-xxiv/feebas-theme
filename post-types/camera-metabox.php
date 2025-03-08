<?php

/**
 * Camera Custom Meta Box
 */


// Enqueue WordPress Media Library scripts
function camera_admin_scripts() {
    global $post_type;
    if ('camera' === $post_type) {
        wp_enqueue_media();
    }
}
add_action('admin_enqueue_scripts', 'camera_admin_scripts');

// Register Meta Box
function camera_meta_box() {
    add_meta_box(
        'camera_details',
        'Camera Details',
        'camera_meta_box_callback',
        'camera',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'camera_meta_box');

// Meta Box Callback
function camera_meta_box_callback($post) {
    wp_nonce_field('camera_save_meta', 'camera_meta_nonce');
    
    // Get saved values
    $description = get_post_meta($post->ID, '_camera_description', true);
    $daily_price = get_post_meta($post->ID, '_camera_daily_price', true);
    $weekly_price = get_post_meta($post->ID, '_camera_weekly_price', true);
    $image_id = get_post_meta($post->ID, '_camera_image', true);
    
    // Get terms for this post
    $brand_terms = wp_get_post_terms($post->ID, 'brand', array('fields' => 'ids'));
    $type_terms = wp_get_post_terms($post->ID, 'type', array('fields' => 'ids'));
    
    ?>
    <div class="camera-meta-box">
        <!-- Description Field -->
        <div class="meta-field">
            <label for="camera_description">Description:</label>
            <textarea id="camera_description" name="camera_description" rows="4" style="width: 100%;"><?php echo esc_textarea($description); ?></textarea>
        </div>
        
        <!-- Brand Taxonomy -->
        <div class="meta-field">
            <label for="camera_brand">Brand:</label>
            <?php
            $brand_args = array(
                'taxonomy'         => 'brand',
                'name'             => 'camera_brand',
                'show_option_none' => '-- Select Brand --',
                'selected'         => !empty($brand_terms) ? $brand_terms[0] : 0,
                'hierarchical'     => true,
                'show_count'       => false,
                'hide_empty'       => false,
            );
            wp_dropdown_categories($brand_args);
            ?>
        </div>
        
        <!-- Type Taxonomy -->
        <div class="meta-field">
            <label for="camera_type">Type:</label>
            <?php
            $type_args = array(
                'taxonomy'         => 'type',
                'name'             => 'camera_type',
                'show_option_none' => '-- Select Type --',
                'selected'         => !empty($type_terms) ? $type_terms[0] : 0,
                'hierarchical'     => true,
                'show_count'       => false,
                'hide_empty'       => false,
            );
            wp_dropdown_categories($type_args);
            ?>
        </div>
        
        <!-- Daily Price Field -->
        <div class="meta-field">
            <label for="camera_daily_price">Daily Price:</label>
            <input type="number" id="camera_daily_price" name="camera_daily_price" value="<?php echo esc_attr($daily_price); ?>" step="0.01" min="0" />
        </div>
        
        <!-- Weekly Price Field -->
        <div class="meta-field">
            <label for="camera_weekly_price">Weekly Price:</label>
            <input type="number" id="camera_weekly_price" name="camera_weekly_price" value="<?php echo esc_attr($weekly_price); ?>" step="0.01" min="0" />
        </div>
        
        <!-- Image Field -->
        <div class="meta-field">
            <label for="camera_image">Featured Image:</label>
            <div class="camera-image-container">
                <div id="camera_image_preview" style="margin-bottom: 10px;">
                    <?php if ($image_id) : ?>
                        <?php echo wp_get_attachment_image($image_id, 'thumbnail'); ?>
                    <?php endif; ?>
                </div>
                <input type="hidden" id="camera_image" name="camera_image" value="<?php echo esc_attr($image_id); ?>" />
                <button type="button" id="camera_upload_image_button" class="button">Select Image</button>
                <button type="button" id="camera_remove_image_button" class="button" <?php echo empty($image_id) ? 'style="display:none;"' : ''; ?>>Remove Image</button>
            </div>
        </div>
    </div>
    
    <style>
        .camera-meta-box .meta-field {
            margin-bottom: 15px;
        }
        .camera-meta-box label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
    </style>
    
    <script>
    jQuery(document).ready(function($) {
        // Media Uploader
        var camera_file_frame;
        
        $('#camera_upload_image_button').on('click', function(event) {
            event.preventDefault();
            
            if (camera_file_frame) {
                camera_file_frame.open();
                return;
            }
            
            camera_file_frame = wp.media({
                title: 'Select or Upload an Image',
                button: {
                    text: 'Use this image'
                },
                multiple: false
            });
            
            camera_file_frame.on('select', function() {
                var attachment = camera_file_frame.state().get('selection').first().toJSON();
                $('#camera_image').val(attachment.id);
                $('#camera_image_preview').html('<img src="' + attachment.url + '" alt="" style="max-width: 100%; max-height: 150px;" />');
                $('#camera_remove_image_button').show();
            });
            
            camera_file_frame.open();
        });
        
        $('#camera_remove_image_button').on('click', function(event) {
            $('#camera_image').val('');
            $('#camera_image_preview').html('');
            $(this).hide();
        });
    });
    </script>
    <?php
}

// Save Meta Box Data
function camera_save_meta($post_id) {
    // Check if nonce is set
    if (!isset($_POST['camera_meta_nonce'])) {
        return;
    }
    
    // Verify nonce
    if (!wp_verify_nonce($_POST['camera_meta_nonce'], 'camera_save_meta')) {
        return;
    }
    
    // Check if autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    // Check permissions
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    // Save description
    if (isset($_POST['camera_description'])) {
        update_post_meta($post_id, '_camera_description', sanitize_textarea_field($_POST['camera_description']));
    }
    
    // Save prices
    if (isset($_POST['camera_daily_price'])) {
        update_post_meta($post_id, '_camera_daily_price', sanitize_text_field($_POST['camera_daily_price']));
    }
    
    if (isset($_POST['camera_weekly_price'])) {
        update_post_meta($post_id, '_camera_weekly_price', sanitize_text_field($_POST['camera_weekly_price']));
    }
    
    // Save image
    if (isset($_POST['camera_image'])) {
        update_post_meta($post_id, '_camera_image', sanitize_text_field($_POST['camera_image']));
    }
    
    // Save taxonomies
    if (isset($_POST['camera_brand']) && $_POST['camera_brand'] > 0) {
        wp_set_object_terms($post_id, (int)$_POST['camera_brand'], 'brand');
    }
    
    if (isset($_POST['camera_type']) && $_POST['camera_type'] > 0) {
        wp_set_object_terms($post_id, (int)$_POST['camera_type'], 'type');
    }
}
add_action('save_post_camera', 'camera_save_meta');
