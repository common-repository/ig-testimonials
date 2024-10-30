<?php
if ( ! function_exists('ig_testimonials_post_type') ) {
// Register Custom Post Type
function ig_testimonials_post_type() {

    $labels = array(
        'name'                => _x( 'Testimonials', 'Post Type General Name', 'ig-testimonials' ),
        'singular_name'       => _x( 'Testimonial', 'Post Type Singular Name', 'ig-testimonials' ),
        'menu_name'           => __( 'Testimonials', 'ig-testimonials' ),
        'name_admin_bar'      => __( 'Testimonial', 'ig-testimonials' ),
        'parent_item_colon'   => __( 'Parent Testimonial:', 'ig-testimonials' ),
        'all_items'           => __( 'All Testimonials', 'ig-testimonials' ),
        'add_new_item'        => __( 'Add New Testimonial', 'ig-testimonials' ),
        'add_new'             => __( 'Add New', 'ig-testimonials' ),
        'new_item'            => __( 'New Testimonial', 'ig-testimonials' ),
        'edit_item'           => __( 'Edit Testimonial', 'ig-testimonials' ),
        'update_item'         => __( 'Update Testimonial', 'ig-testimonials' ),
        'view_item'           => __( 'View Testimonial', 'ig-testimonials' ),
        'search_items'        => __( 'Search Testimonial', 'ig-testimonials' ),
        'not_found'           => __( 'Not found', 'ig-testimonials' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'ig-testimonials' ),
    );
    $args = array(
        'label'               => __( 'testimonial', 'ig-testimonials' ),
        'description'         => __( 'Testimonial post type', 'ig-testimonials' ),
        'labels'              => $labels,
        'supports'            => array( 'title', 'editor', 'thumbnail', 'revisions', 'custom-fields', ),
        'taxonomies'          => array( 'testimonial-cat' ),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'menu_icon'           => 'dashicons-format-quote',
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
    );
    register_post_type( 'testimonial', $args );
    flush_rewrite_rules();
}

// Hook into the 'init' action
add_action( 'init', 'ig_testimonials_post_type', 0 );

}

if ( ! function_exists( 'ig_testimonials_custom_taxonomy' ) ) {

// Register Custom Taxonomy
function ig_testimonials_custom_taxonomy() {

    $labels = array(
        'name'                       => _x( 'Testimonial Categories', 'Taxonomy General Name', 'ig-testimonials' ),
        'singular_name'              => _x( 'Testimonial Category', 'Taxonomy Singular Name', 'ig-testimonials' ),
        'menu_name'                  => __( 'Categories', 'ig-testimonials' ),
        'all_items'                  => __( 'All Categories', 'ig-testimonials' ),
        'parent_item'                => __( 'Parent Category', 'ig-testimonials' ),
        'parent_item_colon'          => __( 'Parent Category:', 'ig-testimonials' ),
        'new_item_name'              => __( 'New Category Name', 'ig-testimonials' ),
        'add_new_item'               => __( 'Add New Category', 'ig-testimonials' ),
        'edit_item'                  => __( 'Edit Category', 'ig-testimonials' ),
        'update_item'                => __( 'Update Category', 'ig-testimonials' ),
        'view_item'                  => __( 'View Category', 'ig-testimonials' ),
        'separate_items_with_commas' => __( 'Separate categories with commas', 'ig-testimonials' ),
        'add_or_remove_items'        => __( 'Add or remove categories', 'ig-testimonials' ),
        'choose_from_most_used'      => __( 'Choose from the most used', 'ig-testimonials' ),
        'popular_items'              => __( 'Popular Categories', 'ig-testimonials' ),
        'search_items'               => __( 'Search Categories', 'ig-testimonials' ),
        'not_found'                  => __( 'Not Found', 'ig-testimonials' ),
    );
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
    );
    register_taxonomy( 'testimonial-cat', array( 'testimonial' ), $args );

}

// Hook into the 'init' action
add_action( 'init', 'ig_testimonials_custom_taxonomy', 0 );

}
/* END */
?>
