

$(document).ready(function() {
	
	var end_date = '';
	
	$(document).delegate('.t_h_btn.aa,#single_t,#mul_t,#stu_t','click',function() {
	
		 
		 $('.mic_tooltip_message').fadeIn();
		 var ScrollTop = $('html').scrollTop();

//console.log(ScrollTop);
		 
		 if (ScrollTop > 100)
		 
		 {
		 var t_p = $('.t_h_btn.aa').offset().top - 317;
		 }
		 
		 else{
			var t_p = $('.t_h_btn.aa').offset().top - 352; 
		 }
		 
		 $('.mic_tooltip_message').css({top:t_p});
		 
		 $('.tooltip_travel_sec').html("<p><b>Single trip:</b> Refers to a single to and fro trip from India. It could include mulitple destinations after departure from India.</p><p><b>Annual multi-trip:</b> Refers to multiple trips to and fro from India within a single year.</p><p><b>Student travel:</b> Refers to a single trip to and fro from India for students going abroad for education.</p>");

        });
		
		
		
		
		
		
		
		$('.toll_a,.where_go_a,.where_go_b,.where_go_c,.where_go_d').click(function(){
		 
		 $('.mic_tooltip_message').fadeIn();
		 
		 
		  var ScrollTop = $('html').scrollTop();

//console.log(ScrollTop);
		 
		 if (ScrollTop > 100)
		 
		 {
		 var t_p = $('.toll_a').offset().top - 317;
		 }
		 
		 else{
			var t_p = $('.toll_a').offset().top - 352; 
		 }
		 
		 
		 //alert(t_p);
		 $('.mic_tooltip_message').css({top:t_p});
		 
		 $('.tooltip_travel_sec').html("<p>Select your region of travel. You can select only one region at a time</p>");

        });
		
		
			
		$('.toll_b,.w_ga,.w_gb,.w_gc,.w_gd').click(function(){
		 
		 $('.mic_tooltip_message').fadeIn();
		  var ScrollTop = $('html').scrollTop();

//console.log(ScrollTop);
		 
		 if (ScrollTop > 100)
		 
		 {
		 var t_p = $('.toll_b').offset().top - 317;
		 }
		 
		 else{
			var t_p = $('.toll_b').offset().top - 352; 
		 }
		 $('.mic_tooltip_message').css({top:t_p});
		 
		 $('.tooltip_travel_sec').html("<p>Select your date of departure from India. </p><p><b>Note:</b> Date changes after 12 in the midnight. For eg. 12:09 am means the next date!.</p>");

        });
		
		$('.toll_away,.n_a,.n_b,.n_c,.n_d').click(function(){
		 
		 $('.mic_tooltip_message').fadeIn();
		   var ScrollTop = $('html').scrollTop();

//console.log(ScrollTop);
		 
		 if (ScrollTop > 100)
		 
		 {
		 var t_p = $('.toll_away').offset().top - 317;
		 }
		 
		 else{
			var t_p = $('.toll_away').offset().top - 352; 
		 }
		 $('.mic_tooltip_message').css({top:t_p});
		 
		 $('.tooltip_travel_sec').html("<p>Select your date of arrival from India. </p><p><b>Note:</b> Date changes after 12 in the midnight. For eg. 12:09 am means the next date!.</p>");

        });
		
		
	/*	$('.toll_c').click(function(){
		 
		 $('.mic_tooltip_message').fadeIn();
		 var t_p = $(this).offset().top - 352;
		 $('.mic_tooltip_message').css({top:t_p});
		 
		 $('.tooltip_travel_sec').html("<p><b>Winter sports:</b> this covers you if you're taking part in activities such as skiing or snowboarding.</p><p>This may also include cover for off-piste skiing and for your equipment.</p><p><b>Cruise cover:</b> these policies are tailored to you being at sea and may include extras such as missed port departure and cabin confinement.</p><p>Read the policy wording carefully as it may include conditions and exclusions. It's important to ensure that your insurance provider will cover you for all destinations on your cruise.</p>");

        });
		*/
		
		$('.toll_d,.insure_a,.insure_b,.insure_c').click(function(){
		 
		 $('.mic_tooltip_message').fadeIn();
		  var ScrollTop = $('html').scrollTop();

//console.log(ScrollTop);
		 
		 if (ScrollTop > 100)
		 
		 {
		 var t_p = $('.toll_d').offset().top - 317;
		 }
		 
		 else{
			var t_p = $('.toll_d').offset().top - 352; 
		 }
		 $('.mic_tooltip_message').css({top:t_p});
		 
		 $('.tooltip_travel_sec').html("<p><b>Individual:</b> Covers a single traveller.</p><p><b>Couple:</b> Covers husband and wife who are travelling together.</p><p><b>Family:</b> Covers a family travelling together.</p>");

        });
			$('.toll_e,.t_dd,.t_mm,.t_yy').click(function(){
		 
		 $('.help-message').fadeIn();
		  var ScrollTop = $('html').scrollTop();

//console.log(ScrollTop);
		 
		 if (ScrollTop > 100)
		 
		 {
		 var t_p = $('.toll_e').offset().top - 317;
		 }
		 
		 else{
			var t_p = $('.toll_e').offset().top - 352; 
		 }
		 $('.mic_tooltip_message').css({top:t_p});
		 
		 $('.tooltip_travel_sec').html("<p>The main traveller must be at least 18 years of age to take out a travel insurance policy.</p>");

        });
		
		$('.toll_f').click(function(){
		 
		 $('.mic_tooltip_message').fadeIn();
		 var t_p = $(this).offset().top - 352;
		 $('.mic_tooltip_message').css({top:t_p});
		 
		 $('.tooltip_travel_sec').html("<p class='help-title'><b>What is a medical condition?</b></p><p>An illness or injury for which you have taken medication or been given treatment.</p><p>This also includes conditions from which you have suffered symptoms, but not yet had a diagnosis and ongoing medical conditions.</p><p>Be as accurate as possible when telling us if you have any medical conditions or disabilities.</p><p>Remember, insurance providers define medical conditions in different ways and, if you answered this question incorrectly for any particular insurance provider, then your policy may be void.</p><p>As a result, always check with the insurance provider that you answered all questions accurately based on your circumstances before taking out a policy.</p>");

        });

 $('.mic_tooltip_close').click(function(){
		 
		 $('.mic_tooltip_message').fadeOut();
	 
      //   $('.mic_tooltip_message card').addClass('active');   
	 
				 
			//	 $('#soi').removeClass('active');  
        });
	
	
	/*$('.link').click(function(){
		 
		 $('.ref_y').fadeIn();
		 var t_p = $('.link').offset().top - 338;
		 // var t_l = $('.link').offset().left -320;
		 
		 $('.ref_y').css({top:t_p});
		 
		 $('.ref_y_text').html("'You' or 'Your' refers to the main traveller to be insured on the policy");

        });
		 $('.close_you').click(function(){
		 
		 $('.ref_y').fadeOut();
	 
        });*/


 $('.mic_btn_tl_one').mouseover(function(){
	 
         $(this).addClass('mic_btn_tl-hover');   
	 
				 
				
        });
		 $('.mic_btn_tl_one').mouseleave(function(){
	 
         $(this).removeClass('mic_btn_tl-hover');   
	 
				 
				
        });
		
		
		
		
		 $('#single_t').click(function(){
		 $('.travel_form_s').fadeIn();
		// $('.mic_tooltip_message').fadeOut();
		$('.travel_end_date.trip-end-date').fadeIn();
		 $(this).addClass('mic_btn_tl_chkd');  
		 $('#mul_t,#stu_t').removeClass('mic_btn_tl_chkd'); 
		 
		// $('html, body').animate({scrollTop:$(".sc_top").offset().top -20},100);
	 
    
        });
		
		
		 $('#mul_t').click(function(){
		 $('.travel_form_s').fadeIn();
		 $('.travel_end_date.trip-end-date').fadeOut();
		 $(this).addClass('mic_btn_tl_chkd');  
		 $('#single_t,#stu_t').removeClass('mic_btn_tl_chkd'); 
	 
    
        });
		
		 $('#stu_t').click(function(){
		 $('.travel_form_s').fadeIn();
		// $('.mic_tooltip_message').fadeOut();
		$('.travel_end_date.trip-end-date').fadeIn();
		 $(this).addClass('mic_btn_tl_chkd');  
		 $('#single_t,#mul_t').removeClass('mic_btn_tl_chkd'); 
	 
    
        });
		
		$('.where_go_a').click(function(){
		
		 $(this).addClass('mic_btn_tl_chkd');
		 $('.where_go_b,.where_go_c,.where_go_d').removeClass('mic_btn_tl_chkd');   
	 
    
        });
		$('.where_go_b').click(function(){
		
		 $(this).addClass('mic_btn_tl_chkd');
		 $('.where_go_a,.where_go_c,.where_go_d').removeClass('mic_btn_tl_chkd');   
	 
    
        });
		$('.where_go_c').click(function(){
		
		 $(this).addClass('mic_btn_tl_chkd');
		 $('.where_go_a,.where_go_b,.where_go_d').removeClass('mic_btn_tl_chkd');   
	 
    
        });
		$('.where_go_d').click(function(){
		
		 $(this).addClass('mic_btn_tl_chkd');
		 $('.where_go_a,.where_go_b,.where_go_c').removeClass('mic_btn_tl_chkd');   
	 
        });
		
		
		$(document).delegate('.w_ga','click',function() {
		 $(this).addClass('mic_btn_tl_chkd');
		 $('.w_gb,.w_gc,.w_gd').removeClass('mic_btn_tl_chkd');   
		 end_date = 7; 
		   $( ".end_datepicker" ).datepicker( "option", "minDate", 0 );
		 $('.n_a .mic_top_text').html(seven_day(7));
		  $('.n_b .mic_top_text').html(seven_day(10));
		   $('.n_c .mic_top_text').html(seven_day(14));
		   
        });
		
		$(document).delegate('.w_gb','click',function() {
		
		 $(this).addClass('mic_btn_tl_chkd');
		 $('.w_ga,.w_gc,.w_gd').removeClass('mic_btn_tl_chkd');  
		 $('.trip-end-date-picker .mic_sec_label').hide();
		  end_date = 8; 
		   $( ".end_datepicker" ).datepicker( "option", "minDate", 1 );
		 $('.n_a .mic_top_text').html(seven_day(8));
		  $('.n_b .mic_top_text').html(seven_day(11));
		   $('.n_c .mic_top_text').html(seven_day(15));
        });
		
		$(document).delegate('.w_gc','click',function() {
		 $(this).addClass('mic_btn_tl_chkd');
		 $('.w_gb,.w_ga,.w_gd').removeClass('mic_btn_tl_chkd'); 
		  $('.trip-end-date-picker .mic_sec_label').hide();
		  end_date = 9;  
		  $( ".end_datepicker" ).datepicker( "option", "minDate", 2 );
		 $('.n_a .mic_top_text').html(seven_day(9));
		  $('.n_b .mic_top_text').html(seven_day(12));
		   $('.n_c .mic_top_text').html(seven_day(16));
        });
		
		
		
		
		$('.n_a').click(function(){
		 $(this).addClass('mic_btn_tl_chkd');
		 $('.n_b,.n_c,.n_d').removeClass('mic_btn_tl_chkd');   
        });
		
		$('.n_b').click(function(){
		 $(this).addClass('mic_btn_tl_chkd');
		 $('.n_a,.n_c,.n_d').removeClass('mic_btn_tl_chkd');   
        });
		
		$('.n_c').click(function(){
		 $(this).addClass('mic_btn_tl_chkd');
		 $('.n_b,.n_a,.n_d').removeClass('mic_btn_tl_chkd');   
        });
		
		var counter = 2;
		$(document).delegate('.insure_a','click',function() {
		 $(this).addClass('mic_btn_tl_chkd');
		 $('.insure_b,.insure_c').removeClass('mic_btn_tl_chkd');   
		 $('.id-member-header.member-header').html('');
		  $('.add_traveller,.add_more_member').hide();
		  $('#TextBoxDiv2,#TextBoxDiv3,#TextBoxDiv4,#TextBoxDiv5,#TextBoxDiv6,#TextBoxDiv7').remove();
		   counter = 2;
        });
		
		$(document).delegate('.insure_b','click',function() {
		 $(this).addClass('mic_btn_tl_chkd');
		 $('.insure_a,.insure_c').removeClass('mic_btn_tl_chkd'); 
		 $('.add_traveller').show();
		  $('.add_more_member').hide();
		  
		  $('#TextBoxDiv2,#TextBoxDiv3,#TextBoxDiv4,#TextBoxDiv5,#TextBoxDiv6,#TextBoxDiv7').remove();
		   counter = 2;
        });
		
		$(document).delegate('.insure_c','click',function() {
		 $(this).addClass('mic_btn_tl_chkd');
		 $('.insure_b,.insure_a').removeClass('mic_btn_tl_chkd');   
		 $('.add_traveller').show();
		  $('.add_more_member').show();
		  counter = 2;
        });
		
		$(document).delegate('.gen_but_addtra_m','click',function() {
		 $(this).addClass('mic_btn_tl_chkd');
		 $(this).next('.gen_but_addtra_f').removeClass('mic_btn_tl_chkd');   
		 
        });
		
		$(document).delegate('.gen_but_addtra_f','click',function() {
		 $(this).addClass('mic_btn_tl_chkd');
		 $(this).prev('.gen_but_addtra_m').removeClass('mic_btn_tl_chkd');   
		 
        });
		
		
		
		
		
			$(document).delegate('input.id','keyup',function() {
    
    if (this.value.match(/\d+/)) {
      var $this = $(this);
       
             if($(this).val().length >= 2) {
				// alert(2);
          $this.next('input').focus();
             
        } else {
         
        }  
    }
	    
});
		
		
		  
		  $(document).delegate('#addButton','click',function() {
	if(counter>6){
         alert("You can add only 7 travellers.");
         return false;
	}   
	
	var cnt_num = counter+1;
	
	var num_members = counter - 1;
	var newTextBoxDiv = $(document.createElement('div'))
	     .attr("id", 'TextBoxDiv' + counter);

	newTextBoxDiv.after().html('<div> <div style="width:50%; float:left;"> <div class="family_section_header ">Traveller '+cnt_num+' date of birth</div> <div class="family_section "> <div class="individual_icon inline-block"></div> <div class="birth-date"> <div class="mic_sec_label mic_sec_label_cntrl"> <div class="mic_t_input"><span class=" mic_sec_day_cntrl"> <div class="mic_sec_label"> <div class="mic_t_input "> <input type="text" class="mic_t_input mic_e_input  id" style="margin-right:10px;" name="traveller_day[]" placeholder="DD" aria-label="DD" maxlength="2"> <input type="text" class="mic_t_input mic_e_input  id" style="margin-right:10px; width:36px;" placeholder="MM" name="traveller_month[]" aria-label="MM" maxlength="2"> <input type="text" class="mic_t_input mic_e_input " style="width:48px;" placeholder="YYYY" name="traveller_year[]" aria-label="YYYY" maxlength="4"> </div> <div class="id-error-text error-text" style="display: none;"></div> </div> </span></div> <div class=" error-text" style="display: none;"></div> </div> </div> </div> <div class="id-member-error-text error-text" style="display: none;"></div> </div> <div class="id-cus-gender" style="display:inline-block;width: 50%;"> <div class="family_section_header ">Traveller '+cnt_num+' Gender</div> <div style="width: 100%; margin-top:10px;" class="mic_t_input"> <div class=" mic_t_b_panel"> <div style="width:33.33%;" aria-pressed="true" class="mic_btn_in mic_btn_tl mic_btn_tl_one s-b mic_btn_tl_c_r gen_but_addtra_m" id="traveller_'+ cnt_num +'_male"> <div class="mic_icon" style="padding: 5px 0px"> <div class="mic_i_mar male" style="float: left; margin-top: 2px;"></div> <div class="mic_i_btm" style="margin-top: 5px;padding-bottom: 5px;">Male</div> </div> </div> <div style="width: 33.33%;"  class="mic_btn_in mic_btn_tl mic_btn_tl_one s-b mic_btn_tl_c_l mic_btn_tl_c_r gen_but_addtra_f" id = "traveller_'+ cnt_num +'_female"> <div class="mic_icon" style="padding: 5px 0px"> <div class="mic_i_mar female" style="float: left; margin-top: 3px;"></div> <div class="mic_i_btm" style="margin-top: 5px;padding-bottom: 5px;">Female</div> </div> </div> </div> <a href="javascript:void(0)" class="id-delete-per fa fa-trash-o " id="traveller_' + cnt_num +'_delete"></a> </div> </div></div>');
 
	newTextBoxDiv.appendTo("#TextBoxesGroup");
	
	$('#family_composition').val("2A" + num_members + "C");
	
	$("#traveller_" + cnt_num + "_male").click(function(){
		
		$("#traveller_" + cnt_num + "_gender").val('Male');
		
	});
	
	$("#traveller_" + cnt_num + "_female").click(function(){
		
		$("#traveller_" + cnt_num + "_gender").val('Female');
		
	});
	$(document).delegate("#traveller_"+ cnt_num + "_delete",'click',function() {
	
		$("#traveller_" + cnt_num + "_gender").val('');
	});
	counter++;
     });
 
$(document).delegate('.id-delete-per','click',function() {
	if(counter==2){
          alert("No more travellers to remove.");
          return false;
       }   
 
	counter--;
 
        $("#TextBoxDiv" + counter).remove();
  
     });
		
		
		
		
	$('.gen_but_m').click(function(){
		 $(this).addClass('mic_btn_tl_chkd');
		 
		 $('.gen_but_spouce_f').addClass('mic_btn_tl_chkd');
		 $('.gen_but_f,.gen_but_spouce_m').removeClass('mic_btn_tl_chkd');
		 $('#cust_gender').val('Male');
		 $('#spouse_gender').val('Female');
        });
	
	$('.gen_but_f').click(function(){
		 $(this).addClass('mic_btn_tl_chkd');
		  $('.gen_but_spouce_m').addClass('mic_btn_tl_chkd');
		 $('.gen_but_m,.gen_but_spouce_f').removeClass('mic_btn_tl_chkd');
		 $('#cust_gender').val('Female');
		 $('#spouse_gender').val('Male');
        });
		
		
		
		
		/*var currentdate = new Date(); 
		//alert(currentdate);
		
		var d = new Date();
var strDate = d.getFullYear() + "/" + (d.getMonth()+1) + "/" + d.getDate();
var cur_mnt = d.getMonth();
var cur_date = d.getDate();
alert(cur_date);*/
 var months = ["Jan", "Feb", "Mar","Apr","May","June","July","Aug","Sept","Oct","Nov","Dec"]; 
   
    var days = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];


 $('.n_a .mic_top_text').html(seven_day(7));
 $('.n_b .mic_top_text').html(seven_day(10));
 $('.n_c .mic_top_text').html(seven_day(14));
		   
		   
var d = new Date();

 var e = new Date();
    e.setHours(0, 0, 0, 0);
    e.setDate(e.getDate() + 1);
	
	 var f = new Date();
    f.setHours(0, 0, 0, 0);
    f.setDate(f.getDate() + 2);




	
	
var cur_today = days[d.getDay()] + ", " + months[d.getMonth()] + " " + (d.getDate() < 10 ? "0" + d.getDate() : d.getDate()) ;
var cur_tomorrow = days[e.getDay()] + ", " + months[e.getMonth()] + " " + (e.getDate() < 10 ? "0" + e.getDate() : e.getDate()) ;
var in_two_day = days[f.getDay()] + ", " + months[f.getMonth()] + " " + (f.getDate() < 10 ? "0" + f.getDate() : f.getDate()) ;


$('.w_today').html(cur_today);
$('.w_tommorow').html(cur_tomorrow);
$('.w_in_two_day').html(in_two_day);


function seven_day(days_no) {
	
	var g = new Date();
    g.setHours(0, 0, 0, 0);
    g.setDate(g.getDate() + days_no);
	
	var no_of_day = days[g.getDay()] + ", " + months[g.getMonth()] + " " + (g.getDate() < 10 ? "0" + g.getDate() : g.getDate()) ;
	return no_of_day;
	
}




var mydate = new Date();



function MDFormat(MMDD) {
    MMDD = new Date(MMDD);
    
    var months = ["Jan", "Feb", "Mar", "Apr", "May", "June", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
	var days = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
    var strDate = "";
    var day = MMDD.getDate();
    var month = months[MMDD.getMonth()];
    
    var today = new Date();
    today.setHours(0, 0, 0, 0);
    
    var yesterday = new Date();
    yesterday.setHours(0, 0, 0, 0);
    yesterday.setDate(yesterday.getDate() - 1);
    
    var tomorrow = new Date();
    tomorrow.setHours(0, 0, 0, 0);
    tomorrow.setDate(tomorrow.getDate() + 1);
    
    console.log(MMDD.getTime(),today.getTime(),MMDD.getTime()==today.getTime());
    
    if (today.getTime() == MMDD.getTime()) {
        strDate = "Today";
    } else if (yesterday.getTime() == MMDD.getTime()) {
        strDate = "Yesterday";
    } else if (tomorrow.getTime() == MMDD.getTime()) {
        strDate = "Tomorrow";
    } else {
        strDate = months[MMDD.getMonth()] + "-" + MMDD.getDate();
    }

    return strDate;
}
		
	$('.w_gd').click(function() {
		$('.trip-end-date-picker .mic_sec_label').hide();
		
		$(this).addClass('mic_btn_tl_chkd');
		 $('.w_gb,.w_gc,.w_ga').removeClass('mic_btn_tl_chkd');  
		
			$('.trip-start-date-picker .mic_sec_label').show();
	$('.start_datepicker').datepicker({
		minDate: 0,
		dateFormat: 'yy-mm-dd',
										prevText: '<i class="fa fa-chevron-left"></i>',
					nextText: '<i class="fa fa-chevron-right"></i>',
					
	onSelect: function(){
            var day1 = $(this).datepicker('getDate').getDate();                 
            var month1 = $(this).datepicker('getDate').getMonth() + 1;             
            var year1 = $(this).datepicker('getDate').getFullYear();
            var fullDate = year1 + "-" + month1 + "-" + day1;
            var fullDateDiffFormat = day1 + '/' + month1 + '/' + year1;
			//var cur_today_date_a = d.getDate() < 10 ? "0" + d.getDate() : d.getDate();
			//var cur_today_date = day1 - cur_today_date_a;
			
			$('.trip-start-date-picker .mic_sec_label').hide();
			var date = $(this).datepicker('getDate');
        var today = new Date();
        var dayDiff = Math.ceil((date - today) / (1000 * 60 * 60 * 24));
       
        $('#trip_start').val(fullDateDiffFormat);
			if(dayDiff == 0)
			{
				
				$('.w_gd .mic_i_btm').html(seven_day(dayDiff));
			 $('.n_a .mic_top_text').html(seven_day(7));
 $('.n_b .mic_top_text').html(seven_day(10));
 $('.n_c .mic_top_text').html(seven_day(14));
 
			}
			
			else{
				$('.w_gd .mic_i_btm').html(seven_day(dayDiff));
				 $('.n_a .mic_top_text').html(seven_day(7+dayDiff));
 $('.n_b .mic_top_text').html(seven_day(10+dayDiff));
 $('.n_c .mic_top_text').html(seven_day(14+dayDiff));
				
				}
				
				$( ".end_datepicker" ).datepicker( "option", "minDate", dayDiff );
			end_date = dayDiff+6;
			
		 
		
        }
					
				});
		
	});
	
	
	
	$(document).delegate('.n_d','click',function() {
		
		$('.trip-start-date-picker .mic_sec_label').hide();
		
			 $(this).addClass('mic_btn_tl_chkd');
		 $('.n_b,.n_c,.n_a').removeClass('mic_btn_tl_chkd');   
		
			$('.trip-end-date-picker .mic_sec_label').show();
		//	var m_d =2;
			
			
			if(end_date<=6){
			
		m_end= 0;
		}
		else{
			m_end= end_date-6;
		}
	//	alert(end_date);
		//alert(m_end);
		//$( ".end_datepicker" ).datepicker( "option", "minDate", m_end );
		
	$('.end_datepicker').datepicker({
		
	
			
		minDate: m_end,
		
		
		dateFormat: 'yy-mm-dd',
										prevText: '<i class="fa fa-chevron-left"></i>',
					nextText: '<i class="fa fa-chevron-right"></i>',
					
	    onSelect: function(){
          
			
			$('.trip-end-date-picker .mic_sec_label').hide();
			var date = $(this).datepicker('getDate');
        var today = new Date();
        var dayDiff = Math.ceil((date - today) / (1000 * 60 * 60 * 24));
        var fulldate = date.getDate() + '/' + (date.getMonth()+1) + '/' + date.getFullYear();
        $('#trip_end').val(fulldate);
		
				$('.n_d .mic_i_btm').html(seven_day(dayDiff));
		
			
			
		 
		
        }
					
				});
		
	});
	
	/*$("#demoContainer").mouseup(function(e)
    {
        var subject = $("#demo"); 

        if(e.target.id != subject.attr('id'))
        {
            subject.fadeOut();
        }
    });
	*/
	$(document).on('click', function (e) {
    if ($(e.target).closest(".n_d").length === 0) {
        $("#demoContainer").hide();
    }
	
	else{
		$("#demoContainer").show();
	}
});
	
/*$(document).on("click", function(e) {
	
	//alert('d');
	
    var elem = $(e.target);
    if(!elem.hasClass("hasDatepicker") && 
        !elem.hasClass("ui-datepicker") && 
        !elem.hasClass("ui-icon") && 
        !elem.hasClass("ui-datepicker-next") && 
        !elem.hasClass("ui-datepicker-prev") && 
        !$(elem).parents(".ui-datepicker").length){
          //  $('.hasDatepicker').hide();
			//$('.trip-end-date-picker .mic_sec_label').hide();
    }
});	
 */
  

/**************** Trip Type **************/	
	
	$('#single_t').click(function() {
		
		//var trip_type = $(this).text();
		//alert("value recieved");
		$("#trip_type").val("Single trip");
		
		
	});
	
$('#mul_t').click(function() {
		
		//var trip_type = $(this).text();
		
		$("#trip_type").val("Annual multi-trip");

	});
$('#stu_t').click(function() {
	
	//var trip_type = $(this).text();
	
	$("#trip_type").val("Student trip");
	
});



/************ Trip Location *****************/

$('#including_usa_canada').click(function() {
	
	$("#trip_location").val("Worldwide Including Usa/Canada");
	
	
});

$('#excluding_usa_canada').click(function() {
	
	$("#trip_location").val("Worldwide Excluding Usa/Canada");
	//alert("Excluding");
	
});


$('#Schengen').click(function() {
	
	$("#trip_location").val("Schengen Countries");
	//alert("Schengen");
	
});

$('#Asia').click(function() {
	
	$("#trip_location").val("Asia");
	//alert("Asia");
	
});

$('#today').click(function() {
	var g = new Date();
	var curDate = g.getDate() + "/" +  (g.getMonth()+1)   + "/" +  d.getFullYear(); 	 
	$("#trip_start").val(curDate);
	
});


$('#tomorrow').click(function() {
	var g = new Date();
	var curDate = (g.getDate()+1) + "/" +  (g.getMonth()+1)   + "/" +  d.getFullYear(); 	 
	$("#trip_start").val(curDate);
});

$('#in2days').click(function() {
	var g = new Date();
	var curDate = (g.getDate()+2) + "/" +  (g.getMonth()+1)   + "/" +  d.getFullYear();
	var endDate = (g.getDate()+10) + "/" +  (g.getMonth()+1)   + "/" +  d.getFullYear();
	$("#trip_start").val(curDate);
	
});

$('#7_nights').click(function() {
	var startDate = $("#trip_start").val();
	var endDate =  new Date();
	var end_of_trip = (endDate.getDate() + 7) +  "/" + (endDate.getMonth()+1) + "/" + endDate.getFullYear();
	$("#trip_end").val(end_of_trip);
	
});

$('#10_nights').click(function() {
	var startDate = $("#trip_start").val();
	var endDate =  new Date();
	var end_of_trip = (endDate.getDate() + 10) +  "/" + (endDate.getMonth()+1) + "/" + endDate.getFullYear();
	$("#trip_end").val(end_of_trip);
	
});

$('#14_nights').click(function() {
	var startDate = $("#trip_start").val();
	var endDate =  new Date();
	var end_of_trip = (endDate.getDate() + 14) +  "/" + (endDate.getMonth()+1) + "/" + endDate.getFullYear();
	//alert(end_of_trip);
	$("#trip_end").val(end_of_trip);
	
});

$('#1A').click(function() {
	
	$("#family_composition").val('1A');
	$("#family_composition_desp").val('Individual');
	
});

$('#2A').click(function() {
	
	$("#family_composition").val('2A');
	$("#family_composition_desp").val('Couple');
});

$('#family').click(function() {
	
	$("#family_composition").val('2A');
	$("#family_composition_desp").val('Family');
});



/************* Form Validation For Travel Insurance ******************/











});