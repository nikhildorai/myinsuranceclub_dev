<div class="page" data-ng-controller="formConstraintsCtrl">
<?php 	$attributes = array('class'=>"form-horizontal form-validation");
		echo form_open_multipart(current_url(), $attributes);
				$model = array();	?>
	<div class="panel panel-primary">
    	<div class="panel-heading">
        	<strong>
        		<span class="glyphicon glyphicon-th-list"></span> Update Account of <?php echo $user['upro_first_name'].' '.$user['upro_last_name']; ?> 
        	</strong>
        	<a href="<?php echo $base_url;?>admin/auth_admin/manage_user_accounts" class="btn btn-w-md btn-gap-v btn-default btn-sm" style="float: right; margin-top: -5px;">Cancel</a>
        	
        </div>
		<?php 	if (! empty($message))
				{
					echo '<div class="col-md-12">
					            <section class="panel-default">';
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
					echo '		</section>
					      </div>';
				} ?>
				
        <div class="panel-body">
        
	        <div class="row">
		        <div class="col-md-12">
				    <section class="panel panel-default">
				        <div class="panel-body">
				        
				        	<div class="row">
				        	
						        <div class="col-md-6">
						            <section class="panel panel-default">
						                <div class="panel-heading"><strong><span class="glyphicon glyphicon-th-list"></span> User Details</strong></div>
						                <div class="panel-body">
						                
							                <div class="form-group">
							                    <label for="" class="col-sm-3">First Name</label>
							                    <div class="col-sm-9">
							                        <input type="text" class="form-control " required placeholder="" id="first_name" name="update_first_name" value="<?php echo set_value('update_first_name',$user['upro_first_name']);?>"  >
							                    </div>
							                </div>
							                
							                
							                <div class="form-group">
							                    <label for="" class="col-sm-3">Last Name</label>
							                    <div class="col-sm-9">
							                        <input type="text" class="form-control " required placeholder="" id="last_name" name="update_last_name" value="<?php echo set_value('update_last_name',$user['upro_last_name']);?>"  >
							                    </div>
							                </div>
							                
							                <div class="form-group">
							                    <label for="" class="col-sm-3">Phone Number</label>
							                    <div class="col-sm-9">
							                        <input type="text" class="form-control " placeholder="" id="phone_number" name="update_phone_number" value="<?php echo set_value('update_phone_number',$user['upro_phone']);?>"  >
							                    </div>
							                </div>
				                
							                <div class="form-group">
							                    <label for="" class="col-sm-3">About</label>
							                    <div class="col-sm-9">
							                        <textarea required class="form-control charecterCount" maxlength="183" name="update_about" id="update_about" ><?php echo set_value('update_about',$user['upro_about']);?></textarea>
							                        <span class="help-block" style="margin-bottom: -5px;">Max 183 chars</span>
			                        				<span class="help-block currentLength"><?php echo array_key_exists( 'upro_about',$user) ? 'Current length: '.strlen($user['upro_about']).' chars' : '0'.' chars';?></span>
							                    </div>
								                <div class="form-group">
								                </div>
							                </div>
							                
							                <div class="form-group">
							                	<?php $newsletter = ($user['upro_newsletter'] == 1) ;?>
							                    <label for="" class="col-sm-3">Subscribe to Newsletter</label>
							                    <div class="col-sm-9">
							                        <input type="checkbox" class="form-control " placeholder="" id="newsletter" name="update_newsletter" value="1" <?php echo set_checkbox('update_newsletter','1',$newsletter); ?> >
							                    </div>
							                </div>
							                
							                
							                <div class="form-group">
							                    <label for="" class="col-sm-3">Image</label>
							                    <div class="col-sm-9">
							                        <input type="file" id="original_image" name="model[user_image]"  title="Choose File" data-ui-file-upload class="btn-info">
							                        <span class="help-block">Image size: 75px X 75px.</span>
							                    
							                    <?php 
															$folderUrl = $this->config->config['folder_path']['users']['original'];
															$fileUrl = $this->config->config['url_path']['users']['original'];
															
															if (isset($user['user_image']) && !empty($user['user_image']))
															{
																if (file_exists($folderUrl.$user['user_image']))
																{
																	echo 	'<div class="divider"></div>
								                    						<img src="'.$fileUrl.$user['user_image'].'">';
																}
															}
															?>
												</div>
						                
						                
						                </div>
						            </section>
						        </div>
						        
				        	
				        	
				        	
				        	
						        <div class="col-md-6">
						            <section class="panel panel-default">
						                <div class="panel-heading"><strong><span class="glyphicon glyphicon-th-list"></span> Contact Details</strong></div>
						                <div class="panel-body">
						                
							                <div class="form-group">
							                    <label for="" class="col-sm-3">Email</label>
							                    <div class="col-sm-9">
							                        <input type="text" class="form-control " required placeholder="" id="email_address" name="update_email_address" value="<?php echo set_value('update_email_address',$user[$this->flexi_auth->db_column('user_acc', 'email')]);?>"  >
							                    </div>
							                </div>
							                
							                <div class="form-group">
							                    <label for="" class="col-sm-3">Username</label>
							                    <div class="col-sm-9">
							                        <input type="text" class="form-control " required placeholder="" id="username" name="update_username" value="<?php echo set_value('update_username',$user[$this->flexi_auth->db_column('user_acc', 'username')]);?>"  >
							                    </div>
							                </div>
							                
							                <div class="form-group"> 
							                    <label for="" class="col-sm-3">Group</label>
							                    <div class="col-sm-9">
												<span class="ui-select "> 
													<select id="group" name="update_group" required style="width: 345px; margin-top: 0px;">
														<?php foreach($groups as $group) { ?>
														<?php $user_group = ($group[$this->flexi_auth->db_column('user_group', 'id')] == $user[$this->flexi_auth->db_column('user_acc', 'group_id')]) ? TRUE : FALSE;?>
														<option value="<?php echo $group[$this->flexi_auth->db_column('user_group', 'id')];?>" <?php echo set_select('update_group', $group[$this->flexi_auth->db_column('user_group', 'id')], $user_group);?>>
															<?php echo $group[$this->flexi_auth->db_column('user_group', 'name')];?>
														</option>
													<?php } ?>
													</select>	
												</span> 
							                    </div>
							                </div>
							                
				
						                </div>
						            </section>
						        </div>
						        
						    </div>
	        
				        
				                <div class="form-group">
				                    <label for="" class="col-sm-3"></label>
				                    <div class="col-sm-9 "  data-ng-controller="ModalDemoCtrl">
	
										<script type="text/ng-template" id="myModalContent.html">
                       						<div class="modal-header">
                            					<h3>Confirmation</h3>
                        					</div>
                        					<div class="modal-body">
												Are you sure, you want to 
								<?php 			if (isset($model['status']) && !empty($model['status'])) 
							          			{
							          				if (in_array($model['status'], array( 'inactive', 'delete'))) {	?>
					          						Activate
					          	<?php 				}
							          				else if (in_array($model['status'], array( 'active'))) {?>
					                 				De-activate
					           <?php 				}
							          			}  ?>
                            			  "<?php echo $model['title'];?>" ?
                        					</div>
                        					<div class="modal-footer">
                            					<button class="btn btn-danger" onClick="deactiveCompany()">Yes</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            					<button class="btn btn-primary" ng-click="cancel()">No</button>
                        					</div>
                    					</script>
                    					
								<?php  	if (isset($model['status']) && !in_array($model['status'], array( 'inactive', 'delete'))) {?>
					                        <input type="submit" name="update_users_account" id="submit" value="Submit" class="btn btn-success btn-lg  " />
					            <?php 	}else {	?>
					                		<input type="submit" name="update_users_account" id="submit" value="Submit" class="btn btn-success btn-lg  " />
					            <?php 	}	?>   
					                	<a href = "<?php echo $base_url; ?>admin/news"  class="btn btn-lg btn-default">Cancel</a>     
							           <?php 	
							                 if (isset($model['news_id']) && !empty($model['news_id']))
							                 {	
							                 	if (isset($model['status']) && !empty($model['status'])) 
							          			{
							          				if (in_array($model['status'], array( 'inactive', 'delete'))) {	?>
							          					<a style="float: right;" href="javascript:void(0);" ng-click="open()" id="deactiveCompany" data-hrefval="<?php echo $base_url;?>admin/news/changeStatus/<?php echo $model['news_id'];?>/active" class="btn btn-danger btn-lg" >Activate Article</a>
							          	<?php 		}
							          				else if (in_array($model['status'], array( 'active'))) {?>
							                 			<a style="float: right;" href="javascript:void(0);" ng-click="open()" id="deactiveCompany" data-hrefval="<?php echo $base_url;?>admin/news/changeStatus/<?php echo $model['news_id'];?>/inactive" class="btn btn-danger btn-lg" >De-activate Article</a>
							           <?php 		}
							          			} 
							          		}	?>
				                     </div>
				               	</div>
						              

				        </div>
				    </section> 
		        </div>
	        </div>   
	        
       	</div>
	</div>
   

	<?php echo form_close();?>
