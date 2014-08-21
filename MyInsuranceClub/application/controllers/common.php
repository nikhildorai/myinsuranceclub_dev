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
	
	
	public function getPeerComparisionView()
	{
		$data['premium'] = $arrParams = array();
		if (!empty($_POST['policy_slug']) && !empty($_POST['variant_type']))
		{
			$this->load->model('policy_variants_master_model');
			$policySlug = $_POST['policy_slug'];
			$variantType = $_POST['variant_type'];
		
			$allVariantTypes = Util::getControllerForPolicyVariantFeatures($variantType);
			$cacheFileName[] = 'peer_comparision';
			foreach ($_POST as $k1=>$v1)
			{
				$cacheFileName[] = $v1;
			}
			$cacheFileName = implode('_', $cacheFileName);
			$cacheResult = Util::getCachedObject($cacheFileName);

			//	check if cache file exist
			if(!empty($cacheResult))
			{
				// get result set from cache
				$data = $cacheResult;
			}
			else
			{
				//get resultset from DB and save in cache
				$db = &get_instance();
				$dbPrefix = Util::getdbPrefix();
				$where = array('table_name'=>$dbPrefix.'policy_master', 'where_field_name'=>'slug', 'where_field_value'=>$policySlug);
				$details = Util::callStoreProcedure('sp_getSingleRecordFromTable', $where);
				if (!empty($details))
				{
					$details = reset($details);
	
					//	peer comparision data
					
					$dbPrefix = Util::getdbPrefix();
									
					$param['premium_table'] = (!empty($allVariantTypes['premium_table'])) ? $dbPrefix.$allVariantTypes['premium_table'] : $dbPrefix.'annual_premium_health';
					$param['product_id'] = (isset($details['product_id']) && !empty($details['product_id'])) ? $details['product_id'] : '' ;
					$param['sub_product_id'] = (isset($details['sub_product_id']) && !empty($details['sub_product_id'])) ? $details['sub_product_id'] : '' ;
					$param['city'] = 590;
					$param['gender'] = 'male';
					$param['age'] = (isset($_POST['age']) && !empty($_POST['age'])) ? $_POST['age'] : 25;
					$param['members'] = !empty($details['policy_composition_type']) ? ($details['policy_composition_type'] == 'individual') ? "1A" : '2A' : '1A';
					$param['sum_assured'] = (isset($_POST['sum_assured']) && !empty($_POST['sum_assured'])) ? $_POST['sum_assured'] : 500000;
					$param['variant_id'] = $_POST['peerComparisionVariants']; 
					
					$allVariants = Policy_variants_master_model::getAllPolicyVariantsDetails($param);
					if (!empty($allVariants))
					{
						$peerVariants = explode(',', $details['peer_comparision_variants']);
						$i = 1;
						foreach ($allVariants as $k2=>$v2)
						{
							if (in_array($k2, $peerVariants))
							{
								$data['premium'][$i] = $v2['final_premium'];
								$i++;
							}
							else 
							{
								$data['premium'][0] = $v2['final_premium'];
							}
						}
					}
				}
//				Util::saveResultToCache($cacheFileName,$data);
			}
		}
		if (!empty($data['premium']))
			ksort($data['premium']);
		$data['max'] = (max($data['premium'])) > 10000 ? max($data['premium']) : 10000;

		//	color band
		$range = round($data['max']/3,0);
		$rangeVal[0]['from'] = 0;
		$rangeVal[0]['to'] = $range;
		$rangeVal[0]['color'] = '#55BF3B';
		$rangeVal[1]['to'] = $range*2;
		$rangeVal[1]['from'] = $range;
		$rangeVal[1]['color'] = '#DDDF0D';
		$rangeVal[2]['from'] = $range*2; 
		$rangeVal[2]['to'] = $data['max']; 
		$rangeVal[2]['color'] = '#DF5353';
			
		echo json_encode($data);
		
		
	}
	
}

/* End of file common.php */
/* Location: ./application/controllers/common.php */