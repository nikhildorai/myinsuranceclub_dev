<?php 
class MIC_Controller extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        
       
        $this->load->driver('cache', array('adapter' => 'file'));
        date_default_timezone_set('Asia/Kolkata');
        
        // Do whatever you want - load a model, call a function...
        if($this->input->cookie('mic_userdata'))
        {
        	
        	//$this->session->set_userdata('user_input',unserialize($this->input->cookie('mic_userdata')));
        	
        	$cookie_id = $this->input->cookie('mic_userdata');
        	
        	$returned_array = $this->model_get_stored_sessions_data->get_stored_userData($cookie_id);
        	
        	$this->db->freeDBResource($this->db->conn_id);
        	
        	if(isset($returned_array[0]['user_data']))
        	{
        		$get_sess = unserialize($returned_array[0]['user_data']);
        	
        		$this->session->set_userdata('user_input',$get_sess['user_input']);
        	}
        		
        }
    
    }
}


?>