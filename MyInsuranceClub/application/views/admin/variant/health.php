<script type="text/javascript">
<!--
$(document).ready(function(){
<?php if (isset($variantModel['status']) && !empty($variantModel['status']) && in_array($variantModel['status'], array( 'inactive', 'delete'))) {?>
$(".form-horizontal :input").prop("disabled", true);
$("#addVariant").attr("disabled","disabled");
$("#dlBrochure").attr("disabled","disabled");
$("#dlWordings").attr("disabled","disabled");
$('.remove').prop('disabled', true);
<?php }?>	
});
</script>

<div class="page" data-ng-controller="signupCtrl">
<?php 
$variantModel = array(); 
$attributes = array('class'=>"form-horizontal form-validation");
		echo form_open_multipart(current_url(), $attributes);	?>
	<div class="panel panel-primary">
    	<div class="panel-heading">
        	<strong>
        		<span class="glyphicon glyphicon-th-list"></span> <?php echo (isset($variantModel['policy_id']) && !empty($variantModel['policy_id'])) ? 'Update Policy' : 'Create Policy';?> 
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
						                    <label for="" class="col-sm-3">Policy Name</label>
						                    <div class="col-sm-9">
						                        <input type="text" class="form-control" placeholder="" id="policy_name" name="policyModel[policy_name]" value="<?php echo array_key_exists( 'policy_name',$variantModel) ? $variantModel['policy_name'] : '';?>"  >
						                    </div>
						                </div>
						                
						                
						                <div class="form-group">
						                    <label for="" class="col-sm-3">Show in Search</label>
						                    <div class="col-sm-9">
						                    	<label class="switch switch-success">
							                    	<?php if (isset($variantModel['show_in_search']) && $variantModel['show_in_search'] == 'yes' ) {?>
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
						                        <input type="text" class="form-control" required  placeholder="SEO Title" maxlength="90" maxlength="90"  id="seo_title" name="policyModel[seo_title]" value="<?php echo array_key_exists( 'seo_title',$variantModel) ? $variantModel['seo_title'] : '';?>" >
						                        <span class="help-block">Max length 90 characters.</span>
						                    </div>
						                </div>
						                
						                <div class="form-group">
						                    <label for="" class="col-sm-3">SEO Description</label>
						                    <div class="col-sm-9">
						                        <textarea class="form-control" rows="5"  required maxlength="175" id="seo_description" name="policyModel[seo_description]"><?php echo array_key_exists( 'seo_description',$variantModel) ? $variantModel['seo_description'] : '';?></textarea>
						                        <span class="help-block">Max length 175 characters.</span>
						                    </div>
						                </div>
						                
						                <div class="form-group">
						                    <label for="" class="col-sm-3">SEO Keywords</label>
						                    <div class="col-sm-9">
						                        <textarea class="form-control" rows="4" required maxlength="175" id="seo_keywords" name="policyModel[seo_keywords]"><?php echo array_key_exists( 'seo_keywords',$variantModel) ? $variantModel['seo_keywords'] : '';?></textarea>
						                    </div>
						                </div>
						                
						                <div class="form-group">
						                    <label for="" class="col-sm-3">URL</label>
						                    <div class="col-sm-9">
						                        <input type="text" class="form-control"  required placeholder="URL"  id="url" name="policyModel[slug]" value="<?php echo array_key_exists( 'slug',$variantModel) ? $variantModel['slug'] : '';?>"  >
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
								<?php 	if (isset($variantModel['status']) && !empty($variantModel['status'])) 
								          			{
								          				if (in_array($variantModel['status'], array( 'inactive', 'delete'))) {	?>
					          					Activate
					          	<?php 		}
								          				else if (in_array($variantModel['status'], array( 'active'))) {?>
					                 			De-activate
					           <?php 		}
								          			}  ?>
                            			  "<?php echo $variantModel['policy_name'];?>" ?
                        			</div>
                        			<div class="modal-footer">
                            			<button class="btn btn-danger" onClick="deactiveCompany()">Yes</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            			<button class="btn btn-primary" ng-click="cancel()">No</button>
                        			</div>
                    			</script>
			
			
			
			
										<input type="hidden" id="policy_id" name="policyModel[policy_id]" value="<?php echo array_key_exists( 'policy_id',$variantModel) ? $variantModel['policy_id'] : '';?>" />	<?php 
										if (isset($variantModel['status']) && !in_array($variantModel['status'], array( 'inactive', 'delete'))) {?>
						                        <input type="submit" name="submit" value="Submit" class="btn btn-success btn-lg  " />
						                <?php }else {	?>
						                		<input type="submit" name="submit" value="Submit" class="btn btn-success btn-lg  " />
						                <?php }	?>   
						                	<a href = "<?php echo $base_url; ?>admin/company"  class="btn btn-lg btn-default">Cancel</a>     
								           <?php 	
								                 if (isset($variantModel['company_id']) && !empty($variantModel['company_id']))
								                 {	?>
								         
								          	<?php 	if (isset($variantModel['status']) && !empty($variantModel['status'])) 
								          			{
								          				if (in_array($variantModel['status'], array( 'inactive', 'delete'))) {	?>
								          					<a style="float: right;" href="javascript:void(0);" ng-click="open()" id="deactiveCompany" data-hrefval="<?php echo $base_url;?>admin/policy/changeStatus/<?php echo $variantModel['policy_id'];?>/active" class="btn btn-danger btn-lg" >Activate Policy</a>
								          	<?php 		}
								          				else if (in_array($variantModel['status'], array( 'active'))) {?>
								                 			<a style="float: right;" href="javascript:void(0);" ng-click="open()" id="deactiveCompany" data-hrefval="<?php echo $base_url;?>admin/policy/changeStatus/<?php echo $variantModel['policy_id'];?>/inactive" class="btn btn-danger btn-lg" >De-activate Policy</a>
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