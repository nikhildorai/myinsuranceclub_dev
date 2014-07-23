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
		$data = $data['companyDetails'] = $details = array();
		$arrParams['company_type_slug'] = $companyType = 'life-insurance';
		$arrParams['company_slug'] = $companyName;
		//	if company name is defined, show specific company details
		if (!empty($companyName))
		{
			$data = Insurance_company_master_model::getSingleInsuranceCompanyDetails($arrParams);
			$this->template->set_template('frontend');
			$this->template->write_view('content', 'company_page/companyDetail', $data, TRUE);
			$this->template->render();
		}
		else 
		{
			$data = Insurance_company_master_model::getInsuranceCompaniesByCompanyType($arrParams);
			//	if company name is not defined show all company listing
			$this->template->set_template('frontend');
			$this->template->write_view('content', 'company_page/liCompany', $data, TRUE);
			$this->template->render();
		}
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/company.php */