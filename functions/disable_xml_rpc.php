<?php
// Standard WP check if direct
if ( ! function_exists( 'add_action' ) ) {
    exit();
}

// Disable XML RPC
add_filter( 'xmlrpc_enabled', '__return_false' );