<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News_model EXTENDS Admin_Model{

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}
	
	function saveRecord($arrParams = array(), $modelType = 'update')
	{
		$saveRecord = false;
		if (!empty($arrParams))
		{
			$colNames = $colValues = $values = array();
			foreach ($arrParams as $k1=>$v1)
			{
				if (!in_array($k1, array('news_id')))
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
				$where = array('news_id'=> $arrParams['news_id']);
				if ($this->db->update($this->getTableName(), $values, $where))
					$saveRecord = true;
			}
		}		
		if ($saveRecord == true)
		{
			if ($modelType == 'create')
				return $this->db->insert_id();
			else 
				return $arrParams['news_id'];
		}
		else
			return false;				
	}
	
	
	public function getAll($arrParams = array())
	{	
		$sql = 'SELECT * FROM '.$this->getTableName().' WHERE '.News_model::getWhere($arrParams);
		$sql .= ' ORDER BY title ASC, news_id ASC ';	
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
		return Util::getDbPrefix().'news';
	}
	
	public function excuteQuery($sql)
	{		
		return $this->db->query($sql);
	}
	
	public static function getNewsDetails($arrParams = array())
	{
		$data = $details = $relatedPost = array();
		$data['seoData'] = '';
		$cacheFileName = 'news';
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
			$details = Util::callStoreProcedure("sp_getNewsDetails", $arrParams);		
			//	get top 3 records
			$tableName = Util::getdbPrefix().'news';
			$where = array('table_name'=>$tableName);
			$top = Util::callStoreProcedure("sp_getTopNewsArticlesGuide", $where); 	
			if (!empty($details))
			{				
				$db->db->freeDBResource($db->db->conn_id);
				$data = Util::rearrangeDataAsPerColumnName('newsListing', $details);				
			}
			$data['top'] = $top;
			
			//	get all the tags with post count
			$allTags = Util::callStoreProcedure("sp_getTagsWithNewsCount", $where);
			if (!empty($allTags))
				$data['allTags'] = $allTags;
			else 
				$data['allTags'] = array();
				
			if (isset($arrParams['news_slug']) && !empty($arrParams['news_slug']))
			{
				$data['newsDetails'] = reset($data['newsDetails']);	
				
				//	update page view count
				$updateCount = Util::incrementPageViewCount('news', 'page_view_count','news_id',$data['newsDetails']['news']['news_id']);
							
				//	seo data
				$url = base_url().'news/'.$arrParams['news_slug'];
		        $data['seoData']['title'] = $data['newsDetails']['news']['seo_title'];
		        $data['seoData']['keywords'] = $data['newsDetails']['news']['seo_keywords'];
		        $data['seoData']['description'] = $data['newsDetails']['news']['seo_description'];
		        $data['seoData']['url'] = $url;
		        $data['socialSeoData'] = Util::getSocialMediaSeoData($data['newsDetails']['news'], $url);
		        $data['url'] = $url;
		        
		        
				//	get related post by tags
				$tags = $data['newsDetails']['news']['tag'];
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
										if ($v3['news_id'] != $data['newsDetails']['news']['news_id'])
											$relatedPost[$v3['news_id']] = $v3; 
									}
								}
							}
						}
					}
				}
				$data['relatedPost'] = $relatedPost;
			}
			
			//	for news by author  
			if (!empty($arrParams['author']))
			{
				$temp = reset($data['newsDetails']);
				$data['author'] = $temp['author'];
			}
			
			//	for news by category/tag
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
				$seoType = 'newsListing';
				if (!empty($arrParams['author']))
				{
					$arrSeo['author_name'] = isset($data['author']['upro_last_name']) ? $data['author']['upro_first_name'].' '.$data['author']['upro_last_name'] : $data['author']['upro_first_name'];
					$seoType = 'newsByAuthor';
				}
				else if (!empty($arrParams['tag']))
				{
					$arrSeo['tag_name'] = isset($data['tagDetails']['name']) ? $data['tagDetails']['name'] : '';
					$seoType = 'newsByTag';
				}
				$data['seoData'] = Util::getDefaultSeoData($seoType, $arrSeo);
			}
			//Util::saveResultToCache($cacheFileName,$data);
		}
		return $data;
	}
}