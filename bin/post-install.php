#!/usr/bin/env php
<?php
/**
 * Commands to have Composer run post-install.
 *
 * @package Growella
 */

define( 'BASEDIR', dirname( __DIR__ ) . '/' );

/**
 * Copy the sample wp-config.php file from the .docker directory into BASEDIR.
 */
if ( ! file_exists( BASEDIR . 'wp-config.php' ) ) {
	echo 'Generating the default wp-config.php file' . PHP_EOL;
	copy( BASEDIR . '.docker/wordpress/wp-config.php', BASEDIR . 'wp-config.php' );
}
