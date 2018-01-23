<?php

// If accessed directly, Amen.
defined( 'BASEPATH' ) or exit( 'God bless you!' );

/**
 * User_model class.
 * 
 * @extends CI_Model
 */
class User_model extends CI_Model {

	/**
	 * Initialize the class.
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
	 * Validate user login.
	 *
	 * Validate user login using username and password
	 * and then return user object if valid.
	 * 
	 * @access public
	 *
	 * @param string $username Username.
	 * @param string $password Password.
	 *
	 * @return bool|object User object on success, false on failure.
	 */
	public function login( $username, $password ) {

		$this->db->select( '*' );
		$this->db->from( 'users' );
		$this->db->where( 'username', $username );
		$this->db->where( 'password', md5( $password ) );
		
		return $this->db->get()->row();
	}
}
