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
		<h2 class="title-divider">
			<span><?php echo $policyDetails['policy']['policy_name'];?></span>
		</h2>
		<div class="row">
			<div class="col-md-9" style="padding-right: 0px;">
				<div class="top_col border-box-1 radius2" style="min-height: 515px;">
					<header class="share-header"> <aside class="shares social">
					<div class="total-shares" data-index="0">
						<em>22,247</em>
						<div class="caption">Views</div>
					</div>
					<div class="total-shares" data-index="0">
						<em>424</em>
						<div class="caption">Comments</div>
					</div>
					<div class="share-buttons v2">
						<div class="share-container">
							<div class="share-count">2.5k</div>
							<div class="primary-shares">
								<a class="social-share facebook fa fa-facebook-square"> <span
									class="expanded-text">Share on Facebook</span> </a> <a
									class="social-share twitter fa fa-twitter"> <span
									class="alt-text">Tweet</span> <span class="expanded-text">Share
										on Twitter</span> </a>
								<div class="share-toggle fa fa-plus"></div>
							</div>
							<div class="secondary-shares">
								<a class="social-share google_plus fa fa-google-plus"></a> <a
									class="social-share linked_in fa fa-linkedin-square"></a>
								<div class="secondary-share-toggle fa fa-minus"></div>
							</div>
						</div>
					</div>
					</aside> </header>
					<div class="col-md-12">
						<div class="col-md-5 no_pad_l">
							<div class="logo_pages border-box-1 radius2">
<?php 
								if (isset($policyDetails['policy']['policy_logo']) && !empty($policyDetails['policy']['policy_logo']))
								{
									$folderUrl = $this->config->config['folder_path']['policy']['policy_logo']; 
									$fileUrl = $this->config->config['url_path']['policy']['policy_logo'];
									$imgUrl = $fileUrl.'logo_missing_172x68.jpg';
									$imgName = $policyDetails['policy']['policy_logo'];
								}
								else 
								{
									$folderUrl = $this->config->config['folder_path']['company']['companyPageLogo']; 
									$fileUrl = $this->config->config['url_path']['company']['companyPageLogo'];
									$imgUrl = $fileUrl.'logo_missing_172x68.jpg';
									$imgName = $company['logo_image_1'];
								}
								
								if (!empty($imgName) && file_exists($folderUrl.$imgName))
									$imgUrl = $fileUrl.$imgName;
?>							
								<img src="<?php echo $imgUrl;?>" border="0">
							</div>
							<div class="col-5" style="margin-top: 20px;">
								<table class="table table-bordered table-striped"
									id="description_details" itemprop="breadcrumb">
									<tbody>

										<tr>
											<td>Product Type</td>
											<td class="value"><?php echo $policyDetails['policy']['sub_product']['sub_product_name'];?></td>
										</tr>
										<tr>
											<td>Sub Product Type:</td>
											<td class="value"><?php echo $policyDetails['policy']['sub_product']['sub_product_name'];?></td>
										</tr>

										<tr>
											<td>UIN</td>
											<td class="value"><?php echo $policyDetails['policy']['policy_uin'];?></td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
						<div class="col-md-7">
							<div class="product-name">
								<h1><?php echo $policyDetails['policy']['policy_display_name'];?></h1>
							</div>
<?php 
							if (!empty($policyDetails['policy']['key_features']))
							{
								$keyFeatures = unserialize($policyDetails['policy']['key_features']);
								if (!empty($keyFeatures))
								{
									foreach ($keyFeatures as $k1=>$v1)
									{	?>
										<p class="availability in-stock">
											<span class="p-icons"><i class="fa fa-check"></i> </span>
											<?php echo $v1;?>
										</p>
<?php 								}
								}
							}
