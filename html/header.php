<?php
// Standard WP check if direct
if (!function_exists('add_action')) {
    exit();
}

function inspry_toolkit_page_header_html() {
    $screen = get_current_screen();
?>
    <div class="atp-header">
        <div class="atp-left-side-header">
            <a class="atp-logo" href="<?php echo admin_url( 'admin.php?page=inspry-agency-toolkit' );?>">
                <img src="<?php echo plugin_dir_url(__DIR__) . '/assets/images/agency-toolkit-logo.svg'; ?>" alt=""> Agency Toolkit
            </a>
        </div>
        <div class="atp-right-side-header">
            <ul>
                <li class="version-link">
                    v<?php echo esc_html( INSPRY_TOOLKIT_CURRENT_VERSION );?>
                </li>
                <li class="menu-link <?php
                    if ( $screen->id == 'toplevel_page_inspry-agency-toolkit' ) {
                        echo esc_attr('active');
                    } else {
                        echo '';
                    }
                ?>">
                    <a href="<?php echo admin_url( 'admin.php?page=inspry-agency-toolkit' );?>">Options</a>
                </li>
                
                <li class="menu-link <?php
                    if ( $screen->id == 'admin_page_inspry-toolkit-faqs' ) {
                        echo esc_attr( 'active' );
                    } else {
                        echo '';
                    }
                ?>" >
                    <a href="<?php echo admin_url( 'admin.php?page=inspry-toolkit-faqs' );?>">FAQs</a>
                </li>
            </ul>
        </div>
    </div>
<?php } ?>