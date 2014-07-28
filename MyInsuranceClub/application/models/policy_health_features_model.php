<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Policy_health_features_model EXTENDS Admin_Model{

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}
	
	function saveCompanyRecord($arrParams = array(), $modelType = 'update')
	{
		$saveRecord = false;
		if (!empty($arrParams))
		{
			$colNames = $colValues = $values = array();
			foreach ($arrParams as $k1=>$v1)
			{
				if (!in_array($k1, array('feature_id')))
				{
					$values[$k1] = trim($v1);
				}
			}
			if ($modelType == 'create')
			{
				if ($this->db->insert($this->getTableName(), $values))
					$saveRecord = true;
			}
			else
			{
				$where = array('feature_id'=> $arrParams['feature_id']);
				if ($this->db->update($this->getTableName(), $values, $where))
					$saveRecord = true;
			}
		}		
		if ($saveRecord == true)
		{
			if ($modelType == 'create')
				return $this->db->insert_id();
			else 
				return $arrParams['feature_id'];
		}
		else
			return false;				
	}
	
	public function getTableName()
	{
		return Util::getDbPrefix().'policy_health_features';
	}
	
	public function excuteQuery($sql)
	{
		return $this->db->query($sql);
	}
}