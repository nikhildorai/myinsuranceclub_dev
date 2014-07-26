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
        		<span class="glyphicon glyphicon-th"></span> Manage Company 
        	</strong>
        	<a href="<?php echo $base_url;?>admin/company/create" class="btn btn-w-md btn-gap-v btn-success btn-sm" style="float: right; margin-top: -5px;">Create New Company</a>
        </div>
        <div class="panel-body">
        
        
        
    <!-- Accordion -->
        <section class="panel" data-ng-controller="AccordionDemoCtrl"  style="border-bottom-width: 0px;">
            <accordion close-others="oneAtATime" class="ui-accordion">
                <accordion-group heading="Search Filter" is-open="false">
					
				<?php echo form_open('admin/company/index', array('method'=>'get'));	?>
			        <div class="form-group">
	                    <label for="" class="col-sm-2">Search Company</label>
	                    <div class="col-sm-10">
	                        <input type="text" class="form-control" placeholder="Search company by name, shortname, display name"  id="company" name="company" value="<?php echo array_key_exists( 'company',$search_query) ? $search_query['company'] : '';?>" >
                    	</div>
	                </div>
	                
	                <div class="space"></div>
			        <div class="form-group">
	                    <label for="" class="col-sm-2">Company Type</label>
	                    <div class="col-sm-10">
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
										echo '<label class="ui-radio">'.form_radio($op).'<span>'.$v1.'</span></label>';
									}
									?>
	                	</div>
	                </div>
	                
			        <div class="form-group">
	                    <label for="" class="col-sm-2"></label>
	                    <div class="col-sm-10">
						<input
							type="submit" 
							name="search" 
							id="submit" 
							value="Search"
							class="btn btn-w-md btn-gap-v btn-primary" />
							<a href="<?php echo $base_url; ?>admin/company"  class="btn btn-w-md btn-gap-v btn-default">Reset</a>
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
                            <th class="numeric">ID</th>
                            <th class="numeric">Company Name</th>
                            <th class="numeric">Short Name</th>
                            <th class="numeric">Display Name</th>
                            <th class="numeric">Vertical</th>
                            <th class="numeric">Status</th>
                            <th class="numeric">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    if (!empty($jsonRows))
                    {
                    	$rows = json_decode($jsonRows);
                    	foreach ($rows as $k1=>$v1)
                    	{
                    		$v1 = (array)$v1;	
                    		if (strtolower($v1['status']) != 'active'){?>
                    		<tr  class="danger">
                    		<?php }else{	?>
                    		<tr>
                    <?php 	}?>
								<td><?php echo $v1['company_id'];?></td>
								<td><?php echo $v1['company_name'];?></td>
								<td><?php echo $v1['company_shortname'];?></td>
								<td><?php echo $v1['company_display_name'];?></td>
								<td><?php echo $v1['company_type_name'];?></td>
								<td><?php echo $this->util->getStatusIcon($v1['status']);?></td>
								<td style="width:18%;"><?php echo $v1['action'];?></td>
							</tr>
        <?php          	}
                    }
                    ?>
                    </tbody>
                </table>
            </section>
        </div>
    </section>

</div>




