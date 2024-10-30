<?php
/**
 * Welcome Screen Class
 */
add_action('admin_menu', 'ig_testimonials_submenu_welcome_page');

function ig_testimonials_submenu_welcome_page() {
    global $ig_testimonials_welcome_page;
    $ig_testimonials_welcome_page = add_submenu_page( 'edit.php?post_type=testimonial', 'IG Testimonials', 'Getting Started', 'manage_options', 'ig-testimonials-getting-started', 'ig_testimonials_submenu_welcome_page_callback' );
}
function ig_testimonials_submenu_welcome_page_callback() {
?>

<div class="wrap about-wrap">
        <h1><?php echo IG_TESTIMONIALS_NAME; ?><sup style="font-size:14px; margin-left:5px;"><?php echo IG_TESTIMONIALS_VERSION; ?></sup></h1>
        <p><?php esc_html_e( 'Thank you to use our plugin for your website.', 'ig-testimonials'); ?></p>
<?php include ('sections/welcome-intro.php'); ?>
<?php include ('sections/welcome-free-resources.php'); ?>
<?php include ('sections/welcome-footer.php'); ?>
</div>
<?php } ?>