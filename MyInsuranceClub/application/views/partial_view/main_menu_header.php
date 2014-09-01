<style type="text/css" id="page-css">
   /* Styles specific to this particular page */
   .scroll-pane {
   width: 100%;
   height: 200px;
   overflow: auto;
   }
</style>
<div id="navigation" class="wrapper">
   <div class="navbar-static-top">
      <div class="header" >
         <div class="header-inner container">
            <div class="row">
               <div class="col-md-12">
                  <!--branding/logo--> 
                  <a class="navbar-brand" href="<?php echo site_url();?>" title="Home">
                     <h1><img src="<?php echo base_url();?>/assets/images/logo.png" /> </h1>
                  </a>
                  <div class="slogan col-md-8">India's 1st IRDA Approved Comparison Site</div>
               </div>
            </div>
         </div>
      </div>
      <div class="full-width">
         <div class="container" data-toggle="clingify">
            <div class="mdslo">India's 1st IRDA Approved Comparison Site</div>
            <div class="navbar">
               <div class="navbar-collapse collapse">
                  <!--main navigation-->
                  <ul class="nav navbar-nav" id="menu">
                     <li>
                        <a href="<?php echo site_url();?>" class="home_fix"><i class="fa fa-home"></i><span class="hidden">Home</span></a>
                     </li>
                     <li><a href="<?php echo site_url('car-insurance');?>" class=" menu-item" >Car Insurance </a></li>
                     <li><a href="<?php echo site_url('two-wheeler-insurance');?>" class=" menu-item" >Two Wheeler Insurance </a></li>
                     <li><a href="<?php echo site_url('health-insurance')."/";?>" class=" menu-item" >Health Insurance </a></li>
                     <li><a href="<?php echo site_url('travel-insurance');?>" class=" menu-item" >Travel Insurance</a></li>
                     <li>
                        <a href="<?php echo site_url('life-insurance');?>" class="dropdown-toggle menu-item" id="features-drop" data-toggle="dropdown1" data-hover="dropdown">Life Insurance&nbsp;&nbsp; <span class="fa fa-sort-desc po"></span></a> 
                        <!-- Dropdown Menu - Mega Menu -->
                        <ul class="dropdown-menu mega-menu" role="menu" aria-labelledby="features-drop">
                           <li class="col-md-4" > <a role="menuitem" href="<?php echo site_url('life-insurance/term-insurance');?>" tabindex="-1" class="menu-item"><strong>Term Plans</strong></a> </li>
                           <li class="col-md-4" > <a role="menuitem" href="<?php echo site_url('life-insurance/endowment-insurance');?>" tabindex="-1" class="menu-item"><strong>Endowment Plans</strong></a> </li>
                           <li class="col-md-4" > <a role="menuitem" href="<?php echo site_url('life-insurance/child-plans');?>" tabindex="-1" class="menu-item"><strong>Child Plans</strong></a> </li>
                           <li class="col-md-4" > <a role="menuitem" href="<?php echo site_url('life-insurance/ulip');?>" tabindex="-1" class="menu-item"><strong>ULIP</strong></a> </li>
                           <li class="col-md-4" > <a role="menuitem" href="<?php echo site_url('life-insurance/money-back-policy');?>" tabindex="-1" class="menu-item"><strong>Money Back Plans</strong></a> </li>
                           <li class="col-md-4" > <a role="menuitem" href="<?php echo site_url('life-insurance/pension-plan');?>" tabindex="-1" class="menu-item"><strong>Pension Plans</strong></a> </li>
                        </ul>
                     </li>
                     <li>
                        <a href="#" class="dropdown-toggle menu-item last" data-toggle="dropdown1" data-hover="dropdown">Other Plans&nbsp;&nbsp; <span class="fa fa-sort-desc po"></span></a> 
                        <ul class="dropdown-menu mega-menu other" role="menu" aria-labelledby="features-drop">
                        
                           <li class="col-md-6" > <a role="menuitem" href="<?php echo site_url('critical-illness')."/";?>" tabindex="-1" class="menu-item"><strong>Critical Illness Insurance</strong></a> </li>
                           <li class="col-md-6" > <a role="menuitem" href="<?php echo site_url('personal-accident');?>" tabindex="-1" class="menu-item"><strong>Personal Accident Insurance</strong></a> </li>
                        </ul>
                     </li>
                  </ul>
               </div>
               <!--/.navbar-collapse --> 
            </div>
         </div>
      </div>
   </div>
</div>