      <link rel="stylesheet" href="<?php echo base_url();?>/assets/css/travel.css">
<div class="min_height" style="height:auto; width:100%; ">
  <div id="highlighted "  class="" >
  <!--<div class="id-shell-background"><div class="background-container"><div style="background-image: url(https://ssl.gstatic.com/compare/rsrcs/static/insurance/20140730-112226-RC5//images/common/uktravelinsurance/edit_background.jpg);" class="edit-background"></div></div></div>-->
    <div class="container">
      <div class="col-md-12 center ">
        <div class="col-md-1"></div>
        <h1 class="travel_container" style="text-align:left; margin-top:30px;" id="step1">Compare & Buy Travel Insurance Plans</h1>
        <div class="col-md-12">
          <p class="travel_container" style="text-align:left; padding-top:10px; padding-bottom:25px;">Choose from 56 plans from 18 companies</p>
<!--           <p class="col-md-11 start_icon"> <img src="assets/images/start2.png" ></p> 
-->        </div>
        
        <div class="col-md-12">
          <p class="travel_container sc_top" style="text-align:left; padding-top:50px; padding-bottom:10px; color:#ff6633;">Get Started...</p>
        </div>
        
      </div>
      <div class="col-md-12 center">
        <div class="travel_container travel_mic">
          <!-- form  method="post"  class="travel_form"> -->
          <?php echo form_open('travel-insurance/search-results',array('id'=>'travel_form','class'=>'travel_form'));?>
            <div class="t_section t_ca">
              <div class="">
                <div class="mic_type mic_section">
                  <div class="form-lable">What type of cover do you want?</div>
                  <div class="travel_hlp"><a class="t_h_btn aa  fa fa-info-circle" href="javascript:void(0)"></a></div>
                  <div class="mic_t_input">
                    <div class=" mic_t_b_panel">
                      <div id="single_t" class="mic_btn_in mic_btn_tl mic_btn_tl_one s-b mic_btn_tl_c_r"  style="width: 33.33%;cursor: pointer;">
                        <div class="mic_icon">
                          <div class="mic_i_mar t_single_trip"></div>
                          <div class="mic_i_btm">Single trip</div>
                        </div>
                      </div>
                      <div id="mul_t" class="mic_btn_in mic_btn_tl mic_btn_tl_one s-b mic_btn_tl_c_l mic_btn_tl_c_r"  style="width: 33.33%;cursor: pointer;">
                        <div class="mic_icon">
                          <div class="mic_i_mar t_mul_trip"></div>
                          <div class="mic_i_btm">Annual multi-trip</div>
                        </div>
                      </div>
                      <div id="stu_t" class="mic_btn_in mic_btn_tl mic_btn_tl_one s-b mic_btn_tl_c_l"  style="width: 33.33%;cursor: pointer;">
                        <div class="mic_icon">
                          <div class="mic_i_mar t_student_trip"></div>
                          <div class="mic_i_btm">Student travel</div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="error-text" style="display: none;"></div>
                </div>
              </div>
            </div>
            <div style="display:none" class="travel_form_s">
              <div class="t_section t_ca" >
                <div class="t_mul_help_text" ></div>
                <div class="mic_cntry">
                  <div class="mic_sec_label" >
                    <div>
                      <div class="mic_type mic_section">
                        <div class="form-lable">Where are you going?</div>
                        <div class="travel_hlp"><a class="t_h_btn  fa fa-info-circle toll_a" href="javascript:void(0)"></a></div>
                        <div class="mic_t_input">
                          <div class=" mic_t_b_panel">
                            <div  class="where_go_a mic_btn_in mic_btn_tl mic_btn_tl_one s-b mic_btn_tl_c_r "  id = "including_usa_canada" style="width: 25%;cursor: pointer;">
                              <div class="mic_icon">
                                <div class="mic_i_mar world_usa"></div>
                                <div class="mic_i_btm">Worldwide<br/>
                                  <span class="trip_location">Including USA/Canada</span></div>
                              </div>
                            </div>
                            <div class="where_go_b mic_btn_in mic_btn_tl mic_btn_tl_one s-b mic_btn_tl_c_l mic_btn_tl_c_r"  id = "excluding_usa_canada" style="width: 25%;cursor: pointer;">
                              <div class="mic_icon">
                                <div class="mic_i_mar world_not_usa"></div>
                                <div class="mic_i_btm">Worldwide<br/>
                                  <span class="trip_location">Excluding USA/Canada</span></div>
                              </div>
                            </div>
                            <div class="where_go_c mic_btn_in mic_btn_tl mic_btn_tl_one s-b mic_btn_tl_c_l mic_btn_tl_c_r"  id = "Schengen" style="width: 25%;cursor: pointer;">
                              <div class="mic_icon">
                                <div class="mic_i_mar schengen"></div>
                                <div class="mic_i_btm trip_location" style="padding-top: 15px;padding-bottom:1px;">Schengen Countries</div>
                              </div>
                            </div>
                            <div class="where_go_d rest mic_btn_in mic_btn_tl mic_btn_tl_one s-b mic_btn_tl_c_l mic_btn_tl_clr_ol"  id = "Asia" style="width: 25%;cursor: pointer;">
                              <div class="mic_icon">
                                <div class="mic_i_mar asia"></div>
                                <div class="mic_i_btm trip_location"  style="padding-top: 15px; padding-bottom:1px;">Asia</div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="error-text" style="display: none;"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="t_section t_ca">
                <div class="trip-start-date">
                  <div class="mic_type mic_section">
                    <div class="form-lable">When are you going?</div>
                    <div class="travel_hlp"><a class="t_h_btn  fa fa-info-circle toll_b" href="javascript:void(0)"></a></div>
                    <div class="mic_t_input">
                      <div class=" mic_t_b_panel">
                        <div class="mic_btn_in mic_btn_tl mic_btn_tl_one s-b mic_btn_tl_c_r w_ga"  id="today" style="width: 25%;cursor: pointer;">
                          <div class="mic_icon">
                            <div class="mic_top_text w_today"></div>
                            <div class="mic_i_btm ">Today</div>
                          </div>
                        </div>
                        <div class="mic_btn_in mic_btn_tl mic_btn_tl_one s-b mic_btn_tl_c_l mic_btn_tl_c_r w_gb"  id="tomorrow" style="width: 25%;cursor: pointer;">
                          <div class="mic_icon">
                            <div class="mic_top_text w_tommorow"></div>
                            <div class="mic_i_btm ">Tomorrow</div>
                          </div>
                        </div>
                        <div class="mic_btn_in mic_btn_tl mic_btn_tl_one s-b mic_btn_tl_c_l mic_btn_tl_c_r w_gc"  id="in2days" style="width: 25%;cursor: pointer;">
                          <div class="mic_icon">
                            <div class="mic_top_text w_in_two_day">In 2 days</div>
                            <div class="mic_i_btm ">In 2 days</div>
                          </div>
                        </div>
                        <div class="mic_btn_in mic_btn_tl mic_btn_tl_one s-b mic_btn_tl_c_l mic_btn_tl_clr_ol w_gd"  style="width: 25%;cursor: pointer;">
                          <div class="mic_icon">
                            <div class="mic_i_mar calendar-start-button-icon"></div>
                            <div class="mic_i_btm" style="margin-top:13px;">Other</div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="error-text" style="display: none;"></div>
                  </div>
                </div>
                <div class="trip-start-date-picker">
                  <div class="date-picker mic_sec_label" style="display: none;">
                    <div class="mic_t_input">
                      <input type="text" class="id-date-picker-input date-picker-input " value="" placeholder="DD/MM/YYYY" aria-label="DD/MM/YYYY" maxlength="10" >
                    </div>
                    <div class="start_datepicker" style="position:absolute; top:17px;"> </div>
                  </div>
                </div>
                <div class="travel_end_date trip-end-date">
                  <div class="mic_type mic_section" >
                    <div class="form-lable">When will you be returning?</div>
                    <div class="travel_hlp" style="display: block;"><a class="t_h_btn fa fa-info-circle toll_away" href="javascript:void(0)"></a></div>
                    <div class="mic_t_input">
                      <div class=" mic_t_b_panel">
                        <div class="mic_btn_in mic_btn_tl mic_btn_tl_one s-b mic_btn_tl_c_r n_a"  id="7_nights" style="width: 25%;cursor: pointer;">
                          <div class="mic_icon">
                            <div class="mic_top_text"></div>
                            <div class="mic_i_btm">7 nights</div>
                          </div>
                        </div>
                        <div class="mic_btn_in mic_btn_tl mic_btn_tl_one s-b mic_btn_tl_c_l mic_btn_tl_c_r n_b"  id="10_nights" style="width: 25%;cursor: pointer;">
                          <div class="mic_icon">
                            <div class="mic_top_text"></div>
                            <div class="mic_i_btm">10 nights</div>
                          </div>
                        </div>
                        <div class="mic_btn_in mic_btn_tl mic_btn_tl_one s-b mic_btn_tl_c_l mic_btn_tl_c_r n_c"  id="14_nights" style="width: 25%;cursor: pointer;">
                          <div class="mic_icon">
                            <div class="mic_top_text"></div>
                            <div class="mic_i_btm">14 nights</div>
                          </div>
                        </div>
                        <div class="mic_btn_in mic_btn_tl mic_btn_tl_one s-b mic_btn_tl_c_l n_d"  style="width: 25%;cursor: pointer;">
                          <div class="mic_icon">
                            <div class="mic_i_mar calendar-end-button-icon"></div>
                            <div class="mic_i_btm" style="margin-top:13px;">Other</div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="error-text" style="display: none;"></div>
                  </div>
                </div>
                <div class="trip-end-date-picker" id="demoContainer">
                  <div class="date-picker mic_sec_label" style="display: none;"  id="demo">
                    <div class="mic_t_input">
                      <div class="id-calendar-icon calendar-icon "></div>
                      <input type="text" class="id-date-picker-input date-picker-input " value="" placeholder="DD/MM/YYYY" aria-label="DD/MM/YYYY" maxlength="10" >
                    </div>
                    <div class="end_datepicker" style="position:absolute; top:17px;"> </div>
                  </div>
                </div>
              </div>
              <div class="t_section t_ca" style="padding-bottom:70px;">
                <div class="mic_travel_insure">
                  <div class="mic_type mic_section">
                    <div class="form-lable">Whom do you want to cover?</div>
                    <div class="travel_hlp"><a class="t_h_btn  fa fa-info-circle toll_d" href="javascript:void(0)"></a></div>
                    <div class="mic_t_input">
                      <div class="mic_t_b_panel">
                        <div class="mic_btn_in mic_btn_tl mic_btn_tl_one s-b mic_btn_tl_c_r insure_a"  id="1A" style="width:33.33%;cursor: pointer;">
                          <div class="mic_icon">
                            <div class="mic_i_mar individual_icon"></div>
                            <div class="mic_i_btm">Individual</div>
                          </div>
                        </div>
                        <div class="mic_btn_in mic_btn_tl mic_btn_tl_one s-b mic_btn_tl_c_l mic_btn_tl_c_r insure_b"  id="2A" style="width: 33.33%;cursor: pointer;">
                          <div class="mic_icon">
                            <div class="mic_i_mar couple-icon"></div>
                            <div class="mic_i_btm">Couple</div>
                          </div>
                        </div>
                        <div class="mic_btn_in mic_btn_tl mic_btn_tl_one s-b mic_btn_tl_c_l mic_btn_tl_c_r insure_c"  id="family"style="width: 33.33%;cursor: pointer;">
                          <div class="mic_icon">
                            <div class="mic_i_mar family-icon"></div>
                            <div class="mic_i_btm">Family</div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="error-text" style="display: none;"></div>
                  </div>
                </div>
                <div class="mic_travel_family_section" >
                  <div >
                    <div >
                      <div class="member-header"></div>
                      <div>
                        <div style="width:50%; float:left;">
                          <div class="family_section_header ">Your date of birth</div>
                          <div class="family_section ">
                            <div class="individual_icon inline-block"></div>
                            <div class="birth-date">
                              <div class="mic_sec_label mic_sec_label_cntrl">
                                <div class="mic_t_input"><span class=" mic_sec_day_cntrl">
                                  <div class="mic_sec_label">
                                    <div class="mic_t_input ">
                                      <input type="text" class="mic_t_input mic_e_input t_dd id" style="margin-right:10px;" placeholder="DD" aria-label="DD" maxlength="2" name="cust_birth_day">
                                      <input type="text" class="mic_t_input mic_e_input t_mm id" style="margin-right:10px; width:36px;"  placeholder="MM" aria-label="MM" maxlength="2" name="cust_birth_month">
                                      <input type="text" class="mic_t_input t_yy mic_e_input" style="width:48px;" placeholder="YYYY" aria-label="YYYY" maxlength="4" name="cust_birth_year">
                                    </div>
                                    <div class="error-text" style="display: none;"></div>
                                  </div>
                                  </span> </div>
                                <div class="travel_hlp"><a class="t_h_btn  fa fa-info-circle toll_e" href="javascript:void(0)"></a></div>
                              </div>
                            </div>
                          </div>
                          <!--          <div class="error-text" style="display: none;"></div>
