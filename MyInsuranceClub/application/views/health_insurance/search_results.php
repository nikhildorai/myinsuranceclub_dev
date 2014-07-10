
<?php $this->load->view('partial_view/header_resultpage');?>

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
			$newVal = array();
			$preexisitng_disease_discard = array();
        foreach($customer_details as $k=>$v)
        {
           	if(!in_array($v['company_id'], $newVal))
        	{
        		$aNew [] = $v;
       	 	}
       	 	$newVal [] = $v['company_id'];
       	 	
       	 	
       	 	if($v['preexisting_diseases']!='Not Covered')
			{
       	 		if(!in_array($v['preexisting_diseases'],$preexisitng_disease_discard))
       	 		{
       	 			$preexist_filter [] = $v['preexisting_diseases'];
       	 		}

       	 		$preexisitng_disease_discard [] = $v['preexisting_diseases'];
			}
        }
                   				
		
        $min_annual_premium='';
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
        }
?>
      
      
    <div class="col-md-2  border c_o">
    <div id="sh1" style="display:none">
       <div class="top_h_t">Companies</div>
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
              
               <div style=" height:auto; padding:10px 0px 30px 0px; background:#ededec;  border-radius: 4px;">
                <div class="col-md-5 plan">
                Plan Details
                </div>
                
                 <div class="col-md-3 an">
                 Annual Premium
                </div>
                 <div class="col-md-4 text-right plan_cmpre">
                 <a href="health_compare.php" class="cmp_p_s">Compare Plans</a>
                </div>
                
                </div>
                
                <?php foreach($customer_details as $detail){
                	$preexist_diseases='';
                if(trim($detail['preexisting_diseases'])!='Not Covered')
                 						{
                 							$preexist_diseases='Waiting period of '.$detail['preexisting_diseases'].' years';
                 						}
                 						else
                 						{
                 							$preexist_diseases=$detail['preexisting_diseases'];
                 						}
										$variant='';
										if($detail['variant_name']!='Base')
										{
											$variant=' '.$detail['variant_name'];
										}
										else{
											$variant='';
										}
										
										$compare_data=$detail['variant_id'].'-'.$detail['annual_premium'].'-'.$detail['age'];
										
										?>
										
                <div class="cmp_tbl">
                <div class="cus_tb clearfix" >
                
                <div class="col-md-2 pad-right-10 logo_ins">
               <div class="img_bx" >
            <img src="<?php echo base_url();?>/assets/images/client/bhartiaxa.jpg" border="0" class="img_bx_i">
            <div class="check_bx">
            <div class="checkbox">
            <label>
            <input type="checkbox" name="c_name" id="c_name" class="" value="<?php echo $compare_data;?>">
            <label class="chk" for="Field4"></label>
          </label></div>
            </div>
            
            
            </div>
                </div>
                
                <div class="col-md-3 pad-left-10">
               <div class="c_t" >
            <span class="title_c" style="width:100%;"><?php echo $detail['company_shortname'];?></span><span class="sub_tit" ><?php echo $detail['policy_name'].$variant;?></span>
          </div>
                </div>
                
                 <div class="col-md-7 m_anc">
                
                <div class="col-md-6 no_pad_l">
                 <h3 class="anc">&#8377; <?php echo $detail['annual_premium'];?></h3>
                 <p class="sub_tit">for cover of &#8377; <?php echo $detail['sum_assured'];?></p>
                 </div>
                 
                  <div class="col-md-2" style="padding:0px">
                 
                 <div class="down_cnt" style="width:20px; height:auto; float:left; color:#999999;"><i class="fa fa-th"></i>
                
                 </div>
  <div class="down_cnt_up" style=""><i class="fa fa-angle-up"></i> 
                
                 </div>
                 </div>
                 
                  <div class="col-md-4 pad_r_10">
                
                  <a class="btn_offer_block" href="#">Buy Now <i class="fa fa-angle-right"></i></a>
                  <div class="thumb"><i class="fa fa-thumbs-up"></i><div class="text_t"> 12 people chose this plan</div></div>
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
<td class="cus_width"><?php echo $detail['cashless_treatment'];?></td></tr>
<tr>
<td>Pre-existing diseases</td>
<td class="cus_width"><?php echo $preexist_diseases;?></td></tr>
<tr class="odd">
<td>Auto recharge of Sum Insured</td>
<td class="cus_width"><?php echo $detail['autorecharge_SI'];?></td></tr>
<tr>
<td>Hospitalisation expenses
    <ul><li><i class="fa fa-angle-right"></i> Room Rent</li>
   <li><i class="fa fa-angle-right"></i> ICU Rent</li>
    <li><i class="fa fa-angle-right"></i> Fees of Surgeon, Anesthetist,  Medicines, Nurses, etc</li></ul> </td>
<td class="cus_width">

<ul class="no"><li>
<?php echo $detail['room_rent'];?></li>
<li><?php echo $detail['icu_rent'];?></li>
<li><?php echo $detail['doctor_fee']?></li></ul></td></tr>
<tr class="odd">
<td>Pre-hospitalisation</td>
<td class="cus_width"><?php echo $detail['pre_hosp'];?></td></tr>
<tr>
<td>Post-hospitalisation</td>
<td class="cus_width"><?php echo $detail['post_hosp'];?></td></tr>
<tr class="odd">
<td>Day care expenses</td>
<td class="cus_width"><?php echo $detail['day_care'];?></td></tr>
<tr >
<td>Maternity Benefits</td>
<td class="cus_width"><?php echo $detail['maternity'];?></td></tr>
<tr >
<td>Health Check up</td>
<td class="cus_width"><?php echo $detail['check_up'];?></td></tr>

<tr class="odd">
<td>Ayurvedic Treatment</td>
<td class="cus_width"><?php echo $detail['ayurvedic'];?></td></tr>
<tr>
<td>Co-payment</td>
<td class="cus_width"><?php echo $detail['co_pay'];?></td></tr>
</tbody>
</table>
</div>

                </div>
                
                   
<div class="col-md-7 medical" style="padding-right:0px;margin-bottom: 0px;">                 <h4 class="h_d mar-40" >List of Hospitals with Cashless Facility</h4>
               
               <div class="cus_d" style="padding:5px;">
               <div style="float: left; width: 100%; margin-top: 10px;">
               
               <div style="float: right; width: 100%; padding-left: 15px;"><div class="form-group col-md-12" style="margin-bottom:0px;">
                    <label for="" class="sr-only">Search by Pin Code</label>
                    <input type="text" placeholder="Search by Pin Code or Hospital Name" name="pin" id="" data-id="hos_class" autocomplete="off" spellcheck="false" class="form-control brdr typeahead tt-query med_search">
                    <!--<div class="bs-example">
        <input type="text" class="typeahead tt-query" autocomplete="off" spellcheck="false">
    </div>-->
                    <div class="search_icon"><i class="fa fa-search"></i></div>
                  </div></div>
                  
                  
                  
                  
<div class="loc_d hos"  style="padding:0px 15px; border:none; display:none; margin-top:20px;">
               
               <div class="col-md-12">
              <span class="tt-dropdown-menu" style="position: absolute; top: 100%; left: 0px; z-index:1; display: block; right: auto;">
<div class="tt-dataset-accounts">
  <div class="city_m">
    <div class="city_a">Hospital Name</div>
    <div class="city_b">City</div>
    <div class="city_c">Pin Code</div>
  </div>
  <span class="tt-suggestions resultTable" id="" style="display: block;">
  
  

  </span></div>
</span>
                  </div>
                  <div style="float: left; position: absolute; bottom: 0px; margin-bottom: 10px;" class="">Note: This list is subject to change without any notice</div>
               
               
               </div>

                  
               </div>
               
               
               
               
               
               
               </div>
               
                </div>
               <div class="col-md-5">
                              <h4 class="h_d mar-40" style="margin-left:50px;">Documents</h4>

<ul class="doc">
<li>Policy Brouchure <a href="javascript:void(0)"><img src="<?php echo base_url();?>/assets/images/pdf.jpg"></a></li>
<li>Policy Wordings <a href="javascript:void(0)"><img src="<?php echo base_url();?>/assets/images/pdf.jpg" class="dimg"></a></li></ul>
</ul>
               
               </div> 
                
                <div class="col-md-12  hide_d" >Hide details <i class="fa fa-angle-up"></i></div>
                
                
                </div>
                
                </div>
               </div> 
   				<?php }?>
         
                
               </div>
             
            </div>
            
            <!--Sidebar-->
            <?php echo form_open('health_insurance/basicMediclaim/health_policy',array('id'=>'search'));?>
            <div class="col-md-3 col-md-pull-9 sidebar sidebar-left" style="padding:0px;">
              <div class="inner" style="margin-bottom:50px;">
                
                
             
                
                
                <div class="block1" style="position:relative;">
                 <h6 class="fh3 l"> 4 of 4 plans</h6>
                 
                 <h6 class="fh3"> Premium</h6>
                 
                 
                 
                 <div class="filterContent ">
				
			<div style="float: left; width: 100%; position: relative; top: -30px;">
  <input type="text" id="amount_a" readonly="" class="s_l">
   <input type="text" id="amount1_a" readonly="" class="s_r">
