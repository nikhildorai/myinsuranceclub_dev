<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {

	
	public function __Construct()
	{
	   	parent::__Construct();
	   	 $this->check_isvalidated();
	}	
	public function index()
	{
		$this->viewForm($data);
	}	
	
	private function check_isvalidated(){
        if(! $this->session->userdata('validated')){
            redirect('admin/login');
        }
    }	
		
	private function viewForm($data=''){		
		$this->load->view('admin/header');		
		$this->load->view('admin/sidebar');		
		$this->load->view('admin/home', $data);		
		$this->load->view('admin/footer');				
	}
	
}

?>
