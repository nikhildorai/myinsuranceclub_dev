<?php $search_query = array();?>
		<div class="content clearfix">
			<div class="col100">
			
				<h2>Create Company</h2>
			
			<?php if (! empty($message)) { ?>
				<div id="message">
					<?php echo $message; ?>
				</div>
			<?php } ?>		
				<?php echo form_open('admin/company/create');	?>
					<fieldset>
						<legend>Company Details</legend>
						
						<label for="search">Search Company:</label>
						<input type="text" id="company" name="company" value="<?php echo array_key_exists( 'company',$search_query) ? $search_query['company'] : '';?>" class="tooltip_trigger" title="Search company by name, shortname, display name." /><br />
						<label for="search">Company Type:</label>
						<!-- <input type="select" id="company_type" name="company_type" value="<?php // echo ?>" class="tooltip_trigger" title="Search by company type."> -->
						<?php 
						$selected = array_key_exists( 'company_type',$search_query) ? $search_query['company_type'] : '';
						$options = $this->util->getCompanyTypeDropDownOptions();
						//sort($options);
						echo form_dropdown('company_type', $options, $selected, ' id="company_type" class="tooltip_trigger" title="Search by company type."');
						?>
						<br />
						<label for="search"></label>
						<input type="submit" name="search" value="Search" class="link_button"/>
						<a href="<?php echo $base_url; ?>admin/company" class="link_button grey">Reset</a>
						
					</fieldset>
				<?php echo form_close();?>
			
			</div>
		</div>
	