		<div class="content clearfix">
			<div class="col100">
			
				<h2>Create Company</h2>
			
					
<?php //echo validation_errors('<p class="error_msg">', '</p>'); ?> 
				<?php echo form_open(); ?>
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
	