<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Insurance_company_master_model EXTENDS Admin_Model{

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}
	
	public function get_all_insurance_company($arrParams = array())
	{	
		$sql = 'SELECT * FROM '.$this->getTableName().' WHERE status != "deleted" AND company_shortname != "mic" ';
		if (!empty($arrParams))
		{
			if (array_key_exists('company', $arrParams) && !empty($arrParams['company']))
				$sql .= ' AND (company_name LIKE "%'.$arrParams['company'].'%" OR company_shortname LIKE "'.$arrParams['company'].'%" OR company_display_name LIKE "'.$arrParams['company'].'%") ';
			if (array_key_exists('company_type', $arrParams) && !empty($arrParams['company_type']))
				$sql .= ' AND company_type_id = '.$arrParams['company_type'];
		}
		$sql .= ' ORDER BY company_name ASC, company_type_id ASC ';
		$result = $this->db->query($sql);
		return $result;
	}
	
	function saveCompanyRecord($arrParams = array(), $modelType = 'update')
	{
		$saveRecord = false;
		if (!empty($arrParams))
		{
			$colNames = $colValues = $values = array();
			foreach ($arrParams as $k1=>$v1)
			{
				if (!in_array($k1, array('company_id')))
				{
					$values[$k1] = trim($v1);
				}
			}
			if ($modelType == 'create')
			{
				if ($this->db->insert($this->getTableName(), $values))
					$saveRecord = true;
			}
			else
			{
				$where = array('company_id'=> $arrParams['company_id']);
				if ($this->db->update($this->getTableName(), $values, $where))
					$saveRecord = true;
			}
		}		
		if ($saveRecord == true)
		{
			if ($modelType == 'create')
				return $this->db->insert_id();
			else 
				return $arrParams['company_id'];
		}
		else
			return false;				
	}
	
	public function getInsuranceCompany($arrParams)
	{	
		$sql = 'SELECT * FROM '.$this->getTableName().' WHERE status != "deleted"';
		if (!empty($arrParams))
		{
			if (isset($arrParams['company_name']) && !empty($arrParams['company_name']))
				$sql .= ' AND company_name = "'.$arrParams['company_name'].'" ';
			if (isset($arrParams['company_shortname']) && !empty($arrParams['company_shortname']))
				$sql .= ' AND company_shortname = "'.$arrParams['company_shortname'].'" ';
			if (isset($arrParams['company_display_name']) && !empty($arrParams['company_display_name']))
				$sql .= ' AND company_display_name = "'.$arrParams['company_display_name'].'" ';
			if (isset($arrParams['company_type_id']) && !empty($arrParams['company_type_id']))
				$sql .= ' AND company_type_id = '.$arrParams['company_type_id'];
			if (isset($arrParams['slug']) && !empty($arrParams['slug']))
				$sql .= ' AND slug = "'.$arrParams['slug'].'" ';
		}	
		$result = $this->db->query($sql);
		return $result;
	}
	
	
	public function getByWhere($condition)
	{
		$sql = 'SELECT * FROM '.$this->getTableName().' WHERE '.$condition;		
		return $this->db->query($sql);
	}
	
	public function getAll()
	{
		$sql = 'SELECT * FROM '.$this->getTableName();
		return $this->db->query($sql);
	}
	
	public function getTableName()
	{
		return Util::getDbPrefix().'insurance_company_master';
	}
	
	public function excuteQuery($sql)
	{
		return $this->db->query($sql);
	}


	public function get_insurance_companies($arrParams)
	{	
		$query = "CALL sp_getInsuranceCompany(?,?)";
		
		$queryData = array($arrParams['company_type_slug'],$arrParams['company_slug']);
		
		$resultData = $this->db->query($query,$queryData);
		if (!empty($resultData))
			return $resultData->result_array();
		else 
			return array();
	}

	public function get_single_insurance_company_all_details($arrParams)
	{	
		$query = "CALL sp_getSingleInsuranceCompanyAllDetails(?)";
		
		$queryData = array($arrParams['company_slug']);
		
		$resultData = $this->db->query($query,$queryData);
		if (!empty($resultData))
			return $resultData->result_array();
		else 
			return array();
	}
	
	public function callStoreProcedure($type, $arrParams = array())
	{
		$query = '';
		
		if ($type == 'singleCompanyAllDetails')
			$query = "CALL sp_getSingleInsuranceCompanyAllDetails(?)";
		else if ($type == 'singleCompanyDetails')
			$query = "CALL sp_getSingleInsuranceCompanyDetails(?)";
		else if ($type == 'allPolicyOfSingleCompany')
			$query = "CALL sp_getAllPolicyOfSingleCompany(?)";
			
		$queryData = $arrParams;
		
		$resultData = $this->db->query($query,$queryData);
		if (!empty($resultData))
			return $resultData->result_array();
		else 
			return array();
	}

	public static function getSingleInsuranceCompanyDetails($arrParams)
	{
		$data = $data['claimRatio'] = $data['companyDetails'] = $policies = $policy = array();
		if (!empty($arrParams))
		{
			$cacheFileName = 'company';
			foreach ($arrParams as $k1=>$v1)
			{
				if (!empty($v1))
					$cacheFileName .= '_'.$v1;
			}
			$cacheResult = Util::getCachedObject($cacheFileName);			
			//	check if cache file exist
			if(!empty($cacheResult))
			{
				// get result set from cache
				$details = $cacheResult;
			}
			else
			{
				//get resultset from DB and save in cache
				$db = &get_instance();
				unset($arrParams['company_type_slug']);
				$details = $db->insurance_company_master_model->callStoreProcedure($type = 'singleCompanyAllDetails', $arrParams);
				Util::saveResultToCache($cacheFileName,$details);
			}
			$data['companyDetails'] = reset($details);
			if (!isset($data['companyDetails']['claim_ratio']))
				$data['claimRatio'] = array();
			else 
				$data['claimRatio'] = $details;
			
			//	get all the plans for a single company
			if (!empty($data['companyDetails']))
			{
				$arrParams = array();
				$arrParams['company_id'] = $data['companyDetails']['company_id'];
				$cacheFileName .= '_all_policies';	
				$cacheResult = Util::getCachedObject($cacheFileName);				
				//	check if cache file exist
				if(!empty($cacheResult))
				{
					// get result set from cache
					$policies = $cacheResult;
				}
				else
				{
					//get resultset from DB and save in cache
					$db = &get_instance();
					$db->db->freeDBResource($db->db->conn_id);
					$policy = $db->insurance_company_master_model->callStoreProcedure($type = 'allPolicyOfSingleCompany', $arrParams);
					if (!empty($policy))
					{
						foreach ($policy as $k1=>$v1)
						{
							if ($v1['company_type_slug'] == 'life-insurance')
							{
								$policyUrl = $v1['company_type_slug'].'/companies/'.$v1['company_slug'].'/'.$v1['slug'];
							}
							else
							{
								if (!empty($v1['product_slug']) && $v1['product_slug'] == 'health-insurance')
									$policyUrl = $v1['product_slug'].'/'.$v1['slug'];
								else if (!empty($v1['sub_product_slug']))
									$policyUrl = $v1['sub_product_slug'].'/'.$v1['slug'];
								else if (!empty($v1['product_slug']))
									$policyUrl = $v1['product_slug'].'/'.$v1['slug'];
							} 
							$policies[$v1['product_name']]['product_slug'] = $v1['product_slug'];
							$policies[$v1['product_name']]['product_name'] = $v1['product_name'];
							$policies[$v1['product_name']]['sub_product_slug'] = $v1['sub_product_slug'];
							$policies[$v1['product_name']]['sub_product_name'] = $v1['sub_product_name'];
							$policies[$v1['product_name']]['policy'][$k1] = $v1;
							$policies[$v1['product_name']]['policy'][$k1]['policy_url'] = $policyUrl;
						}
					}
					Util::saveResultToCache($cacheFileName,$policies);
				}
				$data['policies'] = $policies;
			}
		
			//	seo data
	        $data['seoData']['title'] = $data['companyDetails']['seo_title'];
	        $data['seoData']['keywords'] = $data['companyDetails']['seo_keywords'];
	        $data['seoData']['description'] = $data['companyDetails']['seo_description'];
		}
		return $data;
	}
	

	public static function getInsuranceCompaniesByCompanyType($arrParams)
	{
		$data = array();
		if (!empty($arrParams))
		{	
			$cacheFileName = 'company_';
			foreach ($arrParams as $k1=>$v1)
			{
				if (!empty($v1))
					$cacheFileName .= $v1;
			}
			$cacheResult = Util::getCachedObject($cacheFileName);
			//	check if cache file exist
			if(!empty($cacheResult))
			{
				// get result set from cache
				$data['companyDetails']=$cacheResult;
			}
			else
			{
				//get resultset from DB and save in cache
				$db = &get_instance();
				$data['companyDetails']=$db->insurance_company_master_model->get_insurance_companies($arrParams);
				Util::saveResultToCache($cacheFileName,$data['companyDetails']);
			}
		}
		return $data;
	}
}