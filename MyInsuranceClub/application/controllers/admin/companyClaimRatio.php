<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CompanyClaimRatio extends CI_Controller {
 
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
			//	redirect('admin/auth_public/dashboard');
			}
			else
			{
		//		redirect('admin/auth_public/dashboard');
			}
		}
		
		// Load required CI libraries and helpers.
		$this->load->database();
		$this->load->library('session');
        $this->load->library('upload');
 		$this->load->helper('url');
 		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('company_claim_ratio_model');
 		
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

    public function index($company_id)
	{
		//	check if policy id exists
		if ((isset($_GET['company_id']) && !empty($_GET['company_id'])) || !empty($company_id))
		{
			if (isset($_GET['policy_id']))
				$policy_id = $_GET['policy_id'];
			$where = array();
			$where[0]['field'] = 'company_id';
			$where[0]['value'] = (int)$company_id;
			$where[0]['compare'] = 'equal';
			$exist = $this->util->getTableData($modelName='company_claim_ratio_model', $type="all", $where, $fields = array());
			if (empty($exist))
			{
				$modelType = 'create';
				$ratioModel = array();
			}
			else 
			{
				foreach ($exist as $k4=>$v4)
				{
					$ratioModel[$v4['year_to']] = $v4;
				}
				$modelType = 'update';				
			}
			$this->data['message'] = '';
			if (!empty($_POST))
			{				
				$claimRatioPost = $_POST;			
				$saveClaim = $savedRecords = $errorClaim = array();
				if (!empty($claimRatioPost))
				{
					$variantErrors = array();
					$arrSkip = array('claim_ratio_id');
					foreach ($claimRatioPost as $k1=>$v1)
					{
						if (!empty($v1['claim_ratio']) && $v1['claim_ratio'] <= 100)
						{	
							foreach ($v1 as $k2=>$v2)
							{
								$saveClaim[$k1][$k2] = $v2;
							}
							$saveClaim[$k1]['year_from'] = $k1-1;
							$saveClaim[$k1]['year_to'] = $k1;
							$saveClaim[$k1]['company_id'] = $company_id;
						}
						else if (!empty($v1['claim_ratio']))
						{
							$errorClaim[] = false;
						}
					}
				}						
				if (!empty($saveClaim))
				{
					foreach ($saveClaim as $k3=>$v3)
					{
						$savedRecords[] = $this->addUpdateClaimRatio($model = $v3, $company_id);
					}
				}
				
				if (!empty($savedRecords) && !empty($errorClaim))
				{
					$this->data['message'] = '<p class="status_msg">Records added successfully.</p>';
					$this->data['message'] .= '<p class="error_msg">Records with claim ratio cannot be greater than 100 could not be saved.</p>';
				}
				else if (!empty($savedRecords) && empty($errorClaim))
				{
					$this->data['message'] = '<p class="status_msg">Records added successfully.</p>';
				}
				
				else if (!empty($errorClaim))
				{
					//	show error if validation fails
					$this->data['message'] = '<p class="error_msg">Claim ratio cannot be greater than 100.</p>';
				}
		  		else
		  		{
					//	show error if no record saved
					$this->data['message'] = '<p class="error_msg">Minimum 1 record is required.</p>';
		  		}
		  		$ratioModel = $saveClaim;
			}		
			
			$this->data['modelType'] = $modelType;
			$this->data['ratioModel'] = $ratioModel;
			$this->data['company_id'] = $company_id;
			$this->template->write_view('content', 'admin/companyClaimRatio/index', $this->data, TRUE);
			$this->template->render();
		}
		else 
		{
			$this->session->set_flashdata('message', '<p class="error_msg">Invalid record.</p>');
			redirect('admin/company/index');
		}
	}

	
	
	

	function changeStatus($company_id = null, $status = 'inactive')
	{
		if (!empty($company_id))
		{
			//	check if company id exists
			$where[0]['field'] = 'company_id';
			$where[0]['value'] = (int)$company_id;
			$where[0]['compare'] = 'equal';
			$exist = $this->util->getTableData($modelName='Insurance_company_master_model', $type="single", $where, $fields = array());
	
			if (empty($exist))
			{
				$this->session->set_flashdata('message', '<p class="error_msg">Invalid record.</p>');
			}
			else 
			{
				$companyModel = $exist;	
				$modelType = 'update';
				$arrParams['status'] = $status;
				$arrParams['company_id'] = $company_id;
				if ($this->insurance_company_master_model->saveCompanyRecord($arrParams, $modelType))
					$this->session->set_flashdata('message', '<p class="status_msg">Record updated successfully.</p>');
				else 
					$this->session->set_flashdata('message', '<p class="error_msg">Record could not be updated.</p>');
			}
		}
		else
			$this->session->set_flashdata('message', '<p class="error_msg">Invalid record.</p>');
			
		redirect('admin/company/index');
	}
}

/* End of file auth_lite.php */
/* Location: ./application/controllers/auth_lite.php */