
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/pages.css">
<script type="text/javascript">
$(document).ready(function(){
<?php if (isset($model['status']) && !empty($model['status']) && in_array($model['status'], array( 'inactive', 'delete'))) {
$this->data['status'] = $model['status'];
	?>
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
        		<span class="glyphicon glyphicon-th-list"></span> <?php echo 'Variant feature details - '.$variantModel['variant_name']?> 
        	</strong>
        	
        	<a href="<?php echo $base_url;?>admin/articles/" class="btn btn-w-md btn-gap-v btn-default btn-sm" style="float: right; margin-top: -5px;">Back</a>
        	
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
			                <div class="panel-heading"><strong><span class="glyphicon glyphicon-th-list"></span> Sample Premium</strong></div>
			                <div class="panel-body">
			                	<?php echo widget::run('samplePremiumBack', array('model'=>$model)); ?>
							</div>
			            </section>
					</div>
			    </div>
			</div> 
			
			
			
	        <div class="row">
		        <div class="col-md-12">
		        	<div class="panel-body">    
			            <section class="panel panel-default">
			                <div class="panel-heading"><strong><span class="glyphicon glyphicon-th-list"></span> Eligibility Conditions</strong></div>
			                <div class="panel-body">
			                
								<table cellspacing="0" class="eligibility">
									<tbody>
										<tr>
											<th class="nobg" abbr="Configurations" scope="col">&nbsp;</th>
											<th scope="col">Minimum</th>
											<th scope="col">Maximum</th>
										</tr>
										<tr>
											<th class="spec" scope="row">Sum Assured (in Rs.)</th>
											<td width="252" valign="top">
												<input type="text" class="form-control"  placeholder="Min Sum Assured" name="model[minimum_sum_assured]" value="<?php echo array_key_exists( 'minimum_sum_assured',$model) ? $model['minimum_sum_assured'] : '';?>"  >
											</td>
											<td width="241" valign="top">
												<input type="text" class="form-control"  placeholder="Max Sum Assured" name="model[maximum_sum_assured]" value="<?php echo array_key_exists( 'maximum_sum_assured',$model) ? $model['maximum_sum_assured'] : '';?>"  >
											</td>
										</tr>
										<tr>
											<th class="specalt" scope="row">Policy Term (in years)</th>
											<td width="252" valign="top">
												<input type="text" class="form-control"  placeholder="Min Policy Term" name="model[minimum_policy_terms]" value="<?php echo array_key_exists( 'minimum_policy_terms',$model) ? $model['minimum_policy_terms'] : '';?>"  >
											</td>
											<td width="241" valign="top">
												<input type="text" class="form-control"  placeholder="Max Policy Term" name="model[maximum_policy_terms]" value="<?php echo array_key_exists( 'maximum_policy_terms',$model) ? $model['maximum_policy_terms'] : '';?>"  >
											</td>
										</tr>
										<tr>
											<th class="spec" scope="row" width="234" valign="top">Premium Payment Term (in years)</th>
											<td width="493" valign="top" colspan="2">
												<input type="text" class="form-control"  placeholder="Premium Payment Term" name="model[premium_payment_terms]" value="<?php echo array_key_exists( 'premium_payment_terms',$model) ? $model['premium_payment_terms'] : '';?>"  >
											</td>
										</tr>
										<tr>
											<th class="specalt" scope="row" width="234" valign="top">Entry Age of Policyholder</th>
											<td width="252" valign="top">
												<input type="text" class="form-control"  placeholder="Min Entry Age" name="model[minimum_entry_age]" value="<?php echo array_key_exists( 'minimum_entry_age',$model) ? $model['minimum_entry_age'] : '';?>"  >
											</td>
											<td width="241" valign="top">
												<input type="text" class="form-control"  placeholder="Max Entry Age" name="model[maximum_entry_age]" value="<?php echo array_key_exists( 'maximum_entry_age',$model) ? $model['maximum_entry_age'] : '';?>"  >
											</td>
										</tr>
										<tr>
											<th class="spec" scope="row" width="234" valign="top">Age at Maturity</th>
											<td width="252" valign="top">
												<input type="text" class="form-control"  placeholder="Min Age at Maturity" name="model[minimum_age_at_maturity]" value="<?php echo array_key_exists( 'minimum_age_at_maturity',$model) ? $model['minimum_age_at_maturity'] : '';?>"  >
											</td>
											<td width="241" valign="top">
												<input type="text" class="form-control"  placeholder="Max Age at Maturity" name="model[maximum_age_at_maturity]" value="<?php echo array_key_exists( 'maximum_age_at_maturity',$model) ? $model['maximum_age_at_maturity'] : '';?>"  >
											</td>
										</tr>
										<tr>
											<th class="specalt" scope="row" width="234" valign="top">Premium (in Rs.)</th>
											<td width="252" valign="top">
												<input type="text" class="form-control"  placeholder="Min Premium" name="model[minimum_premium]" value="<?php echo array_key_exists( 'minimum_premium',$model) ? $model['minimum_premium'] : '';?>"  >
											</td>
											<td width="241" valign="top">
												<input type="text" class="form-control"  placeholder="Max Premium" name="model[maximum_premium]" value="<?php echo array_key_exists( 'maximum_premium',$model) ? $model['maximum_premium'] : '';?>"  >
											</td>
										</tr>
										<tr>
											<th class="spec" scope="row" width="234" valign="top">Payment modes</th>
											<td width="493" valign="top" colspan="2">
												 <?php 
												$selected = array_key_exists( 'payment_modes',$model) ? $model['payment_modes'] : '';
												$options = Util::getPremiumPaymentMode();		
												foreach ($options as $k1=>$v1)
												{
													$op = array(
													    'name'        => 'model[payment_modes]',
													    'value'       => $k1,
													    'checked'     => ($selected == $k1) ? TRUE : FALSE,
													    'style'       => 'margin:10px',
													    );
													echo '<label class="ui-radio">'.form_radio($op).'<span>'.$v1.'</span></label>';
												}
												?>
											</td>
										</tr>
									</tbody>
								</table>

			                </div>
			            </section>
					</div>
			    </div>
			</div>  
			
			
				
	        <div class="row">
		        <div class="col-md-12">
		        	<div class="panel-body">    
			            <section class="panel panel-default">
			                <div class="panel-heading"><strong><span class="glyphicon glyphicon-th-list"></span> Riders</strong></div>
			                <div class="panel-body">
			                	<?php echo widget::run('ridersBack', array('riderModel'=>$riderModel, 'rSlug'=>'level-term')); ?>
							</div>
			            </section>
					</div>
			    </div>
			</div>  
			
			
				
	        <div class="row">
		        <div class="col-md-12">
		        	<div class="panel-body">    
			            <section class="panel panel-default">
			                <div class="panel-heading"><strong><span class="glyphicon glyphicon-th-list"></span> Benefits & Features</strong></div>
			                <div class="panel-body">
			                
					                <div class="form-group">
					                    <label for="" class="col-sm-3">Death Benefit</label>
					                    <div class="col-sm-9">
					                    	<span class="icon glyphicon glyphicon-star"></span>
					                        <textarea class="form-control" rows="5" name="model[death_benefit]"><?php echo array_key_exists( 'death_benefit',$model) ? $model['death_benefit'] : '';?></textarea>
					                   	</div>
					                </div>
			                
					                <div class="form-group">
					                    <label for="" class="col-sm-3">Maturity Benefit</label>
					                    <div class="col-sm-9">
					                    	<span class="icon glyphicon glyphicon-star"></span>
					                        <textarea class="form-control" rows="5" name="model[maturity_benefit]"><?php echo array_key_exists( 'maturity_benefit',$model) ? $model['maturity_benefit'] : '';?></textarea>
					                   	</div>
					                </div>
			                
					                <div class="form-group">
					                    <label for="" class="col-sm-3">Surrender Benefit</label>
					                    <div class="col-sm-9">
					                    	<span class="icon glyphicon glyphicon-star"></span>
					                        <textarea class="form-control" rows="5" name="model[surrender_benefit]"><?php echo array_key_exists( 'surrender_benefit',$model) ? $model['surrender_benefit'] : '';?></textarea>
					                   	</div>
					                </div>
			                
					                <div class="form-group">
					                    <label for="" class="col-sm-3">Tax Benefit</label>
					                    <div class="col-sm-9">
					                    	<span class="icon glyphicon glyphicon-star"></span>
					                        <textarea class="form-control" rows="5" name="model[tax_benefits]"><?php echo array_key_exists( 'tax_benefits',$model) ? $model['tax_benefits'] : '';?></textarea>
					                   	</div>
					                </div>
					                
			                </div>
			            </section>
					</div>
			    </div>
			</div>  
			
			
		<?php /*?>	
	        <div class="row">
		        <div class="col-md-12">
		        	<div class="panel-body">    
			            <section class="panel panel-default">
			                <div class="panel-heading"><strong><span class="glyphicon glyphicon-th-list"></span> Additional Details</strong></div>
			                <div class="panel-body">
			                
			                	<?php echo widget::run('additionalDetailsBack', array('model'=>$model, 'ckeditor'=>$ckeditor)); ?>
				                
			                </div>
			            </section>
					</div>
			    </div>
			</div>  
			*/ ?>
			
				
	        <div class="row">
		        <div class="col-md-12">
		        	<div class="panel-body">    
			            <section class="panel panel-default">
			                <div class="panel-heading"><strong><span class="glyphicon glyphicon-th-list"></span> Peer Comparision</strong></div>
			                <div class="panel-body">
			                
			                <?php echo widget::run('peerComparisionBack', array('policy_id'=>$policyModel['policy_id'], 'pear_comparision_policies'=>$model['pear_comparision_policies'], 'allVariants'=>$allVariants)); ?>
			                
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
                    					
								<?php  	if (isset($model['status']) && !in_array($model['status'], array( 'inactive', 'delete'))) {?>
					                        <input type="submit" name="submit" value="Submit" class="btn btn-success btn-lg  " />
					            <?php 	}else {	?>
					                		<input type="submit" name="submit" value="Submit" class="btn btn-success btn-lg  " />
					            <?php 	}	?>   
					                	<a href = "<?php echo $base_url; ?>admin/articles"  class="btn btn-lg btn-default" style="margin-left: 30px;">Cancel</a>     
							           <?php 	
							                 if (isset($model['article_id']) && !empty($model['article_id']))
							                 {	
							                 	if (isset($model['status']) && !empty($model['status'])) 
							          			{
							          				if (in_array($model['status'], array( 'inactive', 'delete'))) {	?>
							          					<a style="float: right;" href="javascript:void(0);" ng-click="open()" id="deactiveCompany" data-hrefval="<?php echo $base_url;?>admin/articles/changeStatus/<?php echo $model['article_id'];?>/active" class="btn btn-danger btn-lg" >Activate Article</a>
							          	<?php 		}
							          				else if (in_array($model['status'], array( 'active'))) {?>
							                 			<a style="float: right;" href="javascript:void(0);" ng-click="open()" id="deactiveCompany" data-hrefval="<?php echo $base_url;?>admin/articles/changeStatus/<?php echo $model['article_id'];?>/inactive" class="btn btn-danger btn-lg" >De-activate Article</a>
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