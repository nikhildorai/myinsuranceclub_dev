
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
	
	$(".share-toggle.fa.fa-plus").click(function() {
 
   $(".share-buttons.v2").addClass('expanded');
	
});
$(".secondary-share-toggle.fa.fa-minus").click(function() {
 
   $(".share-buttons.v2").removeClass('expanded');
	
});


	$("#ratingDivParent").delegate(".ratingHover","hover", function(e){
		if (e.type == 'mouseenter') 
		{
			var id = $(this).attr('id');
			var ratingNum = $(this).data('num');
			var hoverRating = $(this).data('hover-rating');
			$(".rating-cls.user_starssel_0").addClass('user_stars2_2').removeClass('user_starssel_0');
			for ( var j = ratingNum; j < 10; j++ ) {
				$('#rating-id-'+j).addClass('level-0');
			}
			$(".rating-widget-num").show().text(hoverRating);
	    } 
		else 
	    {
			$(".rating-cls.user_stars2_2").addClass('user_starssel_0').removeClass('user_stars2_2');
			for ( var j = 1; j < 10; j++ ) {
				$('#rating-id-'+j).removeClass('level-0');
			}
			$(".rating-widget-num").hide().text('-');
	    }
	});

	$("#ratingDivParent").delegate(".ratingSystem","click", function(e){
		var id = $(this).attr('id');
		var ratingNum = $(this).data('num');
		var hoverRating = $(this).data('hover-rating');
		var url = CI_ROOT+"common/rating";
		var formData = {ratingNum:ratingNum, hoverRating:hoverRating, record:record, ratingType:ratingType };

		$(".rating-cls.user_starssel_0").addClass('user_stars2_2').removeClass('user_starssel_0');
		for ( var j = ratingNum; j < 10; j++ ) {
			$('#rating-id-'+j).addClass('level-0');
		}
		$(".rating-widget-num").show().text(hoverRating);
		$('.ratingSystem').removeClass('ratingHover').removeClass('ratingSystem');
		$.ajax({
				url:url,
				type: "post",
				data: formData,
				success:function(result)
				{
					result = $.parseJSON(result);
					$('#ratingValueId').text(result.rating_value);
					$('.tot_votes_m').html('based on '+result.rating_click_count);
		    	}
		});	
		
	});



	});




(function($) {
$.fn.tabs = function() {
	var selector = this;
	
	this.each(function() {
		var obj = $(this); 
		
		$(obj.attr('href')).hide();
		
		obj.click(function() {
			$(selector).removeClass('selected');
			
			$(this).addClass('selected');
			
			$($(this).attr('href')).fadeIn();
			
			$(selector).not(this).each(function(i, element) {
				$($(element).attr('href')).hide();
			});
			
			return false;
		});
	});

	$(this).show();
	
	$(this).first().click();
};
})(jQuery);


$(function () {
	
	/*$('div.chartdiv').each(function(i) {
  $(this).fadeIn(1000);
});

$('div.chartdiv1').each(function(i) {
  $(this).fadeIn(2000);
});


$('div.chartdiv2').each(function(i) {
  $(this).fadeIn(3000);
});

$('div.chartdiv3').each(function(i) {
  $(this).fadeIn(4000);
});

$('div.chartdiv4').each(function(i) {
  $(this).fadeIn(5000);
});*/

//$( "#members" ).delegate( "li a", "click", function( e ) {} );










var $ad_show_claim = $('#ad_show_claim');
var ad_show_claim_top = $ad_show_claim.offset().top;

var ad_show_claim_flag = false;

$(window).scroll(function (event) {
	ad_show_claim_top = $ad_show_claim.offset().top - 150;
    if(ad_show_claim_flag) return;
    // what the y position of the scroll is
    var y = $(window).scrollTop();

    // whether that's below the form
    if (y >= ad_show_claim_top) {
        
		  if ( $('#ad_show_claim').hasClass( "one_time" ) ) {
			  $('#ad_show_claim').removeClass('one_time');
		
		  $('#claims_ratio1').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: ''
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                type: 'category',
                labels: {
                    rotation: -45,
                    style: {
                        fontSize: '10px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Claims Ratio'
                },
                max: 100
            },
            legend: {
                enabled: false
            },
            tooltip: {
                pointFormat: 'Claims Ratio in 2014: <b>{point.y:.1f} %</b>',
            },
            series: [{
                name: 'Claim Ratio',
                data: companyClaimRatio,
                dataLabels: {
                    enabled: true,
                    rotation: -90,
                    color: '#1E316C',
                    align: 'right',
                    x: 4,
                    y: 10,
                    style: {
                        fontSize: '10px',
                        fontFamily: 'Verdana, sans-serif',
                        textShadow: '0 0 3px black'
                    }
                }
            }]
        });
		  }
		  else {
			  
		  }
		
		
		}
});















