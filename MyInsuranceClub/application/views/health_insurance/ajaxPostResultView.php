<?php 
$con = &get_instance();
$folderUrl = $con->config->config['folder_path']['company']['searchResultLogo'];
$fileUrl = $con->config->config['url_path']['company']['searchResultLogo'];
$pfolderUrl = $con->config->config['folder_path']['policy']['brochure'];;
$pfileUrl = $con->config->config['url_path']['policy']['policy_wordings'];
$temp = $customer_details;
if($compareParam == 'yes' && !empty($cookie_customer_detail))
{
	$customer_details = $cookie_customer_detail;
}

if(empty($customer_details))
{?>
<div>There are no plans that match your selection criteria.</div>
<?php }
    
elseif(! empty ( $customer_details )) {
	$plans = count($customer_details);
	?>
	
	<?php 
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
		
		if ((int) (trim ( $detail ['sum_assured'] )) != (int) $con->session->userdata ['user_input'] ['coverage_amount_literal']) {
				
				$sum_assured = "<span style='color: #2CA3EF;'>&#8377;" . Util::moneyFormatIndia($detail ['sum_assured']) . "</span>";
		} else {
			$sum_assured = "<span>&#8377;" . Util::moneyFormatIndia($detail ['sum_assured']) . "</span>";
		}
		$compared_plans = array();
		$plan_checked = '';
		/* if($this->input->cookie('compared_plans'))
		{
			$compared_plans = unserialize($this->input->cookie('compared_plans'));
			
			if(in_array($detail['variant_id'],$compared_plans))
			{
			
				$plan_checked = "checked='checked'";
			}
			else{
				$plan_checked = "";
			}
		} */
		
		?>


<div class="cmp_tbl">
	<div class="cus_tb clearfix">
		<div class="col-md-2 pad-right-10 logo_ins">
			<div class="img_bx">
				<img src="<?php echo $fileUrl.$detail['logo_image_2'];?>" border="0"
					class="img_bx_i">
				<div class="check_bx">
					<div class="checkbox">
						<label> <input type="checkbox" name="compare[]" id="c_name_<?php echo $detail ['variant_id'].$detail['annual_premium'];?>"
							class="cmpplans" value="<?php echo $compare_data?>" <?php echo $plan_checked; ?>> <label
							class="chk" for="c_name_<?php echo $detail ['variant_id'].$detail['annual_premium'];?>"></label>
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
			<div class="col-md-2" style="padding:0px">
                 
                 <div class="down_cnt" style="width:20px; height:auto; float:left; "><i class="fa fa-plus-square"></i>
                
                 </div>
  <div class="down_cnt_up" style=""><i class="fa fa-angle-up"></i> 
                
                 </div>
                 </div>
			<div class="col-md-4 post_msg" id="buy_now_message_<?php echo $detail['variant_id'];?>" style="display:none">
			Sure! We will call you back.
			</div>
			<div class="col-md-4 pad_r_10" id="buy_now_btn_<?php echo $detail['variant_id'];?>">
				<a class="btn_offer_block" href="#" onclick="return buy_now_msg(<?php echo $detail['variant_id']?>,<?php echo $detail['policy_id'];?>);">Buy Now <i
					class="fa fa-angle-right"></i></a>
				<div class="thumb">
					<i class="fa fa-thumbs-up"></i>
					<div class="text_t"><?php echo $detail['buy_now_click_count']?> people chose this plan</div>
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
								<td class="cus_width"><?php echo $detail['check_up']?></td>
							</tr>
							<tr class="odd">
								<td>Ayurvedic Treatment</td>
								<td class="cus_width"><?php echo $detail['ayurvedic']?></td>
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
											<div class="city_a"><b>Hospital Name</b></div>
											<div class="city_b"><b>City</b></div>
											<div class="city_c"><b>Pin Code</b></div>
										</div>
										<span class="tt-suggestions resultTable"
											id="resultTable_<?php echo $detail['variant_id']?>"
											style="display: block;"></span>
									</div>
								</span>
							</div>
							<div
								style="float: left; position: absolute; bottom: 0px; margin-bottom: 10px;"
								class=""><b>Note</b>: This list is subject to change without any notice</div>

						</div>
					</div>
				</div>
			</div>


			<div class="col-md-5">
				<h4 class="h_d mar-40" style="margin-left: 50px;">Documents</h4>
				<ul class="doc">
				<?php if (!empty($detail['brochure']) && file_exists($pfolderUrl.$detail['brochure']))?>
					
					<?php {?>
							<li>Policy Brouchure <a href="<?php echo $pfileUrl.$detail['brochure'];?>"><img
									src="<?php echo base_url();?>/assets/images/pdf.jpg"></a></li>
					<?php }?>
					
				<?php if (!empty($detail['policy_wordings']) && file_exists($pfolderUrl.$detail['policy_wordings']))?>
					
					<?php {?>
							<li>Policy Wordings <a href="<?php $pfileUrl.$detail['policy_wordings']?>"><img
							src="<?php echo base_url();?>/assets/images/pdf.jpg" class="dimg"></a></li>
					<?php }?>
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

		 $customer_details = $temp;		
		
?>

