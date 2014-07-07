
/*global jRespond */
var jPM = {};
jQuery(document).ready(function () {
  
    jQuery().clingify && jQuery("[data-toggle=clingify]").clingify({
        breakpoint: 1010
    });
 
});


$(document).ready(function() {
	
	
	
	$('#menu').slicknav({
    'open': function(trigger){
		
		
		
        var that = trigger.parent().children('ul');
        $('.slicknav_menu ul li.slicknav_open ul').each(function(){
            if($(this).get( 0 ) != that.get( 0 )){
                $(this).slideUp().addClass('slicknav_hidden');
                $(this).parent().removeClass('slicknav_open').addClass('slicknav_collapsed');
				 $(this).parent().find('span').text('▼');
            }
        })
		
		
		
    }, 
});

//$('#menu').slicknav('open');
	
$('.bxslider').bxSlider({
                 mode: 'horizontal',
                 slideMargin: 3,
				 touchEnabled:false,
				                 auto:true
             });  
	

	
	


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

 
  


/*$(document).click(function(event) { 
    if(!$(event.target).closest('#c_ch').length) {
        if($('#c_ch').is(":visible")) {
            $('#c_ch').hide()
        }
    }        
})*/
//FIRST

//$('.scroll-pane').jScrollPane();

/*$('.scroll-pane').jScrollPane({
                    autoReinitialise: false,
                    mouseWheelSpeed: 30,
                    contentWidth: '0px'
                });*/
				
 $('#clickk').click(function() {
  // $("#c_ch").stop().slideDown();
    $("#c_ch").show();
  $('.scroll-pane').jScrollPane();
   /* $('.scroll-pane').jScrollPane(
                                {autoReinitialise: true}
                         );*/
  }); 
var mouseOverActiveElement = false;
$('#clickk').live('mouseenter', function(){
    mouseOverActiveElement = true; 
	
}).live('mouseleave', function(){ 
    mouseOverActiveElement = false; 
	 $("#c_ch").fadeOut();
	/* if (!mouseOverActiveElement) {
        console.log('clicked outside active element');
		   $("#c_ch").slideUp("slow");
    }*/
});
$("html").click(function(){ 
   /* if (!mouseOverActiveElement) {
        console.log('clicked outside active element');
		   $("#c_ch").slideUp("slow");
    }*/
});

$("#c_amt li").click(function() {
//alert('a');
   var am_v = $(this).text(); // gets text contents of clicked li
	$("#rs").text(am_v);
	var am_vid = $(this).data('cvg-id');
	$("#coverage_amount").val(am_v);
	$("#coverage_amount_literal").val(am_vid);
 mouseOverActiveElement = false; 
  if (!mouseOverActiveElement) {
		 
		  // $("#c_ch").stop().slideUp();
		    $("#c_ch").fadeOut();
    }
});



//SECOND

$('#clickk_f').click(function(){
  //$("#c_ch_f").stop().slideDown();
  $("#c_ch_f").show();
  $('.scroll-pane').jScrollPane();
  }); 
 

var mouseOverActiveElement1 = false;
$('#clickk_f').live('mouseenter', function(){
    mouseOverActiveElement1 = true; 
}).live('mouseleave', function(){ 
    mouseOverActiveElement1 = false; 
	$("#c_ch_f").fadeOut();
});
/*$("html").click(function(){ 
    if (!mouseOverActiveElement1) {
        console.log('clicked outside active element');
		   $("#c_ch_f").slideUp("slow");
    }
});*/


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
	if(am_v == 'Self + 1 Child'){
		//alert
		$("#one_c").fadeIn();
		$("#adlt_spc,#two_c,#three_c,#four_c").fadeOut();
	}
	
	if(am_v == 'Self + 2 Children'){
		//alert
		$("#one_c,#two_c").fadeIn();
		$("#adlt_spc,#three_c,#four_c").fadeOut();
	}
	if(am_v == 'Self + 3 Children'){
		//alert
		$("#one_c,#two_c,#three_c").fadeIn();
		$("#adlt_spc,#four_c").fadeOut();
	}
	if(am_v == 'Self + 4 Children'){
		//alert
		$("#one_c,#two_c,#three_c,#four_c").fadeIn();
		$("#adlt_spc").fadeOut();
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
	 mouseOverActiveElement1 = false; 
	 $("#c_ch_f").fadeOut();
});



//THIRD

$('#clickk_g').click(function(){
  //$("#c_ch_g").stop().slideDown();
    $("#c_ch_g").show();
 
  }); 
 

var mouseOverActiveElement2 = false;
$('#clickk_g').live('mouseenter', function(){
    mouseOverActiveElement2 = true; 
}).live('mouseleave', function(){ 
    mouseOverActiveElement2 = false; 
	 $("#c_ch_g").fadeOut();
});
/*$("html").click(function(){ 
    if (!mouseOverActiveElement2) {
        console.log('clicked outside active element');
		   $("#c_ch_g").slideUp("slow");
    }
});*/


$("#c_for_g li").click(function() {
   var am_v = $(this).text(); 
	$("#ge").text(am_v);
	$("#cust_gender").val(am_v);
	  mouseOverActiveElement2 = false; 
	   $("#c_ch_g").fadeOut();
});


//FOUR
$("#c_for_occupation li").click(function() {
	   var am_v = $(this).text(); 
		$("#oc").text(am_v);
		$("#cust_occupation").val($(this).data('occupation-id'));
		  mouseOverActiveElement2 = false; 
		   $("#c_ch_g").fadeOut();
	});


$('#clickk_l').click(function(){
 //$("#c_ch_l").stop().slideDown();
 $("#c_ch_l").show();
 // $('.scroll-pane').jScrollPane();
 
  //  this.value = '';
   // $(".ui-combobox-input").autocomplete("search", '');

  }); 
 

var mouseOverActiveElement3 = false;
$('#clickk_l').live('mouseenter', function(){
    mouseOverActiveElement3 = true; 
}).live('mouseleave', function(){ 
    mouseOverActiveElement3 = false; 
	// $("#c_ch_l").fadeOut();
});
$("body").click(function(){ 
    if (!mouseOverActiveElement3) {
       // console.log('clicked outside active element');
		//   $("#c_ch_l").slideUp("slow");
		  $("#c_ch_l").fadeOut();
    }
});


/*$('.ui-autocomplete').live('mouseenter', function(){
    mouseOverActiveElement3 = true; 
}).live('mouseleave', function(){ 
    mouseOverActiveElement3 = false; 
	 $("#c_ch_l").fadeOut();
});*/

$("#c_for_l li").click(function() {
   var am_v = $(this).text(); 
   var rrr = $("#combobox").val();
   alert(rrr);
	//var am_vid=$(this).data('city-id');
   $("#loc").text(am_v);
   $("#cust_city_name").val(am_v);
	//$("#cust_city").val(am_vid);
	 	  mouseOverActiveElement3 = false; 
		  $("#c_ch_l").fadeOut();

});

$(".ui-autocomplete li").click(function() {
	alert('dd');
  
/*8080402284
*/});

/* js for policy term list */
 
  $('#clickk_p').mouseenter(function(){
	  $("#c_yr").stop().slideDown();
	  }); 
	  $('#c_yr').mouseleave(function(){
		   $("#c_yr").slideUp("slow");
	  });
  
 $("#c_term li").click(function() {

	   var am_v = $(this).text(); 
		$("#yr").text(am_v);
		$("#policy_term").val(am_v);
		 $("#c_yr").fadeOut();
	});
 /* js for policy term ends */
  
/*$("#clickk").hover(function () {
  $(".choice").slideToggle("fast");
});*/

















});


