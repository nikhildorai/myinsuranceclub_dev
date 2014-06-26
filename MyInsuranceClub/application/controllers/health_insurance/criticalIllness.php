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
		$this->load->model('get_results_critical_illness');
		$this->load->model('compare_critical_illness_policies');
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
		
		/* $data['cvg_amt']=array(	'1'=>'Below 1 Lakh',
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
								); */
		
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
		$data = array();
		
		$user_input = array();
		
		if($this->input->post('submit')!='')
		{
			if($this->input->post('product_name')!='')
			{
				$user_input['product_name'] = $this->input->post('product_name');
			}
			
			if($this->input->post('product_type')!='')
			{
				$user_input['product_type'] = $this->input->post('product_type');
			}
			
			if($this->input->post('plan_type')!='')
			{
				$user_input['plan_type'] = $this->input->post('plan_type');//$this->input->post('plan_type');
			}
			
			if($this->input->post('cust_gender')!='')
			{
				$user_input['cust_gender'] = $this->input->post('cust_gender');
			}
			
			if($this->input->post('cust_dob')!='')
			{
				$user_input['cust_birthdate'] = $this->input->post('cust_dob');
				
				$birthage=$this->input->post('cust_dob');
				
				$birthDate=explode('-',$birthage);
				
				$age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")? ((date("Y") - $birthDate[2]) - 1): (date("Y") - $birthDate[2]));
				
				$user_input['cust_age']=$age;
				
			}
			
			if($this->input->post('spouse_dob')!='')
			{
				$user_input['spouse_dob']=$this->input->post('spouse_dob');
			}
			
			if($this->input->post('spouse_gender')!='')
			{
				$user_input['spouse_gender']=$this->input->post('spouse_gender');
			}
			
			if($this->input->post('child1_dob')!='')
			{
				$user_input['child1_dob']=$this->input->post('child1_dob');
			}
			
			if($this->input->post('child1_gender')!='')
			{
				$user_input['child1_gender']=$this->input->post('child1_gender');
			}
			if($this->input->post('child2_dob')!='')
			{
				$user_input['child2_dob']=$this->input->post('child2_dob');
			}
			
			if($this->input->post('child2_gender')!='')
			{
				$user_input['child2_gender']=$this->input->post('child2_gender');
			}
			
			if($this->input->post('child3_dob')!='')
			{
				$user_input['child3_dob']=$this->input->post('child3_dob');
			}
			
			if($this->input->post('child3_gender')!='')
			{
				$user_input['child3_gender']=$this->input->post('child3_gender');
			}
			
			if($this->input->post('child4_dob')!='')
			{
				$user_input['child4_dob']=$this->input->post('child4_dob');
			}
			
			if($this->input->post('child4_gender')!='')
			{
				$user_input['child4_gender']=$this->input->post('child4_gender');
			}
			
			$this->session->set_userdata('user_input',$user_input);
		}
		
		$user_input=$this->session->userdata('user_input',$user_input);
		
		$data['user_input'] = $user_input;
		
		$this->mic_dbtest->customer_personal_search_details($user_input);
		
		$data['customer_details'] = $this->get_results_critical_illness->get_results($user_input);
		
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
			echo $this->util->getUserSearchFiltersHtml($data['customer_details'], $type = "criticalillness");
		}
		
		/**************************************/
		
		else 
		{
			$this->load->view('critical_illness/search_results',$data);
		}
		
	}
	
	public function compare_policies()
	{
		$this->load->model('compare_health_policies');
	
		$data=array();
	
		$variant=array();
	
		$annual_premium=array();
	
		$age=array();
	
		if($this->input->post('compare')!=null)
		{
				
			foreach($this->input->post('compare') as $k=>$v)
			{
				$compare=explode('-',$v);
	
				$variant[]=$compare[0];
	
				$annual_premium[]=$compare[1];
	
				$age=$compare[2];
			}
				
		}
		$data['comparison_results']=$this->compare_critical_illness_policies->get_comparison($variant,$annual_premium,$age);
	
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
	
		$this->load->view('critical_illness/compare_results',$data);
	}
}