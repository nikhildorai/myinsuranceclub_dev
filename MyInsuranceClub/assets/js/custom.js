

$(document).ready(function() {

	 $('#soi').mouseover(function(){
         $('#soi').addClass('active');   
	  if ( $("#tes" ).hasClass( "tes" ) ) {
		  
		   $("#target").load("http://192.168.2.201//include/social.html"); 
		  
		  } 
		        });
				
				
					$('#footer').mouseleave(function(){
				 
				 $('#soi').removeClass('active');  
	     $("#tes").remove();
        });

  
	
	$('#clickk').mouseenter(function(){
   var s = $("#o_touch");

    var pos = s.position();                    
    $(window).scroll(function() {
        var windowpos = $(window).scrollTop();
        if (windowpos+10 >= pos.top) {
         //  $(".choice").css({"top":20,"bottom":-270});
        } else {
         //  $(".choice").css({"top":-180,"bottom":0}); 
        }
    });
  $("#c_ch").stop().slideDown();
  }); 
  
  $('#c_ch').mouseleave(function(){
	  // $(".choice").css({"top":-170,"bottom":0});
	  
	    var s = $("#o_touch");

    var pos = s.position();                    
    $(window).scroll(function() {
        var windowpos = $(window).scrollTop();
        if (windowpos+10 >= pos.top) {
      //  $(".choice").css({"top":-170,"bottom":0});
        } else {
          //  $("p").css("background-color","yellow"); 
        }
	   });
	   $("#c_ch").slideUp("slow");
	   
	   
  });
  
/* js for policy term list */
 
  $('#clickk_p').mouseenter(function(){
	  $("#c_yr").stop().slideDown();
	  }); 
	  $('#c_yr').mouseleave(function(){
		   $("#c_yr").slideUp("slow");
	  });
  
 $("#c_term li").click(function() {

	   var am_v = $(this).text(); // gets text contents of clicked li
		$("#yr").text(am_v);
		$("#policy_term").val(am_v);
		 $("#c_yr").fadeOut();
	});
 /* js for policy term ends */
  
/*$("#clickk").hover(function () {
  $(".choice").slideToggle("fast");
});*/

$("#c_amt li").click(function() {

   var am_v = $(this).text(); // gets text contents of clicked li
	$("#rs").text(am_v);
	$("#coverage_amount").val(am_v);
	 $("#c_ch").fadeOut();
});



$('#clickk_f').mouseenter(function(){
  $("#c_ch_f").stop().slideDown();
  }); 
  $('#c_ch_f').mouseleave(function(){
	   $("#c_ch_f").slideUp("slow");
  });
$("#c_for_f li").click(function() {
   var am_v = $(this).text(); 
   var am_vid = $(this).data('compo-id');
	$("#c_for").text(am_v);
	if(am_v == 'myself'){
		//alert
		//$("#adlt_spc").fadeIn();
		$("#adlt_spc,#one_c,#two_c,#three_c,#four_c").fadeOut();
	}
	if(am_v == 'Self + Spouse'){
		//alert
		$("#adlt_spc").fadeIn();
		$("#one_c,#two_c,#three_c,#four_c").fadeOut();
	}
	if(am_v == 'Self + Spouse + 1 Child' ){
		$("#adlt_spc,#one_c").fadeIn();
		$("#two_c,#three_c,#four_c").fadeOut();
	}
	if(am_v == 'Self + Spouse + 2 Children' ){
		$("#adlt_spc,#one_c,#two_c").fadeIn();
		$("#three_c,#four_c").fadeOut();
	}
	if(am_v == 'Self + Spouse + 3 Children' ){
		$("#adlt_spc,#one_c,#two_c,#three_c").fadeIn();
		$("#four_c").fadeOut();
	}
	if(am_v == 'Self + Spouse + 4 Children' ){
		//$("#four_c").fadeIn();
		$("#adlt_spc,#one_c,#two_c,#three_c,#four_c").fadeIn();
	}
	
	$("#plan_type").val(am_vid);
	$("#plan_type_name").val(am_v);
	 $("#c_ch_f").fadeOut();
});


$('#clickk_g').mouseenter(function(){
  $("#c_ch_g").stop().slideDown();
  }); 
  $('#c_ch_g').mouseleave(function(){
	   $("#c_ch_g").slideUp("slow");
  });
  $("#c_for_g li").click(function() {
	   var am_v = $(this).text(); 
		$("#ge").text(am_v);
		$("#cust_gender").val(am_v);
		 $("#c_ch_g").fadeOut();
	});
  
  $("#c_for_occupation li").click(function() {
	   var am_v = $(this).text(); 
		$("#oc").text(am_v);
		$("#cust_occupation").val($(this).data('occupation-id'));
		$("#c_for_occupation").fadeOut();
	});

$('#clickk_l').mouseenter(function(){
	// $('#c_for_l').load('city/city.txt');
  $("#c_ch_l").stop().slideDown();
  $('.scroll-pane').jScrollPane();
  }); 
  $('#c_ch_l').mouseleave(function(){
	   $("#c_ch_l").slideUp("slow");
  });
$("#c_for_l li").click(function() {
   var am_v = $(this).text(); 
	var am_vid=$(this).data('city-id');
   $("#loc").text(am_v);
	$("#cust_city").val(am_vid);
	$("#cust_city_name").val(am_v);
	 $("#c_ch_l").fadeOut();
});







});
