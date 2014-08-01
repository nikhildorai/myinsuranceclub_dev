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
	
	
	?>
	
	<?php 
	foreach ( $customer_details as $detail ) {
		
			
		$sum_assured_session = $con->session->userdata['user_input']['coverage_amount_literal'];
		
		$service_tax = round($detail['annual_premium'] * 0.1236);
		
		
		
		$variant = '';
		if ($detail ['variant_name'] != 'Base') {
			$variant = ' ' . $detail ['variant_name'];
		} else {
			$variant = '';
		}
		
		$compare_data = $detail ['variant_id'] . '-' . $detail['annual_premium'] . '-' . $detail ['age'];
				
		$sum_assured = "<span>&#8377;" . Util::moneyFormatIndia($sum_assured_session) . "</span>";
		
		$compared_plans = array();
		
		/* $plan_checked = '';
		
		if($this->input->cookie('compared_plans'))
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
				<h3 class="anc">&#8377;<?php echo number_format($detail['annual_premium']);?></h3>
				<p class="sub_tit">for cover of <?php echo $sum_assured ?></p>
			</div>
			<div class="col-md-2" style="padding:0px">
                 
                 <div class="down_cnt" style="width:20px; height:auto; float:left; "><i class="fa fa-plus-square"></i>
                
                 </div>
  <div class="down_cnt_up" style=""><i class="fa fa-angle-up"></i> 
                
                 </div>
                 </div>
			<div class="col-md-4 post_msg" id="buy_now_message_<?php echo $detail['variant_id'];?>" style="display:none">
			Call 100100100 to buy this policy
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

