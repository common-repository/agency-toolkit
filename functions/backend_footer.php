<?php
// Standard WP check if direct
if ( ! function_exists( 'add_action' ) ) {
    exit();
}

// Enable custom back-end footer
function inspry_toolkit_custom_admin_footer() {

    echo wp_kses( 'Managed by <a href="' . get_option( "inspry_toolkit_backend_footer_agency_url" ) . '" target="_blank">' . get_option( "inspry_toolkit_backend_footer_agency_name" ) . '</a>. Questions? Email us at <a href="mailto:' . get_option( "inspry_toolkit_backend_footer_agency_email" ) . '">' . get_option( "inspry_toolkit_backend_footer_agency_email" ) . '</a>.', 'post' );
}
add_filter( 'admin_footer_text', 'inspry_toolkit_custom_admin_footer' );