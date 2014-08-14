
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
			                	<?php echo widget::run('eligibilityConditionsBack', array('model'=>$model)); ?>
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
												<th colspan="2">Basic Benefits</th>
											</tr>
										</thead>
										<tbody>

											<tr>
												<th class="spec" scope="row" width="234" valign="top">Cashless treatment</th>
												<td width="510" valign="top">
													<?php 
														$default = array('hospitals'=>'', 'cities'=>'');
														$arrValues = array_key_exists( 'cashless_treatment',$model) ? unserialize($model['cashless_treatment']) : $default;
														$arrValues = Util::array_overlay($default, $arrValues);
													?>																	
									                <div class="row">
									                    <div class="col-sm-3">
									                        <input type="number" class="form-control col-sm-3 numberValidation" placeholder="" name="model[cashless_treatment][hospitals]" value="<?php echo $arrValues['hospitals'];?>">
									                    </div>
									                    <div class="col-sm-3"> 
									                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">hospitls across </label>
									                    </div>
									                    <div class="col-sm-3">
									                        <input type="number" class="form-control col-sm-3 numberValidation" placeholder="" name="model[cashless_treatment][cities]" value="<?php echo $arrValues['cities'];?>">
									                    </div>       
									                    <div class="col-sm-3"> 
									                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">cities </label>
									                    </div>                 
									                </div>		
												</td>
											</tr>
											
											<tr>
												<th class="specalt" scope="row" width="234" valign="top">Pre-existing diseases</th>
												<td width="510" valign="top">																
									                <div class="row">
									                    <div class="col-sm-3">
									                        <input type="text" class="form-control col-sm-3 numberValidation" placeholder="" name="model[preexisting_diseases]" value="<?php echo array_key_exists( 'preexisting_diseases',$model) ? $model['preexisting_diseases'] : '';?>">
									                    </div>
									                    <div class="col-sm-3"> 
									                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;"><?php echo ((int)reset($arrValues) > 1) ? ' years': 'year';?> </label>
									                    </div>              
									                </div>	
												</td>
											</tr>
											

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
												<td width="510" valign="top">
									                <div class="row">
													<?php
														$default = array('covered'=>'', 'percent'=>'', 'days'=>'','amount'=>'', 'comments'=>'');
														$arrValues = array_key_exists( 'pre_hosp',$model) ? unserialize($model['pre_hosp']) : $default;
														$arrValues = Util::array_overlay($default, $arrValues);
														$selected = $arrValues['covered'];
									                ?>
									                    <div class="col-sm-12"> 
										                    <?php 
																$options = array('yes'=>'Covered', 'no'=>'Not Covered');		
																foreach ($options as $k1=>$v1)
																{
																	$op = array(
																	    'class'       => 'showHideNextDivByRadio',
																	    'name'        => 'model[pre_hosp][covered]',
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
												                    <div class="col-sm-4"> 
												                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Percent</label>
												                    </div>  
												                    <div class="col-sm-8">
												                        <input type="text" class="form-control" maxlength="3" placeholder="" name="model[pre_hosp][percent]" value="<?php echo $arrValues['percent'];?>" >
												                    </div>              
												                </div>				
												                <div class="col-sm-4">
												                    <div class="col-sm-4"> 
												                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Max Amount</label>
												                    </div>  
												                    <div class="col-sm-8">
												                        <input type="text" class="form-control numberValidation" placeholder="" name="model[pre_hosp][amount]" value="<?php echo $arrValues['amount'];?>" >
												                    </div>              
												                </div>				
												                <div class="col-sm-4">
												                    <div class="col-sm-4"> 
												                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Days</label>
												                    </div>  
												                    <div class="col-sm-8">
												                        <input type="text" class="form-control numberValidation" maxlength="3" placeholder="" name="model[pre_hosp][days]" value="<?php echo $arrValues['days'];?>" >
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
											                   		<input type="text" class="form-control"  placeholder="" name="model[pre_hosp][comments]" value="<?php echo $arrValues['comments'];?>" >
											                    </div>            
											                </div>	
										                </div>
									                </div> 
												</td>
											</tr>
											
											<tr>
												<th class="spec" scope="row" width="234" valign="top"><strong>Post-hospitalisation</strong></th>
												<td width="510" valign="top">
									                <div class="row">
													<?php
														$default = array('covered'=>'', 'percent'=>'', 'days'=>'','amount'=>'', 'comments'=>'');
														$arrValues = array_key_exists( 'post_hosp',$model) ? unserialize($model['post_hosp']) : $default;
														$arrValues = Util::array_overlay($default, $arrValues);
														$selected = $arrValues['covered'];
									                ?>
									                    <div class="col-sm-12"> 
										                    <?php 
																$options = array('yes'=>'Covered', 'no'=>'Not Covered');		
																foreach ($options as $k1=>$v1)
																{
																	$op = array(
																	    'class'       => 'showHideNextDivByRadio',
																	    'name'        => 'model[post_hosp][covered]',
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
												                    <div class="col-sm-4"> 
												                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Percent</label>
												                    </div>  
												                    <div class="col-sm-8">
												                        <input type="text" class="form-control" maxlength="3" placeholder="" name="model[post_hosp][percent]" value="<?php echo $arrValues['percent'];?>" >
												                    </div>              
												                </div>				
												                <div class="col-sm-4">
												                    <div class="col-sm-4"> 
												                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Max Amount</label>
												                    </div>  
												                    <div class="col-sm-8">
												                        <input type="text" class="form-control numberValidation" placeholder="" name="model[post_hosp][amount]" value="<?php echo $arrValues['amount'];?>" >
												                    </div>              
												                </div>				
												                <div class="col-sm-4">
												                    <div class="col-sm-4"> 
												                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Days</label>
												                    </div>  
												                    <div class="col-sm-8">
												                        <input type="text" class="form-control numberValidation" placeholder="" name="model[post_hosp][days]" value="<?php echo $arrValues['days'];?>" >
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
											                   		<input type="text" class="form-control"  placeholder="" name="model[post_hosp][comments]" value="<?php echo $arrValues['comments'];?>" >
											                    </div>            
											                </div>	
										                </div>
									                </div> 
												</td>
											</tr>
											<tr>
												<th class="specalt" scope="row" width="234" valign="top"><strong>Day care expenses</strong></th>
												<td width="510" valign="top">
									                <div class="row">
													<?php
														$default = array('covered'=>'', 'day_care'=>'', 'comments'=>'');
														$arrValues = array_key_exists( 'day_care',$model) ? unserialize($model['day_care']) : $default;
														$arrValues = Util::array_overlay($default, $arrValues);
														$selected = $arrValues['covered'];
									                ?>
									                    <div class="col-sm-12"> 
										                    <?php 
																$options = array('yes'=>'Covered', 'all'=>'All', 'specific'=>'Specific', 'no'=>'Not Covered');		
																foreach ($options as $k1=>$v1)
																{
																	$op = array(
																	    'class'       => 'showHideNextDivByRadio',
																	    'name'        => 'model[day_care][covered]',
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
												                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Percent</label>
												                    </div>  
												                    <div class="col-sm-6">
												                        <input type="text" class="form-control" maxlength="3" placeholder="" name="model[day_care][day_care]" value="<?php echo $arrValues['day_care'];?>" >
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
											                   		<input type="text" class="form-control"  placeholder="" name="model[day_care][comments]" value="<?php echo $arrValues['comments'];?>" >
											                    </div>            
											                </div>	
										                </div>
									                </div>
												</td>
											</tr>
											<tr>
												<th class="spec" scope="row" width="234" valign="top">Maternity Benefits</th>
												<td width="510" valign="top">
											<?php 	$maternitySelected = array_key_exists( 'maternity',$model) ? $model['maternity'] : '';
													$options = array('yes'=>'Yes', 'no'=>'No');		
													foreach ($options as $k1=>$v1)
													{
														$op = array(
														    'class'        => 'maternityBenefit',
														    'name'        => 'model[maternity]',
														    'value'       => $k1,
														    'checked'     => ($maternitySelected == $k1) ? TRUE : FALSE,
														    'style'       => 'margin:10px',
														    );
														echo '<label class="ui-radio">'.form_radio($op).'<span>'.$v1.'</span></label>';
													}
													?>
												</td>
											</tr>	
											<tr>
												<th class="spec" scope="row" width="234" valign="top">Health Check up</th>
												<td width="510" valign="top"><input type="text" class="form-control"  placeholder="" name="model[check_up]" value="<?php echo array_key_exists( 'check_up',$model) ? $model['check_up'] : '';?>" ></td>
											</tr>
											<tr>
												<th class="spec" scope="row" width="234" valign="top">Ayurvedic Treatment</th>
												<td width="510" valign="top">
												
									                <div class="row">
													<?php
														$default = array('covered'=>'', 'percent'=>'', 'amount'=>'', 'comments'=>'');
														$arrValues = array_key_exists( 'ayurvedic',$model) ? unserialize($model['ayurvedic']) : $default;
														$arrValues = Util::array_overlay($default, $arrValues);
														$selected = $arrValues['covered'];
									                ?>
									                    <div class="col-sm-12"> 
										                    <?php 
																$options = array('yes'=>'Covered', 'no'=>'Not Covered');		
																foreach ($options as $k1=>$v1)
																{
																	$op = array(
																	    'class'       => 'showHideNextDivByRadio',
																	    'name'        => 'model[ayurvedic][covered]',
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
												                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Percent</label>
												                    </div>  
												                    <div class="col-sm-6">
												                        <input type="text" class="form-control" maxlength="3" placeholder="" name="model[ayurvedic][percent]" value="<?php echo $arrValues['percent'];?>" >
												                    </div>              
												                </div>	
												                <div class="col-sm-6">
												                    <div class="col-sm-6"> 
												                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Amount</label>
												                    </div>  
												                    <div class="col-sm-6">
												                        <input type="text" class="form-control numberValidation"  placeholder="" name="model[ayurvedic][amount]" value="<?php echo $arrValues['amount'];?>" >
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
											                   		<input type="text" class="form-control"  placeholder="" name="model[ayurvedic][comments]" value="<?php echo $arrValues['comments'];?>" >
											                    </div>            
											                </div>	
										                </div>
									                </div>	
												
												</td>
												
											</tr>
											<tr>
												<th class="specalt" scope="row" width="234" valign="top">Co-payment</th>
												<td width="510" valign="top">
												
									                <div class="row">
													<?php
														$default = array('covered'=>'', 'percent'=>'', 'amount'=>'', 'comments'=>'');
														$arrValues = array_key_exists( 'co_pay',$model) ? unserialize($model['co_pay']) : $default;
														$arrValues = Util::array_overlay($default, $arrValues);
														$selected = $arrValues['covered'];
									                ?>
									                    <div class="col-sm-12"> 
										                    <?php 
																$options = array('yes'=>'Covered', 'no'=>'Not Covered');		
																foreach ($options as $k1=>$v1)
																{
																	$op = array(
																	    'class'       => 'showHideNextDivByRadio',
																	    'name'        => 'model[co_pay][covered]',
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
												                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Percent</label>
												                    </div>  
												                    <div class="col-sm-6">
												                        <input type="text" class="form-control" maxlength="3" placeholder="" name="model[co_pay][percent]" value="<?php echo $arrValues['percent'];?>" >
												                    </div>              
												                </div>	
												                <div class="col-sm-6">
												                    <div class="col-sm-6"> 
												                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Amount</label>
												                    </div>  
												                    <div class="col-sm-6">
												                        <input type="text" class="form-control numberValidation"  placeholder="" name="model[co_pay][amount]" value="<?php echo $arrValues['amount'];?>" >
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
											                   		<input type="text" class="form-control"  placeholder="" name="model[co_pay][comments]" value="<?php echo $arrValues['comments'];?>" >
											                    </div>            
											                </div>	
										                </div>
									                </div>	
												</td>
											</tr>
											
										</tbody>
									</table>
			
			                <div class="maternityBenefitClass">
			                
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
												<th class="spec" scope="row" width="234" valign="top">Waiting Period</th>
												<td width="510" valign="top">
													<?php 
														$str = array_key_exists( 'maternity_waiting_period',$model) ? $model['maternity_waiting_period'] : '';
													?>																	
									                <div class="row">
									                    <div class="col-sm-3"> 
									                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: right;">Covered after</label>
									                    </div>  
									                    <div class="col-sm-3">
									                        <input type="text" class="form-control col-sm-3 numberValidation" placeholder="" name="model[maternity_waiting_period]" value="<?php echo $str;?>">
									                    </div>  
									                    <div class="col-sm-3"> 
									                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Years </label>
									                    </div>            
									                </div>	
												</td>
											</tr>
											
											<tr>
												<th class="specalt" scope="row" width="234" valign="top">Normal Delivery</th>
												<td width="510" valign="top">
												<?php 
													$default = array('percent'=>'', 'amount'=>'', 'comments'=>'');
													$arrValues = array_key_exists( 'maternity_normal_delivery',$model) ? unserialize($model['maternity_normal_delivery']) : $default;
													$arrValues = Util::array_overlay($default, $arrValues);
												?>				
													<div class="row" >						
										                <div class="col-sm-6">
										                    <div class="col-sm-6"> 
										                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Percent</label>
										                    </div>  
										                    <div class="col-sm-6">
										                        <input type="text" class="form-control numberValidation" maxlength="3" placeholder="" name="model[maternity_normal_delivery][percent]" value="<?php echo $arrValues['percent'];?>" >
										                    </div>            
										                </div>	
										                <div class="col-sm-6">
										                    <div class="col-sm-6"> 
										                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Amount</label>
										                    </div>  
										                    <div class="col-sm-6">
										                        <input type="text" class="form-control numberValidation"  placeholder="" name="model[maternity_normal_delivery][amount]" value="<?php echo $arrValues['amount'];?>" >
										                    </div>            
										                </div>
									                </div>
									                <div class="divider"></div> 
													<div class="row" >						
										                <div class="col-sm-12">
										                    <div class="col-sm-2"> 
										                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Comments</label>
										                    </div>  
										                    <div class="col-sm-10">
										                        <input type="text" class="form-control"  placeholder="" name="model[maternity_normal_delivery][comments]" value="<?php echo $arrValues['comments'];?>" >
										                    </div>            
										                </div>	
									                </div>
												</td>
											</tr>
											<tr>
												<th class="spec" scope="row" width="234" valign="top">Caesarean Delivery</th>
												<td width="510" valign="top">
												<?php 
													$arrValues = array_key_exists( 'maternity_caesarean_delivery',$model) ? unserialize($model['maternity_caesarean_delivery']) : $default;
													$arrValues = Util::array_overlay($default, $arrValues);
												?>				
													<div class="row" >						
										                <div class="col-sm-6">
										                    <div class="col-sm-6"> 
										                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Percent</label>
										                    </div>  
										                    <div class="col-sm-6">
										                        <input type="text" class="form-control numberValidation" maxlength="3" placeholder="" name="model[maternity_caesarean_delivery][percent]" value="<?php echo $arrValues['percent'];?>" >
										                    </div>            
										                </div>	
										                <div class="col-sm-6">
										                    <div class="col-sm-6"> 
										                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Amount</label>
										                    </div>  
										                    <div class="col-sm-6">
										                        <input type="text" class="form-control numberValidation"  placeholder="" name="model[maternity_caesarean_delivery][amount]" value="<?php echo $arrValues['amount'];?>" >
										                    </div>            
										                </div>
									                </div>
									                <div class="divider"></div> 
													<div class="row" >						
										                <div class="col-sm-12">
										                    <div class="col-sm-2"> 
										                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Comments</label>
										                    </div>  
										                    <div class="col-sm-10">
										                        <input type="text" class="form-control"  placeholder="" name="model[maternity_caesarean_delivery][comments]" value="<?php echo $arrValues['comments'];?>" >
										                    </div>            
										                </div>	
									                </div>
												</td>
											</tr>
											<tr>
												<th class="specalt" scope="row" width="234" valign="top">New-born baby expenses cover</th>
												<td width="510" valign="top">
												
									                <div class="row">
													<?php
														$default = array('covered'=>'', 'percent'=>'', 'amount'=>'', 'coverage_period'=>'', 'coverage_in'=>'', 'comments'=>'');
														$arrValues = array_key_exists( 'maternity_new_born_baby_cover',$model) ? unserialize($model['maternity_new_born_baby_cover']) : $default;
														$arrValues = Util::array_overlay($default, $arrValues);
														$selected = $arrValues['covered'];
									                ?>
									                    <div class="col-sm-12"> 
										                    <?php 
																$options = array('yes'=>'Covered', 'no'=>'Not Covered', 'optional'=>'Optional');		
																foreach ($options as $k1=>$v1)
																{
																	$op = array(
																	    'class'       => 'showHideNextDivByRadio',
																	    'name'        => 'model[maternity_new_born_baby_cover][covered]',
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
												                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Percent</label>
												                    </div>  
												                    <div class="col-sm-6">
												                        <input type="text" class="form-control numberValidation" maxlength="3" placeholder="" name="model[maternity_new_born_baby_cover][percent]" value="<?php echo $arrValues['percent'];?>" >
												                    </div>            
												                </div>	
												                <div class="col-sm-6">
												                    <div class="col-sm-6"> 
												                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Amount</label>
												                    </div>  
												                    <div class="col-sm-6">
												                        <input type="text" class="form-control numberValidation"  placeholder="" name="model[maternity_new_born_baby_cover][amount]" value="<?php echo $arrValues['amount'];?>" >
												                    </div>            
												                </div>
												            </div>
											                <div class="divider"></div> 
												            <div class="row" > 
												                <div class="col-sm-6">
												                    <div class="col-sm-6"> 
												                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Coverage Period</label>
												                    </div>  
												                    <div class="col-sm-6">
												                        <input type="text" class="form-control numberValidation"  placeholder="" name="model[maternity_new_born_baby_cover][coverage_period]" value="<?php echo $arrValues['coverage_period'];?>" >
												                    </div>            
												                </div>
												                <div class="col-sm-6">
												                    <div class="col-sm-4"> 
												                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Coverage In</label>
												                    </div>  
												                    <div class="col-sm-8">
												                    <?php 
																		$options = array('days'=>'Days', 'years'=>'Years');
																		$selected = $arrValues['coverage_in'];		
																		foreach ($options as $k1=>$v1)
																		{
																			$op = array(
																			    'name'        => 'model[maternity_new_born_baby_cover][coverage_in]',
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
									                    </div>    
									                    <br clear="all">
										                <div class="divider"></div> 
														<div class="row" >						
											                <div class="col-sm-12">
											                    <div class="col-sm-2"> 
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Comments</label>
											                    </div>  
											                    <div class="col-sm-10">
											                   		<input type="text" class="form-control"  placeholder="" name="model[maternity_new_born_baby_cover][comments]" value="<?php echo $arrValues['comments'];?>" >
											                    </div>            
											                </div>	
										                </div>
										                         
									                </div>	
												</td>
											</tr>
											<tr>
												<th class="spec" scope="row" width="234" valign="top">Addition of New-born</th>
												<td width="510" valign="top">
												
									                <div class="row">
													<?php
														$default = array('covered'=>'', 'percent'=>'', 'amount'=>'', 'coverage_period_from'=>'', 'coverage_period_from_in'=>'', 'coverage_period_to'=>'', 'coverage_period_to_in'=>'', 'comments'=>'');
														$arrValues = array_key_exists( 'maternity_addition_of_new_born',$model) ? unserialize($model['maternity_addition_of_new_born']) : $default;
														$arrValues = Util::array_overlay($default, $arrValues);
														$selected = $arrValues['covered'];
									                ?>
									                    <div class="col-sm-12"> 
										                    <?php 
																$options = array('yes'=>'Covered', 'no'=>'Not Covered');		
																foreach ($options as $k1=>$v1)
																{
																	$op = array(
																	    'class'       => 'showHideNextDivByRadio',
																	    'name'        => 'model[maternity_addition_of_new_born][covered]',
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
												                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Percent</label>
												                    </div>  
												                    <div class="col-sm-6">
												                        <input type="text" class="form-control numberValidation" maxlength="3" placeholder="" name="model[maternity_addition_of_new_born][percent]" value="<?php echo $arrValues['percent'];?>" >
												                    </div>            
												                </div>	
												                <div class="col-sm-6">
												                    <div class="col-sm-6"> 
												                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Amount</label>
												                    </div>  
												                    <div class="col-sm-6">
												                        <input type="text" class="form-control numberValidation"  placeholder="" name="model[maternity_addition_of_new_born][amount]" value="<?php echo $arrValues['amount'];?>" >
												                    </div>            
												                </div>
												            </div>
											                <div class="divider"></div> 
												            <div class="row" > 
												            
												                <div class="col-sm-6">
												                    <div class="col-sm-3"> 
												                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Coverage From</label>
												                    </div>  
												                    <div class="col-sm-4">
												                        <input type="text" class="form-control numberValidation"  placeholder="" name="model[maternity_addition_of_new_born][coverage_period_from]" value="<?php echo $arrValues['coverage_period_from'];?>" >
												                    </div>  
												                    <div class="col-sm-5">
												                    <?php 
																		$options = array('days'=>'Days', 'years'=>'Years');
																		$selected = $arrValues['coverage_period_from_in'];		
																		foreach ($options as $k1=>$v1)
																		{
																			$op = array(
																			    'name'        => 'model[maternity_addition_of_new_born][coverage_period_from_in]',
																			    'value'       => $k1,
																			    'checked'     => ($selected == $k1) ? TRUE : FALSE,
																			    'style'       => 'margin:10px',
																			    );
																			echo '<label class="ui-radio">'.form_radio($op).'<span>'.$v1.'</span></label>';
																		}
																	?>
												                    </div>             
												                </div>
												                
												            
												                <div class="col-sm-6">
												                    <div class="col-sm-3"> 
												                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Coverage To</label>
												                    </div>  
												                    <div class="col-sm-4">
												                        <input type="text" class="form-control numberValidation"  placeholder="" name="model[maternity_addition_of_new_born][coverage_period_to]" value="<?php echo $arrValues['coverage_period_to'];?>" >
												                    </div>  
												                    <div class="col-sm-5">
												                    <?php 
																		$options = array('days'=>'Days', 'years'=>'Years');
																		$selected = $arrValues['coverage_period_to_in'];		
																		foreach ($options as $k1=>$v1)
																		{
																			$op = array(
																			    'name'        => 'model[maternity_addition_of_new_born][coverage_period_to_in]',
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
									                    </div>    
									                    <br clear="all">
										                <div class="divider"></div> 
														<div class="row" >						
											                <div class="col-sm-12">
											                    <div class="col-sm-2"> 
											                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Comments</label>
											                    </div>  
											                    <div class="col-sm-10">
											                   		<input type="text" class="form-control"  placeholder="" name="model[maternity_addition_of_new_born][comments]" value="<?php echo $arrValues['comments'];?>" >
											                    </div>            
											                </div>	
										                </div>
										                         
									                </div>	
												</td>
											</tr>
										</tbody>
									</table>
								</div>	
			<style>
.maternityBenefitClass{
display:<?php echo ($maternitySelected == 'yes') ? 'block' : 'none';?>;
}
</style>	
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
												<td width="510" valign="top">
												
												
									                <div class="row">
													<?php
														$default = array('covered'=>'', 'percent'=>'', 'amount'=>'', 'day_from'=>'', 'day_from_in'=>'', 'day_to'=>'', 'day_to_in'=>'', 'continue_days'=>'', 'max_amount'=>'', 'deductable_days'=>'', 'comments'=>'');
														$arrValues = array_key_exists( 'hospital_cash',$model) ? unserialize($model['hospital_cash']) : $default;
														$arrValues = Util::array_overlay($default, $arrValues);
														$selected = $arrValues['covered'];
									                ?>
									                    <div class="col-sm-12"> 
										                    <?php 
																$options = array('yes'=>'Covered', 'no'=>'Not Covered');		
																foreach ($options as $k1=>$v1)
																{
																	$op = array(
																	    'class'       => 'showHideNextDivByRadio',
																	    'name'        => 'model[hospital_cash][covered]',
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
												                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Percent</label>
												                    </div>  
												                    <div class="col-sm-5">
												                        <input type="text" class="form-control" maxlength="3" placeholder="" name="model[hospital_cash][percent]" value="<?php echo $arrValues['percent'];?>" >
												                    </div> 
												                    <div class="col-sm-3"> 
												                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">per day</label>
												                    </div>             
												                </div>	
												                <div class="col-sm-6">
												                    <div class="col-sm-4"> 
												                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Amount</label>
												                    </div>  
												                    <div class="col-sm-5">
												                        <input type="text" class="form-control numberValidation"  placeholder="" name="model[hospital_cash][amount]" value="<?php echo $arrValues['amount'];?>" >
												                    </div> 
												                    <div class="col-sm-3"> 
												                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">per day</label>
												                    </div>            
												                </div>
												            </div>
											                <div class="divider"></div> 
												            <div class="row" > 
												            
												                <div class="col-sm-7">
												                    <div class="col-sm-4"> 
												                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Cash Allowance From</label>
												                    </div>  
												                    <div class="col-sm-3">
												                        <input type="text" class="form-control numberValidation"  placeholder="" name="model[hospital_cash][day_from]" value="<?php echo $arrValues['day_from'];?>" >
												                    </div>  
												                    <div class="col-sm-5">
												                    <?php 
																		$options = array('days'=>'Days', 'months'=>'Months');
																		$selected = $arrValues['day_from_in'];		
																		foreach ($options as $k1=>$v1)
																		{
																			$op = array(
																			    'name'        => 'model[hospital_cash][day_from_in]',
																			    'value'       => $k1,
																			    'checked'     => ($selected == $k1) ? TRUE : FALSE,
																			    'style'       => 'margin:10px',
																			    );
																			echo '<label class="ui-radio">'.form_radio($op).'<span>'.$v1.'</span></label>';
																		}
																	?>
												                    </div>             
												                </div>
												                
												            
												                <div class="col-sm-5">
												                    <div class="col-sm-2"> 
												                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;"> To</label>
												                    </div>  
												                    <div class="col-sm-4">
												                        <input type="text" class="form-control numberValidation"  placeholder="" name="model[hospital_cash][day_to]" value="<?php echo $arrValues['day_to'];?>" >
												                    </div>  
												                    <div class="col-sm-6">
												                    <?php 
																		$options = array('days'=>'Days', 'months'=>'Months');
																		$selected = $arrValues['day_to_in'];		
																		foreach ($options as $k1=>$v1)
																		{
																			$op = array(
																			    'name'        => 'model[hospital_cash][day_to_in]',
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
											                
											                
											                <div class="divider"></div> 
												            <div class="row" > 
												            
												                <div class="col-sm-4">
												                    <div class="col-sm-6"> 
												                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Continue Hospitalization Days</label>
												                    </div>  
												                    <div class="col-sm-6">
												                        <input type="text" class="form-control numberValidation"  placeholder="" name="model[hospital_cash][continue_days]" value="<?php echo $arrValues['continue_days'];?>" >
												                    </div>             
												                </div>
												                
												            
												                <div class="col-sm-4">
												                    <div class="col-sm-6"> 
												                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Deductable Days</label>
												                    </div>  
												                    <div class="col-sm-6">
												                        <input type="text" class="form-control numberValidation"  placeholder="" name="model[hospital_cash][deductable_days]" value="<?php echo $arrValues['deductable_days'];?>" >
												                    </div>              
												                </div>
												                
												            
												                <div class="col-sm-4">
												                    <div class="col-sm-6"> 
												                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Max Amounts</label>
												                    </div>  
												                    <div class="col-sm-6">
												                        <input type="text" class="form-control numberValidation"  placeholder="" name="model[hospital_cash][max_amount]" value="<?php echo $arrValues['max_amount'];?>" >
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
											                   		<input type="text" class="form-control"  placeholder="" name="model[hospital_cash][comments]" value="<?php echo $arrValues['comments'];?>" >
											                    </div>            
											                </div>	
										                </div>
									                </div>	
												</td>
											</tr>
											<tr>
												<th class="spec" scope="row" width="234" valign="top">Ambulance Charges</th>
												<td width="510" valign="top">
									                <div class="row">
													<?php
														$default = array('covered'=>'', 'percent'=>'', 'amount'=>'', 'comments'=>'');
														$arrValues = array_key_exists( 'emergency_ambulance',$model) ? unserialize($model['emergency_ambulance']) : $default;
														$arrValues = Util::array_overlay($default, $arrValues);
														$selected = $arrValues['covered'];
									                ?>
									                    <div class="col-sm-12"> 
										                    <?php 
																$options = array('yes'=>'Covered', 'no'=>'Not Covered');		
																foreach ($options as $k1=>$v1)
																{
																	$op = array(
																	    'class'       => 'showHideNextDivByRadio',
																	    'name'        => 'model[emergency_ambulance][covered]',
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
												                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Percent</label>
												                    </div>  
												                    <div class="col-sm-5">
												                        <input type="text" class="form-control" maxlength="3" placeholder="" name="model[emergency_ambulance][percent]" value="<?php echo $arrValues['percent'];?>" >
												                    </div> 
												                    <div class="col-sm-3"> 
												                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Per Hospitalization</label>
												                    </div>             
												                </div>	
												                <div class="col-sm-6">
												                    <div class="col-sm-4"> 
												                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Amount</label>
												                    </div>  
												                    <div class="col-sm-5">
												                        <input type="text" class="form-control numberValidation"  placeholder="" name="model[emergency_ambulance][amount]" value="<?php echo $arrValues['amount'];?>" >
												                    </div> 
												                    <div class="col-sm-3"> 
												                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Per Hospitalization</label>
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
											                   		<input type="text" class="form-control"  placeholder="" name="model[emergency_ambulance][comments]" value="<?php echo $arrValues['comments'];?>" >
											                    </div>            
											                </div>	
										                </div>
									                </div>	
									             </td> 
											</tr>
											<tr>
												<th class="specalt" scope="row" width="234" valign="top">Recovery Benefit</th>
												<td width="510" valign="top"><input type="text" class="form-control"  placeholder="" name="model[recovery_benefit]" value="<?php echo array_key_exists( 'recovery_benefit',$model) ? $model['recovery_benefit'] : '';?>" ></td>
											</tr>
											<tr>
												<th class="specalt" scope="row" width="234" valign="top">Organ Donor Cover</th>
												<td width="510" valign="top">
												
									                <div class="row">
													<?php
														$default = array('covered'=>'', 'percent'=>'', 'amount'=>'', 'comments'=>'');
														$arrValues = array_key_exists( 'organ_donor_exp',$model) ? unserialize($model['organ_donor_exp']) : $default;
														$arrValues = Util::array_overlay($default, $arrValues);
														$selected = $arrValues['covered'];
									                ?>
									                    <div class="col-sm-12"> 
										                    <?php 
																$options = array('yes'=>'Covered', 'no'=>'Not Covered');		
																foreach ($options as $k1=>$v1)
																{
																	$op = array(
																	    'class'       => 'showHideNextDivByRadio',
																	    'name'        => 'model[organ_donor_exp][covered]',
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
												                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Percent</label>
												                    </div>  
												                    <div class="col-sm-6">
												                        <input type="text" class="form-control" maxlength="3" placeholder="" name="model[organ_donor_exp][percent]" value="<?php echo $arrValues['percent'];?>" >
												                    </div>              
												                </div>	
												                <div class="col-sm-6">
												                    <div class="col-sm-6"> 
												                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Amount</label>
												                    </div>  
												                    <div class="col-sm-6">
												                        <input type="text" class="form-control numberValidation"  placeholder="" name="model[organ_donor_exp][amount]" value="<?php echo $arrValues['amount'];?>" >
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
											                   		<input type="text" class="form-control"  placeholder="" name="model[organ_donor_exp][comments]" value="<?php echo $arrValues['comments'];?>" >
											                    </div>            
											                </div>	
										                </div>
									                </div>	
												
												</td>
											</tr>
											
											<tr>
												<th class="specalt" scope="row" width="234" valign="top">Second Opinion</th>
												<td width="510" valign="top">
								                    <?php 
														$selected = array_key_exists( 'second_opinion',$model) ? strtolower($model['second_opinion']) : 'no';
														$options = array('yes'=>'Yes', 'no'=>'No');		
														foreach ($options as $k1=>$v1)
														{
															$op = array(
															    'name'        => 'model[second_opinion]',
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
												<th class="spec" scope="row" width="234" valign="top">E-opinion</th>
												<td width="510" valign="top">
												
									                <div class="row">
													<?php
														$default = array('covered'=>'', 'comments'=>'');
														$arrValues = array_key_exists( 'e_opinion',$model) ? unserialize($model['e_opinion']) : $default;
														$arrValues = Util::array_overlay($default, $arrValues);
														$selected = $arrValues['covered'];
									                ?>
									                    <div class="col-sm-12"> 
										                    <?php 
																$options = array('yes'=>'Covered', 'no'=>'Not Covered');		
																foreach ($options as $k1=>$v1)
																{
																	$op = array(
																	    'name'        => 'model[e_opinion][covered]',
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
											                   		<input type="text" class="form-control"  placeholder="" name="model[e_opinion][comments]" value="<?php echo $arrValues['comments'];?>" >
											                    </div>            
											                </div>	
										                </div>
									                </div>	
												</td>
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
												<th class="spec" scope="row" width="234" valign="top"><strong>Domiciliary Hospitalisation</strong></th>
												<td width="510" valign="top">
												
												
									                <div class="row">
													<?php
														$default = array('covered'=>'', 'percent'=>'', 'amount'=>'', 'comments'=>'');
														$arrValues = array_key_exists( 'domiciliary_treatment_expenses',$model) ? unserialize($model['domiciliary_treatment_expenses']) : $default;														
														$arrValues = Util::array_overlay($default, $arrValues);
														$selected = $arrValues['covered'];
									                ?>
									                    <div class="col-sm-12"> 
										                    <?php 
																$options = array('yes'=>'Covered', 'no'=>'Not Covered');		
																foreach ($options as $k1=>$v1)
																{
																	$op = array(
																	    'class'       => 'showHideNextDivByRadio',
																	    'name'        => 'model[domiciliary_treatment_expenses][covered]',
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
												                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Percent</label>
												                    </div>  
												                    <div class="col-sm-6">
												                        <input type="text" class="form-control" maxlength="3" placeholder="" name="model[domiciliary_treatment_expenses][percent]" value="<?php echo $arrValues['percent'];?>" >
												                    </div>              
												                </div>	
												                <div class="col-sm-6">
												                    <div class="col-sm-6"> 
												                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Max Amount</label>
												                    </div>  
												                    <div class="col-sm-6">
												                        <input type="text" class="form-control numberValidation"  placeholder="" name="model[domiciliary_treatment_expenses][amount]" value="<?php echo $arrValues['amount'];?>" >
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
											                   		<input type="text" class="form-control"  placeholder="" name="model[domiciliary_treatment_expenses][comments]" value="<?php echo $arrValues['comments'];?>" >
											                    </div>            
											                </div>	
										                </div>
									                </div>	
												</td>
											</tr>
											<tr>
												<th class="specalt" scope="row" width="234" valign="top"><strong>Free look period</strong></th>
												<td width="510" valign="top">									
									                <div class="row">
									                    <div class="col-sm-3">
									                    	<input type="text" class="form-control numberValidation"  placeholder="" name="model[free_look_period]" value="<?php echo array_key_exists( 'free_look_period',$model) ? $model['free_look_period'] : '';?>" >
									                    </div>  
									                    <div class="col-sm-9"> 
									                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Days from the Date of Receipt of the Policy Document</label>
									                    </div>            
									                </div>	
												</td>
											</tr>
											<tr>
												<th class="spec" scope="row" width="234" valign="top"><strong>Grace period</strong></th>
												<td width="510" valign="top">						
									                <div class="row">
									                    <div class="col-sm-3">
									                    	<input type="text" class="form-control numberValidation"  placeholder="" name="model[grace_period]" value="<?php echo array_key_exists( 'grace_period',$model) ? $model['grace_period'] : '';?>" >
									                    </div>  
									                    <div class="col-sm-9"> 
									                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Days from date of Renewal</label>
									                    </div>            
									                </div>	
									            </td>
											</tr>
											<tr>
												<th class="specalt" scope="row" width="234" valign="top">Hospital list</th>
												<td width="510" valign="top">
								                    <?php 
														$selected = array_key_exists( 'hospital_list',$model) ? strtolower($model['hospital_list']) : 'no';
														$options = array('yes'=>'Yes', 'no'=>'No');		
														foreach ($options as $k1=>$v1)
														{
															$op = array(
															    'name'        => 'model[hospital_list]',
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
												<th class="spec" scope="row" width="234" valign="top">Family Discount</th>
												<td width="510" valign="top">
												
									                <div class="row">
													<?php
														$default = array('covered'=>'', 'comments'=>'');
														$arrValues = array_key_exists( 'family_discount',$model) ? unserialize($model['family_discount']) : $default;

														$arrValues = Util::array_overlay($default, $arrValues);
														$selected = $arrValues['covered'];
									                ?>
									                    <div class="col-sm-12"> 
										                    <?php 
																$options = array('yes'=>'Covered', 'no'=>'Not Covered');		
																foreach ($options as $k1=>$v1)
																{
																	$op = array(
																	    'name'        => 'model[family_discount][covered]',
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
											                   		<input type="text" class="form-control"  placeholder="" name="model[family_discount][comments]" value="<?php echo $arrValues['comments'];?>" >
											                    </div>            
											                </div>	
										                </div>
									                </div>	
												</td>
											</tr>
											<tr>
												<th class="specalt" scope="row" width="234" valign="top">Cumulative Bonus</th>
												<td width="510" valign="top"><input type="text" class="form-control"  placeholder="" name="model[cumulative_bonus]" value="<?php echo array_key_exists( 'cumulative_bonus',$model) ? $model['cumulative_bonus'] : '';?>" ></td>
											</tr>
											<tr>
												<th class="spec" scope="row" width="234" valign="top">Two Year Policy Option</th>
												<td width="510" valign="top">
												
									                <div class="row">
													<?php
														$default = array('covered'=>'', 'percent'=>'', 'comments'=>'');
														$arrValues = array_key_exists( 'two_year_policy_option',$model) ? unserialize($model['two_year_policy_option']) : $default;
														$arrValues = Util::array_overlay($default, $arrValues);
														$selected = $arrValues['covered'];
									                ?>
									                    <div class="col-sm-12"> 
										                    <?php 
																$options = array('yes'=>'Covered', 'no'=>'Not Covered');		
																foreach ($options as $k1=>$v1)
																{
																	$op = array(
																	    'class'       => 'showHideNextDivByRadio',
																	    'name'        => 'model[two_year_policy_option][covered]',
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
												                <div class="col-sm-12">
												                    <div class="col-sm-3"> 
												                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Percent</label>
												                    </div>  
												                    <div class="col-sm-3">
												                        <input type="text" class="form-control" maxlength="3" placeholder="" name="model[two_year_policy_option][percent]" value="<?php echo $arrValues['percent'];?>" >
												                    </div> 
												                    <div class="col-sm-6"> 
												                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">% is offered on the Premium</label>
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
											                   		<input type="text" class="form-control"  placeholder="" name="model[two_year_policy_option][comments]" value="<?php echo $arrValues['comments'];?>" >
											                    </div>            
											                </div>	
										                </div>
									                </div>	
												</td>
												
											</tr>
											<tr>
												<th class="specalt" scope="row" width="234" valign="top">Claim Loading</th>
												<td width="510" valign="top"><input type="text" class="form-control"  placeholder="" name="model[claim_loading]" value="<?php echo array_key_exists( 'claim_loading',$model) ? $model['claim_loading'] : '';?>" ></td>
											</tr>
											<tr>
												<th class="spec" scope="row" width="234" valign="top">Dependent Parents</th>
												<td width="510" valign="top">
								                    <?php 
														$selected = array_key_exists( 'dependent_parents',$model) ? strtolower($model['dependent_parents']) : 'no';
														$options = array('yes'=>'Covered', 'no'=>'Not Covered');		
														foreach ($options as $k1=>$v1)
														{
															$op = array(
															    'name'        => 'model[dependent_parents]',
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
			
					                <div class="form-group">
					                </div>
					                
					                <div class="form-group">
					                </div>
			                
<?php /* ?>			                
			                
									<table  cellspacing="0" class="eligibility">
										<thead>
											<tr>
												<th colspan="2">Major Exclusions</th>
											</tr>
										</thead>
										<tbody>
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
			
<?php */ ?>		
			
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