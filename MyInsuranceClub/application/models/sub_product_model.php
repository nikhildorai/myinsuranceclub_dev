<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sub_product_model EXTENDS Admin_Model{

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}
	
	function saveCompanyRecord($arrParams = array(), $modelType = 'update')
	{
		$saveRecord = false;
		$db = &get_instance();
		if (!empty($arrParams))
		{
			$colNames = $colValues = $values = array();
			foreach ($arrParams as $k1=>$v1)
			{
				if (!in_array($k1, array('sub_product_id')))
				{
					if (is_numeric($v1))
						$values[$k1] = (int)trim($v1);
					else
						$values[$k1] = trim($v1);
				}
			}		
			if ($modelType == 'create')
			{
				if ($db->db->insert($this->getTableName(), $values))
					$saveRecord = true;
			}
			else
			{
				$where = array('sub_product_id'=> $arrParams['sub_product_id']);
				if ($db->db->update($this->getTableName(), $values, $where))
					$saveRecord = true;
			}
		}	
		if ($saveRecord == true)
		{
			if ($modelType == 'create')
				return $db->db->insert_id();
			else 
				return $arrParams['sub_product_id'];
		}
		else
			return false;
	}
	
	public function getTableName()
	{
		return Util::getDbPrefix().'sub_product';
	}
	
	public function excuteQuery($sql)
	{		
		return $this->db->query($sql);
	}
}