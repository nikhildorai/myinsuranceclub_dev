<?php 
class PeerComparisionBack extends Widget{

      public function __construct() {

        parent::widget ();

    }

    function run($ext = array())
    {
        $allVariants = isset($ext['allVariants']) ? $ext['allVariants'] : array();
        $policy_id = isset($ext['policy_id']) ? $ext['policy_id'] : ''; 
        $peerValue = (isset($ext['pear_comparision_policies']) && !empty($ext['pear_comparision_policies'])) ?  $ext['pear_comparision_policies'] : '';
        
?>    	
		<script type="text/javascript">
			$(document).ready(function(){
				$('.peerComparisionChk').click(function(e){
					var countCheckedCheckboxes = $('.peerComparisionChk').filter(':checked').length;
					if(countCheckedCheckboxes > 4)
					{
						alert('You can select only 4 peers variants');
						e.preventDefault();
					}					
				});
			});
		</script>   	
	
	<table cellspacing="0" class="eligibility">
			<tr>
				<th scope="col">Company Name</th>
				<th scope="col">Policy Name</th>
				<th scope="col">Variant Name</th>
				<th scope="col">Comparision Count</th>
				<th class="nobg" abbr="Configurations" scope="col" style=" border-right:0px; !important">&nbsp;</th>
			</tr>
<?php 
			
			$peerValue = explode(',', $peerValue);			
			if (!empty($allVariants))
			{
				foreach ($allVariants as $k1=>$v1)
				{	
					if ($v1['policy_id'] != $policy_id)
					{
						$checked = '';
						if (in_array($v1['variant_id'], $peerValue))
							$checked = 'checked';
						?>
					<tr>
						<td class="spec" scope="row" width="334" valign="top" style="border-top: 1px solid #c1dad7; border-left: 1px solid #c1dad7">
							<?php echo $v1['company_display_name']?>
						</td>
						<td class="spec" scope="row" width="334" valign="top" style="border-top: 1px solid #c1dad7">
							<?php echo (!empty($v1['policy_display_name'])) ? $v1['policy_display_name'] : $v1['policy_name']?>
						</td>
						<td class="spec" scope="row" width="234" valign="top" style="border-top: 1px solid #c1dad7">
							<?php echo $v1['variant_name']?>
						</td>
						<td class="spec" scope="row" width="200" valign="top" style="border-top: 1px solid #c1dad7">
							<?php echo $v1['peer_comparision_count']?>
						</td>
						<td class="spec" scope="row" width="24" valign="top" style="border-top: 1px solid #c1dad7;">
							<label class="ui-checkbox"><input name="model[pear_comparision_policies][]" type="checkbox" value="<?php echo $v1['variant_id']?>" class="peerComparisionChk" <?php echo $checked;?>><span></span></label>
						</td>
					</tr>
<?php 										
					}
				}
			}
?>			                
	</table>
<?php                 
	}
}
?>