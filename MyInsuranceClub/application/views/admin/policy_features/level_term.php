
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
				                <div class="form-group">
				                    <label for="" class="col-sm-4">Gender</label>
				                    <div class="col-sm-8">
				                         <?php 
										$selected = array_key_exists( 'gender',$model) ? $model['gender'] : '';
										$options = array('male'=>'Male', 'female'=>'female', 'male, female'=>'Both');		
										foreach ($options as $k1=>$v1)
										{
											$op = array(
											    'name'        => 'model[gender]',
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
				                    <label for="" class="col-sm-4">Healthy</label>
				                    <div class="col-sm-8">
				                         <?php 
										$selected = array_key_exists( 'healthy',$model) ? $model['healthy'] : '';
										$options = array('yes'=>'Yes', 'no'=>'No');		
										foreach ($options as $k1=>$v1)
										{
											$op = array(
											    'name'        => 'model[healthy]',
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
				                    <label for="" class="col-sm-4">Smoker</label>
				                    <div class="col-sm-8">
				                         <?php 
										$selected = array_key_exists( 'smoker',$model) ? $model['smoker'] : '';
										$options = array('yes'=>'Yes', 'no'=>'No');	
										foreach ($options as $k1=>$v1)
										{
											$op = array(
											    'name'        => 'model[smoker]',
											    'value'       => $k1,
											    'checked'     => ($selected == $k1) ? TRUE : FALSE,
											    'style'       => 'margin:10px',
											    );
											echo '<label class="ui-radio">'.form_radio($op).'<span>'.$v1.'</span></label>';
										}
										?>
				                   	</div>
				                </div>	
				                
				                
								<table cellspacing="0" class="eligibility">
									<tbody>
										<tr>
											<th class="nobg" abbr="Configurations" scope="col">&nbsp;</th>
											<th scope="col">Age</th>
											<th scope="col">Premium Amount</th>
										</tr>
										<tr>
											<th class="spec" scope="row">Sample Premium 1</th>
											<td width="352" valign="top">
												<input type="text" class="form-control"  placeholder="Sample Age" name="model[sample_premium_age_1]" value="<?php echo array_key_exists( 'sample_premium_age_1',$model) ? $model['sample_premium_age_1'] : '';?>"  >
											</td>
											<td width="352" valign="top">
												<input type="text" class="form-control"  placeholder="Sample Premium" name="model[sample_premium_amount_1]" value="<?php echo array_key_exists( 'sample_premium_amount_1',$model) ? $model['sample_premium_amount_1'] : '';?>"  >
											</td>
										</tr>
										<tr>
											<th class="specalt" scope="row">Sample Premium 2</th>
											<td width="352" valign="top">
												<input type="text" class="form-control"  placeholder="Sample Age" name="model[sample_premium_age_2]" value="<?php echo array_key_exists( 'sample_premium_age_2',$model) ? $model['sample_premium_age_2'] : '';?>"  >
											</td>
											<td width="352" valign="top">
												<input type="text" class="form-control"  placeholder="Sample Premium" name="model[sample_premium_amount_2]" value="<?php echo array_key_exists( 'sample_premium_amount_2',$model) ? $model['sample_premium_amount_2'] : '';?>"  >
											</td>
										</tr>
										<tr>
											<th class="spec" scope="row">Sample Premium 3</th>
											<td width="352" valign="top">
												<input type="text" class="form-control"  placeholder="Sample Age" name="model[sample_premium_age_3]" value="<?php echo array_key_exists( 'sample_premium_age_3',$model) ? $model['sample_premium_age_3'] : '';?>"  >
											</td>
											<td width="352" valign="top">
												<input type="text" class="form-control"  placeholder="Sample Premium" name="model[sample_premium_amount_3]" value="<?php echo array_key_exists( 'sample_premium_amount_3',$model) ? $model['sample_premium_amount_3'] : '';?>"  >
											</td>
										</tr>
										<tr>
											<th class="specalt" scope="row">Sample Premium 4</th>
											<td width="352" valign="top">
												<input type="text" class="form-control"  placeholder="Sample Age" name="model[sample_premium_age_4]" value="<?php echo array_key_exists( 'sample_premium_age_4',$model) ? $model['sample_premium_age_4'] : '';?>"  >
											</td>
											<td width="352" valign="top">
												<input type="text" class="form-control"  placeholder="Sample Premium" name="model[sample_premium_amount_4]" value="<?php echo array_key_exists( 'sample_premium_amount_4',$model) ? $model['sample_premium_amount_4'] : '';?>"  >
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
								<table cellspacing="0" class="eligibility">
										<tr>
											<th class="nobg" abbr="Configurations" scope="col">&nbsp;</th>
											<th scope="col">Rider Display Name</th>
											<th scope="col">Rider Value</th>
											<th scope="col">Comments</th>
										</tr>
<?php 
									$riderSlugs = Util::getRiderSlugs('level-term');
									if (!empty($riderSlugs['slug']))
									{
										foreach ($riderSlugs['slug'] as $k1=>$v1)
										{		
											$valRidVal = $valCom = $valName = '';
											$valDisName = $v1;
											if (!empty($riderModel) && isset($riderModel[$k1]))
											{
												$valName = $riderModel[$k1]['rider_name'];
												$valDisName = $riderModel[$k1]['rider_display_name'];
												$valRidVal = $riderModel[$k1]['rider_value'];
												$valCom = $riderModel[$k1]['comments'];
											}
											?>
											<tr>
												<th class="spec" scope="row" width="234" valign="top" style="border-top: 1px solid #c1dad7">
													<?php echo $v1;?>
													<input type="hidden" class="form-control"  placeholder="" name="riderModel[<?php echo $k1;?>][rider_name]" value="<?php echo !empty($valName) ? $valName : $valDisName;?>"  >
												</th>
												<td width="258" valign="top" style="border-top: 1px solid #c1dad7">
													<input type="text" class="form-control"  placeholder="" name="riderModel[<?php echo $k1;?>][rider_display_name]" value="<?php echo $valDisName;?>"  >
												</td>
												<td width="258" valign="top" style="border-top: 1px solid #c1dad7">
													<input type="text" class="form-control"  placeholder="" name="riderModel[<?php echo $k1;?>][rider_value]" value="<?php echo $valRidVal;?>"  >
												</td>
												<td width="258" valign="top" style="border-top: 1px solid #c1dad7">
													<input type="text" class="form-control"  placeholder="" name="riderModel[<?php echo $k1;?>][comments]" value="<?php echo $valCom;?>"  >
												</td>
											</tr>
<?php 									}
									}
?>			                
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
					                        <textarea class="form-control" rows="5" name="model[tax_benefit]"><?php echo array_key_exists( 'tax_benefit',$model) ? $model['tax_benefit'] : '';?></textarea>
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
			                <div class="panel-heading"><strong><span class="glyphicon glyphicon-th-list"></span> Additional Details</strong></div>
			                <div class="panel-body">
			                
				                <div class="form-group">
				                    <label for="" class="col-sm-3">Surrender Policy</label>
				                    <div class="col-sm-9">
				                    	<span class="icon glyphicon glyphicon-star"></span>
				                        <textarea class="form-control ckeditor"  rows="5" name="model[surrender_policy]"><?php echo array_key_exists( 'surrender_policy',$model) ? $model['surrender_policy'] : '';?></textarea>
				                        <?php echo display_ckeditor($ckeditor); ?>
				                   	</div>
				                </div>
			                
				                <div class="form-group">
				                    <label for="" class="col-sm-3">Revive Policy</label>
				                    <div class="col-sm-9">
				                    	<span class="icon glyphicon glyphicon-star"></span>
				                        <textarea class="form-control ckeditor"  rows="5" name="model[revive_policy]"><?php echo array_key_exists( 'revive_policy',$model) ? $model['revive_policy'] : '';?></textarea>
				                        <?php echo display_ckeditor($ckeditor); ?>
				                   	</div>
				                </div>
			                
				                <div class="form-group">
				                    <label for="" class="col-sm-3">Loan</label>
				                    <div class="col-sm-9">
				                    	<span class="icon glyphicon glyphicon-star"></span>
				                        <textarea class="form-control ckeditor"  rows="5" name="model[loan]"><?php echo array_key_exists( 'loan',$model) ? $model['loan'] : '';?></textarea>
				                        <?php echo display_ckeditor($ckeditor); ?>
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
			                <div class="panel-heading"><strong><span class="glyphicon glyphicon-th-list"></span> Peer Comparision</strong></div>
			                <div class="panel-body">
								<table cellspacing="0" class="eligibility">
										<tr>
											<th scope="col">Company Name</th>
											<th scope="col">Policy Name</th>
											<th scope="col">Variant Name</th>
											<th scope="col">Comparision Count</th>
											<th class="nobg" abbr="Configurations" scope="col" style=" border-right:0px; !important">&nbsp;</th>
										</tr>
<?php 
									$peerValue = (isset($model['pear_comparision_policies']) && !empty($model['pear_comparision_policies'])) ?  $model['pear_comparision_policies'] : '';
									$peerValue = explode(',', $peerValue);
									
									if (!empty($allVariants))
									{
										foreach ($allVariants as $k1=>$v1)
										{	
											if ($v1['policy_id'] != $policyModel['policy_id'])
											{
												$checked = '';
												if (in_array($v1['variant_id'], $peerValue))
													$checked = 'checked';
												?>
												<tr>
													<td class="spec" scope="row" width="334" valign="top" style="border-top: 1px solid #c1dad7; border-left: 1px solid #c1dad7">
														<?php echo $v1['company_display_name']?>
													</td>
													<td class="spec" scope="row" width="334" valign="top" style="border-top: 1px solid #c1dad7">
														<?php echo (!empty($v1['policy_display_name'])) ? $v1['policy_display_name'] : $v1['policy_name']?>
													</td>
													<td class="spec" scope="row" width="234" valign="top" style="border-top: 1px solid #c1dad7">
														<?php echo $v1['variant_name']?>
													</td>
													<td class="spec" scope="row" width="200" valign="top" style="border-top: 1px solid #c1dad7">
														<?php echo $v1['peer_comparision_count']?>
													</td>
													<td class="spec" scope="row" width="24" valign="top" style="border-top: 1px solid #c1dad7;">
														<label class="ui-checkbox"><input name="model[pear_comparision_policies][]" type="checkbox" value="<?php echo $v1['variant_id']?>" <?php echo $checked;?>><span></span></label>
													</td>
												</tr>
<?php 										}
										}
									}
?>			                
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