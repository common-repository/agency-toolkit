<?php
// Standard WP check if direct
if ( ! function_exists( 'add_action' ) ) {
    exit();
}

// Check if we have already written to the wp-config file
function inspry_toolkit_check_for_wpengine_rule_2() {

    // Rewrite the wp-config file to comment out the file editor lines
    //$wp_config_file_path = ABSPATH . 'wp-config.php';
    $wp_config_file_path = inspry_get_wp_config();
    
    // return if empty
    if (empty( $wp_config_file_path)) {
        return false;
    }
    $wp_config_search_for = '// AGENCY TOOLKIT - DISABLE FILE MODS';
    $wp_config_file = file_get_contents( $wp_config_file_path );

    // Check if we have already disabled
    if ( strpos( $wp_config_file, $wp_config_search_for ) !== false ) {
        return true;
    }
    else {
        return false;
    }
}

// Write to the wp-config file
function inspry_toolkit_write_wpengine_rule_2() {

    //$wp_config_file_path = ABSPATH . 'wp-config.php';
    $wp_config_file_path = inspry_get_wp_config();
    
    // return if empty
    if (empty( $wp_config_file_path)) {
        return false;
    }

    $wp_config_file = file_get_contents( $wp_config_file_path );

    $wp_config_file = str_replace( "define( 'DISALLOW_FILE_MODS', FALSE );", "// AGENCY TOOLKIT - DISABLE FILE MODS " . PHP_EOL . "// define( 'DISALLOW_FILE_MODS', FALSE );", $wp_config_file );

    inspry_write_wp_config( $wp_config_file_path, $wp_config_file );
}

// Check if this site is on WPEngine
if ( function_exists( 'is_wpe' ) ) {
    if ( is_wpe() ) {
        // Check if we have already written to the file
        if ( ! inspry_toolkit_check_for_wpengine_rule_2() ) {

            // Write to the file
            inspry_toolkit_write_wpengine_rule_2();
        }
    }
}

// Disable any file modifications; installs and updates for plugins/themes for selected users, check if defined already
function inspry_toolkit_check_user_role(){

    if ( is_admin() && is_user_logged_in() ) {

        if ( get_option( 'inspry_toolkit_disable_installs_and_updates' ) == 1 && ! empty( get_option( 'inspry_toolkit_disable_installs_and_updates_list' ) ) ) {
            
            // Check if this admin is included in the array
            if ( !in_array( get_current_user_id(), get_option( 'inspry_toolkit_disable_installs_and_updates_list' ) ) ) {

                // Limit admins enabled and user is in list, display page
                if ( ! defined( 'DISALLOW_FILE_MODS' ) ){

                    define( 'DISALLOW_FILE_MODS', true );
                }
            }
        }
    }
}
add_action( 'init', 'inspry_toolkit_check_user_role' );