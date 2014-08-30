<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Articles_model EXTENDS Admin_Model{

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
				if (!in_array($k1, array('article_id')))
				{
					if (is_numeric($v1))
						$values[$k1] = (int)trim($v1);
					else
						$values[$k1] = trim($v1);
				}
			}
			if ($modelType == 'create')
			{
				if ($this->db->insert('articles', $values))
					$saveRecord = true;
			}
			else
			{
				$where = array('article_id'=> $arrParams['article_id']);
				if ($this->db->update('articles', $values, $where))
					$saveRecord = true;
			}
		}
		if ($saveRecord == true)
		{
			if ($modelType == 'create')
				return $this->db->insert_id();
			else 
				return $arrParams['article_id'];
		}
		else
			return false;				
	}
	
	
	public function getAll($arrParams = array())
	{	
		$sql = 'SELECT * FROM '.$this->getTableName().' WHERE '.Articles_model::getWhere($arrParams);
		$sql .= ' ORDER BY title ASC, article_id ASC ';	
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
		return Util::getDbPrefix().'articles';
	}
	
	public function excuteQuery($sql)
	{		
		return $this->db->query($sql);
	}

	
	public static function getArticlesDetails($arrParams = array())
	{
		$data = $details = $relatedPost = array();
		$data['seoData'] = '';
		$cacheFileName = 'articles';
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
			$details = Util::callStoreProcedure("sp_getArticlesDetails", $arrParams);	
			if (!empty($details))
			{				
				$db->db->freeDBResource($db->db->conn_id);
				$data = Util::rearrangeDataAsPerColumnName('articlesListing', $details);				
			}

			//	get top 3 records
			$tableName = Util::getdbPrefix().'articles';
			$where = array('table_name'=>$tableName);
			$top = Util::callStoreProcedure("sp_getTopNewsArticlesGuide", $where); 	
			$data['top'] = $top;
			
			//	get all the tags with post count
			$allTags = Util::callStoreProcedure("sp_getTagsWithNewsCount", $where);
			if (!empty($allTags))
				$data['allTags'] = $allTags;
			else 
				$data['allTags'] = array();
				

			if (isset($arrParams['articles_slug']) && !empty($arrParams['articles_slug']))
			{
				$data['articlesDetails'] = reset($data['articlesDetails']);					
				
				//	update page view count
				$updateCount = Util::incrementPageViewCount('articles', 'page_view_count','article_id',$data['articlesDetails']['articles']['article_id']);
							
				//	seo data
				$url = base_url().'articles/'.$arrParams['articles_slug'];
		        $data['seoData']['title'] = $data['articlesDetails']['articles']['seo_title'];
		        $data['seoData']['keywords'] = $data['articlesDetails']['articles']['seo_keywords'];
		        $data['seoData']['description'] = $data['articlesDetails']['articles']['seo_description'];
		        $data['seoData']['url'] = $url;
		        $data['socialSeoData'] = Util::getSocialMediaSeoData($data['articlesDetails']['articles'], $url);
		        $data['url'] = $url;
		        	        
				//	get related post by tags
				$tags = $data['articlesDetails']['articles']['tag'];
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
										if ($v3['article_id'] != $data['articlesDetails']['articles']['article_id'])
											$relatedPost[$v3['article_id']] = $v3; 
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
				//	get comment count for each articles
				foreach ($data['articlesDetails'] as $k4=>$v4)
				{
					$arrTitle[] = $v4['articles']['slug'];				
				}	
				$arrTitle = implode(',', $arrTitle);
			}
			
			//	for articles by author  
			if (!empty($arrParams['author']) && !empty($data['articlesDetails']))
			{
				$temp = reset($data['articlesDetails']);
				$data['author'] = $temp['author'];
			}
			
			//	for articles by category/tag
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
				$seoType = 'articlesListing';
				if (!empty($arrParams['author']) && !empty($data['author']))
				{
					$arrSeo['author_name'] = isset($data['author']['upro_last_name']) ? $data['author']['upro_first_name'].' '.$data['author']['upro_last_name'] : $data['author']['upro_first_name'];
					$seoType = 'articlesByAuthor';
				}
				else if (!empty($arrParams['tag']))
				{
					$arrSeo['tag_name'] = isset($data['tagDetails']['name']) ? $data['tagDetails']['name'] : '';
					$seoType = 'articlesByTag';
				}
				$data['seoData'] = Util::getDefaultSeoData($seoType, $arrSeo);
			}
			//Util::saveResultToCache($cacheFileName,$data);
		}
		return $data;
	}
	
	
	
	
	
	
	
}