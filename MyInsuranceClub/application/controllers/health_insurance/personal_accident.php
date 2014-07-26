<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Personal_accident extends MIC_Controller {

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
		//$this->load->library('email');
		$this->load->model('annual_premium_personal_accident_model');
		$this->load->model('city');
	}


	public function index()
	{
		$data=array();
		$data['family_composition']=array(	'1A'=>'Myself',
											'2A'=>'Self + Spouse',
											'2A1C'=>'Self + Spouse + 1 Children',
											'2A2C'=>'Self + Spouse + 2 Children',
											);

		$occupation = $this->util->getCompanyTypeDropDownOptions($modelName ='Occupation_model', $optionKey = 'occupation_id', $optionValue = 'occupation_name', $defaultEmpty = "", $extraKeys = true);

		$data['occupation']=$occupation;
		
		$this->template->set_template('frontend');
		$this->template->write_view('content', 'personal_accident/home', $data, TRUE);
		$this->template->render();
	}
	
	
	public function get_personal_accident_results()
	{
		$data = array();
		$user_input = array();
		
		if($this->input->post('submit')!='' && !empty($_POST))
		{
			$arrSkip = array('MIC_terms','submit');
			foreach ($_POST as $k1=>$v1)
			{
				if (!in_array($k1, $arrSkip) && !empty($v1))
					$user_input[$k1] = trim($v1);
			}
			$this->session->set_userdata('user_input',$user_input);
		}
		$user_input = $this->session->userdata('user_input',$user_input);
		//	set cookie
		Util::setCookies('mic_userdata', $user_input);

		$this->mic_dbtest->customer_personal_search_details($user_input);
		foreach ($user_input as $k1=>$v1)
		{
			if (!is_array($v1))
				$user_input_slug[$k1] = $this->util->getSlug($v1);
		}
		$data['user_input'] = $user_input;		
		
		$cacheFileName = $user_input_slug['product_type'].'_'.$user_input_slug['product_name'].'_'.$user_input_slug['plan_type'].'_'.$user_input_slug['cust_occupation'] ;

		//	check if cache file exist
		if(Util::getCachedFile($cacheFileName) != null)
		{
			// get result set from cache
			$data['customer_details']=Util::getCachedFile($cacheFileName); 
		}
		else
		{
			//get resultset from DB and save in cache
			$data['customer_details']=$this->annual_premium_personal_accident_model->get_results($user_input);
			Util::saveResultToCache($cacheFileName,$data['customer_details']);
		}
		
		/* Filter Data Received From Ajax Post */
		
		if($this->input->is_ajax_request())
		{
			$search_filter=$_POST;
			foreach($data['customer_details'] as $k => $v)
			{
				if(isset($search_filter['sum_assured']))
				{
					if (!in_array($v['sum_assured'],$search_filter['sum_assured']))
					{
						unset($data['customer_details'][$k]);
					}
				}
				
				if(isset($search_filter['sector']))
				{
						
					if (!(in_array($v['public_private_health'],$search_filter['sector'])))
					{
						unset($data['customer_details'][$k]);
					}
				}
				
				if(isset($search_filter['company_name']))
				{
					if (!(in_array(trim($v['company_id']),$search_filter['company_name'])))
					{
						unset($data['customer_details'][$k]);
					}
				}
			}
			echo $this->util->getUserSearchFiltersHtml($data['customer_details'], $type = "personalAccident");
		}
		
		/**************************************/
		
		else 
		{
			$this->template->set_template('frontendsearch');
			$this->template->write_view('content', 'personal_accident/search_results', $data, TRUE);
			$this->template->render();
		}
		
	}
	
	public function compare_policies()
	{
		$data = $variant = $annual_premium = $age = $result = $compareData = array();
		
		if($this->input->post('compare')!=null)
		{
			$compareData = $user_input['personal_accident_compare'] = $_POST['compare'];
			//	set cookie
			Util::setCookies('mic_userdata', $user_input);
		}
		else if (isset($_COOKIE['mic_userdata']) && !empty($_COOKIE['mic_userdata']))
		{
			$compareData = unserialize($_COOKIE['mic_userdata']);
			$compareData = $compareData['personal_accident_compare'];	
		}		
		if (!empty($compareData))
		{		
			foreach($compareData as $k=>$v)
			{
				$compare=explode('-',$v);
				$variant[]=$compare[0];
				$annual_premium[]=$compare[1];
			//	$age=$compare[2];
			}
			$variant = implode(',', $variant);
			$annual_premium = implode(',', $annual_premium);
		
			$data['comparison_results']=$this->annual_premium_personal_accident_model->get_comparison($variant,$annual_premium,$age);
		
			foreach ($data['comparison_results'] as $k1=>$v1)
			{
					
				foreach ($v1 as $k2=>$v2)
				{
					$result[$k2][] = $v2;
				}
			}
		}
		$data['result']=$result;
		//$this->load->view('personal_accident/compare_results', $data);
		$this->template->set_template('frontendsearch');
		$this->template->write_view('content', 'personal_accident/compare_results', $data, TRUE);
		$this->template->render();
	}
}