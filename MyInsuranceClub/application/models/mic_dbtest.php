<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mic_dbtest EXTENDS CI_Model{

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
		$this->load->library('session');
	}
	
	public function get_coverage_amount()
	{
		$get_cvg_amt= "SELECT DISTINCT sum_assured FROM annual_premium_health WHERE sum_assured !=0";
		$cvg_amt= $this->db->query($get_cvg_amt);
		return $cvg_amt->result_array();
	}
	
	public function get_user_info($user_info)
	{	
			
			//$user_location=mysql_real_escape_string($user_info['location']);
			$insert_user_info="INSERT INTO visitor_information(sessions_id,visitor_referrer_site,visitor_device,visitor_os,visitor_browser,visitor_entry_time) VALUES('$user_info[session_id]','$user_info[referrer]','$user_info[device]','$user_info[os]','$user_info[browser]','$user_info[timestamp]')";
			$this->db->query($insert_user_info);
	}
	
	
	public function customer_personal_search_details($user_input)
	{
		if($user_input['cust_gender']=='male')
		{
			$cust_gend ='2';
		}
		else
		{
			$cust_gend ='3';
		}
		$session_id= $this->session->userdata('session_id');
		$insert_customer_details=" INSERT INTO customer_details(cust_session_id,cust_firstname,cust_middlename,cust_lastname,
		cust_email_id,cust_phone,cust_dob,cust_age,cust_gender,cust_city) VALUES('$session_id','$user_input[first_name]','$user_input[middle_name]','$user_input[last_name]',
		'$user_input[cust_email]','$user_input[cust_mobile]','$user_input[cust_birthdate]','$user_input[cust_age]','$cust_gend','$user_input[cust_city]')";
		
		$this->db->query($insert_customer_details);
		
		$plantype='';
		if($user_input['plan_type']=='1'){$plantype='Individual';}else{$plantype='Family Floater';}
		$insert_customer_search_details="INSERT INTO customer_search_details(session_id,product_name,product_type,plan_type,coverage_amount,policy_term)
		VALUES('$session_id','$user_input[product_name]','$user_input[product_type]','$plantype','$user_input[coverage_amount]',1)";
		
		$this->db->query($insert_customer_search_details);
	}
	
	
	public function get_policy_results($user_input)
	{	
		$get_policy="SELECT i.company_shortname,p.policy_name,ap.annual_premium,ap.age,ap.sum_assured,ap.service_tax,ap.final_premium,f.cashless_treatment,f.preexisting_diseases,f.maternity,
					ap.no_of_members,v.variant_name,f.autorecharge_SI,f.pre_hosp,f.post_hosp,f.day_care,f.check_up,f.ayurvedic,f.co_pay FROM insurance_company_master i,policy_health_master p, annual_premium_health ap,
					 policy_health_features f,policy_health_variants v WHERE i.company_id=p.company_id AND p.policy_id=v.policy_id AND v.variant_id=f.variant_id
					AND ap.term = 1";
	
		/* Filtering data based on $user_input */
		
		if($user_input['plan_type']!='')		/* Filter based on Individual/Family Composition */
		{
			if($user_input['plan_type']=='myself')
			{
				$get_policy.=" AND ap.no_of_members='1A'";
			}
			elseif($user_input['plan_type']=='2')
			{
				 
				if((!isset($user_input['child'])) && $user_input['adult']=='2')
				{
					$get_policy.=" AND ap.no_of_members='2A'";
				}
				elseif(isset($user_input['child']))
				{
					if($user_input['adult']=='1' && $user_input['child']=='1')
				 	{
				 		$get_policy.=" AND ap.no_of_members='1A1C'";
				    }
				 	elseif($user_input['adult']=='1' && $user_input['child']=='2')
				 	{
				 		$get_policy.=" AND ap.no_of_members='1A2C'";
					}
					elseif($user_input['adult']=='1' && $user_input['child']=='3')
					{
				 		$get_policy.=" AND ap.no_of_members='1A3C'";
				    }
				 	elseif($user_input['adult']=='1' && $user_input['child']=='4')
				 	{
				 		$get_policy.=" AND ap.no_of_members='1A4C'";
					}
					elseif($user_input['adult']=='2' && $user_input['child']=='1')
					{
				 		$get_policy.=" AND ap.no_of_members='2A1C'";
					}	
					elseif($user_input['adult']=='2' && $user_input['child']=='2')
					{
					 	$get_policy.=" AND ap.no_of_members='2A2C'";
				    }
				 	elseif($user_input['adult']=='2' && $user_input['child']=='3')
				 	{
				 		$get_policy.=" AND ap.no_of_members='2A3C'";
				 	}
				 	elseif($user_input['adult']=='2' && $user_input['child']=='4')
				 	{
				 		$get_policy.=" AND ap.no_of_members='2A4C'";
				 	}												
				}	
				 	
				 	
			}		/* Filter based on individual/family composition ends*/
		}										
		
		if($user_input['coverage_amount']!='') /* Filter based on coverage amount */
		{
			
			if($user_input['coverage_amount']=='Below 1 Lakh')
			{
				$get_policy.=" AND ap.sum_assured <= 100000";
			}
			
			 elseif($user_input['coverage_amount']=='1 Lakh')
			{
				$get_policy.=" AND ap.sum_assured BETWEEN 100000 AND 190000";
			}
			
			elseif($user_input['coverage_amount']=='2 Lakhs')
			{
				$get_policy.=" AND ap.sum_assured BETWEEN 200000 AND 290000";
			}
			elseif($user_input['coverage_amount']=='3 Lakhs')
			{
				$get_policy.=" AND ap.sum_assured BETWEEN 300000 AND 390000";
			}
			elseif($user_input['coverage_amount']=='4 Lakhs')
			{
				$get_policy.=" AND ap.sum_assured BETWEEN 400000 AND 500000";
			}
			elseif($user_input['coverage_amount']=='5 Lakhs')
			{
				$get_policy.=" AND ap.sum_assured BETWEEN 500000 AND 590000";
			}
			elseif($user_input['coverage_amount']=='7.5 Lakhs')
			{
				$get_policy.=" AND ap.sum_assured BETWEEN 700000 AND 790000";
			} 
			elseif($user_input['coverage_amount']=='10 Lakhs')
			{
				$get_policy.=" AND ap.sum_assured BETWEEN 1000000 AND 1090000";
			}
			elseif($user_input['coverage_amount']=='15 Lakhs')
			{
				$get_policy.=" AND ap.sum_assured BETWEEN 1500000 AND 1990000";
			}
			elseif($user_input['coverage_amount']=='20 Lakhs')
			{
				$get_policy.=" AND ap.sum_assured BETWEEN 2000000 AND 4990000";
			}
			elseif($user_input['coverage_amount']=='50 Lakhs')
			{
				$get_policy.=" AND ap.sum_assured = 5000000";
			}
			
		}
		
		/* Filter based on coverage amount */
		 	
		/* Filter based on policy_term */
		/* if($user_input['policy_term']!='')
		{
			$get_policy.=" AND ap.term =".$user_input['policy_term'];
		} */
		/* Filter based on policy_term ends*/
	
		/* Filter based on customer age*/
		if(isset($user_input['cust_age']))
		{
			$get_policy.=" AND ap.age =".$user_input['cust_age'];
		}
		/* Filter based on customer gender */
		if($user_input['cust_gender']!='')
		{
			if($user_input['cust_gender']== 'male')
			{
				
				$get_policy.=" AND ap.gender_id !=3";
				
			}
			if($user_input['cust_gender']== 'female')
			{
				$get_policy.=" AND ap.gender_id !=2 ";
			}
		}
		$get_data=$this->db->query($get_policy);
		return $get_data->result_array();
	}
}