</div>
                <div id="slider-range1"></div>
                
                
				<div class="price rangeSlider">
	          
							
			
			<p class="displayStaticRange clearFix" style="padding-bottom:0px; margin-bottom:0px;">
				<span class="fLeft"><span data-pr="6437" class="INR">&#8377;</span>6,437</span>
				<span class="fRight"><span data-pr="42306" class="INR">&#8377;</span>42,306</span>
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
            <input type="checkbox" id="" name="agree1"  class="field checkbox" value="agree">
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
            <input type="checkbox" id="" name="agree3"  class="field checkbox" value="agree2">
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
                 <?php 
                 		
                 		foreach($preexist_filter as $p){?>
					<div class="checkbox">
            <label>
            
            <input type="checkbox" id="" name="10"  class="field checkbox" value="<?php echo $p;?>">
            <label class="" for="10">Plans which cover after <?php echo $p;?> years
					
					</label>
         	
          </label>
          
          </div><?php }}?>
               
				</p>
                
                <p class="addOnFilter" style="margin:0px; padding:0px;">
						<h6 class="fh3 l" style="margin:0px; padding:0px; height:9px;">&nbsp; </h6>
				</p> 
                
                
                 <h6 class="fh3">Company </h6>
                 <?php foreach($aNew as $comp){?>
                 <div class="addOnFilter clearfix" >
                 
                    
                    <div style="width: 100%; float: left;">
                    <div class="checkbox" style="width: auto; float: left; margin: 0px;">
            <label>
            
            <input type="checkbox" value="<?php echo $comp['company_id'];?>" class="field checkbox" name="23" id="">
            <label for="23" class=""><?php echo $comp['company_shortname'];?></label>
           
          </label></div> <span style="float:right;"> Rs. 12,340</span></div>
              
				</div><?php }?>
                 
                 <p class="addOnFilter" style="margin:0px; padding:0px;">
						<h6 class="fh3 l" style="margin:0px; padding:0px; height:9px;">&nbsp; </h6>
				</p> 
                 <h6 class="fh3">Co-payment</h6>
                 <p class="addOnFilter" >
                 
					 <div class="checkbox">
            <label>
            <input type="checkbox" id="" name="14"  class="field checkbox" value="14">
            <label class="" for="14">Plans with no co-payment
					</label>
          </label></div>
                     <div class="checkbox">
            <label>
            <input type="checkbox" id="" name="15"  class="field checkbox" value="15">
            <label class="" for="15">Plans with 10% co-payment
					</label>
          </label></div>
                      <div class="checkbox">
            <label>
            <input type="checkbox" id="" name="16"  class="field checkbox" value="16">
            <label class="" for="16">Plans with 20% co-payment
					</label>
          </label></div>
                      <div class="checkbox">
            <label>
            <input type="checkbox" id="" name="17"  class="field checkbox" value="17">
            <label class="" for="17">CPlans with 30% co-payment
					</label>
          </label></div>
				</p>
                
                 <p class="addOnFilter" style="margin:0px; padding:0px;">
						<h6 class="fh3 l" style="margin:0px; padding:0px; height:9px;">&nbsp; </h6>
				</p> 
                
                 <h6 class="fh3">Mode of purchase</h6>
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
				</p>
                
                                <h6 class="fh3">Claims ratio of company</h6>

                
                     <!--<div class="" ng-controller="DemoController34" style="margin-top:30px;">
                <div range-slider min="0" max="100" model-min="demo1.min" model-max="demo1.max"></div>-->
              
                <p>

  <input type="text" id="amount" readonly class="s_l">
   <input type="text" id="amount1" readonly  class="s_r">
