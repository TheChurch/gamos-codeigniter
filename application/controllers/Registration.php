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
		$this->load->model( 'front/registration_model' );

		// Force login.
		force_login();
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

		// Get churches list.
		$data['churches'] = $this->registration_model->get_churches();
		$data['dates'] = $this->get_active_dates();

		// Render html.
		$this->load->view( 'front/common/header' );
		$this->load->view( 'front/register', $data );
		$this->load->view( 'front/common/footer' );
	}

	/**
	 * Get classess to disable dates.
	 *
	 * NOTE: This needs to be changed according to camp
	 * dates change.
	 *
	 * @access private
	 *
	 * @return array
	 */
	private function get_active_dates() {

		$days_class = array();

		// Today time.
		$today = strtotime( 'today' );;

		// Current camp dates.
		$days = array(
			1 => '24-12-2017',
			2 => '25-12-2017',
			3 => '26-12-2017',
			4 => '27-12-2017',
		);

		// Loop through each days.
		foreach ( $days as $key => $day ) {
			// If current date is greater than the date.
			if( strtotime( $day ) < $today ) {
				$days_class[ $key ] = 'disabled';
			} else {
				$days_class[ $key ] = '';
			}
		}

		return $days_class;
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

		// Validate form.
		if ( $this->validate() ) {

			if ( $this->is_duplicate() ) {
				$this->session->set_flashdata( 'error', 'Oh nah! This attendee was already registered.' );
			} elseif ( $this->insert() ) {
				// Attempt to insert registration data and return success.
				$this->session->set_flashdata( 'success', 'Registration successful!' );
			} else {
				$this->session->set_flashdata( 'error', 'Oh nah! Registration failed.' );
			}
		} else {
			// Validation errors.
			$this->session->set_flashdata( 'error', validation_errors() );
		}

		redirect( 'registration' );
	}

	/**
	 * Insert dummy data to database for testing.
	 *
	 * @param int $count Dummy user count.
	 *
	 * @return void
	 */
	public function insert_dummy( $count = 100 ) {

		$names = array( 'Sijo', 'Joel', 'Biju', 'Sabu', 'Shintu', 'Gaius', 'Abin', 'Prem', 'Vivek', 'Adyn', 'Stephen' );
		$gender = array( 'M', 'F' );
		for ( $i = 0; $i < $count; $i++ ) {
			$data = array(
				'church'        => rand( 1, 3 ),
				'name'          => $names[ rand( 0, count( $names ) - 1 ) ],
				'age'           => rand( 1, 120 ),
				'gender'        => $gender[ rand( 0, 1 ) ],
				'accommodation' => rand( 0, 1 ),
				'all_days'      => rand( 0, 1 ),
				'day'           => array(
					1 => array(
						'available' => rand( 0, 1 ),
						'supper'    => rand( 0, 1 ),
					),
					2 => array(
						'available' => rand( 0, 1 ),
						'breakfast' => rand( 0, 1 ),
						'lunch'     => rand( 0, 1 ),
						'tea'       => rand( 0, 1 ),
						'supper'    => rand( 0, 1 ),
					),
					3 => array(
						'available' => rand( 0, 1 ),
						'breakfast' => rand( 0, 1 ),
						'lunch'     => rand( 0, 1 ),
						'tea'       => rand( 0, 1 ),
						'supper'    => rand( 0, 1 ),
					),
					4 => array(
						'available' => rand( 0, 1 ),
						'breakfast' => rand( 0, 1 ),
						'lunch'     => rand( 0, 1 ),
						'tea'       => rand( 0, 1 ),
						'supper'    => rand( 0, 1 ),
					),
				),
			);

			$this->insert_dummy_data( $data );
		}
	}

	/**
	 * Format and insert dummy registration data.
	 *
	 * Send dummy registration data to registration model in
	 * valid format.
	 *
	 * @access private
	 *
	 * @return mixed
	 */
	private function insert_dummy_data( $data ) {

		// Registration data.
		$insert_data = array(
			'church' => $data['church'],
			'name' => $data['name'],
			'gender' => $data['gender'],
			'age' => $data['age'],
			'accommodation' => $data['accommodation'],
			'hot_water' => 0,
			'milk' => 0,
			'inserted_by' => 1,
		);

		// Insert attendee personal data and get attendee id.
		$attendee_id = $this->registration_model->register( $insert_data );
		// If attendee added, insert date and time.
		if ( $attendee_id ) {
			$this->insert_dates_time( $attendee_id, $data['day'] );
		}

		return ( ! empty( $attendee_id ) );
	}

	/**
	 * Format and insert registration data.
	 *
	 * Send registration data to registration model in
	 * valid format.
	 *
	 * @access private
	 *
	 * @return mixed
	 */
	private function insert() {

		$post = $this->input->post();

		// Registration data.
		$data = array(
			'church' => (int) $this->input->post( 'church' ),
			'name' => trim( $this->input->post( 'name' ) ),
			'gender' => $this->input->post( 'gender' ) === 'F' ? 'F' : 'M',
			'age' => (int) $this->input->post( 'age' ),
			'accommodation' => $this->input->post( 'accommodation' ) ? 1 : 0,
			'hot_water' => $this->input->post( 'hot_water' ) ? 1 : 0,
			'milk' => $this->input->post( 'milk' ) ? 1 : 0,
			'inserted_by' => $this->session->userdata( 'user_id' )? $this->session->userdata( 'user_id' ) : null,
		);

		// Insert attendee personal data and get attendee id.
		$attendee_id = $this->registration_model->register( $data );
		// If attendee added, insert date and time.
		if ( $attendee_id ) {
			$this->insert_dates_time( $attendee_id, $this->input->post( 'day' ) );
		}

		return ( ! empty( $attendee_id ) );
	}

	/**
	 * Set date and time values.
	 *
	 * Get date and time data from form and format
	 * it to match db field.
	 *
	 * @param int $attendee_id Attendee ID.
	 * @param array $dates Dates field value.
	 *
	 * @access private
	 *
	 * @return mixed
	 */
	private function insert_dates_time( $attendee_id, $dates ) {

		// Do not continue if date data is empty.
		if ( empty( $dates ) || ! is_array( $dates ) ) {
			return false;
		}

		$date['attendee_id'] = $attendee_id;
		// Loop through each days.
		for ( $i = 1; $i <= 4; $i++ ) {
			// If the attendee is not available on this day.
			$date[ 'day' . $i ] = isset( $dates[ $i ][ 'available' ] ) ? 1 : 0;
		}

		// Get date id after inserting date.
		$date_id = $this->registration_model->insert_dates( $date );

		// If dates added, insert timing too.
		if ( $date_id ) {
			$timing = array();
			for ( $i = 1; $i <= 4; $i++ ) {
				// No need enter timing if not available.
				if ( empty( $dates[ $i ][ 'available' ] ) ) {
					continue;
				}
				$timing[] = array(
					'date_id' => $date_id,
					'day' => $i,
					'breakfast' => isset( $dates[ $i ][ 'breakfast' ] ) ? 1 : 0,
					'lunch' => isset( $dates[ $i ][ 'lunch' ] ) ? 1 : 0,
					'tea' => isset( $dates[ $i ][ 'tea' ] ) ? 1 : 0,
					'supper' => isset( $dates[ $i ][ 'supper' ] ) ? 1 : 0,
				);
			}

			$this->registration_model->insert_timings( $timing );
		}
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
		$this->form_validation->set_rules( 'church', 'church', 'trim|required|integer' );
		$this->form_validation->set_rules( 'name', 'name', 'trim|required|callback_dates_required' );
		$this->form_validation->set_rules( 'age', 'age', 'trim|required|integer|less_than[121]|greater_than[0]' );
		$this->form_validation->set_rules( 'gender', 'gender', 'trim|required|max_length[1]' );
		$this->form_validation->set_rules( 'day[]', 'day', 'callback_dates_required');

		return $this->form_validation->run();
	}

	/**
	 * Custom callback for dates validation.
	 *
	 * Set custom message for dates and timing.
	 *
	 * @param array $value Dates field value.
	 *
	 * @return bool
	 */
	public function dates_required( $value ) {

		$this->form_validation->set_message(
			'dates_required',
			'Why not attending any sessions? Please select dates and time.'
		);

		return ! empty( $value );
	}

	/**
	 * Check whether it is a duplicate entry.
	 *
	 * Same person should not be added twice.
	 *
	 * @return bool
	 */
	public function is_duplicate() {

		if ( empty( $this->input->post( 'name' ) ) ) {
			return false;
		}

		return $this->registration_model->is_duplicate();
	}

	/**
	 * Get registrant names by church.
	 *
	 * @return json
	 */
	public function get_registrants() {

		$data = array();

		// Get the church id from url.
		$id = $this->uri->segment( 3 );

		// Do not continue if valid id is not found.
		if ( ! empty( $id ) ) {

			$this->load->model( 'front/registration_model' );

			// Get pre registered users.
			$data = $this->registration_model->get_registrants( $id );

			$data = array_map( 'reset', $data );
		}

		echo json_encode( $data );
	}
}
