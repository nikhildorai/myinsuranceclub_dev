<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News extends MIC_Controller {

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
		$this->load->model('news_model');
        $this->load->plugin('widget_pi');
	}
	
	
	/*
	 * controller for mic/news/
	 */
	public function index()
	{
		$this->load->library('pagination');
		$data = $data['details'] = $arrParams = $records = array();
		$where 	= 'status ="active"';//News_model::getWhere();	
		$total = Util::getTotalRowTable('total','news', $where);
		
		$limit = 10;
		$limit = isset($_GET['per_page']) ? $_GET['per_page'] : 0 ; 
		
		$arrParams['news_slug'] = '';
		$arrParams['perPage'] = $this->config->config['pagination']['per_page'];
		$arrParams['limits'] = $limit;
		$arrParams['author'] = '';
		$arrParams['tag'] = '';
		$data = News_model::getNewsDetails($arrParams);			
		//	pagination
		$config = $this->util->get_pagination_params();
		
		if (!empty($data['newsDetails']))
			$config['total_rows'] = $data['total'] = $total;
		$data['currentPage'] = $config['currentPage'];
		$this->pagination->initialize($config); 		
		$this->template->set_template('frontend');
		$this->template->write_view('content', 'news/index', $data, TRUE);
		$this->template->render();
	}
	
	
	/*
	 * controller for mic/news/single-new-articles
	 */
	public function newsDetails($slug)
	{	
        $this->load->library('disquslib');
		$data = array();
		if (empty($slug))
			redirect('news/index');
		else 
		{
			$arrParams['news_slug'] = $slug;
			$arrParams['perPage'] = '';//$this->config->config['pagination']['per_page'];
			$arrParams['limits'] = '';
			$arrParams['author'] = '';
			$arrParams['tag'] = '';
			$data = News_model::getNewsDetails($arrParams);
			$data['disqusUrl'] = base_url().'news/'.$slug;	
			$this->template->set_template('frontend');
			$this->template->write_view('content', 'news/news_detail', $data, TRUE);
			$this->template->render();
		}
	}
	
	public function newsByCategory($newsType, $categoryType)
	{
		if (!empty($newsType) && !empty($categoryType))
		{
			
			$this->load->library('pagination');
			$data = $data['details'] = $data['author'] = $data['tagDetails'] = $arrParams = $records = array();
			$limit = 10;
			$limit = isset($_GET['per_page']) ? $_GET['per_page'] : 0 ; 
			
			if ($newsType == 'author')
			{	
				$arrParams['news_slug'] = '';
				$arrParams['perPage'] = $this->config->config['pagination']['per_page'];
				$arrParams['limits'] = $limit;
				$arrParams['author'] = $categoryType;
				$arrParams['tag'] = '';
				$data = News_model::getNewsDetails($arrParams);	
				
				$where 	= 'status ="active"';//News_model::getWhere();
				if (!empty($data['author']))
					$where .= ' AND author = '.$data['author']['uacc_id']; 
			}
			else if ($newsType == 'category')
			{
				$arrParams['news_slug'] = '';
				$arrParams['perPage'] = $this->config->config['pagination']['per_page'];
				$arrParams['limits'] = $limit;
				$arrParams['author'] = '';
				$arrParams['tag'] = $categoryType;
				$data = News_model::getNewsDetails($arrParams);	

				//	get tag records from allTags		
				
				$where 	= 'status ="active"';//News_model::getWhere();
				if (!empty($data['tagDetails']))
					$where .= ' AND FIND_IN_SET('.$data['tagDetails']['tag_id'].',tag)';
			}
			$total = Util::getTotalRowTable('total','news', $where);
			//	pagination
			$config = $this->util->get_pagination_params();
			if (!empty($data['newsDetails']))
				$config['total_rows'] = $data['total'] = $total; 
			$data['currentPage'] = $config['currentPage'];
			$this->pagination->initialize($config); 
			
			$data['newsType'] = $newsType;
			$data['categoryType'] = $categoryType;
			$this->template->set_template('frontend');
			$this->template->write_view('content', 'news/news_by_category', $data, TRUE);
			$this->template->render();
		}
		else 
			redirect('news/index');	
	}
	
}

