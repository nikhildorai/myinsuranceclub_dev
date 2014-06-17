<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Articles extends CI_Controller {
 
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
		$this->load->library('form_validation');
		$this->load->model('articles_model');
 		
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
		$this->data['records'] 	= $this->articles_model->getAll($arrParams);

		//	pagination
		$config = $this->util->get_pagination_params();
		$config['total_rows'] 	= $this->data['records']->num_rows();
		$this->pagination->initialize($config); 		
        
		$this->template->write_view('content', 'admin/articles/index', $this->data, TRUE);
		$this->template->render();
	}

    public function create($article_id = null)
	{
		$modelType = 'create';
		//	check if policy id exists
		$model = array();
		$this->data['message'] = '';
		$company_id = '';
		$sessionMsg = $this->session->flashdata('message');
		$this->data['message'] = ( !empty($sessionMsg)) ? $sessionMsg : '';
		$this->session->set_flashdata('message','');	
		$isActive = true;
		if ((isset($_GET['article_id']) && !empty($_GET['article_id'])) || !empty($article_id))
		{
			if (isset($_GET['article_id']))
				$article_id = $_GET['article_id'];
			$where = array();
			$where[0]['field'] = 'article_id';
			$where[0]['value'] = (int)$article_id;
			$where[0]['compare'] = 'equal';
			$exist = $this->util->getTableData($modelName='Articles_model', $type="single", $where, $fields = array());
			if (empty($exist))
			{
				$this->session->set_flashdata('message', '<p class="error_msg">Invalid record.</p>');
				redirect('admin/articles/index');
			}
			else 
			{
				if ($exist['status'] != 'active')
					$isActive = false;
				$model = $exist;
			}
		}
		
		//	initailze ckeditor
		$this->data['ckeditor'] = array(
			//ID of the textarea that will be replaced
			'id' 	=> 	'description',
			'path'	=>	'js/ckeditor',
			//Optionnal values
			'config' => array(
				'toolbar' 	=> 	"Full", 	//Using the Full toolbar
				'width' 	=> 	"100%",	//Setting a custom width
				'height' 	=> 	'300px',	//Setting a custom height
				),
			);
		
				
		//	check if post data is available
		if ($this->input->post('model') && $isActive == true)
		{
			//	set default values for policy
			$arrParams = $this->input->post('model');
			$_POST['modelType'] = $modelType;
			//	set validation rules
			$validation_rules = array(
				array('field' => 'model[title]', 'label' => 'title', 'rules' => 'required'),
				array('field' => 'model[description]', 'label' => 'description', 'rules' => 'required'),
				array('field' => 'model[publish_date]', 'label' => 'publish date', 'rules' => 'required'),
				array('field' => 'model[author]', 'label' => 'author', 'rules' => 'required'),
				array('field' => 'model[seo_description]', 'label' => 'seo description', 'rules' => 'required'),
				array('field' => 'model[seo_keywords]', 'label' => 'seo keywords', 'rules' => 'required'),
				array('field' => 'model[seo_title]', 'label' => 'key features', 'rules' => 'required'),
				array('field' => 'model[slug]', 'label' => 'url', 'rules' => 'required|callback_validatePost[slug]'),
				);	
			$this->form_validation->set_rules($validation_rules);
						
			// Run the validation.
			if ($this->form_validation->run())
			{
				//	set new default values
				$arrParams = $this->input->post('model');
				//	run validation on complete company post data
				//	save record for policy 
				$recordId = $this->articles_model->saveRecord($arrParams, $modelType);	
				if ($recordId != false)
				{
					$saveData[] = true;
					$article_id = $recordId;	
				}
				else 
					$saveData[] = false;
						
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
				// 	Set validation errors.
				$this->data['message'] = validation_errors('<p class="error_msg">', '</p>'); 
				$this->data['msgType'] = 'error';
			}
			$model = $_POST['model'];
		}		
		$this->data['model'] = $model;
		$this->data['modelType'] = $modelType;
		
		
		//	get all active authorized(admin n moderator) users
		
		$users = $this->util->getActiveUserLIst();
		
		$this->data['users'] = $users->result_array();
		$this->template->write_view('content', 'admin/articles/create', $this->data, TRUE);
		$this->template->render();
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
			$model = $_POST['model'];
			
			if (isset($_POST['modelType']) && !empty($_POST['modelType']))
				$modelType = $_POST['modelType'];
				
			$article_id = (isset($model['article_id']) && !empty($model['article_id'])) ? $model['article_id'] : '';
			
			$arrSkip = $arrParams = $arrQuery = array();
			if ($validationFor == 'policy_name')
			{
				$arrQuery = array('company_id', 'policy_name');
				$arrSkip = array('product_id', 'product_id');
			}
			else if ($validationFor == 'product_id')
			{
				if (!empty($model['company_id']))
				{
					$where = array();
					$where[0]['field'] = 'company_id';
					$where[0]['value'] = (int)$model['company_id'];
					$where[0]['compare'] = 'equal';
					$compType = reset($this->util->getTableData($modelName='Insurance_company_master_model', $type="single", $where, $fields = array('company_type_id')));
					$where = array();
					$where[0]['field'] = 'company_type_id';
					$where[0]['value'] = (int)$compType['company_type_id'];
					$where[0]['compare'] = 'equal';
					$policyHealth = $this->util->getTableData($modelName='Product_model', $type="all", $where, $fields = array());

					if (!empty($policyHealth))
					{
						if (isset($model['product_id']) && !empty($model['product_id']))
						{
							$product_id = explode(',', $model['product_id']);
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
								$_POST['model']['product_id'] = null;
								$this->form_validation->set_message('validatePost', 'The %s is required');
								return FALSE;
							}
						}
						else 
						{
							$_POST['model']['product_id'] = null;
							$this->form_validation->set_message('validatePost', 'The %s is required');
							return FALSE;
						}
					}
					else 
					{
						$_POST['model']['product_id'] = null;
					}		
				}
				else 
				{
					return true;
				}
			}
			else 
			{
				$arrParams = $model;
			}
			
			foreach ($model as $k1=>$v1)
			{
				if (in_array($k1, $arrQuery))
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
					if ($record['article_id'] == $model['article_id'])
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

	function changeStatus($article_id = null, $status = 'inactive')
	{
		if (!empty($article_id))
		{
			//	check if policy id exists
			$where = array();
			$where[0]['field'] = 'article_id';
			$where[0]['value'] = (int)$article_id;
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
				$arrParams['article_id'] = $article_id;
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
	
	public function download($article_id = null, $field = null)
	{
		if (!empty($article_id))
		{
			//	check if policy id exists
			$where = array();
			$where[0]['field'] = 'article_id';
			$where[0]['value'] = (int)$article_id;
			$where[0]['compare'] = 'equal';
			$exist = $this->util->getTableData($modelName='Policy_health_master_model', $type="single", $where, $fields = array());
			if (empty($exist))
			{
				$this->session->set_flashdata('message', '<p class="error_msg">Invalid record.</p>');
				$this->data['msgType'] = 'error';
				redirect('admin/policy/index');
			}
			else 
			{
				$model = $exist;
				if (empty($field))
					$field = 'brochure';
				$this->load->helper('download');
				$folderUrl = $this->config->config['folder_path']['policy'];
				$fileUrl = $this->config->config['url_path']['policy'];
				$data = file_get_contents($fileUrl.$model[$field]);
				force_download($model[$field], $data);
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

	
	public function deleteFile($article_id = null, $field = null)
	{
		if (!empty($article_id))
		{
			//	check if policy id exists
			$where = array();
			$where[0]['field'] = 'article_id';
			$where[0]['value'] = (int)$article_id;
			$where[0]['compare'] = 'equal';
			$exist = $this->util->getTableData($modelName='Policy_health_master_model', $type="single", $where, $fields = array());
			if (empty($exist))
			{
				$this->session->set_flashdata('message', '<p class="error_msg">Invalid record.</p>');
				$this->data['msgType'] = 'error';
				redirect('admin/policy/index');
			}
			else 
			{
				$model = $exist;
				if ($exist['status'] == 'active')
				{
					if (empty($field))
						$field = 'brochure';
					$this->load->helper('download');
					$folderUrl = $this->config->config['folder_path']['policy'];
					$fileUrl = $this->config->config['url_path']['policy'];
			//		if (file_exists($folderUrl.$model[$field]))
			//			@unlink($folderUrl.$model[$field]);
					$arrParams[$field] = null;
					$modelType = 'update';
					$arrParams['article_id'] = $article_id;
					
					if ($this->policy_health_master_model->saveRecord($arrParams, $modelType))
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
		redirect('admin/policy/create/'.$article_id);
	}
}

/* End of file auth_lite.php */
/* Location: ./application/controllers/auth_lite.php */