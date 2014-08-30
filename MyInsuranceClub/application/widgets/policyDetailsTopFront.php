<?php 
class PolicyDetailsTopFront extends Widget{

      public function __construct() {

        parent::widget ();

    }

    function run($ext = array())
    {
        $policyDetails = isset($ext['policyDetails']) ? $ext['policyDetails'] : array();
        $url = isset($ext['url']) ? $ext['url'] : base_url();
        $company = isset($ext['company']) ? $ext['company'] : array();
        if (!empty($policyDetails))
        {	?>
			<h2 class="title-divider">
				<span><?php echo $policyDetails['policy_name'];?></span>
			</h2>
			<div class="row">
				<div class="col-md-9" style="padding-right: 0px;">
					<div class="top_col border-box-1 radius2" style="min-height: 515px;">
						<header class="share-header"> <aside class="shares social">
						<div class="total-shares" data-index="0">
							<em><?php echo number_format($policyDetails['page_view_count']+1);?></em>
							<div class="caption">View<?php echo ((int)$policyDetails['page_view_count']+1 > 1) ? 's' : '';?></div>
						</div>
						<div class="total-shares" data-index="0">
							<em>424</em>
							<div class="caption">Comments</div>
						</div>
						<div class="share-buttons v2">
							<div class="share-container">
								<div class="share-count">2.5k</div>
								<div class="primary-shares">
									<a class="social-share facebook fa fa-facebook-square" href="http://www.facebook.com/sharer/sharer.php?u=<?php echo $url;?>" target="_blank"> 
										<span class="expanded-text">Share on Facebook</span> 
									</a> 
									<a class="social-share twitter fa fa-twitter" href="http://twitter.com/share?url=<?php $url?>" target="_blank"> 
										<span class="alt-text">Tweet</span> 
										<span class="expanded-text">Share on Twitter</span> 
									</a>
									<div class="share-toggle fa fa-plus"></div>
								</div>
								<div class="secondary-shares">
									<a class="social-share google_plus fa fa-google-plus" href="https://plus.google.com/share?url=<?php echo $url;?>" target="_blank"></a> 
									<a class="social-share linked_in fa fa-linkedin-square" href="http://www.linkedin.com/shareArticle?url=<?php echo $url;?>" target="_blank"></a>
									<div class="secondary-share-toggle fa fa-minus"></div>
								</div>
							</div>
						</div>
						</aside> </header>
						<div class="col-md-12">
							<div class="col-md-5 no_pad_l">
								<div class="logo_pages border-box-1 radius2">
	<?php 
									if (isset($policyDetails['policy_logo']) && !empty($policyDetails['policy_logo']))
									{
										$folderUrl = $this->config->config['folder_path']['policy']['policy_logo']; 
										$fileUrl = $this->config->config['url_path']['policy']['policy_logo'];
										$imgUrl = $fileUrl.'logo_missing_172x68.jpg';
										$imgName = $policyDetails['policy_logo'];
									}
									else 
									{
										$folderUrl = $this->config->config['folder_path']['company']['companyPageLogo']; 
										$fileUrl = $this->config->config['url_path']['company']['companyPageLogo'];
										$imgUrl = $fileUrl.'logo_missing_172x68.jpg';
										$imgName = $company['logo_image_1'];
									}
									
									if (!empty($imgName) && file_exists($folderUrl.$imgName))
										$imgUrl = $fileUrl.$imgName;
	?>							
									<img src="<?php echo $imgUrl;?>" border="0">
								</div>
								<div class="col-5" style="margin-top: 20px;">
									<table class="table table-bordered table-striped"
										id="description_details" itemprop="breadcrumb">
										<tbody>
	
											<tr>
												<td>Product Type</td>
												<td class="value">
													<?php 
													$product = array();
													foreach ($policyDetails['product'] as $k2=>$v2)
													{
														$product[] = $v2['product_name'];
													}
													echo implode(',', $product);?>
												</td>
											</tr>
											<tr>
												<td>Sub Product Type:</td>
												<td class="value">
													<?php 
													$subProduct = array();
													foreach ($policyDetails['sub_product'] as $k2=>$v2)
													{
														$subProduct[] = $v2['sub_product_name'];
													}
													echo implode(',', $subProduct);?>
												</td>
											</tr>
	<?php 									if (!empty($policyDetails['policy_uin']))
											{	?>
											<tr>
												<td>UIN</td>
												<td class="value"><?php echo $policyDetails['policy_uin'];?></td>
											</tr>
									<?php 	}	?>		
										</tbody>
									</table>
								</div>
							</div>
							<div class="col-md-7">
								<div class="product-name">
									<h1><?php echo $policyDetails['policy_display_name'];?></h1>
								</div>
	<?php 
								if (!empty($policyDetails['key_features']))
								{
									$keyFeatures = unserialize($policyDetails['key_features']);
									if (!empty($keyFeatures))
									{
										foreach ($keyFeatures as $k1=>$v1)
										{	?>
											<p class="availability in-stock">
												<span class="p-icons"><i class="fa fa-check"></i> </span>
												<?php echo $v1;?>
											</p>
	<?php 								}
									}
								}
	?>							
	
								<div class="short-description">
									<h2>Quick Overview</h2>
									<div class="std"><?php echo $policyDetails['quick_overview']?></div>
								</div>
							</div>
						<?php if (!empty($policyDetails['tweet_property'])){?>						
							<div class="tw_sh">
								<div style="width: 50px;; float: left;">
									<a class="feature-icon-hover " href="javascript:void(0)"
										title="Tweet This"> <span class="v-center"> <span
											class="icon i-recommend-bw icon-color-productview fa fa-thumbs-up"></span>
									</span> </a>
								</div>
								<div
									style="width: auto; max-width: 92%; float: left; position: relative;">
									<div class="twt">
										<span><?php echo $policyDetails['tweet_property'];?></span><span class="tw_th">Tweet
											This</span>
									</div>
									<div class="twt_img">
										<img src="<?php echo base_url();?>assets/images/twt_share.png"
											border="0">
									</div>
								</div>
							</div>
						<?php }?>						
						</div>
					</div>
				</div>
				<div class="col-md-3 sidebar sidebar-right">
					<div class="inner">
						<div class="block">
							<img src="<?php echo base_url();?>assets/images/ad/hdfc.jpg"
								style="max-width: 100%;" border="0">
						</div>
						<div class="block">
							<img src="<?php echo base_url();?>assets/images/ad/hdfc.jpg"
								style="max-width: 100%;" border="0">
						</div>
					</div>
				</div>
			</div>

<?php   }             
	}
}
?>