<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class model_get_results_travel_insurance EXTENDS MIC_Model{

	function __construct()
	{
		parent::__construct();
	}
	
	
	public function get_search_results($user_input)
	{	
		$sessionID = $this->session->userdata('session_id');
		
		$travelsubproduct_id = '';
		
		$location_id = '';
		
		$trip_duration = '';
		
		if(isset($user_input['trip_type']))
		{
			if($user_input['trip_type'] == 'Single trip')
			{
				$travelsubproduct_id = '17';
			}
			elseif($user_input['trip_type'] == 'Annual multi-trip')
			{
				$travelsubproduct_id = '18';
			}
			elseif($user_input['trip_type'] == 'Student trip')
			{
				$travelsubproduct_id = '19';
			}
		}
		
		if(isset($user_input['trip_location']))
		{
			if($user_input['trip_location'] == 'Worldwide Including Usa/Canada')
			{
				$location_id = '1';
			}
			
			elseif($user_input['trip_location'] == 'Worldwide Excluding Usa/Canada')
			{
				$location_id = '2';
			}
			
			elseif($user_input['trip_location'] == 'Schengen Countries')
			{
				$location_id = '5';
			}
			
			elseif($user_input['trip_location'] == 'Asia')
			{
				$location_id = '8';
			}
			
		
		}
		
		
		if(isset($user_input['trip_duration']))
		{
			$trip_duration = $user_input['trip_duration'];
		}
		else 
		{
			$trip_duration = '180';
		}
		
		$TravelStoredProcedure = "CALL sp_getTravelInsuranceSearchResults(?,?,?,?,?)";
		
		$SearchResultsParameterArray = array(	
												$user_input['cust_age'],
												$user_input['family_composition'],
												$location_id,
												$trip_duration,
												$travelsubproduct_id
												);
	
		$getTravelSearchData = $this->db->query($TravelStoredProcedure,$SearchResultsParameterArray);
		$this->db->freeDBResource($this->db->conn_id);
		
		$result = $getTravelSearchData->result_array();
		/********************************* Saving Fetched Search Results ***********************************/
		
		if(!empty($result))
		{
			//$result = $getTravelSearchData->result_array();
			
			$result_string = json_encode($result);
			
			$insertSearchResultSP = "CALL sp_insertCustomerSearchResults(?,?,?)";
			
			$insertResultsArray = array ($sessionID,$user_input['cust_email'],$result_string);

			$this->db->query($insertSearchResultSP,$insertResultsArray);
			$this->db->freeDBResource($this->db->conn_id);
		}
		
		/**************************************************************************************************/
		
		return $result;
	
	}



}