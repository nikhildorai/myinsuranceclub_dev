<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class City EXTENDS CI_Model{

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}

	public function get_city()
	{
		$city_query= $this->db->query("CALL sp_getCityList()");
		return $city_query->result_array();
	}
}