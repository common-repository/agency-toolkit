<?php

// Standard WP check if direct
if ( !function_exists( "add_action" ) ) {
    exit(  );
}

// Send users email notification on plugin updates
function inspry_toolkit_send_admin_notification( $plugins_list_arr, $users_ids )
{
    if ( !empty( $plugins_list_arr ) && !empty( $users_ids ) ) {
       
        $all_admins = get_users( [
            "role" => "administrator",
            "order" => "ASC",
            "orderby" => "ID",
        ] );

        //Loop through all admins
        foreach ( $all_admins as $admin_user ) {
            
            //Keep those are selected from sending the notification
            if ( in_array( $admin_user->ID, $users_ids ) ) {
                $to = $admin_user->user_email;

                $site_title = get_bloginfo( "name" );

                $subject = "Plugins updated on " . $site_title;

                $plugin_names = implode( ", ", $plugins_list_arr );

                $updated_time = wp_date( "m-d-Y h:i:s a" );

                $mail_body =
                    "Just a heads up, <b> " .
                    $plugin_names .
                    " </b> was updated at " .
                    $updated_time .
                    ", be on the lookout!";

                $headers = ["Content-Type: text/html; charset=UTF-8"];

                wp_mail( $to, $subject, $mail_body, $headers );
            }
        }
    }
}

// Find out selected plugins and admin users to send notification
function inspry_toolkit_plugin_update_admin_notification( $upgrader_object, $options ) {

    //Check for selected option and plugins
    if ( get_option( "inspry_toolkit_enable_plugin_update_admin_notifications" ) == 1 && !empty( get_option( "inspry_toolkit_enable_plugin_update_admin_notifications_plugin_list" ) ) && !empty( get_option(   "inspry_toolkit_enable_plugin_update_admin_notifications_list" ) ) ) {

        //Get the list of selected users
        $users_ids = get_option( "inspry_toolkit_enable_plugin_update_admin_notifications_list" );

        //Get the list of selected plugins
        $plugin_lists = get_option( "inspry_toolkit_enable_plugin_update_admin_notifications_plugin_list" );

        //Check if plugin has been updated
        if ( isset( $options["action"] ) && $options["action"] == "update" && ( isset( $options["type"] ) && $options["type"] == "plugin" ) ) {

            if ( isset( $options["plugins"] ) && !empty( $options["plugins"] ) ) {

                //Get list of plugins has been updated
                $get_plugin_lists = $options["plugins"];

                //Check at least some plugins updated
                if ( !empty( $get_plugin_lists ) ) {

                    $plugins_list_arr = [];

                    //Loop through all the updated plugins
                    foreach ( $get_plugin_lists as $each_plugin ) {
                        //Check for plugin details
                        $plugin_data = get_plugin_data( 
                            WP_PLUGIN_DIR . "/" . $each_plugin
                         );

                        // check plugin is exist in our plugin list
                        if ( in_array( $each_plugin, $plugin_lists ) ) {
                            $plugins_list_arr[] =
                                $plugin_data["Name"] .
                                " " .
                                $plugin_data["Version"];
                        }
                    }

                    //Send notifcation email though the function
                    inspry_toolkit_send_admin_notification( 
                        $plugins_list_arr,
                        $users_ids
                     );
                }
            }
        }
    }
}

//upgrader_process_complete hook calls after plugin updates with some details
add_action( "upgrader_process_complete", "inspry_toolkit_plugin_update_admin_notification", 10, 2 );