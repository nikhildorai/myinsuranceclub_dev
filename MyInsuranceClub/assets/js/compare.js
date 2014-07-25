
var formatNumber = function(number)
{
	number += "";
	var parts = number.split('.');
	var integer = parts[0];
	var decimal = parts.length > 1 ? '.' + parts[1] : '';
	var regex = /(\d+)(\d{3})/;
	while (regex.test(integer))
	{
		integer = integer.replace(regex, '$1' + ',' + '$2');
	}
	return integer + decimal;
};


/**
 * 
 * @param  controller_url is the method
 *         where filter parameters are passed.
 * 
 * @methods using this function are Annual Premium
 *          & Claims Ratio Sliders, Search Filter
 *          Checkboxes.
 */
function send_ajax_post(controller_url)
{
	$('.no_odometer').addClass('odometer').removeClass('no_odometer');
	Odometer.init();
	data = $('#search').serialize();
		
	 $.ajax({
		 
	type:"post", 
	url: controller_url,
	data:data,
	success:function(data)
	{ 
		var s = $.parseJSON(data);
		
		$('#cmp_tbl').html(s.html);
		$('#plan_cnt').html(s.plan);
		plan_count = s.plan;
		company_count = s.company;
		min_premium = s.minPremium;
		max_premium = s.maxPremium;
		
		show_prem(min_premium,max_premium,company_count,plan_count);
	}
	});
}

function show_prem(x,y,a,b) {
	  
  	  com_c.innerHTML = a;
  	  plan_c.innerHTML = b;
  
  	 pr_ra.innerHTML = x;
	  pr_rb.innerHTML = y;
  
}

var timeoutID;
delayedAlert();
function delayedAlert() {
	if(searchScroll == "yes")
  	{
		timeoutID = window.setTimeout(slowAlert, 1000);
  	}
	else
		{
		timeoutID = window.setTimeout(slowAlert, 0);
		}
  }

function slowAlert() {
	
	com_c.innerHTML = company_count;
  	if(searchScroll == "yes")
  	{
  		$("#sh1").fadeIn();
  		timeoutID = window.setTimeout(slowAlert1, 500);
  	}
  	else
  	{	
  		$("#sh1").show();
  		timeoutID = window.setTimeout(slowAlert1, 0);
  	}
}

function slowAlert1() {
	plan_c.innerHTML = plan_count;
	 plan_cnt.innerHTML = plan_count;
	 if(searchScroll == "yes")
	  	{
		 $("#sh2").fadeIn();
		 timeoutID = window.setTimeout(slowAlert3, 750);
	  	}
	 else{
		 $("#sh2").show();
		 timeoutID = window.setTimeout(slowAlert3, 0);
	 	}
}

function slowAlert3() {
	pr_ra.innerHTML = min_premium;
	  pr_rb.innerHTML = max_premium;
	  if(searchScroll == "yes")
	  	{
		  $("#sh3").fadeIn();
		  timeoutID = window.setTimeout(slowAlert4,1200);
		  timeoutID = window.setTimeout(slowAlert5,1500);
	  	}
	  else
	  {
		  $("#sh3").show();
		  timeoutID = window.setTimeout(slowAlert4,0);
		  timeoutID = window.setTimeout(slowAlert5,0);
	  }
}

function slowAlert4() {
	$("#loader").fadeOut();
	if(searchScroll == "yes")
	{
		$("#prdt_dis").fadeIn();
	}else
		{
		$("#prdt_dis").show();
		}
}
function slowAlert5() {
	if(searchScroll == "yes")
	{
		$("#sh4").fadeIn();
	}
	else
		{
		$("#sh4").show();
		}
	
}

