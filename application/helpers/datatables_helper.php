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
		if ( is_admin() ) {
			$content .= ' <a href="#" class="edit" title="Edit profile"><button type="button" class="btn btn-warning btn-xs">Edit</button></a>';
		}
		$content .= ' <a href="' . base_url( 'profile/delete/' . base64_encode( $id ) ) . '" class="delete" title="Delete profile"><button type="button" class="btn btn-danger btn-xs">Delete</button></a>';
	}

	return $content;
}

/**
 * Get first letter capitalized.
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

/**
 * Get education full text from code.
 *
 * @param string $edu Education code.
 *
 * @return string
 */
function getEducation( $edu ) {

	$edus = array(
		'none' => 'None',
		'hs' => 'High School',
		'hsc' => 'Higher Secondary',
		'ug' => 'Graduate',
		'pg' => 'Post Graduate',
	);

	// If education found.
	if ( isset( $edus[ $edu ] ) ) {
		return $edus[ $edu ];
	}

	return 'None';
}

/**
 * Get job full text from code.
 *
 * @param string $job Job code.
 *
 * @return string
 */
function getJob( $job ) {

	$jobs = array(
		'none' => 'None',
		'private' => 'Private Job',
		'government' => 'Government Job',
		'business' => 'Business',
	);

	// If job found.
	if ( isset( $jobs[ $job ] ) ) {
		return $jobs[ $job ];
	}

	return 'None';
}