--> </div>
                        <div class="id-cus-gender" style="display:inline-block;width: 50%;">
                          <div class="family_section_header ">Your Gender</div>
                          <div style="width: 100%; margin-top:10px;" class="mic_t_input">
                            <div class=" mic_t_b_panel">
                              <div style="width:33.33%;" aria-pressed="true" class="mic_btn_in mic_btn_tl mic_btn_tl_one s-b mic_btn_tl_c_r gen_but_m">
                                <div class="mic_icon" style="padding: 5px 0px;cursor: pointer;">
                                  <div class="mic_i_mar male" style="float: left; margin-top: 2px;"></div>
                                  <div class="mic_i_btm" style="margin-top: 5px;padding-bottom: 5px;">Male</div>
                                </div>
                              </div>
                              <div style="width: 33.33%;"  class="mic_btn_in mic_btn_tl mic_btn_tl_one s-b mic_btn_tl_c_l mic_btn_tl_c_r gen_but_f">
                                <div class="mic_icon" style="padding: 5px 0px;cursor: pointer;">
                                  <div class="mic_i_mar female" style="float: left; margin-top: 3px;"></div>
                                  <div class="mic_i_btm" style="margin-top: 5px;padding-bottom: 5px;">Female</div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div id="TextBoxesGroup">
                          <div  id="TextBoxDiv1">
                            <div class="add_traveller" style="display:none;">
                              <div style="width:50%; float:left;">
                                <div class="family_section_header">Spouse's date of birth</div>
                                <div class="family_section">
                                  <div class="individual_icon inline-block"></div>
                                  <div class="birth-date">
                                    <div class="mic_sec_label mic_sec_label_cntrl">
                                      <div class="mic_t_input"><span class="mic_sec_day_cntrl">
                                        <div class="mic_sec_label">
                                          <div class="mic_t_input ">
                                            <input type="text" class="mic_t_input mic_e_input  id" style="margin-right:10px;" placeholder="DD" aria-label="DD" maxlength="2" name="spouse_birth_day">
                                            <input type="text" class="mic_t_input mic_e_input  id" style="margin-right:10px; width:36px;"  placeholder="MM" aria-label="MM" maxlength="2" name="spouse_birth_month">
                                            <input type="text" class="mic_t_input mic_e_input " style="width:48px;" placeholder="YYYY" aria-label="YYYY" maxlength="4" name="spouse_birth_year">
                                          </div>
                                          <div class="error-text" style="display: none;"></div>
                                        </div>
                                        </span></div>
                                    </div>
                                  </div>
                                </div>
                                <!--          <div class="id-member-error-text error-text" style="display: none;"></div>