<?php /*?>
<div class="page page-table" data-ng-controller="tableCtrl" >
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
				
    <section class="panel panel-default table-dynamic">
        <div class="panel-heading"><strong><span class="glyphicon glyphicon-th"></span> Manage Company</strong></div>
	        <div class="table-filters">
	            <div class="row">
	                <div class="col-sm-4 col-xs-6">
	                    <form>
	                        <input type="text"
	                               placeholder="search"
	                               class="form-control"
	                               data-ng-model="searchKeywords"
	                               data-ng-keyup="search()">
	                    </form>
	                </div>
	                <div class="col-sm-3 col-xs-6 filter-result-info">
	                    <span>
                        	Showing {{filteredStores.length}}/{{stores.length}} entries
	                    </span>              
	                </div>
	            </div>
	        </div>
	
	        <table class="table table-bordered table-striped table-responsive">
	            <thead>
	                <tr>
	                    <th>
	                    	<div class="th">
		                        ID
		                        <span class="glyphicon glyphicon-chevron-up"
		                              data-ng-click=" order('company_id') "
		                              data-ng-class="{active: row == 'company_id'}"></span>
		                        <span class="glyphicon glyphicon-chevron-down"
		                              data-ng-click=" order('-company_id') "
		                              data-ng-class="{active: row == '-company_id'}"></span>
	                    	</div>
	                    </th>
	                    <th>
	                    	<div class="th">
	                        	Name
		                        <span class="glyphicon glyphicon-chevron-up"
		                              data-ng-click=" order('company_name') "
		                              data-ng-class="{active: row == 'company_name'}"></span>
		                        <span class="glyphicon glyphicon-chevron-down"
		                              data-ng-click=" order('-company_name') "
		                              data-ng-class="{active: row == '-company_name'}"></span>
	                    	</div>
	                    </th>
	                    <th>
	                    	<div class="th">
		                        Short Name
		                        <span class="glyphicon glyphicon-chevron-up"
		                              data-ng-click=" order('company_shortname') "
		                              data-ng-class="{active: row == 'company_shortname'}"></span>
		                        <span class="glyphicon glyphicon-chevron-down"
		                              data-ng-click=" order('-company_shortname') "
		                              data-ng-class="{active: row == '-company_shortname'}"></span>
	                    	</div>
	                    </th>
	                    <th>
	                    	<div class="th">
		                        Display Name
		                        <span class="glyphicon glyphicon-chevron-up"
		                              data-ng-click=" order('company_display_name') "
		                              data-ng-class="{active: row == 'company_display_name'}"></span>
		                        <span class="glyphicon glyphicon-chevron-down"
		                              data-ng-click=" order('-company_display_name') "
		                              data-ng-class="{active: row == '-company_display_name'}"></span>
	                    	</div>
	                    </th>
	                    <th>
	                    	<div class="th">
	                        	Type
		                        <span class="glyphicon glyphicon-chevron-up"
		                              data-ng-click=" order('company_type_name') "
		                              data-ng-class="{active: row == 'company_type_name'}"></span>
		                        <span class="glyphicon glyphicon-chevron-down"
		                              data-ng-click=" order('-company_type_name') "
		                              data-ng-class="{active: row == '-company_type_name'}"></span>
	                    	</div>
	                    </th>
	                    <th>
	                    	<div class="th">
		                        Status
		                        <span class="glyphicon glyphicon-chevron-up"
		                              data-ng-click=" order('status') "
		                              data-ng-class="{active: row == 'status'}"></span>
		                        <span class="glyphicon glyphicon-chevron-down"
		                              data-ng-click=" order('-status') "
		                              data-ng-class="{active: row == '-status'}"></span>
	                    	</div>
	                    </th>
	                    <th style="width: 18%;">
	                    	<div class="th">
		                        Action
	                    	</div>
	                    </th>
	                    
	                </tr>
	            </thead>
	            <tbody>
	                <tr data-ng-repeat="store in currentPageStores">
	                    <td>{{store.company_id}}</td>
	                    <td>{{store.company_name}}</td>
	                    <td>{{store.company_shortname}}</td>
	                    <td>{{store.company_display_name}}</td>
	                    <td>{{store.company_type_name}}</td>
	                    <td>{{store.status}}</td>
	                    <td>{{store.action}}</td>
	                </tr>
	            </tbody>
	        </table>
	
	        <footer class="table-footer">
	            <div class="row">
	                <div class="col-md-6 page-num-info">
	                    <span>
	                        Show 
	                        <select data-ng-model="numPerPage"
	                                data-ng-options="num for num in numPerPageOpt"
	                                data-ng-change="onNumPerPageChange()">
	                        </select> 
	                        entries per page
	                    </span>
	                </div>
	                <div class="col-md-6 text-right pagination-container">
	                    <pagination class="pagination-sm"
	                                page="currentPage"
	                                total-items="filteredStores.length"
	                                max-size="4"
	                                on-select-page="select(page)"
	                                items-per-page="numPerPage"
	                                rotate="false"
	                                boundary-links="true"></pagination>
	                </div>
	            </div>
	        </footer>
    </section>

</div>

 <script>
  function tableCtrl($scope) {
	  $scope.stores = <?php echo $jsonRows;?>;
	  console.log($scope.stores);
  }
</script>


<?php /*?>

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
								<th style="width: 13%;">Action</th>
							</tr>
						</thead>
						<tbody>
						<?php 
						if (!empty($records))
						{
							if ($records->num_rows() > 0)
							{
								
						//		$i = 1;
						//		$min = 0; $max = $this->config->config['pagination']['per_page'];
						//   		if (array_key_exists('per_page', $_GET))
						//   		{
						//   			$page = str_replace('/','',$_GET['per_page']);
						//   			$min = $page;
						 //  			$max += $page;
						 //  		}   		
						   		
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
											$actionBtn .= '  | <a href="'.$base_url.'admin/companyClaimRatio/index/'.$row['company_id'].'" style="line-height: 2;">Claim Ratio</a>';
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
	*/ ?>