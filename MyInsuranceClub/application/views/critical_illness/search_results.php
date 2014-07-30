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
  
     <div class="top_p"><strong>Members</strong> = <?php if(isset($this->session->userdata['user_input']['plan_type_name'])){echo $this->session->userdata['user_input']['plan_type_name'];}?></div>
    <div class="top_p"><strong>Age</strong> = <?php if(isset($this->session->userdata['user_input']['cust_age'])){echo $this->session->userdata['user_input']['cust_age'];}?>&nbsp;years</div>
       <div class="top_m"><i class="fa fa-angle-left"></i> <a href="<?php echo site_url('critical-illness')."/";?>">&nbsp;Modify Your Search</a></div>
   </div>
  <?php   
  
  $newVal = array();
  $preexisitng_disease_discard = array();
  $aNew = array();
  $pph = array();
  
  //$diseases_discard = array();
  if(!empty($customer_details))
  {
      
        foreach($customer_details as $k=>$v)
        {
            
          $aNew[$v['company_id']]['company'] = $v;
          $aNew[$v['company_id']]['premium'][] = $v['annual_premium'];
          
          
          
			if($v['preexisting_age']!='Not Covered')
      		{
				if(!in_array($v['preexisting_age'],$preexisitng_disease_discard))
          		{
          			$preexist_filter [] = $v['preexisting_age'];
         	 	}

          		$preexisitng_disease_discard [] = $v['preexisting_age'];
      		}
        
      		if(!in_array($v['public_private_health'],$pph))
      		{
      			$pph[] = $v['public_private_health'];
      		}
        		$pph_disacrd[] = $v['public_private_health'];
        		
        	
    	}
                          
  } 
      
?>
    

