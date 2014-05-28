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
		$CI =& get_instance();
		$config =  $CI->config->config['pagination'];
		
		$pageUrl = $this->getUrl().'?';
		if (isset($_SERVER['QUERY_STRING']) &&!empty($_SERVER['QUERY_STRING']))
		{
			$qString = explode('&', $_SERVER['QUERY_STRING']);			
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
	
	public function getCompanyTypeDropDownOptions($modelName ='Company_type_model', $optionKey = 'company_type_id', $optionValue = 'company_type_name', $defaultEmpty = "Please Select")
	{
		$result = $this->getTableData($modelName, $type="all", $id='', $fields = array());		
		$options[''] = $defaultEmpty;
		foreach ($result as $k1=>$v1)
		{
			$options[$v1[$optionKey]] = $v1[$optionValue];
		}		
		return $options;
	}
}

// END Util class

/* End of file Calendar.php */
/* Location: ./system/libraries/Util.php */