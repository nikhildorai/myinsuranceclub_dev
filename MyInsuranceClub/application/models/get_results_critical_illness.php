<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Get_results_critical_illness EXTENDS MIC_Model{

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}
	
	public function get_results($user_input)
	{	
		$health_result_query = "CALL sp_getCriticalIllnessSearchResults(?,?)";
		
		$user_chosen_filter=array($user_input['plan_type'],$user_input['cust_age']);
		
		$health_result_data = $this->db->query($health_result_query,$user_chosen_filter);
		
		return $health_result_data->result_array();
	}

}
