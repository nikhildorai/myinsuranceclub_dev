<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class controller_two_wheeler extends Customer_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	function __construct()
	{
		// Call the Controller constructor
		parent::__construct();
		//$this->load->library('email');
		$this->load->library('session');
		$this->load->library('table');
		$this->load->library('user_agent');
		$this->load->database();
		//$this->load->model('mic_dbtest');
		//$this->load->model('annual_premium_travel_model');
		//$this->load->model('city');
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->load->library('util');
		$this->load->helper('html');
		date_default_timezone_set('Asia/Kolkata');
	}


	public function index()
	{
	
		$data="";
		
		$this->template->set_template('frontend');
		$this->template->write_view('content', 'two_wheeler/home', $data, TRUE);
		$this->template->render();
		
		
	}
	

}