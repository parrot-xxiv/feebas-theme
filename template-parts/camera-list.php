<?php

?>
<section class="bg-gray-100">
    <div class="w-5xl p-10 mx-auto">
        <h1 class="text-2xl text-blue-500 font-semibold mb-4">Elevate your vision</h1>
        <h2 class="text-xl mb-2">Rent high-end gear for your masterpiece</h2>

        <!-- Camera Filter Form -->
        <form id="camera-filter-form" class="flex space-x-4 justify-center mb-8">
            <select name="camera_brand" id="camera_brand" class="p-2 border rounded">
                <option value=""><?php esc_html_e('Select Brand', 'camera-list'); ?></option>
                <?php
                $brands = get_terms(array('taxonomy' => 'brand', 'hide_empty' => false));
                if (!empty($brands) && !is_wp_error($brands)) {
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

            <select name="camera_type" id="camera_type" class="p-2 border rounded">
                <option value=""><?php esc_html_e('Select Type', 'camera-list'); ?></option>
                <?php
                $types = get_terms(array('taxonomy' => 'type', 'hide_empty' => false));
                if (!empty($types) && !is_wp_error($types)) {
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

            <select name="price_range" id="price_range" class="p-2 border rounded">
                <option value=""><?php esc_html_e('Select Price Range', 'camera-list'); ?></option>
                <option value="2000-3000"><?php esc_html_e('2000 - 3000', 'camera-list'); ?></option>
                <option value="10000-20000"><?php esc_html_e('10000 - 20000', 'camera-list'); ?></option>
            </select>

        </form>

        <!-- Results Section with a Grid layout, max 4 columns -->
        <div id="camera-list-results" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
            <!-- Results will be loaded dynamically here -->
        </div>
    </div>
</section>
<script type="text/javascript">
    jQuery(document).ready(function($) {
        function loadCameras() {
            var data = {
                action: 'load_cameras',
                camera_brand: $('#camera_brand').val(),
                camera_type: $('#camera_type').val(),
                price_range: $('#price_range').val()
            };

            // Fade out the existing content before loading new content
            $('#camera-list-results').fadeOut(300, function() {
                // Show loading message during the fade-out
                $('#camera-list-results').html('<p class="text-center text-gray-500"><?php esc_html_e('Loading...', 'camera-list'); ?></p>');

                // Make the loading message fade in
                $('#camera-list-results').fadeIn(300);

                // Perform AJAX request
                $.ajax({
                    url: '<?php echo admin_url('admin-ajax.php'); ?>',
                    type: 'GET',
                    data: data,
                    success: function(response) {
                        // Fade out the current content, then replace with new content
                        $('#camera-list-results').fadeOut(300, function() {
                            // Update the content
                            $('#camera-list-results').html(response);

                            // Fade in the updated content
                            $('#camera-list-results').fadeIn(300);
                        });
                    },
                    error: function() {
                        $('#camera-list-results').html('<p class="text-center text-red-500"><?php esc_html_e('Error loading cameras.', 'camera-list'); ?></p>');
                    }
                });
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