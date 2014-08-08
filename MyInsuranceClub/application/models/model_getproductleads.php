<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class model_getproductleads EXTENDS Admin_Model{

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}
	
	
	public function getProductLeads($productName = '')
	{
		$callProductLeadsSP = "CALL sp_getProductLeads()";
		
		$getLeads = $this->db->query($callProductLeadsSP);
		
		return $getLeads->result_array();
	}
}
