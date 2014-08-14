
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
<style>
.eligibility td {
    border-left: 1px solid #c1dad7;
}
</style>
<?php 
//var_dump($variantModel, $policyModel, $companyModel);
?>
<div class="page" data-ng-controller="signupCtrl">
<?php 	$attributes = array('class'=>"form-horizontal form-validation");
		echo form_open_multipart(current_url(), $attributes);	?>
	<div class="panel panel-primary">
    	<div class="panel-heading">
        	<strong>
        		<span class="glyphicon glyphicon-th-list"></span> <?php echo $companyModel['company_shortname'].' - '.((!empty($policyModel['policy_display_name']))?$policyModel['policy_display_name'] : $policyModel['policy_name']).' - '.$variantModel['variant_name']?> 
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
											<th class="spec" scope="row">Coverage Amounts (in USD.)</th>
											<td width="252" valign="top" colspan="2">
											<?php 
												$defaultCoverage = array('min'=>'','max'=>'', 'value'=>array(), 'comments'=>'');
												$coverage_amount = array_key_exists( 'coverage_amount',$model) ? unserialize($model['coverage_amount']) : array();
													
												if (empty($coverage_amount))
													$coverage_amount = $defaultCoverage;													
												$values = $coverage_amount['value']; 
											?>
												<div class="row">
													<div class="col-sm-3">
														<div class="checkbox">
						                                    <label>
						                                        <input type="checkbox" name="model[coverage_amount][value][]" value="0.5 lakh" class="model_coverage_amount" <?php echo (in_array('0.5 lakh', $values)) ? 'checked' : ''?>> 0.5 Lakhs
						                                    </label>
							                            </div>
							                        </div> 
													<div class="col-sm-3">
														<div class="checkbox">
						                                    <label>
						                                        <input type="checkbox" name="model[coverage_amount][value][]" value="0.75 lakh" class="model_coverage_amount"  <?php echo (in_array('0.75 lakh', $values)) ? 'checked' : ''?>> 0.75 Lakh
						                                    </label>
							                            </div>
							                        </div> 
											<?php 
													for ($i = 1; $i <= 10; $i += 0.25) 
													{	
														$checked = (in_array($i.' lakhs', $values)) ? 'checked' : '';
														?>
													<div class="col-sm-3">
														<div class="checkbox">
						                                    <label>
						                                        <input type="checkbox" name="model[coverage_amount][value][]" class="model_coverage_amount"  <?php echo $checked;?> value="<?php echo $i.' lakhs';?>"> <?php echo $i?> Lakhs
						                                    </label>
							                            </div>
							                        </div> 
											<?php 	}
													for ($i = 15; $i <= 100; $i += 5) 
													{	
														$checked = (in_array($i.' lakhs', $values)) ? 'checked' : '';
														if ($i == 100)
															$checked = (in_array('1 crore', $values)) ? 'checked' : '';
														?>
													<div class="col-sm-3">
														<div class="checkbox">
						                                    <label>
						                                        <input type="checkbox" name="model[coverage_amount][value][]" class="model_coverage_amount"  <?php echo $checked;?> value="<?php echo ($i != 100) ? $i.' lakhs':'1 crore'; ?>"> <?php echo ($i != 100) ? $i.' Lakhs':'1 Crore'; ?>
						                                    </label>
							                            </div>
							                        </div> 
											<?php 	}	?>
												</div>
												<div class="divider"></div>
												<div class="row">
								                    <label for="" class="col-sm-2">Comment</label>
								                    <div class="col-sm-10">
								                        <input type="text" class="form-control"  placeholder="Max 255 characters" name="model[coverage_amount][comment][]" maxlength="255" value="<?php echo (isset($coverage_amount['comments']) && !empty($coverage_amount['comments'])) ? $coverage_amount['comments'] : '';?>"  >
								                    </div>
												</div>
											</td>
										</tr>
										
										
										<tr>
											<th class="spec" scope="row">Duration of Coverage/Policy Term (In Years)</th>
											<td width="252" valign="top" >
											
												<div>
													<label for="">Individual</label>	
									                <div class="row">
									                <?php 
									                	$defaultEntryAge = array(	'minimum'=>array(	'individual'=>array('value'=>'', 'type'=>'', 'comments'=>''),
									                													'family_floater'=>array('value'=>'', 'type'=>'', 'comments'=>'')),
															                		'maximum'=>array(	'individual'=>array('value'=>'', 'type'=>'', 'comments'=>''),
															                							'family_floater'=>array('value'=>'', 'type'=>'', 'comments'=>'')));
									                	
														$entryAge = array_key_exists( 'policy_terms',$model) ? unserialize($model['policy_terms']) : '';
														if (empty($entryAge))
															$entryAge = $defaultEntryAge;
														
														$selected = $entryAge['minimum']['individual']['type'];									
									                ?>
									                    <div class="col-sm-10" style="padding-right: 0px; padding-left: 0px; width: 307px;"> 
										                    <?php 
																$options = array('days'=>'Days','months'=>'Months', 'years'=>'Years');		
																foreach ($options as $k1=>$v1)
																{
																	$op = array(
																	    'name'        => 'model[policy_terms][minimum][individual][type]',
																	    'value'       => $k1,
																	    'checked'     => ($selected == $k1) ? TRUE : FALSE,
																	    'style'       => 'margin:10px',
																	    );
																	echo '<label class="ui-radio">'.form_radio($op).'<span>'.$v1.'</span></label>';
																}
															?>
									                    </div> 
									                    <div class="col-sm-2" style="padding-left: 0px; border-right-width: 0px; padding-right: 0px;display:<?php echo ($entryAge['minimum']['individual']['type'] != 'no limit') ? 'block;' : 'none;';?>;">
									                        <input type="text" class="form-control numberValidation" maxlength="2" placeholder="Min Age" name="model[policy_terms][minimum][individual][value]" value="<?php echo $entryAge['minimum']['individual']['value'];?>"  >
									                    </div>          
									                </div>
													<div class="divider"></div> 
													<div class="row">  
									                    <label for="" class="col-sm-3">Comment</label>
									                    <div class="col-sm-9">
									                    	<?php //$entry_age = array_key_exists( 'entry_age_comments',$model) ? unserialize($model['entry_age_comments']) : array('min'=>'', 'max'=>'');?>
									                        <input type="text" class="form-control"  placeholder="Max 127 characters" name="model[policy_terms][minimum][individual][comments]" maxlength="127" value="<?php echo $entryAge['minimum']['individual']['comments'];?>"  >
									                    </div>
													</div>
												</div>	
												<div class="divider"></div> 
												<div>
													<label for="">Family Floater</label>	
									                <div class="row">
									                <?php 
														$selected = $entryAge['minimum']['family_floater']['type'];									
									                ?>
									                    <div class="col-sm-10" style="padding-right: 0px; padding-left: 0px; width: 307px;"> 
										                    <?php 	
																foreach ($options as $k1=>$v1)
																{
																	$op = array(
																	    'class'       => 'showHideNextDivByRadio',
																	    'name'        => 'model[policy_terms][minimum][family_floater][type]',
																	    'value'       => $k1,
																	    'checked'     => ($selected == $k1) ? TRUE : FALSE,
																	    'style'       => 'margin:10px',
																	    );
																	echo '<label class="ui-radio">'.form_radio($op).'<span>'.$v1.'</span></label>';
																}
															?>
									                    </div> 
									                    <div class="col-sm-2" style="padding-left: 0px; border-right-width: 0px; padding-right: 0px;display:<?php echo ($entryAge['minimum']['family_floater']['type'] != 'no limit') ? 'block;' : 'none;';?>;">
									                        <input type="text" class="form-control numberValidation" maxlength="2" placeholder="Min Age" name="model[policy_terms][minimum][family_floater][value]" value="<?php echo $entryAge['minimum']['family_floater']['value'];?>"  >
									                    </div>          
									                </div>
													<div class="divider"></div> 
													<div class="row">  
									                    <label for="" class="col-sm-3">Comment</label>
									                    <div class="col-sm-9">
									                    	<?php //$entry_age = array_key_exists( 'entry_age_comments',$model) ? unserialize($model['entry_age_comments']) : array('min'=>'', 'max'=>'');?>
									                        <input type="text" class="form-control"  placeholder="Max 127 characters" name="model[policy_terms][minimum][family_floater][comments]" maxlength="127" value="<?php echo $entryAge['minimum']['family_floater']['comments'];?>"  >
									                    </div>
													</div>
												</div>	
											</td>
											
											<td width="252" valign="top" >
											
												<div>
													<label for="">Individual</label>	
									                <div class="row">
									                <?php 
														$selected = $entryAge['maximum']['individual']['type'];									
									                ?>
									                    <div class="col-sm-10" style="padding-right: 0px; padding-left: 0px; width: 307px;"> 
										                    <?php 	
																foreach ($options as $k1=>$v1)
																{
																	$op = array(
																	    'name'        => 'model[policy_terms][maximum][individual][type]',
																	    'value'       => $k1,
																	    'checked'     => ($selected == $k1) ? TRUE : FALSE,
																	    'style'       => 'margin:10px',
																	    );
																	echo '<label class="ui-radio">'.form_radio($op).'<span>'.$v1.'</span></label>';
																}
															?>
									                    </div> 
									                    <div class="col-sm-2" style="padding-left: 0px; border-right-width: 0px; padding-right: 0px;display:<?php echo ($entryAge['maximum']['individual']['type'] != 'no limit') ? 'block;' : 'none;';?>;">
									                        <input type="text" class="form-control numberValidation" maxlength="2" placeholder="Min Age" name="model[policy_terms][maximum][individual][value]" value="<?php echo $entryAge['maximum']['individual']['value'];?>"  >
									                    </div>          
									                </div>
													<div class="divider"></div> 
													<div class="row">  
									                    <label for="" class="col-sm-3">Comment</label>
									                    <div class="col-sm-9">
									                    	<?php //$entry_age = array_key_exists( 'entry_age_comments',$model) ? unserialize($model['entry_age_comments']) : array('min'=>'', 'max'=>'');?>
									                        <input type="text" class="form-control"  placeholder="Max 127 characters" name="model[policy_terms][maximum][individual][comments]" maxlength="127" value="<?php echo $entryAge['maximum']['individual']['comments'];?>"  >
									                    </div>
													</div>
												</div>	
												<div class="divider"></div> 
												<div>
													<label for="">Family Floater</label>	
									                <div class="row">
									                <?php 
														$selected = $entryAge['maximum']['family_floater']['type'];									
									                ?>
									                    <div class="col-sm-10" style="padding-right: 0px; padding-left: 0px; width: 307px;"> 
										                    <?php 	
																foreach ($options as $k1=>$v1)
																{
																	$op = array(
																	    'name'        => 'model[policy_terms][maximum][family_floater][type]',
																	    'value'       => $k1,
																	    'checked'     => ($selected == $k1) ? TRUE : FALSE,
																	    'style'       => 'margin:10px',
																	    );
																	echo '<label class="ui-radio">'.form_radio($op).'<span>'.$v1.'</span></label>';
																}
															?>
									                    </div> 
									                    <div class="col-sm-2" style="padding-left: 0px; border-right-width: 0px; padding-right: 0px;display:<?php echo ($entryAge['maximum']['family_floater']['type'] != 'no limit') ? 'block;' : 'none;';?>;">
									                        <input type="text" class="form-control numberValidation" maxlength="2" placeholder="Min Age" name="model[policy_terms][maximum][family_floater][value]" value="<?php echo $entryAge['maximum']['family_floater']['value'];?>"  >
									                    </div>          
									                </div>
													<div class="divider"></div> 
													<div class="row">  
									                    <label for="" class="col-sm-3">Comment</label>
									                    <div class="col-sm-9">
									                    	<?php //$entry_age = array_key_exists( 'entry_age_comments',$model) ? unserialize($model['entry_age_comments']) : array('min'=>'', 'max'=>'');?>
									                        <input type="text" class="form-control"  placeholder="Max 127 characters" name="model[policy_terms][maximum][family_floater][comments]" maxlength="127" value="<?php echo $entryAge['maximum']['family_floater']['comments'];?>"  >
									                    </div>
													</div>
												</div>	
											</td>
										</tr>
										
										
										<tr>
											<th class="specalt" scope="row" width="234" valign="top">Entry Age (in years)</th>
											<td width="252" valign="top">
												
												<div>
													<label for="">Individual</label>	
									                <div class="row">
									                <?php 
									                	$defaultEntryAge = array(	'minimum'=>array(	'individual'=>array('value'=>'', 'type'=>'', 'comments'=>''),
									                													'family_floater'=>array('value'=>'', 'type'=>'', 'comments'=>'')),
															                		'maximum'=>array(	'individual'=>array('value'=>'', 'type'=>'', 'comments'=>''),
															                							'family_floater'=>array('value'=>'', 'type'=>'', 'comments'=>'')));
									                	
														$entryAge = array_key_exists( 'entry_age',$model) ? unserialize($model['entry_age']) : '';
														if (empty($entryAge))
															$entryAge = $defaultEntryAge;
														
														$selected = $entryAge['minimum']['individual']['type'];									
									                ?>
									                    <div class="col-sm-10" style="padding-right: 0px; padding-left: 0px; width: 307px;"> 
										                    <?php 
										                    	$options = array('days'=>'Days','months'=>'Months', 'years'=>'Years');	
																foreach ($options as $k1=>$v1)
																{
																	$op = array(
																	    'name'        => 'model[entry_age][minimum][individual][type]',
																	    'value'       => $k1,
																	    'checked'     => ($selected == $k1) ? TRUE : FALSE,
																	    'style'       => 'margin:10px',
																	    );
																	echo '<label class="ui-radio">'.form_radio($op).'<span>'.$v1.'</span></label>';
																}
															?>
									                    </div> 
									                    <div class="col-sm-2" style="padding-left: 0px; border-right-width: 0px; padding-right: 0px;display:<?php echo ($entryAge['minimum']['individual']['type'] != 'no limit') ? 'block;' : 'none;';?>;">
									                        <input type="text" class="form-control numberValidation" maxlength="2" placeholder="Min Age" name="model[entry_age][minimum][individual][value]" value="<?php echo $entryAge['minimum']['individual']['value'];?>"  >
									                    </div>          
									                </div>
													<div class="divider"></div> 
													<div class="row">  
									                    <label for="" class="col-sm-3">Comment</label>
									                    <div class="col-sm-9">
									                    	<?php //$entry_age = array_key_exists( 'entry_age_comments',$model) ? unserialize($model['entry_age_comments']) : array('min'=>'', 'max'=>'');?>
									                        <input type="text" class="form-control"  placeholder="Max 127 characters" name="model[entry_age][minimum][individual][comments]" maxlength="127" value="<?php echo $entryAge['minimum']['individual']['comments'];?>"  >
									                    </div>
													</div>
												</div>	
												<div class="divider"></div> 
												<div>
													<label for="">Family Floater</label>	
									                <div class="row">
									                <?php 
														$selected = $entryAge['minimum']['family_floater']['type'];									
									                ?>
									                    <div class="col-sm-10" style="padding-right: 0px; padding-left: 0px; width: 307px;"> 
										                    <?php 
																foreach ($options as $k1=>$v1)
																{
																	$op = array(
																	    'name'        => 'model[entry_age][minimum][family_floater][type]',
																	    'value'       => $k1,
																	    'checked'     => ($selected == $k1) ? TRUE : FALSE,
																	    'style'       => 'margin:10px',
																	    );
																	echo '<label class="ui-radio">'.form_radio($op).'<span>'.$v1.'</span></label>';
																}
															?>
									                    </div> 
									                    <div class="col-sm-2" style="padding-left: 0px; border-right-width: 0px; padding-right: 0px;display:<?php echo ($entryAge['minimum']['family_floater']['type'] != 'no limit') ? 'block;' : 'none;';?>;">
									                        <input type="text" class="form-control numberValidation" maxlength="2" placeholder="Min Age" name="model[entry_age][minimum][family_floater][value]" value="<?php echo $entryAge['minimum']['family_floater']['value'];?>"  >
									                    </div>          
									                </div>
													<div class="divider"></div> 
													<div class="row">  
									                    <label for="" class="col-sm-3">Comment</label>
									                    <div class="col-sm-9">
									                    	<?php //$entry_age = array_key_exists( 'entry_age_comments',$model) ? unserialize($model['entry_age_comments']) : array('min'=>'', 'max'=>'');?>
									                        <input type="text" class="form-control"  placeholder="Max 127 characters" name="model[entry_age][minimum][family_floater][comments]" maxlength="127" value="<?php echo $entryAge['minimum']['family_floater']['comments'];?>"  >
									                    </div>
													</div>
												</div>	
											</td>
											
											<td width="252" valign="top" >
											
												<div>
													<label for="">Individual</label>	
									                <div class="row">
									                <?php 
														$selected = $entryAge['maximum']['individual']['type'];									
									                ?>
									                    <div class="col-sm-10" style="padding-right: 0px; padding-left: 0px; width: 307px;"> 
										                    <?php 	
																foreach ($options as $k1=>$v1)
																{
																	$op = array(
																	    'name'        => 'model[entry_age][maximum][individual][type]',
																	    'value'       => $k1,
																	    'checked'     => ($selected == $k1) ? TRUE : FALSE,
																	    'style'       => 'margin:10px',
																	    );
																	echo '<label class="ui-radio">'.form_radio($op).'<span>'.$v1.'</span></label>';
																}
															?>
									                    </div> 
									                    <div class="col-sm-2" style="padding-left: 0px; border-right-width: 0px; padding-right: 0px;display:<?php echo ($entryAge['maximum']['individual']['type'] != 'no limit') ? 'block;' : 'none;';?>;">
									                        <input type="text" class="form-control numberValidation" maxlength="2" placeholder="Min Age" name="model[entry_age][maximum][individual][value]" value="<?php echo $entryAge['maximum']['individual']['value'];?>"  >
									                    </div>          
									                </div>
													<div class="divider"></div> 
													<div class="row">  
									                    <label for="" class="col-sm-3">Comment</label>
									                    <div class="col-sm-9">
									                    	<?php //$entry_age = array_key_exists( 'entry_age_comments',$model) ? unserialize($model['entry_age_comments']) : array('min'=>'', 'max'=>'');?>
									                        <input type="text" class="form-control"  placeholder="Max 127 characters" name="model[entry_age][maximum][individual][comments]" maxlength="127" value="<?php echo $entryAge['maximum']['individual']['comments'];?>"  >
									                    </div>
													</div>
												</div>	
												<div class="divider"></div> 
												<div>
													<label for="">Family Floater</label>	
									                <div class="row">
									                <?php 
														$selected = $entryAge['maximum']['family_floater']['type'];									
									                ?>
									                    <div class="col-sm-10" style="padding-right: 0px; padding-left: 0px; width: 307px;"> 
										                    <?php 	
																foreach ($options as $k1=>$v1)
																{
																	$op = array(
																	    'name'        => 'model[entry_age][maximum][family_floater][type]',
																	    'value'       => $k1,
																	    'checked'     => ($selected == $k1) ? TRUE : FALSE,
																	    'style'       => 'margin:10px',
																	    );
																	echo '<label class="ui-radio">'.form_radio($op).'<span>'.$v1.'</span></label>';
																}
															?>
									                    </div> 
									                    <div class="col-sm-2" style="padding-left: 0px; border-right-width: 0px; padding-right: 0px;display:<?php echo ($entryAge['maximum']['family_floater']['type'] != 'no limit') ? 'block;' : 'none;';?>;">
									                        <input type="text" class="form-control numberValidation" maxlength="2" placeholder="Min Age" name="model[entry_age][maximum][family_floater][value]" value="<?php echo $entryAge['maximum']['family_floater']['value'];?>"  >
									                    </div>          
									                </div>
													<div class="divider"></div> 
													<div class="row">  
									                    <label for="" class="col-sm-3">Comment</label>
									                    <div class="col-sm-9">
									                    	<?php //$entry_age = array_key_exists( 'entry_age_comments',$model) ? unserialize($model['entry_age_comments']) : array('min'=>'', 'max'=>'');?>
									                        <input type="text" class="form-control"  placeholder="Max 127 characters" name="model[entry_age][maximum][family_floater][comments]" maxlength="127" value="<?php echo $entryAge['maximum']['family_floater']['comments'];?>"  >
									                    </div>
													</div>
												</div>	
											</td>
										</tr>
										<tr>
											<th class="spec" scope="row" width="234" valign="top">Renewable till Age (in years)</th>
											<td width="252" valign="top" colspan="2">
								                <div class="row">
								                <?php 		                
													$selected = array_key_exists( 'maximum_renewal_age',$model) ? $model['maximum_renewal_age'] : '';												
								                ?>
								                    <div class="col-sm-5"> 
									                    <?php 
															$options = array('yes'=>'Renewable', 'no'=>'No Renewable');		
															foreach ($options as $k1=>$v1)
															{
																$op = array(
																    'name'        => 'model[maximum_renewal_age]',
																    'value'       => $k1,
																    'checked'     => ($selected == $k1) ? TRUE : FALSE,
																    'style'       => 'margin:10px',
																    );
																echo '<label class="ui-radio">'.form_radio($op).'<span>'.$v1.'</span></label>';
															}
														?>
								                    </div>       
								                </div>	
											
											
											</td>
										</tr>
									
										<tr>
											<th class="specalt" scope="row" width="234" valign="top"><strong>No Medical Test Age (in years)</strong></th>
											<td width="510" valign="top" colspan="2">
								                <div class="row">
												<?php
													$defaultOrgan = array('covered'=>'', 'min'=>'', 'max'=>'', 'comments'=>'');
													$organ = array_key_exists( 'no_medical_test_age',$model) ? unserialize($model['no_medical_test_age']) : array();
													if (empty($organ))
														$organ = $defaultOrgan;
													$selected = $organ['covered'];
								                ?>
								                    <div class="col-sm-12"> 
									                    <?php 
															$options = array('yes'=>'Yes', 'all'=>'All', 'specific'=>'Specific', 'no'=>'No');		
															foreach ($options as $k1=>$v1)
															{
																$op = array(
																    'class'       => 'showHideNextDivByRadio',
																    'name'        => 'model[no_medical_test_age][covered]',
																    'value'       => $k1,
																    'checked'     => ($selected == $k1) ? TRUE : FALSE,
																    'style'       => 'margin:10px',
																    );
																echo '<label class="ui-radio">'.form_radio($op).'<span>'.$v1.'</span></label>';
															}
														?>
								                    </div> 
								                    <div class="col-sm-12 row" style="display:<?php echo ($selected != 'no') ? 'block' : 'none';?>;">
														<div class="row" >						
											                <div class="col-sm-6">
											                    <div class="col-sm-6"> 
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Min</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control" placeholder="" name="model[no_medical_test_age][min]" value="<?php echo $organ['min'];?>" >
											                    </div>              
											                </div>			
											                <div class="col-sm-6">
											                    <div class="col-sm-6"> 
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Max</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control" placeholder="" name="model[no_medical_test_age][max]" value="<?php echo $organ['max'];?>" >
											                    </div>              
											                </div>	
											            </div>
								                    </div>    
								                    <br clear="all">
									                <div class="divider"></div> 
													<div class="row" >						
										                <div class="col-sm-12">
										                    <div class="col-sm-2"> 
										                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Comments</label>
										                    </div>  
										                    <div class="col-sm-10">
										                   		<input type="text" class="form-control"  placeholder="" name="model[no_medical_test_age][comments]" value="<?php echo $organ['comments'];?>" >
										                    </div>            
										                </div>	
									                </div>
								                </div>
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
			                <div class="panel-heading"><strong><span class="glyphicon glyphicon-th-list"></span> Basic Benefits</strong></div>
			                <div class="panel-body">
			                
								<table cellspacing="0" class="eligibility">
									<tbody>
										<tr>
											<th class="nobg" abbr="Configurations" scope="col">&nbsp;</th>
											<th scope="col">Minimum</th>
											<th scope="col">Maximum</th>
										</tr>
									
										<tr>
											<th class="spec" scope="row" width="234" valign="top"><strong>No Medical Sum Assured limit</strong></th>
											<td width="510" valign="top" colspan="2">
								                <div class="row">
												<?php
													$defaultOrgan = array('covered'=>'', 'per_illness'=>'', 'per_accident'=>'', 'max'=>'', 'comments'=>'');
													$organ = array_key_exists( 'no_medical_sum_assured_limit',$model) ? unserialize($model['no_medical_sum_assured_limit']) : array();
													if (empty($organ))
														$organ = $defaultOrgan;
													$selected = $organ['covered'];
								                ?>
								                    <div class="col-sm-12"> 
									                    <?php 
															$options = array('yes'=>'Yes', 'no'=>'No');		
															foreach ($options as $k1=>$v1)
															{
																$op = array(
																    'class'       => 'showHideNextDivByRadio',
																    'name'        => 'model[no_medical_sum_assured_limit][covered]',
																    'value'       => $k1,
																    'checked'     => ($selected == $k1) ? TRUE : FALSE,
																    'style'       => 'margin:10px',
																    );
																echo '<label class="ui-radio">'.form_radio($op).'<span>'.$v1.'</span></label>';
															}
														?>
								                    </div> 
								                    <div class="col-sm-12 row" style="display:<?php echo ($selected != 'no') ? 'block' : 'none';?>;">
														<div class="row" >						
											                <div class="col-sm-4">
											                    <div class="col-sm-6"> 
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Per Illness</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control" placeholder="" name="model[no_medical_sum_assured_limit][per_illness]" value="<?php echo $organ['per_illness'];?>" >
											                    </div>              
											                </div>			
											                <div class="col-sm-4">
											                    <div class="col-sm-6"> 
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Per Accident</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control" placeholder="" name="model[no_medical_sum_assured_limit][per_accident]" value="<?php echo $organ['per_accident'];?>" >
											                    </div>              
											                </div>	
											                <div class="col-sm-4">
											                    <div class="col-sm-6"> 
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Max Amount</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control" placeholder="" name="model[no_medical_sum_assured_limit][max]" value="<?php echo $organ['max'];?>" >
											                    </div>              
											                </div>	
											            </div>
								                    </div>    
								                    <br clear="all">
									                <div class="divider"></div> 
													<div class="row" >						
										                <div class="col-sm-12">
										                    <div class="col-sm-2"> 
										                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Comments</label>
										                    </div>  
										                    <div class="col-sm-10">
										                   		<input type="text" class="form-control"  placeholder="" name="model[no_medical_sum_assured_limit][comments]" value="<?php echo $organ['comments'];?>" >
										                    </div>            
										                </div>	
									                </div>
								                </div>
											</td>
										</tr>
										
										<tr>
											<th class="specalt" scope="row" width="234" valign="top">Cashless Treatment</th>
											<td width="510" valign="top" colspan="2">
											
								                <div class="row">
												<?php
													$defaultEopinion = array('covered'=>'', 'comments'=>'');
													$eopinion = array_key_exists( 'cashless_treatment',$model) ? unserialize($model['cashless_treatment']) : array();
													if (empty($eopinion))
														$eopinion = $defaultEopinion;
													$selected = $eopinion['covered'];
								                ?>
								                    <div class="col-sm-12"> 
									                    <?php 
															$options = array('yes'=>'Covered', 'no'=>'Not Covered');		
															foreach ($options as $k1=>$v1)
															{
																$op = array(
																    'name'        => 'model[cashless_treatment][covered]',
																    'value'       => $k1,
																    'checked'     => ($selected == $k1) ? TRUE : FALSE,
																    'style'       => 'margin:10px',
																    );
																echo '<label class="ui-radio">'.form_radio($op).'<span>'.$v1.'</span></label>';
															}
														?>
								                    </div> 
								                    <br clear="all">
									                <div class="divider"></div> 
													<div class="row" >						
										                <div class="col-sm-12">
										                    <div class="col-sm-2"> 
										                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Comments</label>
										                    </div>  
										                    <div class="col-sm-10">
										                   		<input type="text" class="form-control" maxlength="120" placeholder="Max 127 Chars" name="model[cashless_treatment][comments]" value="<?php echo $eopinion['comments'];?>" >
										                    </div>            
										                </div>	
									                </div>
								                </div>	
											</td>
										</tr>
										
										
										<tr>
											<th class="spec" scope="row" width="234" valign="top">Pre-existing diseases</th>
											<td width="510" valign="top" colspan="2">
											
								                <div class="row">
												<?php
													$defaultEopinion = array('covered'=>'', 'comments'=>'');
													$eopinion = array_key_exists( 'pre_existing_diseases',$model) ? unserialize($model['pre_existing_diseases']) : array();
													if (empty($eopinion))
														$eopinion = $defaultEopinion;
													$selected = $eopinion['covered'];
								                ?>
								                    <div class="col-sm-12"> 
									                    <?php 
															$options = array('yes'=>'Covered', 'no'=>'Not Covered');		
															foreach ($options as $k1=>$v1)
															{
																$op = array(
																    'name'        => 'model[pre_existing_diseases][covered]',
																    'value'       => $k1,
																    'checked'     => ($selected == $k1) ? TRUE : FALSE,
																    'style'       => 'margin:10px',
																    );
																echo '<label class="ui-radio">'.form_radio($op).'<span>'.$v1.'</span></label>';
															}
														?>
								                    </div> 
								                    <br clear="all">
									                <div class="divider"></div> 
													<div class="row" >						
										                <div class="col-sm-12">
										                    <div class="col-sm-2"> 
										                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Comments</label>
										                    </div>  
										                    <div class="col-sm-10">
										                   		<input type="text" class="form-control" maxlength="120" placeholder="Max 127 Chars" name="model[pre_existing_diseases][comments]" value="<?php echo $eopinion['comments'];?>" >
										                    </div>            
										                </div>	
									                </div>
								                </div>	
											</td>
										</tr>
										
										<tr>
											<th class="specalt" scope="row" width="234" valign="top">Sub Limits</th>
											<td width="510" valign="top" colspan="2">
												<textarea class="form-control" rows="5" name="model[sub_limits]"><?php echo array_key_exists( 'sub_limits',$model) ? $model['sub_limits'] : '';?></textarea>
											</td>
										</tr>
										<tr>
											<th class="spec" scope="row" width="234" valign="top"><strong>Buying Mode</strong></th>
											<td colspan="2">&nbsp;</td>
										</tr>
										<tr>
											<td class="pad-70">Online</td>
											<td width="510" valign="top" colspan="2">
							                    <?php 
							                    	$selected = array_key_exists( 'buying_online',$model) ? $model['buying_online'] : '';
													$options = array('yes'=>'Yes', 'no'=>'No');		
													foreach ($options as $k1=>$v1)
													{
														$op = array(
														    'name'        => 'model[buying_online]',
														    'value'       => $k1,
														    'checked'     => ($selected == $k1) ? TRUE : FALSE,
														    'style'       => 'margin:10px',
														    );
														echo '<label class="ui-radio">'.form_radio($op).'<span>'.$v1.'</span></label>';
													}
												?>
											</td>
										</tr>
										<tr>
											<td class="pad-70">Offline</td>
											<td width="510" valign="top" colspan="2">
							                    <?php 
							                    	$selected = array_key_exists( 'buying_offline',$model) ? $model['buying_offline'] : '';
													$options = array('yes'=>'Yes', 'no'=>'No');		
													foreach ($options as $k1=>$v1)
													{
														$op = array(
														    'name'        => 'model[buying_offline]',
														    'value'       => $k1,
														    'checked'     => ($selected == $k1) ? TRUE : FALSE,
														    'style'       => 'margin:10px',
														    );
														echo '<label class="ui-radio">'.form_radio($op).'<span>'.$v1.'</span></label>';
													}
												?>
											</td>
										</tr>
										
										
										<tr>
											<th class="spec" scope="row" width="234" valign="top"><strong>Free Look Period</strong></th>
											<td width="510" valign="top" colspan="2">
								                <div class="row">
												<?php
													$defaultOrgan = array('covered'=>'', 'days'=>'', 'trip_type'=>'', 'comments'=>'');
													$organ = array_key_exists( 'free_look_period',$model) ? unserialize($model['free_look_period']) : array();
													if (empty($organ))
														$organ = $defaultOrgan;
													$selected = $organ['covered'];
								                ?>
								                    <div class="col-sm-12"> 
									                    <?php 
															$options = array('yes'=>'Yes', 'no'=>'No');		
															foreach ($options as $k1=>$v1)
															{
																$op = array(
																    'class'       => 'showHideNextDivByRadio',
																    'name'        => 'model[free_look_period][covered]',
																    'value'       => $k1,
																    'checked'     => ($selected == $k1) ? TRUE : FALSE,
																    'style'       => 'margin:10px',
																    );
																echo '<label class="ui-radio">'.form_radio($op).'<span>'.$v1.'</span></label>';
															}
														?>
								                    </div> 
								                    <div class="col-sm-12 row" style="display:<?php echo ($selected != 'no') ? 'block' : 'none';?>;">
														<div class="row" >						
											                <div class="col-sm-4">
											                    <div class="col-sm-6"> 
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Days</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control" placeholder="" name="model[free_look_period][days]" value="<?php echo $organ['days'];?>" >
											                    </div>              
											                </div>			
											                <div class="col-sm-8">
											                    
									                    <?php 
															$selected = $organ['covered'];
															$options = array('single'=>'Single', 'multi trip'=>'Multi Trip', 'student'=>'Student');		
															foreach ($options as $k1=>$v1)
															{
																$op = array(
																    'name'        => 'model[free_look_period][trip_type]',
																    'value'       => $k1,
																    'checked'     => ($selected == $k1) ? TRUE : FALSE,
																    'style'       => 'margin:10px',
																    );
																echo '<label class="ui-radio">'.form_radio($op).'<span>'.$v1.'</span></label>';
															}
														?>             
											                </div>
											            </div>
								                    </div>    
								                    <br clear="all">
									                <div class="divider"></div> 
													<div class="row" >						
										                <div class="col-sm-12">
										                    <div class="col-sm-2"> 
										                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Comments</label>
										                    </div>  
										                    <div class="col-sm-10">
										                   		<input type="text" class="form-control"  placeholder="" name="model[free_look_period][comments]" value="<?php echo $organ['comments'];?>" >
										                    </div>            
										                </div>	
									                </div>
								                </div>
											</td>
										</tr>
										
										<tr>
											<th class="spec" scope="row" width="234" valign="top"><strong>Grace Period</strong></th>
											<td width="510" valign="top" colspan="2">
								                <div class="row">
												<?php
													$defaultOrgan = array('covered'=>'', 'days'=>'', 'trip_type'=>'', 'comments'=>'');
													$organ = array_key_exists( 'grace_period',$model) ? unserialize($model['grace_period']) : array();
													if (empty($organ))
														$organ = $defaultOrgan;
													$selected = $organ['covered'];
								                ?>
								                    <div class="col-sm-12"> 
									                    <?php 
															$options = array('yes'=>'Yes', 'no'=>'No');		
															foreach ($options as $k1=>$v1)
															{
																$op = array(
																    'class'       => 'showHideNextDivByRadio',
																    'name'        => 'model[grace_period][covered]',
																    'value'       => $k1,
																    'checked'     => ($selected == $k1) ? TRUE : FALSE,
																    'style'       => 'margin:10px',
																    );
																echo '<label class="ui-radio">'.form_radio($op).'<span>'.$v1.'</span></label>';
															}
														?>
								                    </div> 
								                    <div class="col-sm-12 row" style="display:<?php echo ($selected != 'no') ? 'block' : 'none';?>;">
														<div class="row" >						
											                <div class="col-sm-4">
											                    <div class="col-sm-6"> 
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Days</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control" placeholder="" name="model[grace_period][days]" value="<?php echo $organ['days'];?>" >
											                    </div>              
											                </div>			
											                <div class="col-sm-8">
											                    
									                    <?php 
															$selected = $organ['covered'];
															$options = array('single'=>'Single', 'multi trip'=>'Multi Trip', 'student'=>'Student');		
															foreach ($options as $k1=>$v1)
															{
																$op = array(
																    'name'        => 'model[grace_period][trip_type]',
																    'value'       => $k1,
																    'checked'     => ($selected == $k1) ? TRUE : FALSE,
																    'style'       => 'margin:10px',
																    );
																echo '<label class="ui-radio">'.form_radio($op).'<span>'.$v1.'</span></label>';
															}
														?>             
											                </div>
											            </div>
								                    </div>    
								                    <br clear="all">
									                <div class="divider"></div> 
													<div class="row" >						
										                <div class="col-sm-12">
										                    <div class="col-sm-2"> 
										                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Comments</label>
										                    </div>  
										                    <div class="col-sm-10">
										                   		<input type="text" class="form-control"  placeholder="" name="model[grace_period][comments]" value="<?php echo $organ['comments'];?>" >
										                    </div>            
										                </div>	
									                </div>
								                </div>
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