</div>



		
<script type="text/javascript">
	function deactiveCompany()
	{
		var hrefVal = $('#deactiveCompany').data('hrefval');
		window.location.href = hrefVal;
	}
</script>

<?php /*?>
<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Update User Accounts Demo | flexi auth | A User Authentication Library for CodeIgniter</title>
	<meta name="description" content="flexi auth, the user authentication library designed for developers."/> 
	<meta name="keywords" content="demo, flexi auth, user authentication, codeigniter"/>
	<?php $this->load->view('includes/head'); ?> 
</head>

<body id="update_user_account">

<div id="body_wrap">
	<!-- Header -->  
	<?php $this->load->view('includes/header'); ?> 

	<!-- Demo Navigation -->
	<?php $this->load->view('includes/demo_header'); ?> 
	
	<!-- Intro Content -->
	<div class="content_wrap intro_bg">
		<div class="content clearfix">
			<div class="col100">
				<h2>Admin: Update User Account</h2>
				<p>The flexi auth library includes functions to aid the management of user accounts by site administrators.</p>
				<p>This page is similar to the page used by users updating their own account details, but has the additional option for the admininstrator to update the users user group.</p>
			</div>		
		</div>
	</div>
	
	<!-- Main Content -->
	<div class="content_wrap main_content_bg">
		<div class="content clearfix">
			<div class="col100">
				<h2>Update Account of <?php echo $user['upro_first_name'].' '.$user['upro_last_name']; ?></h2>
				<a href="<?php echo $base_url;?>auth_admin/manage_user_accounts">Manage User Accounts</a>

			<?php if (! empty($message)) { ?>
				<div id="message">
					<?php echo $message; ?>
				</div>
			<?php } ?>
				
				<?php echo form_open(current_url());?>  	
					<fieldset>
						<legend>Personal Details</legend>
						<ul>
							<li class="info_req">
								<label for="first_name">First Name:</label>
								<input type="text" id="first_name" name="update_first_name" value="<?php echo set_value('update_first_name',$user['upro_first_name']);?>"/>
							</li>
							<li class="info_req">
								<label for="last_name">Last Name:</label>
								<input type="text" id="last_name" name="update_last_name" value="<?php echo set_value('update_last_name',$user['upro_last_name']);?>"/>
							</li>
						</ul>
					</fieldset>
					
					<fieldset>
						<legend>Contact Details</legend>
						<ul>
							<li class="info_req">
								<label for="phone_number">Phone Number:</label>
								<input type="text" id="phone_number" name="update_phone_number" value="<?php echo set_value('update_phone_number',$user['upro_phone']);?>"/>
							</li>
							<li>
								<?php $newsletter = ($user['upro_newsletter'] == 1) ;?>
								<label for="newsletter">Subscribe to Newsletter:</label>
								<input type="checkbox" id="newsletter" name="update_newsletter" value="1" <?php echo set_checkbox('update_newsletter','1',$newsletter); ?>/>
							</li>
						</ul>
					</fieldset>
					
					<fieldset>
						<legend>Login Details</legend>
						<ul>
							<li class="info_req">
								<label for="email_address">Email Address:</label>
								<input type="text" id="email_address" name="update_email_address" value="<?php echo set_value('update_email_address',$user[$this->flexi_auth->db_column('user_acc', 'email')]);?>" class="tooltip_trigger"
									title="Set the users email address that they can use to login with."
								/>
							</li>
							<li>
								<label for="username">Username:</label>
								<input type="text" id="username" name="update_username" value="<?php echo set_value('update_username',$user[$this->flexi_auth->db_column('user_acc', 'username')]);?>" class="tooltip_trigger"
									title="Set the users username that they can use to login with."
								/>
							</li>
							<li class="info_req">
								<label for="group">Group:</label>
								<select id="group" name="update_group" class="tooltip_trigger"
									title="Set the users group, that can define them as an admin, public, moderator etc."
								>
								<?php foreach($groups as $group) { ?>
									<?php $user_group = ($group[$this->flexi_auth->db_column('user_group', 'id')] == $user[$this->flexi_auth->db_column('user_acc', 'group_id')]) ? TRUE : FALSE;?>
									<option value="<?php echo $group[$this->flexi_auth->db_column('user_group', 'id')];?>" <?php echo set_select('update_group', $group[$this->flexi_auth->db_column('user_group', 'id')], $user_group);?>>
										<?php echo $group[$this->flexi_auth->db_column('user_group', 'name')];?>
									</option>
								<?php } ?>
								</select>
							</li>
							<li>
								<label>Privileges:</label>
								<a href="<?php echo $base_url.'auth_admin/update_user_privileges/'.$user[$this->flexi_auth->db_column('user_acc', 'id')];?>" class="tooltip_trigger"
									title="Manage a users access privileges.">Manage User Privileges</a>
							</li>
						</ul>
					</fieldset>
					
					<fieldset>
						<legend>Update Account</legend>
						<ul>
							<li>
								<label for="submit">Update Account:</label>
								<input type="submit" name="update_users_account" id="submit" value="Submit" class="link_button large"/>
							</li>
						</ul>
					</fieldset>
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
<?php */?>