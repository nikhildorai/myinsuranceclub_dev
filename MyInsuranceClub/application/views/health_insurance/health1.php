<?php //$this->load->view('partial_view/header_new'); ?>

<link rel="stylesheet" href="<?php echo base_url();?>assets/css/introjs.css">

<span id="o_touch"></span>
<div class="min_height" style="height:auto; width:100%; ">
  <div id="highlighted" >
    <div class="container"> <?php echo validation_errors();?> <?php echo form_open('health-insurance/search-results',array('name'=>'health_form','id'=>'health_form','class'=>'health-form'));?>
      <div class="col-md-12 center ">
        <div class="col-md-1"></div>
        <h1 class="col-md-11" style="text-align:center; margin-top:30px; width:100%;" id="step1">Compare & Buy Health Insurance Plans</h1>
        <div class="col-md-12">
          <div class="col-md-1"></div>
          <p class="col-md-11" style="text-align:left; padding-left:32px;">Choose from <?php echo $company_plan_count[1]['companyCount'];?> plans from <?php echo $company_plan_count[0]['companyCount'];?> companies</p>
        </div>
      </div>
      <div class="col-md-12 center m_h" style=" position:relative;">
        <h3>I want a <span id="clickk" style="position:relative; "><span class="dotted rs" id="rs">
          <?php if(isset($this->session->userdata['user_input']['coverage_amount'])){
 																																	echo $this->session->userdata['user_input']['coverage_amount'];}else{?>
          3 Lakhs
          <?php }?>
          </span>
          <div data-bind="" style="display: none; left:0px; width:205px;" class="choice l amt" id="c_ch">
            <div class="choice-leftcol" data-bind="">
              <ul data-bind="jScrollPane" id="c_amt" class="years active scroll-pane">
                <?php foreach($cvg_amt as $k=>$v){?>
                <li data-coverage-literalid="<?php echo $k; ?>"><a href="javascript:void(0);"><?php echo $v;?></a></li>
                <?php } ?>
              </ul>
              <div class="stepwrap years-stepwrap">
                <div class="step show"> <em>1</em>
                  <div class="label-mid">Select Coverage Amount</div>
                </div>
              </div>
            </div>
          </div>
          </span> cover for <span id="clickk_f" style="position:relative;"><span class="dotted c_for" id="c_for">
          <?php if(isset($this->session->userdata['user_input']['plan_type_name'])){ echo $this->session->userdata['user_input']['plan_type_name'];}else{?>
          Myself
          <?php }?>
          </span>
          <div data-bind="" style="display: none;" class="choice l self" id="c_ch_f">
            <div class="choice-leftcol" data-bind="">
              <ul class="years active scroll-pane" id="c_for_f" data-bind="jScrollPane">
                <?php foreach($family_composition as $k=>$v){?>
                <li data-compo-id="<?php echo $k; ?>"><a href="javascript:void(0);"><?php echo trim($v); ?></a></li>
                <?php }?>
              </ul>
              <div class="stepwrap years-stepwrap">
                <div class="step show"> <em>2</em>
                  <div class="label-mid">Select Members</div>
                </div>
              </div>
            </div>
          </div>
          </span></h3>
      </div>
      <div class="col-md-12 center no-margin m_h">
        <h3 style=""><span style="">I am </span> <span id="clickk_g" style="position:relative;"><span class="dotted ge" id="ge">
          <?php if(isset($this->session->userdata['user_input']['cust_gender'])){ echo $this->session->userdata['user_input']['cust_gender'];}else{?>
          Male
          <?php }?>
          </span>
          <div data-bind="" style="display: none;" class="choice  g" id="c_ch_g">
            <div class="choice-leftcol" data-bind="">
              <ul class="years active" id="c_for_g"  style="padding:0px 0 30px;">
                <li><a href="javascript:void(0);">Male</a></li>
                <li><a href="javascript:void(0);">Female</a></li>
              </ul>
              <div class="stepwrap years-stepwrap">
                <div class="step show"> <em>3</em>
                  <div class="label-mid">Select Gender</div>
                </div>
              </div>
            </div>
          </div>
          </span><span style=""> & I stay in</span> <span id="clickk_l" style="position:relative; "><span class="dotted loc" id="loc">
          <?php 
	          	$explodeCity = array();
	          if(isset($this->session->userdata['user_input']['cust_city_name']))
	          { 
	          	$explodeCity = explode(', ',$this->session->userdata['user_input']['cust_city_name']);
	          	
	          	
	          	echo $explodeCity[0];
	          
	          }else{?>
	          Jalgaon
          <?php }?>
          </span>
          <div data-bind="" style="display: none; left:0px;  max-width: 350px; width: 400px;" class="choice l cit" id="c_ch_l">
            <div class="choice-leftcol" data-bind="">
              <select name="cust_city" placeholder="Type your city" id="combobox" style="height:auto;">
                <option value="" > </option>
                <?php if(isset($this->session->userdata['user_input']['cust_city_name']) && isset($this->session->userdata['user_input']['cust_city'])){?>
                <option value="<?php echo $this->session->userdata['user_input']['cust_city'];?>" selected="selected"><?php echo $this->session->userdata['user_input']['cust_city_name']?></option>
                <?php } else{?>
                <option value="583" selected="selected">Jalgaon, Maharashtra</option>
                <?php }?>
                <?php foreach ($city as $c_name){
                	
                	/* if($c_name['alternate_city_name1'] != '' && $c_name['alternate_city_name2'] != '')
                	{
                		$display_city = '('.$c_name['alternate_city_name1'].'/'.$c_name['alternate_city_name2'].') '.$c_name['display_name'];
                	}
                	elseif($c_name['alternate_city_name1'] != '' && $c_name['alternate_city_name2'] == '')
                	{
                		$display_city = '('.$c_name['alternate_city_name1'].') '.$c_name['display_name'];
                	}
                	
                	elseif($c_name['alternate_city_name1'] == '' && $c_name['alternate_city_name2'] == '')
                	{
                		$display_city = $c_name['display_name'];
                	} */
                	
                	
             ?>
                <option value="<?php echo $c_name['city_id']; ?>" data-city-name="<?php echo $c_name['mic_city_name']; ?>" data-altname1="<?php echo $c_name['alternate_city_name1']; ?>" data-alt_name2="<?php echo $c_name['alternate_city_name2'];?>"><?php echo $c_name['display_name']; ?></option>
                
                <?php }?>
              </select>
              <div class="stepwrap years-stepwrap">
                <div class="step show"> <em>4</em>
                  <div class="label-mid">Select City of Residence</div>
                </div>
              </div>
            </div>
          </div>
          </span> </h3>
      </div>
      <div class="cus_cont">
        <div class="col-md-12 mar-20 no_pad_l m_h" >
          <p>About Policy holder:</p>
        </div>
        <div class="">
          <div class="clearfix1">
            <div class="form-group col-md-3" style="padding-left:0px;">
              <div class="section">
                <label class="field prepend-icon ">
                <label class="sr-only" for="signup-first-name">Full Name</label>
                <input type="text" autocomplete="off" maxlength="50" style="text-transform:capitalize;" class="form-control gui-input" id="cust_name" name="cust_name" onkeyup="javascript:validateName(cust_name);" placeholder="Full name" value="<?php if(isset($this->session->userdata['user_input']['full_name']))
                    																					{
                    																						echo $this->session->userdata['user_input']['full_name'];
                    																					}else 
                    																					{			 
                    																						echo set_value('cust_name');
                    																					}?>" required>
                <input type="hidden" id="cust_gender" name="cust_gender" value="<?php if(isset($this->session->userdata['user_input']['cust_gender']))
                    																					{
                    																						echo $this->session->userdata['user_input']['cust_gender'];
                    																					}else 
                    																					{?>Male<?php }?>">
                <input type="hidden" id="policy_term" name="policy_term" value="">
                <input type="hidden" id="cust_city_name" name="cust_city_name" value="<?php if(isset($this->session->userdata['user_input']['cust_city_name'])){ echo $this->session->userdata['user_input']['cust_city_name'];}else{?>Jalgaon, Maharashtra<?php }?>">
                <input type="hidden" id="coverage_amount" name="coverage_amount" value="<?php if(isset($this->session->userdata['user_input']['coverage_amount']))
                     																				{
 																										echo $this->session->userdata['user_input']['coverage_amount'];
                     																				}else
																										{?>3 Lakhs<?php }?>">
                <input type="hidden" id="coverage_amount_literal" name="coverage_amount_literal" value="<?php if(isset($this->session->userdata['user_input']['coverage_amount_literal']))
                     																				{
 																										echo $this->session->userdata['user_input']['coverage_amount_literal'];
                     																				}else
																										{?>300000<?php }?>">
                <input type="hidden" id="plan_type" name="plan_type" value="<?php if(isset($this->session->userdata['user_input']['plan_type']))
                    																					{
                    																						echo $this->session->userdata['user_input']['plan_type'];
                    																					}else 
                    																					{?>1A<?php }?>">
                <input type="hidden" id="plan_type_name" name="plan_type_name" value="<?php if(isset($this->session->userdata['user_input']['plan_type_name']))
                    																					{
                    																						echo $this->session->userdata['user_input']['plan_type_name'];
                    																					}else 
                    																					{?>Myself<?php }?>">
                <input type="hidden" id="product_name" name="product_name" value="Health Insurance">
                <input type="hidden" id="product_type" name="product_type" value="Mediclaim">
                </label>
              </div>
            </div>
            <div class="form-group car-ins col-md-3">
              <input type="text" class="mob_cal m_cust" name="m_cust_dob1" id="m_cust_dob1" autocomplete="off" placeholder="Date of Birth"    >
              <div class="section">
                <label class="field prepend-icon">
                <label class="sr-only" for="signup-first-name">Date Of Birth</label>
                
                <!--                   <div id="cal_d"></div>
