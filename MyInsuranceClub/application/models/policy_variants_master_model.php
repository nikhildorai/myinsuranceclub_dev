<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Policy_variants_master_model EXTENDS Admin_Model{

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}
	
	public function get_all_insurance_company($arrParams = array())
	{	
		$sql = 'SELECT * FROM policy_variants_master WHERE company_shortname != "mic" ';
		if (!empty($arrParams))
		{
			if (array_key_exists('company', $arrParams) && !empty($arrParams['company']))
				$sql .= ' AND (company_name LIKE "%'.$arrParams['company'].'%" OR company_shortname LIKE "%'.$arrParams['company'].'%" OR company_display_name LIKE "%'.$arrParams['company'].'%") ';
			if (array_key_exists('company_type', $arrParams) && !empty($arrParams['company_type']))
				$sql .= ' AND company_type_id = '.$arrParams['company_type'];
		}
		$sql .= ' ORDER BY company_name ASC, company_type_id ASC ';
		$result = $this->db->query($sql);
		return $result;
	}
	
	
	function saveRecord($arrParams = array(), $modelType = 'update')
	{
		$saveRecord = false;
		if (!empty($arrParams))
		{
			$colNames = $colValues = $values = array();
			foreach ($arrParams as $k1=>$v1)
			{
				if (!in_array($k1, array('variant_id')))
				{
					if (is_numeric($v1))
						$values[$k1] = (int)trim($v1);
					else
						$values[$k1] = trim($v1);
				}
			}		
			if ($modelType == 'create')
			{
				if ($this->db->insert('policy_variants_master', $values))
					$saveRecord = true;
			}
			else
			{
				$where = array('variant_id'=> $arrParams['variant_id']);
				if ($this->db->update('policy_variants_master', $values, $where))
					$saveRecord = true;
			}
		}	
		if ($saveRecord == true)
		{
			if ($modelType == 'create')
				return $this->db->insert_id();
			else 
				return $arrParams['variant_id'];
		}
		else
			return false;
	}
	
	
	
	public function getByWhere($id)
	{
		$sql = 'SELECT * FROM policy_variants_master WHERE company_id = '.$id;		
		return $this->db->query($sql);
	}
	
	public function getAll()
	{
		$sql = 'SELECT * FROM policy_variants_master';
		return $this->db->query($sql);
	}
	
	public function getTableName()
	{
		return 'policy_variants_master';
	}
	
	public function excuteQuery($sql)
	{
		return $this->db->query($sql);
	}
	
	public static function getAllPolicyVariantsDetails($arrParams = array())
	{
		$sql = 'SELECT 
					i.company_id, i.company_name, i.company_display_name, i.slug as company_slug, i.status as company_status, ct.company_type_name, ct.slug as company_type_slug,
  					p.policy_id, p.policy_display_name, p.policy_name, p.status as policy_status, v.*, pr.product_name, pr.slug as product_slug, spr.sub_product_name, spr.slug as sub_product_slug
				FROM 
				  	insurance_company_master i,
				  	company_type ct,
				  	policy_master p  
				  	LEFT JOIN sub_product spr ON p.sub_product_id = spr.sub_product_id AND spr.status = "active" 
				  	LEFT JOIN product pr ON p.product_id = pr.product_id AND pr.status = "active"
				  	LEFT JOIN policy_variants_master v ON v.policy_id = p.policy_id AND v.status = "active"
				WHERE 
					i.status = "active" AND
					i.company_shortname != "mic" AND
					i.company_id = p.company_id AND
					p.product_id = pr.product_id AND
					i.company_type_id = ct.company_type_id';
		if (!empty($arrParams))
		{
			foreach ($arrParams as $k1=>$v1)
			{
				$sql .= ' AND p.'.$k1.' = '.$v1;
			}
		} 
		$ci = &get_instance();
		$result=$ci->db->query($sql);
		return $result->result_array();
	}
}