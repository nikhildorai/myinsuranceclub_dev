<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Guides_model EXTENDS Admin_Model{

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
		$this->load->library('session');
	}
	
	function saveRecord($arrParams = array(), $modelType = 'update')
	{
		$saveRecord = false;
		if (!empty($arrParams))
		{
			$colNames = $colValues = $values = array();
			foreach ($arrParams as $k1=>$v1)
			{
				if (!in_array($k1, array('guide_id')))
				{
					$values[$k1] = trim($v1);
				}
			}
			if ($modelType == 'create')
			{
				if ($this->db->insert($this->getTableName(), $values))
					$saveRecord = true;
			}
			else
			{
				$where = array('guide_id'=> $arrParams['guide_id']);
				if ($this->db->update($this->getTableName(), $values, $where))
					$saveRecord = true;
			}
		}		
		if ($saveRecord == true)
		{
			if ($modelType == 'create')
				return $this->db->insert_id();
			else 
				return $arrParams['guide_id'];
		}
		else
			return false;				
	}
	
	
	public function getAll($arrParams = array())
	{	
		$sql = 'SELECT * FROM '.$this->getTableName().' WHERE '.Guides_model::getWhere($arrParams);
		$sql .= ' ORDER BY title ASC, guide_id ASC ';	
		$result = $this->db->query($sql);
		return $result;
	}
	
	public static function getWhere($arrParams = array())
	{	
		$where = 'status !="deleted" ';
		if (!empty($arrParams))
		{
			if (isset($arrParams['title']) && !empty($arrParams['title']))
				$where .= ' AND title LIKE "%'.$arrParams['title'].'%" ';
			if (isset($arrParams['slug']) && !empty($arrParams['slug']))
				$where .= ' AND slug = "'.$arrParams['slug'].'"';
		}
		return $where;
	}
	
	
	public function getTableName()
	{
		return Util::getDbPrefix().'guides';
	}
	
	public function excuteQuery($sql)
	{		
		return $this->db->query($sql);
	}
	
	
	public static function getGuidesDetails($arrParams = array())
	{
		$data = $details = $relatedPost = array();
		$data['seoData'] = '';
		$cacheFileName = 'guides';
		$db =& get_instance();
		if (!empty($arrParams))
		{
			foreach ($arrParams as $k1=>$v1)
			{
				if (!empty($v1))
					$cacheFileName .= '_'.$v1;
			}
		}
		$cacheResult = Util::getCachedObject($cacheFileName);			
		//	check if cache file exist
		if(!empty($cacheResult))
		{
			// get result set from cache
			$details = $cacheResult;
		}
		else
		{			
			//get resultset from DB and save in cache
			$db->db->freeDBResource($db->db->conn_id);
			$details = Util::callStoreProcedure("sp_getGuidesDetails", $arrParams);	
			if (!empty($details))
			{				
				$db->db->freeDBResource($db->db->conn_id);
				$data = Util::rearrangeDataAsPerColumnName('guidesListing', $details);				
			}

			//	get top 3 records
			$tableName = Util::getdbPrefix().'guides';
			$where = array('table_name'=>$tableName);
			$top = Util::callStoreProcedure("sp_getTopNewsArticlesGuide", $where); 	
			$data['top'] = $top;
			
			//	get all the tags with post count
			$allTags = Util::callStoreProcedure("sp_getTagsWithNewsCount", $where);
			if (!empty($allTags))
				$data['allTags'] = $allTags;
			else 
				$data['allTags'] = array();
				

			if (isset($arrParams['guides_slug']) && !empty($arrParams['guides_slug']))
			{
				$data['guidesDetails'] = reset($data['guidesDetails']);					
				
				//	update page view count
				$updateCount = Util::incrementPageViewCount('guides', 'page_view_count','guide_id',$data['guidesDetails']['guides']['guide_id']);
							
				//	seo data
				$url = base_url().'guides/'.$arrParams['guides_slug'];
		        $data['seoData']['title'] = $data['guidesDetails']['guides']['seo_title'];
		        $data['seoData']['keywords'] = $data['guidesDetails']['guides']['seo_keywords'];
		        $data['seoData']['description'] = $data['guidesDetails']['guides']['seo_description'];
		        $data['seoData']['url'] = $url;
		        $data['socialSeoData'] = Util::getSocialMediaSeoData($data['guidesDetails']['guides'], $url);
		        $data['url'] = $url;
		        	        
				//	get related post by tags
				$tags = $data['guidesDetails']['guides']['tag'];
				if(!empty($tags))
				{
					$tags = explode(',', $tags);
					foreach ($tags as $k2=>$v2)
					{
						if (!empty($v2))
						{
							if (count($relatedPost)<7)
							{
								$where['tag'] = $v2;
								$rel= Util::callStoreProcedure('sp_getRelatedNewsArticlesGuides', $where);							
								if (!empty($rel))
								{
									foreach ($rel as $k3=>$v3)
									{
										if ($v3['guide_id'] != $data['guidesDetails']['guides']['guide_id'])
											$relatedPost[$v3['guide_id']] = $v3; 
									}
								}
							}
						}
					}
				}
				$data['relatedPost'] = $relatedPost;
			}
			else 
			{			
				$arrTitle = array();
				//	get comment count for each guides
				foreach ($data['guidesDetails'] as $k4=>$v4)
				{
					$arrTitle[] = $v4['guides']['slug'];				
				}	
				$arrTitle = implode(',', $arrTitle);
			}
			
			//	for guides by author  
			if (!empty($arrParams['author']) && !empty($data['guidesDetails']))
			{
				$temp = reset($data['guidesDetails']);
				$data['author'] = $temp['author'];
			}
			
			//	for guides by category/tag
			if (!empty($arrParams['tag']))
			{
				if (!empty($data['allTags']))
				{
					foreach ($data['allTags'] as $k1=>$v1)
					{
						if ($v1['slug'] == $arrParams['tag'])
							$data['tagDetails'] = $v1;
					}
				}
			}
			
			if (empty($data['seoData']))
			{
				$config = $db->util->get_pagination_params();
				$arrSeo['currentPage'] = $config['currentPage'];
				$seoType = 'guidesListing';
				if (!empty($arrParams['author']) && !empty($data['author']))
				{
					$arrSeo['author_name'] = isset($data['author']['upro_last_name']) ? $data['author']['upro_first_name'].' '.$data['author']['upro_last_name'] : $data['author']['upro_first_name'];
					$seoType = 'guidesByAuthor';
				}
				else if (!empty($arrParams['tag']))
				{
					$arrSeo['tag_name'] = isset($data['tagDetails']['name']) ? $data['tagDetails']['name'] : '';
					$seoType = 'guidesByTag';
				}
				$data['seoData'] = Util::getDefaultSeoData($seoType, $arrSeo);
			}
			//Util::saveResultToCache($cacheFileName,$data);
		}
		return $data;
	}
	
	
}