--> </div>
                              <div class="id-cus-gender-spouce" style="display:inline-block;width: 50%;">
                                <div class="family_section_header ">Spouse Gender</div>
                                <div style="width: 100%; margin-top:10px;" class="mic_t_input">
                                  <div class=" mic_t_b_panel">
                                    <div style="width:33.33%;" aria-pressed="true" class="mic_btn_in mic_btn_tl mic_btn_tl_one s-b mic_btn_tl_c_r gen_but_spouce_m">
                                      <div class="mic_icon" style="padding: 5px 0px; cursor: pointer;">
                                        <div class="mic_i_mar male" style="float: left; margin-top: 2px;"></div>
                                        <div class="mic_i_btm" style="margin-top: 5px;padding-bottom: 5px;">Male</div>
                                      </div>
                                    </div>
                                    <div style="width: 33.33%;"  class="mic_btn_in mic_btn_tl mic_btn_tl_one s-b mic_btn_tl_c_l mic_btn_tl_c_r gen_but_spouce_f">
                                      <div class="mic_icon" style="padding: 5px 0px; cursor: pointer;">
                                        <div class="mic_i_mar female" style="float: left; margin-top: 3px;"></div>
                                        <div class="mic_i_btm" style="margin-top: 5px;padding-bottom: 5px;">Female</div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="mic_sec_label add_more_member"  style="display:none;">
                      <div class="add-member-button" style="cursor: pointer;">
                        <div id="addButton" class="mic_btn_in mic_btn_tl mic_btn_tl_one"  >
                          <div class="btn_title">+ add traveller</div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              	<div>
              	
              	<input type="hidden" name="trip_type" id="trip_type" value="" />
              	<input type="hidden" name="trip_location" id="trip_location" value="" />
              	<input type="hidden" name="trip_start" id="trip_start" value="" />
              	<input type="hidden" name="trip_end" id="trip_end" value="" />
              	<input type="hidden" name="cust_gender" id="cust_gender" value="" />
              	<input type="hidden" name="spouse_gender" id="spouse_gender" value="" />
              	<input type="hidden" name="product_type" id="product_type" value="Travel Insurance" />
              	<input type="hidden" name="product_name" id="product_name" value="General Insurance" />
              	<input type="hidden" name="family_composition" id="family_composition" value="" />
              	<input type="hidden" name="family_composition_desp" id="family_composition_desp" value="" />
              	</div>
              <div class="t_section t_ca">
                <div class="title">Policyholder details</div>
                <div>
                  <div class=" travel-name-control right-spacer">
                    <div class="mic_sec_label" >
                      <div class="mic_t_input ">
                        <input type="text" class="mic_t_input mic_e_input " placeholder="Full name" aria-label="Full name" name="cust_name" value="<?php echo set_value('cust_name');?>">
                      </div>
                     
                      <div></div>
                    </div>
                  </div>
                  <div class="travel-name-control" >
                    <div class="mic_sec_label">
                      <div class="mic_t_input ">
                        <input type="text" class="mic_t_input mic_e_input " placeholder="Mobile" aria-label="Mobile" name="cust_mobile" maxlength="10">
                      </div>
                      <div class="error-text"></div>
                    </div>
                  </div>
                </div>
                <div class="travel-email-control">
                  <div class="mic_sec_label">
                    <div class="mic_t_input ">
                      <input type="text" class="mic_t_input mic_e_input " placeholder="Your email" aria-label="Your email" name="cust_email">
                    </div>
                    <div class="error-text"></div>
                  </div>
                </div>
                <div class="note_sec">
                <div class="checkbox">
            <label>
            <input id="Field4" 		name="agree" checked 		type="checkbox" 		class="field checkbox" 		value="agree"/>
            <label class="" for="Field4">I authorize MyInsuranceClub &amp; its partners to Call/SMS for my application &amp; agree to the <a href="" class="link">Terms of Use</a>.</label>
          </div>
                
                </div>
                <div class="button-panel"><span class="right-buttons"><span class="id-next-button">
                  <div style="font-weight: bold;padding: 10px 20px;">
                    <button class="btn btn-primary my" type="submit" id="sub_form" value="submit" name="submit">Show plans<i class="fa fa-chevron-right ar "></i> </button>
                  </div>
                  </span></span> </div>
              </div>
            </div>
          <!-- /form> --> <?php echo form_close();?>         
           <div class=" mic_tooltip_column">
            <div style="top: 8px;" class="mic_tooltip_message card">
              <div class="tooltip_travel_sec help-scroll" style="height: auto;">
               <p><b>Single trip:</b> Refers to a single to and fro trip from India. It could include mulitple destinations after departure from India.</p><p><b>Annual multi-trip:</b> Refers to multiple trips to and fro from India within a single year.</p><p><b>Student travel:</b> Refers to a single trip to and fro from India for students going abroad for education.</p>
              </div>
              <div class="mic_tooltip_corner" style="top: 27.5px;">
                <div class="mic_tooltip_corner_out"></div>
                <div class="mic_tooltip_corner_in"></div>
              </div>
              <a href="javascript:void(0)" class="mic_tooltip_close fa fa-times-circle"></a> </div>
          </div>
          <!--<div class="t_ca ref_y" style="visibility: visible; display:none; margin-left:100px;"> <a class="close_you fa fa-times-circle" href="javascript:void(0)"></a>
            <div class="ref_y_text"></div>
            <div class="mic_tooltip-bottom" style="left: 15px;">
              <div class="mic_tooltip-out"></div>
              <div class="mic_tooltip-in"></div>
            </div>
          </div>-->
        </div>
      </div>
      <!-- div class="cus_cont" style="display:none;">
        <div class="" style="width:100%; float:left">
          <div class="checkbox">
            <label>
            <input id="Field4" 		name="agree" checked 		type="checkbox" 		class="field checkbox" 		value="agree"/>
            <label class="" for="Field4">I authorize MyInsuranceClub &amp; its partners to Call/SMS for my application &amp; agree to the <a href="" class="link">Terms of Use</a>.</label>
          </div>
          <div class="form-group col-md-2 pad_right_no" style="float:right; ">
            <button class="btn btn-primary my" type="submit" id="sub_form" value="submit">Show plans<i class="fa fa-chevron-right ar "></i> </button>
            <div class="load_spin"><img src="assets/images/ajax-loader.gif"></div>
          </div>
        </div> >
      </div -->
     
      <div class="cus_cont" >
        <div style="margin-top: 40px; float: left; margin-bottom:80px; width:100%;" class="">
          <div class="pos1" >
            <div class="col-md-2 c_o">
              <p><img src="<?php echo base_url();?>assets/images/star.png" border="0" class="mar-r8">Global validity 24x7</p>
            </div>
            <div class="col-md-2 c_t">
              <p><img src="<?php echo base_url();?>assets/images/star.png" border="0" class="mar-r8">Medical expenses</p>
            </div>
            <div class="col-md-2 c_th">
              <p><img src="<?php echo base_url();?>assets/images/star.png" border="0" class="mar-r8">Checked-in baggage loss</p>
            </div>
            <div class="col-md-2 c_f" >
              <p><img src="<?php echo base_url();?>assets/images/star.png" border="0" class="mar-r8">Emergency cash</p>
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
          <div class="col-md-5 col-sm-5 fadeInLeft visible"> <img class="img-responsive" src="assets/images/why1.jpg" alt=""></div>
          <div class="col-md-7 col-sm-6 text-left fadeInRight visible">
            <h6>Why Compare Travel Insurance with us?</h6>
            <p>Emergency & un-planned expenses can burn a big hole in your pocket when you are travelling abroad. Not only do they take you by surprise, the charges of medical care in most countries are much higher than what you would have at hand while on a foreign trip. By paying a small amount for travel insurance, you can ensure that these surprises can be taken care of easily.<br/> At MyInsuranceClub, we will help you select the best travel insurance plan with optimum premiums so that you get the best protection while travelling. </p>
            <ul class="sub-list noli" style="padding:0px;">
