<?php
/**
 * Use the DeployBot API to get details about the recent deployments on a site.
 *
 * In order to use this, two constants must be defined in your site's wp-config.php file:
 *
 * - DEPLOYBOT_COUNTER_DOMAIN:  Your DeployBot account domain, e.g. "growella.deploybot.com".
 * - DEPLOYBOT_COUNTER_API_KEY: Your DeployBot API key, generated via the "Developer API" settings
 *                              page in DeployBot.
 *
 * @package Growella\EngineeringBlog
 */

namespace Growella\EngineeringBlog\DeployBotCounter;

/**
 * Retrieve the latest deployment from the DeployBot API.
 *
 * @param int $environment_id The DeployBot environment ID.
 * @return stdClass|WP_Error The API response from DeployBot, or a WP_Error object.
 */
function get_latest_deployment( $environment_id ) {
	if ( ! defined( 'DEPLOYBOT_COUNTER_DOMAIN' ) || ! defined( 'DEPLOYBOT_COUNTER_API_KEY' ) ) {
		return new \WP_Error(
			'credentials',
			__( 'One or both of the required DeployBot constants are missing from your configuration.', 'growella-engineering' )
		);
	}

	$endpoint    = sprintf( 'https://%s/api/v1/deployments', DEPLOYBOT_COUNTER_DOMAIN );
	$request_uri = add_query_arg( 'environment_id', (int) $environment_id, $endpoint );
	$cache_key   = sprintf( 'deploybot_counter_%s', substr( md5( $request_uri ), 0, 8 ) );

	if ( $cached = get_transient( $cache_key ) ) {
		return $cached;
	}

	$response = wp_remote_get( $request_uri, array(
		'headers' => array(
			'X-Api-Token' => DEPLOYBOT_COUNTER_API_KEY,
		),
	) );

	if ( is_wp_error( $response ) ) {
		return $response;
	}

	$deployment = wp_remote_retrieve_body( $response );

	// Cache the result.
	set_transient( $cache_key, $deployment, HOUR_IN_SECONDS );

	return $deployment;
}
