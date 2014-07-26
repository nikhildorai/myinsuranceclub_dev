<div class="page-signin">

    <div class="signin-header">
        <div class="container text-center">
            <section class="logo">
				<a href="<?php echo base_url().'admin'?>" title="My Insurance Club">
					<img src="<?php echo base_url();?>assets/images/logo.png" alt="myinsuranceclub.com" />
				</a>
            </section>
        </div>
    </div>

    <div class="signin-body">
        <div class="container">
            <div class="form-container"   data-ng-controller="signupCtrl">
<!-- 
                <section class="row signin-social text-center">
                    <a href="javascript:;" class="btn-twitter-round"><i class="fa fa-twitter"></i></a>
                    <div class="space"></div>
                    <a href="javascript:;" class="btn-facebook-round"><i class="fa fa-facebook"></i></a>
                    <div class="space"></div>
                    <a href="javascript:;" class="btn-google-plus-round"><i class="fa fa-google-plus"></i></a>
                </section>

                <span class="line-thru">OR</span>
-->
<?php 
// 
?>
				<?php 
				$attributes = array('class'=>"form-horizontal form-validation", );
				echo form_open(current_url(), $attributes);?>  
                    <fieldset>
						
                        
				<?php 	
						if (! empty($message))
						{
							echo '<div class="form-group">';
							if (isset($msgType) && !empty($msgType))
							{
								if ($msgType=='error') 
									echo '<div class="callout callout-danger">';
								else if ($msgType=='success') 
									echo '<div class="callout callout-success">';
								else
									echo '<div class="callout callout-info">';
							}
							else
								echo '<div class="callout callout-info">';
											echo $message;
									echo '</div>';
							echo '</div>';
						} ?>
						
                        <div class="form-group">
                            <div class="input-group input-group-lg">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-envelope"></span>
                                </span>
                                <input type="email"
                                       class="form-control"
                                       placeholder="Email"
                                       id="identity" 
                                       name="login_identity"
                                       required
                                       data-ng-model="user.email"
                                       value="<?php //echo set_value('login_identity', 'admin@admin.com');?>" 
                                       >
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group input-group-lg">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-lock"></span>
                                </span>
                                <input type="password"
                                       class="form-control"
                                       placeholder="Password"
                                       id="password" 
                                       name="login_password" 
                                       required
                                       data-ng-model="user.password"
                                       data-ng-minlength="8"
                                       value="<?php //echo set_value('login_password', 'password123');?>"
                                       >
                            </div>
                        </div>
                        <?php 
							if (isset($captcha))
							{	?>
				                <div class="form-group">
				                    <label for="" class="col-sm-4">Captcha Question</label>
				                    <div class="col-sm-8">
				                        <label><?php echo $captcha;?></label>
				                        <div class="divider"></div>
				                        <input type="number" class="form-control input-lg" placeholder="Enter Captcha"
		                                       id="captcha" name="login_captcha" required  >
				                    </div>
				                </div>
			<?php 			}
                        ?>
                        <div class="form-group">
			                <!-- <section>
			                    <p class="text-center text-muted text-small">Note: 3 failed login attempts will raise security on the account, activating a 10 second time limit ban per login attempt (20 secs after 9+ attempts), and activation of a captcha that must be completed to login.</p>
			                </section>-->
                        </div>
                        
                        
                        <div class="form-group">
						<input
							type="submit" 
							name="login_user" 
							id="submit" 
							value="Log in"
							class="btn btn-primary btn-lg btn-block " />
					</div>
                    </fieldset>
				<?php echo form_close();?>

                <section>
                    <p class="text-center"><a href="<?php echo $base_url;?>admin/forgotten_password">Forgot your password?</a></p>
                    <!-- <p class="text-center text-muted text-small">Don't have an account yet? <a href="#/pages/signup">Sign up</a></p>-->
                </section>
                
            </div>
        </div>
    </div>

</div>

