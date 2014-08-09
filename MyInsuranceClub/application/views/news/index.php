<link rel="stylesheet" href="<?php echo base_url();?>assets/css/news.css">
<style type="text/css">
#blog-entry+.pagination {
	display: block;
}
</style>

<div id="highlighted" style="background: #fff; padding-bottom: 50px; margin-bottom: 0px;">
	<div class="container">
		<div class="row">
			<div class="col-md-12 cus_res_pad">
				<h1 class="header_all" style="border-bottom: 2px solid #dadada; padding-bottom: 10px; margin-bottom: 20px;">Insurance News 
					<?php echo (isset($currentPage) && !empty($currentPage)) ? '- Page '.$currentPage : '' ;?>
				</h1>
			</div>
			<section id="primary" class="col-md-8  one-col-sb" role="main">
				<div id="blog-entry" class="clearfix" style="position: relative; height: auto;">
				
<?php 
				if (!empty($newsDetails))
				{
					foreach ($newsDetails as $k1=>$v1)
					{
						$news = $v1['news'];
						$author = $v1['author'];
					//	$tag = $v1['tag'];	
						$url = base_url().'news/'.$news['news_slug'];
					
							$folderUrl = $this->config->config['folder_path']['news']['listing_image'];
							$fileUrl = $this->config->config['url_path']['news']['listing_image'];
							$imgUrl = '';//$fileUrl.'/logo_missing_300x220.jpg';
							
							if (isset($news['listing_image']) && !empty($news['listing_image']))
							{
								if (file_exists($folderUrl.$news['listing_image']))
								{
									$imgUrl = $fileUrl.$news['listing_image'];
								}
							}						
?>
						<article id="" class="masonry-box clearfix" role="article" style="">
<?php 						if (!empty($imgUrl))
							{	?>						
								<div class="entry-thumb">
									<a href="<?php echo $url;?>"> 
										<img width="300" height="220" src="<?php echo $imgUrl;?>" class="ct-transition wp-post-image" alt="<?php echo $news['title'];?>" title="<?php echo $news['title'];?>"> 
									</a>
									<div class="mask-thumb">
										<div class="mask-wrapper">
											<!-- /meta-likes -->
											<div class="entry-share-icons">
												<div class="share-title">Share this</div>
												<span class="share-icon"><i class="fa fa-share-square-o"></i> </span>
												<span class="ct-fb" title="Share on Facebook">
													<a href="http://www.facebook.com/sharer.php?u=<?php echo $url;?>" target="_blank">
														<i class="fa fa-facebook"></i> 
													</a> 
												</span> 
												<span class="ct-twitter" title="Share on Twitter">
													<a href="https://twitter.com/intent/tweet?text=<?php echo $news['title'];?>;url=<?php echo $url;?>" target="_blank">
														<i class="fa fa-twitter"></i> 
													</a> 
												</span> 
												<span class="ct-gplus" title="Share on Google Plus">
													<a href="https://plus.google.com/share?url=<?php echo $url;?>" target="_blank">
														<i class="fa fa-google-plus"></i> 
													</a> 
												</span> 
												<span class="ct-linkedin" title="Share on Linkedin">
													<a href="http://www.linkedin.com/shareArticle?title=<?php echo $news['title'];?>;url=<?php echo $url;?>" target="_blank">
														<i class="fa fa-linkedin"></i> 
													</a> 
												</span>
											</div>
											<!-- .entry-share-icons -->
										</div>
										<!-- .mask-wrapper -->
									</div>
									<!-- .mask-thumb -->
								</div>
<?php 						}	?>							
							<!-- .entry-thumb --> <header class="entry-header">
							<h1 class="entry-title" style="text-transform: none;">
								<a href="<?php echo $url;?>" rel="bookmark" title="<?php echo $news['title'];?>"><?php echo Util::getSubStringFromString($news['title'], 56);?></a>
							</h1>
							<div class="entry-content">
								<?php echo Util::getSubStringFromString($news['description'], 102);?>&nbsp;
								<a class="read-more left" href="" title=""></a>
							</div>
							
							<div class="entry-meta c_clr" style="float: left; width: 100%; margin-bottom: 0px;">
								<span class="meta-date updated" style="float: left; border: none;"><i class="fa fa-clock-o"></i><?php echo $this->util->getDate($news['publish_date'], 9)?></span> 
								<span class="meta-category" style="float: left; border: none; margin-left: 25px;"> <i class="fa fa-eye" title="views"></i> Views (<?php echo $news['page_view_count']?>) </span> 
								<span class="meta-comments" style="float: left; border: none; margin-left: 25px;"> <i class="fa fa-comments"></i>With 0 comments </span>
								<span class="meta-comments" style="float: left; border: none; margin-left: 25px;"> <i class="fa fa-comments"></i>with <?php //echo $news['comment_count'];?> comments </span>
							</div>
							
							<div class="entry-meta" style="float: left; width: 100%; padding-top: 0px;">
								<div class="entry-author clearfix" style="background: none; border: none;">
									<div class="meta-avatar clearfix">
									
			                    <?php 
										$folderUrl = $this->config->config['folder_path']['users']['75x75'];
										$fileUrl = $this->config->config['url_path']['users']['75x75'];
										$imgUrl = '';
										if (isset($author['user_image']) && !empty($author['user_image']))
										{
											if (file_exists($folderUrl.$author['user_image']))
											{
												$imgUrl = $fileUrl.$author['user_image'];
											}
										}
										?>
										<img alt="" src="<?php echo $imgUrl;?>" class="avatar avatar-32 photo" height="32" width="32">
									</div>
									<!-- .author-avatar -->
									<span class="ct-athr"> Author:&nbsp; 
										<span class="meta-author"> 
											<i class="fa fa-user" title="Author"></i> 
											<span class="author vcard">
												<a class="url fn n" href="<?php echo base_url().'news/author/'.$author['uacc_username'];?>" title="" rel="author"><?php echo $author['upro_first_name']; echo isset($author['upro_last_name']) ? ' '.$author['upro_last_name'] : '';?></a> 
											</span> 
										</span> <!-- .meta-author -->
									</span>
									<!-- .ct-athr -->
								</div>
							</div>
							<!-- .entry-content --> <!-- .entry-meta --> </header> <!-- .entry-header -->
						</article>
						
							
<?php 		
					}
				}
				else 
				{
					echo 'No news found';
				}
