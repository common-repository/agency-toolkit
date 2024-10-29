<?php
// Standard WP check if direct
if (!function_exists('add_action')) {
    exit();
}

//Override Disable admin notices induvidually plugin for selected users
add_action( 'admin_init' , 'inspry_toolkit_disable_admin_notice_dashboard' );
function inspry_toolkit_disable_admin_notice_dashboard(){

    if ( is_admin() && is_user_logged_in() ) {

        $dani_is_active = is_plugin_active( 'disable-admin-notices/disable-admin-notices.php' );

        if ( get_option( 'inspry_toolkit_disable_admin_notice' ) == 1 && ! empty( get_option( 'inspry_toolkit_disable_admin_notice_user_list' ) ) ) {
                
            $user_ids = get_option( 'inspry_toolkit_disable_admin_notice_user_list' );

            if (!empty( $user_ids ) ){
                
                if ( in_array( get_current_user_id(), $user_ids )  ){

                    if  ( $dani_is_active ) {
                        update_option( 'wbcr_dan_hide_admin_notices', 'not_hide' );       
                    }
                } else {

                    if  ( $dani_is_active ) {
                        update_option( 'wbcr_dan_hide_admin_notices', 'all' );
                    }
                }
                
            } else {

                if  ( $dani_is_active ) {
                    update_option( 'wbcr_dan_hide_admin_notices', 'all' );
                }
            }
        }  
    }
}