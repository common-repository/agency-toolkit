<?php
// Standard WP check if direct
if (!function_exists('add_action')) {
    exit();
}

function inspry_toolkit_security_options_html()
{

    global $toolkit_security_options;
?>
    <div id="second-panel" class="atp-panel" data-id="radio2">
        <div class="atp-top-content">
            <h2 class="atp-sub-head">Security</h2>
        </div>
        <?php
        foreach ( $toolkit_security_options as $option ) {

            // Get checked option
            $checked = get_option( 'inspry_toolkit_' . $option["name"] );

            // Determine if checked or not
            if ( $checked == 1 ) {
                $checked = 'checked';
            } else {
                $checked = '';
            }
            
            // Sanitize the string using wp_kses_data() to allow most HTML tags and attributes
            $sanitized_description = wp_kses_data( $option["description"] );
     
            // Display option
        ?>
            <div class="atp-form-grid">
                <div class="atp-label">
                    <?php echo $sanitized_description; ?>
                    <span class="atp-tooltip" data-tip="<?php echo esc_attr( $option['details'] ); ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                            <path d="M5.30252 5.25C5.43966 4.86014 5.71036 4.5314 6.06666 4.322C6.42296 4.11259 6.84188 4.03605 7.24921 4.10592C7.65654 4.17578 8.026 4.38756 8.29215 4.70373C8.5583 5.01989 8.70397 5.42006 8.70335 5.83333C8.70335 7 6.95335 7.58333 6.95335 7.58333M7.00002 9.91667H7.00585M12.8334 7C12.8334 10.2217 10.2217 12.8333 7.00002 12.8333C3.77836 12.8333 1.16669 10.2217 1.16669 7C1.16669 3.77834 3.77836 1.16667 7.00002 1.16667C10.2217 1.16667 12.8334 3.77834 12.8334 7Z" stroke="#667085" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </span>
                </div>
                <div class="atp-label-content">
                    <div class="atp-check-box-design atp-main-check-box">
                        <input type="checkbox" id="<?php echo esc_attr( 'inspry_toolkit_' . $option["name"] ); ?>" name="<?php echo esc_attr( 'inspry_toolkit_' . $option["name"] ); ?>" value="1" <?php checked( 1, get_option('inspry_toolkit_' . $option["name"] ), false ); ?> <?php echo esc_html( $checked ); ?> />
                        <label for="<?php echo esc_attr( 'inspry_toolkit_' . $option["name"] ); ?>"> Enabled </label>
                    </div>
                    <?php
                    switch ( $option['name'] ) {

                        case 'disable_installs_and_updates': ?>

                            <div class="atp-form-control inspry_toolkit_disable_installs_and_updates_custom_option">
                                <label for="">Select Users</label>
                                <select name="inspry_toolkit_disable_installs_and_updates_list[]" multiple="multiple" class="js-select2-multi user">
                                    <?php
                                    $admins = get_users( array( 'role' => 'administrator', 'order' => 'ASC', 'orderby' => 'ID' ) );
                                    foreach ( $admins as $admin ) {
                                    ?>
                                        <option value="<?php echo esc_attr( $admin->ID ); ?>" <?php if ( !empty(get_option( 'inspry_toolkit_disable_installs_and_updates_list' ) ) ) {
                                                                                                if ( in_array( $admin->ID, get_option( 'inspry_toolkit_disable_installs_and_updates_list' ) ) ) {
                                                                                                    echo esc_attr( 'selected="selected"' );
                                                                                                }
                                                                                            } ?>>
                                            <?php echo esc_html( $admin->user_login ); ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div><?php

                                    break;

                                case 'checksum_verification_for_wordpress_core_files': ?>

                            <div class="atp-form-control inspry_toolkit_checksum_verification_for_wordpress_core_files_custom_option">
                                <label for="">Notifications Email Address</label>
                                <?php if (get_option('inspry_toolkit_checksum_verification_for_wordpress_core_files_email_send') == '') {
                                        $admin_email = get_option('admin_email'); ?>
                                    <input type="email" name="inspry_toolkit_checksum_verification_for_wordpress_core_files_email_send" value="<?php echo  esc_attr( $admin_email ); ?>" />
                                <?php } else { ?>
                                    <input type="email" name="inspry_toolkit_checksum_verification_for_wordpress_core_files_email_send" value="<?php echo esc_attr( get_option( 'inspry_toolkit_checksum_verification_for_wordpress_core_files_email_send' ) ); ?>" />
                                <?php } ?>
                            </div>
                            <div class="atp-form-control inspry_toolkit_checksum_verification_for_wordpress_core_files_custom_option">
                                <p class="description">
                                    <?php
                                    $timestamp = wp_next_scheduled( 'cron_called' );
                                    if ( $timestamp ) {
                                        echo sprintf(
                                            '%s: %s',
                                            esc_html__( 'Next Run', 'inspry-toolkit' ),
                                            esc_html( date_i18n( 'm-d-Y h:i:s a', $timestamp + get_option( 'gmt_offset' ) * 3600 ) )
                                        );
                                    }
                                    ?>
                                </p>
                            </div><?php

                                    break;

                                case 'limit_users_modify_admin_email': ?>

                            <div class="atp-form-control inspry_toolkit_limit_users_modify_admin_email_custom_option">
                                <label for="">Select Users</label>
                                <select name="inspry_toolkit_limit_users_modify_admin_email_user_list[]" multiple="multiple" class="js-select2-multi user">
                                    <?php
                                    $admins = get_users( array('role' => 'administrator', 'order' => 'ASC', 'orderby' => 'ID' ) );
                                    foreach ( $admins as $admin ) {
                                    ?>
                                        <option value="<?php echo esc_attr( $admin->ID ); ?>" <?php if ( !empty( get_option( 'inspry_toolkit_limit_users_modify_admin_email_user_list' ) ) ) {
                                                                                                if ( in_array( $admin->ID, get_option( 'inspry_toolkit_limit_users_modify_admin_email_user_list' ) ) ) {
                                                                                                    echo esc_attr( 'selected="selected"' );
                                                                                                }
                                                                                            } ?>>
                                            <?php echo esc_html( $admin->user_login ); ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div><?php

                                    break;

                                case 'disable_admin_notice': ?>

                            <div class="atp-form-control inspry_toolkit_disable_admin_notice_custom_option">
                                <label for="">Select Users</label>
                                <select name="inspry_toolkit_disable_admin_notice_user_list[]" multiple="multiple" class="js-select2-multi user">
                                    <?php
                                    $admins = get_users( array( 'role' => 'administrator', 'order' => 'ASC', 'orderby' => 'ID' ) );
                                    foreach ( $admins as $admin ) {
                                    ?>
                                        <option value="<?php echo esc_attr( $admin->ID ); ?>" <?php if ( !empty( get_option ( 'inspry_toolkit_disable_admin_notice_user_list' ) ) ) {
                                                                                                if ( in_array( $admin->ID, get_option ( 'inspry_toolkit_disable_admin_notice_user_list' ) ) ) {
                                                                                                    echo esc_attr( 'selected="selected"' );
                                                                                                }
                                                                                            } ?>>
                                            <?php echo esc_html( $admin->user_login ); ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div><?php
                                    break;

                                case 'remove_site_health': ?>

                            <div class="atp-form-control inspry_toolkit_remove_site_health_custom_option">
                                <label for="">Select Users</label>
                                <select name="inspry_toolkit_remove_site_health_user_list[]" multiple="multiple" class="js-select2-multi user">

                                    <?php foreach ( $admins as $admin ) { ?>
                                        <option value="<?php echo esc_attr( $admin->ID ); ?>" <?php if ( !empty( get_option( 'inspry_toolkit_remove_site_health_user_list' ) ) ) {
                                                                                                if ( in_array( $admin->ID, get_option( 'inspry_toolkit_remove_site_health_user_list' ) ) ) {
                                                                                                    echo esc_attr( 'selected="selected"' );
                                                                                                }
                                                                                            } ?>>
                                            <?php echo esc_html( $admin->user_login ); ?></option>
                                    <?php }  ?>

                                </select>
                            </div><?php

                                    break; ?>

                    <?php } ?>
                </div>
            </div>
        <?php } ?>
    </div>
<?php
}
