<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_info extends CI_Controller {

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
		$this->load->library('user_agent');
		$this->load->database();
		$this->load->model('visitor_information');
		//$this->load->library('util');
		date_default_timezone_set('Asia/Kolkata');
	}
	
	
	public function index()
	{
		
		$user_info['session_id'] = $this->session->userdata('session_id');
		
		$user_info['timestamp'] = date('H:i:s',$this->session->userdata('last_activity'));
		
		if($this->agent->is_browser())
		{
			$user_info['browser']=$this->agent->browser();
		
			$user_info['os']=$this->agent->platform();
		}
		if($this->agent->is_mobile())
		{
			$user_info['device']=$this->agent->mobile();
		}
		if ($this->agent->is_referral())
		{
			$user_info['referrer']=$this->agent->referrer();
		
		}
		else {
			$user_info['referrer']='';
		}
			
		$this->visitor_information->get_user_info($user_info);
	}

}