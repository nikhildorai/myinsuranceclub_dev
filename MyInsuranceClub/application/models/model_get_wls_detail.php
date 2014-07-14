<?php


if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class model_get_wls_detail EXTENDS MIC_Model{

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}

	public function get_wls($host)
	{
		try 
		{
			
			$wls_query= $this->db->query("CALL sp_getWLS(?);",array($host));
			
			return $wls_query->result_array();
		}
		catch (Exception $ex)
		{
			//log exception
			return null;
		}
	}
}