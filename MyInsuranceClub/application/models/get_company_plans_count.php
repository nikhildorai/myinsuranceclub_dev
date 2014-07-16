<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class get_company_plans_count EXTENDS MIC_Model{

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}

	public function get_count($product_name)
	{
		
		$company_plans_count = $this->db->query("CALL sp_getCompanyAndPlansList(?)",$product_name);
		
		return $company_plans_count->result_array();
	}
}
