<?php

// If accessed directly, Amen.
defined( 'BASEPATH' ) or exit( 'God bless you!' );

/**
 * Data model class.
 * 
 * @extends CI_Model
 */
class Data_model extends CI_Model {

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
	 * Get list of churches.
	 *
	 * @access public
	 *
	 * @param int $district District ID.
	 * @param int $state State ID.
	 * @param int $country Country ID.
	 *
	 * @return array
	 */
	public function get_churches( $district = 0, $state = 0 ) {

		$this->db->from( 'churches' );

		// Filter by district.
		if ( ! empty( $district ) ) {
			$this->db->where( 'district', $district );
		}

		// Filter by state.
		if ( ! empty( $state ) ) {
			$this->db->where( 'state', $state );
		}

		return $this->db->get()->result();
	}

	/**
	 * Get list of states.
	 *
	 * @access public
	 *
	 * @return array
	 */
	public function get_states() {

		$this->db->from( 'states' );

		return $this->db->get()->result();
	}

	/**
	 * Get list of districts.
	 *
	 * @access public
	 *
	 * @return array
	 */
	public function get_districts() {

		$this->db->from( 'districts' );

		return $this->db->get()->result();
	}
}
