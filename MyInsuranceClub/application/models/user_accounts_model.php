<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_accounts_model EXTENDS Admin_Model{

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}
	
	public function getTableName()
	{
		return Util::getDbPrefix().'user_accounts';
	}
	
	public function excuteQuery($sql)
	{		
		return $this->db->query($sql);
	}
}