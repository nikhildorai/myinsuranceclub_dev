<script type="text/javascript">
<!--
$(document).ready(function(){
<?php if (isset($model['status']) && !empty($model['status']) && in_array($model['status'], array( 'inactive', 'delete'))) {?>
$(".form-horizontal :input").prop("disabled", true);
<?php }?>	
});
</script>

<div class="page" data-ng-controller="signupCtrl">
<?php 	$attributes = array('class'=>"form-horizontal form-validation");
		echo form_open_multipart(current_url(), $attributes);	?>
	<div class="panel panel-primary">
    	<div class="panel-heading">
        	<strong>
        		<span class="glyphicon glyphicon-th-list"></span> <?php echo (isset($model['product_id']) && !empty($model['product_id'])) ? 'Update Product' : 'Create Product';?> 
        	</strong>
        	
        	<a href="<?php echo $base_url;?>admin/product/" class="btn btn-w-md btn-gap-v btn-default btn-sm" style="float: right; margin-top: -5px;">Back</a>
        	
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
		        	<div class="panel-body">    
			            <section class="panel panel-default">
			                <div class="panel-heading"><strong><span class="glyphicon glyphicon-th-list"></span> Product Details</strong></div>
			                <div class="panel-body">
			                
				                <div class="form-group">
				                    <label for="" class="col-sm-3">Name</label>
				                    <div class="col-sm-9">
				                        <input type="text" class="form-control" required placeholder="Add unique tag name" id="name" name="model[product_name]" value="<?php echo array_key_exists( 'product_name',$model) ? $model['product_name'] : '';?>"  >
				                    </div>
				                </div>
			                
				                <div class="form-group">
				                    <label for="" class="col-sm-3">Company Type</label>
				                    <div class="col-sm-9">
										<span class="ui-select "> 
										<?php 
											$selected = array_key_exists( 'company_type_id',$model) ?  $model['company_type_id'] : '';
											$options = $this->util->getCompanyTypeDropDownOptions($modelName ='Company_type_model', $optionKey = 'company_type_id', $optionValue = 'company_type_name', $defaultEmpty = "Please Select");
											echo form_dropdown('model[company_type_id][]', $options, explode(',', $selected), ' id="tag_for" multiple required style="width: 345px;margin-top: 0px;"');
										?>
										</span>
				                    </div>
				                </div>
				                
			                
				                <div class="form-group">
				                    <label for="" class="col-sm-3">Url</label>
				                    <div class="col-sm-9">
				                        <input type="text" class="form-control" required placeholder="Add unique url" id="name" name="model[slug]" value="<?php echo array_key_exists( 'slug',$model) ? $model['slug'] : '';?>"  >
				                    </div>
				                </div>
				                
								<?php 
								//	tagit widget
								echo widget::run('tagit'); ?>
								
			                </div>
			            </section>
					</div>
			    </div>
			</div>  
			
	        <div class="row">
		        <div class="col-md-12">
		        	<div class="panel-body">    
			            <section class="panel panel-default">
			                <div class="panel-body">
				                <div class="form-group">
				                    <label for="" class="col-sm-3"></label>
				                    <div class="col-sm-9 "  data-ng-controller="ModalDemoCtrl">
	
										<script type="text/ng-template" id="myModalContent.html">
                       						<div class="modal-header">
                            					<h3>Confirmation</h3>
                        					</div>
                        					<div class="modal-body">
												Are you sure, you want to 
								<?php 			if (isset($model['status']) && !empty($model['status'])) 
							          			{
							          				if (in_array($model['status'], array( 'inactive', 'delete'))) {	?>
					          						Activate
					          	<?php 				}
							          				else if (in_array($model['status'], array( 'active'))) {?>
					                 				De-activate
					           <?php 				}
							          			}  ?>
                            			  "<?php echo $model['product_name'];?>" ?
                        					</div>
                        					<div class="modal-footer">
                            					<button class="btn btn-danger" onClick="deactiveCompany()">Yes</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            					<button class="btn btn-primary" ng-click="cancel()">No</button>
                        					</div>
                    					</script>
		
		
		
		
										<input type="hidden" id="product_id" name="model[product_id]" value="<?php echo array_key_exists( 'product_id',$model) ? $model['product_id'] : '';?>" />	
								<?php  	if (isset($model['status']) && !in_array($model['status'], array( 'inactive', 'delete'))) {?>
					                        <input type="submit" name="submit" value="Submit" class="btn btn-success btn-lg"/>
					            <?php 	}else {	?>
					                		<input type="submit" name="submit" value="Submit" class="btn btn-success btn-lg"/>
					            <?php 	}	?>   
					                	<a href = "<?php echo $base_url; ?>admin/product"  class="btn btn-lg btn-default">Cancel</a>     
							           <?php 	
							                 if (isset($model['product_id']) && !empty($model['product_id']))
							                 {	
							                 	if (isset($model['status']) && !empty($model['status'])) 
							          			{
							          				if (in_array($model['status'], array( 'inactive', 'delete'))) {	?>
							          					<a style="float: right;" href="javascript:void(0);" ng-click="open()" id="deactiveCompany" data-hrefval="<?php echo $base_url;?>admin/product/changeStatus/<?php echo $model['product_id'];?>/active" class="btn btn-danger btn-lg" >Activate Tag</a>
							          	<?php 		}
							          				else if (in_array($model['status'], array( 'active'))) {?>
							                 			<a style="float: right;" href="javascript:void(0);" ng-click="open()" id="deactiveCompany" data-hrefval="<?php echo $base_url;?>admin/product/changeStatus/<?php echo $model['product_id'];?>/inactive" class="btn btn-danger btn-lg" >De-activate Tag</a>
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
	function deactiveCompany()
	{
		var hrefVal = $('#deactiveCompany').data('hrefval');
		window.location.href = hrefVal;
	}

	function checkTagForOther()
	{
		var value = $('#tag_for').val();
		if(value == 'others')
		{
			var others = $('#tag_for_other').val();
			if(others !="" && others != 'undefined')
				return true;
			else
			{
				alert('Please add other value "tag for". ');
				return false;
			}
		}
		else
		{
			return true;
		}
		return false;
	}
	
	$(document).ready(function(){
		$('#tag_for').change(function(){
			var value = $('#tag_for').val();
			if(value == 'others')
			{
				$('#tag_for_other').show();
				$('#tag_for_other').prop('required', true);
			}
			else
				$('#tag_for_other').hide();
			$('#tag_for_other').prop('required', false);
				
		});
	});
</script>