<li><i class="fa fa-slack fa-2"></i>Instant premiums from a large number of insurance companies</li>
<li><i class="fa fa-slack fa-2"></i>Compare premiums and features of various plans instantly</li>
<li><i class="fa fa-slack fa-2"></i>Our comparison is completely un-biased</li>
<li><i class="fa fa-slack fa-2"></i>MyInsuranceClub does this for you at no cost - It's Free!</li>
            </ul>
          </div>
        </article>
      </div>
      
      <!--<div class="tab-pane fade in active" id="htmlcss">
        <article class="row">
          <div class="col-md-5 col-sm-5 fadeInLeft visible" > <img class="img-responsive" src="assets/images/why.jpg" alt="starbuck"> </div>
          <div class="col-md-7 col-sm-6 text-left fadeInRight visible" >
            <h6>Why Compare Insurance with Us?</h6>
            <p>We insure for peace of mind. Whether it is life insurance, health insurance, motor insurance, home insurance or any other insurance policy, we need to ensure that our assests are secure. While insurance is important, we realise that <span class="highlight">affordable insurance</span> is equally important.</p>
            <ul class="sub-list noli" style="padding:0px;">
              <li><i class="fa fa-check fa-2"></i>By comparing, you can get the <span class="highlight">best insurance policy</span> for your needs.</li>
              <li><i class="fa fa-check fa-2"></i>Save money by buying feature rich insurance plans at <span class="highlight">lower premiums</span>.</li>
              <li><i class="fa fa-check fa-2"></i>Oh yes, ours is a <span class="highlight">free service!</span> </li>
            </ul>
          </div>
        </article>
      </div>--> 
      
    </div>
    <article class="node-2 node node-page view-mode-full clearfix">
      <div class="col-md-12">
        <ul class="bxslider">
          <li>
            <div class="field field-name-body field-type-text-with-summary field-label-hidden">
              <div class="field-items">
                <div class="field-item even">
                  <p><strong><img src="assets/images/left_t.jpg" border="0" class="top_i">&nbsp;&nbsp;This was easy. Thanks! I purchased my travel insurance from your site while I was at the airport. It was quite easy and covenenient.&nbsp;&nbsp;</strong></p>
                  <p class="col-md-12 aln_right">- Parvinder Singh, Chandigarh</p>
                </div>
              </div>
            </div>
          </li>
          <li>
            <div class="field field-name-body field-type-text-with-summary field-label-hidden">
              <div class="field-items">
                <div class="field-item even">
                  <p><strong><img src="assets/images/left_t.jpg" border="0" class="top_i">&nbsp;&nbsp;Your comparison was simple and exhaustive. I found it very easy to use. I found a plan which was pretty much what I wanted to buy.&nbsp;&nbsp;</strong></p>
                  <p class="col-md-12 aln_right">- Yogesh Sharma, Kolkatta</p>
                </div>
              </div>
            </div>
          </li>
          
           <li>
            <div class="field field-name-body field-type-text-with-summary field-label-hidden">
              <div class="field-items">
                <div class="field-item even">
                  <p><strong><img src="assets/images/left_t.jpg" border="0" class="top_i">&nbsp;&nbsp;Done in 5 mins from my phone. Loved it! The premiums are indeed pretty low and the comparison helped in getting the right plan. Recommended.&nbsp;&nbsp;</strong></p>
                  <p class="col-md-12 aln_right">- Sameer Malani, Mumbai</p>
                </div>
              </div>
            </div>
          </li>
          
          <li>
            <div class="field field-name-body field-type-text-with-summary field-label-hidden">
              <div class="field-items">
                <div class="field-item even">
                  <p><strong><img src="assets/images/left_t.jpg" border="0" class="top_i">&nbsp;&nbsp;I would request everyone to get travel insurance when going abroad. It really helps when you are suddenly struck with an emergency.&nbsp;&nbsp;</strong></p>
                  <p class="col-md-12 aln_right">- Raj Sekhar Reddy, Coimbatore</p>
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
    <h5>What is Travel Insurance?</h5>
    <div>How often do you travel? Do you travel across the globe? Are you a globetrotter? Do you keep one bag eternally packed with your basic necessities because you might have to travel at any time? Your business trips only come at the last minute without much warning? 
    
    
    <p>Well, in this case have you ever had a problem like:</p>
