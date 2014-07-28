<?php 
class MIC_Controller extends CI_Controller {
 function __construct()
    {
        parent::__construct();
        
       
        $this->load->driver('cache', array('adapter' => 'file'));
        date_default_timezone_set('Asia/Kolkata');
        // Do whatever you want - load a model, call a function...
    }
}


?>