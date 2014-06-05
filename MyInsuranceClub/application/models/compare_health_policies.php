<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class compare_health_policies EXTENDS CI_Model{

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
		$comparison="SELECT i.company_shortname,p.policy_name,v.variant_name,concat('Rs.',ap.annual_premium,'.00') as annual_premium,f.cashless_treatment,concat(round(0.01*ap.sum_assured),'/day') as 'Room Rent',concat(round(0.02*ap.sum_assured),'/day') as 'Icu Rent',
					f.preexisting_diseases,f.autorecharge_SI,f.maternity,f.pre_hosp as 'Pre-Hospitalisation',f.post_hosp as 'Post-Hospitalisation',f.day_care,f.check_up,f.ayurvedic,f.co_pay FROM insurance_company_master i, policy_health_master p,
		policy_health_variants v,annual_premium_health ap,policy_health_features f WHERE i.company_id=p.company_id AND p.policy_id=v.policy_id AND v.variant_id=ap.variant_id
		AND f.variant_id = ap.variant_id
		AND v.variant_id IN ($var) AND ap.annual_premium IN ($ap) AND ap.age=$age";
		$comparison_query=$this->db->query($comparison);
		return $comparison_query->result_array();
	}

}