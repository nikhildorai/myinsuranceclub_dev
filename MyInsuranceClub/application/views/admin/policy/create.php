<script src="<?php echo $includes_dir;?>js/dynamicPolicyRows.js"></script>


<script type="text/javascript">
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
		var changeType = $(this).data('change-type'); 

		var options = $('#product_id option:selected');

		var productId = $.map(options ,function(option) {
		    return option.value;
		});

		var options = $('#sub_product_id option:selected');

		var subProductId = $.map(options ,function(option) {
		    return option.value;
		});
		
		var formData = {companyTypeId:companyTypeId, productId:productId, subProductId:subProductId, changeType:changeType };
		$('#'+changeType).empty()
		if(changeType == 'product_id')
		{
			$('#productIdDiv').show();
			$('#productSubIdDiv').hide();
			
		}
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
		echo form_open_multipart(current_url(), $attributes);	?>
	<div class="panel panel-primary">
    	<div class="panel-heading">
        	<strong>
        		<span class="glyphicon glyphicon-th-list"></span> <?php echo (isset($policyModel['policy_id']) && !empty($policyModel['policy_id'])) ? 'Update Policy' : 'Create Policy';?> 
        	</strong>
        	
        	<a href="<?php echo $base_url;?>admin/policy/" class="btn btn-w-md btn-gap-v btn-default btn-sm" style="float: right; margin-top: -5px;">Back</a>
        	
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
					                
						                <div class="form-group">
						                    <label for="Company Type" class="col-sm-3">Company Name</label>
						                    <div class="col-sm-9">
												<span class="ui-select "> 
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
										$selected = array_key_exists( 'product_id',$policyModel) ? explode(',',$policyModel['product_id']) : '';
										$sqlFilter['orderBy'] = 'product_name';
										$healthOptions = $this->util->getCompanyTypeDropDownOptions($modelName ='Product_model', $optionKey = 'product_id', $optionValue = 'product_name', $defaultEmpty = "Please Select", $extraKeys = false, $where, $sqlFilter); 		
										?>			
						                <div id = "productIdDiv" class="form-group">
						                    <label for="Company Type" class="col-sm-3">Product</label>
						                    <div class="col-sm-9">
												<span class="ui-select "> 
												<?php 
													echo form_dropdown('policyModel[product_id][]', $healthOptions, $selected, 'multiple id="product_id" class="tooltip_trigger changeDropDown" data-change-type="sub_product_id" title="Search by health type." style="width: 345px;"');
												?>		
												</span> 
						                    </div>
						                </div>
						                
										<?php
										$where = array();
										$selected = array_key_exists( 'sub_product_id',$policyModel) ? explode(',', $policyModel['sub_product_id']) : '';
										$sqlFilter['orderBy'] = 'sub_product_name';
										$healthOptions = $this->util->getCompanyTypeDropDownOptions($modelName ='Sub_product_model', $optionKey = 'sub_product_id', $optionValue = 'sub_product_name', $defaultEmpty = "Please Select", $extraKeys = false, $where, $sqlFilter);
										?>		
						                <div id= "productSubIdDiv" class="form-group" >
						                    <label for="Company Type" class="col-sm-3">Sub Product</label>
						                    <div class="col-sm-9">
												<span class="ui-select "> 
												<?php 
													echo form_dropdown('policyModel[sub_product_id][]', $healthOptions, $selected, 'multiple id="sub_product_id" class="tooltip_trigger" data-change-type="sub_product_id" title="Search by health type." style="width: 345px;"');
												?>		
												</span> 
						                    </div>
						                </div>
						                
						                
						                <div class="form-group">
						                    <label for="" class="col-sm-3">Policy Name</label>
						                    <div class="col-sm-9">
						                        <input type="text" class="form-control" placeholder="" id="policy_name" name="policyModel[policy_name]" value="<?php echo array_key_exists( 'policy_name',$policyModel) ? $policyModel['policy_name'] : '';?>"  >
						                    </div>
						                </div>
						                
						                
						                <div class="form-group">
						                    <label for="" class="col-sm-3">Show in Search</label>
						                    <div class="col-sm-9">
						                    	<label class="switch switch-success">
							                    	<?php if (isset($policyModel['show_in_search']) && $policyModel['show_in_search'] == 'yes' ) {?>
							                    		<input type="checkbox" checked id="show_in_search" name="policyModel[show_in_search]" value="yes"  >
							                    	<?php }else {?>
							                    		<input type="checkbox"  id="show_in_search" name="policyModel[show_in_search]" value="yes"  >
							                    	<?php }?>
							                    	<i></i>
						                    	</label>
						                    </div>
						                </div>
						                
						                
						                <div class="form-group">
						                    <label for="" class="col-sm-3">SEO Title</label>
						                    <div class="col-sm-9">
						                        <input type="text" class="form-control" required  placeholder="SEO Title" maxlength="90" maxlength="90"  id="seo_title" name="policyModel[seo_title]" value="<?php echo array_key_exists( 'seo_title',$policyModel) ? $policyModel['seo_title'] : '';?>" >
						                        <span class="help-block">Max length 90 characters.</span>
						                    </div>
						                </div>
						                
						                <div class="form-group">
						                    <label for="" class="col-sm-3">SEO Description</label>
						                    <div class="col-sm-9">
						                        <textarea class="form-control" rows="5"  required maxlength="175" id="seo_description" name="policyModel[seo_description]"><?php echo array_key_exists( 'seo_description',$policyModel) ? $policyModel['seo_description'] : '';?></textarea>
						                        <span class="help-block">Max length 175 characters.</span>
						                    </div>
						                </div>
						                
						                <div class="form-group">
						                    <label for="" class="col-sm-3">SEO Keywords</label>
						                    <div class="col-sm-9">
						                        <textarea class="form-control" rows="4" required maxlength="175" id="seo_keywords" name="policyModel[seo_keywords]"><?php echo array_key_exists( 'seo_keywords',$policyModel) ? $policyModel['seo_keywords'] : '';?></textarea>
						                    </div>
						                </div>
						                
										<?php 
										//	tagit widget
										echo widget::run('tagit'); ?>
										
						                <div class="form-group">
						                    <label for="" class="col-sm-3">URL</label>
						                    <div class="col-sm-9">
						                        <input type="text" class="form-control"  required placeholder="URL"  id="url" name="policyModel[slug]" value="<?php echo array_key_exists( 'slug',$policyModel) ? $policyModel['slug'] : '';?>"  >
						                    </div>
						                </div>
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
											$folderUrl = $this->config->config['folder_path']['policy'];
											$fileUrl = $this->config->config['url_path']['policy'];
											
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
			                    <label for="" class="col-sm-3">Key Features</label>
			                    <div class="col-sm-9">
			                    <?php 
			                    $keyFeatures = array();
			                    if(array_key_exists( 'key_features',$policyModel) &&  $policyModel['key_features'])
			                    {
			                    	$keyFeatures = unserialize( $policyModel['key_features']);			                    	
			                    }
			                    for ($i = 0; $i < $this->config->config['policy']['keyFeatures']; $i++)
			                    {
			                    ?>
			                        <input type="text" class="form-control"  <?php echo ($i==0) ? "required" : '';?> placeholder="Key feature <?php echo $i+1;?>"  id="url" name="policyModel[key_features][]" value="<?php echo array_key_exists( $i,$keyFeatures) ? $keyFeatures[$i] : '';?>"  >
			                        <div class="divider"></div>
			             <?php 	}?>
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
											     
												                    	<td>
												                    		<input type="text" class="form-control"  placeholder="Variant Name"  name="variantModel[variant_name][]" value="<?php echo $v1['variant_name'];?>" >
												                    	</td>
												                    	<td>
												                    		<input type="text" class="form-control"  placeholder="Variant Comments"  name="variantModel[comments][]" value="<?php echo $v1['comments'];?>" >
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
								                        <textarea class="form-control" name="policyFeaturesModel[description<?php echo $i; ?>]" id="description<?php echo $i; ?>" ><?php echo array_key_exists( 'description'.$i,$policyFeaturesModel) ? $policyFeaturesModel['description'.$i] : '';?></textarea>
								                        <?php 
								                        $ck = 'ckeditor'.$i;
								                        echo display_ckeditor($this->data['ckeditor'.$i]); ?>
								                    </div>
									                <div class="form-group">
									                </div>
								                </div>
								                
				<?php 						}
						                ?>
							                <div class="form-group">
							                    <label for="" class="col-sm-2"></label>
							                    <div class="col-sm-10">
							                    	<input type="hidden" id="showMoreLessNum" value="2" />
							                        <a href = "javascript:void(0);"  class="btn btn-sm btn-success showMoreLess" id="showMore" data-btnname="more">Show More</a>   
							                        <a href = "javascript:void(0);"  class="btn btn-sm btn-warning showMoreLess" id="showLess" data-btnname="less" style="display: none;">Show Less</a>   
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
						                	<a href = "<?php echo $base_url; ?>admin/company"  class="btn btn-lg btn-default">Cancel</a>     
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
</script>
<?php /* ?>


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
				$healthOptions = $this->util->getCompanyTypeDropDownOptions($modelName ='Product_model', $optionKey = 'product_id', $optionValue = 'product_name', $defaultEmpty = "Please Select");
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

</script>
	<?php */ ?>