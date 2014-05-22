<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

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
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->library('form_validation');
		date_default_timezone_set('Asia/Kolkata');
	}
	public function index()
	{
		$this->load->view('MIC_DEV');
		
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
		 
			//$user_info['location']="<span id='myField'></span>";
		 	$this->mic_dbtest->get_user_info($user_info);
		 	
	}
	
	public function health_policy()
	{	
		/* Form Validation Rules */
		$this->form_validation->set_rules('cust_name', 'Full Name', 'required|alpha_spaces_dots');
		$this->form_validation->set_rules('cust_mobile', 'Phone Number', 'required|numeric|phone_789|exact_length[10]');
		$this->form_validation->set_rules('cust_email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('cust_dob', 'Date of Birth', 'required|age_greater_than_18');
		$this->form_validation->set_rules('cust_city', 'City', 'required');
		$this->form_validation->set_rules('plan_type', 'Plan', 'required');
		$this->form_validation->set_error_delimiters('<div class="error" style="color: red;">', '</div>');
		/* Form Validation Rules Ends  */
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->index();
		}
		else{
		
			$user_input=array();/* array passed on to database */
			$data=array();		/* array passed to the view with result */
		
			if ($this->input->post()!='')			/* customer policy details start */
			{
				$plan_type=explode('/',$this->input->post('product_des'));
				$user_input['product_name']=$plan_type[0];
				$user_input['product_type']=$plan_type[1];
						
			
				if($this->input->post('plan_type')!='')
				{
					$user_input['plan_type']=$this->input->post('plan_type');
				}
				if($this->input->post('coverage_amount')!='')
				{
					$user_input['coverage_amount']=$this->input->post('coverage_amount');
				}
				if($this->input->post('adult')!='')
				{
					$user_input['adult']=$this->input->post('adult');
				}
				if($this->input->post('child')!='')
				{
					$user_input['child']=$this->input->post('child');
				}
				if($this->input->post('policy_term')!='')
				{
					$user_input['policy_term']=$this->input->post('policy_term');
				}												/* customer policy details ends */
			
				if($this->input->post('cust_name')!='')			/* customer personal details starts */
				{
					$custname=explode(' ',$this->input->post('cust_name'));
					
					if(count($custname==1))
					{
						$user_input['first_name']=$custname[0];
						$user_input['middle_name']="";
						$user_input['last_name']="";
					}
					elseif(count($custname==2))
					{
						$user_input['first_name']=$custname[0];
						$user_input['middle_name']="";
						$user_input['last_name']=$custname[1];
					}
					elseif(count($custname)==3)
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
																				/* birthdate ends */
																				/* age */
					$birthage=$this->input->post('cust_dob');
					$birthDate=explode('-',$birthage);
					$age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
						? ((date("Y") - $birthDate[0]) - 1)
						: (date("Y") - $birthDate[0]));
				
					$user_input['cust_age']=$age;
																				/* age ends */
				}
				if($this->input->post('cust_gender')!='')
				{
					$user_input['cust_gender']=$this->input->post('cust_gender');
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
												/* customer personal details end */
				}
			}
		
			
		$this->mic_dbtest->customer_personal_search_details($user_input);
		$data['customer_details']=$this->mic_dbtest->get_policy_results($user_input);
		$data['send_email']= $this->mic_dbtest->get_policy_results($user_input);
		$this->load->view('search_results',$data);
		
		/*  Email config */
		/* $message=$this->load->view('email/send_email',$data,TRUE);
		$config = Array(
				'protocol' => 'smtp',
				'smtp_host' => 'ssl://smtp.googlemail.com',
				'smtp_port' => 465,
				'smtp_user' => 'nikhildorai@gmail.com',
				'smtp_pass' => 'Hammit123',
				'mailtype' => 'html',
				'charset'  => 'utf-8',
				'priority' => '1',
				'wordwrap' => TRUE,
		
		);
		
		$this->load->library('email',$config);
		$this->email->set_newline("\r\n"); /* Important*/
		
		/* $this->email->from('myinsuranceclub.com', 'nikhil dorai');
		$this->email->to('nikhildorai@gmail.com');
		$this->email->subject('This is an email test');
		$this->email->message($message);
		$this->email->send(); */
		/* Email config Ends */
		
		}	
	}	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */