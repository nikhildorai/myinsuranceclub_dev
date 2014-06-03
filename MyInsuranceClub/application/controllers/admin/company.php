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
        $this->load->library('upload');
 		$this->load->helper('url');
 		$this->load->helper('form');
		$this->load->library('form_validation');
        $this->load->helper('ckeditor');
		$this->load->model('insurance_company_master_model');
		$this->load->model('insurance_company_master_detail_model');
 		
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
		// Set any returned status/error messages..		
		$this->data['message'] = (! isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];
		$this->session->set_flashdata('message','');
		
		$this->data['records'] 	= $this->insurance_company_master_model->get_all_insurance_company($arrParams);
		//	pagination
		$config = $this->util->get_pagination_params();
		$config['total_rows'] 	= $this->data['records']->num_rows();
		$this->pagination->initialize($config); 		
		$this->template->write_view('content', 'admin/company/index', $this->data, TRUE);
		$this->template->render();
	}

    public function create($company_id = null)
	{
		$modelType = 'create';
		$companyModel = $companyDetailModel = $saveData = array();
		$this->data['message'] = '';
		$this->data['file_upload'] = array();
		
		
		//Ckeditor's configuration
		$this->data['ckeditor1'] = array(
			//ID of the textarea that will be replaced
			'id' 	=> 	'description_1',
			'path'	=>	'js/ckeditor',
			//Optionnal values
			'config' => array(
				'toolbar' 	=> 	"Full", 	//Using the Full toolbar
				'width' 	=> 	"80%",	//Setting a custom width
				'height' 	=> 	'100px',	//Setting a custom height
			),
		);
		$this->data['ckeditor2'] = array(
			//ID of the textarea that will be replaced
			'id' 	=> 	'description_2',
			'path'	=>	'js/ckeditor',
			//Optionnal values
			'config' => array(
				'toolbar' 	=> 	"Full", 	//Using the Full toolbar
				'width' 	=> 	"80%",	//Setting a custom width
				'height' 	=> 	'100px',	//Setting a custom height
			),
		);
		
			
		//	check if company id exists
		if (!empty($company_id))
		{
			$where = array();
			$where[0]['field'] = 'company_id';
			$where[0]['value'] = (int)$company_id;
			$where[0]['compare'] = 'equal';
			$exist = $this->util->getTableData($modelName='Insurance_company_master_model', $type="single", $where, $fields = array());
			//$this =& get_instance();
			if (empty($exist))
			{
				$this->session->set_flashdata('message', '<p class="error_msg">Invalid record.</p>');
				redirect('admin/company/index');
			}
			else 
			{
				$companyModel = $exist;	
				$modelType = 'update';
				
				//	check if details exist
				$where = array();
				$where[0]['field'] = 'company_id';
				$where[0]['value'] = (int)$company_id;
				$where[0]['compare'] = 'equal';
				$detailExists = $this->util->getTableData($modelName='Insurance_company_master_detail_model', $type="single", $where, $fields = array());
				
				if (empty($detailExists))
				{
					$dmodelType = 'create';
				}
				else 
				{
					$companyDetailModel = $detailExists;
					$dmodelType = 'update';
				}			
				
			}
		}
		
		//	check if post data is available
		if ($this->input->post('companyModel'))
		{
			//	check if file is uploaded
			if (!empty($_FILES))
			{
				$i = 1;
				foreach($_FILES['companyModel']['name'] as $k1=>$v1)
				{
					$ext = end(explode('.', $v1));
					if (empty($ext))
						$ext = 'jpg';
					$name = $this->util->getSlug($_POST['companyModel']['company_display_name']);
					if ($i == 2)
						$name .= '-small';
					$name .= '.'.$ext;
					$arrFileNames[$k1] = $name;
					if (empty($v1))
					{
						$_POST['companyModel'][$k1] = $companyModel[$k1];
					}
					else
						$_POST['companyModel'][$k1] = $name;
					$i++;
				}
			}
			else 
			{
				//	set previous file name in post
				$_POST['companyModel']['image_logo_1'] = $companyModel['image_logo_1'];
				$_POST['companyModel']['image_logo_2'] = $companyModel['image_logo_2'];
			}	
			//	set default values
			$_POST['companyModel']['company_display_name'] = (isset($_POST['companyModel']['company_display_name']) && !empty($_POST['companyModel']['company_display_name'])) ? $_POST['companyModel']['company_display_name'] :  $_POST['companyModel']['company_name'];
			$arrParams = $this->input->post('companyModel');
			$companyTypeId = (isset($arrParams['company_type_id']) && !empty($arrParams['company_type_id'])) ? $arrParams['company_type_id'] : '';
			$company_id = (isset($arrParams['company_id']) && !empty($arrParams['company_id'])) ? $arrParams['company_id'] : '';	
			
			//	set validation rules
			$validation_rules = array(
				//	co mpany validation	
				array('field' => 'companyModel[company_name]', 'label' => 'company name', 'rules' => 'required|callback_validateInsuranceCompany[company_name#'.$arrParams["company_name"].',company_type_id#'.$companyTypeId.',modelType#'.$modelType.',company_id#'.$company_id.']'),
				array('field' => 'companyModel[company_shortname]', 'label' => 'company shortname', 'rules' => 'required|callback_validateInsuranceCompany[company_shortname#'.$arrParams["company_shortname"].',company_type_id#'.$companyTypeId.',modelType#'.$modelType.',company_id#'.$company_id.']'),
				array('field' => 'companyModel[company_display_name]', 'label' => 'company display name', 'rules' => 'required|callback_validateInsuranceCompany[company_display_name#'.$arrParams["company_display_name"].',company_type_id#'.$companyTypeId.',modelType#'.$modelType.',company_id#'.$company_id.']'),
				array('field' => 'companyModel[company_type_id]', 'label' => 'company type', 'rules' => 'required'),
				array('field' => 'companyModel[seo_title]', 'label' => 'seo title', 'rules' => 'required'),
				array('field' => 'companyModel[seo_description]', 'label' => 'seo description', 'rules' => 'required'),
				array('field' => 'companyModel[seo_keywords]', 'label' => 'seo keywords', 'rules' => 'required'),
		//		array('field' => 'companyModel[image_logo_1]', 'label' => 'logo image 1', 'rules' => 'required'),
		//		array('field' => 'companyModel[image_logo_2]', 'label' => 'logo image 2', 'rules' => 'required'),
				array('field' => 'companyModel[slug]', 'label' => 'url', 'rules' => 'required|callback_validateInsuranceCompany[slug#'.$arrParams["slug"].',modelType#'.$modelType.',company_id#'.$company_id.',company_type_id#'.$companyTypeId.']'),
				
				//	company contact detail validation
				array('field' => 'companyDetailModel[website]', 'label' => 'website', 'rules' => 'required|trim|max_length[256]|xss_clean|prep_url|valid_url_format|url_exists'),
				//array('field' => 'companyDetailModel[facebook]', 'label' => 'facebook', 'rules' => 'required|trim|max_length[256]|xss_clean|prep_url|valid_url_format|url_exists'),
				array('field' => 'companyDetailModel[phone]', 'label' => 'phone', 'rules' => 'required'),
				array('field' => 'companyDetailModel[email]', 'label' => 'email', 'rules' => 'required|valid_emails'),
				array('field' => 'companyDetailModel[address]', 'label' => 'address', 'rules' => 'required|'),
				array('field' => 'companyDetailModel[heading_1]', 'label' => 'heading 1', 'rules' => 'required'),
				array('field' => 'companyDetailModel[heading_2]', 'label' => 'heading 2', 'rules' => 'required'),
				array('field' => 'companyDetailModel[description_1]', 'label' => 'description 1', 'rules' => 'required'),
				array('field' => 'companyDetailModel[description_2]', 'label' => 'description 2', 'rules' => 'required'),
				
			);
			$companyDetailModel = $_POST['companyDetailModel'];
			$this->form_validation->set_rules($validation_rules);
			// Run the validation.
			if ($this->form_validation->run())
			{
				//	run validation on complete company post data
				$validate = $this->validateInsuranceCompany($arrParams, 'modelType#'.$modelType.',company_id#'.$company_id);	
				if ($validate == true)
				{
				
					//	save record for company 
					$recordId = $this->insurance_company_master_model->saveCompanyRecord($arrParams, $modelType);	
					if ($recordId != false)
					{
						$saveData[] = true;
						$company_id = $recordId;	
					}
					else 
						$saveData[] = false;
						
					if (!empty($company_id))
					{
						// 	save records for files
						if (!empty($_FILES))
						{
							$this->data['file_upload_error'] = array();
					        $config['upload_path'] = $this->config->config['folder_path']['company'];
					        $config['file_name'] = $arrFileNames;
					        $config['allowed_types'] = 'gif|jpg|png';
					        $config['max_size'] = '200';
					        $config['max_width']  = '400';
					        $config['max_height']  = '250';
							$this->load->library('upload', $config);
							$this->upload->initialize($config); 	
							if($this->upload->do_multi_upload("companyModel"))
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
				            	}
								$saveData[] = false;
				            }
				            else 
				            {
								$saveData[] = true;
				            }
						}		
						
						if (!empty($companyDetailModel))
						{
							$companyDetailModel['company_id'] = $company_id;
							//	save record for company details
							$recordId = $this->insurance_company_master_detail_model->saveCompanyRecord($companyDetailModel, $dmodelType);	
							if ($recordId != false)
							{
								$saveData[] = true;
								$company_id = $recordId;	
							}
							else 
								$saveData[] = false;	
						}
						
					}			
					//	if policy and varients records are stored then on show success and redirect to index 
					if(!in_array(false, $saveData))
					{
						$this->session->set_flashdata('message', '<p class="status_msg">Record saved successfully.</p>');
						redirect('admin/company/index');
					}
					else 
					{
						// show error if record is not created
						$this->data['message'] .= '<p class="error_msg">Record could not be created.</p>';
					}
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					/*
					
					//	save record and redirect to index
					if ($this->insurance_company_master_model->saveCompanyRecord($arrParams, $modelType))
					{
						$this->data['file_upload_error'] = array();
						if (!empty($_FILES))
						{
					        $config['upload_path'] = $this->config->config['folder_path']['company'];
					        $config['file_name'] = $arrFileNames;
					        $config['allowed_types'] = 'gif|jpg|png';
					        $config['max_size'] = '200';
					        $config['max_width']  = '400';
					        $config['max_height']  = '250';
							$this->load->library('upload', $config);
							$this->upload->initialize($config); 	
							if($this->upload->do_multi_upload("companyModel"))
							{
				              	$this->data['file_upload'] = $this->upload->get_multi_upload_data();
							}
							else 
							{
				                $this->data['file_upload_error'][] = $this->upload->display_errors();
							}
				             $this->data['file_upload'] = $this->upload->get_multi_upload_data();
						}			
												
			            if (empty($this->data['file_upload_error']))
			            {
							$this->session->set_flashdata('message', '<p class="status_msg">Record saved successfully.</p>');
							redirect('admin/company/index');
			            }
			            else if (!empty($this->data['file_upload_error']))
			            {
			            	foreach ($this->data['file_upload_error'] as $k1=>$v1)
			            	{
			            		$msg = str_replace('<p>', '', $v1);
			            		$msg = str_replace('</p>', '', $msg);
								$this->data['message'] .= '<p class="error_msg">'.$msg.'</p>';
			            	}
			            }
			            else 
			            {
							$this->session->set_flashdata('message', '<p class="status_msg">Record saved successfully.</p>');
							redirect('admin/company/index');
			            }
					}
					else
					{
						// show error if record is not created
						$this->data['message'] = '<p class="error_msg">Record could not be created.</p>';
					}
					*/
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
			$companyModel = $_POST['companyModel'];
			$companyDetailModel = $_POST['companyDetailModel'];
		}		
		$this->data['companyModel'] = $companyModel;
		$this->data['companyDetailModel'] = $companyDetailModel;
		$this->template->write_view('content', 'admin/company/create', $this->data, TRUE);
		$this->template->render();
	}
	
	
	
	/* 
	 * $value	: it will have current validations post value
	 * $params	:should be string with multiple key value joined using ",". 
	 * 			It should be key value pair should be separated by "#".
	 * 			example: "company_name#Agricultural Insurance Company of India,company_type_id#1"
	 */
	public function validateInsuranceCompany($value , $params = null)
	{
		$arrParams = $arrParamsVals = $return = array();
	
		//	separate parametes from string
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
						$arrParamsVals[$a[0]] = $a[1];
					}
				}
			}
		}
		
		//	set where parametes accordingly
		if (is_array($value))
		{
			$arrParams = $value;
		}
		else if (is_string($value))
		{
			$arrParams = $arrParamsVals;
		}
		else 
		{
			$this->form_validation->set_message('validateInsuranceCompany', 'Undefined validation error');
			return FALSE;
		}
		//	search for existing records
		$record = $this->insurance_company_master_model->getInsuranceCompany($arrParams);

		if ($record->num_rows == 0)
		{
			return TRUE;
		}
		else if ($record->num_rows == 1)
		{
			if (isset($arrParamsVals['modelType']) && $arrParamsVals['modelType'] == 'create' )
			{
				$this->form_validation->set_message('validateInsuranceCompany', 'The %s already exists');
				return FALSE;
			}
			else if (isset($arrParamsVals['modelType']) && $arrParamsVals['modelType'] == 'update' && !empty($arrParamsVals['modelType']))
			{
				//	if company id matches with post company id, then true else record exists 
				$record = reset($record->result_array());
				if ($record['company_id'] == $arrParamsVals['company_id'])
					return true;
				else 
				{
					$this->form_validation->set_message('validateInsuranceCompany', 'The %s already exists');
					return FALSE;
				}
			}
			else 
			{
				$this->form_validation->set_message('validateInsuranceCompany', 'Undefined validation error');
				return FALSE;
			}
		}
		else if ($record->num_rows > 1)
		{
			$this->form_validation->set_message('validateInsuranceCompany', 'The %s already exists');
		}
		else 
		{
			$this->form_validation->set_message('validateInsuranceCompany', 'Undefined validation error');
			return FALSE;
		}
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