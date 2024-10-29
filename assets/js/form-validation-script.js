/**
 * Form Validation
 */

(function($) {

    // Email Validate
    function check_valid_email( email ) {

        var email_check = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,}$/i;
        
        if (email_check.test(email))
            return true;
        else
            return false;
    }

    // on submit Validation
    $("#submit").on('click', function(e) {

        var agency_footer = $("#inspry_toolkit_backend_footer");
        var agency_logo = $("#inspry_toolkit_backend_logo");

        /** custom agency footer with a name, URL and email in the WordPress Dashboard field is Not Enabled
         * OR
         * custom agency logo on the WordPress login screen is Not Enabled
         */

        if (agency_footer.is(':checked')) {
            var agency_footer_sub_fields = $('.inspry_toolkit_backend_footer_custom_option').find('input');
            // console.log(agency_footer_sub_fields.find('input'));
            if (agency_footer_sub_fields.length > 0) {
                agency_footer_sub_fields.each((index, ele) => {

                    if (ele.value == '') {
                        ele.classList.add('validate-error');
                        // $('#radio1').click();

                        e.preventDefault();
                        e.stopImmediatePropagation();
                    } else {
                        if (ele.classList.contains('validate-error')) {
                            ele.classList.remove('validate-error');
                        }
                    }

                });
            }
        } else {
            $('.inspry_toolkit_backend_footer_custom_option input').removeClass('validate-error');
        }

        var agency_logo_sub_field = $('#inspry_toolkit_backend_logo_image');
        if (agency_logo.is(':checked')) {
            console.log(agency_logo_sub_field.val());
            if (agency_logo_sub_field.val() == '') {
                agency_logo_sub_field.addClass('validate-error');
                // $('#radio1').click();
                e.preventDefault();
                e.stopImmediatePropagation();
            } else {
                if (agency_logo_sub_field.hasClass('validate-error')) {
                    agency_logo_sub_field.removeClass('validate-error');
                }
            }
        } else {
            if (agency_logo_sub_field.hasClass('validate-error')) {
                agency_logo_sub_field.removeClass('validate-error');
            }
        }

        /* USER SELECT BOX VALIDATION */
        // get all user list select box
        var user_select_box = $('.js-select2-multi.user');

        // check if main check box is active
        user_select_box.each(function(index, ele) {
            var curEle = $(this);

            // if main option are enable
            if (curEle.parent().parent().find('.atp-main-check-box input[type="checkbox"]').is(':checked')) {
                // get selected user
                var selected_user = curEle.val().length;

                // if not selected any user
                if (selected_user == 0) {
                    curEle.siblings('.select2-container').find('.select2-selection').addClass('validate-error');
                    e.preventDefault();
                    e.stopImmediatePropagation();
                } else {
                    curEle.siblings('.select2-container').find('.select2-selection').removeClass('validate-error');
                }
            }
        });

        /** Checksum verification for WordPress core files **/
        var checksum = $('#inspry_toolkit_checksum_verification_for_wordpress_core_files');
        if ( checksum.is(':checked') ) {
            var checksum_email = $('#inspry_toolkit_options_form input[name="inspry_toolkit_checksum_verification_for_wordpress_core_files_email_send"]');
            if ( checksum_email.val() == '' || !check_valid_email( checksum_email.val() ) ) {
                checksum_email.addClass('validate-error');
                e.preventDefault();
                e.stopImmediatePropagation();
            } else {
                checksum_email.removeClass('validate-error');
            }
        }

        /** Globally change email sender **/
        var globally_email_sender = $('#inspry_toolkit_change_email_sender');
        if ( globally_email_sender.is(':checked') ) {
            var sender_email = $('#inspry_toolkit_options_form input[name="inspry_toolkit_change_email_sender_address"]');
            var sender_name = $('#inspry_toolkit_options_form input[name="inspry_toolkit_change_email_sender_name"]');

            if ( sender_email.val() == '' || !check_valid_email( sender_email.val() ) ) {
                sender_email.addClass('validate-error');
                e.preventDefault();
                e.stopImmediatePropagation();
            } else {
                sender_email.removeClass('validate-error');
            }

            if ( sender_name.val() == '' ) {
                sender_name.addClass('validate-error');
                e.preventDefault();
                e.stopImmediatePropagation();
            } else {
                sender_name.removeClass('validate-error');
            }
        }

        /** Change admin email address shared in user emails **/
        var user_email_shared = $('#inspry_toolkit_change_user_notifications_email');
        if ( user_email_shared.is(':checked') ) {
            var shared_email = $('#inspry_toolkit_options_form input[name="inspry_toolkit_change_user_notifications_email_sender"]');

            if ( shared_email.val() == '' || !check_valid_email( shared_email.val() ) ) {
                shared_email.addClass('validate-error');
                e.preventDefault();
                e.stopImmediatePropagation();
            } else {
                shared_email.removeClass('validate-error');
            }
        }

        if ($('input, .select2-selection').hasClass('validate-error')) {
            var get_all_errors = $('.validate-error');

            var option_tab_id = get_all_errors.first().closest('.atp-panel').data('id');

            $(`#${option_tab_id}`).click();

            $('html, body').animate({
                scrollTop: ($('.validate-error').first().offset().top - 100) 
            }, 300);
        }
    });
})(jQuery);