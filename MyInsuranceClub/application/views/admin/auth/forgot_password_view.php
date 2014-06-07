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
                                    <span class="glyphicon glyphicon-envelope"></span>
                                </span>
                                <input type="email"
                                       class="form-control"
                                       placeholder="Email"
                                       id="identity" 
                                       name="forgot_password_identity"
                                       required
                                       data-ng-model="user.email"
                                       value="<?php //echo set_value('login_identity', 'admin@admin.com');?>" 
                                       >
                            </div>
                        </div>
                        
                        <div class="form-group">
			                <section>
			                    <p class="text-center">The password must be reset within 15 minutes of the 'forgotten password' email being sent.</p>
			                </section>
                        </div>
                        
                        
                        <div class="form-group">
						<input
							type="submit" 
							name="send_forgotten_password" 
							id="submit" 
							value="Submit"
							class="btn btn-primary btn-lg btn-block " />
					</div>
                    </fieldset>
				<?php echo form_close();?>

                <section>
                    <p class="text-center"><a href="<?php echo $base_url;?>admin/">Back to Login</a></p>
                </section>
                
                
            </div>
        </div>
    </div>

</div>
<?php /*	?>
		<div class="content clearfix">
			<div class="col100">
				<h2>Forgotten Password</h2>

			<?php if (! empty($message)) { ?>
				<div id="message">
					<?php echo $message; ?>
				</div>
			<?php } ?>
				
				<?php echo form_open(current_url());	?>  	
					<div class="w100 frame">
						<ul>
							<li class="info_req">
								<label for="identity">Email or Username:</label>
								<input type="text" id="identity" name="forgot_password_identity" value="" class="tooltip_trigger"
									title="Please enter either your email address or username defined during registration."
								/>
							</li>
							<li>
								<label for="submit">Send Email:</label>
								<input type="submit" name="send_forgotten_password" id="submit" value="Submit" class="link_button large"/>
								<small>Note: By default, this demo is set so that the password must be reset within 15 minutes of the 'forgotten password' email being sent.</small>
							</li>
						</ul>
					</div>	
				<?php echo form_close();?>
			</div>
		</div>
*/ ?>		