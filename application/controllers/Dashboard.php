<?php

// If accessed directly, Amen.
defined( 'BASEPATH' ) or exit( 'God bless you!' );

/**
 * Dashboard base class.
 * 
 * @extends CI_Controller
 */
class Dashboard extends CI_Controller {

	/**
	 * Initialise class and set its properties.
	 * 
	 * @access public
	 */
	public function __construct() {

		parent::__construct();

		$this->load->library( array( 'session' ) );
		$this->load->helper( array( 'url', 'user' ) );

		// Force login.
		force_login();
	}

	/**
	 * Dashboard index page.
	 *
	 * @access public
	 *
	 * @return mixed
	 */
	public function index() {

		$this->load->model( 'common/data_model' );

		// Get church list.
		$data['churches'] = $this->data_model->get_churches();

		// Render html.
		$this->load->view( 'back/common/header' );
		$this->load->view( 'back/profiles', $data );
		$this->load->view( 'back/common/footer' );
	}

	/**
	 * Get profiles list based on the filters.
	 *
	 * Get the json output to display on datatables.
	 * This functions takes memory! Seriously.
	 * Filter the sql query and get the output based on
	 * the filters applied.
	 * Sorting and pagination will also be taken care by
	 * Datatables library.
	 *
	 * @access public
	 *
	 * @return string
	 */
	public function get_profiles() {

		$this->load->model( 'back/profiles_model' );

		// Generate output and display it.
		echo $this->profiles_model->get_profiles();
	}

	/**
	 * Get single profile details.
	 *
	 * @access public
	 *
	 * @return bool
	 */
	public function view_profile() {

		$this->load->helper( 'datatables' );
		// Get the id from url.
		$id = $this->uri->segment( 4 );

		$content_data = array();
		$header_data = array( 'title' => 'Profile Details' );

		// Do not continue if valid id is not found.
		if ( ! empty( $id ) ) {

			$this->load->model( 'back/profiles_model' );

			$profile = $this->profiles_model->profile_details( base64_decode( $id ) );

			// Get images.
			if ( ! empty( $profile->upload_key ) ) {
				$content_data['images'] = $this->get_images( $profile->upload_key );
			}

			$content_data['profile'] = $profile;
		}

		// Render html.
		$this->load->view( 'back/common/header', $header_data );
		$this->load->view( 'back/details', $content_data );
		$this->load->view( 'back/common/footer' );
	}

	/**
	 * Contact details page view.
	 *
	 * @access public
	 *
	 * @return void
	 */
	public function contact() {

		$header_data = array( 'title' => 'Contact Us' );

		// Render html.
		$this->load->view( 'back/common/header', $header_data );
		$this->load->view( 'back/contact' );
		$this->load->view( 'back/common/footer' );
	}

	/**
	 * Edit form for single profile details.
	 *
	 * @access public
	 *
	 * @return bool
	 */
	public function edit_profile() {

		// Only admin can delete the profile.
		if ( ! is_admin() ) {
			$this->session->set_flashdata( 'error', 'Oops! Only admin can edit this profile.' );
			redirect( 'dashboard/profiles' );
		}

		// Get the id from url.
		$id = $this->uri->segment( 4 );

		$header_data = array( 'title' => 'Edit Profile' );

		// Load form helper.
		$this->load->helper( 'form' );
		$this->load->model( 'common/data_model' );

		// Get states, churches, educations and jobs list.
		$data['states'] = $this->data_model->get_states();
		$data['districts'] = $this->data_model->get_districts();
		$data['churches'] = $this->data_model->get_churches();

		// Do not continue if valid id is not found.
		if ( ! empty( $id ) ) {

			$this->load->model( 'back/profiles_model' );

			$profile = $this->profiles_model->profile_details( base64_decode( $id ) );

			// Get images.
			if ( ! empty( $profile->upload_key ) ) {
				$data['images'] = $this->get_images( $profile->upload_key );
			}

			$data['profile'] = $profile;
		}

		// Render html.
		$this->load->view( 'back/common/header', $header_data );
		$this->load->view( 'back/edit', $data );
		$this->load->view( 'back/common/footer' );
	}

	/**
	 * Update single profile details.
	 *
	 * @access public
	 *
	 * @return bool
	 */
	public function update_profile() {

		// Only admin can delete the profile.
		if ( ! is_admin() ) {
			$this->session->set_flashdata( 'error', 'Oops! Only admin can update this profile.' );
			redirect( 'dashboard/profiles' );
		}

		// Get the id from url.
		$id = $this->uri->segment( 4 );

		// Validate form.
		if ( $this->validate() ) {

			if ( $this->update( base64_decode( $id ) ) ) {
				// Attempt to insert registration data and return success.
				$this->session->set_flashdata( 'success', 'Profile update successful!' );
			} else {
				$this->session->set_flashdata( 'error', 'Oh nah! Profile update failed.' );
			}

			redirect( 'dashboard/profiles' );
		} elseif ( $id ) {
			$this->edit_profile();
		} else {
			redirect( 'dashboard/profiles' );
		}
	}

