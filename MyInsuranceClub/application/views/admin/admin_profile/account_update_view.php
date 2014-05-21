
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
	