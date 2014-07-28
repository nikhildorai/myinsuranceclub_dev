<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Company_claim_ratio_model EXTENDS Admin_Model{

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}
	
	function saveRecord($arrParams = array(), $dmodelType = 'update')
	{
		$saveRecord = false;
		if (!empty($arrParams))
		{
			$colNames = $colValues = $values = array();
			foreach ($arrParams as $k1=>$v1)
			{
				if (!in_array($k1, array('claim_ratio_id')))
				{
					$values[$k1] = trim($v1);
				}
			}
			if ($dmodelType == 'create')
			{
				if ($this->db->insert('company_claim_ratio', $values))
					$saveRecord = true;
			}
			else
			{
				$where = array('claim_ratio_id'=> $arrParams['claim_ratio_id']);
				if ($this->db->update('company_claim_ratio', $values, $where))
					$saveRecord = true;
			}
		}
		if ($saveRecord == true)
		{
			if ($dmodelType == 'create')
				return $this->db->insert_id();
			else 
				return $arrParams['claim_ratio_id'];
		}
		else
			return false;				
	}
	
	public function getTableName()
	{
		return Util::getDbPrefix().'company_claim_ratio';
	}
	
	public function excuteQuery($sql)
	{
		return $this->db->query($sql);
	}
}