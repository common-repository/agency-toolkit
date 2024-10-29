<?php
// Standard WP check if direct
if ( !function_exists( "add_action" ) ) {
    exit();
}

function inspry_toolkit_remove_site_health_dashboard_user(){

    if ( is_admin() && is_user_logged_in() ) {

        if ( get_option( "inspry_toolkit_remove_site_health" ) == 1 && !empty( get_option( "inspry_toolkit_remove_site_health_user_list" ) ) ) {

            if (  !in_array( get_current_user_id(  ), get_option( "inspry_toolkit_remove_site_health_user_list" ) ) ) {

                global $pagenow;

                add_action( "admin_menu",  "inspry_toolkit_remove_site_health_tools" );

                add_action( "wp_dashboard_setup", "inspry_toolkit_remove_site_health_dashboard" );

                if ( $pagenow == "site-health.php" ) {
                    wp_redirect( admin_url(  ) );
                }
            }
        }
    }
}

add_action( "init", "inspry_toolkit_remove_site_health_dashboard_user" );

// Remove site health from dashboard
function inspry_toolkit_remove_site_health_dashboard(){

    global $wp_meta_boxes;

    unset( $wp_meta_boxes["dashboard"]["normal"]["core"]["dashboard_site_health"]  );
}

// Remove site health from tools menu
function inspry_toolkit_remove_site_health_tools(){
    
    remove_submenu_page( "tools.php", "site-health.php" );
}