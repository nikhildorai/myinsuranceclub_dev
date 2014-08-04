<?php 
class MultiFileUpload extends Widget{

      public function __construct() {

        parent::widget ();

    }

    function run($ext = array()){
        	
        $model = isset($ext['policyModel']) ? $ext['policyModel'] : array();
        $modelName = isset($ext['modelName']) ? $ext['modelName'] : 'model';
        $policy_id = isset($ext['policy_id']) ? $ext['policy_id'] : ''; 
        $fieldName = (isset($ext['fieldName']) && !empty($ext['fieldName'])) ?  $ext['fieldName'] : 'file';
        $uploadType = (isset($ext['uploadType']) && !empty($ext['uploadType'])) ?  $ext['uploadType'] : '';
        $multiUpload = (isset($ext['multiUpload']) && !empty($ext['multiUpload'])) ?  $ext['multiUpload'] : true;
        
?>
	<?php 	
		if (!empty($model[$fieldName]) && !empty($uploadType))
		{
			$files = explode(',', $model[$fieldName]);	?>
			<div class="previewImage">
<?php 		
			if ($uploadType == 'policy_wordings_images')
			{
				$folderUrl = $this->config->config['folder_path']['policy']['policy_wordings_images'];
				$fileUrl = $this->config->config['url_path']['policy']['policy_wordings_images'];
			}
			else if ($uploadType == 'brochure_images')
			{
				$folderUrl = $this->config->config['folder_path']['policy']['brochure_images'];
				$fileUrl = $this->config->config['url_path']['policy']['brochure_images'];
			}
			
			foreach ($files as $k1=>$v1)
			{
				if (isset($v1) && !empty($v1))
				{
					if (file_exists($folderUrl.$v1))
					{
						echo '<img src="'.$fileUrl.$v1.'">';
					}
				}
			}	?>
		</div>
<?php 
		}
	?>		
		<input type="hidden" class="modelNameClassInput" value="<?php echo $modelName;?>">
		<input type="hidden" class="fieldNameClassInput" value="<?php echo $fieldName;?>">
		<input type="hidden" class="multiUploadClassInput" value="<?php echo $multiUpload;?>">
		
		<div class="filediv">
			<input type="file" name="<?php echo $modelName.'['.$fieldName.']';?><?php echo ($multiUpload == true) ? '[]' : ''?>" title="Choose File" data-ui-file-upload class="btn-info fileUploadAjax" value="<?php echo array_key_exists( $fieldName,$model) ? $model[$fieldName] : '';?>">
		</div>
		<br /> 
		<a href="javascript:void(0);" class="add_more" class="add btn btn-info"><span class="glyphicon glyphicon-plus"></span> Add More Files</a>
	

<?php                 
	}
}
?>