<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class controller_travel extends Customer_Controller {

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
		
		$this->load->model('model_travel_customer_details');
		$this->load->model('model_get_results_travel_insurance');
	}


	public function index()
	{
		$data=array();
		
		$this->template->set_template('frontend');
		$this->template->write_view('content', 'travel_insurance/home', $data, TRUE);
		$this->template->render();
		
	}
	
	public function get_travel_insurance_search_results($param = "no")
	{
		$post='';
		
		if($this->input->post()=='')
		{
			$post = $this->session->userdata('user_input');
		}
		
		$userInputValidation = Util::getUserInputValidation();
		
		if ($userInputValidation == FALSE && !($this->input->is_ajax_request()) && empty($post))
		{
			$this->index();
		}
		
		else 
		{
			$data = array();
			
			$user_input = array();
			
			if($this->input->post('submit')!='' && !empty($_POST))
			{
				
				$user_input['product_name'] = $this->input->post('product_name');
				
				$user_input['product_type'] = $this->input->post('product_type');
				
				if($this->input->post('cust_name') != '')
				{
					
					$user_input['full_name'] = $this->input->post('cust_name');
					
					$explodeName = Util::explodeFullName($user_input['full_name']);
					
					$user_input['first_name'] = $explodeName['first_name'];
					
					$user_input['middle_name'] = $explodeName['middle_name'];
					
					$user_input['last_name'] = $explodeName['last_name'];
					
				}
				
				if($this->input->post('cust_mobile') != '')
				{
					$user_input['cust_mobile'] = $this->input->post('cust_mobile');
				}
				
				if($this->input->post('cust_email') != '')
				{
					$user_input['cust_email'] = $this->input->post('cust_email');
				}
				
				if($this->input->post('cust_birth_day') != '' && $this->input->post('cust_birth_month') != '' && $this->input->post('cust_birth_year') != '')
				{
					$user_input['cust_birthdate'] = $this->input->post('cust_birth_day').'/'.$this->input->post('cust_birth_month').'/'.$this->input->post('cust_birth_year');
				
					$user_input['cust_age'] = Util::convertBirthdateToAge($user_input['cust_birthdate']);
				}
				
				if($this->input->post('cust_gender') != '')
				{
					$user_input['cust_gender'] = $this->input->post('cust_gender');
				}
				
				if($this->input->post('trip_type') != '')
				{
					$user_input['trip_type'] = $this->input->post('trip_type');
				}
				
				if($this->input->post('trip_location') != '')
				{
					$user_input['trip_location'] = $this->input->post('trip_location');
				}
				
				if($this->input->post('trip_start') != '')
				{
					$user_input['trip_start'] = $this->input->post('trip_start');
				}
				
				if($this->input->post('trip_end') != '')
				{
					$user_input['trip_end'] = $this->input->post('trip_end');
				}
				
				if($this->input->post('trip_start') != '' && $this->input->post('trip_end') != '')
				{
					
					$tripstart = date('Y-m-d',strtotime(str_replace('/','-',$user_input['trip_start'])));
					
					$tripend = date('Y-m-d',strtotime(str_replace('/','-',$user_input['trip_end'])));
					
					$tripstartUnix = strtotime($tripstart);
					
					$tripendUnix = strtotime($tripend);
					
					$datediff = $tripendUnix - $tripstartUnix;
					
					$no_of_days = floor($datediff/(60*60*24));
					
					$user_input['trip_duration'] = $no_of_days;
					
				}
				
				if($this->input->post('family_composition') != '')
				{
					$user_input['family_composition'] = $this->input->post('family_composition');
				}
				
				if($this->input->post('family_composition_desp') != '')
				{
					$user_input['family_composition_desp'] = $this->input->post('family_composition_desp');
				}
				
				
				if($this->input->post('spouse_birth_day') != '' && $this->input->post('spouse_birth_day') != '' && $this->input->post('spouse_birth_day'))
				{
					$user_input['spouse_birthdate'] = $this->input->post('spouse_birth_day').'/'.$this->input->post('spouse_birth_month').'/'.$this->input->post('spouse_birth_year');
				
					$user_input['spouse_age'] = Util::convertBirthdateToAge($user_input['spouse_birthdate']);
				}
				
				if($this->input->post('spouse_gender') != '')
				{
					$user_input['spouse_gender'] = $this->input->post('spouse_gender');
				}
				
				$this->session->set_userdata('user_input',$user_input); 
			}	
			
			$user_input=$this->session->userdata('user_input',$user_input);
			
			$this->input->set_cookie('mic_userdata',$this->session->userdata('session_id'),'864000');
			
			$data['compareParam'] = $param;
			
			$this->model_travel_customer_details->insert_customer_details($user_input);
			
			/********************************************** Code Handling Caching **********************************************************/
			
			$cacheFileName = 'sr'.$user_input['product_name'].$user_input['product_type'].
									$user_input['cust_age'].$user_input['family_composition'].
									$user_input['trip_duration'].$user_input['trip_location'].$user_input['trip_type'];
			
			$cacheObject = Util::getCachedObject($cacheFileName);
			
			if($cacheObject != null)
			{
				// RESULT FROM CACHE
				$data['customer_details'] = $cacheObject;
				//echo "from cache";
			}
			else	
			{
				
				// RESULT FETCHED FROM DB AND SAVED IN CACHE
				$data['customer_details'] = $this->model_get_results_travel_insurance->get_search_results($user_input); 
				//echo "from db";
				if(!empty($data['customer_details']))
				{
					Util::saveResultToCache($cacheFileName,$data['customer_details']);
				}
			}
			
			/******************************************************************************************************************************/
			
			
			//var_dump($data['customer_details']);//die;
	
			
			//Filter Data Received From Ajax Post 
			if($this->input->is_ajax_request())
			{
				$search_filter=$_POST;
				$search_filter = array();
				
				Util::setCookies('user_filter',$_POST);
				
				$search_filter=$_POST;
				
				//$data['customer_details'] = Util::getFilteredData($data['customer_details'],$search_filter);
				
				$company_discard = array();
					
				$companycnt = array();
					
				foreach($data['customer_details'] as $k=>$v)
				{
				
					if(!in_array($v['company_id'],$companycnt))
					{
						$companycnt[] = $v['company_id'];
					}
					$company_discard[] = $v['company_id'];
				}
					
				$premiums_from_ajax = Util::getMinAndMaxPremium($data['customer_details']);
				
				$return['html'] = $this->load->view('health_insurance/ajaxPostResultView',$data,TRUE);
				$return['company'] = count($companycnt);
				$return['plan'] = count($data['customer_details']);
				$return['minPremium'] = $premiums_from_ajax['min_premium'];
				$return['maxPremium'] = $premiums_from_ajax['max_premium'];
				echo  json_encode($return);
			}
			
			else 
			{

				//$data['html'] = $this->load->view('travel_insurance/ajaxPostResultView',$data,TRUE);
				$this->template->set_template('frontendsearch');
				$this->template->write_view('content', 'travel_insurance/search_results', $data, TRUE);
				$this->template->render();
			}
			
		}
	}
	
	
	
	
	public function compare_policies()
	{
		/* $data=$variant=$annual_premium=$age=array();
		if($this->input->post('compare')!=null)
		{	
			foreach($this->input->post('compare') as $k=>$v)
			{
				$compare=explode('-',$v);
				$variant[]=$compare[0];
				$annual_premium[]=$compare[1];
			//	$age=$compare[2];
			}
			$variant = implode(',', $variant);
			$annual_premium = implode(',', $annual_premium);
		}
		$data['comparison_results']=$this->annual_premium_personal_accident_model->get_comparison($variant,$annual_premium,$age);
	
		foreach ($data['comparison_results'] as $k1=>$v1)
		{
				
			foreach ($v1 as $k2=>$v2)
			{
				if ($k2 == 'company_shortname')
				{
					$key = 'Company';
				}
				else
				{
					$key = ucfirst(str_replace(array('_','-',' '), ' ', $k2));
				}
				$result[$key][] = $v2;
			}
		}
		$data['result']=$result;
		$this->load->view('personal_accident/compare_results', $data); */
	}
}