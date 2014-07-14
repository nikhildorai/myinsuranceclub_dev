<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class compare_health_policies EXTENDS MIC_Model{

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
		$comparison="SELECT DISTINCT i.company_shortname,p.policy_name,v.variant_name,ap.annual_premium as annual_premium,f.* 
		FROM insurance_company_master i, policy_master p,policy_variants_master v,annual_premium_health ap,policy_features_mediclaim f WHERE i.company_id=p.company_id AND p.policy_id=v.policy_id AND v.variant_id=ap.variant_id
		AND f.variant_id = ap.variant_id
		AND v.variant_id IN ($var) AND ap.annual_premium IN ($ap) AND ap.age=$age ORDER BY ap.annual_premium ASC";
		
		
		$comparison_query=$this->db->query($comparison);
		return $comparison_query->result_array();
	}

}