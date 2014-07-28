<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class termPlan extends CI_Controller {

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
		$this->load->model('get_results_term_plan');
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
		$data['annual_income'] = array( );
		
		$data['city']=$this->city->get_city();
		
		$this->load->view('termPlan/home',$data);
	
	}
	
	public function get_termPlan_results()
	{
		
		$this->form_validation->set_rules('cust_name', 'Full Name', 'required|alpha');
	
		$this->form_validation->set_rules('cust_mobile', 'Phone Number', 'required|phone_789|exact_length[10]');
	
		$this->form_validation->set_rules('cust_email', 'Email', 'required|valid_email');
	
		$this->form_validation->set_rules('cust_dob', 'Date of Birth', 'required|age_greater_than_18');
		
		$this->form_validation->set_rules('smoker', 'Smoker/Non-Smoker', 'required');
		
		$this->form_validation->set_rules('MIC_terms', 'checkbox', 'required');
	
		$this->form_validation->set_error_delimiters('<div class="error" style="color: red;">', '</div>');
		
		if($this->form_validation->run()==FALSE)
		{
			return $this->index();
		}
		else 
		{
			
			$data = array();
			
			$user_input = array();
			
			if($this->input->post('submit'))
			{
					
				$user_input['product_name']=$this->input->post('product_name');
				
				$user_input['product_type']=$this->input->post('product_type');
				
				if($this->input->post('coverage_amount')!='')
				{
					$user_input['coverage_amount']=$this->input->post('coverage_amount');
				}
				
				if($this->input->post('coverage_amount_literal')!='')
				{
					$user_input['coverage_amount_literal']=$this->input->post('coverage_amount_literal');
				}
				
				if($this->input->post('policy_term')!='')
				{
					$user_input['policy_term']=$this->input->post('policy_term');
				}
				
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
				
				if($this->input->post('cust_dob')!='')
				{
					/* birthdate */
						
					$user_input['cust_birthdate']=$this->input->post('cust_dob');
						
					/* age */
						
					$birthage=$this->input->post('cust_dob');
				
					$birthDate=explode('-',$birthage);
				
					$age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md") ? ((date("Y") - $birthDate[2]) - 1) : (date("Y") - $birthDate[2]));
				
					$user_input['cust_age']=$age;
						
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
					$user_input['cust_city_name']=$this->input->post('cust_city_name');
				}
				
				$this->session->set_userdata('user_input',$user_input);
			}
			
			$user_input=$this->session->userdata('user_input',$user_input);
				
			$data['user_input'] = $user_input;
			
			
			$this->mic_dbtest->customer_personal_search_details($user_input);
			
			$data['customer_details'] = $this->get_results_term_plan->get_results($user_input);
			
			/* Filter data received from Ajax Post */
			 	
			if($this->input->is_ajax_request())
			{
				
				
				$this->util->getUserSearchFiltersHtml($customer_details, $type = "termplan");
			}
			
			/**************************************/
			
			else 
			{
			
				$this->load->view('termPlan/search_results',$data);
		
			}	
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
