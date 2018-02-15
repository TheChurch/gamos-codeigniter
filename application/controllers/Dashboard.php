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
		// Get education list.
		$data['educations'] = $this->data_model->get_educations();
		// Get job list.
		$data['jobs'] = $this->data_model->get_jobs();

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
	 * Delete a profile in emergency.
	 *
	 * @access public
	 *
	 * @return bool
	 */
	public function delete_profile() {

		// Get the id from url.
		$id = $this->uri->segment( 3 );

		// Do not continue if valid id is not found.
		if ( ! empty( $id ) ) {

			$this->load->model( 'back/profiles_model' );

			// Attempt to delete attendee.
			if ( $this->profiles_model->delete_profile( base64_decode( $id ) ) ) {
				$this->session->set_flashdata( 'success', 'Profile deleted.' );
			} else {
				$this->session->set_flashdata( 'error', 'Oops! Could not delete the profile.' );
			}
		}

		redirect( 'dashboard/profiles' );
	}

	/**
	 * Get single profile details.
	 *
	 * @access public
	 *
	 * @return bool
	 */
	public function view_details() {

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
}
