<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class model_get_results_term_plan EXTENDS MIC_Model{

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}
	
	public function get_results($user_input)
	{	
		$term_plan_sp = "CALL sp_getTermPlanSearchResults(?,?,?,?,?)";
		
		$user_form_data =	array(	$user_input['coverage_amount'],
									$user_input['policy_term'],
									$user_input['cust_gender'],
									$user_input['cust_age'],
									$user_input['smoker']
								);
		
		$termplan_result_data = $this->db->query($term_plan_sp,$user_form_data);
		
		return $termplan_result_data->result_array();
	}

}

