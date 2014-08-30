
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
			                	<?php echo widget::run('eligibilityConditionsBack', array('model'=>$model, 'policyModel'=>$policyModel, 'type'=>'travel')); ?>
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
											<th class="spec" scope="row" width="234" valign="top"><strong>Emergency Medical Expenses (in USD)</strong></th>
											<td width="510" valign="top" colspan="2">
												<?php
													$default = array('amount'=>'',  'deductable'=>'', 'comments'=>'');
													$arrValues = array_key_exists( 'medical_expenses',$model) ? unserialize($model['medical_expenses']) : $default;
													$arrValues = Util::array_overlay($default, $arrValues);
								                ?>
								                    <div class="col-sm-12 row" >
														<div class="row" >						
											                <div class="col-sm-6">
											                    <div class="col-sm-6"> 
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Covered Upto</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control numberValidation" name="model[medical_expenses][amount]" value="<?php echo $arrValues['amount'];?>" >
											                    </div>              
											                </div>			
											                <div class="col-sm-6">
											                    <div class="col-sm-6"> 
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Deductable upto</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control numberValidation" name="model[medical_expenses][deductable]" value="<?php echo $arrValues['deductable'];?>" >
											                    </div>              
											                </div>	
											            </div>
											            
								                    </div>  
								                    <div class="form-group"></div>
									                <div class="col-sm-12 row">
									                    <div class="col-sm-2"> 
									                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Comments</label>
									                    </div>  
									                    <div class="col-sm-10">
									                        <input type="text" class="form-control" name="model[medical_expenses][comments]" placeholder ="Max 100 Char" maxlength="100" placeholder ="Max 100 Char" maxlength="100" value="<?php echo $arrValues['comments'];?>" >
									                    </div>              
									                </div>	 
											</td>
										</tr>
										
										
										<tr>
											<th class="spec" scope="row" width="234" valign="top"><strong>Sickness Dental Relief</strong></th>
											<td width="510" valign="top" colspan="2">
								                <div class="row">
												<?php
													$default = array('covered'=>'no', 'amount'=>'', 'deductable'=>'', 'comments'=>'');
													$arrValues = array_key_exists( 'dental',$model) ? unserialize($model['dental']) : $default;
													$arrValues = Util::array_overlay($default, $arrValues);
													$selected = $arrValues['covered'];
								                ?>
								                    <div class="col-sm-12"> 
									                    <?php 
															$options = array('yes'=>'Yes', 'no'=>'No');		
															foreach ($options as $k1=>$v1)
															{
																$op = array(
																    'class'       => 'showHideNextDivByRadio',
																    'name'        => 'model[dental][covered]',
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
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Covered Upto</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control numberValidation" name="model[dental][amount]" value="<?php echo $arrValues['amount'];?>" >
											                    </div>              
											                </div>			
											                <div class="col-sm-6">
											                    <div class="col-sm-6"> 
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Deductable Upto</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control numberValidation" name="model[dental][deductable]" value="<?php echo $arrValues['deductable'];?>" >
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
										                   		<input type="text" class="form-control"  name="model[dental][comments]" placeholder ="Max 100 Char" maxlength="100" placeholder ="Max 100 Char" maxlength="100" value="<?php echo $arrValues['comments'];?>" >
										                    </div>            
										                </div>	
									                </div>
								                </div>
											</td>
										</tr>
										
										
										
										<tr>
											<th class="spec" scope="row" width="234" valign="top"><strong>Emergency Medical Evacuation</strong></th>
											<td width="510" valign="top" colspan="2">
								                <div class="row">
												<?php
													$default = array('covered'=>'no', 'amount'=>'', 'deductable'=>'', 'comments'=>'');
													$arrValues = !empty($model['emergency_medical_evacuation']) ? unserialize($model['emergency_medical_evacuation']) : $default;
													$arrValues = Util::array_overlay($default, $arrValues);
													$selected = $arrValues['covered'];
								                ?>
								                    <div class="col-sm-12"> 
									                    <?php 
															$options = array('yes'=>'Yes', 'no'=>'No');		
															foreach ($options as $k1=>$v1)
															{
																$op = array(
																    'class'       => 'showHideNextDivByRadio',
																    'name'        => 'model[emergency_medical_evacuation][covered]',
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
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Covered Upto</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control numberValidation" name="model[emergency_medical_evacuation][amount]" value="<?php echo $arrValues['amount'];?>" >
											                    </div>              
											                </div>			
											                <div class="col-sm-6">
											                    <div class="col-sm-6"> 
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Deductable Upto</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control numberValidation" name="model[emergency_medical_evacuation][deductable]" value="<?php echo $arrValues['deductable'];?>" >
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
										                   		<input type="text" class="form-control"  name="model[emergency_medical_evacuation][comments]" placeholder ="Max 100 Char" maxlength="100" placeholder ="Max 100 Char" maxlength="100" value="<?php echo $arrValues['comments'];?>" >
										                    </div>            
										                </div>	
									                </div>
								                </div>
											</td>
										</tr>
										
										
										<tr>
											<th class="spec" scope="row" width="234" valign="top"><strong>Repatriation of Remains</strong></th>
											<td width="510" valign="top" colspan="2">
								                <div class="row">
												<?php
													$default = array('covered'=>'no', 'amount'=>'', 'deductable'=>'', 'comments'=>'');
													$arrValues = !empty($model['repatriation_of_mortal_remains']) ? unserialize($model['repatriation_of_mortal_remains']) : $default;
													$arrValues = Util::array_overlay($default, $arrValues);
													$selected = $arrValues['covered'];
								                ?>
								                    <div class="col-sm-12"> 
									                    <?php 
															$options = array('yes'=>'Yes', 'no'=>'No');		
															foreach ($options as $k1=>$v1)
															{
																$op = array(
																    'class'       => 'showHideNextDivByRadio',
																    'name'        => 'model[repatriation_of_mortal_remains][covered]',
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
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Covered Upto</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control numberValidation" name="model[repatriation_of_mortal_remains][amount]" value="<?php echo $arrValues['amount'];?>" >
											                    </div>              
											                </div>			
											                <div class="col-sm-6">
											                    <div class="col-sm-6"> 
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Deductable Upto</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control numberValidation" name="model[repatriation_of_mortal_remains][deductable]" value="<?php echo $arrValues['deductable'];?>" >
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
										                   		<input type="text" class="form-control"  name="model[repatriation_of_mortal_remains][comments]" placeholder ="Max 100 Char" maxlength="100" value="<?php echo $arrValues['comments'];?>" >
										                    </div>            
										                </div>	
									                </div>
								                </div>
											</td>
										</tr>
										
										
										<tr>
											<th class="spec" scope="row" width="234" valign="top"><strong>Baggage Loss</strong></th>
											<td width="510" valign="top" colspan="2">
								                <div class="row">
												<?php
													$default = array('covered'=>'no', 'amount'=>'', 'deductable'=>'', 'comments'=>'');
													$arrValues = !empty($model['total_loss_of_checked_baggage']) ? unserialize($model['total_loss_of_checked_baggage']) : $default;
													$arrValues = Util::array_overlay($default, $arrValues);
													$selected = $arrValues['covered'];
								                ?>
								                    <div class="col-sm-12"> 
									                    <?php 
															$options = array('yes'=>'Yes', 'no'=>'No');		
															foreach ($options as $k1=>$v1)
															{
																$op = array(
																    'class'       => 'showHideNextDivByRadio',
																    'name'        => 'model[total_loss_of_checked_baggage][covered]',
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
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Covered Upto</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control numberValidation" name="model[total_loss_of_checked_baggage][amount]" value="<?php echo $arrValues['amount'];?>" >
											                    </div>              
											                </div>			
											                <div class="col-sm-6">
											                    <div class="col-sm-5"> 
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Deductable Upto</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control numberValidation" name="model[total_loss_of_checked_baggage][deductable]" value="<?php echo $arrValues['deductable'];?>" >
											                    </div>     
											                    <div class="col-sm-1"> 
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">%</label>
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
										                   		<input type="text" class="form-control"  name="model[total_loss_of_checked_baggage][comments]" placeholder ="Max 100 Char" maxlength="100" value="<?php echo $arrValues['comments'];?>" >
										                    </div>            
										                </div>	
									                </div>
								                </div>
											</td>
										</tr>
										
										
										<tr>
											<th class="spec" scope="row" width="234" valign="top"><strong>Baggage Delay</strong></th>
											<td width="510" valign="top" colspan="2">
								                <div class="row">
												<?php
													$default = array('covered'=>'no', 'covered_after'=>'', 'amount'=>'', 'deductable'=>'', 'comments'=>'');
													$arrValues = !empty($model['delay_of_checked_baggage']) ? unserialize($model['delay_of_checked_baggage']) : $default;
													$arrValues = Util::array_overlay($default, $arrValues);
													$selected = $arrValues['covered'];
								                ?>
								                    <div class="col-sm-12"> 
									                    <?php 
															$options = array('yes'=>'Yes', 'no'=>'No');		
															foreach ($options as $k1=>$v1)
															{
																$op = array(
																    'class'       => 'showHideNextDivByRadio',
																    'name'        => 'model[delay_of_checked_baggage][covered]',
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
											                    <div class="col-sm-7"> 
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Covered upto delay of</label>
											                    </div>  
											                    <div class="col-sm-3" style="padding-left: 0px; border-right-width: 0px; padding-right: 0px; left: -16px; width: 74px;">
											                        <input type="text" class="form-control numberValidation" name="model[delay_of_checked_baggage][covered_after]" value="<?php echo $arrValues['covered_after'];?>" >
											                    </div>    
											                    <div class="col-sm-2"> 
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Hrs</label>
											                    </div>            
											                </div>				
											                <div class="col-sm-6">
											                    <div class="col-sm-6"> 
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Covered Upto</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control numberValidation" placeholder="Amount" name="model[delay_of_checked_baggage][amount]" value="<?php echo $arrValues['amount'];?>" >
											                    </div>              
											                </div>		
											                <br clear="all">	
											                <div class="divider"></div> 
											                <div class="col-sm-6">
											                    <div class="col-sm-4"> 
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Deductable Upto</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control numberValidation" name="model[delay_of_checked_baggage][deductable]" value="<?php echo $arrValues['deductable'];?>" >
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
										                   		<input type="text" class="form-control"  name="model[delay_of_checked_baggage][comments]" placeholder ="Max 100 Char" maxlength="100" value="<?php echo $arrValues['comments'];?>" >
										                    </div>            
										                </div>	
									                </div>
								                </div>
											</td>
										</tr>
										
										
										<tr>
											<th class="spec" scope="row" width="234" valign="top"><strong>Loss of Passport</strong></th>
											<td width="510" valign="top" colspan="2">
								                <div class="row">
												<?php
													$default = array('covered'=>'no', 'amount'=>'', 'deductable'=>'', 'comments'=>'');
													$arrValues = !empty($model['loss_of_passport']) ? unserialize($model['loss_of_passport']) : $default;
													$arrValues = Util::array_overlay($default, $arrValues);
													$selected = $arrValues['covered'];
								                ?>
								                    <div class="col-sm-12"> 
									                    <?php 
															$options = array('yes'=>'Yes', 'no'=>'No');		
															foreach ($options as $k1=>$v1)
															{
																$op = array(
																    'class'       => 'showHideNextDivByRadio',
																    'name'        => 'model[loss_of_passport][covered]',
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
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Covered Upto</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control numberValidation" name="model[loss_of_passport][amount]" value="<?php echo $arrValues['amount'];?>" >
											                    </div>              
											                </div>			
											                <div class="col-sm-6">
											                    <div class="col-sm-6"> 
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Deductable Upto</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control numberValidation" name="model[loss_of_passport][deductable]" value="<?php echo $arrValues['deductable'];?>" >
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
										                   		<input type="text" class="form-control"  name="model[loss_of_passport][comments]" placeholder ="Max 100 Char" maxlength="100" value="<?php echo $arrValues['comments'];?>" >
										                    </div>            
										                </div>	
									                </div>
								                </div>
											</td>
										</tr>
										
										
										<tr>
											<th class="spec" scope="row" width="234" valign="top"><strong>Loss of Visa</strong></th>
											<td width="510" valign="top" colspan="2">
								                <div class="row">
												<?php
													$default = array('covered'=>'no', 'amount'=>'', 'deductable'=>'', 'comments'=>'');
													$arrValues = !empty($model['loss_of_visa']) ? unserialize($model['loss_of_visa']) : $default;
													$arrValues = Util::array_overlay($default, $arrValues);
													$selected = $arrValues['covered'];
								                ?>
								                    <div class="col-sm-12"> 
									                    <?php 
															$options = array('yes'=>'Yes', 'no'=>'No');		
															foreach ($options as $k1=>$v1)
															{
																$op = array(
																    'class'       => 'showHideNextDivByRadio',
																    'name'        => 'model[loss_of_visa][covered]',
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
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Covered Upto</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control numberValidation" name="model[loss_of_visa][amount]" value="<?php echo $arrValues['amount'];?>" >
											                    </div>              
											                </div>			
											                <div class="col-sm-6">
											                    <div class="col-sm-6"> 
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Deductable Upto</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control numberValidation" name="model[loss_of_visa][deductable]" value="<?php echo $arrValues['deductable'];?>" >
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
										                   		<input type="text" class="form-control"  name="model[loss_of_visa][comments]" placeholder ="Max 100 Char" maxlength="100" value="<?php echo $arrValues['comments'];?>" >
										                    </div>            
										                </div>	
									                </div>
								                </div>
											</td>
										</tr>
										
										
										
										<tr>
											<th class="spec" scope="row" width="234" valign="top"><strong>Personal Liability</strong></th>
											<td width="510" valign="top" colspan="2">
								                <div class="row">
												<?php
													$default = array('covered'=>'no', 'amount'=>'', 'deductable'=>'', 'comments'=>'');
													$arrValues = !empty($model['personal_liability']) ? unserialize($model['personal_liability']) : $default;
													$arrValues = Util::array_overlay($default, $arrValues);
													$selected = $arrValues['covered'];
								                ?>
								                    <div class="col-sm-12"> 
									                    <?php 
															$options = array('yes'=>'Yes', 'no'=>'No');		
															foreach ($options as $k1=>$v1)
															{
																$op = array(
																    'class'       => 'showHideNextDivByRadio',
																    'name'        => 'model[personal_liability][covered]',
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
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Covered Upto</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control numberValidation" name="model[personal_liability][amount]" value="<?php echo $arrValues['amount'];?>" >
											                    </div>              
											                </div>			
											                <div class="col-sm-6">
											                    <div class="col-sm-6"> 
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Deductable Upto</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control numberValidation" name="model[personal_liability][deductable]" value="<?php echo $arrValues['deductable'];?>" >
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
										                   		<input type="text" class="form-control"  name="model[personal_liability][comments]" placeholder ="Max 100 Char" maxlength="100" value="<?php echo $arrValues['comments'];?>" >
										                    </div>            
										                </div>	
									                </div>
								                </div>
											</td>
										</tr>
										
										
										<tr>
											<th class="spec" scope="row" width="234" valign="top"><strong>Trip Cancellation</strong></th>
											<td width="510" valign="top" colspan="2">
								                <div class="row">
												<?php
													$default = array('covered'=>'no', 'amount'=>'', 'deductable'=>'', 'comments'=>'');
													$arrValues = !empty($model['trip_cancellation']) ? unserialize($model['trip_cancellation']) : $default;
													$arrValues = Util::array_overlay($default, $arrValues);
													$selected = $arrValues['covered'];
								                ?>
								                    <div class="col-sm-12"> 
									                    <?php 
															$options = array('yes'=>'Yes', 'no'=>'No');		
															foreach ($options as $k1=>$v1)
															{
																$op = array(
																    'class'       => 'showHideNextDivByRadio',
																    'name'        => 'model[trip_cancellation][covered]',
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
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Covered Upto</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control numberValidation" name="model[trip_cancellation][amount]" value="<?php echo $arrValues['amount'];?>" >
											                    </div>              
											                </div>			
											                <div class="col-sm-6">
											                    <div class="col-sm-6"> 
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Deductable Upto</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control numberValidation" name="model[trip_cancellation][deductable]" value="<?php echo $arrValues['deductable'];?>" >
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
										                   		<input type="text" class="form-control"  name="model[trip_cancellation][comments]" placeholder ="Max 100 Char" maxlength="100" value="<?php echo $arrValues['comments'];?>" >
										                    </div>            
										                </div>	
									                </div>
								                </div>
											</td>
										</tr>
										
										
										<tr>
											<th class="spec" scope="row" width="234" valign="top"><strong>Trip Curtailment</strong></th>
											<td width="510" valign="top" colspan="2">
								                <div class="row">
												<?php
													$default = array('covered'=>'no', 'amount'=>'', 'deductable'=>'', 'comments'=>'');
													$arrValues = !empty($model['trip_curtailment']) ? unserialize($model['trip_curtailment']) : $default;
													$arrValues = Util::array_overlay($default, $arrValues);
													$selected = $arrValues['covered'];
								                ?>
								                    <div class="col-sm-12"> 
									                    <?php 
															$options = array('yes'=>'Yes', 'no'=>'No');		
															foreach ($options as $k1=>$v1)
															{
																$op = array(
																    'class'       => 'showHideNextDivByRadio',
																    'name'        => 'model[trip_curtailment][covered]',
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
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Covered Upto</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control numberValidation" name="model[trip_curtailment][amount]" value="<?php echo $arrValues['amount'];?>" >
											                    </div>              
											                </div>			
											                <div class="col-sm-6">
											                    <div class="col-sm-6"> 
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Deductable Upto</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control numberValidation" name="model[trip_curtailment][deductable]" value="<?php echo $arrValues['deductable'];?>" >
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
										                   		<input type="text" class="form-control"  name="model[trip_curtailment][comments]" placeholder ="Max 100 Char" maxlength="100" value="<?php echo $arrValues['comments'];?>" >
										                    </div>            
										                </div>	
									                </div>
								                </div>
											</td>
										</tr>
										
										
										<tr>
											<th class="spec" scope="row" width="234" valign="top"><strong>Trip Interruption</strong></th>
											<td width="510" valign="top" colspan="2">
								                <div class="row">
												<?php
													$default = array('covered'=>'no', 'amount'=>'', 'deductable'=>'', 'comments'=>'');
													$arrValues = !empty($model['trip_interruption']) ? unserialize($model['trip_interruption']) : $default;
													$arrValues = Util::array_overlay($default, $arrValues);
													$selected = $arrValues['covered'];
								                ?>
								                    <div class="col-sm-12"> 
									                    <?php 
															$options = array('yes'=>'Yes', 'no'=>'No');		
															foreach ($options as $k1=>$v1)
															{
																$op = array(
																    'class'       => 'showHideNextDivByRadio',
																    'name'        => 'model[trip_interruption][covered]',
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
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Covered Upto</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control numberValidation" name="model[trip_interruption][amount]" value="<?php echo $arrValues['amount'];?>" >
											                    </div>              
											                </div>			
											                <div class="col-sm-6">
											                    <div class="col-sm-6"> 
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Deductable Upto</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control numberValidation" name="model[trip_interruption][deductable]" value="<?php echo $arrValues['deductable'];?>" >
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
										                   		<input type="text" class="form-control"  name="model[trip_interruption][comments]" placeholder ="Max 100 Char" maxlength="100" value="<?php echo $arrValues['comments'];?>" >
										                    </div>            
										                </div>	
									                </div>
								                </div>
											</td>
										</tr>
										
										
										<tr>
											<th class="spec" scope="row" width="234" valign="top"><strong>Hospital Daily Cash</strong></th>
											<td width="510" valign="top" colspan="2">
								                <div class="row">
												<?php
													$default = array('covered'=>'no', 'amount'=>'', 'days'=>'', 'comments'=>'');
													$arrValues = !empty($model['hospital_daily_cash']) ? unserialize($model['hospital_daily_cash']) : $default;
													$arrValues = Util::array_overlay($default, $arrValues);
													$selected = $arrValues['covered'];
								                ?>
								                    <div class="col-sm-12"> 
									                    <?php 
															$options = array('yes'=>'Yes', 'no'=>'No');		
															foreach ($options as $k1=>$v1)
															{
																$op = array(
																    'class'       => 'showHideNextDivByRadio',
																    'name'        => 'model[hospital_daily_cash][covered]',
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
											                    <div class="col-sm-4"> 
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Covered Upto</label>
											                    </div>  
											                    <div class="col-sm-5">
											                        <input type="text" class="form-control numberValidation" name="model[hospital_daily_cash][amount]" value="<?php echo $arrValues['amount'];?>" >
											                    </div>    
											                   <div class="col-sm-3"> 
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Per Day</label>
											                    </div>              
											                </div>			
											                <div class="col-sm-6">
											                    <div class="col-sm-4"> 
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Upto</label>
											                    </div>  
											                    <div class="col-sm-5">
											                        <input type="text" class="form-control numberValidation" name="model[hospital_daily_cash][days]" value="<?php echo $arrValues['days'];?>" >
											                    </div>    
											                    <div class="col-sm-3"> 
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Days</label>
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
										                   		<input type="text" class="form-control"  name="model[hospital_daily_cash][comments]" placeholder ="Max 100 Char" maxlength="100" value="<?php echo $arrValues['comments'];?>" >
										                    </div>            
										                </div>	
									                </div>
								                </div>
											</td>
										</tr>
										
										
										<tr>
											<th class="spec" scope="row" width="234" valign="top"><strong>Personal Accident</strong></th>
											<td width="510" valign="top" colspan="2">
								                <div class="row">
												<?php
													$default = array('covered'=>'no', 'amount'=>'', 'deductable'=>'', 'comments'=>'');
													$arrValues = !empty($model['personal_accident']) ? unserialize($model['personal_accident']) : $default;
													$arrValues = Util::array_overlay($default, $arrValues);
													$selected = $arrValues['covered'];
								                ?>
								                    <div class="col-sm-12"> 
									                    <?php 
															$options = array('yes'=>'Yes', 'no'=>'No');		
															foreach ($options as $k1=>$v1)
															{
																$op = array(
																    'class'       => 'showHideNextDivByRadio',
																    'name'        => 'model[personal_accident][covered]',
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
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Covered Upto</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control numberValidation" name="model[personal_accident][amount]" value="<?php echo $arrValues['amount'];?>" >
											                    </div>              
											                </div>			
											                <div class="col-sm-6">
											                    <div class="col-sm-6"> 
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Deductable Upto</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control numberValidation" name="model[personal_accident][deductable]" value="<?php echo $arrValues['deductable'];?>" >
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
										                   		<input type="text" class="form-control"  name="model[personal_accident][comments]" placeholder ="Max 100 Char" maxlength="100" value="<?php echo $arrValues['comments'];?>" >
										                    </div>            
										                </div>	
									                </div>
								                </div>
											</td>
										</tr>
										
										
										
										<tr>
											<th class="spec" scope="row" width="234" valign="top"><strong>Personal Accident (Common Carrier)</strong></th>
											<td width="510" valign="top" colspan="2">
								                <div class="row">
												<?php
													$default = array('covered'=>'no', 'amount'=>'', 'deductable'=>'', 'comments'=>'');
													$arrValues = !empty($model['personal_accident_common_carrier']) ? unserialize($model['personal_accident_common_carrier']) : $default;
													$arrValues = Util::array_overlay($default, $arrValues);
													$selected = $arrValues['covered'];
								                ?>
								                    <div class="col-sm-12"> 
									                    <?php 
															$options = array('yes'=>'Yes', 'no'=>'No');		
															foreach ($options as $k1=>$v1)
															{
																$op = array(
																    'class'       => 'showHideNextDivByRadio',
																    'name'        => 'model[personal_accident_common_carrier][covered]',
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
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Covered Upto</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control numberValidation" name="model[personal_accident_common_carrier][amount]" value="<?php echo $arrValues['amount'];?>" >
											                    </div>              
											                </div>			
											                <div class="col-sm-6">
											                    <div class="col-sm-6"> 
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Deductable Upto</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control numberValidation" name="model[personal_accident_common_carrier][deductable]" value="<?php echo $arrValues['deductable'];?>" >
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
										                   		<input type="text" class="form-control"  name="model[personal_accident_common_carrier][comments]" placeholder ="Max 100 Char" maxlength="100" value="<?php echo $arrValues['comments'];?>" >
										                    </div>            
										                </div>	
									                </div>
								                </div>
											</td>
										</tr>
										
										
										
										<tr>
											<th class="spec" scope="row" width="234" valign="top"><strong>Personal Accident ( Domestic)</strong></th>
											<td width="510" valign="top" colspan="2">
								                <div class="row">
												<?php
													$default = array('covered'=>'no', 'amount'=>'', 'deductable'=>'', 'comments'=>'');
													$arrValues = !empty($model['personal_accident_domestic']) ? unserialize($model['personal_accident_domestic']) : $default;
													$arrValues = Util::array_overlay($default, $arrValues);
													$selected = $arrValues['covered'];
								                ?>
								                    <div class="col-sm-12"> 
									                    <?php 
															$options = array('yes'=>'Yes', 'no'=>'No');		
															foreach ($options as $k1=>$v1)
															{
																$op = array(
																    'class'       => 'showHideNextDivByRadio',
																    'name'        => 'model[personal_accident_domestic][covered]',
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
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Covered Upto</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control numberValidation" name="model[personal_accident_domestic][amount]" value="<?php echo $arrValues['amount'];?>" >
											                    </div>              
											                </div>			
											                <div class="col-sm-6">
											                    <div class="col-sm-6"> 
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Deductable Upto</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control numberValidation" name="model[personal_accident_domestic][deductable]" value="<?php echo $arrValues['deductable'];?>" >
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
										                   		<input type="text" class="form-control"  name="model[personal_accident_domestic][comments]" placeholder ="Max 100 Char" maxlength="100" value="<?php echo $arrValues['comments'];?>" >
										                    </div>            
										                </div>	
									                </div>
								                </div>
											</td>
										</tr>
										
										
										
										<tr>
											<th class="spec" scope="row" width="234" valign="top"><strong>Accidental Death and Dismemberment (24 hrs)</strong></th>
											<td width="510" valign="top" colspan="2">
								                <div class="row">
												<?php
													$default = array('covered'=>'no', 'amount'=>'', 'deductable'=>'', 'comments'=>'');
													$arrValues = !empty($model['personal_accident']) ? unserialize($model['accidental_death_and_dismemberment']) : $default;
													$arrValues = Util::array_overlay($default, $arrValues);
													$selected = $arrValues['covered'];
								                ?>
								                    <div class="col-sm-12"> 
									                    <?php 
															$options = array('yes'=>'Yes', 'no'=>'No');		
															foreach ($options as $k1=>$v1)
															{
																$op = array(
																    'class'       => 'showHideNextDivByRadio',
																    'name'        => 'model[accidental_death_and_dismemberment][covered]',
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
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Covered Upto</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control numberValidation" name="model[accidental_death_and_dismemberment][amount]" value="<?php echo $arrValues['amount'];?>" >
											                    </div>              
											                </div>			
											                <div class="col-sm-6">
											                    <div class="col-sm-6"> 
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Deductable Upto</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control numberValidation" name="model[accidental_death_and_dismemberment][deductable]" value="<?php echo $arrValues['deductable'];?>" >
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
										                   		<input type="text" class="form-control"  name="model[accidental_death_and_dismemberment][comments]" placeholder ="Max 100 Char" maxlength="100" value="<?php echo $arrValues['comments'];?>" >
										                    </div>            
										                </div>	
									                </div>
								                </div>
											</td>
										</tr>
										
										
										
										<tr>
											<th class="spec" scope="row" width="234" valign="top"><strong>Accidental Death and Dismemberment (Common Carrier)</strong></th>
											<td width="510" valign="top" colspan="2">
								                <div class="row">
												<?php
													$default = array('covered'=>'no', 'amount'=>'', 'deductable'=>'', 'comments'=>'');
													$arrValues = !empty($model['accidental_death_and_dismemberment_common_carrier']) ? unserialize($model['accidental_death_and_dismemberment_common_carrier']) : $default;
													$arrValues = Util::array_overlay($default, $arrValues);
													$selected = $arrValues['covered'];
								                ?>
								                    <div class="col-sm-12"> 
									                    <?php 
															$options = array('yes'=>'Yes', 'no'=>'No');		
															foreach ($options as $k1=>$v1)
															{
																$op = array(
																    'class'       => 'showHideNextDivByRadio',
																    'name'        => 'model[accidental_death_and_dismemberment_common_carrier][covered]',
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
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Covered Upto</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control numberValidation" name="model[accidental_death_and_dismemberment_common_carrier][amount]" value="<?php echo $arrValues['amount'];?>" >
											                    </div>              
											                </div>			
											                <div class="col-sm-6">
											                    <div class="col-sm-6"> 
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Deductable Upto</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control numberValidation" name="model[accidental_death_and_dismemberment_common_carrier][deductable]" value="<?php echo $arrValues['deductable'];?>" >
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
										                   		<input type="text" class="form-control"  name="model[accidental_death_and_dismemberment_common_carrier][comments]" placeholder ="Max 100 Char" maxlength="100" value="<?php echo $arrValues['comments'];?>" >
										                    </div>            
										                </div>	
									                </div>
								                </div>
											</td>
										</tr>
										
										
										<tr>
											<th class="spec" scope="row" width="234" valign="top"><strong>Accident and Sickness Medical Expenses Reimbursement</strong></th>
											<td width="510" valign="top" colspan="2">
								                <div class="row">
												<?php
													$default = array('covered'=>'no', 'amount'=>'', 'deductable'=>'', 'comments'=>'');
													$arrValues = !empty($model['accident_sickness_medical_expenses_reimbursement']) ? unserialize($model['accident_sickness_medical_expenses_reimbursement']) : $default;
													$arrValues = Util::array_overlay($default, $arrValues);
													$selected = $arrValues['covered'];
								                ?>
								                    <div class="col-sm-12"> 
									                    <?php 
															$options = array('yes'=>'Yes', 'no'=>'No');		
															foreach ($options as $k1=>$v1)
															{
																$op = array(
																    'class'       => 'showHideNextDivByRadio',
																    'name'        => 'model[accident_sickness_medical_expenses_reimbursement][covered]',
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
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Covered Upto</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control numberValidation" name="model[accident_sickness_medical_expenses_reimbursement][amount]" value="<?php echo $arrValues['amount'];?>" >
											                    </div>              
											                </div>			
											                <div class="col-sm-6">
											                    <div class="col-sm-6"> 
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Deductable Upto</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control numberValidation" name="model[accident_sickness_medical_expenses_reimbursement][deductable]" value="<?php echo $arrValues['deductable'];?>" >
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
										                   		<input type="text" class="form-control"  name="model[accident_sickness_medical_expenses_reimbursement][comments]" placeholder ="Max 100 Char" maxlength="100" value="<?php echo $arrValues['comments'];?>" >
										                    </div>            
										                </div>	
									                </div>
								                </div>
											</td>
										</tr>
										
										
										<tr>
											<th class="spec" scope="row" width="234" valign="top"><strong>Accidental Death air travel only</strong></th>
											<td width="510" valign="top" colspan="2">
								                <div class="row">
												<?php
													$default = array('covered'=>'no', 'amount'=>'', 'deductable'=>'', 'comments'=>'');
													$arrValues = !empty($model['accidental_death_air_travel']) ? unserialize($model['accidental_death_air_travel']) : $default;
													$arrValues = Util::array_overlay($default, $arrValues);
													$selected = $arrValues['covered'];
								                ?>
								                    <div class="col-sm-12"> 
									                    <?php 
															$options = array('yes'=>'Yes', 'no'=>'No');		
															foreach ($options as $k1=>$v1)
															{
																$op = array(
																    'class'       => 'showHideNextDivByRadio',
																    'name'        => 'model[accidental_death_air_travel][covered]',
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
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Covered Upto</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control numberValidation" name="model[accidental_death_air_travel][amount]" value="<?php echo $arrValues['amount'];?>" >
											                    </div>              
											                </div>			
											                <div class="col-sm-6">
											                    <div class="col-sm-6"> 
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Deductable Upto</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control numberValidation" name="model[accidental_death_air_travel][deductable]" value="<?php echo $arrValues['deductable'];?>" >
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
										                   		<input type="text" class="form-control"  name="model[accidental_death_air_travel][comments]" placeholder ="Max 100 Char" maxlength="100" value="<?php echo $arrValues['comments'];?>" >
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
			                <div class="panel-heading"><strong><span class="glyphicon glyphicon-th-list"></span> Other Benefits</strong></div>
			                <div class="panel-body">
			                
								<table cellspacing="0" class="eligibility">
									<tbody>
										<tr>
											<th class="nobg" abbr="Configurations" scope="col">&nbsp;</th>
											<th scope="col">Minimum</th>
											<th scope="col">Maximum</th>
										</tr>
									
										<tr>
											<th class="specalt" scope="row" width="234" valign="top">Cashless Treatment</th>
											<td width="510" valign="top" colspan="2">
											
								                <div class="row">
												<?php
													$default = array('covered'=>'no',  'comments'=>'');
													$arrValues = array_key_exists( 'cashless_treatment',$model) ? unserialize($model['cashless_treatment']) : $default;
													$arrValues = Util::array_overlay($default, $arrValues);
													$selected = $arrValues['covered'];
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
										                   		<input type="text" class="form-control" maxlength="120" placeholder="Max 127 Chars" name="model[cashless_treatment][comments]" placeholder ="Max 100 Char" maxlength="100" value="<?php echo $arrValues['comments'];?>" >
										                    </div>            
										                </div>	
									                </div>
								                </div>	
											</td>
										</tr>
										
										<tr>
											<th class="spec" scope="row" width="234" valign="top"><strong>No Medical Sum Assured limit</strong></th>
											<td width="510" valign="top" colspan="2">
								                <div class="row">
												<?php
													$default = array('covered'=>'no', 'per_illness'=>'', 'per_accident'=>'', 'max'=>'', 'comments'=>'');
													$arrValues = array_key_exists( 'no_medical_sum_assured_limit',$model) ? unserialize($model['no_medical_sum_assured_limit']) : $default;
													$arrValues = Util::array_overlay($default, $arrValues);
													$selected = $arrValues['covered'];
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
											                        <input type="text" class="form-control" name="model[no_medical_sum_assured_limit][per_illness]" value="<?php echo $arrValues['per_illness'];?>" >
											                    </div>              
											                </div>			
											                <div class="col-sm-4">
											                    <div class="col-sm-6"> 
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Per Accident</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control" name="model[no_medical_sum_assured_limit][per_accident]" value="<?php echo $arrValues['per_accident'];?>" >
											                    </div>              
											                </div>	
											                <div class="col-sm-4">
											                    <div class="col-sm-6"> 
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Max Amount</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control" name="model[no_medical_sum_assured_limit][max]" value="<?php echo $arrValues['max'];?>" >
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
										                   		<input type="text" class="form-control"  name="model[no_medical_sum_assured_limit][comments]" placeholder ="Max 100 Char" maxlength="100" value="<?php echo $arrValues['comments'];?>" >
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
													$default = array('covered'=>'no', 'comments'=>'');
													$arrValues = array_key_exists( 'pre_existing_diseases',$model) ? unserialize($model['pre_existing_diseases']) : $default;
													$arrValues = Util::array_overlay($default, $arrValues);
													$selected = $arrValues['covered'];
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
										                   		<input type="text" class="form-control" maxlength="120" placeholder="Max 127 Chars" name="model[pre_existing_diseases][comments]" placeholder ="Max 100 Char" maxlength="100" value="<?php echo $arrValues['comments'];?>" >
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
													$default = array('covered'=>'no', 'days'=>'', 'trip_type'=>'', 'comments'=>'');
													$arrValues = array_key_exists( 'free_look_period',$model) ? unserialize($model['free_look_period']) : $default;
													$arrValues = Util::array_overlay($default, $arrValues);
													$selected = $arrValues['covered'];
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
											                        <input type="text" class="form-control" name="model[free_look_period][days]" value="<?php echo $arrValues['days'];?>" >
											                    </div>              
											                </div>			
											                <div class="col-sm-8">
											                    
									                    <?php 
															$selected = $arrValues['trip_type'];
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
										                   		<input type="text" class="form-control"  name="model[free_look_period][comments]" placeholder ="Max 100 Char" maxlength="100" value="<?php echo $arrValues['comments'];?>" >
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
													$default = array('covered'=>'no', 'days'=>'', 'trip_type'=>'', 'comments'=>'');
													$arrValues = array_key_exists( 'grace_period',$model) ? unserialize($model['grace_period']) : $default;
													$arrValues = Util::array_overlay($default, $arrValues);
													$selected = $arrValues['covered'];
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
											                        <input type="text" class="form-control" name="model[grace_period][days]" value="<?php echo $arrValues['days'];?>" >
											                    </div>              
											                </div>			
											                <div class="col-sm-8">
											                    
									                    <?php 
															$selected = $arrValues['trip_type'];
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
										                   		<input type="text" class="form-control"  name="model[grace_period][comments]" placeholder ="Max 100 Char" maxlength="100" value="<?php echo $arrValues['comments'];?>" >
										                    </div>            
										                </div>	
									                </div>
								                </div>
											</td>
										</tr>
										
										<tr>
											<th class="spec" scope="row" width="234" valign="top"><strong>Worldwide Coverage</strong></th>
											<td width="510" valign="top" colspan="2">
							                    <?php 
							                    	$selected = array_key_exists( 'worldwide_coverage',$model) ? $model['worldwide_coverage'] : '';
													$options = array('yes'=>'Yes', 'no'=>'No');		
													foreach ($options as $k1=>$v1)
													{
														$op = array(
														    'name'        => 'model[worldwide_coverage]',
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
											<th class="spec" scope="row" width="234" valign="top">Cumulative Bonus </th>
											<td width="510" valign="top" colspan="2">
											
								                <div class="row">
												<?php
													$default = array('covered'=>'no', 'comments'=>'');
													$arrValues = array_key_exists( 'cumulative_bonus',$model) ? unserialize($model['cumulative_bonus']) : $default;
													$arrValues = Util::array_overlay($default, $arrValues);
													$selected = $arrValues['covered'];
								                ?>
								                    <div class="col-sm-12"> 
									                    <?php 
															$options = array('yes'=>'Covered', 'no'=>'Not Covered');		
															foreach ($options as $k1=>$v1)
															{
																$op = array(
																    'name'        => 'model[cumulative_bonus][covered]',
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
										                   		<input type="text" class="form-control" name="model[cumulative_bonus][comments]" placeholder ="Max 100 Char" maxlength="100" value="<?php echo $arrValues['comments'];?>" >
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
			                <div class="panel-heading"><strong><span class="glyphicon glyphicon-th-list"></span> Other Benefits</strong></div>
			                <div class="panel-body">
			                
								<table cellspacing="0" class="eligibility">
									<tbody>
										<tr>
											<th class="nobg" abbr="Configurations" scope="col">&nbsp;</th>
											<th scope="col">Minimum</th>
											<th scope="col">Maximum</th>
										</tr>

										<tr>
											<th class="spec" scope="row" width="234" valign="top"><strong>Flight Delay</strong></th>
											<td width="510" valign="top" colspan="2">
												<div class="row">
												<?php
													$default = array('covered'=>'no', 'amount'=>'','per_hour'=>'', 'deductable'=>'', 'covered_after'=>'', 'comments'=>'');
													$arrValues = array_key_exists( 'flight_delay',$model) ? unserialize($model['flight_delay']) : $default;
													$arrValues = Util::array_overlay($default, $arrValues);
													$selected = $arrValues['covered'];
								                ?>
								                    <div class="col-sm-12"> 
									                    <?php 
															$options = array('yes'=>'Yes', 'no'=>'No');		
															foreach ($options as $k1=>$v1)
															{
																$op = array(
																    'class'       => 'showHideNextDivByRadio',
																    'name'        => 'model[flight_delay][covered]',
																    'value'       => $k1,
																    'checked'     => ($selected == $k1) ? TRUE : FALSE,
																    'style'       => 'margin:10px',
																    );
																echo '<label class="ui-radio">'.form_radio($op).'<span>'.$v1.'</span></label>';
															}
														?>
								                    </div> 
								                    <div class="col-sm-12 row" style="display:<?php echo ($selected != 'no') ? 'block':'none';?>">
														<div class="row" >						
											                <div class="col-sm-6">
											                    <div class="col-sm-6"> 
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Per Hour USD</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control numberValidation" name="model[flight_delay][per_hour]" value="<?php echo $arrValues['per_hour'];?>" >
											                    </div>              
											                </div>			
											                <div class="col-sm-6">
											                    <div class="col-sm-6"> 
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Max upto</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control numberValidation" name="model[flight_delay][amount]" value="<?php echo $arrValues['amount'];?>" >
											                    </div>              
											                </div>	
											            </div>
									                    <br clear="all">
										                <div class="divider"></div> 
											            <div class="row" >						
											                <div class="col-sm-6">
											                    <div class="col-sm-6"> 
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Deductable upto USD</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control numberValidation" name="model[flight_delay][deductable]" value="<?php echo $arrValues['deductable'];?>" >
											                    </div>              
											                </div>			
											                <div class="col-sm-6">
											                    <div class="col-sm-5"> 
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Covered After</label>
											                    </div>  
											                    <div class="col-sm-4">
											                        <input type="text" class="form-control numberValidation" name="model[flight_delay][covered_after]" value="<?php echo $arrValues['covered_after'];?>" >
											                    </div> 
											                    <div class="col-sm-3"> 
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Hrs</label>
											                    </div>              
											                </div>	
											            </div>
								                    </div>  
								                    <div class="form-group"></div>
									                <div class="col-sm-12 row">
									                    <div class="col-sm-2"> 
									                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Comments</label>
									                    </div>  
									                    <div class="col-sm-10">
									                        <input type="text" class="form-control" name="model[flight_delay][comments]" placeholder ="Max 100 Char" maxlength="100" placeholder ="Max 100 Char" maxlength="100" placeholder ="Max 100 Char" maxlength="100" value="<?php echo $arrValues['comments'];?>" >
									                    </div>              
									                </div>	 
									             </div>   
											</td>
										</tr>
										
										
										<tr>
											<th class="spec" scope="row" width="234" valign="top"><strong>Hijack</strong></th>
											<td width="510" valign="top" colspan="2">
												<div class="row">
												<?php
													$default = array('covered'=>'no', 'amount'=>'','max_days'=>'', 'max_amount'=>'', 'covered_after'=>'', 'comments'=>'');
													$arrValues = array_key_exists( 'hijack_daily_allowance',$model) ? unserialize($model['hijack_daily_allowance']) : $default;
													$arrValues = Util::array_overlay($default, $arrValues);
													$selected = $arrValues['covered'];
								                ?>
								                    <div class="col-sm-12"> 
									                    <?php 
															$options = array('yes'=>'Yes', 'no'=>'No');		
															foreach ($options as $k1=>$v1)
															{
																$op = array(
																    'class'       => 'showHideNextDivByRadio',
																    'name'        => 'model[hijack_daily_allowance][covered]',
																    'value'       => $k1,
																    'checked'     => ($selected == $k1) ? TRUE : FALSE,
																    'style'       => 'margin:10px',
																    );
																echo '<label class="ui-radio">'.form_radio($op).'<span>'.$v1.'</span></label>';
															}
														?>
								                    </div> 
								                    <div class="col-sm-12 row" style="display:<?php echo ($selected != 'no') ? 'block':'none';?>">
														<div class="row" >						
											                <div class="col-sm-6">
											                    <div class="col-sm-6"> 
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Amount Per Day USD</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control numberValidation" name="model[hijack_daily_allowance][amount]" value="<?php echo $arrValues['amount'];?>" >
											                    </div>              
											                </div>			
											                <div class="col-sm-6">
											                    <div class="col-sm-6"> 
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Max Amount Upto USD</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control numberValidation" name="model[hijack_daily_allowance][max_amount]" value="<?php echo $arrValues['max_amount'];?>" >
											                    </div>              
											                </div>	
											            </div>			            
									                    <br clear="all">
										                <div class="divider"></div> 
											            <div class="row" >
											                <div class="col-sm-6">
											                    <div class="col-sm-6"> 
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Max Days</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control numberValidation" name="model[hijack_daily_allowance][max_days]" value="<?php echo $arrValues['max_days'];?>" >
											                    </div>              
											                </div>	
											                <div class="col-sm-6">
											                    <div class="col-sm-5"> 
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Covered after</label>
											                    </div>  
											                    <div class="col-sm-4">
											                        <input type="text" class="form-control numberValidation" name="model[hijack_daily_allowance][covered_after]" value="<?php echo $arrValues['covered_after'];?>" >
											                    </div>  
											                    <div class="col-sm-3"> 
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Hrs</label>
											                    </div>              
											                </div>	
											            </div>
								                    </div>  
								                    
								                    <div class="form-group"></div>
									                <div class="col-sm-12 row">
									                    <div class="col-sm-2"> 
									                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Comments</label>
									                    </div>  
									                    <div class="col-sm-10">
									                        <input type="text" class="form-control" name="model[hijack_daily_allowance][comments]" placeholder ="Max 100 Char" maxlength="100" placeholder ="Max 100 Char" maxlength="100" placeholder ="Max 100 Char" maxlength="100" value="<?php echo $arrValues['comments'];?>" >
									                    </div>              
									                </div>	 
									             </div>   
											</td>
										</tr>
										

										<tr>
											<th class="spec" scope="row" width="234" valign="top"><strong>Automatic extension of policy</strong></th>
											<td width="510" valign="top" colspan="2">
												<div class="row">
												<?php
													$default = array('covered'=>'no', 'days'=>'','comments'=>'');
													$arrValues = array_key_exists( 'automatic_extension_of_policy',$model) ? unserialize($model['automatic_extension_of_policy']) : $default;
													$arrValues = Util::array_overlay($default, $arrValues);
													$selected = $arrValues['covered'];
								                ?>
								                    <div class="col-sm-12"> 
									                    <?php 
															$options = array('yes'=>'Yes', 'no'=>'No');		
															foreach ($options as $k1=>$v1)
															{
																$op = array(
																    'class'       => 'showHideNextDivByRadio',
																    'name'        => 'model[automatic_extension_of_policy][covered]',
																    'value'       => $k1,
																    'checked'     => ($selected == $k1) ? TRUE : FALSE,
																    'style'       => 'margin:10px',
																    );
																echo '<label class="ui-radio">'.form_radio($op).'<span>'.$v1.'</span></label>';
															}
														?>
								                    </div> 
								                    <div class="col-sm-12 row" style="display:<?php echo ($selected != 'no') ? 'block':'none';?>">
									                    <div class="col-sm-2"> 
									                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">No. of Days</label>
									                    </div>  
									                    <div class="col-sm-3">
									                        <input type="text" class="form-control numberValidation" name="model[automatic_extension_of_policy][days]" value="<?php echo $arrValues['days'];?>" >
									                    </div>    											            
								                    </div>  
								                    <div class="form-group"></div>
									                <div class="col-sm-12 row">
									                    <div class="col-sm-2"> 
									                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Comments</label>
									                    </div>  
									                    <div class="col-sm-10">
									                        <input type="text" class="form-control" name="model[automatic_extension_of_policy][comments]" placeholder ="Max 100 Char" maxlength="100" placeholder ="Max 100 Char" maxlength="100" placeholder ="Max 100 Char" maxlength="100" value="<?php echo $arrValues['comments'];?>" >
									                    </div>              
									                </div>	 
									             </div>   
											</td>
										</tr>
										
										
										<tr>
											<th class="spec" scope="row" width="234" valign="top"><strong>Emergency Cash Advance</strong></th>
											<td width="510" valign="top" colspan="2">
								                <div class="row">
												<?php
													$default = array('covered'=>'no', 'amount'=>'', 'deductable'=>'', 'comments'=>'');
													$arrValues = array_key_exists( 'emergency_cash_advance',$model) ? unserialize($model['emergency_cash_advance']) : $default;
													$arrValues = Util::array_overlay($default, $arrValues);
													$selected = $arrValues['covered'];
								                ?>
								                    <div class="col-sm-12"> 
									                    <?php 
															$options = array('yes'=>'Yes', 'no'=>'No');		
															foreach ($options as $k1=>$v1)
															{
																$op = array(
																    'class'       => 'showHideNextDivByRadio',
																    'name'        => 'model[emergency_cash_advance][covered]',
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
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Covered Upto</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control numberValidation" name="model[emergency_cash_advance][amount]" value="<?php echo $arrValues['amount'];?>" >
											                    </div>              
											                </div>			
											                <div class="col-sm-6">
											                    <div class="col-sm-6"> 
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Deductable Upto</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control numberValidation" name="model[emergency_cash_advance][deductable]" value="<?php echo $arrValues['deductable'];?>" >
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
										                   		<input type="text" class="form-control"  name="model[emergency_cash_advance][comments]" placeholder ="Max 100 Char" maxlength="100" placeholder ="Max 100 Char" maxlength="100" value="<?php echo $arrValues['comments'];?>" >
										                    </div>            
										                </div>	
									                </div>
								                </div>
											</td>
										</tr>
										
										
										<tr>
											<th class="spec" scope="row" width="234" valign="top"><strong>Missed Connections/Departure</strong></th>
											<td width="510" valign="top" colspan="2">
								                <div class="row">
												<?php
													$default = array('covered'=>'no', 'amount'=>'', 'covered_after'=>'', 'comments'=>'');
													$arrValues = array_key_exists( 'missed_connection',$model) ? unserialize($model['missed_connection']) : $default;
													$arrValues = Util::array_overlay($default, $arrValues);
													$selected = $arrValues['covered'];
								                ?>
								                    <div class="col-sm-12"> 
									                    <?php 
															$options = array('yes'=>'Yes', 'no'=>'No');		
															foreach ($options as $k1=>$v1)
															{
																$op = array(
																    'class'       => 'showHideNextDivByRadio',
																    'name'        => 'model[missed_connection][covered]',
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
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Covered Upto</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control numberValidation" name="model[missed_connection][amount]" value="<?php echo $arrValues['amount'];?>" >
											                    </div>              
											                </div>			
											                <div class="col-sm-6">
											                    <div class="col-sm-4"> 
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Covered after </label>
											                    </div>  
											                    <div class="col-sm-4">
											                        <input type="text" class="form-control numberValidation" name="model[missed_connection][covered_after]" value="<?php echo $arrValues['covered_after'];?>" >
											                    </div>    
											                    <div class="col-sm-4"> 
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Hrs of delay </label>
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
										                   		<input type="text" class="form-control"  name="model[missed_connection][comments]" placeholder ="Max 100 Char" maxlength="100" placeholder ="Max 100 Char" maxlength="100" value="<?php echo $arrValues['comments'];?>" >
										                    </div>            
										                </div>	
									                </div>
								                </div>
											</td>
										</tr>
										
										<tr>
											<th class="spec" scope="row" width="234" valign="top"><strong>Bounced bookings of Hotel and Airline</strong></th>
											<td width="510" valign="top" colspan="2">
								                <div class="row">
												<?php
													$default = array('covered'=>'no', 'amount'=>'', 'deductable'=>'', 'comments'=>'');
													$arrValues = array_key_exists( 'bounced_bookings',$model) ? unserialize($model['bounced_bookings']) : $default;
													$arrValues = Util::array_overlay($default, $arrValues);
													$selected = $arrValues['covered'];
								                ?>
								                    <div class="col-sm-12"> 
									                    <?php 
															$options = array('yes'=>'Yes', 'no'=>'No');		
															foreach ($options as $k1=>$v1)
															{
																$op = array(
																    'class'       => 'showHideNextDivByRadio',
																    'name'        => 'model[bounced_bookings][covered]',
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
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Covered Upto</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control numberValidation" name="model[bounced_bookings][amount]" value="<?php echo $arrValues['amount'];?>" >
											                    </div>              
											                </div>			
											                <div class="col-sm-6">
											                    <div class="col-sm-6"> 
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Deductable Upto</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control numberValidation" name="model[bounced_bookings][deductable]" value="<?php echo $arrValues['deductable'];?>" >
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
										                   		<input type="text" class="form-control"  name="model[bounced_bookings][comments]" placeholder ="Max 100 Char" maxlength="100" placeholder ="Max 100 Char" maxlength="100" value="<?php echo $arrValues['comments'];?>" >
										                    </div>            
										                </div>	
									                </div>
								                </div>
											</td>
										</tr>
										
										
										<tr>
											<th class="specalt" scope="row" width="234" valign="top">Fraudulent Charges (Payment Card Security)</th>
											<td width="510" valign="top" colspan="2">
											
								                <div class="row">
												<?php
													$default = array('covered'=>'no',  'comments'=>'');
													$arrValues = array_key_exists( 'fraudulent_charges',$model) ? unserialize($model['fraudulent_charges']) : $default;
													$arrValues = Util::array_overlay($default, $arrValues);
													$selected = $arrValues['covered'];
								                ?>
								                    <div class="col-sm-12"> 
									                    <?php 
															$options = array('yes'=>'Covered', 'no'=>'Not Covered');		
															foreach ($options as $k1=>$v1)
															{
																$op = array(
																    'name'        => 'model[fraudulent_charges][covered]',
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
										                   		<input type="text" class="form-control" maxlength="120" placeholder="Max 127 Chars" name="model[fraudulent_charges][comments]" placeholder ="Max 100 Char" maxlength="100" value="<?php echo $arrValues['comments'];?>" >
										                    </div>            
										                </div>	
									                </div>
								                </div>	
											</td>
										</tr>
										
										
										<tr>
											<th class="spec" scope="row" width="234" valign="top"><strong>Home Burglary</strong></th>
											<td width="510" valign="top" colspan="2">
								                <div class="row">
												<?php
													$default = array('covered'=>'no', 'amount'=>'', 'deductable'=>'', 'comments'=>'');
													$arrValues = array_key_exists( 'home_burglary',$model) ? unserialize($model['home_burglary']) : $default;
													$arrValues = Util::array_overlay($default, $arrValues);
													$selected = $arrValues['covered'];
								                ?>
								                    <div class="col-sm-12"> 
									                    <?php 
															$options = array('yes'=>'Yes', 'no'=>'No');		
															foreach ($options as $k1=>$v1)
															{
																$op = array(
																    'class'       => 'showHideNextDivByRadio',
																    'name'        => 'model[home_burglary][covered]',
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
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Covered Upto</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control numberValidation" name="model[home_burglary][amount]" value="<?php echo $arrValues['amount'];?>" >
											                    </div>              
											                </div>			
											                <div class="col-sm-6">
											                    <div class="col-sm-6"> 
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Deductable Upto</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control numberValidation" name="model[home_burglary][deductable]" value="<?php echo $arrValues['deductable'];?>" >
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
										                   		<input type="text" class="form-control"  name="model[home_burglary][comments]" placeholder ="Max 100 Char" maxlength="100" placeholder ="Max 100 Char" maxlength="100" value="<?php echo $arrValues['comments'];?>" >
										                    </div>            
										                </div>	
									                </div>
								                </div>
											</td>
										</tr>
										
										
										
										<tr>
											<th class="spec" scope="row" width="234" valign="top"><strong>Study Interuption</strong></th>
											<td width="510" valign="top" colspan="2">
								                <div class="row">
												<?php
													$default = array('covered'=>'no', 'amount'=>'', 'deductable'=>'', 'comments'=>'');
													$arrValues = array_key_exists( 'study_interuption',$model) ? unserialize($model['study_interuption']) : $default;
													$arrValues = Util::array_overlay($default, $arrValues);
													$selected = $arrValues['covered'];
								                ?>
								                    <div class="col-sm-12"> 
									                    <?php 
															$options = array('yes'=>'Yes', 'no'=>'No');		
															foreach ($options as $k1=>$v1)
															{
																$op = array(
																    'class'       => 'showHideNextDivByRadio',
																    'name'        => 'model[study_interuption][covered]',
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
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Covered Upto</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control numberValidation" name="model[study_interuption][amount]" value="<?php echo $arrValues['amount'];?>" >
											                    </div>              
											                </div>			
											                <div class="col-sm-6">
											                    <div class="col-sm-6"> 
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Deductable Upto</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control numberValidation" name="model[study_interuption][deductable]" value="<?php echo $arrValues['deductable'];?>" >
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
										                   		<input type="text" class="form-control"  name="model[study_interuption][comments]" placeholder ="Max 100 Char" maxlength="100" placeholder ="Max 100 Char" maxlength="100" value="<?php echo $arrValues['comments'];?>" >
										                    </div>            
										                </div>	
									                </div>
								                </div>
											</td>
										</tr>
										
										<tr>
											<th class="specalt" scope="row" width="234" valign="top">Sponsor Protection</th>
											<td width="510" valign="top" colspan="2">
											
								                <div class="row">
												<?php
													$default = array('covered'=>'no',  'comments'=>'');
													$arrValues = array_key_exists( 'sponsor_protection',$model) ? unserialize($model['sponsor_protection']) : $default;
													$arrValues = Util::array_overlay($default, $arrValues);
													$selected = $arrValues['covered'];
								                ?>
								                    <div class="col-sm-12"> 
									                    <?php 
															$options = array('yes'=>'Covered', 'no'=>'Not Covered');		
															foreach ($options as $k1=>$v1)
															{
																$op = array(
																    'name'        => 'model[sponsor_protection][covered]',
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
										                   		<input type="text" class="form-control" maxlength="120" placeholder="Max 127 Chars" name="model[sponsor_protection][comments]" placeholder ="Max 100 Char" maxlength="100" value="<?php echo $arrValues['comments'];?>" >
										                    </div>            
										                </div>	
									                </div>
								                </div>	
											</td>
										</tr>
										
										
										
										<tr>
											<th class="spec" scope="row" width="234" valign="top"><strong>Compassionate Visit</strong></th>
											<td width="510" valign="top" colspan="2">
								                <div class="row">
												<?php
													$default = array('covered'=>'no', 'amount'=>'', 'deductable'=>'', 'comments'=>'');
													$arrValues = array_key_exists( 'compassionate_visit',$model) ? unserialize($model['compassionate_visit']) : $default;
													$arrValues = Util::array_overlay($default, $arrValues);
													$selected = $arrValues['covered'];
								                ?>
								                    <div class="col-sm-12"> 
									                    <?php 
															$options = array('yes'=>'Yes', 'no'=>'No');		
															foreach ($options as $k1=>$v1)
															{
																$op = array(
																    'class'       => 'showHideNextDivByRadio',
																    'name'        => 'model[compassionate_visit][covered]',
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
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Covered Upto</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control numberValidation" name="model[compassionate_visit][amount]" value="<?php echo $arrValues['amount'];?>" >
											                    </div>              
											                </div>			
											                <div class="col-sm-6">
											                    <div class="col-sm-6"> 
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Deductable Upto</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control numberValidation" name="model[compassionate_visit][deductable]" value="<?php echo $arrValues['deductable'];?>" >
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
										                   		<input type="text" class="form-control"  name="model[compassionate_visit][comments]" placeholder ="Max 100 Char" maxlength="100" placeholder ="Max 100 Char" maxlength="100" value="<?php echo $arrValues['comments'];?>" >
										                    </div>            
										                </div>	
									                </div>
								                </div>
											</td>
										</tr>
										
										
										<tr>
											<th class="spec" scope="row" width="234" valign="top"><strong>Bail Bond</strong></th>
											<td width="510" valign="top" colspan="2">
								                <div class="row">
												<?php
													$default = array('covered'=>'no', 'amount'=>'', 'deductable'=>'', 'comments'=>'');
													$arrValues = array_key_exists( 'bail_bond',$model) ? unserialize($model['bail_bond']) : $default;
													$arrValues = Util::array_overlay($default, $arrValues);
													$selected = $arrValues['covered'];
								                ?>
								                    <div class="col-sm-12"> 
									                    <?php 
															$options = array('yes'=>'Yes', 'no'=>'No');		
															foreach ($options as $k1=>$v1)
															{
																$op = array(
																    'class'       => 'showHideNextDivByRadio',
																    'name'        => 'model[bail_bond][covered]',
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
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Covered Upto</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control numberValidation" name="model[bail_bond][amount]" value="<?php echo $arrValues['amount'];?>" >
											                    </div>              
											                </div>			
											                <div class="col-sm-6">
											                    <div class="col-sm-6"> 
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Deductable Upto</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control numberValidation" name="model[bail_bond][deductable]" value="<?php echo $arrValues['deductable'];?>" >
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
										                   		<input type="text" class="form-control"  name="model[bail_bond][comments]" placeholder ="Max 100 Char" maxlength="100" placeholder ="Max 100 Char" maxlength="100" value="<?php echo $arrValues['comments'];?>" >
										                    </div>            
										                </div>	
									                </div>
								                </div>
											</td>
										</tr>
										
										<tr>
											<th class="spec" scope="row" width="234" valign="top"><strong>Felonious Assault</strong></th>
											<td width="510" valign="top" colspan="2">
												<div class="row">
												<?php
													$default = array('covered'=>'no', 'amount'=>'',  'comments'=>'');
													$arrValues = array_key_exists( 'felonious_assault',$model) ? unserialize($model['felonious_assault']) : $default;
													$arrValues = Util::array_overlay($default, $arrValues);
													$selected = $arrValues['covered'];
								                ?>
								                    <div class="col-sm-12"> 
									                    <?php 
															$options = array('yes'=>'Yes', 'no'=>'No');		
															foreach ($options as $k1=>$v1)
															{
																$op = array(
																    'class'       => 'showHideNextDivByRadio',
																    'name'        => 'model[felonious_assault][covered]',
																    'value'       => $k1,
																    'checked'     => ($selected == $k1) ? TRUE : FALSE,
																    'style'       => 'margin:10px',
																    );
																echo '<label class="ui-radio">'.form_radio($op).'<span>'.$v1.'</span></label>';
															}
														?>
								                    </div> 
								                    <div class="col-sm-12 row" style="display:<?php echo ($selected != 'no') ? 'block':'none';?>">
									                    <div class="col-sm-2"> 
									                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Max Amount</label>
									                    </div>  
									                    <div class="col-sm-3">
									                        <input type="text" class="form-control numberValidation" name="model[felonious_assault][amount]" value="<?php echo $arrValues['amount'];?>" >
									                    </div>    											            
								                    </div>  
								                    <div class="form-group"></div>
									                <div class="col-sm-12 row">
									                    <div class="col-sm-2"> 
									                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Comments</label>
									                    </div>  
									                    <div class="col-sm-10">
									                        <input type="text" class="form-control" name="model[felonious_assault][comments]" placeholder ="Max 100 Char" maxlength="100" placeholder ="Max 100 Char" maxlength="100" placeholder ="Max 100 Char" maxlength="100" value="<?php echo $arrValues['comments'];?>" >
									                    </div>              
									                </div>	 
									             </div>   
											</td>
										</tr>
										
										
										<tr>
											<th class="spec" scope="row" width="234" valign="top"><strong>Maternity benefit for termination of pregnancy</strong></th>
											<td width="510" valign="top" colspan="2">
												<div class="row">
												<?php
													$default = array('covered'=>'no', 'amount'=>'',  'comments'=>'');
													$arrValues = array_key_exists( 'maternity_benefit_for_termination_of_pregnancy',$model) ? unserialize($model['maternity_benefit_for_termination_of_pregnancy']) : $default;
													$arrValues = Util::array_overlay($default, $arrValues);
													$selected = $arrValues['covered'];
								                ?>
								                    <div class="col-sm-12"> 
									                    <?php 
															$options = array('yes'=>'Yes', 'no'=>'No');		
															foreach ($options as $k1=>$v1)
															{
																$op = array(
																    'class'       => 'showHideNextDivByRadio',
																    'name'        => 'model[maternity_benefit_for_termination_of_pregnancy][covered]',
																    'value'       => $k1,
																    'checked'     => ($selected == $k1) ? TRUE : FALSE,
																    'style'       => 'margin:10px',
																    );
																echo '<label class="ui-radio">'.form_radio($op).'<span>'.$v1.'</span></label>';
															}
														?>
								                    </div> 
								                    <div class="col-sm-12 row" style="display:<?php echo ($selected != 'no') ? 'block':'none';?>">
									                    <div class="col-sm-2"> 
									                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Max Amount</label>
									                    </div>  
									                    <div class="col-sm-3">
									                        <input type="text" class="form-control numberValidation" name="model[maternity_benefit_for_termination_of_pregnancy][amount]" value="<?php echo $arrValues['amount'];?>" >
									                    </div>    											            
								                    </div>  
								                    <div class="form-group"></div>
									                <div class="col-sm-12 row">
									                    <div class="col-sm-2"> 
									                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Comments</label>
									                    </div>  
									                    <div class="col-sm-10">
									                        <input type="text" class="form-control" name="model[maternity_benefit_for_termination_of_pregnancy][comments]" placeholder ="Max 100 Char" maxlength="100" placeholder ="Max 100 Char" maxlength="100" placeholder ="Max 100 Char" maxlength="100" value="<?php echo $arrValues['comments'];?>" >
									                    </div>              
									                </div>	 
									             </div>   
											</td>
										</tr>
										
										
										<tr>
											<th class="spec" scope="row" width="234" valign="top"><strong>Other Medical Treatment(Trip for Medical treatment)</strong></th>
											<td width="510" valign="top" colspan="2">
												<div class="row">
												<?php
													$default = array('covered'=>'no', 'amount'=>'',  'comments'=>'');
													$arrValues = array_key_exists( 'other_medical_treatment',$model) ? unserialize($model['other_medical_treatment']) : $default;
													$arrValues = Util::array_overlay($default, $arrValues);
													$selected = $arrValues['covered'];
								                ?>
								                    <div class="col-sm-12"> 
									                    <?php 
															$options = array('yes'=>'Yes', 'no'=>'No');		
															foreach ($options as $k1=>$v1)
															{
																$op = array(
																    'class'       => 'showHideNextDivByRadio',
																    'name'        => 'model[other_medical_treatment][covered]',
																    'value'       => $k1,
																    'checked'     => ($selected == $k1) ? TRUE : FALSE,
																    'style'       => 'margin:10px',
																    );
																echo '<label class="ui-radio">'.form_radio($op).'<span>'.$v1.'</span></label>';
															}
														?>
								                    </div> 
								                    <div class="col-sm-12 row" style="display:<?php echo ($selected != 'no') ? 'block':'none';?>">
									                    <div class="col-sm-2"> 
									                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Max Amount</label>
									                    </div>  
									                    <div class="col-sm-3">
									                        <input type="text" class="form-control numberValidation" name="model[other_medical_treatment][amount]" value="<?php echo $arrValues['amount'];?>" >
									                    </div>    											            
								                    </div>  
								                    <div class="form-group"></div>
									                <div class="col-sm-12 row">
									                    <div class="col-sm-2"> 
									                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Comments</label>
									                    </div>  
									                    <div class="col-sm-10">
									                        <input type="text" class="form-control" name="model[other_medical_treatment][comments]" placeholder ="Max 100 Char" maxlength="100" placeholder ="Max 100 Char" maxlength="100" placeholder ="Max 100 Char" maxlength="100" value="<?php echo $arrValues['comments'];?>" >
									                    </div>              
									                </div>	 
									             </div>   
											</td>
										</tr>
										
										
										<tr>
											<th class="spec" scope="row" width="234" valign="top"><strong>Red 24 Services</strong></th>
											<td width="510" valign="top" colspan="2">
												<div class="row">
												<?php
													$default = array('covered'=>'no', 'amount'=>'',  'comments'=>'');
													$arrValues = array_key_exists( 'red_services',$model) ? unserialize($model['red_services']) : $default;
													$arrValues = Util::array_overlay($default, $arrValues);
													$selected = $arrValues['covered'];
								                ?>
								                    <div class="col-sm-12"> 
									                    <?php 
															$options = array('yes'=>'Yes', 'no'=>'No');		
															foreach ($options as $k1=>$v1)
															{
																$op = array(
																    'class'       => 'showHideNextDivByRadio',
																    'name'        => 'model[red_services][covered]',
																    'value'       => $k1,
																    'checked'     => ($selected == $k1) ? TRUE : FALSE,
																    'style'       => 'margin:10px',
																    );
																echo '<label class="ui-radio">'.form_radio($op).'<span>'.$v1.'</span></label>';
															}
														?>
								                    </div> 
								                    <div class="col-sm-12 row" style="display:<?php echo ($selected != 'no') ? 'block':'none';?>">
									                    <div class="col-sm-2"> 
									                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Max Amount</label>
									                    </div>  
									                    <div class="col-sm-3">
									                        <input type="text" class="form-control numberValidation" name="model[red_services][amount]" value="<?php echo $arrValues['amount'];?>" >
									                    </div>    											            
								                    </div>  
								                    <div class="form-group"></div>
									                <div class="col-sm-12 row">
									                    <div class="col-sm-2"> 
									                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Comments</label>
									                    </div>  
									                    <div class="col-sm-10">
									                        <input type="text" class="form-control" name="model[red_services][comments]" placeholder ="Max 100 Char" maxlength="100" placeholder ="Max 100 Char" maxlength="100" placeholder ="Max 100 Char" maxlength="100" value="<?php echo $arrValues['comments'];?>" >
									                    </div>              
									                </div>	 
									             </div>   
											</td>
										</tr>
										
										
										<tr>
											<th class="spec" scope="row" width="234" valign="top"><strong>Assistance Services</strong></th>
											<td width="510" valign="top" colspan="2">
								                <div class="row">
												<?php
													$default = array('covered'=>'no', 'amount'=>'', 'deductable'=>'', 'comments'=>'');
													$arrValues = array_key_exists( 'assistance_services',$model) ? unserialize($model['assistance_services']) : $default;
													$arrValues = Util::array_overlay($default, $arrValues);
													$selected = $arrValues['covered'];
								                ?>
								                    <div class="col-sm-12"> 
									                    <?php 
															$options = array('yes'=>'Yes', 'no'=>'No');		
															foreach ($options as $k1=>$v1)
															{
																$op = array(
																    'class'       => 'showHideNextDivByRadio',
																    'name'        => 'model[assistance_services][covered]',
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
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Covered Upto</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control numberValidation" name="model[assistance_services][amount]" value="<?php echo $arrValues['amount'];?>" >
											                    </div>              
											                </div>			
											                <div class="col-sm-6">
											                    <div class="col-sm-6"> 
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Deductable Upto</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control numberValidation" name="model[assistance_services][deductable]" value="<?php echo $arrValues['deductable'];?>" >
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
										                   		<input type="text" class="form-control"  name="model[assistance_services][comments]" placeholder ="Max 100 Char" maxlength="100" placeholder ="Max 100 Char" maxlength="100" value="<?php echo $arrValues['comments'];?>" >
										                    </div>            
										                </div>	
									                </div>
								                </div>
											</td>
										</tr>
										
										
										
										<tr>
											<th class="spec" scope="row" width="234" valign="top"><strong>In - Hospital Indemnity –Accident</strong></th>
											<td width="510" valign="top" colspan="2">
								                <div class="row">
												<?php
													$default = array('covered'=>'no', 'amount'=>'', 'deductable'=>'','max_days'=>'', 'comments'=>'');
													$arrValues = array_key_exists( 'in_hospital_indemnity_accident',$model) ? unserialize($model['in_hospital_indemnity_accident']) : $default;
													$arrValues = Util::array_overlay($default, $arrValues);
													$selected = $arrValues['covered'];
								                ?>
								                    <div class="col-sm-12"> 
									                    <?php 
															$options = array('yes'=>'Yes', 'no'=>'No');		
															foreach ($options as $k1=>$v1)
															{
																$op = array(
																    'class'       => 'showHideNextDivByRadio',
																    'name'        => 'model[in_hospital_indemnity_accident][covered]',
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
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Covered Upto</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control numberValidation" name="model[in_hospital_indemnity_accident][amount]" value="<?php echo $arrValues['amount'];?>" >
											                    </div>              
											                </div>			
											                <div class="col-sm-4">
											                    <div class="col-sm-6"> 
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Deductable Upto</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control numberValidation" name="model[in_hospital_indemnity_accident][deductable]" value="<?php echo $arrValues['deductable'];?>" >
											                    </div>              
											                </div>	
											                <div class="col-sm-4">
											                    <div class="col-sm-6"> 
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Max Days</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control numberValidation" name="model[in_hospital_indemnity_accident][max_days]" value="<?php echo $arrValues['max_days'];?>" >
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
										                   		<input type="text" class="form-control"  name="model[in_hospital_indemnity_accident][comments]" placeholder ="Max 100 Char" maxlength="100" placeholder ="Max 100 Char" maxlength="100" value="<?php echo $arrValues['comments'];?>" >
										                    </div>            
										                </div>	
									                </div>
								                </div>
											</td>
										</tr>
										
										
										<tr>
											<th class="spec" scope="row" width="234" valign="top"><strong>Accommodation charges due to Trip Delay</strong></th>
											<td width="510" valign="top" colspan="2">
								                <div class="row">
												<?php
													$default = array('covered'=>'no', 'amount'=>'', 'deductable'=>'','max_days'=>'', 'comments'=>'');
													$arrValues = array_key_exists( 'accommodation_charges_on_delay',$model) ? unserialize($model['accommodation_charges_on_delay']) : $default;
													$arrValues = Util::array_overlay($default, $arrValues);
													$selected = $arrValues['covered'];
								                ?>
								                    <div class="col-sm-12"> 
									                    <?php 
															$options = array('yes'=>'Yes', 'no'=>'No');		
															foreach ($options as $k1=>$v1)
															{
																$op = array(
																    'class'       => 'showHideNextDivByRadio',
																    'name'        => 'model[accommodation_charges_on_delay][covered]',
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
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Covered Upto</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control numberValidation" name="model[accommodation_charges_on_delay][amount]" value="<?php echo $arrValues['amount'];?>" >
											                    </div>              
											                </div>			
											                <div class="col-sm-4">
											                    <div class="col-sm-6"> 
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Deductable Upto</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control numberValidation" name="model[accommodation_charges_on_delay][deductable]" value="<?php echo $arrValues['deductable'];?>" >
											                    </div>              
											                </div>	
											                <div class="col-sm-4">
											                    <div class="col-sm-6"> 
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Max Days</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control numberValidation" name="model[accommodation_charges_on_delay][max_days]" value="<?php echo $arrValues['max_days'];?>" >
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
										                   		<input type="text" class="form-control"  name="model[accommodation_charges_on_delay][comments]" placeholder ="Max 100 Char" maxlength="100" placeholder ="Max 100 Char" maxlength="100" value="<?php echo $arrValues['comments'];?>" >
										                    </div>            
										                </div>	
									                </div>
								                </div>
											</td>
										</tr>
										
										
										<tr>
											<th class="spec" scope="row" width="234" valign="top"><strong>Loss of Ticket</strong></th>
											<td width="510" valign="top" colspan="2">
								                <div class="row">
												<?php
													$default = array('covered'=>'no', 'amount'=>'', 'deductable'=>'', 'comments'=>'');
													$arrValues = array_key_exists( 'loss_of_ticket',$model) ? unserialize($model['loss_of_ticket']) : $default;
													$arrValues = Util::array_overlay($default, $arrValues);
													$selected = $arrValues['covered'];
								                ?>
								                    <div class="col-sm-12"> 
									                    <?php 
															$options = array('yes'=>'Yes', 'no'=>'No');		
															foreach ($options as $k1=>$v1)
															{
																$op = array(
																    'class'       => 'showHideNextDivByRadio',
																    'name'        => 'model[loss_of_ticket][covered]',
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
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Covered Upto</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control numberValidation" name="model[loss_of_ticket][amount]" value="<?php echo $arrValues['amount'];?>" >
											                    </div>              
											                </div>			
											                <div class="col-sm-6">
											                    <div class="col-sm-6"> 
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Deductable Upto</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control numberValidation" name="model[loss_of_ticket][deductable]" value="<?php echo $arrValues['deductable'];?>" >
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
										                   		<input type="text" class="form-control"  name="model[loss_of_ticket][comments]" placeholder ="Max 100 Char" maxlength="100" placeholder ="Max 100 Char" maxlength="100" value="<?php echo $arrValues['comments'];?>" >
										                    </div>            
										                </div>	
									                </div>
								                </div>
											</td>
										</tr>
										
										
										
										<tr>
											<th class="spec" scope="row" width="234" valign="top"><strong>Transportation</strong></th>
											<td width="510" valign="top" colspan="2">
								                <div class="row">
												<?php
													$default = array('covered'=>'no', 'amount'=>'', 'deductable'=>'', 'comments'=>'');
													$arrValues = array_key_exists( 'transportation',$model) ? unserialize($model['transportation']) : $default;
													$arrValues = Util::array_overlay($default, $arrValues);
													$selected = $arrValues['covered'];
								                ?>
								                    <div class="col-sm-12"> 
									                    <?php 
															$options = array('yes'=>'Yes', 'no'=>'No');		
															foreach ($options as $k1=>$v1)
															{
																$op = array(
																    'class'       => 'showHideNextDivByRadio',
																    'name'        => 'model[transportation][covered]',
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
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Covered Upto</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control numberValidation" name="model[transportation][amount]" value="<?php echo $arrValues['amount'];?>" >
											                    </div>              
											                </div>			
											                <div class="col-sm-6">
											                    <div class="col-sm-6"> 
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Deductable Upto</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control numberValidation" name="model[transportation][deductable]" value="<?php echo $arrValues['deductable'];?>" >
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
										                   		<input type="text" class="form-control"  name="model[transportation][comments]" placeholder ="Max 100 Char" maxlength="100" placeholder ="Max 100 Char" maxlength="100" value="<?php echo $arrValues['comments'];?>" >
										                    </div>            
										                </div>	
									                </div>
								                </div>
											</td>
										</tr>
										
										
										
										<tr>
											<th class="spec" scope="row" width="234" valign="top"><strong>Replacement of Staff ( Business Trip Only)</strong></th>
											<td width="510" valign="top" colspan="2">
								                <div class="row">
												<?php
													$default = array('covered'=>'no', 'amount'=>'', 'deductable'=>'', 'comments'=>'');
													$arrValues = array_key_exists( 'replacement_of_staff',$model) ? unserialize($model['replacement_of_staff']) : $default;
													$arrValues = Util::array_overlay($default, $arrValues);
													$selected = $arrValues['covered'];
								                ?>
								                    <div class="col-sm-12"> 
									                    <?php 
															$options = array('yes'=>'Yes', 'no'=>'No');		
															foreach ($options as $k1=>$v1)
															{
																$op = array(
																    'class'       => 'showHideNextDivByRadio',
																    'name'        => 'model[replacement_of_staff][covered]',
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
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Covered Upto</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control numberValidation" name="model[replacement_of_staff][amount]" value="<?php echo $arrValues['amount'];?>" >
											                    </div>              
											                </div>			
											                <div class="col-sm-6">
											                    <div class="col-sm-6"> 
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Deductable Upto</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control numberValidation" name="model[replacement_of_staff][deductable]" value="<?php echo $arrValues['deductable'];?>" >
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
										                   		<input type="text" class="form-control"  name="model[replacement_of_staff][comments]" placeholder ="Max 100 Char" maxlength="100" placeholder ="Max 100 Char" maxlength="100" value="<?php echo $arrValues['comments'];?>" >
										                    </div>            
										                </div>	
									                </div>
								                </div>
											</td>
										</tr>
										
										
										
										
										
										
										<tr>
											<th class="spec" scope="row" width="234" valign="top"><strong>Loss Of Personal Documents</strong></th>
											<td width="510" valign="top" colspan="2">
								                <div class="row">
												<?php
													$default = array('covered'=>'no', 'amount'=>'', 'deductable'=>'', 'comments'=>'');
													$arrValues = array_key_exists( 'loss_of_personal_documents',$model) ? unserialize($model['loss_of_personal_documents']) : $default;
													$arrValues = Util::array_overlay($default, $arrValues);
													$selected = $arrValues['covered'];
								                ?>
								                    <div class="col-sm-12"> 
									                    <?php 
															$options = array('yes'=>'Yes', 'no'=>'No');		
															foreach ($options as $k1=>$v1)
															{
																$op = array(
																    'class'       => 'showHideNextDivByRadio',
																    'name'        => 'model[loss_of_personal_documents][covered]',
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
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Covered Upto</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control numberValidation" name="model[loss_of_personal_documents][amount]" value="<?php echo $arrValues['amount'];?>" >
											                    </div>              
											                </div>			
											                <div class="col-sm-6">
											                    <div class="col-sm-6"> 
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Deductable Upto</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control numberValidation" name="model[loss_of_personal_documents][deductable]" value="<?php echo $arrValues['deductable'];?>" >
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
										                   		<input type="text" class="form-control"  name="model[loss_of_personal_documents][comments]" placeholder ="Max 100 Char" maxlength="100" placeholder ="Max 100 Char" maxlength="100" value="<?php echo $arrValues['comments'];?>" >
										                    </div>            
										                </div>	
									                </div>
								                </div>
											</td>
										</tr>
										
										
										
										<tr>
											<th class="spec" scope="row" width="234" valign="top"><strong>Childcare Benefits</strong></th>
											<td width="510" valign="top" colspan="2">
								                <div class="row">
												<?php
													$default = array('covered'=>'no', 'amount'=>'', 'deductable'=>'','max_days'=>'', 'comments'=>'');
													$arrValues = array_key_exists( 'childcare_benefits',$model) ? unserialize($model['childcare_benefits']) : $default;
													$arrValues = Util::array_overlay($default, $arrValues);
													$selected = $arrValues['covered'];
								                ?>
								                    <div class="col-sm-12"> 
									                    <?php 
															$options = array('yes'=>'Yes', 'no'=>'No');		
															foreach ($options as $k1=>$v1)
															{
																$op = array(
																    'class'       => 'showHideNextDivByRadio',
																    'name'        => 'model[childcare_benefits][covered]',
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
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Covered Upto</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control numberValidation" name="model[childcare_benefits][amount]" value="<?php echo $arrValues['amount'];?>" >
											                    </div>              
											                </div>			
											                <div class="col-sm-4">
											                    <div class="col-sm-6"> 
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Deductable Upto</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control numberValidation" name="model[childcare_benefits][deductable]" value="<?php echo $arrValues['deductable'];?>" >
											                    </div>              
											                </div>	
											                <div class="col-sm-4">
											                    <div class="col-sm-6"> 
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Max Days</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control numberValidation" name="model[childcare_benefits][max_days]" value="<?php echo $arrValues['max_days'];?>" >
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
										                   		<input type="text" class="form-control"  name="model[childcare_benefits][comments]" placeholder ="Max 100 Char" maxlength="100" placeholder ="Max 100 Char" maxlength="100" value="<?php echo $arrValues['comments'];?>" >
										                    </div>            
										                </div>	
									                </div>
								                </div>
											</td>
										</tr>
										
										
										
										
										<tr>
											<th class="spec" scope="row" width="234" valign="top"><strong>Political Risk and Catastrop Evacuation</strong></th>
											<td width="510" valign="top" colspan="2">
								                <div class="row">
												<?php
													$default = array('covered'=>'no', 'amount'=>'', 'deductable'=>'', 'comments'=>'');
													$arrValues = array_key_exists( 'political_risk_and_catastrop_evacuation',$model) ? unserialize($model['political_risk_and_catastrop_evacuation']) : $default;
													$arrValues = Util::array_overlay($default, $arrValues);
													$selected = $arrValues['covered'];
								                ?>
								                    <div class="col-sm-12"> 
									                    <?php 
															$options = array('yes'=>'Yes', 'no'=>'No');		
															foreach ($options as $k1=>$v1)
															{
																$op = array(
																    'class'       => 'showHideNextDivByRadio',
																    'name'        => 'model[political_risk_and_catastrop_evacuation][covered]',
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
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Covered Upto</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control numberValidation" name="model[political_risk_and_catastrop_evacuation][amount]" value="<?php echo $arrValues['amount'];?>" >
											                    </div>              
											                </div>			
											                <div class="col-sm-6">
											                    <div class="col-sm-6"> 
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Deductable Upto</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control numberValidation" name="model[political_risk_and_catastrop_evacuation][deductable]" value="<?php echo $arrValues['deductable'];?>" >
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
										                   		<input type="text" class="form-control"  name="model[political_risk_and_catastrop_evacuation][comments]" placeholder ="Max 100 Char" maxlength="100" placeholder ="Max 100 Char" maxlength="100" value="<?php echo $arrValues['comments'];?>" >
										                    </div>            
										                </div>	
									                </div>
								                </div>
											</td>
										</tr>
										
										
										
										
										<tr>
											<th class="spec" scope="row" width="234" valign="top"><strong>Fire Cover for Building</strong></th>
											<td width="510" valign="top" colspan="2">
								                <div class="row">
												<?php
													$default = array('covered'=>'no', 'amount'=>'', 'deductable'=>'', 'comments'=>'');
													$arrValues = array_key_exists( 'fire_cover_for_building',$model) ? unserialize($model['fire_cover_for_building']) : $default;
													$arrValues = Util::array_overlay($default, $arrValues);
													$selected = $arrValues['covered'];
								                ?>
								                    <div class="col-sm-12"> 
									                    <?php 
															$options = array('yes'=>'Yes', 'no'=>'No');		
															foreach ($options as $k1=>$v1)
															{
																$op = array(
																    'class'       => 'showHideNextDivByRadio',
																    'name'        => 'model[fire_cover_for_building][covered]',
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
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Covered Upto</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control numberValidation" name="model[fire_cover_for_building][amount]" value="<?php echo $arrValues['amount'];?>" >
											                    </div>              
											                </div>			
											                <div class="col-sm-6">
											                    <div class="col-sm-6"> 
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Deductable Upto</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control numberValidation" name="model[fire_cover_for_building][deductable]" value="<?php echo $arrValues['deductable'];?>" >
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
										                   		<input type="text" class="form-control"  name="model[fire_cover_for_building][comments]" placeholder ="Max 100 Char" maxlength="100" placeholder ="Max 100 Char" maxlength="100" value="<?php echo $arrValues['comments'];?>" >
										                    </div>            
										                </div>	
									                </div>
								                </div>
											</td>
										</tr>
										
										
										
										<tr>
											<th class="spec" scope="row" width="234" valign="top"><strong>Fire Cover for Home Content</strong></th>
											<td width="510" valign="top" colspan="2">
								                <div class="row">
												<?php
													$default = array('covered'=>'no', 'amount'=>'', 'deductable'=>'', 'comments'=>'');
													$arrValues = array_key_exists( 'fire_cover_for_home_content',$model) ? unserialize($model['fire_cover_for_home_content']) : $default;
													$arrValues = Util::array_overlay($default, $arrValues);
													$selected = $arrValues['covered'];
								                ?>
								                    <div class="col-sm-12"> 
									                    <?php 
															$options = array('yes'=>'Yes', 'no'=>'No');		
															foreach ($options as $k1=>$v1)
															{
																$op = array(
																    'class'       => 'showHideNextDivByRadio',
																    'name'        => 'model[fire_cover_for_home_content][covered]',
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
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Covered Upto</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control numberValidation" name="model[fire_cover_for_home_content][amount]" value="<?php echo $arrValues['amount'];?>" >
											                    </div>              
											                </div>			
											                <div class="col-sm-6">
											                    <div class="col-sm-6"> 
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Deductable Upto</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control numberValidation" name="model[fire_cover_for_home_content][deductable]" value="<?php echo $arrValues['deductable'];?>" >
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
										                   		<input type="text" class="form-control"  name="model[fire_cover_for_home_content][comments]" placeholder ="Max 100 Char" maxlength="100" placeholder ="Max 100 Char" maxlength="100" value="<?php echo $arrValues['comments'];?>" >
										                    </div>            
										                </div>	
									                </div>
								                </div>
											</td>
										</tr>
										
										
										
										<tr>
											<th class="spec" scope="row" width="234" valign="top"><strong>Emergency Hotel Extension</strong></th>
											<td width="510" valign="top" colspan="2">
								                <div class="row">
												<?php
													$default = array('covered'=>'no', 'amount'=>'', 'deductable'=>'', 'comments'=>'');
													$arrValues = array_key_exists( 'emergency_hotel_extension',$model) ? unserialize($model['emergency_hotel_extension']) : $default;
													$arrValues = Util::array_overlay($default, $arrValues);
													$selected = $arrValues['covered'];
								                ?>
								                    <div class="col-sm-12"> 
									                    <?php 
															$options = array('yes'=>'Yes', 'no'=>'No');		
															foreach ($options as $k1=>$v1)
															{
																$op = array(
																    'class'       => 'showHideNextDivByRadio',
																    'name'        => 'model[emergency_hotel_extension][covered]',
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
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Covered Upto</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control numberValidation" name="model[emergency_hotel_extension][amount]" value="<?php echo $arrValues['amount'];?>" >
											                    </div>              
											                </div>			
											                <div class="col-sm-6">
											                    <div class="col-sm-6"> 
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Deductable Upto</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control numberValidation" name="model[emergency_hotel_extension][deductable]" value="<?php echo $arrValues['deductable'];?>" >
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
										                   		<input type="text" class="form-control"  name="model[emergency_hotel_extension][comments]" placeholder ="Max 100 Char" maxlength="100" placeholder ="Max 100 Char" maxlength="100" value="<?php echo $arrValues['comments'];?>" >
										                    </div>            
										                </div>	
									                </div>
								                </div>
											</td>
										</tr>
										
										
										
										<tr>
											<th class="spec" scope="row" width="234" valign="top"><strong>Return of Minor Child(ren)</strong></th>
											<td width="510" valign="top" colspan="2">
								                <div class="row">
												<?php
													$default = array('covered'=>'no', 'amount'=>'', 'deductable'=>'', 'comments'=>'');
													$arrValues = array_key_exists( 'return_of_minor_children',$model) ? unserialize($model['return_of_minor_children']) : $default;
													$arrValues = Util::array_overlay($default, $arrValues);
													$selected = $arrValues['covered'];
								                ?>
								                    <div class="col-sm-12"> 
									                    <?php 
															$options = array('yes'=>'Yes', 'no'=>'No');		
															foreach ($options as $k1=>$v1)
															{
																$op = array(
																    'class'       => 'showHideNextDivByRadio',
																    'name'        => 'model[return_of_minor_children][covered]',
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
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Covered Upto</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control numberValidation" name="model[return_of_minor_children][amount]" value="<?php echo $arrValues['amount'];?>" >
											                    </div>              
											                </div>			
											                <div class="col-sm-6">
											                    <div class="col-sm-6"> 
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Deductable Upto</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control numberValidation" name="model[return_of_minor_children][deductable]" value="<?php echo $arrValues['deductable'];?>" >
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
										                   		<input type="text" class="form-control"  name="model[return_of_minor_children][comments]" placeholder ="Max 100 Char" maxlength="100" placeholder ="Max 100 Char" maxlength="100" value="<?php echo $arrValues['comments'];?>" >
										                    </div>            
										                </div>	
									                </div>
								                </div>
											</td>
										</tr>
										
										
										<tr>
											<th class="spec" scope="row" width="234" valign="top"><strong>Golfer Hole-in-one</strong></th>
											<td width="510" valign="top" colspan="2">
								                <div class="row">
												<?php
													$default = array('covered'=>'no', 'amount'=>'', 'deductable'=>'', 'comments'=>'');
													$arrValues = array_key_exists( 'golfe_hole_in_one',$model) ? unserialize($model['golfe_hole_in_one']) : $default;
													$arrValues = Util::array_overlay($default, $arrValues);
													$selected = $arrValues['covered'];
								                ?>
								                    <div class="col-sm-12"> 
									                    <?php 
															$options = array('yes'=>'Yes', 'no'=>'No');		
															foreach ($options as $k1=>$v1)
															{
																$op = array(
																    'class'       => 'showHideNextDivByRadio',
																    'name'        => 'model[golfe_hole_in_one][covered]',
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
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Covered Upto</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control numberValidation" name="model[golfe_hole_in_one][amount]" value="<?php echo $arrValues['amount'];?>" >
											                    </div>              
											                </div>			
											                <div class="col-sm-6">
											                    <div class="col-sm-6"> 
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Deductable Upto</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control numberValidation" name="model[golfe_hole_in_one][deductable]" value="<?php echo $arrValues['deductable'];?>" >
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
										                   		<input type="text" class="form-control"  name="model[golfe_hole_in_one][comments]" placeholder ="Max 100 Char" maxlength="100" placeholder ="Max 100 Char" maxlength="100" value="<?php echo $arrValues['comments'];?>" >
										                    </div>            
										                </div>	
									                </div>
								                </div>
											</td>
										</tr>
										
										
										<tr>
											<th class="spec" scope="row" width="234" valign="top"><strong>Any one illness</strong></th>
											<td width="510" valign="top" colspan="2">
								                <div class="row">
												<?php
													$default = array('covered'=>'no', 'amount'=>'', 'deductable'=>'', 'comments'=>'');
													$arrValues = array_key_exists( 'any_one_illness',$model) ? unserialize($model['any_one_illness']) : $default;
													$arrValues = Util::array_overlay($default, $arrValues);
													$selected = $arrValues['covered'];
								                ?>
								                    <div class="col-sm-12"> 
									                    <?php 
															$options = array('yes'=>'Yes', 'no'=>'No');		
															foreach ($options as $k1=>$v1)
															{
																$op = array(
																    'class'       => 'showHideNextDivByRadio',
																    'name'        => 'model[any_one_illness][covered]',
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
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Covered Upto</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control numberValidation" name="model[any_one_illness][amount]" value="<?php echo $arrValues['amount'];?>" >
											                    </div>              
											                </div>			
											                <div class="col-sm-6">
											                    <div class="col-sm-6"> 
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Deductable Upto</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control numberValidation" name="model[any_one_illness][deductable]" value="<?php echo $arrValues['deductable'];?>" >
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
										                   		<input type="text" class="form-control"  name="model[any_one_illness][comments]" placeholder ="Max 100 Char" maxlength="100" placeholder ="Max 100 Char" maxlength="100" value="<?php echo $arrValues['comments'];?>" >
										                    </div>            
										                </div>	
									                </div>
								                </div>
											</td>
										</tr>
										
										
										<tr>
											<th class="spec" scope="row" width="234" valign="top"><strong>Any one accident</strong></th>
											<td width="510" valign="top" colspan="2">
								                <div class="row">
												<?php
													$default = array('covered'=>'no', 'amount'=>'', 'deductable'=>'', 'comments'=>'');
													$arrValues = array_key_exists( 'any_one_accident',$model) ? unserialize($model['any_one_accident']) : $default;
													$arrValues = Util::array_overlay($default, $arrValues);
													$selected = $arrValues['covered'];
								                ?>
								                    <div class="col-sm-12"> 
									                    <?php 
															$options = array('yes'=>'Yes', 'no'=>'No');		
															foreach ($options as $k1=>$v1)
															{
																$op = array(
																    'class'       => 'showHideNextDivByRadio',
																    'name'        => 'model[any_one_accident][covered]',
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
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Covered Upto</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control numberValidation" name="model[any_one_accident][amount]" value="<?php echo $arrValues['amount'];?>" >
											                    </div>              
											                </div>			
											                <div class="col-sm-6">
											                    <div class="col-sm-6"> 
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Deductable Upto</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control numberValidation" name="model[any_one_accident][deductable]" value="<?php echo $arrValues['deductable'];?>" >
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
										                   		<input type="text" class="form-control"  name="model[any_one_accident][comments]" placeholder ="Max 100 Char" maxlength="100" placeholder ="Max 100 Char" maxlength="100" value="<?php echo $arrValues['comments'];?>" >
										                    </div>            
										                </div>	
									                </div>
								                </div>
											</td>
										</tr>
										
										
										
										<tr>
											<th class="spec" scope="row" width="234" valign="top"><strong>Tution Fees</strong></th>
											<td width="510" valign="top" colspan="2">
								                <div class="row">
												<?php
													$default = array('covered'=>'no', 'amount'=>'', 'deductable'=>'', 'comments'=>'');
													$arrValues = array_key_exists( 'tution_fees',$model) ? unserialize($model['tution_fees']) : $default;
													$arrValues = Util::array_overlay($default, $arrValues);
													$selected = $arrValues['covered'];
								                ?>
								                    <div class="col-sm-12"> 
									                    <?php 
															$options = array('yes'=>'Yes', 'no'=>'No');		
															foreach ($options as $k1=>$v1)
															{
																$op = array(
																    'class'       => 'showHideNextDivByRadio',
																    'name'        => 'model[tution_fees][covered]',
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
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Covered Upto</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control numberValidation" name="model[tution_fees][amount]" value="<?php echo $arrValues['amount'];?>" >
											                    </div>              
											                </div>			
											                <div class="col-sm-6">
											                    <div class="col-sm-6"> 
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Deductable Upto</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control numberValidation" name="model[tution_fees][deductable]" value="<?php echo $arrValues['deductable'];?>" >
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
										                   		<input type="text" class="form-control"  name="model[tution_fees][comments]" placeholder ="Max 100 Char" maxlength="100" placeholder ="Max 100 Char" maxlength="100" value="<?php echo $arrValues['comments'];?>" >
										                    </div>            
										                </div>	
									                </div>
								                </div>
											</td>
										</tr>
										
										
										<tr>
											<th class="spec" scope="row" width="234" valign="top"><strong>Accident to Sponsor</strong></th>
											<td width="510" valign="top" colspan="2">
								                <div class="row">
												<?php
													$default = array('covered'=>'no', 'amount'=>'', 'deductable'=>'', 'comments'=>'');
													$arrValues = array_key_exists( 'accident_to_sponsor',$model) ? unserialize($model['accident_to_sponsor']) : $default;
													$arrValues = Util::array_overlay($default, $arrValues);
													$selected = $arrValues['covered'];
								                ?>
								                    <div class="col-sm-12"> 
									                    <?php 
															$options = array('yes'=>'Yes', 'no'=>'No');		
															foreach ($options as $k1=>$v1)
															{
																$op = array(
																    'class'       => 'showHideNextDivByRadio',
																    'name'        => 'model[accident_to_sponsor][covered]',
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
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Covered Upto</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control numberValidation" name="model[accident_to_sponsor][amount]" value="<?php echo $arrValues['amount'];?>" >
											                    </div>              
											                </div>			
											                <div class="col-sm-6">
											                    <div class="col-sm-6"> 
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Deductable Upto</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control numberValidation" name="model[accident_to_sponsor][deductable]" value="<?php echo $arrValues['deductable'];?>" >
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
										                   		<input type="text" class="form-control"  name="model[accident_to_sponsor][comments]" placeholder ="Max 100 Char" maxlength="100" placeholder ="Max 100 Char" maxlength="100" value="<?php echo $arrValues['comments'];?>" >
										                    </div>            
										                </div>	
									                </div>
								                </div>
											</td>
										</tr>
										
										
										<tr>
											<th class="spec" scope="row" width="234" valign="top"><strong>Family Visit</strong></th>
											<td width="510" valign="top" colspan="2">
								                <div class="row">
												<?php
													$default = array('covered'=>'no', 'amount'=>'', 'deductable'=>'', 'comments'=>'');
													$arrValues = array_key_exists( 'family_visit',$model) ? unserialize($model['family_visit']) : $default;
													$arrValues = Util::array_overlay($default, $arrValues);
													$selected = $arrValues['covered'];
								                ?>
								                    <div class="col-sm-12"> 
									                    <?php 
															$options = array('yes'=>'Yes', 'no'=>'No');		
															foreach ($options as $k1=>$v1)
															{
																$op = array(
																    'class'       => 'showHideNextDivByRadio',
																    'name'        => 'model[family_visit][covered]',
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
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Covered Upto</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control numberValidation" name="model[family_visit][amount]" value="<?php echo $arrValues['amount'];?>" >
											                    </div>              
											                </div>			
											                <div class="col-sm-6">
											                    <div class="col-sm-6"> 
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Deductable Upto</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control numberValidation" name="model[family_visit][deductable]" value="<?php echo $arrValues['deductable'];?>" >
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
										                   		<input type="text" class="form-control"  name="model[family_visit][comments]" placeholder ="Max 100 Char" maxlength="100" placeholder ="Max 100 Char" maxlength="100" value="<?php echo $arrValues['comments'];?>" >
										                    </div>            
										                </div>	
									                </div>
								                </div>
											</td>
										</tr>
										
										
										<tr>
											<th class="spec" scope="row" width="234" valign="top"><strong>International Driving License Loss</strong></th>
											<td width="510" valign="top" colspan="2">
								                <div class="row">
												<?php
													$default = array('covered'=>'no', 'amount'=>'', 'deductable'=>'', 'comments'=>'');
													$arrValues = array_key_exists( 'international_driving_license_loss',$model) ? unserialize($model['international_driving_license_loss']) : $default;
													$arrValues = Util::array_overlay($default, $arrValues);
													$selected = $arrValues['covered'];
								                ?>
								                    <div class="col-sm-12"> 
									                    <?php 
															$options = array('yes'=>'Yes', 'no'=>'No');		
															foreach ($options as $k1=>$v1)
															{
																$op = array(
																    'class'       => 'showHideNextDivByRadio',
																    'name'        => 'model[international_driving_license_loss][covered]',
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
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Covered Upto</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control numberValidation" name="model[international_driving_license_loss][amount]" value="<?php echo $arrValues['amount'];?>" >
											                    </div>              
											                </div>			
											                <div class="col-sm-6">
											                    <div class="col-sm-6"> 
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Deductable Upto</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control numberValidation" name="model[international_driving_license_loss][deductable]" value="<?php echo $arrValues['deductable'];?>" >
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
										                   		<input type="text" class="form-control"  name="model[international_driving_license_loss][comments]" placeholder ="Max 100 Char" maxlength="100" placeholder ="Max 100 Char" maxlength="100" value="<?php echo $arrValues['comments'];?>" >
										                    </div>            
										                </div>	
									                </div>
								                </div>
											</td>
										</tr>
										
										<tr>
											<th class="spec" scope="row" width="234" valign="top"><strong>Re Union Expenses</strong></th>
											<td width="510" valign="top" colspan="2">
								                <div class="row">
												<?php
													$default = array('covered'=>'no', 'amount'=>'', 'deductable'=>'', 'comments'=>'');
													$arrValues = array_key_exists( 'reunion_expenses',$model) ? unserialize($model['reunion_expenses']) : $default;
													$arrValues = Util::array_overlay($default, $arrValues);
													$selected = $arrValues['covered'];
								                ?>
								                    <div class="col-sm-12"> 
									                    <?php 
															$options = array('yes'=>'Yes', 'no'=>'No');		
															foreach ($options as $k1=>$v1)
															{
																$op = array(
																    'class'       => 'showHideNextDivByRadio',
																    'name'        => 'model[reunion_expenses][covered]',
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
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Covered Upto</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control numberValidation" name="model[reunion_expenses][amount]" value="<?php echo $arrValues['amount'];?>" >
											                    </div>              
											                </div>			
											                <div class="col-sm-6">
											                    <div class="col-sm-6"> 
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Deductable Upto</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control numberValidation" name="model[reunion_expenses][deductable]" value="<?php echo $arrValues['deductable'];?>" >
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
										                   		<input type="text" class="form-control"  name="model[reunion_expenses][comments]" placeholder ="Max 100 Char" maxlength="100" placeholder ="Max 100 Char" maxlength="100" value="<?php echo $arrValues['comments'];?>" >
										                    </div>            
										                </div>	
									                </div>
								                </div>
											</td>
										</tr>
										
										<tr>
											<th class="spec" scope="row" width="234" valign="top"><strong>Transportation Of Mortal Remains</strong></th>
											<td width="510" valign="top" colspan="2">
								                <div class="row">
												<?php
													$default = array('covered'=>'no', 'amount'=>'', 'deductable'=>'', 'comments'=>'');
													$arrValues = array_key_exists( 'transportation_of_mortal_remains',$model) ? unserialize($model['transportation_of_mortal_remains']) : $default;
													$arrValues = Util::array_overlay($default, $arrValues);
													$selected = $arrValues['covered'];
								                ?>
								                    <div class="col-sm-12"> 
									                    <?php 
															$options = array('yes'=>'Yes', 'no'=>'No');		
															foreach ($options as $k1=>$v1)
															{
																$op = array(
																    'class'       => 'showHideNextDivByRadio',
																    'name'        => 'model[transportation_of_mortal_remains][covered]',
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
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Covered Upto</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control numberValidation" name="model[transportation_of_mortal_remains][amount]" value="<?php echo $arrValues['amount'];?>" >
											                    </div>              
											                </div>			
											                <div class="col-sm-6">
											                    <div class="col-sm-6"> 
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Deductable Upto</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control numberValidation" name="model[transportation_of_mortal_remains][deductable]" value="<?php echo $arrValues['deductable'];?>" >
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
										                   		<input type="text" class="form-control"  name="model[transportation_of_mortal_remains][comments]" placeholder ="Max 100 Char" maxlength="100" placeholder ="Max 100 Char" maxlength="100" value="<?php echo $arrValues['comments'];?>" >
										                    </div>            
										                </div>	
									                </div>
								                </div>
											</td>
										</tr>
										
										<tr>
											<th class="spec" scope="row" width="234" valign="top"><strong>PED</strong></th>
											<td width="510" valign="top" colspan="2">
								                <div class="row">
												<?php
													$default = array('covered'=>'no', 'amount'=>'', 'deductable'=>'', 'comments'=>'');
													$arrValues = array_key_exists( 'ped',$model) ? unserialize($model['ped']) : $default;
													$arrValues = Util::array_overlay($default, $arrValues);
													$selected = $arrValues['covered'];
								                ?>
								                    <div class="col-sm-12"> 
									                    <?php 
															$options = array('yes'=>'Yes', 'no'=>'No');		
															foreach ($options as $k1=>$v1)
															{
																$op = array(
																    'class'       => 'showHideNextDivByRadio',
																    'name'        => 'model[ped][covered]',
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
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Covered Upto</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control numberValidation" name="model[ped][amount]" value="<?php echo $arrValues['amount'];?>" >
											                    </div>              
											                </div>			
											                <div class="col-sm-6">
											                    <div class="col-sm-6"> 
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Deductable Upto</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control numberValidation" name="model[ped][deductable]" value="<?php echo $arrValues['deductable'];?>" >
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
										                   		<input type="text" class="form-control"  name="model[ped][comments]" placeholder ="Max 100 Char" maxlength="100" placeholder ="Max 100 Char" maxlength="100" value="<?php echo $arrValues['comments'];?>" >
										                    </div>            
										                </div>	
									                </div>
								                </div>
											</td>
										</tr>
										
										
										
										<tr>
											<th class="spec" scope="row" width="234" valign="top"><strong>Additioal SI for Accidental Hospitalization</strong></th>
											<td width="510" valign="top" colspan="2">
								                <div class="row">
												<?php
													$default = array('covered'=>'no', 'amount'=>'', 'deductable'=>'', 'comments'=>'');
													$arrValues = array_key_exists( 'additioal_si_for_accidental_hospitalization',$model) ? unserialize($model['additioal_si_for_accidental_hospitalization']) : $default;
													$arrValues = Util::array_overlay($default, $arrValues);
													$selected = $arrValues['covered'];
								                ?>
								                    <div class="col-sm-12"> 
									                    <?php 
															$options = array('yes'=>'Yes', 'no'=>'No');		
															foreach ($options as $k1=>$v1)
															{
																$op = array(
																    'class'       => 'showHideNextDivByRadio',
																    'name'        => 'model[additioal_si_for_accidental_hospitalization][covered]',
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
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Covered Upto</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control numberValidation" name="model[additioal_si_for_accidental_hospitalization][amount]" value="<?php echo $arrValues['amount'];?>" >
											                    </div>              
											                </div>			
											                <div class="col-sm-6">
											                    <div class="col-sm-6"> 
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Deductable Upto</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control numberValidation" name="model[additioal_si_for_accidental_hospitalization][deductable]" value="<?php echo $arrValues['deductable'];?>" >
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
										                   		<input type="text" class="form-control"  name="model[additioal_si_for_accidental_hospitalization][comments]" placeholder ="Max 100 Char" maxlength="100" placeholder ="Max 100 Char" maxlength="100" value="<?php echo $arrValues['comments'];?>" >
										                    </div>            
										                </div>	
									                </div>
								                </div>
											</td>
										</tr>
										
										
										
										<tr>
											<th class="spec" scope="row" width="234" valign="top"><strong>Out Patient care</strong></th>
											<td width="510" valign="top" colspan="2">
								                <div class="row">
												<?php
													$default = array('covered'=>'no', 'amount'=>'', 'deductable'=>'', 'comments'=>'');
													$arrValues = array_key_exists( 'out_patient_care',$model) ? unserialize($model['out_patient_care']) : $default;
													$arrValues = Util::array_overlay($default, $arrValues);
													$selected = $arrValues['covered'];
								                ?>
								                    <div class="col-sm-12"> 
									                    <?php 
															$options = array('yes'=>'Yes', 'no'=>'No');		
															foreach ($options as $k1=>$v1)
															{
																$op = array(
																    'class'       => 'showHideNextDivByRadio',
																    'name'        => 'model[out_patient_care][covered]',
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
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Covered Upto</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control numberValidation" name="model[out_patient_care][amount]" value="<?php echo $arrValues['amount'];?>" >
											                    </div>              
											                </div>			
											                <div class="col-sm-6">
											                    <div class="col-sm-6"> 
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Deductable Upto</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control numberValidation" name="model[out_patient_care][deductable]" value="<?php echo $arrValues['deductable'];?>" >
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
										                   		<input type="text" class="form-control"  name="model[out_patient_care][comments]" placeholder ="Max 100 Char" maxlength="100" placeholder ="Max 100 Char" maxlength="100" value="<?php echo $arrValues['comments'];?>" >
										                    </div>            
										                </div>	
									                </div>
								                </div>
											</td>
										</tr>
										
										
										
										<tr>
											<th class="spec" scope="row" width="234" valign="top"><strong>Business Class</strong></th>
											<td width="510" valign="top" colspan="2">
								                <div class="row">
												<?php
													$default = array('covered'=>'no', 'amount'=>'', 'deductable'=>'', 'comments'=>'');
													$arrValues = array_key_exists( 'business_class',$model) ? unserialize($model['business_class']) : $default;
													$arrValues = Util::array_overlay($default, $arrValues);
													$selected = $arrValues['covered'];
								                ?>
								                    <div class="col-sm-12"> 
									                    <?php 
															$options = array('yes'=>'Yes', 'no'=>'No');		
															foreach ($options as $k1=>$v1)
															{
																$op = array(
																    'class'       => 'showHideNextDivByRadio',
																    'name'        => 'model[business_class][covered]',
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
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Covered Upto</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control numberValidation" name="model[business_class][amount]" value="<?php echo $arrValues['amount'];?>" >
											                    </div>              
											                </div>			
											                <div class="col-sm-6">
											                    <div class="col-sm-6"> 
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Deductable Upto</label>
											                    </div>  
											                    <div class="col-sm-6">
											                        <input type="text" class="form-control numberValidation" name="model[business_class][deductable]" value="<?php echo $arrValues['deductable'];?>" >
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
										                   		<input type="text" class="form-control"  name="model[business_class][comments]" placeholder ="Max 100 Char" maxlength="100" placeholder ="Max 100 Char" maxlength="100" value="<?php echo $arrValues['comments'];?>" >
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
$(function(){
	  //$("input:radio").click();
	});
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
		if(curVal == 'lifelong' || curVal == 'no limit' || curVal == 'no' || curVal == 'actual rent')
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