<?php $diseases = Util::featureList('Critical Illness');
$disease_filter = array();
		//var_dump($diseases);
		foreach($diseases as $k=>$v){
		
			$disease_filter[$k] = $v['name'];
	
		}
		$DISEASE_FILTER = array_splice($disease_filter,5);
		//var_dump($disease_FILTER);
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


  <div id="loader" style="display: <?php echo ($compareParam == "yes") ? 'none' : 'block'?>"><img src="<?php echo base_url();?>/assets/images/loader.gif" border="0"></div>
   <div class="" style="margin-top:20px; display:none;" id="prdt_dis">
            <div class="col-md-9 col-md-push-3 cus_res_hlth" style="padding-right:0px;">
            
            
               <div class="col-md-12" style="padding:0px;">
              <?php echo form_open('critical-illness/compare-results',array('id'=>'compare'));?>
               <div style=" height:auto; padding:10px 0px 30px 0px; background:#ededec;  border-radius: 4px; font-weight:bold;">
                <div class="col-md-5 plan">
                <div style="position: relative; float: left; margin-left: -2px; top: 2px; margin-right: 7px; color: rgb(95, 180, 29); font-size: 17px;"><i class="fa fa-level-up  fa-rotate-180"></i></div>  <div class="com_pl" style="float: left; font-weight: bold; color: rgb(44, 163, 239);"><a href="javascript:void(0);" class="cmp_p_s" id="comparePolicy" title="Compare upto 3 plans">Compare Plans</a></div>
                </div>
                
                 <div class="col-md-3 an">
                 Annual Premium
                </div>
                
                
                </div>
                <div id="cmp_tbl">
					
					  <?php $this->load->view('critical_illness/ajaxPostResultView');?>
					
         		</div>
         	
                <?php echo form_close();?>
               </div>
             
            </div>
            <?php if(!empty($customer_details)) {$display = 'style=""';} else{$display = 'style="display: none;"';}?>
            <!--Sidebar-->
            <div <?php echo $display;?>>
            <?php echo form_open('critical-illness/search-results',array('id'=>'search'));?>
            
            <div class="col-md-3 col-md-pull-9 sidebar sidebar-left" style="padding:0px;">
              <div class="inner" style="margin-bottom:50px;">
                
                
             
                
                
                <div class="block1" style="position:relative;">
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
			</p>
	
			<input type="hidden" name="price" value="6437-32293">
	
				
		</div>
                 <?php 
                 	
                 	
                 	$checked_sumassured='';
                 	$checked_company_health='';
                 	if($this->input->cookie('user_filter')){
                 		
						$filters = unserialize($this->input->cookie('user_filter'));
						
						if(isset($filters['health_comp']))
						{
							$checked_company_health = "checked='checked'";
						}
						else{
						
							$checked_company_health = "";
						}
						
                 }?>
                 
                 <?php $discard_duplicate = array();
                   						foreach($customer_details as $k=>$v)
                   						{
                   							if(!in_array($v['sum_assured'], $discard_duplicate))
                   							{
                   								$sum_ass [] = $v['sum_assured'];
                   							}
                   							$discard_duplicate [] = $v['sum_assured'];
                   						}
                   			sort($sum_ass);			
                  ?>
                <p class="addOnFilter" style="margin:0px; padding:0px;">
						<h6 class="fh3 l" style="margin:0px; padding:0px; height:9px;">&nbsp; </h6>
				</p> 
                <h6 class="fh3">Sum Assured</h6>
                <p class="addOnFilter" >
                 <?php 	if(!empty($sum_ass)){
                 		foreach($sum_ass as $s){
                 		
                 		if(isset($filters['sum_assured']) && in_array($s,$filters['sum_assured']))
						{
							$checked_sumassured = "checked='checked'";
						}
						else
						{
							$checked_sumassured= '';
						} 
						?>
                 <div class="checkbox">
            
            <label>
            <input type="checkbox" id="sum_assured" name="sum_assured[]"   class="search_filter" value="<?php echo $s;?>" <?php echo $checked_sumassured; ?>>
            <label class="" for=""><?php echo Util::moneyFormatIndia($s);?></label>
          </label>
          
          </div>
				<?php } 
                 
                 }?>
		</p>
		<p class="addOnFilter" style="margin:0px; padding:0px;">
						<h6 class="fh3 l" style="margin:0px; padding:0px; height:9px;">&nbsp; </h6>
				</p> 
         		<h6 class="fh3">Diseases Covered</h6>
                <p class="addOnFilter" >
                <?php if(!empty($DISEASE_FILTER)){
                		
                		foreach ($DISEASE_FILTER as $k=>$v){?>
                		
                <div class="checkbox">
            
            <label>
            <input type="checkbox" id="disease_covered" name="disease_covered[]"   class="search_filter" value="<?php echo $k?>">
            <label class="" for=""><?php echo $v;?></label>
          </label>
          
          </div>
                
           <?php      }
                	
                	
                	
                }?>
                
                </p>
             <?php if(isset($preexist_filter))
                 	
             
             		{
                 		sort($preexist_filter);?>
                			<p class="addOnFilter" style="margin:0px; padding:0px;">
									<h6 class="fh3 l" style="margin:0px; padding:0px; height:9px;">&nbsp; </h6>
							</p> 
                 			<h6 class="fh3">Pre-existing diseases</h6>
                 <p class="addOnFilter" >
                 <?php $sl = 1; foreach($preexist_filter as $p){
                 					
                 						if(isset($filters['precover']) && in_array($p,$filters['precover']))
                 						{
                 							$checked_precover = "checked='checked'";
                 						}
                 						else{
											$checked_precover="";
										}
                 ?>
					
					<div class="checkbox">
            				<label>
            					<input type="checkbox" id="precover[<?php echo $sl; ?>]" name="precover[]" class="search_filter" value="<?php echo $p;?>" <?php echo $checked_precover;?>>
           							 <label class="" for="precover[<?php echo $sl; ?>]">Plans which cover after <?php echo $p;?> years
									</label>
         					 </label>
          			</div>
          			<?php $sl++;}
                 		
                 	}?>
				</p>
                <p class="addOnFilter" style="margin:0px; padding:0px;">
						<h6 class="fh3 l" style="margin:0px; padding:0px; height:9px;">&nbsp; </h6>
				</p> 
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
	              
                    <div style="width: 100%; float: left;">
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
                 <p class="addOnFilter" style="margin:0px; padding:0px;">
						<h6 class="fh3 l" style="margin:0px; padding:0px; height:9px;">&nbsp; </h6>
				</p> 
                 <h6 class="fh3">Co-payment</h6>
                 <p class="addOnFilter" >
					 <div class="checkbox">
            			<label>
            				<input type="checkbox" id="c14" name="c14"  class="search_filter" value="14">
            					<label class="" for="c14">Plans with no co-payment
								</label>
          				</label>
          			</div>
                     <div class="checkbox">
            				<label>
            					<input type="checkbox" id="c15" name="c15"  class="search_filter" value="15">
            						<label class="" for="c15">Plans with 10% co-payment
									</label>
          					</label>
          			</div>
                      <div class="checkbox">
            				<label>
            					<input type="checkbox" id="c16" name="c16"  class="search_filter" value="16">
            						<label class="" for="c16">Plans with 20% co-payment
									</label>
          					</label>
          			</div>
                      <div class="checkbox">
            				<label>
            					<input type="checkbox" id="c17" name="c17"  class="search_filter" value="17">
            						<label class="" for="c17">CPlans with 30% co-payment
									</label>
          					</label>
          			</div>
				</p>
                
                 <p class="addOnFilter" style="margin:0px; padding:0px;">
						<h6 class="fh3 l" style="margin:0px; padding:0px; height:9px;">&nbsp; </h6>
				</p> 
                
                 <!-- h6 class="fh3">Mode of purchase</h6>
                 <p class="addOnFilter" >
                 
					 <div class="checkbox">
            <label>
            <input type="checkbox" id="p18" name="p18"  class="field checkbox" value="18">
            <label class="" for="p18">Online
					</label>
          </label></div>
                    <div class="checkbox">
            <label>
            <input type="checkbox" id="p19" name="p19"  class="field checkbox" value="19">
            <label class="" for="p19">Not Online
					</label>
          </label></div>
                    
				</p>
                <!--  <p class="addOnFilter" style="margin:0px; padding:0px;">
						<h6 class="fh3 l" style="margin:0px; padding:0px; height:9px;">&nbsp; </h6>
				</p>
                
                               <h6 class="fh3">Claims ratio of company</h6>

                
                  <div class="" ng-controller="DemoController34" style="margin-top:30px;">
                <div range-slider min="0" max="100" model-min="demo1.min" model-max="demo1.max"></div>
              
                <p>

  <input type="text" id="amount" readonly class="s_l" name="min_claim_ratio">
   <input type="text" id="amount1" readonly  class="s_r" name="max_claim_ratio">
