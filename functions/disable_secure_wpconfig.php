<?php
// Standard WP check if direct
if ( ! function_exists( 'add_action' ) ) {
    exit();
}

// Set up delete to file rule function
function inspry_toolkit_delete_config_rule() {
    
    // Get the file
    $htaccess_file_path = ABSPATH . '.htaccess';
    $htaccess_file = file_get_contents( $htaccess_file_path );
    $htaccess_search_for = '# AGENCY TOOLKIT - SECURE WP CONFIG' . "\n" . '<files wp-config.php>' . "\n" . 'order allow,deny' . "\n" . 'deny from all' . "\n" . '</files>';
    $htaccess_file_new = str_replace( $htaccess_search_for, '', $htaccess_file );
    
    if (!empty( $htaccess_file_new)) {
        // Replace file contents
        file_put_contents( $htaccess_file_path, $htaccess_file_new );
    }
    
}

// Set up function to check for the rule
function inspry_toolkit_check_config_rule() {

    $htaccess_file_path = ABSPATH . '.htaccess';
    $htaccess_search_for = '# AGENCY TOOLKIT - SECURE WP CONFIG';
    $htaccess_file = file_get_contents( $htaccess_file_path );

    if ( strpos( $htaccess_file, $htaccess_search_for ) !== false ) {
        return true;
    } else {
        return false;
    }
}

// Make sure we haven't already written the rule
function inspry_toolkit_run_config_rule() {

    if ( inspry_toolkit_check_config_rule() ) {

        // Write the fuke
        inspry_toolkit_delete_config_rule();
    }
}
add_action( 'init', 'inspry_toolkit_run_config_rule' );
