	
	<div class="content_wrap nav_bg">
		<div id="sub_nav_wrap" class="content">
			<ul id="sub_nav">
		<?php if (! $this->flexi_auth->is_logged_in()) { ?>
				<li>
					<a href="<?php echo $base_url;?>admin">Home</a>
				</li>
		<?php } else { ?>
		
			
	
			<?php /*?>
				<li>
					<a href="<?php echo $base_url;?>auth_lite/demo">About Demo</a>
				</li>
			<?php if (! $this->flexi_auth->is_logged_in_via_password()) { ?>
				<li>
					<a href="<?php echo $base_url;?>auth"><?php echo ($this->flexi_auth->is_logged_in()) ? 'Login via Password' : 'Login';?></a>
				</li>
				<li>
					<a href="<?php echo $base_url;?>auth/login_via_ajax">Login via Ajax</a>
				</li>
			<?php } 
				<li>
					<a href="<?php echo $base_url;?>auth/register_account">Register</a>
				</li>
				<li>
					<a href="<?php echo $base_url;?>auth_lite/lite_library">Lite Library</a>
				</li>
				<li>
					<a href="<?php echo $base_url;?>auth_lite/privilege_examples">Privilege Examples</a>
				</li>
						<li>
							<a href="<?php echo $base_url;?>admin/auth_public/manage_address_book">Manage Address Book</a>
						</li>
			*/
			?>
			
				<li class="css_nav_dropmenu">
					<a href="<?php echo $base_url;?>admin/auth_public/">Home</a>
					<?php /*?>
					<ul>
						<li>
							<a href="<?php echo $base_url;?>admin/auth_public/">Dashboard</a>
						</li>
						<li class="header">Select Feature to Manage</li>
						<li>
							<a href="<?php echo $base_url;?>admin/auth_public/update_account">Update Account Details</a>
						</li>
						<li>
							<a href="<?php echo $base_url;?>admin/auth_public/update_email">Update Email Address</a>
						</li>
						<li>
							<a href="<?php echo $base_url;?>admin/auth_public/change_password">Update Password</a>
						</li>
					</ul>	
					*/ ?>	
				</li>
			
				<li class="css_nav_dropmenu">
					<a href="javascript:void(0);">Master DB</a>
					<ul>
						<li>
							<a href="<?php echo $base_url;?>admin/company/">Company</a>
						</li>
						<li>
							<a href="<?php echo $base_url;?>admin/policy/">Policy</a>
						</li>
						<li>
							<a href="javascript:void(0);">City</a>
						</li>
						<li>
							<a href="javascript:void(0);">Users</a>
						</li>
						<li>
							<a href="javascript:void(0);">Products</a>
						</li>
						<li>
							<a href="javascript:void(0);">Upload Files</a>
						</li>
						<li>
							<a href="javascript:void(0);">Ad Banners</a>
						</li>
						<li>
							<a href="javascript:void(0);">Testimonials</a>
						</li>
					</ul>		
				</li>
				
			
				<li class="css_nav_dropmenu">
					<a href="javascript:void(0);">Content</a>
					<ul>
						<li>
							<a href="javascript:void(0);">Articles</a>
						</li>
						<li>
							<a href="javascript:void(0);">Guides</a>
						</li>
						<li>
							<a href="javascript:void(0);">News</a>
						</li>
						<li>
							<a href="javascript:void(0);">Ask an Expert</a>
						</li>
						<li>
							<a href="javascript:void(0);">Company Page</a>
						</li>
						<li>
							<a href="javascript:void(0);">Policy Reviews</a>
						</li>
						<li>
							<a href="javascript:void(0);">Buzz of the Month</a>
						</li>
						<li>
							<a href="javascript:void(0);">Views from MyInsuranceClub</a>
						</li>
						<li>
							<a href="javascript:void(0);">Author Profiles</a>
						</li>
						<li>
							<a href="javascript:void(0);">Categories</a>
						</li>
					</ul>		
				</li>
				
			
				<li class="css_nav_dropmenu">
					<a href="javascript:void(0);">Touchpoints</a>
					<ul>
						<li>
							<a href="javascript:void(0);">Contact Us</a>
						</li>
						<li>
							<a href="javascript:void(0);">Comments</a>
						</li>
						<li>
							<a href="javascript:void(0);">Feedback</a>
						</li>
					</ul>		
				</li>
				
			
				<li class="css_nav_dropmenu">
					<a href="javascript:void(0);">Products</a>
					<ul>
						<li>
							<a href="javascript:void(0);">Life</a>
						</li>
						<li>
							<a href="javascript:void(0);">Health</a>
						</li>
						<li>
							<a href="javascript:void(0);">Car</a>
						</li>
						<li>
							<a href="javascript:void(0);">2W</a>
						</li>
						<li>
							<a href="javascript:void(0);">Travel</a>
						</li>
						<li>
							<a href="javascript:void(0);">PA</a>
						</li>
						<li>
							<a href="javascript:void(0);">CI</a>
						</li>
						<li>
							<a href="javascript:void(0);">Home</a>
						</li>
						<li>
							<a href="javascript:void(0);">Corporate</a>
						</li>
					</ul>		
				</li>
				
			
				<li class="css_nav_dropmenu">
					<a href="javascript:void(0);">Reports</a>
					<ul>
						<li>
							<a href="javascript:void(0);">Daily Sales</a>
						</li>
						<li>
							<a href="javascript:void(0);">Social Login Data</a>
						</li>
					</ul>		
				</li>
				<?php /*?>
				<li class="css_nav_dropmenu">
					<a href="<?php echo $base_url;?>admin/auth_admin/">Manage Users</a>
					<ul>
						<li>
							<a href="<?php echo $base_url;?>admin/auth_admin/">Manage Users</a>
						</li>
						<li class="header">Select Feature to Manage</li>
						<li>
							<a href="<?php echo $base_url;?>admin/auth_admin/manage_user_accounts">Manage User Accounts</a>			
						</li>
						<li>
							<a href="<?php echo $base_url;?>admin/auth_admin/manage_user_groups">Manage User Groups</a>			
						</li>
						<li>
							<a href="<?php echo $base_url;?>admin/auth_admin/manage_privileges">Manage User Privileges</a>			
						</li>
						<li>
							<a href="<?php echo $base_url;?>admin/auth_admin/list_user_status/active">List Active Users</a>
						</li>	
						<li>
							<a href="<?php echo $base_url;?>admin/auth_admin/list_user_status/inactive">List Inactive Users</a>
						</li>	
						<li>
							<a href="<?php echo $base_url;?>admin/auth_admin/delete_unactivated_users">List Unactivated Users</a>
						</li>	
						<li>
							<a href="<?php echo $base_url;?>admin/auth_admin/failed_login_users">List Failed Logins</a>			
						</li>	
					</ul>		
				</li>
				*/ ?>
				<li>
					<a href="<?php echo $base_url;?>admin/logout">Logout</a>
				</li>
				
							
			<?php } ?>
			
			</ul>
		</div>
	</div>