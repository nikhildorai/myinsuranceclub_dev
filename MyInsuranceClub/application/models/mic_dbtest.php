<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mic_dbtest EXTENDS CI_Model{

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
		$this->load->library('session');
	}
	
	
	/* public function get_user_info($user_info)
	{	
			$user_data="CALL sp_inputUserInfo(?,?,?,?,?,?)";
			
			$this->db->query($user_data,array(	$user_info['session_id'],
												$user_info['referrer'],
												$user_info['device'],
												$user_info['os'],
												$user_info['browser'],
												$user_info['timestamp']
												)
							);
	} */
	
	
	public function customer_personal_search_details($user_input)
	{
		$plantype='';
		
		$session_id= $this->session->userdata('session_id');
		
		$birthdate_format = date("Y-m-d", strtotime(str_replace('-','/',$user_input['cust_birthdate'])));
		
		$cust_personal_data="CALL sp_insertCustomerPersonalDetails(?,?,?,?,?,?,?,?,?,?);";
		
		$this->db->query($cust_personal_data,array(	$session_id,
													$user_input['first_name'],
													$user_input['middle_name'],
													$user_input['last_name'],
													$user_input['cust_email'],
													$user_input['cust_mobile'],
													$birthdate_format,
													$user_input['cust_age'],
													$user_input['cust_gender'],
													$user_input['cust_city']
													)
						);
		
		if($user_input['plan_type']=='1A')
		{
			$plantype='Individual';
		}
		else
		{
			$plantype='Family Floater';
		}
		
		$cust_search_data="CALL sp_insertCustomerSearchDetails(?,?,?,?,?,?,?)";
		
		$this->db->query($cust_search_data,array(	$session_id,
													$user_input['cust_email'],
													$user_input['product_name'],
													$user_input['product_type'],
													$plantype,
													$user_input['coverage_amount'],
													1
												)
						);
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