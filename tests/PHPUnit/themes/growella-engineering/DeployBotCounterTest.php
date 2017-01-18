<?php
/**
 * Tests for the deploy counter.
 */

namespace Growella\EngineeringBlog\DeployBotCounter;

use WP_Mock as M;
use Growella;

/**
 * @runTestsInSeparateProcesses
 */
class DeployBotCounterTest extends Growella\TestCase {

	protected $testFiles = array(
		'themes/growella-engineering/includes/deploybot-counter.php',
	);

	public function testGetLatestDeployment() {
		define( 'DEPLOYBOT_COUNTER_DOMAIN', 'growella.deploybot.com' );
		define( 'DEPLOYBOT_COUNTER_API_KEY', 'abc123' );

		$result = new \stdClass;

		M::wpFunction( 'add_query_arg' );

		M::wpFunction( 'get_transient', array(
			'return' => false,
		) );

		M::wpFunction( 'wp_remote_get', array(
			'return' => function( $url, $args ) {
				if ( ! isset( $args['headers']['X-Api-Token'] ) ) {
					$this->fail( 'Request fails to set X-Api-Token header' );
				}
			}
		) );

		M::wpFunction( 'is_wp_error', array(
			'return' => false,
		) );

		M::wpFunction( 'wp_remote_retrieve_body', array(
			'return' => $result,
		) );

		M::wpFunction( 'set_transient', array(
			'times'  => 1,
			'args'   => array( '*', $result, HOUR_IN_SECONDS ),
		) );

		$this->assertEquals( $result, get_latest_deployment( 123 ) );
	}

	public function testGetLatestDeploymentReturnsFromCache() {
		define( 'DEPLOYBOT_COUNTER_DOMAIN', 'growella.deploybot.com' );
		define( 'DEPLOYBOT_COUNTER_API_KEY', 'abc123' );

		$value = uniqid();

		M::wpFunction( 'add_query_arg' );

		M::wpFunction( 'get_transient', array(
			'return' => $value,
		) );

		$this->assertEquals( $value, get_latest_deployment( 123 ) );
	}

	public function testGetLatestDeploymentChecksGlobalConfigForDomain() {
		define( 'DEPLOYBOT_COUNTER_API_KEY', 'abc123' );

		M::wpPassthruFunction( '__' );

		$result = get_latest_deployment( 123 );

		$this->assertFalse( defined( 'DEPLOYBOT_COUNTER_DOMAIN' ) );
		$this->assertInstanceOf( '\WP_Error', $result );
		$this->assertArrayHasKey( 'credentials', $result->errors );
	}

	public function testGetLatestDeploymentChecksGlobalConfigForAPIKey() {
		define( 'DEPLOYBOT_COUNTER_DOMAIN', 'growella.deploybot.com' );

		M::wpPassthruFunction( '__' );

		$result = get_latest_deployment( 123 );

		$this->assertFalse( defined( 'DEPLOYBOT_COUNTER_API_KEY' ) );
		$this->assertInstanceOf( '\WP_Error', $result );
		$this->assertArrayHasKey( 'credentials', $result->errors );
	}

}
