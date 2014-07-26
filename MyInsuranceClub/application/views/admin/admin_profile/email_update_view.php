
		<div class="content clearfix">
			<div class="col100">
				<h2>Change Email via Email Verification</h2>

			<?php if (! empty($message)) { ?>
				<div id="message">
					<?php echo $message; ?>
				</div>
			<?php } ?>
				
				<?php echo form_open(current_url());	?>  	
					<div class="w100 frame">
						<ul>
							<li class="info_req">
								<label for="email_address">New Email Address:</label>
								<input type="text" id="email_address" name="email_address" value="<?php echo set_value('email_address');?>"/>
							</li>
							<li>
								<label for="submit"></label>
								<input type="submit" name="update_email" id="submit" value="Submit" class="link_button large"/>
							</li>
						</ul>
					</div>
				<?php echo form_close();?>
			</div>
		</div>
