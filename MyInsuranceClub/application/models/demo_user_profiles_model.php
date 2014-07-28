<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Demo_user_profiles_model EXTENDS Admin_Model{

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}

	
	public function getAll()
	{
		$sql = 'SELECT * FROM demo_user_profiles';
		return $this->db->query($sql);
	}
	
	public function getTableName()
	{
		return 'demo_user_profiles';
	}
	
	public function excuteQuery($sql)
	{
		return $this->db->query($sql);
	}
}