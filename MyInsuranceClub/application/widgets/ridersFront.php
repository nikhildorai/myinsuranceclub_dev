<?php 
class RidersFront extends Widget{

      public function __construct() {

        parent::widget ();

    }

    function run($ext = array())
    {
        $rSlug = isset($ext['rSlug']) ? $ext['rSlug'] : array();
        $riderModel = isset($ext['riderModel']) ? $ext['riderModel'] : array();     
?>    	

			<table class="bordered mar-40">
				<thead>

					<tr>
						<th colspan="2">Add-ons or Riders (for extra premium)</th>
					</tr>
				</thead>
				<tbody>
<?php 
			//$riderSlugs = Util::getRiderSlugs($rSlug);
//var_dump($riderSlugs, $riderModel);			
			if (!empty($riderModel))
			{
				$emptyRider = true;
				foreach ($riderModel as $k1=>$v1)
				{	
					if (!empty($k1) && !empty($v1))
					{
						$emptyRider = false;
						$valName = $v1['rider_name'];
						$valDisName = $v1['rider_display_name'];
						$valRidVal = $v1['rider_value'];
						$valCom = $v1['comments'];
							?>
						<tr>
							<td><?php echo $valName;?></td>
							<td><?php echo $valRidVal;?></td>
						</tr>
<?php 				}
				}
				if ($emptyRider == true)
					echo '<tr><td colspan="2">No Rider Options Available</td></tr>';
			}
?>			        
				</tbody>
			</table>
			
<?php                 
	}
}
?>