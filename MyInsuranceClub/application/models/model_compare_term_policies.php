<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class model_compare_term_policies EXTENDS MIC_Model{

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
		//$this->load->library('session');
	}
	
	public function get_comparison($variant,$annual_premium,$age,$term,$coverage_amount)
	{
		$var=implode(',',$variant);
		$ap=implode(',',$annual_premium);
		
		$call_comparison_sp = "CALL sp_getTermPlanComparisonResults(?,?,?,?,?)";
		
		$parameter_array = array($coverage_amount,$ap,$term,$age,$var);
		
		$comparison_query=$this->db->query($call_comparison_sp,$parameter_array);
		
		return $comparison_query->result_array();
	}

}