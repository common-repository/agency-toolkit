<?php
// Standard WP check if direct
if ( !function_exists( "add_action" ) ) {
    exit();
}

// Disable self pinkgback
function inspry_toolkit_no_self_ping( &$links )
{
    $home = get_option( "home" );

    foreach ( $links as $l => $link ) {
        if ( 0 === strpos( $link, $home ) ) {
            unset( $links[$l] );
        }
    }
}

add_action( "pre_ping", "inspry_toolkit_no_self_ping" );