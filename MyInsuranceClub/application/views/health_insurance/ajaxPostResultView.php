<?php 

$con = &get_instance();
$folderUrl = $con->config->config['folder_path']['company'];
$fileUrl = $con->config->config['url_path']['company'];
$pfolderUrl = $con->config->config['folder_path']['policy'];
$pfileUrl = $con->config->config['url_path']['policy'];


if(empty($customer_details))
{?>
<div>There are no plans that match your selection criteria.</div>
<?php }
    
elseif(! empty ( $customer_details )) {
	foreach ( $customer_details as $detail ) {
		
		$preexist_diseases = '';
		
		if (trim ( $detail ['preexisting_diseases'] ) != 'Not Covered') {
			$preexist_diseases = 'Waiting period of ' . $detail ['preexisting_diseases'] . ' years';
		} else {
			$preexist_diseases = $detail ['preexisting_diseases'];
		}
		$variant = '';
		if ($detail ['variant_name'] != 'Base') {
			$variant = ' ' . $detail ['variant_name'];
		} else {
			$variant = '';
		}
		
		$compare_data = $detail ['variant_id'] . '-' . $detail ['annual_premium'] . '-' . $detail ['age'];
		
		if (trim ( $detail ['sum_assured'] ) != $con->session->userdata ['user_input'] ['coverage_amount_literal']) {
			$sum_assured = "<span style='color: #ff6633;'>&#8377;" . number_format ( $detail ['sum_assured'] ) . "</span>";
		} else {
			$sum_assured = "<span>&#8377;" . number_format ( $detail ['sum_assured'] ) . "</span>";
		}
		?>


<div class="cmp_tbl">
	<div class="cus_tb clearfix">
		<div class="col-md-2 pad-right-10 logo_ins">
			<div class="img_bx">
				<img src="<?php echo $fileUrl.$detail['logo_image_2'];?>" border="0"
					class="img_bx_i">
				<div class="check_bx">
					<div class="checkbox">
						<label> <input type="checkbox" name="compare[]" id="c_name"
							class="cmpplans" value="<?php echo $compare_data?>"> <label
							class="chk" for="Field4"></label>
						</label>
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-3 pad-left-10">
			<div class="c_t">
				<span class="title_c" style="width: 100%;"><?php echo $detail['company_shortname']?></span><span
					class="sub_tit"><?php echo $detail['policy_name'].$variant?></span>
			</div>
		</div>

		<div class="col-md-7 m_anc">
			<div class="col-md-6 no_pad_l">
				<h3 class="anc">&#8377;<?php echo number_format($detail['annual_premium'])?></h3>
				<p class="sub_tit">for cover of <?php echo $sum_assured ?></p>
			</div>
			<div class="col-md-2" style="padding: 0px">
				<div class="down_cnt"
					style="width: 20px; height: auto; float: left; color: #999999;">
					<i class="fa fa-th"></i>
				</div>
				<div class="down_cnt_up" style="">
					<i class="fa fa-angle-up"></i>
				</div>
			</div>
			<div class="col-md-4 pad_r_10">
				<a class="btn_offer_block" href="#">Buy Now <i
					class="fa fa-angle-right"></i></a>
				<div class="thumb">
					<i class="fa fa-thumbs-up"></i>
					<div class="text_t">12 people chose this plan</div>
				</div>
			</div>
		</div>
	</div>

	<div class="accordion_a">
		<div class="col-md-12">
			<div class="col-md-12 mar-10">
				<h4 class="h_d">Key Features</h4>
				<div class="custom-table-1">
					<table width="100%">
						<tbody>
							<tr class="odd">
								<td>Cashless treatment</td>
								<td class="cus_width"><?php echo $detail['cashless_treatment'] ?>
        															</td>
							</tr>
							<tr>
								<td>Pre-existing diseases</td>
								<td class="cus_width"><?php echo $preexist_diseases?>
        															</td>
							</tr>
							<tr class="odd">
								<td>Auto recharge of Sum Insured</td>
								<td class="cus_width"><?php echo $detail['autorecharge_SI']?>
        															</td>
							</tr>
							<tr>
								<td>Hospitalisation expenses
									<ul>
										<li><i class="fa fa-angle-right"></i> Room Rent</li>
										<li><i class="fa fa-angle-right"></i> ICU Rent</li>
										<li><i class="fa fa-angle-right"></i> Fees of Surgeon,
											Anesthetist, Medicines, Nurses, etc</li>
									</ul>
								</td>
								<td class="cus_width">
									<ul class="no">
										<li><?php echo $detail['room_rent']?></li>
										<li><?php echo $detail['icu_rent']?></li>
										<li><?php echo $detail['doctor_fee']?></li>
									</ul>
								</td>
							</tr>
							<tr class="odd">
								<td>Pre-hospitalisation</td>
								<td class="cus_width"><?php echo $detail['pre_hosp']?></td>
							</tr>
							<tr>
								<td>Post-hospitalisation</td>
								<td class="cus_width"><?php echo $detail['post_hosp']?></td>
							</tr>
							<tr class="odd">
								<td>Day care expenses</td>
								<td class="cus_width"><?php echo $detail['day_care']?></td>
							</tr>
							<tr>
								<td>Maternity Benefits</td>
								<td class="cus_width"><?php echo $detail['maternity']?></td>
							</tr>
							<tr>
								<td>Health Check up</td>
								<td class="cus_width"><?php $detail['check_up']?></td>
							</tr>
							<tr class="odd">
								<td>Ayurvedic Treatment</td>
								<td class="cus_width"><?php $detail['ayurvedic']?></td>
							</tr>
							<tr>
								<td>Co-payment</td>
								<td class="cus_width"><?php echo $detail['co_pay']?></td>
							</tr>

						</tbody>
					</table>
				</div>
			</div>


			<div class="col-md-7 medical"
				style="padding-right: 0px; margin-bottom: 0px;">
				<h4 class="h_d mar-40">List of Hospitals with Cashless Facility</h4>
				<div class="cus_d" style="padding: 5px;">
					<div style="float: left; width: 100%; margin-top: 10px;">
						<div style="float: right; width: 100%; padding-left: 15px;">
							<div class="form-group col-md-12" style="margin-bottom: 0px;">
								<label for="" class="sr-only">Search by Pin Code</label> <input
									type="text" placeholder="Search by Pin Code or Hospital Name"
									name="hospital_list" id=""
									data-company-id="<?php echo $detail['company_id']?>"
									data-hospital-list-id="resultTable_<?php echo $detail['variant_id']?>"
									data-id="hos_class" autocomplete="off" spellcheck="false"
									class="form-control brdr typeahead tt-query med_search">

								<!--<div class="bs-example">
        			        									<input type="text" class="typeahead tt-query" autocomplete="off" spellcheck="false">
        			    									</div>-->
								<div class="search_icon">
									<i class="fa fa-search"></i>
								</div>
							</div>
						</div>

						<div class="loc_d hos"
							style="padding: 0px 15px; border: none; display: none; margin-top: 20px;">
							<div class="col-md-12">
								<span class="tt-dropdown-menu"
									style="position: absolute; top: 100%; left: 0px; z-index: 1; display: block; right: auto;">
									<div class="tt-dataset-accounts">
										<div class="city_m">
											<div class="city_a">Hospital Name</div>
											<div class="city_b">City</div>
											<div class="city_c">Pin Code</div>
										</div>
										<span class="tt-suggestions resultTable"
											id="resultTable_<?php echo $detail['variant_id']?>"
											style="display: block;"></span>
									</div>
								</span>
							</div>
							<div
								style="float: left; position: absolute; bottom: 0px; margin-bottom: 10px;"
								class="">Note: This list is subject to change without any notice</div>

						</div>
					</div>
				</div>
			</div>


			<div class="col-md-5">
				<h4 class="h_d mar-40" style="margin-left: 50px;">Documents</h4>
				<ul class="doc">
					<li>Policy Brouchure <a href="javascript:void(0)"><img
							src="<?php echo base_url();?>/assets/images/pdf.jpg"></a></li>
					<li>Policy Wordings <a href="javascript:void(0)"><img
							src="<?php echo base_url();?>/assets/images/pdf.jpg" class="dimg"></a></li>
				</ul>
				</ul>
			</div>
			<div class="col-md-12  hide_d">
				Hide details <i class="fa fa-angle-up"></i>
			</div>
		</div>
	</div>
</div>

<?php 		}
		}
?>