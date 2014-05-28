
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
				<?php 
				$this->table->set_heading('Id', 'Name', 'Company Name', 'Health Plan Type', 'Action');
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
								$comp_name = reset($this->util->getTableData($modelName='Insurance_company_master_model', $type="single", $id=$row['company_id'], $fields = array('company_name')));
								$rows[] = $comp_name['company_name']; 
								$comp_type = reset($this->util->getTableData($modelName='Policy_health_type_model', $type="single", $id=$row['type_health_plan'], $fields = array('type_name')));
								$rows[] = $comp_type['type_name']; 
								$actionBtn = '<a href="'.$base_url.'admin/policy/create/'.$row['policy_id'].'">Update</a>';
								$rows[] = $actionBtn; 
								$this->table->add_row($rows);
					   		}
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
	