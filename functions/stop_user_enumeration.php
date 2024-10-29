<?php
// Standard WP check if direct
if ( ! function_exists( 'add_action' ) ) {
    exit();
}


// Display error if we can't write to file
function inspry_toolkit_show_error() {
    ?>
    <div class="notice notice-error">
        <p style="font-weight: bold;">ERROR: Agency Toolkit</p>
        <p>Failed to save settings for <b>Stop User Enumeration</b>.  Please check the wp-config.php and .htaccess permissions on your web server'.</p>
    </div>
    <?php
}

// Set up write to file rule function
function inspry_toolkit_stop_user_enumeration_rule() {

    $htaccess_file_path = ABSPATH . '.htaccess';
    $htaccess_file = fopen( $htaccess_file_path, 'a' );
    $site_url = site_url(  );
    // Make sure we can write to file
    if ( $htaccess_file && is_writable( $htaccess_file_path )  ) {
        fwrite( $htaccess_file, "\n\n" . '# AGENCY TOOLKIT - STOP USER ENUM' . "\n" . '<IfModule mod_rewrite.c>' . "\n" . 'RewriteCond %{REQUEST_URI}  ^/$' . "\n" . 'RewriteCond %{QUERY_STRING} ^/?author=([0-9]*)' . "\n" . 'RewriteRule ^(.*)$ ' . $site_url . '? [L,R=301]' . "\n" . '</IfModule>' );
        fclose( $htaccess_file );
    } else {
        add_action( 'admin_notices', 'inspry_toolkit_show_error' );
    }
}

// Set up function to check for the rule
function inspry_toolkit_check_user_enumeration_rule() {

    $htaccess_file_path = ABSPATH . '.htaccess';
    $htaccess_search_for = '# AGENCY TOOLKIT - STOP USER ENUM';
    $htaccess_file = file_get_contents( $htaccess_file_path );
    if ( strpos( $htaccess_file, $htaccess_search_for ) == false ) {
        return true;
    } else {
        return false;
    }
}

// Make sure we haven't already written the rule
function inspry_toolkit_run_stop_user_emun_rule() {

    if ( !is_admin() ) {

        // default URL format
        if ( preg_match('/author=([0-9]*)/i', $_SERVER['QUERY_STRING']) ){
            die(  );
        } 
        add_filter( 'redirect_canonical', 'inspry_toolkit_check_enum', 10, 2 );
        
        //Disable REST API endpoints to get user details
        add_filter( 'rest_endpoints', function( $endpoints ){
            if ( isset( $endpoints['/wp/v2/users'] ) ) {
                unset( $endpoints['/wp/v2/users'] );
            }    return $endpoints;
        } );
    }
    function inspry_toolkit_check_enum( $redirect, $request ) {
        
        // permalink URL format
        if ( preg_match( '/\?author=([0-9]*)(\/*)/i', $request ) ){
            die(  );
        }else{
            return $redirect;
        } 
    }
    
   if ( inspry_toolkit_check_user_enumeration_rule() ) {
       // Write the fuke
       inspry_toolkit_stop_user_enumeration_rule();
   }
}
add_action( 'init', 'inspry_toolkit_run_stop_user_emun_rule' );   