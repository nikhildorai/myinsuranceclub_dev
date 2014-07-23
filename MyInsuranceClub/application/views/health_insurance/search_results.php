

<span id="o_touch"></span>

<div id="highlighted" style=" background:#fff; padding-bottom:50px; margin-bottom:0px;" >

  <div class="container">
  
   <div class="top_band">
   <div class="col-md-3  border m_a">
       <div class="top_h">Your Search</div>
       <div class="top_p">Coverage Amount = &#8377; <?php if(isset($this->session->userdata['user_input']['coverage_amount'])){echo $this->session->userdata['user_input']['coverage_amount'];}?></div>
      <div class="top_p"> Members = <?php if(isset($this->session->userdata['user_input']['plan_type_name'])){echo $this->session->userdata['user_input']['plan_type_name'];}?></div>
       <div class="top_m"><i class="fa fa-angle-left"></i> <a href="<?php echo site_url('health-insurance');?>">&nbsp;Modify Your Search</a></div>
   </div>
	<?php   
	
	 
	$premiums = Util::getMinAndMaxPremium($customer_details);
	//var_dump($premiums);
	
	$newVal = array();
	$preexisitng_disease_discard = array();
	$aNew = array();
	$pph = array();
	if(!empty($customer_details))
	{
			
        foreach($customer_details as $k=>$v)
        {
           	
        	$aNew[$v['company_id']]['company'] = $v;
        	$aNew[$v['company_id']]['premium'][] = $v['annual_premium'];
       	 	
       	 	
       	 	
       	 	if($v['preexisting_diseases']!='Not Covered')
			{
       	 		if(!in_array($v['preexisting_diseases'],$preexisitng_disease_discard))
       	 		{
       	 			$preexist_filter [] = $v['preexisting_diseases'];
       	 		}

       	 		$preexisitng_disease_discard [] = $v['preexisting_diseases'];
			}
        
       		if(!in_array($v['public_private_health'],$pph))
       		{
       			$pph[] = $v['public_private_health'];
       		}
				$pph_disacrd[] = $v['public_private_health'];
        }
                   				
	}	
       /*  $min_annual_premium='';
        $max_annual_premium='';
        if(count($customer_details) > 0)
        {
        	$anuual_premium = array_map(function($detail)
        	{
        		return $detail['annual_premium'];
        	}, $customer_details);
        	$min_annual_premium=min($anuual_premium);
        	$max_annual_premium=max($anuual_premium);
        }
        elseif(count($customer_details) == 0)
        {
        	$min_annual_premium='0';
        	$max_annual_premium='0';
        } */
