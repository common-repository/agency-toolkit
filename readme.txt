=== Agency Toolkit ===
Contributors: inspry
Tags: health, maintenance, disable, email, notification, automatic, revisions, xml-rpc, pingback, trackback, rsd, htaccess
Tested up to: 6.6.1
Requires at least: 5.5
Requires PHP: 7.2
Stable tag: 1.0.22
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

== Description ==

The Agency Toolkit plugin provides a lightweight way for agency owners, freelancers and website owners to quickly debug, optimize, and streamline the WordPress experience without needing a dozen or more additional plugins. This plugin came out of a need for our own agency to standardize the WordPress settings across all of our maintenance clients. This plugin saves time and maintenance by reducing the need for many other third party plugins and ensures only privileged users can access these settings.

Each setting can be enabled or disabled as needed to keep things light and customized to your own needs. Currently, we support the following with more to be added:

**General Settings:**

* Limit the users who can view the Agency Toolkit Settings Page 
* Enable maintenance mode 
* Enable the WordPress debugger 
* Enable a custom agency footer with a name, URL and email in the WordPress Dashboard 
* Enable a custom agency logo on the WordPress login screen 
* Show Environment Indicator in Admin Bar 

**Security Settings:**

* Disable theme and plugin editors 
* Limit the users who can install and update plugins and themes 
* Hide WordPress version generator in front-end source code 
* Limit the users who can view Site Health 
* Secure the wp-config.php file using .htaccess 
* Stop User Enumeration 
* Checksum verification for WordPress core files 
* Limit users who can modify Admin Email Address 
* Override the [Disable Admin Notices Individually](https://wordpress.org/plugins/disable-admin-notices/plugin) to show all admin notices 

**Performance Settings:**

* Limit or disable post revisions 
* Disable emoticons 
* Disable pingback and trackback notification emails 
* Disable self-pingbacks 
* Disable XML-RPC 
* Disable Media Comments 
* Remove RSD links 

**Email Notifications Settings:**

* Disable admin notification emails 
* Globally change email sender 
* Disable WordPress Admin Email Verification prompt 
* Change admin email address shared in user emails 
* Receive email notifications when specific plugins are updated 

You can also export and import plugin settings via .json file to ensure you have the same settings across all of your websites. 

**What if I lock myself out of the Agency Toolkit interface?**

We have you covered. Simply go to **'domain.com/wp-admin/admin.php?page=inspry-agency-toolkit&rescue=email'** where **'domain.com'** is the WordPress website root domain and 'email' is the email associated with your WordPress admin user account.  This will send a new email to your email address with a link to reset the 'Limit the users who can view the Agency Toolkit Settings Page' setting.  This way all WordPress admin users can access access the Agency Toolkit plugin interface.  You can then re-select the users who should be able to access the interface in that setting.

See an option or tweak that you would find useful? Just email us and let us know. 

Enjoy!

== Installation ==

1. Install the plugin through the WordPress repository, upload the zip file via the WordPress Dashboard Plugins page or upload to your website's plugins folder.
2. Activate the plugin through the Plugin dashboard in WordPress.
3. Customize to your needs in your WordPress Dashboard's left sidebar under 'Agency Toolkit'.

== Changelog ==
= 1.0.22 =
* Bug Fix: Fixed an issue where admin emails were still being sent to administrators, despite the option being disabled, on sites with WooCommerce installed.

= 1.0.21 =
* Bug Fix: Modified the correction from 1.0.20.

= 1.0.20 =
* Bug Fix: Corrected admins still receiving password update emails on different PHP/hosting versions.

= 1.0.19 =
* Added auto deployment with 10up's Github action.

= 1.0.18 =
* Confirmed: Compatibility with WordPress 6.6.

= 1.0.17 =
* Confirmed: Compatibility with WordPress 6.5.3.
* Notice Fix: Resolved notice for function 'inspry_toolkit_run_stop_user_emun_rule'.

= 1.0.16 =
* Confirmed: Compatibility with WordPress 6.4

= 1.0.15 =
* Bug Fix: Conflict with table and form plugins export function has been fixed.
* Bug Fix: Removed Control WP Core Updates feature since multiple issues arose from keeping it in the plugin.

= 1.0.14 =
* Bug Fix: Updated logic for getting the wp-config.php file path.
* Bug Fix: Write changes to wp-config.php file correctly.
* Bug Fix: Placed a check for constants already being defined.

= 1.0.13 =
* Bug Fix: Removed WP Debugger feature since multiple issues arose from keeping it in the plugin.

= 1.0.12 =
* Tweak: Set environmental indicator development URL field to be optional.

= 1.0.11 =
* Bug Fix: Error no longer shown when changing the Limit Amount for Post Revisions.
* Bug Fix: Custom agency logo on login page dimensions are now proportional.
* Bug Fix: Enabling the WP Debugger option on some sites and servers no longer produce an error.
* Bug Fix: Enabling the WP Debugger option on some sites and servers will actually enable the debug log correctly now.
* Bug Fix: Adding a custom agency footer no longer produces an error.
* Tweak: When saving changes, the most recent active tab is shown instead of redirecting back to the General tab.
* Tweak: When enabling the Control WordPress Core auto-updates option, a choice is now required.
* Tweak: Changed various option labels to be more clear.

= 1.0.10 =
* Security Fix: Escaped all PHP strings that are printed out to the page. 
* Bug Fix: Labels corrected and minor styling changes.
* Bug Fix: Debug log and display now works on WP Engine hosted websites.
* Bug Fix: Replaced PHP short tags with normal tags. Servers with short tags disabled can now activate the plugin.

= 1.0.9 =
* New Feature: Updated plugin logo and user interface with settings now categorized by the type of setting
* New Feature: Show Environment Indicator in Admin Bar to differentiate visually between a staging website and production website
* New Feature: Control WordPress Core auto-updates to select which core auto-updates run in the background
* New Feature: Agency Toolkit Admin Access Reset functionality allows any WordPress admin to reset who has access to the Agency Toolkit plugin interface in case of being lock out
* New Feature: WordPress 6.2 refactoring
* Bug Fix: Agency Toolkit plugin now is hidden from the WP dashboard correctly for users without the proper privileges 
* Bug Fix: Site Health now cannot be directly accessed via URL for users without the proper privileges 

= 1.0.8 =
* Bug Fix: Wrong option called on admin notify function, corrected to use proper option

= 1.0.7 =
* New Feature: Limit the users who can install and update plugins and themes (rather than being disabled for all users as a previous feature)
* New Feature: Limit the users who can view Site Health (rather than being disabled for all users as a previous feature)
* New Feature: Disable all admin notification emails including: new user notification to site admin, password change notification to admin, automatic WordPress core update e-mail, automatic WordPress plugin update e-mail, automatic WordPress theme update e-mail (previous feature only disabled automatic core update emails)
* New Feature: Disable Admin Email Notification Prompts upon login
* New Feature: Change Admin Email Address shared in user emails to a specified email address
* New Feature: Email an alert notification to specified users if selected plugins are updated
* New Feature: Daily Checksum verification for WordPress core files
* New Feature: Limit users who can modify General Settings -> Administration Admin Email Address
* New Feature: Stop User Enumeration function for security
* New Feature: Disable Media Comments removes the comments field on new attachment uploads to prevent spam
* New Feature: Override the Disable Admin Notices Individually plugin to show all admin notices
* New Feature: Ability to export and import plugin settings via .json file
* Tweak: Changed various setting option labels to be more clear.
* Confirmed: Compatibility with PHP 8.0 ad PHP 8.1
* Confirmed: Compatibility with WordPress 6.1

= 1.0.6 =
* Bug Fix: Removed PHP warnings

= 1.0.5 =
* Bug Fix: Disable emoticons option no longer removes classic editor features

= 1.0.4 =
* Bug Fix: Websites hosted on WPEngine now properly disable plugin and theme installs and updates when enabled

= 1.0.3 =
* New Feature: Hide Site Health from the WordPress backend

= 1.0.2 =
* Bug Fix: Limit Admins PHP warning if admins are selected in the options

= 1.0.1 =
* New Feature: Globally Change Email Sender Option so users can force all emails to come from a specific email address and name by default
* Bug Fix: Limit Admins error if no admins were selected in the options

= 1.0 =
* Initial release
