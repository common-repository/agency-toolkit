<?php
// Standard WP check if direct
if ( !function_exists( "add_action" ) ) {
    exit();
}

// Disable WordPress Administration email verification prompt
add_filter( "admin_email_check_interval", "__return_false" );