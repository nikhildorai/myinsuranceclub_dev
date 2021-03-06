<div class="page">
<?php //var_dump($this->util->getLoggedInUserDetails());?>
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
				echo '<div class="callout callout-success">';
							echo $message;
					echo '</div>';
		} ?>

    <section class="panel panel-primary">
        <div class="panel-heading">
        	<strong>
        		<span class="glyphicon glyphicon-th"></span> Manage User Accounts 
        	</strong>
        	<!-- <a href="<?php echo $base_url;?>admin/company/create" class="btn btn-w-md btn-gap-v btn-success btn-sm" style="float: right; margin-top: -5px;">Create New Company</a>-->
        </div>
        <div class="panel-body">
        
        
        
    <!-- Accordion -->
        <section class="panel" data-ng-controller="AccordionDemoCtrl"  style="border-bottom-width: 0px;">
            <accordion close-others="oneAtATime" class="ui-accordion">
            <?php 
            $open = false;
            if (isset($_GET['search']))
            	$open = true;
            ?>
                <accordion-group heading="Search Filter" is-open="<?php echo $open;?>">
					
				<?php echo form_open('admin/admin/auth_admin/manage_user_accounts');	?>
			        <div class="form-group">
	                    <label for="" class="col-sm-2">Search Users</label>
	                    <div class="col-sm-10">
	                    	<input type="text" id="search" name="search_query" value="<?php echo set_value('search_users',$search_query);?>" class="form-control" placeholder="Search users by email, first name and last name." />
                    	</div>
	                </div>
	                
	                
	                <div class="space"></div>
			        <div class="form-group">
	                    <label for="" class="col-sm-2"></label>
	                    <div class="col-sm-10">
							<input type="submit" name="search_users" id="submit" value="Search" class="btn btn-w-md btn-gap-v btn-primary" />
							<a href="<?php echo $base_url; ?>admin/admin/auth_admin/manage_user_accounts"  class="btn btn-w-md btn-gap-v btn-default">Reset</a>
                    	</div>
	                </div>
				<?php echo form_close();?>
                </accordion-group>
            </accordion>

        </section>
        
        
        
            <section class="table-flip-scroll">
                <table class="table table-bordered table-striped cf">
                    <thead class="cf">
                        <tr>
                            <th class="numeric">Id</th>
                            <th class="numeric">Email</th>
                            <th class="numeric">First Name</th>
                            <th class="numeric">Last Name</th>
                            <th class="numeric">User Group</th>
                            <th class="numeric">Action</th>
                     <?php /*?>       <th class="numeric">Account Suspended</th>
                            <th class="numeric">Delete</th>
                     <?php */ ?>        
                        </tr>
                    </thead>
					<?php echo form_open('admin/admin/auth_admin/manage_user_accounts');	?>
                    <tbody>
                    <?php 
                    if (!empty($users))
                    {
                    	foreach ($users as $k1=>$user)
                    	{	
//var_dump($user);                   
                    		if ($user['uacc_suspend'] == 1){?>
                    		<tr  class="danger">
                    		<?php }else{	?>
                    		<tr>
                    	<?php }	?>	
								<td><?php echo $user['uacc_id'];?></td>
								<td><?php echo $user['uacc_email'];?></td>
								<td><?php echo $user['upro_first_name'];?></td>
								<td><?php echo $user['upro_last_name'];?></td>
								<td><?php echo $user['ugrp_name'];?></td>
								<td style="width:18%;">
									<a href="<?php echo $base_url.'admin/auth_admin/update_user_account/'.$user[$this->flexi_auth->db_column('user_acc', 'id')];?>">
										Update
									</a>
								<?php /*?>	 | <a href="<?php echo $base_url.'admin/auth_admin/update_user_privileges/'.$user['uacc_id'];?>">Manage Privilege</a> <?php */?>
								</td>
<?php /* ?>								
								<td>
									<input type="hidden" name="current_status[<?php echo $user['uacc_id'];?>]" value="<?php echo $user['uacc_suspend'];?>"/>
									<!-- A hidden 'suspend_status[]' input is included to detect unchecked checkboxes on submit -->
									<input type="hidden" name="suspend_status[<?php echo $user['uacc_id'];?>]" value="0"/>
								
								<?php if ($this->flexi_auth->is_privileged('Update Users')) { ?>
									<input type="checkbox" name="suspend_status[<?php echo $user['uacc_id'];?>]" value="1" <?php echo ($user['uacc_suspend'] == 1) ? 'checked="checked"' : "";?>/>
								<?php } else { ?>
									<input type="checkbox" disabled="disabled"/>
									<small>Not Privileged</small>
									<input type="hidden" name="suspend_status[<?php echo $user['uacc_id'];?>]" value="0"/>
								<?php } ?>
								</td>
								<td>
								<?php if ($this->flexi_auth->is_privileged('Delete Users')) { ?>
									<input type="checkbox" name="delete_user[<?php echo $user['uacc_id'];?>]" value="1"/>
								<?php } else { ?>
									<input type="checkbox" disabled="disabled"/>
									<small>Not Privileged</small>
									<input type="hidden" name="delete_user[<?php echo $user['uacc_id'];?>]" value="0"/>
								<?php } ?>
								</td>
<?php */ ?>								
							</tr>
        <?php          	
                    	}
                    }
                    ?>
                    </tbody>
