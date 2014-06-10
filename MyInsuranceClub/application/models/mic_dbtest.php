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
	
	
	public function get_policy_results($user_input,$search_filter)
	{	
		$get_policy="SELECT ap.variant_id,ap.ap_id,i.company_id,i.public_private_health,ap.age,i.company_shortname,p.policy_name,ap.annual_premium,ap.age,ap.sum_assured,ap.service_tax,ap.final_premium,f.cashless_treatment,
					f.preexisting_diseases,f.maternity,ap.no_of_members,v.variant_name,f.autorecharge_SI,f.pre_hosp,f.post_hosp,f.day_care,f.check_up,f.ayurvedic,
					f.co_pay,f.room_rent,f.icu_rent,f.doctor_fee 
					         FROM 
					               insurance_company_master i,policy_health_master p, annual_premium_health ap, policy_health_features f,policy_health_variants v,zone z,company_city_zone ccz 
							WHERE 
					               i.company_id=p.company_id AND p.policy_id=v.policy_id AND v.variant_id=f.variant_id AND v.variant_id=ap.variant_id AND ap.zone=z.zone_id AND z.zone_id=ccz.zone_id AND ap.term=1";
		/* FILTER DATA USING USER INPUT */
		
		if($user_input['plan_type']!='')		/* Filter based on Individual/Family Composition */
		{
			if($user_input['plan_type']=='1A')
			{
				$get_policy.=" AND ap.no_of_members='1A'";		//indivudual
			}
			elseif($user_input['plan_type']=='2A')				
			{
				$get_policy.=" AND ap.no_of_members='2A'";		//couple
			}
			elseif($user_input['plan_type']=='1A1C')
			{
				$get_policy.=" AND ap.no_of_members='1A1C'";	//self+1child
			}
			elseif($user_input['plan_type']=='1A2C')
			{
				$get_policy.=" AND ap.no_of_members='1A2C'";	//self+2children		
			}
			elseif($user_input['plan_type']=='1A3C')
			{
				$get_policy.=" AND ap.no_of_members='1A3C'";	//self+3children
			}
			elseif($user_input['plan_type']=='1A4C')		
			{
				$get_policy.=" AND ap.no_of_members='1A4C'";	//self+4children
			}
			
			
			elseif($user_input['plan_type']=='2A1C')
			{
				$get_policy.=" AND ap.no_of_members='2A1C'";	//self+spouse+1child
			}
			elseif($user_input['plan_type']=='2A2C')
			{
				$get_policy.=" AND ap.no_of_members='2A2C'";	//self+spouse+2children
			}
			elseif($user_input['plan_type']=='2A3C')
			{
				$get_policy.=" AND ap.no_of_members='2A3C'";	//self+spouse+3children
			}
			elseif($user_input['plan_type']=='2A4C')
			{
				$get_policy.=" AND ap.no_of_members='2A4C'";	//self+spouse+4children
			}	 	
			/* Filter ends */
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
				$get_policy.=" AND ap.sum_assured BETWEEN 400000 AND 490000";
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
			
		}/* Filter ends */
		
		
		 	
		/* Filter based on policy_term */
		/* if($user_input['policy_term']!='')
		{
			$get_policy.=" AND ap.term =".$user_input['policy_term'];
		} */
		/* Filter based on policy_term ends*/
	
		
		if(isset($user_input['cust_age']))	/* Filter based on customer age*/
		{
			$get_policy.=" AND ap.age =".$user_input['cust_age'];
		}	/* Filter ends */
		
		
		if($user_input['cust_gender']!='') /* Filter based on policyholder gender*/
		{
			if($user_input['cust_gender']== 'male')
			{
				
				$get_policy.=" AND ap.gender_id !=3";
				
			}
			if($user_input['cust_gender']== 'female')
			{
				$get_policy.=" AND ap.gender_id !=2 ";
			}/* Filter ends */
		}
		if($user_input['cust_city']!='')
		{
			$get_policy.=" AND ccz.city_id = ".$user_input['cust_city'];
		}
		/* Search Filters obtained from  Users */
		
		if($this->input->is_ajax_request())
		{
		if(count($search_filter)>0)
		{
			if(isset($search_filter['room_rent']))
			{
				$get_policy.=" AND f.room_rent='Fully Covered' AND f.icu_rent='Fully Covered' AND doctor_fee='Fully Covered'";
			}
			if(isset($search_filter['maternity']))
			{
				$get_policy.=" AND f.maternity!='Not Covered'";
			}
			if(isset($search_filter['precover']))
			{
				$preexisting_diseases =implode(',',$search_filter['precover']);
				$get_policy .=" AND f.preexisting_diseases IN ($preexisting_diseases)";
			}
			if(isset($search_filter['sector']))
			{
				$sector=implode(',',$search_filter['sector']);
				$get_policy .=" AND i.public_private_health IN($sector)";
			}
			if(isset($search_filter['company_name']))
			{
				$company = implode(',',$search_filter['company_name']);
				$get_policy .=" AND i.company_id IN ($company)";
			}
		}
		}
		$get_data=$this->db->query($get_policy);
		return $get_data->result_array();
	}
}