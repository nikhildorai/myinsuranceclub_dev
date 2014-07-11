<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Download extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	function __construct()
	{
		// Call the Controller constructor
		parent::__construct();
		date_default_timezone_set('Asia/Kolkata');
	}
	
	
	public function index()
	{	
		redirect('home');
	}
	
	public function policy($slug = null, $field = null)
	{
		if (!empty($slug))
		{
			$slug = explode('-', $slug);
			$policy_id = end($slug);
			array_pop($slug);
			$slug = implode('-', $slug);
			//	check if policy id exists
			$where = array();
			$where[0]['field'] = 'policy_id';
			$where[0]['value'] = (int)$policy_id;
			$where[0]['compare'] = 'equal';
			$exist = $this->util->getTableData($modelName='Policy_master_model', $type="single", $where, $fields = array());
			if (!empty($exist) && $slug == $exist['slug'])
			{
				$policyModel = $exist;
								
				if (empty($field))
					$field = 'brochure';
				$this->load->helper('download');
				$folderUrl = $this->config->config['folder_path']['policy'];
				$fileUrl = $this->config->config['url_path']['policy'];
				$data = file_get_contents($fileUrl.$policyModel[$field]);
				force_download($policyModel[$field], $data);
				//if ($pol)
			}
			else
			{
				return false;
			}
			
		}
		else
		{
			$this->session->set_flashdata('message', '<p class="error_msg">Invalid record.</p>');
			$this->data['msgType'] = 'error';
			redirect(base_url());
		}	
	}
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */