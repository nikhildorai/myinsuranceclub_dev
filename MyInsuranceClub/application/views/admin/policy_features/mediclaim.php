
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
        		<span class="glyphicon glyphicon-th-list"></span> <?php echo $companyModel['company_shortname'].' - '.$policyModel['policy_display_name'].' - '.$variantModel['variant_name']?> 
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
											<th class="spec" scope="row">Coverage Amounts (in Rs.)</th>
											<td width="252" valign="top" colspan="2">
											<?php 
												$coverage_amount = array_key_exists( 'coverage_amount',$model) ? unserialize($model['coverage_amount']) : array();	
												if (empty($coverage_amount))
													$coverage_amount1 = array('value'=>array(), 'comments'=>'');
												else 
												{
													$coverage_amount1 = array(	'value'=>(isset($coverage_amount['value']) && !empty($coverage_amount['value'])) ? explode(',', $coverage_amount['value']) : array(), 
																				'comments'=>(isset($coverage_amount['comments']) && !empty($coverage_amount['comments'])) ? reset($coverage_amount['comments']) : '');
												}	
												$coverage_amount = $coverage_amount1;
											?>
												<div class="row">
													<div class="col-sm-3">
														<div class="checkbox">
						                                    <label>
						                                        <input type="checkbox" name="model[coverage_amount][value][]" value="0.5 lakh" class="model_coverage_amount" <?php echo (in_array('0.5 lakh', $coverage_amount['value'])) ? 'checked' : ''?>> 0.5 Lakhs
						                                    </label>
							                            </div>
							                        </div> 
													<div class="col-sm-3">
														<div class="checkbox">
						                                    <label>
						                                        <input type="checkbox" name="model[coverage_amount][value][]" value="0.75 lakh" class="model_coverage_amount"  <?php echo (in_array('0.75 lakh', $coverage_amount['value'])) ? 'checked' : ''?>> 0.75 Lakh
						                                    </label>
							                            </div>
							                        </div> 
											<?php 
													for ($i = 1; $i <= 10; $i += 0.25) 
													{	
														$checked = (in_array($i.' lakhs', $coverage_amount['value'])) ? 'checked' : '';
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
														$checked = (in_array($i.' lakhs', $coverage_amount['value'])) ? 'checked' : '';
														if ($i == 100)
															$checked = (in_array('1 crore', $coverage_amount['value'])) ? 'checked' : '';
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
											<th class="spec" scope="row">Coverage Amount (in Rs.)</th>
											<td width="252" valign="top">
												<input type="text" class="form-control"  placeholder="Min Sum Assured" id="model_minimum_coverage_amount" name="model[minimum_coverage_amount]" disabled value="<?php echo array_key_exists( 'minimum_coverage_amount',$model) ? $model['minimum_coverage_amount'] : '';?>"  >
											</td>
											<td width="241" valign="top">
												<input type="text" class="form-control"  placeholder="Max Sum Assured" id="model_maximum_coverage_amount" ame="model[maximum_coverage_amount]" disabled value="<?php echo array_key_exists( 'maximum_coverage_amount',$model) ? $model['maximum_coverage_amount'] : '';?>"  >
											</td>
										</tr>
										
										
										
										<tr>
											<th class="spec" scope="row">Duration of Coverage (In Years)</th>
											<td width="252" valign="top" colspan="2">
											<?php 
												$coverage_amount = array_key_exists( 'duration_of_coverage',$model) ? explode(',', $model['duration_of_coverage']) : array();
											
												for ($i = 1; $i <= 3; $i ++) 
												{	
													$checked = (in_array($i.' years', $coverage_amount)) ? 'checked' : '';
													?>
												<div class="col-sm-3">
													<div class="checkbox">
					                                    <label>
					                                        <input type="checkbox" name="model[duration_of_coverage][]" class="model_duration_of_coverage"  <?php echo $checked;?> value="<?php echo $i.' years';?>"> <?php echo $i?> Years
					                                    </label>
						                            </div>
						                        </div> 
										<?php 	}	?>
											</td>
										</tr>
										
										
										<tr>
											<th class="specalt" scope="row">Policy Term (in years)</th>
											<td width="252" valign="top">
												<input type="text" class="form-control" disabled placeholder="Min Policy Term" id="model_minimum_policy_terms" name="model[minimum_policy_terms]" value="<?php echo array_key_exists( 'minimum_policy_terms',$model) ? $model['minimum_policy_terms'] : '';?>"  >
											</td>
											<td width="241" valign="top">
												<input type="text" class="form-control" disabled placeholder="Max Policy Term" id="model_maximum_policy_terms" name="model[maximum_policy_terms]" value="<?php echo array_key_exists( 'maximum_policy_terms',$model) ? $model['maximum_policy_terms'] : '';?>"  >
											</td>
										</tr>
										<tr>
											<th class="spec" scope="row" width="234" valign="top">Entry Age (in years)</th>
											<td width="252" valign="top">
																
								                <div class="row">
								                <?php 
													$str = array_key_exists( 'minimum_entry_age',$model) ? $model['minimum_entry_age'] : '';
													$values = reset(Util::getNumbersFromString($str));
													if (strpos($str, 'days'))
														$yearVal = 'days';
													else if ($str == 'no limit')
														$yearVal = 'no limit';
													else 
														$yearVal = 'years';									
								                ?>
								                    <div class="col-sm-10" style="padding-right: 0px; padding-left: 0px; width: 307px;"> 
									                    <?php 
															$options = array('days'=>'Days', 'years'=>'Years','no limit'=>'No Limit');		
															foreach ($options as $k1=>$v1)
															{
																$op = array(
																    'class'       => 'showHideNextDivByRadio',
																    'name'        => 'model[minimum_entry_age][]',
																    'value'       => $k1,
																    'checked'     => ($yearVal == $k1) ? TRUE : FALSE,
																    'style'       => 'margin:10px',
																    );
																echo '<label class="ui-radio">'.form_radio($op).'<span>'.$v1.'</span></label>';
															}
														?>
								                    </div> 
								                    <div class="col-sm-2" style="padding-left: 0px; border-right-width: 0px; padding-right: 0px;display:<?php echo ($yearVal != 'no limit') ? 'block;' : 'none;';?>;">
								                        <input type="text" class="form-control numberValidation" maxlength="2" placeholder="Min Age" name="model[minimum_entry_age][]" value="<?php echo (isset($values) && is_array($values))? reset($values) : '';?>"  >
								                    </div>          
								                </div>
												<div class="divider"></div> 
												<div class="row">  
								                    <label for="" class="col-sm-3">Comment</label>
								                    <div class="col-sm-9">
								                    	<?php $entry_age = array_key_exists( 'entry_age_comments',$model) ? unserialize($model['entry_age_comments']) : array('min'=>'', 'max'=>'');?>
								                        <input type="text" class="form-control"  placeholder="Max 127 characters" name="model[entry_age_comments][min]" maxlength="127" value="<?php echo $entry_age['min'];?>"  >
								                    </div>
												</div>
											</td>
											
											<td width="241" valign="top">
											
								                <div class="row">
								                <?php 
													$str = array_key_exists( 'maximum_entry_age',$model) ? $model['maximum_entry_age'] : '';
													$values = reset(Util::getNumbersFromString($str));
													if (strpos($str, 'days'))
														$yearVal = 'days';
													else if ($str == 'no limit')
														$yearVal = 'no limit';
													else 
														$yearVal = 'years';										
								                ?>
								                    <div class="col-sm-10" style="padding-right: 0px; padding-left: 0px; width: 307px;"> 
									                    <?php 
															$options = array('days'=>'Days', 'years'=>'Years','no limit'=>'No Limit');	
															foreach ($options as $k1=>$v1)
															{
																$op = array(
																    'class'       => 'showHideNextDivByRadio',
																    'name'        => 'model[maximum_entry_age][]',
																    'value'       => $k1,
																    'checked'     => ($yearVal == $k1) ? TRUE : FALSE,
																    'style'       => 'margin:10px',
																    );
																echo '<label class="ui-radio">'.form_radio($op).'<span>'.$v1.'</span></label>';
															}
														?>
								                    </div>   
								                    <div class="col-sm-2" style="padding-left: 0px; border-right-width: 0px; padding-right: 0px;display:<?php echo ($yearVal != 'no limit') ? 'block;' : 'none;';?>;">
								                        <input type="text" class="form-control numberValidation" maxlength="2" placeholder="Max Age" name="model[maximum_entry_age][]" value="<?php echo (isset($values) && is_array($values))? reset($values) : '';?>"  >
								                    </div>           
								                </div>	
												<div class="divider"></div>
												<div class="row">
								                    <label for="" class="col-sm-3">Comment</label>
								                    <div class="col-sm-9">
								                        <input type="text" class="form-control"  placeholder="Max 127 characters" name="model[entry_age_comments][max]" maxlength="127" value="<?php echo $entry_age['max'];?>"  >
								                    </div>
												</div>
											</td>
										</tr>
										<tr>
											<th class="specalt" scope="row" width="234" valign="top">Renewable till Age (in years)</th>
											<td width="252" valign="top" colspan="2">
								                <div class="row">
								                <?php 		                
													$str = array_key_exists( 'maximum_renewal_age',$model) ? $model['maximum_renewal_age'] : '';
													$values = reset(Util::getNumbersFromString($str));
													if ($str == 'lifelong')
														$yearVal = 'lifelong';
													else 
														$yearVal = 'years';														
								                ?>
								                    <div class="col-sm-5"> 
									                    <?php 
															$selected = $yearVal;
															$options = array('lifelong'=>'Lifelong', 'years'=>'No. of Years');		
															foreach ($options as $k1=>$v1)
															{
																$op = array(
																    'class'       => 'showHideNextDivByRadio',
																    'name'        => 'model[maximum_renewal_age][]',
																    'value'       => $k1,
																    'checked'     => ($selected == $k1) ? TRUE : FALSE,
																    'style'       => 'margin:10px',
																    );
																echo '<label class="ui-radio">'.form_radio($op).'<span>'.$v1.'</span></label>';
															}
														?>
								                    </div> 
								                    <div class="col-sm-7" style="display:<?php echo ($yearVal == 'years') ? 'block' : 'none';?>;" id="model_maximum_renewal_age_div">
								                    
										                <div class="col-sm-6">
										                    <label for="" class="col-sm-3">Min</label>
										                    <div class="col-sm-9">
										                        <input type="text" class="form-control numberValidation"  placeholder="Min Age" name="model[minimum_renewal_age]" maxlength="2" value="<?php echo array_key_exists( 'minimum_renewal_age',$model) ? $model['minimum_renewal_age'] : ''?>"  >
										                    </div>
										                </div>
										                <div class="col-sm-6">
										                    <label for="" class="col-sm-3">Max</label>
										                    <div class="col-sm-9">
										                        <input type="text" class="form-control numberValidation"  placeholder="Max Age" name="model[maximum_renewal_age][]" maxlength="2" value="<?php echo (isset($values) && is_array($values))? reset($values) : '';?>"  >
										                    </div>
										                </div>
								                    </div>             
								                </div>	
											
											
											</td>
										</tr>
										<tr>
											<th class="spec" scope="row" width="234" valign="top">No Medical Test Age (in years)</th>
											<td width="252" valign="top">
												<input type="text" class="form-control"  placeholder="Min Medical Test Age" name="model[minimum_no_medical_test_age]" value="<?php echo array_key_exists( 'minimum_no_medical_test_age',$model) ? $model['minimum_no_medical_test_age'] : '';?>"  >
											</td>
											<td width="241" valign="top">
												<input type="text" class="form-control"  placeholder="Max Medical Test Age" name="model[maximum_no_medical_test_age]" value="<?php echo array_key_exists( 'maximum_no_medical_test_age',$model) ? $model['maximum_no_medical_test_age'] : '';?>"  >
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
			                	<?php echo widget::run('ridersBack', array('riderModel'=>$riderModel, 'rSlug'=>'mediclaim')); ?>
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
						       	<div class="panel-body ">
			
									<table  cellspacing="0" class="eligibility">
										<thead>
											<tr>
												<th colspan="2">Basic</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<th class="spec" scope="row" width="234" valign="top"><strong>Hospitalisation expenses</strong></th>
												<td>&nbsp;</td>
											</tr>
											<tr>
												<td class="pad-70">Room Rent</td>
												<td width="510" valign="top"><input type="text" class="form-control"  placeholder="" name="model[room_rent]" value="<?php echo array_key_exists( 'room_rent',$model) ? $model['room_rent'] : '';?>" ></td>
											</tr>
											<tr>
												<td class="pad-70">ICU Rent</td>
												<td width="510" valign="top"><input type="text" class="form-control"  placeholder="" name="model[icu_rent]" value="<?php echo array_key_exists( 'icu_rent',$model) ? $model['icu_rent'] : '';?>" ></td>
											</tr>
											<tr>
												<td class="pad-70">Fees of Surgeon, Anesthetist, Nurses and
													Specialists</td>
												<td width="510" valign="top"><input type="text" class="form-control"  placeholder="" name="model[doctor_fee]" value="<?php echo array_key_exists( 'doctor_fee',$model) ? $model['doctor_fee'] : '';?>" ></td>
											</tr>
											<tr>
												<th class="specalt" scope="row" width="234" valign="top"><strong>Pre-hospitalisation</strong></th>
												<td width="510" valign="top"><input type="text" class="form-control"  placeholder="" name="model[pre_hosp]" value="<?php echo array_key_exists( 'pre_hosp',$model) ? $model['pre_hosp'] : '';?>" ></td>
											</tr>
											<tr>
												<th class="spec" scope="row" width="234" valign="top"><strong>Post-hospitalisation</strong></th>
												<td width="510" valign="top"><input type="text" class="form-control"  placeholder="" name="model[post_hosp]" value="<?php echo array_key_exists( 'post_hosp',$model) ? $model['post_hosp'] : '';?>" ></td>
											</tr>
											<tr>
												<th class="specalt" scope="row" width="234" valign="top"><strong>Day care expenses</strong></th>
												<td width="510" valign="top"><input type="text" class="form-control"  placeholder="" name="model[day_care]" value="<?php echo array_key_exists( 'day_care',$model) ? $model['day_care'] : '';?>" ></td>
											</tr>
											<tr>
												<th class="spec" scope="row" width="234" valign="top"><strong>Domiciliary Hospitalisation</strong></th>
												<td width="510" valign="top"><input type="text" class="form-control"  placeholder="" name="model[domiciliary_treatment_expenses]" value="<?php echo array_key_exists( 'domiciliary_treatment_expenses',$model) ? $model['domiciliary_treatment_expenses'] : '';?>" ></td>
											</tr>
										</tbody>
									</table>
			
			                <div class="form-group">
			                </div>
			                
			                <div class="form-group">
			                </div>
									<table  cellspacing="0" class="eligibility">
										<thead>
											<tr>
												<th colspan="2">Maternity Benefits</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<th class="spec" scope="row" width="234" valign="top">Maternity Benefits</th>
												<td width="510" valign="top">
								                    <?php 
														$selected = array_key_exists( 'maternity',$model) ? $model['maternity'] : '';
														$options = array('yes'=>'Yes', 'no'=>'No');		
														foreach ($options as $k1=>$v1)
														{
															$op = array(
															    'name'        => 'model[maternity]',
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
												<th class="spec" scope="row" width="234" valign="top">Waiting Period</th>
												<td width="510" valign="top"><input type="text" class="form-control"  placeholder="" name="model[maternity_waiting_period]" value="<?php echo array_key_exists( 'maternity_waiting_period',$model) ? $model['maternity_waiting_period'] : '';?>" ></td>
											</tr>
											<tr>
												<th class="specalt" scope="row" width="234" valign="top">Normal Delivery</th>
												<td width="510" valign="top"><input type="text" class="form-control"  placeholder="" name="model[maternity_normal_delivery]" value="<?php echo array_key_exists( 'maternity_normal_delivery',$model) ? $model['maternity_normal_delivery'] : '';?>" ></td>
											</tr>
											<tr>
												<th class="spec" scope="row" width="234" valign="top">Caesarean Delivery</th>
												<td width="510" valign="top"><input type="text" class="form-control"  placeholder="" name="model[maternity_caesarean_delivery]" value="<?php echo array_key_exists( 'maternity_caesarean_delivery',$model) ? $model['maternity_caesarean_delivery'] : '';?>" ></td>
											</tr>
											<tr>
												<th class="specalt" scope="row" width="234" valign="top">New-born baby cover</th>
												<td width="510" valign="top"><input type="text" class="form-control"  placeholder="" name="model[maternity_new_born_baby_cover]" value="<?php echo array_key_exists( 'maternity_new_born_baby_cover',$model) ? $model['maternity_new_born_baby_cover'] : '';?>" ></td>
											</tr>
											<tr>
												<th class="spec" scope="row" width="234" valign="top">Addition of New-born</th>
												<td width="510" valign="top"><input type="text" class="form-control"  placeholder="" name="model[maternity_addition_of_new_born]" value="<?php echo array_key_exists( 'maternity_addition_of_new_born',$model) ? $model['maternity_addition_of_new_born'] : '';?>" ></td>
											</tr>
										</tbody>
									</table>
			
			                <div class="form-group">
			                </div>
			                
			                <div class="form-group">
			                </div>
			
									<table cellspacing="0" class="eligibility">
										<thead>
											<tr>
												<th colspan="2">Other Benefits</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<th class="spec" scope="row" width="234" valign="top">Auto Recharge of Sum Insured</th>
												<td width="510" valign="top">
								                    <?php 
														$selected = array_key_exists( 'autorecharge_SI',$model) ? strtolower($model['autorecharge_SI']) : 'no';
														$options = array('yes'=>'Yes', 'no'=>'No');		
														foreach ($options as $k1=>$v1)
														{
															$op = array(
															    'name'        => 'model[autorecharge_SI]',
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
												<th class="specalt" scope="row" width="234" valign="top">Hospital Cash</th>
												<td width="510" valign="top"><input type="text" class="form-control"  placeholder="" name="model[hospital_cash]" value="<?php echo array_key_exists( 'hospital_cash',$model) ? $model['hospital_cash'] : '';?>" ></td>
											</tr>
											<tr>
												<th class="spec" scope="row" width="234" valign="top">Ambulance Charges</th>
												<td width="510" valign="top"><input type="text" class="form-control"  placeholder="" name="model[emergency_ambulance]" value="<?php echo array_key_exists( 'emergency_ambulance',$model) ? $model['emergency_ambulance'] : '';?>" ></td>
											</tr>
											<tr>
												<th class="specalt" scope="row" width="234" valign="top">Recovery Benefit</th>
												<td width="510" valign="top"><input type="text" class="form-control"  placeholder="" name="model[recovery_benefit]" value="<?php echo array_key_exists( 'recovery_benefit',$model) ? $model['recovery_benefit'] : '';?>" ></td>
											</tr>
											<tr>
												<th class="spec" scope="row" width="234" valign="top">Health Check up</th>
												<td width="510" valign="top"><input type="text" class="form-control"  placeholder="" name="model[check_up]" value="<?php echo array_key_exists( 'check_up',$model) ? $model['check_up'] : '';?>" ></td>
											</tr>
											<tr>
												<th class="specalt" scope="row" width="234" valign="top">Organ Donor Cover</th>
												<td width="510" valign="top"><input type="text" class="form-control"  placeholder="" name="model[organ_donor_exp]" value="<?php echo array_key_exists( 'organ_donor_exp',$model) ? $model['organ_donor_exp'] : '';?>" ></td>
											</tr>
											<tr>
												<th class="spec" scope="row" width="234" valign="top">Ayurvedic Treatment</th>
												<td width="510" valign="top"><input type="text" class="form-control"  placeholder="" name="model[ayurvedic]" value="<?php echo array_key_exists( 'ayurvedic',$model) ? $model['ayurvedic'] : '';?>" ></td>
											</tr>
											<tr>
												<th class="specalt" scope="row" width="234" valign="top">Second Opinion</th>
												<td width="510" valign="top"><input type="text" class="form-control"  placeholder="" name="model[second_opinion]" value="<?php echo array_key_exists( 'second_opinion',$model) ? $model['second_opinion'] : '';?>" ></td>
											</tr>
											<tr>
												<th class="spec" scope="row" width="234" valign="top">E-opinion</th>
												<td width="510" valign="top"><input type="text" class="form-control"  placeholder="" name="model[e-opinion]" value="<?php echo array_key_exists( 'e-opinion',$model) ? $model['e-opinion'] : '';?>" ></td>
											</tr>
											<tr>
												<th class="specalt" scope="row" width="234" valign="top">Physiotherapy Charges</th>
												<td width="510" valign="top"><input type="text" class="form-control"  placeholder="" name="model[physiotherapy_charges]" value="<?php echo array_key_exists( 'physiotherapy_charges',$model) ? $model['physiotherapy_charges'] : '';?>" ></td>
											</tr>
											<tr>
												<th class="spec" scope="row" width="234" valign="top">Child Education Fund</th>
												<td width="510" valign="top"><input type="text" class="form-control"  placeholder="" name="model[child_education_fund]" value="<?php echo array_key_exists( 'child_education_fund',$model) ? $model['child_education_fund'] : '';?>" ></td>
											</tr>
											<tr>
												<th class="specalt" scope="row" width="234" valign="top">Health Programs</th>
												<td width="510" valign="top"><input type="text" class="form-control"  placeholder="" name="model[health_programs]" value="<?php echo array_key_exists( 'health_programs',$model) ? $model['health_programs'] : '';?>" ></td>
											</tr>
										</tbody>
									</table>
			
			                <div class="form-group">
			                </div>
			                
			                <div class="form-group">
			                </div>
			
									<table  cellspacing="0" class="eligibility">
										<thead>
											<tr>
												<th colspan="2">Additional Benefits</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<th class="spec" scope="row" width="234" valign="top">Family Discount</th>
												<td width="510" valign="top"><input type="text" class="form-control"  placeholder="" name="model[family_discount]" value="<?php echo array_key_exists( 'family_discount',$model) ? $model['family_discount'] : '';?>" ></td>
											</tr>
											<tr>
												<th class="specalt" scope="row" width="234" valign="top">Cumulative Bonus</th>
												<td width="510" valign="top"><input type="text" class="form-control"  placeholder="" name="model[cumulative_bonus]" value="<?php echo array_key_exists( 'cumulative_bonus',$model) ? $model['cumulative_bonus'] : '';?>" ></td>
											</tr>
											<tr>
												<th class="spec" scope="row" width="234" valign="top">Two Year Policy Option</th>
												<td width="510" valign="top"><input type="text" class="form-control"  placeholder="" name="model[two_year_policy_option]" value="<?php echo array_key_exists( 'two_year_policy_option',$model) ? $model['two_year_policy_option'] : '';?>" ></td>
											</tr>
											<tr>
												<th class="specalt" scope="row" width="234" valign="top">Co-payment</th>
												<td width="510" valign="top"><input type="text" class="form-control"  placeholder="" name="model[co_pay]" value="<?php echo array_key_exists( 'co_pay',$model) ? $model['co_pay'] : '';?>" ></td>
											</tr>
											<tr>
												<th class="spec" scope="row" width="234" valign="top">Cashless</th>
												<td width="510" valign="top">
													<?php 
														$str = array_key_exists( 'cashless_treatment',$model) ? $model['cashless_treatment'] : '';
														$values = reset(Util::getNumbersFromString($str));
													?>																	
									                <div class="row">
									                    <div class="col-sm-3">
									                        <input type="number" class="form-control col-sm-3 numberValidation" placeholder="" name="model[cashless_treatment][]" value="<?php echo isset($values[0]) ? $values[0] : '';?>">
									                    </div>
									                    <div class="col-sm-3"> 
									                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">hospitls across </label>
									                    </div>
									                    <div class="col-sm-3">
									                        <input type="number" class="form-control col-sm-3 numberValidation" placeholder="" name="model[cashless_treatment][]" value="<?php echo isset($values[1]) ? $values[1] : '';?>">
									                    </div>       
									                    <div class="col-sm-3"> 
									                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">cities </label>
									                    </div>                 
									                </div>		
												</td>
											</tr>
											<tr>
												<th class="specalt" scope="row" width="234" valign="top">Claim Loading</th>
												<td width="510" valign="top"><input type="text" class="form-control"  placeholder="" name="model[claim_loading]" value="<?php echo array_key_exists( 'claim_loading',$model) ? $model['claim_loading'] : '';?>" ></td>
											</tr>
										</tbody>
									</table>
			
					                <div class="form-group">
					                </div>
					                
					                <div class="form-group">
					                </div>
			                
			                
			                
									<table  cellspacing="0" class="eligibility">
										<thead>
											<tr>
												<th colspan="2">Major Exclusions</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<th class="specalt" scope="row" width="234" valign="top">Pre-existing diseases</th>
												<td width="510" valign="top">
													<?php 
														$str = array_key_exists( 'preexisting_diseases',$model) ? $model['preexisting_diseases'] : '';
														$values = reset(Util::getNumbersFromString($str));
													?>																	
									                <div class="row">
									                    <div class="col-sm-3">
									                        <input type="number" class="form-control col-sm-3 numberValidation" placeholder="" name="model[preexisting_diseases]" value="<?php echo isset($values) ? reset($values) : '';?>">
									                    </div>
									                    <div class="col-sm-3"> 
									                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;"><?php echo ((int)reset($values) > 1) ? ' years': 'year';?> </label>
									                    </div>              
									                </div>	
												</td>
											</tr>
											
											<tr>
												<th class="specalt" scope="row" width="234" valign="top">For the first 30 days</th>
												<td width="510" valign="top">
													<input type="text" class="form-control"  placeholder="" name="model[first_30_days]" value="<?php echo array_key_exists( 'first_30_days',$model) ? $model['first_30_days'] : '';?>" >
												</td>
											</tr>
											
											<tr>
												<th class="specalt" scope="row" width="234" valign="top">For the first 24 months</th>
												<td width="510" valign="top">
													<input type="text" class="form-control"  placeholder="" name="model[first_24_months]" value="<?php echo array_key_exists( 'first_24_months',$model) ? $model['first_24_months'] : '';?>" >
												</td>
											</tr>
											
											<tr>
												<th class="specalt" scope="row" width="234" valign="top">Dental treatment or surgery</th>
												<td width="510" valign="top">
													<input type="text" class="form-control"  placeholder="" name="model[dental_treatment_or_surgery]" value="<?php echo array_key_exists( 'dental_treatment_or_surgery',$model) ? $model['dental_treatment_or_surgery'] : '';?>" >
												</td>
											</tr>
											
											<tr>
												<th class="specalt" scope="row" width="234" valign="top">AIDS / HIV</th>
												<td width="510" valign="top">
													<input type="text" class="form-control"  placeholder="" name="model[aids_hiv]" value="<?php echo array_key_exists( 'aids_hiv',$model) ? $model['aids_hiv'] : '';?>" >
												</td>
											</tr>
											
											<tr>
												<th class="specalt" scope="row" width="234" valign="top">Cosmetic treatment</th>
												<td width="510" valign="top">
													<input type="text" class="form-control"  placeholder="" name="model[cosmetic_treatment]" value="<?php echo array_key_exists( 'cosmetic_treatment',$model) ? $model['cosmetic_treatment'] : '';?>" >
												</td>
											</tr>
											
										</tbody>
									</table>
			
			
			
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
				
	        <div class="row">
		        <div class="col-md-12">
		        	<div class="panel-body">    
			            <section class="panel panel-default">
			                <div class="panel-heading"><strong><span class="glyphicon glyphicon-th-list"></span> Peer Comparision</strong></div>
			                <div class="panel-body">
			                
			                <?php echo widget::run('peerComparisionBack', array('policy_id'=>$policyModel['policy_id'], 'peer_comparision_variants'=>$model['peer_comparision_variants'], 'allVariants'=>$allVariants)); ?>
			                
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
		if(curVal == 'lifelong' || curVal == 'no limit' )
			$(this).parent().parent().next().hide();
		else
			$(this).parent().parent().next().show();	
	});
});
//-->
</script>