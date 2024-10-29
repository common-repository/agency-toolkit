<?php
// Standard WP check if direct
if ( ! function_exists( 'add_action' ) ) {
    exit();
}

// Remove version from HTML
remove_action( 'wp_head', 'wp_generator' );

// Remove version from RSS
function inspry_toolkit_remove_wp_version_rss() {
    return '';
}

add_filter( 'the_generator', 'inspry_toolkit_remove_wp_version_rss' );
