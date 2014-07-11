<span id="o_touch"></span>

<div id="highlighted" style="background: #fff; padding-bottom: 50px; margin-bottom: 0px;">
	<div class="container">
		<?php
		$min_annual_premium='';
		$max_annual_premium='';
		if(count($customer_details) > 0)
		{
			$anuual_premium = array_map(function($details)
			{
				return $details['annual_premium'];
			}, $customer_details);
			$min_annual_premium=min($anuual_premium);
			$max_annual_premium=max($anuual_premium);
		}
		elseif(count($customer_details) == 0)
		{
			$min_annual_premium='0';
			$max_annual_premium='0';
		}
		?>
		<div class="top_band">
			<div class="col-md-3  border m_a">
				<div class="top_h">Your Search</div>
				<div class="top_p">
					Members = <?php echo isset($this->session->userdata['user_input']['plan_type_name']) ? $this->session->userdata['user_input']['plan_type_name'] : 'Myself';?>
				</div>
				<div class="top_p">
					Occupation = <?php echo isset($this->session->userdata['user_input']['cust_occupation_name']) ? $this->session->userdata['user_input']['cust_occupation_name'] : 'Accountant';?>
				</div>
				<div class="top_m">
					<i class="fa fa-angle-left"></i> 
					<a href="<?php echo site_url('health_insurance/personal_accident');?>">Modify Your Search</a>
				</div>
			</div>

			<div class="col-md-2  border c_o">
				<div id="sh1" style="display: none">
					<div class="top_h_t">Companies</div>
					<div id="com_c" class="top_p_n odometer">0</div>
				</div>

			</div>

			<div class="col-md-2  border c_o">
				<div id="sh2" style="display: none">
					<div class="top_h_t">Plans</div>
					<div id="plan_c" class="top_p_n odometer">0</div>
				</div>
			</div>
			<div class="col-md-5  noborder clearfix">
				<div id="sh3" style="display: none">
					<div class="top_h_t text-left">Price Range</div>
					<div class="top_p_n text-left" style="float: left;">
						<span style="float: left; margin-top: 7px;">&#8377;</span>
						<span id="pr_ra" class="odometer" style="float: left;">0</span>
						<span style="float: left; margin-top: 7px;""> &nbsp;- &#8377;</span>
						<span id="pr_rb" class="odometer" style="float: left;">0</span>
					</div>
				</div>
				<div id="sh4" style="position: absolute;">
					<i class="fa fa-check-square-o"></i>
				</div>
			</div>

		</div>
		<div id="loader">
			<img src="<?php echo base_url();?>assets/images/loader.gif" border="0">
		</div>
		<div class="" style="margin-top: 20px; display: none;" id="prdt_dis">
			<div class="col-md-9 col-md-push-3 cus_res_hlth" style="padding-right: 0px;">
				<div class="col-md-12" style="padding: 0px;">
				<?php echo form_open('health_insurance/personal_accident/compare_policies',array('id'=>'compare'));?>
					<div style="height: auto; padding: 10px 0px 30px 0px; background: #ededec; border-radius: 4px;">
						<div class="col-md-5 plan">Plan Details</div>
						<div class="col-md-3 an">Annual Premium</div>
						<div class="col-md-4 text-right plan_cmpre">
							<a href="javascript:void(0);" id="comparePolicy" class="cmp_p_s">Compare Plans</a>
						</div>
					</div>
					<div  id="cmp_tbl_result">
						<?php echo $this->util->getUserSearchFiltersHtml($customer_details, $type = "personalAccident");?>
					</div>
					<?php echo form_close();?>
				</div>




			</div>
			<!--Sidebar-->
			<div class="col-md-3 col-md-pull-9 sidebar sidebar-left" style="padding: 0px;">
				<?php echo form_open('health_insurance/personal_accident/get_personal_accident_results',array('id'=>'search'));?>
				<div class="inner" style="margin-bottom: 50px;">
					<div class="block1" style="position: relative;">
						<h6 class="fh3 l"><?php echo count($customer_details);?> of <?php echo count($customer_details);?> plans</h6>
						<h6 class="fh3">Premium</h6>
						<div class="filterContent ">
							<div style="float: left; width: 100%; position: relative; top: -30px;">
								<input type="text" id="amount_a" readonly="" class="s_l"> 
								<input type="text" id="amount1_a" readonly="" class="s_r">
							</div>
							<div id="slider-range1"></div>
							<div class="price rangeSlider">
								<p class="displayStaticRange clearFix" style="padding-bottom: 0px; margin-bottom: 0px;">
									<span class="fLeft"><span data-pr="<?php echo $min_annual_premium; ?>" class="INR">&#8377;</span><?php echo number_format($min_annual_premium); ?></span>
									<span class="fRight"><span data-pr="<?php echo $max_annual_premium; ?>" class="INR">&#8377;</span><?php echo number_format($max_annual_premium); ?></span>
								</p>
								<input type="hidden" name="price" value="<?php echo $min_annual_premium.'-'.$max_annual_premium; ?>">
							</div>
						
							<p class="addOnFilter" style="margin: 0px; padding: 0px;">
								<h6 class="fh3 l" style="margin: 0px; padding: 0px; height: 9px;">&nbsp;</h6>
							</p>


							<h6 class="fh3">Company</h6>
							<div class="addOnFilter clearfix">
                   		<?php 	
                   			if (!empty($customer_details))
                   			{
	                   			$newVal = array();
                   				foreach($customer_details as $k=>$v)
                   				{
                   					$aNew[$v['company_id']]['company'] = $v;
                   					$aNew[$v['company_id']]['premium'][] = $v['annual_premium'];
                   				}    				
                   				if(!empty($aNew))
                   				{
	                   				foreach ($aNew as $company)
	                   				{	
	                   					$premium = $company['premium'];
	                   					sort($premium);
	                   					?>				
										<div style="width: 100%; float: left;">
											<div class="checkbox" style="width: auto; float: left; margin: 0px;">
												<label> 
													<input type="checkbox" class="field checkbox search_filter" name="company_name[]" value="<?php echo $company['company']['company_id'];?>"> 
													<label for="23" class=""><?php echo $company['company']['company_shortname'];?></label> 
												</label>
											</div>
											<span style="float: right;"><?php echo 'Rs. '.reset($premium).' - Rs. '.end($premium);?></span>
										</div>
							<?php 	}
                   				}
                   			}
                   				?>			
							</div>

							<p class="addOnFilter" style="margin: 0px; padding: 0px;">
							
							
							<h6 class="fh3 l" style="margin: 0px; padding: 0px; height: 9px;">&nbsp;
							</h6>
							</p>

							<h6 class="fh3">Claims ratio of company</h6>


							<!--<div class="" ng-controller="DemoController34" style="margin-top:30px;">
                <div range-slider min="0" max="100" model-min="demo1.min" model-max="demo1.max"></div>-->

							<p>

								<input type="text" id="amount" readonly class="s_l"> <input
									type="text" id="amount1" readonly class="s_r">
							</p>
							<div id="slider-range"></div>

						</div>
					</div>

				</div>
				<?php echo form_close();?>
			</div>
		</div>
	</div>



