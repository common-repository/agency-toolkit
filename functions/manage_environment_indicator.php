<?php
// Standard WP check if direct
if ( ! function_exists( 'add_action' ) ) {
    exit();
}

// Manage Environment Indicator
function inspry_toolkit_manage_environment_indicator() {

    if ( is_user_logged_in() ) {
        
        // Provided host name
        $devServerHost = get_option( 'inspry_toolkit_development_environment_host_name' );

        $devServerHost = str_replace( 'http://', '', $devServerHost );

        $devServerHost = str_replace( 'https://', '', $devServerHost );

        if ( substr( $devServerHost, -1 ) === '/' ) {

            $devServerHost = substr( $devServerHost, 0, -1 );
        }

        // Provided color of notify
        $getAlertColor = get_option( 'inspry_toolkit_manage_development_environment_banner_color' );

        // Selected User List
        $selectedUserList = get_option( 'inspry_toolkit_development_environment_user_list' );

        $is_development_server = inspry_toolkit_check_server_is_development_or_user_selected( $devServerHost, $selectedUserList );

        $environment_indicator_css = '';

        if ( $is_development_server ) {

            add_action( 'wp_before_admin_bar_render', function () {

                global $wp_admin_bar;

                $menu_id = 'production-environment-indicator'; // the menu id which you want to remove

                $wp_admin_bar->remove_menu( $menu_id );
            } );

            // DISPLAY ENVIRONMENT ON ADMIN BAR ITEMS
            add_action( 'admin_bar_menu', function ( WP_Admin_Bar $admin_bar ) {

                if ( !current_user_can( 'manage_options' ) ) {

                    return;
                }

                $admin_bar->add_menu( array( 

                    'id' => 'staging-environment-indicator',
                    'parent' => null,
                    'group' => null,
                    'title' => esc_html__( 'Staging', 'inspry-toolkit' ), // Escape the title
                    'href' => admin_url( 'admin.php?page=inspry-agency-toolkit' ),
                    'meta' => [
                        'title' => esc_html__( 'Staging', 'inspry-toolkit' ), // Escape the title
                    ]
                 ) );

            }, 9999 );

            if ( in_array( 'red', $getAlertColor ) ) {

                $environment_indicator_css .= "#wpadminbar:before {
                    width: 100%;
                    height: 4px;
                    background: url( " . esc_url( plugin_dir_url( __DIR__ ) ) . "assets/images/dev-mode-red.svg ) 25px 0px repeat-x;
                    content: '';
                    display: block;
                }

                #wp-admin-bar-staging-environment-indicator {
                    background-color: #ce3333 !important;
                }";

            } elseif ( in_array( 'yellow', $getAlertColor ) ) {

                $environment_indicator_css .= "#wpadminbar:before {
                    width: 100%;
                    height: 4px;
                    background: url( " . esc_url( plugin_dir_url( __DIR__ ) ) . "assets/images/dev-mode-yellow.svg ) 25px 0px repeat-x;
                    content: '';
                    display: block;
                }

                #wp-admin-bar-staging-environment-indicator {
                    background-color: #bb9a18 !important;
                    height: 28px !important;
                    line-height: 28px !important;
                }";
            }
        } else {

            $environment_indicator_css .= "#wp-admin-bar-production-environment-indicator {
                background-color: #008000 !important;
                height: 32px !important;
                line-height: 32px !important;
            }";
        }

        // set hite for indicator (  Staging / Production  )
        $environment_indicator_css .= "

        #adminmenu li.current .wp-menu-image img{
            opacity: 1 !important;
        }";

        if ( $environment_indicator_css ) {

            add_action( 'admin_head', function () use ( $environment_indicator_css ) {
                echo '<style>' . wp_kses_post( $environment_indicator_css ) . '</style>';
            } );

            add_action( 'wp_head', function () use ( $environment_indicator_css ) {
                echo '<style>' . wp_kses_post( $environment_indicator_css ) . '</style>';
            } );
        }
    }
}
add_action( 'init', 'inspry_toolkit_manage_environment_indicator' );

if ( !function_exists( 'inspry_toolkit_check_server_is_development_or_user_selected' ) ) {
    function inspry_toolkit_check_server_is_development_or_user_selected( $hostName, $selectedUserList ) {
        
        $currentUserID = get_current_user_id();

        if ( !$selectedUserList || ( !empty( $selectedUserList ) && !in_array( $currentUserID, $selectedUserList ) ) ) {
            return false;
        }
        
        if ( isset( $_SERVER['HTTP_HOST'] ) ) {

            $currentHost = $_SERVER['HTTP_HOST'];

        } elseif ( isset( $_SERVER['SERVER_NAME'] ) ) {

            $currentHost = $_SERVER['SERVER_NAME'];

        } else {

            $currentHost = $_SERVER['VIRTUAL_HOST'];
        }

        if ( $hostName != '' ){
            
            $modifyHostName = str_replace( "*", "", $hostName );
            
            if ( ( strpos( $hostName, '*' ) === FALSE && $currentHost === $hostName ) 
                || ( strpos( $hostName, '*' ) !== FALSE && strpos( $currentHost, $modifyHostName ) !== FALSE )
         ) {
                return true;
            }
        } 

        if ( $currentHost == 'localhost' 
            || strpos( $currentHost, '.dev' ) 
            || strpos( $currentHost, '.wpengine.com' )
            || strpos( $currentHost, '.local' )
            || ( strpos( $currentHost, 'dev.' ) !== FALSE )
            || ( strpos( $currentHost, 'staging.' ) !== FALSE )
            || ( strpos( $currentHost, 'staging-' ) !== FALSE  )
            || $currentHost == '10.0.0.0'
            || $currentHost == '172.16.0.0'
            || $currentHost == '192.168.0.0'
     ) {
            return true;
        }
    }
}