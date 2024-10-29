<?php
// Standard WP check if direct
if ( !function_exists( "add_action" ) ) {
    exit();
}

// Turn on maintenance mode
function inspry_toolkit_maintenance_mode(  )
{
    if ( is_admin() ) {
        return;
    }

    // Get maintenance mode heading if set in options, otherwise, set a default
    if ( !empty( get_option( "inspry_toolkit_maintenance_mode_heading" ) ) ) {
        $maintenance_mode_heading = get_option( 
            "inspry_toolkit_maintenance_mode_heading"
         );
    } else {
        $maintenance_mode_heading = "Under Maintenance";
    }

    // Get maintenance mode sentence if set in options, otherwise, set a default
    if ( !empty( get_option( "inspry_toolkit_maintenance_mode_sentence" ) ) ) {
        $maintenance_mode_sentence = get_option( 
            "inspry_toolkit_maintenance_mode_sentence"
         );
    } else {
        $maintenance_mode_sentence =
            get_bloginfo( "name" ) .
            " is under maintenance. Please check back later.";
    }

    // Kill WP and set message if user is not logged in and doesn't have editing access
    global $pagenow;

    if ( $pagenow != "wp-login.php" && ( !current_user_can( "edit_themes" ) || !is_user_logged_in() ) ) {

        wp_die( wp_kses(  "<h1>" .  $maintenance_mode_heading . "</h1><p> " . $maintenance_mode_sentence . "</p>", "post" ) );
    }
}

add_action( "init", "inspry_toolkit_maintenance_mode" );