<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CriticalIllness extends CI_Controller {

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
		$this->load->model('mic_dbtest');
		$this->load->model('city');
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->load->library('util');
		$this->load->helper('html');
		date_default_timezone_set('Asia/Kolkata');
	}


	public function index()
	{
		$data=array();
		
		$data['cvg_amt']=array(	'1'=>'Below 1 Lakh',
				'2'=>'1 Lakh',
				'3'=>'2 Lakhs',
				'4'=>'3 Lakhs',
				'5'=>'4 Lakhs',
				'6'=>'5 Lakhs',
				'7'=>'7.5 Lakhs',
				'8'=>'10 Lakhs',
				'9'=>'15 Lakhs',
				'10'=>'20 Lakhs',
				'11'=>'50 Lakhs'
		);
		
		$data['family_composition']=array(	'1A'=>'myself',
				'2A'=>'Self + Spouse',
				'1A1C'=>'Self + 1 Child',
				'1A2C'=>'Self + 2 Children',
				'1A3C'=>'Self + 3 Children',
				'1A4C'=>'Self + 4 Children',
				'2A1C'=>'Self + Spouse + 1 Child',
				'2A2C'=>'Self + Spouse + 2 Children',
				'2A3C'=>'Self + Spouse + 3 Children',
				'2A4C'=>'Self + Spouse + 4 Children'
		);
		
		$data['city']=$this->city->get_city();
		
		
		
		$this->load->view('critical_illness/home',$data);

		/* $user_info['session_id'] = $this->session->userdata('session_id');

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
			
		$this->mic_dbtest->get_user_info($user_info);
 */
	}
	
	public function get_critical_illness_results()
	{
		echo "inside controller";
	}
}