?>
      
      
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
		?>
       <div class="top_h_t"><?php echo $comp_name;?></div>
       <div id="com_c" class="top_p_n odometer">0</div>
      </div> 
      
   </div>
   
    <div class="col-md-2  border c_o">
    <div id="sh2" style="display:none">
       <div class="top_h_t">Plans</div>
       <div id="plan_c" class="top_p_n odometer">0</div>
       </div>
   </div>
    <div class="col-md-5  noborder clearfix">
    <div id="sh3" style="display:none">
       <div class="top_h_t text-left">Price Range</div>
       <div class="top_p_n text-left" style="float:left;"><span style="float:left; margin-top:7px;">&#8377;</span><span id="pr_ra"  class="odometer" style="float:left;">0</span><span style="float:left;margin-top:7px;""> &nbsp;- &#8377;</span><span id="pr_rb" class="odometer" style="float:left;">0</span></div>
       </div>
       <div id="sh4" style="position:absolute;"><i class="fa fa-check-square-o"></i> </div>
   </div>
   
   </div>
  <div id="loader"><img src="<?php echo base_url();?>/assets/images/loader.gif" border="0"></div>
   <div class="" style="margin-top:20px; display:none;" id="prdt_dis">
            <div class="col-md-9 col-md-push-3 cus_res_hlth" style="padding-right:0px;">
            
            
               <div class="col-md-12" style="padding:0px;">
              <?php echo form_open('health-insurance/compare-results',array('id'=>'compare'));?>
               <div style=" height:auto; padding:10px 0px 30px 0px; background:#ededec;  border-radius: 4px; font-weight:bold;">
                <div class="col-md-5 plan">
                Plan Details
                </div>
                
                 <div class="col-md-3 an">
                 Annual Premium
                </div>
                 <div class="col-md-4 text-right plan_cmpre">
                 <a href="javascript:void(0);" class="cmp_p_s" id="comparePolicy" title="Compare upto 3 plans">Compare Plans</a>
                </div>
                
                </div>
                <div id="cmp_tbl">
					
					  <?php 
							
					  //var_dump($ajax);	
					  //exit;	
					  //echo $ajax ;
							$this->load->view('health_insurance/ajaxPostResultView');//,array('customer_details'=>$customer_details)
							//echo $this->util->getUserSearchFiltersHtml($customer_details, $type='health');?>       			
         		</div>
         	
                <?php echo form_close();?>
               </div>
             
            </div>
            <?php if(!empty($customer_details)) {$display = 'style=""';} else{$display = 'style="display: none;"';}?>
            <!--Sidebar-->
            <div <?php echo $display;?>>
            <?php echo form_open('health_insurance/basicMediclaim/health_policy',array('id'=>'search'));?>
            
            <div class="col-md-3 col-md-pull-9 sidebar sidebar-left" style="padding:0px;">
              <div class="inner" style="margin-bottom:50px;">
                
                
             
                
                
                <div class="block1" style="position:relative;">
                 <h6 class="fh3 l"><span id="plan_cnt"></span> of <?php echo  count($customer_details);?> plans</h6>
                 
                 <h6 class="fh3"> Premium</h6>
                 
                 
                 
                 <div class="filterContent ">
				
			<div style="float: left; width: 100%; position: relative; top: -30px;">
  <input type="text" id="amount_a" readonly="" class="s_l search_filter" name="min_premium_amt" value="">
   <input type="text" id="amount1_a" readonly="" class="s_r search_filter" name="max_premium_amt" value="">
