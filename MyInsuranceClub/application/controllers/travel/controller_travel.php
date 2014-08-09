<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class controller_travel extends Customer_Controller {

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
		$this->load->model('annual_premium_travel_model');
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
		$data['family_composition']=array(	'1A'=>'myself',
											'2A'=>'Self + Spouse',
											'2A2C'=>'Self + Spouse + 2 Children',
											);
	
		$occupation = $this->util->getCompanyTypeDropDownOptions($modelName ='Occupation_model', $optionKey = 'occupation_id', $optionValue = 'occupation_name', $defaultEmpty = "", $extraKeys = true);

		$data['occupation']=$occupation;
		
		$this->load->view('travel_insurance/home',$data);

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
	
	public function get_personal_accident_results()
	{
		$data = array();
		
		$user_input = array();

		if($this->input->post('submit')!='' && !empty($_POST))
		{
			$arrSkip = array('MIC_terms','submit');
			foreach ($_POST as $k1=>$v1)
			{
				if (!in_array($k1, $arrSkip) && !empty($v1))
					$user_input[$k1] = trim($v1);
			}
			$this->session->set_userdata('user_input',$user_input);
		}	
		$user_input=$this->session->userdata('user_input',$user_input);
//var_dump($user_input,$_POST);
		
		$data['user_input'] = $user_input;
		
		$this->mic_dbtest->customer_personal_search_details($user_input);
		
		$data['customer_details'] = $this->annual_premium_personal_accident_model->get_results($user_input);
//var_dump($data);die;
		/* Filter Data Received From Ajax Post */
		
		if($this->input->is_ajax_request())
		{
			$search_filter=$_POST;
			foreach($data['customer_details'] as $k => $v)
			{
				if(isset($search_filter['sum_assured']))
				{
					if (!in_array($v['sum_assured'],$search_filter['sum_assured']))
					{
						unset($data['customer_details'][$k]);
					}
				}
				
				if(isset($search_filter['sector']))
				{
						
					if (!(in_array($v['public_private_health'],$search_filter['sector'])))
					{
						unset($data['customer_details'][$k]);
					}
				}
				
				if(isset($search_filter['company_name']))
				{
					if (!(in_array(trim($v['company_id']),$search_filter['company_name'])))
					{
						unset($data['customer_details'][$k]);
					}
				}
			}
			echo $this->util->getUserSearchFiltersHtml($data['customer_details'], $type = "personalAccident");
		}
		
		/**************************************/
		
		else 
		{
			$this->load->view('personal_accident/search_results',$data);
		}
		
	}
	
	public function compare_policies()
	{
		$data=$variant=$annual_premium=$age=array();
		if($this->input->post('compare')!=null)
		{	
			foreach($this->input->post('compare') as $k=>$v)
			{
				$compare=explode('-',$v);
				$variant[]=$compare[0];
				$annual_premium[]=$compare[1];
			//	$age=$compare[2];
			}
			$variant = implode(',', $variant);
			$annual_premium = implode(',', $annual_premium);
		}
		$data['comparison_results']=$this->annual_premium_personal_accident_model->get_comparison($variant,$annual_premium,$age);
	
		foreach ($data['comparison_results'] as $k1=>$v1)
		{
				
			foreach ($v1 as $k2=>$v2)
			{
				if ($k2 == 'company_shortname')
				{
					$key = 'Company';
				}
				else
				{
					$key = ucfirst(str_replace(array('_','-',' '), ' ', $k2));
				}
				$result[$key][] = $v2;
			}
		}
		$data['result']=$result;
		$this->load->view('personal_accident/compare_results', $data);
	}
}