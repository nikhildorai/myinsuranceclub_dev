<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class model_get_results_mediclaim EXTENDS MIC_Model{

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
		$this->load->library('session');
	}


public function get_policy_results($user_input)
	{	
		$health_result_query = "CALL sp_getMediclaimSearchResults(?,?,?,?,?)";
		
		$user_chosen_filter=array(	$user_input['coverage_amount'],
									$user_input['plan_type'],
									$user_input['cust_age'],
									$user_input['cust_city'],
									$user_input['cust_gender']
									);
		
		$health_result_data = $this->db->query($health_result_query,$user_chosen_filter);
		
		return $health_result_data->result_array();
	}
	
}