<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Compare_critical_illness_policies EXTENDS MIC_Model{

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
		$comparison="SELECT DISTINCT i.company_shortname,p.policy_name,v.variant_name,concat('Rs.',ap.annual_premium,'.00') as annual_premium, 
					f.policy_renewable as 'Policy Renewable Age Limit',f.medical_test_age as 'No Medical Test Age',
					f.tax_benifits as 'Tax Benefits',f.cancer as 'Cancer',f.cabg as 'Coronary Artery Bypass Surgery',
					f.myocardial_infraction as 'Myocardial Infraction',f.kidney_faliure as 'Kidney Faliure',f.obt as 'Organ/Bonemarrow Transplant',
					f.stroke as stroke,f.ags as 'Aorta Graft Surgery',f.ppah as 'Primary Pulmonary Arterial Hypertension',f.ms as 'Multiple Scleriosis',
					f.ppl as 'Permenant Paralysis of Limbs',f.cad as 'Coronary Artery Disease',f.opr as 'Open Heart Replacement',
					f.aplastic_anemia as 'Aplastic Anemia',f.e_lu_d as 'End Stage Lung Disease',f.e_li_d as 'End Stage Liver Disease',
					f.coma as Coma,f.major_burns as 'Major Burns',f.mnd as 'Motor Neuron Disease',f.ti as 'Terminal Illness',
					f.bm as 'Bacterial Meningitis',f.parkinsons as Parkinsons,f.blindness as 'Blindness',f.speech_loss as 'Speech Loss',
					f.deafness as Deafness,f.md as 'Muscular Dystrophy',f.paraplegia as Paraplegia,f.hepatoma as Hepatoma,f.ovarian_c as 'ovarian cancer',
					f.vaginal_c as 'vaginal cancer',f.breast_c as 'breast cancer',f.cervical as 'cervical cancer',f.endometrial_c as 'endometrial cancer',f.fallopian_tube_c as 'fallopian tube cancer',f.burns,f.paralysis_multitrauma
					FROM insurance_company_master i, policy_master p,
		policy_variants_master v,annual_premium_critical_illness ap,policy_features_critical_illness f WHERE i.company_id=p.company_id AND p.policy_id=v.policy_id AND v.variant_id=ap.variant_id
		AND f.variant_id = ap.variant_id
		AND v.variant_id IN ($var) AND ap.annual_premium IN ($ap) AND ap.age=$age ORDER BY ap.annual_premium ASC";
		$comparison_query=$this->db->query($comparison);
		return $comparison_query->result_array();
	}

}