		<div class="content clearfix">
			<div class="col100">
			
				<h2>Create Company</h2>
			
			<?php if (! empty($message)) { ?>
				<div id="message">
					<?php echo $message; ?>
				</div>
			<?php } ?>		
				<?php echo form_open('admin/company/create'); ?>
					<fieldset>
						<legend>Company Details</legend>
						<ul>
							<li class="info_req">
								<label for="search">Company Name:</label>
								<input type="text" id="company_name" name="companyModel[company_name]" value="<?php echo array_key_exists( 'company_name',$companyModel) ? $companyModel['company_name'] : '';?>" class="tooltip_trigger" title="Unique company name." /><br />
							</li>
							
							<li>
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
						
							<li>	
								<hr/>
								<input type="hidden" id="company_id" name="companyModel[company_id]" value="<?php echo array_key_exists( 'company_id',$companyModel) ? $companyModel['company_id'] : '';?>" />
								<label for="search"></label>
								<input type="submit" name="submit" value="Submit" class="link_button"/>
							</li>
						</ul>
					</fieldset>
				<?php echo form_close();?>
			
			</div>
		</div>
	