<?php
// Standard WP check if direct
if ( !function_exists( 'add_action' ) ) {
    exit();
}

function inspry_toolkit_email_notification_options_html(){

    global $toolkit_email_notification_options;
    $all_plugins = get_plugins(); ?>

    <div id="fourth-panel" class="atp-panel"  data-id="radio4">
        <div class="atp-top-content">
            <h2 class="atp-sub-head">Email Notifications</h2>
        </div>
        <?php
            foreach ( $toolkit_email_notification_options as $option ) {
            // Get checked option
            $checked = get_option( 'inspry_toolkit_' . $option["name"] );

            // Determine if checked or not
            if ( $checked == 1 ) {
                $checked = 'checked';
            } else {
                $checked = '';
            }

            // Display option
        ?>
        <div class="atp-form-grid">
            <div class="atp-label">
                <?php echo esc_html( $option["description"] ); ?>
                <span class="atp-tooltip" data-tip="<?php echo  esc_attr( $option['details'] ); ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                        <path d="M5.30252 5.25C5.43966 4.86014 5.71036 4.5314 6.06666 4.322C6.42296 4.11259 6.84188 4.03605 7.24921 4.10592C7.65654 4.17578 8.026 4.38756 8.29215 4.70373C8.5583 5.01989 8.70397 5.42006 8.70335 5.83333C8.70335 7 6.95335 7.58333 6.95335 7.58333M7.00002 9.91667H7.00585M12.8334 7C12.8334 10.2217 10.2217 12.8333 7.00002 12.8333C3.77836 12.8333 1.16669 10.2217 1.16669 7C1.16669 3.77834 3.77836 1.16667 7.00002 1.16667C10.2217 1.16667 12.8334 3.77834 12.8334 7Z" stroke="#667085" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </span>
            </div>
            <div class="atp-label-content">
                <div class="atp-check-box-design atp-main-check-box">
                    <input type="checkbox" id="<?php echo esc_attr( 'inspry_toolkit_' . $option["name"] ); ?>" name="<?php echo esc_attr( 'inspry_toolkit_' . $option["name"] ); ?>" value="1" <?php checked( 1, get_option( 'inspry_toolkit_' . $option["name"] ), false ); ?> <?php echo esc_html( $checked ); ?> />
                    <label for="<?php echo esc_attr( 'inspry_toolkit_' . $option["name"] ); ?>"> Enabled </label>
                </div>
                <?php 
                    switch ( $option['name'] ){

                        case 'change_email_sender':?>
                        
                            <div class="atp-form-control inspry_toolkit_change_email_sender_custom_option">
                                <label for="">Email Sender Address</label>
                                <input type="email" name="inspry_toolkit_change_email_sender_address" value="<?php echo esc_attr( get_option( 'inspry_toolkit_change_email_sender_address' ) ); ?>" />
                            </div>
                            <div class="atp-form-control inspry_toolkit_change_email_sender_custom_option">
                                <label for="">Email Sender Name</label>
                                <input type="text" name="inspry_toolkit_change_email_sender_name" value="<?php echo esc_attr( get_option( 'inspry_toolkit_change_email_sender_name' ) ); ?>" />
                            </div><?php

                        break;
                        
                        case 'change_user_notifications_email':?>

                            <div class="atp-form-control inspry_toolkit_change_user_notifications_email_custom_option">
                                <label for="">Email Address</label>
                                <?php
                                    if ( get_option( 'inspry_toolkit_change_user_notifications_email_sender' ) == '' ) {
                                        $admin_email = get_option( 'admin_email' ); ?>
                                        <input type="text" name="inspry_toolkit_change_user_notifications_email_sender" value="<?php echo esc_attr( $admin_email ) ;  ?>" />
                                    <?php } else { ?>
                                        <input type="text" name="inspry_toolkit_change_user_notifications_email_sender" value="<?php echo esc_attr( get_option( 'inspry_toolkit_change_user_notifications_email_sender' ) ); ?>" />
                                <?php
                                } ?>
                            </div><?php
                        
                        break;
                        
                        case 'enable_plugin_update_admin_notifications': ?>

                            <div class="atp-form-control inspry_toolkit_enable_plugin_update_admin_notifications_custom_option">
                                <label for="">Select Users</label>
                                <select class="js-select2-multi user" name="inspry_toolkit_enable_plugin_update_admin_notifications_list[]" multiple="multiple">
                                    <?php
                                    $admins = get_users( array( 'role' => 'administrator', 'order' => 'ASC', 'orderby' => 'ID' ) );
                                    foreach ( $admins as $admin ) {
                                    ?>
                                        <option value="<?php echo esc_attr( $admin->ID ); ?>" <?php if ( !empty( get_option( 'inspry_toolkit_enable_plugin_update_admin_notifications_list' ) ) ) {
                                                if ( in_array( $admin->ID, get_option( 'inspry_toolkit_enable_plugin_update_admin_notifications_list' ) ) ) {
                                                    echo esc_attr( 'selected="selected"' );
                                                }
                                            } ?>><?php echo esc_html( $admin->user_login ); ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="atp-form-control inspry_toolkit_enable_plugin_update_admin_notifications_custom_option">
                                <label for="">Select Plugins</label>
                                <select name="inspry_toolkit_enable_plugin_update_admin_notifications_plugin_list[]" multiple="multiple" class="js-select2-multi plugin user">
                                    <?php
                                        $selcted_plugins = get_option( 'inspry_toolkit_enable_plugin_update_admin_notifications_plugin_list' );
                                        
                                        foreach ( $all_plugins as $key => $val ) {

                                            $plugin_basename = plugin_basename( $key );
                                            $active = is_plugin_active( $plugin_basename );
                                            $deactivated_label  = $active ? '' : ' (Deactivated)';
                                            ?>

                                            <option value="<?php echo esc_attr( $key ); ?>" <?php if ( !empty( $selcted_plugins ) ) {
                                                        if ( in_array( $key, $selcted_plugins ) ) {
                                                            echo esc_attr( 'selected="selected"' );
                                                        }
                                                    } ?>><?php echo esc_html( $val['Name'] ); ?> <?php echo esc_html( $deactivated_label ); ?>  </option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div><?php

                        break;?>

                <?php } ?>
            </div>
        </div>
        <?php }?>
    </div><?php
}