<?php
/**
 * Welcome Free Resources
 */
?>
<ul class="ig-resources">
    <li class="themes">
        <h3><?php esc_html_e( 'Free themes', 'ig-testimonials' ); ?></h3>
            <?php
            // Set the arguments. For brevity of code, I will use most of the defaults
            $args = array(
                'author' => 'iografica',
            );
            // Make request and extract plug-in object
            $response = wp_remote_post(
            'http://api.wordpress.org/themes/info/1.0/',
            array(
            'body' => array(
                'action' => 'query_themes',
                'request' => serialize((object)$args)
                    )
                )
            );

            if ( !is_wp_error($response) ) {
                $returned_object =  unserialize(wp_remote_retrieve_body($response));
                $theme = $returned_object->themes;
                if ( !is_object($theme) && !is_array($theme) ) {
                // Response body does not contain an object/array
                echo esc_html__('An error has occurred', 'ig-testimonials');
            }
            else {
            // Display a list of the plug-ins and the number of downloads
            if ( $theme ) {
                foreach ( $theme as $theme ) { ?>
                <div class="item">
                    <span class="item-name"><?php echo esc_html($theme->name); ?></span>
                    <!-- Check if the theme is installed -->
                    <?php if( wp_get_theme( $theme->slug )->exists() ) { ?>
                    <!-- Show the tick image notifying the theme is already installed. -->
                    <span class="item-status"><?php esc_html_e( 'installed', 'ig-testimonials' ); ?></span>
                    <?php }	else {
                    // Set the install url for the theme.
                    $install_url = add_query_arg( array(
                    'action' => 'install-theme',
                    'theme'  => $theme->slug,
                    ), self_admin_url( 'update.php' ) );
                    ?>
                    <!-- Install Button -->
                    <span class="item-buttons">
                    <a class="install" href="<?php echo esc_url( wp_nonce_url( $install_url, 'install-theme_' . $theme->slug ) ); ?>" >
                        <?php esc_html_e( 'Install Now', 'ig-testimonials' ); ?>
                    </a>
                    <?php } ?>
                    </span><!-- item-buttons -->
                </div><!-- item -->
           <?php }
            }
        }
    }
    else {
        // Error object returned
        echo esc_html__('An error has occurred', 'ig-testimonials');
    }?>
    </li><!-- themes -->

    <li class="plugins">
    <h3><?php esc_html_e( 'Free plugins', 'ig-testimonials' ); ?></h3>
    <?php
    $args = array(
        'author' => 'iografica',
        'fields' => array(
            'description' => true,
            'downloadlink' => true
        )
    );
    // Make request and extract plug-in object. Action is query_plugins
    $response = wp_remote_post(
        'http://api.wordpress.org/plugins/info/1.0/',
        array(
        'body' => array(
            'action' => 'query_plugins',
            'request' => serialize((object)$args)
            )
        )
    );
    if ( !is_wp_error($response) ) {
        $returned_object = unserialize(wp_remote_retrieve_body($response));
        $plugins = $returned_object->plugins;
        if ( !is_array($plugins) ) {
            // Response body does not contain an object/array
            echo esc_html__('An error has occurred', 'ig-testimonials');
        }
        else {
            // Display a list of the plug-ins and the number of downloads
            if ( $plugins ) {
                foreach ( $plugins as $plugin ) { ?>
        <div class="item">
            <span class="item-name">
                <?php echo esc_html($plugin->name) ?>
            </span><!-- item-name -->
            <span class="item-buttons">
                <a class="download" target="_blank" href="<?php echo esc_url($plugin->download_link); ?>">
                    <?php esc_html_e( 'Download Now', 'ig-testimonials' ); ?>
                </a>
            </span><!-- item-buttons -->
        </div><!-- item -->
            <?php }
        }
    }
}
else {
    // Error object returned
        echo esc_html__('An error has occurred', 'ig-testimonials');
}
    ?>
    </li><!-- plugins -->
</ul><!-- ig-intro -->
