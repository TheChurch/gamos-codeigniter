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
		$this->datatables->select( 'pf.name, pf.gender, pf.dob, ch.name as church, pf.education, pf.job, pf.id' );
		$this->datatables->from( 'profiles as pf' );
		$this->datatables->join( 'churches as ch', 'pf.church = ch.id' );

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
			$this->datatables->where( 'pf.education', $post['education'] );
		}

		// Job filter.
		if ( ! empty( $post['job'] ) ) {
			$this->datatables->where( 'pf.job', $post['job'] );
		}

		$this->datatables->unset_column( 'id' );

		$this->datatables->edit_column( 'name', '$1', 'getCaps(name)' );
		// Add gender full text instead of short term from db.
		$this->datatables->edit_column( 'gender', '$1', 'getGender(gender)' );
		// Get age from DOB.
		$this->datatables->edit_column( 'dob', '$1', 'getAge(dob)' );
		// Get education.
		$this->datatables->edit_column( 'education', '$1', 'getEducation(education)' );
		// Get job.
		$this->datatables->edit_column( 'job', '$1', 'getJob(job)' );
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

		// Get the upload key.
		$upload_key = $this->get_upload_key( $id );

		$this->db->where( 'id', $id );
		$this->db->delete( 'profiles' );

		// Return upload key.
		if ( $this->db->affected_rows() > 0 && isset( $upload_key ) ) {
			return $upload_key;
		}

		return false;
	}

	/**
	 * Get the upload key of a profile.
	 *
	 * @param int $id Profile ID.
	 *
	 * @access public
	 *
	 * @return int|bool
	 */
	public function get_upload_key( $id ) {

		// Get the upload key.
		$this->db->select( 'upload_key' );
		$this->db->from( 'profiles' );
		$this->db->where( 'id', $id );

		$result = $this->db->get()->row();

		return isset( $result->upload_key ) ? $result->upload_key : false;
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

		$this->db->select( '*, pf.name as name, ch.name as church, st.name as state, ds.name as district' );
		$this->db->from( 'profiles as pf' );
		$this->db->join( 'churches as ch', 'pf.church = ch.id' );
		$this->db->join( 'states as st', 'pf.state = st.id' );
		$this->db->join( 'districts as ds', 'pf.district = ds.id' );
		$this->db->from( 'profiles' );
		$this->db->where( 'pf.id', $id );

		return $this->db->get()->row();
	}
}
