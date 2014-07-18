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
        $this->load->helper('ckeditor');
        $this->load->plugin('widget_pi');
		$this->load->library('form_validation');
		$this->load->model('policy_health_features_model');
		$this->load->model('policy_variants_master_model');
		$this->load->model('policy_master_model');
		$this->load->model('policy_features_model');
		$this->load->model('product_model');
		$this->load->model('sub_product_model');
		$this->load->model('user_accounts_model');
 		
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
		$this->data['records'] 	= $this->policy_master_model->get_all_policy($arrParams);

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
		$policyModel = $variantModel = $policyFeaturesModel = array();
		$this->data['message'] = '';
		$company_id = '';
		$sessionMsg = $this->session->flashdata('message');
		$this->data['message'] = ( !empty($sessionMsg)) ? $sessionMsg : '';
		$this->session->set_flashdata('message','');	
		$isActive = true;
		if ((isset($_GET['policy_id']) && !empty($_GET['policy_id'])) || !empty($policy_id))
		{
			if (isset($_GET['policy_id']))
				$policy_id = $_GET['policy_id'];
			$where = array();
			$where[0]['field'] = 'policy_id';
			$where[0]['value'] = (int)$policy_id;
			$where[0]['compare'] = 'equal';
			$exist = $this->util->getTableData($modelName='Policy_master_model', $type="single", $where, $fields = array());
			if (empty($exist))
			{
				$this->session->set_flashdata('message', '<p class="error_msg">Invalid record.</p>');
				redirect('admin/policy/index');
			}
			else 
			{
				if ($exist['status'] != 'active')
					$isActive = false;
				$policyModel = $exist;
				$company_id = $policyModel['company_id'];
				$modelType = 'update';
				
				
				$where = array();
				$where[0]['field'] = 'policy_id';
				$where[0]['value'] = (int)$policy_id;
				$where[0]['compare'] = 'equal';
	
				$policyFeaturesModel = $this->util->getTableData($modelName='Policy_features_model', $type="single", $where, $fields = array());	
			}
		}
		
		//	get all existing variants
		$where = array();
		$where[0]['field'] = 'policy_id';
		$where[0]['value'] = (int)$policy_id;
		$where[0]['compare'] = 'equal';
		$where[1]['field'] = 'status';
		$where[1]['value'] = 'active';
		$where[1]['compare'] = 'equal';
		$variantModel = $this->util->getTableData($modelName='Policy_variants_master_model', $type="all", $where, $fields = array());
		
		//	initailze all policy feature ckeditor
		
		$descCount = $this->config->config['policy']['descriptionCount'];
		for($i = 1; $i<=$descCount; $i++)
		{
			$ck = 'ckeditor'.$i;
			$des = 'description'.$i;
			$this->data[$ck] = array(
			//ID of the textarea that will be replaced
			'id' 	=> 	$des,
			'path'	=>	'JS/ckeditor',
			//Optionnal values
			'config' => array(
				'toolbar' 	=> 	"Full", 	//Using the Full toolbar
				'width' 	=> 	"100%",	//Setting a custom width
				'height' 	=> 	'300px',	//Setting a custom height
				),
			);
		}	
				
		//	check if post data is available
		if ($this->input->post('policyModel') && $isActive == true)
		{		
			//	save tags
			if (isset($_POST['tag']) && !empty($_POST['tag']))
			{
				$tag = $this->util->addUpdateTags($_POST['tag']);
				$_POST['policyModel']['tag'] = $tag;
			}		
			
			//	check if file is uploaded
			if (!empty($_FILES))
			{
				$i = 1;
				foreach($_FILES['policyModel']['name'] as $k1=>$v1)
				{					
					$ext = end(explode('.', $v1));
					if (empty($ext))
						$ext = 'doc';
					$name = $this->util->getSlug($_POST['policyModel']['policy_name']);
					if ($k1 == 'brochure')
						$name .= '-brochure';
					else if ($k1 == 'policy_wordings')
						$name .= '-policy-wordings';
					else if ($k1 == 'policy_logo')
						$name .= '-policy-logo';
					else 
						$name .= '-doc-'.date('dmy').time();
					$name .= '.'.$ext;
					$arrFileNames[$k1] = $name;
					if (empty($v1))
					{
						$_POST['policyModel'][$k1] = isset($policyModel[$k1]) ? $policyModel[$k1] : '';
					}
					else
						$_POST['policyModel'][$k1] = $name;
					$i++;
				}
			}
			else 
			{
				//	set previous file name in post
				$_POST['policyModel']['brochure'] = $policyModel['brochure'];
				$_POST['policyModel']['policy_wordings'] = $policyModel['policy_wordings'];
			}	
			
			if (isset($_POST['policyModel']['product_id']) && !empty($_POST['policyModel']['product_id']))
				$_POST['policyModel']['product_id'] = implode(',', $_POST['policyModel']['product_id']);
				
			if (isset($_POST['policyModel']['sub_product_id']) && !empty($_POST['policyModel']['sub_product_id']))
				$_POST['policyModel']['sub_product_id'] = implode(',', $_POST['policyModel']['sub_product_id']);
				
			if (isset($_POST['policyModel']['key_features']) && !empty($_POST['policyModel']['key_features']))
				$_POST['policyModel']['key_features'] = serialize($_POST['policyModel']['key_features']);

			//	set default values for policy
			$arrParams = $this->input->post('policyModel');
			$policy_id = (isset($arrParams['policy_id']) && !empty($arrParams['policy_id'])) ? $arrParams['policy_id'] : '';
			$company_id = (isset($arrParams['company_id']) && !empty($arrParams['company_id'])) ? $arrParams['company_id'] : '';	
			$_POST['policyModel']['slug'] = (isset($_POST['policyModel']['slug']) && !empty($_POST['policyModel']['slug'])) ? $this->util->getSlug($_POST['policyModel']['slug']) :  '';
			$_POST['modelType'] = $modelType;
			//	set validation rules
			$validation_rules = array(
				array('field' => 'policyModel[policy_name]', 'label' => 'policy name', 'rules' => 'required'),
				array('field' => 'policyModel[company_id]', 'label' => 'company name', 'rules' => 'required'),
				array('field' => 'policyModel[product_id]', 'label' => 'product', 'rules' => 'required'),
				array('field' => 'policyModel[seo_title]', 'label' => 'seo title', 'rules' => 'required'),
				array('field' => 'policyModel[seo_description]', 'label' => 'seo description', 'rules' => 'required'),
				array('field' => 'policyModel[seo_keywords]', 'label' => 'seo keywords', 'rules' => 'required'),
				array('field' => 'policyModel[key_features]', 'label' => 'key features', 'rules' => 'required'),
				array('field' => 'policyModel[created_by_user_id]', 'label' => 'created by', 'rules' => 'required'),
				array('field' => 'policyModel[slug]', 'label' => 'url', 'rules' => 'required|callback_validatePost[slug]'),
				);	
			$this->form_validation->set_rules($validation_rules);
			
			
			//	set default values for variant
			$variantPost = $this->input->post('variantModel');	
			
			//	set default values for policy features
			$policyFeaturesPost = $this->input->post('policyFeaturesModel');	
						
			// Run the validation.
			if ($this->form_validation->run())
			{
				//	set new default values
				$arrParams = $this->input->post('policyModel');
//var_dump($_POST, $arrParams);die;
				//	run validation on complete company post data
				$validate = true;//$this->validatePost($arrParams);	
				if ($validate == true)
				{
					//	save record for policy 
					$recordId = $this->policy_master_model->saveRecord($arrParams, $modelType);	
					if ($recordId != false)
					{
						$saveData[] = true;
						$policy_id = $recordId;	
					}
					else 
						$saveData[] = false;
					
					
					// save records for policy is stored then add/update varient and policy features
					if (!empty($policy_id))
					{
						// 	save records for files
						if (!empty($_FILES))
						{
							$this->data['file_upload_error'] = array();
					        $config['upload_path'] = $this->config->config['folder_path']['policy']['all'];
					        $config['file_name'] = $arrFileNames;
					        $config['extra_config'] = Util::getConfigForFileUpload('policy');
							$this->load->library('upload', $config);
							$this->upload->initialize($config); 	
							if($this->upload->do_multi_upload("policyModel"))
							{
				              	$this->data['file_upload'] = $this->upload->get_multi_upload_data();
							}
							else 
							{
				                $this->data['file_upload_error'][] = $this->upload->display_errors();
							}
				            $this->data['file_upload'] = $this->upload->get_multi_upload_data();
				             
				            if (empty($this->data['file_upload_error']))
				            {
								$saveData[] = true;
				            }
				            else if (!empty($this->data['file_upload_error']))
				            {
				            	foreach ($this->data['file_upload_error'] as $k1=>$v1)
				            	{
				            		$msg = str_replace('<p>', '', $v1);
				            		$msg = str_replace('</p>', '', $msg);
									$this->data['message'] .= '<p class="error_msg">'.$msg.'</p>';
									$this->data['msgType'] = 'error';
				            	}
								$saveData[] = false;
				            }
				            else 
				            {
								$saveData[] = true;
				            }
						}	
						
					// save records for varients
						$saveVarient = $this->saveVarientData($policy_id, $variantPost);
						if ($saveVarient['result'] == true)
							$saveData[] = true;
						else 
						{
							$saveData[] = false;
							$this->data['message'] .= $saveVarient['msg'];
							$this->data['msgType'] = 'error';
						}
						$variantModel = $saveVarient['varientModel'];	

						
						//	save policy features
						$savePolicyFeatures = $this->savePolicyFeatures($policy_id, $policyFeaturesPost);
						if ($savePolicyFeatures['result'] == true)
							$saveData[] = true;
						else 
						{
							$saveData[] = false;
							$this->data['message'] .= $savePolicyFeatures['msg'];
							$this->data['msgType'] = 'error';
						}
						$policyFeaturesPost = $savePolicyFeatures['policyFeaturesPost'];	
						
					}			
					//	if policy and varients records are stored then on show success and redirect to index 
					if(!in_array(false, $saveData))
					{
						$this->session->set_flashdata('message', '<p class="status_msg">Record saved successfully.</p>');
						$this->data['msgType'] = 'success';
						redirect('admin/policy/index');
					}
					else 
					{
						//$this->data['message'] .= '<p class="error_msg">Validation Error.</p>';
						//$this->data['msgType'] = 'error';
					}
				}
				else 
				{
					//	show error if record exist
					$this->data['message'] .= '<p class="error_msg">Record already exists.</p>';
					$this->data['msgType'] = 'error';
				}
			}		
			else 
			{
				// 	Set validation errors.
				$this->data['message'] = validation_errors('<p class="error_msg">', '</p>'); 
				$this->data['msgType'] = 'error';
			}
			$policyModel = $_POST['policyModel'];
		}		
		$this->data['policyModel'] = $policyModel;
		$this->data['modelType'] = $modelType;
		$this->data['variantModel'] = $variantModel;
		$this->data['policyFeaturesModel'] = $policyFeaturesModel;
		
		
		$this->data['selectedTags'] = isset($policyModel['tag']) ? $policyModel['tag'] : '';
		$this->data['tag_for'] = 'policy';
		$this->data['status'] = isset($policyModel['status']) ? $policyModel['status'] : '';
		
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
			
				$existingVarients = $this->util->getTableData($modelName='Policy_variants_master_model', $type="all", $where, $fields = array());
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
			$where = $isExist = array();
			$arrSkip = array('variant_id', 'status', 'comments');
			if (isset($model['variant_id']) && !empty($model['variant_id']))
			{
				$where[0]['field'] = 'variant_id';
				$where[0]['value'] = $model['variant_id'];
				$where[0]['compare'] = 'equal';
			}
			//	for unique varients within a policy
		/*	else 
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
			*/
			if (!empty($where))
				$isExist = $this->util->getTableData($modelName='Policy_variants_master_model', $type="all", $where, $fields = array());
			
			if (!empty($isExist))
			{
				foreach ($isExist as $k1=>$v1)
				{
					$model['variant_id'] = (int)$v1['variant_id'];
					$save = $this->policy_variants_master_model->saveRecord($arrParams = $model, $modelType = 'update');
					break;	
				}
			}
			else 
			{
				$save = $this->policy_variants_master_model->saveRecord($arrParams = $model, $modelType = 'create');
			}
			
		}
		return $save;
	}
	
	
	
	
	public function savePolicyFeatures($policy_id, $policyFeaturesPost = array())
	{
		$return = $policyFeaturesModel = array();
		$result = false;
		
		$msg = '<p class="error_msg">Undefined error in variant.</p>';
		if (!empty($policyFeaturesPost))
		{
			$policyFeaturesModel = $policyFeaturesPost;
			$policyFeaturesModel['policy_id'] = $policy_id;
			
			$where = array();
			$where[0]['field'] = 'policy_id';
			$where[0]['value'] = (int)$policy_id;
			$where[0]['compare'] = 'equal';

			$isExist = $this->util->getTableData($modelName='Policy_features_model', $type="all", $where, $fields = array());
			if (!empty($isExist))
			{
				foreach ($isExist as $k1=>$v1)
				{
					$save = $this->policy_features_model->saveRecord($arrParams = $policyFeaturesModel, $modelType = 'update');
					break;	
				}
			}
			else 
			{
				$save = $this->policy_features_model->saveRecord($arrParams = $policyFeaturesModel, $modelType = 'create');
			}
			
	  		if ($save)
	  		{
				$result = true;
				$msg = 'Policy features updated successfully';
	  		}
	  		else 
	  		{
	  			$result = false;
	  			$msg = '<p class="error_msg">Policy features cannot be updated.</p>';
	  		}
		}
		else 
		{
			$result = false;
			$msg = '<p class="error_msg">Policy features cannot be blank.</p>';
		}
		$return = array('result'=>$result, 'msg'=>$msg, 'policyFeaturesModel'=>$policyFeaturesModel);
		return $return;	
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
			
			$arrSkip = $arrParams = $arrQuery = array();
			if ($validationFor == 'policy_name')
			{
				$arrQuery = array('company_id', 'policy_name');
				$arrSkip = array('product_id', 'product_id');
			}
			else if ($validationFor == 'slug')
			{
				$arrQuery = array('slug');
			}
			else if ($validationFor == 'product_id')
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
					$policyHealth = $this->util->getTableData($modelName='Product_model', $type="all", $where, $fields = array());

					if (!empty($policyHealth))
					{
						if (isset($policyModel['product_id']) && !empty($policyModel['product_id']))
						{
							$product_id = explode(',', $policyModel['product_id']);
							$exist = false;
							foreach ($policyHealth as $k2=>$v2)
							{
								if (in_array($v2['product_id'], $product_id))
									$exist = true;
							}
							if ($exist)
								return TRUE;
							else
							{
								$_POST['policyModel']['product_id'] = null;
								$this->form_validation->set_message('validatePost', 'The %s is required');
								return FALSE;
							}
						}
						else 
						{
							$_POST['policyModel']['product_id'] = null;
							$this->form_validation->set_message('validatePost', 'The %s is required');
							return FALSE;
						}
					}
					else 
					{
						$_POST['policyModel']['product_id'] = null;
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
				if (in_array($k1, $arrQuery))
					$arrParams[$k1] = $v1;
			}	
			//	search for existing records
			$record = $this->policy_master_model->getPolicy($arrParams);

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
					if ($record['policy_id'] == $policyModel['policy_id'])
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
			$exist = $this->util->getTableData($modelName='Policy_master_model', $type="single", $where, $fields = array());
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
				if ($this->policy_master_model->saveRecord($arrParams, $modelType))
					$this->session->set_flashdata('message', '<p class="status_msg">Record updated successfully.</p>');
				else 
					$this->session->set_flashdata('message', '<p class="error_msg">Record could not be updated.</p>');
			}
		}
		else
			$this->session->set_flashdata('message', '<p class="error_msg">Invalid record.</p>');
			
		redirect('admin/policy/index');
	}
	
	public function getProductSubProductDropDown()
	{		
		$result = '';
		if (isset($_POST['companyTypeId']) && !empty($_POST['companyTypeId']))
		{	
			$compType = $_POST['companyTypeId'];
			$changeType = $_POST['changeType'];
			$isProductId = isset($_POST['productId']) ? reset($_POST['productId']) : '';
			if (!empty($_POST['companyTypeId']) &&($changeType == 'product_id'))
			{
				$where = array();
				$where[0]['field'] = 'company_type_id';
				$where[0]['value'] = $compType;
				$where[0]['compare'] = 'findInSet';
				$selected = isset($_POST['productId']) ? $_POST['productId'] : array();
				$modelName = 'Product_model';
				$optionKey = 'product_id';
				$optionValue = 'product_name';
				$sqlFilter['orderBy'] = 'product_name';
			}
			if (!empty($isProductId) && $changeType == 'sub_product_id')
			{
				$where = array();
				$where[1]['field'] = 'product_id';
				$where[1]['value'] = implode(',', $_POST['productId']);
				$where[1]['compare'] = 'findInSet';
				$selected = isset($_POST['subProductId']) ? $_POST['subProductId'] : array();
				$modelName = 'Sub_product_model';
				$optionKey = 'sub_product_id';
				$optionValue = 'sub_product_name';
				$sqlFilter['orderBy'] = 'sub_product_name';
			}
		
			$healthOptions = $this->util->getCompanyTypeDropDownOptions($modelName, $optionKey, $optionValue, $defaultEmpty = "Please Select", $extraKeys = false, $where, $sqlFilter); 
			if (!empty($healthOptions))
			{
				foreach ($healthOptions as $k1=>$v1)
				{
					if (in_array($k1, $selected))
						$result .= '<option value="'.$k1.'" selected>'.$v1.'</option>';
					else
						$result .= '<option value="'.$k1.'">'.$v1.'</option>';
				}
			}
		}		
		echo $result;
	}
	
	public function download($policy_id = null, $field = null)
	{
		if (!empty($policy_id))
		{
			//	check if policy id exists
			$where = array();
			$where[0]['field'] = 'policy_id';
			$where[0]['value'] = (int)$policy_id;
			$where[0]['compare'] = 'equal';
			$exist = $this->util->getTableData($modelName='Policy_master_model', $type="single", $where, $fields = array());
			if (empty($exist))
			{
				$this->session->set_flashdata('message', '<p class="error_msg">Invalid record.</p>');
				$this->data['msgType'] = 'error';
				redirect('admin/policy/index');
			}
			else 
			{
				$policyModel = $exist;
				if (empty($field))
					$field = 'brochure';
				$this->load->helper('download');
				if ($field == 'brochure')
				{
					$folderUrl = $this->config->config['folder_path']['policy']['brochure'];
					$fileUrl = $this->config->config['url_path']['policy']['brochure'];
				}
				else if ($field == 'policy_wordings')
				{
					$folderUrl = $this->config->config['folder_path']['policy']['policy_wordings'];
					$fileUrl = $this->config->config['url_path']['policy']['policy_wordings'];
				}
				$data = file_get_contents($fileUrl.$policyModel[$field]);
				force_download($policyModel[$field], $data);
				//if ($pol)
			}
		}
		else
		{
			$this->session->set_flashdata('message', '<p class="error_msg">Invalid record.</p>');
			$this->data['msgType'] = 'error';
			redirect('admin/policy/index');
		}	
	}

	
	public function deleteFile($policy_id = null, $field = null)
	{
		if (!empty($policy_id))
		{
			//	check if policy id exists
			$where = array();
			$where[0]['field'] = 'policy_id';
			$where[0]['value'] = (int)$policy_id;
			$where[0]['compare'] = 'equal';
			$exist = $this->util->getTableData($modelName='Policy_master_model', $type="single", $where, $fields = array());
			if (empty($exist))
			{
				$this->session->set_flashdata('message', '<p class="error_msg">Invalid record.</p>');
				$this->data['msgType'] = 'error';
				redirect('admin/policy/index');
			}
			else 
			{
				$policyModel = $exist;
				if ($exist['status'] == 'active')
				{
					if (empty($field))
						$field = 'brochure';
					$this->load->helper('download');
					if ($field == 'brochure')
					{
						$folderUrl = $this->config->config['folder_path']['policy']['brochure'];
						$fileUrl = $this->config->config['url_path']['policy']['brochure'];
					}
					else if ($field == 'policy_wordings')
					{
						$folderUrl = $this->config->config['folder_path']['policy']['policy_wordings'];
						$fileUrl = $this->config->config['url_path']['policy']['policy_wordings'];
					}
			//		if (file_exists($folderUrl.$policyModel[$field]))
			//			@unlink($folderUrl.$policyModel[$field]);
					$arrParams[$field] = null;
					$modelType = 'update';
					$arrParams['policy_id'] = $policy_id;
					
					if ($this->policy_master_model->saveRecord($arrParams, $modelType))
					{
						$this->session->set_flashdata('message', '<p class="status_msg">File deleted successfully.</p>');
						$this->data['msgType'] = 'success';
					}
					else 
					{
						$this->session->set_flashdata('message', '<p class="error_msg">File could not be deleted.</p>');
						$this->data['msgType'] = 'error';
					}
				}
				else 
				{
					$this->session->set_flashdata('message', '<p class="error_msg">Invalid record.</p>');
					$this->data['msgType'] = 'error';
					redirect('admin/policy/index');
				}
			}
		}
		else
		{
			$this->session->set_flashdata('message', '<p class="error_msg">Invalid record.</p>');
			$this->data['msgType'] = 'error';
		}
		redirect('admin/policy/create/'.$policy_id);
	}
}

/* End of file auth_lite.php */
/* Location: ./application/controllers/auth_lite.php */