-->
                <div class="desk_cal">
                  <label class="input" style="position:relative"> <i class="icon-append fa fa-calendar " id="trigger"></i>
                    <input type="text" name="desktop_cust_dob" id="cust_dob" autocomplete="off" class="form-control cal"   placeholder="Date of Birth" value="<?php if(isset($this->session->userdata['user_input']['cust_birthdate']))
                    																											{
                    																												echo $this->session->userdata['user_input']['cust_birthdate'];
                    																											}else 
                    																											{			 
                    																												echo set_value('desktop_cust_dob');
                    																											}?>" required>
                  </label>
                </div>
                <div class="mob_cal">
                  <label class="input form-control" style="position:relative; margin:0px;"> <i class="icon-append fa fa-calendar "></i>
                    <input type="date" name="mobile_cust_dob" id="m_cust_dob" autocomplete="off" class="native_date_picker" value="<?php if(isset($this->session->userdata['user_input']['cust_birthdate']))
                    																											{
                    																												echo $this->session->userdata['user_input']['cust_birthdate'];
                    																											}else 
                    																											{			 
                    																												echo set_value('mobile_cust_dob');
                    																											}?>" required/>
                  </label>
                </div>
                </label>
              </div>
            </div>
          </div>
          <div class="clearfix1">
            <div class="form-group col-md-2 m_s">
              <div class="section">
                <label class="field prepend-icon">
                <label class="sr-only" for="signup-first-name">Mobile</label>
                <input type="text" autocomplete="off" class="form-control" id="cust_mobile" name="cust_mobile" maxlength="10" placeholder="Mobile" value="<?php if(isset($this->session->userdata['user_input']['cust_mobile']))
                    																						{
                    																							echo $this->session->userdata['user_input']['cust_mobile'];
                    																						}else 
                    																						{			 
                    																							echo set_value('cust_mobile');
                    																						}?>" required>
                </label>
              </div>
            </div>
            <div class="form-group col-md-4 pad_right_no">
              <div class="section">
                <label class="field prepend-icon">
                <label class="sr-only" for="signup-first-name">Email</label>
                <input type="text" autocomplete="off" class="form-control gui-input" id="cust_email" name="cust_email"  placeholder="Email" value="<?php if(isset($this->session->userdata['user_input']['cust_email']))
                    																						{
                    																							echo $this->session->userdata['user_input']['cust_email'];
                    																						}else 
                    																						{			 
                    																							echo set_value('cust_email');
                    																						}?>" required>
                <!--                     <b class="tooltip tip-left-top" ><em>Male</em></b>  
