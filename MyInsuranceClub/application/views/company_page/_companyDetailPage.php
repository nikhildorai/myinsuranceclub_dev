
<div class="col-md-9" style="padding-right: 0px;">
	<h2 class="title-divider">
		<span><?php echo $companyDetails['company_name'];?> </span>
	</h2>
	<div class="top_col border-box-1 radius2">
		<ul class="listsocial">
			<li class="google"><g:plusone size="medium"></g:plusone>
			</li>
			<li class="like" style="width: 105px; height: 10px;"><span
				id="ctl00_cphBody_lblfacebook"> <iframe
						src='//www.facebook.com/plugins/like.php?href=http://www.myinsuranceclub.com/life-insurance/companies/canara-hsbc&amp;send=false&amp;layout=button_count&amp;width=450&amp;show_faces=false&amp;font&amp;colorscheme=light&amp;action=like&amp;height=65'
						scrolling='no' frameborder='0'
						style='border: none; overflow: hidden; width: 450px; height: 65px;'
						allowTransparency='true'></iframe> </span></li>
			<li class="reweet"><span id="ctl00_cphBody_lbltweet"><a
					href='http://twitter.com/share' class='twitter-share-button'
					data-url='http://www.myinsuranceclub.com/life-insurance/companies/canara-hsbc'
					data-count='horizontal'>Tweet</a> <script type='text/javascript'
						src='http://platform.twitter.com/widgets.js'></script> </span>
			</li>
			<li class="last"><span id="ctl00_cphBody_ViewCount_lblViewsCount">
					17,083</span>&nbsp;Views</li>
		</ul>
	</div>
