<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Policy_variants_master extends Admin_Controller {
 
    function __construct() 
    {
        parent::__construct();
		$this->load->model('company_claim_ratio_model');
	}

}

/* End of file auth_lite.php */
/* Location: ./application/controllers/auth_lite.php */