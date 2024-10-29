<?php
// Standard WP check if direct
if (!function_exists('add_action')) {
    exit();
}

function inspry_toolkit_tools_options_html(){

?>
    <div id="fifth-panel" class="atp-panel" data-id="radio5">
        <div class="atp-top-content">
            <h2 class="atp-sub-head">Import/Export Settings</h2>
        </div>
        <div class="atp-form-grid">
            <div class="atp-label atp-max-310">
                <h3>Import Settings</h3>
                <p>Import the plugin settings from a .json file. This file can be obtained by exporting the settings on another site.</p>
            </div>
            <div class="atp-label-content">
                <form method="post" enctype="multipart/form-data">
                    <div class="atp-file-input">
                        <input type="file" name="import_file" required class="form-control-file" id="exampleFormControlFile1"/>
                    </div>
                    <div>
                        <input type="hidden" name="inspry_toolkit_action" value="import_settings" />
                        <?php submit_button(__('Import Settings'), 'secondary', 'agency_toolkit_import', false); ?>
                    </div>
                </form>
            </div>
        </div>
        
        <div class="atp-form-grid">
            <div class="atp-label atp-max-310">
                <h3>Export Settings</h3>
                <p>Export the plugin settings for this site as a .json file. This allows you to easily import the configuration into another site.</p>
            </div>
            <div class="atp-label-content">
                <div>
                    <form method="post">
                        <input type="hidden" name="inspry_toolkit__action" value="export_settings" />
                        <?php submit_button(__('Export Settings'), 'secondary', 'agency_toolkit_export', false); ?>
                    </form>
                </div>
            </div>
        </div>
        
    </div>
<?php
} 