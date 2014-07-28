<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product_model EXTENDS Admin_Model{

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
				if (!in_array($k1, array('product_id')))
				{
					if (is_numeric($v1))
						$values[$k1] = (int)trim($v1);
					else
						$values[$k1] = trim($v1);
				}
			}		
			if ($modelType == 'create')
			{
				if ($db->db->insert('product', $values))
					$saveRecord = true;
			}
			else
			{
				$where = array('product_id'=> $arrParams['product_id']);
				if ($db->db->update('product', $values, $where))
					$saveRecord = true;
			}
		}	
		if ($saveRecord == true)
		{
			if ($modelType == 'create')
				return $db->db->insert_id();
			else 
				return $arrParams['product_id'];
		}
		else
			return false;
	}

	public function getAll($arrParams = array())
	{	
		$sql = 'SELECT * FROM '.$this->getTableName().' WHERE status !="deleted" ';
		if (!empty($arrParams))
		{
			if (isset($arrParams['product_name']) && !empty($arrParams['product_name']))
				$sql .= ' AND product_name LIKE "%'.$arrParams['product_name'].'%" ';
		}
		$sql .= ' ORDER BY product_name ASC, product_id ASC ';	
		$result = $this->db->query($sql);
		return $result;
	}
	
	public function getTableName()
	{
		return Util::getDbPrefix().'product';
	}
	
	public function excuteQuery($sql)
	{		
		return $this->db->query($sql);
	}
}