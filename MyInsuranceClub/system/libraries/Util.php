<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Util {

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
		$config['per_page'] 	=	10;
		$config['num_links'] 	=	5;
		$config['first_link'] 	= 	'First';
		$config['first_tag_open'] = '<div>';
		$config['first_tag_close'] = '</div>';
		$config['last_link'] = 'Last';
		$config['last_tag_open'] = '<div>';
		$config['last_tag_close'] = '</div>';
		$config['display_pages'] = TRUE;
		$config['page_query_string'] = TRUE;
		$pageUrl = $this->getUrl().'?';
		if (isset($_SERVER['QUERY_STRING']) &&!empty($_SERVER['QUERY_STRING']))
		{
			$qString = explode('&', $_SERVER['QUERY_STRING']);
//var_dump($qString);			
			foreach ($qString as $k1=>$v1)
			{
				if (reset(explode('=', $v1)) != 'per_page' && !empty($v1))
					$pageUrl .= '&'.$v1;
			}
		}	
		$config['base_url'] 	= $pageUrl;
		return $config;
	}
	
	function getUrl($type = 'currentUrl')
	{
		$value = base_url();
		$url = (isset($_SERVER['HTTPS']) ? "https://" : "http://") . $_SERVER['HTTP_HOST'] .$_SERVER['REQUEST_URI'];
		
		if ($type == 'currentUrl' )
			$value = reset(explode('?', $url));
		else if ($type == 'currentPageUrl')
			$value = $url;
	//	$router =& load_class('Router', 'core');
	//	$uri = & load_class('URI','core');
	//	$router->fetch_class();
	//	$router->fetch_method();
	//	$router->fetch_module();
		return $value;
	}
	
	function getTableData($modelName = '', $type="all", $id = null, $fields = array('id'))
	{
		$result = $value = null;
		$model = &get_instance();
		$model->load->model($modelName);
		if ($type == 'single' && !empty($id))
		{
			$result = $model->$modelName->getById($id);
		}
		else if ($type == 'all')
		{
			$result = $model->$modelName->getAll($id);
		}	
		if ($result->num_rows > 0)
		{
			$i = 0;
			foreach ($result->result_array() as $k1=>$v1)
			{			
				if (!empty($v1))
				{	
					if ($type == 'all')
					{
						$value[$i] = $v1;
					}
					else if (in_array($type, array('single')) && !empty($fields) )
					{			
						$value[$i] = array_intersect_key($v1, array_flip($fields));
					}
					else if (in_array($type, array('single')) && empty($fields) )
					{			
						$value = $v1;
					}
				}
				$i++;
			}
		}
		return $value;
	}
	
	public function getCompanyTypeDropDownOptions($defaultEmpty = "Please Select", $optionType = null)
	{
		$result = $this->getTableData($modelName='Company_type_model', $type="all", $id='', $fields = array());		
		$options[''] = $defaultEmpty;
		foreach ($result as $k1=>$v1)
		{
			if (!empty($optionType))
			{
				//defined later
			}
			else 
			{
				$options[$v1['company_type_id']] = $v1['company_type_name'];
			}
		}		
		return $options;
	}
}

// END Util class

/* End of file Calendar.php */
/* Location: ./system/libraries/Util.php */