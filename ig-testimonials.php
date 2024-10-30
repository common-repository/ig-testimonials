<?php
/**
 * Plugin Name:IG Testimonials
 * Plugin URI: http://www.iograficathemes.com/downloads/ig-testimonials
 * Description: IG Testimonials is a clean and simply WordPress plugin for adding Testimonials to your theme, using a shortcode or a widget.
 * Version: 1.8
 * Author: iografica
 * Author URI: http://www.iograficathemes.com/
 * License: GNU General Public License v2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */
 // Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;
//start class
if ( ! class_exists( 'IG_Testimonials' ) ) {
   class IG_Testimonials {
        public function __construct() {
            add_action('wp_enqueue_scripts', array( $this, 'ig_testimonials_scripts' ));
            add_action('admin_enqueue_scripts', array( $this, 'ig_testimonials_admin_enqueue' ));
            add_action('admin_head', array( $this, 'ig_testimonials_mce_button' ));
            /* Includes */
            include ('includes/ig-testimonials-post-type.php');
            include ('includes/ig-testimonials-settings.php');
            include ('includes/ig-testimonials-function.php');
            include ('extra/ig-testimonials-carousel-widget.php');
            include ('extra/ig-testimonials-shortcodes.php');
            include ('welcome/welcome-screen.php');
}
// Add testimonials scripts file
public function ig_testimonials_scripts() {
        wp_enqueue_style('ig-stestimonials-style', plugins_url( 'ig-testimonials.css', __FILE__ ) );
        if ( true != get_option('ig_testimonials_script_style')) {
            wp_register_script('slick', plugins_url( 'js/slick.js', __FILE__ ), array('jquery'),'1.6.0',true );
            wp_enqueue_script( 'slick' );
            wp_register_script('ig-testimonials-carousel', plugins_url( 'js/ig-testimonials-main.js', __FILE__ ), array('jquery'),'',true );
            wp_enqueue_script( 'ig-testimonials-carousel' );
        }
}
//Add admin css
public function ig_testimonials_admin_enqueue($hook) {
    global $ig_testimonials_welcome_page;
    if ( $hook != $ig_testimonials_welcome_page ) {
        return;
    }
    wp_enqueue_style( 'ig-testimonials-admin', plugins_url( 'welcome/css/welcome.css', __FILE__ ) );
}
// Testimonials shortcodes button
public function ig_testimonials_mce_button() {
    // check user permissions
    if ( !current_user_can( 'edit_posts' ) && !current_user_can( 'edit_pages' ) ) {
        return;
    }
    // check if WYSIWYG is enabled
    if ( 'true' == get_user_option( 'rich_editing' ) ) {
        add_filter( 'mce_external_plugins', array( $this, 'ig_testimonials_tinymce_plugin'));
        add_filter( 'mce_buttons', array( $this, 'ig_testimonials_register_mce_button' ));
    }
}
// Declare script for new button
function ig_testimonials_tinymce_plugin( $plugin_array ) {
    $plugin_array['ig_testimonials_mce_button'] = plugins_url('/includes/mce-button.js', __FILE__);
    return $plugin_array;
}
// Register new button in the editor
function ig_testimonials_register_mce_button( $buttons ) {
    array_push( $buttons, 'ig_testimonials_mce_button' );
    return $buttons;
}

        }//end class
    $igtestimonials = new IG_Testimonials();
}//end if class exists

//Load plugin textdomain
function ig_testimonials_load_textdomain() {
  load_plugin_textdomain( 'ig-testimonials', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}
add_action( 'plugins_loaded', 'ig_testimonials_load_textdomain' );
