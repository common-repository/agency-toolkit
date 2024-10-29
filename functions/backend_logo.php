<?php
// Standard WP check if direct
if ( ! function_exists( 'add_action' ) ) {
    exit();
}

// Change the logo for WP Admin login screen
function inspry_toolkit_backend_logo() {
    ?>
    <style type="text/css">
    .login #login h1 a {
        height: 118px !important;
        width: 100% !important;
        margin: 0 auto !important;
        padding: 0 !important;
        background-image: url(<?php echo esc_url( get_option( 'inspry_toolkit_backend_logo_image' ) ); ?>) !important;
        background-size: contain !important;
    }
    </style>
    <?php
}
add_action( 'login_enqueue_scripts', 'inspry_toolkit_backend_logo' );