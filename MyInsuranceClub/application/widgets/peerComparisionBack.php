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
        
?>    	
		<script type="text/javascript">
			var policy_id = "<?php echo $policy_id;?>";
			var peerValue = "<?php echo $peerValue;?>";
			var modelName = "<?php echo $modelName;?>";
			
			$(document).ready(function(){
				$('.peerComparisionChk').on('click',function(e){
					var countCheckedCheckboxes = $('.peerComparisionChk').filter(':checked').length;
					if(countCheckedCheckboxes > 4)
					{
						alert('You can select only 4 peers variants');
						e.preventDefault();
					}				
				});
				
				$('.model_coverage_amount').on('click',function(e){
					var countCheckedCheckboxes = $('.model_coverage_amount').filter(':checked').length;
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

				var model_coverage_amount = $('.model_coverage_amount:checked').map(function() {
				    return this.value;
				}).get();
				
			    
				var model_peer_comparision_age = [];
			    $('.model_peer_comparision_age:checked').each(function() {
			    	 model_peer_comparision_age.push($(this).val());
			    });
			    
				var peer_comparision_type = $('.peer_comparision_type:checked').val();
			     
				var formData = {product_id:productId, sub_product_id:subProductId, peerValue:peerValue, modelName:modelName, policy_id:policy_id, model_coverage_amount:model_coverage_amount, model_peer_comparision_age:model_peer_comparision_age,peer_comparision_type:peer_comparision_type};

				$.ajax({
						url:"<?php echo base_url().'/admin/policy/getPeerComparisionTable'?>",
						type: "post",
						data: formData,
						success:function(result)
						{
							$('#peer_comparision_table').html(result);
				    	}
				});	
			}
		</script>   

		<table cellspacing="0" class="eligibility">
			<tbody>
				<tr>
					<th class="spec" scope="row" style="border-top: 1px solid #c1dad7;">Peer Comparision type</th>
					<td width="700" valign="top" style="border-top: 1px solid #c1dad7;">
					 <?php 					 
						$selected = !empty($policyModel['peer_comparision_type']) ? $policyModel['peer_comparision_type'] : '';
						$options = array('individual'=>'Individual', 'family floater'=>'Family Floater', 'both'=>'Both');	
						foreach ($options as $k1=>$v1)
						{
							$op = array(
								'class'			=>	'peer_comparision_type',
							    'name'        	=> $modelName.'[peer_comparision_type]',
							    'value'       	=> $k1,
							    'checked'     	=> ($selected == $k1) ? TRUE : FALSE,
							    'style'       	=> 'margin:10px',
							    );
							echo '<label class="ui-radio">'.form_radio($op).'<span>'.$v1.'</span></label>';
						}
					?>
					</td>
				</tr>
				<tr>
					<th class="spec" scope="row">Peer Comparision Sum Assured (Max 2)</th>
					<td width="700" valign="top" style="text-align: left;">
					<?php 
						$values = !empty($policyModel['peer_comparision_coverage_amounts']) ? explode(',', $policyModel['peer_comparision_coverage_amounts']) : array();
					?>
						<div class="row">
							<div class="col-sm-3">
								<label class="ui-checkbox">
									<input name="<?php echo $modelName?>[peer_comparision_coverage_amounts][]" type="checkbox" value="50000" class="model_coverage_amount" <?php echo (in_array('50000', $values)) ? 'checked' : ''?> > <span>50,000</span>
								</label>
	                        </div>  
							<div class="col-sm-3">
								<label class="ui-checkbox">
									<input name="<?php echo $modelName?>[peer_comparision_coverage_amounts][]" type="checkbox" value="75000" class="model_coverage_amount" <?php echo (in_array('75000', $values)) ? 'checked' : ''?> > <span>75,000</span>
								</label>
	                        </div>  
					<?php 
							for ($i = 100000; $i <= 1000000; $i += 25000) 
							{	
								$checked = (in_array($i, $values)) ? 'checked' : '';
								?>
								<div class="col-sm-3">
									<label class="ui-checkbox">
										<input name="<?php echo $modelName?>[peer_comparision_coverage_amounts][]" type="checkbox" value="<?php echo $i;?>" class="model_coverage_amount" <?php echo $checked;?> > <span><?php echo Util::moneyFormatIndia($i)?></span>
									</label>
		                        </div>  
					<?php 	}
							for ($i = 1500000; $i <= 10000000; $i += 500000) 
							{	
								$checked = (in_array($i, $values)) ? 'checked' : '';
								?>
								<div class="col-sm-3">
									<label class="ui-checkbox">
										<input name="<?php echo $modelName?>[peer_comparision_coverage_amounts][]" type="checkbox" value="<?php echo $i;?>" class="model_coverage_amount" <?php echo $checked;?> > <span><?php echo Util::moneyFormatIndia($i)?></span>
									</label>
		                        </div> 
					<?php 	}	?>
	                     </div>
					</td>
				</tr>
				
				<tr>
					<th class="spec" scope="row">Peer Comparision Age (Max 3)</th>
					<td width="700" valign="top" style="text-align: left;">
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
					</td>
				</tr>
				
			</tbody>
		</table>
			
				                <div class="form-group">
				                </div>
				                <div class="form-group">
				                </div>
	<div id="peer_comparision_table">
	<?php 
		echo Util::peerComparisionTableViewBackend($allVariants, $policy_id, $peerValue, $modelName);
	?>
	</div>
<?php                 
	}
}
?>