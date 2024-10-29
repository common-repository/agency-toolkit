<?php
/*
Plugin Name: Agency Toolkit
Description: Lightweight and modular client site tools to empower your agency.
Version: 1.0.22
Author: Inspry
Author URI: https://www.inspry.com/
License: GPL v2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

// Standard WP check if direct
if ( ! function_exists( 'add_action' ) ) {
	exit();
}

// Register activation hook
register_activation_hook( __FILE__, 'inspry_toolkit_activation' );

function inspry_toolkit_activation() {
	// Set transient
	set_transient( 'inspry_toolkit_activation_notification', true, 5 );
}

// Add the activation notificaton
add_action( 'admin_notices', 'inspry_toolkit_activation_notification_notice' );

function inspry_toolkit_activation_notification_notice() {
	// Check for transient
	if ( get_transient( 'inspry_toolkit_activation_notification' ) ) {
		// Transient available, we can delete it now
		delete_transient( 'inspry_toolkit_activation_notification' );
		// Display notification
		?>
		<div class="notice notice-success is-dismissible">
			<p style="font-weight: bold;">Agency Toolkit Activated</p>
			<p>Agency Toolkit plugin has been activated. You may visit your options page <strong><a href="
			<?php
			echo esc_url(
				get_admin_url()
			);
			?>
			admin.php?page=inspry-agency-toolkit">here</a></strong>.</p>
		</div>
		<?php
	}
}

// Include the rescue page file
require plugin_dir_path( __FILE__ ) . 'rescue_feature.php';

// Include Common Funcitons
require plugin_dir_path( __FILE__ ) . 'common_functions.php';

// Include the options page file
require plugin_dir_path( __FILE__ ) . 'options.php';
require plugin_dir_path( __FILE__ ) . 'html/header.php';
require plugin_dir_path( __FILE__ ) . 'html/general.php';
require plugin_dir_path( __FILE__ ) . 'html/performance.php';
require plugin_dir_path( __FILE__ ) . 'html/security.php';
require plugin_dir_path( __FILE__ ) . 'html/email_notifications.php';
require plugin_dir_path( __FILE__ ) . 'html/faqs.php';
require plugin_dir_path( __FILE__ ) . 'html/tools.php';

require plugin_dir_path( __FILE__ ) . 'tools.php';

$plugin_data    = get_file_data( __FILE__, array( 'Version' => 'Version' ), false );
$plugin_version = $plugin_data['Version'];
define( 'INSPRY_TOOLKIT_CURRENT_VERSION', $plugin_version );

$toolkit_all_options = array_merge(
	$toolkit_options,
	$toolkit_security_options,
	$toolkit_performance_options,
	$toolkit_email_notification_options
);

// Loop through options and enable what is enabled
foreach ( $toolkit_all_options as $option ) {

	// Check if the option is enabled
	if ( get_option( 'inspry_toolkit_' . $option['name'] ) == 1 ) {
		// Exclude limit admins file since there is none
		if ( $option['name'] != 'limit_admins' ) {
			// Include the file that option is located in
			include plugin_dir_path( __FILE__ ) . 'functions/' . $option['name'] . '.php';
		}

		// Set Default Host In Manage Environment Indicator
		if ( $option['name'] == 'manage_environment_indicator' ) {

			$dei_host_name = get_option( 'inspry_toolkit_development_environment_host_name' );


			if ( $dei_host_name ) {

				$default_host = $dei_host_name;

			}

			// DISPLAY ENVIRONMENT ON ADMIN BAR ITEMS
			add_action( 'admin_bar_menu', 'inspry_toolkit_display_production_environment_on_admin_bar', 9999 );

			if ( ! function_exists( 'inspry_toolkit_display_production_environment_on_admin_bar' ) ) {

				function inspry_toolkit_display_production_environment_on_admin_bar( WP_Admin_Bar $admin_bar ) {
					$agency_toolkit_access = get_option( 'inspry_toolkit_development_environment_user_list' );

					if ( ! current_user_can( 'manage_options' ) ) {
						return;
					}

					if ( in_array( get_current_user_id(), $agency_toolkit_access ) ) {

						$admin_bar->add_menu(
							array(
								'id'     => 'production-environment-indicator',
								'parent' => null,
								'group'  => null,
								'title'  => 'Production', // you can use img tag with image link. it will show the image icon Instead of the title.
								'href'   => admin_url(
									'admin.php?page=inspry-agency-toolkit'
								),
								'meta'   => array(
									'title' => __( 'Production', 'inspry-toolkit' ), // This title will show on hover
								),
							)
						);
					}
				}
			}

			// Environment Indicator CSS ( Backend/Frontend )
			add_action( 'admin_head', 'inspry_toolkit_environment_indicator_custom_css' );
			add_action( 'wp_head', 'inspry_toolkit_environment_indicator_custom_css' );
			if ( ! function_exists( 'inspry_toolkit_environment_indicator_custom_css' ) ) {

				function inspry_toolkit_environment_indicator_custom_css() {
					?>
					<style>
						#wp-admin-bar-production-environment-indicator {
							background-color: #008000 !important;
						}
					</style>
					<?php
				}
			}
		}
	} else {
		// Check for hard-coded options that we need to disable
		if ( $option['name'] == 'secure_wpconfig' ) {
			// Include the disable function file
			include plugin_dir_path( __FILE__ ) .
				'functions/disable_secure_wpconfig.php';
		}
		if ( $option['name'] == 'stop_user_enumeration' ) {
			// Include the disable function file
			include plugin_dir_path( __FILE__ ) .
				'functions/disable_stop_user_enumeration.php';
		}
		if ( $option['name'] == 'disable_admin_notice' ) {
			// Include the disable function file
			include plugin_dir_path( __FILE__ ) .
				'functions/disable_override_admin_notices.php';
		}
	}
}
?>
