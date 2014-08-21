
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
	        text: chart_title_text
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
	            //text: 'Premium'
	        },
	        plotBands: [{
	            from: 0,
	            to: 10000,
	            color: '#55BF3B' // green
	        }/*{
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
	        }*/]        
	    },
	
	    series: [{
	        name: 'Premium',
	        data: [chart_series_premium],
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
	        text: chart_title_text1
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
	            //text: 'Premium'
	        },
	        plotBands: [{
	            from: 0,
	            to: 10000,
	            color: '#55BF3B' // green
	        }/*{
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
	        }*/]        
	    },
	
	    series: [{
	        name: 'Premium',
	        data: [chart_series_premium1],
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
	        text: chart_title_text2
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
	            //text: 'Premium'
	        },
	        plotBands: [{
	            from: 0,
	            to: 10000,
	            color: '#55BF3B' // green
	        }/*{
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
	        }*/]          
	    },
	
	    series: [{
	        name: 'Premium',
	        data: [chart_series_premium2],
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
	        text: chart_title_text3
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
	            //text: 'Premium'
	        },
	        plotBands: [{
	            from: 0,
	            to: 10000,
	            color: '#55BF3B' // green
	        }/*{
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
	        }*/]       
	    },
	
	    series: [{
	        name: 'Premium',
	        data: [chart_series_premium3],
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
	        text: chart_title_text4
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
	            ////text: 'Premium'
	        },
	        plotBands: [{
	            from: 0,
	            to: 10000,
	            color: '#55BF3B' // green
	        }/*{
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
	        }*/]        
	    },
	
	    series: [{
	        name: 'Premium',
	        data: [chart_series_premium4],
	        tooltip: {
	            valuePrefix: 'Rs. '
	        },
		    dataLabels: {
	            enabled: true
	        }
	    }]
	
	}, 
	// Add some life
	function (chart) {});
	
	
	
	
	
    }
});










	
	
});







function DropDown(el) {
	this.dd = el;
	this.placeholder = this.dd.children('span');
	this.opts = this.dd.find('ul.dropdown > li');
	this.val = '';
	this.index = -1;
	this.initEvents();
}
DropDown.prototype = {
	initEvents : function() {
		var obj = this;

		obj.dd.on('click', function(event){
			$(this).toggleClass('active');
			return false;
		});

		obj.opts.on('click',function(){
			var opt = $(this);
			obj.val = opt.text();
			$(this).parent().parent().find('span').text(opt.text()).data('textval',opt.text()).data('dataval',opt.text());

			var sum_assured = $('#peer_comparision_sum_assured').data('dataval');
			var age = $('#peer_comparision_age').data('dataval');				

		//	console.log(age, $('#peer_comparision_age').data('dataval'), sum_assured, $('#peer_comparision_sum_assured').data('dataval'));
			var formData = {policy_slug:policy_slug, age:age, sum_assured:sum_assured,peerComparisionVariants:peerComparisionVariants, variant_type:variant_type};

		//	console.log(formData);
			
			var premium0 = 0; var premium1 = 0; var premium2 = 0; var premium3 = 0; var premium4 = 0;

			var chart = $('#container').highcharts();
			var point = chart.series[0].points[0];
					
			var chart1 = $('#container1').highcharts();
			var point1 = chart1.series[0].points[0];
					
			var chart2 = $('#container2').highcharts();
			var point2 = chart2.series[0].points[0];
					
			var chart3 = $('#container3').highcharts();
			var point3 = chart3.series[0].points[0];
					
			var chart4 = $('#container4').highcharts();
			var point4 = chart4.series[0].points[0];

			
			$.ajax({
					url:CI_ROOT+'common/getPeerComparisionView',
					type: "post",
					data: formData,
					success:function(result)
					{
						console.log(result);
						results = $.parseJSON(result);
						var maxY = parseInt(results.max);
						if(results.premium[0] != '')
						{
							chart.yAxis[0].setExtremes(0,maxY,true);
							chart.yAxis[0].addPlotBand({
				                from: 0,
				                to: maxY,
				                color: '#55BF3B',
				            });
							point.update(parseInt(results.premium[0]));
						}
						if(results.premium[1] != '')
						{
							chart1.yAxis[0].setExtremes(0,maxY);
							chart1.yAxis[0].addPlotBand({
				                from: 0,
				                to: maxY,
				                color: '#55BF3B',
				            });
							point1.update(parseInt(results.premium[1]));
						}
						if(results.premium[2] != '')
						{
							chart2.yAxis[0].setExtremes(0,maxY);
							chart2.yAxis[0].addPlotBand({
				                from: 0,
				                to: maxY,
				                color: '#55BF3B',
				            });
							point2.update(parseInt(results.premium[2]));
						}
						if(results.premium[3] != '')
						{
							chart3.yAxis[0].setExtremes(0,maxY);
							chart3.yAxis[0].addPlotBand({
				                from: 0,
				                to: maxY,
				                color: '#55BF3B',
				            });
							point3.update(parseInt(results.premium[3]));
						}
						if(results.premium[4] != '')
						{
							chart4.yAxis[0].setExtremes(0,maxY);
							chart4.yAxis[0].addPlotBand({
				                from: 0,
				                to: maxY,
				                color: '#55BF3B',
				            });
							point4.update(parseInt(results.premium[4]));
						}
						/*
						if(results.premium[0] != '')
							point1.update(parseInt(results.premium[1]));
						if(results.premium[2] != '')
							point2.update(parseInt(results.premium[2]));
						if(results.premium[3] != '')
							point3.update(parseInt(results.premium[3]));
						if(results.premium[4] != '')
							point4.update(parseInt(results.premium[4]));
						*/
			    	}
			});	
			
			//amt_value = $(this).val();

			/*

    newVal = point.y - premium0;
	newVal1 = point1.y - premium1;
	newVal2 = point2.y - premium2;
	newVal3 = point3.y - premium3;
	newVal4 = point4.y - premium4;
	
	point.update(premium0);
	point1.update(premium1);
	point2.update(premium2);
	point3.update(premium3);
	point4.update(premium4);*/
			obj.index = opt.index();
			obj.placeholder.text(obj.val);
		});
	},
	getValue : function() {
		return this.val;
	},
	getIndex : function() {
		return this.index;
	}
}




