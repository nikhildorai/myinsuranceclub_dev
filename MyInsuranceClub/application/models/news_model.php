<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News_model EXTENDS Admin_Model{

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
					if (!in_array($k1, array('news_id')))
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
				$sql = 'INSERT INTO news ('.$colNames.') VALUES('.$colValues.')';
			}
			else
			{
				foreach ($arrParams as $k1=>$v1)
				{
					if (!in_array($k1, array('news_id')))
					{
						if (is_numeric($v1))
							$colValues[] = trim($k1).'='.trim($v1);
						else
							$colValues[] = trim($k1).'='.'"'.trim($v1).'"';
					}
				}
				$colValues = implode(', ', $colValues);
				$sql = 'UPDATE news SET '.$colValues.' WHERE news_id = '.$arrParams['news_id'];		
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
		$sql = 'SELECT * FROM news WHERE status !="deleted" ';
		if (!empty($arrParams))
		{
			if (isset($arrParams['title']) && !empty($arrParams['title']))
				$sql .= ' AND title LIKE "%'.$arrParams['title'].'%" ';
			if (isset($arrParams['slug']) && !empty($arrParams['slug']))
				$sql .= ' AND slug = "'.$arrParams['slug'].'"';
		}
		$sql .= ' ORDER BY title ASC, news_id ASC ';		
		$result = $this->db->query($sql);
		return $result;
	}
	
	public function getTableName()
	{
		return 'news';
	}
	
	public function excuteQuery($sql)
	{		
		return $this->db->query($sql);
	}
}