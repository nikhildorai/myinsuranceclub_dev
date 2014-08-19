<?php 
class PeerComparisionFront extends Widget{

      public function __construct() {

        parent::widget ();

    }

    function run($ext = array())
    {
        $policyDetails = isset($ext['policyDetails']) ? $ext['policyDetails'] : array();   
        $companyDetails = isset($ext['companyDetails']) ? $ext['companyDetails'] : array();
//var_dump($policyDetails);        
?>

		
		<div class="col-sm-12">
			<div class="wid_25">
				<div class="h_w">Cover Amount</div>
				<div class="">
					<div class="wrapper-demo">
						<div id="dd" class="wrapper-dropdown-1" tabindex="1">
							<span>50 Lakhs</span>
							<ul class="dropdown" tabindex="1">
								<li><a href="#">50 Lakhs</a></li>
								<li><a href="#">1 Crore</a></li>
							</ul>
						</div>
						​
					</div>
				</div>
			</div>
			<div class="wid_25">
				<div class="h_w">Term</div>
				<div class="">
					<div class="wrapper-demo">
						<div id="dd1" class="wrapper-dropdown-1" tabindex="1">
							<span>25 Years</span>
							<ul class="dropdown" tabindex="1">
								<li><a href="#">25 Years</a></li>
								<li><a href="#">30 Years</a></li>
							</ul>
						</div>
						​
					</div>
				</div>
			</div>
			<div class="wid_25">
				<div class="h_w">Age</div>
				<div class="c_w">25 Years</div>
			</div>
			<div class="wid_25">
				<div class="h_w">Gender</div>
				<div class="c_w">Male</div>
			</div>
			<div class="wid_25">
				<div class="h_w">Life Style</div>
				<div class="c_w">Healthy, Non smoker</div>
			</div>
		</div>
		<div class="col-sm-12 clearfix no_pad_lr">
			<div class="col-sm-12 clearfix count_shw no_pad_lr" id="">
				<div class="col-md-12 no_pad_lr">
		
					<div class="col-md-4 no_pad_lr">
						<div class=" chartdiv clearfix">
							<div align="center">
								<img src="<?php echo base_url();?>assets/images/company/hdfc.jpg" border="0">
							</div>
							<div id="container" class="" style="max-width: 100%; height: 300px; margin: 0 auto"></div>
						</div>
					</div>
		
					<div class=" col-md-2 no_pad_lr chartdiv1">
						<div align="center">
							<img src="<?php echo base_url();?>assets/images/company/bharti-axa-general-insurance-company-small.jpg" border="0">
						</div>
		
						<div id="container1" class="chartdiv" style="max-width: 100%; height: 300px; margin: 0 auto"></div>
					</div>
		
		
					<div class="col-md-2 no_pad_lr chartdiv2">
						<div align="center">
							<img src="<?php echo base_url();?>assets/images/company/l-t-general-insurance-company-small.jpg" border="0">
						</div>
		
						<div id="container2" class="chartdiv" style="max-width: 100%; height: 300px; margin: 0 auto"></div>
					</div>
		
					<div class="col-md-2 no_pad_lr chartdiv3">
						<div align="center">
							<img src="<?php echo base_url();?>assets/images/company/bajaj-allianz-general-insurance-company-small.jpg" border="0">
						</div>
						<div id="container3" class="chartdiv" style="max-width: 100%; height: 300px; margin: 0 auto"></div>
					</div>
		
					<div class="col-md-2 no_pad_lr chartdiv4">
						<div align="center">
							<img src="<?php echo base_url();?>assets/images/company/tata-aig-general-insurance-company-small.jpg" border="0">
						</div>
						<div id="container4" class="chartdiv" style="max-width: 100%; height: 300px; margin: 0 auto"></div>
					</div>
				</div>
		
				<div class="cal">
					<a class="btn_offer_block" href="javascript:void(0)">
						Calculate Your Premium <i class="fa fa-angle-right"></i> 
					</a>
				</div>
		
			</div>
		
		</div>

<?php                 
	}
}
?>