?>							

							<div class="short-description">
								<h2>Quick Overview</h2>
								<div class="std"><?php echo $policyDetails['policy']['quick_overview']?></div>
							</div>
						</div>
						<div class="tw_sh">
							<div style="width: 50px;; float: left;">
								<a class="feature-icon-hover " href="javascript:void(0)"
									title="Tweet This"> <span class="v-center"> <span
										class="icon i-recommend-bw icon-color-productview fa fa-thumbs-up"></span>
								</span> </a>
							</div>
							<div
								style="width: auto; max-width: 92%; float: left; position: relative;">
								<div class="twt">
									<span><?php echo $policyDetails['policy']['tweet_property'];?></span><span class="tw_th">Tweet
										This</span>
								</div>
								<div class="twt_img">
									<img src="<?php echo base_url();?>assets/images/twt_share.png"
										border="0">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-3 sidebar sidebar-right">
				<div class="inner">
					<div class="block">
						<img src="<?php echo base_url();?>assets/images/ad/hdfc.jpg"
							style="max-width: 100%;" border="0">
					</div>
					<div class="block">
						<img src="<?php echo base_url();?>assets/images/ad/hdfc.jpg"
							style="max-width: 100%;" border="0">
					</div>
				</div>
			</div>
		</div>




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
							<img src="<?php echo base_url();?>assets/images/icons/person.png"
								border="0" class="compo-img">
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
						$vFeatures = $v1['features'];
						?>
						<div id="Medisure<?php echo $variant['variant_id']?>">
	
	
							<div class="row pad">
	
								<div class="col-sm-12">
	
									<h2 class=" header_in cus_mar">
										<span>Eligibility and Restrictions</span>
									</h2>
								</div>
								
								<div class="smart-grids col-md-12 clearfix">
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
												<td align="center"><?php echo array_key_exists( 'minimum_coverage_amount',$vFeatures) ? $vFeatures['minimum_coverage_amount'] : '';?></td>
												<td align="center"><?php echo array_key_exists( 'maximum_coverage_amount',$vFeatures) ? $vFeatures['maximum_coverage_amount'] : '';?></td>
											</tr>
											<tr>
												<td>Policy Term (in years)</td>
												<td align="center"><?php echo array_key_exists( 'minimum_policy_terms',$vFeatures) ? $vFeatures['minimum_policy_terms'] : '';?></td>
												<td align="center"><?php echo array_key_exists( 'maximum_policy_terms',$vFeatures) ? $vFeatures['maximum_policy_terms'] : '';?></td>
											</tr>
											<tr>
												<td>Entry Age (in years)</td>
												<td align="center"><?php echo array_key_exists( 'minimum_entry_age',$vFeatures) ? $vFeatures['minimum_entry_age'] : '';?></td>
												<td align="center"><?php echo array_key_exists( 'maximum_entry_age',$vFeatures) ? $vFeatures['maximum_entry_age'] : '';?></td>
											</tr>
											<tr>
												<td>Renewable till Age (in years)</td>
												<td align="center"><?php echo array_key_exists( 'manimum_renewal_age',$vFeatures) ? $vFeatures['manimum_renewal_age'] : '';?></td>
												<td align="center"><?php echo array_key_exists( 'maximum_renewal_age',$vFeatures) ? $vFeatures['maximum_renewal_age'] : '';?></td>
											</tr>
											<tr>
												<td>No Medical Test Age (in years)</td>
												<td align="center"><?php echo array_key_exists( 'minimum_no_medical_test_age',$vFeatures) ? $vFeatures['minimum_no_medical_test_age'] : '';?></td>
												<td align="center"><?php echo array_key_exists( 'maximum_no_medical_test_age',$vFeatures) ? $vFeatures['maximum_no_medical_test_age'] : '';?></td>
											</tr>
										</tbody>
									</table>
								</div>
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
												<th colspan="2">Basic</th>
	
											</tr>
										</thead>
										<tbody>
	
	
											<tr>
												<td><strong>Hospitalisation expenses</strong></td>
												<td>&nbsp;</td>
											</tr>
											<tr>
												<td class="pad-70">Room Rent</td>
												<td><?php echo (isset($vFeatures['room_rent']) && !empty($vFeatures['room_rent'])) ? $vFeatures['room_rent'] :'-';?></td>
											</tr>
											<tr>
												<td class="pad-70">ICU Rent</td>
												<td><?php echo array_key_exists( 'icu_rent',$vFeatures) ? $vFeatures['icu_rent'] : '';?></td>
											</tr>
											<tr>
												<td class="pad-70">Fees of Surgeon, Anesthetist, Nurses and
													Specialists</td>
												<td><?php echo array_key_exists( 'doctor_fee',$vFeatures) ? $vFeatures['doctor_fee'] : '';?></td>
											</tr>
											<tr>
												<td><strong>Pre-hospitalisation</strong></td>
												<td><?php echo array_key_exists( 'pre_hosp',$vFeatures) ? $vFeatures['pre_hosp'] : '';?></td>
											</tr>
											<tr>
												<td><strong>Post-hospitalisation</strong></td>
												<td><?php echo array_key_exists( 'post_hosp',$vFeatures) ? $vFeatures['post_hosp'] : '';?></td>
											</tr>
											<tr>
												<td><strong>Day care expenses</strong></td>
												<td><?php echo array_key_exists( 'day_care',$vFeatures) ? $vFeatures['day_care'] : '';?></td>
											</tr>
											<tr>
												<td><strong>Domiciliary Hospitalisation</strong></td>
												<td><?php echo array_key_exists( 'domiciliary_treatment_expenses',$vFeatures) ? $vFeatures['domiciliary_treatment_expenses'] : '';?></td>
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
												<td><?php echo array_key_exists( 'maternity_waiting_period',$vFeatures) ? $vFeatures['maternity_waiting_period'] : '';?></td>
											</tr>
											<tr>
												<td>Normal Delivery</td>
												<td><?php echo array_key_exists( 'maternity_normal_delivery',$vFeatures) ? $vFeatures['maternity_normal_delivery'] : '';?></td>
											</tr>
											<tr>
												<td>Caesarean Delivery</td>
												<td><?php echo array_key_exists( 'maternity_caesarean_delivery',$vFeatures) ? $vFeatures['maternity_caesarean_delivery'] : '';?></td>
											</tr>
											<tr>
												<td>New-born baby cover</td>
												<td><?php echo array_key_exists( 'maternity_new_born_baby_cover',$vFeatures) ? $vFeatures['maternity_new_born_baby_cover'] : '';?></td>
											</tr>
											<tr>
												<td>Addition of New-born</td>
												<td><?php echo array_key_exists( 'maternity_addition_of_new_born',$vFeatures) ? $vFeatures['maternity_addition_of_new_born'] : '';?></td>
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
												<td><?php echo array_key_exists( 'autorecharge_SI',$vFeatures) ? $vFeatures['autorecharge_SI'] : '';?></td>
											</tr>
											<tr>
												<td>Hospital Cash</td>
												<td><?php echo array_key_exists( 'hospital_cash',$vFeatures) ? $vFeatures['hospital_cash'] : '';?></td>
											</tr>
											<tr>
												<td>Ambulance Charges</td>
												<td><?php echo array_key_exists( 'emergency_ambulance',$vFeatures) ? $vFeatures['emergency_ambulance'] : '';?></td>
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
												<td><?php echo array_key_exists( 'organ_donor_exp',$vFeatures) ? $vFeatures['organ_donor_exp'] : '';?></td>
											</tr>
											<tr>
												<td>Ayurvedic Treatment</td>
												<td><?php echo array_key_exists( 'ayurvedic',$vFeatures) ? $vFeatures['ayurvedic'] : '';?></td>
											</tr>
											<tr>
												<td>Second Opinion</td>
												<td><?php echo array_key_exists( 'second_opinion',$vFeatures) ? $vFeatures['second_opinion'] : '';?></td>
											</tr>
											<tr>
												<td>E-opinion</td>
												<td><?php echo array_key_exists( 'e-opinion',$vFeatures) ? $vFeatures['e-opinion'] : '';?></td>
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
												<td><?php echo array_key_exists( 'family_discount',$vFeatures) ? $vFeatures['family_discount'] : '';?></td>
											</tr>
											<tr>
												<td>Cumulative Bonus</td>
												<td><?php echo array_key_exists( 'cumulative_bonus',$vFeatures) ? $vFeatures['cumulative_bonus'] : '';?></td>
											</tr>
											<tr>
												<td>Two Year Policy Option</td>
												<td><?php echo array_key_exists( 'two_year_policy_option',$vFeatures) ? $vFeatures['two_year_policy_option'] : '';?></td>
											</tr>
											<tr>
												<td>Co-payment</td>
												<td><?php echo array_key_exists( 'co_pay',$vFeatures) ? $vFeatures['co_pay'] : '';?></td>
											</tr>
											<tr>
												<td>Cashless</td>
												<td><?php echo array_key_exists( 'cashless_treatment',$vFeatures) ? $vFeatures['cashless_treatment'] : '';?></td>
											</tr>
											<tr>
												<td>Claim Loading</td>
												<td><?php echo array_key_exists( 'claim_loading',$vFeatures) ? $vFeatures['claim_loading'] : '';?></td>
											</tr>
										</tbody>
									</table>
	
	
	
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
					<div class="htabs col-lg-3 col-md-3 col-sm-12 col-xs-12" id="tabs">
						<a href="#tab-a" class="selected">Claims Ratio </a> 
						<a href="#tab-b" class="">Surrender Policy</a> 
						<a href="#tab-c" class="">Revive Policy</a> 
						<a href="#tab-d" class="">Loan</a> 
						<a href="#tab-e" class="">About Company</a>
					</div>
					<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
						<div class="tab-content box-description" id="tab-a" style="display: block;">

							<div class="form-add">
							<?php 
								$yearFrom = date('Y')-1;
								if ($yearFrom != '1999')
									$yearTo = substr(date('Y'), 2, 2);
								else 
									$yearTo = '2000';
							?>
								<h2>Claims Settlement Ratio in <?php echo  $yearFrom.'-'.$yearTo;?></h2>
								<div id="claims_ratio1" style="min-width: 50%; height: 400px; margin: 0 auto"></div>
							</div>


						</div>
						
						<div class="tab-content box-additional" id="tab-b" style="display: none;">
							<div class="box-collateral box-tags">
								<h2>Surrender Policy</h2>
								<div class="std"><?php echo $policyDetails['policy']['surrender_policy']?></div>
								<br class="clear clr">
							</div>
						</div>
						
						<div class="tab-content" id="tab-c" style="display: none;">
							<div class="box-collateral box-tags">
								<h2>Revive Policy</h2>
								<div class="std"><?php echo $policyDetails['policy']['revive_policy']?></div>
								<br class="clear clr">
							</div>
						</div>
						
						<div class="tab-content" id="tab-d" style="display: none;">
							<div id="customer-reviews" class="box-collateral box-reviews">
								<div class="form-add">
									<h2>Loan</h2>
									<div class="std"><?php echo $policyDetails['policy']['loan']?></div>
								</div>
							</div>
						</div>
						<div class="tab-content" id="tab-e" style="display: none;">
							<div id="customer-reviews" class="box-collateral box-reviews">
								<h2>About Company</h2>
								<div class="std"><?php echo $companyDetails['description_1']?></div>
								<br class="clear clr">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row pad" id="thisdiv">
			<div class="col-sm-12">
				<h2 class="lined-heading">
					<span>Peer Comparison</span>
				</h2>
			</div>
			<div class="col-sm-12">
				<div class="wid_25">
					<div class="h_w">Cover Amount</div>
					<!--<div class="c_w"><select id="c_amt" class="form-control">
  <option value="50">50 Lakhs</option>
  <option value="1">1 Crore</option>
  
