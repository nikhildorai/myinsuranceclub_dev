<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News extends Admin_Controller {
 
    function __construct() 
    {
        parent::__construct();
		$this->load->model('news_model');
	}

    public function index()
	{
		$this->load->library('table');
		$this->load->library('pagination');
		
		// Set any returned status/error messages..		
		$this->data['message'] = (! isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];
		$this->session->set_flashdata('message','');		

		$arrParams 	= $records = array();
		$where 	= News_model::getWhere();	
		$total = Util::getTotalRowTable('total','news', $where);
		
		$limit = 0;
		if (isset($_GET))
		{
			$arrParams = $_GET;
			$limit = isset($_GET['per_page']) ? $_GET['per_page'] : 0 ; 
		}
		$this->data['search_query'] = $arrParams;
		$where 	= News_model::getWhere($arrParams);
			
		$orderBy = 'title ASC, news_id ASC'; 
		$this->data['records'] = Util::getTotalRowTable('all','news', $where, $limit, $orderBy);
		
		
		
		//	pagination
		$config = $this->util->get_pagination_params();
		$config['total_rows'] 	= $total;
		$this->pagination->initialize($config); 		
        
		$this->template->write_view('content', 'admin/news/index', $this->data, TRUE);
		$this->template->render();
	}

    public function create($news_id = null)
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
		if ((isset($_GET['news_id']) && !empty($_GET['news_id'])) || !empty($news_id))
		{
			if (isset($_GET['news_id']))
				$news_id = $_GET['news_id'];
			$where = array();
			$where[0]['field'] = 'news_id';
			$where[0]['value'] = (int)$news_id;
			$where[0]['compare'] = 'equal';
			$exist = $this->util->getTableData($modelName='News_model', $type="single", $where, $fields = array());
			if (empty($exist))
			{
				$this->session->set_flashdata('message', '<p class="error_msg">Invalid record.</p>');
				redirect('admin/news/index');
			}
			else 
			{
				if ($exist['status'] != 'active')
					$isActive = false;
				$model = $exist;
				$modelType = 'update';
			}
		}
		
		//	initailze ckeditor
		$this->data['ckeditor'] = array(
			//ID of the textarea that will be replaced
			'id' 	=> 	'description',
			'path'	=>	'JS/ckeditor',
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
			//	save tags
			if (isset($_POST['tag']) && !empty($_POST['tag']))
			{
				$tag = $this->util->addUpdateTags($_POST['tag']);
				$_POST['model']['tag'] = $tag;
			}
			
			if (isset($_POST['model']['slug']) && !empty($_POST['model']['slug']))
				$_POST['model']['slug'] = $this->util->getSlug($_POST['model']['slug']);
			else
				$_POST['model']['slug'] = $this->util->getSlug($_POST['model']['title']);
					
			if (isset($_POST['model']['publish_date']) && !empty($_POST['model']['publish_date']))
			{
				$_POST['model']['publish_date'] = $this->util->getDate($_POST['model']['publish_date'], 3);
			}
			if (!isset($_POST['model']['seo_description'])|| empty($_POST['model']['seo_description']))
			{
				$_POST['model']['seo_description'] = substr(strip_tags($_POST['model']['description']), 1, 150);
			}
//var_dump($_POST);die;			
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
			//	array('field' => 'model[seo_keywords]', 'label' => 'seo keywords', 'rules' => 'required'),
				array('field' => 'model[seo_title]', 'label' => 'key features', 'rules' => 'required'),
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
				$recordId = $this->news_model->saveRecord($arrParams, $modelType);	
				if ($recordId != false)
				{
					$saveData[] = true;
					$news_id = $recordId;	
				}
				else 
					$saveData[] = false;
						
				//	if policy and varients records are stored then on show success and redirect to index 
				if(!in_array(false, $saveData))
				{
					$this->session->set_flashdata('message', '<p class="status_msg">Record saved successfully.</p>');
					$this->data['msgType'] = 'success';
					redirect('admin/news/index');
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
		$this->data['tag_for'] = 'news';
//		$this->data['tagLimit'] = 1;
		$this->data['status'] = isset($model['status']) ? $model['status'] : '';
		
		$this->template->write_view('content', 'admin/news/create', $this->data, TRUE);
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
				
			$news_id = (isset($model['news_id']) && !empty($model['news_id'])) ? $model['news_id'] : '';
			
			$arrSkip = $arrParams = $arrQuery = array();
			if ($validationFor == 'slug')
			{
				$arrQuery = array('slug');
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
			$record = $this->news_model->getAll($arrParams);

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
					if ($record['news_id'] == $model['news_id'])
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

	function changeStatus($news_id = null, $status = 'inactive')
	{
		if (!empty($news_id))
		{
			//	check if policy id exists
			$where = array();
			$where[0]['field'] = 'news_id';
			$where[0]['value'] = (int)$news_id;
			$where[0]['compare'] = 'equal';
			$exist = $this->util->getTableData($modelName='News_model', $type="single", $where, $fields = array());
			if (empty($exist))
			{
				$this->session->set_flashdata('message', '<p class="error_msg">Invalid record.</p>');
			}
			else 
			{
				$companyModel = $exist;	
				$modelType = 'update';
				$arrParams['status'] = $status;
				$arrParams['news_id'] = $news_id;
				if ($this->news_model->saveRecord($arrParams, $modelType))
					$this->session->set_flashdata('message', '<p class="status_msg">Record updated successfully.</p>');
				else 
					$this->session->set_flashdata('message', '<p class="error_msg">Record could not be updated.</p>');
			}
		}
		else
			$this->session->set_flashdata('message', '<p class="error_msg">Invalid record.</p>');
			
		redirect('admin/news/index');
	}
	
}

/* End of file auth_lite.php */
/* Location: ./application/controllers/auth_lite.php */