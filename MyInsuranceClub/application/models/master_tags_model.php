<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Master_tags_model EXTENDS MIC_Model{

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
		$this->load->library('session');
		$this->load->library('form_validation');
        $this->load->helper('form');
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
				if (!in_array($k1, array('tag_id')))
				{
					if (is_numeric($v1))
						$values[$k1] = (int)trim($v1);
					else
						$values[$k1] = trim($v1);
				}
			}		
			if ($modelType == 'create')
			{
				if ($db->db->insert('master_tags', $values))
					$saveRecord = true;
			}
			else
			{
				$where = array('tag_id'=> $arrParams['tag_id']);
				if ($db->db->update('master_tags', $values, $where))
					$saveRecord = true;
			}
		}	
		if ($saveRecord == true)
		{
			if ($modelType == 'create')
				return $db->db->insert_id();
			else 
				return $arrParams['tag_id'];
		}
		else
			return false;
	}
	
	
	public function getAll($arrParams = array())
	{	
		$sql = 'SELECT * FROM master_tags WHERE status !="deleted" ';
		if (!empty($arrParams))
		{
			if (isset($arrParams['name']) && !empty($arrParams['name']))
				$sql .= ' AND name LIKE "%'.$arrParams['name'].'%" ';
		}
		$sql .= ' ORDER BY name ASC, tag_id ASC ';	
		$result = $this->db->query($sql);
		return $result;
	}
	
	public function getTableName()
	{
		return 'master_tags';
	}
	
	public function excuteQuery($sql)
	{		
		return $this->db->query($sql);
	}
}