var $thisdiv = $('#thisdiv');
var thisdiv_top = $thisdiv.offset().top - 150;
var thisdiv_flag = false;

$(window).scroll(function (event) {
	 thisdiv_top = $thisdiv.offset().top - 150;
    if(thisdiv_flag) return;

    // what the y position of the scroll is
    var y = $(window).scrollTop();

    // whether that's below the form
    if (y >= thisdiv_top) {
        // if so, ad the fixed class
        $thisdiv.addClass('show_gauge');
        thisdiv_flag = true;
		
		 $('#container').highcharts({
	
	    chart: {
	        type: 'gauge',
	        plotBackgroundColor: null,
	        plotBackgroundImage: null,
	        plotBorderWidth: 0,
	        plotShadow: true
	    },
	    
	    title: {
	        text: 'HDFC Life Click 2 Protect'
	    },
	    
	    pane: {
	        startAngle: -150,
	        endAngle: 150,
	        background: [{
	            backgroundColor: {
	                linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
	                stops: [
	                    [0, '#FFF'],
	                    [1, '#333']
	                ]
	            },
	            borderWidth: 0,
	            outerRadius: '109%'
	        }, {
	            backgroundColor: {
	                linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
	                stops: [
	                    [0, '#333'],
	                    [1, '#FFF']
	                ]
	            },
	            borderWidth: 1,
	            outerRadius: '107%'
	        }, {
	            // default background
	        }, {
	            backgroundColor: '#DDD',
	            borderWidth: 0,
	            outerRadius: '105%',
	            innerRadius: '103%'
	        }]
	    },
	       
	    // the value axis
	    yAxis: {
	        min: 0,
	        max: 10000,
	        
	        minorTickInterval: 'auto',
	        minorTickWidth: 1,
	        minorTickLength: 10,
	        minorTickPosition: 'inside',
	        minorTickColor: '#666',
	
	        tickPixelInterval: 50,
	        tickWidth: 2,
	        tickPosition: 'inside',
	        tickLength: 10,
	        tickColor: '#666',
	        labels: {
	            step: 2,
	            rotation: 'auto'
	        },
	        title: {
	            text: 'Premium'
	        },
	        plotBands: [{
	            from: 0,
	            to: 5000,
	            color: '#55BF3B' // green
	        }, {
	            from: 5000,
	            to: 7000,
	            color: '#DDDF0D' // yellow
	        }, {
	            from: 7000,
	            to: 10000,
	            color: '#DF5353' // red
	        }]        
	    },
	
	    series: [{
	        name: 'Premium',
	        data: [7800],
	        tooltip: {
	            valueSuffix: ''
	        }
	    }]
	
	}, 
	// Add some life
	function (chart) {});
	
	
	
	
	
	
	
	
	
	$('#container1').highcharts({
	
	    chart: {
	        type: 'gauge',
	        plotBackgroundColor: null,
	        plotBackgroundImage: null,
	        plotBorderWidth: 0,
	        plotShadow: true
	    },
	    
	    title: {
	        text: 'Smart Health Insurance'
	    },
	    
	    pane: {
	        startAngle: -150,
	        endAngle: 150,
	        background: [{
	            backgroundColor: {
	                linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
	                stops: [
	                    [0, '#FFF'],
	                    [1, '#333']
	                ]
	            },
	            borderWidth: 0,
	            outerRadius: '109%'
	        }, {
	            backgroundColor: {
	                linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
	                stops: [
	                    [0, '#333'],
	                    [1, '#FFF']
	                ]
	            },
	            borderWidth: 1,
	            outerRadius: '107%'
	        }, {
	            // default background
	        }, {
	            backgroundColor: '#DDD',
	            borderWidth: 0,
	            outerRadius: '105%',
	            innerRadius: '103%'
	        }]
	    },
	       
	    // the value axis
	    yAxis: {
	        min: 0,
	        max: 10000,
	        
	        minorTickInterval: 'auto',
	        minorTickWidth: 1,
	        minorTickLength: 10,
	        minorTickPosition: 'inside',
	        minorTickColor: '#666',
	
	        tickPixelInterval: 50,
	        tickWidth: 2,
	        tickPosition: 'inside',
	        tickLength: 10,
	        tickColor: '#666',
	        labels: {
	            step: 2,
	            rotation: 'auto'
	        },
	        title: {
	            text: 'Premium'
	        },
	        plotBands: [{
	            from: 0,
	            to: 5000,
	            color: '#55BF3B' // green
	        }, {
	            from: 5000,
	            to: 7000,
	            color: '#DDDF0D' // yellow
	        }, {
	            from: 7000,
	            to: 10000,
	            color: '#DF5353' // red
	        }]        
	    },
	
	    series: [{
	        name: 'Premium',
	        data: [6000],
	        tooltip: {
	            valueSuffix: ''
	        }
	    }]
	
	}, 
	// Add some life
	function (chart) {});
	
	
	$('#container2').highcharts({
	
	    chart: {
	        type: 'gauge',
	        plotBackgroundColor: null,
	        plotBackgroundImage: null,
	        plotBorderWidth: 0,
	        plotShadow: true
	    },
	    
	    title: {
	        text: 'Medisure Classic'
	    },
	    
	    pane: {
	        startAngle: -150,
	        endAngle: 150,
	        background: [{
	            backgroundColor: {
	                linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
	                stops: [
	                    [0, '#FFF'],
	                    [1, '#333']
	                ]
	            },
	            borderWidth: 0,
	            outerRadius: '109%'
	        }, {
	            backgroundColor: {
	                linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
	                stops: [
	                    [0, '#333'],
	                    [1, '#FFF']
	                ]
	            },
	            borderWidth: 1,
	            outerRadius: '107%'
	        }, {
	            // default background
	        }, {
	            backgroundColor: '#DDD',
	            borderWidth: 0,
	            outerRadius: '105%',
	            innerRadius: '103%'
	        }]
	    },
	       
	    // the value axis
	    yAxis: {
	        min: 0,
	        max: 10000,
	        
	        minorTickInterval: 'auto',
	        minorTickWidth: 1,
	        minorTickLength: 10,
	        minorTickPosition: 'inside',
	        minorTickColor: '#666',
	
	        tickPixelInterval: 50,
	        tickWidth: 2,
	        tickPosition: 'inside',
	        tickLength: 10,
	        tickColor: '#666',
	        labels: {
	            step: 2,
	            rotation: 'auto'
	        },
	        title: {
	            text: 'Premium'
	        },
	        plotBands: [{
	            from: 0,
	            to: 5000,
	            color: '#55BF3B' // green
	        }, {
	            from: 5000,
	            to: 7000,
	            color: '#DDDF0D' // yellow
	        }, {
	            from: 7000,
	            to: 10000,
	            color: '#DF5353' // red
	        }]        
	    },
	
	    series: [{
	        name: 'Premium',
	        data: [7200],
	        tooltip: {
	            valueSuffix: ''
	        }
	    }]
	
	}, 
	// Add some life
	function (chart) {});
	
	
	$('#container3').highcharts({
	
	    chart: {
	        type: 'gauge',
	        plotBackgroundColor: null,
	        plotBackgroundImage: null,
	        plotBorderWidth: 0,
	        plotShadow: true
	    },
	    
	    title: {
	        text: 'Health Guard Individual'
	    },
	    
	    pane: {
	        startAngle: -150,
	        endAngle: 150,
	        background: [{
	            backgroundColor: {
	                linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
	                stops: [
	                    [0, '#FFF'],
	                    [1, '#333']
	                ]
	            },
	            borderWidth: 0,
	            outerRadius: '109%'
	        }, {
	            backgroundColor: {
	                linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
	                stops: [
	                    [0, '#333'],
	                    [1, '#FFF']
	                ]
	            },
	            borderWidth: 1,
	            outerRadius: '107%'
	        }, {
	            // default background
	        }, {
	            backgroundColor: '#DDD',
	            borderWidth: 0,
	            outerRadius: '105%',
	            innerRadius: '103%'
	        }]
	    },
	       
	    // the value axis
	    yAxis: {
	        min: 0,
	        max: 10000,
	        
	        minorTickInterval: 'auto',
	        minorTickWidth: 1,
	        minorTickLength: 10,
	        minorTickPosition: 'inside',
	        minorTickColor: '#666',
	
	        tickPixelInterval: 50,
	        tickWidth: 2,
	        tickPosition: 'inside',
	        tickLength: 10,
	        tickColor: '#666',
	        labels: {
	            step: 2,
	            rotation: 'auto'
	        },
	        title: {
	            text: 'Premium'
	        },
	        plotBands: [{
	            from: 0,
	            to: 5000,
	            color: '#55BF3B' // green
	        }, {
	            from: 5000,
	            to: 7000,
	            color: '#DDDF0D' // yellow
	        }, {
	            from: 7000,
	            to: 10000,
	            color: '#DF5353' // red
	        }]        
	    },
	
	    series: [{
	        name: 'Premium',
	        data: [4500],
	        tooltip: {
	            valueSuffix: ''
	        }
	    }]
	
	}, 
	// Add some life
	function (chart) {});
	
	
	
	$('#container4').highcharts({
	
	    chart: {
	        type: 'gauge',
	        plotBackgroundColor: null,
	        plotBackgroundImage: null,
	        plotBorderWidth: 0,
	        plotShadow: true
	    },
	    
	    title: {
	        text: 'MediPrime Insurance'
	    },
	    
	    pane: {
	        startAngle: -150,
	        endAngle: 150,
	        background: [{
	            backgroundColor: {
	                linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
	                stops: [
	                    [0, '#FFF'],
	                    [1, '#333']
	                ]
	            },
	            borderWidth: 0,
	            outerRadius: '109%'
	        }, {
	            backgroundColor: {
	                linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
	                stops: [
	                    [0, '#333'],
	                    [1, '#FFF']
	                ]
	            },
	            borderWidth: 1,
	            outerRadius: '107%'
	        }, {
	            // default background
	        }, {
	            backgroundColor: '#DDD',
	            borderWidth: 0,
	            outerRadius: '105%',
	            innerRadius: '103%'
	        }]
	    },
	       
	    // the value axis
	    yAxis: {
	        min: 0,
	        max: 10000,
	        
	        minorTickInterval: 'auto',
	        minorTickWidth: 1,
	        minorTickLength: 10,
	        minorTickPosition: 'inside',
	        minorTickColor: '#666',
	
	        tickPixelInterval: 50,
	        tickWidth: 2,
	        tickPosition: 'inside',
	        tickLength: 10,
	        tickColor: '#666',
	        labels: {
	            step: 2,
	            rotation: 'auto'
	        },
	        title: {
	            text: 'Premium'
	        },
	        plotBands: [{
	            from: 0,
	            to: 5000,
	            color: '#55BF3B' // green
	        }, {
	            from: 5000,
	            to: 7000,
	            color: '#DDDF0D' // yellow
	        }, {
	            from: 7000,
	            to: 10000,
	            color: '#DF5353' // red
	        }]        
	    },
	
	    series: [{
	        name: 'Premium',
	        data: [7000],
	        tooltip: {
	            valueSuffix: ''
	        }
	    }]
	
	}, 
	// Add some life
	function (chart) {});
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
    }
});






