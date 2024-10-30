<?php
//IG TESTIMONIALS CUSTOM FIELDS
function ig_testimonials_get_meta( $value ) {
    global $post;

    $field = get_post_meta( $post->ID, $value, true );
    if ( ! empty( $field ) ) {
        return is_array( $field ) ? stripslashes_deep( $field ) : stripslashes( wp_kses_decode_entities( $field ) );
    } else {
        return false;
    }
}

function ig_testimonials_add_meta_box() {
    add_meta_box(
        'ig_testimonials_details',
        esc_html__( 'Testimonial details', 'ig-testimonials' ),
        'ig_testimonials_html',
        'testimonial',
        'side',
        'default'
    );
}
add_action( 'add_meta_boxes', 'ig_testimonials_add_meta_box' );

function ig_testimonials_html( $post ) {
    wp_nonce_field( 'ig_testimonials_save_meta_box_data', 'ig_testimonials_nonce' ); ?>
    <p><?php esc_html_e( 'Add your testimonial details', 'ig-testimonials' ); ?></p>
    <p>
        <label for="ig_testimonials_name"><?php esc_html_e( 'Name', 'ig-testimonials' ); ?></label><br>
        <input type="text" name="ig_testimonials_name" id="ig_testimonials_name" value="<?php echo ig_testimonials_get_meta( 'ig_testimonials_name' ); ?>">
    </p>
    <p>
        <label for="ig_testimonials_job"><?php  esc_html_e( 'Job', 'ig-testimonials' ); ?></label><br>
        <input type="text" name="ig_testimonials_job" id="ig_testimonials_job" value="<?php echo ig_testimonials_get_meta( 'ig_testimonials_job' ); ?>">
    </p>
    <p>
        <label for="ig_testimonials_website"><?php  esc_html_e( 'Website', 'ig-testimonials' ); ?></label><br>
        <input type="url" name="ig_testimonials_website" id="ig_testimonials_website" value="<?php echo ig_testimonials_get_meta( 'ig_testimonials_website' ); ?>">
    </p>
<?php
}

function ig_testimonials_save( $post_id ) {
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! isset( $_POST['ig_testimonials_nonce'] ) || ! wp_verify_nonce( $_POST['ig_testimonials_nonce'], 'ig_testimonials_save_meta_box_data' ) ) return;
    if ( isset( $_POST['ig_testimonials_name'] ) )
        update_post_meta( $post_id, 'ig_testimonials_name', esc_attr( $_POST['ig_testimonials_name'] ) );
    if ( isset( $_POST['ig_testimonials_job'] ) )
        update_post_meta( $post_id, 'ig_testimonials_job', esc_attr( $_POST['ig_testimonials_job'] ) );
    if ( isset( $_POST['ig_testimonials_website'] ) )
        update_post_meta( $post_id, 'ig_testimonials_website', esc_attr( $_POST['ig_testimonials_website'] ) );
}
add_action( 'save_post', 'ig_testimonials_save' );

//IG TESTIMONIALS CUSTOM IMAGE SIZE
function ig_testimonials_image() {
    add_image_size( 'ig-testimonials-thumb', get_option('ig_testimonials_thumb_width', '180'), get_option('ig_testimonials_thumb_height', '180'), true );
    add_image_size( 'ig-testimonials-thumb-medium', 280, 180, true );
}
//IMAGE SIZE
add_action( 'init', 'ig_testimonials_new_image_size' );
function ig_testimonials_new_image_size() {
    add_image_size( 'ig-testimonials-thumb', get_option('ig_testimonials_thumb_width', '180'), get_option('ig_testimonials_thumb_heigth', '180'), true ); //cropped
    add_image_size( 'ig-testimonials-carousel-img', get_option('ig_testimonials_carousel_img_width', '600'), get_option('ig_testimonials_carousel_img_height', '350'), true ); //cropped
}
// COLUMN
add_filter('manage_testimonial_posts_columns', 'ig_testimonials_columns');
function ig_testimonials_columns($defaults){
    $defaults['testimonial_thumbs'] = __('Thumbs');
    return $defaults;
}
//render the column
add_action('manage_testimonial_posts_custom_column', 'ig_testimonials_custom_columns', 5, 2);
function ig_testimonials_custom_columns($column_name, $post_id){
    if($column_name === 'testimonial_thumbs'){
        if (has_post_thumbnail( $post_id ))
            echo the_post_thumbnail( array('60','60') );
        else
            echo "N/A";
    }
}
$params = array(
  'foo' => 'false',
  'setting' => 123,
);
