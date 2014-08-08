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
				case 'news':
					$tableName = $dbPrefix.'news';
					$whereFieldName = 'slug';
					$whereFieldValue = $arrParams['record'];
				break;
				case 'guides':
					$tableName = $dbPrefix.'guides';
					$whereFieldName = 'slug';
					$whereFieldValue = $arrParams['record'];
				break;
				case 'articles':
					$tableName = $dbPrefix.'articles';
					$whereFieldName = 'slug';
					$whereFieldValue = $arrParams['record'];
				break;
				default :
					$data = array();
				break;
			}
			$where = array('table_name'=>$tableName, 'where_field_name'=>$whereFieldName, 'where_field_value'=>$whereFieldValue);
			$recordData = Util::callStoreProcedure('sp_getSingleRecordFromTable', $where);
		
			if (!empty($recordData))
			{
				$recordData = reset($recordData);
				$oldRating = $recordData['rating_value'];
				$oldRatingTotalValue = $recordData['rating_total_value'];
				$oldRatingClickCount = $recordData['rating_click_count'];
				
				$newRatingTotalValue = $oldRatingTotalValue + $arrParams['currentRatingValue'];
				$newRatingClickCount = $oldRatingClickCount +1;
				$newRating = number_format($newRatingTotalValue/$newRatingClickCount,1);
				Util::callStoreProcedure('sp_updateRatingValuesForRecords', array('table_name'=>$tableName, 'where_field_name'=>$whereFieldName, 'where_field_value'=>$whereFieldValue,'rating_click_count'=>$newRatingClickCount, 'rating_total_value'=>$newRatingTotalValue, 'rating_value'=>$newRating));
				$data = array('rating_click_count'=>$newRatingClickCount, 'rating_total_value'=>$newRatingTotalValue, 'rating_value'=>$newRating);
			}		
		}
		echo json_encode($data);
	}
	
	public function ajaxImageUpload()
	{
		define ("MAX_SIZE","9000"); 
		$valid_formats = array("jpg", "png", "gif", "bmp","jpeg");
		$ci =& get_instance();
//var_dump($_FILES, $_POST);
		if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
		{
			$fileConfig = Util::getConfigForFileUpload('temp');
			$uploaddir = $fileConfig['temp']['upload_path']; //a directory inside
			$uploadUrl = $fileConfig['temp']['upload_url']; //a directory inside
//var_dump($_FILES);			
			foreach ($_FILES['photos']['name'] as $name => $value)
			{
				$filename = stripslashes($_FILES['photos']['name'][$name]);
				$size=filesize($_FILES['photos']['tmp_name'][$name]);
				//get the extension of the file in a lower case format
				$ext = Util::getFileExtension($filename);
				$ext = strtolower($ext);

				if(in_array($ext,$valid_formats))
				{
					if ($size < (MAX_SIZE*1024))
					{
						$time = time();
						$image_name = $time.$filename;
						echo "<img src='".$uploadUrl.$image_name."' class='imgList1'>";
						$newname = $uploaddir.$image_name;
						 
						if (move_uploaded_file($_FILES['photos']['tmp_name'][$name], $newname))
						{
							$time=time();
							//mysql_query("INSERT INTO user_uploads(image_name,user_id_fk,created) VALUES('$image_name','$session_id','$time')");
						}
						else
						{
							echo '<span class="imgList">You have exceeded the size limit! so moving unsuccessful! </span>';
						}

					}
		   else
		   {
		   	echo '<span class="imgList">You have exceeded the size limit!</span>';

		   }
		    
				}
				else
				{
					echo '<span class="imgList">Unknown extension!</span>';
					 
				}
				 
			}
		}

	}
}

/* End of file common.php */
/* Location: ./application/controllers/common.php */