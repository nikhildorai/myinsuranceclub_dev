
<link rel="stylesheet" href="<?php echo base_url();?>/assets/css/travel_search.css">

<div id="highlighted" style=" background:#fff; padding-bottom:50px; margin-bottom:0px;" >
  <div class="container">
    <div style=" width:100%; float:left;">
      <div class="col-md-3  border m_a">
        <div class="top_h">You searched for:</div>
        <div class="top_p">Annual multi-trip</div>
        <div class="top_p">Worldwide Including USA/Canada</div>
        <div class="top_p">12/08/2014 - 22/08/2014</div>
        <div class="top_p">Couple</div>
        <div style="text-align: right; padding-top: 0px; margin-top: -7px;" class="top_m"><i class="fa fa-angle-left"></i> <a href="travel.php">&nbsp;Modify Your Search</a></div>
      </div>
      <div class="col-md-9" style="padding-right:0px;" >
        <div class="top_band_com">
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
          <div class="col-md-8  noborder clearfix">
            <div id="sh3" style="display:none">
              <div class="top_h_t text-left">Price Range</div>
              <div class="top_p_n text-left" style="float:left;"><span style="float:left; margin-top:7px;">&#8377;</span><span id="pr_ra"  class="odometer" style="float:left;">0</span><span style="float:left;margin-top:7px;""> &nbsp;- &#8377;</span><span id="pr_rb" class="odometer" style="float:left;">0</span></div>
            </div>
            <div id="sh4" style="position:absolute;"><i class="fa fa-check-square-o"></i> </div>
          </div>
        </div>
      </div>
    </div>
    <div id="loader"><!--<img src="assets/images/loader.gif" border="0">--></div>
    <div class="" style="margin-top:20px; display:none;" id="prdt_dis">
      <div class="col-md-9 col-md-push-3 cus_res_hlth" style="padding-right:0px;">
        <div class="col-md-12 t_s" style="padding:0px;">
          <div style=" height:auto; padding:10px 0px 30px 0px; background:#ededec;  border-radius: 4px;">
            <div class="col-md-5 plan">
              <div style="position: relative; float: left; margin-left: -2px; top: 2px; margin-right: 7px; color: rgb(95, 180, 29); font-size: 17px;"><i class="fa fa-level-up  fa-rotate-180"></i></div>
              <div class="com_pl" style="float: left; font-weight: bold; color: rgb(44, 163, 239);"><a href="health_compare.php" class="">Compare Plans</a></div>
            </div>
            <div class="col-md-3 an" style="font-weight: bold;"> Annual Premium </div>
          </div>
          <div class="cmp_tbl ">
            <div class="cus_tb clearfix" >
              <div class="col-md-2 pad-right-10 logo_ins">
                <div class="img_bx" > <img src="assets/images/client/bajaj-allianz-general-insurance-company-small.jpg" border="0" class="img_bx_i">
                  <div class="check_bx">
                    <div class="checkbox">
                      <label>
                      <input type="checkbox" name="c_name" id="c_name" class="">
                      <label class="chk" for="Field4"></label>
                      </label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-3 pad-left-10">
                <div class="c_t" > <span class="title_c" style="width:100%;">Bajaj Allianz</span><span class="sub_tit" >Travel Companion</span> </div>
              </div>
              <div class="col-md-7 m_anc">
                <div class="col-md-6 no_pad_l">
                  <h3 class="anc">Rs. 12,340</h3>
                  <p class="sub_tit cvr">for cover of USD 3,00,000</p>
                </div>
                <div class="col-md-2" style="padding:0px">
                  <div class="down_cnt" style="width:20px; height:auto; float:left; "><i class="fa fa-plus-square"></i> </div>
                  <div class="down_cnt_up" style=""><i class="fa fa-angle-up"></i> </div>
                </div>
                <div class="col-md-4 pad_r_10"> <a class="btn_offer_block" href="#">Buy Now <i class="fa fa-angle-right"></i></a>
                  <div class="thumb"><i class="fa fa-thumbs-up"></i>
                    <div class="text_t"> 12 people chose this plan</div>
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
                          <td>Medical Treatment</td>
                          <td class="cus_width">Cover of USD 3,00,000</td>
                        </tr>
                        <tr>
                          <td>Dental Treatment</td>
                          <td class="cus_width">Cover of USD 500<br/>
                            This is part of 'Medical Treatment'</td>
                        </tr>
                        <tr class="odd">
                          <td>Medical Evacuation</td>
                          <td class="cus_width">Covered as part of 'Medical Treatment'</td>
                        </tr>
                        <tr >
                          <td>Hospital Daily Allowance</td>
                          <td class="cus_width">-</td>
                        </tr>
                        <tr class="odd">
                          <td>Balance Treatment back in India</td>
                          <td class="cus_width">-</td>
                        </tr>
                        <tr >
                          <td>Total Loss of Checked-in Baggage</td>
                          <td class="cus_width">USD 250</td>
                        </tr>
                        <tr class="odd">
                          <td>Delay of Checked-in baggage</td>
                          <td class="cus_width">USD 100</td>
                        </tr>
                        <tr >
                          <td>Loss of Passport</td>
                          <td class="cus_width">USD 250</td>
                        </tr>
                        <tr class="odd">
                          <td>Financial Emergency Cash</td>
                          <td class="cus_width">USD 500</td>
                        </tr>
                        <tr >
                          <td>Repatriation of mortal remains</td>
                          <td class="cus_width">Covered as part of 'Medical Treatment'</td>
                        </tr>
                        <tr class="odd">
                          <td>Personal Liability</td>
                          <td class="cus_width">USD 1,00,000</td>
                        </tr>
                        <tr >
                          <td>Personal Accident</td>
                          <td class="cus_width">USD 10,000</td>
                        </tr>
                        <tr class="odd">
                          <td>Trip Delay</td>
                          <td class="cus_width">-</td>
                        </tr>
                        <tr >
                          <td>Trip Cancellation & Curtailment</td>
                          <td class="cus_width">-</td>
                        </tr>
                        <tr class="odd">
                          <td>Hijack Allowance</td>
                          <td class="cus_width">USD 50 per day to maximum USD 300</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="col-md-5">
                  <h4 class="h_d mar-40" style="margin-left:50px;">Documents</h4>
                  <ul class="doc">
                    <li>Policy Brouchure <a href="javascript:void(0)"><img src="assets/images/pdf.jpg"></a></li>
                    <li>Policy Wordings <a href="javascript:void(0)"><img src="assets/images/pdf.jpg" class="dimg"></a></li>
                  </ul>
                  </ul>
                </div>
                <div class="col-md-12  hide_d" >Hide details <i class="fa fa-angle-up"></i></div>
              </div>
            </div>
          </div>
        
          
        </div>
      </div>
      <!--Sidebar-->
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
                <p class="displayStaticRange clearFix" style="padding-bottom:0px; margin-bottom:0px;"> <span class="fLeft"><span data-pr="6437" class="INR">&#8377;</span>6,437</span> <span class="fRight"><span data-pr="42306" class="INR">&#8377;</span>42,306</span> </p>
                <input type="hidden" name="price" value="6437-32293">
              </div>
              <p class="addOnFilter" style="margin:0px; padding:0px;">
              <h6 class="fh3 l" style="margin:0px; padding:0px; height:9px;">&nbsp; </h6>
              </p>
              <h6 class="fh3">Coverage amount</h6>
              <p class="addOnFilter" >
              <div class="checkbox">
                <label>
                <input type="checkbox" id="" name="agree1"  class="field checkbox" value="">
                <label class="" for="Field4"> USD 1,00,000</label>
                </label>
              </div>
              <div class="checkbox">
                <label>
                <input type="checkbox" id="" name="agree1"  class="field checkbox" value="">
                <label class="" for="Field4"> USD 2,00,000</label>
                </label>
              </div>
              <div class="checkbox">
                <label>
                <input type="checkbox" id="" name="agree1"  class="field checkbox" value="">
                <label class="" for="Field4"> USD 3,00,000</label>
                </label>
              </div>
              </p>
              <p class="addOnFilter" style="margin:0px; padding:0px;">
              <h6 class="fh3 l" style="margin:0px; padding:0px; height:9px;">&nbsp; </h6>
              </p>
              <h6 class="fh3">Company </h6>
              <div class="addOnFilter clearfix" >
                <div style="width: 100%; float: left;">
                  <div class="checkbox" style="width: auto; float: left; margin: 0px;">
                    <label>
                    <input type="checkbox" value="23" class="field checkbox" name="23" id="">
                    <label for="23" class="">Relaince Life </label>
                    </label>
                  </div>
                  <span style="float:right;"> Rs. 12,340</span></div>
                <div style="width: 100%; float: left;">
                  <div class="checkbox" style="width: auto; float: left; margin: 0px;">
                    <label>
                    <input type="checkbox" value="23" class="field checkbox" name="23a" id="23a">
                    <label for="23a" class="">Max Life </label>
                    </label>
                  </div>
                  <span style="float:right;"> Rs. 13,340</span></div>
                <div style="width: 100%; float: left;">
                  <div class="checkbox" style="width: auto; float: left; margin: 0px;">
                    <label>
                    <input type="checkbox" value="23" class="field checkbox" name="23b" id="23b">
                    <label for="23b" class="">Aviva </label>
                    </label>
                  </div>
                  <span style="float:right;"> Rs. 13,340</span></div>
                <div style="width: 100%; float: left;">
                  <div class="checkbox" style="width: auto; float: left; margin: 0px;">
                    <label>
                    <input type="checkbox" value="23" class="field checkbox" name="23c" id="23c">
                    <label for="23c" class="">HDFC Life </label>
                    </label>
                  </div>
                  <span style="float:right;"> Rs. 13,340</span></div>
                <div style="width: 100%; float: left;">
                  <div class="checkbox" style="width: auto; float: left; margin: 0px;">
                    <label>
                    <input type="checkbox" value="23" class="field checkbox" name="23d" id="23d">
                    <label for="23d" class="">Max Life </label>
                    </label>
                  </div>
                  <span style="float:right;"> Rs. 13,340</span></div>
                <div style="width: 100%; float: left;">
                  <div class="checkbox" style="width: auto; float: left; margin: 0px;">
                    <label>
                    <input type="checkbox" value="23" class="field checkbox" name="23e" id="23e">
                    <label for="23e" class="">Canara HSBC OBC </label>
                    </label>
                  </div>
                  <span style="float:right;"> Rs. 13,340</span></div>
                <div style="width: 100%; float: left;">
                  <div class="checkbox" style="width: auto; float: left; margin: 0px;">
                    <label>
                    <input type="checkbox" value="23" class="field checkbox" name="23f" id="23f">
                    <label for="23f" class="">LIC </label>
                    </label>
                  </div>
                  <span style="float:right;"> Rs. 13,340</span></div>
                <div style="width: 100%; float: left;margin-bottom:10px;">
                  <div class="checkbox" style="width: auto; float: left; margin: 0px;">
                    <label>
                    <input type="checkbox" value="23" class="field checkbox" name="23g" id="23g">
                    <label for="23g" class="">Star Union Daiichi </label>
                    </label>
                  </div>
                  <span style="float:right;"> Rs. 13,340</span></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
