<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Comments extends Admin_Controller {
 
    function __construct() 
    {
        parent::__construct();
		// Load required CI libraries and helpers.
		$this->load->model('disqus_threads_model');
		$this->load->model('disqus_comments_model');
	}

	public function index()
	{
		$this->load->library('table');
		$this->load->library('pagination');
		$arrParams 	= array();
		if (isset($_GET))
			$arrParams = $_GET;
		$this->data['search_query'] = $arrParams;
		// Set any returned status/error messages..		
		$this->data['message'] = (! isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];
		$this->session->set_flashdata('message','');		
		$this->data['records'] 	= $this->disqus_threads_model->getAll($arrParams);

		//	pagination
		$config = $this->util->get_pagination_params();
		$config['total_rows'] 	= $this->data['records']->num_rows();
		$this->pagination->initialize($config); 		
		
		$this->template->write_view('content', 'admin/comments/index', $this->data, TRUE);
		$this->template->render();
	}
	
	public function updateComments()
	{
		require('application/controllers/admin/cron.php');
		$cron = new Cron;
		if ($cron->getCommentsFromDisqus())
		{
			$this->session->set_flashdata('message', '<p class="status_msg">Comments backed up successfully.</p>');
			$this->data['msgType'] = 'success';
		}
		else 
		{
			$this->session->set_flashdata('message', '<p class="error_msg">Communication error. Comments could not be backed up.</p>');
			$this->data['msgType'] = 'error';
		}
		redirect('admin/comments/index');
	}
}

/* End of file auth_lite.php */
/* Location: ./application/controllers/auth_lite.php */