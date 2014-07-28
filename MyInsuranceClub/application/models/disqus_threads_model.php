<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Disqus_threads_model EXTENDS Admin_Model{

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
				if (!in_array($k1, array('id')))
				{
					if (is_numeric($v1))
						$values[$k1] = (int)trim($v1);
					else
						$values[$k1] = trim($v1);
				}
			}
			if ($modelType == 'create')
			{
				if ($this->db->insert('disqus_threads', $values))
					$saveRecord = true;
			}
			else
			{
				$where = array('id'=> $arrParams['id']);
				if ($this->db->update('disqus_threads', $values, $where))
					$saveRecord = true;
			}
		}
		if ($saveRecord == true)
		{
			if ($modelType == 'create')
				return $this->db->insert_id();
			else 
				return $arrParams['id'];
		}
		else
			return false;				
	}
	
	public function getTableName()
	{
		return Util::getDbPrefix().'disqus_threads';
	}
	
	public function excuteQuery($sql)
	{		
		return $this->db->query($sql);
	}
}