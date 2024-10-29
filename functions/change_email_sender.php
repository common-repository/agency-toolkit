<?php
// Standard WP check if direct
if ( ! function_exists( 'add_action' ) ) {
    exit();
}

// Functions to change email sender address and name
function inspry_toolkit_sender_from_email( $old ) {

    $sender_email_address = get_option( 'inspry_toolkit_change_email_sender_address' );
	return $sender_email_address;
}

function inspry_toolkit_sender_from_email_name( $old ) {

    $sender_email_name = get_option( 'inspry_toolkit_change_email_sender_name' );
	return $sender_email_name;
}

// Make sure option isn't empty
if ( ! empty( get_option( 'inspry_toolkit_change_email_sender_address') ) ){

    // Change sender email address
    add_filter( 'wp_mail_from', 'inspry_toolkit_sender_from_email' );
}

if ( ! empty( get_option( 'inspry_toolkit_change_email_sender_name' ) ) ){

    // Change sender email name
    add_filter( 'wp_mail_from_name', 'inspry_toolkit_sender_from_email_name' );
}