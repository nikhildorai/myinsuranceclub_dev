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
        		<span class="glyphicon glyphicon-th"></span> Manage Comments 
        	</strong>
        	<a href="<?php echo $base_url;?>admin/comments/updateComments" class="btn btn-w-md btn-gap-v btn-success btn-sm" style="float: right; margin-top: -5px;">Get Latest Comments</a>
        </div>
        <div class="panel-body">
        
            <section class="table-flip-scroll">
                <table class="table table-bordered table-striped cf">
                    <thead class="cf">
                        <tr>
							<th>Id</th>
							<th>Identifier</th>
							<th>View Comment</th>
							<th>Category</th>
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
									$actionBtn = '<a href="javascript:void(0);" class="showVariants" data-clicktype="show">Show Comments</a>';
			                    	if ($row['isClosed'] == '1' || $row['isDeleted'] == '1'){?>
			                    	<tr  class="danger" id="<?php echo $i;?>">
			                  <?php }	else	{	?>
			                    	<tr id="<?php echo $i;?>">
			                 <?php 	}?>
										<td><?php echo $row['id'];?></td>
										<td><?php echo $row['identifiers'];?></td>
										<td><a href="<?php echo $row['link'];?>" >view Comment</a></td>
										<td><?php echo $row['category'];?></td>
										<td><?php echo $actionBtn;?></td>
									</tr>						
			<?php 			   	}
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

<script type="text/javascript">
$(document).ready(function(){

	var currentOpen = '';
	
	$('.showVariants').click(function(){
		var clickType= $(this).data('clicktype');
		if(clickType=="show")
		{
			$(this).data('clicktype','hide').text('Hide Variants');
			$('.even').hide();
			$(this).parent().parent().next().slideDown(1000);
			var currentId = $(this).parent().parent().attr('id'); 
			if(currentOpen != '' && currentOpen != 'undefined')
			{
				$('#'+currentOpen).find('.showVariants').data('clicktype', 'show').text('Show Variants');
			}
			currentOpen = currentId;
		}
		else if(clickType=="hide")
		{
			$(this).data('clicktype','show').text('Show Variants');
			$(this).parent().parent().next().hide();
			currentOpen = '';
		}
		else
		{
			$('.even').hide();
		}
	});
	
});
</script>