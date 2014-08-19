<link rel="stylesheet" href="<?php echo base_url();?>/assets/css/travel_search.css">
<?php 
		
	$temp = $customer_details;
	$temp_premiums = Util::getMinAndMaxPremium($temp);

	$allPremiums = Util::getMinAndMaxPremium($customer_details);

	//	if user is visiting from compare result show all the values from cookie

	if(!empty($cookie_customer_detail) && $compareParam == 'yes')
	{
		$customer_details = $cookie_customer_detail;
	}
	
	foreach($customer_details as $k=>$v)
	{
		$companyCount[$v['company_id']] = $v['company_id'];
	}
	
	$premiums = Util::getMinAndMaxPremium($customer_details);
	
	$planCount = count($customer_details);
	
	$customer_details = $temp;
	?>
<span id="o_touch"></span>
	<div id="highlighted" style=" background:#fff; padding-bottom:50px; margin-bottom:0px;" >
  		<div class="container">
			<div style=" width:100%; float:left;">
   				<div class="col-md-3  border m_a">
        			<div class="top_h">You searched for:</div>
        				<div class="top_p"><?php echo (isset($this->session->userdata['user_input']['trip_type']) ? $this->session->userdata['user_input']['trip_type'] : '');?></div>
        					<div class="top_p"><?php echo (isset($this->session->userdata['user_input']['trip_location']) ? $this->session->userdata['user_input']['trip_location'] : '');?></div>
        						<div class="top_p"><?php echo (isset($this->session->userdata['user_input']['trip_start']) ? $this->session->userdata['user_input']['trip_start'] : '');?> - <?php echo (isset($this->session->userdata['user_input']['trip_end']) ? $this->session->userdata['user_input']['trip_end'] : ' Upto 180 Days');?></div>
        							<div class="top_p"><?php echo (isset($this->session->userdata['user_input']['family_composition_desp']) ? $this->session->userdata['user_input']['family_composition_desp'] : '');?></div>
        								<div style="text-align: right; padding-top: 0px; margin-top: -7px;" class="top_m"><i class="fa fa-angle-left"></i> <a href="<?php echo base_url();?>travel-insurance">&nbsp;Modify Your Search</a></div>
      			</div>
<?php
$newVal = array();
$aNew = array();
$pph = array();
$sum_assured_discard = array();
 
$trip_duration_disacrd = array();

if(!empty($customer_details))
{
      
	foreach($customer_details as $k=>$v)
	{
            
		$aNew[$v['company_id']]['company'] = $v;
		$aNew[$v['company_id']]['premium'][] = $v['annual_premium'];
		          
		if(!in_array($v['public_private_health'],$pph))
		{
			$pph[] = $v['public_private_health'];
		}
		
		$pph_disacrd[] = $v['public_private_health'];
		        
		if(!in_array($v['sum_assured'],$sum_assured_discard))
		{
			$sum_assured_array [] = $v['sum_assured'];
		}
		
		$sum_assured_discard[] = $v['sum_assured'];
		
		if(!in_array($v['maximum_trip_duration'], $trip_duration_disacrd))
		{
			$trip_duration_arr [] = $v['maximum_trip_duration'];
		}
		
		$trip_duration_disacrd[] = $v['maximum_trip_duration'];
	}
    	                    
} 
?>
			<div class="col-md-9" style="padding-right:0px;" >
				<div class="top_band_com">
    				<div class="col-md-2  border c_o">
    					<div id="sh1" style="display:none">
    <?php 
      $comp_name = '';
      	if (count($aNew) > 1)
    	{
      		$comp_name = "Companies";
    	}
    	else
    	{
      		$comp_name = "Company";
    	}
    
    	if($compareParam == 'yes')
    	{
      		$odometer = "no_odometer";
    	}
   		 else
    	{
      		$odometer = "odometer";
    	}

    	if($this->input->cookie('user_filter'))
		{
    		 
    		$filters = unserialize($this->input->cookie('user_filter'));
    	}
    ?>
    
<div class="top_h_t"><?php echo $comp_name;?></div>
	<div id="com_c" class="top_p_n <?php echo $odometer;?>">0</div>
	</div> 
</div>
<div class="col-md-2  border c_o">
	<div id="sh2" style="display:none">
		<div class="top_h_t">Plans</div>
			<div id="plan_c" class="top_p_n <?php echo $odometer;?>">0</div>
	</div>
