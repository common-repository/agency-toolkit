<?php
// Standard WP check if direct
if (!function_exists('add_action')) {
    exit();
}

function inspry_toolkit_faqs(){
?>
    <div class="atp-option">
        <?php inspry_toolkit_page_header_html();?>
        <div class="atp-body-content">
            <div class="atp-head">
                <h1 class="atp-heding">Frequently Asked Questions</h1>
            </div>
            <div class="atp-faq-content">
                <div class="atp-faq-drawer">
                    <input class="atp-faq-drawer__trigger" id="atp-faq-drawer-01" type="checkbox" checked/>
                    <label class="atp-faq-drawer__title" for="atp-faq-drawer-01"> What is the Agency Tookit Plugin?</label>
                    <div class="atp-faq-drawer__content-wrapper">
                        <div class="atp-faq-drawer__content">
                            <p> The plugin is a lightweight, modularized plugin that includes all of the basic tweaks and optimizations most agencies and freelancers will need to configure on their client WordPress websites.  This all-in-one solution was made with performance in mind and replaces the need for dozens of small plugins that may add bloat or conflict with client WordPress sites.</p>
                        </div>
                    </div>
                </div>

                <div class="atp-faq-drawer">
                    <input class="atp-faq-drawer__trigger" id="atp-faq-drawer-02" type="checkbox" />
                    <label class="atp-faq-drawer__title" for="atp-faq-drawer-02"> Who is the Agency Toolkit plugin for?</label>
                    <div class="atp-faq-drawer__content-wrapper">
                        <div class="atp-faq-drawer__content">
                            <p>The plugin is built for agencies, freelancers, IT departments, webmasters and any other individuals who manage multiple WordPress websites who need to provide a uniform configuration setup for their websites.</p>
                        </div>
                     </div>
                </div>
                <div class="atp-faq-drawer">
                    <input class="atp-faq-drawer__trigger" id="atp-faq-drawer-03" type="checkbox" />
                    <label class="atp-faq-drawer__title" for="atp-faq-drawer-03">What if I lock myself out of the Agency Toolkit interface?</label>
                    <div class="atp-faq-drawer__content-wrapper">
                        <div class="atp-faq-drawer__content">
                            <p>We have you covered.  Simply go to 'domain.com/wp-admin/admin.php?page=inspry-agency-toolkit&rescue=email' where 'domain.com' is the WordPress website root domain and 'email' is the email associated with your WordPress admin user account.  This will send a new email to your email address with a link to reset the 'Limit the users who can view the Agency Toolkit Settings Page' setting.  This way all WordPress admin users can access access the Agency Toolkit plugin interface.  You can then re-select the users who should be able to access the interface in that setting.</p>
                        </div>
                     </div>
                </div>
        </div>
    </div>
<?php
}