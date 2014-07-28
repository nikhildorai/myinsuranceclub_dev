<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Articles_model EXTENDS Admin_Model{

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
				if (!in_array($k1, array('article_id')))
				{
					if (is_numeric($v1))
						$values[$k1] = (int)trim($v1);
					else
						$values[$k1] = trim($v1);
				}
			}
			if ($modelType == 'create')
			{
				if ($this->db->insert('articles', $values))
					$saveRecord = true;
			}
			else
			{
				$where = array('article_id'=> $arrParams['article_id']);
				if ($this->db->update('articles', $values, $where))
					$saveRecord = true;
			}
		}
		if ($saveRecord == true)
		{
			if ($modelType == 'create')
				return $this->db->insert_id();
			else 
				return $arrParams['article_id'];
		}
		else
			return false;				
	}
	
	
	public function getAll($arrParams = array())
	{	
		$sql = 'SELECT * FROM '.$this->getTableName().' WHERE '.Articles_model::getWhere();
		$sql .= ' ORDER BY title ASC, article_id ASC ';	
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
		return Util::getDbPrefix().'articles';
	}
	
	public function excuteQuery($sql)
	{		
		return $this->db->query($sql);
	}
}