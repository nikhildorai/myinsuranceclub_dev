<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class model_compare_travel_policies EXTENDS MIC_Model{

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
		//$this->load->library('session');
	}
	
	public function get_comparison($variant,$annual_premium,$location_id,$age,$members,$duration)
	{
		$callStoredProcedure = "CALL sp_getTravelInsuranceCompareResults(?,?,?,?,?,?)";
		
		
			
			$compareParameters = array($annual_premium,$variant,$members,$age,$location_id,$duration);
		
	
		$getComparisonData = $this->db->query($callStoredProcedure,$compareParameters);
		
		return $getComparisonData->result_array();
	}
	


}