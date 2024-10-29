<?php
// Standard WP check if direct
if ( ! function_exists( 'add_action' ) ) {
	exit();
}

// Disable update notifications - plugins
add_filter( 'auto_plugin_update_send_email', '__return_false' );

// Disable update notifications - themes
add_filter( 'auto_theme_update_send_email', '__return_false' );

// Disable Admin Notification of User Password Change
remove_action( 'after_password_reset', 'wp_password_change_notification' );

// Disable WooCommerce Admin Notification of User Password Change
add_filter('woocommerce_disable_password_change_notification', function() {
	return true;
});

// Disable update notifications - WP Core
add_filter( 'auto_core_update_send_email', 'inspry_toolkit_stop_update_emails', 10, 4 );
function inspry_toolkit_stop_update_emails( $send, $type, $core_update, $result ) {
	if ( ! empty( $type ) && $type == 'success' ) {
		return false;
	}
	return true;
}

// Disable Admin Notification of User Password Change; Backup function
if ( ! function_exists( 'wp_password_change_notification' ) ) {
	function wp_password_change_notification( $user ) {
		return;
	}
}

// Disable Admin Notification of User User notification
if ( ! function_exists( 'wp_new_user_notification' ) ) :
	function wp_new_user_notification( $user_id, $deprecated = null, $notify = '' ) {
		return;
	}
endif;
