<?php 
class MIC_Controller extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->helper('html');
        $this->load->database();
        date_default_timezone_set('Asia/Kolkata');
        $this->load->library('session');
        $this->load->helper('cookie');
        $this->load->driver('cache', array('adapter' => 'file'));
        $this->load->library('util');
        $this->load->model('visitor_information');
        $this->load->model('mic_dbtest');
        // Do whatever you want - load a model, call a function...
        if($this->input->cookie('mic_userdata'))
        {
        	$this->session->set_userdata('user_input',unserialize($this->input->cookie('mic_userdata')));
        }
    
    }
}


?>