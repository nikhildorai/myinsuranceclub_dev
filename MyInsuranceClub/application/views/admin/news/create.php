<script type="text/javascript">
<!--
$(document).ready(function(){
<?php if (isset($model['status']) && !empty($model['status']) && in_array($model['status'], array( 'inactive', 'delete'))) {
$this->data['status'] = $model['status'];
	?>
$(".form-horizontal :input").prop("disabled", true);
<?php }?>	
$( "#publish_date" ).datepicker({
    showButtonPanel: true,
    showOn: "both",
    minDate:0,
    buttonImage: "<?php echo base_url().'/'?>images/calendar.gif",
    buttonImageOnly: true,
    dateFormat:'dd-mm-yy',
	});
});
</script>

<link rel="stylesheet" href="<?php echo base_url();?>css/jquery-ui-1.10.4.custom.css">
<div class="page" data-ng-controller="signupCtrl">
<?php 	$attributes = array('class'=>"form-horizontal form-validation");
		echo form_open_multipart(current_url(), $attributes);	?>
	<div class="panel panel-primary">
    	<div class="panel-heading">
        	<strong>
        		<span class="glyphicon glyphicon-th-list"></span> <?php echo (isset($model['news_id']) && !empty($model['news_id'])) ? 'Update Article' : 'Create Article';?> 
        	</strong>
        	
        	<a href="<?php echo $base_url;?>admin/news/" class="btn btn-w-md btn-gap-v btn-default btn-sm" style="float: right; margin-top: -5px;">Back</a>
        	
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
			                <div class="panel-heading"><strong><span class="glyphicon glyphicon-th-list"></span> News Details</strong></div>
			                <div class="panel-body">
			                
				                <div class="form-group">
				                    <label for="" class="col-sm-3">Title</label>
				                    <div class="col-sm-9">
				                        <input type="text" class="form-control" required placeholder="Add title" id="title" name="model[title]" value="<?php echo array_key_exists( 'title',$model) ? $model['title'] : '';?>"  >
				                    </div>
				                </div>
				                
				                <div class="form-group">
				                    <label for="" class="col-sm-3">Description</label>
				                    <div class="col-sm-9">
				                        <textarea required class="form-control" name="model[description]" id="description" ><?php echo array_key_exists( 'description',$model) ? $model['description'] : '';?></textarea>
				                        <?php echo display_ckeditor($this->data['ckeditor']); ?>
				                    </div>
					                <div class="form-group">
					                </div>
				                </div>
				                
				                <div class="form-group">
				                    <label for="" class="col-sm-3">Publish Date</label>
				                    <div class="col-sm-5">
				                     <input type="text" required id="publish_date" name = "model[publish_date]" class="form-control" value="<?php echo array_key_exists( 'publish_date',$model) ? $this->util->getDate($model['publish_date']) : date('d-m-Y');;?>">
				                    </div>
					                <div class="form-group">
					                </div>
				                </div>
			                
				                <div class="form-group">
				                    <label for="" class="col-sm-3">Category</label>
				                    <div class="col-sm-9">
				                    <?php 
										$selected = array_key_exists( 'category',$model) ? explode(',',$model['category']) : '';
										$sqlFilter['orderBy'] = 'product_name';
										$healthOptions = $this->util->getCompanyTypeDropDownOptions($modelName ='Product_model', $optionKey = 'product_id', $optionValue = 'product_name', $defaultEmpty = "Please Select", $extraKeys = false, $where=array(), $sqlFilter); 
				                    ?>
										<span class="ui-select "> 
										<?php 
											echo form_dropdown('model[category]', $healthOptions, $selected, 'id="category" style="width: 345px; margin-top: 0px;"');
										?>		
										</span> 
				                        <?php /*?><input type="text" class="form-control" placeholder="" required id="category" name="model[category]" value="<?php echo array_key_exists( 'category',$model) ? $model['category'] : '';?>"  > */ ?>
				                    </div>
				                </div>
			                
				                <div class="form-group"> 
									<?php $selected = array_key_exists( 'author',$model) ? $model['author'] : '';?>
				                    <label for="" class="col-sm-3">Author</label>
				                    <div class="col-sm-9">
									<span class="ui-select "> 
										<select id="author" name="model[author]" required style="width: 345px; margin-top: 0px;">
											<?php echo $this->util->getUserDropdownList($selected);?>
										</select>	
									</span> 
				                    </div>
				                </div>
				                
				                
				                <div class="form-group">
				                    <label for="" class="col-sm-3">SEO Title</label>
				                    <div class="col-sm-9">
				                        <input type="text" class="form-control" required  placeholder="SEO Title" maxlength="90" maxlength="90"  id="seo_title" name="model[seo_title]" value="<?php echo array_key_exists( 'seo_title',$model) ? $model['seo_title'] : '';?>" >
				                        <span class="help-block">Max length 90 characters.</span>
				                    </div>
				                </div>
				                
				                <div class="form-group">
				                    <label for="" class="col-sm-3">SEO Description</label>
				                    <div class="col-sm-9">
				                        <textarea class="form-control" rows="5"  required maxlength="175" id="seo_description" name="model[seo_description]"><?php echo array_key_exists( 'seo_description',$model) ? $model['seo_description'] : '';?></textarea>
				                        <span class="help-block">Max length 175 characters.</span>
				                    </div>
				                </div>
				                
				                <div class="form-group">
				                    <label for="" class="col-sm-3">SEO Keywords</label>
				                    <div class="col-sm-9">
				                        <textarea class="form-control" rows="4" required maxlength="175" id="seo_keywords" name="model[seo_keywords]"><?php echo array_key_exists( 'seo_keywords',$model) ? $model['seo_keywords'] : '';?></textarea>
				                    </div>
				                </div>
				                
								<?php 
								//	tagit widget
								echo widget::run('tagit'); ?>
								
				                <div class="form-group">
				                    <label for="" class="col-sm-3">URL</label>
				                    <div class="col-sm-9">
				                        <input type="text" class="form-control"  required placeholder="URL"  id="url" name="model[slug]" value="<?php echo array_key_exists( 'slug',$model) ? $model['slug'] : '';?>"  >
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
                            			  "<?php echo $model['title'];?>" ?
                        					</div>
                        					<div class="modal-footer">
                            					<button class="btn btn-danger" onClick="deactiveCompany()">Yes</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            					<button class="btn btn-primary" ng-click="cancel()">No</button>
                        					</div>
                    					</script>
                    					
								<input type="hidden" id="news_id" name="model[news_id]" value="<?php echo array_key_exists( 'news_id',$model) ? $model['news_id'] : '';?>" />
								<?php  	if (isset($model['status']) && !in_array($model['status'], array( 'inactive', 'delete'))) {?>
					                        <input type="submit" name="submit" value="Submit" class="btn btn-success btn-lg  " />
					            <?php 	}else {	?>
					                		<input type="submit" name="submit" value="Submit" class="btn btn-success btn-lg  " />
					            <?php 	}	?>   
					                	<a href = "<?php echo $base_url; ?>admin/news"  class="btn btn-lg btn-default">Cancel</a>     
							           <?php 	
							                 if (isset($model['news_id']) && !empty($model['news_id']))
							                 {	
							                 	if (isset($model['status']) && !empty($model['status'])) 
							          			{
							          				if (in_array($model['status'], array( 'inactive', 'delete'))) {	?>
							          					<a style="float: right;" href="javascript:void(0);" ng-click="open()" id="deactiveCompany" data-hrefval="<?php echo $base_url;?>admin/news/changeStatus/<?php echo $model['news_id'];?>/active" class="btn btn-danger btn-lg" >Activate Article</a>
							          	<?php 		}
							          				else if (in_array($model['status'], array( 'active'))) {?>
							                 			<a style="float: right;" href="javascript:void(0);" ng-click="open()" id="deactiveCompany" data-hrefval="<?php echo $base_url;?>admin/news/changeStatus/<?php echo $model['news_id'];?>/inactive" class="btn btn-danger btn-lg" >De-activate Article</a>
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
			                		
					
			
	        <div class="row">
		        <div class="col-md-12">
		        	<div class="panel-body">    
			            <section class="panel panel-default">
			                <div class="panel-body">
				                <div class="form-group">
									<?php echo $this->disqus->get_html();?>
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