$('#c_amt').on('change', function() {
  amt_value = $(this).val();
	   
	   	var chart = $('#container').highcharts();
	   var point = chart.series[0].points[0],
		            newVal;
					
					var chart1 = $('#container1').highcharts();
	   var point1 = chart1.series[0].points[0],
		            newVal1;
					
					var chart2 = $('#container2').highcharts();
	   var point2 = chart2.series[0].points[0],
		            newVal2;
					
					
					var chart3 = $('#container3').highcharts();
	   var point3 = chart3.series[0].points[0],
		            newVal3;
					
					
					var chart4 = $('#container4').highcharts();
	   var point4 = chart4.series[0].points[0],
		            newVal4;
					
	   if(amt_value == "1"){
		        
		        newVal = point.y - 2000;
				newVal1 = point1.y - 2000;
				newVal2 = point2.y - 2000;
				newVal3 = point3.y - 2000;
				newVal4 = point4.y - 2000;
				point.update(newVal);
				point1.update(newVal1);
				point2.update(newVal2);
				point3.update(newVal3);
				point4.update(newVal4);
  
	   }
	    if(amt_value == "50"){
			
		        
		        newVal = point.y + 2000;
				
				newVal1 = point1.y + 2000;
				newVal2 = point2.y + 2000;
				newVal3 = point3.y + 2000;
				newVal4 = point4.y + 2000;
				
				point.update(newVal);
				point1.update(newVal1);
				point2.update(newVal2);
				point3.update(newVal3);
				point4.update(newVal4);
	   }
	   
	   
    
});





