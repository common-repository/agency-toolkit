<?php

// Standard WP check if direct
if ( ! function_exists( 'add_action' ) ) {
	exit;
}

add_action( 'cron_called', 'inspry_toolkit_verify_files' );

add_filter( 'cron_schedules', function ( $schedules ) {
	$schedules['three_minute'] = [
		'interval' => 180,
		'display'  => __( 'three Minute', 'inspry-toolkit' ),
	];
	return $schedules;
} );

// Schedule an action if it's not already scheduled
add_action( 'init', 'inspry_toolkit_wp_custom_cron' );

function inspry_toolkit_wp_custom_cron() {
	if ( ! wp_next_scheduled( 'cron_called' ) ) {
		wp_schedule_event( time(), 'daily', 'cron_called' );
	}
}

// Perform the check
function inspry_toolkit_verify_files() {

	// Get checksums via API.
	$checksums = inspry_toolkit_get_checksums();

	if ( ! $checksums ) {
		return;
	}

	// Loop files and match checksums.
	$matches = inspry_toolkit_match_checksums( $checksums );

	if ( ! $matches ) {
		return;
	}

	// Notification mail.
	inspry_toolkit_notify_admin( $matches );
}

// Get file checksums.
function inspry_toolkit_get_checksums() {

	// Blog information.
	$version  = get_bloginfo( 'version' );
	$language = get_locale();

	// Transient name.
	$transient = sprintf(
		'checksums_%s',
		base64_encode( $version . $language )
	);

	// Read from cache.
	$checksums = get_site_transient( $transient );

	if ( $checksums ) {
		return $checksums;
	}

	// Start API request.
	$response = wp_remote_get(
		add_query_arg(
			[
				'version' => $version,
				'locale'  => $language,
			],
			'https://api.wordpress.org/core/checksums/1.0/'
		)
	);

	// Check response code.
	if ( wp_remote_retrieve_response_code( $response ) != 200 ) {
		return;
	}

	// JSON magic.
	$json = json_decode( wp_remote_retrieve_body( $response ) );

	// Exit on JSON error.
	if ( json_last_error() !== JSON_ERROR_NONE ) {
		return;
	}

	// Checksums exists?
	if ( empty( $json->checksums ) ) {
		return;
	}

	// Eat it.
	$checksums = $json->checksums;

	// Save into the cache.
	set_site_transient(
		$transient,
		$checksums,
		DAY_IN_SECONDS
	);

	return $checksums;
}

// Matching of MD5 hashes
function inspry_toolkit_match_checksums( $checksums ) {

	// Ignore files filter.
	$ignore_files = (array) apply_filters(
		'checksum_verifier_ignore_files',
		[
			'wp-config-sample.php',
            "wp-includes/version.php",
            "readme.html", // Default readme file.
            "readme-ja.html", // Japanese readme, shipped up to 3.9 (ja).
            "liesmich.html", // German readme (de_DE).
            "olvasdel.html", // Hungarian readme (hu_HU).
            "procitajme.html", // Croatian readme (hr).
        ]
    );

    // Init matches.
    $matches = [];

    // Loop files.
    foreach ($checksums as $file => $checksum) {
        // Skip ignored files and wp-content directory.
        if (
            0 === strpos($file, "wp-content/") ||
            in_array($file, $ignore_files, true)
        ) {
            continue;
        }

        // File path.
        $file_path = ABSPATH . $file;

        // File check.
        if (0 !== validate_file($file_path) || !file_exists($file_path)) {
            continue;
        }

        // Compare MD5 hashes.
        if (md5_file($file_path) !== $checksum) {
            $matches[] = $file;
        }
    }

    return $matches;
}

// Admin notification mail.
function inspry_toolkit_notify_admin( $matches )
{
    // Get recipient email address.
    $to = get_option(
        "inspry_toolkit_checksum_verification_for_wordpress_core_files_email_send"
    );

    // Get admin email address if nothing is stored.
    if ( !is_email( $to ) ) {
        $to = get_bloginfo( "admin_email" );
    }

    // Mail subject.
    $subject = wp_specialchars_decode(
        sprintf(
            " [%s] %s ",

            get_bloginfo("name"),

            esc_html__( "Checksum Verifier Alert" )
        ),
        ENT_QUOTES
    );

    // Mail body.
    $body = wp_specialchars_decode(
        sprintf(
            "%s:\r\n\r\n- %s",

            esc_html__(
                "Official checksums do not match for the following files"
            ),

            implode("\r\n- ", $matches)
        ),
        ENT_QUOTES
    );

    // Send!
    wp_mail( $to, $subject, $body );

    // Write to log.
    if ( defined( "WP_DEBUG_LOG" ) && WP_DEBUG_LOG ) {
        // @codingStandardsIgnoreLine Ignore this call for now...
        error_log(
            sprintf(
                "%s: %s",

                esc_html__("Checksums do not match for the following files"),

                implode(", ", $matches)
            )
        );
    }
}