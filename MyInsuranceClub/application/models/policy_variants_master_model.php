<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Policy_variants_master_model EXTENDS Admin_Model{

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}
	
	public function get_all_insurance_company($arrParams = array())
	{	
		$sql = 'SELECT * FROM '.$this->getTableName().' WHERE company_shortname != "mic" ';
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
	
	
	function saveRecord($arrParams = array(), $modelType = 'update')
	{
		$saveRecord = false;
		$this->db->freeDBResource($this->db->conn_id);
		if (!empty($arrParams))
		{
			$colNames = $colValues = $values = array();
			foreach ($arrParams as $k1=>$v1)
			{
				if (!in_array($k1, array('variant_id')))
				{
					if (is_numeric($v1))
						$values[$k1] = (int)trim($v1);
					else
						$values[$k1] = trim($v1);
				}
			}		
			if ($modelType == 'create')
			{
				if ($this->db->insert('policy_variants_master', $values))
					$saveRecord = true;
			}
			else
			{
				$where = array('variant_id'=> $arrParams['variant_id']);
				if ($this->db->update('policy_variants_master', $values, $where))
					$saveRecord = true;
			}
		}	
		if ($saveRecord == true)
		{
			if ($modelType == 'create')
				return $this->db->insert_id();
			else 
				return $arrParams['variant_id'];
		}
		else
			return false;
	}
	
	
	
	public function getByWhere($id)
	{
		$sql = 'SELECT * FROM '.$this->getTableName().' WHERE company_id = '.$id;		
		return $this->db->query($sql);
	}
	
	public function getAll()
	{
		$sql = 'SELECT * FROM '.$this->getTableName();
		return $this->db->query($sql);
	}
	
	public function getTableName()
	{
		return Util::getDbPrefix().'policy_variants_master';
	}
	
	public function excuteQuery($sql)
	{
		return $this->db->query($sql);
	}
	
	public static function getAllPolicyVariantsDetails($arrParams = array())
	{
//var_dump($arrParams);die;		
		$return = array();
		$result = Util::callStoreProcedure('getAllPolicyVariantsDetails', $arrParams);

		if (!empty($result))
		{
			foreach ($result as $k1=>$v1)
			{
				if (!empty($return[$v1['variant_id']]))
				{
					if ($return[$v1['variant_id']]['annual_premium'] > $v1['annual_premium'])
						$return[$v1['variant_id']] = $v1;
				}
				else 
				{
					$return[$v1['variant_id']] = $v1;
				}
			}		
		}
//var_dump($arrParams, $result, $return);die;		
		return $return;
	}
}