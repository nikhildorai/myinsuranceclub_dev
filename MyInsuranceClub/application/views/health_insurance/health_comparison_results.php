<!DOCTYPE html>
<html lang="en" ng-app="myApp">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<title>Compare Insurance Policies and Plans in India |
	MyInsuranceClub.com</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="Description"
	content="Compare and get free quotes for the best life insurance, health insurance, travel insurance, car and auto insurance plans, policies and schemes in India offered by different insurance companies only at MyInsuranceClub.com" />
<meta name="Keywords"
	content="compare insurance, best life insurance, best health insurance, cheap car insurance, auto insurance quote, cheap travel insurance, affordable insurance, best insurance policy, insurance companies in India" />

<!-- Bootstrap CSS -->
<link
	href="<?php echo base_url();?>/assets/css/bootstrap/bootstrap.min.css"
	rel="stylesheet">

<!-- Bootstrap third-party plugins css -->
<link
	href="<?php echo base_url();?>/assets/css/bootstrap/bootstrap-switch.min.css"
	media="screen" rel="stylesheet" />
<!-- Font Awesome -->
<link href="<?php echo base_url();?>/assets/css/font-awesome.min.css"
	rel="stylesheet">

<!-- Plugins -->

<!-- style -->
<link href="<?php echo base_url();?>/assets/css/theme-style.min.css"
	rel="stylesheet">

<!-- custom override -->
<link href="<?php echo base_url();?>/assets/css/custom-style.css"
	rel="stylesheet">
<link href="<?php echo base_url();?>/assets/css/clingify.css"
	rel="stylesheet">
<link href="<?php echo base_url();?>/assets/css/jquery.bxslider.css"
	rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css"
	href="<?php echo base_url();?>/assets/css/slick.css" />
<link rel="stylesheet"
	href="<?php echo base_url();?>/assets/css/slicknav.css">

<link rel="stylesheet"
	href="<?php echo base_url();?>/assets/css/custom.css">

<link href="<?php echo base_url();?>/assets/css/angular.rangeSlider.css"
	rel="stylesheet">

<style type="text/css" id="page-css">
/* Styles specific to this particular page */
.scroll-pane {
	width: 100%;
	height: 200px;
	overflow: auto;
}
</style>

<!-- HTML5 shiv & respond.js for IE6-8 support of HTML5 elements & media queries -->
<!--[if lt IE 9]>
    <script src="plugins/html5shiv/dist/html5shiv.js"></script>
    <![endif]-->

<!-- Le fav and touch icons - @todo: fill with your icons or remove -->
<link rel="shortcut icon"
	href="<?php echo base_url();?>/assets/img/icons/favicon.png">
<link
	href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,300'
	rel='stylesheet' type='text/css'>

<!--Retina.js plugin - @see: http://retinajs.com/-->
<script
	src="<?php echo base_url();?>/assets/plugins/js/retina-1.1.0.min.js"></script>
</head>

<!-- ======== @Region: body ======== -->
<body class="page page-index">

<?php $this->load->view('partial_view/header_resultpage');?>

<?php echo anchor('health_insurance/basicMediclaim/health_policy','Go Back To Search Results');?>

<table border='1'>
<?php 
	if (!empty($result))
	{	
		
		foreach ($result as $k1=>$v1)
		{
			
			echo '<tr>';
			
				echo '<td><b>'.$k1.'</b></td>';
				foreach ($v1 as $k2=>$v2)
				{
					if (!empty($v2)){
						if($v2=='Base')
						{
							$v2='N/A';
						}
						echo '<td>'.$v2.'</td>';
					}
					else 
						echo '<td>N/A</td>';
				}
				
			echo '</tr>';
		}
	}
?>

</table>


