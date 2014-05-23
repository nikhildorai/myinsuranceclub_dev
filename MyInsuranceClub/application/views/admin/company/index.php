
		<div class="content clearfix">
			<div class="col100">
			
				<h2>Manage Company</h2>
			
			<?php if (! empty($message)) { ?>
				<div id="message">
					<?php echo $message; ?>
				</div>
			<?php } ?>		
				<?php echo form_open('admin/company/index', array('method'=>'get'));	?>
					<fieldset>
						<legend>Search Filter</legend>
						
						<label for="search">Search Company:</label>
						<input type="text" id="company" name="company" value="<?php echo array_key_exists( 'company',$search_query) ? $search_query['company'] : '';?>" class="tooltip_trigger" title="Search company by name, shortname, display name." /><br />
						<label for="search">Company Type:</label>
						<!-- <input type="select" id="company_type" name="company_type" value="<?php // echo ?>" class="tooltip_trigger" title="Search by company type."> -->
						<?php 
						$selected = array_key_exists( 'company_type',$search_query) ? $search_query['company_type'] : '';
						$options = $this->util->getCompanyTypeDropDownOptions();
						//sort($options);
						echo form_dropdown('company_type', $options, $selected, ' id="company_type" class="tooltip_trigger" title="Search by company type."');
						?>
						<br />
						<label for="search"></label>
						<input type="submit" name="search" value="Search" class="link_button"/>
						<a href="<?php echo $base_url; ?>admin/company" class="link_button grey">Reset</a>
						
					</fieldset>
				<?php echo form_close();?>
			
				<div class="w100 frame">	
				<?php 
				$this->table->set_heading('Id', 'Name', 'Shortname', 'Display Name', 'Type', 'Action');
				if (!empty($records))
				{
					if ($records->num_rows() > 0)
					{
						$i = 1;
						$min = 0; $max = $this->config->item('per_page');
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
								$rows[] = $row['company_id'];
								$rows[] = $row['company_name']; 
								$rows[] = $row['company_shortname']; 
								$rows[] = $row['company_display_name']; 
								$comp_type = reset($this->util->getTableData($modelName='Company_type_model', $type="single", $id=$row['company_type_id'], $fields = array('company_type_name')));
								$rows[] = $comp_type['company_type_name']; 
								$actionBtn = '<a href="'.$base_url.'admin/company/create">Update</a>';
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
	