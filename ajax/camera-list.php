<?php
/*
 Ajax for template-parts/camera-list 
*/
function load_cameras_ajax_handler()
{
    $camera_brand = isset($_GET['camera_brand']) ? sanitize_text_field($_GET['camera_brand']) : '';
    $camera_type  = isset($_GET['camera_type'])  ? sanitize_text_field($_GET['camera_type'])  : '';
    $price_range  = isset($_GET['price_range'])  ? sanitize_text_field($_GET['price_range'])  : '';

    $args = array(
        'post_type'      => 'camera',
        'posts_per_page' => -1,
    );

    // Build taxonomy query if brand or type are selected.
    $tax_queries = array();
    if (! empty($camera_brand)) {
        $tax_queries[] = array(
            'taxonomy' => 'brand',
            'field'    => 'slug',
            'terms'    => $camera_brand,
        );
    }
    if (! empty($camera_type)) {
        $tax_queries[] = array(
            'taxonomy' => 'type',
            'field'    => 'slug',
            'terms'    => $camera_type,
        );
    }
    if (! empty($tax_queries)) {
        $args['tax_query'] = array_merge(array('relation' => 'AND'), $tax_queries);
    }

    if (! empty($price_range)) {
        $range = explode('-', $price_range);
        if (count($range) === 2) {
            $low = intval($range[0]);
            $high = intval($range[1]);
            $args['meta_query'] = array(
                'relation' => 'OR',
                array(
                    'key'     => '_camera_daily_price',
                    'value'   => array($low, $high),
                    'compare' => 'BETWEEN',
                    'type'    => 'NUMERIC',
                ),
                array(
                    'key'     => '_camera_weekly_price',
                    'value'   => array($low, $high),
                    'compare' => 'BETWEEN',
                    'type'    => 'NUMERIC',
                ),
            );
        }
    }

    $query = new WP_Query($args);

    // Check if there are any results
    if ($query->have_posts()) {
        // Start outputting the card HTML for each camera
        while ($query->have_posts()) {
            $query->the_post();
?>
            <!-- Card Design -->
            <div class="max-w-xs bg-white rounded-lg shadow-lg overflow-hidden mb-4">
                <img src="<?php echo "https://placehold.co/600x400"; ?>" alt="<?php the_title(); ?>" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h2 class="text-xl font-semibold text-gray-800"><?php the_title(); ?></h2>
                    <p class="text-gray-600 mt-2"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                    <a href="<?php the_permalink(); ?>" class="text-blue-500 hover:underline mt-3 inline-block">Learn More</a>
                </div>
            </div>
<?php
        }
    } else {
        echo '<p>' . esc_html__('No cameras found matching your criteria.', 'feebas-theme') . '</p>';
    }
    wp_reset_postdata();
    wp_die();
}

add_action('wp_ajax_load_cameras', 'load_cameras_ajax_handler');
add_action('wp_ajax_nopriv_load_cameras', 'load_cameras_ajax_handler');
