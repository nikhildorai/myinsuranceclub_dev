

<span id="o_touch"></span>

<div id="highlighted" style=" background:#fff; padding-bottom:50px; margin-bottom:0px;" >

  <div class="container">
  
   <div class="top_band">
   <div class="col-md-3  border m_a">
       <div class="top_h">Your Search</div>
       <div class="top_p">Coverage Amount = &#8377; <?php if(isset($this->session->userdata['user_input']['coverage_amount'])){echo $this->session->userdata['user_input']['coverage_amount'];}?></div>
      <div class="top_p"> Members = <?php if(isset($this->session->userdata['user_input']['plan_type_name'])){echo $this->session->userdata['user_input']['plan_type_name'];}?></div>
       <div class="top_m"><i class="fa fa-angle-left"></i> <a href="<?php echo site_url('health-insurance');?>">Modify Your Search</a></div>
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
               <div style=" height:auto; padding:10px 0px 30px 0px; background:#ededec;  border-radius: 4px;">
                <div class="col-md-5 plan">
                Plan Details
                </div>
                
                 <div class="col-md-3 an">
                 Annual Premium
                </div>
                 <div class="col-md-4 text-right plan_cmpre">
                 <a href="javascript:void(0);" class="cmp_p_s" id="comparePolicy">Compare Plans</a>
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
            <label class="" for="Field4">Show plans without room rent caps</label>
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
            <input type="checkbox" id="" name="maternity"  class="search_filter" value="1" <?php //echo $checked;?>>
            <label class="" for="Field6">Show plans with maternity benefits</label>
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
                 <?php foreach($preexist_filter as $p){?>
                 
					<div class="checkbox">
            				<label>
            					<input type="checkbox" id="" name="precover[]" class="search_filter" value="<?php echo $p;?>">
           							 <label class="" for="10">Plans which cover after <?php echo $p;?> years
									</label>
         					 </label>
          			</div>
          			<?php }
                 		
                 	}?>
				</p>
                <p class="addOnFilter" style="margin:0px; padding:0px;">
						<h6 class="fh3 l" style="margin:0px; padding:0px; height:9px;">&nbsp; </h6>
				</p> 
                 <h6 class="fh3">Company </h6>
                 	<div class="addOnFilter clearfix" >
                 
                 <?php 
                 if(!empty($aNew))
                 {
                 	
                 	foreach($aNew as $company){
                    	
                    	$premium = $company['premium'];
	                   	sort($premium);
	              ?>
	              
                    <div style="width: 100%; float: left;">
                    	<div class="checkbox" style="width: auto; float: left; margin: 0px;">
            				<label>
            					<input type="checkbox" value="<?php echo $company['company']['company_id'];?>" class="search_filter" name="company_name[]">
            						<label for="23" class=""><?php echo $company['company']['company_shortname'];?></label>
          					</label>
          				</div> <span style="float:right;"> &#8377; <?php echo reset($premium).' - &#8377; '.end($premium);?></span>
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
            				<input type="checkbox" id="" name="14"  class="search_filter" value="14">
            					<label class="" for="14">Plans with no co-payment
								</label>
          				</label>
          			</div>
                     <div class="checkbox">
            				<label>
            					<input type="checkbox" id="" name="15"  class="search_filter" value="15">
            						<label class="" for="15">Plans with 10% co-payment
									</label>
          					</label>
          			</div>
                      <div class="checkbox">
            				<label>
            					<input type="checkbox" id="" name="16"  class="search_filter" value="16">
            						<label class="" for="16">Plans with 20% co-payment
									</label>
          					</label>
          			</div>
                      <div class="checkbox">
            				<label>
            					<input type="checkbox" id="" name="17"  class="search_filter" value="17">
            						<label class="" for="17">CPlans with 30% co-payment
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
            <input type="checkbox" id="" name="18"  class="field checkbox" value="18">
            <label class="" for="18">Online
					</label>
          </label></div>
                    <div class="checkbox">
            <label>
            <input type="checkbox" id="" name="19"  class="field checkbox" value="19">
            <label class="" for="19">Not Online
					</label>
          </label></div>
                    
				</p>
                <p class="addOnFilter" style="margin:0px; padding:0px;">
						<h6 class="fh3 l" style="margin:0px; padding:0px; height:9px;">&nbsp; </h6>
				</p -->
                
                                <h6 class="fh3">Claims ratio of company</h6>

                
                     <!--<div class="" ng-controller="DemoController34" style="margin-top:30px;">
                <div range-slider min="0" max="100" model-min="demo1.min" model-max="demo1.max"></div>-->
              
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
				</p> 
                 <h6 class="fh3">Company type</h6>
                 <p class="addOnFilter" >
                 
                 <?php foreach($pph as $k=>$v){?>
					 
					 <?php if($v == '2'){?>
					 
					 	<div class="checkbox">
            				<label>
            					<input type="checkbox" id="" name="sector[]"  class="search_filter" value="2">
            						<label class="" for="20">Plans from Private Sector companies
									</label>
          					</label>
          				</div>
          				
          			<?php }?>
          			
          			<?php if($v == '1'){?>
          			
                    	<div class="checkbox">
            				<label>
            					<input type="checkbox" id="" name="sector[]"  class="search_filter" value="1">
            						<label class="" for="21">Plans from Public Sector companies
									</label>
          					</label>
          				</div>
          				
                    	<?php }?>
                    
                    <?php }?>
                    
                    
                    
                    	<div class="checkbox">
            				<label>
            					<input type="checkbox" id="" name="health_comp[]"  class="search_filter" value="3">
           							 <label class="" for="22">Plans from Specialised Health Insurers									</label>
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
<?php if(empty($customer_details)){?>

<?php }?>
<script type="text/javascript">
var company_count = "<?php echo count($aNew);?>";
var plan_count = "<?php echo  count($customer_details);?>";
var min_premium = "<?php echo  $premiums['min_premium']?>";
var max_premium = "<?php echo  $premiums['max_premium'];?>";
var hospital_list_url = "<?php echo base_url().'health_insurance/controller_basicMediclaim/get_hospital_list'?>";
var annual_premium_search_url = "<?php echo base_url().'health_insurance/controller_basicMediclaim/health_policy'?>";

function buy_now_msg(variant_id)
{
	$('#buy_now_message_' + variant_id).show();
	$('#buy_now_btn_' + variant_id).hide();
	return false;
}
</script>