</div>
<div class="col-md-8  noborder clearfix">
	<div id="sh3" style="display:none">
      <div class="top_h_t text-left">Price Range</div>
      	<div class="top_p_n text-left" style="float:left;"> <span style="float:left; margin-top:7px;">&#8377;</span> <span id="pr_ra"  class="<?php echo $odometer;?>" style="float:left;">0</span> <span style="float:left;margin-top:7px;""> &nbsp;- &#8377;</span> <span id="pr_rb" class="<?php echo $odometer;?>" style="float:left;">0</span> </div>
    </div>
    	<div id="sh4" style="position:absolute;"><i class="fa fa-check-square-o"></i> </div>
</div>
		</div>
	</div>
</div>
<div id="loader" style="display: <?php echo ($compareParam == "yes" || count($customer_details) < 1) ? 'none' : 'block'?>"><img src="<?php echo base_url();?>/assets/images/loader.gif" border="0"></div>
	<div class="" style="margin-top:20px; display:none;" id="prdt_dis">
		<div class="col-md-9 col-md-push-3 cus_res_hlth" style="padding-right:0px; padding-bottom:100px;">
			<div class="col-md-12" style="padding:0px;">
              <?php echo form_open('travel-insurance/compare-results',array('id'=>'compare'));?>
               <div style=" height:auto; padding:10px 0px 30px 0px; background:#ededec;  border-radius: 4px; font-weight:bold;">
                	<div class="col-md-5 plan">
                		<div style="position: relative; float: left; margin-left: -2px; top: 2px; margin-right: 7px; color: rgb(95, 180, 29); font-size: 17px;"><i class="fa fa-level-up  fa-rotate-180"></i></div>  <div class="com_pl" style="float: left; font-weight: bold; color: rgb(44, 163, 239);"><a href="javascript:void(0);" class="cmp_p_s" id="comparePolicy" title="Compare upto 3 plans">Compare Plans</a></div>
                	</div>
                 	<div class="col-md-3 an">
                 		Annual Premium
                	</div>
                </div>
                <div id="cmp_tbl">
					<?php $this->load->view('travel_insurance/ajaxPostResultView');?>
         		</div>
                <?php echo form_close();?>
              </div>
           </div>
           
            <!--Sidebar-->
            
            <?php echo form_open('travel-insurance/search-results',array('id'=>'search'));?>
            
            <div class="col-md-3 col-md-pull-9 sidebar sidebar-left" style="padding:0px;">
              <div class="inner" style="margin-bottom:50px;">
                <div class="block1" style="position:relative; min-height:200px;">
                 <h6 class="fh3 l"><span id="plan_cnt"></span> of <?php  echo  count($temp);?> plans</h6>
                 	<h6 class="fh3"> Premium</h6>
                 		<div class="filterContent ">
							<div style="float: left; width: 100%; position: relative; top: -30px;">
  								<input type="text" id="amount_a" readonly="" class="s_l search_filter" name="min_premium_amt" value="">
   								<input type="text" id="amount1_a" readonly="" class="s_r search_filter" name="max_premium_amt" value="">
							</div>
                				<div id="slider-range1"></div>
									<div class="price rangeSlider">
										<p class="displayStaticRange clearFix" style="padding-bottom:0px; margin-bottom:0px;">
											<span class="fLeft"><span data-pr="6437" class="INR">&#8377;</span><?php echo number_format($temp_premiums['min_premium']);?></span>
											<span class="fRight"><span data-pr="42306" class="INR">&#8377;</span><?php echo number_format($temp_premiums['max_premium']);?></span>
									</div>
									
                		<p class="addOnFilter" style="margin:0px; padding:0px;">
										<h6 class="fh3 l" style="margin:0px; padding:0px; height:9px;">&nbsp; </h6>
						</p> 
                			<h6 class="fh3">Coverage Amount</h6>
                				<p class="addOnFilter" >
                					<?php if(!empty($sum_assured_array))
                	 					 {
                							sort($sum_assured_array);
                							
                							$check_sum_assured = '';
                							
                								foreach($sum_assured_array as $sum)
												{
													if(isset($filters['coverage_amount']) && in_array($sum, $filters['coverage_amount']))
													{
														$check_sum_assured = 'checked="checked"';
													}
													else
													{
														$check_sum_assured = '';
													} 
												?>
                 									<div class="checkbox">
            											<label>
            												<input type="checkbox" id="coverage_amount_<?php echo $sum;?>" name="coverage_amount[]" value="<?php echo $sum;?>"  class="search_filter" <?php echo $check_sum_assured; ?>>
            													<label class="" for="coverage_amount_<?php echo $sum;?>"><?php echo 'USD '.number_format($sum) ;?></label>
          												</label>
          											</div>
										 <?php }
										 
										   }?>
								</p>
								
                				<p class="addOnFilter" style="margin:0px; padding:0px;">
										<h6 class="fh3 l" style="margin:0px; padding:0px; height:9px;">&nbsp; </h6>
								</p> 
                 					
                 					<?php 
                 							
                 					if(isset($this->session->userdata['user_input']['trip_type']) && $this->session->userdata['user_input']['trip_type'] == 'Annual multi-trip'){?>
                 						<h6 class="fh3">Trip Duration</h6>
                 							<p class="addOnFilter clearfix" >
                 								<?php 
                 										sort($trip_duration_arr);
                 										foreach($trip_duration_arr as $trip){
														
															if(isset($filters['trip_duration']) && in_array($trip,$filters['trip_duration']))
															{
																$check_duration = 'checked="checked"';
															}
															else 
															{
																$check_duration= '';
															}
															
															
															?>
                 									<div class="checkbox">
            											<label>
            												<input type="checkbox" id="trip_duration_<?php echo $trip;?>" name="trip_duration[]" value="<?php echo $trip;?>"  class="search_filter" <?php echo $check_duration; ?>>
            													<label class="" for="trip_duration_<?php echo $trip;?>"><?php echo $trip. ' days' ;?></label>
          												</label>
          											</div>
                 							
                 							</p>
                 							<?php }?>
                 				<p class="addOnFilter" style="margin:0px; padding:0px;">
										<h6 class="fh3 l" style="margin:0px; padding:0px; height:9px;">&nbsp; </h6>
								</p>
								
								<?php }?>
                 					<h6 class="fh3">Company </h6>
                 						<div class="addOnFilter clearfix" >
							                 
							                 <?php 
							                 $display_premium = '';
							                 if(!empty($aNew))
							                 {
							                 	
							                 	foreach($aNew as $company){
							                    	
							                    	
													if(isset($filters['company_name']) && in_array($company['company']['company_id'],$filters['company_name']))
													{
														$checked_company = "checked='checked'";
													}
													else{
														$checked_company="";
													}
													
													$premium = $company['premium'];
								                   	sort($premium);
								                   	if (reset($premium) != end($premium))
								                   	{
								                   		$display_premium = '&#8377;'.number_format(reset($premium)).' - &#8377;'.number_format(end($premium));
								                   	}
								                   	else
								                   	{
								                   		$display_premium = '&#8377;'.number_format(reset($premium));
								                   	}
								              ?>
	              
							                    	<div style="width: 100%; float: left; margin-bottom: 10px;">
							                    	<div class="checkbox" style="width: auto; float: left; margin: 0px;">
							            				<label>
							            					<input type="checkbox" value="<?php echo $company['company']['company_id'];?>" class="search_filter" id="company_name[<?php echo $company['company']['company_id'];?>]" name="company_name[]" <?php echo $checked_company;?>>
							            						<label for="company_name[<?php echo $company['company']['company_id'];?>]" class=""><?php echo $company['company']['company_shortname'];?></label>
							          					</label>
							          				</div> <span style="float:right;"><?php echo $display_premium;?></span>
							          				</div>
          			
							              <?php }
							                 }?>
									
								</div>
               				 </div>
              			</div>
            		</div>
            			<?php echo form_close();?>
          		</div>
			</div>
		</div>
	</div>