-->
                </label>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="cus_cont">
        <?php if(isset($this->session->userdata['user_input']['plan_type']) && in_array($this->session->userdata['user_input']['plan_type'],array('2A','2A1C','2A2C','2A3C','2A4C'))){?>
        <?php 	$display_spouse = "style='width:100%; float:left;'";
        		
              } 
              else
			  {
			  	$display_spouse = "style='display:none; width:100%; float:left;'";
			  }       
        ?>
        <div id="adlt_spc" <?php echo $display_spouse; ?> class=" ">
          <div class="">
            <div class="col-md-12" style="padding-left:0px;">
              <p>Adult 2 (Spouse):</p>
            </div>
            <div class="form-group car-ins col-md-3">
              <input type="text" class="mob_cal m_cust" name="m_spouce_dob1" id="m_spouce_dob1" autocomplete="off" placeholder="Date of Birth">
              <div class="section">
                <label class="field prepend-icon">
                <label class="sr-only" for="signup-first-name">Date Of Birth</label>
                <div class="desk_cal">
                  <label class="input" style="position:relative"> <i class="icon-append fa fa-calendar " id="trigger1"></i>
                    <input type="text" name="desktop_spouce_dob" id="spouce_dob" class="form-control cal"  placeholder="Date of Birth" value="<?php if(isset($this->session->userdata['user_input']['spouse_dob']))
                    																						{
                    																							echo $this->session->userdata['user_input']['spouse_dob'];
                    																						}else 
                    																						{			 
                    																							echo set_value('desktop_spouse_dob');
                    																						}?>" required>
                  </label>
                </div>
                <div class="mob_cal">
                  <label class="input form-control" style="position:relative"> <i class="icon-append fa fa-calendar "></i>
                    <input type="date" name="mobile_spouce_dob" id="m_spouce_dob" class="native_date_picker" value="<?php if(isset($this->session->userdata['user_input']['spouse_dob']))
                    																						{
                    																							echo $this->session->userdata['user_input']['spouse_dob'];
                    																						}else 
                    																						{			 
                    																							echo set_value('mobile_spouse_dob');
                    																						}?>" required>
                  </label>
                </div>
                </label>
              </div>
            </div>
            <div class="">
              <div class="desk_gen">
                <div class="form-group car-ins col-md-3">
                  <div class="cus_border form-control sel">
                    <label class="gen_text" for="signup-first-name">Gender</label>
                    <label title1="Male" class="selection-confirm">
                    <label class="input gen_r rm">
                    <input type="radio" name="spouce_gender" id="spouce_gender1" class="css-checkbox">
                    <label for="radio4" class="css-label a radGroup2 sel_m"></label>
                    <i class="icon-append nob fa fa-male"></i>
                    </label>
                    </label>
                    <label title1="Female" class="selection-confirm">
                    <label class="input gen_r">
                    <input type="radio" name="spouce_gender" id="spouce_gender2" class="css-checkbox">
                    <label for="radio4" class="css-label a radGroup2 ss sel_f"></label>
                    <i class="icon-append fa fa-female"></i>
                    </label>
                    </label>
                  </div>
                </div>
              </div>
              <div class="mob_gen" style="display:none;">
                <div class="form-group car-ins col-md-2">
                  <div class="cus_border form-control1 ">
                    <div id="myToggle" class="slider-toggle-container" style="float: left" data-initialvalue="1" data-height="34" data-width="175" data-ballwidth="87.5" data-ballwheight="34" data-tabindex="undefined" data-speed="550">
                      <label for="leftInput"></label>
                      <input id="leftInput" type="radio" name="spouce_gender" value="1">
                      <label for="rightInput"></label>
                      <input id="rightInput" type="radio" name="spouce_gender" value="0">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="cus_cont">
        <div class=" " style="width: 100%; float: left;">
          <?php if(isset($this->session->userdata['user_input']['plan_type']) && in_array($this->session->userdata['user_input']['plan_type'],array('2A1C','2A2C','2A3C','2A4C','1A1C','1A2C','1A3C','1A4C'))){?>
          <?php 	$display_child1 = "style=''";
        		
              } 
              else
			  {
			  	$display_child1 = "style='display:none;'";
			  }       
        ?>
          <div class="" id="one_c" <?php echo $display_child1;?>>
            <div style="padding-left:0px;" class="col-md-12">
              <p>Child 1:</p>
            </div>
            <div class="form-group car-ins col-md-6">
              <input type="text" class="mob_cal m_cust" name="m_child1_dob1" id="m_child1_dob1" autocomplete="off" placeholder="Date of Birth"    >
              <div class="section">
                <label class="field prepend-icon">
                <label class="sr-only" for="signup-first-name">Date Of Birth</label>
                <div class="desk_cal">
                  <label class="input" style="position:relative"> <i class="icon-append fa fa-calendar " id="trigger2"></i>
                    <input type="text" name="desktop_child1_dob" id="child1_dob" class="form-control cal"  placeholder="Date of Birth" value="<?php if(isset($this->session->userdata['user_input']['child1_dob']))
                    																						{
                    																							echo $this->session->userdata['user_input']['child1_dob'];
                    																						}else 
                    																						{			 
                    																							echo set_value('desktop_child1_dob');
                    																						}?>">
                  </label>
                </div>
                <div class="mob_cal">
                  <label class="input form-control" style="position:relative"> <i class="icon-append fa fa-calendar "></i>
                    <input type="date" name="mobile_child1_dob" id="m_child1_dob" class="native_date_picker" placeholder="Date of Birth" value="<?php if(isset($this->session->userdata['user_input']['child1_dob']))
                    																						{
                    																							echo $this->session->userdata['user_input']['child1_dob'];
                    																						}else 
                    																						{			 
                    																							echo set_value('mobile_child1_dob');
                    																						}?>">
                  </label>
                </div>
                </label>
              </div>
            </div>
            <div class="desk_gen">
              <div class="form-group car-ins col-md-6">
                <div class="cus_border form-control ">
                  <label class="gen_text" for="signup-first-name">Gender</label>
                  <label title1="Male" class="selection-confirm">
                  <label class="input gen_r rm">
                  <input type="radio" name="child1_gender" id="child1_gender" class="css-checkbox ">
                  <label for="radio4" class="css-label a radGroup2"></label>
                  <i class="icon-append nob fa fa-male"></i>
                  </label>
                  </label>
                  <label title1="Female" class="selection-confirm">
                  <label class="input gen_r">
                  <input type="radio" name="child1_gender" id="child1_gender" class="css-checkbox">
                  <label for="radio4" class="css-label a radGroup2 ss"></label>
                  <i class="icon-append fa fa-female"></i>
                  </label>
                  </label>
                </div>
              </div>
            </div>
            <div class="mob_gen" style="display:none;">
              <div class="form-group car-ins col-md-2">
                <div class="cus_border form-control1 ">
                  <div id="myToggle1" class="slider-toggle-container" style="float: left" data-initialvalue="1" data-height="34" data-width="175" data-ballwidth="87.5" data-ballwheight="34" data-tabindex="undefined" data-speed="550">
                    <label for="leftInput"></label>
                    <input id="leftInput" type="radio" name="child1_gender" value="1">
                    <label for="rightInput"></label>
                    <input id="rightInput" type="radio" name="child1_gender" value="0">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php if(isset($this->session->userdata['user_input']['plan_type']) && in_array($this->session->userdata['user_input']['plan_type'],array('2A2C','2A3C','2A4C','1A2C','1A3C','1A4C'))){
        	$display_child2 = "style=''";
        		
              } 
              else
			  {
			  	$display_child2 = "style='display:none;'";
			  }       
        ?>
          <div class="" id="two_c" <?php echo $display_child2;?>>
            <div style="padding-left:0px;" class="col-md-12">
              <p>Child 2:</p>
            </div>
            <div class="form-group car-ins col-md-6">
              <input type="text" class="mob_cal m_cust" name="m_child2_dob1" id="m_child2_dob1" autocomplete="off" placeholder="Date of Birth"    >
              <div class="section">
                <label class="field prepend-icon">
                <label class="sr-only" for="signup-first-name">Date Of Birth</label>
                <div class="desk_cal">
                  <label class="input" style="position:relative"> <i class="icon-append fa fa-calendar " id="trigger3"></i>
                    <input type="text" name="desktop_child2_dob" id="child2_dob" class="form-control cal"  placeholder="Date of Birth" value="<?php if(isset($this->session->userdata['user_input']['child2_dob']))
                    																						{
                    																							echo $this->session->userdata['user_input']['child2_dob'];
                    																						}else 
                    																						{			 
                    																							echo set_value('desktop_child2_dob');
                    																						}?>">
                  </label>
                </div>
                <div class="mob_cal">
                  <label class="input form-control" style="position:relative"> <i class="icon-append fa fa-calendar "></i>
                    <input type="date" name="mobile_child2_dob" id="m_child2_dob" class="native_date_picker" placeholder="Date of Birth" value="<?php if(isset($this->session->userdata['user_input']['child2_dob']))
                    																						{
                    																							echo $this->session->userdata['user_input']['child2_dob'];
                    																						}else 
                    																						{			 
                    																							echo set_value('mobile_child2_dob');
                    																						}?>">
                  </label>
                </div>
                </label>
              </div>
            </div>
            <div class="">
              <div class="desk_gen">
                <div class="form-group car-ins col-md-6">
                  <div class="cus_border form-control ">
                    <label class="gen_text" for="signup-first-name">Gender</label>
                    <label title1="Male" class="selection-confirm">
                    <label class="input gen_r rm">
                    <input type="radio" name="child2_gender" id="child2_gender" class="css-checkbox ">
                    <label for="radio4" class="css-label a radGroup2"></label>
                    <i class="icon-append nob fa fa-male"></i>
                    </label>
                    </label>
                    <label title1="Female" class="selection-confirm">
                    <label class="input gen_r">
                    <input type="radio" name="child2_gender" id="child2_gender" class="css-checkbox">
                    <label for="radio4" class="css-label a radGroup2 ss"></label>
                    <i class="icon-append fa fa-female"></i>
                    </label>
                    </label>
                  </div>
                </div>
              </div>
              <div class="mob_gen" style="display:none;">
                <div class="form-group car-ins col-md-2">
                  <div class="cus_border form-control1 ">
                    <div id="myToggle2" class="slider-toggle-container" style="float: left" data-initialvalue="1" data-height="34" data-width="175" data-ballwidth="87.5" data-ballwheight="34" data-tabindex="undefined" data-speed="550">
                      <label for="leftInput"></label>
                      <input id="leftInput" type="radio" name="child2_gender" value="1">
                      <label for="rightInput"></label>
                      <input id="rightInput" type="radio" name="child2_gender" value="0">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php if(isset($this->session->userdata['user_input']['plan_type']) && in_array($this->session->userdata['user_input']['plan_type'],array('2A3C','2A4C','1A3C','1A4C'))){
        	$display_child3 = "style=''";
        		
              } 
              else
			  {
			  	$display_child3 = "style='display:none;'";
			  }       
        ?>
          <div class="" id="three_c" <?php echo $display_child3;?>>
            <div style="padding-left:0px;" class="col-md-12">
              <p>Child 3:</p>
            </div>
            <div class="form-group car-ins col-md-6">
              <input type="text" class="mob_cal m_cust" name="m_child3_dob1" id="m_child3_dob1" autocomplete="off" placeholder="Date of Birth"    >
              <div class="section">
                <label class="field prepend-icon">
                <label class="sr-only" for="signup-first-name">Date Of Birth</label>
                <div class="desk_cal">
                  <label class="input" style="position:relative"> <i class="icon-append fa fa-calendar " id="trigger4"></i>
                    <input type="text" name="desktop_child3_dob" id="child3_dob" class="form-control cal"   placeholder="Date of Birth" value="<?php if(isset($this->session->userdata['user_input']['child3_dob']))
                    																						{
                    																							echo $this->session->userdata['user_input']['child3_dob'];
                    																						}else 
                    																						{			 
                    																							echo set_value('desktop_child3_dob');
                    																						}?>" required>
                  </label>
                </div>
                <div class="mob_cal">
                  <label class="input form-control" style="position:relative"> <i class="icon-append fa fa-calendar "></i>
                    <input type="date" name="mobile_child3_dob" id="m_child3_dob" class="native_date_picker" placeholder="Date of Birth" value="<?php if(isset($this->session->userdata['user_input']['child3_dob']))
                    																						{
                    																							echo $this->session->userdata['user_input']['child3_dob'];
                    																						}else 
                    																						{			 
                    																							echo set_value('mobile_child3_dob');
                    																						}?>" required>
                  </label>
                </div>
                </label>
              </div>
            </div>
            <div class="">
              <div class="desk_gen">
                <div class="form-group car-ins col-md-6">
                  <div class="cus_border form-control ">
                    <label class="gen_text" for="signup-first-name">Gender</label>
                    <label title1="Male" class="selection-confirm">
                    <label class="input gen_r rm">
                    <input type="radio" name="child3_gender" id="child3_gender" class="css-checkbox ">
                    <label for="radio4" class="css-label a radGroup2"></label>
                    <i class="icon-append nob fa fa-male"></i>
                    </label>
                    </label>
                    <label title1="Female" class="selection-confirm">
                    <label class="input gen_r">
                    <input type="radio" name="child3_gender" id="child3_gender" class="css-checkbox">
                    <label for="radio4" class="css-label a radGroup2 ss"></label>
                    <i class="icon-append fa fa-female"></i>
                    </label>
                    </label>
                  </div>
                </div>
              </div>
              <div class="mob_gen" style="display:none;">
                <div class="form-group car-ins col-md-6">
                  <div class="cus_border form-control1 ">
                    <div id="myToggle3" class="slider-toggle-container" style="float: left" data-initialvalue="1" data-height="34" data-width="175" data-ballwidth="87.5" data-ballwheight="34" data-tabindex="undefined" data-speed="550">
                      <label for="leftInput"></label>
                      <input id="leftInput" type="radio" name="child3_gender" value="1">
                      <label for="rightInput"></label>
                      <input id="rightInput" type="radio" name="child3_gender" value="0">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php if(isset($this->session->userdata['user_input']['plan_type']) && in_array($this->session->userdata['user_input']['plan_type'],array('2A4C','1A4C'))){
        	$display_child4 = "style=''";
        		
              } 
              else
			  {
			  	$display_child4 = "style='display:none;'";
			  }       
        ?>
          <div class=" " id="four_c" <?php echo $display_child4;?>>
            <div style="padding-left:0px;" class="col-md-12">
              <p>Child 4:</p>
            </div>
            <div class="form-group car-ins col-md-6">
              <input type="text" class="mob_cal m_cust" name="m_child4_dob1" id="m_child4_dob1" autocomplete="off" placeholder="Date of Birth">
              <div class="section">
                <label class="field prepend-icon">
                <label class="sr-only" for="signup-first-name">Date Of Birth</label>
                <div class="desk_cal">
                  <label class="input" style="position:relative"> <i class="icon-append fa fa-calendar " id="trigger5"></i>
                    <input type="text" name="desktop_child4_dob" id="child4_dob" class="form-control cal"  placeholder="Date of Birth" value="<?php if(isset($this->session->userdata['user_input']['child4_dob']))
                    																						{
                    																							echo $this->session->userdata['user_input']['child4_dob'];
                    																						}else 
                    																						{			 
                    																							echo set_value('desktop_child4_dob');
                    																						}?>" required>
                  </label>
                </div>
                <div class="mob_cal">
                  <label class="input form-control" style="position:relative"> <i class="icon-append fa fa-calendar "></i>
                    <input type="date" name="mobile_child4_dob" id="m_child4_dob" class="native_date_picker" placeholder="Date of Birth" value="<?php if(isset($this->session->userdata['user_input']['child4_dob']))
                    																						{
                    																							echo $this->session->userdata['user_input']['child4_dob'];
                    																						}else 
                    																						{			 
                    																							echo set_value('mobile_child4_dob');
                    																						}?>" required>
                  </label>
                </div>
                </label>
              </div>
            </div>
            <div class="">
              <div class="desk_gen">
                <div class="form-group car-ins col-md-6">
                  <div class="cus_border form-control ">
                    <label class="gen_text" for="signup-first-name">Gender</label>
                    <label title1="Male" class="selection-confirm">
                    <label class="input gen_r rm">
                    <input type="radio" name="child4_gender" id="child4_gender" class="css-checkbox ">
                    <label for="radio4" class="css-label a radGroup2"></label>
                    <i class="icon-append nob fa fa-male"></i>
                    </label>
                    </label>
                    <label title1="Female" class="selection-confirm">
                    <label class="input gen_r">
                    <input type="radio" name="child4_gender" id="child4_gender" class="css-checkbox">
                    <label for="radio4" class="css-label a radGroup2 ss"></label>
                    <i class="icon-append fa fa-female"></i>
                    </label>
                    </label>
                  </div>
                </div>
              </div>
              <div class="mob_gen" style="display:none;">
                <div class="form-group car-ins col-md-2">
                  <div class="cus_border form-control1 ">
                    <div id="myToggle4" class="slider-toggle-container" style="float: left" data-initialvalue="1" data-height="34" data-width="175" data-ballwidth="87.5" data-ballwheight="34" data-tabindex="undefined" data-speed="550">
                      <label for="leftInput"></label>
                      <input id="leftInput" type="radio" name="child4_gender" value="1">
                      <label for="rightInput"></label>
                      <input id="rightInput" type="radio" name="child4_gender" value="0">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="cus_cont">
        <div class="" style="width:100%; float:left">
          <div class="checkbox">
            <label>
            <input id="Field4" 	type="checkbox"	 name="agree"  class="field checkbox"  value="agree" checked="checked" />
            <label class="" for="Field4">I authorize MyInsuranceClub &amp; its partners to Call/SMS for my application &amp; agree to the <a href="" class="link">Terms of Use</a>.</label>
          </div>
          <div class="form-group col-md-2 pad_right_no" style="float:right"> 
            <!-- <input name="submit" class="btn btn-primary my" type="submit" id="sub_form" value="Show My Options &gt;">
             -->
            <button name="submit" class="btn btn-primary my" type="submit" id="sub_form" value="submit">Show plans<i class="fa fa-chevron-right ar "></i> </button>
            <div class="load_spin"><img src="<?php echo base_url();?>/assets/images/ajax-loader.gif"></div>
          </div>
        </div>
      </div>
      <?php echo form_close();?>
      <div class="cus_cont" style=" ">
        <div style="margin-top: 40px; float: left; width:100%;" class="">
          <div class="pos1" >
            <div class="col-md-2 c_o">
              <p><img src="<?php echo base_url();?>/assets/images/star.png" border="0" class="mar-r8">Cashless claims </p>
            </div>
            <div class="col-md-2 c_t">
              <p><img src="<?php echo base_url();?>/assets/images/star.png" border="0" class="mar-r8">Lifetime renewal</p>
            </div>
            <div class="col-md-2 c_th">
              <p><img src="<?php echo base_url();?>/assets/images/star.png" border="0" class="mar-r8">Tax benefits</p>
            </div>
            <div class="col-md-2 c_f" >
              <p><img src="<?php echo base_url();?>/assets/images/star.png" border="0" class="mar-r8">Free health checkups</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<div class="b-top"></div>
