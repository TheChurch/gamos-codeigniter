<?php

// If accessed directly, Amen.
defined( 'BASEPATH' ) or exit( 'God bless you!' );

/**
 * Admin base class.
 * 
 * @extends CI_Controller
 */
class Admin extends CI_Controller {

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
		force_login( 'admin' );
	}

	/**
	 * Admin index page.
	 *
	 * By default render registration form with all required
	 * fields and elements.
	 *
	 * @access public
	 *
	 * @return mixed
	 */
	public function index() {

		$this->load->model( 'front/registration_model' );

		// Get churches list.
		$data['churches'] = $this->registration_model->get_churches();

		// Render html.
		$this->load->view( 'back/common/header' );
		$this->load->view( 'back/profiles', $data );
		$this->load->view( 'back/common/footer' );
	}

	/**
	 * Get attendees list based on the filters.
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
	public function get_attendees() {

		$this->load->model( 'back/reporting_model' );

		// Generate output and display it.
		echo $this->reporting_model->get_attendees();
	}

	/**
	 * Delete and attendee in emergency.
	 *
	 * @access public
	 *
	 * @return bool
	 */
	public function delete_attendee() {

		// Get the id from url.
		$id = $this->uri->segment( 4 );

		// Do not continue if valid id is not found.
		if ( empty( $id ) ) {
			redirect( 'admin' );
		}

		$this->load->model( 'front/registration_model' );

		// Attempt to delete attendee.
		if ( $this->registration_model->delete_attendee( base64_decode( $id ) ) ) {
			$this->session->set_flashdata( 'success', 'Attendee deleted.' );
		} else {
			$this->session->set_flashdata( 'error', 'Oops! Could not delete the attendee.' );
		}

		redirect( 'admin' );
	}

	/**
	 * Export attendees list based on the filters.
	 *
	 * Filter the sql query and get the output based on
	 * the filters applied.
	 * Pass this data to excel library and generate output.
	 *
	 * @access public
	 *
	 * @return string
	 */
	public function export_attendees() {

		// Load model.
		$this->load->model( 'back/reporting_model' );

		// Generate output and display it.
		$data = $this->reporting_model->get_attendees_export();

		// Attempt to export to excel.
		try {
			$this->export( $data );
		} catch ( Exception $e ) {
			// Pray.
		}

		redirect( 'admin' );
	}

	/**
	 * Export attendees list to excel.
	 *
	 * Use the PHPExcel library and export the result
	 * data as excel sheet.
	 *
	 * @param array $data Array of data objects.
	 *
	 * @access public
	 *
	 * @return void
	 */
	public function export( $data = array() ) {

		// Load excel library.
		$this->load->library( 'jjexcel' );

		// Activate worksheet number 1
		$this->jjexcel->setActiveSheetIndex( 0 );

		// Name the worksheet
		$this->jjexcel->getActiveSheet()->setTitle( 'Camp Attendee List' );

		// Set cells titles.
		$this->jjexcel->getActiveSheet()->setCellValue( 'A1', 'Name' );
		$this->jjexcel->getActiveSheet()->setCellValue( 'B1', 'Church' );
		$this->jjexcel->getActiveSheet()->setCellValue( 'C1', 'Age' );
		$this->jjexcel->getActiveSheet()->setCellValue( 'D1', 'Gender' );

		// Loop through each data and add columns.
		for ( $i = 0; $i < count( $data ); $i++ ) {
			// Set the cell number.
			$cell_no = $i + 2;

			// Set excel content.
			$this->jjexcel->getActiveSheet()->setCellValue( 'A' . $cell_no, ucwords( $data[ $i ]->name ) );
			$this->jjexcel->getActiveSheet()->setCellValue( 'B' . $cell_no, ucwords( $data[ $i ]->church ) );
			$this->jjexcel->getActiveSheet()->setCellValue( 'C' . $cell_no, $data[ $i ]->age );
			$this->jjexcel->getActiveSheet()->setCellValue( 'D' . $cell_no, $data[ $i ]->gender == 'M' ? 'Male' : 'Female' );
		}

		// Align excel titles to center.
		$this->jjexcel->getActiveSheet()->getStyle( 'A1:D1' )->getAlignment()->setHorizontal( PHPExcel_Style_Alignment::HORIZONTAL_CENTER );

		// Set a file name and add suffix with time.
		$filename = 'attendees_' . time() . '.xlsx';

		// Let the browser know the file is excel.
		header( 'Content-Type: application/vnd.ms-excel' );
		header( 'Content-Disposition: attachment;filename="' . $filename . '"' );
		header( 'Cache-Control: max-age=0' );

		// Save it to Excel2007 format.
		$objWriter = PHPExcel_IOFactory::createWriter( $this->jjexcel, 'Excel2007' );

		// Force user to download the Excel file without writing it to server's HD
		$objWriter->save( 'php://output' );
	}
}