<ul style="list-style-type:none; padding-left:0px;" class="small_i"><li><i class="fa fa-slack fa-2"></i> Your baggage was misplaced?</li>
<li><i class="fa fa-slack fa-2"></i> Your passport was stolen?</li>
<li><i class="fa fa-slack fa-2"></i> You missed your connecting flight because the previous one was delayed?</li>
<li><i class="fa fa-slack fa-2"></i> You had to be admitted into a hospital while holidaying in Dubai?</li>
<li><i class="fa fa-slack fa-2"></i> Someone from your office met with a fatal accident during your business trip to London?</li>
<li><i class="fa fa-slack fa-2"></i> Your trip had to be cancelled due to bad weather and you suffered a loss at the flight and hotel reservation?</li></ul>

<p>Travel Insurance has the solution to the all above problems. Travel Insurance means insuring the risks of having a financial loss or a medical emergency while travelling. In case of a medical emergency, your travel insurance will pay for the medical expenses incurred while undergoing treatment abroad. You do not have to worry about the exorbitant medical bills which will taken care of by the insurance company. There are other benefits of cash allowance for delayed flights and loss of baggage, theft of your belongings etc. It pretty much covers all the standard risks involved while travellign abroad.</p>
    
    </div>
  </div>
  <div class="loading"></div>
  <div class="accordion closed">
    <h5>What are the different Types fo Travel Insurance?</h5>
    <div class="" style="min-height:300px;  height:100%; width:100%;"> <span class="" style="float:left; width:100%; margin-top:0px;">
    <div  class="col-md-4 ">
        <h3>Single trip</h3>
        <p>This is for ONE single trip to and from from India. The moment you return from your trip to India, the policy is valididity is over. An example of single trip could be a leaving India for a trip to Singapre, travelling to Thailand from Singapre and then returning from Singpapore or Thailand to India.</p>
      </div>

