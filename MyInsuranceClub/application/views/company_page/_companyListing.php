
<?php 
		if (!empty($companyDetails))
		{
			$folderUrl = $this->config->config['folder_path']['company']['partnerLogo']; 
			$fileUrl = $this->config->config['url_path']['company']['partnerLogo'];
			foreach ($companyDetails as $k1=>$v1)
			{
				$imgUrl = $fileUrl.'logo_missing_147x107.jpg';
				if (!empty($v1['logo_image_partner']) && file_exists($folderUrl.$v1['logo_image_partner']))
					$imgUrl = $fileUrl.$v1['logo_image_partner'];	?>
				
		        <div class="col-md-3">
		         <div class="view view-fifth">
		                    <img src="<?php echo $imgUrl;?>" />
		                    <div class="mask">
		                        <h2><?php echo $v1['company_shortname']?></h2>
<?php 							if (!empty($v1['slug'])) 
								{
									if ($v1['company_type_slug'] == 'life-insurance')
										$url = base_url().'life-insurance/companies/'.$v1['slug'].'/';
									else 
										$url = base_url().'general-insurance-companies/'.$v1['slug'];
	?>		                        
		                        	<a href="<?php echo (!empty($v1['slug'])) ? $url : 'javascript:void(0);';?>" class="info">Read More</a>
<?php 							}	?>		                        
		                    </div>
		                </div>
		        </div>
<?php 		}
		}
?>      