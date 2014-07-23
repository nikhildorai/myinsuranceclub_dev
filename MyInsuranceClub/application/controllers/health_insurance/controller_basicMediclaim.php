<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class controller_basicMediclaim extends MIC_Controller {

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
		
		
		
	}
	
	
	public function index()
	{
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
		
		// Discussion: Put form validations in common function in Util
		
		/* Form Validation Rules */
		$post='';
	
		if($this->input->post()=='')
		{
			$post = $this->session->userdata('user_input');
		}
	
		// Please create a validation util function and do these validations there.
		$this->form_validation->set_rules('cust_name', 'Full Name', 'required|alpha');
	
		$this->form_validation->set_rules('cust_mobile', 'Phone Number', 'required|phone_789|exact_length[10]');
	
		$this->form_validation->set_rules('cust_email', 'Email', 'required|valid_email');
	
		//$this->form_validation->set_rules('cust_dob', 'Date of Birth', 'required|age_greater_than_18');
	
		//$this->form_validation->set_rules('MIC_terms', 'checkbox', 'required');
	
		$this->form_validation->set_error_delimiters('<div class="error" style="color: red;">', '</div>');
	
		/* Form Validation Rules Ends  */
	
		if (!($this->input->is_ajax_request()) && empty($post) && $this->form_validation->run() == FALSE)
		{
			$this->index();
		}
		else{
			
			// Discussion:Common for user input from all forms in Util
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
				
				//create function for name field in util.
				if($this->input->post('cust_name')!='')		/* customer personal details starts */
				{
					$user_input['full_name'] = $this->input->post('cust_name');
					
					$custname=explode(' ',$this->input->post('cust_name'));
					
					if(sizeof($custname)==1)
					{
						$user_input['first_name']=$custname[0];
							
						$user_input['middle_name']="";
							
						$user_input['last_name']="";
					}
					elseif(sizeof($custname)==2)
					{
						$user_input['first_name']=$custname[0];
							
						$user_input['middle_name']="";
							
						$user_input['last_name']=$custname[1];
					}
					elseif(sizeof($custname)==3)
					{
						$user_input['first_name']=$custname[0];
							
						$user_input['middle_name']=$custname[1];
							
						$user_input['last_name']=$custname[2];
					}
						
				}
				if($this->input->post('desktop_cust_dob')!='')
				{
					/* birthdate */
					
					$user_input['cust_birthdate']=$this->input->post('desktop_cust_dob');
					
					$birthage=$this->input->post('desktop_cust_dob');
					
				}
				elseif($this->input->post('m_cust_dob1')!='')
				{
					//echo $this->input->post('m_cust_dob1');
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
					/* $user_input['cust_city_name'] */;
				}
				
				$this->session->set_userdata('user_input',$user_input);
			}
			
			$user_input=$this->session->userdata('user_input',$user_input);
			
			//serialize($user_input),
			$this->input->set_cookie('mic_userdata',$this->session->userdata('session_id'),'864000');
			$data['user_input'] = $user_input;
			$data['compareParam'] = $param;
			$this->mic_dbtest->customer_personal_search_details($user_input);
			$this->db->freeDBResource($this->db->conn_id);
			
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
				
				$data['customer_details']=$this->mic_dbtest->get_policy_results($user_input);
				
				if(!empty($data['customer_details']))
				{
					Util::saveResultToCache($cacheFileName,$data['customer_details']);
				}
			}
			
			/* Filter Data Received From Ajax Post */
			
			if($this->input->is_ajax_request())
			{
				
				$search_filter=$_POST;
				
				foreach($data['customer_details'] as $k => $v)
				{
					if(isset($search_filter['room_rent']))
					{
						if ( $v['room_rent'] != 'Fully Covered' )
						{
							unset($data['customer_details'][$k]);
						}
					}
					if(isset($search_filter['maternity']))
					{
						if ( $v['maternity'] == 'Not Covered' )
						{
							unset($data['customer_details'][$k]);
						}
					}
					if(isset($search_filter['precover']))
					{
						if (!(in_array(trim($v['preexisting_diseases']),$search_filter['precover'])))
						{
							unset($data['customer_details'][$k]);
						}
					}
					if(isset($search_filter['sector']))
					{
	
						if (!(in_array(trim($v['public_private_health']),$search_filter['sector'])))
						{
							unset($data['customer_details'][$k]);
						}
					}
					
					if(isset($search_filter['health_comp']))
					{
						
						if (!(in_array(trim($v['company_type_id']),$search_filter['health_comp'])))
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
					
					
					if(isset($search_filter['min_premium_amt']))
					{
						$min_amt_arr = explode('₹',$search_filter['min_premium_amt']);
						
						$min_premium = (int) str_replace(',','',$min_amt_arr[1]);
						
						if(!($v['annual_premium'] >= $min_premium))
						{
							unset($data['customer_details'][$k]);
						}
					}
					
					if(isset($search_filter['max_premium_amt']))
					{
						$max_amt_arr = explode('₹',$search_filter['max_premium_amt']);
						
						$max_premium = (int) str_replace(',','',$max_amt_arr[1]);
						
						if(!($v['annual_premium'] <= $max_premium))
						{
							unset($data['customer_details'][$k]);
						}
					}
					
					/* if(isset($search_filter['min_claim_ratio']))
					{
						
						$min_claims_ratio = (int) str_replace(' %','',$search_filter['min_claim_ratio']);
						
						if($v['claim_ratio'] <= $min_claims_ratio)
						{
							unset($data['customer_details'][$k]);
						}
					}
					
					if(isset($search_filter['max_claim_ratio']))
					{
						
						$max_claims_ratio = (int) str_replace(' %','',$search_filter['max_claim_ratio']);
					
						if($v['claim_ratio'] >= $max_claims_ratio)
						{
							unset($data['customer_details'][$k]);
						}
					} */
				
					
					
				}
				
				
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
				//var_dump($premiums_from_ajax);
				//exit;
				//$this->session->set_userdata('search_filters',$search_filter);
				
				//$this->session->userdata('search_filter',$search_filter);
				
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
	
	
	public function get_hospital_list()
	{
		
		
		$this->load->model('get_hospital_list');
		
		if($_GET != '')
		{
			
			$company_hospitals = $_GET['search_keyword'];
			$company_id = $_GET['company_id'];
		}	
		
		$response = '';
		$result = $this->get_hospital_list->get_list($company_id,$company_hospitals);
		/* echo "<pre>";
		var_dump($result); */
		if(empty($result) && !in_array($company_id,$result))
		{
			$response .= '<div class="tt-suggestion clearfix" style="white-space: nowrap;"><p style="white-space: normal;">No Matches Found.</div>';
		}
		
		elseif(!empty($result))
		{	
			
			foreach($result as $k=>$v)
			{
				$response.='<div class="tt-suggestion clearfix" style="white-space: nowrap;"><p style="white-space: normal;">';
				
				$response .= "<span class='city_a'>".$v['hospital_name']."</span><span class='city_b'>".$v['hospital_city']."</span><span class='city_c'>".$v['hospital_pincode']."</span>";
				
				$response .='</p></div>';
			}
		}
		echo $response;
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
		$this->load->model('model_compare_mediclaim_policies');
	
		$data=array();
	
		$variant=array();
	
		$annual_premium=array();
	
		$age=array();
	
		if($this->input->post('compare')!=null)
		{
				
			foreach($this->input->post('compare') as $k=>$v)
			{
				//Discussion - Please check the length of the $compare and it should be 3. Otherwise
				// Redirect the user to the error page.
				$compare=explode('-',$v);
	
				$variant[]=$compare[0];
	
				$annual_premium[]=$compare[1];
	
				$age=$compare[2];
			}
				
		}
		$data['comparison_results']=$this->model_compare_mediclaim_policies->get_comparison($variant,$annual_premium,$age);
	
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
		
		$this->template->set_template('frontendsearch');
		$this->template->write_view('content', 'health_insurance/compare_results', $data, TRUE);
		$this->template->render();
		
		//$this->load->view('health_insurance/compare_results',$data);
	}
	
}
/* End of basicMediclaim controller. */