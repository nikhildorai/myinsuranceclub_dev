<?php
/*
 * File: SimpleImage.php
 * Author: Simon Jarvis
 * Copyright: 2006 Simon Jarvis
 * Date: 08/11/06
 * Link: http://www.white-hat-web-design.co.uk/articles/php-image-resizing.php
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details:
 * http://www.gnu.org/licenses/gpl.html
 *
 */

class SimpleImage {

	var $image;
	var $image_type;
	private $width, $height,$original_info,$filename;

	function load1($filename) {

		$image_info = getimagesize($filename);
		$this->image_type = $image_info[2];
		if( $this->image_type == IMAGETYPE_JPEG ) {
			$this->image = imagecreatefromjpeg($filename);
		} elseif( $this->image_type == IMAGETYPE_GIF ) {
			$this->image = imagecreatefromgif($filename);
		} elseif( $this->image_type == IMAGETYPE_PNG ) {
			$this->image = imagecreatefrompng($filename);
		}
	}

	public function load($filename) {
			
		// Require GD library
		if( !extension_loaded('gd') ) throw new Exception('Required extension GD is not loaded.');
			
		$this->filename = $filename;
			
		$info = getimagesize($this->filename);
			
		switch( $info['mime'] ) {

			case 'image/gif':
				$this->image = imagecreatefromgif($this->filename);
				break;
					
			case 'image/jpeg':
				$this->image = imagecreatefromjpeg($this->filename);
				break;
					
			case 'image/png':
				$this->image = imagecreatefrompng($this->filename);
				break;
					
			default:
				throw new Exception('Invalid image: ' . $this->filename);
				break;
					
		}
			
		$this->original_info = array(
   			'width' => $info[0],
   			'height' => $info[1],
   			'orientation' => $this->get_orientation(),
   			'exif' => function_exists('exif_read_data') && $info['mime'] === 'image/jpeg' ? $this->exif = @exif_read_data($this->filename) : null,
   			'format' => preg_replace('/^image\//', '', $info['mime']),
   			'mime' => $info['mime']
		);
			
		$this->width = $info[0];
		$this->height = $info[1];
			
		imagesavealpha($this->image, true);
		imagealphablending($this->image, true);
			
		return $this;
			
	}

	public function get_orientation() {
			
		if( imagesx($this->image) > imagesy($this->image) ) return 'landscape';
		if( imagesx($this->image) < imagesy($this->image) ) return 'portrait';
		return 'square';
			
	}

	function save($filename, $image_type=IMAGETYPE_JPEG, $compression=75, $permissions=null) {
		if( $image_type == IMAGETYPE_JPEG ) {
			imagejpeg($this->image,$filename,$compression);
		} elseif( $image_type == IMAGETYPE_GIF ) {
			imagegif($this->image,$filename);
		} elseif( $image_type == IMAGETYPE_PNG ) {
			imagepng($this->image,$filename);
		}
		if( $permissions != null) {
			chmod($filename,$permissions);
		}
	}

	function output($image_type=IMAGETYPE_JPEG) {
		if( $image_type == IMAGETYPE_JPEG ) {
			imagejpeg($this->image);
		} elseif( $image_type == IMAGETYPE_GIF ) {
			imagegif($this->image);
		} elseif( $image_type == IMAGETYPE_PNG ) {
			imagepng($this->image);
		}
	}

	function getWidth() {
		return imagesx($this->image);
	}

	function getHeight() {
		return imagesy($this->image);
	}

	function resizeToHeight($height) {
		$ratio = $height / $this->getHeight();
		$width = $this->getWidth() * $ratio;
		$this->resizeImage($width,$height);
	}

	function resizeToWidth($width) {
		$ratio = $width / $this->getWidth();
		$height = $this->getheight() * $ratio;
		$this->resizeImage($width,$height);
	}

	function scale($scale) {
		$width = $this->getWidth() * $scale/100;
		$height = $this->getheight() * $scale/100;
		$this->resizeImage($width,$height);
	}

	/* old function */
	 function resizeImage($width,$height) {
		$new_image = imagecreatetruecolor($width, $height);
		imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
		$this->image = $new_image;
		}


