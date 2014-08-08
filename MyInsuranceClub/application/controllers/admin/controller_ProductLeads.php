<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class controller_ProductLeads extends Admin_Controller {
    function __construct() 
    {
    	parent::__construct();
    	
    	$this->load->model('model_getproductLeads');
    }
    
    public function index()
    {
    	$data = array();
    	$product_name = 'Mediclaim';
    	
    	$data['product_leads'] = $this->model_getproductLeads->getProductLeads($product_name);
    	
    	
    	$this->template->write_view('content', 'admin/productLeads/healthLeads', $data, TRUE);
    	$this->template->render();
    }

	public function critical_illness()
	{
		$data = array();
		$product_name = 'Critical Illness';
		 
		$data['product_leads'] = $this->model_getproductLeads->getProductLeads($product_name);
		 
		 
		$this->template->write_view('content', 'admin/productLeads/criticalillnessLeads', $data, TRUE);
		$this->template->render();
	}
	
	public function term_plans()
	{
		$data = array();
		$product_name = 'Term Plan';
			
		$data['product_leads'] = $this->model_getproductLeads->getProductLeads($product_name);
			
			
		$this->template->write_view('content', 'admin/productLeads/termplanLeads', $data, TRUE);
		$this->template->render();
	}
}