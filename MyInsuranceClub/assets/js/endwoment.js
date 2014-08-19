

$(document).ready(function() {
	
	var end_date = '';
	
	$(document).delegate('.t_h_btn.aa,#cover_a,#cover_b,#cover_c,#cover_d','click',function() {
	
		 
		 $('.mic_tooltip_message').fadeIn();
		 var ScrollTop = $('html').scrollTop();

//console.log(ScrollTop);
		 
		 if (ScrollTop > 100)
		 
		 {
		 var t_p = $('.t_h_btn.aa').offset().top - 265;
		 }
		 
		 else{
			var t_p = $('.t_h_btn.aa').offset().top - 300; 
		 }
		 
		 $('.mic_tooltip_message').css({top:t_p});
		 
		 $('.tooltip_term_sec').html("<p>Cover amount should be between Rs 1 Lakh and 5 Crores in multiples of Rs 1 Lakh.");

        });
		
		
		

		
		


 $('.mic_tooltip_close').click(function(){
		 
		 $('.mic_tooltip_message').fadeOut();
	 
	 
        });
	



 $('.mic_btn_tl_one').mouseover(function(){
	 
         $(this).addClass('mic_btn_tl-hover');   
	 
				 
				
        });
		 $('.mic_btn_tl_one').mouseleave(function(){
	 
         $(this).removeClass('mic_btn_tl-hover');   
	 
				 
				
        });
		
		
		/* term  */
		
			////////////////////// COVER //////////////////
		
		 $('#cover_a').click(function(){
		 
		 $(this).addClass('mic_btn_tl_chkd');  
		 $('#cover_b,#cover_c,#cover_d').removeClass('mic_btn_tl_chkd'); 
		  $('.id-cover-custom,#cus_sel_cover').hide();
		   $('#about_policy_holder').show();
		 
		// $('html, body').animate({scrollTop:$(".sc_top").offset().top -20},100);
	 
    
        });
		
		$('#cover_b').click(function(){
		 $(this).addClass('mic_btn_tl_chkd');  
		 $('#cover_a,#cover_c,#cover_d').removeClass('mic_btn_tl_chkd'); 
		  $('.id-cover-custom,#cus_sel_cover').hide();
		   $('#about_policy_holder').show();
        });
		
		$('#cover_c').click(function(){
		 $(this).addClass('mic_btn_tl_chkd');  
		 $('#cover_a,#cover_b,#cover_d').removeClass('mic_btn_tl_chkd'); 
	  $('.id-cover-custom,#cus_sel_cover').hide();
	   $('#about_policy_holder').show();
    
        });
		
		/*$('#cover_d').click(function(){
		 $(this).addClass('mic_btn_tl_chkd');  
		 $('#cover_a,#cover_b,#cover_c').removeClass('mic_btn_tl_chkd'); 
		 $('#cus_sel_cover').show();
        });*/
		
			$(document).delegate('.cover_menu li','click',function() {
					$('#cover_d').addClass('mic_btn_tl_chkd');  
					 $('#cover_a,#cover_b,#cover_c').removeClass('mic_btn_tl_chkd'); 
   var am_v = $(this).text(); // gets text contents of clicked li
   $('.id-cover-custom').show();
    $('#about_policy_holder').show();
	$("#cover_other_select span").text(am_v);
	$('#cus_sel_cover').fadeOut();
	

});

	$(document).delegate('.close_cover_select','click',function() {
		
	  $('.id-cover-custom').hide();
	  $('#cover_d').removeClass('mic_btn_tl_chkd'); 
    
        });



		
	

////////////////////// CITY //////////////////	
			
			
			$('.city_a').click(function(){
		 $(this).addClass('mic_btn_tl_chkd');  
		 $('.city_b,.city_c,.city_d,.city_e,.city_f').removeClass('mic_btn_tl_chkd'); 
		  $('.id-city-custom,#cus_sel_city').hide();
		   $('#Policy_holder_details').show();
    
        });
		
		$('.city_b').click(function(){
		 $(this).addClass('mic_btn_tl_chkd');  
		 $('.city_a,.city_c,.city_d,.city_e,.city_f').removeClass('mic_btn_tl_chkd'); 
		  $('.id-city-custom,#cus_sel_city').hide();
		    $('#Policy_holder_details').show();
    
        });
		
		$('.city_c').click(function(){
		 $(this).addClass('mic_btn_tl_chkd');  
		 $('.city_b,.city_a,.city_d,.city_e,.city_f').removeClass('mic_btn_tl_chkd'); 
		  $('.id-city-custom,#cus_sel_city').hide();
		    $('#Policy_holder_details').show();
    
        });
		
		
		$('.city_d').click(function(){
		 $(this).addClass('mic_btn_tl_chkd');  
		 $('.city_b,.city_c,.city_a,.city_e,.city_f').removeClass('mic_btn_tl_chkd'); 
		  $('.id-city-custom,#cus_sel_city').hide();
		    $('#Policy_holder_details').show();
    
        });
		
		
		$('.city_e').click(function(){
		 $(this).addClass('mic_btn_tl_chkd');  
		 $('.city_b,.city_c,.city_d,.city_a,.city_f').removeClass('mic_btn_tl_chkd'); 
		    $('#Policy_holder_details').show();
    
        });
		
		$('.city_f').click(function(){
		 $(this).addClass('mic_btn_tl_chkd');  
		 $('.city_b,.city_c,.city_d,.city_a,.city_e').removeClass('mic_btn_tl_chkd'); 
		  $('#cus_sel_city').show();
		    $('#Policy_holder_details').show();
    
        });
			
			
			$(document).delegate('.city_menu li','click',function() {
						
   var am_c = $(this).text(); // gets text contents of clicked li
   $('.id-city-custom').show();
	$("#city_other_select span").text(am_c);
	$('#cus_sel_city').fadeOut();
	

});


$(document).delegate('.close_city_select','click',function() {
		
	  $('.id-city-custom').hide();
	  $('.city_f').removeClass('mic_btn_tl_chkd'); 
    
        });
			



$(document).mouseup(function (e)
{
    var container = $(".select-cover-section");

    if (!container.is(e.target) 
        && container.has(e.target).length === 0) 
    {
        $("#cus_sel_annual").hide();
    }
	
	var dur =$("#cus_sel_duration");
	  if (!dur.is(e.target) 
        && dur.has(e.target).length === 0) 
    {
        $("#cus_sel_duration").hide();
    }
	
	var amt =$("#cus_sel_cover");
	  if (!amt.is(e.target) 
        && amt.has(e.target).length === 0) 
    {
        $("#cus_sel_cover").hide();
    }
	
	var city_sel =$("#cus_sel_city");
	  if (!city_sel.is(e.target) 
        && city_sel.has(e.target).length === 0) 
    {
        $("#cus_sel_city").hide();
    }
	
	
});
		
		
		
	
	
	var d = new Date();
		var year = d.getFullYear() - 18 ;
		var child_age = d.getFullYear() - 26;
				$('.dob_datepicker').datepicker({
		changeMonth: true,
            changeYear: true,
			yearRange :'1940:'+ d,
		dateFormat: 'dd-mm-yy',
		defaultDate: new Date(year,d.getMonth(), d.getDate()),
					maxDate: new Date(),
										prevText: '<i class="fa fa-chevron-left"></i>',
					nextText: '<i class="fa fa-chevron-right"></i>',
					
	onSelect: function(){}
					
				});
		
		////////////////// end /////////
		
		
		
var sources = [];
$('.city_menu li').each(function(i,ele){
  sources.push({'label': $(ele).text(), 'value' : i});
});
$( "#city_s_auto" ).autocomplete({
    source: sources,
    open: function () {
        $(this).data("uiAutocomplete").menu.element.addClass("my_class");
    },
    select: function (e, ui) {

      //  alert("selected!");
	  
		var autotext = ui.item.label;
		$('.id-city-custom').show();
		$("#city_other_select span").text(autotext);
	$('#cus_sel_city').fadeOut();
	
		
    },

    change: function (e, ui) {

       
    }
	
	
});
  

});