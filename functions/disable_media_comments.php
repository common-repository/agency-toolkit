<?php

// Standard WP check if direct
if ( !function_exists( "add_action" ) ) {
    exit();
}

// Disable commentes for media attachments
function inspry_toolkit_disable_media_comment( $open, $post_id ){
    
    $post = get_post( $post_id );

    if ( $post->post_type == "attachment" ) {
        return false;
    }

    return $open;
}

add_filter( "comments_open", "inspry_toolkit_disable_media_comment", 10, 2 );

//Remove comment support from media attachments

function inspry_toolkit_remove_media_post_comment(){

    remove_post_type_support( "attachment", "comments" );
}

add_action( "init", "inspry_toolkit_remove_media_post_comment" );