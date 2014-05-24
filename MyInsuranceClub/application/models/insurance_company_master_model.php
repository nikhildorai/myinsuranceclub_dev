<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Insurance_company_master_model EXTENDS CI_Model{

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
		$this->load->library('session');
		$this->load->library('form_validation');
        $this->load->helper('form');
	}
	
	public function get_all_insurance_company($arrParams = array())
	{	
		$sql = 'SELECT * FROM insurance_company_master WHERE company_shortname != "mic" ';
		if (!empty($arrParams))
		{
			if (array_key_exists('company', $arrParams) && !empty($arrParams['company']))
				$sql .= ' AND (company_name LIKE "%'.$arrParams['company'].'%" OR company_shortname LIKE "%'.$arrParams['company'].'%" OR company_display_name LIKE "%'.$arrParams['company'].'%") ';
			if (array_key_exists('company_type', $arrParams) && !empty($arrParams['company_type']))
				$sql .= ' AND company_type_id = '.$arrParams['company_type'];
		}
		$result = $this->db->query($sql);
		return $result;
	}
	
	function saveCompanyRecord($modelType = 'update')
	{
		return FALSE;
	}
	

	public function getInsuranceCompany($arrParams)
	{	
		$sql = 'SELECT * FROM insurance_company_master WHERE status = "active"';
		if (!empty($arrParams))
		{
			if (isset($arrParams['company_name']) && !empty($arrParams['company_name']))
				$sql .= ' AND company_name LIKE "%'.$arrParams['company_name'].'%" ';
			if (isset($arrParams['company_shortname']) && !empty($arrParams['company_shortname']))
				$sql .= ' AND company_shortname LIKE "%'.$arrParams['company_shortname'].'%" ';
			if (isset($arrParams['company_display_name']) && !empty($arrParams['company_display_name']))
				$sql .= ' AND company_display_name LIKE "%'.$arrParams['company_display_name'].'%" ';
			if (isset($arrParams['company_type_id']) && !empty($arrParams['company_type_id']))
				$sql .= ' AND company_type_id = '.$arrParams['company_type_id'];
		}
		$result = $this->db->query($sql);
		return $result;
	}
}