<section id="feature-pannels" style="opacity: 1; bottom: 0px;" class="moving">
  <div class="container ">
    <ul class="pannels">
      <li class="col-md-4">
        <div class="info">
          <h1 class="primary">Fast</h1>
          <div class="text orange-hover">In just a few seconds, we will display premiums from different insurance companies. <br>
            <a href="javascript:void(0)" title="">Quick comparison </a> </div>
        </div>
      </li>
      <li class="col-md-4">
        <div class="info">
          <h1 class="primary">Un-biased</h1>
          <div class="text orange-hover">We display premiums from all insurance companies partnered with us. No one is left out! <br>
            <a href="javascript:void(0)" title="">Fair comparison</a> </div>
        </div>
      </li>
      <li class="col-md-4">
        <div class="info">
          <h1 class="primary">Saves Money</h1>
          <div class="text orange-hover">By comparing plans with us you can save a large amount of money every year. <br>
            <a href="javascript:void(0)" title="">Money saver</a> </div>
        </div>
      </li>
    </ul>
  </div>
</section>
<div class="b-top"></div>
<section class="nav-tabs-simple"> 
  <!-- Nav tabs -->
  <div class="container ">
    <div class="tab-content  mar-70">
      <div class="tab-pane fade in active" id="htmlcss">
        <article class="row">
          <div class="col-md-5 col-sm-5 fadeInLeft visible"> <img class="img-responsive" src="<?php echo base_url();?>/assets/images/why1.jpg" alt=""></div>
          <div class="col-md-7 col-sm-6 text-left fadeInRight visible">
            <h6>Benefits of Comparing Health Insurance with us?</h6>
            <p>Health expenses are increasing considerably each day and so are the health risks. With a wide array of health insurance policies, the task of choosing the best health insurance policy for your needs can be quite tough and confusing.
              At MyInsuranceClub we provide you with comparative health insurance quotes to select the best health insurance policy in a quick and simplified manner. You can also compare features of different health insurance policies to check the <span class="highlight">best health insurance policy</span> for your requirements. 
              
              .</p>
            <ul class="sub-list noli" style="padding:0px;">
              <li><i class="fa fa-slack fa-2"></i>With our <span class="highlight">instant online calculator</span>, you can compare health  insurance premiums easily</li>
              <li><i class="fa fa-slack fa-2"></i>With the plan features, you do get the <span class="highlight">Best Health Insurance Comparison</span></li>
              <li><i class="fa fa-slack fa-2"></i>Yes, we are <span class="highlight">Completely Un-biased</span> in our comparison</li>
              <li><i class="fa fa-slack fa-2"></i>MyInsuranceClub does this for you at no cost - <span class="highlight">It's Free!</span> </li>
            </ul>
          </div>
        </article>
      </div>
    </div>
    <article class="node-2 node node-page view-mode-full clearfix">
      <div class="col-md-12">
        <ul class="bxslider">
          <li>
            <div class="field field-name-body field-type-text-with-summary field-label-hidden">
              <div class="field-items">
                <div class="field-item even">
                  <p><strong><img src="<?php echo base_url();?>/assets/images/left_t.jpg" border="0" class="top_i">&nbsp;&nbsp;Thank you once again for your free and very valuable information on 
                    insurance. Best wishes to your team and keep up the good work!&nbsp;&nbsp;</strong></p>
                  <p class="col-md-12 aln_right">- Pravin Bhandare, Bangalore</p>
                </div>
              </div>
            </div>
          </li>
          <li>
            <div class="field field-name-body field-type-text-with-summary field-label-hidden">
              <div class="field-items">
                <div class="field-item even">
                  <p><strong><img src="<?php echo base_url();?>/assets/images/left_t.jpg" border="0" class="top_i">&nbsp;&nbsp;I was looking for a term plan and it was tough choosing the right one as there were too many choices. I am glad that you helped patiently.&nbsp;&nbsp;</strong></p>
                  <p class="col-md-12 aln_right">- Anita Viswas, Mumbai</p>
                </div>
              </div>
            </div>
          </li>
          <li>
            <div class="field field-name-body field-type-text-with-summary field-label-hidden">
              <div class="field-items">
                <div class="field-item even">
                  <p><strong><img src="<?php echo base_url();?>/assets/images/left_t.jpg" border="0" class="top_i">&nbsp;&nbsp;This is cool. Usually go with the options provided by my car dealer for my car insurance. Spending a few minutes here save me money.&nbsp;&nbsp;</strong></p>
                  <p class="col-md-12 aln_right">- Arun Kumar, Chennai</p>
                </div>
              </div>
            </div>
          </li>
          <li>
            <div class="field field-name-body field-type-text-with-summary field-label-hidden">
              <div class="field-items">
                <div class="field-item even">
                  <p><strong><img src="<?php echo base_url();?>/assets/images/left_t.jpg" border="0" class="top_i">&nbsp;&nbsp;Fun, non-intrusive and informative. Your health insurance comparison is great. It would have been better if you can recommend plans also.&nbsp;&nbsp;</strong></p>
                  <p class="col-md-12 aln_right">- Abhinav Kumar, New Delhi</p>
                </div>
              </div>
            </div>
          </li>
        </ul>
      </div>
    </article>
  </div>
