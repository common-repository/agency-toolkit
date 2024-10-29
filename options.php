<?php
// Standard WP check if direct
if ( !function_exists( 'add_action' ) ) {
    exit();
}

// Create all option settings
$toolkit_performance_options = array( 
    array( 
        'name' => 'limit_post_revisions',
        'description' => 'Limit or disable post revisions',
        'details' => 'Limit post revisions to improve database efficiency. This all applies to all post types.'
    ),
    array( 
        'name' => 'disable_emoticons',
        'description' => 'Disable emoticons',
        'details' => 'Stops the WordPress core emoticons Javascript files from loading.  Ensure you are not using these emoticons on your frontend.'

    ),
    array( 
        'name' => 'disable_pingback_trackback_emails',
        'description' => 'Disable pingback and trackback notification emails',
        'details' => 'Stops potential spam by disabling WordPress pingback and trackbacks including on existing posts.'

    ),
    array( 
        'name' => 'disable_self_pingback',
        'description' => 'Disable self-pingbacks',
        'details' => 'Stops pinging from your own website / domain.'

    ),
    array( 
        'name' => 'disable_xml_rpc',
        'description' => 'Disable XML-RPC',
        'details' => 'Disable this legacy core WordPress API entirely to prevent malicious activity.   Ensure you do not have any services using the service.'

    ),
    array( 
        'name' => 'disable_media_comments',
        'description' => 'Disable Media Comments',
        'details' => ' Removes the comments field from all media attachments to prevent spam.'

    ),
    array( 
        'name' => 'remove_rsd_links',
        'description' => 'Remove RSD links',
        'details' => 'Removes the Really Simple Discovery service endpoint.'

    ),   
    
 ); 

$toolkit_security_options = array( 
    array( 
        'name' => 'disable_editors',
        'description' => 'Disable theme and plugin editors',
        'details' => 'Disable the theme and plugin code editors from all WordPress users.'

    ),
    array( 
        'name' => 'disable_installs_and_updates',
        'description' => 'Limit the users who can install and update plugins and themes',
        'details' => 'Limit the WordPress users who can install and update plugins and themes.'

    ),
    array( 
        'name' => 'hide_wordpress_version',
        'description' => 'Hide WordPress version generator in front-end source code',
        'details' => 'Hides the WordPress version generator in the frontend source code.'

    ),
    array( 
        'name' => 'remove_site_health',
        'description' => 'Limit the users who can view Site Health',
        'details' => 'Limit the WordPress users who can view Site Health.'

    ),
    array( 
        'name' => 'secure_wpconfig',
        'description' => 'Secure the wp-config.php file using .htaccess',
        'details' => 'Hardens the wp-config.php against attacks using .htaccess. Ensure your server supports .htaccess and use with caution as may break in some server environments.'

    ),
    array( 

        'name' => 'stop_user_enumeration',
        'description' => 'Stop User Enumeration using .htaccess',
        'details' => 'Prevent user enumeration to protect your login names at the basic level.'
        
    ),
    array( 
        'name' => 'checksum_verification_for_wordpress_core_files',
        'description' => 'Checksum verification for WordPress core files',
        'details' => ' Checks your WordPress core files against the official checksums daily to detect any suspicious core modifications.'

    ),
      
    array( 
        'name' => 'limit_users_modify_admin_email',
        'description' => 'Limit users who can modify Admin Email Address',
        'details' => 'Limit which WordPress users can modify the Admin Email Address in the WordPress General Options panel.'

    ),
    array( 
        'name' => 'disable_admin_notice',
        'description' => 'Override the <a href="https://wordpress.org/plugins/disable-admin-notices/" target="_blank">Disable Admin Notices Individually</a> plugin to show all admin notices',
        'details' => 'Override the Disable Admin Notices Individually plugin to show all admin notices for specific WordPress users.  Requires the Disable Admin Notices Individually plugin to be installed.'

    ),
 ); 

