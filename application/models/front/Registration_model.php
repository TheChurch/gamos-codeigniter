<?php

// If accessed directly, Amen.
defined( 'BASEPATH' ) or exit( 'God bless you!' );

/**
 * Registration model class.
 * 
 * @extends CI_Model
 */
class Registration_model extends CI_Model {

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
	 * Insert registration data.
	 * 
	 * @access public
	 *
	 * @param array $data Registration data.
	 *
	 * @return bool true on success, false on failure
	 */
	public function register( $data ) {
		
		$this->db->insert( 'profiles', $data );

		return $this->db->insert_id();
	}

	/**
	 * Check if current inserting attendee is duplicate.
	 *
	 * @access public
	 *
	 * @return array
	 */
	public function is_duplicate() {

		$post = $this->input->post();

		// Filter by name.
		$this->db->where( 'name', trim( $post['name'] ) );

		// Filter by church.
		$this->db->where( 'church', (int) $post['church'] );

		// Filter by gender.
		if ( ! empty( $post['gender'] ) ) {
			$this->db->where( 'gender', $post['gender'] );
		}

		$query = $this->db->get( 'profiles' );

		return $query->num_rows() > 0;

	}
}