$(document).ready(function() {
	
	$('#sub_form').on('click',function(){

		$('#health_form').bind('submit').submit();
		});
	
	
	 /*$(document).mouseover(function(){
       $('.mouseout.modal').hide();
		        });
				
			$(document).mouseleave(function(){
				 
				$('.mouseout.modal').show();
        });*/
			
 $('#soi').mouseover(function(){
         $('#soi').addClass('active');   
	  if ( $("#tes" ).hasClass( "tes" ) ) {
		  
		   $("#target").load("include/social.php"); 
		  
		  } 
		        });
				
				
					$('#footer').mouseleave(function(){
				 
				 $('#soi').removeClass('active');  
	     $("#tes").remove();
        });





$(document).delegate('.med_search','keyup',function () {
						
						
//var data = $('#getlist').serialize();
var company_id = $(this).data('company-id');
var hospital_list_id = $(this).data('hospital-list-id');
var id=$(this);
var minlength = 1;
var that = this,
	value = $(this).val();
					        
	if (value.length >= minlength ) {
		$.ajax({
				type: "GET",
				url: hospital_list_url,
				data: {
					   'search_keyword' : value,
					   'company_id': company_id
					  },
					               
					   success: function(response){
									
						id.parent().parent().parent().find('.hos').show();
						$('#'+ hospital_list_id).html(response);
						//id.parent().parent().parent().find('.resultTable').html(response);
					    }
					});
				}
						
		});
	
	
		$(document).delegate('.down_cnt','click',function() {
			//$('.accordion_a').slideToggle();
			
		//	$('.down_cnt').closest('.accordion_a').slideToggle();
		//$('.accordion_a').hide();
		 $(this).toggleClass("down_arw");
		
$(this).parent().parent().parent().parent().find('.accordion_a').slideToggle();

 if ( $( this ).hasClass( "down_arw" ) ) {
 
       $(this).parent().find('.down_cnt_up').show();
 
    }
	else{
		$(this).parent().find('.down_cnt_up').hide();
	}
		
	});	
	
	$(document).delegate('.down_cnt_up','click',function() {
			//$('.accordion_a').slideToggle();
			
		//	$('.down_cnt').closest('.accordion_a').slideToggle();
		//$('.accordion_a').hide();
		$(this).parent().find('.down_cnt').removeClass("down_arw");
$(this).parent().parent().parent().parent().find('.accordion_a').slideToggle();
$(this).hide();
		
	});	
	
	$(document).delegate('.hide_d','click',function() {
			//$('.accordion_a').slideToggle();
			
		//	$('.down_cnt').closest('.accordion_a').slideToggle();
		//$('.accordion_a').hide();
$(this).parent().parent().parent().find('.accordion_a').slideToggle();
$(this).parent().parent().parent().find('.down_cnt').removeClass("down_arw");
$(this).parent().parent().parent().find('.down_cnt_up').hide();

$('html, body').animate({scrollTop: $(this).parent().parent().parent().offset().top}, 100);

//$('.down_cnt_up').hide();
		
	});	









    $( "#slider-range" ).slider({
      range: true,
      step:5,
      min: 0,
      max: 100,
      values: [ 0,100 ],
      slide: function( event, ui ) {
        $( "#amount" ).val(formatNumber(ui.values[ 0 ]) + " %");
		$( "#amount1" ).val(formatNumber(ui.values[ 1 ] + " %"));
		
		
      },
      
      stop: function( event, ui ) {
			data = $('#search').serialize();
	  		
			 $.ajax({
				 
			type:"post", 
			url: annual_premium_search_url,
			data:data,
			success:function(data)
			{ 
				$('#cmp_tbl').html(data);
			}
			});
		
		}
    });
    $( "#amount" ).val($( "#slider-range" ).slider( "values", 0 ) + " %");
	$( "#amount1" ).val($( "#slider-range" ).slider( "values", 1 ) + " %");
	   
	   
	
	/****************** Annual Premium Slider ****************/	   
	 
	 $( "#slider-range1" ).slider({
      range: true,
      min: parseInt(all_min_premium),
      max: parseInt(all_max_premium),
      values: [ parseInt(min_premium), parseInt(max_premium) ],
      slide: function( event, ui ) {
        $("#amount_a" ).val( "₹" + formatNumber(ui.values[ 0 ]));
		$("#amount1_a" ).val( "₹" + formatNumber(ui.values[ 1 ]));
		var val_pa = ui.values[ 0 ];
  		var val_pb = ui.values[ 1 ];
		
		
		
      },
      
      stop: function( event, ui )
      {
			
    	  send_ajax_post(annual_premium_search_url);
      }
			 
    });
    $( "#amount_a" ).val( "₹" + formatNumber($( "#slider-range1" ).slider( "values", 0 )));
	   $( "#amount1_a" ).val( "₹" + formatNumber($( "#slider-range1" ).slider( "values", 1 )) );	 
  

});

	/******************************************************/


	/***************** Search Filter Checboxes ************/

