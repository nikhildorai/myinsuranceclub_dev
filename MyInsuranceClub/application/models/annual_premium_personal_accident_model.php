<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Annual_premium_personal_accident_model EXTENDS CI_Model{

	function __construct()
	{
		parent::__construct();
	}
	
	public function getTableName()
	{
		return 'annual_premium_personal_accident';
	}
	
	public function excuteQuery($sql)
	{		
		return $this->db->query($sql);
	}
	
	public function get_results($user_input)
	{	
		$health_result_query = "CALL sp_getPersonalAccidentSearchResults(?,?)";
		
		$user_chosen_filter=array($user_input['plan_type'],$user_input['cust_occupation']);
		
		$health_result_data = $this->db->query($health_result_query,$user_chosen_filter);
		
		return $health_result_data->result_array();
	}
	
	public function get_comparison($variant,$annual_premium,$age)
	{
		$comparison="SELECT DISTINCT i.company_shortname,p.policy_name,v.variant_name,concat('Rs.',ap.annual_premium,'.00') as annual_premium,f.* 
					FROM insurance_company_master i, policy_master p,
		policy_variants_master v,annual_premium_personal_accident ap,policy_features_personal_accident f WHERE i.company_id=p.company_id AND p.policy_id=v.policy_id AND v.variant_id=ap.variant_id
		AND f.variant_id = ap.variant_id
		AND v.variant_id IN ($variant)  AND ap.annual_premium IN ($annual_premium)";
		$comparison_query=$this->db->query($comparison);
		return $comparison_query->result_array();
	}
}