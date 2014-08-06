<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Guides_model EXTENDS Admin_Model{

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
		$this->load->library('session');
	}
	
	function saveRecord($arrParams = array(), $modelType = 'update')
	{
		$saveRecord = false;
		if (!empty($arrParams))
		{
			$colNames = $colValues = $values = array();
			foreach ($arrParams as $k1=>$v1)
			{
				if (!in_array($k1, array('guide_id')))
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
				$where = array('guide_id'=> $arrParams['guide_id']);
				if ($this->db->update($this->getTableName(), $values, $where))
					$saveRecord = true;
			}
		}		
		if ($saveRecord == true)
		{
			if ($modelType == 'create')
				return $this->db->insert_id();
			else 
				return $arrParams['guide_id'];
		}
		else
			return false;				
	}
	
	
	public function getAll($arrParams = array())
	{	
		$sql = 'SELECT * FROM '.$this->getTableName().' WHERE '.Guides_model::getWhere($arrParams);
		$sql .= ' ORDER BY title ASC, guide_id ASC ';	
		$result = $this->db->query($sql);
		return $result;
	}
	
	public static function getWhere($arrParams = array())
	{	
		$where = 'status !="deleted" ';
		if (!empty($arrParams))
		{
			if (isset($arrParams['title']) && !empty($arrParams['title']))
				$where .= ' AND title LIKE "%'.$arrParams['title'].'%" ';
			if (isset($arrParams['slug']) && !empty($arrParams['slug']))
				$where .= ' AND slug = "'.$arrParams['slug'].'"';
		}
		return $where;
	}
	
	
	public function getTableName()
	{
		return Util::getDbPrefix().'guides';
	}
	
	public function excuteQuery($sql)
	{		
		return $this->db->query($sql);
	}
}