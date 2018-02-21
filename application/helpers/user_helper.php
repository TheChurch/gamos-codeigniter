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
 * Check if logged in user is admin.
 *
 * @param string $role
 *
 * @return bool
 */
function is_role( $role = 'normal' ) {

	// Available roles.
	$roles = array(
		0 => 'normal',
		1 => 'admin',
		2 => 'elder',
	);

	// If not any of existing roles.
	if ( ! in_array( $role, array_values( $roles ) ) ) {
		return false;
	}

	// Get core instance.
	$ci =& get_instance();

	// Check if the role is assigned to the current user.
	if ( $ci->session->userdata( 'role' ) && $ci->session->userdata( 'role' ) == $role ) {
		return true;
	}

	return false;
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
function force_login() {

	// Check if user is logged in.
	if ( ! is_loggedin() ) {
		redirect( 'login' );
	}
}