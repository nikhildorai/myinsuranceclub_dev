		<div class="content clearfix">
			<div class="col100">
			
				<h2><?php echo (isset($companyModel['company_id']) && !empty($companyModel['company_id'])) ? 'Update Company' : 'Create Company';?></h2>
		<div class="download-row">
			<a href="<?php echo $base_url;?>admin/company" class="link_button">Back</a>
		</div>
		<br>
<br>			
		

			
					
<?php //echo validation_errors('<p class="error_msg">', '</p>'); ?> 
				<?php echo form_open_multipart(); ?>
					<fieldset>
							<?php if (! empty($message)) { ?>
								<div id="message">
									<?php echo $message; ?>
								</div>
							<?php } ?>		
						<h2>Company Details</h2>							
						<ul>
							
							<li class="info_req">
								<label for="search">Company Type:</label>
								<?php 
								$selected = array_key_exists( 'company_type_id',$companyModel) ?  $companyModel['company_type_id'] : '';
								$options = $this->util->getCompanyTypeDropDownOptions($modelName ='Company_type_model', $optionKey = 'company_type_id', $optionValue = 'company_type_name', $defaultEmpty = "Please Select");
								//sort($options);
								echo form_dropdown('companyModel[company_type_id]', $options, $selected, ' id="company_type_id" class="tooltip_trigger" title="Search by company type."');
								?>
							</li>
							
							
							<li class="info_req">
								<label for="search">Company Name:</label>
								<input type="text" id="company_name" name="companyModel[company_name]" value="<?php echo array_key_exists( 'company_name',$companyModel) ? $companyModel['company_name'] : '';?>" class="tooltip_trigger" title="Unique company name." /><br />
							</li>
							
							<li class="info_req">
								<label for="search">Company Display Name:</label>
								<input type="text" id="company_display_name" name="companyModel[company_display_name]" value="<?php echo array_key_exists( 'company_display_name',$companyModel) ? $companyModel['company_display_name'] : '';?>" class="tooltip_trigger" title="Unique company display name." /><br />
							</li>
							
							<li class="info_req">
								<label for="search">Company Short Name:</label>
								<input type="text" id="company_shortname" name="companyModel[company_shortname]" value="<?php echo array_key_exists( 'company_shortname',$companyModel) ? $companyModel['company_shortname'] : '';?>" class="tooltip_trigger" title="Unique company shortname." /><br />
							</li>
							
							<li class="info_req">
								<label for="search">SEO Title:</label>
								<input type="text" id="seo_title" name="companyModel[seo_title]" maxlength="90" value="<?php echo array_key_exists( 'seo_title',$companyModel) ? $companyModel['seo_title'] : '';?>" class="tooltip_trigger" title="Add seo title" /><span style="margin-top: 3px;"> (Max length 90 characters)</span><br />
							</li>
							
							<li class="info_req">
								<label for="search">SEO Description:</label>
								<textarea id="seo_description" name="companyModel[seo_description]" style="margin-top: 0px; margin-bottom: 0px;" rows="4" cols="20" class="tooltip_trigger" title=" Add seo description"  maxlength="175"><?php echo array_key_exists( 'seo_description',$companyModel) ? $companyModel['seo_description'] : '';?></textarea><span style="margin-top: 3px;"> (Max length 175 characters)</span><br />
							</li>
							
							<li class="info_req">
								<label for="search">SEO Keywords:</label>
								<textarea id="seo_keywords" name="companyModel[seo_keywords]" class="tooltip_trigger" style="margin-top: 0px; margin-bottom: 0px;" rows="4" cols="20" title="Add seo keywords"><?php echo array_key_exists( 'seo_keywords',$companyModel) ? $companyModel['seo_keywords'] : '';?></textarea><br />
							</li>
							
							<li class="info_req">
								<label for="search">URL:</label>
								<input type="text" name="companyModel[slug]" value="<?php echo array_key_exists( 'slug',$companyModel) ? $companyModel['slug'] : '';?>" class="tooltip_trigger" title="Add URL" /><br />
							</li>
							
							<li class="info_req1">
								<label for="search">Logo for Company Page:</label>
								<input type="file" id="logo1" name="companyModel[logo_image_1]" /><span>Image size: 400px X 250px</span> <br />
								<?php 
								$folderUrl = $this->config->config['folder_path']['company'];
								$fileUrl = $this->config->config['url_path']['company'];
								if (isset($companyModel['logo_image_1']) && !empty($companyModel['logo_image_1']))
								{
									if (file_exists($folderUrl.$companyModel['logo_image_1']))
										echo '<img src="'.$fileUrl.$companyModel['logo_image_1'].'"><br>';
								}
								?>								
							</li>

							<li class="info_req1">
								<label for="search">Logo for Search Results:</label>
								<input type="file" id="logo2" name="companyModel[logo_image_2]" /><span>Image size: 400px X 250px</span> <br />
								<?php 
								if (isset($companyModel['logo_image_1']) && !empty($companyModel['logo_image_2']))
								{
									if (file_exists($folderUrl.$companyModel['logo_image_2']))
										echo '<img src="'.$fileUrl.$companyModel['logo_image_2'].'"><br>';
								}