<div id="search_sense_of_urgency_popup" class="hcom_simple_popdiv hcom_urgency_popup" style="display: none;">
    <div class="arrow">
      <div class="outer"></div>
      <div class="inner"></div>
    </div>
    <div id="searchUrgencyPopupBox">
<!-- div class="fader"><div class="arrow-w arrowlocation1" style="font-size:1em;" ></div><div id="tutorial1" class="tutorial createquestion1">Just booked Health Policy 7 minutes ago from United Kingdom.</div></div>
<div class="fader"><div class="arrow-w arrowlocation1" style="font-size:1em;" ></div><div id="tutorial1" class="tutorial createquestion1">In 2013-14, Exide Life Insurance recorded doubling in profits to Rs 53 crore driven by growth in renewal premiums and improvements in efficiency and product mix.</div></div>
<div class="fader"><div class="arrow-w arrowlocation1" style="font-size:1em;" ></div><div id="tutorial1" class="tutorial createquestion1">Reliance Life Insurance launches Claims Guarantee service.</div></div> -->
<div class="fader"><div class="arrow-w arrowlocation1" style="font-size:1em;" ></div><div id="tutorial1" class="tutorial createquestion1">IDBI Federal Life Insurance today launched a bouquet of individual products catering to various life stage needs of customers along with group solutions.</div></div>
<div>
</div>
</div>
</div>

