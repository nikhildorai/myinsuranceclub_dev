<?php 
class SamplePremiumBack extends Widget{

      public function __construct() {

        parent::widget ();

    }

    function run($ext = array())
    {
        $model = isset($ext['model']) ? $ext['model'] : array();
?>    	
		
                <div class="form-group">
                    <label for="" class="col-sm-4">Gender</label>
                    <div class="col-sm-8">
                    <?php 
						$selected = array_key_exists( 'gender',$model) ? $model['gender'] : '';
						$options = array('male'=>'Male', 'female'=>'female', 'male, female'=>'Both');		
						foreach ($options as $k1=>$v1)
						{
							$op = array(
							    'name'        => 'model[gender]',
							    'value'       => $k1,
							    'checked'     => ($selected == $k1) ? TRUE : FALSE,
							    'style'       => 'margin:10px',
							    );
							echo '<label class="ui-radio">'.form_radio($op).'<span>'.$v1.'</span></label>';
						}
					?>
                   	</div>
                </div>	
                
                
                <div class="form-group">
                    <label for="" class="col-sm-4">Healthy</label>
                    <div class="col-sm-8">
                    <?php 
						$selected = array_key_exists( 'healthy',$model) ? $model['healthy'] : '';
						$options = array('yes'=>'Yes', 'no'=>'No');		
						foreach ($options as $k1=>$v1)
						{
							$op = array(
							    'name'        => 'model[healthy]',
							    'value'       => $k1,
							    'checked'     => ($selected == $k1) ? TRUE : FALSE,
							    'style'       => 'margin:10px',
							    );
							echo '<label class="ui-radio">'.form_radio($op).'<span>'.$v1.'</span></label>';
						}
					?>
                   	</div>
                </div>	
                
                
                <div class="form-group">
                    <label for="" class="col-sm-4">Smoker</label>
                    <div class="col-sm-8">
                    <?php 
						$selected = array_key_exists( 'smoker',$model) ? $model['smoker'] : '';
						$options = array('yes'=>'Yes', 'no'=>'No');	
						foreach ($options as $k1=>$v1)
						{
							$op = array(
							    'name'        => 'model[smoker]',
							    'value'       => $k1,
							    'checked'     => ($selected == $k1) ? TRUE : FALSE,
							    'style'       => 'margin:10px',
							    );
							echo '<label class="ui-radio">'.form_radio($op).'<span>'.$v1.'</span></label>';
						}
					?>
                   	</div>
                </div>	
                
                
				<table cellspacing="0" class="eligibility">
					<tbody>
						<tr>
							<th class="nobg" abbr="Configurations" scope="col">&nbsp;</th>
							<th scope="col">Age</th>
							<th scope="col">Premium Amount</th>
						</tr>
						<tr>
							<th class="spec" scope="row">Sample Premium 1</th>
							<td width="352" valign="top">
								<input type="text" class="form-control"  placeholder="Sample Age" name="model[sample_premium_age_1]" value="<?php echo array_key_exists( 'sample_premium_age_1',$model) ? $model['sample_premium_age_1'] : '';?>"  >
						</td>
						<td width="352" valign="top">
							<input type="text" class="form-control"  placeholder="Sample Premium" name="model[sample_premium_amount_1]" value="<?php echo array_key_exists( 'sample_premium_amount_1',$model) ? $model['sample_premium_amount_1'] : '';?>"  >
						</td>
					</tr>
					<tr>
						<th class="specalt" scope="row">Sample Premium 2</th>
						<td width="352" valign="top">
							<input type="text" class="form-control"  placeholder="Sample Age" name="model[sample_premium_age_2]" value="<?php echo array_key_exists( 'sample_premium_age_2',$model) ? $model['sample_premium_age_2'] : '';?>"  >
						</td>
						<td width="352" valign="top">
							<input type="text" class="form-control"  placeholder="Sample Premium" name="model[sample_premium_amount_2]" value="<?php echo array_key_exists( 'sample_premium_amount_2',$model) ? $model['sample_premium_amount_2'] : '';?>"  >
						</td>
					</tr>
					<tr>
						<th class="spec" scope="row">Sample Premium 3</th>
						<td width="352" valign="top">
							<input type="text" class="form-control"  placeholder="Sample Age" name="model[sample_premium_age_3]" value="<?php echo array_key_exists( 'sample_premium_age_3',$model) ? $model['sample_premium_age_3'] : '';?>"  >
						</td>
						<td width="352" valign="top">
							<input type="text" class="form-control"  placeholder="Sample Premium" name="model[sample_premium_amount_3]" value="<?php echo array_key_exists( 'sample_premium_amount_3',$model) ? $model['sample_premium_amount_3'] : '';?>"  >
						</td>
					</tr>
					<tr>
						<th class="specalt" scope="row">Sample Premium 4</th>
						<td width="352" valign="top">
							<input type="text" class="form-control"  placeholder="Sample Age" name="model[sample_premium_age_4]" value="<?php echo array_key_exists( 'sample_premium_age_4',$model) ? $model['sample_premium_age_4'] : '';?>"  >
						</td>
						<td width="352" valign="top">
							<input type="text" class="form-control"  placeholder="Sample Premium" name="model[sample_premium_amount_4]" value="<?php echo array_key_exists( 'sample_premium_amount_4',$model) ? $model['sample_premium_amount_4'] : '';?>"  >
							</td>
						</tr>
					</tbody>
				</table>
<?php                 
	}
}
?>