	function best_fit($max_width, $max_height) {
			
		// If it already fits, there's nothing to do
		if( $this->width <= $max_width && $this->height <= $max_height ) return $this;
			
		// Determine aspect ratio
		$aspect_ratio = $this->height / $this->width;
			
		// Make width fit into new dimensions
		if( $this->width > $max_width ) {
			$width = $max_width;
			$height = $width * $aspect_ratio;
		} else {
			$width = $this->width;
			$height = $this->height;
		}
			
		// Make height fit into new dimensions
		if( $height > $max_height ) {
			$height = $max_height;
			$width = $height / $aspect_ratio;
		}
			
		return $this->resizeImage($width, $height);
			
	}
	
	
	public function resize($img, $w, $h, $newfilename) {
		//Check if GD extension is loaded

		if (!extension_loaded('gd') && !extension_loaded('gd2')) {
			trigger_error("GD is not loaded", E_USER_WARNING); return false;
		}

		//Get Image size info
		$imgInfo = getimagesize($img);

		switch ($imgInfo[2]) {

			case 1: $im = imagecreatefromgif($img); break;

			case 2: $im = imagecreatefromjpeg($img);  break;

			case 3: $im = imagecreatefrompng($img); break;

			default:  trigger_error('Unsupported filetype!', E_USER_WARNING);  break;

		}

		//If image dimension is smaller, do not resize

		if ($imgInfo[0] <= $w && $imgInfo[1] <= $h) {

			$nHeight = $imgInfo[1];

			$nWidth = $imgInfo[0];

		}else{

			//resize image with specific width x height
			$nWidth = round($w);
				
			$nHeight = round($h);

		}

		$nWidth = round($nWidth);

		$nHeight = round($nHeight);
		
		$newImg = imagecreatetruecolor($nWidth, $nHeight);
			

		/* Check if this image is PNG or GIF, then set if Transparent*/

		if(($imgInfo[2] == 1) OR ($imgInfo[2]==3)){

			imagealphablending($newImg, false);

			imagesavealpha($newImg,true);

			$transparent = imagecolorallocatealpha($newImg, 255, 255, 255, 127);

			imagefilledrectangle($newImg, 0, 0, $nWidth, $nHeight, $transparent);

		}

		imagecopyresampled($newImg, $im, 0, 0, 0, 0, $nWidth, $nHeight, $imgInfo[0], $imgInfo[1]);

		//Generate the file, and rename it to $newfilename

		switch ($imgInfo[2]) {

			case 1: imagegif($newImg,$newfilename); break;

			case 2: imagejpeg($newImg,$newfilename);  break;

			case 3: imagepng($newImg,$newfilename); break;

			default:  trigger_error('Failed resize image!', E_USER_WARNING);  break;

		}
		return $newfilename;

	}
	
	/*public function resizeImage($source, $destination, $scaling_params=array()) {
		$thumbnail = $this->resize($source, $scaling_params['width'],$scaling_params['height'], $destination);
	}*/


	public function resizeImageAll($name,$original_size, $destination_type)
	{
		$arrSizes = ApplicationConfig::getImagedimensions();

		if(!empty($arrSizes)) {
			foreach ($arrSizes as $key=>$value) {
				$this->resize($original_size, $value['width'],$value['height'], $destination);
			}
		}
	}
	
	public static function deleteJunk($path,$photoName,$delOrig = false){
		$temp = ApplicationConfig::app()->params['folder_path']['temp'];
		$nName = 'temp_'.$photoName;
		$orig = $path.'original/';
		$arr = ApplicationConfig::getImagedimensions();
		if(!$delOrig){			
			Util::unlinkFile($temp.$nName);
			Util::unlinkFile($temp.$photoName);
		}else{					
			foreach($arr as $k=>$val){
				$location = $path.$k.'/';
				Util::unlinkFile($location.$photoName); // model not saved
			}
			Util::unlinkFile($orig.$photoName);
			Util::unlinkFile($path.'thumbnails/'.$photoName);
			Util::unlinkFile($temp.$nName);
			Util::unlinkFile($temp.$photoName);			
		}
	}
	
	
	public static function saveImages($path, $photoName, $type)
	{
		$ci =& get_instance();
		$arr = Util::getImagedimensions($type);
		$orig = $path;
		$temp = $ci->config->config['folder_path']['temp'];//ApplicationConfig::app()->params['folder_path']['temp'];
		
		if(copy( $orig.$photoName	, 	$temp.$photoName )){
			$nName='temp_'.$photoName;
			//step 2: create copy of temp file
			@copy($temp.$photoName, $temp.$nName);
			$location = $temp;//$path.'thumbnails/';
		//	copy($temp.$nName	,	$location.$photoName);
			$obj = new SimpleImage();
			$obj->load($location.$photoName);
			$obj->best_fit(220,124);
			$obj->save($location.$photoName);
			unset($obj);
			$newPath = array_filter(explode('/', $path));
			array_pop($newPath);
			$newPath = implode('/', $newPath);
				
			if (!empty($arr))
			{
				foreach($arr as $k=>$val)
				{
					$location = $newPath.'/'.$k.'/';			
					@copy($temp.$nName	,	$location.$photoName);
					$obj = new SimpleImage();
					$obj->load($temp.$photoName); //step 3: Load copied file with specified size
					$obj->resize($location.$photoName, $val['width'], $val['height'], $location.$photoName); //step 4: Resize after resampling
					unset($obj,$location);
				}
			}
			@unlink($temp.$photoName);
			@unlink($temp.$nName);
		}
		
	}




	
}