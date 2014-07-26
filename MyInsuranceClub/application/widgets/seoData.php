<?php 
class SeoData extends Widget{

      public function __construct() {

        parent::widget ();

    }

    public $title = "Test";
    public $description = "For test";
    
    function run(){
    	$this->render("seoData_view");
var_dump($seo_keywords);    	
    	//	get all the tags
    //	$allTags = $this->util->getAllTags();//isset($this->data['allTags']) ? $this->data['allTags'] : array();
    	//	get the existing tag
    	$modelName = isset($this->data['modelName']) ? $this->data['modelName'] : 'model';

                      
	}
	
}
?>