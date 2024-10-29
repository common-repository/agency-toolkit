<?php

// Standard WP check if direct

if ( ! function_exists( 'add_action' ) ) {

    exit();

}

// Change User Notifications Email
function inspry_toolkit_change_email_address_change( $email_change, $user, $userdata ) {

	$sender_email_address = get_option( 'inspry_toolkit_change_user_notifications_email_sender' );

	$email_change[ 'message' ] = str_replace( '###ADMIN_EMAIL###',  $sender_email_address ,  $email_change['message'] );

	return $email_change;
}

add_filter( 'email_change_email', 'inspry_toolkit_change_email_address_change', 10, 3  );
add_filter( 'password_change_email', 'inspry_toolkit_change_email_address_change', 10, 3  );