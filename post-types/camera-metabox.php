<?php 

function add_custom_meta_box() {
    add_meta_box(
        'custom_meta_box', // ID of the meta box
        'Details', // Title of the meta box
        'render_custom_meta_box', // Callback to render the form
        'camera', // Post type where the meta box should appear
        'normal', // Context (normal, side, advanced)
        'high' // Priority (high, low, etc.)
    );
}
add_action( 'add_meta_boxes', 'add_custom_meta_box' );

function render_custom_meta_box( $post ) {
    // Add a nonce field for security
    wp_nonce_field( 'custom_meta_box_nonce', 'custom_meta_box_nonce_field' );

    // Get current meta value (if any)
    $meta_value = get_post_meta( $post->ID, 'description', true );

    // Display custom form fields (input boxes, selects, etc.)
    ?>
    <p>
        <label for="description">Description:</label>
        <!-- $_POST['my_custom_field'] -->
        <input type="text" name="description" id="description" value="<?php echo esc_attr( $meta_value ); ?>" />
    </p>
    <?php
}

function save_custom_meta_box_data( $post_id ) {
    // Check if nonce is valid
    if ( ! isset( $_POST['custom_meta_box_nonce_field'] ) || ! wp_verify_nonce( $_POST['custom_meta_box_nonce_field'], 'custom_meta_box_nonce' ) ) {
        return;
    }

    // If it's autosave, don't save
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    // Check if this is a custom post type
    if ( 'camera' !== $_POST['post_type'] ) {
        return;
    }

    // Save the custom field data
    if ( isset( $_POST['description'] ) ) {
        update_post_meta( $post_id, 'description', sanitize_text_field( $_POST['description'] ) );
    }
}
add_action( 'save_post', 'save_custom_meta_box_data' );
