<?php
// Standard WP check if direct
if ( ! function_exists( 'add_action' ) ) {
    exit();
}
//Check for the users can update admin email address in general settings
function inspry_toolkit_limit_users_modify_admin_email(){
   
    if ( is_admin() && is_user_logged_in() ) {
        
        //Check if the option has user selection
        if ( get_option( 'inspry_toolkit_limit_users_modify_admin_email' ) == 1 && ! empty( get_option( 'inspry_toolkit_limit_users_modify_admin_email_user_list' ) ) ) {
          
            //Check logged in user has the right to edit the email address
            if( !in_array( get_current_user_id(), get_option( 'inspry_toolkit_limit_users_modify_admin_email_user_list' ) ) ){

                //Add script to disable the text box for the users who has no right for this
                ob_start(); ?>

                    <script type="text/javascript">
                            jQuery("#new_admin_email").prop('disabled', true);
                    </script> <?php

                echo ob_get_clean();
            }
        }
    }
}

add_action( 'admin_footer' , 'inspry_toolkit_limit_users_modify_admin_email' );