</section>
<div class="container">
  <div class="noscript accordion closed">
    <h5>What is Health Insurance?</h5>
    <div>Health Insurance, also known as Mediclaim in India,  is a form of insurance which covers the expenses incurred on medical treatment and hospitalisation. It covers the policyholder against any financial constraints arising from medical emergencies. In case of sudden hospitalisation, illness or accident, health insurance takes care of the expenses on medicines, oxygen, ambulance, blood, hospital room, various medical tests and almost all other costs involved. By paying a small premium every year, you can ensure that any big medical expenses, if incurred, will not burn a hole in your pocket. The plan can be taken for an individual or for your family as a Family Floater Health Insurance Plan. </div>
  </div>
  <div class="loading"></div>
  <div class="noscript accordion closed nn">
    <h5>Major Benefits in a Health Insurance Policy</h5>
    <div class="" style="min-height:300px; float:left; width:100%;"> <span class="" style="min-height:200px; float:left; width:100%; margin-top:0px;">
      <div  class="col-md-4 ">
        <h3>Cashless facility</h3>
        <p>Each health insurance company ties up with a large number of hospitals to provide cashless health insurance facility. If you are admitted to any of the network hospitals, you would not have to pay the expenses from your pocket. In case the hospital is not part of the network, you will have to pay the hospital and the insurance company will reimburse the costs to you later. </p>
      </div>
      <div  class="col-md-4">
        <h3>Pre-hospitalisation expenses</h3>
        <p>In case you have incurred treatment costs for the ailment for which you later get admitted to a hospital, the insurance company will bear those costs also. Usually the payout is for costs incurred between 30 to 60 days before hospitalisation.</p>
      </div>
      <div  class="col-md-4 ">
        <h3>Hospitalisation Expenses </h3>
        <p>Costs incurred if a policyholder is admitted to the hospital for more than 24 hours are covered by the health insurance plan. </p>
      </div>
      </span> <span class="" style="min-height:130px; float:left; width:100%;">
      <div  class="col-md-4 ">
        <h3>Post-hospitalisation expenses </h3>
        <p>Even after you are discharged from the hospital, you will incur costs during the recovery period. Most mediclaim policies will cover the expenses incurred 60 to 90 days after hospitalisation. </p>
      </div>
      <div  class="col-md-4">
        <h3>Day Care Procedure Expenses</h3>
        <p>Due to advancement in technology some of the treatments no more require a 24 hours of hospitalisation. Your health insurance policy will cover the costs incurred for these treatments also. </p>
      </div>
      <div  class="col-md-4">
        <h3>Ambulance Charges</h3>
        <p>In most cases the ambulance charges are taken up by the policy and the policy holder usually doesn't have to bear the burden of the same.</p>
      </div>
      </span> <span class="" style="min-height:200px; float:left; width:100%;">
      <div  class="col-md-4">
        <h3>Cover for Pre-existing Diseases</h3>
        <p>Health insurance policies have a facility of covering pre-existing diseases after 3 or 4 years of continuously renewing the policy, i.e. if someone has diabetes, then after completion of 3 or 4 years of continuous renewal with the same insurer (depending on the plan offered and his age), any hospitalisation due to diabetes will also be covered..</p>
      </div>
      <div  class="col-md-4">
        <h3>Tax Benefits</h3>
        <p>The premiums paid for a Health Insurance Policy are exempted for Under Section 80D of the Income Tax Act. Income tax benefit is provided to the customer for the premium amount till a maximum of Rs. 15,000 for regular and Rs. 20,000 for senior citizen respectively.</p>
      </div>
      <div  class="col-md-4 ">
        <h3>No-Claim Bonus</h3>
        <p>If there has been no claim in the previous year, a benefit is passed on to the policyholder, either by reducing the premium or by increasing the sum assured by a certain percentage of the existing premium. </p>
      </div>
      </span> <span class="" style="min-height:100px; float:left; width:100%;">
      <div  class="col-md-4">
        <h3>Health Check-Up</h3>
        <p>Some health insurance policies have a facility of free health check-up for the well being of the individual if there is no claim made for certain number of years.</p>
      </div>
      <div  class="col-md-4 ">
        <h3>Organ Donor Expenses</h3>
        <p>The medical expenses incurred in harvesting the organ for a transplant is paid by the policy. </p>
      </div>
      </span> </div>
  </div>
  <div class="loading"></div>
