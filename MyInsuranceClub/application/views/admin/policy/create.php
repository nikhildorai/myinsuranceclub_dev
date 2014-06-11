<script src="<?php echo $includes_dir;?>js/dynamicStyleRows.js"></script>
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
					$where = array();
					$where[0]['field'] = 'company_id';
					$where[0]['value'] = (int)$policyModel['company_id'];
					$where[0]['compare'] = 'equal';
					$compType = reset($this->util->getTableData($modelName='Insurance_company_master_model', $type="single", $where, $fields = array('company_type_id')));					
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
				<?php 
				$selected = array_key_exists( 'type_health_plan',$policyModel) ? $policyModel['type_health_plan'] : '';
				$healthOptions = $this->util->getCompanyTypeDropDownOptions($modelName ='Policy_health_type_model', $optionKey = 'type_id', $optionValue = 'type_name', $defaultEmpty = "Please Select");
				if ($modelType == 'create' && empty($selected) && empty($_POST))
				{
					$healthOptions = array();
					$pfTypeDisplay = 'none';
				}
				else if (!empty($_POST) && isset($_POST['type_health_plan']))
				{
					$pfTypeDisplay = 'block';
				}
				else if (!empty($selected))
				{
					$healthOptions = $allPolicyHealthType['data'][(int)$compType['company_type_id']];
					$pfTypeDisplay = 'block';
				}
				else 
				{
					$healthOptions = array();
					$pfTypeDisplay = 'block';
				}
				
				if (empty($healthOptions))
					$pfTypeDisplay = 'none';
					
				?>			
				<li class="info_req" id="type_health_plan_li" style="display:<?php echo $pfTypeDisplay;?>;">
					<label for="search">Product:</label>
					<?php 
					//
					echo form_dropdown('policyModel[type_health_plan]', $healthOptions, $selected, 'multiple id="type_health_plan" class="tooltip_trigger" title="Search by health type."');
					?>
				</li>
