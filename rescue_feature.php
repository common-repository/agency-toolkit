<?php
// Standard WP check if direct
if ( ! function_exists( 'add_action' ) ) {
    exit();
}

// check if rescue secret link is called
if ( ( isset( $_GET[ 'page' ] ) && $_GET[ 'page' ] == 'inspry-agency-toolkit' ) && ( ( isset( $_GET[ 'rescue' ] ) && filter_var( $_GET[ 'rescue' ], FILTER_VALIDATE_EMAIL ) ) || ( isset( $_GET ['rescue_verify' ] ) && $_GET[ 'rescue_verify' ] != '' ) ) ) {

    if ( empty( get_option( 'inspry_toolkit_limit_admins_list' ) ) ) {

        inspry_agency_custom_admin_notice( 'error', 'Agency Toolkit Admin Access already reset.' );
        return;
    }

    function inspry_agency_toolkit_provide_access_to_user(){

        if ( isset( $_GET[ 'rescue' ] ) && !isset( $_GET[ 'rescue_verify' ] ) ) {  

            if ( get_transient( 'iat_access_token' ) !== false ) {
                
                inspry_agency_custom_admin_notice( 'success', 'Agency Toolkit Admin Access reset email has been sent. Please check your inbox.' );
                return;
            }

            $get_user_email = $_GET[ 'rescue' ];
            $userOBJ = get_user_by( 'email', $get_user_email );
                
            if ( $userOBJ ) {
                // check user is admin or not
                if ( in_array( 'administrator', $userOBJ->roles ) ) {

                    $email = $userOBJ->user_email;
                    $ID =  $userOBJ->ID;
                    $random_number = rand( 0000,9999 );
                    $token_str = $email.'-'.$ID.'-'.$random_number;
                    $access_token = wp_hash( $token_str, 'inspry-agency-toolkit' );

                    $expiration = 180;

                    $create_access_token_url = site_url() . '/wp-admin/admin.php?page=inspry-agency-toolkit&rescue_verify=' . $access_token;

                    $subject = 'Agency Toolkit Admin Access Reset';
                    $message = "A request was made to reset the list of admins who can access the Agency Toolkit plugin. If this was an intentional, please <a href='$create_access_token_url' target='_blank'>click here</a> to proceed with the reset. If this was not you, please disregard. This Access Reset link will be expire in 3 minutes.";
                    $headers = array( 'Content-Type: text/html; charset=UTF-8' );

                    if ( wp_mail( $email, $subject, $message, $headers ) ) {

                        set_transient('iat_access_token', $access_token, $expiration);

                        inspry_agency_custom_admin_notice( 'success', 'Agency Toolkit Admin Access Reset Mail Sent. Please check your inbox.' );
                    }
                }        
            } else {

                inspry_agency_custom_admin_notice( 'error', 'Agency Toolkit Admin Access Reset link has timed out Please try again.' );
            }
        } else if ( isset($_GET['rescue_verify']) && !isset($_GET['rescue']) ) { 
            
            if ( get_transient ( 'iat_access_token' ) === false ) {
                inspry_agency_custom_admin_notice( 'error', 'Agency Toolkit Admin Access Reset link has timed out Please try again.' );
                return;
            }

            $access_token = get_transient( 'iat_access_token' );
            $fetch_access_token = $_GET[ 'rescue_verify' ];

            if ( $access_token === $fetch_access_token ) {

                update_option( 'inspry_toolkit_limit_admins_list', [] );

                delete_transient( 'iat_access_token' );

                inspry_agency_custom_admin_notice( 'success', 'Agency Toolkit Admin Access Reset Successful.' );
            } else {
                inspry_agency_custom_admin_notice( 'success', 'Agency Toolkit Admin Access Reset link has timed out Please try again.' );
            }
        }
    }
    add_action( 'init', 'inspry_agency_toolkit_provide_access_to_user' ); 
}

function inspry_agency_custom_admin_notice( $class, $message ) {

    add_action( 'admin_notices', function() use ( $class, $message ) {

        global $pagenow;

        if ( $pagenow == 'admin.php' ) {

            echo "<div class='notice notice-" . esc_attr( $class ) . " is-dismissible'><p>" . esc_html( $message ) . "</p></div>";
        }
    });
}