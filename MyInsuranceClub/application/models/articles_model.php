<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Articles_model EXTENDS CI_Model{

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
		$this->load->library('session');
		$this->load->library('form_validation');
        $this->load->helper('form');
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
					if (!in_array($k1, array('article_id')))
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
				$sql = 'INSERT INTO articles ('.$colNames.') VALUES('.$colValues.')';
			}
			else
			{
				foreach ($arrParams as $k1=>$v1)
				{
					if (!in_array($k1, array('article_id')))
					{
						if (is_numeric($v1))
							$colValues[] = trim($k1).'='.trim($v1);
						else
							$colValues[] = trim($k1).'='.'"'.trim($v1).'"';
					}
				}
				$colValues = implode(', ', $colValues);
				$sql = 'UPDATE articles SET '.$colValues.' WHERE article_id = '.$arrParams['article_id'];		
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
		$sql = 'SELECT * FROM articles WHERE status !="deleted" ';
		if (!empty($arrParams))
		{
			if (isset($arrParams['title']) && !empty($arrParams['title']))
				$sql .= ' AND title LIKE "%'.$arrParams['title'].'%" ';
		}
		$sql .= ' ORDER BY title ASC, article_id ASC ';	
		$result = $this->db->query($sql);
		return $result;
	}
	
	public function getTableName()
	{
		return 'articles';
	}
	
	public function excuteQuery($sql)
	{		
		return $this->db->query($sql);
	}
}