<?php

function camera_enqueue_ajax_script()
{
    // Check if the current post content contains our shortcode.
    wp_enqueue_script('jquery');
}
add_action('wp_enqueue_scripts', 'camera_enqueue_ajax_script');

function camera_list_ajax_shortcode($atts)
{
    ob_start();
?>
    <form id="camera-filter-form">
        <select name="camera_brand" id="camera_brand">
            <option value=""><?php esc_html_e('Select Brand', 'camera-list'); ?></option>
            <?php
            $brands = get_terms(array('taxonomy' => 'brand', 'hide_empty' => false));
            if (! empty($brands) && ! is_wp_error($brands)) {
                foreach ($brands as $brand) {
                    printf(
                        '<option value="%s">%s</option>',
                        esc_attr($brand->slug),
                        esc_html($brand->name)
                    );
                }
            }
            ?>
        </select>

        <select name="camera_type" id="camera_type">
            <option value=""><?php esc_html_e('Select Type', 'camera-list'); ?></option>
            <?php
            $types = get_terms(array('taxonomy' => 'type', 'hide_empty' => false));
            if (! empty($types) && ! is_wp_error($types)) {
                foreach ($types as $type) {
                    printf(
                        '<option value="%s">%s</option>',
                        esc_attr($type->slug),
                        esc_html($type->name)
                    );
                }
            }
            ?>
        </select>

        <select name="price_range" id="price_range">
            <option value=""><?php esc_html_e('Select Price Range', 'camera-list'); ?></option>
            <option value="2000-3000"><?php esc_html_e('2000 - 3000', 'camera-list'); ?></option>
            <option value="10000-20000"><?php esc_html_e('10000 - 20000', 'camera-list'); ?></option>
        </select>

        <button type="button" id="camera-filter-btn" class="button">
            <?php esc_html_e('Filter', 'camera-list'); ?>
        </button>
    </form>

    <div id="camera-list-results"></div>

    <script type="text/javascript">
        jQuery(document).ready(function($) {
            function loadCameras() {
                var data = {
                    action: 'load_cameras',
                    camera_brand: $('#camera_brand').val(),
                    camera_type: $('#camera_type').val(),
                    price_range: $('#price_range').val()
                };
                // Optionally show a loader
                $('#camera-list-results').html('<p><?php esc_html_e('Loading...', 'camera-list'); ?></p>');

                $.ajax({
                    url: '<?php echo admin_url('admin-ajax.php'); ?>',
                    type: 'GET',
                    data: data,
                    success: function(response) {
                        $('#camera-list-results').html(response);
                    },
                    error: function() {
                        $('#camera-list-results').html('<p><?php esc_html_e('Error loading cameras.', 'camera-list'); ?></p>');
                    }
                });
            }

            // Trigger AJAX load when any dropdown value changes
            $('#camera_brand, #camera_type, #price_range').on('change', function() {
                loadCameras();
            });

            // Optionally load cameras initially
            loadCameras();
        });
    </script>

<?php
    return ob_get_clean();
}
add_shortcode('camera_list', 'camera_list_ajax_shortcode');
