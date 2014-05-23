<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	function get_css_folder()
	{
		$CI =& get_instance();
		return $CI->config->config['css_path'];
	}
	
	function get_js_folder()
	{
		$CI =& get_instance();
		return $CI->config->config['js_path'];
	}
	
	function get_pagination_params()
	{
		$config = array();
		$config['total_rows'] 	= $this->data['records']->num_rows();
		$config['per_page'] 	=	$this->config->item('per_page');
		$config['num_links'] 	=	$this->config->item('num_links');
		$config['first_link'] = 'First';
		$config['first_tag_open'] = '<div>';
		$config['first_tag_close'] = '</div>';
		$config['last_link'] = 'Last';
		$config['last_tag_open'] = '<div>';
		$config['last_tag_close'] = '</div>';
		$config['display_pages'] = TRUE;
		return $config;
	}

// END Util class

/* End of file Calendar.php */
/* Location: ./system/libraries/Util.php */