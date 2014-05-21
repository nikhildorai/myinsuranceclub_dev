
		<div class="content clearfix">
			<div class="col100">
				<h2>Resend Activation Token</h2>

			<?php if (! empty($message)) { ?>
				<div id="message">
					<?php echo $message; ?>
				</div>
			<?php } ?>
				
				<?php echo form_open(current_url());?>  	
					<div class="w100 frame">
						<ul>
							<li class="info_req">
								<label for="identity">Email or Username:</label>
								<input type="text" id="identity" name="activation_token_identity" value="" class="tooltip_trigger"
									title="Please enter either your email address or username defined during registration."
								/>
							</li>
							<li>
								<label for="submit">Send Email:</label>
								<input type="submit" name="send_activation_token" id="submit" value="Submit" class="link_button large"/>
							</li>
						</ul>
					</div>	
				<?php echo form_close();?>
			</div>
		</div>
	