<script type="text/javascript">
<!--
$(document).ready(function(){
	
<?php if (isset($companyModel['status']) && !empty($companyModel['status']) && in_array($companyModel['status'], array( 'inactive', 'delete'))) {?>
$(".form-horizontal :input").prop("disabled", true);
<?php }?>	
});
//-->
</script>
<div class="page" data-ng-controller="formConstraintsCtrl">
<?php 	$attributes = array('class'=>"form-horizontal form-validation");
		echo form_open_multipart(current_url(), $attributes);	?>
	<div class="panel panel-primary">
    	<div class="panel-heading">
        	<strong>
        		<span class="glyphicon glyphicon-th-list"></span> <?php echo (isset($companyModel['company_id']) && !empty($companyModel['company_id'])) ? 'Update Company' : 'Create Company';?> 
        	</strong>
        	<a href="<?php echo $base_url;?>admin/company/" class="btn btn-w-md btn-gap-v btn-default btn-sm" style="float: right; margin-top: -5px;">Back</a>
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
				
        <div class="panel-body">
        
	        <div class="row">
		        <div class="col-md-12">
				    <section class="panel panel-default">
				        <div class="panel-body">
				        
        	<div class="row">
        	
		        <div class="col-md-6">
		            <section class="panel panel-default">
		                <div class="panel-heading"><strong><span class="glyphicon glyphicon-th-list"></span> Company Details</strong></div>
		                <div class="panel-body">
		                
			                <div class="form-group">
			                    <label for="Company Type" class="col-sm-3">Vertical</label>
			                    <div class="col-sm-9">
									<span class="ui-select "> 
									<?php 
										$selected = array_key_exists( 'company_type_id',$companyModel) ?  $companyModel['company_type_id'] : '';
										$options = $this->util->getCompanyTypeDropDownOptions($modelName ='Company_type_model', $optionKey = 'company_type_id', $optionValue = 'company_type_name', $defaultEmpty = "Please Select");
										echo form_dropdown('companyModel[company_type_id]', $options, $selected, ' id="company_type_id" class="tooltip_trigger" required title="Search by company type." style="width: 345px;margin-top: 0px;"');
									?>		
									</span> 
			                    </div>
			                </div>
			                
			                <div class="form-group">
			                    <label for="Company Type" class="col-sm-3">Type</label>
			                    <div class="col-sm-9">
									<span class="ui-select "> 
									<?php 
										$selected = array_key_exists( 'public_private_health',$companyModel) ?  $companyModel['public_private_health'] : '';
										$options = $this->util->getCompanyTypeDropDownOptions($modelName ='Company_private_public_health_model', $optionKey = 'pph_id', $optionValue = 'company_type', $defaultEmpty = "Please Select");
										echo form_dropdown('companyModel[public_private_health]', $options, $selected, ' id="public_private_health" class="tooltip_trigger" required title="Search by company type." style="width: 345px;margin-top: 0px;"');
									?>		
									</span> 
			                    </div>
			                </div>
			                
			                <div class="form-group">
			                    <label for="" class="col-sm-3">Name</label>
			                    <div class="col-sm-9">
			                    	<span class="icon glyphicon glyphicon-star"></span>
			                        <input type="text" class="form-control" required placeholder="Company Name" id="company_name" name="companyModel[company_name]" value="<?php echo array_key_exists( 'company_name',$companyModel) ? $companyModel['company_name'] : '';?>" >
			                    </div>
			                </div>
			                
			                
			                <div class="form-group">
			                    <label for="" class="col-sm-3">Display Name</label>
			                    <div class="col-sm-9">
			                    	<span class="icon glyphicon glyphicon-star"></span>
			                        <input type="text" class="form-control"  required  placeholder="Company Display Name" id="company_display_name" name="companyModel[company_display_name]" value="<?php echo array_key_exists( 'company_display_name',$companyModel) ? $companyModel['company_display_name'] : '';?>">
			                    </div>
			                </div>
			                
			                
			                <div class="form-group">
			                    <label for="" class="col-sm-3">Short Name</label>
			                    <div class="col-sm-9">
			                    	<span class="icon glyphicon glyphicon-star"></span>
			                        <input type="text" class="form-control" required  placeholder="Company Short Name" id="company_shortname" name="companyModel[company_shortname]" value="<?php echo array_key_exists( 'company_shortname',$companyModel) ? $companyModel['company_shortname'] : '';?>" >
			                    </div>
			                </div>
			                
			                
			                <div class="form-group">
			                    <label for="" class="col-sm-3">SEO Title</label>
			                    <div class="col-sm-9">
			                    	<span class="icon glyphicon glyphicon-star"></span>
			                        <input type="text" class="form-control" required  placeholder="SEO Title" maxlength="90" id="seo_title" name="companyModel[seo_title]" maxlength="90" value="<?php echo array_key_exists( 'seo_title',$companyModel) ? $companyModel['seo_title'] : '';?>" >
			                        <span class="help-block">Max length 90 characters.</span>
			                    </div>
			                </div>
			                
			                <div class="form-group">
			                    <label for="" class="col-sm-3">SEO Description</label>
			                    <div class="col-sm-9">
			                    	<span class="icon glyphicon glyphicon-star"></span>
			                        <textarea class="form-control" rows="5" required maxlength="250" id="seo_description" name="companyModel[seo_description]"><?php echo array_key_exists( 'seo_description',$companyModel) ? $companyModel['seo_description'] : '';?></textarea>
			                        <span class="help-block">Max length 250 characters.</span>
			                    </div>
			                </div>
			                
			                <div class="form-group">
			                    <label for="" class="col-sm-3">SEO Keywords</label>
			                    <div class="col-sm-9">
			                    	<span class="icon glyphicon glyphicon-star"></span>
			                        <textarea class="form-control" rows="4" required  maxlength="175" id="seo_keywords" name="companyModel[seo_keywords]"><?php echo array_key_exists( 'seo_keywords',$companyModel) ? $companyModel['seo_keywords'] : '';?></textarea>
			                    </div>
			                </div>
			                
			                <div class="form-group">
			                    <label for="" class="col-sm-3">URL</label>
			                    <div class="col-sm-9">
			                    	<span class="icon glyphicon glyphicon-star"></span>
			                        <input type="text" class="form-control"  required placeholder="URL"  name="companyModel[slug]" value="<?php echo array_key_exists( 'slug',$companyModel) ? $companyModel['slug'] : '';?>" >
			                    </div>
			                </div>
			                
							<?php 
							//	tagit widget
							echo widget::run('tagit'); ?>
							
			                <div class="form-group">
			                    <label for="" class="col-sm-3">Logo for Company Page:</label>
			                    <div class="col-sm-9">
			                        <input type="file" id="logo1" name="companyModel[logo_image_1]" accept="image/*" title="Choose File" data-ui-file-upload class="btn-info" value="<?php echo array_key_exists( 'logo_image_1',$companyModel) ? $companyModel['logo_image_1'] : '';?>">
			                        <span class="help-block">Image size: 172px X 68px</span>
			                    
			                    <?php 
											$folderUrl = $this->config->config['folder_path']['company']['companyPageLogo'];
											$fileUrl = $this->config->config['url_path']['company']['companyPageLogo'];
											
											if (isset($companyModel['logo_image_1']) && !empty($companyModel['logo_image_1']))
											{
												if (file_exists($folderUrl.$companyModel['logo_image_1']))
												{
													echo 	'<div class="divider"></div>
				                    						<img src="'.$fileUrl.$companyModel['logo_image_1'].'">';
												}
											}
											?>
								</div>
			                </div>
			                
			                <div class="form-group">
			                    <label for="" class="col-sm-3">Logo for Search Results:</label>
			                    <div class="col-sm-9">
			                        <input type="file" id="logo1" name="companyModel[logo_image_2]" accept="image/*" title="Choose File" data-ui-file-upload class="btn-info" value="<?php echo array_key_exists( 'logo_image_2',$companyModel) ? $companyModel['logo_image_2'] : '';?>">
			                        <span class="help-block">Image size: 80px X 50px</span>
			                    <?php 
											$folderUrl = $this->config->config['folder_path']['company']['searchResultLogo'];
											$fileUrl = $this->config->config['url_path']['company']['searchResultLogo'];
											if (isset($companyModel['logo_image_2']) && !empty($companyModel['logo_image_2']))
											{
												if (file_exists($folderUrl.$companyModel['logo_image_2']))
												{
													echo 	'<div class="divider"></div>
				                    						<img src="'.$fileUrl.$companyModel['logo_image_2'].'">';
												}
											}
								?>		   
								</div>
			                 							
			                </div>
		           	  
		                </div>
		            </section>
		        </div>
		        
        	
        	
        	
        	
		        <div class="col-md-6">
		            <section class="panel panel-default">
		                <div class="panel-heading"><strong><span class="glyphicon glyphicon-th-list"></span> Contact Details</strong></div>
		                <div class="panel-body">
		                
		                <div class="form-group">
		                    <label for="" class="col-sm-3">Corporate Office</label>
		                    <div class="col-sm-9">
		                    	<textarea class="form-control" rows="4"  maxlength="175" id="address" name="companyDetailModel[address]" ><?php echo array_key_exists( 'address',$companyDetailModel) ? $companyDetailModel['address'] : '';?></textarea>
		                    	
		                   </div>
		                </div>
		                
		                
		                <div class="form-group">
		                    <label for="" class="col-sm-3">Website</label>
		                    <div class="col-sm-9">
		                        <input type="text" class="form-control" placeholder="Website"name="companyDetailModel[website]" value="<?php echo array_key_exists( 'website',$companyDetailModel) ? $companyDetailModel['website'] : '';?>" >
		                        
		                    </div>
		                </div>
		                
		                
		                <div class="form-group">
		                    <label for="" class="col-sm-3">Twitter Handle</label>
		                    <div class="col-sm-9">
		                        <input type="text" class="form-control" placeholder="Twitter Handle"  name="companyDetailModel[twitter]" value="<?php echo array_key_exists( 'twitter',$companyDetailModel) ? $companyDetailModel['twitter'] : '';?>"  >
		                    </div>
		                </div>
		                
		                
		                <div class="form-group">
		                    <label for="" class="col-sm-3">Facebook Page</label>
		                    <div class="col-sm-9">
		                        <input type="text" class="form-control" placeholder="Facebook Page" name="companyDetailModel[facebook]" value="<?php echo array_key_exists( 'facebook',$companyDetailModel) ? $companyDetailModel['facebook'] : '';?>" >
		                    </div>
		                </div>
		                
		                <div class="form-group">
		                    <label for="" class="col-sm-3">Google Profile</label>
		                    <div class="col-sm-9">
		                        <input type="text" class="form-control" placeholder="Google Profile" name="companyDetailModel[google_plus]" value="<?php echo array_key_exists( 'google_plus',$companyDetailModel) ? $companyDetailModel['google_plus'] : '';?>" >
		                    </div>
		                </div>
		                
		                <div class="form-group">
		                    <label for="" class="col-sm-3">Phone</label>
		                    <div class="col-sm-9">
		                        <input type="text" class="form-control input-lg" placeholder="Add phone number" name="companyDetailModel[phone]" value="<?php echo array_key_exists( 'phone',$companyDetailModel) ? $companyDetailModel['phone'] : '';?>" >
		                        <div class="divider"></div>
		                        <input type="text" class="form-control input-lg" placeholder="Add phone number" name="companyDetailModel[phone2]" value="<?php echo array_key_exists( 'phone2',$companyDetailModel) ? $companyDetailModel['phone2'] : '';?>" >
		                        <div class="divider"></div>
		                        <input type="text" class="form-control input-lg" placeholder="Add phone number" name="companyDetailModel[phone3]" value="<?php echo array_key_exists( 'phone3',$companyDetailModel) ? $companyDetailModel['phone2'] : '';?>" >
		                        <span class="help-block">Add comma seperate multiple values</span>
		                    </div>
		                </div>
		                
		                <div class="form-group">
		                    <label for="" class="col-sm-3">Email</label>
		                    <div class="col-sm-9">
		                    	<input type="text" class="form-control" placeholder="Add coporate email"  name="companyDetailModel[email]" value="<?php echo array_key_exists( 'email',$companyDetailModel) ? $companyDetailModel['email'] : '';?>" >
		                   	</div>
		                </div>
		                
		                <div class="form-group">
		                    <label for="" class="col-sm-3">SMS</label>
		                    <div class="col-sm-9">
		                        <input type="text" class="form-control" placeholder="" name="companyDetailModel[sms]" value="<?php echo array_key_exists( 'sms',$companyDetailModel) ? $companyDetailModel['sms'] : '';?>">
		                    </div>
		                </div>
		                
		           	  
		                </div>
		            </section>
		        </div>
		        
		    </div>
		    
	        <div class="row">
		        <div class="col-md-12">
				    <section class="panel panel-default">
				        <div class="panel-heading"><strong><span class="glyphicon glyphicon-th-list"></span> Description Details</strong></div>
				        <div class="panel-body">
				        
		                
			                <div class="form-group">
			                    <label for="" class="col-sm-2">Heading 1</label>
			                    <div class="col-sm-10">
			                    	<span class="icon glyphicon glyphicon-star"></span>
			                        <input type="text" class="form-control" placeholder="" name="companyDetailModel[heading_1]" value="<?php echo array_key_exists( 'heading_1',$companyDetailModel) ? $companyDetailModel['heading_1'] : '';?>" >
			                    </div>
			                </div>
			                <div class="form-group">
			                    <label for="" class="col-sm-2">Description 1</label>
			                    <div class="col-sm-10">
			                    	<span class="icon glyphicon glyphicon-star"></span>
			                        <textarea class="form-control" name="companyDetailModel[description_1]" id="description_1" ><?php echo array_key_exists( 'description_1',$companyDetailModel) ? $companyDetailModel['description_1'] : '';?></textarea>
			                        <?php echo display_ckeditor($ckeditor1); ?>
			                    </div>
			                </div>
			                
			                <div class="form-group">
			                </div>
			                <div class="form-group">
			                </div>
			                
			                <div class="form-group">
			                    <label for="" class="col-sm-2">Heading 2</label>
			                    <div class="col-sm-10">
			                    	<span class="icon glyphicon glyphicon-star"></span>
			                        <input type="text" class="form-control" placeholder="" name="companyDetailModel[heading_2]" value="<?php echo array_key_exists( 'heading_2',$companyDetailModel) ? $companyDetailModel['heading_2'] : '';?>" >
			                    </div>
			                </div>
			                <div class="form-group">
			                    <label for="" class="col-sm-2">Description 2</label>
			                    <div class="col-sm-10">
			                    	<span class="icon glyphicon glyphicon-star"></span>
			                        <textarea class="form-control" name="companyDetailModel[description_2]" id="description_2" ><?php echo array_key_exists( 'description_2',$companyDetailModel) ? $companyDetailModel['description_2'] : '';?></textarea>
			                        <?php echo display_ckeditor($ckeditor2); ?>
			                    </div>
			                </div>
			                
			                <div class="form-group">
			                </div>
			                <div class="form-group">
			                </div>
			                
			                <div class="form-group">
			                    <label for="" class="col-sm-2">Claims Ratio</label>
			                    <div class="col-sm-10">
			                        <label for="">Claims Ratio</label>
			                        <div class="divider"></div>
			                        
										<table class="table table-bordered table-striped cf">
						                	<thead class="cf">
						                		<tr>
								                    <th>#</th>
								                    <th>Financial Year</th>
								                    <th class="numeric">Claims Ratio</th>
												</tr>
						                	</thead> 
						                	<tbody>
												<?php 
												$curMonth = (int)date('m');
												if ($curMonth > 3)
													$curYear = (int)date('Y')-1;
												else
													$curYear = (int)date('Y')-2;
													
												$i = 1;
												for ($year = 2000; $year <= $curYear; $year++)
												{	
													$prev = $year;
													$cur = $year+1;
													?>
													<tr>
														<td>
															<?php echo $i;?>
															<input type="hidden" name="claimRatio[<?php echo $cur;?>][claim_ratio_id]" value="<?php echo isset($ratioModel[$cur]) ? $ratioModel[$cur]['claim_ratio_id'] : '';?>">
														</td>
														<td>
															<?php echo $prev.' - '.$cur;?>
															<input type="hidden" name="claimRatio[<?php echo $cur;?>][financial_year]" value="<?php echo $prev.'-'.$cur; ?>">
														</td>
														<td>
															<input type="text" name="claimRatio[<?php echo $cur;?>][claim_ratio]" value="<?php echo isset($ratioModel[$cur]) ? $ratioModel[$cur]['claim_ratio'] : '';?>"/>&nbsp;&nbsp;%
														</td>
													</tr>
								<?php 				$i++;
												}	?>
											</tbody>
										</table>
					
			                    </div>
			                </div>
			                
				        </div>
				    </section> 
		        </div>
	        </div>   
	        
	        
	        
	        
	        
				        
				        
			                <div class="form-group">
			                
			                    <label for="" class="col-sm-2"></label>
			                    <div class="col-sm-10 "  data-ng-controller="ModalDemoCtrl">

								<script type="text/ng-template" id="myModalContent.html">
                       				<div class="modal-header">
                            			<h3>Confirmation</h3>
                        			</div>
                        			<div class="modal-body">
										Are you sure, you want to 
								<?php 	if (isset($companyModel['status']) && !empty($companyModel['status'])) 
					          			{
					          				if (in_array($companyModel['status'], array( 'inactive', 'delete'))) {	?>
					          					Activate
					          	<?php 		}
					          				else if (in_array($companyModel['status'], array( 'active'))) {?>
					                 			De-activate
					           <?php 		}
					          			}  ?>
                            			  "<?php echo $companyModel['company_name'];?>" ?
                        			</div>
                        			<div class="modal-footer">
                            			<button class="btn btn-danger" onClick="deactiveCompany()">Yes</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            			<button class="btn btn-primary" ng-click="cancel()">No</button>
                        			</div>
                    			</script>




								<input type="hidden" id="company_id" name="companyModel[company_id]" value="<?php echo array_key_exists( 'company_id',$companyModel) ? $companyModel['company_id'] : '';?>" />
									<input type="hidden" id="company_detail_id" name="companyDetailModel[company_detail_id]" value="<?php echo array_key_exists( 'company_detail_id',$companyDetailModel) ? $companyDetailModel['company_detail_id'] : '';?>" />
							<?php 
							if (isset($companyModel['status']) && !in_array($companyModel['status'], array( 'inactive', 'delete'))) {?>
			                        <div class="space"><div class="space"><input type="submit" name="submit" value="Submit" class="btn btn-success btn-lg  " />
			                <?php }else {	?>
			                		<div class="space"><div class="space"><input type="submit" name="submit" value="Submit" class="btn btn-success btn-lg  " />
			                <?php }	?>   
			                	<a href = "<?php echo $base_url; ?>admin/company"  class="btn btn-lg btn-default">Cancel</a>     
					           <?php 	
					                 if (isset($companyModel['company_id']) && !empty($companyModel['company_id']))
					                 {	?>
					         
					          	<?php 	if (isset($companyModel['status']) && !empty($companyModel['status'])) 
					          			{
					          				if (in_array($companyModel['status'], array( 'inactive', 'delete'))) {	?>
					          					<a style="float: right;" href="javascript:void(0);" ng-click="open()" id="deactiveCompany" data-hrefval="<?php echo $base_url;?>admin/company/changeStatus/<?php echo $companyModel['company_id'];?>/active" class="btn btn-danger btn-lg" >Activate Company</a>
					          	<?php 		}
					          				else if (in_array($companyModel['status'], array( 'active'))) {?>
					                 			<a style="float: right;" href="javascript:void(0);" ng-click="open()" id="deactiveCompany" data-hrefval="<?php echo $base_url;?>admin/company/changeStatus/<?php echo $companyModel['company_id'];?>/inactive" class="btn btn-danger btn-lg" >De-activate Company</a>
					           <?php 		}
					          			} 
					          		}	?>
			                     </div>
			                    
			               	</div>

				        </div>
				    </section> 
		        </div>
	        </div>   
	        
       	</div>
	</div>
   

	<?php echo form_close();?>
</div>
<script type="text/javascript">
<!--
	function deactiveCompany()
	{
		var hrefVal = $('#deactiveCompany').data('hrefval');
		window.location.href = hrefVal;
	}
//-->
</script>


<?php /*?>			
					
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
	
*/?>					
					