<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Common extends Common_Controller {
	
    function __construct() 
    {
        parent::__construct();
		// Load required CI libraries and helpers.
		$this->load->model('master_tags_model');
 		
	}
	
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
	
	/**
	 * 
	 * update rating for any table
	 */
	public function rating()
	{
		$data = array();
		$tableName = $updateFieldName = $whereFieldName = $whereFieldValue = $count = '';
		if (!empty($_POST))
		{
			$arrParams['ratingType'] = $ratingTYpe = $_POST['ratingType'];
			$arrParams['currentRatingValue'] = (float)$_POST['hoverRating']; 
			$arrParams['record'] = $_POST['record'];
			$dbPrefix = Util::getdbPrefix();
			switch ($ratingTYpe)
			{
				case 'policy':
					$tableName = $dbPrefix.'policy_master';
					$whereFieldName = 'slug';
					$whereFieldValue = $arrParams['record'];
				break;
				default :
					$data = array();
				break;
			}
			$recordData = Util::callStoreProcedure('sp_getSingleRecordFromTable', array('table_name'=>$tableName, 'where_field_name'=>$whereFieldName, 'where_field_value'=>$whereFieldValue));
			if (!empty($recordData))
			{
				$recordData = reset($recordData);
				$oldRating = $recordData['rating_value'];
				$oldRatingTotalValue = $recordData['rating_total_value'];
				$oldRatingClickCount = $recordData['rating_click_count'];
				
				$newRatingTotalValue = $oldRatingTotalValue + $arrParams['currentRatingValue'];
				$newRatingClickCount = $oldRatingClickCount +1;
				$newRating = number_format($newRatingTotalValue/$newRatingClickCount,2);
				Util::callStoreProcedure('sp_updateRatingValuesForRecords', array('table_name'=>$tableName, 'where_field_name'=>$whereFieldName, 'where_field_value'=>$whereFieldValue,'rating_click_count'=>$newRatingClickCount, 'rating_total_value'=>$newRatingTotalValue, 'rating_value'=>$newRating));
				$data = array('rating_click_count'=>$newRatingClickCount, 'rating_total_value'=>$newRatingTotalValue, 'rating_value'=>$newRating);
			}		
		}
		echo json_encode($data);
	}
}

/* End of file common.php */
/* Location: ./application/controllers/common.php */