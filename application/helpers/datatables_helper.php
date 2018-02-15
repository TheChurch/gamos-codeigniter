<?php

// If accessed directly, Amen.
defined( 'BASEPATH' ) or exit( 'God bless you!' );

/**
 * Get gender full text from code.
 *
 * @param string $gender Gender code.
 *
 * @return string
 */
function getGender( $gender ) {

	return trim( $gender ) == 'F' ? 'Female' : 'Male';
}

/**
 * Get actions link for profile.
 *
 * @param int $id Profile ID.
 *
 * @return string
 */
function getActionsLink( $id ) {

	$content = '';
	if ( ! empty( $id ) ) {
		$content .= '<a href="' . base_url( 'dashboard/profile/view/' . base64_encode( $id ) ) . '" class="view" title="View details" target="_blank"><button type="button" class="btn btn-success btn-xs">View Details</button></a>';
		$content .= ' <a href="' . base_url( 'profile/delete/' . base64_encode( $id ) ) . '" class="delete" title="Delete profile"><button type="button" class="btn btn-danger btn-xs">Delete</button></a>';
	}

	return $content;
}

/**
 * Get firsr letter capitalized.
 *
 * @param string $name String name.
 *
 * @return string
 */
function getCaps( $name ) {

	return ucwords( $name );
}

/**
 * Get formatted age from DOB.
 *
 * @param string $dob DOB
 *
 * @return int
 */
function getAge( $dob ) {

	$dob = new DateTime( $dob );
	$to   = new DateTime( 'today' );

	// Calculate the age.
	$age = $dob->diff( $to )->y;

	return empty( $age ) ? 'Unknown' : $age;
}