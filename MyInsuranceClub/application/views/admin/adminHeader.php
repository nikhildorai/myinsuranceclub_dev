<header class="clearfix">
    <a href="#/" data-toggle-min-nav
                 class="toggle-min"
                 ><i class="fa fa-bars"></i></a>
<?php $user = $this->util->getLoggedInUserDetails();?>
    <!-- Logo -->
    <div class="logo">    
		<a href="<?php echo base_url().'admin'?>" title="MyInsuranceClub" style="font-size: 16px;">
            <span>MyInsuranceClub</span>
        </a>
    </div>

    <!-- needs to be put after logo to make it working-->
    <div class="menu-button" toggle-off-canvas>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </div>

    <div class="top-nav">
<!--  
        <ul class="nav-left list-unstyled">
            <li class="dropdown">
                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-comment-o"></i>
                    <span class="badge badge-success">2</span>
                </a>
                <div class="dropdown-menu with-arrow panel panel-default">
                    <div class="panel-heading">
                        You have 2 messages.
                    </div>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <a href="javascript:;" class="media">
                                <span class="pull-left media-icon">
                                    <span class="round-icon sm bg-info"><i class="fa fa-comment-o"></i></span>
                                </span>
                                <div class="media-body">
                                    <span class="block">Jane sent you a message</span>
                                    <span class="text-muted">3 hours ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="javascript:;" class="media">
                                <span class="pull-left media-icon">
                                    <span class="round-icon sm bg-danger"><i class="fa fa-comment-o"></i></span>
                                </span>
                                <div class="media-body">
                                    <span class="block">Lynda sent you a mail</span>
                                    <span class="text-muted">9 hours ago</span>
                                </div>
                            </a>
                        </li>                       
                    </ul>
                    <div class="panel-footer">
                        <a href="javascript:;">Show all messages.</a>
                    </div>
                </div>
            </li>
            <li class="dropdown">
                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-envelope-o"></i>
                    <span class="badge badge-info">3</span>
                </a>
                <div class="dropdown-menu with-arrow panel panel-default">
                    <div class="panel-heading">
                        You have 3 mails.
                    </div>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <a href="javascript:;" class="media">
                                <span class="pull-left media-icon">
                                    <span class="round-icon sm bg-warning"><i class="fa fa-envelope-o"></i></span>
                                </span>
                                <div class="media-body">
                                    <span class="block">Lisa sent you a mail</span>
                                    <span class="text-muted block">2min ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="javascript:;" class="media">
                                <span class="pull-left media-icon">
                                    <span class="round-icon sm bg-info"><i class="fa fa-envelope-o"></i></span>
                                </span>
                                <div class="media-body">
                                    <span class="block">Jane sent you a mail</span>
                                    <span class="text-muted">3 hours ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="javascript:;" class="media">
                                <span class="pull-left media-icon">
                                    <span class="round-icon sm bg-success"><i class="fa fa-envelope-o"></i></span>
                                </span>
                                <div class="media-body">
                                    <span class="block">Lynda sent you a mail</span>
                                    <span class="text-muted">9 hours ago</span>
                                </div>
                            </a>
                        </li>                       
                    </ul>
                    <div class="panel-footer">
                        <a href="javascript:;">Show all mails.</a>
                    </div>
                </div>
            </li>
            <li class="dropdown">
                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-bell-o nav-icon"></i>
                    <span class="badge badge-warning">3</span>
                </a>
                <div class="dropdown-menu with-arrow panel panel-default">
                    <div class="panel-heading">
                        You have 3 notifications.
                    </div>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <a href="javascript:;" class="media">
                                <span class="pull-left media-icon">
                                    <span class="round-icon sm bg-success"><i class="fa fa-bell-o"></i></span>
                                </span>
                                <div class="media-body">
                                    <span class="block">New tasks needs to be done</span>
                                    <span class="text-muted block">2min ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="javascript:;" class="media">
                                <span class="pull-left media-icon">
                                    <span class="round-icon sm bg-info"><i class="fa fa-bell-o"></i></span>
                                </span>
                                <div class="media-body">
                                    <span class="block">Change your password</span>
                                    <span class="text-muted">3 hours ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="javascript:;" class="media">
                                <span class="pull-left media-icon">
                                    <span class="round-icon sm bg-danger"><i class="fa fa-bell-o"></i></span>
                                </span>
                                <div class="media-body">
                                    <span class="block">New feature added</span>
                                    <span class="text-muted">9 hours ago</span>
                                </div>
                            </a>
                        </li>                       
                    </ul>
                    <div class="panel-footer">
                        <a href="javascript:;">Show all notifications.</a>
                    </div>
                </div>
            </li>
        </ul>
