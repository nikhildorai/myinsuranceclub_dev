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
		
		$variant = '';
		
		$trip_duration = '';
		
		if ($detail ['variant_name'] != 'Base') {
			$variant = ' ' . $detail ['variant_name'];
		} else {
			$variant = '';
		}
		
		$sum_assured ='';
		
		if(isset($this->session->userdata['user_input']['cust_age']))
		{
			$age = $this->session->userdata['user_input']['cust_age'];
		}
		
		if(isset($this->session->userdata['user_input']['trip_duration']))
		{
		
			$trip_duration = $this->session->userdata['user_input']['trip_duration'];
		}
		else
		{
			$trip_duration = $detail['maximum_trip_duration'];
		}
		
		$compare_data = $detail ['variant_id'] . '-' . $detail ['annual_premium']. '-' . $detail['location_id']. '-' . $age . '-'. $detail['no_of_members']. '-' . $trip_duration.'-'.$detail['sub_product_id'];
		
		$sum_assured = "<span>USD " . number_format($detail ['sum_assured']). "</span>";
		
		$compared_plans = array();
		$plan_checked = '';
		
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
							class="cmpplans" value="<?php echo $compare_data?>" <?php //echo $plan_checked; ?>> <label
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
				<a class="btn_offer_block" href="javascript:void(0);" onclick="return buy_now_msg(<?php echo $detail['variant_id']?>,<?php echo $detail['policy_id'];?>);">Buy Now <i
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
                          <td>Medical Treatment</td>
                          <td class="cus_width">Cover of USD <?php echo $detail['medical_expenses']; ?></td>
                        </tr>
                        <tr>
                          <td>Dental Treatment</td>
                          <td class="cus_width">Cover of USD <?php echo $detail['dental']?><br/>
                            This is part of 'Medical Treatment'</td>
                        </tr>
                        <tr class="odd">
                          <td>Medical Evacuation</td>
                          <td class="cus_width">Covered as part of 'Medical Treatment'</td>
                        </tr>
                        <tr >
                          <td>Hospital Daily Allowance</td>
                          <td class="cus_width"> <?php echo $detail['hospital_daily_cash']?></td>
                        </tr>
                        <tr class="odd">
                          <td>Balance Treatment back in India</td>
                          <td class="cus_width">-</td>
                        </tr>
                        <tr >
                          <td>Total Loss of Checked-in Baggage</td>
                          <td class="cus_width">USD <?php echo $detail['total_loss_of_checked_baggage'];?></td>
                        </tr>
                        <tr class="odd">
                          <td>Delay of Checked-in baggage</td>
                          <td class="cus_width">USD <?php echo $detail['delay_of_checked_baggage'];?></td>
                        </tr>
                        <tr >
                          <td>Loss of Passport</td>
                          <td class="cus_width">USD <?php echo $detail['loss_of_passport']?></td>
                        </tr>
                        <tr class="odd">
                          <td>Financial Emergency Cash</td>
                          <td class="cus_width">USD <?php echo $detail['financial_emergency']?></td>
                        </tr>
                        <tr >
                          <td>Repatriation of mortal remains</td>
                          <td class="cus_width"><?php echo $detail['repatriation_of_mortal_remains'];?><br/>Covered as part of 'Medical Treatment'</td>
                        </tr>
                        <tr class="odd">
                          <td>Personal Liability</td>
                          <td class="cus_width">USD <?php echo $detail['personal_liability']?></td>
                        </tr>
                        <tr >
                          <td>Personal Accident</td>
                          <td class="cus_width">USD <?php echo $detail['personal_accident']?></td>
                        </tr>
                        <tr class="odd">
                          <td>Trip Delay</td>
                          <td class="cus_width"><?php echo $detail['trip_delay'];?></td>
                        </tr>
                        <tr >
                          <td>Trip Cancellation</td>
                          <td class="cus_width"><?php echo $detail['trip_cancellation'];?></td>
                        </tr>
                        <tr class="odd">
                          <td>Trip Curtailment</td>
                          <td class="cus_width"><?php echo $detail['trip_curtailment'];?></td>
                        </tr>
                        <tr>
                        	<?php 
                        			/* $hijack_details = '';
                        			
                        			if($detail['hijack_daily_allowance'] != '')
									{
                        				$splitData = explode('/',$detail['hijack_daily_allowance']);
								    	
                        				$hijack_details = "USD $splitData[0] per day to maximum USD $splitData[1]";
									}  

								    else
								    {
								    	$hijack_details = '-';
								    } */
                        	?>
                          <td>Hijack Allowance</td>
                          <td class="cus_width"><?php echo $detail['hijack_daily_allowance']; ?></td>
                        </tr>
						</tbody>
					</table>
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

