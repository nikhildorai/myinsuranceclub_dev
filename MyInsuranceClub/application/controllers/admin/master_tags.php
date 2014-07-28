<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Master_tags extends Admin_Controller {
 
    function __construct() 
    {
        parent::__construct();
		$this->load->model('master_tags_model');
	}

    public function index()
	{
		$this->load->library('table');
		$this->load->library('pagination');
		
		// Set any returned status/error messages..		
		$this->data['message'] = (! isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];
		$this->session->set_flashdata('message','');		
		

		$arrParams 	= $records = array();
		$where 	= 'status !="deleted"';		
		$total = Util::getTotalRowTable('total','master_tags', $where);
		
		$limit = 0;
		if (isset($_GET))
		{
			$arrParams = $_GET;
			$limit = isset($_GET['per_page']) ? $_GET['per_page'] : 0 ; 
		}
		$this->data['search_query'] = $arrParams;
		$where 	= 'status !="deleted"';
		if (isset($arrParams['name']) && !empty($arrParams['name']))
			$where .= ' AND name LIKE "%'.$arrParams['name'].'%" ';
			
		$orderBy = 'name ASC, tag_id ASC'; 
		$this->data['records'] = Util::getTotalRowTable('all','master_tags', $where, $limit, $orderBy);
		
		
		
		
		
		//	pagination
		$config = $this->util->get_pagination_params();
		$config['total_rows'] 	= $total;
		$this->pagination->initialize($config); 		
        
		$this->template->write_view('content', 'admin/tags/index', $this->data, TRUE);
		$this->template->render();
	}

    public function create($tag_id = null)
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
		if ((isset($_GET['tag_id']) && !empty($_GET['tag_id'])) || !empty($tag_id))
		{
			if (isset($_GET['tag_id']))
				$tag_id = $_GET['tag_id'];
			$where = array();
			$where[0]['field'] = 'tag_id';
			$where[0]['value'] = (int)$tag_id;
			$where[0]['compare'] = 'equal';
			$exist = $this->util->getTableData($modelName='master_tags_model', $type="single", $where, $fields = array());
			if (empty($exist))
			{
				$this->session->set_flashdata('message', '<p class="error_msg">Invalid record.</p>');
				redirect('admin/tags/index');
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
			if (isset($_POST['model']['tag_for']) && $_POST['model']['tag_for'] == 'others')
			{
				$_POST['model']['tag_for'] = $_POST['tag_for_other'];
			}
			//	set default values for policy
			$arrParams = $this->input->post('model');
			$_POST['modelType'] = $modelType;
			//	set validation rules
			$validation_rules = array(
				//array('field' => 'tag_for_other', 'label' => 'tag for others', 'rules' => 'required|callback_validatePost[tag_for_other]'),
				array('field' => 'model[name]', 'label' => 'name', 'rules' => 'required|callback_validatePost[name]'),
				array('field' => 'model[tag_for]', 'label' => 'tag for', 'rules' => 'required'),
				);	
			$this->form_validation->set_rules($validation_rules);
								
			// Run the validation.
			if ($this->form_validation->run())
			{
				//	create unique slug if not present
				$_POST['model']['slug'] = $this->util->getSlug($_POST['model']['name']);
				//	set new default values
				$arrParams = $this->input->post('model');
				//	run validation on complete company post data
				//	save record for policy 
				$recordId = $this->master_tags_model->saveRecord($arrParams, $modelType);
				if ($recordId != false)
				{
					$saveData[] = true;
				}
				else 
					$saveData[] = false;	
					
				if(!in_array(false, $saveData))
				{
					$this->session->set_flashdata('message', '<p class="status_msg">Record saved successfully.</p>');
					$this->data['msgType'] = 'success';
					redirect('admin/master_tags/index');
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
		$this->data['tag_for_other'] = '';
		$this->template->write_view('content', 'admin/tags/create', $this->data, TRUE);
		$this->template->render();
	}
	
	
	/* 
	 * $value	: it will have current validations post value
	 * $validationFor	:defines type of validation on field
	 */
	public function validatePost($post , $validationFor = null)
	{
		var_dump($post);
		if (!empty($_POST) || !empty($post))
		{
			$modelType = 'create';
			$model = $_POST['model'];
			
			if (isset($_POST['modelType']) && !empty($_POST['modelType']))
				$modelType = $_POST['modelType'];
				
			$tag_id = (isset($model['tag_id']) && !empty($model['tag_id'])) ? $model['tag_id'] : '';
			
			$arrSkip = $arrParams = $arrQuery = array();
			if ($validationFor == 'name')
			{
				$arrQuery = array('name', 'status');
				$arrSkip = array('product_id', 'comments');
			}
			else if ($validationFor == 'tag_for_other')
			{
				return true;
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
			$where = array();
			$where[0]['field'] = 'name';
			$where[0]['value'] = $model['name'];
			$where[0]['compare'] = 'equal';
			
			$record = $this->util->getTableData($modelName='Master_tags_model', $type="all", $where, $fields = array());		
			if (!empty($record))
			{
				if (count($record) == 0)
				{
					return TRUE;
				}
				else if (count($record) == 1)
				{
					if ($modelType == 'create' )
					{
						$this->form_validation->set_message('validatePost', 'The %s already exists');
						return FALSE;
					}
					else if ($modelType == 'update')
					{
						//	if company id matches with post tag id, then true else record exists 
						$record = reset($record);
						if ($record['tag_id'] == $model['tag_id'])
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
				else if (count($record) > 1)
				{
					$this->form_validation->set_message('validatePost', 'The %s already exists');
				}
			}
			else 
			{
				return TRUE;
			}
		}
		else 
		{
			$this->form_validation->set_message('validatePost', 'Undefined validation error');
			return FALSE;
		}
	}

	function changeStatus($tag_id = null, $status = 'inactive')
	{
		if (!empty($tag_id))
		{
			//	check if policy id exists
			$where = array();
			$where[0]['field'] = 'tag_id';
			$where[0]['value'] = (int)$tag_id;
			$where[0]['compare'] = 'equal';
			$exist = $this->util->getTableData($modelName='Master_tags_model', $type="single", $where, $fields = array());
			if (empty($exist))
			{
				$this->session->set_flashdata('message', '<p class="error_msg">Invalid record.</p>');
			}
			else 
			{
				$companyModel = $exist;	
				$modelType = 'update';
				$arrParams['status'] = $status;
				$arrParams['tag_id'] = $tag_id;
				if ($this->master_tags_model->saveRecord($arrParams, $modelType))
					$this->session->set_flashdata('message', '<p class="status_msg">Record updated successfully.</p>');
				else 
					$this->session->set_flashdata('message', '<p class="error_msg">Record could not be updated.</p>');
			}
		}
		else
			$this->session->set_flashdata('message', '<p class="error_msg">Invalid record.</p>');
			
		redirect('admin/master_tags/index');
	}

}

/* End of file auth_lite.php */
/* Location: ./application/controllers/auth_lite.php */