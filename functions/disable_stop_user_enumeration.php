<?php
// Standard WP check if direct
if ( ! function_exists( 'add_action' ) ) {
	exit();
}

// Set up delete to user enum rule function
function inspry_toolkit_delete_stop_user_enumeration_rule() {

	// Get the file
	$htaccess_file_path  = ABSPATH . '.htaccess';
	$htaccess_file       = file_get_contents( $htaccess_file_path );
	$site_url            = site_url();
	$htaccess_search_for = '# AGENCY TOOLKIT - STOP USER ENUM' . "\n" . '<IfModule mod_rewrite.c>' . "\n" . 'RewriteCond %{REQUEST_URI}  ^/$' . "\n" . 'RewriteCond %{QUERY_STRING} ^/?author=([0-9]*)' . "\n" . 'RewriteRule ^(.*)$ ' . $site_url . '? [L,R=301]' . "\n" . '</IfModule>';
	$htaccess_file_new   = str_replace( $htaccess_search_for, '', $htaccess_file );
	if ( ! empty( $htaccess_file_new ) ) {
		// Replace file contents
		file_put_contents( $htaccess_file_path, $htaccess_file_new );
	}
}

function inspry_toolkit_check_user_enum_rule() {

	$htaccess_file_path  = ABSPATH . '.htaccess';
	$htaccess_search_for = '# AGENCY TOOLKIT - STOP USER ENUM';
	$htaccess_file       = file_get_contents( $htaccess_file_path );

	if ( strpos( $htaccess_file, $htaccess_search_for ) !== false ) {
		return true;
	} else {
		return false;
	}
}

// Make sure we haven't already written the rule.
function inspry_toolkit_run_stop_user_emun_rule() {

	if ( ! is_admin() ) {

		// default URL format.
		if ( isset( $_SERVER['QUERY_STRING'] ) && preg_match( '/author=([0-9]*)/i', $_SERVER['QUERY_STRING'] ) ) {
			die();
		}
		add_filter( 'redirect_canonical', 'inspry_toolkit_check_enum', 10, 2 );
	}
	/**
	 * Checks for enun.
	 *
	 * @param url        $redirect url to redirect.
	 * @param WP_Request $request WP request.
	 * @return string.
	 */
	function inspry_toolkit_check_enum( $redirect, $request ) {
		// permalink URL format.
		if ( preg_match( '/\?author=([0-9]*)(\/*)/i', $request ) ) {
			die();
		} else {
			return $redirect;
		}
	}

	if ( inspry_toolkit_check_user_enum_rule() ) {

		// Write the rule.
		inspry_toolkit_delete_stop_user_enumeration_rule();
	}
}
add_action( 'init', 'inspry_toolkit_run_stop_user_emun_rule' );