</div>
</div>


<div id="search_sense_of_urgency_popup"
	class="hcom_simple_popdiv hcom_urgency_popup" style="display: none;">
	<div class="arrow">
		<div class="outer"></div>
		<div class="inner"></div>
	</div>
	<div id="searchUrgencyPopupBox">

		<div class="fader">
			<div class="arrow-w arrowlocation1" style="font-size: 1em;"></div>
			<div id="tutorial1" class="tutorial createquestion1">Just booked
				Health Policy 7 minutes ago from United Kingdom.</div>
		</div>
		<div class="fader">
			<div class="arrow-w arrowlocation1" style="font-size: 1em;"></div>
			<div id="tutorial1" class="tutorial createquestion1">In 2013-14,
				Exide Life Insurance recorded doubling in profits to Rs 53 crore
				driven by growth in renewal premiums and improvements in efficiency
				and product mix.</div>
		</div>
		<div class="fader">
			<div class="arrow-w arrowlocation1" style="font-size: 1em;"></div>
			<div id="tutorial1" class="tutorial createquestion1">Reliance Life
				Insurance launches Claims Guarantee service.</div>
		</div>
		<div class="fader">
			<div class="arrow-w arrowlocation1" style="font-size: 1em;"></div>
			<div id="tutorial1" class="tutorial createquestion1">IDBI Federal
				Life Insurance today launched a bouquet of individual products
				catering to various life stage needs of customers along with group
				solutions.</div>
		</div>



		<div></div>
	</div>
</div>

<div class="tutorial"></div>


<script type="text/javascript">

var company_count = "<?php echo count($aNew);?>";
var plan_count = "<?php echo count($customer_details);?>";
var min_premium = "<?php echo $min_annual_premium;?>";
var max_premium = "<?php echo $max_annual_premium;?>";
var hospital_list_url = "<?php echo base_url().'health_insurance/basicMediclaim/get_hospital_list'?>";

</script>



<script type="text/javascript">

	$(document).ready(function() {

		$('.search_filter').on('click',function(){
			data = $('#search').serialize();

			 $.ajax({
					type:"post", 
					url:"<?php echo base_url().'health_insurance/personal_accident/get_personal_accident_results'?>",
					data:data,
					success:function(data)
					{
						$('#cmp_tbl_result').html(data);
					}
				});
		});
	});

</script>