<?php 
if (!empty($policies))
{		?>
	<div class="company_term">
		<h3 class="t_cmp_header">
			<span>List of Plans from <?php echo $companyDetails['company_display_name'];?>
			</span>
		</h3>
		
		<div class="col-md-6 fst">
<?php 
		$i = 2;
		foreach ($policies as $k1=>$v1)
		{
			if (!empty($v1) && ($i % 2 == 0))
			{
			?>
				<h3 class="sub_h_cmp"><?php echo $k1?> <?php echo (count($v1['policy'])>1) ? 'Plans' : 'Plan'?></h3>
				<ul class="cmp_ul">
<?php 			foreach ($v1['policy'] as $k2=>$v2)
				{	
					?>				
					<li>
						<a href="<?php echo base_url().$v2['policy_url'];?>"><?php echo $v2['policy_name'];?> </a>
					</li>
<?php 			}		?>					
					<li class="cmp_link">
						<a href="javascript:void(0)">Compare <?php echo $k1?> <i class="fa fa-arrow-right"></i> </a>
					</li>
				</ul>
<?php 		
			}
			$i++;
		}	?>
		</div>


<?php 
		if (count($policies) > 1)
		{	?>
			<div class="col-md-6 ">
	<?php 
			$i = 1;
			foreach ($policies as $k1=>$v1)
			{
				if (!empty($v1) && ($i % 2 == 0))
				{
				?>
					<h3 class="sub_h_cmp"><?php echo $k1?> <?php echo (count($v1['policy'])>1) ? 'Plans' : 'Plan'?></h3>
					<ul class="cmp_ul">
	<?php 			foreach ($v1['policy'] as $k2=>$v2)
					{	
						?>				
						<li>
							<a href="<?php echo base_url().$v2['policy_url'];?>"><?php echo $v2['policy_name'];?> </a>
						</li>
	<?php 			}		?>					
						<li class="cmp_link">
							<a href="javascript:void(0)">Compare <?php echo $k1?> <i class="fa fa-arrow-right"></i> </a>
						</li>
					</ul>
	<?php 		
				}
				$i++;
			}	?>
			</div>
<?php 	}
?>


<?php /*?>

		<div class="col-md-6 fst">
			<h3 class="sub_h_cmp">Term Insurance Plan</h3>
			<ul class="cmp_ul">
				<li>
					<a href="javascript:void(0)">Canara HSBC eSmart Term PlanOnline </a>
				</li>
				<li class="cmp_link">
					<a href="javascript:void(0)">Compare Term Insurance Plans <i class="fa fa-arrow-right"></i> </a>
				</li>
			</ul>
			
			<h3 class="sub_h_cmp">Child Plans</h3>
			<ul class="cmp_ul">
				<li>
					<a href="javascript:void(0)"> Canara HSBC Future Smart Plan</a>
				</li>
				<li>
					<a href="javascript:void(0)">Shubh Laabh</a>
				</li>
				<li class="cmp_link">
					<a href="javascript:void(0)">Compare Child Plans <i class="fa fa-arrow-right"></i> </a>
				</li>
			</ul>
			
			<h3 class="sub_h_cmp">Unit Linked Insurance Plans - ULIPs</h3>
			<ul class="cmp_ul">
				<li>
					<a href="javascript:void(0)"> Canara HSBC Grow Smart Plan</a>
				</li>
				<li>
					<a href="javascript:void(0)">Canara HSBC Dream Smart Plan</a>
				</li>
				<li>
					<a href="javascript:void(0)">Canara HSBC Insure Smart Plan</a>
				</li>
				<li class="cmp_link">
					<a href="javascript:void(0)">Compare ULIPs <i class="fa fa-arrow-right"></i> </a>
				</li>
			</ul>
			
			<ul class="cmp_ul" style="margin-top: 30px;">
				<li>
					View <a href="javascript:void(0)">List of Withdrawn Plans from Canara HSBC OBC</a>
				</li>
			</ul>
		</div>
		
		<div class="col-md-6">
			<h3 class="sub_h_cmp">Money Back Plan</h3>
			<ul class="cmp_ul">
				<li>
					<a href="javascript:void(0)">Smart Stage Money Back Plan</a>
				</li>
				<li class="cmp_link">
					<a href="javascript:void(0)">Compare Money Back Plans <i class="fa fa-arrow-right"></i> </a>
				</li>
			</ul>
			
			<h3 class="sub_h_cmp">Monthly Income Plan</h3>
			<ul class="cmp_ul">
				<li>
					<a href="javascript:void(0)">Canara HSBC Smart Monthly Income Plan</a>
				</li>
			</ul>
			<h3 class="sub_h_cmp">Annuity Plan</h3>
			<ul class="cmp_ul">
				<li>
					<a href="javascript:void(0)"> Immediate Pension</a>
				</li>
			</ul>
		</div>
		*/ ?>
	</div>
<?php 
}
?>	
	
	
<?php 			if (!empty($companyDetails)) {?>				
	<div class="company_abt">
		<h3 class="t_cmp_header">
			<span><?php echo $companyDetails['heading_1'];?></span>
		</h3>
		<p class="mar-20">
<?php 
						$folderUrl = $this->config->config['folder_path']['company']['companyPageLogo']; 
						$fileUrl = $this->config->config['url_path']['company']['companyPageLogo'];
						$imgUrl = $fileUrl.'logo_missing_172x68.jpg';
						if (!empty($companyDetails['logo_image_1']) && file_exists($folderUrl.$companyDetails['logo_image_1']))
							$imgUrl = $fileUrl.$companyDetails['logo_image_1'];
?>					
			<img src="<?php echo $imgUrl;?>" align="left"  class="cus_border_im">
			<?php 
			$strip_list = array('p');
			foreach ($strip_list as $tag)
			{
			    $companyDetails['description_1'] = preg_replace('/<\/?' . $tag . '(.|\s)*?>/', '', $companyDetails['description_1']);
			}
			echo nl2br($companyDetails['description_1']);?>
		</p>
	</div>
	<div class="company_abt">
		<h3 class="t_cmp_header">
			<span><span><?php echo $companyDetails['heading_2'];?></span></span>
		</h3>
		<p class="mar-20" align="center" style="width: 100%; float: left; text-align: center;">
<?php 
						$folderUrl = $this->config->config['folder_path']['company']['companyLeadership']; 
						$fileUrl = $this->config->config['url_path']['company']['companyLeadership'];
						$imgUrl = $fileUrl.'logo_missing_160x160.jpg';
						if (!empty($companyDetails['logo_image_leadership']) && file_exists($folderUrl.$companyDetails['logo_image_leadership']))
							$imgUrl = $fileUrl.$companyDetails['logo_image_leadership'];
?>					
			<img src="<?php echo $imgUrl;?>" class="round_image">
		</p>
		<p align="center" style="width: 100%; float: left; text-align: center;">
			<?php echo nl2br($companyDetails['description_2']);?>
		</p>
	</div>
<?php }	?>				
	<div class="company_abt">
		<h3 class="t_cmp_header">
			<span>Contact Details</span>
		</h3>



		<div class="col-md-6 no_pad_l mar-20">

