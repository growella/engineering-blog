<?php
/**
 * Bootstrap the test suite.
 */

if ( ! defined( 'PROJECT' ) ) {
	define( 'PROJECT', __DIR__ . '/../wp-content/' );
}

if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/test-tools/' );
}

if ( ! defined( 'HOUR_IN_SECONDS' ) ) {
	define( 'HOUR_IN_SECONDS', 60 * 60 );
}

if ( ! file_exists( __DIR__ . '/../vendor/autoload.php' ) ) {
	throw new PHPUnit_Framework_Exception(
		'ERROR: You must use Composer to install the test suite\'s dependencies!' . PHP_EOL
	);
}

require_once __DIR__ . '/../vendor/autoload.php';
require_once ABSPATH . 'TestCase.php';
require_once ABSPATH . 'dummy-files/class-wp-error.php';

WP_Mock::setUsePatchwork( true );
WP_Mock::bootstrap();
WP_Mock::tearDown();
