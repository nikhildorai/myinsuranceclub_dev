<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Policy_health_master_model EXTENDS CI_Model{

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
		$this->load->library('session');
	}
	
	public function get_all_policy($arrParams = array())
	{	
		$sql = 'SELECT * FROM policy_health_master WHERE status="active" ';
		if (!empty($arrParams))
		{
			if (isset($arrParams['policy_name']) && !empty($arrParams['policy_name']))
				$sql .= ' AND policy_name LIKE "%'.$arrParams['policy_name'].'%" ';
			if (isset($arrParams['company_id']) && !empty($arrParams['company_id']))
				$sql .= ' AND company_id = '.$arrParams['company_id'];
			if (isset($arrParams['type_health_plan']) && !empty($arrParams['type_health_plan']))
				$sql .= ' AND type_health_plan = '.$arrParams['type_health_plan'];
		}
		$sql .= ' ORDER BY policy_name ASC, type_health_plan ASC ';	
		$result = $this->db->query($sql);
		return $result;
	}
	
	function saveCompanyRecord($arrParams = array(), $modelType = 'update')
	{
		if (!empty($arrParams))
		{
			$colNames = $colValues = array();
			if ($modelType == 'create')
			{
				foreach ($arrParams as $k1=>$v1)
				{
					if (!in_array($k1, array('company_id')))
					{
						$colNames[] = trim($k1);
						if (is_numeric($v1))
							$colValues[] = trim($v1);
						else
							$colValues[] = '"'.trim($v1).'"';
					}
				}
				$colNames = implode(', ', $colNames);
				$colValues = implode(', ', $colValues);
				$sql = 'INSERT INTO policy_health_master ('.$colNames.') VALUES('.$colValues.')';
			}
			else
			{
				foreach ($arrParams as $k1=>$v1)
				{
					if (!in_array($k1, array('company_id')))
					{
						if (is_numeric($v1))
							$colValues[] = trim($k1).'='.trim($v1);
						else
							$colValues[] = trim($k1).'='.'"'.trim($v1).'"';
					}
				}
				$colValues = implode(', ', $colValues);
				$sql = 'UPDATE policy_health_master SET '.$colValues.' WHERE company_id = '.$arrParams['company_id'];
//var_dump($arrParams, $colValues, $sql);die;				
			}		
			if ($this->db->query($sql))
				return true;
			else 
				return false;
		}
		else
			return FALSE;
	}
	
	public function getInsuranceCompany($arrParams)
	{	
		$sql = 'SELECT * FROM policy_health_master WHERE status = "active"';
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
//var_dump($sql);		
		$result = $this->db->query($sql);
		return $result;
	}
	
	
	public function getById($id)
	{
		$sql = 'SELECT * FROM policy_health_master WHERE policy_id = '.$id;		
		return $this->db->query($sql);
	}
	
	public function getAll()
	{
		$sql = 'SELECT * FROM policy_health_master';
		return $this->db->query($sql);
	}
}