<?php
/*---------------------------------------------------------------------------
 * TESTIMONIALS SHORTCODE
-----------------------------------------------------------------------------*/
function ig_testimonials_shortcode( $atts ) {
    // Attributes
    extract( shortcode_atts(
        array(
            'cat' => '',
            'image' => 'true',
            'perpage' => 12,
            ), $atts )
    );
    // start
    ob_start();
    $paged = get_query_var('paged') ? get_query_var('paged') : 1;
    if ( $cat ) {
        $query = new WP_Query( array(
        'posts_per_page' => $perpage,
        'post_type' => 'testimonial',
        'paged' => $paged,
        'tax_query' => array(
            array(
            'taxonomy' => 'testimonial-cat',
            'field' => 'slug',
            'terms' => array($cat))
            ))
        );
    } else {
        $query = new WP_Query( array(
            'posts_per_page' => $perpage,
            'paged' => $paged,
            'post_type' => 'testimonial')
        );
    };?>

<div class="ig-testimonials-page">
   <?php if ( $query->have_posts() ) {
        while ( $query->have_posts() ) : $query->the_post();
    ?>
        <div id="testimonial-<?php the_ID(); ?>" class="ig-testimonials">

            <?php if ( has_post_thumbnail() && $image=='true') : ?>
                <div class="image">
                        <?php the_post_thumbnail('ig-testimonials-thumb'); ?>
                </div>
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

            <?php //pagination
            $big = 999999999;
            echo paginate_links( array(
                'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                'format' => '?paged=%#%',
                'type'   => 'list',
                'current' => max( 1, get_query_var('paged') ),
                'total' =>  $query->max_num_pages
            ) ); ?>

    <?php  wp_reset_postdata(); ?>
</div>
    <?php $cleanvar = ob_get_clean();
    return $cleanvar;
    }
}
add_shortcode( 'ig-testimonials', 'ig_testimonials_shortcode' );

/*---------------------------------------------------------------------------
 * TESTIMONIALS CAROUSEL SHORTCODE
-----------------------------------------------------------------------------*/
function ig_testimonials_carousel_shortcode( $atts, $content = null ) {
    // Attributes
    extract( shortcode_atts(
        array(
            'cat' => '',
            'perpage' => '12',
            'items' => '1',
            'autoplay' => 'true',
            'image' => 'true',
            'arrows' => 'false',
            'dots' => 'true',
            ), $atts )
    );
    // start
    ob_start();
    if ( $cat ) {
        $query = new WP_Query( array(
        'posts_per_page' => $perpage,
        'post_type' => 'testimonial',
        'tax_query' => array(
            array(
            'taxonomy' => 'testimonial-cat',
            'field' => 'slug',
            'terms' => array($cat))
            ))
        );
    } else {
        $query = new WP_Query( array(
            'posts_per_page' => $perpage,
            'post_type' => 'testimonial')
        );
    };?>

<div class="ig-testimonials-carousel" data-slick='{"slidesToShow":<?php echo esc_attr($items);?>,"dots":<?php echo esc_attr($dots);?>,"arrows":<?php echo esc_attr($arrows);?>,"autoplay":<?php echo esc_attr($autoplay);?>}'>
   <?php if ( $query->have_posts() ) {
             while ( $query->have_posts() ) : $query->the_post();?>
            <div class="ig-testimonials">
            <?php if ( has_post_thumbnail() && $image=='true') : ?>
                <div class="image">
                        <?php the_post_thumbnail('ig-testimonials-thumb'); ?>
                </div>
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
    <?php  $cleanvar = ob_get_clean();
    return $cleanvar;
    }
}
add_shortcode( 'ig-testimonials-carousel', 'ig_testimonials_carousel_shortcode' );
/*************************************************
FIX SHORTCODES HTML TAG
*************************************************/
function ig_testimonials_fix_shortcodes($content){
        $array = array (
            '<p>[' => '[',
            ']</p>' => ']',
            ']<br />' => ']'
        );
        $content = strtr($content, $array);
        return $content;
    }
add_filter('the_content', 'ig_testimonials_fix_shortcodes');
