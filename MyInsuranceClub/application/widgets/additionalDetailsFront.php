<?php 
class additionalDetailsFront extends Widget{

      public function __construct() {

        parent::widget ();

    }

    function run($ext = array())
    {
        $policyDetails = isset($ext['policyDetails']) ? $ext['policyDetails'] : array();   
        $companyDetails = isset($ext['companyDetails']) ? $ext['companyDetails'] : array();
        $claimRatioJson = isset($ext['claimRatioJson']) ? $ext['claimRatioJson'] : array();
        
?>    	
				
		<div class="htabs col-lg-3 col-md-3 col-sm-12 col-xs-12" id="tabs">
			<a href="#tab-a" class="selected">Claims Ratio </a> 
			<a href="#tab-b" class="">Surrender Policy</a> 
			<a href="#tab-c" class="">Revive Policy</a> 
			<a href="#tab-d" class="">Loan</a> 
			<a href="#tab-e" class="">About Company</a>
		</div>
		<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
			<div class="tab-content box-description" id="tab-a" style="display: block;">
		
				<div class="form-add">
				<?php 
					$yearFrom = date('Y')-1;
					if ($yearFrom != '1999')
						$yearTo = substr(date('Y'), 2, 2);
					else 
						$yearTo = '2000';
				?>
					<h2>Claims Settlement Ratio in <?php echo  $yearFrom.'-'.$yearTo;?></h2>
					<div id="claims_ratio1" style="min-width: 50%; height: 500px; margin: 0 auto">
						<?php echo empty($claimRatioJson) ? 'No claim ratio found.' : ''; ?>
					</div>
				</div>
		
		
			</div>
			
			<div class="tab-content box-additional" id="tab-b" style="display: none;">
				<div class="box-collateral box-tags">
					<h2>Surrender Policy</h2>
					<div class="std"><?php echo $policyDetails['policy']['surrender_policy']?></div>
					<br class="clear clr">
				</div>
			</div>
			
			<div class="tab-content" id="tab-c" style="display: none;">
				<div class="box-collateral box-tags">
					<h2>Revive Policy</h2>
					<div class="std"><?php echo $policyDetails['policy']['revive_policy']?></div>
					<br class="clear clr">
				</div>
			</div>
			
			<div class="tab-content" id="tab-d" style="display: none;">
				<div id="customer-reviews" class="box-collateral box-reviews">
					<div class="form-add">
						<h2>Loan</h2>
						<div class="std"><?php echo $policyDetails['policy']['loan']?></div>
					</div>
				</div>
			</div>
			<div class="tab-content" id="tab-e" style="display: none;">
				<div id="customer-reviews" class="box-collateral box-reviews">
					<h2>About Company</h2>
					<div class="std"><?php echo $companyDetails['description_1']?></div>
										<br class="clear clr">
									</div>
								</div>
		</div>
		
<script type="text/javascript">
var companyClaimRatio = <?php echo $claimRatioJson; ?>;
</script>
	                
<?php                 
	}
}
?>