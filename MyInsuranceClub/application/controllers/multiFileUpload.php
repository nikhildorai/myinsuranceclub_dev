<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MultiFileUpload extends CI_Controller {
	
	public function processImage()
	{
		try
 		{			
     		// get the file
     		$picture_file = CUploadedFile::getInstanceByName('Filedata');
     		
     		if(!$picture_file || $picture_file->getHasError())
     		{
    			echo 'Error: Document Invalid';
    			Yii::app()->end();
     		}
			$picture_name = $picture_file->name;
			$extension = $picture_file->extensionName;
			
			$imageFileExt = Util::getAllowedImageExtensionType();
			
				$file_name = Util::generateFileName().".".$extension;
				
				$ci = &get_instance();
		    		if($picture_file->saveAs($ci->config->config['folder_path']['temp']. $file_name)) {
		    			
			     		$source = $ci->config->config['folder_path']['temp'].$file_name;
			     		
						$scaling_params = Util::resizeForThumbnail('resize_to_thumbnail');
						
						$destination = $ci->config->config['folder_path']['brochure_thumbnail'].$file_name;
						
						Util::resizeImage($source, $destination, 'RESIZE', $scaling_params);
					    // Return the file id to the script
					    // This will display the thumbnail of the uploaded file to the view
		      			$file_preview_url = $ci->config->config['url_path']['brochure_thumbnail']. $file_name;
		      			
		      			$return_array['file_display_name'] = $picture_name; 
		      			$return_array['file_stored_name'] = $file_name;
		      			$return_array['file_preview_url'] = $file_preview_url;
		      			echo json_encode($return_array);
		      		}
		     		else
		     		{
		     			echo "SEEMS TO BE SOME ERROR";
		     		}
	     	}
	     	catch(Exception $e)
	     	{
	   	 	echo 'Error: ' . $e->getMessage();
	     	}
	     	Yii::app()->end();
	}
}

?>