<?php echo $this->load->view('partial_view/footer_resultpage');?>


	<!-- ======== @Region: #navigation ======== -->

	<!--Scripts -->

	<!--Legacy jQuery support for quicksand plugin-->

	<!-- Bootstrap JS -->

	<!--Bootstrap third-party plugins-->

	<!--JS plugins-->
	<script
		src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.6.2/modernizr.min.js"></script>

	<script src="<?php echo base_url();?>/assets/js/jquery.min.js"></script>


	<!--Legacy jQuery support for quicksand plugin-->
	<script
		src="<?php echo base_url();?>/assets/js/jquery-migrate-1.2.1.min.js"></script>

	<!-- Bootstrap JS -->
	<script src="<?php echo base_url();?>/assets/js/bootstrap.min.js"></script>

	<!--Bootstrap third-party plugins-->
	<script
		src="<?php echo base_url();?>/assets/js/bootstrap-hover-dropdown.min.js"></script>
	<script src="<?php echo base_url();?>/assets/js/bootstrap-switch.min.js"></script>

	<!--JS plugins-->
	<script src="<?php echo base_url();?>/assets/js/jquery.clingify.min.js"></script>
	<script
		src="<?php echo base_url();?>/assets/js/jquery.jpanelmenu.min.js"></script>
	<script src="<?php echo base_url();?>/assets/js/jRespond.js"></script>


	<!--Custom scripts mainly used to trigger libraries -->
	<script src="<?php echo base_url();?>/assets/js/script.min.js"></script>
	<script src="<?php echo base_url();?>/assets/js/jquery.bxslider.min.js"
		type="text/javascript"></script>
	<script type='text/javascript' src='<?php echo base_url();?>/assets/js/jquery.carouFredSel.js'></script>
	<script
		src="<?php echo base_url();?>/assets/js/jquery.ui.accordion.min.js"></script>

	<script src="<?php echo base_url();?>/assets/js/jquery.slicknav.js"></script>


	<script src="<?php echo base_url();?>/assets/js/jquery.cluetip.js"></script>
	<!-- <script src="../lib/jquery.cluetip.compat.js"></script> -->
	<script src="<?php echo base_url();?>/assets/js/demo.js"></script>

	<script type="text/javascript"
		src="<?php echo base_url();?>/assets/js/jquery.mousewheel.js"></script>
	<!-- the jScrollPane script -->
	<script type="text/javascript"
		src="<?php echo base_url();?>/assets/js/jquery.jscrollpane.min.js"></script>
	<script src="<?php echo base_url();?>/assets/js/scrolltopcontrol.js"></script>
	<script src="<?php echo base_url();?>/assets/js/angular.min.js"></script>
	<!-- and out directive code -->
	<script src="<?php echo base_url();?>/assets/js/angular.rangeSlider.js"></script>

	<script src="<?php echo base_url();?>/assets/js/custom.js"></script>
	<script>
		// basic angular app setup
		var app = angular.module('myApp', ['ui-rangeSlider']);

		app.controller('DemoController',
        	function DemoController($scope) {

        		// just some values for the sliders
        		$scope.demo2 = {
					range: {
						min:<?php echo $min_annual_premium;?>,
						max: <?php echo $max_annual_premium;?>
					},
					minPrice: <?php echo $min_annual_premium;?>,
					maxPrice: <?php echo $max_annual_premium;?>

					
				};

        	}
				
        );


		app.controller('DemoController34',
        	function DemoController34($scope) {

        		// just some values for the sliders
        		$scope.demo1 = {
    min:0,
    max: 100
};

        	}
			
        );
	</script>
	<script type="text/javascript">
$(document).ready(function(){
	$('#menu').slicknav();
	
	$(document).delegate('.down_cnt','click',function() {
			//$('.accordion_a').slideToggle();
		//	$('.down_cnt').closest('.accordion_a').slideToggle();
		//$('.accordion_a').slideToggle();
$(this).parent().parent().parent().find('.accordion_a').slideToggle();
		
	});	
	
});

(function($) {
	$(document).ready(function() {

		$('#comparePolicy').on('click',function(){
			if(!($('.refundable:checked').length>1))
			{
				alert('Please Select At Least 2 Plans To Compare.');
				return false;
			}
			else if ($('.refundable:checked').length>3)
			{
				alert('You can select maximum of 3 policies to compare.');
				return false;
			}
			else
			{
				$('#compare').submit();
			}
		});

		$('.accordion').accordion({
			collapsible: true,
			heightStyle : 'content'
			
		});
		$('.accordion.closed').accordion("option", "active", false );
	});

	$('.search_filter').on('click',function(){
		data = $('#search').serialize();

		 $.ajax({
			type:"post", 
			url:"<?php echo base_url().'index.php/health_insurance/criticalIllness/get_critical_illness_results'?>",
			data:data,
			 success:function(data)
			{ $('#cmp_tbl').html(data);
			}
			});
	});
})(jQuery);
</script>




</body>
</html>