$('.search_filter').on('click',function(){
	
		send_ajax_post(annual_premium_search_url);
});

	/*****************************************************/
$(function () {
   
 /* var msie6 = $.browser == 'msie' && $.browser.version < 7;
   
  if (!msie6 && $('.block1').offset()!=null) {
    var top = $('.block1').offset().top - parseFloat($('.block1').css('margin-top').replace(/auto/, 0));
    var height = $('.block1').height();
    var winHeight = $(window).height(); 
    var footerTop = $('#bottom-bg').offset().top - parseFloat($('#bottom-bg').css('margin-top').replace(/auto/, 0));
    var gap = 7;
    $(window).scroll(function (event) {
      // what the y position of the scroll is
      var y = $(this).scrollTop();
       
      // whether that's below the form
      if (y+winHeight >= top+ height+gap && y+winHeight<=footerTop) {
        // if so, ad the fixed class
        $('.block1').addClass('leftsidebarfixed').css('top',winHeight-height-gap +'px');
      } 
      else if (y+winHeight>footerTop) {
        // if so, ad the fixed class
       $('.block1').addClass('leftsidebarfixed').css('top',footerTop-height-y-gap+'px');
      } 
      else    
      {
        // otherwise remove it
        $('.block1').removeClass('leftsidebarfixed').css('top','0px');
      }
    });
  }  */
});

    $(document).ready(function(){


    	
    	$(document).delegate('#comparePolicy','click',function() {
    		if(!($('.cmpplans:checked').length>1))
    		{
    		//	alert('Please Select At Least 2 Plans To Compare.');
    		 $(".alert_cmp strong").text('Oh ho!');
 $(".al_msg_cmp").text('Please select at least 2 plans to compare.');
    			 $(".alert_cmp,#modal_bak").show();

    			return false;
    		}
    		/*else if ($('.cmpplans:checked').length>3)
    		{
    			//alert('You can select maximum of 3 plans to compare.');
    			 $(".alert_cmp strong").text('Sorry, we tried. But it looks terrible.');
    			 $(".al_msg_cmp").text('You can select maximum of 3 plans to compare.');
    			 $(".alert_cmp,#modal_bak").show();
    			return false;
    		}*/
    		else
    		{
    			$('#compare').submit();
    		}
    	});	

$(document).delegate('.cmpplans','click',function() {

  var n = $( ".cmpplans:checked" ).length;
 if (n>3)
    		{
 				 $(".alert_cmp strong").text('Sorry, we tried. But it looks terrible.');
    			 $(".al_msg_cmp").text('You can select maximum of 3 plans to compare.');
    			 $(".alert_cmp,#modal_bak").show();
    			return false;

}


	});	
 

$(document).delegate('.close34','click',function() {
  
 $(".alert_cmp,#modal_bak").hide();

    	});	
    	
    	
    	
    	
    fadeLoop()
    function fadeLoop() {

        var counter = 0,
		
            divs = $('.fader').hide(),
            dur = 1300;

        function showDiv() {
			/* $('div.fader').animate({
    opacity: 0.25,
    height: 'toggle'
    }, 1000, function() {
// Animation complete.
    });*/
            $("div.fader").fadeOut(dur) // hide all divs
                .filter(function(index) {
                    return index == counter % divs.length;
                }) // figure out correct div to show
                .delay(dur) // delay until fadeout is finished
                .fadeIn(dur); // and show it
            counter++;
        }; // function to loop through divs and show correct div
        showDiv(); // show first div    
        return setInterval(function() {
            showDiv(); // show next div
        }, 1 * 5000); // do this every 7 seconds    
    };

    $(function() {
        var interval;

        $("#start").click(function() {
            if (interval == undefined){
                interval = fadeLoop();
                $(this).val("Stop");
            }
            else{
                clearInterval(interval);
                $(this).val("Start");
                interval = undefined;
            }
        });
    });
    });

    
    /**
     *@abstract counter for buy now button
     */
   
    function buy_now_msg(variant_id,policy_id)
    {
    	$('#buy_now_message_' + variant_id).show();
    	$('#buy_now_btn_' + variant_id).hide();
    	

    	$.ajax({
    		 
    		type:"post", 
    		url: increment_buyNow_url,
    		data:{'policy_id':policy_id}
    	
    	});

    	return false;
    }    
