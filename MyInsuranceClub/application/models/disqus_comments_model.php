<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Disqus_comments_model EXTENDS CI_Model{

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
		$this->load->library('session');
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
					if (!in_array($k1, array('guide_id')))
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
				$sql = 'INSERT INTO disqus_comments ('.$colNames.') VALUES('.$colValues.')';
			}
			else
			{
				foreach ($arrParams as $k1=>$v1)
				{
					if (!in_array($k1, array('guide_id')))
					{
						if (is_numeric($v1))
							$colValues[] = trim($k1).'='.trim($v1);
						else
							$colValues[] = trim($k1).'='.'"'.trim($v1).'"';
					}
				}
				$colValues = implode(', ', $colValues);
				$sql = 'UPDATE disqus_comments SET '.$colValues.' WHERE guide_id = '.$arrParams['guide_id'];		
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
		$sql = 'SELECT * FROM disqus_comments WHERE status !="deleted" ';
		if (!empty($arrParams))
		{
			if (isset($arrParams['title']) && !empty($arrParams['title']))
				$sql .= ' AND title LIKE "%'.$arrParams['title'].'%" ';
			if (isset($arrParams['slug']) && !empty($arrParams['slug']))
				$sql .= ' AND slug = "'.$arrParams['slug'].'"';
		}
		$sql .= ' ORDER BY title ASC, guide_id ASC ';		
		$result = $this->db->query($sql);
		return $result;
	}
	
	public function getTableName()
	{
		return 'disqus_comments';
	}
	
	public function excuteQuery($sql)
	{		
		return $this->db->query($sql);
	}
}