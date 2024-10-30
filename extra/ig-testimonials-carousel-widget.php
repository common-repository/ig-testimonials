<?php
//Add widget class
class ig_testimonials_carousel_widget extends WP_Widget {

//Register widget with WordPress.
function __construct() {
    parent::__construct(
        'ig_testimonials_carousel_widget', // Base ID
        esc_html__('IG Testimonials Carousel', 'ig-testimonials'), // Name
        array(
            'description' => esc_html__('Display a carousel with your testimonials', 'ig-testimonials' ),
        ) // Args
    );
}
//Front-end display of widget.
public function widget( $args, $instance ) {
        $cat = isset( $instance[ 'testimonial_cat' ]) ? esc_attr( $instance['testimonial_cat'] ) : '';
        $showposts = isset( $instance[ 'show_posts' ]) ? esc_attr( $instance['show_posts'] ) : '';
        $show_image = isset( $instance[ 'show_image' ]) ? esc_attr( $instance['show_image'] ) : '';
        $show_dots = isset( $instance[ 'show_dots' ]) ? esc_attr( $instance['show_dots'] ) : '';
        $show_nav = isset( $instance[ 'show_nav' ]) ? esc_attr( $instance['show_nav'] ) : '';
        $start_autoplay = isset( $instance[ 'start_autoplay' ]) ? esc_attr( $instance['start_autoplay'] ) : '';
        $slide_show = isset( $instance[ 'slide_show' ]) ? esc_attr( $instance['slide_show'] ) : '';

        echo $args['before_widget'];
        if ( ! empty( $instance['title'] ) ) {
            echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
        }

?>
<div class="ig-testimonials-carousel" data-slick='{"slidesToShow":<?php echo esc_attr($slide_show);?>,"dots":<?php if ($show_dots) { echo "true";} else {echo "false";} ;?>,"arrows":<?php if ($show_nav) { echo "true";} else {echo "false";} ;?>,"autoplay":<?php if ($start_autoplay) { echo "true";} else {echo "false";} ;?>}'>
    <?php
    if ( empty ( $instance['testimonial_cat'] ) ) {
            $testimonial_query = new WP_Query();
            $testimonial_query->query( array(
    'showposts' => $showposts,
    'post_status' => 'publish',
    'post_type' => 'testimonial')
    );
    } else {
            $testimonial_query = new WP_Query();
            $testimonial_query->query( array(
    'showposts' => $showposts,
    'post_status' => 'publish',
    'post_type' => 'testimonial',
    'tax_query' => array(
        array(
        'taxonomy' => 'testimonial-cat',
        'field' => 'slug',
        'terms' => array($cat)
        )
    ))
);
    }
            while ($testimonial_query->have_posts()) : $testimonial_query->the_post();

        ?>

            <div id="testimonial-<?php the_ID(); ?>" class="ig-testimonials item">

        <?php if ( $show_image ) : ?>
            <?php if ( has_post_thumbnail()) : ?>
                <div class="image">
                        <?php the_post_thumbnail('ig-testimonials-carousel-img'); ?>
                </div>
            <?php endif; ?>
        <?php endif; ?>

                <div class="text">
                    <?php the_content();?>
                </div>

            <?php if ( ig_testimonials_get_meta( 'ig_testimonials_name' ) ) : ;?>
                <span class="name">
                    <strong> <?php echo ig_testimonials_get_meta( 'ig_testimonials_name' );?></strong>
                </span>
            <?php endif ;?>

            <?php if ( ig_testimonials_get_meta( 'ig_testimonials_job' ) ) : ;?>
                <span class="job">
                    <?php echo ig_testimonials_get_meta( 'ig_testimonials_job' ); ?>
                </span>
            <?php endif ;?>

            <?php if ( ig_testimonials_get_meta( 'ig_testimonials_website' ) ) : ;?>
                <span class="website">
                <a href="<?php echo esc_url(ig_testimonials_get_meta('ig_testimonials_website')); ?>" rel="nofollow">
                    <?php esc_html_e('Website', 'ig-testimonials'); ?>
                </a>
                </span>
            <?php endif ;?>

            </div>
        <?php endwhile; ?>
        <?php wp_reset_postdata(); ?>
   </div>
<?php
        echo $args['after_widget'];
    }
/**
* Back-end widget form.
**/
public function form( $instance ) {
    $title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
    $cat = isset( $instance[ 'testimonial_cat' ]) ? esc_attr( $instance['testimonial_cat'] ) : '';
    $showposts = isset( $instance[ 'show_posts' ]) ? esc_attr( $instance['show_posts'] ) : '12';
    $show_image = isset( $instance[ 'show_image' ]) ? esc_attr( $instance['show_image'] ) : '1';
    $show_dots = isset( $instance[ 'show_dots' ]) ? esc_attr( $instance['show_dots'] ) : '1';
    $show_nav = isset( $instance[ 'show_nav' ]) ? esc_attr( $instance['show_nav'] ) : '';
    $start_autoplay = isset( $instance[ 'start_autoplay' ]) ? esc_attr( $instance['start_autoplay'] ) : '1';
    $slide_show = isset( $instance[ 'slide_show' ]) ? esc_attr( $instance['slide_show'] ) : '1';
?>
<p>
    <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
</p>
<p>
<p>
    <input class="checkbox" type="checkbox" value="1" <?php checked( '1', $show_image ); ?> id="<?php echo $this->get_field_id( 'show_image' ); ?>" name="<?php echo $this->get_field_name( 'show_image' ); ?>" />
    <label for="<?php echo $this->get_field_id( 'show_image' ); ?>"><?php esc_html_e( 'Display testimonial image?', 'ig-testimonials' ); ?></label>
</p>
<p>
    <input class="checkbox" type="checkbox" value="1" <?php checked( '1', $show_dots ); ?> id="<?php echo $this->get_field_id( 'show_dots' ); ?>" name="<?php echo $this->get_field_name( 'show_dots' ); ?>" />
    <label for="<?php echo $this->get_field_id( 'show_dots' ); ?>"><?php esc_html_e( 'Display dots navigation?', 'ig-testimonials' ); ?></label>
</p>
<p>
    <input class="checkbox" type="checkbox" value="1" <?php checked( '1', $show_nav ); ?> id="<?php echo $this->get_field_id( 'show_nav' ); ?>" name="<?php echo $this->get_field_name( 'show_nav' ); ?>" />
    <label for="<?php echo $this->get_field_id( 'show_nav' ); ?>"><?php esc_html_e( 'Display arrow navigation?', 'ig-testimonials' ); ?></label>
</p>
<p>
    <input class="checkbox" type="checkbox" value="1" <?php checked( '1', $start_autoplay ); ?> id="<?php echo $this->get_field_id( 'start_autoplay' ); ?>" name="<?php echo $this->get_field_name( 'start_autoplay' ); ?>" />
    <label for="<?php echo $this->get_field_id( 'start_autoplay' ); ?>"><?php esc_html_e( 'Autoplay?', 'ig-testimonials' ); ?></label>
</p>
<p>
<label for="<?php echo $this->get_field_id( 'slide_show' ); ?>"><?php _e( 'Number of testimonials to show in a slide:' ); ?></label>
<input class="widefat" id="<?php echo $this->get_field_id( 'slide_show' ); ?>" name="<?php echo $this->get_field_name( 'slide_show' ); ?>" type="number" step="1" min="1" value="<?php echo $slide_show; ?>">
</p>
<p>
<label for="<?php echo $this->get_field_id( 'show_posts' ); ?>"><?php _e( 'Number of testimonials to show:' ); ?></label>
<input class="widefat" id="<?php echo $this->get_field_id( 'show_posts' ); ?>" name="<?php echo $this->get_field_name( 'show_posts' ); ?>" type="number" step="1" min="1" value="<?php echo $showposts; ?>">
</p>
<p>
<label for="<?php echo $this->get_field_id( 'testimonial_cat' ); ?>"><?php _e( 'Show categories:' ); ?></label>
<input class="widefat" id="<?php echo $this->get_field_id( 'testimonial_cat' ); ?>" name="<?php echo $this->get_field_name( 'testimonial_cat' ); ?>" type="text" value="<?php echo $cat; ?>">
</p>
<?php
}
/**
* Sanitize widget form values as they are saved.
**/
public function update( $new_instance, $old_instance ) {
    $instance = array();
    $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
    $instance['testimonial_cat'] = ( ! empty( $new_instance['testimonial_cat'] ) ) ? strip_tags( $new_instance['testimonial_cat'] ) : '';
    $instance['show_posts'] = ( ! empty( $new_instance['show_posts'] ) ) ? strip_tags( $new_instance['show_posts'] ) : '';
    $instance['show_image'] = ( ! empty( $new_instance['show_image'] ) ) ? strip_tags( $new_instance['show_image'] ) : '';
    $instance['show_dots'] = ( ! empty( $new_instance['show_dots'] ) ) ? strip_tags( $new_instance['show_dots'] ) : '';
    $instance['show_nav'] = ( ! empty( $new_instance['show_nav'] ) ) ? strip_tags( $new_instance['show_nav'] ) : '';
    $instance['start_autoplay'] = ( ! empty( $new_instance['start_autoplay'] ) ) ? strip_tags( $new_instance['start_autoplay'] ) : '';
    $instance['slide_show'] = ( ! empty( $new_instance['slide_show'] ) ) ? strip_tags( $new_instance['slide_show'] ) : '';

return $instance;
    }
} // Class ends here

// Register and load the widget
function ig_testimonials_load_widget() {
    register_widget( 'ig_testimonials_carousel_widget' );
}
add_action( 'widgets_init', 'ig_testimonials_load_widget' );
