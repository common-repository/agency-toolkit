<?php
// Standard WP check if direct
if (!function_exists('add_action')) {
    exit();
}

function inspry_toolkit_general_options_html(){

    global $toolkit_options;
    $admins = get_users( array( 'role' => 'administrator', 'order' => 'ASC', 'orderby' => 'ID' ) );
    ?>
<div id="first-panel" class="atp-panel active" data-id="radio1">
    <div class="atp-top-content">
        <h2 class="atp-sub-head">General</h2>
        <p><i>Disclaimer</i>: Since many of these options change the fundamental settings of your WordPress install, we
            recommend testing thoroughly to ensure there are no unintended consequences. </p>
    </div>

    <?php
            foreach ( $toolkit_options as $option ) {
                // Get checked option
                $checked = get_option( 'inspry_toolkit_' . $option["name"] );

                // Determine if checked or not
                if ( $checked == 1 ) {
                    $checked = 'checked';
                } else {
                    $checked = '';
            }?>
    <div class="atp-form-grid">
        <div class="atp-label">
            <?php echo esc_html( $option["description"] ); ?>
            <span class="atp-tooltip" data-tip="<?php echo esc_attr( $option['details'] ); ?>">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                    <path
                        d="M5.30252 5.25C5.43966 4.86014 5.71036 4.5314 6.06666 4.322C6.42296 4.11259 6.84188 4.03605 7.24921 4.10592C7.65654 4.17578 8.026 4.38756 8.29215 4.70373C8.5583 5.01989 8.70397 5.42006 8.70335 5.83333C8.70335 7 6.95335 7.58333 6.95335 7.58333M7.00002 9.91667H7.00585M12.8334 7C12.8334 10.2217 10.2217 12.8333 7.00002 12.8333C3.77836 12.8333 1.16669 10.2217 1.16669 7C1.16669 3.77834 3.77836 1.16667 7.00002 1.16667C10.2217 1.16667 12.8334 3.77834 12.8334 7Z"
                        stroke="#667085" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </span>
        </div>
        <div class="atp-label-content">
            <div class="atp-check-box-design atp-main-check-box">

                <input type="checkbox" id="<?php echo esc_attr( 'inspry_toolkit_' . $option["name"] ); ?>"
                    name="<?php echo esc_attr( 'inspry_toolkit_' . $option["name"] ); ?>" value="1"
                    <?php checked( 1, get_option( 'inspry_toolkit_' . $option["name"] ), false ); ?>
                    <?php echo esc_html( $checked ); ?> />
                <label for="<?php echo esc_attr( 'inspry_toolkit_' . $option["name"] ); ?>"> Enabled </label>
            </div>
            <?php 
                        switch ( $option['name'] ){

                            case 'backend_footer':?>

            <div class="atp-form-control inspry_toolkit_backend_footer_custom_option">
                <label for="">Agency Name</label>
                <input type="text" name="inspry_toolkit_backend_footer_agency_name" placeholder="e.g. Agency"
                    value="<?php echo esc_attr( get_option( 'inspry_toolkit_backend_footer_agency_name' ) ); ?>" required>
            </div>
            <div class="atp-form-control inspry_toolkit_backend_footer_custom_option">
                <label for="">Agency URL</label>
                <input type="url" name="inspry_toolkit_backend_footer_agency_url"
                    placeholder="e.g. https://www.agency.com/"
                    value="<?php echo esc_url( get_option( 'inspry_toolkit_backend_footer_agency_url' ) ); ?>" required>
            </div>
            <div class="atp-form-control inspry_toolkit_backend_footer_custom_option">
                <label for="">Agency Email</label>
                <input type="email" name="inspry_toolkit_backend_footer_agency_email"
                    value="<?php echo esc_attr( get_option( 'inspry_toolkit_backend_footer_agency_email' ) ); ?>"
                    placeholder="e.g. support@agency.com" required />
            </div><?php
                            
                            break;

                            case 'backend_logo':?>

            <div class="atp-form-control inspry_toolkit_backend_logo_custom_option">
                <label for="">Logo Image URL</label>
                <input type="text" name="inspry_toolkit_backend_logo_image" id="inspry_toolkit_backend_logo_image"
                    value="<?php echo esc_url( get_option( 'inspry_toolkit_backend_logo_image' ) ); ?>" />
                <input type="button" id="upload_backend_logo_image_button" class="button-primary"
                    value="Choose from media library" />
            </div><?php

                            break;

                            case 'limit_admins': ?>

            <div class="atp-form-control inspry_toolkit_limit_admins_custom_option">
                <label for="">Select Users</label>
                <select name="inspry_toolkit_limit_admins_list[]" class="js-select2-multi user" multiple="multiple">

                    <?php foreach ( $admins as $admin ) { ?>

                    <option value="<?php echo esc_attr( $admin->ID ); ?>" <?php if ( !empty( get_option( 'inspry_toolkit_limit_admins_list' ) ) ) {
                                                    if ( in_array( $admin->ID, get_option( 'inspry_toolkit_limit_admins_list' ) ) ) {
                                                        echo esc_attr( 'selected="selected"' );
                                                    }
                                                } ?>><?php echo esc_html( $admin->user_login ); ?></option>

                    <?php } ?>
                </select>
            </div><?php
                            break;

                            case 'maintenance_mode':?>

            <div class="atp-form-control inspry_toolkit_maintenance_mode_custom_option">
                <label for="">Maintenance Mode Heading</label>
                <input type="text" name="inspry_toolkit_maintenance_mode_heading"
                    value="<?php echo esc_attr( get_option( 'inspry_toolkit_maintenance_mode_heading' ) ); ?>"
                    placeholder="Maintenance mode heading" />
            </div>
            <div class="atp-form-control inspry_toolkit_maintenance_mode_custom_option">
                <label for="">Maintenance Mode Body</label>
                <input type="text" name="inspry_toolkit_maintenance_mode_sentence"
                    value="<?php echo esc_attr( get_option( 'inspry_toolkit_maintenance_mode_sentence' ) ); ?>"
                    placeholder="[Site Name] is under maintenance. Please check back later." />
            </div><?php
                            break;

                            case 'remove_site_health':?>

            <div class="atp-form-control inspry_toolkit_remove_site_health_custom_option">
                <label for="">Select users</label>
                <select name="inspry_toolkit_remove_site_health_user_list[]" multiple="multiple"
                    class="js-select2-multi user">

                    <?php foreach ( $admins as $admin ) { ?>
                    <option value="<?php echo esc_attr( $admin->ID ); ?>" <?php if ( !empty( get_option( 'inspry_toolkit_remove_site_health_user_list' ) ) ) {
                                                        if ( in_array( $admin->ID, get_option( 'inspry_toolkit_remove_site_health_user_list') ) ) {
                                                            echo esc_attr( 'selected="selected"' );
                                                        }
                                                    } ?>><?php echo esc_html( $admin->user_login ); ?></option>
                    <?php }  ?>

                </select>
            </div><?php

                            break;
                            
                            case 'manage_environment_indicator':?>

            <div class="atp-form-control inspry_toolkit_manage_environment_indicator_custom_option">
                <label for="">Select Users</label>
                <select name="inspry_toolkit_development_environment_user_list[]" multiple="multiple"
                    class="js-select2-multi user">

                    <?php

                                            foreach ( $admins as $admin ) {
                                                $selected = '';
                                                $selected_user = get_option( 'inspry_toolkit_development_environment_user_list' );
                                                if ( !empty( $selected_user ) && in_array( $admin->ID, $selected_user) ) {
                                                        $selected = esc_attr( 'selected="selected"' );
                                                }?>
                    <option value="<?php echo esc_attr( $admin->ID ); ?>" <?php echo esc_attr( $selected ); ?>>
                        <?php echo esc_html( $admin->user_login ); ?>
                    </option>

                    <?php } ?>

                </select>
            </div>
            <div class="atp-form-control inspry_toolkit_manage_environment_indicator_custom_option">
                <label for="">Development Host Name</label>
                <input type="text" name="inspry_toolkit_development_environment_host_name"
                    value="<?php echo esc_attr( get_option( 'inspry_toolkit_development_environment_host_name' ) ); ?>" />
            </div>
            <div class="atp-form-control inspry_toolkit_manage_environment_indicator_custom_option">
                <label for="">Select Color</label>
                <select name="inspry_toolkit_manage_development_environment_banner_color[]" class="js-select2-multi">

                    <?php
                                        $colors = [ 'red' => 'Red', 'yellow' => 'Yellow' ];
                                        foreach ( $colors as $key => $value ) {

                                            $selected_value = get_option( 'inspry_toolkit_manage_development_environment_banner_color' );
                                            $selected_class = '';
                                            if ( !empty( $selected_value ) ) {
                                                if ( in_array( $key, $selected_value ) ) {
                                                    $selected_class = esc_attr( 'selected="selected"' );
                                                }
                                            } ?>

                    <option value="<?php echo esc_attr( $key ) ; ?>" <?php echo esc_attr ( $selected_class ) ; ?>><?php echo esc_html( $value ); ?>
                    </option>

                    <?php }  ?>
                </select>
            </div>
            <?php 
                break;
            } 
            ?>
        </div>
    </div>
    <?php }?>
</div>
<?php
}