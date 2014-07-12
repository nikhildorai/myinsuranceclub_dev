<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class basicMediclaim extends CI_Controller {

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
		$this->load->model('visitor_information');
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->load->library('util');
		$this->load->helper('html');
		date_default_timezone_set('Asia/Kolkata');
	}
	
	
	public function index()
	{
		
		$this->load->model('city');
		
		$data=array();
		
		$data['cvg_amt']=array(	//'1'=>'Below 1 Lakh',
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
		
		$data['family_composition']=array(	'1A'=>'Myself',
											'2A'=>'Self + Spouse',
											'2A1C'=>'Self + Spouse + 1 Child',
											'2A2C'=>'Self + Spouse + 2 Children',
											'2A3C'=>'Self + Spouse + 3 Children',
											'2A4C'=>'Self + Spouse + 4 Children',
											'1A1C'=>'Self + 1 Child',
											'1A2C'=>'Self + 2 Children',
											'1A3C'=>'Self + 3 Children',
											'1A4C'=>'Self + 4 Children'
											
											);
		
		$data['city']=$this->city->get_city();
		
		
		$this->template->set_template('frontend');
		$this->template->write_view('content', 'health_insurance/health1', $data, TRUE);
		$this->template->render();
		//$this->load->view('health_insurance/health1',$data);
	
	}
	
	public function health_policy()
	{
		/* Form Validation Rules */
		$post='';
	
		if($this->input->post()=='')
		{
			$post = $this->session->userdata('user_input');
		}
	
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
				elseif($this->input->post('mobile_cust_dob')!='')
				{
					$user_input['cust_birthdate']=$this->input->post('mobile_cust_dob');
					
					$birthage=$this->input->post('mobile_cust_dob');
				}
					/* birthdate ends */
					
					
					/* age */
					
					$birthDate=explode('/',$birthage);
	
					$age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
							? ((date("Y") - $birthDate[2]) - 1)
							: (date("Y") - $birthDate[2]));
	
					$user_input['cust_age']=$age;
					
					/* age ends */
				
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
			
			$data['user_input'] = $user_input;
			
			$this->mic_dbtest->customer_personal_search_details($user_input);
			
			$data['customer_details']=$this->mic_dbtest->get_policy_results($user_input);
	
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
					if(isset($search_filter['company_name']))
					{
						if (!(in_array(trim($v['company_id']),$search_filter['company_name'])))
						{
							unset($data['customer_details'][$k]);
						}
					}
				}
					
				echo $this->util->getUserSearchFiltersHtml($data['customer_details'], $type = "health");
					
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
		if(empty($result))
		{
			$response = '<div class="tt-suggestion clearfix" style="white-space: nowrap;"><p style="white-space: normal;">Hospital List Not Available For This Company</div>';
		}
		
		if(!empty($result))
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
		$data['comparison_results']=$this->compare_health_policies->get_comparison($variant,$annual_premium,$age);
	
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