<?php
//Settings
add_action('admin_menu', 'ig_testimonials_submenu_page');

function ig_testimonials_submenu_page() {
    add_submenu_page( 'edit.php?post_type=testimonial', 'IG Testimonials Settings', 'Settings', 'manage_options', 'ig-testimonials-settings-page', 'ig_testimonials_submenu_page_callback' );
    //call register settings function
    add_action( 'admin_init', 'register_ig_testimonials_settings' );
}

function register_ig_testimonials_settings() {
	//register our settings
	register_setting( 'ig-testimonials-settings-group', 'ig_testimonials_thumb_width' );
	register_setting( 'ig-testimonials-settings-group', 'ig_testimonials_thumb_heigth' );
	register_setting( 'ig-testimonials-settings-group', 'ig_testimonials_carousel_img_width' );
	register_setting( 'ig-testimonials-settings-group', 'ig_testimonials_carousel_img_heigth' );}

function ig_testimonials_submenu_page_callback() {
?>
<div class="wrap">
<h2>IG Testimonials Settings</h2>

<form method="post" action="options.php">
    <?php settings_fields( 'ig-testimonials-settings-group' ); ?>
    <?php do_settings_sections( 'ig-testimonials-settings-group' ); ?>
    <table class="form-table">
        <tr valign="top">
            <th style="margin:0px; padding:0px;"><h3><?php esc_html_e('CAROUSEL SETTINGS', 'ig-testimonials');?></h3></th>
            <td style="margin:0px; padding:0px;"></td>
        </tr>
        <tr valign="top">
        <th scope="row"><?php esc_html_e('Image Width', 'ig-testimonials');?></th>
        <td><input type="text" name="ig_testimonials_thumb_width" value="<?php echo esc_attr( get_option('ig_testimonials_thumb_width', '180') ); ?>" /> px</td>
        </tr>
        <tr valign="top">
        <th scope="row"><?php esc_html_e('Image Height', 'ig-testimonials');?></th>
        <td><input type="text" name="ig_testimonials_thumb_heigth" value="<?php echo esc_attr( get_option('ig_testimonials_thumb_heigth', '180') ); ?>" /> px</td>
        </tr>
        <tr valign="top">
            <th><?php esc_html_e('Testimonials Widget Images', 'ig-testimonials');?></th>
            <td></td>
        </tr>
        <tr valign="top">
        <th scope="row"><?php esc_html_e('Image Width', 'ig-testimonials');?></th>
        <td><input type="text" name="ig_testimonials_carousel_img_width" value="<?php echo esc_attr( get_option('ig_testimonials_carousel_img_width', '600') ); ?>" /> px</td>
        </tr>

        <tr valign="top">
        <th scope="row"><?php esc_html_e('Image Height', 'ig-testimonials');?></th>
        <td><input type="text" name="ig_testimonials_carousel_img_heigth" value="<?php echo esc_attr( get_option('ig_testimonials_carousel_img_heigth', '350') ); ?>" /> px</td>
        </tr>
    </table>
    <p><?php esc_html_e('Remember to regenerate your thumbnails after saved, you can use the free plugin:', 'ig-testimonials');?> <a href="https://wordpress.org/plugins/regenerate-thumbnails/" target="_blank">Regenerate Thumbnails</a></p>
    <?php submit_button(); ?>
</form>

</div>
<?php } ?>