</select></div>-->


					<div class="">
						<div class="wrapper-demo">
							<div id="dd" class="wrapper-dropdown-1" tabindex="1">
								<span>50 Lakhs</span>
								<ul class="dropdown" tabindex="1">
									<li><a href="#">50 Lakhs</a></li>
									<li><a href="#">1 Crore</a></li>
								</ul>
							</div>
							​
						</div>


					</div>
				</div>
				<div class="wid_25">
					<div class="h_w">Term</div>
					<div class="">
						<div class="wrapper-demo">
							<div id="dd1" class="wrapper-dropdown-1" tabindex="1">
								<span>25 Years</span>
								<ul class="dropdown" tabindex="1">
									<li><a href="#">25 Years</a></li>
									<li><a href="#">30 Years</a></li>
								</ul>
							</div>
							​
						</div>
						<!--<select id="c_term" class="form-control">
  <option value="25">25 Years</option>
  <option value="35">35 Years</option>
  
</select>-->

					</div>
				</div>
				<div class="wid_25">
					<div class="h_w">Age</div>
					<div class="c_w">25 Years</div>
				</div>
				<div class="wid_25">
					<div class="h_w">Gender</div>
					<div class="c_w">Male</div>
				</div>
				<div class="wid_25">
					<div class="h_w">Life Style</div>
					<div class="c_w">Healthy, Non smoker</div>
				</div>
			</div>
			<div class="col-sm-12 clearfix no_pad_lr">
				<!--      <div class="com"  ><a class="btn_offer_block com_premium" id="com_premium_shw" href="javascript:void(0)">Compare <i class="fa fa-angle-right"></i></a></div></div>