<?php /*?>                    
					<tfoot>
						<tr>
							<td colspan="8">
								<?php $disable = (! $this->flexi_auth->is_privileged('Update Users') && ! $this->flexi_auth->is_privileged('Delete Users')) ? 'disabled="disabled"' : NULL;?>
								<input type="submit" name="update_users" id="submitUpdate" value="Update / Delete Users" class="btn btn-w-md btn-gap-v btn-primary" <?php echo $disable; ?> />
							</td>
						</tr>
					</tfoot>
<?php */?>					
				<?php echo form_close();?>
                </table>
            </section>
        </div>
    </section>

</div>


<?php /*?>
<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Manage User Accounts Demo | flexi auth | A User Authentication Library for CodeIgniter</title>
	<meta name="description" content="flexi auth, the user authentication library designed for developers."/> 
	<meta name="keywords" content="demo, flexi auth, user authentication, codeigniter"/>
	<?php $this->load->view('includes/head'); ?> 
</head>

<body id="manage_users">

<div id="body_wrap">
	<!-- Header -->  
	<?php $this->load->view('includes/header'); ?> 

	<!-- Demo Navigation -->
	<?php $this->load->view('includes/demo_header'); ?> 
	
	<!-- Intro Content -->
	<div class="content_wrap intro_bg">
		<div class="content clearfix">
			<div class="col100">
				<h2>Admin: Manage User Accounts</h2>
				<p>The flexi auth library includes functions to aid the management of user accounts by site administrators.</p>
				<p>This page demonstrates how to display a pagninated list of all user accounts and then apply a search filter to find specific users via their email address or first and last name. In addition, the page demonstrates how to mass update or delete multiple accounts at the same time.</p>
			</div>		
		</div>
	</div>
	
	<!-- Main Content -->
	<div class="content_wrap main_content_bg">
		<div class="content clearfix">
			<div class="col100">
				<h2>User Accounts</h2>

			<?php if (! empty($message)) { ?>
				<div id="message">
					<?php echo $message; ?>
				</div>
			<?php } ?>
				
				<?php echo form_open(current_url());	?>
					<fieldset>
						<legend>Search Filter</legend>
						
						<label for="search">Search Users:</label>
						<input type="text" id="search" name="search_query" value="<?php echo set_value('search_users',$search_query);?>" class="tooltip_trigger"
							title="This example searches for users by email, first name and last name."
						/>
						<input type="submit" name="search_users" value="Search" class="link_button"/>
						<a href="<?php echo $base_url; ?>admin/auth_admin/manage_user_accounts" class="link_button grey">Reset</a>
						
					</fieldset>
				<?php echo form_close();?>
			
				<?php echo form_open(current_url());	?>
					<table>
						<thead>
							<tr>
								<th class="spacer_200">Email</th>
								<th>First Name</th>
								<th>Last Name</th>
								<th class="spacer_100 align_ctr tooltip_trigger"
									title="Indicates the user group the user belongs to.">
									User Group
								</th>
								<th class="spacer_100 align_ctr tooltip_trigger"
									title="Manage the access privileges of users.">
									User Privileges
								</th>
								<th class="spacer_100 align_ctr tooltip_trigger"
									title="If checked, the users account will be locked and they will not be able to login.">
									Account Suspended
								</th>
								<th class="spacer_100 align_ctr tooltip_trigger" 
									title="If checked, the row will be deleted upon the form being updated.">
									Delete
								</th>
							</tr>
						</thead>
						<?php if (!empty($users)) { ?>
						<tbody>
							<?php foreach ($users as $user) { ?>
							<tr>
								<td>
									<a href="<?php echo $base_url.'admin/auth_admin/update_user_account/'.$user[$this->flexi_auth->db_column('user_acc', 'id')];?>">
										<?php echo $user[$this->flexi_auth->db_column('user_acc', 'email')];?>
									</a>
								</td>
								<td>
									<?php echo $user['upro_first_name'];?>
								</td>
								<td>
									<?php echo $user['upro_last_name'];?>
								</td>
								<td class="align_ctr">
									<?php echo $user[$this->flexi_auth->db_column('user_group', 'name')];?>
								</td>
								<td class="align_ctr">
									<a href="<?php echo $base_url.'admin/auth_admin/update_user_privileges/'.$user[$this->flexi_auth->db_column('user_acc', 'id')];?>">Manage</a>
								</td>
								<td class="align_ctr">
									<input type="hidden" name="current_status[<?php echo $user[$this->flexi_auth->db_column('user_acc', 'id')];?>]" value="<?php echo $user[$this->flexi_auth->db_column('user_acc', 'suspend')];?>"/>
									<!-- A hidden 'suspend_status[]' input is included to detect unchecked checkboxes on submit -->
									<input type="hidden" name="suspend_status[<?php echo $user[$this->flexi_auth->db_column('user_acc', 'id')];?>]" value="0"/>
								
								<?php if ($this->flexi_auth->is_privileged('Update Users')) { ?>
									<input type="checkbox" name="suspend_status[<?php echo $user[$this->flexi_auth->db_column('user_acc', 'id')];?>]" value="1" <?php echo ($user[$this->flexi_auth->db_column('user_acc', 'suspend')] == 1) ? 'checked="checked"' : "";?>/>
								<?php } else { ?>
									<input type="checkbox" disabled="disabled"/>
									<small>Not Privileged</small>
									<input type="hidden" name="suspend_status[<?php echo $user[$this->flexi_auth->db_column('user_acc', 'id')];?>]" value="0"/>
								<?php } ?>
								</td>
								<td class="align_ctr">
								<?php if ($this->flexi_auth->is_privileged('Delete Users')) { ?>
									<input type="checkbox" name="delete_user[<?php echo $user[$this->flexi_auth->db_column('user_acc', 'id')];?>]" value="1"/>
								<?php } else { ?>
									<input type="checkbox" disabled="disabled"/>
									<small>Not Privileged</small>
									<input type="hidden" name="delete_user[<?php echo $user[$this->flexi_auth->db_column('user_acc', 'id')];?>]" value="0"/>
								<?php } ?>
								</td>
							</tr>
						<?php } ?>
						</tbody>
						<tfoot>
							<tr>
								<td colspan="7">
									<?php $disable = (! $this->flexi_auth->is_privileged('Update Users') && ! $this->flexi_auth->is_privileged('Delete Users')) ? 'disabled="disabled"' : NULL;?>
									<input type="submit" name="update_users" value="Update / Delete Users" class="link_button large" <?php echo $disable; ?>/>
								</td>
							</tr>
						</tfoot>
					<?php } else { ?>
						<tbody>
							<tr>
								<td colspan="7" class="highlight_red">
									No users are available.
								</td>
							</tr>
						</tbody>
					<?php } ?>
					</table>
					
				<?php if (! empty($pagination['links'])) { ?>
					<div id="pagination" class="w100 frame">
						<p>Pagination: <?php echo $pagination['total_users'];?> users match your search</p>
						<p>Links: <?php echo $pagination['links'];?></p>
					</div>
				<?php } ?>
					
				<?php echo form_close();?>
			</div>
		</div>
	</div>	
	
	<!-- Footer -->  
	<?php $this->load->view('includes/footer'); ?> 
</div>

<!-- Scripts -->  
<?php $this->load->view('includes/scripts'); ?> 

</body>
</html>
*/ ?>