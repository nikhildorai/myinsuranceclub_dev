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




<?php /*?>
		<div class="row">
			<div class="col-sm-12">


				<h2 class="lined-heading">
					<span>Eligibility and Restrictions</span>
				</h2>
			</div>

			<div class="smart-grids c_t col-md-12 clearfix">
				<table class="bordered">
					<thead>

						<tr>
							<th></th>
							<th>Minimum</th>
							<th>Maximum</th>
						</tr>
					</thead>
					<tbody>

						<tr>
							<td>Coverage Amount (in Rs.)</td>
							<td align="center">1,00,000 (Individual)<br> 2,00,000 (Floater)</td>
							<td align="center">5,00,000</td>
						</tr>
						<tr>
							<td>Policy Term (in years)</td>
							<td align="center">1</td>
							<td align="center">2</td>
						</tr>
						<tr>
							<td>Entry Age (in years)</td>
							<td align="center">18</td>
							<td align="center">No limit</td>
						</tr>
						<tr>
							<td>Renewable till Age (in years)</td>
							<td align="center">-</td>
							<td align="center">Life long</td>
						</tr>
						<tr>
							<td>No Medical Test Age (in years)</td>
							<td align="center">0</td>
							<td align="center">49</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>

*/ ?>
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
<?php 					}	?>			
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
								
								<?php echo widget::run('eligibilityConditionsFront', array('variant'=>$variant, 'model'=>$vFeatures));?>
								
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
												<td><strong>Hospitalisation expenses</strong></td>
												<td>&nbsp;</td>
											</tr>
											<tr>
												<td class="pad-70">Room Rent</td>
												<td>
													<?php
														$default = array('covered'=>'', 'percent'=>'', 'amount'=>'', 'comments'=>'');
														$arrValues = array_key_exists( 'room_rent',$model) ? unserialize($model['room_rent']) : $default;
														$arrValues = Util::array_overlay($default, $arrValues);
														$selected = $arrValues['covered'];
														$display = array();
														if ($selected == 'actual rent')
															$display[] = 'Actual Rent';
														else if ($selected == 'specific')
														{
															$display[] = (!empty($arrValues['percent'])) ? $arrValues['percent'].' % of Sum Insured per day' : '';
															$display[] =  (!empty($arrValues['amount'])) ? 'Rs. '.$arrValues['amount'].' per day' : '';
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
												<td class="pad-70">ICU Rent</td>
												<td>
													<?php
														$default = array('covered'=>'', 'percent'=>'', 'amount'=>'', 'comments'=>'');
														$arrValues = array_key_exists( 'icu_rent',$model) ? unserialize($model['icu_rent']) : $default;
														$arrValues = Util::array_overlay($default, $arrValues);
														$selected = $arrValues['covered'];
														$display = array();
														if ($selected == 'actual rent')
															$display[] = 'Actual Rent';
														else if ($selected == 'specific')
														{
															$display[] = (!empty($arrValues['percent'])) ? $arrValues['percent'].' % of Sum Insured per day' : '';
															$display[] =  (!empty($arrValues['amount'])) ? 'Rs. '.$arrValues['amount'].' per day' : '';
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
												<td class="pad-70">Fees of Surgeon, Anesthetist, Nurses and
													Specialists</td>
												<td><?php echo array_key_exists( 'doctor_fee',$vFeatures) ? $vFeatures['doctor_fee'] : '';?></td>
											</tr>
											<tr>
												<td><strong>Pre-hospitalisation</strong></td>
												<td>
													<?php
														$default = array('covered'=>'', 'percent'=>'', 'days'=>'','amount'=>'', 'comments'=>'');
														$arrValues = array_key_exists( 'pre_hosp',$model) ? unserialize($model['pre_hosp']) : $default;
														$arrValues = Util::array_overlay($default, $arrValues);
														$selected = $arrValues['covered'];
														$display = array();
														if ($selected == 'yes')
														{
															$display[] = (!empty($arrValues['percent'])) ? $arrValues['percent'].' % of admissible hospitalization expenses' : '';
															$display[] =  (!empty($arrValues['amount'])) ? 'Maximum of Rs. '.$arrValues['amount'] : '';
															$display[] =  (!empty($arrValues['days'])) ? 'Upto '.$arrValues['days'].' days' : '';
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
												<td><strong>Post-hospitalisation</strong></td>
												<td>
													<?php
														$default = array('covered'=>'', 'percent'=>'', 'days'=>'','amount'=>'', 'comments'=>'');
														$arrValues = array_key_exists( 'post_hosp',$model) ? unserialize($model['post_hosp']) : $default;
														$arrValues = Util::array_overlay($default, $arrValues);
														$selected = $arrValues['covered'];
														$display = array();
														if ($selected == 'yes')
														{
															$display[] = (!empty($arrValues['percent'])) ? $arrValues['percent'].' % of admissible hospitalization expenses' : '';
															$display[] =  (!empty($arrValues['amount'])) ? 'Maximum of Rs. '.$arrValues['amount'] : '';
															$display[] =  (!empty($arrValues['days'])) ? 'Upto '.$arrValues['days'].' days' : '';
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
												<td><strong>Day care expenses</strong></td>
												<td>
													<?php
														$default = array('covered'=>'', 'day_care'=>'', 'comments'=>'');
														$arrValues = array_key_exists( 'day_care',$model) ? unserialize($model['day_care']) : $default;
														$arrValues = Util::array_overlay($default, $arrValues);
														$selected = $arrValues['covered'];
														$display = array();
														if ($selected == 'yes')
														{
															$display[] = (!empty($arrValues['day_care'])) ? 'No. of Listed Procedures '.$arrValues['day_care'] : '';
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
												<td><strong>Domiciliary Hospitalisation</strong></td>
												<td>
													<?php
														$default = array('covered'=>'', 'percent'=>'', 'amount'=>'', 'comments'=>'');
														$arrValues = array_key_exists( 'domiciliary_treatment_expenses',$model) ? unserialize($model['domiciliary_treatment_expenses']) : $default;														
														$arrValues = Util::array_overlay($default, $arrValues);
														$selected = $arrValues['covered'];
														$display = array();
														if ($selected == 'yes')
														{
															$display[] = (!empty($arrValues['percent'])) ? $arrValues['percent'].' % of SI' : '';
															$display[] =  (!empty($arrValues['amount'])) ? 'Maximum of Rs. '.$arrValues['amount'] : '';
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
	
	
	
	
	
	
	
	
	
	
	
	
							<?php 
								$maternityBenefits = array_key_exists( 'maternity',$vFeatures) ? strtolower($vFeatures['maternity']) : 'no';
								if ($maternityBenefits == 'yes')
								{
							?>
									<table class="bordered mar-40">
										<thead>
	
											<tr>
												<th colspan="2">Maternity Benefits</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>Waiting Period</td>
												<td>
													<?php
													$display = array();
													$display[] = (!empty($vFeatures['maternity_waiting_period'])) ? 'Covered after '.$vFeatures['maternity_waiting_period'].' years' : '';
													$display = array_filter($display);
													$display = (!empty($display)) ? implode(', ', array_filter($display)) : '-';
													echo $display;	
									                ?>
									            </td>
											</tr>
											<tr>
												<td>Normal Delivery</td>
												<td>
													<?php
														$default = array('percent'=>'', 'amount'=>'', 'comments'=>'');
														$arrValues = array_key_exists( 'maternity_normal_delivery',$model) ? unserialize($model['maternity_normal_delivery']) : $default;														
														$arrValues = Util::array_overlay($default, $arrValues);
														
														$display = array();
														$display[] = (!empty($arrValues['percent'])) ? $arrValues['percent'].' % of SI' : '';
														$display[] =  (!empty($arrValues['amount'])) ? 'Maximum of Rs. '.$arrValues['amount'] : '';
														$display[] = (!empty($arrValues['comments'])) ? $arrValues['comments'] : '';
														$display = array_filter($display);
														$display = (!empty($display)) ? implode(', ', array_filter($display)) : 'Not Covered';
														echo $display;	
									                ?>
									            </td>
											</tr>
											<tr>
												<td>Caesarean Delivery</td>
												<td>
													<?php
														$default = array('percent'=>'', 'amount'=>'', 'comments'=>'');
														$arrValues = array_key_exists( 'maternity_caesarean_delivery',$model) ? unserialize($model['maternity_caesarean_delivery']) : $default;														
														$arrValues = Util::array_overlay($default, $arrValues);
														
														$display = array();
														$display[] = (!empty($arrValues['percent'])) ? $arrValues['percent'].' % of SI' : '';
														$display[] =  (!empty($arrValues['amount'])) ? 'Maximum of Rs. '.$arrValues['amount'] : '';
														$display[] = (!empty($arrValues['comments'])) ? $arrValues['comments'] : '';
														$display = array_filter($display);
														$display = (!empty($display)) ? implode(', ', array_filter($display)) : 'Not Covered';
														echo $display;	
									                ?>
									            </td>
											</tr>
											<tr>
												<td>New-born baby cover</td>
												<td>
													<?php
														$default = array('covered'=>'', 'percent'=>'', 'amount'=>'', 'coverage_period'=>'', 'coverage_in'=>'', 'comments'=>'');
														$arrValues = array_key_exists( 'maternity_new_born_baby_cover',$model) ? unserialize($model['maternity_new_born_baby_cover']) : $default;														
														$arrValues = Util::array_overlay($default, $arrValues);
														$selected = $arrValues['covered'];
														$display = array();
														if ($selected != 'no')
														{
															$display[] = (!empty($arrValues['percent'])) ? $arrValues['percent'].' % of SI' : '';
															$display[] =  (!empty($arrValues['amount'])) ? 'Maximum of Rs. '.$arrValues['amount'] : '';
															$display[] =  (!empty($arrValues['coverage_period'])) ? 'Coverage period of '.$arrValues['coverage_period'].' '.$arrValues['coverage_in'] : '';
															$display[] = (!empty($arrValues['comments'])) ? $arrValues['comments'] : '';
														}
														else 
															$display[] = 'Not covered';
														$display = array_filter($display);
														$display = (!empty($display)) ? implode(', ', array_filter($display)) : 'Optional';
														echo $display;	
									                ?>
									             </td>
											</tr>
											<tr>
												<td>Addition of New-born</td>
												<td>
													<?php
														$default = array('covered'=>'', 'percent'=>'', 'amount'=>'', 'coverage_period_from'=>'', 'coverage_period_from_in'=>'', 'coverage_period_to'=>'', 'coverage_period_to_in'=>'', 'comments'=>'');
														$arrValues = array_key_exists( 'maternity_addition_of_new_born',$model) ? unserialize($model['maternity_addition_of_new_born']) : $default;														
														$arrValues = Util::array_overlay($default, $arrValues);
														$selected = $arrValues['covered'];
														$display = array();
														if ($selected != 'no')
														{
															$display[] = (!empty($arrValues['percent'])) ? $arrValues['percent'].' % of SI' : '';
															$display[] =  (!empty($arrValues['amount'])) ? 'Maximum of Rs. '.$arrValues['amount'] : '';
															$display[] =  (!empty($arrValues['coverage_period_from'])) ? 'Coverage period from '.$arrValues['coverage_period_from'].' '.$arrValues['coverage_period_from_in'] : '';
															$display[] =  (!empty($arrValues['coverage_period_to'])) ? ' upto '.$arrValues['coverage_period_to'].' '.$arrValues['coverage_period_to_in'] : '';
															$display[] = (!empty($arrValues['comments'])) ? $arrValues['comments'] : '';
														}
														else 
															$display[] = 'Not covered';
														$display = array_filter($display);
														$display = (!empty($display)) ? implode(', ', array_filter($display)) : '-';
														echo $display;	
									                ?>
									             </td>
											</tr>
										</tbody>
									</table>
						<?php 	}	?>	
									<table class="bordered mar-40">
										<thead>
	
											<tr>
												<th colspan="2">Other Benefits</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>Auto Recharge of Sum Insured</td>
												<td>
													<?php
													$display = array();
													$display[] = (!empty($vFeatures['autorecharge_SI'])) ? $vFeatures['autorecharge_SI'] : '';
													$display = array_filter($display);
													$display = (!empty($display)) ? implode(', ', array_filter($display)) : '-';
													echo $display;	
									                ?>
									            </td>
											</tr>
											<tr>
												<td>Hospital Cash</td>
												<td>
													<?php
														$default = array('covered'=>'', 'percent'=>'', 'amount'=>'', 'day_from'=>'', 'day_from_in'=>'', 'day_to'=>'', 'day_to_in'=>'', 'continue_days'=>'', 'max_amount'=>'', 'deductable_days'=>'', 'comments'=>'');
														$arrValues = array_key_exists( 'hospital_cash',$model) ? unserialize($model['hospital_cash']) : $default;														
														$arrValues = Util::array_overlay($default, $arrValues);
														$selected = $arrValues['covered'];
														$display = array();
														if ($selected == 'yes')
														{
															$d = (!empty($arrValues['percent'])) ? $arrValues['percent'].' % of SI per day,' : '';
															$d .= (!empty($arrValues['amount'])) ? ' Upto Rs. '.$arrValues['amount'].' per day' : '';
															$d .= ((!empty($arrValues['day_from'])) ? ' from '.$arrValues['day_from_in'].' '.$arrValues['day_from'] : '');
															$d .= ((!empty($arrValues['day_to'])) ? ' to '.$arrValues['day_to_in'].' '.$arrValues['day_to'] : '');
															$d .= (!empty($arrValues['continue_days'])) ? ' provided if hospitalisation exceeds '.$arrValues['continue_days'].' days continuously.' : '';
															$d .= (!empty($arrValues['max_amount'])) ? ' Maximum Upto Rs. '.$arrValues['max_amount'] : '';
															$d .= (!empty($arrValues['deductable_days'])) ? ' with '.$arrValues['deductable_days'].' day deductable' : '';
															$display[] = $d;
															$display[] = (!empty($arrValues['comments'])) ? $arrValues['comments'] : '';
														}
														else 
															$display[] = 'Not covered';
														$display = array_filter($display);
														$display = (!empty($display)) ? implode(', ', array_filter($display)) : '-';
														echo $display;	
									                ?>
												</td>
											</tr>
											<tr>
												<td>Ambulance Charges</td>
												<td>
													<?php
														$default = array('covered'=>'', 'percent'=>'', 'amount'=>'', 'comments'=>'');
														$arrValues = array_key_exists( 'emergency_ambulance',$model) ? unserialize($model['emergency_ambulance']) : $default;														
														$arrValues = Util::array_overlay($default, $arrValues);
														$selected = $arrValues['covered'];
														$display = array();
														if ($selected != 'no')
														{
															$display[] = (!empty($arrValues['covered']) && $arrValues['covered'] == 'actual cost') ? 'Actual ambulance cost' : '';
															$display[] = (!empty($arrValues['percent'])) ? $arrValues['percent'].'% Per Hospitalization' : '';
															$display[] = (!empty($arrValues['amount'])) ? 'Upto Rs. '.$arrValues['amount'].' Per Hospitalization' : '';
															$display[] = (!empty($arrValues['comments'])) ? $arrValues['comments'] : '';
														}
														else 
															$display[] = 'Not covered';
														$display = array_filter($display);
														$display = (!empty($display)) ? implode(', ', array_filter($display)) : '-';
														echo $display;	
									                ?>
												</td>
											</tr>
											<tr>
												<td>Recovery Benefit</td>
												<td><?php echo array_key_exists( 'recovery_benefit',$vFeatures) ? $vFeatures['recovery_benefit'] : '';?></td>
											</tr>
											<tr>
												<td>Health Check up</td>
												<td><?php echo array_key_exists( 'check_up',$vFeatures) ? $vFeatures['check_up'] : '';?></td>
											</tr>
											<tr>
												<td>Organ Donor Cover</td>
												<td>
													<?php
														$default = array('covered'=>'', 'percent'=>'', 'amount'=>'', 'comments'=>'');
														$arrValues = array_key_exists( 'organ_donor_exp',$model) ? unserialize($model['organ_donor_exp']) : $default;													
														$arrValues = Util::array_overlay($default, $arrValues);
														$selected = $arrValues['covered'];
														$display = array();
														if ($selected != 'no')
														{
															$display[] = (!empty($arrValues['percent'])) ? $arrValues['percent'].'% of SI' : '';
															$display[] = (!empty($arrValues['amount'])) ? 'Max upto Rs. '.$arrValues['amount'] : '';
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
												<td>Ayurvedic Treatment</td>
												<td>
													<?php
														$default = array('covered'=>'', 'percent'=>'', 'amount'=>'', 'comments'=>'');
														$arrValues = array_key_exists( 'ayurvedic',$model) ? unserialize($model['ayurvedic']) : $default;												
														$arrValues = Util::array_overlay($default, $arrValues);
														$selected = $arrValues['covered'];
														$display = array();
														if ($selected != 'no')
														{
															$display[] = (!empty($arrValues['percent'])) ? $arrValues['percent'].'% of SI' : '';
															$display[] = (!empty($arrValues['amount'])) ? 'Max upto Rs. '.$arrValues['amount'] : '';
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
												<td>Second Opinion</td>
												<td><?php echo array_key_exists( 'second_opinion',$vFeatures) ? $vFeatures['second_opinion'] : '';?></td>
											</tr>
											<tr>
												<td>E-opinion</td>
												<td>
													<?php
													$default = array('covered'=>'', 'comments'=>'');
													$arrValues = array_key_exists( 'e_opinion',$model) ? unserialize($model['e_opinion']) : $default;
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
												<td>Physiotherapy Charges</td>
												<td><?php echo array_key_exists( 'physiotherapy_charges',$vFeatures) ? $vFeatures['physiotherapy_charges'] : '';?></td>
											</tr>
											<tr>
												<td>Child Education Fund</td>
												<td><?php echo array_key_exists( 'child_education_fund',$vFeatures) ? $vFeatures['child_education_fund'] : '';?></td>
											</tr>
											<tr>
												<td>Health Programs</td>
												<td><?php echo array_key_exists( 'health_programs',$vFeatures) ? $vFeatures['health_programs'] : '';?></td>
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
												<td>Family Discount</td>
												<td>
													<?php
													$default = array('covered'=>'', 'comments'=>'');
													$arrValues = array_key_exists( 'family_discount',$model) ? unserialize($model['family_discount']) : $default;
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
												<td>Cumulative Bonus</td>
												<td><?php echo array_key_exists( 'cumulative_bonus',$vFeatures) ? $vFeatures['cumulative_bonus'] : '';?></td>
											</tr>
											<tr>
												<td>Two Year Policy Option</td>
												<td>
													<?php
													$default = array('covered'=>'', 'comments'=>'');
													$arrValues = array_key_exists( 'two_year_policy_option',$model) ? unserialize($model['two_year_policy_option']) : $default;
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
												<td>Co-payment</td>
												<td>
													<?php
														$default = array('covered'=>'', 'percent'=>'', 'amount'=>'', 'comments'=>'');
														$arrValues = array_key_exists( 'co_pay',$model) ? unserialize($model['co_pay']) : $default;												
														$arrValues = Util::array_overlay($default, $arrValues);
														$selected = $arrValues['covered'];
														$display = array();
														if ($selected != 'no')
														{
															$display[] = (!empty($arrValues['percent'])) ? $arrValues['percent'].'% of the admissible claim amoun' : '';
															$display[] = (!empty($arrValues['amount'])) ? 'Max upto Rs. '.$arrValues['amount'] : '';
															$display[] = (!empty($arrValues['comments'])) ? $arrValues['comments'] : '';
														}
														else 
															$display[] = 'No';
														$display = array_filter($display);
														$display = (!empty($display)) ? implode(', ', array_filter($display)) : 'Yes';
														echo $display;	
									                ?>
												</td>
											</tr>
											<tr>
												<td>Cashless</td>
												<td>
													<?php
													$default = array('hospitals'=>'', 'cities'=>'');
													$arrValues = array_key_exists( 'cashless_treatment',$model) ? unserialize($model['cashless_treatment']) : $default;
													$arrValues = Util::array_overlay($default, $arrValues);
													$display = array();
													$display[] = ((!empty($arrValues['hospitals'])) ? $arrValues['hospitals'].' hospitals' : '').((!empty($arrValues['cities'])) ? ' across '.$arrValues['cities'].' cities' : ' across country');
													$display = array_filter($display);
													$display = (!empty($display)) ? implode(', ', array_filter($display)) : 'No';
													echo $display;	
									                ?>
									            </td>
											</tr>
											<tr>
												<td>Claim Loading</td>
												<td><?php echo array_key_exists( 'claim_loading',$vFeatures) ? $vFeatures['claim_loading'] : '';?></td>
											</tr>
											
											<tr>
												<td>Free look period</td>
												<td><?php echo array_key_exists( 'free_look_period',$vFeatures) ? $vFeatures['free_look_period'].' days from the date of receipt of the policy document' : '';?></td>
											</tr>
											
											<tr>
												<td>Grace period</td>
												<td><?php echo array_key_exists( 'grace_period',$vFeatures) ? $vFeatures['grace_period'].' days from date of renewal ' : '';?></td>
											</tr>
											
											
											<tr>
												<td>Dependent Parents</td>
												<td><?php echo (!empty($vFeatures['dependent_parents']) && $vFeatures['dependent_parents'] == 'yes') ? 'Covered' : 'Not Covered';?></td>
											</tr>
											
											
											<tr>
												<td>Pre-existing diseases</td>
												<td><?php echo array_key_exists( 'preexisting_diseases',$vFeatures) ? ' Covered after '.$vFeatures['preexisting_diseases'].' years' : '';?></td>
											</tr>
											
										</tbody>
									</table>
	
	
<?php /* ?>	
									<table class="bordered mar-40">
									<thead>
				
										<tr>
											<th colspan="2">Major Exclusions</th>
										</tr>
										</thead>
										<tbody>
											<tr>
												<td>Pre-existing diseases</td>
												<td><?php echo array_key_exists( 'preexisting_diseases',$vFeatures) ? $vFeatures['preexisting_diseases'] : '';?></td>
											</tr>
											<tr>
												<td>For the first 30 days</td>
												<td><?php echo array_key_exists( 'first_30_days',$vFeatures) ? $vFeatures['first_30_days'] : '';?></td>
											</tr>
											<tr>
												<td>For the first 24 months</td>
												<td><?php echo array_key_exists( 'first_24_months',$vFeatures) ? $vFeatures['first_24_months'] : '';?></td>
											</tr>
											<tr>
												<td>Dental treatment or surgery</td>
												<td><?php echo array_key_exists( 'dental_treatment_or_surgery',$vFeatures) ? $vFeatures['dental_treatment_or_surgery'] : '';?></td>
											</tr>
											<tr>
												<td>AIDS / HIV</td>
												<td><?php echo array_key_exists( 'aids_hiv',$vFeatures) ? $vFeatures['aids_hiv'] : '';?></td>
											</tr>
											<tr>
												<td>Cosmetic treatment</td>
												<td><?php echo array_key_exists( 'cosmetic_treatment',$vFeatures) ? $vFeatures['cosmetic_treatment'] : '';?></td>
											</tr>
										</tbody>
									</table>
<?php */ ?>									
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
		
			<div class="col-sm-12">
				<h2 class="lined-heading">
					<span>Annual Premium - Peer Comparison</span>
				</h2>
			</div>
			
			<?php
			echo widget::run(	'peerComparisionFront', array(	'company'=>$company, 'policyDetails'=>$policyDetails['policy'], 
																'peerComparisionResult'=>$peerComparisionResult,'policyVariants'=> $variantNames,
																'type'=>'mediclaim', 'variantType'=>$variantType, 'features'=>$vFeatures));?>
			
			
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




<?php /*?>
			<div class="row">
				<div class="col-sm-12">
					<h2 class="lined-heading">
						<span>Exclusions - What is not covered in L&T my health Medisure
							Classic Insurance Policy?</span>
					</h2>
				</div>
				<div class="smart-grids col-md-12 clearfix">
					<table class="bordered" style="margin-top: 30px;">
						<thead>

							<tr>
								<th colspan="2">Major Exclusions</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Pre-existing diseases</td>
								<td>Covered after first 3 continuous policy years</td>
							</tr>
							<tr>
								<td>For the first 30 days</td>
								<td>Only accidents are covered. (not applicable for renewals)</td>
							</tr>
							<tr>
								<td>For the first 24 months</td>
								<td>Diabetes, Hypertension, Cataract, Hernia,</td>
							</tr>
							<tr>
								<td>Dental treatment or surgery</td>
								<td>Not covered unless caused due to an accident</td>
							</tr>
							<tr>
								<td>&nbsp;</td>
								<td>Routine medical, eye and ear examinations, cost of
									spectacles, laser surgery for cosmetic purposes or corrective
									surgeries, contact lenses or hearing aids, etc</td>
							</tr>
							<tr>
								<td>AIDS / HIV</td>
								<td>All expenses arising out of any condition directly or
									indirectly caused due to or associated with human T-call Lymph
									tropic virus type III (HTLV-III) or <br> Lymphadinopathy
									Associated Virus (LAV) or Acquired Immune Deficiency Syndrome
									(AIDS), AIDS related complex syndrome (ARCS) and all diseases /
									illness / injury caused by and / or related to HIV and sexually
									transmitted diseases.</td>
							</tr>
							<tr>
								<td>Cosmetic treatment</td>
								<td>Any cosmetic surgery unless forming part of treatment for
									cancer or burns, surgery for sex change or treatment of obesity
									/ morbid obesity or treatment / surgery / complications /
									illness arising as a consequence thereof.</td>
							</tr>
						</tbody>
					</table>
				</div>



			</div>

*/ ?>

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
<?php 	}		?>





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
										
							/*		?>
				<div id="disqus_thread"></div>
				<script type="text/javascript">
        // * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * 
        var disqus_shortname = 'mictestram'; // required: replace example with your forum shortname

        // * * DON'T EDIT BELOW THIS LINE * * *
        (function() {
            var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
            dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
            (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
        })();
    </script>
				<noscript>
					Please enable JavaScript to view the <a
						href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a>
				</noscript>
				<a href="http://disqus.com" class="dsq-brlink">comments powered by <span
					class="logo-disqus">Disqus</span> </a>
<?php */?>
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