<div  class="col-md-4 ">
        <h3>Annual multi-trip</h3>
        <p>This is more for a frequent traveller who makes multiple trips throughout the year. It is ideal for businessmen who make more than one trip in a year to specific locations. You can make as mulitple trips to an fro from India within the period of ONE year.</p>
      </div>

<div  class="col-md-4 ">
        <h3>Student travel</h3>
        <p>This is for students who are going abroad for education. A lot of universties insist on student travel insurance as the cost of medical expenses while studying in a foreign university can be quite a large sum for a student. In fact, student travel insurance is strongly recommended even if the university you are going to does not insist on it. While on an extended stay, the chances of falling ill or of a medical emergency can be quite high. This also offer some other benefits like visit of emergency family visit, bail bonds on tution fees etc.</p>
      </div>
      </span></div>
  </div>
  <div class="loading"></div>
  
  <div class="accordion closed nn">
    <h5>Major Benefits in a Travel Insurance Policy</h5>
    <div class="" style="min-height:300px; float:left; width:100%;"> 
    
    <span><div  class="col-md-12 " style="margin-bottom:20px;">These are some of the common benefits provided in an overseas travel insurance policy. This list is not exhaustive and the features may vary from plan to plan.</div></span>
    
    <span class="" style="float:left; width:100%; margin-top:0px;">
