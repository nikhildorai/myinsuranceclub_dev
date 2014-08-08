<script type="text/javascript">
<!--
$(document).ready(function(){
<?php if (isset($model['status']) && !empty($model['status']) && in_array($model['status'], array( 'inactive', 'delete'))) {?>
$(".form-horizontal :input").prop("disabled", true);
<?php }?>	
});
</script>

<div class="page" data-ng-controller="signupCtrl">
<?php 	$attributes = array('class'=>"form-horizontal form-validation", "onsubmit"=>"return checkTagForOther()");
		echo form_open_multipart(current_url(), $attributes);	?>
	<div class="panel panel-primary">
    	<div class="panel-heading">
        	<strong>
        		<span class="glyphicon glyphicon-th-list"></span> <?php echo (isset($model['tag_id']) && !empty($model['tag_id'])) ? 'Update Tag' : 'Create Tag';?> 
        	</strong>
        	
        	<a href="<?php echo $base_url;?>admin/master_tags/" class="btn btn-w-md btn-gap-v btn-default btn-sm" style="float: right; margin-top: -5px;">Back</a>
        	
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
			                <div class="panel-heading"><strong><span class="glyphicon glyphicon-th-list"></span> Tag Details</strong></div>
			                <div class="panel-body">
			                
				                <div class="form-group">
				                    <label for="" class="col-sm-2">Name</label>
				                    <div class="col-sm-10">
				                        <input type="text" class="form-control" required placeholder="Add unique tag name" id="name" name="model[name]" value="<?php echo array_key_exists( 'name',$model) ? $model['name'] : '';?>"  >
				                    </div>
				                </div>
			                
				                <div class="form-group">
				                    <label for="" class="col-sm-2">Display Name</label>
				                    <div class="col-sm-10">
				                        <input type="text" class="form-control" required placeholder="Add tag display name" id="display_name" name="model[display_name]" value="<?php echo array_key_exists( 'display_name',$model) ? $model['display_name'] : '';?>"  >
				                    </div>
				                </div>
			                
				                <div class="form-group">
				                    <label for="" class="col-sm-2">Tag For</label>
				                    <div class="col-sm-10">
										<span class="ui-select "> 
										<?php 
											$selected = array_key_exists( 'tag_for',$model) ?  $model['tag_for'] : '';
											$options = Util::getUniqueTagFor();
											echo form_dropdown('model[tag_for]', $options, $selected, ' id="tag_for" required style="width: 345px;margin-top: 0px;"');
										?>
										</span> 
										<input type="text" id="tag_for_other" class="form-control" placeholder="Add tag for" name="tag_for_other" value="<?php echo $tag_for_other;?>" style="display:none;" >
				                    </div>
				                </div>
				                
			                
				                
				                <div class="form-group">
				                    <label for="" class="col-sm-2">Comments</label>
				                    <div class="col-sm-10">
				                        <textarea class="form-control" name="model[comments]" id="comments" ><?php echo array_key_exists( 'comments',$model) ? $model['comments'] : '';?></textarea>
				                    </div>
				                </div>
				                
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
				                    <label for="" class="col-sm-2"></label>
				                    <div class="col-sm-10 "  data-ng-controller="ModalDemoCtrl">
	
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
                            			  "<?php echo $model['name'];?>" ?
                        					</div>
                        					<div class="modal-footer">
                            					<button class="btn btn-danger" onClick="deactiveCompany()">Yes</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            					<button class="btn btn-primary" ng-click="cancel()">No</button>
                        					</div>
                    					</script>
		
		
		
		
										<input type="hidden" id="tag_id" name="model[tag_id]" value="<?php echo array_key_exists( 'tag_id',$model) ? $model['tag_id'] : '';?>" />	
								<?php  	if (isset($model['status']) && !in_array($model['status'], array( 'inactive', 'delete'))) {?>
					                        <input type="submit" name="submit" value="Submit" class="btn btn-success btn-lg"/>
					            <?php 	}else {	?>
					                		<input type="submit" name="submit" value="Submit" class="btn btn-success btn-lg"/>
					            <?php 	}	?>   
					                	<a href = "<?php echo $base_url; ?>admin/master_tags"  class="btn btn-lg btn-default">Cancel</a>     
							           <?php 	
							                 if (isset($model['tag_id']) && !empty($model['tag_id']))
							                 {	
							                 	if (isset($model['status']) && !empty($model['status'])) 
							          			{
							          				if (in_array($model['status'], array( 'inactive', 'delete'))) {	?>
							          					<a style="float: right;" href="javascript:void(0);" ng-click="open()" id="deactiveCompany" data-hrefval="<?php echo $base_url;?>admin/master_tags/changeStatus/<?php echo $model['tag_id'];?>/active" class="btn btn-danger btn-lg" >Activate Tag</a>
							          	<?php 		}
							          				else if (in_array($model['status'], array( 'active'))) {?>
							                 			<a style="float: right;" href="javascript:void(0);" ng-click="open()" id="deactiveCompany" data-hrefval="<?php echo $base_url;?>admin/master_tags/changeStatus/<?php echo $model['tag_id'];?>/inactive" class="btn btn-danger btn-lg" >De-activate Tag</a>
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