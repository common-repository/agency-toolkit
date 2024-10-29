<?php
// Standard WP check if direct
if ( ! function_exists( 'add_action' ) ) {
    exit();
}

// Check if post revisions are disabled or limited
if ( get_option( 'inspry_toolkit_limit_post_revisions_number' ) == 0 ) {
    
    // Disable post revisions
    if (!defined( 'WP_POST_REVISIONS')) {
        define( 'WP_POST_REVISIONS', false );
    }
    
} else {
    
    // Limit post revisions to set amount
    if (!defined( 'WP_POST_REVISIONS')) {
        define( 'WP_POST_REVISIONS', get_option( 'inspry_toolkit_limit_post_revisions_number' ) );
    }
}
