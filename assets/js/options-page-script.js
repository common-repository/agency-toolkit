// jQuery init

jQuery( document ).ready( function( $ ) {

    // Media uploader logic

    var media_uploader;

    $( '#upload_backend_logo_image_button' ).click( function( e ) {

        e.preventDefault();

        if ( media_uploader ) {

            media_uploader.open();

            return;

        }
        media_uploader = wp.media.frames.file_frame = wp.media( {

            title: 'Choose Image',

            button: {

                text: 'Choose Image'

            },

            multiple: false

        } );

        media_uploader.on( 'select', function() {

            var attachment = media_uploader.state().get( 'selection' ).first().toJSON();

            $( '#inspry_toolkit_backend_logo_image' ).val( attachment.url );

        });
        media_uploader.open();

    } );



    // Create the function that loops through options and shows/hides

    function inspry_toolkit_custom_options_dynamic_check( options ) {

        jQuery.each( options, function( index, value ) {

            if ( jQuery( '#inspry_toolkit_' + value ).is( ':checked' ) ) {

                jQuery( '.inspry_toolkit_' + value + '_custom_option' ).show();

            } else {

                jQuery( '.inspry_toolkit_' + value + '_custom_option' ).hide();

            }

        } );

    }

    // Declare options that have additional custom options

    var inspry_toolkit_custom_options = [

        'backend_footer',
        'backend_logo',
        'limit_post_revisions',
        'enable_wp_debugger',
        'limit_admins',
        'disable_installs_and_updates',
        'maintenance_mode',
        'change_email_sender',
        'enable_plugin_update_admin_notifications',
        'change_user_notifications_email',
        'remove_site_health',
        'checksum_verification_for_wordpress_core_files',
        'limit_users_modify_admin_email',
        'enable_plugin_update_admin_notifications',
        'disable_admin_notice',
        'manage_environment_indicator',
        'control_wp_core_updates'
    ];

    // Run function on form change

    jQuery( '#inspry_toolkit_options_form' ).change( function() {

        inspry_toolkit_custom_options_dynamic_check( inspry_toolkit_custom_options );

    });

    // Run function on page load
    inspry_toolkit_custom_options_dynamic_check( inspry_toolkit_custom_options );

} );


// select2
jQuery(document).ready(function($) {

    $('.atp-body-content #submit').on('click',function (){
        $('#inspry_toolkit_options_form').submit();
    });

	$(".js-select2-multi.user").select2({
		placeholder: "Please select user(s)",
        tags: true,
        tokenSeparators: [',', ' ']
	});

	$(".js-select2-multi.plugin").select2({
		placeholder: "Please select plugin(s)",
        tags: true,
        tokenSeparators: [',', ' ']
	});
});

jQuery(document).ready(function ($){

    var optionValue = localStorage.getItem('atp_tab_option');
    if (optionValue !== null) {
        switch (optionValue) {
            case 'general':
                $('#first-tab').click();
                break;
            case 'security':
                $('#second-tab').click();
                break;
            case 'perf':
                $('#third-tab').click();
                break;
            case 'email_noti':
                $('#fourth-tab').click();
                break;
            case 'tools':
                $('#fifth-tab').click();
                break;
        }
    }

    $('#first-tab').on('click', function() {
         localStorage.setItem('atp_tab_option', 'general');
    });
    $('#second-tab').on('click', function() {
         localStorage.setItem('atp_tab_option', 'security');
    });
    $('#third-tab').on('click', function() {
         localStorage.setItem('atp_tab_option', 'perf');
    });
    $('#fourth-tab').on('click', function() {
         localStorage.setItem('atp_tab_option', 'email_noti');
    });
    $('#fifth-tab').on('click', function() {
         localStorage.setItem('atp_tab_option', 'tools');
    });

    $('#inspry_toolkit_control_wp_core_updates').change(function() {

        if ($(this).is(':checked')) {
        
            if ($('#inspry_toolkit_enable_wp_core_minor_updates:checked, #inspry_toolkit_disable_wp_core_updates:checked, #inspry_toolkit_enable_wp_core_updates:checked').length=== 0) {
        
                // None of the radio buttons are selected
                $('#inspry_toolkit_enable_wp_core_minor_updates').prop('checked', true);
            }
        }
    });

});
