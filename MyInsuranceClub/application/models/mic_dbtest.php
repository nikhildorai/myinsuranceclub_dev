<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mic_dbtest EXTENDS CI_Model{

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
		$this->load->library('session');
	}
	
	
	public function customer_personal_search_details($user_input)
	{
		$customer_info_array = array();
		
		$customer_search_info_array = array();
		
		$plantype='';
		
		if(trim($user_input['plan_type']) == '1A')
		{
			$plantype='Individual';
		}
		else
		{
			$plantype='Family Floater';
		}
		
		$session_id= $this->session->userdata('session_id');
		
		$birthdate_format = date("Y-m-d", strtotime(str_replace('-','/',$user_input['cust_birthdate'])));
		
		if(trim($user_input['product_type']) == 'Mediclaim')
		{
			$customer_info_array = array(	$session_id,
											$user_input['first_name'],
											$user_input['middle_name'],
											$user_input['last_name'],
											$user_input['cust_email'],
											$user_input['cust_mobile'],
											$birthdate_format,
											$user_input['cust_age'],
											$user_input['cust_gender'],
											$user_input['cust_city']
										);
		
			$customer_search_info_array = array(	$session_id,
													$user_input['cust_email'],
													$user_input['product_name'],
													$user_input['product_type'],
													$plantype,
													$user_input['coverage_amount'],
													1
												);
		}
		
		elseif(trim($user_input['product_type']) == 'Critical Illness')
		{
			$customer_info_array = array(	$session_id,
											'',
											'',
											'',
											'',
											'',
											$birthdate_format,
											$user_input['cust_age'],
											$user_input['cust_gender'],
											''
										);
		
			$customer_search_info_array = array(	$session_id,
													'',
													$user_input['product_name'],
													$user_input['product_type'],
													$plantype,
													'',
													1
												);
		}
		
		elseif(trim($user_input['product_type']) == 'Personal Accident')
		{
			$customer_info_array = array(	$session_id,
											'',
											'',
											'',
											'',
											'',
											$birthdate_format,
											$user_input['cust_age'],
											$user_input['cust_gender'],
											''
										);
		
			$customer_search_info_array = array(	$session_id,
													'',
													$user_input['product_name'],
													$user_input['product_type'],
													$plantype,
													'',
													1
												);
		}
		$cust_personal_data="CALL sp_insertCustomerPersonalDetails(?,?,?,?,?,?,?,?,?,?);";
		
		$this->db->query($cust_personal_data,$customer_info_array);
		
		$cust_search_data="CALL sp_insertCustomerSearchDetails(?,?,?,?,?,?,?)";
		
		$this->db->query($cust_search_data,$customer_search_info_array);
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