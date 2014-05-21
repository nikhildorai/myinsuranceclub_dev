<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logout extends MY_Controller{
	
	public function __Construct() {
		parent::__Construct();
		$this->load->library('session');
		}
	function index() {
		$loginPath	=	base_url()."admin/login";
		$this->session->sess_destroy();
		//printpre($this->session);
		redirectTo("$loginPath");	
	}	
}
