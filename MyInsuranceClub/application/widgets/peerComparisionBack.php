<?php 
class PeerComparisionBack extends Widget{

      public function __construct() {

        parent::widget ();

    }

    function run($ext = array())
    {
    	$policyModel = isset($ext['policyModel']) ? $ext['policyModel'] : array();
        $modelName = isset($ext['modelName']) ? $ext['modelName'] : 'model';
        $allVariants = isset($ext['allVariants']) ? $ext['allVariants'] : array();
        $policy_id = isset($ext['policy_id']) ? $ext['policy_id'] : ''; 
        $peerValue = (isset($ext['peer_comparision_variants']) && !empty($ext['peer_comparision_variants'])) ?  $ext['peer_comparision_variants'] : '';
        
?>    	        <div class="form-group">
                    <label for="" class="col-sm-3">Peer Comparision Age (Max 3)</label>
                    <div class="col-sm-9">
						<div class="row">
						<?php 
							$values = !empty($policyModel['peer_comparision_age']) ? explode(',', $policyModel['peer_comparision_age']) : array();
							for ($i = 20; $i <= 60; $i += 5) 
							{	
								$checked = (in_array($i, $values)) ? 'checked' : '';
								?>
								<div class="col-sm-3">
									<label class="ui-checkbox">
										<input name="<?php echo $modelName?>[peer_comparision_age][]" type="checkbox" value="<?php echo $i;?>" class="model_peer_comparision_age" <?php echo $checked;?> > <span><?php echo $i.' Years'; ?></span>
									</label>
		                        </div> 
					<?php 	}	?>
	                    </div>
                    </div>
                </div>
                 
                <div class="form-group">
                </div>
                <div class="form-group">
                </div>

		
                <div class="form-group">
                    <label for="" class="col-sm-3">Peer Comparision Sum Assured (Max 2)</label>
                    <div class="col-sm-9">
						<div class="row" id="peer_comparision_coverage_amounts">
						<?php 
							$arrRange = !empty($policyModel['policy_coverage_amounts']) ? explode(',', $policyModel['policy_coverage_amounts']) : array();
							$peer_comparision_coverage_amounts = !empty($policyModel['peer_comparision_coverage_amounts']) ? explode(',', $policyModel['peer_comparision_coverage_amounts']) : array();
							if (!empty($arrRange))
							{
								foreach ($arrRange as $k9=>$v9)
								{	
									$checked = (in_array($v9, $peer_comparision_coverage_amounts)) ? 'checked' : '';
									?>
									<div class="col-sm-3">
										<label class="ui-checkbox">
											<input name="<?php echo $modelName?>[peer_comparision_coverage_amounts][]" type="checkbox" value="<?php echo $v9;?>" class="peer_comparision_coverage_amounts" <?php echo $checked;?> > <span><?php echo Util::moneyFormatIndia($v9);?></span>
										</label>
			                        </div> 
						<?php 	}
							}	?>
	                     </div>
                    </div>
                </div>
                <div class="form-group">
                </div>
                <div class="form-group">
                </div>
	<div id="peer_comparision_table">
	<?php 
		echo Util::peerComparisionTableViewBackend($allVariants, $policy_id, $peerValue, $modelName);
	?>
	</div>
	
		<script type="text/javascript">
		
			var policy_id = "<?php echo $policy_id;?>";
			var peerValue = "<?php echo $peerValue;?>";
			var modelName = "<?php echo $modelName;?>";

			var peer_comparision_coverage_amounts_selected = [];
			<?php 
			if (!empty($peer_comparision_coverage_amounts))
			{
				foreach ($peer_comparision_coverage_amounts as $k8=>$v8)
				{	?>
					peer_comparision_coverage_amounts_selected.push(<?php echo $v8;?>);
	<?php 		}
			}
			?>
			
			$(document).ready(function(){

				$('.policy_coverage_amounts').on('click', function(){

					var policy_coverage_amounts = [];
					var policy_coverage_amounts_display = [];
					
				    $('.policy_coverage_amounts:checked').each(function() {
				    	policy_coverage_amounts.push($(this).val());
				    	policy_coverage_amounts_display.push($(this).data('display-val'));
				    });


					var peer_comparision_coverage_amounts = $('.peer_comparision_coverage_amounts:checked').map(function() {
					    return this.value;
					}).get();

				    var newHtml = '';
				    if (policy_coverage_amounts.length === 0) {
				    	newHtml += '<div class="col-sm-3">\
		        						<span>Please select policy coverage amount</span>\
	        						</div>';
				    }
				    else
				    {  
					    $.each(policy_coverage_amounts, function(i, val) {
					        newHtml += '<div class="col-sm-3">\
			        						<label class="ui-checkbox">';
			        			if ($.inArray(val, peer_comparision_coverage_amounts) !== -1)
			        			{
				        				newHtml += '<input class="peer_comparision_coverage_amounts" type="checkbox" value="'+val+'" checked="" name="policyModel[peer_comparision_coverage_amounts][]">';
			        			}
			        			else
			        			{
				        				newHtml += '<input class="peer_comparision_coverage_amounts" type="checkbox" value="'+val+'" name="policyModel[peer_comparision_coverage_amounts][]">';
			        			}	
			        				
			        				newHtml +=	'<span>'+policy_coverage_amounts_display[i]+'</span>\
			        					</label>\
		        					</div>';
	    				});		
				    }
//console.log(peer_comparision_coverage_amounts);				    
				    $('#peer_comparision_coverage_amounts').html(newHtml);
				    getPeerComparisionTable();					    
				});
				
				$('.peerComparisionChk').on('click',function(e){
					var countCheckedCheckboxes = $('.peerComparisionChk').filter(':checked').length;
					if(countCheckedCheckboxes > 4)
					{
						alert('You can select only 4 peers variants');
						e.preventDefault();
					}				
				});

				$(document).delegate('.peer_comparision_coverage_amounts','click',function(e){	
					var countCheckedCheckboxes = $('.peer_comparision_coverage_amounts').filter(':checked').length;
					if(countCheckedCheckboxes > 2)
					{
						alert('You can select only 2 amounts');
						e.preventDefault();
					}
					else
						getPeerComparisionTable();					
				});
				
				$('.model_peer_comparision_age').on('click',function(e){
					var countCheckedCheckboxes = $('.model_peer_comparision_age').filter(':checked').length;
					if(countCheckedCheckboxes > 3)
					{
						alert('You can select only 3 amounts');
						e.preventDefault();
					}
					else
						getPeerComparisionTable();					
				});

				$('.peer_comparision_type').on('click', function(e){
					getPeerComparisionTable();	
				});

			});

			
			function getPeerComparisionTable()
			{
				var options = $('#product_id option:selected');
				var productId = $.map(options ,function(option) {
				    return option.value;
				});      
			        
				var options = $('#sub_product_id option:selected');
				var subProductId = $.map(options ,function(option) {
				    return option.value;
				});

				var prodSlug = '';
				var subProdSlug = '';
				$('#product_id :selected').each(function (i, selected) {
					prodSlug = $(selected).data('slug');
			    });   
			        
				$('#sub_product_id :selected').each(function (i, selected) {
						subProdSlug = $(selected).data('slug');
				}); 
				 
				var peer_comparision_coverage_amounts = $('.peer_comparision_coverage_amounts:checked').map(function() {
				    return this.value;
				}).get();
//console.log(peer_comparision_coverage_amounts);				
			    
				var model_peer_comparision_age = [];
			    $('.model_peer_comparision_age:checked').each(function() {
			    	 model_peer_comparision_age.push($(this).val());
			    });
			    
				var policy_composition_type = $('.policy_composition_type:checked').val();
				var formData = {product_id:productId, sub_product_id:subProductId, peerValue:peerValue, modelName:modelName, policy_id:policy_id, peer_comparision_coverage_amounts:peer_comparision_coverage_amounts, model_peer_comparision_age:model_peer_comparision_age,policy_composition_type:policy_composition_type,subProdSlug:subProdSlug,prodSlug:prodSlug};
				
				$.ajax({
						url:"<?php echo base_url().'admin/policy/getPeerComparisionTable'?>",
						type: "post",
						data: formData,
						success:function(result)
						{
							$('#peer_comparision_table').html(result);
				    	}
				});	
			}
			
		</script>   
		
		
<?php                 
	}
}
?>