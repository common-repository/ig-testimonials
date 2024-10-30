<?php
/**
 * Welcome Intro
 */
?>
    <ul class="ig-intro">
        <li class="evidence">
            <h2><?php esc_html_e('Settings', 'ig-shortcodes') ?></h3>
            <p><?php esc_html_e( 'Ready to get started? Start to customize and setup your plugin in the settings page.', 'ig-shortcodes' ); ?></p>
            <a href="<?php echo admin_url('edit.php?post_type=testimonial&page=ig-testimonials-settings-page'); ?>" target="_blank" class="button-upgrade">
                <?php esc_html_e( 'Go to settings page', 'ig-shortcodes' ); ?>
            </a>
        </li>
        <li>
            <h2><?php esc_html_e('Documentation', 'ig-shortcodes') ?></h3>
            <p><?php esc_html_e('Learn more about your new plugin, visit our website to read the plugin documentation.', 'ig-shortcodes') ?></p>
            <a href="http://www.iograficathemes.com/documentation/ig-testimonials/" target="_blank" class="button">
                <?php esc_html_e( 'Read the documentation', 'ig-shortcodes' ); ?>
            </a>
        </li>
    </ul>