$(document).ready(function(){
	
	$(".model_coverage_amount").click(function()
	{
		var searchIDs = $(".model_coverage_amount:checked").map(function(){
	        return this.value;
	    }).toArray();

	    if(jQuery.isEmptyObject(searchIDs))
    	{
		    $('#model_minimum_coverage_amount').val('');
		    $('#model_maximum_coverage_amount').val('');
    	}
	    else
	    {
		    $('#model_minimum_coverage_amount').val(searchIDs[0]);
		    $('#model_maximum_coverage_amount').val(searchIDs.pop());
	    }
	});


	
	$(".model_duration_of_coverage").click(function()
	{
		var searchIDs = $(".model_duration_of_coverage:checked").map(function(){
	        return this.value;
	    }).toArray();

	    if(jQuery.isEmptyObject(searchIDs))
    	{
		    $('#model_minimum_policy_terms').val('');
		    $('#model_maximum_policy_terms').val('');
    	}
	    else
	    {
		    $('#model_minimum_policy_terms').val(searchIDs[0]);
		    $('#model_maximum_policy_terms').val(searchIDs.pop());
	    }
	});

	$('.showHideNextDivByRadio').click(function(){
		var curVal = $(this).val(); 		
		if(curVal == 'lifelong' || curVal == 'no limit' || curVal == 'no')
			$(this).parent().parent().next().hide();
		else
			$(this).parent().parent().next().show();	
	});

	$('.maternityBenefit').click(function(){
		var curVal = $(this).val(); 		
		if(curVal == 'yes')
			$('.maternityBenefitClass').show();
		else
			$('.maternityBenefitClass').hide();
	});
});
//-->
</script>