$toolkit_email_notification_options = array( 
    array( 
        'name' => 'disable_auto_update_emails',
        'description' => 'Disable admin notification emails',
        'details' => 'Stop admin notification emails from being sent including new user, password change, and automatic WordPress update notifications.'
        ),
    array( 
        'name' => 'change_email_sender',
        'description' => 'Globally change email sender',
        'details' => 'Globally override all WordPress emails to originate from a specified email address instead of the default admin email.  Note may not override all plugins.'
        ),
    array( 
        'name' => 'disable_admin_email_verification',
        'description' => 'Disable WordPress Admin Email Verification prompt',
        'details' => 'Stops the prompt that routinely asks admins to verify their email after sign-in.'
        ),
    array( 
        'name' => 'change_user_notifications_email',
        'description' => 'Change admin email address shared in user emails',
        'details' => 'Changes the admin email listed in user emails ( such as password resets ) to a specified email instead of the default admin email.'
        ),
    array( 
        'name' => 'enable_plugin_update_admin_notifications',
        'description' => 'Receive email notifications when specific plugins are updated',
        'details' => 'Sends an email notification to specified email addresses every time selected plugins are updated.  '
        ),
 );

$toolkit_options = array( 
    array( 
        'name' => 'limit_admins',
        'description' => 'Limit the users who can view the Agency Toolkit Settings Page',
        'details' => 'Limit the WordPress users who can view and modify the Agency Toolkit settings.'

    ),
    array( 
        'name' => 'maintenance_mode',
        'description' => 'Enable maintenance mode',
        'details' => 'Activates maintenance mode for non-logged users on the frontend website, instead displaying a custom message.'

    ),
    array( 
        'name' => 'backend_footer',
        'description' => 'Enable a custom agency footer with a name, URL and email in the WordPress Dashboard',
        'details' => ' Enable a custom footer with your company name, URL and email address in the WordPress Dashboard footer.'

    ),
    array( 
        'name' => 'backend_logo',
        'description' => 'Enable a custom agency logo on the WordPress login screen',
        'details' => 'Enable a custom image logo on the WordPress Dashboard login screen.'

    ),
    array( 
        'name' => 'manage_environment_indicator',
        'description' => 'Show Environment Indicator in Admin Bar',
        'details' => 'Activates the environment indicator in the logged-in admin bar to clearly show if this is a staging or production website.'

    ),
 );

// Add options menu
function inspry_toolkit_options_menu_item(){
   
    $agency_toolkit_access = get_option( 'inspry_toolkit_limit_admins_list' );
    if ( is_admin() && ( empty( $agency_toolkit_access ) || in_array( get_current_user_id(), $agency_toolkit_access ) ) ) {

        $icon_url = plugin_dir_url( __DIR__ ).'agency-toolkit/assets/images/agency-toolkit-white-logo.svg';
        add_menu_page( 'Agency Toolkit Options', 'Agency Toolkit', 'manage_options', 'inspry-agency-toolkit', 'inspry_toolkit_options_page', "$icon_url", 80 );
        add_submenu_page(  'inspry_toolkit_options_page', 'FAQs', 'FAQs', 'manage_options', 'inspry-toolkit-faqs', 'inspry_toolkit_faqs' );
    } else {

        if ( isset( $_GET[ 'page' ] )  && $_GET[ 'page' ] == 'inspry-agency-toolkit' ) {
            wp_redirect( admin_url() );
            exit;
        }
        
    }
}
add_action( 'admin_menu', 'inspry_toolkit_options_menu_item' );

