<?php

// If accessed directly, Amen.
defined( 'BASEPATH' ) or exit( 'God bless you!' );

/**
 * Profiles model class.
 * 
 * @extends CI_Model
 */
class Profiles_model extends CI_Model {

	/**
	 * Initialise class and set its properties.
	 *
	 * @access public
	 *
	 * @return void
	 */
	public function __construct() {
		
		parent::__construct();

		$this->load->database();
	}

	/**
	 * Get list of profiles.
	 *
	 * Filter profiles by church, age, gender, education and job.
	 *
	 * @access public
	 *
	 * @return array
	 */
	public function get_profiles() {

		// Load required libraries.
		$this->load->helper( 'datatables' );
		$this->load->library( array( 'Datatables' ) );

		// Start db query.
		$this->datatables->select( 'pf.id, pf.name, gender, dob, ch.name as church, ed.title as education, jb.title as job' );
		$this->datatables->from( 'profiles as pf' );
		$this->datatables->join( 'churches as ch', 'pf.church = ch.id' );
		$this->datatables->join( 'educations as ed', 'pf.education = ed.id' );
		$this->datatables->join( 'jobs as jb', 'pf.job = jb.id' );

		// Full post data.
		$post = $this->input->post();

		// Name filter.
		if ( ! empty( $post['name'] ) ) {
			$this->datatables->like( 'pf.name', trim( $post['name'] ) );
		}

		// Church filter.
		if ( ! empty( $post['church'] ) ) {
			$this->datatables->where( 'pf.church', (int) $post['church'] );
		}

		// Gender filter.
		if ( ! empty( $post['gender'] ) && in_array( $post['gender'], array( 'M', 'F' ) ) ) {
			$this->datatables->where( 'pf.gender', $post['gender'] );
		}

		// Age from filter.
		if ( ! empty( $post['age_from'] ) ) {
			$this->datatables->where( 'pf.age >=', (int) $post['age_from'] );
		}

		// Age to filter.
		if ( ! empty( $post['age_to'] ) ) {
			$this->datatables->where( 'pf.age <=', (int) $post['age_to'] );
		}

		// State filter.
		if ( ! empty( $post['state'] ) ) {
			$this->datatables->where( 'pf.state', (int) $post['state'] );
		}

		// District filter.
		if ( ! empty( $post['district'] ) ) {
			$this->datatables->where( 'pf.district', (int) $post['district'] );
		}

		// Education filter.
		if ( ! empty( $post['education'] ) ) {
			$this->datatables->where( 'pf.education', (int) $post['education'] );
		}

		// Job filter.
		if ( ! empty( $post['job'] ) ) {
			$this->datatables->where( 'pf.job', (int) $post['job'] );
		}

		$this->datatables->edit_column( 'name', '$1', 'getCaps(name)' );
		// Add gender full text instead of short term from db.
		$this->datatables->edit_column( 'gender', '$1', 'getGender(gender)' );
		// Get age from DOB.
		$this->datatables->edit_column( 'dob', '$1', 'getAge(dob)' );
		// Add actions.
		$this->datatables->add_column( 'delete', '$1', 'getActionsLink(id)' );

		return $this->datatables->generate();
	}

	/**
	 * Delete a profile in emergency.
	 *
	 * @param int $id Profile ID.
	 *
	 * @access public
	 *
	 * @return bool
	 */
	public function delete_profile( $id ) {

		$this->db->where( 'id', $id );
		$this->db->delete( 'profiles' );

		return $this->db->affected_rows() > 0;
	}

	/**
	 * Get details of a profile.
	 *
	 * @param int $id Profile ID.
	 *
	 * @access public
	 *
	 * @return array|bool
	 */
	public function profile_details( $id ) {

		$this->db->select( '*, ch.name as church, ed.title as education, jb.title as job, st.name as state, ds.name as district' );
		$this->db->from( 'profiles as pf' );
		$this->db->join( 'churches as ch', 'pf.church = ch.id' );
		$this->db->join( 'educations as ed', 'pf.education = ed.id' );
		$this->db->join( 'jobs as jb', 'pf.job = jb.id' );
		$this->db->join( 'states as st', 'pf.state = st.id' );
		$this->db->join( 'districts as ds', 'pf.district = ds.id' );
		$this->db->from( 'profiles' );
		$this->db->where( 'pf.id', $id );

		return $this->db->get()->row();
	}
}
