<?php
// Standard WP check if direct
if ( ! function_exists( 'add_action' ) ) {
    exit();
}

// Display error if we can't write to file
function inspry_toolkit_show_file_error() {
    ?>
    <div class="notice notice-error">
        <p style="font-weight: bold;"><?php esc_html_e('ERROR: Agency Toolkit', 'inspry-toolkit'); ?></p>
        <p><?php esc_html_e('Failed to save settings for', 'inspry-toolkit'); ?> <b><?php esc_html_e('Secure the wp-config.php file using .htaccess', 'inspry-toolkit'); ?></b>. <?php esc_html_e("Please check the wp-config.php and .htaccess permissions on your web server'", 'inspry-toolkit'); ?>.</p>
    </div>
    <?php
}


// Set up write to file rule function
function inspry_toolkit_write_config_rule() {

    $htaccess_file_path = ABSPATH . '.htaccess';
    
    $htaccess_file = fopen( $htaccess_file_path, 'a' );

    // Make sure we can write to file
    if ( $htaccess_file && is_writable($htaccess_file_path) ) {
        fwrite( $htaccess_file, PHP_EOL . '# AGENCY TOOLKIT - SECURE WP CONFIG' . "\n" . '<files wp-config.php>' . "\n" . 'order allow,deny' . "\n" . 'deny from all' . "\n" . '</files>' );
        fclose( $htaccess_file );
    } else {
        add_action( 'admin_notices', 'inspry_toolkit_show_file_error' );
    }
}

// Set up function to check for the rule
function inspry_toolkit_check_for_config_rule() {
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
function inspry_toolkit_run_custom_config_rule() {
    if ( ! inspry_toolkit_check_for_config_rule() ) {
        // Write the rule
        inspry_toolkit_write_config_rule();
    }
}
add_action( 'init', 'inspry_toolkit_run_custom_config_rule' );
