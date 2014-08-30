<?php 
class EligibilityConditionsFront extends Widget{

      public function __construct() {

        parent::widget ();

    }

    function run($ext = array())
    {
        $model = isset($ext['model']) ? $ext['model'] : array();
        $modelType = isset($ext['modelType']) ? $ext['modelType'] : '';
    	$type = isset($ext['type']) ? $ext['type'] : array();
    	$arrUSCurrency = array('travel');
?>    	
		
               
		
		<div class="smart-grids col-md-12 clearfix">
			<table class="bordered">
				<thead>
	
					<tr>
						<th></th>
						<th>Minimum</th>
						<th>Maximum</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Coverage Amount (in <?php echo (in_array($type, $arrUSCurrency)) ? 'USD' : 'Rs.' ;?>)</td>
						<?php 
							$default = array('value'=>array(), 'comment'=>'');
							$arrValues = array_key_exists( 'coverage_amount',$model) ? unserialize($model['coverage_amount']) : $default;
							$arrValues = Util::array_overlay($default, $arrValues);		
						?>
						<td align="center"><?php echo Util::moneyFormatIndia(reset($arrValues['value']));?></td>
						<td align="center"><?php echo Util::moneyFormatIndia(end($arrValues['value']));?><?php echo !empty($arrValues['comments']) ? ', '.$arrValues['comments'] : '';?></td>
					</tr>
					<tr>
						<td>Policy Term (In <?php echo (in_array($type, $arrUSCurrency)) ? 'Days' : 'Years' ;?>)</td>
						<?php 
							$arrValues = array_key_exists( 'policy_terms',$model) ? unserialize($model['policy_terms']) : array();
						?>
						<td align="center"><?php echo reset($arrValues);?></td>
						<td align="center"><?php echo end($arrValues);?></td>
					</tr>
					<tr>
						<?php 			
	                	$default = array(	'minimum'=>array(	'individual'=>array('value'=>'', 'type'=>'', 'comments'=>''),
	                													'family_floater'=>array('value'=>'', 'type'=>'', 'comments'=>'')),
							                'maximum'=>array(	'individual'=>array('value'=>'', 'type'=>'', 'comments'=>''),
							                							'family_floater'=>array('value'=>'', 'type'=>'', 'comments'=>'')));
	                	
						$arrValues = array_key_exists( 'entry_age',$model) ? unserialize($model['entry_age']) : $default;
						$arrValues = Util::array_overlay($default, $arrValues); ?>
						<td>Entry Age (in years)</td>
						<td align="center">
						<?php 	
							$min = '';
							if (!empty($arrValues['minimum']['individual']['value']) && empty($arrValues['minimum']['family_floater']['value']))
								$min =  $arrValues['minimum']['individual']['value'];
							else if (empty($arrValues['minimum']['family_floater']['value']) && !empty($arrValues['minimum']['family_floater']['value']))
								$min =  $arrValues['minimum']['individual']['value'];
							else if (!empty($arrValues['minimum']['individual']['value']) && !empty($arrValues['minimum']['family_floater']['value']))
								$min = 'Individual : '.$arrValues['minimum']['individual']['value'].' '.(!empty($arrValues['minimum']['individual']['type']) ? $arrValues['minimum']['individual']['type'] : 'Years').'<br>Family Floater : '.$arrValues['minimum']['family_floater']['value'].' '.(!empty($arrValues['minimum']['family_floater']['type']) ? $arrValues['minimum']['family_floater']['type'] : 'Years');
							echo $min;
						?>
						<?php echo !empty($arrValues['minimum']['individual']['comments']) ? ', '.$arrValues['minimum']['individual']['comments'] : '';?>
						<?php echo !empty($arrValues['minimum']['family_floater']['comments']) ? ', '.$arrValues['minimum']['family_floater']['comments'] : '';?>
						</td>
						<td align="center">
						<?php 	
							$min = '';
							if (!empty($arrValues['maximum']['individual']['value']) && empty($arrValues['maximum']['family_floater']['value']))
								$min =  $arrValues['maximum']['individual']['value'];
							else if (empty($arrValues['maximum']['individual']['value']) && !empty($arrValues['maximum']['family_floater']['value']))
								$min =  $arrValues['maximum']['family_floater']['value'];
							else if (!empty($arrValues['maximum']['individual']['value']) && !empty($arrValues['maximum']['family_floater']['value']))
								$min = 'Individual : '.$arrValues['maximum']['individual']['value'].' '.(!empty($arrValues['maximum']['individual']['type']) ? $arrValues['maximum']['individual']['type'] : 'Years').'<br>Family Floater : '.$arrValues['maximum']['family_floater']['value'].' '.(!empty($arrValues['maximum']['family_floater']['type']) ? $arrValues['maximum']['family_floater']['type'] : 'Years');
							echo $min;
						?>
						<?php echo !empty($arrValues['maximum']['individual']['comments']) ? ', '.$arrValues['maximum']['individual']['comments'] : '';?>
						<?php echo !empty($arrValues['maximum']['family_floater']['comments']) ? ', '.$arrValues['maximum']['family_floater']['comments'] : '';?>
						</td>
					</tr>
					<tr>
						<td><?php echo (in_array($type, $arrUSCurrency)) ? 'Is Renewable' : 'Renewable till Age (in years)' ;?></td>
						<?php 		
						$default = array('type'=>'', 'max'=>'', 'min'=>'');
						$arrValues = array_key_exists( 'renewal_age',$model) ? unserialize($model['renewal_age']) : $default;
						$arrValues = Util::array_overlay($default, $arrValues);
						if (in_array($arrValues['type'], array('renewable','non renewable')))
						{	?>
							<td align="center" colspan="2">
								<?php echo ucwords($arrValues['type']);?>
							</td>
			<?php		}
			 			else
						{						?>
						<td align="center">
						<?php echo ($arrValues['type'] != 'lifelong') ? (array_key_exists( 'min',$arrValues) ? $arrValues['min'] : '0') : '-';?>
						</td>
						<td align="center">
						<?php echo ($arrValues['type'] != 'lifelong') ? array_key_exists( 'max',$arrValues) ? $arrValues['max'] : '-' : 'Lifelong';?>
						</td>
			<?php 		}	?>			
					</tr>
					<tr>
						<td>No Medical Test Age (in years)</td>
						<?php
						$default = array('covered'=>'', 'min'=>'', 'max'=>'', 'comments'=>'');
						$arrValues = array_key_exists( 'no_medical_test_age',$model) ? unserialize($model['no_medical_test_age']) : $default;
						$arrValues = Util::array_overlay($default, $arrValues);
						$selected = $arrValues['covered'];
						?>
						<td align="center">
							-<?php //echo array_key_exists( 'minimum_no_medical_test_age',$vFeatures) ? $vFeatures['minimum_no_medical_test_age'] : '';?>
						</td>
						<td align="center">
							<?php echo ($arrValues['covered'] == 'yes') ? $arrValues['max'] : 'Not Covered'; ?>
							<?php echo !empty($arrValues['comments']) ? ', '.$arrValues['comments'] : '';?>
						</td>
					</tr>
				</tbody>
			</table>
		</div>

<?php                 
	}
}
?>