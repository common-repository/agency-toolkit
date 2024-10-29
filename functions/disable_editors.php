<?php
// Standard WP check if direct
if ( !function_exists( "add_action" ) ) {
    exit();
}

// Check if we have already written to the wp-config file
function inspry_toolkit_check_for_wpengine_rule()
{
    // Rewrite the wp-config file to comment out the file editor lines
    //$wp_config_file_path = ABSPATH . "wp-config.php";
    $wp_config_file_path = inspry_get_wp_config();

    // return path empty
    if (empty( $wp_config_file_path)) {
        return false;
    }

    $wp_config_search_for = "// AGENCY TOOLKIT - DISABLE FILE EDIT";

    $wp_config_file = file_get_contents($wp_config_file_path);

    // Check if we have already disabled
    if (strpos($wp_config_file, $wp_config_search_for) !== false) {
        return true;
    } else {
        return false;
    }
}

// Write to the wp-config file
function inspry_toolkit_write_wpengine_rule()
{
    //$wp_config_file_path = ABSPATH . "wp-config.php";
    $wp_config_file_path = inspry_get_wp_config();
    
    // return if empty
    if (empty( $wp_config_file_path)) {
        return false;
    }

    $wp_config_file = file_get_contents($wp_config_file_path);

    $wp_config_file = str_replace(
        "define( 'DISALLOW_FILE_EDIT', FALSE );",
        "// AGENCY TOOLKIT - DISABLE FILE EDIT " .
            PHP_EOL .
            "// define( 'DISALLOW_FILE_EDIT', FALSE );",
        $wp_config_file
    );

    inspry_write_wp_config($wp_config_file_path, $wp_config_file);
}

// Check if this site is on WPEngine
if (function_exists("is_wpe")) {
    if (is_wpe()) {

        // Check if we have already written to the file
        if (!inspry_toolkit_check_for_wpengine_rule()) {

            // Write to the file
            inspry_toolkit_write_wpengine_rule();
        }
    }
}

// Disable theme and plugin editors if not already defined
if (!defined( "DISALLOW_FILE_EDIT" )) {

    define("DISALLOW_FILE_EDIT", true);
}