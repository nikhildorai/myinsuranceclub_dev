<?php 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class model_buynow_count EXTENDS MIC_Model{

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}

	public function increase_count($increase_count_arr)
	{
		
		if(!empty($increase_count_arr))
		{
			
			$callSP= $this->db->query("CALL sp_incrementBuyNowCount(?);",array($increase_count_arr));
			
			
		}
	}
}
