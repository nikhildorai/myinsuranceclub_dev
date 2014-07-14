<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Get_Hospital_List EXTENDS CI_Model{

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}

	public function get_list($company_id,$company_hospitals)
	{
		$search_data = array();
		
		if(!is_numeric($company_hospitals))
		{
			$search_data = array($company_id,$company_hospitals,'');
		}
		else
		{
			$search_data = array($company_id,'',$company_hospitals);
		}
		
		$hospital_list_query= $this->db->query("CALL sp_getHospitalList(?,?,?)",$search_data);
		
		return $hospital_list_query->result_array();
	}
}