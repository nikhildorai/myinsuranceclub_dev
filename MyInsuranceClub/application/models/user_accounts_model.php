<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_accounts_model EXTENDS CI_Model{

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
		$this->load->library('session');
		$this->load->library('form_validation');
        $this->load->helper('form');
	}
	
	function saveCompanyRecord($arrParams = array(), $modelType = 'update')
	{
		if (!empty($arrParams))
		{
			$colNames = $colValues = array();
			if ($modelType == 'create')
			{
				foreach ($arrParams as $k1=>$v1)
				{
					if (!in_array($k1, array('user_accounts_id')))
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
				$sql = 'INSERT INTO user_accounts ('.$colNames.') VALUES('.$colValues.')';
			}
			else
			{
				foreach ($arrParams as $k1=>$v1)
				{
					if (!in_array($k1, array('user_accounts_id')))
					{
						if (is_numeric($v1))
							$colValues[] = trim($k1).'='.trim($v1);
						else
							$colValues[] = trim($k1).'='.'"'.trim($v1).'"';
					}
				}
				$colValues = implode(', ', $colValues);
				$sql = 'UPDATE user_accounts SET '.$colValues.' WHERE user_accounts_id = '.$arrParams['user_accounts_id'];
//var_dump($arrParams, $colValues, $sql);die;				
			}		
			if ($this->db->query($sql))
				return true;
			else 
				return false;
		}
		else
			return FALSE;
	}
	
	public function getTableName()
	{
		return 'user_accounts';
	}
	
	public function excuteQuery($sql)
	{		
		return $this->db->query($sql);
	}
}