	/**
	 * Delete a profile in emergency.
	 *
	 * @access public
	 *
	 * @return bool
	 */
	public function delete_profile() {

		// Only admin can delete the profile.
		if ( ! is_admin() ) {
			$this->session->set_flashdata( 'error', 'Oops! Only admin can delete this profile.' );
			redirect( 'dashboard/profiles' );
		}

		// Get the id from url.
		$id = $this->uri->segment( 4 );

		// Do not continue if valid id is not found.
		if ( ! empty( $id ) ) {

			$this->load->model( 'back/profiles_model' );

			$result = $this->profiles_model->delete_profile( base64_decode( $id ) );
			// Attempt to delete attendee.
			if ( $result ) {
				// Delete profile images.
				$this->delete_images( (int) $result );

				$this->session->set_flashdata( 'success', 'Profile deleted.' );
			} else {
				$this->session->set_flashdata( 'error', 'Oops! Could not delete the profile.' );
			}
		}

		redirect( 'dashboard/profiles' );
	}

	/**
	 * Approve a pending profile.
	 *
	 * @access public
	 *
	 * @return bool
	 */
	public function approve_profile() {

		// Only admin can delete the profile.
		if ( ! is_admin() ) {
			$this->session->set_flashdata( 'error', 'Oops! Only admin can approve this profile.' );
			redirect( 'dashboard/profiles' );
		}

		// Get the id from url.
		$id = $this->uri->segment( 4 );

		// Do not continue if valid id is not found.
		if ( ! empty( $id ) ) {

			$this->load->model( 'back/profiles_model' );

			// Attempt to delete attendee.
			if ( $this->profiles_model->approve_profile( base64_decode( $id ) ) ) {
				$this->session->set_flashdata( 'success', 'Profile approved.' );
			} else {
				$this->session->set_flashdata( 'error', 'Oops! Could not approve the profile.' );
			}
		}

		redirect( 'dashboard/profiles' );
	}

	/**
	 * Get images of a profile.
	 *
	 * @param int $key Upload key.
	 *
	 * @return array
	 */
	private function get_images( $key ) {

		$images = array();

		// Get the real path.
		$dir =  realpath( APPPATH . '../uploads/' . $key );

		if ( ! file_exists( $dir ) ) {
			return $images;
		}

		// Scan the directory.
		$dh  = opendir( $dir );
		// Get the image files and add to array.
		while ( false !== ( $filename = readdir( $dh ) ) ) {
			$images[] = $filename;
		}
		// Only get valid images.
		$images = preg_grep( '/\.jpg|.png|.gif|.jpeg$/i', $images );

		return $images;
	}

	/**
	 * Delelte profile image directory and images.
	 *
	 * @param string $key Upload key.
	 *
	 * @return bool|string
	 */
	private function delete_images( $key ) {

		// Get the real path.
		$dir =  realpath( APPPATH . '../uploads/' . $key );

		try {
			// Do not continue if not a directory.
			if ( ! is_dir( $dir ) ) {
				return true;
			}
			// Delete the folder and contents.
			return system( 'rm -rf ' . escapeshellarg( $dir ) );

		} catch(Exception $e) {

			return false;
		}
	}

	/**
	 * Format and update profile data.
	 *
	 * Send profile data to profile model in
	 * valid format.
	 *
	 * @param int $id Profile ID.
	 *
	 * @access private
	 *
	 * @return mixed
	 */
	private function update( $id ) {

		$this->load->model( 'back/profiles_model' );

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
		);

		// Update profile data.
		return $this->profiles_model->update( $data, $id );
	}

	/**
	 * Validate profile form.
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
		$this->form_validation->set_rules( 'height', 'height', 'trim|integer' );
		$this->form_validation->set_rules( 'weight', 'weight', 'trim|integer' );
		$this->form_validation->set_rules( 'state', 'state', 'trim|required|integer' );
		$this->form_validation->set_rules( 'district', 'district', 'trim|required' );
		$this->form_validation->set_rules( 'education', 'education', 'trim|required' );
		$this->form_validation->set_rules( 'education_details', 'education_details', 'trim' );
		$this->form_validation->set_rules( 'job', 'job', 'trim|required' );
		$this->form_validation->set_rules( 'job_details', 'job_details', 'trim' );
		$this->form_validation->set_rules( 'father_name', 'father_name', 'trim|required' );
		$this->form_validation->set_rules( 'father_occupation', 'father_occupation', 'trim' );
		$this->form_validation->set_rules( 'father_number', 'father_number', 'trim|required|integer' );
		$this->form_validation->set_rules( 'mother_name', 'mother_name', 'trim' );
		$this->form_validation->set_rules( 'elder_name', 'elder_name', 'trim|required' );
		$this->form_validation->set_rules( 'elder_number', 'elder_number', 'trim|required|integer' );

		return $this->form_validation->run();
	}
}