$(".com_premium").delegate( "", "click", function( e ) {
	$(this).removeClass('com_premium');
	$(".count_shw").show();
	
	
// $("#count_shw").fadeIn(18050);
	
    $('#container').highcharts({
	
	    chart: {
	        type: 'gauge',
	        plotBackgroundColor: null,
	        plotBackgroundImage: null,
	        plotBorderWidth: 0,
	        plotShadow: true
	    },
	    
	    title: {
	        text: 'Religare Care'
	    },
	    
	    pane: {
	        startAngle: -150,
	        endAngle: 150,
	        background: [{
	            backgroundColor: {
	                linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
	                stops: [
	                    [0, '#FFF'],
	                    [1, '#333']
	                ]
	            },
	            borderWidth: 0,
	            outerRadius: '109%'
	        }, {
	            backgroundColor: {
	                linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
	                stops: [
	                    [0, '#333'],
	                    [1, '#FFF']
	                ]
	            },
	            borderWidth: 1,
	            outerRadius: '107%'
	        }, {
	            // default background
	        }, {
	            backgroundColor: '#DDD',
	            borderWidth: 0,
	            outerRadius: '105%',
	            innerRadius: '103%'
	        }]
	    },
	       
	    // the value axis
	    yAxis: {
	        min: 0,
	        max: 10000,
	        
	        minorTickInterval: 'auto',
	        minorTickWidth: 1,
	        minorTickLength: 10,
	        minorTickPosition: 'inside',
	        minorTickColor: '#666',
	
	        tickPixelInterval: 50,
	        tickWidth: 2,
	        tickPosition: 'inside',
	        tickLength: 10,
	        tickColor: '#666',
	        labels: {
	            step: 2,
	            rotation: 'auto'
	        },
	        title: {
	            text: 'Premium'
	        },
	        plotBands: [{
	            from: 0,
	            to: 5000,
	            color: '#55BF3B' // green
	        }, {
	            from: 5000,
	            to: 7000,
	            color: '#DDDF0D' // yellow
	        }, {
	            from: 7000,
	            to: 10000,
	            color: '#DF5353' // red
	        }]        
	    },
	
	    series: [{
	        name: 'Premium',
	        data: [7800],
	        tooltip: {
	            valueSuffix: ''
	        }
	    }]
	
	}, 
	// Add some life
	

	function (chart) {
		if (!chart.renderer.forExport) {
		    setInterval(function () {
		        var point = chart.series[0].points[0],
		            newVal,
		            inc = Math.round((Math.random() - 0.5) * 20);
		        
		        newVal = point.y + inc;
		        if (newVal < 0 || newVal > 200) {
		            newVal = point.y - inc;
		        }
		        
		     //   point.update(newVal);
		        
		    }, 3000);
		}
	});
	
	
	
	
	
	
	
	
	$('#container1').highcharts({
	
	    chart: {
	        type: 'gauge',
	        plotBackgroundColor: null,
	        plotBackgroundImage: null,
	        plotBorderWidth: 0,
	        plotShadow: true
	    },
	    
	    title: {
	        text: 'Smart Health Insurance'
	    },
	    
	    pane: {
	        startAngle: -150,
	        endAngle: 150,
	        background: [{
	            backgroundColor: {
	                linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
	                stops: [
	                    [0, '#FFF'],
	                    [1, '#333']
	                ]
	            },
	            borderWidth: 0,
	            outerRadius: '109%'
	        }, {
	            backgroundColor: {
	                linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
	                stops: [
	                    [0, '#333'],
	                    [1, '#FFF']
	                ]
	            },
	            borderWidth: 1,
	            outerRadius: '107%'
	        }, {
	            // default background
	        }, {
	            backgroundColor: '#DDD',
	            borderWidth: 0,
	            outerRadius: '105%',
	            innerRadius: '103%'
	        }]
	    },
	       
	    // the value axis
	    yAxis: {
	        min: 0,
	        max: 10000,
	        
	        minorTickInterval: 'auto',
	        minorTickWidth: 1,
	        minorTickLength: 10,
	        minorTickPosition: 'inside',
	        minorTickColor: '#666',
	
	        tickPixelInterval: 50,
	        tickWidth: 2,
	        tickPosition: 'inside',
	        tickLength: 10,
	        tickColor: '#666',
	        labels: {
	            step: 2,
	            rotation: 'auto'
	        },
	        title: {
	            text: 'Premium'
	        },
	        plotBands: [{
	            from: 0,
	            to: 5000,
	            color: '#55BF3B' // green
	        }, {
	            from: 5000,
	            to: 7000,
	            color: '#DDDF0D' // yellow
	        }, {
	            from: 7000,
	            to: 10000,
	            color: '#DF5353' // red
	        }]        
	    },
	
	    series: [{
	        name: 'Premium',
	        data: [6000],
	        tooltip: {
	            valueSuffix: ''
	        }
	    }]
	
	}, 
	// Add some life
	function (chart) {});
	
	
	$('#container2').highcharts({
	
	    chart: {
	        type: 'gauge',
	        plotBackgroundColor: null,
	        plotBackgroundImage: null,
	        plotBorderWidth: 0,
	        plotShadow: true
	    },
	    
	    title: {
	        text: 'Smart Health Insurance'
	    },
	    
	    pane: {
	        startAngle: -150,
	        endAngle: 150,
	        background: [{
	            backgroundColor: {
	                linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
	                stops: [
	                    [0, '#FFF'],
	                    [1, '#333']
	                ]
	            },
	            borderWidth: 0,
	            outerRadius: '109%'
	        }, {
	            backgroundColor: {
	                linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
	                stops: [
	                    [0, '#333'],
	                    [1, '#FFF']
	                ]
	            },
	            borderWidth: 1,
	            outerRadius: '107%'
	        }, {
	            // default background
	        }, {
	            backgroundColor: '#DDD',
	            borderWidth: 0,
	            outerRadius: '105%',
	            innerRadius: '103%'
	        }]
	    },
	       
	    // the value axis
	    yAxis: {
	        min: 0,
	        max: 10000,
	        
	        minorTickInterval: 'auto',
	        minorTickWidth: 1,
	        minorTickLength: 10,
	        minorTickPosition: 'inside',
	        minorTickColor: '#666',
	
	        tickPixelInterval: 50,
	        tickWidth: 2,
	        tickPosition: 'inside',
	        tickLength: 10,
	        tickColor: '#666',
	        labels: {
	            step: 2,
	            rotation: 'auto'
	        },
	        title: {
	            text: 'Premium'
	        },
	        plotBands: [{
	            from: 0,
	            to: 5000,
	            color: '#55BF3B' // green
	        }, {
	            from: 5000,
	            to: 7000,
	            color: '#DDDF0D' // yellow
	        }, {
	            from: 7000,
	            to: 10000,
	            color: '#DF5353' // red
	        }]        
	    },
	
	    series: [{
	        name: 'Premium',
	        data: [6000],
	        tooltip: {
	            valueSuffix: ''
	        }
	    }]
	
	}, 
	// Add some life
	function (chart) {});
	
	
	$('#container3').highcharts({
	
	    chart: {
	        type: 'gauge',
	        plotBackgroundColor: null,
	        plotBackgroundImage: null,
	        plotBorderWidth: 0,
	        plotShadow: true
	    },
	    
	    title: {
	        text: 'Smart Health Insurance'
	    },
	    
	    pane: {
	        startAngle: -150,
	        endAngle: 150,
	        background: [{
	            backgroundColor: {
	                linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
	                stops: [
	                    [0, '#FFF'],
	                    [1, '#333']
	                ]
	            },
	            borderWidth: 0,
	            outerRadius: '109%'
	        }, {
	            backgroundColor: {
	                linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
	                stops: [
	                    [0, '#333'],
	                    [1, '#FFF']
	                ]
	            },
	            borderWidth: 1,
	            outerRadius: '107%'
	        }, {
	            // default background
	        }, {
	            backgroundColor: '#DDD',
	            borderWidth: 0,
	            outerRadius: '105%',
	            innerRadius: '103%'
	        }]
	    },
	       
	    // the value axis
	    yAxis: {
	        min: 0,
	        max: 10000,
	        
	        minorTickInterval: 'auto',
	        minorTickWidth: 1,
	        minorTickLength: 10,
	        minorTickPosition: 'inside',
	        minorTickColor: '#666',
	
	        tickPixelInterval: 50,
	        tickWidth: 2,
	        tickPosition: 'inside',
	        tickLength: 10,
	        tickColor: '#666',
	        labels: {
	            step: 2,
	            rotation: 'auto'
	        },
	        title: {
	            text: 'Premium'
	        },
	        plotBands: [{
	            from: 0,
	            to: 5000,
	            color: '#55BF3B' // green
	        }, {
	            from: 5000,
	            to: 7000,
	            color: '#DDDF0D' // yellow
	        }, {
	            from: 7000,
	            to: 10000,
	            color: '#DF5353' // red
	        }]        
	    },
	
	    series: [{
	        name: 'Premium',
	        data: [6000],
	        tooltip: {
	            valueSuffix: ''
	        }
	    }]
	
	}, 
	// Add some life
	function (chart) {});
	
	
	
	$('#container4').highcharts({
	
	    chart: {
	        type: 'gauge',
	        plotBackgroundColor: null,
	        plotBackgroundImage: null,
	        plotBorderWidth: 0,
	        plotShadow: true
	    },
	    
	    title: {
	        text: 'Smart Health Insurance'
	    },
	    
	    pane: {
	        startAngle: -150,
	        endAngle: 150,
	        background: [{
	            backgroundColor: {
	                linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
	                stops: [
	                    [0, '#FFF'],
	                    [1, '#333']
	                ]
	            },
	            borderWidth: 0,
	            outerRadius: '109%'
	        }, {
	            backgroundColor: {
	                linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
	                stops: [
	                    [0, '#333'],
	                    [1, '#FFF']
	                ]
	            },
	            borderWidth: 1,
	            outerRadius: '107%'
	        }, {
	            // default background
	        }, {
	            backgroundColor: '#DDD',
	            borderWidth: 0,
	            outerRadius: '105%',
	            innerRadius: '103%'
	        }]
	    },
	       
	    // the value axis
	    yAxis: {
	        min: 0,
	        max: 10000,
	        
	        minorTickInterval: 'auto',
	        minorTickWidth: 1,
	        minorTickLength: 10,
	        minorTickPosition: 'inside',
	        minorTickColor: '#666',
	
	        tickPixelInterval: 50,
	        tickWidth: 2,
	        tickPosition: 'inside',
	        tickLength: 10,
	        tickColor: '#666',
	        labels: {
	            step: 2,
	            rotation: 'auto'
	        },
	        title: {
	            text: 'Premium'
	        },
	        plotBands: [{
	            from: 0,
	            to: 5000,
	            color: '#55BF3B' // green
	        }, {
	            from: 5000,
	            to: 7000,
	            color: '#DDDF0D' // yellow
	        }, {
	            from: 7000,
	            to: 10000,
	            color: '#DF5353' // red
	        }]        
	    },
	
	    series: [{
	        name: 'Premium',
	        data: [6000],
	        tooltip: {
	            valueSuffix: ''
	        }
	    }]
	
	}, 
	// Add some life
	function (chart) {});
	
	
	});
	
	
});

