<?php

// If accessed directly, Amen.
defined( 'BASEPATH' ) or exit( 'God bless you!' );

/**
 * Check if a user is logged in.
 *
 * @return bool
 */
function is_loggedin() {

	// Get core instance.
	$ci =& get_instance();

	return $ci->session->userdata( 'user_id' );
}

/**
 * Check if logged in user is admin.
 *
 * @return bool
 */
function is_admin() {

	// Get core instance.
	$ci =& get_instance();

	return $ci->session->userdata( 'is_admin' );
}

/**
 * Force user to login.
 *
 * If user is not logged in, redirect user
 * to redirect to login page.
 *
 * @param string $user Username.
 *
 * @return bool
 */
function force_login( $user = '' ) {

	// Get core instance.
	$ci =& get_instance();

	// Check if user is logged in.
	if ( ! is_loggedin() ) {
		redirect( 'login' );
	}

	if ( $user === 'admin' && ! is_admin() ) {
		// Show error message.
		$ci->session->set_flashdata( 'error', 'Please login as admin.' );

		redirect( 'login' );
	}
}