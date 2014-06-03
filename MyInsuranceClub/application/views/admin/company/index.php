
		<div class="content clearfix">
			<div class="col100">
			
				<h2>Manage Company</h2>
<div class="download-row">
				<a href="<?php echo $base_url;?>admin/company/create" class="link_button">Create New Company</a>
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
				<?php echo form_open('admin/company/index', array('method'=>'get'));	?>
					<fieldset>
						
						<label for="search">Search Company:</label>
						<input type="text" id="company" name="company" value="<?php echo array_key_exists( 'company',$search_query) ? $search_query['company'] : '';?>" class="tooltip_trigger" title="Search company by name, shortname, display name." /><br />
						<label for="search">Company Type:</label>
						<!-- <input type="select" id="company_type" name="company_type" value="<?php // echo ?>" class="tooltip_trigger" title="Search by company type."> -->
						<?php 
						$selected = array_key_exists( 'company_type',$search_query) ? $search_query['company_type'] : '';
						$options = $this->util->getCompanyTypeDropDownOptions($modelName ='Company_type_model', $optionKey = 'company_type_id', $optionValue = 'company_type_name', $defaultEmpty = "All");			
						foreach ($options as $k1=>$v1)
						{
							$op = array(
							    'name'        => 'company_type',
							    'value'       => $k1,
							    'checked'     => ($selected == $k1) ? TRUE : FALSE,
							    'style'       => 'margin:10px',
							    );
							echo form_radio($op).$v1;
						}
						?>
						<br />
						<label for="search"></label>
						<input type="submit" name="search" value="Search" class="link_button"/>
						<a href="<?php echo $base_url; ?>admin/company" class="link_button grey">Reset</a>
						
					</fieldset>
				<?php echo form_close();?>
			
				<div class="w100 frame">	
				
		
					<table cellspacing="0" cellpadding="4" border="0">
						<thead>
							<tr>
								<th>Id</th>
								<th>Name</th>
								<th>Short Name</th>
								<th>Display Name</th>
								<th>Type</th>
								<th>Status</th>
								<th style="width: 12%;">Action</th>
							</tr>
						</thead>
						<tbody>
						<?php 
						if (!empty($records))
						{
							if ($records->num_rows() > 0)
							{
								/*
								$i = 1;
								$min = 0; $max = $this->config->config['pagination']['per_page'];
						   		if (array_key_exists('per_page', $_GET))
						   		{
						   			$page = str_replace('/','',$_GET['per_page']);
						   			$min = $page;
						   			$max += $page;
						   		}   		
						   		*/
							   	foreach ($records->result_array() as $row)
							   	{
					//		   		if ($i > $min && $i <= $max)
						//	   		{
								   		$rows = array();
										$rows[] = $row['company_id'];
										$rows[] = $row['company_name']; 
										$rows[] = $row['company_shortname']; 
										$rows[] = $row['company_display_name']; 
										$where = array();
										$where[0]['field'] = 'company_type_id';
										$where[0]['value'] = (int)$row['company_type_id'];
										$where[0]['compare'] = 'equal';
										
										$comp_type = reset($this->util->getTableData($modelName='Company_type_model', $type="single", $where, $fields = array('company_type_name')));
										$rows[] = $comp_type['company_type_name']; 
										$rows[] = ucfirst($row['status']);
										if ($row['status'] == 'active')
										{
											$actionBtn = '<a href="'.$base_url.'admin/company/create/'.$row['company_id'].'" style="line-height: 2;" >Update</a>';
											$actionBtn .= ' | <a href="'.$base_url.'admin/company/changeStatus/'.$row['company_id'].'/inactive" style="line-height: 2;">De-activate</a>';	
											$actionBtn .= ' <br><a href="'.$base_url.'admin/policy/index?company_id='.$row['company_id'].'" style="line-height: 2;">View Policies</a>';
										}
										else if ($row['status'] == 'inactive')
										{
											$actionBtn = '<a href="'.$base_url.'admin/company/changeStatus/'.$row['company_id'].'/active" style="line-height: 2;">Activate</a>';
										}
										$rows[] = $actionBtn; 
										?>
										<tr class="odd">
											<td><?php echo $row['company_id'];?></td>
											<td><?php echo $row['company_name'];?></td>
											<td><?php echo $row['company_shortname'];?></td>
											<td><?php echo $row['company_display_name'];?></td>
											<td><?php echo $comp_type['company_type_name'];?></td>
											<td><?php echo ucfirst($row['status']);?></td>
											<td><?php echo $actionBtn;?></td>
										</tr>						
				<?php 		//	   	}
							//		$i++;
								}
							}
							else 
							{
								echo '<tr><td colspan="6">No record found</td></tr>';
							}
						}
						else 
						{
							echo '<tr><td colspan="6">No record found</td></tr>';
						}
						?>
						</tbody>
					</table>
				
				<?php 
/*				
				$this->table->set_heading('Id', 'Name', 'Short Name', 'Display Name', 'Type', 'Status','Action');
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
				//	   		if ($i > $min && $i <= $max)
				//	   		{
						   		$rows = array();
								$rows[] = $row['company_id'];
								$rows[] = $row['company_name']; 
								$rows[] = $row['company_shortname']; 
								$rows[] = $row['company_display_name']; 
								$where = array();
								$where[0]['field'] = 'company_type_id';
								$where[0]['value'] = (int)$row['company_type_id'];
								$where[0]['compare'] = 'equal';
								
								$comp_type = reset($this->util->getTableData($modelName='Company_type_model', $type="single", $where, $fields = array('company_type_name')));
								$rows[] = $comp_type['company_type_name']; 
								$rows[] = ucfirst($row['status']);
								if ($row['status'] == 'active')
								{
									$actionBtn = '<a href="'.$base_url.'admin/company/create/'.$row['company_id'].'">Update</a>';
									$actionBtn .= ' | <a href="'.$base_url.'admin/company/changeStatus/'.$row['company_id'].'/inactive">De-activate</a>';	
									$actionBtn .= ' <br><a href="'.$base_url.'admin/policy/index?company_id='.$row['company_id'].'">View Policies</a>';
								}
								else if ($row['status'] == 'inactive')
								{
									$actionBtn = '<a href="'.$base_url.'admin/company/changeStatus/'.$row['company_id'].'/active">Activate</a>';
								}
								$rows[] = $actionBtn; 
								$this->table->add_row($rows);
				//	   		}
						//	$i++;
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
				//echo $this->pagination->create_links();
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
	