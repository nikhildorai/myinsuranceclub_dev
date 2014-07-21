<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class LifeInsurance extends MIC_Controller {

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
		$this->load->model('insurance_company_master_model');
	}
	
	
	/*
	 * controller for mic/life-insurance/
	 */
	public function index()
	{	
		$data = array();
		$this->template->set_template('frontend');
		$this->template->write_view('content', 'company_page/lifeInsuranceHome', $data, TRUE);
		$this->template->render();
	}
	
	/*
	 * controller for mic/life-insurance/companies/
	 * controller for mic/life-insurance/companies/any_company_name
	 */
	public function companies($companyName = null)
	{
		$data = array();
		$arrParams['company_type_slug'] = $companyType = 'life-insurance';
		$arrParams['company_slug'] = $companyName;
		$cacheFileName = 'company_'.$companyType;
		if (!empty($companyName))
			$cacheFileName .= '_'.$companyName;

		$cacheResult = Util::getCachedFile($cacheFileName);
		//	check if cache file exist
		if(!empty($cacheResult))
		{
			// get result set from cache
			$data['companyDetails']=$cacheResult;
		}
		else
		{
			//get resultset from DB and save in cache
			$data['companyDetails']=$this->insurance_company_master_model->get_insurance_companies($arrParams);
			Util::saveResultToCache($cacheFileName,$data['companyDetails']);
		}
//var_dump($data);
		//	if company name is defined, show specific company details
		if (!empty($companyName))
		{
			$this->template->set_template('frontend');
			$this->template->write_view('content', 'company_page/companyDetail', $data, TRUE);
			$this->template->render();
		}
		else 
		{
			//	if company name is not defined show all company listing
			$this->template->set_template('frontend');
			$this->template->write_view('content', 'company_page/company', $data, TRUE);
			$this->template->render();
		}
	}
	
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/company.php */