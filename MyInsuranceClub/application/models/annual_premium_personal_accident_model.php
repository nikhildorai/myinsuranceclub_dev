<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Annual_premium_personal_accident_model EXTENDS CI_Model{

	function __construct()
	{
		parent::__construct();
	}
	
	public function getTableName()
	{
		return 'annual_premium_personal_accident';
	}
	
	public function excuteQuery($sql)
	{		
		return $this->db->query($sql);
	}
	
	public function get_results($user_input)
	{	
		$health_result_query = "CALL sp_getPersonalAccidentSearchResults(?,?)";
		
		$user_chosen_filter=array($user_input['plan_type'],$user_input['cust_occupation']);
		
		$health_result_data = $this->db->query($health_result_query,$user_chosen_filter);
		
		return $health_result_data->result_array();
	}
}