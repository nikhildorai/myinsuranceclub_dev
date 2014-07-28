<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Occupation_group_model EXTENDS Admin_Model{

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}
	
	function saveRecord($arrParams = array(), $modelType = 'update')
	{		
		if (!empty($arrParams))
		{
			$colNames = $colValues = array();
			if ($modelType == 'create')
			{
				foreach ($arrParams as $k1=>$v1)
				{
					if (!in_array($k1, array('occupation_group_id')))
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
				$sql = 'INSERT INTO occupation_group ('.$colNames.') VALUES('.$colValues.')';
			}
			else
			{
				foreach ($arrParams as $k1=>$v1)
				{
					if (!in_array($k1, array('occupation_group_id')))
					{
						if (is_numeric($v1))
							$colValues[] = trim($k1).'='.trim($v1);
						else
							$colValues[] = trim($k1).'='.'"'.trim($v1).'"';
					}
				}
				$colValues = implode(', ', $colValues);
				$sql = 'UPDATE occupation_group SET '.$colValues.' WHERE occupation_group_id = '.$arrParams['occupation_group_id'];		
			}		
			if ($this->db->query($sql))
				return true;
			else 
				return false;
		}
		else
			return FALSE;
	}
	
	
	public function getAll($arrParams = array())
	{	
		$sql = 'SELECT * FROM occupation_group WHERE status !="deleted" ';
		if (!empty($arrParams))
		{
			if (isset($arrParams['group_name']) && !empty($arrParams['group_name']))
				$sql .= ' AND group_name LIKE "'.$arrParams['group_name'].'%" ';
			if (isset($arrParams['slug']) && !empty($arrParams['slug']))
				$sql .= ' AND slug = "'.$arrParams['slug'].'"';
		}
		$sql .= ' ORDER BY group_name ASC, occupation_group_id ASC ';		
		$result = $this->db->query($sql);
		return $result;
	}
	
	public function getTableName()
	{
		return 'occupation_group';
	}
	
	public function excuteQuery($sql)
	{		
		return $this->db->query($sql);
	}
}