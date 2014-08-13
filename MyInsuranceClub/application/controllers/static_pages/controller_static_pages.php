<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class controller_static_pages extends MIC_Controller {

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
		$this->template->write_view('content', 'static_pages/about', $data, TRUE);
		$this->template->render();
		
		
	}
	
	public function team()
	{
		$data="";
		$this->template->set_template('frontend');
		$this->template->write_view('content', 'static_pages/team', $data, TRUE);
		$this->template->render();
		
		
	}
		public function contact()
	{
		$data="";
		$this->template->set_template('frontend');
		$this->template->write_view('content', 'static_pages/contact', $data, TRUE);
		$this->template->render();
		
		
	}
	
		public function ask_expert()
	{
		$data="";
		$this->template->set_template('frontend');
		$this->template->write_view('content', 'static_pages/ask_expert', $data, TRUE);
		$this->template->render();
		
		
	}
	

}