function calculateEMI1(){
			//	alert('s');
			
}

$(document).ready(function(){
	
$("#la_value").keyup(function(){
  //calculateEMI();
});

			
			function calculateEMI(){
			
				var loanAmount = $("#la_value").val();
				var numberOfMonths = $("#nm_value").val();
				var rateOfInterest = $("#roi_value").val();
				var monthlyInterestRatio = (rateOfInterest/100)/12;
				
				var top = Math.pow((1+monthlyInterestRatio),numberOfMonths);
				var bottom = top -1;
				var sp = top / bottom;
				var emi = ((loanAmount * monthlyInterestRatio) * sp);
				var full = numberOfMonths * emi;
				var interest = full - loanAmount;
				var int_pge =  (interest / full) * 100;
				$("#tbl_int_pge").html(int_pge.toFixed(2)+" %");
				//$("#tbl_loan_pge").html((100-int_pge.toFixed(2))+" %");
				
				var emi_str = emi.toFixed(2).toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
				var loanAmount_str = loanAmount.toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
				var full_str = full.toFixed(2).toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
				var int_str = interest.toFixed(2).toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
				
				$("#emi").html(emi);
				$("#tbl_emi").html(emi_str);
				$("#tbl_la").html(loanAmount_str);
				$("#tbl_nm").html(numberOfMonths);
				$("#tbl_roi").html(rateOfInterest);
				$("#tbl_full").html(full_str);
				$("#tbl_int").html(int_str);
				var detailDesc = "<thead><tr class='success'><th>Payment No.</th><th>Begining Balance</th><th>EMI</th><th>Principal</th><th>Interest</th><th>Ending Balance</th></thead><tbody>";
				var bb=parseInt(loanAmount);
				var int_dd =0;var pre_dd=0;var end_dd=0;
				for (var j=1;j<=numberOfMonths;j++){
					int_dd = bb * ((rateOfInterest/100)/12);
					pre_dd = emi.toFixed(2) - int_dd.toFixed(2);
					end_dd = bb - pre_dd.toFixed(2);
					detailDesc += "<tr><td>"+j+"</td><td>"+bb.toFixed(2)+"</td><td>"+emi.toFixed(2)+"</td><td>"+pre_dd.toFixed(2)+"</td><td>"+int_dd.toFixed(2)+"</td><td>"+end_dd.toFixed(2)+"</td></tr>";
					bb = bb - pre_dd.toFixed(2);
				}
					detailDesc += "</tbody>";
				$("#illustrate").html(detailDesc);
				 $('#container').highcharts({
				 
						chart: {
							plotBackgroundColor: null,
							plotBorderWidth: null,
							plotShadow: false
						},
						title: {
							text: 'EMI Calculator'
						},
						tooltip: {
							//pointFormat: '{series.name}: <b>{point.value}%</b>'
						},
						plotOptions: {
							pie: {
								allowPointSelect: true,
								cursor: 'pointer',
								dataLabels: {
								//	enabled: true,
									color: '#000000',
									connectorColor: '#000000',
									format: '<b>{point.name}</b>: {point.percentage:.1f} %'
								}
							}
						},
						series: [{
							type: 'pie',
							name: 'Amount',
							data: [
								['Loan',   eval(loanAmount)],
								['Interest',       eval(interest.toFixed(2))]
							]
						}]
					});			
			
			}
		//	calculateEMI();

		});