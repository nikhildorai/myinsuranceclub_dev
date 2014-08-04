<?php 
class PeerComparisionBack extends Widget{

      public function __construct() {

        parent::widget ();

    }

    function run($ext = array())
    {
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

				var formData = {product_id:productId, sub_product_id:subProductId, peerValue:peerValue, modelName:modelName, policy_id:policy_id};

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
	<div id="peer_comparision_table">
	<?php 
		echo Util::peerComparisionTableViewBackend($allVariants, $policy_id, $peerValue, $modelName);
	?>
	</div>
<?php                 
	}
}
?>