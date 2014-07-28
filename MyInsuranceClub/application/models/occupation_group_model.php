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
		$saveRecord = false;
		if (!empty($arrParams))
		{
			$colNames = $colValues = $values = array();
			foreach ($arrParams as $k1=>$v1)
			{
				if (!in_array($k1, array('occupation_group_id')))
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
				$where = array('occupation_group_id'=> $arrParams['occupation_group_id']);
				if ($this->db->update($this->getTableName(), $values, $where))
					$saveRecord = true;
			}
		}		
		if ($saveRecord == true)
		{
			if ($modelType == 'create')
				return $this->db->insert_id();
			else 
				return $arrParams['occupation_group_id'];
		}
		else
			return false;				
	}
	
	
	public function getAll($arrParams = array())
	{	
		$sql = 'SELECT * FROM '.$this->getTableName().' WHERE status !="deleted" ';
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
		return Util::getDbPrefix().'occupation_group';
	}
	
	public function excuteQuery($sql)
	{		
		return $this->db->query($sql);
	}
}