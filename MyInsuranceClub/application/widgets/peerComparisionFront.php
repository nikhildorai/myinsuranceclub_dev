<?php 
class PeerComparisionFront extends Widget{

      public function __construct() {

        parent::widget ();

    }

    function run($ext = array())
    {
        $company = isset($ext['company']) ? $ext['company'] : array();
        $policyDetails = isset($ext['policyDetails']) ? $ext['policyDetails'] : array();   
        $peerComparisionResult = isset($ext['peerComparisionResult']) ? $ext['peerComparisionResult'] : array();
        $policyVariants = isset($ext['policyVariants']) ? $ext['policyVariants'] : array();
        $type = isset($ext['type']) ? $ext['type'] : array();
        $features = isset($ext['features']) ? $ext['features'] : array();
        $variantType = $ext['variantType'];
        $arrUSCurrency = array('travel');
        
        $peerCoverageAmount = explode(',', $policyDetails['peer_comparision_coverage_amounts']);
        $peerAge = explode(',', $policyDetails['peer_comparision_age']);
        $peerComparisionType = $policyDetails['policy_composition_type'];
        $peerComparisionVariants = explode(',', $policyDetails['peer_comparision_variants']);
        $policyVariants = array_filter(array_values(array_flip($policyVariants)));
        foreach ($policyVariants as $k6=>$v6)	
			$peerComparisionVariants[] = $v6; 
		$peerComparisionVariants = implode(',', $peerComparisionVariants);
		$folderUrl = $this->config->config['folder_path']['company']['searchResultLogo']; 
		$fileUrl = $this->config->config['url_path']['company']['searchResultLogo'];
		$imgUrl = $fileUrl.'search_result_80x50.jpg';
		$imgName = $company['logo_image_2'];
//var_dump($currentVariant, $policyDetails, $company);        
?>

		
		<div class="col-sm-12">
			<div class="wid_25">
				<div class="h_w">Cover Amount</div>
				<div class="">
					<div class="wrapper-demo">
						<div id="dd" class="wrapper-dropdown-1" tabindex="1">
							<span id="peer_comparision_sum_assured" data-textval="<?php echo reset($peerCoverageAmount);?>" data-dataval="<?php echo reset($peerCoverageAmount);?>"><?php echo reset($peerCoverageAmount);?></span>
							<ul class="dropdown" tabindex="1">
							<?php 
								foreach ($peerCoverageAmount as $k7=>$v7)
								{	?>
									<li><a href="#" data-sum_assured = "<?php echo $v7;?>"><?php echo $v7;?></a></li>
						<?php 	}	?>
							</ul>
						</div>
						​
					</div>
				</div>
			</div>
			
			<div class="wid_25">
				<div class="h_w">Age</div>
				<div class="">
					<div class="wrapper-demo">
						<div id="dd1" class="wrapper-dropdown-1" tabindex="1">
							<span id="peer_comparision_age" data-textval="<?php echo reset($peerAge);?>" data-dataval="<?php echo reset($peerAge);?>"><?php echo reset($peerAge);?></span>
							<ul class="dropdown" tabindex="1">
							<?php 
								foreach ($peerAge as $k7=>$v7)
								{	?>
									<li><a href="#" data-sum_assured = "<?php echo $v7;?>"><?php echo $v7;?></a></li>
						<?php 	}	?>
							</ul>
						</div>
						​
					</div>
				</div>
			</div>
			
			<div class="wid_25">
				<div class="h_w">Term</div>
				<div class="c_w">
			<?php 	if ($type == 'travel')
						echo '7 Days';
					else 
						echo '1 Years';?>
				</div>
			</div>
			
			<div class="wid_25">
				<div class="h_w">Gender</div>
				<div class="c_w">Male</div>
			</div>
			<div class="wid_25">
				<div class="h_w">Life Style</div>
				<div class="c_w">
				<?php 
					$dis[] = array_key_exists( 'healthy',$features) ? (strtolower($features['healthy']) == 'yes') ? 'Healthy' : 'Non-Healthy' : '' ;
					$dis[] = array_key_exists( 'smoker',$features) ? (strtolower($features['smoker']) == 'yes') ? 'Smoker' : 'Non-Smoker' : '' ;
					echo implode(', ', array_filter($dis));
				?>
				</div>
			</div>
		</div>
		<div class="col-sm-12 clearfix no_pad_lr">
			<div class="col-sm-12 clearfix count_shw no_pad_lr" id="">
				<div class="col-md-12 no_pad_lr">
		
					<div class="col-md-4 no_pad_lr">
						<div class=" chartdiv clearfix">
							<div align="center">
							<?php 
								if (!empty($imgName) && file_exists($folderUrl.$imgName))
										$imgUrl = $fileUrl.$imgName;
							?>
								<img src="<?php echo $imgUrl;?>" border="0">
							</div>
							<div id="container" class="" style="max-width: 100%; height: 340px; margin: 0 auto"></div>
						</div>
					</div>
		<?php 
					if (!empty($peerComparisionResult))
					{				
						$i = 1;
						
						foreach ($peerComparisionResult as $k8=>$v8)
						{
							if (!in_array($v8['variant_id'], $policyVariants))
							{
								$imgUrl = $fileUrl.'search_result_80x50.jpg';
								$imgName = $v8['logo_image_2'];
								if (!empty($imgName) && file_exists($folderUrl.$imgName))
										$imgUrl = $fileUrl.$imgName;
								?>
								<div class=" col-md-2 no_pad_lr chartdiv<?php echo $i;?>">
									<div align="center">
										<img src="<?php echo $imgUrl;?>" border="0">
									</div>
					
									<div id="container<?php echo $i;?>" class="chartdiv" style="max-width: 100%; height: 340px; margin: 0 auto"></div>
								</div>
<?php 							$i++;
							}		
						}
					}				
		?>
				</div>
		
				<div class="cal">
					<a class="btn_offer_block" href="javascript:void(0)">
						Calculate Your Premium <i class="fa fa-angle-right"></i> 
					</a>
				</div>
		
			</div>
		
		</div>

	<script type="text/javascript">
		var policy_slug = "<?php echo $policyDetails['policy_slug']?>"
		var variant_type = "<?php echo $variantType;?>";
		var peerComparisionVariants = "<?php echo $peerComparisionVariants;?>";
		
		var chart_title_text	=	'';
		var chart_series_premium	= '';
		var chart_title_text1	=	'';
		var chart_series_premium1	= '';
		var chart_title_text2	=	'';
		var chart_series_premium2	= '';
		var chart_title_text3	=	'';
		var chart_series_premium3	= '';
		var chart_title_text4	=	'';
		var chart_series_premium4	= '';
		var currency = 'Rs. ';
<?php 
		$i = 1;
		foreach ($peerComparisionResult as $k8=>$v8)
		{	
			if (!in_array($v8['variant_id'], $policyVariants))
			{	?>
				chart_title_text<?php echo $i;?> = "<?php echo $v8['policy_name'].(strtolower($v8['variant_name']) != 'base' ? '<br>'.$v8['variant_name'] : '') ?>";
				chart_series_premium<?php echo $i;?> = <?php echo $v8['final_premium'] ?>;
<?php 			$i++;
    		}
    		else 
    		{	?>
				chart_title_text = "<?php echo $v8['policy_name'].(strtolower($v8['variant_name']) != 'base' ? '<br>'.$v8['variant_name'] : '') ?>";
				chart_series_premium = <?php echo $v8['final_premium'] ?>;
<?php 		}	?>			
<?php 	}
?>
	$(function() {
	
		var dd = new DropDown( $('#dd') );
		var dd = new DropDown( $('#dd1') );
		$(document).click(function() {
			// all dropdowns
			$('.wrapper-dropdown-1').removeClass('active');
		});

		
	});
	</script>
<?php                 
	}
}
?>