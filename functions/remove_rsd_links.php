<?php
// Standard WP check if direct
if ( ! function_exists( 'add_action' ) ) {
    exit();
}

// Remove RSD links
remove_action( 'wp_head', 'rsd_link' );