</div>
                <div id="slider-range1"></div>
                
                
				<div class="price rangeSlider">
	          
							
			
			<p class="displayStaticRange clearFix" style="padding-bottom:0px; margin-bottom:0px;">
				<span class="fLeft"><span data-pr="6437" class="INR">&#8377;</span><?php echo number_format($premiums['min_premium']);?></span>
				
				<span class="fRight"><span data-pr="42306" class="INR">&#8377;</span><?php echo number_format($premiums['max_premium']);?></span>
			</p>
	
			<input type="hidden" name="price" value="6437-32293">
	
				
		</div>
                 
                <p class="addOnFilter" style="margin:0px; padding:0px;">
						<h6 class="fh3 l" style="margin:0px; padding:0px; height:9px;">&nbsp; </h6>
				</p> 
                <h6 class="fh3">Sub limits</h6>
                <p class="addOnFilter" >
                 <div class="checkbox">
            <label>
            <input type="checkbox" id="room_rent" name="room_rent" value="1"  class="search_filter">
            <label class="" for="room_rent">Show plans without room rent caps</label>
          </label></div>
					
                    
                    
                   
				</p>
                <p class="addOnFilter" style="margin:0px; padding:0px;">
						<h6 class="fh3 l" style="margin:0px; padding:0px; height:9px;">&nbsp; </h6>
				</p> 
                
                 <h6 class="fh3">Maternity benefits</h6>
                 <p class="addOnFilter" >
                 
                 <div class="checkbox">
            <label>
            <?php //if(isset($this->session->userdata['search_filters']['maternity'])){
            	
            	//$checked == "checked";
           // } else{
           // 	$checked == "";
         //   }?>
            <input type="checkbox" id="maternity" name="maternity"  class="search_filter" value="1" <?php //echo $checked;?>>
            <label class="" for="maternity">Show plans with maternity benefits</label>
          </label></div>
					 
				</p>
                
                
             <?php if(isset($preexist_filter))
                 	{
                 		sort($preexist_filter);?>
                			<p class="addOnFilter" style="margin:0px; padding:0px;">
									<h6 class="fh3 l" style="margin:0px; padding:0px; height:9px;">&nbsp; </h6>
							</p> 
                 			<h6 class="fh3">Pre-existing diseases</h6>
                 <p class="addOnFilter" >
                 <?php $sl = 1; foreach($preexist_filter as $p){?>
                 
					<div class="checkbox">
            				<label>
            					<input type="checkbox" id="precover[<?php echo $sl; ?>]" name="precover[]" class="search_filter" value="<?php echo $p;?>">
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
            					<input type="checkbox" value="<?php echo $company['company']['company_id'];?>" class="search_filter" id="company_name[<?php echo $company['company']['company_id'];?>]" name="company_name[]">
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
                 
                 <?php foreach($pph as $k=>$v){?>
					 
					 <?php if($v == '2'){?>
					 
					 	<div class="checkbox">
            				<label>
            					<input type="checkbox" id="sector_1" name="sector[]"  class="search_filter" value="2">
            						<label class="" for="sector_1">Plans from Private Sector Companies
									</label>
          					</label>
          				</div>
          				
          			<?php }?>
          			
          			<?php if($v == '1'){?>
          			
                    	<div class="checkbox">
            				<label>
            					<input type="checkbox" id="sector_2" name="sector[]"  class="search_filter" value="1">
            						<label class="" for="sector_2">Plans from Public Sector Companies
									</label>
          					</label>
          				</div>
          				
                    	<?php }?>
                    
                    <?php }?>
                    
                    
                    
                    	<div class="checkbox">
            				<label>
            					<input type="checkbox" id="health_comp1" name="health_comp[]"  class="search_filter" value="3">
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
<div id="search_sense_of_urgency_popup" class="hcom_simple_popdiv hcom_urgency_popup" style="display: block;">
    <div class="arrow">
      <div class="outer"></div>
      <div class="inner"></div>
    </div>
    <div id="searchUrgencyPopupBox">
<div class="fader"><div class="arrow-w arrowlocation1" style="font-size:1em;" ></div><div id="tutorial1" class="tutorial createquestion1">Just booked Health Policy 7 minutes ago from United Kingdom.</div></div>
<div class="fader"><div class="arrow-w arrowlocation1" style="font-size:1em;" ></div><div id="tutorial1" class="tutorial createquestion1">In 2013-14, Exide Life Insurance recorded doubling in profits to Rs 53 crore driven by growth in renewal premiums and improvements in efficiency and product mix.</div></div>
<div class="fader"><div class="arrow-w arrowlocation1" style="font-size:1em;" ></div><div id="tutorial1" class="tutorial createquestion1">Reliance Life Insurance launches Claims Guarantee service.</div></div>
<div class="fader"><div class="arrow-w arrowlocation1" style="font-size:1em;" ></div><div id="tutorial1" class="tutorial createquestion1">IDBI Federal Life Insurance today launched a bouquet of individual products catering to various life stage needs of customers along with group solutions.</div></div>
<div>
</div>
</div>
</div>

<div class="tutorial">
</div>


<div id="backgroundPopup" >
    
    
   
    
    </div>
    
    <div id="share_link" style="">
      <div id="share_link-ct">
        <div id="share_link-header">
          <h2>Hi Akash Mishra,</h2>
          <p>Can you do us a favour?</p>
          <a class="modal_close" href="#"></a>
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
<?php if(empty($customer_details)){?>

<?php }?>
<script type="text/javascript">
var company_count = "<?php echo count($aNew);?>";
var plan_count = "<?php echo  count($customer_details);?>";
var min_premium = "<?php echo  $premiums['min_premium']?>";
var max_premium = "<?php echo  $premiums['max_premium'];?>";
var hospital_list_url = "<?php echo base_url().'health_insurance/controller_basicMediclaim/get_hospital_list'?>";
var annual_premium_search_url = "<?php echo base_url().'health_insurance/controller_basicMediclaim/health_policy'?>";
var increment_buyNow_url = "<?php echo base_url().'health_insurance/controller_basicMediclaim/increment_count'?>";

</script>
<script>
$(function() {
  $("#share_link,#backgroundPopup").delay(2000).fadeIn(500);
  
  setTimeout(function(){
   $('#share_link').css({opacity: 1});
   
}, 2000);
  
  $('.fac_link').html('<div class="fb-share-button" data-href="http://www.myinsuranceclub.com/health-insurance/"></div>');
  
  
  $('.modal_close').click(function() {
    $("#share_link,#backgroundPopup").fadeOut(500);
     $("#share_link").css({opacity: 0});
    
    });
    
});
</script>