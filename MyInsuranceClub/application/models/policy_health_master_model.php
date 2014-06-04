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
		$sql = 'SELECT * FROM policy_health_master WHERE status !="deleted" ';
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
	
	function saveRecord($arrParams = array(), $modelType = 'update')
	{
		$saveRecord = false;
		if (!empty($arrParams))
		{
			$colNames = $colValues = $values = array();
			foreach ($arrParams as $k1=>$v1)
			{
				if (!in_array($k1, array('policy_id', 'variant')))
				{
					if (is_numeric($v1))
						$values[$k1] = (int)trim($v1);
					else
						$values[$k1] = trim($v1);
				}
			}
			if ($modelType == 'create')
			{
				if ($this->db->insert('policy_health_master', $values))
					$saveRecord = true;
			}
			else
			{
				$where = array('policy_id'=> $arrParams['policy_id']);
				if ($this->db->update('policy_health_master', $values, $where))
					$saveRecord = true;
			}
		}	
		if ($saveRecord == true)
		{
			if ($modelType == 'create')
				return $this->db->insert_id();
			else 
				return $arrParams['policy_id'];
		}
		else
			return false;
	}
	
	public function getPolicy($arrParams)
	{	
		$sql = 'SELECT * FROM policy_health_master WHERE status = "active"';
		if (!empty($arrParams))
		{
			if (isset($arrParams['policy_name']) && !empty($arrParams['policy_name']))
				$sql .= ' AND policy_name = "'.$arrParams['policy_name'].'" ';
			if (isset($arrParams['company_id']) && !empty($arrParams['company_id']))
				$sql .= ' AND company_id = '.$arrParams['company_id'];
			if (isset($arrParams['type_health_plan']) && !empty($arrParams['type_health_plan']))
				$sql .= ' AND type_health_plan = "'.$arrParams['type_health_plan'].'" ';
		}
		$result = $this->db->query($sql);
		return $result;
	}
	
	
	public function getByWhere($id)
	{
		$sql = 'SELECT * FROM policy_health_master WHERE policy_id = '.$id;		
		return $this->db->query($sql);
	}
	
	public function getAll()
	{
		$sql = 'SELECT * FROM policy_health_master';
		return $this->db->query($sql);
	}
	
	public function getTableName()
	{
		return 'policy_health_master';
	}
	
	public function excuteQuery($sql)
	{
		return $this->db->query($sql);
	}
}