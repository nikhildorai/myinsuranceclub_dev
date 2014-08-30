<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Articles extends MIC_Controller {

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
		$this->load->model('articles_model');
        $this->load->plugin('widget_pi');
	}
	
	
	/*
	 * controller for mic/articles/
	 */
	public function index()
	{
		$this->load->library('pagination');
		$data = $data['details'] = $arrParams = $records = array();
		$where 	= 'status ="active"';//articles_model::getWhere();	
		$total = Util::getTotalRowTable('total','articles', $where);
		
		$limit = 10;
		$limit = isset($_GET['per_page']) ? $_GET['per_page'] : 0 ; 
		
		$arrParams['articles_slug'] = '';
		$arrParams['perPage'] = $this->config->config['pagination']['per_page'];
		$arrParams['limits'] = $limit;
		$arrParams['author'] = '';
		$arrParams['tag'] = '';

		$data = Articles_model::getArticlesDetails($arrParams);	

		//	pagination
		$config = $this->util->get_pagination_params();
		
		if (!empty($data['articlesDetails']))
			$config['total_rows'] = $data['total'] = $total;
		$data['currentPage'] = $config['currentPage'];
		$this->pagination->initialize($config); 		
		$this->template->set_template('frontend');
		$this->template->write_view('content', 'articles/index', $data, TRUE);
		$this->template->render();
	}
	
	
	/*
	 * controller for mic/articles/single-new-articles
	 */
	public function articlesDetails($slug)
	{	
        $this->load->library('disquslib');
		$data = array();
		if (empty($slug))
			redirect('articles/index');
		else 
		{
			$arrParams['articles_slug'] = $slug;
			$arrParams['perPage'] = '';//$this->config->config['pagination']['per_page'];
			$arrParams['limits'] = '';
			$arrParams['author'] = '';
			$arrParams['tag'] = '';
			$data = articles_model::getarticlesDetails($arrParams);
			$data['disqusUrl'] = base_url().'articles/'.$slug;	
			$this->template->set_template('frontend');
			$this->template->write_view('content', 'articles/articles_detail', $data, TRUE);
			$this->template->render();
		}
	}
	
	public function articlesByCategory($articlesType, $categoryType)
	{
		if (!empty($articlesType) && !empty($categoryType))
		{
			
			$this->load->library('pagination');
			$data = $data['details'] = $data['author'] = $data['tagDetails'] = $arrParams = $records = array();
			$limit = 10;
			$limit = isset($_GET['per_page']) ? $_GET['per_page'] : 0 ; 
			
			if ($articlesType == 'author')
			{	
				$arrParams['articles_slug'] = '';
				$arrParams['perPage'] = $this->config->config['pagination']['per_page'];
				$arrParams['limits'] = $limit;
				$arrParams['author'] = $categoryType;
				$arrParams['tag'] = '';
				$data = articles_model::getarticlesDetails($arrParams);	
				
				$where 	= 'status ="active"';//articles_model::getWhere();
				if (!empty($data['author']))
					$where .= ' AND author = '.$data['author']['uacc_id']; 
			}
			else if ($articlesType == 'category')
			{
				$arrParams['articles_slug'] = '';
				$arrParams['perPage'] = $this->config->config['pagination']['per_page'];
				$arrParams['limits'] = $limit;
				$arrParams['author'] = '';
				$arrParams['tag'] = $categoryType;
				$data = articles_model::getarticlesDetails($arrParams);	

				//	get tag records from allTags		
				
				$where 	= 'status ="active"';//articles_model::getWhere();
				if (!empty($data['tagDetails']))
					$where .= ' AND FIND_IN_SET('.$data['tagDetails']['tag_id'].',tag)';
			}
			$total = Util::getTotalRowTable('total','articles', $where);
			//	pagination
			$config = $this->util->get_pagination_params();
			if (!empty($data['articlesDetails']))
				$config['total_rows'] = $data['total'] = $total; 
			$data['currentPage'] = $config['currentPage'];
			$this->pagination->initialize($config); 
			
			$data['articlesType'] = $articlesType;
			$data['categoryType'] = $categoryType;
			$this->template->set_template('frontend');
			$this->template->write_view('content', 'articles/articles_by_category', $data, TRUE);
			$this->template->render();
		}
		else 
			redirect('articles/index');	
	}
	
}

