<div class="content clearfix">
	<div class="col100">
	
		<h2>Create Policy</h2>
		<div class="download-row">
			<a href="<?php echo $base_url;?>admin/policy" class="link_button">Back</a>
		</div>
		<br>
		<br>							
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
					<label for="search">Policy Name:</label>
					<input type="text" id="policy_name" name="policyModel[policy_name]" value="<?php echo array_key_exists( 'policy_name',$policyModel) ? $policyModel['policy_name'] : '';?>" class="tooltip_trigger" title="Unique company name." /><br />
				</li>
				
				<li class="info_req">
					<label for="search">Company Name:</label>
					<?php 					
					$selected = array_key_exists( 'company_id',$policyModel) ? $policyModel['company_id'] : '';
					$options = $this->util->getCompanyTypeDropDownOptions($modelName ='Insurance_company_master_model', $optionKey = 'company_id', $optionValue = 'company_name', $defaultEmpty = "Please Select", $extraKeys = true);
					$optionsText = '<option value="" data-company_type_id="">Please Select</option>';
					foreach ($options as $k1=>$v1)
					{
						if ($selected == $v1['company_id'])
							$optionsText .= '<option value="'.$v1['company_id'].'" data-company_type_id="'.$v1['company_type_id'].'" selected>'.$v1['company_name'].'</option>';
						else
							$optionsText .= '<option value="'.$v1['company_id'].'" data-company_type_id="'.$v1['company_type_id'].'">'.$v1['company_name'].'</option>';
					}
				//	echo form_dropdown('policyModel[company_id]', $options, $selected, ' id="company_id" class="tooltip_trigger" title="Select company name."');
					?>
					<select id="company_id" class="tooltip_trigger" name="policyModel[company_id]" title="Select company name.">
						<?php echo $optionsText;?>
					</select>
				</li>
				
				<li class="info_req">
					<label for="search">Policy Health Type:</label>
					<?php 
					$selected = array_key_exists( 'type_health_plan',$policyModel) ? $policyModel['type_health_plan'] : '';
					$healthOptions = $this->util->getCompanyTypeDropDownOptions($modelName ='Policy_health_type_model', $optionKey = 'type_id', $optionValue = 'type_name', $defaultEmpty = "Please Select");
					echo form_dropdown('policyModel[type_health_plan]', $healthOptions, $selected, ' id="type_health_plan" class="tooltip_trigger" title="Search by health type."');
					?>
				</li>
				
				<li class="info_req">
					<label for="search">Variant:</label>
					<?php 
					$selected = array_key_exists( 'varient',$policyModel) ? $policyModel['varient'] : '';
					
					$op = array(
					    'name'        => 'policyModel[varient]',
					    'value'       => 'yes',
					    'checked'     => ($selected == 'yes') ? TRUE : FALSE,
					    'style'       => 'margin:10px',
					    );
					$op1 = array(
					    'name'        => 'policyModel[varient]',
					    'value'       => 'no',
					    'checked'     => ($selected == 'no') ? TRUE : FALSE,
					    'style'       => 'margin:10px',
					    );
					echo form_radio($op).'Yes';
					echo form_radio($op1).'No';
					
		//			$options = $this->util->getCompanyTypeDropDownOptions($modelName ='Policy_health_type_model', $optionKey = 'type_id', $optionValue = 'type_name', $defaultEmpty = "All");
		//			echo form_dropdown('policyModel[type_health_plan]', $options, $selected, ' id="type_health_plan" class="tooltip_trigger" title="Search by health type."');
					?>
				</li>
				
				<li>
					<hr/>
					<input type="hidden" id="company_id" name="policyModel[policy_id]" value="<?php echo array_key_exists( 'policy_id',$policyModel) ? $policyModel['policy_id'] : '';?>" />
					<label for="search"></label>
					<input type="submit" name="submit" value="Submit" class="link_button"/>
					<a href="<?php echo $base_url; ?>admin/company" class="link_button grey">Cancel</a>
				</li>
			</ul>
		</fieldset>
		<?php echo form_close();?>
	
	</div>
</div>
<script type="text/javascript">

$(document).ready(function(){
	$('#company_id').change(function(){
		
	});
});


</script>
	