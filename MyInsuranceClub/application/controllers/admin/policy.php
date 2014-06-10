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
		$policyModel = $variantModel = array();
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
				redirect('admin/policy/index');
			}
			else 
			{
				$policyModel = $exist;
				$company_id = $policyModel['company_id'];
				$modelType = 'update';
			}
		}
	
		//	get all the health type as per company type
		$allCompanyType = $this->util->getTableData($modelName='Company_type_model', $type="all", $where = array(), $fields = array());
		
		//	get all existing variants
		$where = array();
		$where[0]['field'] = 'policy_id';
		$where[0]['value'] = (int)$policy_id;
		$where[0]['compare'] = 'equal';
		$where[1]['field'] = 'status';
		$where[1]['value'] = 'active';
		$where[1]['compare'] = 'equal';
		$variantModel = $this->util->getTableData($modelName='Policy_health_variants_model', $type="all", $where, $fields = array());		
		if (!empty($allCompanyType))
		{
			foreach ($allCompanyType as $k1=>$v1)
			{
				$where = array();
				$where[0]['field'] = 'company_type_id';
				$where[0]['value'] = (int)$v1['company_type_id'];
				$where[0]['compare'] = 'equal';
				$a = array();
				$op = '';
				$policyHealth = $this->util->getTableData($modelName='Policy_health_type_model', $type="all", $where, $fields = array());
				if (!empty($policyHealth))
				{
					foreach ($policyHealth as $k2=>$v2)
					{
						$a[$v2['type_id']] = $v2['type_name']; 
						$op .= '<option value="'.$v2['type_id'].'">'.$v2['type_name'].'</option>';
					}
				}
				$this->data['allPolicyHealthType']['data'][(int)$v1['company_type_id']] = $a;
				$this->data['allPolicyHealthType']['options'][(int)$v1['company_type_id']] = $op;
			}
		}
		
		//	check if post data is available
		if ($this->input->post('policyModel'))
		{	
			//	set default values for policy
			$arrParams = $this->input->post('policyModel');
			$policy_id = (isset($arrParams['policy_id']) && !empty($arrParams['policy_id'])) ? $arrParams['policy_id'] : '';
			$company_id = (isset($arrParams['company_id']) && !empty($arrParams['company_id'])) ? $arrParams['company_id'] : '';	
			$_POST['modelType'] = $modelType;
			//	set validation rules
			$validation_rules = array(
				array('field' => 'policyModel[policy_name]', 'label' => 'policy name', 'rules' => 'required|callback_validatePost[policy_name]'),
				array('field' => 'policyModel[company_id]', 'label' => 'company name', 'rules' => 'required'),
				array('field' => 'policyModel[type_health_plan]', 'label' => 'health plan type', 'rules' => 'callback_validatePost[type_health_plan]'),
			//	array('field' => 'policyModel[variant]', 'label' => 'varient', 'rules' => 'required'),
				array('field' => 'policyModel[seo_title]', 'label' => 'seo title', 'rules' => 'required'),
				array('field' => 'policyModel[seo_description]', 'label' => 'seo description', 'rules' => 'required'),
				array('field' => 'policyModel[seo_keywords]', 'label' => 'seo keywords', 'rules' => 'required'),
				array('field' => 'policyModel[slug]', 'label' => 'url', 'rules' => 'required|callback_validatePost[slug]'),
				);
			
			$this->form_validation->set_rules($validation_rules);
			
			
			//	set default values for variant
			$variantPost = $this->input->post('variantModel');
		
			
			// Run the validation.
			if ($this->form_validation->run())
			{
				//	set new default values
				$arrParams = $this->input->post('policyModel');
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
						$saveVarient = $this->saveVarientData($policy_id, $variantPost);
						if ($saveVarient['result'] == true)
							$saveData[] = true;
						else 
						{
							$saveData[] = false;
							$this->data['message'] .= $saveVarient['msg'];
						}
						$variantModel = $saveVarient['varientModel'];				
					}			
					//	if policy and varients records are stored then on show success and redirect to index 
					if(!in_array(false, $saveData))
					{
						$this->session->set_flashdata('message', '<p class="status_msg">Record saved successfully.</p>');
						redirect('admin/policy/index');
					}
					else 
					{
						//$this->data['message'] .= '<p class="error_msg">Validation Error.</p>';
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
		$this->data['modelType'] = $modelType;
		$this->data['variantModel'] = $variantModel;
		$this->template->write_view('content', 'admin/policy/create', $this->data, TRUE);
		$this->template->render();
	}
	
	public function saveVarientData($policy_id, $variantPost = array())
	{
		$return = $variantModel = array();
		$result = false;
		
		$msg = '<p class="error_msg">Undefined error in variant.</p>';
		if (!empty($variantPost))
		{
			foreach ($variantPost as $k1=>$v1)
			{
				foreach ($variantPost[$k1] as $k2=>$v2)
				{
					$variantModel[$k2][$k1] = $v2;
					$variantModel[$k2]['policy_id'] = $policy_id;
				}
			}
					
			if (!empty($variantModel))
			{
				$variantErrors = array();
				$arrSkip = array('variant_id', 'comments');
				foreach ($variantModel as $k3=>$v3)
				{
					if (!empty($v3))
					{
						$chkEmpty = true;
						foreach ($v3 as $k5=>$v5)
						{
							if (empty($v5) && !in_array($k5, $arrSkip))
								$chkEmpty = false;
						}
					}
					if ($chkEmpty == true)
					{
				  		$variantSave[] = true;
					}
					else 
					{
						$variantSave[] = false;
						$variantErrors[] = 'Some fields are empty for variant.';
					}
				}
			}
			if (!in_array(false, $variantSave))
			{
				$where = $existingVarientsIds = array();
				$where[0]['field'] = 'policy_id';
				$where[0]['value'] = (int)$policy_id;
				$where[0]['compare'] = 'equal';
	
				//	Add/update variants
				if (!empty($variantModel))
				{
					foreach ($variantModel as $k6=>$v6)
					{
						//	un comment to update existing records with previous status
					//	$v6['status'] = 'active';
						$savedVarients[] = $selectedVariantsIds[] = $this->addUpdateVariants($model = $v6, $policy_id);
					}
				}
			
				$existingVarients = $this->util->getTableData($modelName='Policy_health_variants_model', $type="all", $where, $fields = array());
				if (!empty($existingVarients))
				{
					foreach ($existingVarients as $k1=>$v1)
					{
						$existingVarientsIds[] = $v1['variant_id'];
					}
				}	
				$deleteVarients = array_diff($existingVarientsIds, $selectedVariantsIds);	
				//	save or update record
				if (!empty($deleteVarients))
				{
					foreach ($deleteVarients as $k4=>$v4)
					{
						$model = array();
						$model['variant_id'] = $v4;
						$model['status'] = 'deleted';
						$savedVarients[] = $this->addUpdateVariants($model, $policy_id);
					}
				}
			
				if (!empty($savedVarients))
				{
					$result = true;
					$msg = 'Variant updated successfully';
				}
			}
	  		else if (in_array(false, $variantSave))
	  		{
	  			$msg = '';
	  			$variantErrors = array_unique($variantErrors);
	  			//	not update some fields are empty
	  			foreach ($variantErrors as $k1=>$v1)
	  			{
	  				$msg .= '<p class="error_msg">'.$v1.'</p>';
	  			}
	  			$result = false;
	  		}	
		}
		else 
		{
			$result = false;
			$msg = '<p class="error_msg">Varient cannot be blank.</p>';
		}
		$return = array('result'=>$result, 'msg'=>$msg, 'varientModel'=>$variantModel);
		return $return;	
	}
	
	public function addUpdateVariants($model, $policy_id)
	{	
		$save  = false;
		if (!empty($model))
		{	
			//	check if record exists
			$where = array();
			$arrSkip = array('variant_id', 'status', 'comments');
			if (isset($model['variant_id']) && !empty($model['variant_id']))
			{
				$where[0]['field'] = 'variant_id';
				$where[0]['value'] = $model['variant_id'];
				$where[0]['compare'] = 'equal';
			}
			else 
			{
				$i = 0;
				foreach ($model as $k1=>$v1)
				{
					if (!in_array($k1, $arrSkip))
					{
						$where[$i]['field'] = $k1;
						$where[$i]['value'] = $v1;
						$where[$i]['compare'] = 'equal';
						$i++;
					}
				}
			}
			
			$isExist = $this->util->getTableData($modelName='Policy_health_variants_model', $type="all", $where, $fields = array());
			
			if (!empty($isExist))
			{
				foreach ($isExist as $k1=>$v1)
				{
					$model['variant_id'] = (int)$v1['variant_id'];
					$save = $this->policy_health_variants_model->saveRecord($arrParams = $model, $modelType = 'update');
					break;	
				}
			}
			else 
			{
				$save = $this->policy_health_variants_model->saveRecord($arrParams = $model, $modelType = 'create');
			}
			
		}
		return $save;
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
			else if ($validationFor == 'type_health_plan')
			{			
				if (!empty($policyModel['company_id']))
				{
					$where = array();
					$where[0]['field'] = 'company_id';
					$where[0]['value'] = (int)$policyModel['company_id'];
					$where[0]['compare'] = 'equal';
					$compType = reset($this->util->getTableData($modelName='Insurance_company_master_model', $type="single", $where, $fields = array('company_type_id')));
					$where = array();
					$where[0]['field'] = 'company_type_id';
					$where[0]['value'] = (int)$compType['company_type_id'];
					$where[0]['compare'] = 'equal';
					$policyHealth = $this->util->getTableData($modelName='Policy_health_type_model', $type="all", $where, $fields = array());

					if (!empty($policyHealth))
					{
						if (isset($policyModel['type_health_plan']) && !empty($policyModel['type_health_plan']))
						{
							return true;
							/*foreach ($policyHealth as $k2=>$v2)
							{
								$a[$v2['type_id']] = $v2['type_name']; 
								$op .= '<option value="'.$v2['type_id'].'">'.$v2['type_name'].'</option>';
							}*/
						}
						else 
						{
							$_POST['policyModel']['type_health_plan'] = null;
							$this->form_validation->set_message('validatePost', 'The %s is required');
							return FALSE;
						}
					}
					else 
					{
						$_POST['policyModel']['type_health_plan'] = null;
					}		
				}
				else 
				{
					return true;
				}
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