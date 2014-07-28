<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Disqus_comments_model EXTENDS Admin_Model{

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}
	
	public function getTableName()
	{
		return Util::getDbPrefix().'disqus_comments';
	}
	
	public function excuteQuery($sql)
	{		
		return $this->db->query($sql);
	}
}