?>				
					<div class="pbd-alp-placeholder-2"></div>
				</div>
				<!-- #blog-entry --> 
				<nav class="pagination clearfix" role="navigation"> 
					<?php //echo $this->frontpagination->create_links();?>
					<?php echo $this->pagination->create_links();		?>
				<?php /*?>
				<span>Page 1 of 2</span> <span class="current">1</span>
				<a href="#" class="inactive">2</a>
				*/ ?>
				</nav> 
			</section>
			<!-- .col-md-12 -->
			<div id="secondary" class="col-md-4  home-sidebar widget-area">
				<aside id="" class="widget widget_ad">
				<h1 class="widget-title" style="color: #FFFFFF;">
					<span>Social Connections</span>
				</h1>
				<div class="tagcloud">
					<div class="banner-widget1-1">
						<div id="fb-root"></div>
						<script>(function(d, s, id) {
                              var js, fjs = d.getElementsByTagName(s)[0];
                              if (d.getElementById(id)) return;
                              js = d.createElement(s); js.id = id;
                              js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=550187845025415&version=v2.0";
                              fjs.parentNode.insertBefore(js, fjs);
                              }(document, 'script', 'facebook-jssdk'));
                           </script>
						<div class="fb-like-box"
							data-href="http://www.facebook.com/myinsuranceclub"
							data-width="100%" style="padding: 0px;" data-height="300"
							data-show-faces="true" data-stream="false"
							data-border-color="#fcfcfc" data-header="false"></div>
					</div>
				</div>
				</aside>
				
			<?php 
				//	most read news post
				echo widget::run('mostReadPost', array('top'=>$top, 'type'=>'news'));
			?>

			<?php 
				//	START CATEGORY WIDGET
				echo widget::run('categoryDropDown', array('allTags'=>$allTags, 'type'=>'news'));
			?>
				<!-- START ARCHIVES WIDGET -->
				<!-- END ARCHIVES WIDGET -->
				<!-- START AD WIDGET -->
				<aside class="widget widget_ad" id=""
					style="padding: 20px;text-align: center">
				<div id="over">
					<span class="Centerer"></span> <img class="Centered"
						src="assets/images/ad/banner-large.png" />
				</div>
				</aside>
				<!-- END AD WIDGET -->
			</div>
			<!-- .col-md-12 -->
		</div>
		<!-- .row -->
	</div>
</div>
