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
		$city="SELECT DISTINCT c.city_id,c.mic_city_name from city c ORDER BY c.mic_city_name (Mumbai,Kolkata) ASC";
		$city_query= $this->db->query($city);
		return $city_query->result_array();
	}
}