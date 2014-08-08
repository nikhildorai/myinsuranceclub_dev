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
        		<span class="glyphicon glyphicon-th"></span> Manage Tags 
        	</strong>
        	<a href="<?php echo $base_url;?>admin/master_tags/create" class="btn btn-w-md btn-gap-v btn-success btn-sm" style="float: right; margin-top: -5px;">Create New Tag</a>
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
					<?php echo form_open('admin/master_tags/index', array('method'=>'get'));	?>
				        <div class="form-group">
		                    <label for="" class="col-sm-2">Tag Name</label>
		                    <div class="col-sm-10">
		                        <input type="text" class="form-control" placeholder="Search by tag name"  id="name" name="name" value="<?php echo array_key_exists( 'name',$search_query) ? $search_query['name'] : '';?>" >
	                    	</div>
		                </div>
		                
		                <div class="space"></div>
    
				        <div class="form-group">
		                    <label for="" class="col-sm-2"></label>
		                    <div class="col-sm-10">
							<input
								type="submit" 
								name="search" 
								id="submit" 
								value="Search"
								class="btn btn-w-md btn-gap-v btn-primary" />
								<a href="<?php echo $base_url; ?>admin/master_tags"  class="btn btn-w-md btn-gap-v btn-default">Reset</a>
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
							<th>Id</th>
							<th>Name</th>
							<th>Display Name</th>
							<th>Tags For</th>
							<th>Comments</th>
							<th>Status</th>
							<th style="width: 16%;">Action</th>
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
						   //		if ($i > $min && $i <= $max)
						  // 		{
									$actionBtn = '';
									if ($row['status'] == 'active')
									{
										$actionBtn .= '<a href="'.$base_url.'admin/master_tags/create/'.$row['tag_id'].'">Update</a>';
									//	$actionBtn .= ' | <a href="javascript:void(0);" class="showVariants" data-clicktype="show">Show Variants</a>';
									//	$actionBtn .= ' | <a href="'.$base_url.'admin/master_tags/changeStatus/'.$row['tag_id'].'/inactive">Inactive</a>';
									}
									else if ($row['status'] == 'inactive')
									{
										$actionBtn .= '<a href="'.$base_url.'admin/master_tags/create/'.$row['tag_id'].'">View</a>';
									}
			                    	if (strtolower($row['status']) != 'active'){?>
			                    	<tr  class="danger" id="<?php echo $i;?>">
			                  <?php }	else	{	?>
			                    	<tr id="<?php echo $i;?>">
			                 <?php 	}?>
										<td><?php echo $row['tag_id'];?></td>
										<td><?php echo $row['name'];?></td>
										<td><?php echo $row['display_name'];?></td>
										<td><?php echo ucfirst($row['tag_for']);?></td>
										<td><?php echo $row['comments'];?></td>
										<td><?php echo $this->util->getStatusIcon($row['status']);?></td>
										<td><?php echo $actionBtn;?></td>
									</tr>						
			<?php 			//   	}
								$i++;
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
                    
	<div class="btn-toolbar" role="toolbar" style="float: right;">
            <?php echo $this->pagination->create_links();?>
    </div>
            </section>
            
            
        </div>
    </section>

</div>