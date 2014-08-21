<?php 
$server = base_url();//$this->util->getUrl('currentPageUrl');
?>
<!doctype html>
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'>
        <title>MyInsuranceClub</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
        <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic' rel='stylesheet' type='text/css'>
        <!-- needs images, font... therefore can not be part of ui.css -->
        <link rel="stylesheet" href="<?php echo $server;?>dist/bower_components/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo $server;?>dist/bower_components/weather-icons/css/weather-icons.min.css">
        <script src="<?php echo $server;?>dist/bower_components/jquery/dist/jquery.min.js"></script>
        
        <!-- tagit -->
        <link rel="stylesheet" href="<?php echo $server;?>css/jquery.tagit.css">
        <link rel="stylesheet" href="<?php echo $server;?>css/tagit.ui-zendesk.css">
    	<script src="<?php echo $server;?>JS/jquery-ui.1.9.2.min.js" type="text/javascript"></script>
        <script src="<?php echo $server;?>JS/tag-it.js" type="text/javascript" charset="utf-8"></script>
        <script src="<?php echo $server;?>assets/js/common.js" type="text/javascript" charset="utf-8"></script>
        <script src="<?php echo $server;?>assets/js/jquery.slugify.js" type="text/javascript" charset="utf-8"></script>
        <script src="<?php echo $server;?>assets/js/jquery.cookie.js" type="text/javascript" charset="utf-8"></script>
        
        <!-- end needs images -->

            <!-- build:css styles/ui.css -->
            <link rel="stylesheet" href="<?php echo $server;?>dist/bower_components/morris.js/morris.css">
            <!-- endbuild -->
            <link rel="stylesheet" href="<?php echo $server;?>dist/styles/main.css">

	   <script type="text/javascript">
	      CI_ROOT = "<?php echo base_url() ?>";
	   </script>
    </head>
	<?php if (! $this->flexi_auth->is_logged_in()) { ?>
    	<body id="app" class="ng-scope body-special 123" data-off-canvas-nav="" data-custom-background="" data-ng-app="app">
	<?php } else { ?>
   	 	<body data-ng-app="app" id="app" data-custom-background data-off-canvas-nav>
    <?php }?>
        <!--[if lt IE 9]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <div data-ng-controller="AppCtrl">
		<?php if (! $this->flexi_auth->is_logged_in()) { ?>
            <div  class="ng-hide"  data-ng-hide="isSpecificPage()" data-ng-cloak>
            </div>
		<?php } else { ?>
            <div data-ng-hide="isSpecificPage()" data-ng-cloak>

                <section data-ng-include1=" '<?php echo site_url("application/views/header.html");?>' " id="header" class="top-header">
                    <?php $this->load->view('admin/adminHeader'); ?> 
                </section>

                <aside data-ng-include1=" '<?php echo $server;?>dist/views/nav.html' " id="nav-container" class="ng-scope" >
                    <?php $this->load->view('admin/adminNav'); ?> 
                </aside>
            </div>
		<?php }	?>
            <div class="view-container">
                <section data-ng-view1 id="content" class="animate-fade-up">
                	<?php echo $content; ?>
                </section>
            </div>
        </div>
