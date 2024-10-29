<?php
// Standard WP check if direct
if ( !function_exists( "add_action" ) ) {
    exit();
}

// Don't send notification emails for pingbacks and trackbacks.
add_filter( "notify_post_author",  function ( $maybe_notify, $comment_ID ) {

    $comment_type = get_comment_type( $comment_ID );

    if ( in_array( $comment_type, [ "pingback", "trackback" ], true ) ) {
        $maybe_notify = false;
    }

    return $maybe_notify;
    
}, 10, 2);