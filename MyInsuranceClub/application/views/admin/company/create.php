		<div class="content clearfix">
			<div class="col100">
			
				<h2>Create Company</h2>
				
<script src="<?php echo base_url()?>JS/tinymce/tinymce.min.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){

	/*
	tinymce.init({
	    selector: "textarea",
	    plugins: [
	        "advlist autolink lists link image charmap print preview anchor",
	        "searchreplace visualblocks code fullscreen",
	        "insertdatetime media table contextmenu paste"
	    ],
	    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
	});
	*/
});
</script>

			
					
<?php //echo validation_errors('<p class="error_msg">', '</p>'); ?> 
				<?php echo form_open_multipart(); ?>
					<fieldset>
						<legend>Company Details</legend>
							<?php if (! empty($message)) { ?>
								<div id="message">
									<?php echo $message; ?>
								</div>
							<?php } ?>		
						<ul>
							<li class="info_req">
								<label for="search">Company Name:</label>
								<input type="text" id="company_name" name="companyModel[company_name]" value="<?php echo array_key_exists( 'company_name',$companyModel) ? $companyModel['company_name'] : '';?>" class="tooltip_trigger" title="Unique company name." /><br />
							</li>
							
							<li class="info_req">
								<label for="search">Company Display Name:</label>
								<input type="text" id="company_display_name" name="companyModel[company_display_name]" value="<?php echo array_key_exists( 'company_display_name',$companyModel) ? $companyModel['company_display_name'] : '';?>" class="tooltip_trigger" title="Unique company display name." /><br />
							</li>
							
							<li class="info_req">
								<label for="search">Company Shortname:</label>
								<input type="text" id="company_shortname" name="companyModel[company_shortname]" value="<?php echo array_key_exists( 'company_shortname',$companyModel) ? $companyModel['company_shortname'] : '';?>" class="tooltip_trigger" title="Unique company shortname." /><br />
							</li>
							
							<li class="info_req">
								<label for="search">Company Type:</label>
								<?php 
								$selected = array_key_exists( 'company_type_id',$companyModel) ?  $companyModel['company_type_id'] : '';
								$options = $this->util->getCompanyTypeDropDownOptions();
								//sort($options);
								echo form_dropdown('companyModel[company_type_id]', $options, $selected, ' id="company_type_id" class="tooltip_trigger" title="Search by company type."');
								?>
							</li>
							
							<li class="info_req">
								<label for="search">SEO Title:</label>
								<input type="text" id="seo_title" name="companyModel[seo_title]" value="<?php echo array_key_exists( 'seo_title',$companyModel) ? $companyModel['seo_title'] : '';?>" class="tooltip_trigger" title="Add seo title" /><br />
							</li>
							
							<li class="info_req">
								<label for="search">SEO Description:</label>
								<textarea id="seo_description" name="companyModel[seo_description]" class="tooltip_trigger" title=" Add seo description" ><?php echo array_key_exists( 'seo_description',$companyModel) ? $companyModel['seo_description'] : '';?></textarea><br />
							</li>
							
							<li class="info_req">
								<label for="search">SEO Keywords:</label>
								<textarea id="seo_keywords" name="companyModel[seo_keywords]" class="tooltip_trigger" title="Add seo keywords"><?php echo array_key_exists( 'seo_keywords',$companyModel) ? $companyModel['seo_keywords'] : '';?></textarea><br />
							</li>
							
							<li class="info_req">
								<label for="search">URL:</label>
								<input type="text" id="url" name="companyModel[slug]" value="<?php echo array_key_exists( 'slug',$companyModel) ? $companyModel['slug'] : '';?>" class="tooltip_trigger" title="Add URL" /><br />
							</li>
							
							<li class="info_req1">
								<label for="search">Logo Image 1:</label>
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
<?php ?>							
							<li class="info_req1">
								<label for="search">Logo Image 2:</label>
								<input type="file" id="logo2" name="companyModel[logo_image_2]" /><span>Image size: 400px X 250px</span> <br />
<?php 
if (isset($companyModel['logo_image_1']) && !empty($companyModel['logo_image_2']))
{
	if (file_exists($folderUrl.$companyModel['logo_image_2']))
		echo '<img src="'.$fileUrl.$companyModel['logo_image_2'].'"><br>';
}
?>									
							</li>
<?php ?>						
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
							
						<?php //widget::run('features'); ?>
							<li>	
								<hr/>
								<input type="hidden" id="company_id" name="companyModel[company_id]" value="<?php echo array_key_exists( 'company_id',$companyModel) ? $companyModel['company_id'] : '';?>" />
								<label for="search"></label>
								<input type="submit" name="submit" value="Submit" class="link_button"/>
								<a href="<?php echo $base_url; ?>admin/company" class="link_button grey">Cancel</a>
							</li>
						</ul>
					</fieldset>
				<?php echo form_close();?>
			
			</div>
		</div>
	