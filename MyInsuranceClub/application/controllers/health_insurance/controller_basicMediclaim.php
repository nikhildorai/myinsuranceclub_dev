<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class controller_basicMediclaim extends Customer_Controller {

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
		// please load the common module and models in base class controller.
		// Call the Controller constructor
		
		parent::__construct();
		
		$this->load->model('model_city');
		$this->load->model('model_get_company_plans_count');
		$this->load->model('model_get_results_mediclaim');
		
		
	}
	
	
	public function index()
	{
		
		$this->input->set_cookie('user_filter','');
		
		$this->input->set_cookie('compared_plans','');
		
		$product_name = "mediclaim";
		
		$data=array();
		
		$data['city'] = $this->model_city->get_city();
		
		$this->db->freeDBResource($this->db->conn_id);
		
		
		$data['cvg_amt']=array(	'50000'=>'50 Thousand',
								'75000'=>'75 Thousand',
								'100000'=>'1 Lakh',
								'200000'=>'2 Lakhs',
								'300000'=>'3 Lakhs',
								'400000'=>'4 Lakhs',
								'500000'=>'5 Lakhs',
								'750000'=>'7.5 Lakhs',
								'1000000'=>'10 Lakhs',
								'1500000'=>'15 Lakhs',
								'2000000'=>'20 Lakhs',
								'5000000'=>'50 Lakhs'
								);
		
		$data['family_composition']= Util::getFamilyComposition($product_name);
		
		$data['company_plan_count'] = $this->model_get_company_plans_count->get_count($product_name);
		
		$this->db->freeDBResource($this->db->conn_id);
		
		
		$this->template->set_template('frontend');
		$this->template->write_view('content', 'health_insurance/health1', $data, TRUE);
		$this->template->render();
	
	}
	
	public function health_policy($param="no")
	{
		
		/* Form Validation Rules */
		$post='';
	
		if($this->input->post()=='')
		{
			$post = $this->session->userdata('user_input');
		}
	
		
		$userInputValidation = Util::getUserInputValidation();
		
		if ($userInputValidation == FALSE && !($this->input->is_ajax_request()) && empty($post))
		{
			$this->index();
		}
		else{
			
			$search_filter=array();
	
			$user_input=array();/* array passed to database */
	
			$data=array();		/* array passed to the view with result */
	
			if ($this->input->post('submit'))			/* customer policy details start */
			{
				
				
				$user_input['product_name']=$this->input->post('product_name');
				
				$user_input['product_type']=$this->input->post('product_type');
	
				if($this->input->post('plan_type')!='')
				{
					$user_input['plan_type']=$this->input->post('plan_type');
				}
				
				if($this->input->post('plan_type_name')!='')
				{
					$user_input['plan_type_name']=$this->input->post('plan_type_name');
				}
				
				if($this->input->post('coverage_amount')!='')
				{
					$user_input['coverage_amount']=$this->input->post('coverage_amount');
					
				}
				
				if($this->input->post('coverage_amount_literal')!='')
				{
					$user_input['coverage_amount_literal']=$this->input->post('coverage_amount_literal');
						
				}
				
				if($this->input->post('adult')!='')
				{
					$user_input['adult']=$this->input->post('adult');
				}
				
				if($this->input->post('child')!='')
				{
					$user_input['child']=$this->input->post('child');
				}
				/*  customer policy details ends 	*/
				
				if($this->input->post('cust_name')!='')		/* customer personal details starts */
				{
					$explodedName = array();
					
					$user_input['full_name'] = $this->input->post('cust_name');
					
					$explodedName = Util::explodeFullName($this->input->post('cust_name'));
					
					$user_input['first_name'] = $explodedName['first_name'];

					$user_input['middle_name'] = $explodedName['middle_name'];
					
					$user_input['last_name'] = $explodedName['last_name'];
						
				}
				if($this->input->post('desktop_cust_dob')!='')
				{
					/* birthdate */
					
					$user_input['cust_birthdate']=$this->input->post('desktop_cust_dob');
					
					$birthage=$this->input->post('desktop_cust_dob');
					
				}
				
				elseif($this->input->post('m_cust_dob1')!='')
				{
					$user_input['cust_birthdate']=$this->input->post('m_cust_dob1');
					
					$birthage=$this->input->post('m_cust_dob1');
				}
					/* birthdate ends */
					
					/* age */
					
					$age = Util::convertBirthdateToAge($birthage);
					
					$user_input['cust_age'] = $age;
					
					
				if($this->input->post('cust_gender')!='')
				{
					$user_input['cust_gender']=$this->input->post('cust_gender');
				}
				
				
				if($this->input->post('desktop_spouce_dob')!='')
				{
					$user_input['spouse_dob']=$this->input->post('desktop_spouce_dob');
					
				}
				elseif($this->input->post('mobile_spouse_dob')!='')
				{
					$user_input['spouse_dob']=$this->input->post('mobile_spouse_dob');
					
				}
				
				if($this->input->post('spouse_gender')!='')
				{
					$user_input['spouse_gender']=$this->input->post('spouse_gender');
				}
				
				if($this->input->post('desktop_child1_dob')!='')
				{
					$user_input['child1_dob']=$this->input->post('desktop_child1_dob');
				}
				elseif($this->input->post('mobile_child1_dob')!='')
				{
					$user_input['child1_dob']=$this->input->post('mobile_child1_dob');
				}
				
				
				if($this->input->post('child1_gender')!='')
				{
					$user_input['child1_gender']=$this->input->post('child1_gender');
				}
				
				if($this->input->post('desktop_child2_dob')!='')
				{
					$user_input['child2_dob']=$this->input->post('desktop_child2_dob');
				}
				elseif($this->input->post('mobile_child2_dob')!='')
				{
					$user_input['child2_dob']=$this->input->post('mobile_child2_dob');
				}
				
				if($this->input->post('child2_gender')!='')
				{
					$user_input['child2_gender']=$this->input->post('child2_gender');
				}
				
				if($this->input->post('desktop_child3_dob')!='')
				{
					$user_input['child3_dob']=$this->input->post('desktop_child3_dob');
				}
				elseif($this->input->post('mobile_child3_dob')!='')
				{
					$user_input['child3_dob']=$this->input->post('mobile_child3_dob');
				}
				
				if($this->input->post('child3_gender')!='')
				{
					$user_input['child3_gender']=$this->input->post('child3_gender');
				}
				
				if($this->input->post('desktop_child4_dob')!='')
				{
					$user_input['child4_dob']=$this->input->post('desktop_child4_dob');
				}
				elseif($this->input->post('mobile_child4_dob')!='')
				{
					$user_input['child4_dob']=$this->input->post('mobile_child4_dob');
				}
				
				if($this->input->post('child4_gender')!='')
				{
					$user_input['child4_gender']=$this->input->post('child4_gender');
				}
				if($this->input->post('cust_mobile')!='')
				{
					$user_input['cust_mobile']=$this->input->post('cust_mobile');
				}
				if($this->input->post('cust_email')!='')
				{
					$user_input['cust_email']=$this->input->post('cust_email');
				}
				if($this->input->post('cust_city')!='')
				{
					$user_input['cust_city']=$this->input->post('cust_city');
				}										/* customer personal details end */
				
				if($this->input->post('cust_city_name')!='')
				{
					$user_input['cust_city_name']=$this->input->post('cust_city_name');
					
				}
				
				$this->session->set_userdata('user_input',$user_input);
			}
			
			$user_input=$this->session->userdata('user_input',$user_input);
			
			
			$this->input->set_cookie('mic_userdata',$this->session->userdata('session_id'),'864000');
			
			$data['user_input'] = $user_input;
			
			$data['compareParam'] = $param;
			
			$cacheFileName = 'sr_'.$user_input['product_type'].$user_input['plan_type'].$user_input['coverage_amount'].$user_input['cust_age'].$user_input['cust_gender'].$user_input['cust_city'] ;
			
			$cacheObject = Util::getCachedObject($cacheFileName);
			
			if($cacheObject != null)
			{
				// get result set from cache
				$data['customer_details'] = $cacheObject; 
			}
				
			else
			{
				//get result set from DB and save in cache
				$this->model_customer_personal_and_search_details->customer_personal_search_details($user_input);
					
				$this->db->freeDBResource($this->db->conn_id);
				
				$data['customer_details']=$this->model_get_results_mediclaim->get_policy_results($user_input);
				
				if(!empty($data['customer_details']))
				{
					Util::saveResultToCache($cacheFileName,$data['customer_details']);
				}
			}
			
			$cookie_filter = Util::getCookie('user_filter');
		
			
			if($data['compareParam'] == "yes" && !empty($cookie_filter))
			{
				$data['cookie_customer_detail'] = Util::getFilteredData($data['customer_details'],$cookie_filter);
				
			}
			
			/* Filter Data Received From Ajax Post */
			
			if($this->input->is_ajax_request())
			{	
				$search_filter = array();
				
				Util::setCookies('user_filter',$_POST);
				
				$search_filter=$_POST;

				$data['customer_details'] = Util::getFilteredData($data['customer_details'],$search_filter);
				
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
				
				$return['html'] = $this->load->view('health_insurance/ajaxPostResultView',$data,TRUE);
				$return['company'] = count($companycnt);
				$return['plan'] = count($data['customer_details']);
				$return['minPremium'] = $premiums_from_ajax['min_premium'];
				$return['maxPremium'] = $premiums_from_ajax['max_premium'];
				echo  json_encode($return);
			}
			else
			{	
					
				$this->template->set_template('frontendsearch');
				$this->template->write_view('content', 'health_insurance/search_results', $data, TRUE);
				$this->template->render();
				
			}
			
		}
	}
	
	
	/**
	 * 
	 */
	public function get_hospital_list()
	{
		
		
		$this->load->model('model_get_hospital_list');
		
		if($_GET != '')
		{
			
			$company_hospitals = $_GET['search_keyword'];
			$company_id = $_GET['company_id'];
		}	
		
		$response = '';
		
		$result = $this->model_get_hospital_list->get_list($company_id,$company_hospitals);
		
		
		if(empty($result) && !in_array($company_id,$result))
		{
			$response .= '<div class="tt-suggestion clearfix" style="white-space: nowrap;"><p style="white-space: normal;">No Matches Found.</div>';
		}
		
		elseif(!empty($result))
		{	
			
			foreach($result as $k=>$v)
			{
				$response.='<div class="tt-suggestion clearfix" style="white-space: nowrap;"><p style="white-space: normal;">';
				
				$response .= "<span class='city_a' style='cursor:pointer;' title='".$v['hospital_address'].", ".$v['hospital_city']." - ".$v['hospital_pincode']."'>".$v['hospital_name']."</span><span class='city_b'>".$v['hospital_city']."</span><span class='city_c'>".$v['hospital_pincode']."</span>";
				
				$response .='</p></div>';
			}
		}
		echo $response;
	}
	
	/**
	 * 
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
	
	/**
	 * 
	 */
	public function compare_policies()
	{
		$this->load->model('model_compare_mediclaim_policies');
	
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
		
		Util::setCookies('compared_plans',$variant);
		
		$data['comparison_results']=$this->model_compare_mediclaim_policies->get_comparison($variant,$annual_premium,$age);
	
		foreach ($data['comparison_results'] as $k1=>$v1)
		{
				
			foreach ($v1 as $k2=>$v2)
			{
				$result[$k2][] = $v2;
			}
		}
		$data['result']=$result;
		
		$this->template->set_template('frontendsearch');
		$this->template->write_view('content', 'health_insurance/compare_results', $data, TRUE);
		$this->template->render();
		
	}
	
	public function policyView($policySlug = '')
	{
		if (!empty($policySlug))
		{
        	$this->load->plugin('widget_pi');
        	$this->load->library('disquslib');
			$data = array();
			//	get policy
			//	all details with variant, variant features and riders
			$companyType = 'general-insurance-companies';
			$variantType = 'health-insurance';
			$data = Util::getPolicyVariantsFeaturesRidersDetails($policySlug, $variantType, $companyType);
//echo '<pre>';print_r($data);die;			
			$this->template->set_template('frontend');
			$this->template->write_view('content', 'health_insurance/policyView', $data, TRUE);
			$this->template->render();
		}
		else 
		{
			redirect('generalInsurance/companies/');
		}
	}
	
}
/* End of basicMediclaim controller. */