/**
 *  a jQuery plugin for creating simple, user-friendly, 508-compliant,
 *  iPhone-style slider-toggles using a mix of HTML, CSS, and Javascript.
 *
 *  @author rees.byars
 */ (function ($) {

    var sliderTogglePluginName = "sliderToggle12";

    /**
     * values for keycodes, mainly for use in 508
     */
    var keyCodes = {
        tab: 9,
        enter: 13,
        space: 32,
        left: 37,
        up: 38,
        right: 39,
        down: 40
    };

    var defaults = {
        height: 28,
        width: 78,
        ballwidth: 18,
        tabindex: 0,
        speed: 300
    };

    function SliderToggle(element, options) {
        this.element = element;
        this.options = $.extend({}, defaults, options);
        this.options = $.extend({}, this.options, $(element).data());
        this.init();
    }

    SliderToggle.prototype = {

        init: function () {

            var $container = $(this.element);
            var $choices = $container.children('input[type=radio]');

            if ($choices.length != 2) {
                alert("Error:  the slider toggle container [" + $container.attr('id') + "] must contain exactly 2 radio inputs");
                return;
            }

            // get the two radio options and hide them since we are "replacing" them with our own
            var $leftRadio = $($choices[0]).hide();
            var $rightRadio = $($choices[1]).hide();

            // get the text to display on the left and right sides of the slider, use label if present, use radio value otherwise
            function getText($radio) {
                var $label = $('label[for="' + $radio.attr('id') + '"]');
                if ($label.length <= 0) {
                    return $radio.val();
                }
                $label.hide();
                return $label.text();
            }
            var onText = getText($leftRadio);
            var offText = getText($rightRadio);

            /*
             setup rest the values to be used
             */

            var height = this.options.height;
            var width = this.options.width;
            var ballWidth = this.options.ballwidth;
            var ballRight = width - ballWidth - 2; //2 due to the border
            var hideWidth = ballWidth / 2;
            var showWidth = width - hideWidth;
            var speed = this.options.speed;
            var tabIndex = $leftRadio.attr('tabindex');
            if (!tabIndex) {
                tabIndex = this.options.tabindex;
            }

            /*
             style and/or create all the elements
             */

            var $label = $container.children('.slider-toggle-label-text')
                .css({
                'line-height': height + 'px'
            })
                .height(height);

            var $leftP = $('<p></p>')
                .height(height)
                .css({
                'line-height': height + 'px',
                'margin-left': 27 + 'px'
            });
            var $rightP = $('<p></p>')
                .height(height)
                .css({
                'line-height': height + 'px',
                'margin-right': 20 + 'px'
            });

            var $leftTextSpan = $('<span role="radio"></span>')
                .addClass('slider-toggle-text')
                .addClass('left')
                .append($leftP)
                .height(height);
            var $rightTextSpan = $('<span role="radio"></span>')
                .addClass('slider-toggle-text')
                .addClass('right')
                .append($rightP)
                .height(height);

            var $ballSpan = $('<span><i class="fa fa-bars fa-rotate-45"></i></span>')
                .addClass('slider-toggle-ball')
                .height(height)
                .width(ballWidth);

            var $frame = $('<div role="radiogroup"></div>')
                .addClass('slider-toggle-frame')
                .height(height)
                .width(width)
                .append($leftTextSpan)
                .append($rightTextSpan)
                .append($ballSpan)
                .attr('aria-labelledby', $label.attr('id'))
                .attr('id', $container.attr('id') + '_frame');

            // make the toggle container an ARIA application if it is not already part of one
            if ($container.parents('*[role=application]').length == 0) {
                $container.attr('role', 'application');
            }

            $container
                .height(height)
                .append($frame);

            /*
             functions for toggling the slider left and right
             */

            var moveBallRight = function () {
                $leftRadio.prop('checked', true);
                $rightRadio.prop('checked', false);
                $leftTextSpan.attr('aria-checked', 'true').attr('tabindex', tabIndex);
                $rightTextSpan.attr('aria-checked', 'false').attr('tabindex', -1);
                $leftP.text('MALE');
                $rightP.text('FEMALE');
                $leftTextSpan.removeClass('super');
                $rightTextSpan.addClass('super');
                $ballSpan.stop().animate({
                    left: ballRight + 2
                }, speed);
                $leftTextSpan.stop().animate({
                    width: showWidth 
                }, speed);
                $rightTextSpan.stop().animate({
                    width: hideWidth
                }, {
                    duration: speed,
                    done: function () {
                        $rightP.text("");
                    }
                });
            };

            var moveBallLeft = function () {
                $leftRadio.prop('checked', false);
                $rightRadio.prop('checked', true);
                $leftTextSpan.attr('aria-checked', 'false').attr('tabindex', -1);
                $rightTextSpan.attr('aria-checked', 'true').attr('tabindex', tabIndex);
                $leftP.text('MALE');
                $rightP.text('FEMALE');
                $leftTextSpan.addClass('super');
                $rightTextSpan.removeClass('super');
                $ballSpan.stop().animate({
                    left: 0
                }, speed);
                $rightTextSpan.stop().animate({
                    width: showWidth
                }, speed);
                $leftTextSpan.stop().animate({
                    width: hideWidth
                }, {
                    duration: speed,
                    done: function () {
                        $leftP.text("MALE");
                    }
                });
            };

            /*
             bind event handling to the slider components
             */

            $ballSpan.draggable({
                containment: "parent",
                scrollSpeed: speed,
                drag: function (event, ui) {
                    $leftTextSpan.width(function () {
                        var w = ui.position.left + hideWidth;
                        if (w < width / 2) {
                            $leftTextSpan.removeClass('super');
                            $rightTextSpan.addClass('super');
                        } else {
                            $leftTextSpan.addClass('super');
                            $rightTextSpan.removeClass('super');
                        }
                        return w;
                    });
                    $rightTextSpan.width(function () {
                        return showWidth - ui.position.left;
                    });
                },
                start: function () {
                    $leftP.text('MALE');
                    $rightP.text('FEMALE');
                },
                stop: function (event, ui) {
                    if (ui.position.left < (width / 2) - (ballWidth / 2)) {
                        moveBallLeft();
                    } else {
                        moveBallRight();
                    }
                }
            });
            
            $ballSpan.on(
                "touchstart touchmove touchend touchcancel", function(event) {
                    
                    if (event.originalEvent.touches.length > 1) {
                      return;
                    }
                
                    event.preventDefault();
                
                    var touch = event.originalEvent.changedTouches[0],
                        simulatedEvent = document.createEvent('MouseEvents');
                
                    var simulatedEvent = document.createEvent("MouseEvent");
                        simulatedEvent.initMouseEvent({
                        touchstart: "mousedown",
                        touchmove: "mousemove",
                        touchend: "mouseup"
                    }[event.type], true, true, window, 1,
                        touch.screenX, touch.screenY,
                        touch.clientX, touch.clientY, false,
                        false, false, false, 0, null);

                    event.target.dispatchEvent(simulatedEvent);
                    
            });

            $frame.focus(function () {
                if ($leftRadio.is(':checked')) {
                    $leftTextSpan.focus();
                } else {
                    $rightTextSpan.focus();
                }
            });

            $frame.keydown(function (e) {

                if (e.altKey) {
                    return true;
                }

                if (e.keyCode == keyCodes.left || e.keyCode == keyCodes.up || e.keyCode == keyCodes.right || e.keyCode == keyCodes.down) {

                    if (e.shiftKey) {
                        // do nothing
                        return true;
                    }
                    if (!$leftRadio.is(':checked')) {
                        moveBallRight();
                        $leftTextSpan.focus();
                    } else {
                        moveBallLeft();
                        $rightTextSpan.focus();
                    }

                    e.preventDefault();
                    e.stopPropagation();
                    return false;

                } else if (e.keyCode == keyCodes.space || e.keyCode == keyCodes.enter) {
                    $frame.focus();
                    e.preventDefault();
                    e.stopPropagation();
                    return false;
                }

                return true;

            });

            $frame.click(function () {
                if (!$leftRadio.is(':checked')) {
                    moveBallRight();
                } else {
                    moveBallLeft();
                }
            });


            /*
             initialize the state of the slider
             */

            var checked = $container.data('initialvalue') == $leftRadio.val();
            if (checked) {
                $leftRadio.prop('checked', true);
                $leftP.text('MALE');
                $rightP.text("FEMALE");
                $leftTextSpan.attr('aria-checked', 'true').attr('tabindex', tabIndex);
                $leftTextSpan.width(showWidth);
                $ballSpan.css({
                    left: ballRight
                });
            } else {
                $rightRadio.prop('checked', true);
                $leftP.text("MALE");
                $rightP.text('FEMALE');
                $rightTextSpan.attr('aria-checked', 'true').attr('tabindex', tabIndex);
                $rightTextSpan.width(showWidth);
                $ballSpan.css({
                    left: 0
                });
            }

        }

    };

    /**
     *  Creates a simple, user-friendly, 508-compliant, iPhone-style slider-toggles using a mix of HTML, CSS, and Javascript.
     *
     *  The plugin is designed to be used on hidden input elements.  For example, the following HTML:
     *   <pre>
     *      &lt;input id=&quot;mySliderToggle&quot; type=&quot;hidden&quot; name=&quot;myField&quot; value=&quot;0&quot;&gt;
     *   </pre>
     *   Can be turned into a slider-toggle with the following Javascript:
     *   <pre>
     *      $(#mySliderToggle).sliderToggle({
     *          height: 28,
     *          width: 78,
     *          ballwidth: 18,
     *          tabindex: 0,
     *          speed: 300
     *      });
     *   </pre>
     *
     *   Additionally, the generated toggle will inherit the title and tab index of the hidden input.
     *
     *   In order to work appropriately, pages uses this plugin must also link to the slider-toggle.less
     *
     *   <p/>
     *
     *   @author rees.byars
     */
    $.fn.sliderToggle = function (options) {

        return this.each(function () {

            if (!$.data(this, "plugin_" + sliderTogglePluginName)) {
                $.data(this, "plugin_" + sliderTogglePluginName, new SliderToggle(this, options));
            }

        });

    };

    $.fn.sliderToggleVal = function () {

        var val = $(this).children(':checked').val();

        if (val === undefined) {
            val = $(this).data('initialvalue');
        }

        return val;

    };

})(jQuery);

jQuery(document).ready(function () {
    
    jQuery('#myToggle,#myToggle1,#myToggle2,#myToggle3,#myToggle4').sliderToggle();
    
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