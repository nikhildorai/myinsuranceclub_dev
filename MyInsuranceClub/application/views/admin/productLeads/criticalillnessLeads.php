
<section class="panel">
	
	<div class="panel-heading">
        	<strong>
        		<span class="glyphicon glyphicon-th"></span> Critical Illness Leads Page 
        	</strong>
        	
     </div>
     <div class="panel-body">
     	
     	<section class="panel" data-ng-controller="AccordionDemoCtrl"  style="border-bottom-width: 0px;">
     		<accordion close-others="oneAtATime" class="ui-accordion">
     		
     		
     				<accordion-group heading="Search Filter" is-open="">
     				
     				<?php echo form_open('admin/health-leads', array('method'=>'get'));	?>
     				
	                <div class="space"></div>	
     						
     				<div class="form-group">
	                    <label for="" class="col-sm-2">Date Range</label>
	                    <div class="col-sm-10">
	                     <label for="" class="col-sm-4">From:</label> <input type="text" class="form-control" placeholder="Search By Mobile Number"  id="company" name="company" value="" >
                    	</div>
	                </div>
	                <div class="space"></div>
     				
     				<div class="form-group">
	                    <label for="" class="col-sm-2">Mobile</label>
	                    <div class="col-sm-10">
	                        <input type="text" class="form-control" placeholder="Search By Mobile Number"  id="company" name="company" value="" >
                    	</div>
	                </div>
	                <div class="space"></div>
	                
	                <div class="form-group">
	                    <label for="" class="col-sm-2">City</label>
	                    <div class="col-sm-10">
	                        <input type="text" class="form-control" placeholder="Search By Mobile Number"  id="company" name="company" value="" >
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
							<a href="<?php echo $base_url; ?>admin/company"  class="btn btn-w-md btn-gap-v btn-default">Reset</a>
                    	</div>
	                </div>
	                	<?php echo form_close();?>
     				</accordion-group>
     		</accordion>
     	
     	
     	</section>
     
     				<section class="">
                <table class="table table-bordered">
                    <thead class="">
                        <tr>
                            <th class="numeric">Lead Source</th>
                            <th class="numeric">Phone Verified</th>
                            <th class="numeric">Product Name</th>
                            <th class="numeric">Sub-Product Name</th>
                            <th class="numeric">Coverage Amount</th>
                            <th class="numeric">Policy Term</th>
                            <th class="numeric">Customer Id</th>
                            <th class="numeric">Customer Name</th>
                            <th class="numeric">Customer DOB</th>
                            <th class="numeric">Customer Age</th>
                            <th class="numeric">Customer Gender</th>
                            <th class="numeric">Phone Number</th>
                            <th class="numeric">Email Id</th>
                            <th class="numeric">City</th>
                            <th class="numeric">State</th>
                            <th class="numeric">Search Id</th>
                            <th class="numeric">Entry Date/Time</th>
                            <th class="numeric">Number Of Days Back</th>
                            <th class="numeric">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    		<?php foreach($product_leads as $leads){?>
                    			<tr>	
                    				<td>Not Defined</td>
                    				<td>Not Defined</td>
                    				<td><?php echo $leads['product_name']?></td>
                    				<td><?php echo $leads['product_type']?></td>
                    				<td><?php echo $leads['coverage_amount']?></td>
                    				<td><?php echo $leads['policy_term']?></td>
                    				<td><?php echo $leads['visitor_id']?></td>
                    				<td><?php echo $leads['customer_name']?></td>
                    				<td><?php echo $leads['cust_dob']?></td>
                    				<td><?php echo $leads['cust_age']?></td>
                    				<td><?php echo $leads['cust_gender']?></td>
                    				<td><?php echo $leads['cust_phone']?></td>
                    				<td><?php echo $leads['cust_email_id']?></td>
                    				<td><?php echo $leads['cust_city']?></td>
                    				<td><?php echo $leads['cust_state']?></td>
                    				<td><?php echo $leads['search_id']?></td>
                    				<td><?php echo $leads['visitor_entry_time']?></td>
                    				<td><?php echo (($leads['days'] == '0') ? 'Today' : $leads['days'].' days back');?></td>
                    				<td><?php echo "<button>Move</button>"?></td>
                    			</tr>
                    		<?php }?>
                   
                    </tbody>
                </table>
            </section>
     
     </div>	   
</section>




