<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class model_get_stored_sessions_data EXTENDS MIC_Model{

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}

	public function get_stored_userData($cookieID)
	{
		$getCookieData = $this->db->query("CALL sp_getStoredSessionsData(?)",array($cookieID));
		
		return $getCookieData->result_array();
		
		//var_dump($getCookieData->result_array());
		//exit;
	}
}