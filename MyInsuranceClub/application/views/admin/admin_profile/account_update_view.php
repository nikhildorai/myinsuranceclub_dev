<?php $user = $this->util->getLoggedInUserDetails();
//var_dump($user);
?>
<div class="page page-profile">

    <div class="row">
        <div class="col-md-6">

            <div class="panel panel-profile">
                <div class="panel-heading bg-primary clearfix">
                    <a href="" class="pull-left profile">
                        <img alt="" src="images/g1.jpg" class="img-circle img80_80">
                    </a>
                    <h3><?php echo $user['name'];?></h3>
                    <p>
                    <?php 
                    foreach ($user['group'] as $k1=>$v1)
                    {
                    	$role[] = $v1;
                    }
                    echo implode(',', $role);
                    ?></p>
                </div>
                <ul class="list-group">
                    <li class="list-group-item">
                        <span class="badge badge-danger">6</span>
                        <i class="fa fa-envelope-o"></i>
                        Cras justo odio
                    </li>
                    <li class="list-group-item">
                        <span class="badge badge-warning">2</span>
                        <i class="fa fa-comments-o"></i>
                        Dapibus ac facilisis in
                    </li>
                    <li class="list-group-item">
                        <span class="badge badge-info">1</span>
                        <i class="fa fa-heart-o"></i>
                        Morbi leo risus
                    </li>
                    <li class="list-group-item">
                        <span class="badge badge-success">3</span>
                        <i class="fa fa-folder-open-o"></i>
                        Vestibulum at eros
                    </li>
                </ul>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <section class="panel panel-box">
                        <div class="panel-top bg-facebook">
                            <div class="divider divider"></div>
                            <i class="fa fa-facebook size-h1"></i>
                            <div class="divider divider"></div>
                        </div>
                        <div class="list-justified-container">
                            <ul class="list-justified text-center">
                                <li>
                                    <p class="size-h3">575</p>
                                    <p class="text-muted">Followers</p>
                                </li>
                                <li>
                                    <p class="size-h3">23</p>
                                    <p class="text-muted">Following</p>
                                </li>
                            </ul>
                        </div>
                    </section>
                </div>
                <div class="col-sm-6">
                    <section class="panel panel-box">
                        <div class="panel-top bg-twitter">
                            <div class="divider divider"></div>
                            <i class="fa fa-twitter size-h1"></i>
                            <div class="divider divider"></div>
                        </div>
                        <div class="list-justified-container">
                            <ul class="list-justified text-center">
                                <li>
                                    <p class="size-h3">575</p>
                                    <p class="text-muted">Followers</p>
                                </li>
                                <li>
                                    <p class="size-h3">23</p>
                                    <p class="text-muted">Following</p>
                                </li>
                            </ul>
                        </div>
                    </section>                        
                </div>
            </div>


          
        </div>
        <div class="col-md-6">

            <div class="row">
                <div class="col-sm-6">
                    <div class="panel mini-box">
                        <span class="box-icon bg-danger">
                            <i class="fa fa-film"></i>
                        </span>
                        <div class="box-info">
                            <p class="size-h2">39</p>
                            <p class="text-muted">Amazing Films</p>
                        </div>
                    </div>                    
                </div>
                <div class="col-sm-6">
                    <div class="panel mini-box">
                        <span class="box-icon bg-warning">
                            <i class="fa fa-camera"></i>
                        </span>
                        <div class="box-info">
                            <p class="size-h2">63</p>
                            <p class="text-muted">Wonderful Photos</p>
                        </div>
                    </div>                    
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="panel mini-box">
                        <span class="box-icon bg-success">
                            <i class="fa fa-bookmark-o"></i>
                        </span>
                        <div class="box-info">
                            <p class="size-h2">55</p>
                            <p class="text-muted">New Collections</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="panel mini-box">
                        <span class="box-icon bg-info">
                            <i class="fa fa-check"></i>
                        </span>
                        <div class="box-info">
                            <p class="size-h2">34</p>
                            <p class="text-muted">Tasks Finised</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading"><strong><span class="glyphicon glyphicon-th"></span> Profile Info</strong></div>
                <div class="panel-body">
                    <div class="media">
                        <div class="media-body">
                            <ul class="list-unstyled list-info">
                                <li>
                                    <span class="icon glyphicon glyphicon-user"></span>
                                    <label>User name</label>
                                    <?php echo $user['name'];?>
                                </li>
                                <li>
                                    <span class="icon glyphicon glyphicon-envelope"></span>
                                    <label>Email</label>
                                    <?php echo $user['email'];?>
                                </li>
                                <li>
                                    <span class="icon glyphicon glyphicon-earphone"></span>
                                    <label>Contact</label>
                                    <?php echo $user['phone'];?>
                                </li>
                            <!--<li>
                                    <span class="icon glyphicon glyphicon-flag"></span>
                                    <label>Nationality</label>
                                    Australia
                                </li>
                                <li>
                                    <span class="icon glyphicon glyphicon-home"></span>
                                    <label>Address</label>
                                    Street 123, Avenue 45, Country
                                </li>-->
                            </ul>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php /*?>
    <div class="panel panel-default">
        <div class="panel-heading"><strong><span class="glyphicon glyphicon-th"></span> Table - General</strong></div>
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Project</th>
                    <th>Manager</th>
                    <th>Status</th>
                    <th>Progress</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td><span class="color-success"><i class="fa fa-level-up"></i></span> TWLT</td>
                    <td>Amery Lee</td>
                    <td><span class="label label-info">Pending</span></td>
                    <td><progressbar class="progressbar-xs no-margin" value="55"></progressbar>
                </tr>
                <tr>
                    <td>2</td>
                    <td><span class="color-success"><i class="fa fa-level-up"></i></span> A16Z</td>
                    <td>Romayne Carlyn</td>
                    <td><span class="label label-primary">Due</span></td>
                    <td><progressbar class="progressbar-xs no-margin" value="34" type="success"></progressbar></td>
                </tr>
                <tr>
                    <td>3</td>
                    <td><span class="color-warning"><i class="fa fa-level-down"></i></span> DARK</td>
                    <td>Marybeth Joanna</td>
                    <td><span class="label label-success">Due</span></td>
                    <td><progressbar class="progressbar-xs no-margin" value="68" type="info"></progressbar></td>
                </tr>
                <tr>
                    <td>4</td>
                    <td><span class="color-info"><i class="fa fa-level-up"></i></span> Q300</td>
                    <td>Jonah Benny</td>
                    <td><span class="label label-danger">Blocked</span></td>
                    <td><progressbar class="progressbar-xs no-margin" value="52" type="warning"></progressbar></td>
                </tr>
                <tr>
                    <td>5</td>
                    <td><span class="color-danger"><i class="fa fa-level-down"></i></span> RVNG</td>
                    <td>Daly Royle</td>
                    <td><span class="label label-warning">Suspended</span></td>
                    <td><progressbar class="progressbar-xs no-margin" value="77" type="danger"></progressbar></td></td>
                </tr>

            </tbody>
        </table>
    </div>
*/ ?>