</p>
                <div id="slider-range"></div>
                
                </div>
				<div class="price rangeSlider">
	          
							
			
			<p class="displayStaticRange clearFix" style="padding-bottom:0px; margin-bottom:0px; margin-top:15px;">
			
                <span class="fLeft"><span data-pr="" class="INR"></span>0 %</span>
				<span class="fRight"><span data-pr="" class="INR"></span>100 %</span>
			</p>
	
			<input type="hidden" name="price" value="6437-32293">
	
				
		</div>
                
                
               <p class="addOnFilter" style="margin:0px; padding:0px;">
						<h6 class="fh3 l" style="margin:0px; padding:0px; height:9px;">&nbsp; </h6>
				</p>  -->
                 <h6 class="fh3">Company type</h6>
                 <p class="addOnFilter" >
                 
                 <?php $checked_sector = ''; 
                 		
                 			foreach($pph as $k=>$v){?>
					 
					 	<?php if(isset($filters['sector']) && in_array($v,$filters['sector'])){
					 	
					 			$checked_sector = 'checked="checked"';
					 	}
					 		else 
					 		{
					 			$checked_sector = "";
					 		}
					 	?>
					 
					 
					 <?php if($v == '2'){?>
					 		
					 		
					 	
					 	
					 	<div class="checkbox">
            				<label>
            					<input type="checkbox" id="sector_1" name="sector[]"  class="search_filter" value="2" <?php echo $checked_sector;?>>
            						<label class="" for="sector_1">Plans from Private Sector Companies
									</label>
          					</label>
          				</div>
          				
          			<?php }?>
          			
          			<?php if($v == '1'){?>
          			
                    	<div class="checkbox">
            				<label>
            					<input type="checkbox" id="sector_2" name="sector[]"  class="search_filter" value="1" <?php echo $checked_sector;?>> 
            						<label class="" for="sector_2">Plans from Public Sector Companies
									</label>
          					</label>
          				</div>
          				
                    	<?php }?>
                    
                    <?php }?>
                    
                    
                    
                    	<div class="checkbox">
            				<label>
            					<input type="checkbox" id="health_comp1" name="health_comp[]"  class="search_filter" value="3" <?php echo $checked_company_health;?>>
           							 <label class="" for="health_comp1">Plans from Specialised Health Insurers									</label>
          					</label>
          				</div>
          				
          			
                 
           		
				</p>
                
                </div>
                
              </div>
            </div>
            <?php echo form_close();?>
          </div></div>
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

<div class="tutorial">
</div>


<div id="backgroundPopup" >
    	<?php 
    		
    	$name = '';
    		if(isset($this->session->userdata['user_input']['full_name'])){
   
    	 $name = $this->session->userdata['user_input']['full_name'];
    	}
    	 else 
    	 {
    	 	$name = "Guest";
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
                <p class="brdr_link">I used MyInsuranceClub to select a health insurance 
plan for myself. Check it out. You might find it useful.</p>

<div class="soc_link">
    <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=163640157049519&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div class="fac_link">
    
    </div>
    
   <div class="twi_link">
   <a href="https://twitter.com/share" class="twitter-share-button" data-url="http://www.myinsuranceclub.com/health-insurance/" data-size="large" data-dnt="true">Tweet</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
   </div> 
    </div>
    
    
    
    <div class="header">
      <div class="h-card p-author" >
  <div class="u-url profile">
    <img class="u-photo avatar"  src="<?php echo base_url();?>assets/images/deepak_mic.jpg" >
    <span class="full-name">
      
      <span class="p-name" >Deepak Yohanna,</span>
      <span class="p-nickname" ><b>CEO, MyInsuranceClub</b></span>
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
var annual_premium_search_url = "<?php echo base_url().'critical-illness/search-results'?>";
var increment_buyNow_url = "<?php echo base_url().'health_insurance/controller_criticalIllness/increment_count'?>";
var searchScroll = "<?php echo ($compareParam == "yes") ? 'no' : 'yes'?>";
</script>
<script>
<?php if($compareParam !='yes') {?>
$(function() {
  $("#share_link,#backgroundPopup").delay(15000).fadeIn(500);
  
  setTimeout(function(){
   $('#share_link').css({opacity: 1});
   
}, 15000);
  
  $('.fac_link').html('<div class="fb-share-button" data-href="http://www.myinsuranceclub.com/health-insurance/"></div>');
  
  
  $('.modal_close').click(function() {
    $("#share_link,#backgroundPopup").fadeOut(500);
     $("#share_link").css({opacity: 0});
    
    });
    
});
<?php }?>
</script>