<?php /*?>
		<div class="content clearfix">
			<div class="col100">
				<h2>User Login</h2>

			<?php if (! empty($message)) { ?>
				<div id="message">
					<?php echo $message; ?>
				</div>
			<?php } ?>
				
				<?php echo form_open(current_url(), 'class="parallel"');?>  	
					<fieldset class="w50 parallel_target">
						<legend>Registered Users</legend>
						<ul>
							<li>
								<label for="identity">Email or Username:</label>
								<input type="text" id="identity" name="login_identity" value="<?php echo set_value('login_identity', 'admin@admin.com');?>" class="tooltip_parent1"/>
							<?php /*?>
								<span class="tooltip width_400">
									<h6>Example Users</h6>
									<p>There are 3 example users setup, login to each account using the following details.</p>
									<table>
										<thead>
											<tr>
												<th>Email</th>
												<th>Username</th>
												<th>Password</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>admin@admin.com</td>
												<td>admin</td>
												<td>password123</td>
											</tr>
											<tr>
												<td>moderator@moderator.com</td>
												<td>moderator</td>
												<td>password123</td>
											</tr>
											<tr>
												<td>public@public.com</td>
												<td>public</td>
												<td>password123</td>
											</tr>
										</tbody>
									</table>
								</span>
							*/ /*?>	
							</li>
							<li>
								<label for="password">Password:</label>
								<input type="password" id="password" name="login_password" value="<?php echo set_value('login_password', 'password123');?>"/>
							</li>
						<?php 
							# Below are 2 examples, the first shows how to implement 'reCaptcha' (By Google - http://www.google.com/recaptcha),
							# the second shows 'math_captcha' - a simple math question based captcha that is native to the flexi auth library. 
							# This example is setup to use reCaptcha by default, if using math_captcha, ensure the 'auth' controller and 'demo_auth_model' are updated.
						
							# reCAPTCHA Example
							# To activate reCAPTCHA, ensure the 'if' statement immediately below is uncommented and then comment out the math captcha 'if' statement further below.
			 				# You will also need to enable the recaptcha examples in 'controllers/auth.php', and 'models/demo_auth_model.php'.
							#/*
							if (isset($captcha)) 
							{ 
								echo "<li>\n";
								echo $captcha;
								echo "</li>\n";
							}
							#*/
							
							/* math_captcha Example
							# To activate math_captcha, ensure the 'if' statement immediately below is uncommented and then comment out the reCAPTCHA 'if' statement just above.
							# You will also need to enable the math_captcha examples in 'controllers/auth.php', and 'models/demo_auth_model.php'.
							if (isset($captcha))
							{
								echo "<li>\n";
								echo "<label for=\"captcha\">Captcha Question:</label>\n";
								echo $captcha.' = <input type="text" id="captcha" name="login_captcha" class="width_50"/>'."\n";
								echo "</li>\n";
							}
							#*//*
						?>
							<li>
								<label for="remember_me">Remember Me:</label>
								<input type="checkbox" id="remember_me" name="remember_me" value="1" <?php echo set_checkbox('remember_me', 1); ?>/>
							</li>
							<li>
								<label for="submit">Login:</label>
								<input type="submit" name="login_user" id="submit" value="Submit" class="link_button large"/>
							</li>
							<li>
								<small>Note: On this demo, 3 failed login attempts will raise security on the account, activating a 10 second time limit ban per login attempt (20 secs after 9+ attempts), and activation of a captcha that must be completed to login.</small> 
							</li>
							<li>
								<hr/>
								<a href="<?php echo $base_url;?>admin/forgotten_password">Reset Forgotten Password</a>
							</li>
							<li>
								<a href="<?php echo $base_url;?>admin/resend_activation_token">Resend Account Activation Token</a>
							</li>
						</ul>
					</fieldset>

					<fieldset class="w50 r_margin parallel_target">
						<legend>New Users</legend>
						<ul>
							<li>
								New users can register for an account.
							</li>
							<li>
								<hr/>
								<a href="<?php echo $base_url;?>admin/register" class="link_button large">Register New Account</a>
							</li>
						</ul>
					</fieldset>
				<?php echo form_close();?>
			</div>
		</div>
*/ ?>