-->
				<div class="col-sm-12 clearfix count_shw no_pad_lr" id="">



					<div class="col-md-12 no_pad_lr">


						<div class="col-md-4 no_pad_lr">
							<div class=" chartdiv clearfix">
								<div align="center">
									<img
										src="<?php echo base_url();?>assets/images/company/hdfc.jpg"
										border="0">
								</div>
								<div id="container" class=""
									style="max-width: 100%; height: 300px; margin: 0 auto"></div>
							</div>
						</div>

						<div class=" col-md-2 no_pad_lr chartdiv1">
							<div align="center">
								<img
									src="<?php echo base_url();?>assets/images/company/bharti-axa-general-insurance-company-small.jpg"
									border="0">
							</div>

							<div id="container1" class="chartdiv"
								style="max-width: 100%; height: 300px; margin: 0 auto"></div>
						</div>


						<div class="col-md-2 no_pad_lr chartdiv2">
							<div align="center">
								<img
									src="<?php echo base_url();?>assets/images/company/l-t-general-insurance-company-small.jpg"
									border="0">
							</div>

							<div id="container2" class="chartdiv"
								style="max-width: 100%; height: 300px; margin: 0 auto"></div>
						</div>

						<div class="col-md-2 no_pad_lr chartdiv3">
							<div align="center">
								<img
									src="<?php echo base_url();?>assets/images/company/bajaj-allianz-general-insurance-company-small.jpg"
									border="0">
							</div>
							<div id="container3" class="chartdiv"
								style="max-width: 100%; height: 300px; margin: 0 auto"></div>
						</div>

						<div class="col-md-2 no_pad_lr chartdiv4">
							<div align="center">
								<img
									src="<?php echo base_url();?>assets/images/company/tata-aig-general-insurance-company-small.jpg"
									border="0">
							</div>
							<div id="container4" class="chartdiv"
								style="max-width: 100%; height: 300px; margin: 0 auto"></div>
						</div>
					</div>

					<div class="cal">
						<a class="btn_offer_block" href="javascript:void(0)">Calculate
							Your Premium <i class="fa fa-angle-right"></i> </a>
					</div>

				</div>

			</div>
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


			<div class="row">
				<div class="col-sm-12">
					<h2 class="lined-heading">
						<span>L&T my health Medisure Classic Brochure</span>
					</h2>
				</div>

				<!--<div class="col-sm-12" style=" float: none;
    margin: 0 auto;
    width: 600px;">
      <div class="col-sm-3 text-center"><img src="<?php echo base_url();?>assets/images/brch_1.jpg" border="0"></div>
      <div class="col-sm-3 text-center"><img src="<?php echo base_url();?>assets/images/brch_2.jpg" border="0"></div>
      <div class="col-sm-3 text-center"><img src="<?php echo base_url();?>assets/images/brch_3.jpg" border="0"></div>
      <div class="col-sm-3 text-center"><img src="<?php echo base_url();?>assets/images/brch_4.jpg" border="0"></div>
      </div>-->





				<div class="col-sm-12">

					<div class="sixteen columns">


						<div class="portfolio clearfix">



							<ul class="list">


								<li class="" data-content="#colio_c1">
									<div class="thumb">
										<a class="button colio-link" href="#"><div class="view"></div>
										</a> <img
											src="<?php echo base_url();?>assets/images/brch_1.jpg"
											alt="Pic" />
									</div>
								</li>



								<li class="" data-content="#colio_c2">
									<div class="thumb">
										<a class="button colio-link" href="#"><div class="view"></div>
										</a> <img
											src="<?php echo base_url();?>assets/images/brch_2.jpg"
											alt="Pic" />
									</div>
								</li>

								<li class="" data-content="#colio_c3">
									<div class="thumb">
										<a class="button colio-link" href="#"><div class="view"></div>
										</a> <img
											src="<?php echo base_url();?>assets/images/brch_3.jpg"
											alt="Pic" />
									</div>
								</li>

								<li class="" data-content="#colio_c4">
									<div class="thumb">
										<a class="button colio-link" href="#"><div class="view"></div>
										</a> <img
											src="<?php echo base_url();?>assets/images/brch_4.jpg"
											alt="Pic" />
									</div>
								</li>



							</ul>
							<!-- list -->

						</div>
						<!-- portfolio -->


						<!-- colio-content # colio_c1 -->

						<div id="colio_c1" class="colio-content">

							<div class="main">
								<div align="center">

									<span class='zoom'> <img
										src='<?php echo base_url();?>assets/images/pdf/hdfclife_click_2_protect_plan_brochure-1.jpg'
										width="600" height="680" alt='' /> </span>
								</div>




							</div>
						</div>

						<div id="colio_c2" class="colio-content">
							<div class="main">
								<div align="center">
									<span class='zoom'><img
										src="<?php echo base_url();?>assets/images/pdf/hdfclife_click_2_protect_plan_brochure-2.jpg"
										width="600" height="680" border="0"> </span>
								</div>
							</div>
						</div>

						<div id="colio_c3" class="colio-content">
							<div class="main">
								<div align="center">
									<span class='zoom'><img
										src="<?php echo base_url();?>assets/images/pdf/hdfclife_click_2_protect_plan_brochure-3.jpg"
										width="600" height="680" border="0"> </span>
								</div>
							</div>
						</div>

						<div id="colio_c4" class="colio-content">
							<div class="main">
								<div align="center">
									<span class='zoom'><img
										src="<?php echo base_url();?>assets/images/pdf/hdfclife_click_2_protect_plan_brochure-4.jpg"
										width="600" height="680" border="0"> </span>
								</div>


							</div>
						</div>



					</div>

				</div>








			</div>




















			<div class="row">
				<div class="col-sm-12">
					<h2 class="lined-heading">
						<span>L&T my health Medisure policy wording</span>
					</h2>
				</div>

				<!--<div class="col-sm-12" style=" float: none;
    margin: 0 auto;
    width: 600px;">
      <div class="col-sm-3 text-center"><img src="<?php echo base_url();?>assets/images/brch_1.jpg" border="0"></div>
      <div class="col-sm-3 text-center"><img src="<?php echo base_url();?>assets/images/brch_2.jpg" border="0"></div>
      <div class="col-sm-3 text-center"><img src="<?php echo base_url();?>assets/images/brch_3.jpg" border="0"></div>
      <div class="col-sm-3 text-center"><img src="<?php echo base_url();?>assets/images/brch_4.jpg" border="0"></div>
      </div>-->





				<div class="col-sm-12">

					<div class="sixteen columns">


						<div class="portfolio clearfix">



							<ul class="list">


								<li class="" data-content="#wording_c1">
									<div class="thumb">
										<a class="button colio-link" href="#"><div class="view"></div>
										</a> <img
											src="<?php echo base_url();?>assets/images/brch_1.jpg"
											alt="Pic" />
									</div>
								</li>



								<li class="" data-content="#wording_c2">
									<div class="thumb">
										<a class="button colio-link" href="#"><div class="view"></div>
										</a> <img
											src="<?php echo base_url();?>assets/images/brch_2.jpg"
											alt="Pic" />
									</div>
								</li>

								<li class="" data-content="#wording_c3">
									<div class="thumb">
										<a class="button colio-link" href="#"><div class="view"></div>
										</a> <img
											src="<?php echo base_url();?>assets/images/brch_3.jpg"
											alt="Pic" />
									</div>
								</li>

								<li class="" data-content="#wording_c4">
									<div class="thumb">
										<a class="button colio-link" href="#"><div class="view"></div>
										</a> <img
											src="<?php echo base_url();?>assets/images/brch_4.jpg"
											alt="Pic" />
									</div>
								</li>



							</ul>
							<!-- list -->

						</div>
						<!-- portfolio -->


						<!-- colio-content # colio_c1 -->

						<div id="wording_c1" class="colio-content">

							<div class="main">
								<div align="center">

									<span class='zoom'> <img
										src='<?php echo base_url();?>assets/images/pdf/hdfclife_click_2_protect_plan_brochure-1.jpg'
										width="600" height="680" alt='' /> </span>
								</div>




							</div>
						</div>

						<div id="wording_c2" class="colio-content">
							<div class="main">
								<div align="center">
									<span class='zoom'><img
										src="<?php echo base_url();?>assets/images/pdf/hdfclife_click_2_protect_plan_brochure-2.jpg"
										width="600" height="680" border="0"> </span>
								</div>
							</div>
						</div>

						<div id="wording_c3" class="colio-content">
							<div class="main">
								<div align="center">
									<span class='zoom'><img
										src="<?php echo base_url();?>assets/images/pdf/hdfclife_click_2_protect_plan_brochure-3.jpg"
										width="600" height="680" border="0"> </span>
								</div>
							</div>
						</div>

						<div id="wording_c4" class="colio-content">
							<div class="main">
								<div align="center">
									<span class='zoom'><img
										src="<?php echo base_url();?>assets/images/pdf/hdfclife_click_2_protect_plan_brochure-4.jpg"
										width="600" height="680" border="0"> </span>
								</div>


							</div>
						</div>



					</div>

				</div>








			</div>



























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
					<div data-za-intent="raterestaurant.post" data-za-events="click"
						class="rating-widget-stars left">
						<div data-rating="0" data-originalclass="user_starssel_0"
							class="rating-cls user_starssel_0">
							<a data-hover-rating="1.0" data-num="2" class="level-1"
								href="javascript:void(0);">&nbsp;</a> <a data-hover-rating="1.5"
								data-num="3" class="level-2" href="javascript:void(0);">&nbsp;</a>
							<a data-hover-rating="2.0" data-num="4" class="level-3"
								href="javascript:void(0);">&nbsp;</a> <a data-hover-rating="2.5"
								data-num="5" class="level-4" href="javascript:void(0);">&nbsp;</a>
							<a data-hover-rating="3.0" data-num="6" class="level-5"
								href="javascript:void(0);">&nbsp;</a> <a data-hover-rating="3.5"
								data-num="7" class="level-6" href="javascript:void(0);">&nbsp;</a>
							<a data-hover-rating="4.0" data-num="8" class="level-7 big"
								href="javascript:void(0);">&nbsp;</a> <a d
								data-hover-rating="4.5" data-num="9" class="level-8 big"
								href="javascript:void(0);">&nbsp;</a> <a data-hover-rating="5.0"
								data-num="10" class="level-9 big bigger"
								href="javascript:void(0);">&nbsp;</a>
						</div>
					</div>
				</div>


				<div class="tot_votes">
					<div class="avg_vote">
						<span>4.0</span><span class="sm">/5</span>
					</div>
					<div class="tot_votes_m">based on 2476 Votes</div>
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
				$arrParams['disqus_identifier'] = base_url().'admin/guides/create/1';  
				$arrParams['disqus_url'] = base_url().'admin/guides/create/1';
				$arrParams['disqus_title'] = "test guide";
				$arrParams['disqus_category_id'] = '3125046';
		//	echo DisqusLib::displayDisqus($arrParams);
										
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
?>
	</div>