-->
        <ul class="nav-right pull-right list-unstyled">
<!--        
            <li class="dropdown langs text-normal" data-ng-controller="LangCtrl">
                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                    {{lang}}
                </a>
                <ul class="dropdown-menu with-arrow pull-right list-langs" role="menu">
                    <li data-ng-show="lang !== 'English' ">
                        <a href="javascript:;" data-ng-click="setLang('English')"><div class="flag flags-american"></div> English</a></li>
                    <li data-ng-show="lang !== 'EspaÃ±ol' ">
                        <a href="javascript:;" data-ng-click="setLang('EspaÃ±ol')"><div class="flag flags-spain"></div> EspaÃ±ol</a></li>
                    <li data-ng-show="lang !== 'æ—¥æœ¬èªž' ">
                        <a href="javascript:;" data-ng-click="setLang('æ—¥æœ¬èªž')"><div class="flag flags-japan"></div> æ—¥æœ¬èªž</a></li>
                    <li data-ng-show="lang !== 'ä¸­æ–‡' ">
                        <a href="javascript:;" data-ng-click="setLang('ä¸­æ–‡')"><div class="flag flags-china"></div> ä¸­æ–‡</a></li>
                    <li data-ng-show="lang !== 'Deutsch' ">
                        <a href="javascript:;" data-ng-click="setLang('Deutsch')"><div class="flag flags-german"></div> Deutsch</a></li>
                    <li data-ng-show="lang !== 'franÃ§ais' ">
                        <a href="javascript:;" data-ng-click="setLang('franÃ§ais')"><div class="flag flags-france"></div> franÃ§ais</a></li>
                    <li data-ng-show="lang !== 'Italiano' ">
                        <a href="javascript:;" data-ng-click="setLang('Italiano')"><div class="flag flags-italy"></div> Italiano</a></li>
                    <li data-ng-show="lang !== 'Portugal' ">
                        <a href="javascript:;" data-ng-click="setLang('Portugal')"><div class="flag flags-portugal"></div> Portugal</a></li>
                    <li data-ng-show="lang !== 'Ð ÑƒÑ�Ñ�ÐºÐ¸Ð¹ Ñ�Ð·Ñ‹Ðº' ">
                        <a href="javascript:;" data-ng-click="setLang('Ð ÑƒÑ�Ñ�ÐºÐ¸Ð¹ Ñ�Ð·Ñ‹Ðº')"><div class="flag flags-russia"></div> Ð ÑƒÑ�Ñ�ÐºÐ¸Ð¹ Ñ�Ð·Ñ‹Ðº</a></li>
                    <li data-ng-show="lang !== 'í•œêµ­ì–´' ">
                        <a href="javascript:;" data-ng-click="setLang('í•œêµ­ì–´')"><div class="flag flags-korea"></div> í•œêµ­ì–´</a></li>
                </ul>
            </li>
             <li class="dropdown">
                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                    <span class="fa fa-magic nav-icon"></span>
                </a>
                <ul class="dropdown-menu pull-right color-switch" data-ui-color-switch>
                    <li><a href="javascript:;" class="color-option color-some_color" data-style="some_color"></a></li>
                </ul>
            </li> -->
            <li class="dropdown text-normal nav-profile">
                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                    <img src="<?php echo base_url();?>dist/images/user.png" alt="" class="img-circle img30_30">
                    <span class="hidden-xs">
                        <span data-i18n="<?php echo $user['name'];?>"><?php echo $user['name'];?></span>
                    </span>
                </a>
                <ul class="dropdown-menu with-arrow pull-right">
                    <li>
                        <a href="<?php echo $base_url;?>admin/auth_public/update_account">
                            <i class="fa fa-user"></i>
                            <span data-i18n="My Profile"></span>
                        </a>
                    </li>
                    <!-- 
                    <li>
                        <a href="#/tasks">
                            <i class="fa fa-check"></i>
                            <span data-i18n="My Tasks"></span>
                        </a>
                    </li>
                    <li>
                        <a href="#/pages/lock-screen">
                            <i class="fa fa-lock"></i>
                            <span data-i18n="Lock"></span>
                        </a>
                    </li>
                    -->
                    <li>
                        <a href="<?php echo $base_url;?>admin/logout">
                            <i class="fa fa-sign-out"></i>
                            <span data-i18n="Log Out"></span>
                        </a>
                    </li>
                </ul>
            </li>

        </ul>        
    </div>

</header>
