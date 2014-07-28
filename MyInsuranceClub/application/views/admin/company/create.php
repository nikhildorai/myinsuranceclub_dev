<script type="text/javascript">
<!--
$(document).ready(function(){
	
<?php if (isset($companyModel['status']) && !empty($companyModel['status']) && in_array($companyModel['status'], array( 'inactive', 'delete'))) {?>
$(".form-horizontal :input").prop("disabled", true);
<?php }?>	

	$('.changeDropDown').change(function(){
		appendUrl();
	});

	function appendUrl()
	{
		var companySlug = $('#company_type_id').find(':selected').data('slug');
		if(companySlug != "")
		{
			if(companySlug == "life-insurance")
				$('#companyTypeSlug').text(companySlug+'/companies/');
			else
				$('#companyTypeSlug').text(companySlug+'/');
		}
		else
		{
			$('#companyTypeSlug').text("");
		}
	}
	$('.slug').keyup(function(){
		appendUrl();
	});
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
        	<a href="<?php echo $base_url;?>admin/company/" class="btn btn-w-md btn-gap-v btn-default btn-sm" style="float: right; margin-top: -5px;">Cancel</a>
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
			                    <label for="Company Type" class="col-sm-3">Type</label>
			                    <div class="col-sm-9" style="height: 40px;">
									<span class="ui-select "> 
									<?php 
										$currentCompanyTypeSlug= "";
										$selected = array_key_exists( 'company_type_id',$companyModel) ?  $companyModel['company_type_id'] : '';
										$options = $this->util->getCompanyTypeDropDownOptions($modelName ='Company_type_model', $optionKey = 'company_type_id', $optionValue = 'company_type_name', $defaultEmpty = "Please Select",$extraKeys = true);
										$optionsText = '<option value="" data-company_type_id="" data-slug="">Please Select</option>';
												foreach ($options as $k1=>$v1)
												{
													if ($selected == $v1['company_type_id'])
													{
														$optionsText .= '<option value="'.$v1['company_type_id'].'" data-slug="'.$v1['slug'].'" selected>'.$v1['company_type_name'].'</option>';
														$currentCompanyTypeSlug = $v1['slug'];
													}
													else
														$optionsText .= '<option value="'.$v1['company_type_id'].'" data-slug="'.$v1['slug'].'">'.$v1['company_type_name'].'</option>';
												}
											//	echo form_dropdown('policyModel[company_id]', $options, $selected, ' id="company_id" class="tooltip_trigger" title="Select company name."');
												?>
												<select id="company_type_id" class="changeDropDown" name="companyModel[company_type_id]" title="Select company Type" style="width: 345px;margin-top: 0px;">
													<?php echo $optionsText;?>
												</select>	
									</span> 
			                    </div>
			                </div>
			                
			                <div class="form-group">
			                    <label for="Company Type" class="col-sm-3">Ownership</label>
			                    <div class="col-sm-9" style="height: 40px;">
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
			                    <label for="" class="col-sm-3">Is Partner</label>
			                    <div class="col-sm-9">
                    					<span class="icon glyphicon glyphicon-star"></span>
					                    <?php 
										$selected = array_key_exists( 'is_partner',$companyModel) ? $companyModel['is_partner'] : 'no';
										$options = array('yes'=>'Yes', 'no'=>'No');			
										foreach ($options as $k1=>$v1)
										{
											$op = array(
											    'name'        => 'companyModel[is_partner]',
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
			                        <input type="text" class="form-control charecterCount" required  placeholder="SEO Title" maxlength="90" id="seo_title" name="companyModel[seo_title]" maxlength="90" value="<?php echo array_key_exists( 'seo_title',$companyModel) ? $companyModel['seo_title'] : '';?>" >
			                         <span class="help-block" style="margin-bottom: -5px;">Max 90 chars | Recommended 60 chars</span>
			                        <span class="help-block currentLength"><?php echo array_key_exists( 'seo_title',$companyModel) ? 'Current length: '.strlen($companyModel['seo_title']).' chars' : '0'.' chars';?></span>
			                    </div>
			                </div>
			                
			                <div class="form-group">
			                    <label for="" class="col-sm-3">SEO Description</label>
			                    <div class="col-sm-9">
			                    	<span class="icon glyphicon glyphicon-star"></span>
			                        <textarea class="form-control charecterCount" rows="5" required maxlength="250" id="seo_description" name="companyModel[seo_description]"><?php echo array_key_exists( 'seo_description',$companyModel) ? $companyModel['seo_description'] : '';?></textarea>
			                        <span class="help-block" style="margin-bottom: -5px;">Max 250 chars | Recommended 150 chars</span>
			                        <span class="help-block currentLength"><?php echo array_key_exists( 'seo_description',$companyModel) ? 'Current length: '.strlen($companyModel['seo_description']).' chars' : '0'.' chars';?></span>
			                    </div>
			                </div>
			                
			                <div class="form-group">
			                    <label for="" class="col-sm-3">SEO Keywords</label>
			                    <div class="col-sm-9">
			                    	<span class="icon glyphicon glyphicon-star"></span>
			                        <textarea class="form-control charecterCount" rows="4" required  maxlength="175" id="seo_keywords" name="companyModel[seo_keywords]"><?php echo array_key_exists( 'seo_keywords',$companyModel) ? $companyModel['seo_keywords'] : '';?></textarea>
			                        <span class="help-block" style="margin-bottom: -5px;">Max 175 chars | Recommended 150 chars</span>
			                        <span class="help-block currentLength"><?php echo array_key_exists( 'seo_keywords',$companyModel) ? 'Current length: '.strlen($companyModel['seo_keywords']).' chars' : '0'.' chars';?></span>
			                    </div>
			                </div>
			                
			                <div class="form-group">
			                    <label for="" class="col-sm-3">URL</label>
			                    <div class="col-sm-9">
			                    	<span class="icon glyphicon glyphicon-star"></span>
<?php 								if (isset($companyModel['slug']))	{?>
			                        	<input type="text" class="form-control slug" placeholder="URL"  name="companyModel[slug]" value="<?php echo $companyModel['slug'];?>" >
			                        	<?php /*?><span class="help-block" style="color:black;font-size: 12px"><a href="<?php echo ($currentCompanyTypeSlug == 'life-insurance') ? base_url().$currentCompanyTypeSlug.'/companies/'.$companyModel['slug'] : base_url().$currentCompanyTypeSlug.'/'.$companyModel['slug'];?>"><?php echo ($currentCompanyTypeSlug == 'life-insurance') ? base_url().$currentCompanyTypeSlug.'/companies/'.$companyModel['slug'] : base_url().$currentCompanyTypeSlug.'/'.$companyModel['slug'];?></a></span> */ ?>			                        	
			                        	<span class="help-block" style="color:black;font-size: 12px"><?php echo base_url();?><span id="companyTypeSlug"><?php echo ($currentCompanyTypeSlug == 'life-insurance') ? $currentCompanyTypeSlug.'/companies/' : $currentCompanyTypeSlug.'/';?></span><span class="slug"><?php echo array_key_exists( 'slug',$companyModel) ? $this->util->getSlug($companyModel['slug']) : '';?></span>/</span>
<?php 								}else{	?>
			                        	<input type="text" class="form-control slug"  tooltip="Once created you cannot edit this field" data-toggle="tooltip" data-placement="top" tooltip-trigger="focus" required placeholder="URL"  name="companyModel[slug]" value="" >
			                        	<span class="help-block" style="color:black;font-size: 12px"><?php echo base_url();?><span id="companyTypeSlug"><?php echo ($currentCompanyTypeSlug == 'life-insurance') ? $currentCompanyTypeSlug.'/companies/' : $currentCompanyTypeSlug.'/';?></span><span class="slug"><?php echo array_key_exists( 'slug',$companyModel) ? $this->util->getSlug($companyModel['slug']) : '';?></span>/</span>
<?php 								}?>			                        
			                        
			                    </div>
			                </div>
			                
							<?php 
							//	tagit widget
							echo widget::run('tagit', array( 'fdhdsudfn')); ?>
							
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
				                    						<img src="'.$fileUrl.$companyModel['logo_image_1'].'">
											                <div class="form-group">
											                </div>';
												}
											}
											?>
								</div>
			                </div>
							
			                <div class="form-group">
			                    <label for="" class="col-sm-3">Logo for Partner section:</label>
			                    <div class="col-sm-9">
			                        <input type="file" id="logo1" name="companyModel[logo_image_partner]" accept="image/*" title="Choose File" data-ui-file-upload class="btn-info" value="<?php echo array_key_exists( 'logo_image_partner',$companyModel) ? $companyModel['logo_image_partner'] : '';?>">
			                        <span class="help-block">Image size: 147px X 107px</span>
			                    
			                    <?php 
											$folderUrl = $this->config->config['folder_path']['company']['partnerLogo'];
											$fileUrl = $this->config->config['url_path']['company']['partnerLogo'];
											
											if (isset($companyModel['logo_image_partner']) && !empty($companyModel['logo_image_partner']))
											{
												if (file_exists($folderUrl.$companyModel['logo_image_partner']))
												{
													echo 	'<div class="divider"></div>
				                    						<img src="'.$fileUrl.$companyModel['logo_image_partner'].'">
											                <div class="form-group">
											                </div>';
												}
											}
											?>
								</div>
			                </div>
			                
			                <div class="form-group">
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
		                    	<textarea class="form-control charecterCount" rows="6"  maxlength="250" id="address" name="companyDetailModel[address]" ><?php echo array_key_exists( 'address',$companyDetailModel) ? $companyDetailModel['address'] : '';?></textarea>
		                    	<span class="help-block" style="margin-bottom: -5px;">Max 250 chars</span>
			                    <span class="help-block currentLength"><?php echo array_key_exists( 'address',$companyDetailModel) ? 'Current length: '.strlen($companyDetailModel['address']).' chars' : '0'.' chars';?></span>
		                   </div>
		                </div>
		                
		                
		                <div class="form-group">
		                    <label for="" class="col-sm-3">Website</label>
		                    <div class="col-sm-9">
		                        <input type="text" class="form-control" placeholder="Website" name="companyDetailModel[website]" value="<?php echo array_key_exists( 'website',$companyDetailModel) ? $companyDetailModel['website'] : '';?>" >
		                        
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
		                
		           	  
			                
		                <div class="form-group">
		                    <label for="" class="col-sm-3">Photo for Leadership:</label>
		                    <div class="col-sm-9">
		                        <input type="file" id="logo_image_leadership" name="companyModel[logo_image_leadership]" accept="image/*" title="Choose File" data-ui-file-upload class="btn-info" value="<?php echo array_key_exists( 'logo_image_leadership',$companyModel) ? $companyModel['logo_image_leadership'] : '';?>">
		                        <span class="help-block">Image size: 160px X 160px</span>
		                    <?php 
										$folderUrl = $this->config->config['folder_path']['company']['companyLeadership'];
										$fileUrl = $this->config->config['url_path']['company']['companyLeadership'];
										if (isset($companyModel['logo_image_leadership']) && !empty($companyModel['logo_image_leadership']))
										{
											if (file_exists($folderUrl.$companyModel['logo_image_leadership']))
											{
												echo 	'<div class="divider"></div>
			                    						<img src="'.$fileUrl.$companyModel['logo_image_leadership'].'">';
											}
										}
							?>		   
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
			                	<a href = "<?php echo $base_url; ?>admin/company"  class="btn btn-lg btn-default"  style="margin-left: 30px;">Cancel</a>     
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