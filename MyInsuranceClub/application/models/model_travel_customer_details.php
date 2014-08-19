<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class model_travel_customer_details EXTENDS MIC_Model{

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}
	
	
	
	public function insert_customer_details($user_input)
	{
		$UniqueUserID = uniqid();
		
		$sessionsID = $this->session->userdata('session_id');
		
		$NumberOfMembers = '';
		
		$AdditionalMembers = array();
		
		if(isset($user_input['family_composition']))
		{
			if($user_input['family_composition'] == '1A')
			{
				$NumberOfMembers = 'Individual';
			}
			elseif($user_input['family_composition'] == '2A')
			{
				$NumberOfMembers = 'Couple';
			}
			else
			{
				$NumberOfMembers = 'Family';
			}
		}
		
		$spouse_birthdate = '';
		
		$spouse_age = '';
		
		$spouse_gender = '';
		
		if(isset($user_input['spouse_birthdate']))
		{
			$spouse_birthdate = isset($user_input['spouse_birthdate']) ?date("Y-m-d", strtotime(str_replace('/','-',$user_input['spouse_birthdate']))) :'';
			$spouse_age = $user_input['spouse_age'];
			$spouse_gender = $user_input['spouse_gender'];
		}
		else 
		{
			$spouse_birthdate = '';
			$spouse_age = '';
			$spouse_gender = '';
		}
		
		
		$birthdate_format = isset($user_input['cust_birthdate']) ?date("Y-m-d", strtotime(str_replace('/','-',$user_input['cust_birthdate']))) :'';
		

		$TripStartDate = isset($user_input['trip_start']) ?date("Y-m-d", strtotime(str_replace('/','-',$user_input['trip_start']))) :'';
		
		$TripEndDate = isset($user_input['trip_end']) ?date("Y-m-d", strtotime(str_replace('/','-',$user_input['trip_end']))) :'';
		
		$trip_duration = '';
		
		$trip_End = '';
		
		if($user_input['trip_type'] == 'Annual multi-trip')
		{
			$trip_duration = '365 days';
			
			$trip_End = date("Y-m-d",strtotime("$TripStartDate + 365 days"));
			
		}
		else 
		{
			$trip_duration = $user_input['trip_duration'];
			
			$trip_End = $TripEndDate;
		}
		
		for($i = 3;$i <= 7;$i++)
		{
			if(isset($user_input['traveller_'.$i.'_dob']) && isset($user_input['traveller_'.$i.'_age']) && isset($user_input['traveller_'.$i.'_gender'])) 
			{
				$AdditionalMembers['Member_'.$i]['dob'] = $user_input['traveller_'.$i.'_dob'];
				$AdditionalMembers['Member_'.$i]['age']= $user_input['traveller_'.$i.'_age'];
				$AdditionalMembers['Member_'.$i]['gender']= $user_input['traveller_'.$i.'_gender'];
			}
		}
		
		$combineAdditionalMembersInfo = '';
		
		if (!empty($AdditionalMembers))
		{
			$combineAdditionalMembersInfo = json_encode($AdditionalMembers);
		}
		else 
		{
			$combineAdditionalMembersInfo = '';
		}
		
		$StoredProcedure = "CALL sp_insertTravelCustomerDetails(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
		
		$TravelCustomerDetailsArray = array($sessionsID,
											$UniqueUserID,
											$user_input['full_name'],
											$user_input['first_name'],
											$user_input['middle_name'],
											$user_input['last_name'],
											$user_input['cust_gender'],
											$birthdate_format,
											$user_input['cust_age'],
											$user_input['cust_email'],
											$user_input['cust_mobile'],
											$spouse_birthdate,
											$spouse_age,
											$spouse_gender,
											$combineAdditionalMembersInfo,
											$user_input['product_name'],
											$user_input['product_type'],
											$NumberOfMembers,
											$user_input['trip_type'],
											$user_input['trip_location'],
											$TripStartDate,
											$trip_End,
											$trip_duration
											);
		
		$this->db->query($StoredProcedure,$TravelCustomerDetailsArray);
		
		
	}
}