?>									
							</li>
						</ul>
							
							
							
							
							
							
							
							
							
<?php /*?>							
							<li class="info_req">
								<label for="search">description:</label>
								<textarea name="content1" id="content1" >Example data</textarea>
								<?php echo display_ckeditor($ckeditor); ?>
							</li>
							
							<li class="info_req">
								<label for="search">Add heading:</label>
								<input type="text" name="feature[heading][]" value="" class="tooltip_trigger" title="Add Description" /><br />
							</li>
							
							<li class="info_req">
								<label for="search">Description:</label>
								<textarea name="feature[content][]" style="width:60%">Add description here</textarea>
							</li>
							

*/ ?>						
							
					</fieldset>
					
					
					<fieldset>
						<h2>Contact Details</h2>	
						<ul>
							
							
							<li class="info_req">
								<label for="search">Heading 1:</label>
								<input type="text" name="companyDetailModel[heading_1]" value="<?php echo array_key_exists( 'heading_1',$companyDetailModel) ? $companyDetailModel['heading_1'] : '';?>" class="tooltip_trigger" title="Add heading 1" /><br />
							</li>
							
							<li class="info_req">
								<label for="search">Description 1:</label>
								<textarea name="companyDetailModel[description_1]" id="description_1" ><?php echo array_key_exists( 'description_1',$companyDetailModel) ? $companyDetailModel['description_1'] : '';?></textarea>
								<?php echo display_ckeditor($ckeditor1); ?>
							</li>
							
							<li class="info_req">
								<label for="search">Heading 2:</label>
								<input type="text" name="companyDetailModel[heading_2]" value="<?php echo array_key_exists( 'heading_2',$companyDetailModel) ? $companyDetailModel['heading_2'] : '';?>" class="tooltip_trigger" title="Add heading 2" /><br />
							</li>
							
							<li class="info_req">
								<label for="search">Description 2:</label>
								<textarea name="companyDetailModel[description_2]" id="description_2" ><?php echo array_key_exists( 'description_2',$companyDetailModel) ? $companyDetailModel['description_2'] : '';?></textarea>
								<?php echo display_ckeditor($ckeditor2); ?>
							</li>
							
							<li class="info_req">
								<label for="search">Corporate Office:</label>
								<textarea id="seo_description" name="companyDetailModel[address]" style="margin-top: 0px; margin-bottom: 0px;" rows="4" cols="20" class="tooltip_trigger" title=" Add address"><?php echo array_key_exists( 'address',$companyDetailModel) ? $companyDetailModel['address'] : '';?></textarea><br />
							</li>
							
							<li class="info_req">
								<label for="search">Website:</label>
								<input type="text" name="companyDetailModel[website]" value="<?php echo array_key_exists( 'website',$companyDetailModel) ? $companyDetailModel['website'] : '';?>" class="tooltip_trigger" title="Add website" /><br />
							</li>
							
							<li>
								<label for="search">Twitter Handle:</label>
								<input type="text" name="companyDetailModel[twitter]" value="<?php echo array_key_exists( 'twitter',$companyDetailModel) ? $companyDetailModel['twitter'] : '';?>" class="tooltip_trigger" title="Add twitter" /><br />
							</li>
							
							<li>
								<label for="search">Facebook Page:</label>
								<input type="text" name="companyDetailModel[facebook]" value="<?php echo array_key_exists( 'facebook',$companyDetailModel) ? $companyDetailModel['facebook'] : '';?>" class="tooltip_trigger" title="Add facebook" /><br />
							</li>
							
							<li>
								<label for="search">Google Profile:</label>
								<input type="text" name="companyDetailModel[google_plus]" value="<?php echo array_key_exists( 'google_plus',$companyDetailModel) ? $companyDetailModel['google_plus'] : '';?>" class="tooltip_trigger" title="Add google plus" /><br />
							</li>
							
							<li class="info_req">
								<label for="search">Phone 1:</label>
								<input type="text" name="companyDetailModel[phone]" value="<?php echo array_key_exists( 'phone',$companyDetailModel) ? $companyDetailModel['phone'] : '';?>" class="tooltip_trigger" title="Add phone" /><span style="margin-top: 3px;"> (Add comma seperate multiple values)</span><br />
							</li>
							
							<li>
								<label for="search">Phone 2:</label>
								<input type="text" name="companyDetailModel[phone2]" value="<?php echo array_key_exists( 'phone2',$companyDetailModel) ? $companyDetailModel['phone2'] : '';?>" class="tooltip_trigger" title="Add phone 2" /><span style="margin-top: 3px;"> (Add comma seperate multiple values)</span><br />
							</li>
							
							<li>
								<label for="search">Phone 3:</label>
								<input type="text" name="companyDetailModel[phone3]" value="<?php echo array_key_exists( 'phone3',$companyDetailModel) ? $companyDetailModel['phone3'] : '';?>" class="tooltip_trigger" title="Add phone 3" /><span style="margin-top: 3px;"> (Add comma seperate multiple values)</span><br />
							</li>
							
							<li class="info_req">
								<label for="search">Email:</label>
								<input type="text" name="companyDetailModel[email]" value="<?php echo array_key_exists( 'email',$companyDetailModel) ? $companyDetailModel['email'] : '';?>" class="tooltip_trigger" title="Add email" /><span style="margin-top: 3px;"> (Add comma seperate multiple values)</span><br />
							</li>
							
							<li>
								<label for="search">SMS:</label>
								<input type="text" name="companyDetailModel[sms]" value="<?php echo array_key_exists( 'sms',$companyDetailModel) ? $companyDetailModel['sms'] : '';?>" class="tooltip_trigger" title="Add SMS" /><br />
							</li>
							
						</ul>
					</fieldset>
					
					<fieldset>	
						<ul>
							<li>	
								<hr/>
								<input type="hidden" id="company_id" name="companyModel[company_id]" value="<?php echo array_key_exists( 'company_id',$companyModel) ? $companyModel['company_id'] : '';?>" />
								<input type="hidden" id="company_detail_id" name="companyDetailModel[company_detail_id]" value="<?php echo array_key_exists( 'company_detail_id',$companyDetailModel) ? $companyDetailModel['company_detail_id'] : '';?>" />
								<label for="search"></label>
								<input type="submit" name="submit" value="Submit" class="link_button"/>
								<a href="<?php echo $base_url; ?>admin/company" class="link_button grey">Cancel</a>
							</li>
						</ul>
					</fieldset>
					
					
				<?php echo form_close();?>
			
			</div>
		</div>
	