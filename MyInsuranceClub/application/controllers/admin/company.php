<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Company extends CI_Controller {
 
    function __construct() 
    {
        parent::__construct();
		
		// To load the CI benchmark and memory usage profiler - set 1==1.
		if (1==2) 
		{
			$sections = array(
				'benchmarks' => TRUE, 'memory_usage' => TRUE, 
				'config' => FALSE, 'controller_info' => FALSE, 'get' => FALSE, 'post' => FALSE, 'queries' => FALSE, 
				'uri_string' => FALSE, 'http_headers' => FALSE, 'session_data' => FALSE
			); 
			$this->output->set_profiler_sections($sections);
			$this->output->enable_profiler(TRUE);
		}
  		// IMPORTANT! This global must be defined BEFORE the flexi auth library is loaded! 
 		// It is used as a global that is accessible via both models and both libraries, without it, flexi auth will not work.
		$this->auth = new stdClass;
		
		// Load 'standard' flexi auth library by default.
		$this->load->library('flexi_auth');	
		
     	// Redirect users logged in via password (However, not 'Remember me' users, as they may wish to login properly).
		if ($this->flexi_auth->is_logged_in_via_password() && uri_string() != 'auth/logout') 
		{
			// Preserve any flashdata messages so they are passed to the redirect page.
			if ($this->session->flashdata('message')) { $this->session->keep_flashdata('message'); }
			
			// Redirect logged in admins (For security, admin users should always sign in via Password rather than 'Remember me'.
			if ($this->flexi_auth->is_admin()) 
			{
				//redirect('admin/auth_admin/dashboard');
			}
			else
			{
				//redirect('admin/auth_public/dashboard');
			}
		}
		
		// Load required CI libraries and helpers.
		$this->load->database();
		$this->load->library('session');
 		$this->load->helper('url');
 		$this->load->helper('form');
		$this->load->model('insurance_company_master_model');
 		
		// Note: This is only included to create base urls for purposes of this demo only and are not necessarily considered as 'Best practice'.
		$this->load->vars('base_url', base_url());
		$this->load->vars('includes_dir', base_url().'/includes/');
		$this->load->vars('current_url', $this->uri->uri_to_assoc(1));
		
		// Define a global variable to store data that is then used by the end view page.
		$this->data = null;
    
		// Check user has privileges to view user accounts, else display a message to notify the user they do not have valid privileges.
		if (! $this->flexi_auth->is_privileged('View Users'))
		{
			$this->session->set_flashdata('message', '<p class="error_msg">You do not have privileges.</p>');
			redirect('admin/auth_admin');
		}
		
	}

    public function index()
	{
		$this->load->library('table');
		$this->load->library('pagination');
		$this->load->model('insurance_company_master_model');
		$arrParams 	= array();
		if (array_key_exists('search', $_GET) && $_GET['search']== "Search")
			$arrParams = $_GET;
		$this->data['search_query'] = $arrParams;
		// Set any returned status/error messages.
		$this->data['message'] = (! isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];		
		
		$this->data['records'] 	= $this->insurance_company_master_model->get_all_insurance_company($arrParams);
		//	pagination
		$config = $this->util->get_pagination_params();
		$config['total_rows'] 	= $this->data['records']->num_rows();
		$this->pagination->initialize($config); 		
		$this->template->write_view('content', 'admin/company/index', $this->data, TRUE);
		$this->template->render();
	}

    public function create()
	{
		$companyModel = array();
		if ($this->input->post('companyModel'))
		{
			$arrParams = $this->input->post('companyModel');
			$companyTypeId = (isset($arrParams['company_type_id']) && !empty($arrParams['company_type_id'])) ? $arrParams['company_type_id'] : '';
			$validation_rules = array(
				array('field' => 'companyModel[company_name]', 'label' => 'company type', 'rules' => 'required|callback_validateInsuranceCompany[company_name#'.$arrParams["company_name"].',company_type_id#'.$companyTypeId.']'),
				array('field' => 'companyModel[company_shortname]', 'label' => 'company shortname', 'rules' => 'required|callback_validateInsuranceCompany[company_shortname#'.$arrParams["company_shortname"].',company_type_id#'.$companyTypeId.']'),
		//		array('field' => 'companyModel[company_display_name]', 'label' => 'company display name', 'rules' => 'required'),
				array('field' => 'companyModel[company_type_id]', 'label' => 'company type', 'rules' => 'required'),
			);
			$this->form_validation->set_rules($validation_rules);
	
			// Run the validation.
			if ($this->form_validation->run())
			{
				//$validate = $this->getInsuranceCompany($arrParams);
				//var_dump($validate);			
				echo 'inside';
			}
	
			// Set validation errors.
			//$this->data['message'] = validation_errors('<p class="error_msg">', '</p>');
	
	var_dump($_POST, validation_errors())		;die;	
		
			//$this->insurance_company_master_model->saveCompanyRecord($modelType = 'create');
			$companyModel = $_POST['companyModel'];
		}		
		$this->data['companyModel'] = $companyModel;
//var_dump($this->data);die;		
		$this->template->write_view('content', 'admin/company/create', $this->data, TRUE);
		$this->template->render();
	}
	
	
	
	/*
	 * $params: should be string with multiple key value joined using ",". 
	 * 			It should be key value pair should be separated by "#".
	 * 			example: "company_name#Agricultural Insurance Company of India,company_type_id#1"
	 */
	public function validateInsuranceCompany($value, $params = null)
	{
		$arrParams = array();
		if (is_array($value))
		{
			$arrParams = $value;
		}
		else if (is_string($value))
		{
			if (!empty($params))
			{
				$params = explode(',', $params);
				foreach ($params as $k1=>$v1)
				{
					if (!empty($v1))
					{
						$a = explode('#', $v1);
						if (!empty($a))
						{
							$arrParams[$a[0]] = $a[1];
						}
					}
				}
			}
		}
		else 
		{
			$this->form_validation->set_message('undefined', 'Undefined validation error');
			return FALSE;
		}
		
		$record = $this->insurance_company_master_model->getInsuranceCompany($arrParams);
		if ($record->num_rows > 0)
		{
			echo 'exists';
		}
		else 
		{
			//$this->form_validation->set_message('undefined', 'Undefined validation error');
			return true;
		}
	}

}

/* End of file auth_lite.php */
/* Location: ./application/controllers/auth_lite.php */