<?php 					if (!empty($companyDetails['address']))	
						{	?>
			<address class="adr span6">
				<em class="fa fa-map-marker"></em> 
				<strong class="t_h">Corporate Office</strong><br>
				<div class="road">
					<?php echo nl2br($companyDetails['address']); ?>
				</div>
				<br>
			</address>
<?php 					}	?>
			<div style="float: left; width: 100%; margin-top: 20px;">
				<?php 	if (!empty($companyDetails['twitter'])) { 	?><span class="follow"><em class="fa fa-twitter"></em> <?php echo $companyDetails['twitter'];?></span><?php } ?> 
				<?php 	if (!empty($companyDetails['facebook'])) { 	?><span class="follow"><em class="fa fa-facebook"></em> <?php echo $companyDetails['facebook'];?></span><?php } ?> 
				<?php 	if (!empty($companyDetails['google_plus'])) { 	?><span class="follow"><em class="fa fa-google-plus"></em> <?php echo $companyDetails['google_plus'];?></span><?php } ?>
			</div>



		</div>


		<div class="col-md-6 mar-20 no_pad_l">
			<span class="phone"><em class="fa fa-phone"></em>1800 103 0003</span><br>
			<?php 	if (!empty($companyDetails['website'])) { 	?><span class="web"><em class="fa fa-globe"></em><?php echo $companyDetails['website'];?></span><br><?php } ?>
			<?php 	if (!empty($companyDetails['email'])) { 	?><span class="mail"> <em class="fa fa-envelope"></em><?php echo $companyDetails['email'];?></span><br><?php } ?>
			<?php 	if (!empty($companyDetails['sms'])) { 	?><span class="phone"><em class="fa fa-envelope-o"></em><?php echo $companyDetails['sms'];?></span><?php } ?>
		</div>
	</div>

<?php 
				if (!empty($claimRatio))
				{			
					?>
		<div class="company_abt claim_r">
			<h3 class="t_cmp_header">
				<span>Claims ratio of <?php echo $companyDetails['company_display_name'];?></span>
			</h3>


			<table class="mar-20">
				<thead>
					<tr>
						<th>Years</th>
	<?php 				foreach ($claimRatio as $k1=>$v1)
						{
							$yearFrom = $v1['year_from'];
							if ($yearFrom != '1999')
								$yearTo = substr($v1['year_to'], 2, 2);
							else 
								$yearTo = '2000';
							echo '<th>'.$yearFrom.' - '.$yearTo.'</th>';
						}
	?>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Claims ratio</td>
	<?php 				foreach ($claimRatio as $k1=>$v1)
						{
							echo '<td>'.$v1['claim_ratio'].'</td>';
						}
	?>
					</tr>

				</tbody>
			</table>
<?php /*?>						
						<div class="col-md-12 text-rightp" style="margin-top: 15px;">
							<a href="javascript:void(0)">View Older Data <span class="ic">+</span>
							</a>
						</div>
<?php */ ?>	
		</div>
<?php 			}	?>