<script type="text/javascript">
$(document).ready(function(){

	$('#goto_page_btn').click(function(){
		var hrefVal = $('#goto_page_dd').find(':selected').data('href');
		window.location.href = hrefVal;
	});
	
	/*
	$('#goto_page_dd').change(function(){
		var hrefVal = $('#goto_page_dd').find(':selected').data('href');
		window.location.href = hrefVal;
	});
	*/
});
</script>

        <!-- build:js scripts/vendor.js -->
        <script src="<?php echo $server;?>dist/bower_components/angular/angular.min.js"></script>
        <script src="<?php echo $server;?>dist/bower_components/angular-route/angular-route.min.js"></script>
        <script src="<?php echo $server;?>dist/bower_components/angular-animate/angular-animate.min.js"></script>
        <script src="<?php echo $server;?>dist/bower_components/underscore/underscore-min.js"></script>
        <!-- endbuild -->

        <!-- build:js scripts/ui.js -->
        <script src="<?php echo $server;?>dist/bower_components/angular-bootstrap/ui-bootstrap-tpls.min.js"></script>
        <script src="<?php echo $server;?>dist/bower_components/jquery-spinner/dist/jquery.spinner.min.js"></script>
        <script src="<?php echo $server;?>dist/bower_components/seiyria-bootstrap-slider/dist/bootstrap-slider.min.js"></script>
        <script src="<?php echo $server;?>dist/bower_components/jquery-steps/build/jquery.steps.min.js"></script>
        <script src="<?php echo $server;?>dist/bower_components/toastr/toastr.min.js"></script>
        <script src="<?php echo $server;?>dist/bower_components/bootstrap-file-input/bootstrap.file-input.js"></script>
        <script src="<?php echo $server;?>dist/bower_components/jquery.slimscroll/jquery.slimscroll.min.js"></script>
        <script src="<?php echo $server;?>dist/bower_components/holderjs/holder.js"></script>
        <script src="<?php echo $server;?>dist/bower_components/raphael/raphael-min.js"></script>
        <script src="<?php echo $server;?>dist/bower_components/morris.js/morris.js"></script>
        <script src="<?php echo $server;?>dist/scripts/vendors/responsive-tables.js"></script>
        <script src="<?php echo $server;?>dist/scripts/vendors/jquery.sparkline.min.js"></script>
        <script src="<?php echo $server;?>dist/bower_components/flot/jquery.flot.js"></script>
        <script src="<?php echo $server;?>dist/bower_components/flot/jquery.flot.resize.js"></script>
        <script src="<?php echo $server;?>dist/bower_components/flot/jquery.flot.pie.js"></script>
        <script src="<?php echo $server;?>dist/bower_components/flot/jquery.flot.stack.js"></script>
        <script src="<?php echo $server;?>dist/bower_components/flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
        <script src="<?php echo $server;?>dist/bower_components/flot/jquery.flot.time.js"></script>
        <script src="<?php echo $server;?>dist/bower_components/gauge.js/dist/gauge.min.js"></script>
        <script src="<?php echo $server;?>dist/bower_components/jquery.easy-pie-chart/dist/angular.easypiechart.min.js"></script>
        <script src="<?php echo $server;?>dist/bower_components/angular-wizard/dist/angular-wizard.min.js"></script>
        <script src="<?php echo $server;?>dist/bower_components/textAngular/dist/textAngular-sanitize.min.js"></script>
        <script src="<?php echo $server;?>dist/bower_components/textAngular/dist/textAngular.min.js"></script>
        <script src="<?php echo $server;?>dist/scripts/vendors/skycons.js"></script>
        <!-- endbuild -->

        <!-- build:js({.tmp,app}) scripts/app.js -->
        <script src="<?php echo $server;?>dist/scripts/app.js"></script>
        <script src="<?php echo $server;?>dist/scripts/shared/main.js"></script>
        <script src="<?php echo $server;?>dist/scripts/shared/directives.js"></script>
        <script src="<?php echo $server;?>dist/scripts/shared/localize.js"></script>
        <script src="<?php echo $server;?>dist/scripts/UI/UICtrl.js"></script>
        <script src="<?php echo $server;?>dist/scripts/UI/UIDirective.js"></script>
        <script src="<?php echo $server;?>dist/scripts/UI/UIService.js"></script>
        <script src="<?php echo $server;?>dist/scripts/Form/FormDirective.js"></script>
        <script src="<?php echo $server;?>dist/scripts/Form/FormCtrl.js"></script>
        <script src="<?php echo $server;?>dist/scripts/Form/FormValidation.js"></script>
        <script src="<?php echo $server;?>dist/scripts/Table/TableCtrl.js"></script>
        <script src="<?php echo $server;?>dist/scripts/Task/Task.js"></script>
        <script src="<?php echo $server;?>dist/scripts/Chart/ChartCtrl.js"></script>
        <script src="<?php echo $server;?>dist/scripts/Chart/ChartDirective.js"></script>
        <!-- endbuild -->
    </body>
     
<script type="text/javascript">
<?php if (! $this->flexi_auth->is_logged_in()) { ?>
$('body').addClass('body-special');
<?php } ?>
</script>    
    
</html>


<?php /*?>
<!doctype html>
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Web Application</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
        <link href="http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic" rel="stylesheet" type="text/css">
        <!-- needs images, font... therefore can not be part <?php echo $server;?>dist/scripts       <link rel="stylesheet" href="<?php echo $server;?>dist/bower_components/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo $server;?>dist/bower_components/weather-icons/css/weather-icons.min.css">
        <!-- end needs images -->

            <link rel="stylesheet" href="<?php echo $server;?>dist/styles/ui.css"/>
            <link rel="stylesheet" href="<?php echo $server;?>dist/styles/main.css">

    </head>
    <body data-ng-app="app" id="app" data-custom-background="" data-off-canvas-nav="">
        <!--[if lt IE 9]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <div data-ng-controller="AppCtrl">
            <div data-ng-hide="isSpecificPage()" data-ng-cloak="">
                <section data-ng-include=" '<?php echo base_url();?>application/views/header.html' " id="header" class="top-header"></section>

                <aside data-ng-include=" '<?php echo $server;?>dist/views/nav.html' " id="nav-container"></aside>
            </div>

            <div class="view-container">
                <section data-ng-view="" id="content" class="animate-fade-up"></section>
            </div>
        </div>


        <script src="<?php echo $server;?>dist/scripts/vendor.js"></script>

        <script src="<?php echo $server;?>dist/scripts/ui.js"></script>

        <script src="<?php echo $server;?>dist/scripts/app.js"></script>
    </body>
</html>


<?php /*?>
<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>My Insurance Club</title>
	<meta name="description" content="My Insurance Club"/> 
	<meta name="keywords" content="My Insurance Club"/>
	<?php $this->load->view('admin/includes/head'); ?> 
</head>

<!-- Scripts -->  
<?php $this->load->view('admin/includes/scripts'); ?> 
<body id="login">

<div id="body_wrap">
	<!-- Header -->  
	<?php $this->load->view('admin/includes/header'); ?> 

	<!-- Demo Navigation -->
	<?php $this->load->view('admin/includes/demo_header'); ?> 
	
	
	<!-- Main Content -->
	<div class="content_wrap main_content_bg">
		<?php echo $content;?>
	</div>	
	
	<!-- Footer -->  
	<?php $this->load->view('admin/includes/footer'); ?> 
</div>


</body>
</html>
*/?>