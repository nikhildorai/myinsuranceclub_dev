<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends Customer_Controller {

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
		$data = array();
		$this->template->set_template('frontend');
		$this->template->write_view('content', 'home2', $data, TRUE);
		$this->template->render();
		//$this->load->view('home2');
	}
	
	
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */