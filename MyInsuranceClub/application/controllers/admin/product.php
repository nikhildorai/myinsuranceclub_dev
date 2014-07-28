<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product extends Admin_Controller {
 
    function __construct() 
    {
        parent::__construct();
		// Load required CI libraries and helpers.
		$this->load->model('product_model');
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
		$this->data['records'] 	= $this->product_model->getAll($arrParams);
		//	pagination
		$config = $this->util->get_pagination_params();
		$config['total_rows'] 	= $this->data['records']->num_rows();
		$this->pagination->initialize($config); 		
        
		$this->template->write_view('content', 'admin/product/index', $this->data, TRUE);
		$this->template->render();
	}

    public function create($product_id = null)
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
		if ((isset($_GET['product_id']) && !empty($_GET['product_id'])) || !empty($product_id))
		{
			if (isset($_GET['product_id']))
				$product_id = $_GET['product_id'];
			$where = array();
			$where[0]['field'] = 'product_id';
			$where[0]['value'] = (int)$product_id;
			$where[0]['compare'] = 'equal';
			$exist = $this->util->getTableData($modelName='product_model', $type="single", $where, $fields = array());
			if (empty($exist))
			{
				$this->session->set_flashdata('message', '<p class="error_msg">Invalid record.</p>');
				redirect('admin/product/index');
			}
			else 
			{
				if ($exist['status'] != 'active')
					$isActive = false;
				$model = $exist;
				$modelType = 'update';
			}
		}
		
		//	check if post data is available
		if ($this->input->post('model') && $isActive == true)
		{		
			//	save tags
			if (isset($_POST['tag']) && !empty($_POST['tag']))
			{
				$tag = $this->util->addUpdateTags($_POST['tag']);
				$_POST['model']['tag'] = $tag;
			}
			if (isset($_POST['model']['slug']) && !empty($_POST['model']['slug']))
			{
				$_POST['model']['slug'] = $this->util->getSlug($_POST['model']['slug']);
			}
			if (isset($_POST['model']['company_type_id']) && !empty($_POST['model']['company_type_id']))
			{
				$_POST['model']['company_type_id'] = implode(',', ($_POST['model']['company_type_id']));
			}
			//	set default values for policy
			$arrParams = $this->input->post('model');
			$_POST['modelType'] = $modelType;
			//	set validation rules
			$validation_rules = array(
				array('field' => 'model[product_name]', 'label' => 'title', 'rules' => 'required|callback_validatePost[product_name]'),
				array('field' => 'model[company_type_id]', 'label' => 'company type id', 'rules' => 'required'),
				array('field' => 'model[slug]', 'label' => 'url', 'rules' => 'required|callback_validatePost[slug]'),
				array('field' => 'model[tag]', 'label' => 'tag', 'rules' => 'required'),
				);	
			$this->form_validation->set_rules($validation_rules);
		
			// Run the validation.
			if ($this->form_validation->run())
			{
				//	set new default values
				$arrParams = $this->input->post('model');
				//	run validation on complete company post data
				//	save record for policy 	
				$recordId = $this->product_model->saveRecord($arrParams, $modelType);	
				if ($recordId != false)
				{
					$saveData[] = true;
					$product_id = $recordId;	
				}
				else 
					$saveData[] = false;
						
				//	if policy and varients records are stored then on show success and redirect to index 
				if(!in_array(false, $saveData))
				{
					$this->session->set_flashdata('message', '<p class="status_msg">Record saved successfully.</p>');
					$this->data['msgType'] = 'success';
					redirect('admin/product/index');
				}
				else 
				{
					$this->data['message'] .= '<p class="error_msg">Record could not be saved.</p>';
					$this->data['msgType'] = 'error';
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
		$this->data['selectedTags'] = isset($model['tag']) ? $model['tag'] : '';
		$this->data['tag_for'] = 'product';
		$this->data['tagLimit'] = 1;
		$this->data['status'] = isset($model['status']) ? $model['status'] : '';
		$this->template->write_view('content', 'admin/product/create', $this->data, TRUE);
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
				
			$product_id = (isset($model['product_id']) && !empty($model['product_id'])) ? $model['product_id'] : '';
			
			$arrSkip = $arrParams = $arrQuery = array();
			if ($validationFor == 'slug')
			{
				$arrQuery = array('slug');
			}
			if ($validationFor == 'product_name')
			{
				$arrQuery = array('product_name');
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
			$record = $this->product_model->getAll($arrParams);
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
					if ($record['product_id'] == $model['product_id'])
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

	function changeStatus($product_id = null, $status = 'inactive')
	{
		if (!empty($product_id))
		{
			//	check if policy id exists
			$where = array();
			$where[0]['field'] = 'product_id';
			$where[0]['value'] = (int)$product_id;
			$where[0]['compare'] = 'equal';
			$exist = $this->util->getTableData($modelName='product_model', $type="single", $where, $fields = array());
			if (empty($exist))
			{
				$this->session->set_flashdata('message', '<p class="error_msg">Invalid record.</p>');
			}
			else 
			{
				$companyModel = $exist;	
				$modelType = 'update';
				$arrParams['status'] = $status;
				$arrParams['product_id'] = $product_id;
				if ($this->product_model->saveRecord($arrParams, $modelType))
					$this->session->set_flashdata('message', '<p class="status_msg">Record updated successfully.</p>');
				else 
					$this->session->set_flashdata('message', '<p class="error_msg">Record could not be updated.</p>');
			}
		}
		else
			$this->session->set_flashdata('message', '<p class="error_msg">Invalid record.</p>');
			
		redirect('admin/product/index');
	}
}

/* End of file auth_lite.php */
/* Location: ./application/controllers/auth_lite.php */