// Register options
function inspry_toolkit_options_register(){
   
    // Get options
    global $toolkit_options;
    global $toolkit_performance_options;
    global $toolkit_security_options;
    global $toolkit_email_notification_options;
    

    // Loop through each option to register
    foreach ( $toolkit_options as $option ) {
        // Register the option
        register_setting( 'inspry_toolkit_options_group', 'inspry_toolkit_' . $option[ "name" ] );
    }

    foreach ( $toolkit_performance_options as $option ) {
        // Register the option
        register_setting( 'inspry_toolkit_options_group', 'inspry_toolkit_' . $option[ "name" ] );
    }

    foreach ( $toolkit_security_options as $option ) {
        // Register the option
        register_setting( 'inspry_toolkit_options_group', 'inspry_toolkit_' . $option[ "name" ] );
    }

    foreach ( $toolkit_email_notification_options as $option ) {
        // Register the option
        register_setting( 'inspry_toolkit_options_group', 'inspry_toolkit_' . $option[ "name" ] );
    }

    // Add custom settings as well
    register_setting( 'inspry_toolkit_options_group', 'inspry_toolkit_backend_footer_agency_name' );
    register_setting( 'inspry_toolkit_options_group', 'inspry_toolkit_backend_footer_agency_url' );
    register_setting( 'inspry_toolkit_options_group', 'inspry_toolkit_backend_footer_agency_email' );
    register_setting( 'inspry_toolkit_options_group', 'inspry_toolkit_backend_logo_image' );
    register_setting( 'inspry_toolkit_options_group', 'inspry_toolkit_limit_post_revisions_number' );
    register_setting( 'inspry_toolkit_options_group', 'inspry_toolkit_limit_admins' );
    register_setting( 'inspry_toolkit_options_group', 'inspry_toolkit_limit_admins_list' );
    register_setting( 'inspry_toolkit_options_group', 'inspry_toolkit_maintenance_mode_heading' );
    register_setting( 'inspry_toolkit_options_group', 'inspry_toolkit_maintenance_mode_sentence' );
    register_setting( 'inspry_toolkit_options_group', 'inspry_toolkit_change_email_sender_address' );
    register_setting( 'inspry_toolkit_options_group', 'inspry_toolkit_change_email_sender_name' );
    register_setting( 'inspry_toolkit_options_group', 'inspry_toolkit_disable_installs_and_updates' );
    register_setting( 'inspry_toolkit_options_group', 'inspry_toolkit_disable_installs_and_updates_list' );
    register_setting( 'inspry_toolkit_options_group', 'inspry_toolkit_enable_plugin_update_admin_notifications' );
    register_setting( 'inspry_toolkit_options_group', 'inspry_toolkit_enable_plugin_update_admin_notifications_list' );
    register_setting( 'inspry_toolkit_options_group', 'inspry_toolkit_enable_plugin_update_admin_notifications_plugin_list' );
    register_setting( 'inspry_toolkit_options_group', 'inspry_toolkit_change_user_notifications_email_sender' );
    register_setting( 'inspry_toolkit_options_group', 'inspry_toolkit_stop_user_enumeration' );
    register_setting( 'inspry_toolkit_options_group', 'inspry_toolkit_checksum_verification_for_wordpress_core_files' );
    register_setting( 'inspry_toolkit_options_group', 'inspry_toolkit_checksum_verification_for_wordpress_core_files_email_send' );
    register_setting( 'inspry_toolkit_options_group', 'inspry_toolkit_remove_site_health' );
    register_setting( 'inspry_toolkit_options_group', 'inspry_toolkit_remove_site_health_user_list' );
    register_setting( 'inspry_toolkit_options_group', 'inspry_toolkit_disable_media_comments' );
    register_setting( 'inspry_toolkit_options_group', 'inspry_toolkit_limit_users_modify_admin_email_user_list' );
    register_setting( 'inspry_toolkit_options_group', 'inspry_toolkit_limit_users_modify_admin_email' );
    register_setting( 'inspry_toolkit_options_group', 'inspry_toolkit_disable_admin_notice_user_list' );
    register_setting( 'inspry_toolkit_options_group', 'inspry_toolkit_disable_admin_notice' );
    register_setting( 'inspry_toolkit_options_group', 'inspry_toolkit_development_environment_user_list' );
    register_setting( 'inspry_toolkit_options_group', 'inspry_toolkit_development_environment_host_name' );
    register_setting( 'inspry_toolkit_options_group', 'inspry_toolkit_manage_development_environment_banner_color' );

}
add_action( 'admin_init', 'inspry_toolkit_options_register' );

