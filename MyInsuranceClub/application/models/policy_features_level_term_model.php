<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Policy_features_level_term_model EXTENDS MIC_Model{

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}
	
	public static function saveRecord($arrParams = array(), $modelType = 'update')
	{
		$saveRecord = false;
		$db = &get_instance();
		if (!empty($arrParams))
		{
			$colNames = $colValues = $values = array();
			foreach ($arrParams as $k1=>$v1)
			{
				if (!in_array($k1, array('feature_id')))
				{
					if (is_numeric($v1))
						$values[$k1] = (int)trim($v1);
					else
						$values[$k1] = trim($v1);
				}
			}		
			if ($modelType == 'create')
			{
				if ($db->db->insert('policy_features_level_term', $values))
					$saveRecord = true;
			}
			else
			{
				$where = array('feature_id'=> $arrParams['feature_id']);
				if ($db->db->update('policy_features_level_term', $values, $where))
					$saveRecord = true;
			}
		}	
		if ($saveRecord == true)
		{
			if ($modelType == 'create')
				return $db->db->insert_id();
			else 
				return $arrParams['feature_id'];
		}
		else
			return false;
	}
	
	
	public function getAll($arrParams = array())
	{	
		$sql = 'SELECT * FROM policy_features_level_term WHERE status !="deleted" ';
		if (!empty($arrParams))
		{
			if (isset($arrParams['name']) && !empty($arrParams['name']))
				$sql .= ' AND name LIKE "%'.$arrParams['name'].'%" ';
		}
		$sql .= ' ORDER BY name ASC, feature_id ASC ';	
		$result = $this->db->query($sql);
		return $result;
	}
	
	public function getTableName()
	{
		return 'policy_features_level_term';
	}
	
	public function excuteQuery($sql)
	{		
		return $this->db->query($sql);
	}
}