<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class model_compare_critical_illness_policies EXTENDS MIC_Model{

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
		$this->load->library('session');
	}

	public function get_comparison($variant,$annual_premium,$age)
	{
		$var=implode(',',$variant);
		$ap=implode(',',$annual_premium);
		
		$callComparisonSP = "CALL sp_getCriticalIllnessComparisonResults(?,?,?)";
		
		$comparisonParam = array($var,$ap,$age);
		
		$comparison_query=$this->db->query($callComparisonSP,$comparisonParam);
		return $comparison_query->result_array();
	}

}