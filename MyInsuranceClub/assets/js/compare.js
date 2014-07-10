
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


function show_prem(a,b) {
	  
	  var x = Math.floor((Math.random() * 20) + 110);
	  var y = Math.floor((Math.random() * 40) + 200);
	  
	  
  	  com_c.innerHTML = x;
  	  plan_c.innerHTML = y;
  
  	 pr_ra.innerHTML = a;
	  pr_rb.innerHTML = b;
  
}
var timeoutID;
delayedAlert();
function delayedAlert() {
  timeoutID = window.setTimeout(slowAlert, 1000);
}

function slowAlert() {
	
	$("#sh1").fadeIn();
  com_c.innerHTML = company_count;
  timeoutID = window.setTimeout(slowAlert1, 2000);
}

function slowAlert1() {
	$("#sh2").fadeIn();
	 plan_c.innerHTML = plan_count;
	 timeoutID = window.setTimeout(slowAlert3,3000);
}

function slowAlert3() {
	$("#sh3").fadeIn();
	 pr_ra.innerHTML = min_premium;
	  pr_rb.innerHTML = max_premium;
	  timeoutID = window.setTimeout(slowAlert4,4000);
	  timeoutID = window.setTimeout(slowAlert5,2000);
}

function slowAlert4() {
	 $("#loader").fadeOut();
   $("#prdt_dis").fadeIn();
}
function slowAlert5() {
	$("#sh4").fadeIn();
	
}

$(document).ready(function() {
	
	
	
	
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





$(".med_search").keyup(function () {
	var id=$(this);
	var minlength = 1;
        var that = this,
        value = $(this).val();

        if (value.length >= minlength ) {
            $.ajax({
                type: "GET",
                url: "source/medical.php",
                data: {
                    'search_keyword' : value
                },
               
                success: function(response){
				
					id.parent().parent().parent().find('.hos').show();
				
				   id.parent().parent().parent().find('.resultTable').html(response);
                }
            });
        }
		
		
		
    });
	
	
	
		$('.down_cnt').click(function() {
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
	
	$('.down_cnt_up').click(function() {
			//$('.accordion_a').slideToggle();
			
		//	$('.down_cnt').closest('.accordion_a').slideToggle();
		//$('.accordion_a').hide();
		$(this).parent().find('.down_cnt').removeClass("down_arw");
$(this).parent().parent().parent().parent().find('.accordion_a').slideToggle();
$(this).hide();
		
	});	
	
	$('.hide_d').click(function() {
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
      min: 100,
      max: 5000,
      values: [ 1000, 4000 ],
      slide: function( event, ui ) {
        $( "#amount" ).val( "₹ " + formatNumber(ui.values[ 0 ]));
		$( "#amount1" ).val( "₹ " + formatNumber(ui.values[ 1 ] ));
		
		
      }
    });
    $( "#amount" ).val( "₹ " + $( "#slider-range" ).slider( "values", 0 ));
	$( "#amount1" ).val( "₹ " + $( "#slider-range" ).slider( "values", 1 ) );
	   
	   
	   
	    $( "#slider-range1" ).slider({
      range: true,
      min: 1000,
      max: 17000,
      values: [ 3000, 7000 ],
      slide: function( event, ui ) {
        $("#amount_a" ).val( "₹ " + formatNumber(ui.values[ 0 ]));
		$("#amount1_a" ).val( "₹ " + formatNumber(ui.values[ 1 ]));
		var val_pa = ui.values[ 0 ];
  		var val_pb = ui.values[ 1 ];
		
		show_prem(val_pa,val_pb);
		
      }
    });
    $( "#amount_a" ).val( "₹ " + $( "#slider-range" ).slider( "values", 0 ));
	   $( "#amount1_a" ).val( "₹ " + $( "#slider-range" ).slider( "values", 1 ) );
	   
  

});

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

