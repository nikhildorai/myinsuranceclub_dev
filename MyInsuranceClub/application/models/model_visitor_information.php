<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class model_visitor_information EXTENDS MIC_Model{

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
		
	}
	
	/**
	 * @abstract Checks if the current session already
	 * exists in the database. If not then the new sessions
	 * data is entered into the database.
	 * 
	 * @param unknown $user_info
	 */
	public function get_user_info($user_info)
	{	
			$CI = &get_instance();
			
			$getExistingSessionsSP = "CALL sp_getExistingSessionsID()";
			
			$getExistingSessionIds = $this->db->query($getExistingSessionsSP);
			
			
			$result  = $getExistingSessionIds->result_array();
			
			$this->db->freeDBResource($this->db->conn_id);

			$session = array();
			
			if (!empty($result)) 
			{
				foreach ($result as $k1=>$v1)
				{
					$session[] = $v1['sessions_id'];
				}
			}
			$session = array_unique(array_filter($session));
			
			if(!in_array($user_info['session_id'],$session))
			{
				
				$user_data="CALL sp_inputUserInfo(?,?,?,?,?)";
			
				$this->db->query($user_data,array(	$user_info['session_id'],
						$user_info['referrer'],
						$user_info['device'],
						$user_info['os'],
						$user_info['browser']
				)
				);
			}
			
			
	}

}