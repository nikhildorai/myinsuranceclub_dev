<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Insurance_company_master_detail_model EXTENDS Admin_Model{

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}
	
	public function get_all_insurance_company($arrParams = array())
	{	
		$sql = 'SELECT * FROM insurance_company_master_detail WHERE status != "deleted" AND company_shortname != "mic" ';
		if (!empty($arrParams))
		{
			if (array_key_exists('company', $arrParams) && !empty($arrParams['company']))
				$sql .= ' AND (company_name LIKE "%'.$arrParams['company'].'%" OR company_shortname LIKE "%'.$arrParams['company'].'%" OR company_display_name LIKE "%'.$arrParams['company'].'%") ';
			if (array_key_exists('company_type', $arrParams) && !empty($arrParams['company_type']))
				$sql .= ' AND company_type_id = '.$arrParams['company_type'];
		}
		$sql .= ' ORDER BY company_name ASC, company_type_id ASC ';
		$result = $this->db->query($sql);
		return $result;
	}
	
	function saveCompanyRecord($arrParams = array(), $dmodelType = 'update')
	{
		$saveRecord = false;
		if (!empty($arrParams))
		{
			$colNames = $colValues = $values = array();
			foreach ($arrParams as $k1=>$v1)
			{
				if (!in_array($k1, array('company_detail_id')))
				{
					if (is_numeric($v1))
						$values[$k1] = (int)trim($v1);
					else
						$values[$k1] = trim($v1);
				}
			}
			if ($dmodelType == 'create')
			{
				if ($this->db->insert('insurance_company_master_detail', $values))
					$saveRecord = true;
			}
			else
			{
				$where = array('company_detail_id'=> $arrParams['company_detail_id']);
				if ($this->db->update('insurance_company_master_detail', $values, $where))
					$saveRecord = true;
			}
		}
		if ($saveRecord == true)
		{
			if ($dmodelType == 'create')
				return $this->db->insert_id();
			else 
				return $arrParams['company_detail_id'];
		}
		else
			return false;				
	}
	
	public function getInsuranceCompany($arrParams)
	{	
		$sql = 'SELECT * FROM insurance_company_master_detail WHERE status != "deleted"';
		if (!empty($arrParams))
		{
			if (isset($arrParams['company_name']) && !empty($arrParams['company_name']))
				$sql .= ' AND company_name = "'.$arrParams['company_name'].'" ';
			if (isset($arrParams['company_shortname']) && !empty($arrParams['company_shortname']))
				$sql .= ' AND company_shortname = "'.$arrParams['company_shortname'].'" ';
			if (isset($arrParams['company_display_name']) && !empty($arrParams['company_display_name']))
				$sql .= ' AND company_display_name = "'.$arrParams['company_display_name'].'" ';
			if (isset($arrParams['company_type_id']) && !empty($arrParams['company_type_id']))
				$sql .= ' AND company_type_id = '.$arrParams['company_type_id'];
			if (isset($arrParams['slug']) && !empty($arrParams['slug']))
				$sql .= ' AND slug = "'.$arrParams['slug'].'" ';
		}	
		$result = $this->db->query($sql);
		return $result;
	}
	
	
	public function getByWhere($condition)
	{
		$sql = 'SELECT * FROM insurance_company_master_detail WHERE '.$condition;		
		return $this->db->query($sql);
	}
	
	public function getAll()
	{
		$sql = 'SELECT * FROM insurance_company_master_detail';
		return $this->db->query($sql);
	}
	
	public function getTableName()
	{
		return 'insurance_company_master_detail';
	}
	
	public function excuteQuery($sql)
	{
		return $this->db->query($sql);
	}
}