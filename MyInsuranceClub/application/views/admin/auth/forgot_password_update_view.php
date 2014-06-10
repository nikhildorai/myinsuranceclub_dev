<div class="page-signin">

    <div class="signin-header">
        <div class="container text-center">
            <section class="logo">
				<a href="<?php echo base_url().'admin'?>" title="My Insurance Club">
					<img src="<?php echo $includes_dir;?>images/logo.gif" alt="myinsuranceclub.com" />
				</a>
            </section>
        </div>
    </div>

    <div class="signin-body">
        <div class="container">
            <div class="form-container"   data-ng-controller="signupCtrl">
				<?php 
				$attributes = array('class'=>"form-horizontal form-validation", );
				echo form_open(current_url(), $attributes);?>  
                    <fieldset>
						
				<?php 	if (! empty($message))
						{
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
						} ?>
						
                        <div class="form-group">
                            <div class="input-group input-group-lg">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-lock"></span>
                                </span>
                                <input type="password" class="form-control" placeholder="New Password" id="new_password" 
                                name="new_password" required data-ng-model="user.password" data-ng-minlength="8" >
                            </div>
                        </div>
						
                        <div class="form-group">
                            <div class="input-group input-group-lg">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-lock"></span>
                                </span>
                                <input type="password" class="form-control" placeholder="Confirm New Password" id="confirm_new_password" 
                                name="confirm_new_password" required data-ng-model="user.password" data-ng-minlength="8" >
                            </div>
                        </div>
                        
                        
                        <div class="form-group">
			                <section>
			                    <p class="text-center">Password length must be more than <?php echo $this->flexi_auth->min_password_length(); ?> characters in length.<br/>Only alpha-numeric, dashes, underscores, periods and comma characters are allowed.</p>
			                </section>
                        </div>
                        
                        
                        <div class="form-group">
						<input type="submit" name="change_forgotten_password" id="submit" value="Submit"
							class="btn btn-primary btn-lg btn-block " />
					</div>
                    </fieldset>
				<?php echo form_close();?>

                <section>
                    <p class="text-center"><a href="<?php echo $base_url;?>admin">Back to Login</a></p>
                    <!-- <p class="text-center text-muted text-small">Don't have an account yet? <a href="#/pages/signup">Sign up</a></p>-->
                </section>
                
            </div>
        </div>
    </div>

</div>
<?php /*?>
		<div class="content clearfix">
			<div class="col100">
				<h2>Change Forgotten Password</h2>

			<?php if (! empty($message)) { ?>
				<div id="message">
					<?php echo $message; ?>
				</div>
			<?php } ?>
				
				<?php echo form_open(current_url());	?>  	
					<div class="w100 frame">
						<ul>
							<li>
								<small>
									<strong>For this demo, the following validation settings have been defined:</strong><br/>
									Password length must be more than <?php echo $this->flexi_auth->min_password_length(); ?> characters in length.<br/>Only alpha-numeric, dashes, underscores, periods and comma characters are allowed.
								</small>
							</li>
							<li class="info_req">
								<label for="new_password">New Password:</label>
								<input type="password" id="new_password" name="new_password" value=""/>
							</li>
							<li class="info_req">
								<label for="confirm_new_password">Confirm New Password:</label>
								<input type="password" id="confirm_new_password" name="confirm_new_password" value=""/>
							</li>
							<li class="info_req">
								<label for="submit">Change Password:</label>
								<input type="submit" name="change_forgotten_password" id="submit" value="Submit" class="link_button large"/>
							</li>
						</ul>
					</div>
				<?php echo form_close();?>
			</div>
		</div>
*/ ?>