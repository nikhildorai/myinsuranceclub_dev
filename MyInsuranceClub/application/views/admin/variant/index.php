<div class="content clearfix">
	<div class="col100">
	
		<h2>Manage Policy</h2>
<div class="download-row">
	<a href="<?php echo $base_url;?>admin/policy/create" class="link_button">Create New Policy</a>
</div>
<br>
<br>			
	<?php if (! empty($message)) { ?>
		<div id="message">
			<?php echo $message; ?>
		</div>
	<?php } 
	$message = null;
	?>		
		<?php echo form_open('admin/policy/index', array('method'=>'get'));	?>
			<fieldset>
				<legend>Search Filter</legend>
				
				<label for="search">Search Policy:</label>
				<input type="text" id="policy_name" name="policy_name" value="<?php echo array_key_exists( 'policy_name',$search_query) ? $search_query['policy_name'] : '';?>" class="tooltip_trigger" title="Search policy name." /><br />
				<label for="search">Company Type:</label>
				<?php 
					$selected = array_key_exists( 'company_id',$search_query) ? $search_query['company_id'] : '';
					$options = $this->util->getCompanyTypeDropDownOptions($modelName ='Insurance_company_master_model', $optionKey = 'company_id', $optionValue = 'company_name', $defaultEmpty = "All");
					echo form_dropdown('company_id', $options, $selected, ' id="company_id" class="tooltip_trigger" title="Search by company name."');
				?>
				<br />
				<label for="search">Health Type:</label>
				<?php 
					$selected = array_key_exists( 'type_health_plan',$search_query) ? $search_query['type_health_plan'] : '';
					$options = $this->util->getCompanyTypeDropDownOptions($modelName ='Policy_health_type_model', $optionKey = 'type_id', $optionValue = 'type_name', $defaultEmpty = "All");
					echo form_dropdown('type_health_plan', $options, $selected, ' id="type_health_plan" class="tooltip_trigger" title="Search by health type."');
				?>
				<br />
				
				<label for="search"></label>
				<input type="submit" name="search" value="Search" class="link_button"/>
				<a href="<?php echo $base_url; ?>admin/policy" class="link_button grey">Reset</a>
				
			</fieldset>
		<?php echo form_close();?>
	
		<div class="w100 frame">

			<table cellspacing="0" cellpadding="4" border="0">
				<thead>
					<tr>
						<th>Id</th>
						<th>Policy Name</th>
						<th>Company Name</th>
						<th>Health Plan Type</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
				<?php 
				if (!empty($records))
				{
					if ($records->num_rows() > 0)
					{
						$i = 1;
						$min = 0; $max = $this->config->config['pagination']['per_page'];
				   		if (array_key_exists('per_page', $_GET))
				   		{
				   			$page = str_replace('/','',$_GET['per_page']);
				   			$min = $page;
				   			$max += $page;
				   		}   		
					   	foreach ($records->result_array() as $row)
					   	{
					   		if ($i > $min && $i <= $max)
					   		{
								$where = array();
								$where[0]['field'] = 'company_id';
								$where[0]['value'] = (int)$row['company_id'];
								$where[0]['compare'] = 'equal';
								$comp_name = reset($this->util->getTableData($modelName='Insurance_company_master_model', $type="single", $where, $fields = array('company_name')));
								$where = array();
								$where[0]['field'] = 'type_id';
								$where[0]['value'] = (int)$row['type_health_plan'];
								$where[0]['compare'] = 'equal';				
								$comp_type = reset($this->util->getTableData($modelName='Policy_health_type_model', $type="single", $where, $fields = array('type_name')));
								if ($row['status'] == 'active')
								{
									$actionBtn = '<a href="'.$base_url.'admin/policy/create/'.$row['policy_id'].'">Update</a>';
									$actionBtn .= ' | <a href="javascript:void(0);" class="showVariants" >Show Variants</a>';
									$actionBtn .= ' | <a href="'.$base_url.'admin/policy/changeStatus/'.$row['policy_id'].'/inactive">Inactive</a>';
								}
								else if ($row['status'] == 'inactive')
								{
									$actionBtn = '<a href="'.$base_url.'admin/policy/changeStatus/'.$row['policy_id'].'/active">Activate</a>';
								}
								?>
								<tr class="odd" id="<?php echo $i;?>">
									<td><?php echo $row['policy_id'];?></td>
									<td><?php echo $row['policy_name'];?></td>
									<td><a href="<?php echo $base_url.'admin/company/create/'.$row['company_id']; ?>"><?php echo $comp_name['company_name']; ?></a></td>
									<td><?php echo $comp_type['type_name'];?></td>
									<td><?php echo $actionBtn;?></td>
								</tr>
								<tr class="even" style="display:none;">
									<td colspan="5">
										<?php 
										//	get all existing variants
										$where = array();
										$where[0]['field'] = 'policy_id';
										$where[0]['value'] = (int)$row['policy_id'];
										$where[0]['compare'] = 'equal';
										$variantModel = $this->util->getTableData($modelName='Policy_health_variants_model', $type="all", $where, $fields = array());	
										if (!empty($variantModel))
										{	?>
											<table cellspacing="0" cellpadding="4" border="0">
												<thead>
													<tr>
														<th>Variant Id</th>
														<th>Variant Name</th>
														<th>Comments</th>
														<th>Status</th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody>
										<?php 	foreach ($variantModel as $k1 => $v1)
												{
													echo '<tr>';
														echo '<td>'.$v1['variant_id'].'</td>';
														echo '<td>'.$v1['variant_name'].'</td>';
														echo '<td>'.$v1['comments'].'</td>';
														echo '<td>'.ucfirst($v1['status']).'</td>';
														if (in_array($v1['status'], array('inactive', 'deleted')))
														{
															$action = '<a href="'.$base_url.'admin/variant/changeStatus/'.$v1['variant_id'].'/active">Activate</a>';
														}
														else 
														{
															$action = '<a href="'.$base_url.'admin/variant/create/'.$v1['variant_id'].'">Update</a>';
															$action .= ' | <a href="'.$base_url.'admin/variant/changeStatus/'.$v1['variant_id'].'/inactive">Inactive</a>';
															$action .= ' | <a href="'.$base_url.'admin/variant/changeStatus/'.$v1['variant_id'].'/deleted">Delete</a>';
														}
														echo '<td>'.$action.'</td>';
													echo '</tr>';
												}	?>		
												</tbody>
											</table>
								<?php 	}
										else 
										{
											echo 'No variants found.';
										}
											?>
									</td>
								</tr>							
		<?php 			   	}
							$i++;
						}
					}
					else 
					{
						echo '<tr><td colspan="5">No record found</td></tr>';
					}
				}
				else 
				{
					echo '<tr><td colspan="5">No record found</td></tr>';
				}
				?>
				</tbody>
			</table>


		<?php 
