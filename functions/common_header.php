<?php
// Disable magic quotes at runtime. Magic quotes are added using wpdb later in wp-settings.php.
set_magic_quotes_runtime( 0 );
@ini_set( 'magic_quotes_sybase', 0 );

// Set default timezone in PHP 5.
if ( function_exists( 'date_default_timezone_set' ) )
	date_default_timezone_set( 'UTC' );

wp_favicon_request();
function wp_favicon_request() {
	if ( '/favicon.ico' == $_SERVER['REQUEST_URI'] ) {
		header('Content-Type: image/vnd.microsoft.icon');
		header('Content-Length: 0');
		exit;
	}
}