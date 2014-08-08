<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class model_customer_personal_and_search_details EXTENDS MIC_Model{

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
		$this->load->library('session');
	}
	
	
	public function customer_personal_search_details($user_input)
	{
		$UniqueUserID = uniqid();
		
		$customer_info_array = array();
		
		$customer_search_info_array = array();
		
		$plantype='';
		
		if (array_key_exists('plan_type', $user_input))
		{
			if(trim($user_input['plan_type']) == '1A')
			{
				$plantype='Individual';
			}
			else
			{
				$plantype='Family Floater';
			}
		}
		
		$session_id= $this->session->userdata('session_id');
		
		$birthdate_format = isset($user_input['cust_birthdate']) ?date("Y-m-d", strtotime(str_replace('/','-',$user_input['cust_birthdate']))) :'';
		
		if(isset($user_input['cust_city_name']))
		{
			$custCityAndStateArr = explode(', ',$user_input['cust_city_name']);
			
			$custCity = $custCityAndStateArr[0];
			
			$custState = $custCityAndStateArr[1];
		}
			
		if(trim($user_input['product_type']) == 'Mediclaim')
		{
			$customer_info_array = array(	$session_id,
											$UniqueUserID,
											$user_input['first_name'],
											$user_input['middle_name'],
											$user_input['last_name'],
											$user_input['cust_email'],
											$user_input['cust_mobile'],
											$birthdate_format,
											$user_input['cust_age'],
											$user_input['cust_gender'],
											$custCity,
											$custState,
											$user_input['product_type'],
											$user_input['product_name'],
											$user_input['coverage_amount'],
											$plantype,
											1,
											''
										);
		
		}
		
		elseif(trim($user_input['product_type']) == 'Critical Illness')
		{
			$customer_info_array = array(	$session_id,
											$UniqueUserID,
											$user_input['first_name'],
											$user_input['middle_name'],
											$user_input['last_name'],
											$user_input['cust_email'],
											$user_input['cust_mobile'],
											$birthdate_format,
											$user_input['cust_age'],
											'',
											'',
											'',
											$user_input['product_type'],
											$user_input['product_name'],
											'',
											$plantype,
											1,
											''
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
											'',
											'',
											'',
											'',
											'',
											''
										);
		
		/* 	$customer_search_info_array = array(	$session_id,
													'',
													$user_input['product_name'],
													$user_input['product_type'],
													$plantype,
													'',
													1
												); */
		}
		elseif(trim($user_input['product_type']) == 'Term Plan')
		{
			$customer_info_array = array(	$session_id,
											$UniqueUserID,
											$user_input['first_name'],
											$user_input['middle_name'],
											$user_input['last_name'],
											$user_input['cust_email'],
											$user_input['cust_mobile'],
											$birthdate_format,
											$user_input['cust_age'],
											$user_input['cust_gender'],
											$custCity,
											$custState,
											$user_input['product_type'],
											$user_input['product_name'],
											$user_input['coverage_amount_term'],
											'',
											$user_input['policy_term'],
											$user_input['smoker']
											);
		
			/* $customer_search_info_array = array(	$session_id,
													$user_input['cust_email'],
													$user_input['product_name'],
													$user_input['product_type'],
													'',
													$user_input['coverage_amount_term'],
													$user_input['policy_term']
													); */
		}
		$cust_personal_data="CALL sp_insertCustomerPersonalDetails(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);";
		
		$this->db->query($cust_personal_data,$customer_info_array);
		
	}
	
	
	
	
	
	
}