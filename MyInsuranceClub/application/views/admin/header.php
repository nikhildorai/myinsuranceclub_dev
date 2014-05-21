<!DOCTYPE html>
<html lang="en">
  <head>
	<meta charset="utf-8">
	<title>Admin</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Admin panel developed with the Bootstrap from Twitter.">
	<meta name="author" content="dev" >

	<link href="<?=VIEWBASE?>admin/css/bootstrap.css" rel="stylesheet">
	<link href="<?=VIEWBASE?>admin/css/custom.css" rel="stylesheet">
	<link href="<?=VIEWBASE?>admin/css/bootstrap-responsive.css" rel="stylesheet">
	
	<script type="text/javascript" src="<?=VIEWBASE?>admin/js/jquery.latest.js"></script>
	
	<script type="text/javascript" src="<?=VIEWBASE?>admin/js/bootstrap.min.js"></script>
	<script language="javascript" type="text/javascript" src="<?=VIEWBASE?>admin/chartsPlugin/flot/jquery.flot.js"></script>
	<script language="javascript" type="text/javascript" src="<?=VIEWBASE?>admin/chartsPlugin/flot/jquery.flot.resize.min.js"></script>
	<script src="<?=VIEWBASE?>admin/js/blockUI.js"></script>



	<!--[if lt IE 9]>
	  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<script type="text/javascript">
		$(document).ready(function() {
		$('.dropdown-menu li a').hover(
		function() {
		$(this).children('i').addClass('icon-white');
		},
		function() {
		$(this).children('i').removeClass('icon-white');
		});
		$('.icon-remove').click(function(){
			$(this).closest('#charts_main').remove();
		});
		
		}); 
	</script>
	
	
  </head>
  <body>
	<div class="navbar navbar-fixed-top">
	  <div class="navbar-inner">
		<div class="container-fluid">
		  <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		  </a>
		  
		  <a class="brand" href="<?=base_url()?>admin/home">DASHBOARD</a>
		  
		  
		  
		  <div class="btn-group pull-right">
			<a class="btn" href="#"><i class="icon-user"></i> Admin</a>
			<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
			  <span class="caret"></span>
			</a>
			<ul class="dropdown-menu">
			  <li><a href="#">Profile</a></li>
			  <li class="divider"></li>
			  <li><a href="<?=base_url().'admin/logout'?>">Logout</a></li>
			</ul>
		  </div>
		<!--  <div class="nav-collapse">
			<ul class="nav">
			<li><a href="index.html">Home</a></li>
			  <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Users <b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li><a href="add-users.html">New User</a></li>
					<li class="divider"></li>
					<li><a href="users.html">Manage Users</a></li>
				</ul>
			  </li>
			  <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Roles <b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li><a href="add-roles.html">New Role</a></li>
					<li class="divider"></li>
					<li><a href="roles.html">Manage Roles</a></li>
				</ul>
			  </li>
			  <li><a href="graphs.html">Stats</a></li>
			</ul>
		  </div> -->
		</div>
	  </div>
	</div>

	<div class="container-fluid">
	  <div class="row-fluid">
