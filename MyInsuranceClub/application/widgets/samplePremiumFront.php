<?php 
class SamplePremiumFront extends Widget{

      public function __construct() {

        parent::widget ();

    }

    function run($ext = array())
    {
        $vModel = isset($ext['variant']) ? $ext['variant'] : array();
        $features = isset($ext['features']) ? $ext['features'] : array();
?>    	
			<div id="pricing-table">

				<div class="sam_h">
				<?php 
				if (array_key_exists( 'maximum_coverage_amount',$features) && !empty($features['maximum_coverage_amount']))
				{
				?>
					<div class="c_am">
						<i class="fa fa-life-ring"></i>
						<div class="c_text">
							<div class="c_text_m">Cover Amount</div>
							= <?php echo ucwords($features['maximum_coverage_amount']);?>
						</div>
					</div>
<?php 			}	?>		
				<?php 
				if (array_key_exists( 'gender',$features) && !empty($features['gender']))
				{
				?>
					<div class="c_am">
						<i class="fa fa-male"></i>
						<div class="c_text2">
							<div class="c_text_m">Gender</div>
							= <?php echo ucwords($features['gender']);?>
						</div>
					</div>
<?php 			}	?>			
		
				<?php 
				if ((array_key_exists( 'smoker',$features) || array_key_exists( 'healthy',$features)) && ( !empty($features['smoker']) ||  !empty($features['healthy'])))
				{
				?>
					<div class="c_am">
						<i class="fa fa-smile-o"></i>
						<div class="c_text3">
							<?php 
								$dis[] = array_key_exists( 'healthy',$features) ? (strtolower($features['healthy']) == 'yes') ? 'Healthy' : 'Non-Healthy' : '' ;
								$dis[] = array_key_exists( 'smoker',$features) ? (strtolower($features['smoker']) == 'yes') ? 'Smoker' : 'Non-Smoker' : '' ;
							echo implode(', ', array_filter($dis))?>
						</div>
					</div>
				</div>
<?php 			}	?>	


				<div class="sam_c">
<?php 
					if ((array_key_exists( 'sample_premium_age_1',$features) && array_key_exists( 'sample_premium_amount_1',$features))  && ( !empty($features['sample_premium_age_1']) &&  !empty($features['sample_premium_amount_1'])))
					{
?>				
						<div class="plan  col-sm-3" id="most-popular1">
							<h3>
								Age = <?php echo $features['sample_premium_age_1'];?><span style="position: relative; top: 15px;"><font style="font-family: DejaVu Sans">&#x20b9;</font><?php echo $features['sample_premium_amount_1'];?></span>
							</h3>
							<ul>
							</ul>
	
						</div>
<?php 				}	?>		
<?php 
					if ((array_key_exists( 'sample_premium_age_2',$features) && array_key_exists( 'sample_premium_amount_2',$features))  && ( !empty($features['sample_premium_age_2']) &&  !empty($features['sample_premium_amount_2'])))
					{
?>							
						<div class="plan  col-sm-3">
							<h3>
								Age = <?php echo $features['sample_premium_age_2'];?><span>&#8377;<?php echo $features['sample_premium_amount_2'];?></span>
							</h3>
							<ul>
							</ul>
						</div>
<?php 				}	?>	
<?php 
					if ((array_key_exists( 'sample_premium_age_3',$features) && array_key_exists( 'sample_premium_amount_3',$features))  && ( !empty($features['sample_premium_age_3']) &&  !empty($features['sample_premium_amount_3'])))
					{
?>							
						<div class="plan  col-sm-3">
							<h3>
								Age = <?php echo $features['sample_premium_age_3'];?><span>&#8377;<?php echo $features['sample_premium_amount_3'];?></span>
							</h3>
							<ul>
							</ul>
						</div>
<?php 				}	?>	
<?php 
					if ((array_key_exists( 'sample_premium_age_4',$features) && array_key_exists( 'sample_premium_amount_4',$features))  && ( !empty($features['sample_premium_age_4']) &&  !empty($features['sample_premium_amount_4'])))
					{
?>							
						<div class="plan  col-sm-3">
							<h3>
								Age = <?php echo $features['sample_premium_age_4'];?><span>&#8377;<?php echo $features['sample_premium_amount_4'];?></span>
							</h3>
							<ul>
							</ul>
						</div>
<?php 				}	?>	
					<div class="cal" style="bottom: 10px;">
						<a href="javascript:void(0)" class="btn_offer_block">Calculate
							Your Premium <i class="fa fa-angle-right"></i> </a>
					</div>
				</div>
			</div>
<?php                 
	}
}
?>