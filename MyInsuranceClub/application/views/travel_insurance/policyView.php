<link rel="stylesheet" href="<?php echo base_url();?>assets/css/animate.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/pages.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/pdf.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/policy.css">

<div id="highlighted" style="background: #fff; padding-bottom: 50px; margin-bottom: 0px;">
	<div class="container">
<?php 
	if (!empty($company))
	{
?>	
		<?php echo widget::run('policyDetailsTopFront', array('policyDetails'=>$policyDetails['policy'], 'url'=>$url, 'company'=>$company));?>
		
		<div class="row">
			<div class="col-sm-12">
				<h2 class="lined-heading">
					<span>Family Composition in <?php echo $policyDetails['policy']['policy_name'];?></span>
				</h2>
			</div>



			<div class="col-md-12">


				<div class="col-md-3 ">

					<div class="compo">
						<h2 class="compo-title">2 Adults</h2>
						<p class="compo-desc">
							<img src="<?php echo base_url();?>assets/images/icons/person.png" border="0" class="compo-img">
						</p>

					</div>

				</div>



				<div class="col-md-3 ">

					<div class="compo"></div>

				</div>


				<div class="col-md-3 ">

					<div class="compo"></div>

				</div>


				<div class="col-md-3 ">

					<div class="compo"></div>

				</div>

			</div>


		</div>


<?php
	$variantCount = count($variantNames);		 
?>
		<div class="row">
			<div class="col-sm-12">
				<h2 class="lined-heading">
					<span>Plan Variant<?php echo ($variantCount > 1) ? 's':''?> in <?php echo $policyDetails['policy']['policy_name'];?></span>
				</h2>
			</div>

			<div id="tab-container" class="tab-container col-md-12">
<?php 
				if (isset($variantNames) && !empty($variantNames) && $variantCount > 1)
				{	?>	
					<ul class='etabs'>
	<?php 				foreach ($variantNames as $k1=>$v1)
						{	?>
							<li class='tab'><a href="#Medisure<?php echo $k1?>"><?php echo $v1;?></a></li>
<?php 					}										?>			
					</ul>
<?php 			}	?>				
				<div class='panel-container<?php echo ($variantCount == 1) ? '1':''?>'>
<?php 
				if (!empty($variantDetails))
				{
					foreach ($variantDetails as $k1=>$v1)
					{	
						$variant = $v1['variant'];
						$rider = $v1['rider'];
						$vFeatures = $model = $v1['features'];
						?>
						
						<div id="Medisure<?php echo $variant['variant_id']?>">
	
	
							<div class="row pad">
	
								<div class="col-sm-12">
	
									<h2 class=" header_in cus_mar">
										<span>Eligibility and Restrictions</span>
									</h2>
								</div>
								
								<?php echo widget::run('eligibilityConditionsFront', array('variant'=>$variant, 'model'=>$vFeatures,'type'=>'travel'));?>
								
							</div>
							
	
							<div class="row pad">
	
								<div class="col-sm-12">
	
									<h2 class=" header_in cus_mar">
										<span>Sample Premium for <?php echo $variant['variant_name']?></span>
									</h2>
									<?php echo widget::run('samplePremiumFront', array('variant'=>$variant, 'features'=>$vFeatures));?>
								</div>
							</div>
	
	
							<div class="row pad">
								<div class="col-sm-12">
									<h2 class=" header_in cus_mar">
										<span>What is covered?</span>
									</h2>
								</div>
	
								<div class="smart-grids col-md-12 clearfix">
									<table class="bordered  ">
										<thead>
	
											<tr>
												<th colspan="2">Basic Benefits</th>
	
											</tr>
										</thead>
										<tbody>
											<tr>
												<td><strong>Emergency Medical Expenses (in USD)</strong></td>
												<td>
													<?php
														$default = array('amount'=>'',  'deductable'=>'', 'comments'=>'');
														$arrValues = array_key_exists( 'medical_expenses',$model) ? unserialize($model['medical_expenses']) : $default;
														$arrValues = Util::array_overlay($default, $arrValues);
														$display = array();
														$display[] = (!empty($arrValues['amount'])) ? 'Maximum of USD. '.$arrValues['amount'] : '';
														$display[] = (!empty($arrValues['deductable'])) ? 'Deductable upto USD. '.$arrValues['deductable'] : '';
														$display[] = (!empty($arrValues['comments'])) ? $arrValues['comments'] : '';
														$display = array_filter($display);
														$display = (!empty($display)) ? implode(', ', array_filter($display)) : '-';
														echo $display;	
									                ?>
									            </td>
											</tr>
											<tr>
												<td><strong>Sickness Dental Relief</strong></td>
												<td>
													<?php
														$default = array('covered'=>'no', 'amount'=>'', 'deductable'=>'', 'comments'=>'');
														$arrValues = array_key_exists( 'dental',$model) ? unserialize($model['dental']) : $default;
														$arrValues = Util::array_overlay($default, $arrValues);
														$selected = $arrValues['covered'];
														$display = array();
														if ($selected == 'yes')
														{
															$display[] = (!empty($arrValues['amount'])) ? 'Maximum of USD. '.$arrValues['amount'] : '';
															$display[] = (!empty($arrValues['deductable'])) ? 'Deductable upto USD. '.$arrValues['deductable'] : '';
															$display[] = (!empty($arrValues['comments'])) ? $arrValues['comments'] : '';
														}
														else 
															$display[] = 'Not covered';
														$display = array_filter($display);
														$display = (!empty($display)) ? implode(', ', array_filter($display)) : 'Covered';
														echo $display;	
									                ?>
									            </td>
											</tr>
											<tr>
												<td><strong>Emergency Medical Evacuation</strong></td>
												<td>
													<?php
														$default = array('covered'=>'no', 'amount'=>'', 'deductable'=>'', 'comments'=>'');
														$arrValues = !empty($model['emergency_medical_evacuation']) ? unserialize($model['emergency_medical_evacuation']) : $default;
														$arrValues = Util::array_overlay($default, $arrValues);
														$selected = $arrValues['covered'];
														$display = array();
														if ($selected == 'yes')
														{
															$display[] = (!empty($arrValues['amount'])) ? 'Maximum of USD. '.$arrValues['amount'] : '';
															$display[] = (!empty($arrValues['deductable'])) ? 'Deductable upto USD. '.$arrValues['deductable'] : '';
															$display[] = (!empty($arrValues['comments'])) ? $arrValues['comments'] : '';
														}
														else 
															$display[] = 'Not covered';
														$display = array_filter($display);
														$display = (!empty($display)) ? implode(', ', array_filter($display)) : 'Covered';
														echo $display;	
									                ?>
									            </td>
											</tr>
											<tr>
												<td><strong>Repatriation of Remains</strong></td>
												<td>
													<?php
														$default = array('covered'=>'no', 'amount'=>'', 'deductable'=>'', 'comments'=>'');
														$arrValues = !empty($model['repatriation_of_mortal_remains']) ? unserialize($model['repatriation_of_mortal_remains']) : $default;
														$arrValues = Util::array_overlay($default, $arrValues);
														$selected = $arrValues['covered'];
														$display = array();
														if ($selected == 'yes')
														{
															$display[] = (!empty($arrValues['amount'])) ? 'Maximum of USD. '.$arrValues['amount'] : '';
															$display[] = (!empty($arrValues['deductable'])) ? 'Deductable upto USD. '.$arrValues['deductable'] : '';
															$display[] = (!empty($arrValues['comments'])) ? $arrValues['comments'] : '';
														}
														else 
															$display[] = 'Not covered';
														$display = array_filter($display);
														$display = (!empty($display)) ? implode(', ', array_filter($display)) : 'Covered';
														echo $display;	
									                ?>
									            </td>
											</tr>
	
											<tr>
												<td><strong>Baggage Loss</strong></td>
												<td>
													<?php
														$default = array('covered'=>'no', 'amount'=>'', 'deductable'=>'', 'comments'=>'');
														$arrValues = !empty($model['total_loss_of_checked_baggage']) ? unserialize($model['total_loss_of_checked_baggage']) : $default;
														$arrValues = Util::array_overlay($default, $arrValues);
														$selected = $arrValues['covered'];
														$display = array();
														if ($selected == 'yes')
														{
															$display[] = (!empty($arrValues['amount'])) ? 'Maximum of USD. '.$arrValues['amount'] : '';
															$display[] = (!empty($arrValues['deductable'])) ? 'Deductable upto USD. '.$arrValues['deductable'] : '';
															$display[] = (!empty($arrValues['comments'])) ? $arrValues['comments'] : '';
														}
														else 
															$display[] = 'Not covered';
														$display = array_filter($display);
														$display = (!empty($display)) ? implode(', ', array_filter($display)) : 'Covered';
														echo $display;	
									                ?>
									            </td>
											</tr>
	
											<tr>
												<td><strong>Baggage Delay</strong></td>
												<td>
													<?php
														$default = array('covered'=>'no', 'amount'=>'', 'deductable'=>'', 'comments'=>'');
														$arrValues = !empty($model['delay_of_checked_baggage']) ? unserialize($model['delay_of_checked_baggage']) : $default;
														$arrValues = Util::array_overlay($default, $arrValues);
														$selected = $arrValues['covered'];
														$display = array();
														if ($selected == 'yes')
														{
															$display[] = (!empty($arrValues['amount'])) ? 'Maximum of USD. '.$arrValues['amount'] : '';
															$display[] = (!empty($arrValues['deductable'])) ? 'Deductable upto USD. '.$arrValues['deductable'] : '';
															$display[] = (!empty($arrValues['comments'])) ? $arrValues['comments'] : '';
														}
														else 
															$display[] = 'Not covered';
														$display = array_filter($display);
														$display = (!empty($display)) ? implode(', ', array_filter($display)) : 'Covered';
														echo $display;	
									                ?>
									            </td>
											</tr>
	
											<tr>
												<td><strong>Loss of Passport</strong></td>
												<td>
													<?php
														$default = array('covered'=>'no', 'amount'=>'', 'deductable'=>'', 'comments'=>'');
														$arrValues = !empty($model['loss_of_passport']) ? unserialize($model['loss_of_passport']) : $default;
														$arrValues = Util::array_overlay($default, $arrValues);
														$selected = $arrValues['covered'];
														$display = array();
														if ($selected == 'yes')
														{
															$display[] = (!empty($arrValues['amount'])) ? 'Maximum of USD. '.$arrValues['amount'] : '';
															$display[] = (!empty($arrValues['deductable'])) ? 'Deductable upto USD. '.$arrValues['deductable'] : '';
															$display[] = (!empty($arrValues['comments'])) ? $arrValues['comments'] : '';
														}
														else 
															$display[] = 'Not covered';
														$display = array_filter($display);
														$display = (!empty($display)) ? implode(', ', array_filter($display)) : 'Covered';
														echo $display;	
									                ?>
									            </td>
											</tr>
	
											<tr>
												<td><strong>Loss of Visa</strong></td>
												<td>
													<?php
														$default = array('covered'=>'no', 'amount'=>'', 'deductable'=>'', 'comments'=>'');
														$arrValues = !empty($model['loss_of_visa']) ? unserialize($model['loss_of_visa']) : $default;
														$arrValues = Util::array_overlay($default, $arrValues);
														$selected = $arrValues['covered'];
														$display = array();
														if ($selected == 'yes')
														{
															$display[] = (!empty($arrValues['amount'])) ? 'Maximum of USD. '.$arrValues['amount'] : '';
															$display[] = (!empty($arrValues['deductable'])) ? 'Deductable upto USD. '.$arrValues['deductable'] : '';
															$display[] = (!empty($arrValues['comments'])) ? $arrValues['comments'] : '';
														}
														else 
															$display[] = 'Not covered';
														$display = array_filter($display);
														$display = (!empty($display)) ? implode(', ', array_filter($display)) : 'Covered';
														echo $display;	
									                ?>
									            </td>
											</tr>
	
											<tr>
												<td><strong>Personal Liability</strong></td>
												<td>
													<?php
														$default = array('covered'=>'no', 'amount'=>'', 'deductable'=>'', 'comments'=>'');
														$arrValues = !empty($model['personal_liability']) ? unserialize($model['personal_liability']) : $default;
														$arrValues = Util::array_overlay($default, $arrValues);
														$selected = $arrValues['covered'];
														$display = array();
														if ($selected == 'yes')
														{
															$display[] = (!empty($arrValues['amount'])) ? 'Maximum of USD. '.$arrValues['amount'] : '';
															$display[] = (!empty($arrValues['deductable'])) ? 'Deductable upto USD. '.$arrValues['deductable'] : '';
															$display[] = (!empty($arrValues['comments'])) ? $arrValues['comments'] : '';
														}
														else 
															$display[] = 'Not covered';
														$display = array_filter($display);
														$display = (!empty($display)) ? implode(', ', array_filter($display)) : 'Covered';
														echo $display;	
									                ?>
									            </td>
											</tr>
	
											<tr>
												<td><strong>Trip Cancellation</strong></td>
												<td>
													<?php
														$default = array('covered'=>'no', 'amount'=>'', 'deductable'=>'', 'comments'=>'');
														$arrValues = !empty($model['trip_cancellation']) ? unserialize($model['trip_cancellation']) : $default;
														$arrValues = Util::array_overlay($default, $arrValues);
														$selected = $arrValues['covered'];
														$display = array();
														if ($selected == 'yes')
														{
															$display[] = (!empty($arrValues['amount'])) ? 'Maximum of USD. '.$arrValues['amount'] : '';
															$display[] = (!empty($arrValues['deductable'])) ? 'Deductable upto USD. '.$arrValues['deductable'] : '';
															$display[] = (!empty($arrValues['comments'])) ? $arrValues['comments'] : '';
														}
														else 
															$display[] = 'Not covered';
														$display = array_filter($display);
														$display = (!empty($display)) ? implode(', ', array_filter($display)) : 'Covered';
														echo $display;	
									                ?>
									            </td>
											</tr>
	
											<tr>
												<td><strong>Trip Curtailment</strong></td>
												<td>
													<?php
														$default = array('covered'=>'no', 'amount'=>'', 'deductable'=>'', 'comments'=>'');
														$arrValues = !empty($model['trip_curtailment']) ? unserialize($model['trip_curtailment']) : $default;
														$arrValues = Util::array_overlay($default, $arrValues);
														$selected = $arrValues['covered'];
														$display = array();
														if ($selected == 'yes')
														{
															$display[] = (!empty($arrValues['amount'])) ? 'Maximum of USD. '.$arrValues['amount'] : '';
															$display[] = (!empty($arrValues['deductable'])) ? 'Deductable upto USD. '.$arrValues['deductable'] : '';
															$display[] = (!empty($arrValues['comments'])) ? $arrValues['comments'] : '';
														}
														else 
															$display[] = 'Not covered';
														$display = array_filter($display);
														$display = (!empty($display)) ? implode(', ', array_filter($display)) : 'Covered';
														echo $display;	
									                ?>
									            </td>
											</tr>
	
											<tr>
												<td><strong>Trip Interruption</strong></td>
												<td>
													<?php
														$default = array('covered'=>'no', 'amount'=>'', 'deductable'=>'', 'comments'=>'');
														$arrValues = !empty($model['trip_interruption']) ? unserialize($model['trip_interruption']) : $default;
														$arrValues = Util::array_overlay($default, $arrValues);
														$selected = $arrValues['covered'];
														$display = array();
														if ($selected == 'yes')
														{
															$display[] = (!empty($arrValues['amount'])) ? 'Maximum of USD. '.$arrValues['amount'] : '';
															$display[] = (!empty($arrValues['deductable'])) ? 'Deductable upto USD. '.$arrValues['deductable'] : '';
															$display[] = (!empty($arrValues['comments'])) ? $arrValues['comments'] : '';
														}
														else 
															$display[] = 'Not covered';
														$display = array_filter($display);
														$display = (!empty($display)) ? implode(', ', array_filter($display)) : 'Covered';
														echo $display;	
									                ?>
									            </td>
											</tr>
	
											<tr>
												<td><strong>Hospital Daily Cash</strong></td>
												<td>
													<?php
														$default = array('covered'=>'no', 'amount'=>'', 'deductable'=>'', 'comments'=>'');
														$arrValues = !empty($model['hospital_daily_cash']) ? unserialize($model['hospital_daily_cash']) : $default;
														$arrValues = Util::array_overlay($default, $arrValues);
														$selected = $arrValues['covered'];
														$display = array();
														if ($selected == 'yes')
														{
															$display[] = (!empty($arrValues['amount'])) ? 'Maximum of USD. '.$arrValues['amount'] : '';
															$display[] = (!empty($arrValues['deductable'])) ? 'Deductable upto USD. '.$arrValues['deductable'] : '';
															$display[] = (!empty($arrValues['comments'])) ? $arrValues['comments'] : '';
														}
														else 
															$display[] = 'Not covered';
														$display = array_filter($display);
														$display = (!empty($display)) ? implode(', ', array_filter($display)) : 'Covered';
														echo $display;	
									                ?>
									            </td>
											</tr>
	
											<tr>
												<td><strong>Personal Accident</strong></td>
												<td>
													<?php
														$default = array('covered'=>'no', 'amount'=>'', 'deductable'=>'', 'comments'=>'');
														$arrValues = !empty($model['personal_accident']) ? unserialize($model['personal_accident']) : $default;
														$arrValues = Util::array_overlay($default, $arrValues);
														$selected = $arrValues['covered'];
														$display = array();
														if ($selected == 'yes')
														{
															$display[] = (!empty($arrValues['amount'])) ? 'Maximum of USD. '.$arrValues['amount'] : '';
															$display[] = (!empty($arrValues['deductable'])) ? 'Deductable upto USD. '.$arrValues['deductable'] : '';
															$display[] = (!empty($arrValues['comments'])) ? $arrValues['comments'] : '';
														}
														else 
															$display[] = 'Not covered';
														$display = array_filter($display);
														$display = (!empty($display)) ? implode(', ', array_filter($display)) : 'Covered';
														echo $display;	
									                ?>
									            </td>
											</tr>
	
											<tr>
												<td><strong>Personal Accident (Common Carrier)</strong></td>
												<td>
													<?php
														$default = array('covered'=>'no', 'amount'=>'', 'deductable'=>'', 'comments'=>'');
														$arrValues = !empty($model['personal_accident']) ? unserialize($model['personal_accident']) : $default;
														$arrValues = Util::array_overlay($default, $arrValues);
														$selected = $arrValues['covered'];
														$display = array();
														if ($selected == 'yes')
														{
															$display[] = (!empty($arrValues['amount'])) ? 'Maximum of USD. '.$arrValues['amount'] : '';
															$display[] = (!empty($arrValues['deductable'])) ? 'Deductable upto USD. '.$arrValues['deductable'] : '';
															$display[] = (!empty($arrValues['comments'])) ? $arrValues['comments'] : '';
														}
														else 
															$display[] = 'Not covered';
														$display = array_filter($display);
														$display = (!empty($display)) ? implode(', ', array_filter($display)) : 'Covered';
														echo $display;	
									                ?>
									            </td>
											</tr>
	
											<tr>
												<td><strong>Personal Accident (Domestic)</strong></td>
												<td>
													<?php
														$default = array('covered'=>'no', 'amount'=>'', 'deductable'=>'', 'comments'=>'');
														$arrValues = !empty($model['personal_accident_domestic']) ? unserialize($model['personal_accident_domestic']) : $default;
														$arrValues = Util::array_overlay($default, $arrValues);
														$selected = $arrValues['covered'];
														$display = array();
														if ($selected == 'yes')
														{
															$display[] = (!empty($arrValues['amount'])) ? 'Maximum of USD. '.$arrValues['amount'] : '';
															$display[] = (!empty($arrValues['deductable'])) ? 'Deductable upto USD. '.$arrValues['deductable'] : '';
															$display[] = (!empty($arrValues['comments'])) ? $arrValues['comments'] : '';
														}
														else 
															$display[] = 'Not covered';
														$display = array_filter($display);
														$display = (!empty($display)) ? implode(', ', array_filter($display)) : 'Covered';
														echo $display;	
									                ?>
									            </td>
											</tr>
	
											<tr>
												<td><strong>Accidental Death and Dismemberment (24 hrs)</strong></td>
												<td>
													<?php
														$default = array('covered'=>'no', 'amount'=>'', 'deductable'=>'', 'comments'=>'');
														$arrValues = !empty($model['personal_accident']) ? unserialize($model['accidental_death_and_dismemberment']) : $default;
														$arrValues = Util::array_overlay($default, $arrValues);
														$selected = $arrValues['covered'];
														$display = array();
														if ($selected == 'yes')
														{
															$display[] = (!empty($arrValues['amount'])) ? 'Maximum of USD. '.$arrValues['amount'] : '';
															$display[] = (!empty($arrValues['deductable'])) ? 'Deductable upto USD. '.$arrValues['deductable'] : '';
															$display[] = (!empty($arrValues['comments'])) ? $arrValues['comments'] : '';
														}
														else 
															$display[] = 'Not covered';
														$display = array_filter($display);
														$display = (!empty($display)) ? implode(', ', array_filter($display)) : 'Covered';
														echo $display;	
									                ?>
									            </td>
											</tr>
	
											<tr>
												<td><strong>Accidental Death and Dismemberment (Common Carrier)</strong></td>
												<td>
													<?php
														$default = array('covered'=>'no', 'amount'=>'', 'deductable'=>'', 'comments'=>'');
														$arrValues = !empty($model['accidental_death_and_dismemberment_common_carrier']) ? unserialize($model['accidental_death_and_dismemberment_common_carrier']) : $default;
														$arrValues = Util::array_overlay($default, $arrValues);
														$selected = $arrValues['covered'];
														$display = array();
														if ($selected == 'yes')
														{
															$display[] = (!empty($arrValues['amount'])) ? 'Maximum of USD. '.$arrValues['amount'] : '';
															$display[] = (!empty($arrValues['deductable'])) ? 'Deductable upto USD. '.$arrValues['deductable'] : '';
															$display[] = (!empty($arrValues['comments'])) ? $arrValues['comments'] : '';
														}
														else 
															$display[] = 'Not covered';
														$display = array_filter($display);
														$display = (!empty($display)) ? implode(', ', array_filter($display)) : 'Covered';
														echo $display;	
									                ?>
									            </td>
											</tr>
	
											<tr>
												<td><strong>Accident and Sickness Medical Expenses Reimbursement</strong></td>
												<td>
													<?php
														$default = array('covered'=>'no', 'amount'=>'', 'deductable'=>'', 'comments'=>'');
														$arrValues = !empty($model['accident_sickness_medical_expenses_reimbursement']) ? unserialize($model['accident_sickness_medical_expenses_reimbursement']) : $default;
														$arrValues = Util::array_overlay($default, $arrValues);
														$selected = $arrValues['covered'];
														$display = array();
														if ($selected == 'yes')
														{
															$display[] = (!empty($arrValues['amount'])) ? 'Maximum of USD. '.$arrValues['amount'] : '';
															$display[] = (!empty($arrValues['deductable'])) ? 'Deductable upto USD. '.$arrValues['deductable'] : '';
															$display[] = (!empty($arrValues['comments'])) ? $arrValues['comments'] : '';
														}
														else 
															$display[] = 'Not covered';
														$display = array_filter($display);
														$display = (!empty($display)) ? implode(', ', array_filter($display)) : 'Covered';
														echo $display;	
									                ?>
									            </td>
											</tr>
	
											<tr>
												<td><strong>Accidental Death air travel only</strong></td>
												<td>
													<?php
														$default = array('covered'=>'no', 'amount'=>'', 'deductable'=>'', 'comments'=>'');
														$arrValues = !empty($model['accidental_death_air_travel']) ? unserialize($model['accidental_death_air_travel']) : $default;
														$arrValues = Util::array_overlay($default, $arrValues);
														$selected = $arrValues['covered'];
														$display = array();
														if ($selected == 'yes')
														{
															$display[] = (!empty($arrValues['amount'])) ? 'Maximum of USD. '.$arrValues['amount'] : '';
															$display[] = (!empty($arrValues['deductable'])) ? 'Deductable upto USD. '.$arrValues['deductable'] : '';
															$display[] = (!empty($arrValues['comments'])) ? $arrValues['comments'] : '';
														}
														else 
															$display[] = 'Not covered';
														$display = array_filter($display);
														$display = (!empty($display)) ? implode(', ', array_filter($display)) : 'Covered';
														echo $display;	
									                ?>
									            </td>
											</tr>
	
										</tbody>
									</table>
	
	
	
									<table class="bordered mar-40">
										<thead>
											<tr>
												<th colspan="2">Other Benefits</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>Cashless Treatment</td>
												<td>
													<?php
													$default = array('covered'=>'', 'comments'=>'');
													$arrValues = array_key_exists( 'cashless_treatment',$model) ? unserialize($model['cashless_treatment']) : $default;
													$arrValues = Util::array_overlay($default, $arrValues);
													$display = array();
													$display[] = (!empty($arrValues['covered']) && $arrValues['covered'] == 'yes') ? 'Covered' : 'Not Covered';
													$display[] = (!empty($arrValues['comments'])) ? $arrValues['comments'] : '';
													$display = array_filter($display);
													$display = (!empty($display)) ? implode(', ', array_filter($display)) : '-';
													echo $display;	
									                ?>
									            </td>
											</tr>
										
										
											<tr>
												<td>No Medical Sum Assured limit</td>
												<td>
													<?php
													$default = array('covered'=>'no', 'per_illness'=>'', 'per_accident'=>'', 'max'=>'', 'comments'=>'');
													$arrValues = array_key_exists( 'no_medical_sum_assured_limit',$model) ? unserialize($model['no_medical_sum_assured_limit']) : $default;
													$arrValues = Util::array_overlay($default, $arrValues);
													$selected = $arrValues['covered'];
													$display = array();
													if ($selected == 'yes')
													{
														$display[] = (!empty($arrValues['per_illness'])) ? 'Per illness USD. '.$arrValues['per_illness'] : '';
														$display[] = (!empty($arrValues['per_accident'])) ? 'Per accident USD. '.$arrValues['per_accident'] : '';
														$display[] = (!empty($arrValues['max'])) ? 'Maximum of USD. '.$arrValues['max'] : '';
														$display[] = (!empty($arrValues['comments'])) ? $arrValues['comments'] : '';
													}
													else 
														$display[] = 'Not covered';
													$display = array_filter($display);
													$display = (!empty($display)) ? implode(', ', array_filter($display)) : 'Covered';
													echo $display;	
									                ?>
									            </td>
											</tr>
										
											<tr>
												<td>Pre-existing diseases</td>
												<td>
													<?php
													$default = array('covered'=>'', 'comments'=>'');
													$arrValues = array_key_exists( 'pre_existing_diseases',$model) ? unserialize($model['pre_existing_diseases']) : $default;
													$arrValues = Util::array_overlay($default, $arrValues);
													$display = array();
													$display[] = (!empty($arrValues['covered']) && $arrValues['covered'] == 'yes') ? 'Covered' : 'Not Covered';
													$display[] = (!empty($arrValues['comments'])) ? $arrValues['comments'] : '';
													$display = array_filter($display);
													$display = (!empty($display)) ? implode(', ', array_filter($display)) : '-';
													echo $display;	
									                ?>
									            </td>
											</tr>
										
											<tr>
												<td>Sub Limits</td>
												<td>
													<?php echo (!empty($arrValues['sub_limits'])) ? $arrValues['sub_limits'] : '-';?>
									            </td>
											</tr>
										
											<tr>
												<td>Free Look Period</td>
												<td>
													<?php
													$default = array('covered'=>'no', 'days'=>'', 'trip_type'=>'', 'comments'=>'');
													$arrValues = array_key_exists( 'free_look_period',$model) ? unserialize($model['free_look_period']) : $default;
													$arrValues = Util::array_overlay($default, $arrValues);
													$selected = $arrValues['covered'];
													$display = array();
													if ($selected == 'yes')
													{
														$display[] = (!empty($arrValues['days'])) ? $arrValues['days'].' days'.((!empty($arrValues['trip_type'])) ? ' for '.$arrValues['trip_type'] : '') : '';
														$display[] = (!empty($arrValues['comments'])) ? $arrValues['comments'] : '';
													}
													else 
														$display[] = 'Not covered';
													$display = array_filter($display);
													$display = (!empty($display)) ? implode(', ', array_filter($display)) : 'Covered';
													echo $display;	
									                ?>
									            </td>
											</tr>
										
											<tr>
												<td>Grace Period</td>
												<td>
													<?php
													$default = array('covered'=>'no', 'days'=>'', 'trip_type'=>'', 'comments'=>'');
													$arrValues = array_key_exists( 'grace_period',$model) ? unserialize($model['grace_period']) : $default;
													$arrValues = Util::array_overlay($default, $arrValues);
													$selected = $arrValues['covered'];
													$display = array();
													if ($selected == 'yes')
													{
														$display[] = (!empty($arrValues['days'])) ? $arrValues['days'].' days'.((!empty($arrValues['trip_type'])) ? ' for '.$arrValues['trip_type'] : '') : '';
														$display[] = (!empty($arrValues['comments'])) ? $arrValues['comments'] : '';
													}
													else 
														$display[] = 'Not covered';
													$display = array_filter($display);
													$display = (!empty($display)) ? implode(', ', array_filter($display)) : 'Covered';
													echo $display;	
									                ?>
									            </td>
											</tr>
										
											<tr>
												<td>Worldwide Coverage</td>
												<td>
													<?php echo ucfirst($model['worldwide_coverage']);?>
									            </td>
											</tr>
										
											<tr>
												<td>Cumulative Bonus</td>
												<td>
													<?php
													$default = array('covered'=>'no', 'comments'=>'');
													$arrValues = array_key_exists( 'cumulative_bonus',$model) ? unserialize($model['cumulative_bonus']) : $default;
													$arrValues = Util::array_overlay($default, $arrValues);
													$selected = $arrValues['covered'];
													$display = array();
													if ($selected == 'yes')
													{
														$display[] = (!empty($arrValues['comments'])) ? $arrValues['comments'] : '';
													}
													else 
														$display[] = 'Not covered';
													$display = array_filter($display);
													$display = (!empty($display)) ? implode(', ', array_filter($display)) : 'Covered';
													echo $display;	
									                ?>
									            </td>
											</tr>
										</tbody>
									</table>
	
	
			                	<?php echo widget::run('ridersFront', array('riderModel'=>$rider, 'rSlug'=>'mediclaim')); ?>
	
	
									<table class="bordered mar-40">
										<thead>
											<tr>
												<th colspan="2">Additional Benefits</th>
											</tr>
										</thead>
										<tbody>
										
											<tr>
												<td>Flight Delay</td>
												<td>
													<?php
													$default = array('covered'=>'no', 'amount'=>'','per_hour'=>'', 'deductable'=>'', 'covered_after'=>'', 'comments'=>'');
													$arrValues = array_key_exists( 'flight_delay',$model) ? unserialize($model['flight_delay']) : $default;
													$arrValues = Util::array_overlay($default, $arrValues);
													$selected = $arrValues['covered'];
													$display = array();
													if ($selected == 'yes')
													{
														$display[] = (!empty($arrValues['per_hour'])) ? 'Per hour USD. '.$arrValues['per_hour'] : '';
														$display[] = (!empty($arrValues['amount'])) ? 'Maximum of USD. '.$arrValues['amount'] : '';
														$display[] = (!empty($arrValues['deductable'])) ? 'Deductable upto USD. '.$arrValues['deductable'] : '';
														$display[] = (!empty($arrValues['covered_after'])) ? 'Covered after . '.$arrValues['covered_after'].' hrs' : '';
														$display[] = (!empty($arrValues['comments'])) ? $arrValues['comments'] : '';
													}
													else 
														$display[] = 'Not covered';
													$display = array_filter($display);
													$display = (!empty($display)) ? implode(', ', array_filter($display)) : 'Covered';
													echo $display;	
									                ?>
									            </td>
											</tr>
										
											<tr>
												<td>Hijack</td>
												<td>
													<?php
													$default = array('covered'=>'no', 'amount'=>'','per_hour'=>'', 'deductable'=>'', 'covered_after'=>'', 'comments'=>'');
													$arrValues = array_key_exists( 'hijack_daily_allowance',$model) ? unserialize($model['hijack_daily_allowance']) : $default;
													$arrValues = Util::array_overlay($default, $arrValues);
													$selected = $arrValues['covered'];
													$display = array();
													if ($selected == 'yes')
													{
														$display[] = (!empty($arrValues['per_hour'])) ? 'Per hour USD. '.$arrValues['per_hour'] : '';
														$display[] = (!empty($arrValues['amount'])) ? 'Maximum of USD. '.$arrValues['amount'] : '';
														$display[] = (!empty($arrValues['deductable'])) ? 'Deductable upto USD. '.$arrValues['deductable'] : '';
														$display[] = (!empty($arrValues['covered_after'])) ? 'Covered after . '.$arrValues['covered_after'].' hrs' : '';
														$display[] = (!empty($arrValues['comments'])) ? $arrValues['comments'] : '';
													}
													else 
														$display[] = 'Not covered';
													$display = array_filter($display);
													$display = (!empty($display)) ? implode(', ', array_filter($display)) : 'Covered';
													echo $display;	
									                ?>
									            </td>
											</tr>
										
											<tr>
												<td>Automatic extension of policy</td>
												<td>
													<?php													
													$default = array('covered'=>'no', 'days'=>'','comments'=>'');
													$arrValues = array_key_exists( 'automatic_extension_of_policy',$model) ? unserialize($model['automatic_extension_of_policy']) : $default;
													$arrValues = Util::array_overlay($default, $arrValues);
													$selected = $arrValues['covered'];
													$display = array();
													if ($selected == 'yes')
													{
														$display[] = (!empty($arrValues['days'])) ? $arrValues['days'].' Days' : '';
														$display[] = (!empty($arrValues['comments'])) ? $arrValues['comments'] : '';
													}
													else 
														$display[] = 'Not covered';
													$display = array_filter($display);
													$display = (!empty($display)) ? implode(', ', array_filter($display)) : 'Covered';
													echo $display;	
									                ?>
									            </td>
											</tr>
										
											<tr>
												<td>Emergency Cash Advance</td>
												<td>
													<?php
														$default = array('covered'=>'no', 'amount'=>'', 'deductable'=>'', 'comments'=>'');
														$arrValues = array_key_exists( 'emergency_cash_advance',$model) ? unserialize($model['emergency_cash_advance']) : $default;
														$arrValues = Util::array_overlay($default, $arrValues);
														$selected = $arrValues['covered'];
														$display = array();
														if ($selected == 'yes')
														{
															$display[] = (!empty($arrValues['amount'])) ? 'Maximum of USD. '.$arrValues['amount'] : '';
															$display[] = (!empty($arrValues['deductable'])) ? 'Deductable upto USD. '.$arrValues['deductable'] : '';
															$display[] = (!empty($arrValues['comments'])) ? $arrValues['comments'] : '';
														}
														else 
															$display[] = 'Not covered';
														$display = array_filter($display);
														$display = (!empty($display)) ? implode(', ', array_filter($display)) : 'Covered';
														echo $display;	
									                ?>
									            </td>
											</tr>
										
											<tr>
												<td>Missed Connections/Departure</td>
												<td>
													<?php
														$default = array('covered'=>'no', 'amount'=>'', 'covered_after'=>'', 'comments'=>'');
														$arrValues = array_key_exists( 'missed_connection',$model) ? unserialize($model['missed_connection']) : $default;
														$arrValues = Util::array_overlay($default, $arrValues);
														$selected = $arrValues['covered'];
														$display = array();
														if ($selected == 'yes')
														{
															$display[] = (!empty($arrValues['amount'])) ? 'Maximum of USD. '.$arrValues['amount'] : '';
															$display[] = (!empty($arrValues['covered_after'])) ? 'Covered after. '.$arrValues['covered_after'].' hrs' : '';
															$display[] = (!empty($arrValues['comments'])) ? $arrValues['comments'] : '';
														}
														else 
															$display[] = 'Not covered';
														$display = array_filter($display);
														$display = (!empty($display)) ? implode(', ', array_filter($display)) : 'Covered';
														echo $display;	
									                ?>
									            </td>
											</tr>
										
											<tr>
												<td>Bounced bookings of Hotel and Airline</td>
												<td>
													<?php
														$default = array('covered'=>'no', 'amount'=>'', 'deductable'=>'', 'comments'=>'');
														$arrValues = array_key_exists( 'bounced_bookings',$model) ? unserialize($model['bounced_bookings']) : $default;
														$arrValues = Util::array_overlay($default, $arrValues);
														$selected = $arrValues['covered'];
														$display = array();
														if ($selected == 'yes')
														{
															$display[] = (!empty($arrValues['amount'])) ? 'Maximum of USD. '.$arrValues['amount'] : '';
															$display[] = (!empty($arrValues['deductable'])) ? 'Deductable upto USD. '.$arrValues['deductable'] : '';
															$display[] = (!empty($arrValues['comments'])) ? $arrValues['comments'] : '';
														}
														else 
															$display[] = 'Not covered';
														$display = array_filter($display);
														$display = (!empty($display)) ? implode(', ', array_filter($display)) : 'Covered';
														echo $display;	
									                ?>
									            </td>
											</tr>
										
											<tr>
												<td>Fraudulent Charges (Payment Card Security)</td>
												<td>
													<?php
													$default = array('covered'=>'no', 'comments'=>'');
													$arrValues = array_key_exists( 'fraudulent_charges',$model) ? unserialize($model['fraudulent_charges']) : $default;
													$arrValues = Util::array_overlay($default, $arrValues);
													$selected = $arrValues['covered'];
													$display = array();
													if ($selected == 'yes')
													{
														$display[] = (!empty($arrValues['comments'])) ? $arrValues['comments'] : '';
													}
													else 
														$display[] = 'Not covered';
													$display = array_filter($display);
													$display = (!empty($display)) ? implode(', ', array_filter($display)) : 'Covered';
													echo $display;	
									                ?>
									            </td>
											</tr>
										
											<tr>
												<td>Home Burglary</td>
												<td>
													<?php
														$default = array('covered'=>'no', 'amount'=>'', 'deductable'=>'', 'comments'=>'');
														$arrValues = array_key_exists( 'home_burglary',$model) ? unserialize($model['home_burglary']) : $default;
														$arrValues = Util::array_overlay($default, $arrValues);
														$selected = $arrValues['covered'];
														$display = array();
														if ($selected == 'yes')
														{
															$display[] = (!empty($arrValues['amount'])) ? 'Maximum of USD. '.$arrValues['amount'] : '';
															$display[] = (!empty($arrValues['deductable'])) ? 'Deductable upto USD. '.$arrValues['deductable'] : '';
															$display[] = (!empty($arrValues['comments'])) ? $arrValues['comments'] : '';
														}
														else 
															$display[] = 'Not covered';
														$display = array_filter($display);
														$display = (!empty($display)) ? implode(', ', array_filter($display)) : 'Covered';
														echo $display;	
									                ?>
									            </td>
											</tr>
										
											<tr>
												<td>Study Interuption</td>
												<td>
													<?php
														$default = array('covered'=>'no', 'amount'=>'', 'deductable'=>'', 'comments'=>'');
														$arrValues = array_key_exists( 'study_interuption',$model) ? unserialize($model['study_interuption']) : $default;
														$arrValues = Util::array_overlay($default, $arrValues);
														$selected = $arrValues['covered'];
														$display = array();
														if ($selected == 'yes')
														{
															$display[] = (!empty($arrValues['amount'])) ? 'Maximum of USD. '.$arrValues['amount'] : '';
															$display[] = (!empty($arrValues['deductable'])) ? 'Deductable upto USD. '.$arrValues['deductable'] : '';
															$display[] = (!empty($arrValues['comments'])) ? $arrValues['comments'] : '';
														}
														else 
															$display[] = 'Not covered';
														$display = array_filter($display);
														$display = (!empty($display)) ? implode(', ', array_filter($display)) : 'Covered';
														echo $display;	
									                ?>
									            </td>
											</tr>
										
											<tr>
												<td>Sponsor Protection</td>
												<td>
													<?php
													$default = array('covered'=>'no', 'comments'=>'');
													$arrValues = array_key_exists( 'sponsor_protection',$model) ? unserialize($model['sponsor_protection']) : $default;
													$arrValues = Util::array_overlay($default, $arrValues);
													$selected = $arrValues['covered'];
													$display = array();
													if ($selected == 'yes')
													{
														$display[] = (!empty($arrValues['comments'])) ? $arrValues['comments'] : '';
													}
													else 
														$display[] = 'Not covered';
													$display = array_filter($display);
													$display = (!empty($display)) ? implode(', ', array_filter($display)) : 'Covered';
													echo $display;	
									                ?>
									            </td>
											</tr>
										
											<tr>
												<td>Compassionate Visit</td>
												<td>
													<?php
														$default = array('covered'=>'no', 'amount'=>'', 'deductable'=>'', 'comments'=>'');
														$arrValues = array_key_exists( 'compassionate_visit',$model) ? unserialize($model['compassionate_visit']) : $default;
														$arrValues = Util::array_overlay($default, $arrValues);
														$selected = $arrValues['covered'];
														$display = array();
														if ($selected == 'yes')
														{
															$display[] = (!empty($arrValues['amount'])) ? 'Maximum of USD. '.$arrValues['amount'] : '';
															$display[] = (!empty($arrValues['deductable'])) ? 'Deductable upto USD. '.$arrValues['deductable'] : '';
															$display[] = (!empty($arrValues['comments'])) ? $arrValues['comments'] : '';
														}
														else 
															$display[] = 'Not covered';
														$display = array_filter($display);
														$display = (!empty($display)) ? implode(', ', array_filter($display)) : 'Covered';
														echo $display;	
									                ?>
									            </td>
											</tr>
										
											<tr>
												<td>Bail Bond</td>
												<td>
													<?php
														$default = array('covered'=>'no', 'amount'=>'', 'deductable'=>'', 'comments'=>'');
														$arrValues = array_key_exists( 'bail_bond',$model) ? unserialize($model['bail_bond']) : $default;
														$arrValues = Util::array_overlay($default, $arrValues);
														$selected = $arrValues['covered'];
														$display = array();
														if ($selected == 'yes')
														{
															$display[] = (!empty($arrValues['amount'])) ? 'Maximum of USD. '.$arrValues['amount'] : '';
															$display[] = (!empty($arrValues['deductable'])) ? 'Deductable upto USD. '.$arrValues['deductable'] : '';
															$display[] = (!empty($arrValues['comments'])) ? $arrValues['comments'] : '';
														}
														else 
															$display[] = 'Not covered';
														$display = array_filter($display);
														$display = (!empty($display)) ? implode(', ', array_filter($display)) : 'Covered';
														echo $display;	
									                ?>
									            </td>
											</tr>
										
											<tr>
												<td>Felonious Assault</td>
												<td>
													<?php
														$default = array('covered'=>'no', 'amount'=>'',  'comments'=>'');
														$arrValues = array_key_exists( 'felonious_assault',$model) ? unserialize($model['felonious_assault']) : $default;
														$arrValues = Util::array_overlay($default, $arrValues);
														$selected = $arrValues['covered'];
														$display = array();
														if ($selected == 'yes')
														{
															$display[] = (!empty($arrValues['amount'])) ? 'Maximum of USD. '.$arrValues['amount'] : '';
															$display[] = (!empty($arrValues['comments'])) ? $arrValues['comments'] : '';
														}
														else 
															$display[] = 'Not covered';
														$display = array_filter($display);
														$display = (!empty($display)) ? implode(', ', array_filter($display)) : 'Covered';
														echo $display;	
									                ?>
									            </td>
											</tr>
										
											<tr>
												<td>Maternity benefit for termination of pregnancy</td>
												<td>
													<?php
														$default = array('covered'=>'no', 'amount'=>'',  'comments'=>'');
														$arrValues = array_key_exists( 'maternity_benefit_for_termination_of_pregnancy',$model) ? unserialize($model['maternity_benefit_for_termination_of_pregnancy']) : $default;
														$arrValues = Util::array_overlay($default, $arrValues);
														$selected = $arrValues['covered'];
														$display = array();
														if ($selected == 'yes')
														{
															$display[] = (!empty($arrValues['amount'])) ? 'Maximum of USD. '.$arrValues['amount'] : '';
															$display[] = (!empty($arrValues['comments'])) ? $arrValues['comments'] : '';
														}
														else 
															$display[] = 'Not covered';
														$display = array_filter($display);
														$display = (!empty($display)) ? implode(', ', array_filter($display)) : 'Covered';
														echo $display;	
									                ?>
									            </td>
											</tr>
										
											<tr>
												<td>Other Medical Treatment(Trip for Medical treatment)</td>
												<td>
													<?php
														$default = array('covered'=>'no', 'amount'=>'',  'comments'=>'');
														$arrValues = array_key_exists( 'other_medical_treatment',$model) ? unserialize($model['other_medical_treatment']) : $default;
														$arrValues = Util::array_overlay($default, $arrValues);
														$selected = $arrValues['covered'];
														$display = array();
														if ($selected == 'yes')
														{
															$display[] = (!empty($arrValues['amount'])) ? 'Maximum of USD. '.$arrValues['amount'] : '';
															$display[] = (!empty($arrValues['comments'])) ? $arrValues['comments'] : '';
														}
														else 
															$display[] = 'Not covered';
														$display = array_filter($display);
														$display = (!empty($display)) ? implode(', ', array_filter($display)) : 'Covered';
														echo $display;	
									                ?>
									            </td>
											</tr>
										
											<tr>
												<td>Red 24 Services</td>
												<td>
													<?php
														$default = array('covered'=>'no', 'amount'=>'',  'comments'=>'');
														$arrValues = array_key_exists( 'red_services',$model) ? unserialize($model['red_services']) : $default;
														$arrValues = Util::array_overlay($default, $arrValues);
														$selected = $arrValues['covered'];
														$display = array();
														if ($selected == 'yes')
														{
															$display[] = (!empty($arrValues['amount'])) ? 'Maximum of USD. '.$arrValues['amount'] : '';
															$display[] = (!empty($arrValues['comments'])) ? $arrValues['comments'] : '';
														}
														else 
															$display[] = 'Not covered';
														$display = array_filter($display);
														$display = (!empty($display)) ? implode(', ', array_filter($display)) : 'Covered';
														echo $display;	
									                ?>
									            </td>
											</tr>
										
											<tr>
												<td>Assistance Services</td>
												<td>
													<?php
														$default = array('covered'=>'no', 'amount'=>'', 'deductable'=>'', 'comments'=>'');
														$arrValues = array_key_exists( 'assistance_services',$model) ? unserialize($model['assistance_services']) : $default;
														$arrValues = Util::array_overlay($default, $arrValues);
														$selected = $arrValues['covered'];
														$display = array();
														if ($selected == 'yes')
														{
															$display[] = (!empty($arrValues['amount'])) ? 'Maximum of USD. '.$arrValues['amount'] : '';
															$display[] = (!empty($arrValues['deductable'])) ? 'Deductable upto USD. '.$arrValues['deductable'] : '';
															$display[] = (!empty($arrValues['comments'])) ? $arrValues['comments'] : '';
														}
														else 
															$display[] = 'Not covered';
														$display = array_filter($display);
														$display = (!empty($display)) ? implode(', ', array_filter($display)) : 'Covered';
														echo $display;	
									                ?>
									            </td>
											</tr>
										
										
											<tr>
												<td>In - Hospital Indemnity Accident</td>
												<td>
													<?php
														$default = array('covered'=>'no', 'amount'=>'', 'deductable'=>'','max_days'=>'', 'comments'=>'');
														$arrValues = array_key_exists( 'in_hospital_indemnity_accident',$model) ? unserialize($model['in_hospital_indemnity_accident']) : $default;
														$arrValues = Util::array_overlay($default, $arrValues);
														$selected = $arrValues['covered'];
														$display = array();
														if ($selected == 'yes')
														{
															$display[] = (!empty($arrValues['amount'])) ? 'Maximum of USD. '.$arrValues['amount'] : '';
															$display[] = (!empty($arrValues['deductable'])) ? 'Deductable upto USD. '.$arrValues['deductable'] : '';
															$display[] = (!empty($arrValues['max_days'])) ? 'Maximum upto. '.$arrValues['max_days'].' days' : '';
															$display[] = (!empty($arrValues['comments'])) ? $arrValues['comments'] : '';
														}
														else 
															$display[] = 'Not covered';
														$display = array_filter($display);
														$display = (!empty($display)) ? implode(', ', array_filter($display)) : 'Covered';
														echo $display;	
									                ?>
									            </td>
											</tr>
										
										
											<tr>
												<td>Accommodation charges due to Trip Delay</td>
												<td>
													<?php
														$default = array('covered'=>'no', 'amount'=>'', 'deductable'=>'', 'comments'=>'');
														$arrValues = array_key_exists( 'accommodation_charges_on_delay',$model) ? unserialize($model['accommodation_charges_on_delay']) : $default;
														$arrValues = Util::array_overlay($default, $arrValues);
														$selected = $arrValues['covered'];
														$display = array();
														if ($selected == 'yes')
														{
															$display[] = (!empty($arrValues['amount'])) ? 'Maximum of USD. '.$arrValues['amount'] : '';
															$display[] = (!empty($arrValues['deductable'])) ? 'Deductable upto USD. '.$arrValues['deductable'] : '';
															$display[] = (!empty($arrValues['max_days'])) ? 'Maximum upto. '.$arrValues['max_days'].' days' : '';
															$display[] = (!empty($arrValues['comments'])) ? $arrValues['comments'] : '';
														}
														else 
															$display[] = 'Not covered';
														$display = array_filter($display);
														$display = (!empty($display)) ? implode(', ', array_filter($display)) : 'Covered';
														echo $display;	
									                ?>
									            </td>
											</tr>
										
										
											<tr>
												<td>Loss of Ticket</td>
												<td>
													<?php
														$default = array('covered'=>'no', 'amount'=>'', 'deductable'=>'', 'comments'=>'');
														$arrValues = array_key_exists( 'loss_of_ticket',$model) ? unserialize($model['loss_of_ticket']) : $default;
														$arrValues = Util::array_overlay($default, $arrValues);
														$selected = $arrValues['covered'];
														$display = array();
														if ($selected == 'yes')
														{
															$display[] = (!empty($arrValues['amount'])) ? 'Maximum of USD. '.$arrValues['amount'] : '';
															$display[] = (!empty($arrValues['deductable'])) ? 'Deductable upto USD. '.$arrValues['deductable'] : '';
															$display[] = (!empty($arrValues['comments'])) ? $arrValues['comments'] : '';
														}
														else 
															$display[] = 'Not covered';
														$display = array_filter($display);
														$display = (!empty($display)) ? implode(', ', array_filter($display)) : 'Covered';
														echo $display;	
									                ?>
									            </td>
											</tr>
										
										
											<tr>
												<td>Transportation</td>
												<td>
													<?php
														$default = array('covered'=>'no', 'amount'=>'', 'deductable'=>'', 'comments'=>'');
														$arrValues = array_key_exists( 'transportation',$model) ? unserialize($model['transportation']) : $default;
														$arrValues = Util::array_overlay($default, $arrValues);
														$selected = $arrValues['covered'];
														$display = array();
														if ($selected == 'yes')
														{
															$display[] = (!empty($arrValues['amount'])) ? 'Maximum of USD. '.$arrValues['amount'] : '';
															$display[] = (!empty($arrValues['deductable'])) ? 'Deductable upto USD. '.$arrValues['deductable'] : '';
															$display[] = (!empty($arrValues['comments'])) ? $arrValues['comments'] : '';
														}
														else 
															$display[] = 'Not covered';
														$display = array_filter($display);
														$display = (!empty($display)) ? implode(', ', array_filter($display)) : 'Covered';
														echo $display;	
									                ?>
									            </td>
											</tr>
										
										
											<tr>
												<td>Replacement of Staff ( Business Trip Only)</td>
												<td>
													<?php
														$default = array('covered'=>'no', 'amount'=>'', 'deductable'=>'', 'comments'=>'');
														$arrValues = array_key_exists( 'replacement_of_staff',$model) ? unserialize($model['replacement_of_staff']) : $default;
														$arrValues = Util::array_overlay($default, $arrValues);
														$selected = $arrValues['covered'];
														$display = array();
														if ($selected == 'yes')
														{
															$display[] = (!empty($arrValues['amount'])) ? 'Maximum of USD. '.$arrValues['amount'] : '';
															$display[] = (!empty($arrValues['deductable'])) ? 'Deductable upto USD. '.$arrValues['deductable'] : '';
															$display[] = (!empty($arrValues['comments'])) ? $arrValues['comments'] : '';
														}
														else 
															$display[] = 'Not covered';
														$display = array_filter($display);
														$display = (!empty($display)) ? implode(', ', array_filter($display)) : 'Covered';
														echo $display;	
									                ?>
									            </td>
											</tr>
										
										
											<tr>
												<td>Loss Of Personal Documents</td>
												<td>
													<?php
														$default = array('covered'=>'no', 'amount'=>'', 'deductable'=>'', 'comments'=>'');
														$arrValues = array_key_exists( 'loss_of_personal_documents',$model) ? unserialize($model['loss_of_personal_documents']) : $default;
														$arrValues = Util::array_overlay($default, $arrValues);
														$selected = $arrValues['covered'];
														$display = array();
														if ($selected == 'yes')
														{
															$display[] = (!empty($arrValues['amount'])) ? 'Maximum of USD. '.$arrValues['amount'] : '';
															$display[] = (!empty($arrValues['deductable'])) ? 'Deductable upto USD. '.$arrValues['deductable'] : '';
															$display[] = (!empty($arrValues['comments'])) ? $arrValues['comments'] : '';
														}
														else 
															$display[] = 'Not covered';
														$display = array_filter($display);
														$display = (!empty($display)) ? implode(', ', array_filter($display)) : 'Covered';
														echo $display;	
									                ?>
									            </td>
											</tr>
										
										
											<tr>
												<td>Childcare Benefits</td>
												<td>
													<?php
														$default = array('covered'=>'no', 'amount'=>'', 'deductable'=>'','max_days'=>'', 'comments'=>'');
														$arrValues = array_key_exists( 'childcare_benefits',$model) ? unserialize($model['childcare_benefits']) : $default;
														$arrValues = Util::array_overlay($default, $arrValues);
														$selected = $arrValues['covered'];
														$display = array();
														if ($selected == 'yes')
														{
															$display[] = (!empty($arrValues['amount'])) ? 'Maximum of USD. '.$arrValues['amount'] : '';
															$display[] = (!empty($arrValues['deductable'])) ? 'Deductable upto USD. '.$arrValues['deductable'] : '';
															$display[] = (!empty($arrValues['max_days'])) ? 'Maximum for '.$arrValues['max_days'].' days' : '';
															$display[] = (!empty($arrValues['comments'])) ? $arrValues['comments'] : '';
														}
														else 
															$display[] = 'Not covered';
														$display = array_filter($display);
														$display = (!empty($display)) ? implode(', ', array_filter($display)) : 'Covered';
														echo $display;	
									                ?>
									            </td>
											</tr>
										
										
											<tr>
												<td>Political Risk and Catastrop Evacuation</td>
												<td>
													<?php
														$default = array('covered'=>'no', 'amount'=>'', 'deductable'=>'', 'comments'=>'');
														$arrValues = array_key_exists( 'political_risk_and_catastrop_evacuation',$model) ? unserialize($model['political_risk_and_catastrop_evacuation']) : $default;
														$arrValues = Util::array_overlay($default, $arrValues);
														$selected = $arrValues['covered'];
														$display = array();
														if ($selected == 'yes')
														{
															$display[] = (!empty($arrValues['amount'])) ? 'Maximum of USD. '.$arrValues['amount'] : '';
															$display[] = (!empty($arrValues['deductable'])) ? 'Deductable upto USD. '.$arrValues['deductable'] : '';
															$display[] = (!empty($arrValues['comments'])) ? $arrValues['comments'] : '';
														}
														else 
															$display[] = 'Not covered';
														$display = array_filter($display);
														$display = (!empty($display)) ? implode(', ', array_filter($display)) : 'Covered';
														echo $display;	
									                ?>
									            </td>
											</tr>
										
										
											<tr>
												<td>Fire Cover for Building</td>
												<td>
													<?php
														$default = array('covered'=>'no', 'amount'=>'', 'deductable'=>'', 'comments'=>'');
														$arrValues = array_key_exists( 'fire_cover_for_building',$model) ? unserialize($model['fire_cover_for_building']) : $default;
														$arrValues = Util::array_overlay($default, $arrValues);
														$selected = $arrValues['covered'];
														$display = array();
														if ($selected == 'yes')
														{
															$display[] = (!empty($arrValues['amount'])) ? 'Maximum of USD. '.$arrValues['amount'] : '';
															$display[] = (!empty($arrValues['deductable'])) ? 'Deductable upto USD. '.$arrValues['deductable'] : '';
															$display[] = (!empty($arrValues['comments'])) ? $arrValues['comments'] : '';
														}
														else 
															$display[] = 'Not covered';
														$display = array_filter($display);
														$display = (!empty($display)) ? implode(', ', array_filter($display)) : 'Covered';
														echo $display;	
									                ?>
									            </td>
											</tr>
										
										
											<tr>
												<td>Fire Cover for Home Content</td>
												<td>
													<?php
														$default = array('covered'=>'no', 'amount'=>'', 'deductable'=>'', 'comments'=>'');
														$arrValues = array_key_exists( 'fire_cover_for_home_content',$model) ? unserialize($model['fire_cover_for_home_content']) : $default;
														$arrValues = Util::array_overlay($default, $arrValues);
														$selected = $arrValues['covered'];
														$display = array();
														if ($selected == 'yes')
														{
															$display[] = (!empty($arrValues['amount'])) ? 'Maximum of USD. '.$arrValues['amount'] : '';
															$display[] = (!empty($arrValues['deductable'])) ? 'Deductable upto USD. '.$arrValues['deductable'] : '';
															$display[] = (!empty($arrValues['comments'])) ? $arrValues['comments'] : '';
														}
														else 
															$display[] = 'Not covered';
														$display = array_filter($display);
														$display = (!empty($display)) ? implode(', ', array_filter($display)) : 'Covered';
														echo $display;	
									                ?>
									            </td>
											</tr>
										
										
											<tr>
												<td>Emergency Hotel Extension</td>
												<td>
													<?php
														$default = array('covered'=>'no', 'amount'=>'', 'deductable'=>'', 'comments'=>'');
														$arrValues = array_key_exists( 'emergency_hotel_extension',$model) ? unserialize($model['emergency_hotel_extension']) : $default;
														$arrValues = Util::array_overlay($default, $arrValues);
														$selected = $arrValues['covered'];
														$display = array();
														if ($selected == 'yes')
														{
															$display[] = (!empty($arrValues['amount'])) ? 'Maximum of USD. '.$arrValues['amount'] : '';
															$display[] = (!empty($arrValues['deductable'])) ? 'Deductable upto USD. '.$arrValues['deductable'] : '';
															$display[] = (!empty($arrValues['comments'])) ? $arrValues['comments'] : '';
														}
														else 
															$display[] = 'Not covered';
														$display = array_filter($display);
														$display = (!empty($display)) ? implode(', ', array_filter($display)) : 'Covered';
														echo $display;	
									                ?>
									            </td>
											</tr>
										
										
											<tr>
												<td>Return of Minor Child(ren)</td>
												<td>
													<?php
														$default = array('covered'=>'no', 'amount'=>'', 'deductable'=>'', 'comments'=>'');
														$arrValues = array_key_exists( 'return_of_minor_children',$model) ? unserialize($model['return_of_minor_children']) : $default;
														$arrValues = Util::array_overlay($default, $arrValues);
														$selected = $arrValues['covered'];
														$display = array();
														if ($selected == 'yes')
														{
															$display[] = (!empty($arrValues['amount'])) ? 'Maximum of USD. '.$arrValues['amount'] : '';
															$display[] = (!empty($arrValues['deductable'])) ? 'Deductable upto USD. '.$arrValues['deductable'] : '';
															$display[] = (!empty($arrValues['comments'])) ? $arrValues['comments'] : '';
														}
														else 
															$display[] = 'Not covered';
														$display = array_filter($display);
														$display = (!empty($display)) ? implode(', ', array_filter($display)) : 'Covered';
														echo $display;	
									                ?>
									            </td>
											</tr>
										
										
											<tr>
												<td>Golfer Hole-in-one</td>
												<td>
													<?php
														$default = array('covered'=>'no', 'amount'=>'', 'deductable'=>'', 'comments'=>'');
														$arrValues = array_key_exists( 'golfe_hole_in_one',$model) ? unserialize($model['golfe_hole_in_one']) : $default;
														$arrValues = Util::array_overlay($default, $arrValues);
														$selected = $arrValues['covered'];
														$display = array();
														if ($selected == 'yes')
														{
															$display[] = (!empty($arrValues['amount'])) ? 'Maximum of USD. '.$arrValues['amount'] : '';
															$display[] = (!empty($arrValues['deductable'])) ? 'Deductable upto USD. '.$arrValues['deductable'] : '';
															$display[] = (!empty($arrValues['comments'])) ? $arrValues['comments'] : '';
														}
														else 
															$display[] = 'Not covered';
														$display = array_filter($display);
														$display = (!empty($display)) ? implode(', ', array_filter($display)) : 'Covered';
														echo $display;	
									                ?>
									            </td>
											</tr>
										
										
											<tr>
												<td>Any one illness</td>
												<td>
													<?php
														$default = array('covered'=>'no', 'amount'=>'', 'deductable'=>'', 'comments'=>'');
														$arrValues = array_key_exists( 'any_one_illness',$model) ? unserialize($model['any_one_illness']) : $default;
														$arrValues = Util::array_overlay($default, $arrValues);
														$selected = $arrValues['covered'];
														$display = array();
														if ($selected == 'yes')
														{
															$display[] = (!empty($arrValues['amount'])) ? 'Maximum of USD. '.$arrValues['amount'] : '';
															$display[] = (!empty($arrValues['deductable'])) ? 'Deductable upto USD. '.$arrValues['deductable'] : '';
															$display[] = (!empty($arrValues['comments'])) ? $arrValues['comments'] : '';
														}
														else 
															$display[] = 'Not covered';
														$display = array_filter($display);
														$display = (!empty($display)) ? implode(', ', array_filter($display)) : 'Covered';
														echo $display;	
									                ?>
									            </td>
											</tr>
										
											<tr>
												<td>Any one accident</td>
												<td>
													<?php
														$default = array('covered'=>'no', 'amount'=>'', 'deductable'=>'', 'comments'=>'');
														$arrValues = array_key_exists( 'any_one_accident',$model) ? unserialize($model['any_one_accident']) : $default;
														$arrValues = Util::array_overlay($default, $arrValues);
														$selected = $arrValues['covered'];
														$display = array();
														if ($selected == 'yes')
														{
															$display[] = (!empty($arrValues['amount'])) ? 'Maximum of USD. '.$arrValues['amount'] : '';
															$display[] = (!empty($arrValues['deductable'])) ? 'Deductable upto USD. '.$arrValues['deductable'] : '';
															$display[] = (!empty($arrValues['comments'])) ? $arrValues['comments'] : '';
														}
														else 
															$display[] = 'Not covered';
														$display = array_filter($display);
														$display = (!empty($display)) ? implode(', ', array_filter($display)) : 'Covered';
														echo $display;	
									                ?>
									            </td>
											</tr>
										
											<tr>
												<td>Tution Fees</td>
												<td>
													<?php
														$default = array('covered'=>'no', 'amount'=>'', 'deductable'=>'', 'comments'=>'');
														$arrValues = array_key_exists( 'tution_fees',$model) ? unserialize($model['tution_fees']) : $default;
														$arrValues = Util::array_overlay($default, $arrValues);
														$selected = $arrValues['covered'];
														$display = array();
														if ($selected == 'yes')
														{
															$display[] = (!empty($arrValues['amount'])) ? 'Maximum of USD. '.$arrValues['amount'] : '';
															$display[] = (!empty($arrValues['deductable'])) ? 'Deductable upto USD. '.$arrValues['deductable'] : '';
															$display[] = (!empty($arrValues['comments'])) ? $arrValues['comments'] : '';
														}
														else 
															$display[] = 'Not covered';
														$display = array_filter($display);
														$display = (!empty($display)) ? implode(', ', array_filter($display)) : 'Covered';
														echo $display;	
									                ?>
									            </td>
											</tr>
										
											<tr>
												<td>Accident to Sponsor</td>
												<td>
													<?php
														$default = array('covered'=>'no', 'amount'=>'', 'deductable'=>'', 'comments'=>'');
														$arrValues = array_key_exists( 'accident_to_sponsor',$model) ? unserialize($model['accident_to_sponsor']) : $default;
														$arrValues = Util::array_overlay($default, $arrValues);
														$selected = $arrValues['covered'];
														$display = array();
														if ($selected == 'yes')
														{
															$display[] = (!empty($arrValues['amount'])) ? 'Maximum of USD. '.$arrValues['amount'] : '';
															$display[] = (!empty($arrValues['deductable'])) ? 'Deductable upto USD. '.$arrValues['deductable'] : '';
															$display[] = (!empty($arrValues['comments'])) ? $arrValues['comments'] : '';
														}
														else 
															$display[] = 'Not covered';
														$display = array_filter($display);
														$display = (!empty($display)) ? implode(', ', array_filter($display)) : 'Covered';
														echo $display;	
									                ?>
									            </td>
											</tr>
										
											<tr>
												<td>Family Visit</td>
												<td>
													<?php
														$default = array('covered'=>'no', 'amount'=>'', 'deductable'=>'', 'comments'=>'');
														$arrValues = array_key_exists( 'family_visit',$model) ? unserialize($model['family_visit']) : $default;
														$arrValues = Util::array_overlay($default, $arrValues);
														$selected = $arrValues['covered'];
														$display = array();
														if ($selected == 'yes')
														{
															$display[] = (!empty($arrValues['amount'])) ? 'Maximum of USD. '.$arrValues['amount'] : '';
															$display[] = (!empty($arrValues['deductable'])) ? 'Deductable upto USD. '.$arrValues['deductable'] : '';
															$display[] = (!empty($arrValues['comments'])) ? $arrValues['comments'] : '';
														}
														else 
															$display[] = 'Not covered';
														$display = array_filter($display);
														$display = (!empty($display)) ? implode(', ', array_filter($display)) : 'Covered';
														echo $display;	
									                ?>
									            </td>
											</tr>
										
											<tr>
												<td>International Driving License Loss</td>
												<td>
													<?php
														$default = array('covered'=>'no', 'amount'=>'', 'deductable'=>'', 'comments'=>'');
														$arrValues = array_key_exists( 'international_driving_license_loss',$model) ? unserialize($model['international_driving_license_loss']) : $default;
														$arrValues = Util::array_overlay($default, $arrValues);
														$selected = $arrValues['covered'];
														$display = array();
														if ($selected == 'yes')
														{
															$display[] = (!empty($arrValues['amount'])) ? 'Maximum of USD. '.$arrValues['amount'] : '';
															$display[] = (!empty($arrValues['deductable'])) ? 'Deductable upto USD. '.$arrValues['deductable'] : '';
															$display[] = (!empty($arrValues['comments'])) ? $arrValues['comments'] : '';
														}
														else 
															$display[] = 'Not covered';
														$display = array_filter($display);
														$display = (!empty($display)) ? implode(', ', array_filter($display)) : 'Covered';
														echo $display;	
									                ?>
									            </td>
											</tr>
										
											<tr>
												<td>Re Union Expenses</td>
												<td>
													<?php
														$default = array('covered'=>'no', 'amount'=>'', 'deductable'=>'', 'comments'=>'');
														$arrValues = array_key_exists( 'reunion_expenses',$model) ? unserialize($model['reunion_expenses']) : $default;
														$arrValues = Util::array_overlay($default, $arrValues);
														$selected = $arrValues['covered'];
														$display = array();
														if ($selected == 'yes')
														{
															$display[] = (!empty($arrValues['amount'])) ? 'Maximum of USD. '.$arrValues['amount'] : '';
															$display[] = (!empty($arrValues['deductable'])) ? 'Deductable upto USD. '.$arrValues['deductable'] : '';
															$display[] = (!empty($arrValues['comments'])) ? $arrValues['comments'] : '';
														}
														else 
															$display[] = 'Not covered';
														$display = array_filter($display);
														$display = (!empty($display)) ? implode(', ', array_filter($display)) : 'Covered';
														echo $display;	
									                ?>
									            </td>
											</tr>
										
											<tr>
												<td>Transportation Of Mortal Remains</td>
												<td>
													<?php
														$default = array('covered'=>'no', 'amount'=>'', 'deductable'=>'', 'comments'=>'');
														$arrValues = array_key_exists( 'transportation_of_mortal_remains',$model) ? unserialize($model['transportation_of_mortal_remains']) : $default;
														$arrValues = Util::array_overlay($default, $arrValues);
														$selected = $arrValues['covered'];
														$display = array();
														if ($selected == 'yes')
														{
															$display[] = (!empty($arrValues['amount'])) ? 'Maximum of USD. '.$arrValues['amount'] : '';
															$display[] = (!empty($arrValues['deductable'])) ? 'Deductable upto USD. '.$arrValues['deductable'] : '';
															$display[] = (!empty($arrValues['comments'])) ? $arrValues['comments'] : '';
														}
														else 
															$display[] = 'Not covered';
														$display = array_filter($display);
														$display = (!empty($display)) ? implode(', ', array_filter($display)) : 'Covered';
														echo $display;	
									                ?>
									            </td>
											</tr>
										
											<tr>
												<td>PED</td>
												<td>
													<?php
														$default = array('covered'=>'no', 'amount'=>'', 'deductable'=>'', 'comments'=>'');
														$arrValues = array_key_exists( 'ped',$model) ? unserialize($model['ped']) : $default;
														$arrValues = Util::array_overlay($default, $arrValues);
														$selected = $arrValues['covered'];
														$display = array();
														if ($selected == 'yes')
														{
															$display[] = (!empty($arrValues['amount'])) ? 'Maximum of USD. '.$arrValues['amount'] : '';
															$display[] = (!empty($arrValues['deductable'])) ? 'Deductable upto USD. '.$arrValues['deductable'] : '';
															$display[] = (!empty($arrValues['comments'])) ? $arrValues['comments'] : '';
														}
														else 
															$display[] = 'Not covered';
														$display = array_filter($display);
														$display = (!empty($display)) ? implode(', ', array_filter($display)) : 'Covered';
														echo $display;	
									                ?>
									            </td>
											</tr>
										
											<tr>
												<td>Additioal SI for Accidental Hospitalization</td>
												<td>
													<?php
														$default = array('covered'=>'no', 'amount'=>'', 'deductable'=>'', 'comments'=>'');
														$arrValues = array_key_exists( 'additioal_si_for_accidental_hospitalization',$model) ? unserialize($model['additioal_si_for_accidental_hospitalization']) : $default;
														$arrValues = Util::array_overlay($default, $arrValues);
														$selected = $arrValues['covered'];
														$display = array();
														if ($selected == 'yes')
														{
															$display[] = (!empty($arrValues['amount'])) ? 'Maximum of USD. '.$arrValues['amount'] : '';
															$display[] = (!empty($arrValues['deductable'])) ? 'Deductable upto USD. '.$arrValues['deductable'] : '';
															$display[] = (!empty($arrValues['comments'])) ? $arrValues['comments'] : '';
														}
														else 
															$display[] = 'Not covered';
														$display = array_filter($display);
														$display = (!empty($display)) ? implode(', ', array_filter($display)) : 'Covered';
														echo $display;	
									                ?>
									            </td>
											</tr>
										
											<tr>
												<td>Out Patient care</td>
												<td>
													<?php
														$default = array('covered'=>'no', 'amount'=>'', 'deductable'=>'', 'comments'=>'');
														$arrValues = array_key_exists( 'out_patient_care',$model) ? unserialize($model['out_patient_care']) : $default;
														$arrValues = Util::array_overlay($default, $arrValues);
														$selected = $arrValues['covered'];
														$display = array();
														if ($selected == 'yes')
														{
															$display[] = (!empty($arrValues['amount'])) ? 'Maximum of USD. '.$arrValues['amount'] : '';
															$display[] = (!empty($arrValues['deductable'])) ? 'Deductable upto USD. '.$arrValues['deductable'] : '';
															$display[] = (!empty($arrValues['comments'])) ? $arrValues['comments'] : '';
														}
														else 
															$display[] = 'Not covered';
														$display = array_filter($display);
														$display = (!empty($display)) ? implode(', ', array_filter($display)) : 'Covered';
														echo $display;	
									                ?>
									            </td>
											</tr>
										
											<tr>
												<td>Business Class</td>
												<td>
													<?php
														$default = array('covered'=>'no', 'amount'=>'', 'deductable'=>'', 'comments'=>'');
														$arrValues = array_key_exists( 'Business Class',$model) ? unserialize($model['Business Class']) : $default;
														$arrValues = Util::array_overlay($default, $arrValues);
														$selected = $arrValues['covered'];
														$display = array();
														if ($selected == 'yes')
														{
															$display[] = (!empty($arrValues['amount'])) ? 'Maximum of USD. '.$arrValues['amount'] : '';
															$display[] = (!empty($arrValues['deductable'])) ? 'Deductable upto USD. '.$arrValues['deductable'] : '';
															$display[] = (!empty($arrValues['comments'])) ? $arrValues['comments'] : '';
														}
														else 
															$display[] = 'Not covered';
														$display = array_filter($display);
														$display = (!empty($display)) ? implode(', ', array_filter($display)) : 'Covered';
														echo $display;	
									                ?>
									            </td>
											</tr>
										
										
										</tbody>
									</table>
	
	
								</div>
							</div>
	
		
						</div>
<?php 				}
				}
?>				

					</div>




				</div>
			</div>



		










		<div class="row pad">
			<div class="col-sm-12">

				<h3 class="  header_in cus_mar" style="margin-bottom: 15px;">Tax
					Benefits</h3>
				<p><?php echo $policyDetails['policy']['policy_tax_benefits']?></p>

				<h2 class="lined-heading one_time" id="ad_show_claim">
					<span>Additional Details</span>
				</h2>
			</div>
			<div class="tabs-group product-collateral">
				<div class="row">
					<?php echo widget::run('additionalDetailsFront', array('companyDetails'=>$companyDetails, 'policyDetails'=>$policyDetails,'claimRatioJson'=>$claimRatioJson))?>
				</div>
			</div>
		</div>
		
		<div class="row pad" id="thisdiv">
<?php 		if (!empty($peerComparisionResult)) 
			{	?>		
				<div class="col-sm-12">
					<h2 class="lined-heading">
						<span>Annual Premium - Peer Comparison</span>
					</h2>
				</div>
				
				<?php
				echo widget::run(	'peerComparisionFront', array(	'company'=>$company, 'policyDetails'=>$policyDetails['policy'], 
																	'peerComparisionResult'=>$peerComparisionResult,'policyVariants'=> $variantNames,
																	'type'=>'travel', 'variantType'=>$variantType, 'features'=>$vFeatures));?>
				
<?php 		}	?>			
			<div class="row">
				<div class="col-sm-12">
					<h2 class="lined-heading" style="margin-top: 90px;">
						<span>How much term insurance cover should I take?</span>
					</h2>
				</div>
				<div class="block grey-lighter clearfix">
					<div class="wrap">
						<h2>Your Details</h2>
						<div class="calculator-loan">
							<div class="fifty form">
								<div class="accrue-field-amount">
									<p>
										<label>Annual Income:</label> <input type="text" value="1200"
											class="amount" id="la_value">
									</p>
								</div>
								<div class="accrue-field-rate">
									<p>
										<label>Age:</label> <input type="text" value="30" class="rate"
											id="nm_value">
									</p>
								</div>
								<div class="accrue-field-term">
									<p>
										<label>Amount of Cover from Existing Policies:</label> <input
											type="text" value="2000" class="term" id="roi_value">
									</p>
								</div>
							</div>
							<div class="fifty">
								<p>
									<label>Recommended Plan Parameters:</label>
								</p>
								<div class="results">
									<p>
										<strong>Cover Amount:</strong><br> <span class="r_c" id="emi">2,31,508</span>
									</p>
									<p>
										<strong>Policy Term:</strong><br> <span class="r_c"
											id="months">30 Years</span>
									</p>
								</div>
							</div>


						</div>
						<div class="cal">
							<a class="btn_offer_block" href="javascript:void(0)">Compare
								plans for this cover <i class="fa fa-angle-right"></i> </a>
						</div>
						<div class="clear"></div>
					</div>
				</div>
			</div>

<?php 
		if (!empty($policyDetails['policy']['brochure_images']))
		{	
			$policy_wordings_images = array_filter(explode(',', $policyDetails['policy']['brochure_images']));
			?>
			<div class="row">
				<div class="col-sm-12">
					<h2 class="lined-heading">
						<span><?php echo $policyDetails['policy']['policy_name'];?> Brochure</span>
					</h2>
				</div>
				<div class="col-sm-12">
					<div class="sixteen columns">
						<div class="portfolio clearfix">
							<ul class="list">
						<?php 	
								$folderUrl = $this->config->config['folder_path']['policy']['brochure_thumbnails'];
								$fileUrl = $this->config->config['url_path']['policy']['brochure_thumbnails'];
								$i = 1;
								if (!empty($policy_wordings_images))
								{
									foreach ($policy_wordings_images as $k1=>$v1)
									{	
										if (isset($v1) && !empty($v1))
										{				
											if (file_exists($folderUrl.$v1))
											{	?>
												<li class="" data-content="#wording_c<?php echo $i;?>">
													<div class="thumb">
														<a class="button colio-link" href="#">
															<div class="view"></div>
														</a> 
														<img src="<?php echo $fileUrl.$v1;?>" alt="Pic" />
													</div>
												</li>
					<?php 					$i++;
											}
										}
									}
								}	?>
							</ul>
							<!-- list -->

						</div>
						<!-- portfolio -->
						<!-- colio-content # colio_c1 -->
						<?php 	
								$folderUrl = $this->config->config['folder_path']['policy']['brochure_images'];
								$fileUrl = $this->config->config['url_path']['policy']['brochure_images'];
								$i = 1;
								if (!empty($policy_wordings_images))
								{
									foreach ($policy_wordings_images as $k1=>$v1)
									{	
										if (isset($v1) && !empty($v1))
										{				
											if (file_exists($folderUrl.$v1))
											{	?>
												<div id="wording_c<?php echo $i;?>" class="colio-content">
													<div class="main">
														<div align="center">
															<span class='zoom'> 
																<img src='<?php echo $fileUrl.$v1;?>' width="600" height="680" alt='' /> 
															</span>
														</div>
													</div>
												</div>
					<?php 					$i++;
											}
										}
									}
								}	?>
					</div>
				</div>
			</div>
<?php 	}?>





<?php 
		if (!empty($policyDetails['policy']['policy_wordings_images']))
		{	
			$policy_wordings_images = array_filter(explode(',', $policyDetails['policy']['policy_wordings_images']));
			?>
			<div class="row">
				<div class="col-sm-12">
					<h2 class="lined-heading">
						<span><?php echo $policyDetails['policy']['policy_name'];?> policy wording</span>
					</h2>
				</div>
				<div class="col-sm-12">
					<div class="sixteen columns">
						<div class="portfolio clearfix">
							<ul class="list">
						<?php 	
								$folderUrl = $this->config->config['folder_path']['policy']['policy_wordings_thumbnails'];
								$fileUrl = $this->config->config['url_path']['policy']['policy_wordings_thumbnails'];
								$i = 1;
								if (!empty($policy_wordings_images))
								{
									foreach ($policy_wordings_images as $k1=>$v1)
									{	
										if (isset($v1) && !empty($v1))
										{				
											if (file_exists($folderUrl.$v1))
											{	?>
												<li class="" data-content="#wording_c<?php echo $i;?>">
													<div class="thumb">
														<a class="button colio-link" href="#">
															<div class="view"></div>
														</a> 
														<img src="<?php echo $fileUrl.$v1;?>" alt="Pic" />
													</div>
												</li>
					<?php 					$i++;
											}
										}
									}
								}	?>
							</ul>
							<!-- list -->

						</div>
						<!-- portfolio -->
						<!-- colio-content # colio_c1 -->
						<?php 	
								$folderUrl = $this->config->config['folder_path']['policy']['policy_wordings_images'];
								$fileUrl = $this->config->config['url_path']['policy']['policy_wordings_images'];
								$i = 1;
								if (!empty($policy_wordings_images))
								{
									foreach ($policy_wordings_images as $k1=>$v1)
									{	
										if (isset($v1) && !empty($v1))
										{				
											if (file_exists($folderUrl.$v1))
											{	?>
												<div id="wording_c<?php echo $i;?>" class="colio-content">
													<div class="main">
														<div align="center">
															<span class='zoom'> 
																<img src='<?php echo $fileUrl.$v1;?>' width="600" height="680" alt='' /> 
															</span>
														</div>
													</div>
												</div>
					<?php 					$i++;
											}
										}
									}
								}	?>
					</div>
				</div>
			</div>
<?php 	}		?>





























			<div class="row">
				<div class="col-sm-12">
					<h2 class="lined-heading">
						<span>Lets see how you comapre</span>
					</h2>
				</div>

				<section class="">
				<div class="" id="t0">
					<div class="row-fluid">
						<div class="col-md-6">


							<div style="width: 100%; float: left" class="advpolls">
								<form method="post" class="advpolls-form">
									<h3 class="advpolls-title">MIC Poll 1</h3>

									<div class="advpolls-body">
										<div class="advpolls-question">How much life insurance cover
											do yo have?</div>
										<div class="advpolls-answers">
											<ul>
												<li><label> <input type="checkbox" value="1"
														name="answers[]"> < 10 times your annual income. </label>
												</li>
												<li><label> <input type="checkbox" value="2"
														name="answers[]"> > 10 times your annual income. </label>
												</li>

											</ul>
										</div>
									</div>
									<div class="advpolls-buttons">
										<input type="submit" value="Submit"
											class="btn btn-primary advpolls-vote"> <a
											class="advpolls-showresult" href="javascript:void(0);"> View
											Results </a>
									</div>

									<input type="hidden" value="1" name="id"> <input type="hidden"
										value="1" name="maxChoices">
								</form>
							</div>
						</div>







						<div class="col-md-6">


							<div style="width: 100%; float: left" class="advpolls">
								<form method="post" class="advpolls-form">
									<h3 class="advpolls-title">MIC Poll 2</h3>

									<div class="advpolls-body">
										<div class="advpolls-question">Is internet your primary source
											of research for insurance?</div>
										<div class="advpolls-answers">
											<ul>
												<li><label> <input type="checkbox" value="1"
														name="answers[]"> Yes </label>
												</li>
												<li><label> <input type="checkbox" value="2"
														name="answers[]"> No </label>
												</li>

											</ul>
										</div>
									</div>
									<div class="advpolls-buttons">
										<input type="submit" value="Submit"
											class="btn btn-primary advpolls-vote"> <a
											class="advpolls-showresult" href="javascript:void(0);"> View
											Results </a>
									</div>

									<input type="hidden" value="1" name="id"> <input type="hidden"
										value="1" name="maxChoices">
								</form>
							</div>
						</div>


					</div>

				</div>
				</section>

			</div>
			<div class="row">
				<div class="col-sm-12">
					<h2 class="lined-heading">
						<span>Videos</span>
					</h2>
				</div>
				<div class="col-md-12">

					<div class="col-md-3">
						<div style="margin-bottom: 20px;">
							<img src="<?php echo base_url();?>assets/images/video.jpg"
								border="0">
						</div>
					</div>

					<div class="col-md-3">
						<div style="margin-bottom: 20px;">
							<img src="<?php echo base_url();?>assets/images/video.jpg"
								border="0">
						</div>
					</div>
					<div class="col-md-3">
						<div style="margin-bottom: 20px;">
							<img src="<?php echo base_url();?>assets/images/video.jpg"
								border="0">
						</div>
					</div>
					<div class="col-md-3">
						<div>
							<img src="<?php echo base_url();?>assets/images/video.jpg"
								border="0">
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<h2 class="lined-heading">
					<span>Is the information on this page useful to you?</span>
				</h2>
			</div>

			<div class="block light-blue clearfix">
				<div class="grid_4 your-rating ratings-wrapper  clearfix">
					<div class="rating-top">
						<div class="grey-text ttupper bold left">Your Rating</div>
						<div data-original-rating-num="-" class="rating-widget-num right "
							style="display: none;">-</div>

					</div>
					<div data-za-intent="raterestaurant.post" data-za-events="click" class="rating-widget-stars left" id="ratingDivParent">
						<div data-rating="0" data-originalclass="user_starssel_0" class="rating-cls user_starssel_0">
							<a id="rating-id-1" data-hover-rating="1.0" data-num="2" class="level-1 ratingSystem ratingHover" href="javascript:void(0);">&nbsp;</a> 
							<a id="rating-id-2" data-hover-rating="1.5" data-num="3" class="level-2 ratingSystem ratingHover" href="javascript:void(0);">&nbsp;</a>
							<a id="rating-id-3" data-hover-rating="2.0" data-num="4" class="level-3 ratingSystem ratingHover" href="javascript:void(0);">&nbsp;</a> 
							<a id="rating-id-4" data-hover-rating="2.5" data-num="5" class="level-4 ratingSystem ratingHover" href="javascript:void(0);">&nbsp;</a>
							<a id="rating-id-5" data-hover-rating="3.0" data-num="6" class="level-5 ratingSystem ratingHover" href="javascript:void(0);">&nbsp;</a> 
							<a id="rating-id-6" data-hover-rating="3.5" data-num="7" class="level-6 ratingSystem ratingHover" href="javascript:void(0);">&nbsp;</a>
							<a id="rating-id-7" data-hover-rating="4.0" data-num="8" class="level-7 ratingSystem ratingHover big" href="javascript:void(0);">&nbsp;</a> 
							<a id="rating-id-8" data-hover-rating="4.5" data-num="9" class="level-8 ratingSystem ratingHover big" href="javascript:void(0);">&nbsp;</a> 
							<a id="rating-id-9" data-hover-rating="5.0" data-num="10" class="level-9 ratingSystem ratingHover big bigger" href="javascript:void(0);">&nbsp;</a>
						</div>
					</div>
				</div>


				<div class="tot_votes">
					<div class="avg_vote">
						<span id="ratingValueId"><?php echo (!empty($policyDetails['policy']['rating_value']) && $policyDetails['policy']['rating_value'] != 0) ? number_format($policyDetails['policy']['rating_value'], 1) : 0;?></span><span class="sm">/5</span>
					</div>
					<div class="tot_votes_m">based on <?php echo number_format($policyDetails['policy']['rating_click_count'])?> Votes</div>
				</div>
			</div>

		</div>





		<div class="row">

			<div class="col-sm-12">
				<h2 class="lined-heading">
					<span>Leave a Comment</span>
				</h2>
			</div>
			<div class="col-md-12">
			
			<?php 							
				$arrParams['disqus_identifier'] = $disqusUrl;  
				$arrParams['disqus_url'] = $disqusUrl;
				$arrParams['disqus_title'] = $policyDetails['policy']['policy_name'];
		//		$arrParams['disqus_category_id'] = '3125046';
				echo Disquslib::displayDisqus($arrParams);
			?>
			</div>
		</div>


<?php 
	}
	else 
	{
		echo '<h1>No policy found</h1>';
	}
?>
	</div>
</div>
<script type="text/javascript">

</script>

<script type="text/javascript" src="<?php echo base_url();?>assets/js/page.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/rating.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/site.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/highcharts.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/highcharts-more.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/exporting.js"></script>


<script src="<?php echo base_url();?>assets/js/jquery.easytabs.js" type="text/javascript"></script>



<script type="text/javascript">
$('#tabs a').tabs();
var record = "<?php echo $policyDetails['policy']['policy_slug'];?>";
var ratingType = "policy";
</script>



<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.scrollUp.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.colio.min.js"></script>
<script src='<?php echo base_url();?>assets/js/jquery.zoom.js'></script>

<script type="text/javascript">
		$(document).ready(function(){
			
			   $('#tab-container').easytabs();
			//$('#zoom_image').finezoom();
			// "scrollTop" plugin
			$.scrollUp();
			
			// "colio" plugin
			$('.portfolio .list').colio({
				id: 'demo_1',
				theme: 'black',
				placement: 'inside',
				onContent: function(content){
				//	alert('s');
					$('.zoom').zoom();
						
					// init "fancybox" plugin
				//	$('.fancybox', content).fancybox();
				}
			});
			
		
			
			
		});
	</script>



