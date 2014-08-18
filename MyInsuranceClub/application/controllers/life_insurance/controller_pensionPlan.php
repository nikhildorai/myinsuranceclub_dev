<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class controller_pensionPlan extends Customer_Controller {

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
		
		date_default_timezone_set('Asia/Kolkata');
	}


	public function index()
	{
		$data="";
		$this->template->set_template('frontend');
		$this->template->write_view('content', 'pensionPlan/home', $data, TRUE);
		$this->template->render();
		
		
	}
	
	
	

}