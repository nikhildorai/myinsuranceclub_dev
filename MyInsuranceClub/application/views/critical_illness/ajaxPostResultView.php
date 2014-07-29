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
		
		if (trim ( $detail ['preexisting_age'] ) != 'Not Covered') {
			$preexist_diseases = 'Waiting period of ' . $detail ['preexisting_age'] . ' years';
		} else {
			$preexist_diseases = $detail ['preexisting_age'];
		}
		$variant = '';
		if ($detail ['variant_name'] != 'Base') {
			$variant = ' ' . $detail ['variant_name'];
		} else {
			$variant = '';
		}
		
		$compare_data = $detail ['variant_id'] . '-' . $detail ['annual_premium'] . '-' . $detail ['age'];
			
		$sum_assured = "<span>&#8377;" . Util::moneyFormatIndia($detail ['sum_assured']) . "</span>";
		
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
						<tr class="odd">
							<td>Pre-existing diseases</td>
							<td><?php echo $preexist_diseases;?></td>
						</tr>
						<tr><td><h4 class="h_d">Diseases Covered</h4></td></tr>
						<?php if($detail['cancer'] != 'No'){?>
    						<tr class="odd">
								<td>Cancer</td>
								<td><?php echo $detail['cancer']?></td>
							</tr>
    					<?php }?>
    					
    					<?php if($detail['myocardial_infraction'] != 'No'){?>
    						<tr>
								<td>Myocardial Infraction</td>
								<td><?php echo $detail['myocardial_infraction']?></td>
							</tr>
    					<?php } ?>
    					
    					<?php if($detail['kidney_faliure'] != 'No'){?>
    						<tr class="odd">
								<td>Kidney Faliure</td>
								<td><?php echo $detail['kidney_faliure']?></td>
							</tr>
    					<?php }?>
    					
    					<?php if($detail['stroke'] != 'No'){?>
    						<tr >
								<td>Stroke</td>
								<td><?php echo $detail['stroke']?></td>
							</tr>
    					<?php }?>
    					<?php if($detail['obt'] != 'No'){?>
    						<tr class="odd">
								<td>Organ/Bone Marrow Transplant</td>
								<td><?php echo $detail['obt'] ?></td>
							</tr>
    					<?php }?>
    					<?php if($detail['cabg'] != 'No'){?>
    						<tr>
								<td>Coronary Artery Bypass Surgery</td>
								<td><?php echo $detail['cabg']?></td>
									</tr>
    					<?php }?>
    					
    					<?php if($detail['ppah'] != 'No'){?>
    						<tr class="odd">
								<td>Primary Pulmonary Arterial Hypertension</td>
								<td><?php echo $detail['ppah']?></td>
									</tr>
    					<?php }?>
    					<?php if($detail['ms'] != 'No'){?>
    						<tr>
								<td>Multiple Sclerosis</td>
								<td><?php echo $detail['ms']?></td>
									</tr>
    					<?php }?>
    					
    					<?php if($detail['coma'] != 'No'){?>
    						<tr class="odd">
								<td>Coma</td>
								<td><?php echo $detail['coma']?></td>
									</tr>
    					<?php } ?>
    					
    					<?php if($detail['ags'] != 'No'){?>
    						<tr>
								<td>Aorta Graft Surgery</td>
								<td><?php echo $detail['ags']?></td>
							</tr>
    					<?php }?>
    					<?php if($detail['ppl'] != 'No'){?>
    							
    						<tr class="odd">
								<td>Permenant Paralysis Of Limbs</td>
								<td><?php echo $detail['ppl']?></td>
									</tr>
    					<?php }?>
    					
    					<?php if($detail['cad'] != 'No'){?>
    						<tr>
								<td>Coronary Artery Disease</td>
								<td><?php echo $detail['cad']?></td>
							</tr>
    					<?php }?>
    					
    					<?php if($detail['opr'] != 'No'){?>
    
    						<tr class="odd">
								<td>Open Heart Replacement</td>
								<td><?php echo $detail['opr']?></td>
							</tr>
    					<?php }?>
    					
    					<?php if($detail['aplastic_anemia'] != 'No'){?>
    						<tr>
								<td>Aplastic Anemia</td>
								<td><?php echo $detail['aplastic_anemia']?></td>
							</tr>
    					<?php }?>

    					<?php if($detail['e_lu_d'] != 'No'){?>
    						<tr class="odd">
								<td>End Stage Lung Disease</td>
								<td><?php echo $detail['e_lu_d']?></td>
									</tr>
    					<?php }?>
    					
    					<?php if($detail['e_li_d'] != 'No'){?>
    						<tr>
								<td>End Stage Liver Disease</td>
								<td><?php echo  $detail['e_li_d']?></td>
									</tr>
    					<?php }?>
    					
    					<?php if($detail['major_burns'] != 'No'){?>
    						<tr class="odd">
								<td>Major Burns</td>
								<td><?php echo $detail['major_burns']?></td>
									</tr>
    					<?php } ?>
    					
    					<?php if($detail['mnd'] != 'No'){?>
    						<tr>
								<td>Motor Neuron Disease</td>
								<td><?php echo $detail['mnd']?></td>
									</tr>
    					<?php } ?>
    					<?php if($detail['ti'] != 'No'){?>
    						<tr class="odd">
								<td>Terminal Illness</td>
								<td><?php echo $detail['ti']?></td>
									</tr>
    					<?php }?>
    					
    					<?php if($detail['bm'] != 'No'){?>
    						<tr>
								<td>Bacterial Meningitis</td>
								<td><?php echo $detail['bm']?></td>
									</tr>
    					<?php }?>
    					
    					<?php if($detail['parkinsons'] != 'No'){?>
    							
    						<tr class="odd">
								<td>Parkinsons</td>
								<td><?php echo $detail['parkinsons']?></td>
							</tr>
    					<?php }?>
    					
    					<?php if($detail['blindness'] != 'No'){?>
    						<tr>
								<td>Blindness</td>
								<td><?php echo $detail['blindness']?></td>
									</tr>
    					<?php }?>
    
    					<?php if($detail['speech_loss'] != 'No'){?>
    						<tr class="odd">
								<td>Speech Loss</td>
								<td><?php echo $detail['speech_loss']?></td>
									</tr>
    					<?php }?>
    					
    					<?php if($detail['deafness'] != 'No'){?>
    						<tr>
								<td>Deafness</td>
								<td><?php echo $detail['deafness']?></td>
							</tr>
    					<?php }?>
    					<?php if($detail['md'] != 'No'){ ?>
    						<tr class="odd">
								<td>Muscular Dystrophy</td>
								<td><?php echo $detail['md']?></td>
							</tr>
    					<?php } ?>
    					
    					<?php if($detail['paraplegia'] != 'No'){?>
    							<tr>
									<td>Paraplegia</td>
									<td><?php echo $detail['paraplegia']?></td>
								</tr>
    					<?php }?>
    					
    					<?php if($detail['hepatoma'] != 'No'){?>
    						<tr class="odd">
								<td>Hepatoma</td>
								<td><?php echo $detail['hepatoma']?></td>
									</tr>
    					<?php }?>
    					
    					<?php if($detail['hvs'] != 'No'){?>
    						<tr>
								<td>Heart Valve Surgery</td>
								<td><?php echo $detail['hvs']?></td>
							</tr>
    					<?php } ?>
    					
    					<?php if($detail['quad'] != 'No'){ ?>
    						<tr class="odd">
								<td>Quadriplegia</td>
								<td><?php echo $detail['quad']?></td>
							</tr>
    					<?php }?>
    
    					<?php if($detail['ovarian_c'] != 'No'){?>
    						<tr class="odd">
								<td>Ovarian Cancer</td>
								<td><?php echo $detail['ovarian_c']?></td>
							</tr>
    					<?php } ?>
    					
    					<?php if($detail['vaginal_c'] != 'No'){ ?>
    						<tr>
								<td>Vaginal Cancer</td>
								<td><?php echo $detail['vaginal_c']?></td>
							</tr>
    					<?php } ?>
    					
    					<?php if($detail['breast_c'] != 'No'){?>
    						<tr class="odd">
								<td>Breast Cancer</td>
								<td><?php echo $detail['breast_c']?></td>
							</tr>
    					<?php }?>
    					
    					<?php if($detail['cervical'] != 'No'){?>
    						<tr>
								<td>Cervical Cancer</td>
								<td><?php echo $detail['cervical']?></td>
							</tr>
    					<?php } ?>
    					<?php if($detail['endometrial_c'] != 'No'){ ?>
    						<tr class="odd">
								<td>Uterine/Endometrial Cancer</td>
								<td><?php echo $detail['endometrial_c']?></td>
							</tr>
    					<?php } ?>
    					
    					<?php if($detail['fallopian_tube_c'] != 'No'){ ?>
    						<tr>
								<td>Fallopian Tube Cancer</td>
								<td><?php echo $detail['fallopian_tube_c']?></td>
							</tr>
    					<?php } ?>
    					
    					<?php if($detail['burns'] != 'No'){ ?>
    						<tr class="odd">
								<td>Burns</td>
								<td><?php echo $detail['burns']?></td>
							</tr>
    					<?php } ?>
    					
    					<?php if($detail['paralysis_multitrauma'] != 'No'){ ?>
    						<tr>
								<td>Paralysis/Multitrauma</td>
								<td><?php echo $detail['paralysis_multitrauma']?></td>
							</tr>
    					<?php } ?>
    					
    					<?php if($detail['cdb'] != 'No'){?>
    						<tr class="odd">
								<td>Congenital Disability Benefit</td>
								<td><?php echo $detail['cdb']?></td>
							</tr>
    					<?php } ?>
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