</div>


<script type="text/javascript" src="<?php echo base_url();?>assets/js/page.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/site.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/highcharts.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/highcharts-more.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/exporting.js"></script>


<script src="<?php echo base_url();?>assets/js/jquery.easytabs.js" type="text/javascript"></script>



<script type="text/javascript">
$('#tabs a').tabs();

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



<script type="text/javascript">
			
			function DropDown(el) {
				this.dd = el;
				this.placeholder = this.dd.children('span');
				this.opts = this.dd.find('ul.dropdown > li');
				this.val = '';
				this.index = -1;
				this.initEvents();
			}
			DropDown.prototype = {
				initEvents : function() {
					var obj = this;

					obj.dd.on('click', function(event){
						$(this).toggleClass('active');
						return false;
					});

					obj.opts.on('click',function(){
						var opt = $(this);
						obj.val = opt.text();
						
						
						
						
						
						//amt_value = $(this).val();
	   
	   	var chart = $('#container').highcharts();
	   var point = chart.series[0].points[0],
		            newVal;
					
					var chart1 = $('#container1').highcharts();
	   var point1 = chart1.series[0].points[0],
		            newVal1;
					
					var chart2 = $('#container2').highcharts();
	   var point2 = chart2.series[0].points[0],
		            newVal2;
					
					
					var chart3 = $('#container3').highcharts();
	   var point3 = chart3.series[0].points[0],
		            newVal3;
					
					
					var chart4 = $('#container4').highcharts();
	   var point4 = chart4.series[0].points[0],
		            newVal4;
					
	   if(obj.val == "1 Crore"){
		        
		        newVal = point.y - 2000;
				newVal1 = point1.y - 2000;
				newVal2 = point2.y - 2000;
				newVal3 = point3.y - 2000;
				newVal4 = point4.y - 2000;
				point.update(newVal);
				point1.update(newVal1);
				point2.update(newVal2);
				point3.update(newVal3);
				point4.update(newVal4);
  
	   }
	    if(obj.val == "50 Lakhs"){
			
		        
		        newVal = point.y + 2000;
				
				newVal1 = point1.y + 2000;
				newVal2 = point2.y + 2000;
				newVal3 = point3.y + 2000;
				newVal4 = point4.y + 2000;
				
				point.update(newVal);
				point1.update(newVal1);
				point2.update(newVal2);
				point3.update(newVal3);
				point4.update(newVal4);
	   }
						
						
						
						
						obj.index = opt.index();
						obj.placeholder.text(obj.val);
					});
				},
				getValue : function() {
					return this.val;
				},
				getIndex : function() {
					return this.index;
				}
			}

			$(function() {

				var dd = new DropDown( $('#dd') );
var dd = new DropDown( $('#dd1') );
				$(document).click(function() {
					// all dropdowns
					$('.wrapper-dropdown-1').removeClass('active');
				});

			});
			
		</script>