/*		
		$this->table->set_heading('Id', 'Policy Name', 'Company Name', 'Health Plan Type', 'Action');
		if (!empty($records))
		{
			if ($records->num_rows() > 0)
			{
				$i = 1;
				$min = 0; $max = $this->config->config['pagination']['per_page'];
		   		if (array_key_exists('per_page', $_GET))
		   		{
		   			$page = str_replace('/','',$_GET['per_page']);
		   			$min = $page;
		   			$max += $page;
		   		}   		
			   	foreach ($records->result_array() as $row)
			   	{
			   		if ($i > $min && $i <= $max)
			   		{
				   		$rows = array();
						$rows[] = $row['policy_id'];
						$rows[] = $row['policy_name']; 
						$where = array();
						$where[0]['field'] = 'company_id';
						$where[0]['value'] = (int)$row['company_id'];
						$where[0]['compare'] = 'equal';
						$comp_name = reset($this->util->getTableData($modelName='Insurance_company_master_model', $type="single", $where, $fields = array('company_name')));
						$rows[] = '<a href="'.$base_url.'admin/company/create/'.$row['company_id'].'">'.$comp_name['company_name'].'</a>'; 
						$where = array();
						$where[0]['field'] = 'type_id';
						$where[0]['value'] = (int)$row['type_health_plan'];
						$where[0]['compare'] = 'equal';				
						$comp_type = reset($this->util->getTableData($modelName='Policy_health_type_model', $type="single", $where, $fields = array('type_name')));
						$rows[] = $comp_type['type_name']; 
						//$rows[] = ucfirst($row['varient']);
						if ($row['status'] == 'active')
						{
							$actionBtn = '<a href="'.$base_url.'admin/policy/create/'.$row['policy_id'].'">Update</a>';
							$actionBtn .= ' | <a href="'.$base_url.'admin/policy/changeStatus/'.$row['policy_id'].'/inactive">Inactive</a>';
						}
						else if ($row['status'] == 'inactive')
						{
							$actionBtn = '<a href="'.$base_url.'admin/policy/changeStatus/'.$row['policy_id'].'/active">Activate</a>';
						}
						$rows[] = $actionBtn; 
						$this->table->add_row($rows);	?>
<?php 			   	}
					$i++;
				}
			}
			else 
			{
				$cell = array('data' => 'No record found.','colspan' => 6);
				$this->table->add_row($cell);
			}
		}
		else 
		{
				$cell = array('data' => 'No record found.','colspan' => 6);
				$this->table->add_row($cell);
		}
		echo $this->table->generate();
*/
		// pagination
		echo $this->pagination->create_links();
		?>
		<?php echo form_open(current_url());	?>
			
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
<script type="text/javascript">
$(document).ready(function(){
	$('.showVariants').click(function(){
		$('.even').hide();
		$(this).parent().parent().next().slideToggle(1000);
		//console.log(id);
	});
	
});
</script>