<div class="tutorial"></div>

<div id="backgroundPopup" >
    	<?php 
    		
    	$name = '';
    		if(isset($this->session->userdata['user_input']['full_name'])){
   
    	 $name = $this->session->userdata['user_input']['full_name'];
    	}
    	 else 
    	 {
    	 	$name == "Guest";
    	 }
    	 ?>
    
</div>
    
<div id="share_link" style="">
	<div id="share_link-ct">
		<div id="share_link-header">
          <h2>Hi <?php echo $name;?>,</h2>
          	<p>Can you do us a favour?</p>
          		<a class="modal_close" href="javascript:void(0);"></a>
        </div>
        <div id="strengths" class="box">
                <p>If you found our comparison useful, pls share it with your friends.</p>
                <ul>
          			<li>- They might find it useful</li>
          			<li>- It helps us reach out to more personal audience</li>
        		</ul>
                <p class="brdr_link">I used MyInsuranceClub to select health insurance for myself. You might find it useful too. http://www.myinsuranceclub.com/health-insurance/</p>

<div class="soc_link">
	<div class="fac_link"></div>
   		<div class="twi_link">
   			<a href="https://twitter.com/share" class="twitter-share-button" data-url="http://www.myinsuranceclub.com/health-insurance/" data-size="medium" data-dnt="true">Tweet</a>
   		</div> 
</div>
    
<div class="header">
	<div class="h-card p-author" >
 		<div class="u-url profile">
			<img class="u-photo avatar"  src="<?php echo base_url();?>assets/images/deepak_mic.jpg" >
				<span class="full-name">
					<span class="p-name" >Thanks!</span>
						<span class="p-nickname" ><b>Deepak Yohannan, CEO, MyInsuranceClub</b></span>
    			</span>
 		</div>
	</div>
</div>
		</div>
	</div>
</div>

<div class="modal-backdrop fade in" id="modal_bak" style="display:none;"></div>

<div class="alert_cmp">
	<div class="close34" ><span>Ok got it</span> &times;</div>
    <strong>Oh ho!</strong> <br/><div class="al_msg_cmp"></div>
</div>

<script type="text/javascript">
var company_count = "<?php echo count($companyCount);?>";
var plan_count = "<?php echo  $planCount;?>";
var min_premium = "<?php echo  $premiums['min_premium'];?>";
var max_premium = "<?php echo  $premiums['max_premium'];?>";
var all_min_premium = "<?php echo  (int)$allPremiums['min_premium'];?>";
var all_max_premium = "<?php echo  (int)$allPremiums['max_premium'];?>";
var annual_premium_search_url = "<?php echo base_url().'travel-insurance/search-results'?>";
var increment_buyNow_url = "<?php echo base_url().'travel-insurance/increment-count'?>";
var searchScroll = "<?php echo ($compareParam == "yes") ? 'no' : 'yes'?>";
</script>


<script>
<?php if($compareParam !='yes') {?>
$(function() {
  $("#share_link,#backgroundPopup").delay(15000).fadeIn(500);
  
  setTimeout(function(){
   $('#share_link').css({opacity: 1});
   
}, 15000);
  
  $('.fac_link').html('<div class="fb-share-button" data-type="button_count" data-href="http://www.myinsuranceclub.com/health-insurance/"></div>');
  
  
  $('.modal_close').click(function() {
    $("#share_link,#backgroundPopup").fadeOut(500);
     $("#share_link").css({opacity: 0});
    
    });
    
});
<?php }?>
</script>
