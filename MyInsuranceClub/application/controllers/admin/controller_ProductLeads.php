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
    	$product_name = 'healthLeads';
    	
    	$data['product_leads'] = $this->model_getproductLeads->getProductLeads($product_name);
    	
    	
    	$this->template->write_view('content', 'admin/productLeads/healthLeads', $data, TRUE);
    	$this->template->render();
    }

}