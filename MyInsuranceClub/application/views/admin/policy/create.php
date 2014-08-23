<script src="<?php echo $includes_dir;?>js/dynamicPolicyRows.js"></script>
<script src="<?php echo  base_url()?>assets/js/multiFileUpload/script.js"></script>

<script type="text/javascript">

var pear_comparision_policies = "<?php echo (isset($policyModel['peer_comparision_variants']) && !empty($policyModel['peer_comparision_variants'])) ?  $policyModel['peer_comparision_variants'] : ''; ?>"
<!--
$(document).ready(function(){
<?php if (isset($policyModel['status']) && !empty($policyModel['status']) && in_array($policyModel['status'], array( 'inactive', 'delete'))) {?>
$(".form-horizontal :input").prop("disabled", true);
$("#addVariant").attr("disabled","disabled");
$("#dlBrochure").attr("disabled","disabled");
$("#dlWordings").attr("disabled","disabled");
$('.remove').prop('disabled', true);
<?php }?>	

	$('.changeDropDown').change(function(){
		var companyTypeId = $('#company_id').find(':selected').data('company_type_id');
		var companySlug = $('#company_id').find(':selected').data('company-slug');
		var prodSlug = '';
		var subProdSlug = '';
		var changeType = $(this).data('change-type'); 

		var options = $('#product_id option:selected');
		var productId = $.map(options ,function(option) {
		    return option.value;
		});      
	        
		var options = $('#sub_product_id option:selected');
		var subProductId = $.map(options ,function(option) {
		    return option.value;
		});
		

		 $('#product_id :selected').each(function (i, selected) {
			prodSlug = $(selected).data('slug');
	     });   
	        
		 $('#sub_product_id :selected').each(function (i, selected) {
				subProdSlug = $(selected).data('slug');
		 });  

		 
		if(companyTypeId == 1)
		{
			$('#companyTypeSlug').text('life-insurance/companies/'+companySlug+'/');
		}
		else if(prodSlug != "" && subProdSlug == "" && subProdSlug != 'undefined')
		{
			$('#companyTypeSlug').text(prodSlug+'/');
		}
		else if(prodSlug != "" && subProdSlug != "")
		{	
			if(prodSlug == 'health-insurance')
				$('#companyTypeSlug').text(prodSlug+'/');
			else if(prodSlug == 'international-travel')
				$('#companyTypeSlug').text(prodSlug+'/');
			else
				$('#companyTypeSlug').text(subProdSlug+'/');
		}
		else
			$('#companyTypeSlug').text("");
		
		var formData = {companyTypeId:companyTypeId, productId:productId, subProductId:subProductId, changeType:changeType };
		$('#'+changeType).empty()
		if(changeType == 'product_id')
		{
			$('#productIdDiv').show();
			$('#productSubIdDiv').hide();
			
		}
		if(changeType != "sub_product_type")
		{
			$.ajax({
					url:"<?php echo base_url().'/admin/policy/getProductSubProductDropDown'?>",
					type: "post",
					data: formData,
					success:function(result)
					{
						if(changeType == 'product_id')
						{
							$('#'+changeType).empty().append(result);
							$('#productIdDiv').show();
							$('#productSubIdDiv').hide();
							
						}
						if(changeType == 'sub_product_id')
						{
							$('#'+changeType).empty().append(result);
							$('#productIdDiv').show();
							$('#productSubIdDiv').show();
						}
			    	}
			});	
		}
		getPeerComparisionTable();
	});
var maxPolicyFeatures = <?php echo $this->config->config['policy']['descriptionCount'];?>;
	$(document).delegate('.showMoreLess','click',function(e){
		showMoreLessNum = parseInt($('#showMoreLessNum').val());
		var btnname = $(this).data('btnname');	
		if(btnname == 'more')
		{
			if(showMoreLessNum < maxPolicyFeatures)
			{
				$('#featureDiv'+(parseInt(showMoreLessNum+1))).show();
				$('#featureDiv'+(parseInt(showMoreLessNum+2))).show();
				$('#showMoreLessNum').val(parseInt(showMoreLessNum+2));
				showMoreLessNum = parseInt($('#showMoreLessNum').val());
				if(showMoreLessNum == maxPolicyFeatures)
					$('#showMore').hide();
				$('#showLess').show();
			}
		}
		else if(btnname == 'less')
		{
			if(showMoreLessNum > 2)
			{
				$('#featureDiv'+(parseInt(showMoreLessNum))).hide();
				$('#featureDiv'+(parseInt(showMoreLessNum-1))).hide();
				$('#showMoreLessNum').val(parseInt(showMoreLessNum-2));
				showMoreLessNum = parseInt($('#showMoreLessNum').val());
				if(showMoreLessNum == 2)
					$('#showLess').hide();
				$('#showMore').show();
			}
		}
	});

});
</script>

<div class="page" data-ng-controller="signupCtrl">
<?php 	$attributes = array('class'=>"form-horizontal form-validation");
		echo form_open_multipart(current_url(), $attributes);	