<div  class="col-md-4 ">
        <h3>Medical Treatment</h3>
        <p>Costs incurred in treatment of a medical condition, in-patient or out-patient and the costs of transportation to a medical facility are covered.</p>
      </div>

<div  class="col-md-4 ">
        <h3>Dental Treatment</h3>
        <p>The dental treatment costs involved in providing pain relief are covered in the plan.</p>
      </div>

<div  class="col-md-4 ">
        <h3>Medical Evacuation</h3>
        <p>In case of the insured person needs to be moved from one location to another to provide some specific kind of treatment, the costs involved would be covered.</p>
      </div>
</span>

<span class="" style="float:left; width:100%; margin-top:0px;">
<div  class="col-md-4 ">
        <h3>Hospital Daily Allowance</h3>
        <p>A cash allowance is paid for each day of hospitalisation. This is uaually for the miscellaneous expenses which are incurred.</p>
      </div>

<div  class="col-md-4 ">
        <h3>Balance Treatment back in India</h3>
        <p>In case the insured person comes back to India and needs to treatment for the same medical condition, the costs are borne by the policy for a specified period of say 30 days.</p>
      </div>

<div  class="col-md-4 ">
        <h3>Total Loss of Checked-in Baggage</h3>
        <p>In case your baggage is permanently lost by the airline, the costs involved in purchasing the new items would be covered by the policy.</p>
      </div>
</span>


<span class="" style="float:left; width:100%; margin-top:0px;">
<div  class="col-md-4 ">
        <h3>Delay of Checked-in baggage</h3>
        <p>In case your baggage is delayed, the costs involved in purchasing essential items and any medication involved would be covered by the policy.</p>
      </div>

<div  class="col-md-4 ">
        <h3>Loss of Passport</h3>
        <p>In case your passport in lost, the costs involved in procurring a fresh passport would be covered.</p>
      </div>

<div  class="col-md-4 ">
        <h3>Financial Emergency Cash</h3>
        <p>In case you lose your purse or the money you are carrying due to theft, a specified amount of cash would be made available to you.</p>
      </div>
</span>

<span class="" style="float:left; width:100%; margin-top:0px;">
<div  class="col-md-4 ">
        <h3>Repatriation of mortal remains</h3>
        <p>In case of death of the policyholder, the costs involved in transporting the mortail remains to India would be covered.</p>
      </div>

