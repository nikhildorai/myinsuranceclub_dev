
<div class="page" data-ng-controller="signupCtrl">
<?php 	$attributes = array('class'=>"form-horizontal form-validation");
		echo form_open_multipart(current_url(), $attributes);	?>
	<div class="panel panel-primary">
    	<div class="panel-heading">
        	<strong>
        		<span class="glyphicon glyphicon-th-list"></span> Policy wording
        	</strong>
        	
        	<a href="<?php echo $base_url;?>admin/policy/" class="btn btn-w-md btn-gap-v btn-default btn-sm" style="float: right; margin-top: -5px;">Cancel</a>
        	
        </div>
<?php 

?>        
					        
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
				


<?php  ?>				
<script src="<?php echo  base_url()?>assets/js/multiFileUpload/jquery.wallform.js"></script>
<script src="<?php echo  base_url()?>assets/js/multiFileUpload/script.js"></script>
<script>
 $(document).ready(function() { 
		
            $('#photoimg').on('change', function()			{ 
			           //$("#preview").html('');
			    
				$("#imageform").ajaxForm({target: '#preview', 
				     beforeSubmit:function(){ 
					
					console.log('ttest');
					$("#imageloadstatus").show();
					 $("#imageloadbutton").hide();
					 }, 
					success:function(){ 
				    console.log('test');
					 $("#imageloadstatus").hide();
					 $("#imageloadbutton").show();
					}, 
					error:function(){ 
					console.log('xtest');
					 $("#imageloadstatus").hide();
					$("#imageloadbutton").show();
					} }).submit();
					
		
			});
        }); 
</script>

<style>

body
{
font-family:arial;
}

#preview
{
color:#cc0000;
font-size:12px
}
.imgList 
{
max-height:150px;
margin-left:5px;
border:1px solid #dedede;
padding:4px;	
float:left;	
}

</style>	    
<?php /*?>
			        	<div class="row">
					        <div class="col-md-12">
					            <section class="panel panel-default">
					                <div class="panel-heading"><strong><span class="glyphicon glyphicon-th-list"></span> Policy Wording Images</strong></div>
									<div class="panel-body">    
						                <div class="col-sm-12">    


<div id='preview'>
</div>
	
<form id="imageform" method="post" enctype="multipart/form-data" action='<?php echo base_url();?>common/ajaxImageUpload' style="clear:both">
<h1>Upload your images</h1> 
<div id='imageloadstatus' style='display:none'><img src="<?php echo  base_url()?>assets/js/multiFileUpload/images/loader.gif" alt="Uploading...."/></div>
<div id='imageloadbutton'>
<input type="file" name="photos[]" id="photoimg" multiple="true" />
</div>
</form>
         
						                    
						             	</div>
						            </div>
					            </section>
					        </div>
					    </div> 
*/?>

			        	<div class="row">
					        <div class="col-md-12">
					            <section class="panel panel-default">
					                <div class="panel-heading"><strong><span class="glyphicon glyphicon-th-list"></span> Policy Wording Images</strong></div>
									<div class="panel-body">    
						                <div class="col-sm-12">    


                    First Field is Compulsory. Only JPEG,PNG,JPG Type Image Uploaded. Image Size Should Be Less Than 100KB.
                    <hr/>
                    <div id="filediv"><input name="file[]" type="file" id="file" multiple="true" /></div><br/>
           
                    <input type="button" id="add_more" class="upload" value="Add More Files"/>
                    <input type="submit" value="Upload File" name="submit" id="upload" class="upload"/>
         
						                    
					   <input type="submit" name="submit" value="Submit" class="btn btn-success btn-lg  " /> 
						             	</div>
						            </div>
					            </section>
					        </div>
					    </div> 
					    					    
	 <?php ?>				    					    
	
								    
					    
	        </div>
		<?php echo form_close();?>
	</div>