$policy_id = (isset($policyModel['policy_id']) && !empty($policyModel['policy_id'])) ? $policyModel['policy_id'] : '';
				?>
	<div class="panel panel-primary">
    	<div class="panel-heading">
        	<strong>
        		<span class="glyphicon glyphicon-th-list"></span> <?php echo (isset($policyModel['policy_id']) && !empty($policyModel['policy_id'])) ? 'Update Policy' : 'Create Policy';?> 
        	</strong>
        	
        	<a href="<?php echo $base_url;?>admin/policy/" class="btn btn-w-md btn-gap-v btn-default btn-sm" style="float: right; margin-top: -5px;">Cancel</a>
        	
        </div>
        
					        
		<?php 	if (! empty($message))
				{
					echo '<div class="col-md-12">
					            <section class="panel-default">';
					if (isset($msgType) && !empty($msgType))
					{
						if ($msgType=='error') 
							echo '<div class="callout callout-danger">';
						else if ($msgType=='success') 
							echo '<div class="callout callout-success">';
						else
							echo '<div class="callout callout-info">';
					}
					else
						echo '<div class="callout callout-success">';
									echo $message;
							echo '</div>';
					echo '		</section>
					      </div>';
				} ?>
				
	        <div class="row">
		        <div class="col-md-12">
				    <section class="panel panel-body">
							 
					    
					           
			        	<div class="row">
			        	    <div class="col-md-6">
					            <section class="panel panel-default">
					                <div class="panel-heading"><strong><span class="glyphicon glyphicon-th-list"></span> Policy Details</strong></div>
					                <div class="panel-body">
					                
						                <div class="form-group" style="margin-bottom: 5px;">
						                    <label for="Company Type" class="col-sm-3">Company Name</label>
						                    <div class="col-sm-9">
												<span class="ui-select "> 
													<?php 					
													$currentCompanyTypeSlug= "";
													$selected = array_key_exists( 'company_id',$policyModel) ? $policyModel['company_id'] : '';
													$options = $this->util->getCompanyTypeDropDownOptions($modelName ='Insurance_company_master_model', $optionKey = 'company_id', $optionValue = 'company_name', $defaultEmpty = "Please Select", $extraKeys = true);
													
													$optionsText = '<option value="" data-company_type_id="">Please Select</option>';
													foreach ($options as $k1=>$v1)
													{
														if ($selected == $v1['company_id'])
														{
															if($v1['company_type_id']==1)
																$currentCompanyTypeSlug = 'life-insurance/companies/'.$v1['slug'].'/';
															$optionsText .= '<option value="'.$v1['company_id'].'" data-company_type_id="'.$v1['company_type_id'].'" data-company-slug="'.$v1['slug'].'" selected>'.$v1['company_name'].'</option>';
														}
														else
															$optionsText .= '<option value="'.$v1['company_id'].'" data-company_type_id="'.$v1['company_type_id'].'" data-company-slug="'.$v1['slug'].'" >'.$v1['company_name'].'</option>';
													}
												//	echo form_dropdown('policyModel[company_id]', $options, $selected, ' id="company_id" class="tooltip_trigger" title="Select company name."');
													?>
													<select id="company_id" class="changeDropDown" data-change-type="product_id" name="policyModel[company_id]" title="Select company name." style="width: 345px;margin-top: 0px;">
														<?php echo $optionsText;?>
													</select>	
												</span> 
						                    </div>
						                </div>

										<?php
										$compType = '';
										$where = array();
										if (!empty($selected))
										{
											$where[0]['field'] = 'company_id';
											$where[0]['value'] = (int)$policyModel['company_id'];
											$where[0]['compare'] = 'equal';
											$compType = reset($this->util->getTableData($modelName='Insurance_company_master_model', $type="single", $where, $fields = array('company_type_id')));
										}
										$where = array();
										if (!empty($compType))
										{
											$where[0]['field'] = 'company_type_id';
											$where[0]['value'] = $compType['company_type_id'];
											$where[0]['compare'] = 'findInSet';
										}
										$selected = array_key_exists( 'product_id',$policyModel) ? explode(',',$policyModel['product_id']) : array();
										$sqlFilter['orderBy'] = 'product_name';
										$productOptions = $this->util->getCompanyTypeDropDownOptions($modelName ='Product_model', $optionKey = 'product_id', $optionValue = 'product_name', $defaultEmpty = "Please Select", $extraKeys = true, $where, $sqlFilter);										
										if (!empty($productOptions))
										{
											$prodOptionsText = '<option value="" data-company_type_id="">Please Select</option>';
											foreach ($productOptions as $k1=>$v1)
											{
												if (in_array($v1['product_id'], $selected))
												{
													$currentCompanyTypeSlug = $v1['slug'].'/';
													$prodOptionsText .= '<option value="'.$v1['product_id'].'" data-slug="'.$v1['slug'].'" selected>'.$v1['product_name'].'</option>';
												}
												else
													$prodOptionsText .= '<option value="'.$v1['product_id'].'" data-slug="'.$v1['slug'].'" >'.$v1['product_name'].'</option>';
											}
										} 		
										?>			
						                <div id = "productIdDiv" class="form-group" style="margin-bottom: 5px;">
						                    <label for="Company Type" class="col-sm-3">Product</label>
						                    <div class="col-sm-9">
												<span class="ui-select "> 
													<select id="product_id" class="changeDropDown" data-change-type="sub_product_id" multiple name="policyModel[product_id][]" style="width: 345px;margin-top: 0px;">
														<?php echo $prodOptionsText;?>
													</select>
												<?php 
													//echo form_dropdown('policyModel[product_id][]', $productOptions, $selected, 'multiple id="product_id" class="tooltip_trigger changeDropDown" data-change-type="sub_product_id" title="Search by health type." style="width: 345px; margin-bottom: 0px;"');
												?>		
												</span> 
						                    </div>
						                </div>
						                
										<?php
										$where = array();
										$selected = array_key_exists( 'sub_product_id',$policyModel) ? explode(',', $policyModel['sub_product_id']) : array();
	
										$sqlFilter['orderBy'] = 'sub_product_name';
										$subProductOptions = $this->util->getCompanyTypeDropDownOptions($modelName ='Sub_product_model', $optionKey = 'sub_product_id', $optionValue = 'sub_product_name', $defaultEmpty = "Please Select", $extraKeys = true, $where, $sqlFilter);
										if (!empty($subProductOptions))
										{
											$subProdOptionsText = '<option value="" data-company_type_id="">Please Select</option>';
											foreach ($subProductOptions as $k1=>$v1)
											{
												if (in_array($v1['sub_product_id'], $selected))
												{
													$currentCompanyTypeSlug = $v1['slug'].'/';
													$subProdOptionsText .= '<option value="'.$v1['sub_product_id'].'" data-slug="'.$v1['slug'].'" selected>'.$v1['sub_product_name'].'</option>';
												}
												else
													$subProdOptionsText .= '<option value="'.$v1['sub_product_id'].'" data-slug="'.$v1['slug'].'" >'.$v1['sub_product_name'].'</option>';
											}
										}
										?>		
						                <div id= "productSubIdDiv" class="form-group"  style="margin-bottom: 5px;">
						                    <label for="Company Type" class="col-sm-3">Sub Product</label>
						                    <div class="col-sm-9">
												<span class="ui-select "> 
													<select id="sub_product_id" class="changeDropDown" data-change-type="sub_product_type" multiple name="policyModel[sub_product_id][]" style="width: 345px;margin-top: 0px;">
														<?php echo $subProdOptionsText;?>
													</select>
												<?php 
													//echo form_dropdown('policyModel[sub_product_id][]', $subProductOptions, $selected, 'multiple id="sub_product_id" class="tooltip_trigger" data-change-type="sub_product_id" title="Search by health type." style="width: 345px;"');
												?>		
												</span> 
						                    </div>
						                </div>
						                
						                
						                <div class="form-group">
						                    <label for="" class="col-sm-3">Policy Name</label>
						                    <div class="col-sm-9">
			                    			<span class="icon glyphicon glyphicon-star"></span>
						                        <input type="text" required class="form-control" placeholder="" id="policy_name" name="policyModel[policy_name]" value="<?php echo array_key_exists( 'policy_name',$policyModel) ? $policyModel['policy_name'] : '';?>"  >
						                    </div>
						                </div>
						                
						                <div class="form-group">
						                    <label for="" class="col-sm-3">Policy Display Name</label>
						                    <div class="col-sm-9">
			                    			<span class="icon glyphicon glyphicon-star"></span>
						                        <input type="text" required class="form-control" placeholder="" id="policy_display_name" name="policyModel[policy_display_name]" value="<?php echo array_key_exists( 'policy_display_name',$policyModel) ? $policyModel['policy_display_name'] : '';?>"  >
						                    </div>
						                </div>
						                
						                
						                <div class="form-group">
						                    <label for="" class="col-sm-3">Policy UIN</label>
						                    <div class="col-sm-9">
			                    			<span class="icon glyphicon glyphicon-star"></span>
						                        <input type="text" class="form-control" placeholder="" id="policy_uin" name="policyModel[policy_uin]" value="<?php echo array_key_exists( 'policy_uin',$policyModel) ? $policyModel['policy_uin'] : '';?>"  >
						                    </div>
						                </div>
						                
						                
						                <div class="form-group">
						                    <label for="" class="col-sm-3">Show in Search</label>
						                    <div class="col-sm-9">
							                    <?php 
												$selected = array_key_exists( 'show_in_search',$policyModel) ? $policyModel['show_in_search'] : 'no';
												$options = array('yes'=>'Yes', 'no'=>'No');			
												foreach ($options as $k1=>$v1)
												{
													$op = array(
													    'name'        => 'policyModel[show_in_search]',
													    'value'       => $k1,
													    'checked'     => ($selected == $k1) ? TRUE : FALSE,
													    'style'       => 'margin:10px',
													    );
													echo '<label class="ui-radio">'.form_radio($op).'<span>'.$v1.'</span></label>';
												}
												?>
						                    </div>
						                </div>
						                
								                
					                <div class="form-group">
					                    <label for="" class="col-sm-3">SEO Title</label>
					                    <div class="col-sm-9">
					                    	<span class="icon glyphicon glyphicon-star"></span>
					                        <input type="text" class="form-control charecterCount" required  placeholder="SEO Title" maxlength="90" id="seo_title" name="policyModel[seo_title]" maxlength="90" value="<?php echo array_key_exists( 'seo_title',$policyModel) ? $policyModel['seo_title'] : '';?>" >
					                         <span class="help-block" style="margin-bottom: -5px;">Max 90 chars | Recommended 60 chars</span>
					                        <span class="help-block currentLength"><?php echo array_key_exists( 'seo_title',$policyModel) ? 'Current length: '.strlen($policyModel['seo_title']).' chars' : '0'.' chars';?></span>
					                    </div>
					                </div>
					                
					                <div class="form-group">
					                    <label for="" class="col-sm-3">SEO Description</label>
					                    <div class="col-sm-9">
					                    	<span class="icon glyphicon glyphicon-star"></span>
					                        <textarea class="form-control charecterCount" rows="5" required maxlength="250" id="seo_description" name="policyModel[seo_description]"><?php echo array_key_exists( 'seo_description',$policyModel) ? $policyModel['seo_description'] : '';?></textarea>
					                        <span class="help-block" style="margin-bottom: -5px;">Max 250 chars | Recommended 150 chars</span>
					                        <span class="help-block currentLength"><?php echo array_key_exists( 'seo_description',$policyModel) ? 'Current length: '.strlen($policyModel['seo_description']).' chars' : '0'.' chars';?></span>
					                    </div>
					                </div>
					                
					                <div class="form-group">
					                    <label for="" class="col-sm-3">SEO Keywords</label>
					                    <div class="col-sm-9">
					                    	<span class="icon glyphicon glyphicon-star"></span>
					                        <textarea class="form-control charecterCount" rows="4" required  maxlength="175" id="seo_keywords" name="policyModel[seo_keywords]"><?php echo array_key_exists( 'seo_keywords',$policyModel) ? $policyModel['seo_keywords'] : '';?></textarea>
					                        <span class="help-block" style="margin-bottom: -5px;">Max 175 chars | Recommended 150 chars</span>
					                        <span class="help-block currentLength"><?php echo array_key_exists( 'seo_keywords',$policyModel) ? 'Current length: '.strlen($policyModel['seo_keywords']).' chars' : '0'.' chars';?></span>
					                    </div>
					                </div>
								                
						                
						                
						                
										<?php 
										//	tagit widget
										echo widget::run('tagit'); ?>
										
						                <div class="form-group">
						                    <label for="" class="col-sm-3">URL</label>
						                    <div class="col-sm-9">
						                    	<span class="icon glyphicon glyphicon-star"></span>
			<?php 								if (isset($policyModel['slug']))	{?>
						                        	<input type="text" class="form-control slug" placeholder="URL"  name="policyModel[slug]" value="<?php echo $policyModel['slug'];?>" >
						                        	<?php /*?><span class="help-block" style="color:black;font-size: 12px"><a href="<?php echo ($currentCompanyTypeSlug == 'life-insurance') ? base_url().$currentCompanyTypeSlug.'/companies/'.$policyModel['slug'] : base_url().$currentCompanyTypeSlug.'/'.$policyModel['slug'];?>"><?php echo ($currentCompanyTypeSlug == 'life-insurance') ? base_url().$currentCompanyTypeSlug.'/companies/'.$policyModel['slug'] : base_url().$currentCompanyTypeSlug.'/'.$policyModel['slug'];?></a></span> */ ?>	
			<?php 								}else{	?>
						                        	<input type="text" class="form-control slug"  tooltip="Once created you cannot edit this field" data-toggle="tooltip" data-placement="top" tooltip-trigger="focus" required placeholder="URL"  name="policyModel[slug]" value="" >
			<?php 								}?>		
						                        	<span class="help-block" style="color:black;font-size: 12px"><?php echo base_url();?><span id="companyTypeSlug"><?php echo $currentCompanyTypeSlug;?></span><span class="slug"><?php echo array_key_exists( 'slug',$policyModel) ? $this->util->getSlug($policyModel['slug']) : '';?></span>/</span>	                        
						                        
						                    </div>
						                </div>
						              <?php /*?>  
						                <div class="form-group">
						                    <label for="" class="col-sm-3">URL</label>
						                    <div class="col-sm-9">
						                    	<span class="icon glyphicon glyphicon-star"></span>
			<?php 								if (isset($policyModel['slug']))	{?>
						                        	<input type="text" class="form-control slug" disabled placeholder="URL"  name="policyModel[slug]" value="<?php echo $policyModel['slug'];?>" >
						                        	<span class="help-block" style="color:black;font-size: 12px"><a href="<?php echo base_url().$currentCompanyTypeSlug.$policyModel['slug'];?>"><?php echo base_url().$currentCompanyTypeSlug.$policyModel['slug'];?></a></span>
			<?php 								}else{	?>
						                        	<input type="text" class="form-control slug"  tooltip="Once created you cannot edit this field" data-toggle="tooltip" data-placement="top" tooltip-trigger="focus" required placeholder="URL"  name="policyModel[slug]" value="" >
						                        	<span class="help-block" style="color:black;font-size: 12px"><?php echo base_url();?><span id="companyTypeSlug"><?php echo $currentCompanyTypeSlug;?></span><span class="slug"><?php echo array_key_exists( 'slug',$policyModel) ? $policyModel['slug'] : '';?></span></span>
			<?php 								}?>			                        
						                        
						                    </div>
						                </div>
						                */ ?>
					                </div>
					            </section>
					        </div>
					        
					        
					        <div class="col-md-6">
					            <section class="panel panel-default">
					                <div class="panel-heading"><strong><span class="glyphicon glyphicon-th-list"></span> Policy Documents</strong></div>
					                <div class="panel-body">
					                
			                
			                <div class="form-group">
			                    <label for="" class="col-sm-3">Brochure</label>
			                    <div class="col-sm-9">
			                        <input type="file" id="logo1" name="policyModel[brochure]"  title="Choose File" data-ui-file-upload class="btn-info" value="<?php echo array_key_exists( 'brochure',$policyModel) ? $policyModel['brochure'] : '';?>">
			                        <span class="help-block">Max upload 5MB</span>
			                    
			                    <?php 
											$folderUrl = $this->config->config['folder_path']['policy']['brochure'];
											$fileUrl = $this->config->config['url_path']['policy']['brochure'];
											
											if (isset($policyModel['brochure']) && !empty($policyModel['brochure']))
											{
												if (file_exists($folderUrl.$policyModel['brochure']))
												{
													echo 	'<div class="divider"></div>
				                    						<a href="'.base_url().'admin/policy/download/'.$policyModel['policy_id'].'/brochure" title="download" class="btn btn-success"><span class="glyphicon glyphicon-download-alt"></span> Download</a>
				                    						<a id="dlBrochure" href="'.base_url().'admin/policy/deleteFile/'.$policyModel['policy_id'].'/brochure" title="download" class="btn btn-danger" tooltip-animation="false" tooltip="Save data before clicking on remove button"><span class="glyphicon glyphicon-remove"></span> Remove</a>';
												}
											}
											?>
								</div>
			                </div>
			                
			                <div class="form-group">
			                </div>
			                <div class="form-group">
			                </div>
			                <div class="form-group">
			                </div>
			                
			                <div class="form-group">
			                    <label for="" class="col-sm-3">Policy Wordings</label>
			                    <div class="col-sm-9">
			                        <input type="file" id="logo1" name="policyModel[policy_wordings]"  title="Choose File" data-ui-file-upload class="btn-info" value="<?php echo array_key_exists( 'policy_wordings',$policyModel) ? $policyModel['policy_wordings'] : '';?>">
			                        <span class="help-block">Max upload 5MB</span>
			                    <?php 
											$folderUrl = $this->config->config['folder_path']['policy']['policy_wordings'];
											$fileUrl = $this->config->config['url_path']['policy']['policy_wordings'];
											
											if (isset($policyModel['policy_wordings']) && !empty($policyModel['policy_wordings']))
											{
												if (file_exists($folderUrl.$policyModel['policy_wordings']))
												{
													echo '<div class="divider"></div>
				                    						<a href="'.base_url().'admin/policy/download/'.$policyModel['policy_id'].'/policy_wordings" title="download" class="btn btn-success"><span class="glyphicon glyphicon-download-alt"></span> Download</a>
				                    						<a id="dlWordings" href="'.base_url().'admin/policy/deleteFile/'.$policyModel['policy_id'].'/policy_wordings" title="download" class="btn btn-danger" tooltip-animation="false" tooltip="Save data before clicking on remove button"><span class="glyphicon glyphicon-remove"></span> Remove</a>';
													
				                    						//<input type="submit" name="removeFile-policy_wordings" value="Remove" class="btn btn-success btn-lg glyphicon glyphicon-remove  " />
												}
											}
								?>		   
								</div>
			                 							
			                </div>
							
			                <div class="form-group">
			                </div>
			                <div class="form-group">
			                </div>
			                <div class="form-group">
			                </div>
			                
			                <div class="form-group">
			                    <label for="" class="col-sm-3">Policy Logo:</label>
			                    <div class="col-sm-9">
			                        <input type="file" id="logo1" name="policyModel[policy_logo]"  title="Choose File" data-ui-file-upload class="btn-info" value="<?php echo array_key_exists( 'policy_logo',$policyModel) ? $policyModel['policy_logo'] : '';?>">
			                        <span class="help-block">Image size: 172px X 68px <br>If policy logo is not uploaded, sytem will take default as company logo.</span>
			                    
			                    <?php 
											$folderUrl = $this->config->config['folder_path']['policy']['policy_logo'];
											$fileUrl = $this->config->config['url_path']['policy']['policy_logo'];
											
											if (isset($policyModel['policy_logo']) && !empty($policyModel['policy_logo']))
											{
												if (file_exists($folderUrl.$policyModel['policy_logo']))
												{
													echo 	'<div class="divider"></div>
				                    						<img src="'.$fileUrl.$policyModel['policy_logo'].'">';
												}
											}
											?>
								</div>
			                </div>
			                
		           	  
			                <div class="form-group">
			                </div>
			                <div class="form-group">
			                </div>
			                <div class="form-group">
			                </div>
			                
			                <div class="form-group">
			                    <label for="" class="col-sm-3">Key Features</label>
			                    <div class="col-sm-9">
			                    <?php 
			                    $keyFeatures = array();
			                    if(array_key_exists( 'key_features',$policyModel) &&  !empty($policyModel['key_features']))
			                    {
			                    	$keyFeatures = unserialize( $policyModel['key_features']);			                    	
			                    }	                    
			                    for ($i = 0; $i < $this->config->config['policy']['keyFeatures']; $i++)
			                    {
			                    	if($i==0){ echo '<span class="icon glyphicon glyphicon-star"></span>';}
			                    ?>
			                        <input type="text" class="form-control"  <?php echo ($i==0) ? "required" : '';?> placeholder="Key feature <?php echo $i+1;?>"  id="url" name="policyModel[key_features][]" value="<?php if (!empty($keyFeatures)) { echo array_key_exists( $i,$keyFeatures) ? $keyFeatures[$i] : ''; }?>"  >
			                        <div class="divider"></div>
			             <?php 	}?>
			                    </div>
			                </div>
			                
										
			                <div class="form-group">
			                    <label for="" class="col-sm-3">Tweet Property</label>
			                    <div class="col-sm-9">
			                        <input type="text" class="form-control" placeholder="Tweet property" maxlength="125" id="tweet_property" name="policyModel[tweet_property]" value="<?php echo array_key_exists( 'tweet_property',$policyModel) ? $policyModel['tweet_property'] : '';?>"  >
			                        <span class="help-block">Max length 125 characters.</span>
			                    </div>
			                </div>
			                
			                <div class="form-group">
			                    <label for="" class="col-sm-3">Quick Overviews</label>
			                    <div class="col-sm-9">
			                    	<span class="icon glyphicon glyphicon-star"></span>
			                        <textarea class="form-control" rows="5" required maxlength="250" id="quick_overview" name="policyModel[quick_overview]"><?php echo array_key_exists( 'quick_overview',$policyModel) ? $policyModel['quick_overview'] : '';?></textarea>
			                    </div>
			                </div>
			                
			                <div class="form-group">
			                    <label for="Company Type" class="col-sm-3">Created By</label>
			                    <div class="col-sm-9">
									<span class="ui-select "> 
										<?php 			
										$selected = array_key_exists( 'created_by_user_id',$policyModel) ? $policyModel['created_by_user_id'] : '';?>
										<select id="created_by_user_id" name="policyModel[created_by_user_id]" required style="margin-top: 0px;">
											<?php echo $this->util->getUserDropdownList($selected);?>
										</select>	
									</span> 
			                    </div>
			                </div>
                
                
                
					                </div>
					            </section>
					        </div>
					    </div>
					     	
					    
					    

			        	<div class="row">
					        <div class="col-md-12">
					            <section class="panel panel-default">
					                <div class="panel-heading"><strong><span class="glyphicon glyphicon-th-list"></span> Who all can be covered</strong></div>
									<div class="panel-body">    
						                <div class="col-sm-12">    
											
							                <div class="form-group">
							                    <label for="" class="col-sm-3">Composition</label>
							                    <div class="col-sm-9">
							                    <?php 				 
														$selected = !empty($policyModel['policy_composition_type']) ? $policyModel['policy_composition_type'] : 'individual';
														$options = array('individual'=>'Individual', 'family floater'=>'Family Floater');
														foreach ($options as $k1=>$v1)
														{
															$op = array(
																'class'			=>	'policy_composition_type',
															    'name'        	=> 'policyModel[policy_composition_type]',
															    'value'       	=> $k1,
															    'checked'     	=> ($selected == $k1) ? TRUE : FALSE,
															    'style'       	=> 'margin:10px',
															    );
															echo '<label class="ui-radio">'.form_radio($op).'<span>'.$v1.'</span></label>';
														}
													?>
							                    </div>
							                </div>
							                 
							                <div class="form-group"id="familyCompositionDiv" style="display:<?php echo ($selected == 'individual') ? 'none' : 'block';?>;">
							                
								                <div class="form-group">
								                </div>
								                <div class="form-group">
								                </div>
												
							                    <label for="" class="col-sm-3">Member Split</label>
							                    <div class="col-sm-9">
							                    			
															
													<div class="row">
										                <div class="form-group row col-sm-6" style="margin-bottom: 5px;" >
										                    <label for="Company Type" class="col-sm-3">Adults</label>
										                    <div class="col-sm-9">
																<span class="ui-select "> 
																	<?php 				
																	$policy_composition_type = !empty($policyModel['policy_composition']) ? explode(',', $policyModel['policy_composition']) : array();
																	$options = array(	'1A'=>'1 Adults',	'2A'=>'2 Adults', 	'3A'=>'3 Adults', 	'3A'=>'3 Adults', 	'4A'=>'4 Adults',
																						'5A'=>'5 Adults', 	'6A'=>'6 Adults', 	'7A'=>'7 Adults', 	'8A'=>'8 Adults', 	'9A'=>'9 Adults',	
																						'10A'=>'10 Adults', '11A'=>'11 Adults', '12A'=>'12 Adults', '13A'=>'13 Adults', '14A'=>'14 Adults', 
																						'15A'=>'15 Adults');
																	
																	echo form_dropdown('policyModel[policy_composition][]', $options, reset($policy_composition_type), 'style="margin-top: 0px;"');
																	?>	
																</span> 
										                    </div>
										                </div>
															
										                <div class="form-group row col-sm-6" style="margin-bottom: 5px;">
										                    <label for="Company Type" class="col-sm-3">Children</label>
										                    <div class="col-sm-6">
																<span class="ui-select "> 
																	<?php 		
																	$options = array();			
																	$options = array(	'1C'=>'1 Child', 	'2C'=>'2 Children', 	'3C'=>'3 Children', 	'4C'=>'4 Children',
																						'5C'=>'5 Children', '6C'=>'6 Children', 	'7C'=>'7 Children', 	'8C'=>'8 Children',
																						'9C'=>'9 Children', '10C'=>'10 Children');
																	echo form_dropdown('policyModel[policy_composition][]', $options, end($policy_composition_type), 'style="margin-top: 0px;"');
																	?>	
																</span> 
										                    </div>
										                </div>
													</div>				
															
							                    </div>
							                </div>
							                
						             	</div>
						            </div>
					            </section>
					        </div>
					    </div> 
					    
					    
					    

			        	<div class="row">
					        <div class="col-md-12">
					            <section class="panel panel-default">
					                <div class="panel-heading"><strong><span class="glyphicon glyphicon-th-list"></span> Coverage Amounts</strong></div>
									<div class="panel-body">    
						                <div class="col-sm-12">    
										<?php 
											$values = !empty($policyModel['policy_coverage_amounts']) ? explode(',', $policyModel['policy_coverage_amounts']) : array();
											for ($i = 25000; $i <= 1000000; $i += 25000) 
											{	
												$checked = (in_array($i, $values)) ? 'checked' : '';
												?>
												<div class="col-sm-2">
													<label class="ui-checkbox">
														<input name="policyModel[policy_coverage_amounts][]" type="checkbox" value="<?php echo $i;?>" data-display-val="<?php echo Util::moneyFormatIndia($i)?>" class="policy_coverage_amounts" <?php echo $checked;?> > <span><?php echo Util::moneyFormatIndia($i)?></span>
													</label>
						                        </div>  
									<?php 	}
											for ($i = 1500000; $i <= 10000000; $i += 500000) 
											{	
												$checked = (in_array($i, $values)) ? 'checked' : '';
												?>
												<div class="col-sm-2">
													<label class="ui-checkbox">
														<input name="policyModel[policy_coverage_amounts][]" type="checkbox" value="<?php echo $i;?>" data-display-val="<?php echo Util::moneyFormatIndia($i)?>" class="policy_coverage_amounts" <?php echo $checked;?> > <span><?php echo Util::moneyFormatIndia($i)?></span>
													</label>
						                        </div> 
									<?php 	}	?>
						                     </div>
						             	</div>
						            </div>
					            </section>
					        </div>
					    </div> 
					        
					    				    
			        	<div class="row">
					        <div class="col-md-12">
					            <section class="panel panel-default">
					                <div class="panel-heading"><strong><span class="glyphicon glyphicon-th-list"></span> Variants Details</strong></div>
					                <div class="panel-body">          
									<?php 
									$showBtn = true;
									$i = 1;
									$count = count($variantModel);
									
									?>
										<input type="hidden" id="tablerowcount" value="<?php echo $count;?>" />
											<table class="dynatable table table-bordered table-striped cf ">
							                	<thead class="cf">
										            <tr>
										            	<td colspan="4">
										            		<a href="javascript:void(0);" id="addVariant" class="add btn btn-info"><span class="glyphicon glyphicon-plus"></span> Add Variants</a>
										            	</td>
										            </tr>
							                		<tr>
									                    <th>#</th>
									                    <th>Variant Names</th>
									                    <th>Comments</th>
									                    <th>Status</th>
									                    <th  style="width: 74px;" align="center" >Remove</th>
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
												                    	<td  align="center" >
												                    		<span id="spanId" class="incVal id add increment" ><?php echo $i;?><font color="red">*</font></span>
												                    		<input type="hidden" name="variantModel[variant_id][]" value="<?php echo $v1['variant_id'];?>">
												                    	</td>
												<?php 			}	
											                    else
												                {	?>
												                    <tr id="tr<?php echo $i;?>" class="<?php echo $i;?> item">
												                    	<td  align="center" >
												                    		<span id="spanId" class="incVal" ><?php echo $i;?></span>
												                    		<input type="hidden" name="variantModel[variant_id][]" value="<?php echo $v1['variant_id'];?>">
												                    	</td>
											     <?php          }		 ?>
											     						<?php $isDisabled = (isset($v1['status']) && $v1['status'] != 'active') ? 'disabled' : '';?>
												                    	<td>
												                    		<input type="text" class="form-control" <?php echo $isDisabled;?> placeholder="Variant Name"  name="variantModel[variant_name][]" value="<?php echo $v1['variant_name'];?>" >
												                    	</td>
												                    	<td>
												                    		<input type="text" class="form-control" <?php echo $isDisabled;?> placeholder="Variant Comments"  name="variantModel[comments][]" value="<?php echo $v1['comments'];?>" >
												                    	</td>
												                    	<td class="variantStatus">
												                    		<?php echo $this->util->getStatusIcon($v1['status']); ?>
												                    	</td>
										                     <?php 	
																if ($i != 1)
																{
																		echo '<td align="center" ><a href="javascript:void(0);" class="remove btn-icon-round btn-icon-round-sm bg-danger"><span class="glyphicon glyphicon-remove"></span></a></td>';
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
										                    	<td align="center" >
										                    		<span id="spanId" class="incVal id add increment" ><?php echo $i;?><font color="red">*</font></span>
										                    		<input type="hidden" name="variantModel[variant_id][]">
										                    	</td>
										          		     	<td>
										          		     		<input type="text" class="form-control"  placeholder="Variant Name"  name="variantModel[variant_name][]">
										                    	</td>
										<?php 			}
									                    else
									                    {	?>
									                    	<tr id="tr<?php echo $i;?>" class="<?php echo $i;?> item">
										                    	<td align="center" >
										                    		<span id="spanId" class="incVal" ><?php echo $i;?></span>
										                    		<input type="hidden" name="variantModel[variant_id][]">
										                    	</td>
										          		     	<td>
										          		     		<input type="text" class="form-control"  placeholder="Variant Name"  name="variantModel[variant_name][]">
										                    	</td>
									        <?php       }	?>
										                    	<td>
										                    		<input type="text" class="form-control"  placeholder="Variant Comments"  name="variantModel[comments][]">
										                    	</td>
										                    	<td class="variantStatus">
												                    <?php echo $this->util->getStatusIcon('active'); ?>
										                    	</td>
									                		</tr>
									        <?php 	}	?>
							                	
							                	
												</tbody>
											</table>
						                
					                </div>
					            </section>
					        </div>
					        
			        	
					    </div>

					    

			        	<div class="row">
					        <div class="col-md-12">
					            <section class="panel panel-default">
					                <div class="panel-heading"><strong><span class="glyphicon glyphicon-th-list"></span> Policy Wording Images</strong></div>
									<div class="panel-body">    
						                <div class="col-sm-12">    
											<?php echo widget::run('multiFileUpload', array('policy_id'=>$policy_id, 'policyModel'=>$policyModel, 'modelName'=>'policyModel','fieldName'=>'policy_wordings_images','uploadType'=>'policy_wordings_images')); ?>
						             	</div>
						            </div>
					            </section>
					        </div>
					    </div> 
					    

			        	<div class="row">
					        <div class="col-md-12">
					            <section class="panel panel-default">
					                <div class="panel-heading"><strong><span class="glyphicon glyphicon-th-list"></span> Brochure Images</strong></div>
									<div class="panel-body">    
						                <div class="col-sm-12">    
											<?php echo widget::run('multiFileUpload', array('policy_id'=>$policy_id, 'policyModel'=>$policyModel, 'modelName'=>'policyModel','fieldName'=>'brochure_images','uploadType'=>'brochure_images')); ?>
						             	</div>
						            </div>
					            </section>
					        </div>
					    </div> 
					    					    
					    
					    
			        	<div class="row">
					        <div class="col-md-12">
					            <section class="panel panel-default">
					                <div class="panel-heading"><strong><span class="glyphicon glyphicon-th-list"></span> Policy Features Details</strong></div>
									<div class="panel-body">    
						                <div class="col-sm-12">
						                <input type="hidden" name="policyFeaturesModel[policy_feature_id]" value="<?php echo array_key_exists( 'policy_feature_id',$policyFeaturesModel) ? $policyFeaturesModel['policy_feature_id'] : '';?>">
						                <?php 	
											$descCount = $this->config->config['policy']['descriptionCount'];
											for($i = 1; $i<=$descCount;  $i++)
											{	?>
											
								                <div class="form-group" id="featureDiv<?php echo $i;?>" style="display:<?php echo ($i > 2) ? 'none' : 'block';?>;" >
								                    <label for="" class="col-sm-2">Heading <?php echo $i;?></label>
								                    <div class="col-sm-10">
								                        <input type="text" class="form-control" placeholder="" name="policyFeaturesModel[heading<?php echo $i; ?>]" value="<?php echo array_key_exists( 'heading'.$i,$policyFeaturesModel) ? $policyFeaturesModel['heading'.$i] : '';?>" >
								                    </div>
									                <div class="form-group">
									                </div>
								                    <label for="" class="col-sm-2">Description <?php echo $i;?></label>
								                    <div class="col-sm-10">
								                        <textarea class="form-control ckeditor" name="policyFeaturesModel[description<?php echo $i; ?>]"  ><?php echo array_key_exists( 'description'.$i,$policyFeaturesModel) ? $policyFeaturesModel['description'.$i] : '';?></textarea>
								            			<?php echo display_ckeditor($ckeditor); ?>            
											<?php 
								                        //$ck = 'ckeditor'.$i;
								                        //echo display_ckeditor($this->data['ckeditor'.$i]); ?>
								                    </div>
									                <div class="form-group">
									                </div>
								                </div>
								                
				<?php 						}
											if ($descCount > 2)
											{    ?>
								                <div class="form-group">
								                    <label for="" class="col-sm-2"></label>
								                    <div class="col-sm-10">
								                    	<input type="hidden" id="showMoreLessNum" value="2" />
								                        <a href = "javascript:void(0);"  class="btn btn-sm btn-success showMoreLess" id="showMore" data-btnname="more">Show More</a>   
								                        <a href = "javascript:void(0);"  class="btn btn-sm btn-warning showMoreLess" id="showLess" data-btnname="less" style="display: none;">Show Less</a>   
								                    </div>
								                </div>
							   <?php 		}	?>             
						               	 	</div>
						                </div>
					            </section>
					        </div>
					    </div> 

				        <div class="row">
					        <div class="col-md-12">
					        	<div class="panel-body">    
						            <section class="panel panel-default">
						                <div class="panel-heading"><strong><span class="glyphicon glyphicon-th-list"></span> Additional Details</strong></div>
						                <div class="panel-body">
						                
						                	<?php //echo widget::run('additionalDetailsBack', array('model'=>$policyModel, 'ckeditor'=>$ckeditor, 'modelName'=>'policyModel')); ?>
							                
						                </div>
						            </section>
								</div>
						    </div>
						</div>  
									
				<?php 
				$peer_comparision_variants = (isset($policyModel['peer_comparision_variants']) && !empty($policyModel['peer_comparision_variants'])) ? $policyModel['peer_comparision_variants'] : '';
				?>
				        <div class="row">
					        <div class="col-md-12">
					        	<div class="panel-body">    
						            <section class="panel panel-default">
						                <div class="panel-heading"><strong><span class="glyphicon glyphicon-th-list"></span> Peer Comparision</strong></div>
						                <div class="panel-body">
						                	<?php echo widget::run('peerComparisionBack', array('policy_id'=>$policy_id, 'peer_comparision_variants'=>$peer_comparision_variants, 'allVariants'=>$allVariants, 'modelName'=>'policyModel', 'policyModel'=>$policyModel)); ?>
						                </div>
						            </section>
								</div>
						    </div>
						</div>  
								    
					    
			        	<div class="row">
			        	
					        <div class="col-md-12">
					            <section class="panel panel-default">
					                <div class="panel-body">    
						                <div class="form-group">
						                
						                    <label for="" class="col-sm-2"></label>
						                    <div class="col-sm-10 "  data-ng-controller="ModalDemoCtrl">
			
											<script type="text/ng-template" id="myModalContent.html">
                       				<div class="modal-header">
                            			<h3>Confirmation</h3>
                        			</div>
                        			<div class="modal-body">
										Are you sure, you want to 
								<?php 	if (isset($policyModel['status']) && !empty($policyModel['status'])) 
								          			{
								          				if (in_array($policyModel['status'], array( 'inactive', 'delete'))) {	?>
					          					Activate
					          	<?php 		}
								          				else if (in_array($policyModel['status'], array( 'active'))) {?>
					                 			De-activate
					           <?php 		}
								          			}  ?>
                            			  "<?php echo $policyModel['policy_name'];?>" ?
                        			</div>
                        			<div class="modal-footer">
                            			<button class="btn btn-danger" onClick="deactiveCompany()">Yes</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            			<button class="btn btn-primary" ng-click="cancel()">No</button>
                        			</div>
                    			</script>
			
			
			
			
										<input type="hidden" id="policy_id" name="policyModel[policy_id]" value="<?php echo array_key_exists( 'policy_id',$policyModel) ? $policyModel['policy_id'] : '';?>" />	<?php 
										if (isset($policyModel['status']) && !in_array($policyModel['status'], array( 'inactive', 'delete'))) {?>
						                        <input type="submit" name="submit" value="Submit" class="btn btn-success btn-lg  " />
						                <?php }else {	?>
						                		<input type="submit" name="submit" value="Submit" class="btn btn-success btn-lg  " />
						                <?php }	?>   
						                	<a href = "<?php echo $base_url; ?>admin/company" class="btn btn-lg btn-default" style="margin-left: 30px;">Cancel</a>     
								           <?php 	
								                 if (isset($policyModel['company_id']) && !empty($policyModel['company_id']))
								                 {	?>
								         
								          	<?php 	if (isset($policyModel['status']) && !empty($policyModel['status'])) 
								          			{
								          				if (in_array($policyModel['status'], array( 'inactive', 'delete'))) {	?>
								          					<a style="float: right;" href="javascript:void(0);" ng-click="open()" id="deactiveCompany" data-hrefval="<?php echo $base_url;?>admin/policy/changeStatus/<?php echo $policyModel['policy_id'];?>/active" class="btn btn-danger btn-lg" >Activate Policy</a>
								          	<?php 		}
								          				else if (in_array($policyModel['status'], array( 'active'))) {?>
								                 			<a style="float: right;" href="javascript:void(0);" ng-click="open()" id="deactiveCompany" data-hrefval="<?php echo $base_url;?>admin/policy/changeStatus/<?php echo $policyModel['policy_id'];?>/inactive" class="btn btn-danger btn-lg" >De-activate Policy</a>
								           <?php 		}
								          			} 
								          		}	?>
						                     </div>
						                    
						               	</div>
								                
					                </div>
					        </section>
					    </div>
				        
				        </div>
				   		</section> 
				    </div>
		        </div>
	        </div>
		<?php echo form_close();?>
	</div>
   

<script type="text/javascript">
	function deactiveCompany()
	{
		var hrefVal = $('#deactiveCompany').data('hrefval');
		window.location.href = hrefVal;
	}
	$(document).ready(function(){
		$('.policy_composition_type').click(function(){
			var policy_composition_type = $('.policy_composition_type:checked').val();
			if(policy_composition_type == 'individual')
			{
				$('#familyCompositionDiv').hide();
			}
			else
			{
				$('#familyCompositionDiv').show();
			}
		});
	});
</script>
