<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class controller_termPlan extends Customer_Controller {
	
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
		$this->load->model('model_get_company_plans_count');
		$this->load->model('model_get_results_term_plan');
	}
	
	
	public function index()
	{
		$product_name = 'level-term';
		$this->load->model('model_city');
		
		
		$data=array();
		
		$data['cvg_amt']=array(	'1000000'=>'10 Lakhs',
								'1500000'=>'15 Lakh',
								'2000000'=>'20 Lakhs',
								'2500000'=>'25 Lakhs',
								'3000000'=>'30 Lakhs',
								'3500000'=>'35 Lakhs',
								'4000000'=>'40 Lakhs',
								'4500000'=>'45 Lakhs',
								'5000000'=>'50 Lakhs',
								'5500000'=>'55 Lakhs',
								'6000000'=>'60 Lakhs',
								'6500000'=>'65 Lakhs',
								'7000000'=>'70 Lakhs',
								'7500000'=>'75 Lakhs',
								'8000000'=>'80 Lakhs',
								'8500000'=>'85 Lakhs',
								'9000000'=>'90 Lakhs',
								'9500000'=>'95 Lakhs',
								'10000000'=>'1 Crore',
								'20000000'=>'2 Crores',
								'30000000'=>'3 Crores',
								'40000000'=>'4 Crores',
								'50000000'=>'5 Crores'
								);
		
		$data['term_in_years']=array(		'5'=>'5 years',
											'10'=>'10 years',
											'15'=>'15 years',
											'20'=>'20 years',
											'25'=>'25 years',
											'30'=>'30 years',
											'5'=>'5 years',
											'6'=>'6 years',
											'7'=>'7 years',
											'8'=>'8 years',
											'9'=>'9 years',
											'10'=>'10 years',
											'11'=>'11 years',
											'12'=>'12 years',
											'13'=>'13 years',
											'14'=>'14 years',
											'15'=>'15 years',
											'16'=>'16 years',
											'17'=>'17 years',
											'18'=>'18 years',
											'19'=>'19 years',
											'20'=>'20 years',
											'21'=>'21 years',
											'22'=>'22 years',
											'23'=>'23 years',
											'24'=>'24 years',
											'25'=>'25 years',
											'26'=>'26 years',
											'27'=>'27 years',
											'28'=>'28 years',
											'29'=>'29 years',
											'30'=>'30 years',
											'31'=>'31 years',
											'32'=>'32 years',
											'33'=>'33 years',
											'34'=>'34 years',
											'35'=>'35 years',
											'36'=>'36 years',
											'37'=>'37 years',
											'38'=>'38 years',
											'39'=>'39 years',
											'40'=>'40 years'
											);
		$data['company_plan_count'] = $this->model_get_company_plans_count->get_count($product_name);
		$this->db->freeDBResource($this->db->conn_id);
		$data['annual_income'] = array( );
		
		$data['city']=$this->model_city->get_city();
		$this->db->freeDBResource($this->db->conn_id);
		
		$this->template->set_template('frontend');
		$this->template->write_view('content', 'termPlan/home', $data, TRUE);
		$this->template->render();
		
	}
	
	public function get_termPlan_results($param = "no")
	{
		
		$post='';
		
		if($this->input->post()=='')
		{
			$post = $this->session->userdata('user_input');
		}
		
		
		$userInputValidation = Util::getUserInputValidation('term');
		
		if($userInputValidation == FALSE && !($this->input->is_ajax_request()) && empty($post))
		{
			$this->index();
		}
			
		else 
		{
			$data = array();
			
			$user_input = array();
			
			if($this->input->post('submit'))
			{
					
				$user_input['product_name']=$this->input->post('product_name');
				
				$user_input['product_type']=$this->input->post('product_type');
				
				if($this->input->post('coverage_amount_term')!='')
				{
					$user_input['coverage_amount_term']=$this->input->post('coverage_amount_term');
				}
				
				if($this->input->post('coverage_amount_literal')!='')
				{
					$user_input['coverage_amount_literal']=$this->input->post('coverage_amount_literal');
				}
				
				if($this->input->post('policy_term')!='')
				{
					$user_input['policy_term']=$this->input->post('policy_term');
				}
				
				if($this->input->post('policy_term_name')!='')
				{
					$user_input['policy_term_name']=$this->input->post('policy_term_name');
				}
				
				if($this->input->post('cust_name')!='')		/* customer personal details starts */
				{
					
					$user_input['full_name'] = $this->input->post('cust_name');
						
					$custname= Util::explodeFullName($user_input['full_name']); 
					
					$user_input['first_name']=$custname['first_name'];
						
					$user_input['middle_name']=$custname['middle_name'];
						
					$user_input['last_name']=$custname['last_name'];
						
				}
				
				if($this->input->post('desktop_cust_dob')!='')
				{
					/* birthdate */
						
					$user_input['cust_birthdate']=$this->input->post('desktop_cust_dob');
						
					/* age */
						
					$user_input['cust_age']= Util::convertBirthdateToAge($this->input->post('desktop_cust_dob'));
						
				}
				
				if($this->input->post('cust_gender')!='')
				{
					$user_input['cust_gender']=$this->input->post('cust_gender');
				}
				
				if($this->input->post('smoker')!='')
				{
					$user_input['smoker']=$this->input->post('smoker');
				}
				
				if($this->input->post('cust_mobile')!='')
				{
					$user_input['cust_mobile']=$this->input->post('cust_mobile');
				}
				
				if($this->input->post('cust_email')!='')
				{
					$user_input['cust_email']=$this->input->post('cust_email');
				}
				
				if($this->input->post('cust_city_name')!='')		
				{
					$user_input['cust_city']=$this->input->post('cust_city_name');
					
				}
				
				$this->session->set_userdata('user_input',$user_input);
			}
			
			$user_input=$this->session->userdata('user_input',$user_input);
				
			$data['user_input'] = $user_input;
			
			$data['compareParam'] = $param;
			
			$this->model_customer_personal_and_search_details->customer_personal_search_details($user_input);
			$this->db->freeDBResource($this->db->conn_id);
			
			$cacheFileName = 'SR_'.$user_input['product_type'].$user_input['coverage_amount_term'].$user_input['cust_age'].$user_input['cust_gender'].$user_input['cust_city'].$user_input['smoker'] ;
				
			$cacheObject = Util::getCachedObject($cacheFileName);
				
			if($cacheObject != null)
			{
				// get result set from cache
				$data['customer_details'] = $cacheObject;
			}
			else 
			{
				$data['customer_details'] = $this->model_get_results_term_plan->get_results($user_input);
				
				if(!empty($data['customer_details']))
				{
					Util::saveResultToCache($cacheFileName,$data['customer_details']);
				}
				
				$this->db->freeDBResource($this->db->conn_id);
			}
			
			$cookie_filter = Util::getCookie('user_filter');
			
				
			if($data['compareParam'] == "yes" && !empty($cookie_filter))
			{
				$data['cookie_customer_detail'] = Util::getFilteredDataForTermPlan($data['customer_details'],$cookie_filter);
			
			}
			
			//Filter data received from Ajax Post 
			 	
			if($this->input->is_ajax_request())
			{
				$search_filter = array();
				
				Util::setCookies('user_filter',$_POST);
				
				$search_filter=$_POST;
				
				$data['customer_details'] = Util::getFilteredDataForTermPlan($data['customer_details'],$search_filter);
				
				$company_discard = array();
					
				$companycnt = array();
				
				$getPremium = array();
				foreach($data['customer_details'] as $k=>$v)
				{
				
					if(!in_array($v['company_id'],$companycnt))
					{
						$companycnt[] = $v['company_id'];
					}
					$company_discard[] = $v['company_id'];
					
				}
				$getPremium = Util::getMinAndMaxPremium($data['customer_details']);
				
				$return['html'] = $this->load->view('termPlan/ajaxPostResultView',$data,TRUE);
				
				$return['company'] = count($companycnt);
				
				$return['plan'] = count($data['customer_details']);
				
				$return['minPremium'] = $getPremium['min_premium'];
				$return['maxPremium'] = $getPremium['max_premium'];
				
				echo  json_encode($return);
				
			}
			
			/**************************************/
			
			else 
			{
			
				$this->template->set_template('frontendsearch');
				$this->template->write_view('content', 'termPlan/search_results', $data, TRUE);
				$this->template->render();
				//$this->load->view('termPlan/search_results',$data);
		
			}	
		} 
	}
	
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
		/* $this->load->model('compare_health_policies');
	
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
		$data['comparison_results']=$this->compare_health_policies->get_comparison($variant,$annual_premium,$age);
	
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
		$data['result']=$result; */
	
		$this->load->view('termPlan/compare_results');
	}
	
}
/* End of termPlan controller. */
