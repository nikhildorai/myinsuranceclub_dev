<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pre_Hook_Controller extends Customer_Controller {

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
		$this->load->library('session');
		$this->load->library('user_agent');
		$this->load->database();
		$this->load->model('model_get_wls_detail');
		$this->load->model('model_visitor_information');
		
		$currentModule = $this->util->getUrl('module')
		;
		//	load different views for backend and front end
		if (!empty($currentModule))
		{
			if ($currentModule == 'admin')
				$this->template->set_template('default');
			else 
				$this->template->set_template('frontend');
		}
		else 
		{
			$this->template->set_template('frontend');	
		}
	}
	
	
	public function index()
	{
		try{
			//print_r($_SERVER['HTTP_HOST']);
		$WLSDetails = $this->model_get_wls_detail->get_wls($_SERVER['HTTP_HOST']);
		
		$this->db->freeDBResource($this->db->conn_id);
		
		if ($WLSDetails != null)
		{
			$_REQUEST["WLSDetails"] = $WLSDetails;
		}
		
		//echo "<pre>";
		//print_r($this->router->config->base_url());
		//var_dump();
		// Now you would make a DB call where in you would pass $_SERVER['HTTP_HOST'] as paramtere. 
		//exit;
		//print_r('-----------------------');
		
		//print_r($this->uri);
		//exit;
		
		// Fetching user info from the request and storing it in the database.
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
		$this->model_visitor_information->get_user_info($user_info);
		
		$this->db->freeDBResource($this->db->conn_id);
		
		
		}
		catch (Exception $ex)
		{
			return $ex;
			// error has to be reported and the app should redirect the user to some default url.
		}
	}

}