// Include media uploader script function
function inspry_toolkit_options_page_enqueue( $hook ){
   
	if( $hook == 'toplevel_page_inspry-agency-toolkit' || $hook == 'admin_page_inspry-toolkit-faqs' ){
        
		wp_enqueue_media();
        wp_register_script( 'inspry_toolkit_select2_full', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js', array( 'jquery' ), time() );
		wp_enqueue_script( 'inspry_toolkit_select2_full' );
        
		wp_register_script( 'inspry_toolkit_options_page_script', plugins_url( 'assets/js/options-page-script.js', __FILE__ ), array( 'jquery' ), time() );
		wp_enqueue_script( 'inspry_toolkit_options_page_script' );

		wp_register_script( 'inspry_toolkit_form_validation_script', plugins_url( 'assets/js/form-validation-script.js', __FILE__ ), array( 'jquery' ), time(), true );
		wp_enqueue_script( 'inspry_toolkit_form_validation_script' );

        wp_register_style( 'inspry_toolkit_select2_min', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css' , false, time() );
		wp_enqueue_style( 'inspry_toolkit_select2_min' );

		wp_register_style( 'inspry_toolkit_options_page_style', plugins_url( 'assets/css/options-page-style.css', __FILE__ ) , false, time() );
		wp_enqueue_style( 'inspry_toolkit_options_page_style' );
	}	
}
add_action( 'admin_enqueue_scripts', 'inspry_toolkit_options_page_enqueue' );


// Add settings page content
function inspry_toolkit_options_page(){

    // Check if user is admin
    if ( is_admin() ) {

        // Check if limit admins option is enabled and that list is not empty ( to avoid an admin locking themselves out )
        if ( get_option( 'inspry_toolkit_limit_admins' ) == 1 && !empty( get_option( 'inspry_toolkit_limit_admins_list' ) ) ) {
            // Check if this admin is included in the array
            if ( in_array( get_current_user_id(), get_option( 'inspry_toolkit_limit_admins_list' ) ) ) {
                // Limit admins enabled and user is in list, display page
                inspry_toolkit_options_page_html();
            } else {
                // Limit admins enabled and user is not in list, display error
               inspry_toolkit_options_page_error();
            }
        } else {
            // Limit admins disabled and this user is an admin, display page
            inspry_toolkit_options_page_html();
        }
    } else {
        // User is not an admin role, display error
        inspry_toolkit_options_page_error();
    }
}



// Options page HTML and JS
function inspry_toolkit_options_page_html(){

?>

    <div class="atp-option">
		<?php inspry_toolkit_page_header_html();?>

		<div class="atp-body-content">
		
				<div class="atp-head">
					<h1 class="atp-heding">Options</h1>
					<div>
                         <?php submit_button( __( 'Save Changes' ), "atp_submit_form_button" );?>
					</div>
				</div>
				<div class="atp-tab-content">
					<div class="atp-radio-tabs">
					
						<input class="atp-state" type="radio" title="General" name="input-state" id="radio1" checked />
						<input class="atp-state" type="radio" title="Security" name="input-state" id="radio2" />
						<input class="atp-state" type="radio" title="Performance" name="input-state" id="radio3" />
						<input class="atp-state" type="radio" title="Email Notifications" name="input-state" id="radio4" />
						<input class="atp-state" type="radio" title="Tools" name="input-state" id="radio5" />

						<div class="atp-tabs">
							<label for="radio1" id="first-tab" class="atp-tab">
								<div class="tab-label">General</div>
							</label>
							<label for="radio2" id="second-tab" class="atp-tab">
								<div  class="tab-label">Security</div>
							</label>
							<label for="radio3" id="third-tab" class="atp-tab">
								<div  class="tab-label">Performance</div>
							</label>
							<label for="radio4" id="fourth-tab" class="atp-tab">
								<div  class="tab-label">Email Notifications</div>
							</label>
							<label for="radio5" id="fifth-tab" class="atp-tab">
								<div  class="tab-label">Tools</div>
							</label>
							
						</div>

						<div class="atp-panels">

                            <form  method="post" action="options.php" id="inspry_toolkit_options_form">

                                <?php settings_fields( 'inspry_toolkit_options_group' ); ?>
                                <?php do_settings_sections( 'inspry_toolkit_options_group' ); ?>

                                <?php inspry_toolkit_general_options_html(); ?>

                                <?php inspry_toolkit_security_options_html(); ?>

                                <?php inspry_toolkit_performance_options_html(); ?>

                                <?php inspry_toolkit_email_notification_options_html(); ?>      

                            </form>

                            <?php inspry_toolkit_tools_options_html(); ?>    
						</div>

					</div>
				</div>
		</div>
    </div>
<?php
}


// Options error page HTML
function inspry_toolkit_options_page_error(){ ?>

        <h1>Not authorized</h1>
        <p>You are not authorized to view this page. Please contact the site admin for more information.</p>
    <?php
}