<?php
// Standard WP check if direct
if ( !function_exists( 'add_action' ) ) {
    exit();
}


// get wp-config.php file path
function inspry_get_wp_config() {

    $config_path = '';

    if ( file_exists( ABSPATH . 'wp-config.php' ) ) {
        /** The config file resides in ABSPATH */
        $config_path  = ABSPATH . 'wp-config.php';
    } elseif ( @file_exists( dirname( ABSPATH ) . '/wp-config.php' ) && ! @file_exists( dirname( ABSPATH ) . '/wp-settings.php' ) ) {
        /** The config file resides one level above ABSPATH but is not part of another installation */
        $config_path  =  dirname( ABSPATH ) . '/wp-config.php';
    }

    // if writeable 
    if (!empty($config_path)) {
        return $config_path;
    }

    // return empty if no path found
    return ;
}


// Write code to wp-config.php file
function inspry_write_wp_config($file, $contents) {

    //Cannot save the config file with empty contents.
    if ( ! trim( $contents ) ) {
       return false;
    }

    $result = file_put_contents( $file, $contents, LOCK_EX );

    //Failed to update the config file.
    if ( false === $result ) {
        return false;
    }
    return true;
}