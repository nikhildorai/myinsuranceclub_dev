<?php 
class EligibilityConditionsBack extends Widget{

      public function __construct() {

        parent::widget ();

    }

    function run($ext = array())
    {
        $model = isset($ext['model']) ? $ext['model'] : array();
        $modelType = isset($ext['modelType']) ? $ext['modelType'] : '';
?>    	
		
               
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
						$default = array('value'=>array(), 'comment'=>'');
						$arrValues = array_key_exists( 'coverage_amount',$model) ? unserialize($model['coverage_amount']) : $default;
						$arrValues = Util::array_overlay($default, $arrValues);				
						$values = isset($arrValues['value']) ? $arrValues['value'] : array(); 
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
		                        <input type="text" class="form-control"  placeholder="Max 255 characters" name="model[coverage_amount][comment]" maxlength="255" value="<?php echo isset($arrValues['comment']) ? $arrValues['comment'] : '';?>"  >
		                    </div>
						</div>
					</td>
				</tr>
				
				
				<tr>
					<th class="spec" scope="row">Duration of Coverage/Policy Term (In Years)</th>
					<td width="252" valign="top" >
	                <?php 
	                	$default = array('min'=>'','max'=>'');
						$arrValues = array_key_exists( 'policy_terms',$model) ? unserialize($model['policy_terms']) : $default;
						$arrValues = Util::array_overlay($default, $arrValues);	
	                ?>
	                 	<input type="text" class="form-control numberValidation"  placeholder="Minimum policy term" name="model[policy_terms][min]" maxlength="2" value="<?php echo $arrValues['min'];?>"  >
					</td>
					
					<td width="252" valign="top" >
	                 	<input type="text" class="form-control numberValidation"  placeholder="Maximum policy term" name="model[policy_terms][max]" maxlength="2" value="<?php echo $arrValues['max'];?>"  >
					</td>
					
				</tr>
				
				
				<tr>
					<th class="specalt" scope="row" width="234" valign="top">Entry Age (in years)</th>
					<td width="252" valign="top">
						
						<div>
							<label for="">Individual</label>	
			                <div class="row">
			                <?php 
			                	$default = array(	'minimum'=>array(	'individual'=>array('value'=>'', 'type'=>'', 'comments'=>''),
			                													'family_floater'=>array('value'=>'', 'type'=>'', 'comments'=>'')),
									                'maximum'=>array(	'individual'=>array('value'=>'', 'type'=>'', 'comments'=>''),
									                							'family_floater'=>array('value'=>'', 'type'=>'', 'comments'=>'')));
			                	
								$arrValues = array_key_exists( 'entry_age',$model) ? unserialize($model['entry_age']) : $default;
								$arrValues = Util::array_overlay($default, $arrValues);
			                ?>
			                    <div class="col-sm-12"> 
			                        <input type="text" class="form-control numberValidation" maxlength="3" placeholder="Minimum entry age" name="model[entry_age][minimum][individual][value]" value="<?php echo isset($arrValues['minimum']['individual']['value']) ? $arrValues['minimum']['individual']['value'] : ''?>" >
			                    </div>          
			                </div>
							<div class="divider"></div> 
							<div class="row">  
			                    <label for="" class="col-sm-3">Comment</label>
			                    <div class="col-sm-9">
			                    	<?php //$entry_age = array_key_exists( 'entry_age_comments',$model) ? unserialize($model['entry_age_comments']) : array('min'=>'', 'max'=>'');?>
			                        <input type="text" class="form-control"  placeholder="Max 127 characters" name="model[entry_age][minimum][individual][comments]" maxlength="127" value="<?php echo isset($arrValues['minimum']['individual']['comments']) ? $arrValues['minimum']['individual']['comments'] : '';;?>"  >
			                    </div>
							</div>
						</div>	
						<div class="divider"></div> 
						<div>
							<label for="">Family Floater</label>	
			                <div class="row">
			                <?php 
								$selected = isset($arrValues['minimum']['family_floater']['type']) ? $arrValues['minimum']['family_floater']['type'] : '';									
			                ?>
			                    <div class="col-sm-10" style="padding-right: 0px; padding-left: 0px; width: 307px;"> 
				                    <?php 
				                    	$options = array('days'=>'Days','months'=>'Months', 'years'=>'Years');	
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
			                    <div class="col-sm-2" style="padding-left: 0px; border-right-width: 0px; padding-right: 0px; left: -16px; width: 74px;">
			                        <input type="text" class="form-control numberValidation" maxlength="3" placeholder="" name="model[entry_age][minimum][family_floater][value]" value="<?php echo isset($arrValues['minimum']['family_floater']['value']) ? $arrValues['minimum']['family_floater']['value'] : '';?>"  style="width: 92px; padding-left: 0px; padding-right: 0px; margin-left: -16px;" >
			                    </div>          
			                </div>
							<div class="divider"></div> 
							<div class="row">  
			                    <label for="" class="col-sm-3">Comment</label>
			                    <div class="col-sm-9">
			                    	<?php //$entry_age = array_key_exists( 'entry_age_comments',$model) ? unserialize($model['entry_age_comments']) : array('min'=>'', 'max'=>'');?>
			                        <input type="text" class="form-control"  placeholder="Max 127 characters" name="model[entry_age][minimum][family_floater][comments]" maxlength="127" value="<?php echo isset($arrValues['minimum']['family_floater']['comments']) ? $arrValues['minimum']['family_floater']['comments'] : '';?>"  >
			                    </div>
							</div>
						</div>	
					</td>
					<td width="252" valign="top">
						<div>
							<label for="">Individual</label>	
			                <div class="row">
			                    <div class="col-sm-12"> 
			                        <input type="text" class="form-control numberValidation" maxlength="3" placeholder="Maximum entry age" name="model[entry_age][maximum][individual][value]" value="<?php echo isset($arrValues['maximum']['individual']['value']) ? $arrValues['maximum']['individual']['value'] : ''?>" >
			                    </div>          
			                </div>
							<div class="divider"></div> 
							<div class="row">  
			                    <label for="" class="col-sm-3">Comment</label>
			                    <div class="col-sm-9">
			                    	<?php //$entry_age = array_key_exists( 'entry_age_comments',$model) ? unserialize($model['entry_age_comments']) : array('min'=>'', 'max'=>'');?>
			                        <input type="text" class="form-control"  placeholder="Max 127 characters" name="model[entry_age][maximum][individual][comments]" maxlength="127" value="<?php echo isset($arrValues['maximum']['individual']['comments']) ? $arrValues['maximum']['individual']['comments'] : '';;?>"  >
			                    </div>
							</div>
						</div>	
						
						<div class="divider"></div> 
						<div>
							<label for="">Family Floater</label>	
			                <div class="row">
			                <?php 
								$selected = isset($arrValues['maximum']['family_floater']['type']) ? $arrValues['maximum']['family_floater']['type'] : '';									
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
			                    <div class="col-sm-2" style="padding-left: 0px; border-right-width: 0px; padding-right: 0px; left: -16px; width: 74px;">
			                        <input type="text" class="form-control numberValidation" maxlength="3" placeholder="" name="model[entry_age][maximum][family_floater][value]" value="<?php echo isset($arrValues['maximum']['family_floater']['value']) ? $arrValues['maximum']['family_floater']['value'] : '';?>"  style="width: 92px; padding-left: 0px; padding-right: 0px; margin-left: -16px;" >
			                    </div>          
			                </div>
							<div class="divider"></div> 
							<div class="row">  
			                    <label for="" class="col-sm-3">Comment</label>
			                    <div class="col-sm-9">
			                    	<?php //$entry_age = array_key_exists( 'entry_age_comments',$model) ? unserialize($model['entry_age_comments']) : array('min'=>'', 'max'=>'');?>
			                        <input type="text" class="form-control"  placeholder="Max 127 characters" name="model[entry_age][maximum][family_floater][comments]" maxlength="127" value="<?php echo isset($arrValues['maximum']['family_floater']['comments']) ? $arrValues['maximum']['family_floater']['comments'] : '';?>"  >
			                    </div>
							</div>
						</div>	
					</td>
					
				</tr>
				<tr>
					<th class="specalt" scope="row" width="234" valign="top">Maximum Renewable Age (in years)</th>
					<td width="252" valign="top" colspan="2">
		                <div class="row">
		                <?php 		
		                	$default = array('type'=>'', 'max'=>'', 'min'=>'');                
							$arrValues = array_key_exists( 'renewal_age',$model) ? unserialize($model['renewal_age']) : $default;												
							$arrValues = Util::array_overlay($default, $arrValues);
							$selected = $arrValues['type'];							
		                ?>
		                    <div class="col-sm-5"> 
			                    <?php 
									$options = array('lifelong'=>'Lifelong', 'years'=>'No. of Years');		
									foreach ($options as $k1=>$v1)
									{
										$op = array(
										    'class'       => 'showHideNextDivByRadio',
										    'name'        => 'model[renewal_age][type]',
										    'value'       => $k1,
										    'checked'     => ($selected == $k1) ? TRUE : FALSE,
										    'style'       => 'margin:10px',
										    );
										echo '<label class="ui-radio">'.form_radio($op).'<span>'.$v1.'</span></label>';
									}
								?>
		                    </div> 
		                    <div class="col-sm-7" style="display:<?php echo ($selected == 'years') ? 'block' : 'none';?>;" id="model_maximum_renewal_age_div">
				                        <input type="text" class="form-control numberValidation"  placeholder="Maximum Age" name="model[renewal_age][max]" maxlength="2" value="<?php echo $arrValues['max'];?>"  >
		                    </div>             
		                </div>	
					
					
					</td>
				</tr>
				
				<tr>
					<th class="specalt" scope="row" width="234" valign="top"><strong>No Medical Test Age (in years)</strong></th>
					<td width="510" valign="top" colspan="2">
		                <div class="row">
						<?php
							$default = array('covered'=>'', 'min'=>'', 'max'=>'', 'comments'=>'');
							$arrValues = array_key_exists( 'no_medical_test_age',$model) ? unserialize($model['no_medical_test_age']) : $default;
							
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
										    'name'        => 'model[no_medical_test_age][covered]',
										    'value'       => $k1,
										    'checked'     => ($selected == $k1) ? TRUE : FALSE,
										    'style'       => 'margin:10px',
										    );
										echo '<label class="ui-radio">'.form_radio($op).'<span>'.$v1.'</span></label>';
									}
								?>
		                    </div> 
		                    <div class=" row" style="display:<?php echo ($selected != 'no') ? 'block' : 'none';?>;">
								<div class="col-sm-12" >		
					                    <div class="col-sm-4"> 
					                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Medical test required after</label>
					                    </div>  
					                    <div class="col-sm-4">
					                        <input type="text" class="form-control" placeholder="" name="model[no_medical_test_age][max]" value="<?php echo $arrValues['max'];?>" >
					                    </div>   	
					                    <div class="col-sm-2"> 
					                    	<label for="inputPassword3" class="col-sm-12 control-label" style="padding-left: 0px; padding-right: 0px;text-align: left;">Years</label>
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
				                   		<input type="text" class="form-control"  placeholder="" name="model[no_medical_test_age][comments]" value="<?php echo $arrValues['comments'];?>" >
				                    </div>            
				                </div>	
			                </div>
		                </div>
					</td>
				</tr>
			</tbody>
		</table>

<?php                 
	}
}
?>