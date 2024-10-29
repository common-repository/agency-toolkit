<?php
// Standard WP check if direct
if ( ! function_exists( 'add_action' ) ) {
    exit();
}

// Disable Override Admin notices individually and set to hide all the notices
function inspry_toolkit_disable_override_disable_admin_notice() {

    if ( is_admin() && is_user_logged_in() ) {

        $dani_is_active = is_plugin_active( 'disable-admin-notices/disable-admin-notices.php' );

        if  ( $dani_is_active ) {
            update_option( 'wbcr_dan_hide_admin_notices', 'all' );
        }
    }
}
add_action( 'admin_init', 'inspry_toolkit_disable_override_disable_admin_notice' );