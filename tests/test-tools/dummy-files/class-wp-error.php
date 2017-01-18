<?php
/**
 * Mock class for WP_Error.
 */

class WP_Error {

	public $errors = array();
	public $error_data = array();

	public function __construct( $code = '', $message = '', $data = '' ) {
		if ( empty( $code ) ) {
			return;
		}

		$this->errors[ $code ][] = $message;

		if ( ! empty( $data ) ) {
			$this->error_data[ $code ] = $data;
		}
	}
}
