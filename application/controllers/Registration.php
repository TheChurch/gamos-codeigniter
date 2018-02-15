<?php

// If accessed directly, Amen.
defined( 'BASEPATH' ) or exit( 'God bless you!' );

/**
 * Registration base class.
 * 
 * @extends CI_Controller
 */
class Registration extends CI_Controller {

	/**
	 * Initialise class and set its properties.
	 * 
	 * @access public
	 */
	public function __construct() {
		
		parent::__construct();

		$this->load->library( array( 'session' ) );
		$this->load->helper( array( 'url', 'user' ) );
	}

	/**
	 * Registration form.
	 *
	 * By default render registration form with all required
	 * fields and elements.
	 *
	 * @access public
	 *
	 * @return mixed
	 */
	public function index() {

		// Load form helper.
		$this->load->helper( 'form' );
		$this->load->model( 'common/data_model' );

		// Get states, churches, educations and jobs list.
		$data['states'] = $this->data_model->get_states();
		$data['districts'] = $this->data_model->get_districts();
		$data['churches'] = $this->data_model->get_churches();
		$data['educations'] = $this->data_model->get_educations();
		$data['jobs'] = $this->data_model->get_jobs();

		// Render html.
		$this->load->view( 'front/common/header' );
		$this->load->view( 'front/register', $data );
		$this->load->view( 'front/common/footer' );
	}

	/**
	 * Process registration data.
	 *
	 * If validation passed, insert registration data
	 * to database afer proper formatting.
	 * Redirect back to registration page.
	 *
	 * @access private
	 *
	 * @return mixed
	 */
	public function register() {

		//echo '<pre>'; print_r($_POST); exit;
		// Validate form.
		if ( $this->validate() ) {

			if ( $this->is_duplicate() ) {
				$this->session->set_flashdata( 'error', 'Oh nah! This profile was already registered.' );
			} elseif ( $this->insert() ) {
				// Attempt to insert registration data and return success.
				$this->session->set_flashdata( 'success', 'Registration successful!' );
			} else {
				$this->session->set_flashdata( 'error', 'Oh nah! Registration failed.' );
			}

			redirect( 'registration' );
		} else {
			$this->index();
		}
	}

	/**
	 * Format and insert profile data.
	 *
	 * Send registration data to registration model in
	 * valid format.
	 *
	 * @access private
	 *
	 * @return mixed
	 */
	private function insert() {

		// Profile data.
		$data = array(
			'name' => trim( $this->input->post( 'name' ) ),
			'church' => (int) $this->input->post( 'church' ),
			'gender' => $this->input->post( 'gender' ) === 'F' ? 'F' : 'M',
			'dob' => $this->input->post( 'dob' ),
			'height' => (int) $this->input->post( 'height' ),
			'weight' => (int) $this->input->post( 'weight' ),
			'state' => (int) $this->input->post( 'state' ),
			'district' => (int) $this->input->post( 'district' ),
			'education' => $this->input->post( 'education' ),
			'education_details' => trim( $this->input->post( 'education_details' ) ),
			'job' => $this->input->post( 'job' ),
			'job_details' => trim( $this->input->post( 'job_details' ) ),
			'father_name' => $this->input->post( 'father_name' ),
			'father_occupation' => trim( $this->input->post( 'father_occupation' ) ),
			'father_number' => (int) $this->input->post( 'father_number' ),
			'mother_name' => trim( $this->input->post( 'mother_name' ) ),
			'elder_name' => trim( $this->input->post( 'elder_name' ) ),
			'elder_number' => (int) $this->input->post( 'elder_number' ),
			'upload_key' => (int) $this->input->post( 'upload_key' ),
		);

		// Insert attendee personal data and get attendee id.
		$attendee_id = $this->registration_model->register( $data );

		return ( ! empty( $attendee_id ) );
	}

	/**
	 * Validate registration form.
	 *
	 * Set validation rules using Codeigniter form validation
	 * feature and return boolean.
	 *
	 * @access private
	 *
	 * @return mixed
	 */
	private function validate() {

		// Load form validation helper.
		$this->load->library( 'form_validation' );

		// Set validation rules.
		$this->form_validation->set_rules( 'name', 'name', 'trim|required' );
		$this->form_validation->set_rules( 'church', 'church', 'trim|required|integer' );
		$this->form_validation->set_rules( 'gender', 'gender', 'trim|required|max_length[1]' );
		$this->form_validation->set_rules( 'dob', 'dob', 'trim|required' );
		$this->form_validation->set_rules( 'height', 'height', 'trim|required|integer' );
		$this->form_validation->set_rules( 'weight', 'weight', 'trim|required|integer' );
		$this->form_validation->set_rules( 'state', 'state', 'trim|required|integer' );
		$this->form_validation->set_rules( 'district', 'district', 'trim|required' );
		$this->form_validation->set_rules( 'education', 'education', 'trim|required|integer' );
		$this->form_validation->set_rules( 'education_details', 'education_details', 'trim|required' );
		$this->form_validation->set_rules( 'job', 'job', 'trim|required|integer' );
		$this->form_validation->set_rules( 'job_details', 'job_details', 'trim|required' );
		$this->form_validation->set_rules( 'father_name', 'father_name', 'trim|required' );
		$this->form_validation->set_rules( 'father_occupation', 'father_occupation', 'trim|required' );
		$this->form_validation->set_rules( 'father_number', 'father_number', 'trim|required|integer' );
		$this->form_validation->set_rules( 'mother_name', 'mother_name', 'trim|required' );
		$this->form_validation->set_rules( 'elder_name', 'elder_name', 'trim|required' );
		$this->form_validation->set_rules( 'elder_number', 'elder_number', 'trim|required|integer' );
		$this->form_validation->set_rules( 'upload_key', 'upload_key', 'trim|required|integer' );

		return $this->form_validation->run();
	}

	/**
	 * Check whether it is a duplicate entry.
	 *
	 * Same person should not be added twice.
	 *
	 * @return bool
	 */
	public function is_duplicate() {

		$name = $this->input->post( 'name' );

		if ( empty( $name ) ) {
			return false;
		}

		$this->load->model( 'front/registration_model' );

		return $this->registration_model->is_duplicate();
	}

	/**
	 * Upload files to the directory.
	 *
	 * @return void
	 */
	public function upload_images() {

		// Get the upload key.
		$key = $this->uri->segment( 3 );

		if ( empty( $key ) ) {
			return;
		}

		$dir = './uploads/' . $key;

		if ( ! file_exists( $dir ) ) {
			mkdir( $dir, 0777, true );
		}

		$config['upload_path'] = $dir . '/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['encrypt_name'] = false;
		$config['overwrite'] = true;

		// Load upload library.
		$this->load->library( 'upload', $config );

		// If file uploaded, set upload key.
		$this->upload->do_upload( 'file' );
	}
}
