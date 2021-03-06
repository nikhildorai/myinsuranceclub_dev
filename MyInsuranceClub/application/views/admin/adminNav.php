<div id="nav-wrapper">
    <ul id="nav"
        data-ng-controller="NavCtrl"
        data-collapse-nav
        data-slim-scroll
        data-highlight-active>
        
        <?php
        $controller = $this->util->getUrl('controller');
       // var_dump($controller);
          ?>
        
        <li>
        	<a href="<?php echo $base_url;?>admin/auth_public/"> 
        		<i class="fa fa-dashboard">
        			<span class="icon-bg bg-danger"></span>
        		</i>
        		<span data-i18n="Dashboard"></span> 
        	</a>
        </li>
        
        <li class="<?php echo in_array($controller, array('company', 'policy', 'product')) ? 'open active' : '';?>">
            <a href="javascript:void(0);">
            	<i class="fa fa-magic">
            		<span class="icon-bg bg-orange"></span>
            	</i>
            	<span data-i18n="Master DB"></span>
            </a>
            <ul style="display: <?php echo in_array($controller, array('company', 'policy', 'product')) ? 'block' : 'none';?>;">
            
                <li class="<?php echo in_array($controller, array('company')) ? 'active' : 'inactive';?>">
                	<a href="<?php echo $base_url;?>admin/company/">
                		<i class="fa fa-caret-right"></i>
                		<span data-i18n="Company"></span>
                	</a>
               	</li>
                <li class="<?php echo in_array($controller, array('policy')) ? 'active' : 'inactive';?>">
                	<a href="<?php echo $base_url;?>admin/policy/">
                		<i class="fa fa-caret-right"></i>
                		<span data-i18n="Policy"></span>
                	</a>
               	</li>
                <li>
                	<a href="javascript:void(0);">
                		<i class="fa fa-caret-right"></i>
                		<span data-i18n="City"></span>
                	</a>
               	</li>
                <li>
                	<a href="javascript:void(0);">
                		<i class="fa fa-caret-right"></i>
                		<span data-i18n="Users"></span>
                	</a>
               	</li>
                <li class="<?php echo in_array($controller, array('product')) ? 'active' : 'inactive';?>">
                	<a href="<?php echo $base_url;?>admin/product/">
                		<i class="fa fa-caret-right"></i>
                		<span data-i18n="Products"></span>
                	</a>
               	</li>
                <li>
                	<a href="javascript:void(0);">
                		<i class="fa fa-caret-right"></i>
                		<span data-i18n="Upload Files"></span>
                	</a>
               	</li>
                <li>
                	<a href="javascript:void(0);">
                		<i class="fa fa-caret-right"></i>
                		<span data-i18n="Ad Banners"></span>
                	</a>
               	</li>
                <li>
                	<a href="javascript:void(0);">
                		<i class="fa fa-caret-right"></i>
                		<span data-i18n="Testimonials"></span>
                	</a>
               	</li>
            </ul>
        </li>
        
        
        
        <li class="<?php echo in_array($controller, array('articles','master_tags', 'news', 'guides')) ? 'open active' : '';?>">
            <a href="javascript:void(0);">
            	<i class="fa fa-table">
            		<span class="icon-bg bg-violet"></span>
            	</i>
            	<span data-i18n="Content"></span>
            </a>
            <ul style="display: <?php echo in_array($controller, array('articles', 'master_tags', 'news', 'guides')) ? 'block' : 'none';?>;">
                <li>
                	<a href="<?php echo $base_url;?>admin/master_tags/">
                		<i class="fa fa-caret-right"></i>
                		<span data-i18n="Tags"></span>
                	</a>
               	</li>
                <li>
                	<a href="<?php echo $base_url;?>admin/articles/">
                		<i class="fa fa-caret-right"></i>
                		<span data-i18n="Articles"></span>
                	</a>
               	</li>
                <li>
                	<a href="<?php echo $base_url;?>admin/guides/">
                		<i class="fa fa-caret-right"></i>
                		<span data-i18n="Guides"></span>
                	</a>
               	</li>
                <li>
                	<a href="<?php echo $base_url;?>admin/news/">
                		<i class="fa fa-caret-right"></i>
                		<span data-i18n="News"></span>
                	</a>
               	</li>
                <li>
                	<a href="javascript:void(0);">
                		<i class="fa fa-caret-right"></i>
                		<span data-i18n="Ask an Expert"></span>
                	</a>
               	</li>
                <li>
                	<a href="javascript:void(0);">
                		<i class="fa fa-caret-right"></i>
                		<span data-i18n="Company Page"></span>
                	</a>
               	</li>
                <li>
                	<a href="javascript:void(0);">
                		<i class="fa fa-caret-right"></i>
                		<span data-i18n="Policy Reviews"></span>
                	</a>
               	</li>
                <li>
                	<a href="javascript:void(0);">
                		<i class="fa fa-caret-right"></i>
                		<span data-i18n="Buzz of the Month"></span>
                	</a>
               	</li>
                <li>
                	<a href="javascript:void(0);">
                		<i class="fa fa-caret-right"></i>
                		<span data-i18n="Views from MyInsuranceClub"></span>
                	</a>
               	</li>
                <li>
                	<a href="javascript:void(0);">
                		<i class="fa fa-caret-right"></i>
                		<span data-i18n="Author Profiles"></span>
                	</a>
               	</li>
                <li>
                	<a href="javascript:void(0);">
                		<i class="fa fa-caret-right"></i>
                		<span data-i18n="Categories"></span>
                	</a>
               	</li>
            </ul>
        </li>
        
        
        

        <li class="<?php echo in_array($controller, array('comments')) ? 'open active' : '';?>">
            <a href="javascript:void(0);">
            	<i class="fa fa-pencil">
            		<span class="icon-bg bg-primary"></span>
            	</i>
            	<span data-i18n="Touch Points"></span>
            </a>
            <ul style="display: <?php echo in_array($controller, array('comments')) ? 'block' : 'none';?>;">
                <li>
                	<a href="javascript:void(0);">
                		<i class="fa fa-caret-right"></i>
                		<span data-i18n="Contact Us"></span>
                	</a>
               	</li>
                <li>
                	<a href="<?php echo $base_url;?>admin/comments/">
                		<i class="fa fa-caret-right"></i>
                		<span data-i18n="Comments"></span>
                	</a>
               	</li>
                <li>
                	<a href="javascript:void(0);">
                		<i class="fa fa-caret-right"></i>
                		<span data-i18n="Feedback"></span>
                	</a>
               	</li>
            </ul>
        </li>
        
        
        
        
        <li>
            <a href="javascript:void(0);">
            	<i class="fa fa-tasks">
            		<span class="icon-bg bg-info"></span>
            	</i>
            	<span data-i18n="Products"></span>
            </a>
            <ul>
                <li>
                	<a href="javascript:void(0);">
                		<i class="fa fa-caret-right"></i>
                		<span data-i18n="Life"></span>
                	</a>
               	</li>
                <li>
                	<a href="javascript:void(0);">
                		<i class="fa fa-caret-right"></i>
                		<span data-i18n="Health"></span>
                	</a>
               	</li>
                <li>
                	<a href="javascript:void(0);">
                		<i class="fa fa-caret-right"></i>
                		<span data-i18n="Car"></span>
                	</a>
               	</li>
                <li>
                	<a href="javascript:void(0);">
                		<i class="fa fa-caret-right"></i>
                		<span data-i18n="2W"></span>
                	</a>
               	</li>
                <li>
                	<a href="javascript:void(0);">
                		<i class="fa fa-caret-right"></i>
                		<span data-i18n="Travel"></span>
                	</a>
               	</li>
                <li>
                	<a href="javascript:void(0);">
                		<i class="fa fa-caret-right"></i>
                		<span data-i18n="PA"></span>
                	</a>
               	</li>
                <li>
                	<a href="javascript:void(0);">
                		<i class="fa fa-caret-right"></i>
                		<span data-i18n="CI"></span>
                	</a>
               	</li>
                <li>
                	<a href="javascript:void(0);">
                		<i class="fa fa-caret-right"></i>
                		<span data-i18n="Home"></span>
                	</a>
               	</li>
                <li>
                	<a href="javascript:void(0);">
                		<i class="fa fa-caret-right"></i>
                		<span data-i18n="Corporate"></span>
                	</a>
               	</li>
            </ul>
        </li>
        
        
        
        
        <li>
            <a href="javascript:void(0);">
            	<i class="fa fa-bar-chart-o">
            		<span class="icon-bg bg-primary-light"></span>
            	</i>
            	<span data-i18n="Reports"></span>
            </a>
            <ul>
                <li>
                	<a href="javascript:void(0);">
                		<i class="fa fa-caret-right"></i>
                		<span data-i18n="Daily Sales"></span>
                	</a>
               	</li>
                <li>
                	<a href="javascript:void(0);">
                		<i class="fa fa-caret-right"></i>
                		<span data-i18n="Social Login Data"></span>
                	</a>
               	</li>
            </ul>
        </li>
        <li class="<?php echo in_array($controller, array('auth_admin')) ? 'open active' : '';?>">
            <a href="javascript:void(0);">
            	<i class="fa fa-bar-chart-o">
            		<span class="icon-bg bg-primary-light"></span>
            	</i>
            	<span data-i18n="Manage Users"></span>
            </a>
            <ul style="display: <?php echo in_array($controller, array('auth_admin')) ? 'block' : 'none';?>;">
                <li>
                	<a href="<?php echo $base_url;?>admin/auth_admin/manage_user_accounts">
                		<i class="fa fa-caret-right"></i>
                		<span data-i18n="View User"></span>
                	</a>
               	</li>
            </ul>
        </li>
         <li>
        <a href="javascript:void(0);">
            	<i class="fa fa-bar-chart-o">
            		<span class="icon-bg bg-info"></span>
            	</i>
            	<span data-i18n="Leads"></span>
            </a>
        	<ul>
        		<li>
                	<a href="<?php echo $base_url;?>admin/health-leads">
                		<i class="fa fa-caret-right"></i>
                		<span data-i18n="Health"></span>
                	</a>
               	</li>
        		<li>
                	<a href="<?php echo $base_url;?>admin/critical-illness-leads">
                		<i class="fa fa-caret-right"></i>
                		<span data-i18n="Critical Illness"></span>
                	</a>
               	</li>
        		<li>
                	<a href="<?php echo $base_url;?>admin/term-insurance-leads">
                		<i class="fa fa-caret-right"></i>
                		<span data-i18n="Term Insurance"></span>
                	</a>
               	</li>
        	</ul>
        </li>
        
        <?php /*?>
        <li><a href="#/dashboard"> <i class="fa fa-dashboard"><span class="icon-bg bg-danger"></span></i><span data-i18n="Dashboard"></span> </a></li>
        <li>
            <a href="#/ui"><i class="fa fa-magic"><span class="icon-bg bg-orange"></span></i><span data-i18n="UI Kit"></span></a>
            <ul>
                <li><a href="#/ui/buttons"><i class="fa fa-caret-right"></i><span data-i18n="Buttons"></span></a></li>
                <li><a href="#/ui/typography"><i class="fa fa-caret-right"></i><span data-i18n="Typography"></span></a></li>
                <li><a href="#/ui/widgets"><i class="fa fa-caret-right"></i><span data-i18n="Widgets"></span> <span class="badge badge-success">12</span></a></li>
                <li><a href="#/ui/grids"><i class="fa fa-caret-right"></i><span data-i18n="Grids"></span></a></li>
                <li><a href="#/ui/icons"><i class="fa fa-caret-right"></i><span data-i18n="Icons"></span></a></li>
                <li><a href="#/ui/components"><i class="fa fa-caret-right"></i><span data-i18n="Components"></span> <span class="badge badge-info">14</span></a></li>
                <li><a href="#/ui/timeline"><i class="fa fa-caret-right"></i><span data-i18n="Timeline"></span></a></li>
            </ul>
        </li>
        <li>
            <a href="#/table"><i class="fa fa-table"><span class="icon-bg bg-warning"></span></i><span data-i18n="Tables"></span></a>
            <ul>
                <li><a href="#/tables/static"><i class="fa fa-caret-right"></i><span data-i18n="Static Tables"></span></a></li>
                <li><a href="#/tables/responsive"><i class="fa fa-caret-right"></i><span data-i18n="Responsive Tables"></span></a></li>
                <li><a href="#/tables/dynamic"><i class="fa fa-caret-right"></i><span data-i18n="Dynamic Tables"></span></a></li>
            </ul>
        </li>
        <li>
            <a href="#/form"><i class="fa fa-pencil"><span class="icon-bg bg-success"></span></i><span data-i18n="Forms"></span></a>
            <ul class="sub-nav">
                <li><a href="#/forms/elements"><i class="fa fa-caret-right"></i><span data-i18n="Form Elements"></span> <span class="badge badge-warning">13</span></a></li>
                <li><a href="#/forms/validation"><i class="fa fa-caret-right"></i><span data-i18n="Form Validation"></span></a></li>
                <li><a href="#/forms/wizard"><i class="fa fa-caret-right"></i><span data-i18n="Form Wizard"></span></a></li>
                <li><a href="#/forms/layouts"><i class="fa fa-caret-right"></i><span data-i18n="Form Layouts"></span></a></li>
            </ul>
        </li>
        <li class="nav-task">
            <a href="#/tasks">
                <i class="fa fa-tasks"><span class="icon-bg bg-info"></span></i><span data-i18n="Tasks"></span>
                <span class="badge badge-danger main-badge"
                      data-ng-show="taskRemainingCount > 0">{{taskRemainingCount}}</span>
            </a>
        </li>
        <li>
            <a href="#/charts"><i class="fa fa-bar-chart-o"><span class="icon-bg bg-primary-light"></span></i><span data-i18n="Charts"></span></a>
            <ul>
                <li><a href="#/charts/morris"><i class="fa fa-caret-right"></i>Morris <span data-i18n="Charts"></span></a></li>
                <li><a href="#/charts/flot"><i class="fa fa-caret-right"></i>Flot <span data-i18n="Charts"></span></a></li>
                <li><a href="#/charts/others"><i class="fa fa-caret-right"></i>Other <span data-i18n="Charts"></span></a></li>
            </ul>
        </li>
        <li>
            <a href="#/mail"><i class="fa fa-envelope-o"><span class="icon-bg bg-primary"></span></i><span data-i18n="Mail"></span></a>
            <ul>
                <li><a href="#/mail/inbox"><i class="fa fa-caret-right"></i><span data-i18n="Inbox"></span></a></li>
                <li><a href="#/mail/compose"><i class="fa fa-caret-right"></i><span data-i18n="Compose"></span></a></li>
                <li><a href="#/mail/single"><i class="fa fa-caret-right"></i><span data-i18n="Single Mail"></span></a></li>
            </ul>
        </li>
        <li>
            <a href="#/pages"><i class="fa fa-file-text-o"><span class="icon-bg bg-violet"></span></i><span data-i18n="Pages"></span></a>
            <ul>
                <li><a href="#/pages/signin"><i class="fa fa-caret-right"></i><span data-i18n="Sign in"></span></a></li>
                <li><a href="#/pages/signup"><i class="fa fa-caret-right"></i><span data-i18n="Sign Up"></span></a></li>
                <li><a href="#/pages/lock-screen"><i class="fa fa-caret-right"></i><span data-i18n="Lock Screen"></span></a></li>
                <li><a href="#/pages/profile"><i class="fa fa-caret-right"></i><span data-i18n="User Profile"></span></a></li>
                <li><a href="#/pages/404"><i class="fa fa-caret-right"></i>404 <span data-i18n="Error"></span></a></li>
                <li><a href="#/pages/500"><i class="fa fa-caret-right"></i>500 <span data-i18n="Error"></span></a></li>
                <li><a href="#/pages/blank"><i class="fa fa-caret-right"></i><span data-i18n="Blank Page"></span></a></li>
                <!-- <li><a href="#/pages/invoice"><i class="fa fa-caret-right"></i><span data-i18n="Invoice"></span></a></li> -->
            </ul>
        </li>
        
        */ ?>
    </ul>
</div>