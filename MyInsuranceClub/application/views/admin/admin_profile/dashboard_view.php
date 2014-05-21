
		<div class="content clearfix">
			<div class="col100">
			
			<?php if (! empty($message)) { ?>
				<div id="message">
					<?php echo $message; ?>
				</div>
			<?php } ?>
				
				<div class="w100 frame">							
					<h3>Account Details</h3>
					<p>Update your account details.</p>
					<!-- <p>This example updates records from the required 'User Accounts' table, and from the custom 'Demo User Profile' table that in this demo is used to store a users name, phone number etc.</p> -->
					<ul>
						<li>
							<a href="<?php echo $base_url;?>admin/auth_public/update_account">Update Account Details</a>
						</li>	
					</ul>
					<hr/>
					
					<h3>Email Address</h3>
					<p>Update your email address via email verification.</p>
					<!-- <p>
						Using email verification to update an email address confirms the user has entered the correct new email address.<br/>
						If they were make a typo entering the address, that then was NOT verified via email, they could potentially be prevented from logging back in via their email address as they wouldn't know how they misspelled it. 
					</p> -->
					<ul>
						<li>
							<a href="<?php echo $base_url;?>admin/auth_public/update_email">Update Email Address via Email Verification</a>
						</li>	
					</ul>
					<hr/>
					
					<h3>Password</h3>
					<p>Update your password.</p>
					<!-- <p>All passwords are securely hashed using the <a href="http://www.openwall.com/phpass/" target="_blank">phpass framework</a>.</p> -->
					<ul>
						<li>
							<a href="<?php echo $base_url;?>admin/auth_public/change_password">Update Password</a>
						</li>	
					</ul>
				</div>
			</div>
		</div>
	