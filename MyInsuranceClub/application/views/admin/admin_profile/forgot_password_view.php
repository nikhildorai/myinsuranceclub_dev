
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
