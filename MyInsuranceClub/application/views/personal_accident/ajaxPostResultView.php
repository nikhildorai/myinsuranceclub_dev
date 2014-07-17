<?php 
$con = &get_instance();
$folderUrl = $con->config->config['folder_path']['company'];
$fileUrl = $con->config->config['url_path']['company'];
$pfolderUrl = $con->config->config['folder_path']['policy'];
$pfileUrl = $con->config->config['url_path']['policy'];

    		if(empty($customer_details))
    		{
    			$return.='<div>There are no plans that match your selection criteria.</div>';
    		}
    		elseif(empty($customer_details))
    		{
    			foreach($customer_details as $detail)
    			{
    				$preexist_diseases = '';
    				$variant='';
    				if($detail['variant_name']!='Base')
    					$variant=' '.$detail['variant_name'];
    				
    				$compare_data=$detail['variant_id'].'-'.$detail['annual_premium'];//.'-'.$detail['age'];
    				
					$return .= '
								<div class="cmp_tbl">
									<div class="cus_tb clearfix">
										<div class="col-md-2 pad-right-10 logo_ins">
											<div class="img_bx">';
												if (!empty($detail['logo_image_2']) && file_exists($folderUrl.$detail['logo_image_2']))
												{
													$return .= '<img src="'.$fileUrl.$detail['logo_image_2'].'" border="0" class="img_bx_i">';
												}
					$return .= 					'<div class="check_bx">
													<div class="checkbox">
														<label> 
															<input type="checkbox" name="compare[]" id="c_name" class="refundable" value="'.$compare_data.'"> 
															<label class="chk" for="Field4"></label> 
														</label>
													</div>
												</div>
											</div>
										</div>
										<div class="col-md-3 pad-left-10">
											<div class="c_t">
												<span class="title_c" style="width: 100%;">'.$detail['company_shortname'].'</span>
												<span class="sub_tit">'.$detail['policy_name'].$variant.'</span>
											</div>
										</div>
										<div class="col-md-7 m_anc">
											<div class="col-md-6 no_pad_l">
												<h3 class="anc">Rs. '.number_format($detail['annual_premium']).'</h3>
												<p class="sub_tit">for cover of Rs. '.number_format($detail['sum_assured']).'</p>
											</div>
											<div class="col-md-2" style="padding: 0px">
												<div class="down_cnt" style="width: 20px; height: auto; float: left; color: #999999;">
													<i class="fa fa-th"></i>
												</div>
												<div class="down_cnt_up" style="">
													<i class="fa fa-angle-up"></i>
												</div>
											</div>
			
											<div class="col-md-4 pad_r_10">
												<a class="btn_offer_block" href="#">Buy Now <i class="fa fa-angle-right"></i> </a>
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
														<tbody>';
    												$featureList = Util::featureList($type);
    												$featureKeys = array_keys($featureList);
    												$i = 1;
    												foreach ($detail as $k1=>$v1)
    												{
    													if (in_array($k1, $featureKeys) && !empty($v1))
    													{
    														if ($i == 1)
								    							$return .=	'<tr class="odd">';
								    						else 
								    							$return .=	'<tr>';
								    							
																$return .=		'<td>'.$featureList[$k1]['name'].'</td>
																				<td class="cus_width">';
																
									    						if ($k1 == 'major_exclusions')
									    						{
									    							$v1 = unserialize($v1);
									    							if (!empty($v1))
									    							{
											    						$return .=	'<ul class="no">';
											    								foreach ($v1 as $k2=>$v2)
											    								{
																			$return .=	'<ll>'.$v2.'</li>';
											    								}
																		$return .=	'</ul>';
									    							}
									    						}
									    						else 
									    							$return .=			$v1;
									    							
																$return .=		'</td>
																			</tr>';
						    								$i++;
						    								if ($i == 3)
						    									$i = 1;
    													}
    												}
					$return .=							'
														</tbody>
													</table>
												</div>
											</div>
			
			
											<div class="col-md-7 medical" style="padding-right: 0px; margin-bottom: 0px;">
												<h4 class="h_d mar-40">List of Hospitals with Cashless Facility</h4>
												<div class="cus_d" style="padding: 5px;">
													<div style="float: left; width: 100%; margin-top: 10px;">
														<div style="float: right; width: 100%; padding-left: 15px;">
															<div class="form-group col-md-12" style="margin-bottom: 0px;">
																<label for="" class="sr-only">Search by Pin Code</label> 
																<input type="text" placeholder="Search by Pin Code or Hospital Name" name="pin" id="" data-id="hos_class" autocomplete="off" spellcheck="false" class="form-control brdr typeahead tt-query med_search">
																<div class="search_icon">
																	<i class="fa fa-search"></i>
																</div>
															</div>
														</div>
														<div class="loc_d hos" style="padding: 0px 15px; border: none; display: none; margin-top: 20px;">
															<div class="col-md-12">
																<span class="tt-dropdown-menu" style="position: absolute; top: 100%; left: 0px; z-index: 1; display: block; right: auto;">
																	<div class="tt-dataset-accounts">
																		<div class="city_m">
																			<div class="city_a">Hospital Name</div>
																			<div class="city_b">City</div>
																			<div class="city_c">Pin Code</div>
																		</div>
																		<span class="tt-suggestions resultTable" id=""
																			style="display: block;"> </span>
																	</div> 
																</span>
															</div>
															<div style="float: left; position: absolute; bottom: 0px; margin-bottom: 10px;" class="">Note: This list is subject to change without any notice</div>
														</div>
													</div>
												</div>
											</div>
											<div class="col-md-5">
												<h4 class="h_d mar-40" style="margin-left: 50px;">Documents</h4>
												<ul class="doc">';
    			
													if (!empty($detail['brochure']) && file_exists($pfolderUrl.$detail['brochure']))
													{
														$return .=	'<li>Policy Brouchure <a href="'.base_url().'admin/policy/download/'.$detail['policy_id'].'/brochure"><img src="'.base_url().'assets/images/pdf.jpg"> </a></li>';
													}
													if (!empty($detail['policy_wordings']) && file_exists($pfolderUrl.$detail['policy_wordings']))
													{
														$return .=	'<li>Policy Wordings <a href="'.base_url().'admin/policy/download/'.$detail['policy_id'].'/policy_wordings"><img src="'.base_url().'assets/images/pdf.jpg" class="dimg"> </a></li>';
													}
							$return .=			'</ul>
											</div>
											<div class="col-md-12  hide_d">
												Hide details <i class="fa fa-angle-up"></i>
											</div>
										</div>
									</div>
								</div>';
    			}
    		}
    	echo $return;

