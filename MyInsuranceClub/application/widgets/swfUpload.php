<?php
class SwfUpload extends Widget
{
	public $postParams=array();
	public $config=array();
	
	public function __construct() {

		parent::widget ();

	}
	
	
    public function run($ext = array())
    {
		//$assets = dirname(__FILE__).'/swfupload';
		$assets = base_url().'swfupload';
        $baseUrl = $assets;//Yii::app()->assetManager->publish($assets);
       ?> 
       
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo $baseUrl . '/swfupload.css' ?>"/>
 	    <script  type="text/javascript" src="<?php echo $baseUrl.'/swfupload.js'; ?>" ></script>
 	    <script  type="text/javascript" src="<?php echo $baseUrl.'/swfupload.queue.js'; ?>" ></script>
 	    <script  type="text/javascript" src="<?php echo $baseUrl.'/fileprogress.js'; ?>" ></script>
		<script  type="text/javascript" src="<?php echo $baseUrl.'/handlers.js'; ?>" ></script>
		<link rel="stylesheet" type="text/css" href="<?php echo $baseUrl ?>/mystyle.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo $baseUrl ?>/example.css" /> 
		<style>
		#photo_upload_button input[type="submit"] {
		    background: none repeat scroll 0 0 #FF7E31;
		    border: 1px solid #A94A01 !important;
		    border-radius: 2px 2px 2px 2px;
		    box-shadow: 0 1px 0 0 #FBAB7B inset;
		    color: white;
		    cursor: pointer;
		    font-size: 15px;
		    margin-top: 12px;
		    padding: 3px 10px 5px !important; 
		    text-shadow: 0 1px 0 #A94A01;
		    width: 150px !important;
		}
		</style>
				
		<script type="text/javascript">
		$(document).ready(function(){
			var swfuPath = "<?php echo $baseUrl;?>";
			
		});
		</script>
<?php        
		$postParams = array('PHPSESSID'=>session_id());
		
		if(isset($this->postParams))
		{
				$postParams = array_merge($postParams, $this->postParams);
		}
	
		$uurl = base_url().'multiFileUpload/processImage';
		$config = array(
			'use_query_string'=>false,
			//Use $this->createUrl method or define yourself
		    'upload_url'=> $uurl,
			// This is a workaround to avoid certain
			// issues (check SWFUpload Forums)
		   	'file_size_limit'=>'5 MB',
			// Allowed file types
	
		   	'file_types'=>'*.jpg;*.jpeg;*.png;*.gif',
			// File types description (mine spanish)
		   	'file_types_description'=>'Image files',
			// unlimited number of files
		   	'file_upload_limit'=>100,
			// refer to handlers.js from here below
		   	'file_queue_error_handler'=>'fileQueueError',
		   	'file_dialog_complete_handler'=>'fileDialogComplete',
		   	'upload_progress_handler'=>'uploadProgress',
		  	'upload_error_handler'=>'uploadError',
		   	'upload_success_handler'=>'uploadSuccess',
		   	'upload_complete_handler'=>'uploadComplete',
			// what is our upload target layer?
		   	'custom_settings'=>array('progressTarget'=>'divFileProgressContainer','cancelButtonId'=>'btnCancel'),
			// where are we going to place the button?
		   	'button_placeholder_id'=>'swfupload',
		   	'button_width'=>175,
		   	'button_height'=>20,
		   	'button_text'=>'<span class="button">Select Files</span>',
		   	'button_text_style'=>'.button {font-size: 11pt; text-align: center;}',
		   	'button_text_top_padding'=>0,
		   	'button_text_left_padding'=>0,
		   	'button_window_mode'=>'SWFUpload.WINDOW_MODE.TRANSPARENT',
		   	'button_cursor'=>'SWFUpload.CURSOR.HAND',
			'post_params'=> $postParams, 
			'flash_url'=> $baseUrl. '/swfupload.swf',
			'button_image_url'=> $baseUrl .'/images/SmallSpyGlassWithTransperancy_17x18.png',
			'DEBUG'=>true,
		);	//'jsHandlerUrl'=>$baseUrl.'/handlers.js' //Relative path
		$newConfig = (!empty($ext) && isset($ext['config'])) ? $ext['config'] : array();	
		$config = array_merge($config, $newConfig);		
		$config = json_encode($config);
?>

		<script type="text/javascript">
			$(document).ready(function(){
				var swfu;
					swfu = new SWFUpload(<?php echo $config;?>);
			});
		</script>
<?php 			
	} 
       
}