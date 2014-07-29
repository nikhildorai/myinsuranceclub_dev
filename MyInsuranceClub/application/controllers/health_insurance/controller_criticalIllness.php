<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class controller_criticalIllness extends Customer_Controller {

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
		
		$this->load->model('model_get_results_critical_illness');
		$this->load->model('model_compare_critical_illness_policies');
		$this->load->model('model_get_company_plans_count');
		//$this->load->model('model_city');
		
	}


	public function index()
	{
		$data=array();
		
		$this->input->set_cookie('user_filter','');
		
		$this->input->set_cookie('compared_plans','');
		
		$product_name = 'critical-illness';
		
		$data['family_composition']= Util::getFamilyComposition($product_name);
		
		$data['company_plan_count'] = $this->model_get_company_plans_count->get_count($product_name);
		
		$this->template->set_template('frontend');
		$this->template->write_view('content', 'critical_illness/home', $data, TRUE);
		$this->template->render();
	
	}
	
	public function get_critical_illness_results($param="no")
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
			
			if($this->input->post('plan_type_name')!='')
			{
				$user_input['plan_type_name'] = $this->input->post('plan_type_name');//$this->input->post('plan_type');
			}
			
			if($this->input->post('cust_dob')!='')
			{
				$user_input['cust_birthdate'] = $this->input->post('cust_dob');
				
				$birthage=$this->input->post('cust_dob');
				
				//$birthDate=explode('-',$birthage);
				
				
				$user_input['cust_age']= Util::convertBirthdateToAge($user_input['cust_birthdate']);
				
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
		
		$data['compareParam'] = $param;
		
		$this->input->set_cookie('mic_userdata',$this->session->userdata('session_id'),'864000');
		
		$this->model_customer_personal_and_search_details->customer_personal_search_details($user_input);
		$this->db->freeDBResource($this->db->conn_id);
		
		$cacheFileName = 'sr_'.$user_input['product_type'].$user_input['plan_type'].$user_input['cust_age'];
		
		$cacheObject = Util::getCachedObject($cacheFileName);
		
		
		if($cacheObject != null)
		{
			// get result set from cache
			$data['customer_details'] = $cacheObject;
		}
		else
		{
			
			$data['customer_details'] = $this->model_get_results_critical_illness->get_results($user_input);
			
				if(!empty($data['customer_details']))
				{
					Util::saveResultToCache($cacheFileName,$data['customer_details']);
				}
		}
		
		$cookie_filter = Util::getCookie('user_filter');
		
		if($data['compareParam'] == "yes" && !empty($cookie_filter))
		{
			$data['cookie_customer_detail'] = Util::getFilteredDataForCriticalIllness($data['customer_details'],$cookie_filter);
		
		}
		
		/* Filter Data Received From Ajax Post */
		if($this->input->is_ajax_request())
		{
			$search_filter = array();
				
				Util::setCookies('user_filter',$_POST);
				
				$search_filter=$_POST;

				$data['customer_details'] = Util::getFilteredDataForCriticalIllness($data['customer_details'],$search_filter);
			
			$company_discard = array();
				
			$companycnt = array();
				
			foreach($data['customer_details'] as $k=>$v)
			{
			
				if(!in_array($v['company_id'],$companycnt))
				{
					$companycnt[] = $v['company_id'];
				}
				$company_discard[] = $v['company_id'];
			}
				
			$premiums_from_ajax = Util::getMinAndMaxPremium($data['customer_details']);
			
			$return['html'] = $this->load->view('critical_illness/ajaxPostResultView',$data,TRUE);
			$return['company'] = count($companycnt);
			$return['plan'] = count($data['customer_details']);
			$return['minPremium'] = $premiums_from_ajax['min_premium'];
			$return['maxPremium'] = $premiums_from_ajax['max_premium'];
			echo  json_encode($return);
			//$this->load->view('critical_illness/ajaxPostResultView',$data,TRUE);
			//echo $this->util->getUserSearchFiltersHtml($data['customer_details'], $type = "criticalillness");
		}
		
		/**************************************/
		
		else 
		{
			$this->template->set_template('frontendsearch');
			$this->template->write_view('content', 'critical_illness/search_results', $data, TRUE);
			$this->template->render();
			
			//$this->load->view('critical_illness/search_results',$data);
		}
		
	}

	
	/**
	 * @abstract function to increase the buy now count in DB
	 */
	public function increment_count()
	{
		$this->load->model('model_buynow_count');
		
		$increase_count_arr = '';
		
		if(!empty($_POST))
		{
			$increase_count_arr = $_POST['policy_id'];
				
			$this->model_buynow_count->increase_count($increase_count_arr);
		}
	}
	
	public function compare_policies()
	{
		$this->load->model('model_compare_critical_illness_policies');
	
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
		$data['comparison_results']=$this->model_compare_critical_illness_policies->get_comparison($variant,$annual_premium,$age);
	
		foreach ($data['comparison_results'] as $k1=>$v1)
		{
				
			foreach ($v1 as $k2=>$v2)
			{
				/* if ($k2 == 'company_shortname')
				{
					$key = 'Company';
				}
	
				else
				{
					$key = ucfirst(str_replace(array('_','-',' '), ' ', $k2));
				} */
	
				$result[$k2][] = $v2;
			}
		}
		$data['result']=$result;
	
		$this->load->view('critical_illness/compare_results',$data);
	}
}