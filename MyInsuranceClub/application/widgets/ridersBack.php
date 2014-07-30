<?php 
class RidersBack extends Widget{

      public function __construct() {

        parent::widget ();

    }

    function run($ext = array())
    {
        $rSlug = isset($ext['rSlug']) ? $ext['rSlug'] : array();
        $riderModel = isset($ext['riderModel']) ? $ext['riderModel'] : array();     
?>    	
		<table cellspacing="0" class="eligibility">
			<tr>
				<th class="nobg" abbr="Configurations" scope="col">&nbsp;</th>
				<th scope="col">Rider Display Name</th>
				<th scope="col">Rider Value</th>
				<th scope="col">Comments</th>
			</tr>
<?php 
			$riderSlugs = Util::getRiderSlugs($rSlug);
			if (!empty($riderSlugs['slug']))
			{
				foreach ($riderSlugs['slug'] as $k1=>$v1)
				{	
					$valRidVal = $valCom = $valName = '';
					$valDisName = $v1;
					if (!empty($riderModel) && isset($riderModel[$k1]))
					{
						$valName = $riderModel[$k1]['rider_name'];
						$valDisName = $riderModel[$k1]['rider_display_name'];
						$valRidVal = $riderModel[$k1]['rider_value'];
						$valCom = $riderModel[$k1]['comments'];
					}
						?>
					<tr>
						<th class="spec" scope="row" width="234" valign="top" style="border-top: 1px solid #c1dad7">
							<?php echo $v1;?>
							<input type="hidden" class="form-control"  placeholder="" name="riderModel[<?php echo $k1;?>][rider_name]" value="<?php echo !empty($valName) ? $valName : $valDisName;?>"  >
						</th>
						<td width="258" valign="top" style="border-top: 1px solid #c1dad7">
							<input type="text" class="form-control"  placeholder="" name="riderModel[<?php echo $k1;?>][rider_display_name]" value="<?php echo $valDisName;?>"  >
						</td>
						<td width="258" valign="top" style="border-top: 1px solid #c1dad7">
							<input type="text" class="form-control"  placeholder="" name="riderModel[<?php echo $k1;?>][rider_value]" value="<?php echo $valRidVal;?>"  >
						</td>
						<td width="258" valign="top" style="border-top: 1px solid #c1dad7">
							<input type="text" class="form-control"  placeholder="" name="riderModel[<?php echo $k1;?>][comments]" value="<?php echo $valCom;?>"  >
						</td>
					</tr>
<?php 			}
			}
?>			                
								</table>
<?php                 
	}
}
?>