<div  class="col-md-4 ">
        <h3>Personal Liability</h3>
        <p>Any personal liablity incurred such a damage of property, body injury caused or third party death would be covered.</p>
      </div>

<div  class="col-md-4 ">
        <h3>Personal Accident</h3>
        <p>In case of an accident to the airline, a lumpsum amount would be paid out.</p>
      </div>
</span>


<span class="" style="float:left; width:100%; margin-top:0px;">
<div  class="col-md-4 ">
        <h3>Trip Delay</h3>
        <p>If the airline is delayed for more than 24 hours, an amount is paid out to the policyholder.</p>
      </div>

<div  class="col-md-4 ">
        <h3>Trip Cancellation & Curtailment</h3>
        <p>In case the trip is cancelled or curtailed for un-avoidaable reasons which are listed in the policy, the travel and accomodation expenses are covered.</p>
      </div>

<div  class="col-md-4 ">
        <h3>Hijack Allowance</h3>
        <p>A daily allowance is paid to the policyholder in case of an hijack for more than a specified period.</p>
      </div>

</span>
    
    
        
    </div>
  </div>
  
  
</div>
<div class="container   margin-bottom-large">
  <div  class="col-md-6 mar-25">
    <div class="top_ins"></div>
    <h3 class="header_art">Articles on Travel Insurance</span></h3>
    <div class="art_cnt widget ">
      <h4 class="sub_h">How to secure your future with pension</h4>
      <div class="textwidget">
        <p><img style="border: 0px none;" alt="" src="assets/images/art1.jpg" >At any moment, an unhappy customer can share their opinion with the masses through...How to speak with an Indian Accent. </p>
      </div>
      <div class="comnt"> <span class="text-left l">1,348 views</span> <span class="text-right r">0 comments</span> </div>
    </div>
    <div class="art_cnt widget ">
      <h4 class="sub_h">How to secure your future with pension</h4>
      <div class="textwidget">
        <p><img style="border: 0px none;" alt="" src="assets/images/art1.jpg" >At any moment, an unhappy customer can share their opinion with the masses through...How to speak with an Indian Accent. </p>
      </div>
      <div class="comnt"> <span class="text-left l">1,348 views</span> <span class="text-right r">0 comments</span> </div>
    </div>
    <div class="art_cnt widget ">
      <h4 class="sub_h">How to secure your future with pension</h4>
      <div class="textwidget">
        <p><img style="border: 0px none;" alt="" src="assets/images/art1.jpg" >At any moment, an unhappy customer can share their opinion with the masses through...How to speak with an Indian Accent. </p>
      </div>
      <div class="comnt"> <span class="text-left l">1,348 views</span> <span class="text-right r">0 comments</span> </div>
    </div>
    <div class="col-md-12 text-rightp"><a href="javascript:void(0)">More Articles <span class="ic">+</span></a></div>
  </div>
  <div  class="col-md-6 mar-25">
    <div class="top_ins"></div>
    <h3 class="header_art">Guides On Travel Insurance</h3>
    <div class="art_cnt widget ">
      <h4 class="sub_h">How to secure your future with pension</h4>
      <div class="textwidget">
        <p><img style="border: 0px none;" alt="" src="assets/images/news1.jpg" >At any moment, an unhappy customer can share their opinion with the masses through...How to speak with an Indian Accent. </p>
      </div>
      <div class="comnt"> <span class="text-left l">1,348 views</span> <span class="text-right r">0 comments</span> </div>
    </div>
    <div class="art_cnt widget ">
      <h4 class="sub_h">Which is the best child plan?</h4>
      <div class="textwidget">
        <p><img style="border: 0px none;" alt="" src="assets/images/news2.jpg" >At any moment, an unhappy customer can share their opinion with the masses through...How to speak with an Indian Accent. </p>
      </div>
      <div class="comnt"> <span class="text-left l">1,348 views</span> <span class="text-right r">0 comments</span> </div>
    </div>
    <div class="art_cnt widget ">
      <h4 class="sub_h">Benefits of investing early</h4>
      <div class="textwidget">
        <p><img style="border: 0px none;" alt="" src="assets/images/news3.jpg" >At any moment, an unhappy customer can share their opinion with the masses through...How to speak with an Indian Accent. </p>
      </div>
      <div class="comnt"> <span class="text-left l">1,348 views</span> <span class="text-right r">0 comments</span> </div>
    </div>
    <div class="col-md-12 text-rightp"><a href="javascript:void(0)">More Guides <span class="ic">+</span></a></div>
  </div>
</div>

      <script src="<?php echo base_url();?>/assets/js/travel.js"></script>
      <script src="<?php echo base_url();?>/assets/js/health.js"></script>
	<script type="text/javascript">
	$(document).ready(function() {
	$('#sub_form').on('click',function(){

	$('#travel_form').submit();

		});
	});
	</script>