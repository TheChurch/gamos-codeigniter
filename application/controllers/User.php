<?php

// If accessed directly, Amen.
defined( 'BASEPATH' ) or exit( 'God bless you!' );

/**
 * User base class.
 * 
 * @extends CI_Controller
 */
class User extends CI_Controller {

	/**
	 * Initialise class and set its properties.
	 * 
	 * @access public
	 *
	 * @return void
	 */
	public function __construct() {
		
		parent::__construct();

		$this->load->library( array( 'session' ) );
		$this->load->helper( array( 'url', 'user', 'form' ) );
	}

	/**
	 * Show login form to public.
	 *
	 * @access public
	 *
	 * @return void
	 */
	public function login() {

		$this->load->view( 'user/common/header' );
		$this->load->view( 'user/login' );
		$this->load->view( 'user/common/footer' );
	}

	/**
	 * Validate login request from post.
	 *
	 * When user submits data with login credentials,
	 * validate them and redirect if valid, else redirect
	 * back to login.
	 *
	 * @access public
	 *
	 * @return void
	 */
	public function valid_login() {

		// Load required libraries.
		$this->load->library( 'form_validation' );
		$this->load->model( 'common/user_model' );

		// Set form validation rules.
		$this->form_validation->set_rules( 'username', 'username', 'required' );
		$this->form_validation->set_rules( 'password', 'password', 'required' );

		// If form validation was success, continue.
		if ( $this->form_validation->run() === false ) {
			// If validation was failure, show error.
			$this->session->set_flashdata( 'error', validation_errors() );
		} else {

			// Get user data as result if login was success.
			$user = $this->user_model->login( $this->input->post( 'username' ), $this->input->post( 'password' ) );
			if ( ! empty( $user ) ) {
				// Set session data.
				$_SESSION['user_id'] = (int) $user->id;
				$_SESSION['username'] = $user->username;
				$_SESSION['is_admin'] = (bool) $user->is_admin;

				// Redirect to proper page.
				$this->login_redirect();
			} else {
				// If credentials was wrong, let them know.
				$this->session->set_flashdata( 'error', 'Oh come on! We need valid credentials.' );
			}
		}

		redirect( 'login' );
	}

	/**
	 * Redirect to proper page after login.
	 *
	 * If admin user was logged in, redirect to admin
	 * page else to registration form.
	 *
	 * @access private
	 *
	 * @return void
	 */
	private function login_redirect() {

		// Continue only if logged in.
		if ( is_loggedin() ) {
			// Admins to admin page.
			if ( (bool) $this->session->userdata( 'is_admin' ) ) {
				redirect( 'admin' );
			} else {
				redirect( 'registration' );
			}
		}
	}
	
	/**
	 * User logout functionality.
	 * 
	 * @access public
	 *
	 * @return void
	 */
	public function logout() {

		// Destroy all sessions.
		if ( is_loggedin() ) {
			$this->session->sess_destroy();
		}

		redirect( 'login' );
	}
	
}
