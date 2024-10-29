<?php
// Standard WP check if direct
if (!function_exists('add_action')) {
    exit();
}

function inspry_toolkit_performance_options_html(){

    global $toolkit_performance_options;
    ?>

    <div id="third-panel" class="atp-panel" data-id="radio3">
        <div class="atp-top-content">
            <h2 class="atp-sub-head">Performance</h2>
        </div>
        <?php
            foreach ( $toolkit_performance_options as $option ) {
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
                <span class="atp-tooltip" data-tip="<?php echo esc_attr( $option['details'] ); ?>">
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

                        case 'limit_post_revisions':?>

                            <div class="atp-form-control inspry_toolkit_limit_post_revisions_custom_option">
                                <label for="">Limit Amount</label>
                                <select class="js-select2-multi" name="inspry_toolkit_limit_post_revisions_number">
                                    <option value="0" <?php if ( get_option( 'inspry_toolkit_limit_post_revisions_number' ) == 0 ) {
                                                            echo esc_attr( 'selected="selected"' );
                                                        } ?>>0 - Disable</option>
                                    <option value="1" <?php if ( get_option( 'inspry_toolkit_limit_post_revisions_number' ) == 1 ) {
                                                            echo esc_attr( 'selected="selected"' );
                                                        } ?>>1</option>
                                    <option value="3" <?php if ( get_option( 'inspry_toolkit_limit_post_revisions_number' ) == 3 ) {
                                                            echo esc_attr( 'selected="selected"' );
                                                        } ?>>3</option>
                                    <option value="5" <?php if ( get_option( 'inspry_toolkit_limit_post_revisions_number' ) == 5 ) {
                                                            echo esc_attr( 'selected="selected"' );
                                                        } ?>>5</option>
                                    <option value="10" <?php if ( get_option( 'inspry_toolkit_limit_post_revisions_number' ) == 10 ) {
                                                            echo esc_attr( 'selected="selected"' );
                                                        } ?>>10</option>
                                    <option value="15" <?php if ( get_option( 'inspry_toolkit_limit_post_revisions_number' ) == 15 ) {
                                                            echo esc_attr( 'selected="selected"' );
                                                        } ?>>15</option>
                                    <option value="20" <?php if ( get_option( 'inspry_toolkit_limit_post_revisions_number' ) == 20 ) {
                                                            echo esc_attr( 'selected="selected"' );
                                                        } ?>>20</option>
                                </select>
                            </div> <?php

                        break;?>

                <?php } ?>
            </div>
        </div>
        <?php }?>
    </div>
<?php
}