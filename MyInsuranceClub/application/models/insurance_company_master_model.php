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
	
	function saveCompanyRecord()
	{
		$validation_rules = array(
			array('field' => 'companyModel[company_type_id]', 'label' => 'company type', 'rules' => 'required'),
			array('field' => 'companyModel[company_shortname]', 'label' => 'company shortname', 'rules' => 'required'),
			array('field' => 'companyModel[company_display_name]', 'label' => 'company display name', 'rules' => 'required'),
			array('field' => 'companyModel[company_type_id]', 'label' => 'company type', 'rules' => 'required'),
		);

		$this->form_validation->set_rules($validation_rules);
		

		// Run the validation.
		if ($this->form_validation->run()==FALSE)
		{
		}

		// Set validation errors.
		//$this->data['message'] = validation_errors('<p class="error_msg">', '</p>');

//var_dump($_POST, $this->form_validation->run(),  validation_errors())		;die;	
		return FALSE;
	}
}