</div>
<?php /*?>
		<div class="content clearfix">
			<div class="col100">
				
			<?php if (! empty($message)) { ?>
				<div id="message">
					<?php echo $message; ?>
				</div>
			<?php } ?>
				
				<?php echo form_open(current_url());	?>  	
					<fieldset>
						<legend>Update Details</legend>
						<ul>
							<li class="info_req">
								<label for="first_name">First Name:</label>
								<input type="text" id="first_name" name="update_first_name" value="<?php echo set_value('update_first_name',$user['upro_first_name']);?>"/>
							</li>
							<li class="info_req">
								<label for="last_name">Last Name:</label>
								<input type="text" id="last_name" name="update_last_name" value="<?php echo set_value('update_last_name',$user['upro_last_name']);?>"/>
							</li>
							<li class="info_req">
								<label for="phone_number">Phone Number:</label>
								<input type="text" id="phone_number" name="update_phone_number" value="<?php echo set_value('update_phone_number',$user['upro_phone']);?>"/>
							</li>
							<li>
								<hr/>
								<label for="submit"></label>
								<input type="submit" name="update_account" id="submit" value="Submit" class="link_button large"/>
							</li>
						</ul>
					</fieldset>
					
					<fieldset>
						<legend>Update Email</legend>
						<ul>
							<li>
								<label for="username">Username:</label>
								<label for="username"><?php echo set_value('update_username',$user[$this->flexi_auth->db_column('user_acc', 'username')]);?></label>
								<!-- <input type="text" id="username" name="update_username" value="<?php echo set_value('update_username',$user[$this->flexi_auth->db_column('user_acc', 'username')]);?>" class="tooltip_trigger"
									title="Set a username that can be used to login with."
								/> -->
							</li>
							<li class="info_req">
								<label>Email Address:</label>
								<a href="<?php echo $base_url;?>admin/auth_public/update_email">Click here to see an example of updating a users email via email verification</a>.
							</li>
						</ul>
					</fieldset>
					
					<fieldset>
						<legend>Update Password</legend>
						<ul>
							<li>
								<label>Password:</label>
								<a href="<?php echo $base_url;?>admin/auth_public/change_password">Click here to change your password</a>
							</li>
						</ul>
					</fieldset>
					
				<?php echo form_close();?>
			</div>
		</div>
	*/ ?>