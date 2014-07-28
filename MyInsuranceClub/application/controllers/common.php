<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Common extends Common_Controller {
	public function getTags($term = null)
	{
		if (!empty($term))
		{
			$arrParams['name'] = $term;
			$records 	= $this->master_tags_model->getAll($arrParams);
			if ($records->num_rows() > 0)
			{
				foreach ($records->result_array() as $k=>$v)
				{
					if ($v['status'] == 'active')
					{
						$response[$k]['label'] = !empty($v['tag_for']) ? $v['tag_for'].' - '.$v['name'].' - '.$v['comments'] : $v['name'];
						$response[$k]['value'] = $v['name'];
					}
				}
				echo json_encode($response);
			}
		}
	}
}

/* End of file common.php */
/* Location: ./application/controllers/common.php */