</p>
                <div id="slider-range"></div>
                
                </div>
				<div class="price rangeSlider">
	          
							
			
			<p class="displayStaticRange clearFix" style="padding-bottom:0px; margin-bottom:0px; margin-top:15px;">
			
                <span class="fLeft"><span data-pr="<?php echo $min_annual_premium;?>" class="INR">&#8377;</span><?php echo $min_annual_premium;?></span>
				<span class="fRight"><span data-pr="<?php echo $max_annual_premium;?>" class="INR">&#8377;</span><?php echo $max_annual_premium;?></span>
			</p>
	
			<input type="hidden" name="price" value="6437-32293">
	
				
		</div>
                
                
               <p class="addOnFilter" style="margin:0px; padding:0px;">
						<h6 class="fh3 l" style="margin:0px; padding:0px; height:9px;">&nbsp; </h6>
				</p> 
                 <h6 class="fh3">Company type</h6>
                 <p class="addOnFilter" >
                 
					 <div class="checkbox">
            <label>
            <input type="checkbox" id="" name="20"  class="field checkbox" value="20">
            <label class="" for="20">Plans from Private Sector companies
					</label>
          </label></div>
                    <div class="checkbox">
            <label>
            <input type="checkbox" id="" name="21"  class="field checkbox" value="21">
            <label class="" for="21">Plans from Public Sector companies
					</label>
          </label></div>
                    
                    <div class="checkbox">
            <label>
            <input type="checkbox" id="" name="22"  class="field checkbox" value="22">
            <label class="" for="22">Plans from Health Insurance companies
					</label>
          </label></div>
                    
				</p>
               
                
                
                
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

<script type="text/javascript">
var company_count = "<?= count($aNew);?>";
var plan_count = "<?= count($customer_details);?>";
var min_premium = "<?= $min_annual_premium;?>";
var max_premium = "<?= $max_annual_premium;?>";
</script>













 

<?php $this->load->view('partial_view/footer_resultpage');?>