/*
    		if(empty($customer_details))
    		{		?>
    			<div>There are no plans that match your selection criteria.</div>
<?php  		}
    		elseif(!empty($customer_details))
    		{
    			foreach($customer_details as $detail)
    			{
    				$preexist_diseases = '';
    				$variant='';
    				if($detail['variant_name']!='Base')
    					$variant=' '.$detail['variant_name'];
    				
    				$compare_data=$detail['variant_id'].'-'.$detail['annual_premium'];//.'-'.$detail['age'];
    				?>
								<div class="cmp_tbl">
									<div class="cus_tb clearfix">
										<div class="col-md-2 pad-right-10 logo_ins">
											<div class="img_bx">
<?php 											
												if (!empty($detail['logo_image_2']) && file_exists($folderUrl.$detail['logo_image_2']))
												{	?>
													<img src="<?php echo $fileUrl.$detail['logo_image_2'];?>" border="0" class="img_bx_i">
<?php 											}	?>
												<div class="check_bx">
													<div class="checkbox">
														<label> 
															<input type="checkbox" name="compare[]" id="c_name" class="refundable" value="<?php echo $compare_data;?>"> 
															<label class="chk" for="Field4"></label> 
														</label>
													</div>
												</div>
											</div>
										</div>
										<div class="col-md-3 pad-left-10">
											<div class="c_t">
												<span class="title_c" style="width: 100%;"><?php echo $detail['company_shortname'];?></span>
												<span class="sub_tit"><?php echo $detail['policy_name'].$variant; ?></span>
											</div>
										</div>
										<div class="col-md-7 m_anc">
											<div class="col-md-6 no_pad_l">
												<h3 class="anc">Rs. <?php echo number_format($detail['annual_premium']);?></h3>
												<p class="sub_tit">for cover of Rs. <?php echo number_format($detail['sum_assured'])?></p>
											</div>
											<div class="col-md-2" style="padding: 0px">
												<div class="down_cnt" style="width: 20px; height: auto; float: left; color: #999999;">
													<i class="fa fa-th"></i>
												</div>
												<div class="down_cnt_up" style="">
													<i class="fa fa-angle-up"></i>
												</div>
											</div>
			
											<div class="col-md-4 pad_r_10">
												<a class="btn_offer_block" href="#">Buy Now <i class="fa fa-angle-right"></i> </a>
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
<?php 														
    												$featureList = Util::featureList($type);
    												$featureKeys = array_keys($featureList);
    												$i = 1;
    												foreach ($detail as $k1=>$v1)
    												{
    													if (in_array($k1, $featureKeys) && !empty($v1))
    													{
    														if ($i == 1){	?>
								    							<tr class="odd">
								    					<?php }else {?>	
								    							<tr>
								    					<?php }?>		
																	<td><?php echo $featureList[$k1]['name'];?></td>
																	<td class="cus_width">';
																<?php 
									    						if ($k1 == 'major_exclusions')
									    						{
									    							$v1 = unserialize($v1);
									    							if (!empty($v1))
									    							{	?>
											    						<ul class="no">
											    			<?php 			
										    								foreach ($v1 as $k2=>$v2)
										    								{	?>
																				<li><?php echo $v2; ?></li>
										    					<?php 		}	?>
																		</ul>
									    		<?php 				}
									    						}
									    						else 
									    							echo $v1;
									    						?>	
																	</td>
																</tr>
<?php 																
						    								$i++;
						    								if ($i == 3)
						    									$i = 1;
    													}
    												}	?>
														</tbody>
													</table>
												</div>
											</div>
			
			
											<div class="col-md-7 medical" style="padding-right: 0px; margin-bottom: 0px;">
												<h4 class="h_d mar-40">List of Hospitals with Cashless Facility</h4>
												<div class="cus_d" style="padding: 5px;">
													<div style="float: left; width: 100%; margin-top: 10px;">
														<div style="float: right; width: 100%; padding-left: 15px;">
															<div class="form-group col-md-12" style="margin-bottom: 0px;">
																<label for="" class="sr-only">Search by Pin Code</label> 
																<input type="text" placeholder="Search by Pin Code or Hospital Name" name="pin" id="" data-id="hos_class" autocomplete="off" spellcheck="false" class="form-control brdr typeahead tt-query med_search">
																<div class="search_icon">
																	<i class="fa fa-search"></i>
																</div>
															</div>
														</div>
														<div class="loc_d hos" style="padding: 0px 15px; border: none; display: none; margin-top: 20px;">
															<div class="col-md-12">
																<span class="tt-dropdown-menu" style="position: absolute; top: 100%; left: 0px; z-index: 1; display: block; right: auto;">
																	<div class="tt-dataset-accounts">
																		<div class="city_m">
																			<div class="city_a">Hospital Name</div>
																			<div class="city_b">City</div>
																			<div class="city_c">Pin Code</div>
																		</div>
																		<span class="tt-suggestions resultTable" id=""
																			style="display: block;"> </span>
																	</div> 
																</span>
															</div>
															<div style="float: left; position: absolute; bottom: 0px; margin-bottom: 10px;" class="">Note: This list is subject to change without any notice</div>
														</div>
													</div>
												</div>
											</div>
											<div class="col-md-5">
												<h4 class="h_d mar-40" style="margin-left: 50px;">Documents</h4>
												<ul class="doc">
<?php     			
													if (!empty($detail['brochure']) && file_exists($pfolderUrl.$detail['brochure']))
													{	?>
														<li>Policy Brouchure <a href="<?php echo base_url().'admin/policy/download/'.$detail['policy_id'];?>/brochure"><img src="<?php echo base_url()?>assets/images/pdf.jpg"> </a></li>
<?php 												}
													if (!empty($detail['policy_wordings']) && file_exists($pfolderUrl.$detail['policy_wordings']))
													{	?>
														<li>Policy Wordings <a href="<?php echo base_url().'admin/policy/download/'.$detail['policy_id'];?>/policy_wordings"><img src="<?php echo base_url()?>assets/images/pdf.jpg" class="dimg"> </a></li>
<?php 												}	?>
												</ul>
											</div>
											<div class="col-md-12  hide_d">
												Hide details <i class="fa fa-angle-up"></i>
											</div>
										</div>
									</div>
								</div>
<?php  			}
    		}
    		*/
?>