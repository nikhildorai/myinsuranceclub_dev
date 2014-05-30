<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Policy extends CI_Controller {
 
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
        $this->load->library('upload');
 		$this->load->helper('url');
 		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('policy_health_features_model');
		$this->load->model('policy_health_type_model');
		$this->load->model('policy_health_variants_model');
		$this->load->model('policy_health_master_model');
 		
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
		$arrParams 	= array();
		if (isset($_GET))
			$arrParams = $_GET;
		$this->data['search_query'] = $arrParams;
		// Set any returned status/error messages..		
		$this->data['message'] = (! isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];
		$this->session->set_flashdata('message','');		
		$this->data['records'] 	= $this->policy_health_master_model->get_all_policy($arrParams);

		//	pagination
		$config = $this->util->get_pagination_params();
		$config['total_rows'] 	= $this->data['records']->num_rows();
		$this->pagination->initialize($config); 		
		$this->template->write_view('content', 'admin/policy/index', $this->data, TRUE);
		$this->template->render();
	}

    public function create($policy_id = null)
	{	
		$modelType = 'create';
		//	check if policy id exists
		$policyModel = $varientPost = array();
		$this->data['message'] = '';
		$company_id = '';
		if ((isset($_GET['policy_id']) && !empty($_GET['policy_id'])) || !empty($policy_id))
		{			
			if (isset($_GET['policy_id']))
				$policy_id = $_GET['policy_id'];
			$where = array();
			$where[0]['field'] = 'policy_id';
			$where[0]['value'] = (int)$policy_id;
			$where[0]['compare'] = 'equal';
			$exist = $this->util->getTableData($modelName='Policy_health_master_model', $type="single", $where, $fields = array());
			if (empty($exist))
			{
				$this->session->set_flashdata('message', '<p class="error_msg">Invalid record.</p>');
				redirect('admin/company/index');
			}
			else 
			{
				$policyModel = $exist;
				$company_id = $policyModel['company_id'];
				$modelType = 'update';
			}
		}
		
		//	check if post data is available
		if ($this->input->post('policyModel'))
		{
			//	set default values
			$arrParams = $this->input->post('policyModel');
			$policy_id = (isset($arrParams['policy_id']) && !empty($arrParams['policy_id'])) ? $arrParams['policy_id'] : '';
			$company_id = (isset($arrParams['company_id']) && !empty($arrParams['company_id'])) ? $arrParams['company_id'] : '';	
			$_POST['modelType'] = $modelType;
			//	set validation rules
			$validation_rules = array(
				array('field' => 'policyModel[policy_name]', 'label' => 'policy name', 'rules' => 'required|callback_validatePost[policy_name]'),
				array('field' => 'policyModel[company_id]', 'label' => 'company name', 'rules' => 'required'),
				array('field' => 'policyModel[type_health_plan]', 'label' => 'health plan type', 'rules' => 'required'),
				array('field' => 'policyModel[varient]', 'label' => 'varient', 'rules' => 'required'),
				);
			
			$this->form_validation->set_rules($validation_rules);
			// Run the validation.
			if ($this->form_validation->run())
			{
				//	run validation on complete company post data
				$validate = $this->validatePost($arrParams);	
				if ($validate == true)
				{
					//	save record for policy 
					$recordId = $this->policy_health_master_model->saveRecord($arrParams, $modelType);	
					if ($recordId != false)
					{
						$saveData[] = true;
						$policy_id = $recordId;	
					}
					else 
						$saveData[] = false;
					
					// save records for varients
					if (!empty($policy_id))
					{
						$saveVarient = $this->saveVarientData($policy_id, $isVarient=$_POST['policyModel']['varient'],$varientPost);
						if ($saveVarient['result'] == true)
							$saveData[] = true;
						else 
							$saveData[] = false;
					}
					
					//	if policy and varients records are stored then on show success and redirect to index 
					if(!in_array(false, $saveData))
					{
						$this->session->set_flashdata('message', '<p class="status_msg">Record saved successfully.</p>');
						redirect('admin/policy/index');
					}
					else 
					{
						echo 'define error';die;
					}
				}
				else 
				{
					//	show error if record exist
					$this->data['message'] .= '<p class="error_msg">Record already exists.</p>';
				}
			}		
			else 
			{
				// 	Set validation errors.
				$this->data['message'] = validation_errors('<p class="error_msg">', '</p>'); 
			}
			$policyModel = $_POST['policyModel'];
		}
		$this->data['policyModel'] = $policyModel;
		$this->template->write_view('content', 'admin/policy/create', $this->data, TRUE);
		$this->template->render();
	}
	
	public function saveVarientData($policy_id, $isVarient = 'no', $varientPost = array())
	{
		
var_dump($_POST, $policy_id, $isVarient, $varientPost );die;		
	}
	
	
	/* 
	 * $value	: it will have current validations post value
	 * $validationFor	:defines type of validation on field
	 */
	public function validatePost($post , $validationFor = null)
	{
		if (!empty($_POST) || !empty($post))
		{
			$modelType = 'create';
			$policyModel = $_POST['policyModel'];
			
			if (isset($_POST['modelType']) && !empty($_POST['modelType']))
				$modelType = $_POST['modelType'];
				
			$policy_id = (isset($policyModel['policy_id']) && !empty($policyModel['policy_id'])) ? $policyModel['policy_id'] : '';
			$company_id = (isset($policyModel['company_id']) && !empty($policyModel['company_id'])) ? $policyModel['company_id'] : '';	
			
			$arrSkip = $arrParams = array();
			if ($validationFor == 'policy_name')
			{
				$arrSkip = array('type_health_plan');
			}
			else 
			{
				$arrParams = $policyModel;
			}
			
			foreach ($policyModel as $k1=>$v1)
			{
				if (!in_array($k1, $arrSkip))
					$arrParams[$k1] = $v1;
			}	
	
			//	search for existing records
			$record = $this->policy_health_master_model->getPolicy($arrParams);

			if ($record->num_rows == 0)
			{
				return TRUE;
			}
			else if ($record->num_rows == 1)
			{
				if ($modelType == 'create' )
				{
					$this->form_validation->set_message('validatePost', 'The %s already exists');
					return FALSE;
				}
				else if ($modelType == 'update')
				{
					//	if company id matches with post company id, then true else record exists 
					$record = reset($record->result_array());
					if ($record['policy_id'] == $arrParams['policy_id'])
					{
						return true;
					}
					else 
					{
						$this->form_validation->set_message('validatePost', 'The %s already exists');
						return FALSE;
					}
				}
				else 
				{
					$this->form_validation->set_message('validatePost', 'Undefined validation error');
					return FALSE;
				}
			}
			else if ($record->num_rows > 1)
			{
				$this->form_validation->set_message('validatePost', 'The %s already exists');
			}
			else 
			{
				$this->form_validation->set_message('validatePost', 'Undefined validation error');
				return FALSE;
			}
		}
		else 
		{
			$this->form_validation->set_message('validatePost', 'Undefined validation error');
			return FALSE;
		}
	}

	function changeStatus($policy_id = null, $status = 'inactive')
	{
		if (!empty($policy_id))
		{
			//	check if policy id exists
			$where = array();
			$where[0]['field'] = 'policy_id';
			$where[0]['value'] = (int)$policy_id;
			$where[0]['compare'] = 'equal';
			$exist = $this->util->getTableData($modelName='Policy_health_master_model', $type="single", $where, $fields = array());
			if (empty($exist))
			{
				$this->session->set_flashdata('message', '<p class="error_msg">Invalid record.</p>');
			}
			else 
			{
				$companyModel = $exist;	
				$modelType = 'update';
				$arrParams['status'] = $status;
				$arrParams['policy_id'] = $policy_id;
				if ($this->policy_health_master_model->saveRecord($arrParams, $modelType))
					$this->session->set_flashdata('message', '<p class="status_msg">Record updated successfully.</p>');
				else 
					$this->session->set_flashdata('message', '<p class="error_msg">Record could not be updated.</p>');
			}
		}
		else
			$this->session->set_flashdata('message', '<p class="error_msg">Invalid record.</p>');
			
		redirect('admin/policy/index');
	}
}

/* End of file auth_lite.php */
/* Location: ./application/controllers/auth_lite.php */