<?php /*?>

				<div class="company_abt claim_r">
					<h3 class="t_cmp_header">
						<span>NAVs of funds in ULIPs from <?php echo $companyDetails['company_display_name'];?></span>
					</h3>


					<table class="mar-20">
						<thead>
							<tr>
								<th>ULIPs</th>
								<th>NAVs (in Rs.)</th>
								<th>Date</th>
								<th>Change</th>
								<th>% Change</th>

							</tr>
						</thead>
						<tbody>
							<tr>
								<td>AEGON Religare Assure Plus Plan - Accelerator Fund</td>
								<td>16.75400</td>
								<td>16-05-2014</td>
								<td>0.13</td>
								<td>0.78</td>

							</tr>
							<tr>
								<td>AEGON Religare Assure Plus Plan - Debt Fund</td>
								<td>17.75400</td>
								<td>16-05-2014</td>
								<td>0.11</td>
								<td>0.98</td>

							</tr>

							<tr>
								<td>AEGON Religare Assure Plus Plan - Secure Fund</td>
								<td>16.75400</td>
								<td>16-05-2014</td>
								<td>0.13</td>
								<td>0.78</td>

							</tr>

							<tr>
								<td>AEGON Religare Assure Plus Plan - Accelerator Fund</td>
								<td>15.75400</td>
								<td>16-05-2014</td>
								<td>0.03</td>
								<td>0.98</td>

							</tr>


							<tr>
								<td>AEGON Religare Assure Plus Plan - Discontinued Policy Fund</td>
								<td>18.75400</td>
								<td>16-05-2014</td>
								<td>0.10</td>
								<td>0.03</td>

							</tr>

						</tbody>
					</table>
					<div class="col-md-12 text-rightp" style="margin-top: 15px;">
						<a href="javascript:void(0)">View Older Data <span class="ic">+</span>
						</a>
					</div>
					</div>
<?php */ ?>

	

	<!--<div class="company_abt one_time" id="ad_show_premium">
  <div class="col-md-12 mar-25 no_pad_lr">
     
     
        <div id="claims_ratio1" style="min-width:50%; height: 400px; margin: 0 auto"></div>
        
        </div>
        </div>-->


	<div class="company_abt ">
		<div class="col-md-12 mar-25 no_pad_lr">
			<div class="top_ins"></div>
			<h3 class="header_art">News on <?php echo $companyDetails['company_display_name'];?></h3>
			<div class="col-md-6" style="padding-left: 0px;">
				<div class="art_cnt widget ">
					<h4 class="sub_h" style="margin-top: 0px;">How to secure your
						future with pension</h4>
					<div class="textwidget">
						<p>
							<img style="border: 0px none;" alt=""
								src="assets/images/art1.jpg">At any moment, an unhappy
							customer can share their opinion with the masses through...How
							to speak with an Indian Accent.
						</p>
					</div>
					<div class="comnt">
						<span class="text-left l">1,348 views</span> <span
							class="text-right r">0 comments</span>
					</div>
				</div>
				<div class="art_cnt widget ">
					<h4 class="sub_h" style="margin-top: 0px;">How to secure your
						future with pension</h4>
					<div class="textwidget">
						<p>
							<img style="border: 0px none;" alt=""
								src="assets/images/art1.jpg">At any moment, an unhappy
							customer can share their opinion with the masses through...How
							to speak with an Indian Accent.
						</p>
					</div>
					<div class="comnt">
						<span class="text-left l">1,348 views</span> <span
							class="text-right r">0 comments</span>
					</div>
				</div>
			</div>
			<div class="col-md-6 ">
				<div class="art_cnt widget ">
					<h4 class="sub_h" style="margin-top: 0px;">How to secure your
						future with pension</h4>
					<div class="textwidget">
						<p>
							<img style="border: 0px none;" alt=""
								src="assets/images/art1.jpg">At any moment, an unhappy
							customer can share their opinion with the masses through...How
							to speak with an Indian Accent.
						</p>
					</div>
					<div class="comnt">
						<span class="text-left l">1,348 views</span> <span
							class="text-right r">0 comments</span>
					</div>
				</div>
				<div class="art_cnt widget ">
					<h4 class="sub_h" style="margin-top: 0px;">How to secure your
						future with pension</h4>
					<div class="textwidget">
						<p>
							<img style="border: 0px none;" alt=""
								src="assets/images/art1.jpg">At any moment, an unhappy
							customer can share their opinion with the masses through...How
							to speak with an Indian Accent.
						</p>
					</div>
					<div class="comnt">
						<span class="text-left l">1,348 views</span> <span
							class="text-right r">0 comments</span>
					</div>
				</div>
			</div>
			<div class="col-md-12 text-rightp">
				<a href="javascript:void(0)">More Articles <span class="ic">+</span>
				</a>
			</div>
		</div>
	</div>










	<div class="company_abt  ">
		<div class="col-md-12 mar-25 no_pad_lr">
			<div class="top_ins"></div>
			<h3 class="header_art">Videos on <?php echo $companyDetails['company_display_name'];?></h3>
			<div class="col-md-4" style="padding-left: 0px;">

				<div class="art_cnt widget video">
					<div class="textwidget">

						<a href="http://www.youtube.com/watch?v=zkdv8Plk58Q"
							target="_blank"><img
							src="http://img.youtube.com/vi/zkdv8Plk58Q/0.jpg"
							class="img_t" style="max-width: 94%;" border="0"> </a>

					</div>
					<div class="comnt">
						<p>I have been sold 7 ulip policies</p>
					</div>
				</div>
			</div>
			<div class="col-md-4 ">
				<div class="art_cnt widget video">
					<div class="textwidget">

						<a href="http://www.youtube.com/watch?v=lUxY6sx6U9s"
							target="_blank"><img
							src="http://img.youtube.com/vi/lUxY6sx6U9s/0.jpg"
							class="img_t" style="max-width: 100%;" border="0"> </a>


					</div>
					<div class="comnt">
						<p>I have been sold 7 ulip policies</p>
					</div>
				</div>
			</div>


			<div class="col-md-4 ">
				<div class="art_cnt widget video">
					<div class="textwidget">

						<a href="http://www.youtube.com/watch?v=kOhdPbf7p3M"
							target="_blank"><img
							src="http://img.youtube.com/vi/kOhdPbf7p3M/0.jpg"
							class="img_t" style="max-width: 100%;" border="0"> </a>


					</div>
					<div class="comnt">
						<p>I have been sold 7 ulip policies</p>
					</div>

				</div>
			</div>

			<div class="col-md-12 text-rightp">
				<a href="javascript:void(0)">More Videos <span class="ic">+</span>
				</a>
			</div>
		</div>
	</div>
	</div>




	<div class="col-md-3 sidebar sidebar-right">
		<div class="inner">
			<div class="block"></div>
			<div class="block"></div>
		</div>
	</div>