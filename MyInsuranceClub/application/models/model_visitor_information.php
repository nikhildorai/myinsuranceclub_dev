<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class model_visitor_information EXTENDS MIC_Model{

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
		
	}
	
	
	public function get_user_info($user_info)
	{	
			$user_data="CALL sp_inputUserInfo(?,?,?,?,?,?)";
			
			$this->db->query($user_data,array(	$user_info['session_id'],
												$user_info['referrer'],
												$user_info['device'],
												$user_info['os'],
												$user_info['browser'],
												$user_info['timestamp']
												)
							);
	}

}