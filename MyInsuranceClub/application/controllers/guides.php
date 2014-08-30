<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Guides extends MIC_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	function __construct()
	{
		// Call the Controller constructor
		parent::__construct();
		$this->load->model('Guides_model');
        $this->load->plugin('widget_pi');
	}
	
	
	/*
	 * controller for mic/guides/
	 */
	public function index()
	{
		$this->load->library('pagination');
		$data = $data['details'] = $arrParams = $records = array();
		$where 	= 'status ="active"';//Guides_model::getWhere();	
		$total = Util::getTotalRowTable('total','guides', $where);
		
		$limit = 10;
		$limit = isset($_GET['per_page']) ? $_GET['per_page'] : 0 ; 
		
		$arrParams['guides_slug'] = '';
		$arrParams['perPage'] = $this->config->config['pagination']['per_page'];
		$arrParams['limits'] = $limit;
		$arrParams['author'] = '';
		$arrParams['tag'] = '';

		$data = Guides_model::getGuidesDetails($arrParams);	

		//	pagination
		$config = $this->util->get_pagination_params();
		
		if (!empty($data['guidesDetails']))
			$config['total_rows'] = $data['total'] = $total;
		$data['currentPage'] = $config['currentPage'];
		$this->pagination->initialize($config); 		
		$this->template->set_template('frontend');
		$this->template->write_view('content', 'guides/index', $data, TRUE);
		$this->template->render();
	}
	
	
	/*
	 * controller for mic/guides/single-new-guides
	 */
	public function guidesDetails($slug)
	{	
        $this->load->library('disquslib');
		$data = array();
		if (empty($slug))
			redirect('guides/index');
		else 
		{
			$arrParams['guides_slug'] = $slug;
			$arrParams['perPage'] = '';//$this->config->config['pagination']['per_page'];
			$arrParams['limits'] = '';
			$arrParams['author'] = '';
			$arrParams['tag'] = '';
			$data = Guides_model::getGuidesDetails($arrParams);
			$data['disqusUrl'] = base_url().'guides/'.$slug;	
			$this->template->set_template('frontend');
			$this->template->write_view('content', 'guides/guides_detail', $data, TRUE);
			$this->template->render();
		}
	}
	
	public function guidesByCategory($guidesType, $categoryType)
	{
		if (!empty($guidesType) && !empty($categoryType))
		{
			
			$this->load->library('pagination');
			$data = $data['details'] = $data['author'] = $data['tagDetails'] = $arrParams = $records = array();
			$limit = 10;
			$limit = isset($_GET['per_page']) ? $_GET['per_page'] : 0 ; 
			
			if ($guidesType == 'author')
			{	
				$arrParams['guides_slug'] = '';
				$arrParams['perPage'] = $this->config->config['pagination']['per_page'];
				$arrParams['limits'] = $limit;
				$arrParams['author'] = $categoryType;
				$arrParams['tag'] = '';
				$data = Guides_model::getGuidesDetails($arrParams);	
				
				$where 	= 'status ="active"';//Guides_model::getWhere();
				if (!empty($data['author']))
					$where .= ' AND author = '.$data['author']['uacc_id']; 
			}
			else if ($guidesType == 'category')
			{
				$arrParams['guides_slug'] = '';
				$arrParams['perPage'] = $this->config->config['pagination']['per_page'];
				$arrParams['limits'] = $limit;
				$arrParams['author'] = '';
				$arrParams['tag'] = $categoryType;
				$data = Guides_model::getGuidesDetails($arrParams);	

				//	get tag records from allTags		
				
				$where 	= 'status ="active"';//Guides_model::getWhere();
				if (!empty($data['tagDetails']))
					$where .= ' AND FIND_IN_SET('.$data['tagDetails']['tag_id'].',tag)';
			}
			$total = Util::getTotalRowTable('total','guides', $where);
			//	pagination
			$config = $this->util->get_pagination_params();
			if (!empty($data['guidesDetails']))
				$config['total_rows'] = $data['total'] = $total; 
			$data['currentPage'] = $config['currentPage'];
			$this->pagination->initialize($config); 
			
			$data['guidesType'] = $guidesType;
			$data['categoryType'] = $categoryType;
			$this->template->set_template('frontend');
			$this->template->write_view('content', 'guides/guides_by_category', $data, TRUE);
			$this->template->render();
		}
		else 
			redirect('guides/index');	
	}
	
}