<?php /*?>				
				<li class="info_req">
					<label for="search">Variant:</label>
					<?php 
					$selected = array_key_exists( 'varient',$policyModel) ? $policyModel['varient'] : '';
					
					$op = array(
					    'name'        => 'policyModel[variant]',
					    'value'       => 'yes',
					    'checked'     => ($selected == 'yes') ? TRUE : FALSE,
					    'style'       => 'margin:10px',
					    );
					$op1 = array(
					    'name'        => 'policyModel[variant]',
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
<?php */ ?>
				<li class="info_req">
					<label for="search">SEO Title:</label>
					<input type="text" id="seo_title" name="policyModel[seo_title]" value="<?php echo array_key_exists( 'seo_title',$policyModel) ? $policyModel['seo_title'] : '';?>" class="tooltip_trigger" title="Add seo title" /><br />
				</li>
				
				<li class="info_req">
					<label for="search">SEO Description:</label>
					<textarea id="seo_description" name="policyModel[seo_description]" class="tooltip_trigger" title=" Add seo description" ><?php echo array_key_exists( 'seo_description',$policyModel) ? $policyModel['seo_description'] : '';?></textarea><br />
				</li>
				
				<li class="info_req">
					<label for="search">SEO Keywords:</label>
					<textarea id="seo_keywords" name="policyModel[seo_keywords]" class="tooltip_trigger" title="Add seo keywords"><?php echo array_key_exists( 'seo_keywords',$policyModel) ? $policyModel['seo_keywords'] : '';?></textarea><br />
				</li>
				
				<li class="info_req">
					<label for="search">URL:</label>
					<input type="text" id="url" name="policyModel[slug]" value="<?php echo array_key_exists( 'slug',$policyModel) ? $policyModel['slug'] : '';?>" class="tooltip_trigger" title="Add URL" /><br />
				</li>
			</ul>
		</fieldset>
		
		
		
		<fieldset>
			<legend>Variant Details</legend>
			
		<?php 
		$showBtn = true;
		$i = 1;
		$count = count($variantModel);
		?>
		<input type="hidden" id="tablerowcount" value="<?php echo $count;?>" />
			<div style="display: inline-block;width: 100%">
				<table class="dynatable tablesorter" style="border: 1px solid #aaa;">
                	<thead>
			            <tr style="background:none">
			            
			            	<td class="button-column" style="border-bottom:0; text-align: left;" colspan="3">
			            		<a href="javascript:void(0);" class="add">Add More</a>
			            	</td>
			            
			            </tr>
                		<tr>
		                    <th>#</th>
		                    <th>Variant Names</th>
		                    <th>Comments</th>
		                    <th>Remove</th>
						</tr>
                	</thead> 
                	<tbody>
                	
					<?php 
						$i = 1;	
						if (!empty($variantModel))
						{
							foreach ($variantModel as $k1=>$v1)
							{	
								if (!empty($v1))
								{				
									if ($i == 1)
									{	?>
										<tr id="tr<?php echo $i;?>" class="prototype"> 
					                    	<td>
					                    		<span id="spanId" class="incVal id add increment" ><?php echo $i;?><font color="red">*</font></span>
					                    		<input type="hidden" name="variantModel[variant_id][]" value="<?php echo $v1['variant_id'];?>">
					                    	</td>
					<?php 			}	
				                    else
					                {	?>
					                    <tr id="tr<?php echo $i;?>" class="<?php echo $i;?> item">
					                    	<td>
					                    		<span id="spanId" class="incVal" ><?php echo $i;?></span>
					                    		<input type="hidden" name="variantModel[variant_id][]" value="<?php echo $v1['variant_id'];?>">
					                    	</td>
				     <?php          }		 ?>
				     
					                    	<td>
					                    		<input type="text" name="variantModel[variant_name][]"  value="<?php echo $v1['variant_name'];?>">
					                    	</td>
					                    	<td>
					                    		<input type="text" name="variantModel[comments][]" value="<?php echo $v1['comments'];?>">
					                    	</td>
			                     <?php 	
									if ($i != 1)
									{
											echo '<td class="button-column"><a href="javascript:void(0);" class="remove">Remove</a></td>';
									}	?>
								</tr>
				<?php 					
									$i++;
								}
							}
						}
						else
						{
							if ($i == 1)
							{	?>
								<tr id="tr<?php echo $i;?>'" class="prototype"> 
			                    	<td>
			                    		<span id="spanId" class="incVal id add increment" ><?php echo $i;?><font color="red">*</font></span>
			                    		<input type="hidden" name="variantModel[variant_id][]">
			                    	</td>
			          		     	<td>
			                    		<input type="text" name="variantModel[variant_name][]" value="" >
			                    	</td>
			<?php 			}
		                    else
		                    {	?>
		                    	<tr id="tr<?php echo $i;?>" class="<?php echo $i;?> item">
			                    	<td>
			                    		<span id="spanId" class="incVal" ><?php echo $i;?></span>
			                    		<input type="hidden" name="variantModel[variant_id][]">
			                    	</td>
			          		     	<td>
			                    		<input type="text" name="variantModel[variant_name][]" >
			                    	</td>
		        <?php       }	?>
			                    	<td>
			                    		<input type="text" name="variantModel[comments][]">
			                    	</td>
		                		</tr>
		        <?php 	}	?>
					</tbody>
				</table>
			</div>
				
		</fieldset>
		
		<fieldset>
			<legend></legend>
			<ul>
				<li>
					<input type="hidden" id="policy_id" name="policyModel[policy_id]" value="<?php echo array_key_exists( 'policy_id',$policyModel) ? $policyModel['policy_id'] : '';?>" />
					<label for="search"></label>
					<input type="submit" name="submit" value="Submit" class="link_button"/>
					<a href="<?php echo $base_url; ?>admin/policy" class="link_button grey">Cancel</a>
				</li>
			</ul>
		</fieldset>
		
		
		
		<?php echo form_close();?>
	
	</div>
</div>
<script type="text/javascript">		
$(document).ready(function(){

	var myArray = [];
	<?php 
			foreach ($allPolicyHealthType['options'] as $k1=>$v1)
			{	?>
				myArray[<?php echo $k1;?>] = '<?php echo $v1;?>';
	<?php 	}
			?>	
	$('#company_id').change(function(){
		$('#type_health_plan_li').hide();
		var company_type_id = $(this).find(':selected').data('company_type_id');
		if(company_type_id != "")
		{
			if(myArray[company_type_id] != "" && myArray[company_type_id] != "undefined")
			{
				$('#type_health_plan').empty().append(myArray[company_type_id]);
				$('#type_health_plan_li').show();		
			}	
		}
	});
});


</script>
	