</div>
<div class="container   margin-bottom-large">
  <div  class="col-md-6 mar-25">
    <div class="top_ins"></div>
    <h3 class="header_art">Articles on Health Insurance</h3>
    <div class="art_cnt widget ">
      <h4 class="sub_h">How to secure your future with pension</h4>
      <div class="textwidget">
        <p><img style="border: 0px none;" alt="" src="<?php echo base_url();?>/assets/images/art1.jpg" >At any moment, an unhappy customer can share their opinion with the masses through...How to speak with an Indian Accent. </p>
      </div>
      <div class="comnt"> <span class="text-left l">1,348 views</span> <span class="text-right r">0 comments</span> </div>
    </div>
    <div class="art_cnt widget ">
      <h4 class="sub_h">How to secure your future with pension</h4>
      <div class="textwidget">
        <p><img style="border: 0px none;" alt="" src="<?php echo base_url();?>/assets/images/art1.jpg" >At any moment, an unhappy customer can share their opinion with the masses through...How to speak with an Indian Accent. </p>
      </div>
      <div class="comnt"> <span class="text-left l">1,348 views</span> <span class="text-right r">0 comments</span> </div>
    </div>
    <div class="art_cnt widget ">
      <h4 class="sub_h">How to secure your future with pension</h4>
      <div class="textwidget">
        <p><img style="border: 0px none;" alt="" src="<?php echo base_url();?>/assets/images/art1.jpg" >At any moment, an unhappy customer can share their opinion with the masses through...How to speak with an Indian Accent. </p>
      </div>
      <div class="comnt"> <span class="text-left l">1,348 views</span> <span class="text-right r">0 comments</span> </div>
    </div>
    <div class="col-md-12 text-rightp"><a href="javascript:void(0)">More Articles <span class="ic">+</span></a></div>
  </div>
  <div  class="col-md-6 mar-25">
    <div class="top_ins"></div>
    <h3 class="header_art">Guides on Health Insurance</h3>
    <div class="art_cnt widget ">
      <h4 class="sub_h">How to secure your future with pension</h4>
      <div class="textwidget">
        <p><img style="border: 0px none;" alt="" src="<?php echo base_url();?>/assets/images/news1.jpg" >At any moment, an unhappy customer can share their opinion with the masses through...How to speak with an Indian Accent. </p>
      </div>
      <div class="comnt"> <span class="text-left l">1,348 views</span> <span class="text-right r">0 comments</span> </div>
    </div>
    <div class="art_cnt widget ">
      <h4 class="sub_h">Which is the best child plan?</h4>
      <div class="textwidget">
        <p><img style="border: 0px none;" alt="" src="<?php echo base_url();?>/assets/images/news2.jpg" >At any moment, an unhappy customer can share their opinion with the masses through...How to speak with an Indian Accent. </p>
      </div>
      <div class="comnt"> <span class="text-left l">1,348 views</span> <span class="text-right r">0 comments</span> </div>
    </div>
    <div class="art_cnt widget ">
      <h4 class="sub_h">Benefits of investing early</h4>
      <div class="textwidget">
        <p><img style="border: 0px none;" alt="" src="<?php echo base_url();?>/assets/images/news3.jpg" >At any moment, an unhappy customer can share their opinion with the masses through...How to speak with an Indian Accent. </p>
      </div>
      <div class="comnt"> <span class="text-left l">1,348 views</span> <span class="text-right r">0 comments</span> </div>
    </div>
    <div class="col-md-12 text-rightp"><a href="javascript:void(0)">More Guides <span class="ic">+</span></a></div>
  </div>
</div>
<script type="text/javascript" src="<?php echo base_url();?>/assets/js/intro.js"></script>
    <script type="text/javascript">
	startIntro();
      function startIntro(){
        var intro = introJs();
          intro.setOptions({
            steps: [
              
              {
                element: document.querySelector('#step1'),
                intro: "Compare & Buy Health Insurance Plans"
              },
              {
                element: document.querySelectorAll('#rs')[0],
                intro: "Choose amount of cover",
                position: 'right'
              },
              {
                element: '#c_for',
                intro: 'Choose for whom?',
                position: 'left'
              },
              {
                element: '#ge',
                intro: "Select Gender.",
                position: 'bottom'
              },
              {
                element: '#loc',
                intro: 'Select Location.'
              },
			   {
                element: '#sub_form',
                intro: 'OH ! Yes. I Got it.'
              }
            ]
          });

          intro.start();
      }
    </script>
<?php //$this->load->view('partial_view/footer_new'); ?>
