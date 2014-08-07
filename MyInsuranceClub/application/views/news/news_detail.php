<link rel="stylesheet" href="<?php echo base_url();?>assets/css/news.css">

<div id="highlighted" class="single" style="background:#fff; margin-top:30px; padding-bottom:50px; margin-bottom:0px;" >
  <div class="container">
    <div class="row">
     <!-- <div class="col-md-12">
        <div class="ad_top">Advertisement Banner</div>
      </div>-->
<?php 
if (empty($newsDetails))
{
	echo 'No news found.';
}
else 
{
	$news = $newsDetails['news'];
	$author = $newsDetails['author'];
	//$tag = $newsDetails['tag'];	
	$url = base_url().'news/'.$news['news_slug'];

	$folderUrl = $this->config->config['folder_path']['news']['main_image'];
	$fileUrl = $this->config->config['url_path']['news']['main_image'];
	$imgUrl = "";
	
	if (isset($news['main_image']) && !empty($news['main_image']))
	{
		if (file_exists($folderUrl.$news['main_image']))
		{
			$imgUrl = $fileUrl.$news['main_image'];
		}
	}
	?>
      <div id="primary" class="content-area col-md-8 ">
        <article id="" class="clearfix" >
          <div id="" class="site-content" role="main">
            <header class="entry-header clearfix">
              <h1 class="entry-title" itemprop="name"><?php echo $news['title'];?></h1>
              <div class="entry-meta clearfix">
              
               <span class="meta-date updated"><i class="fa fa-clock-o"></i><?php echo $this->util->getDate($news['publish_date'],9)?> </span><!-- .meta-date --> 
               
                
                <span class="meta-views" title="Views"> <i class="fa fa-eye"></i><?php echo $news['page_view_count'] + 1;?>&nbsp;views </span><!-- /meta-views --> 
              
                
                <span class="meta-author"> <i class="fa fa-user" title="Author"></i> <span class="author vcard"><a class="url fn n" href="<?php echo base_url().'author/'.$author['uacc_username'];?>" title="" rel="author"> <?php echo $author['upro_first_name']; echo isset($author['upro_last_name']) ? ' '.$author['upro_last_name'] : '';?> </a></span> </span><!-- .meta-author --> 
                <div style="width:auto; margin-top:4px; float:left;"><div class="fb-like" data-href="http://www.myinsuranceclub.com/" data-layout="button_count" data-action="like" data-show-faces="true" data-share="false"></div></div>
                
                
                <div style="width:83px; margin-top:4px; margin-left:10px; float:left;"> <a href="http://www.myinsuranceclub.com/" class="twitter-share-button" data-via="twitterapi" data-lang="en">Tweet</a></div>
                
                <div style="width:auto; margin-top:4px; margin-left:0px; float:left;">
<script type="IN/Share" data-url="http://www.myinsuranceclub.com" data-counter="right"></script></div>
                
              </div>
              <!-- .entry-meta --> 
              
            </header>
            
          <!--    <div class="content_box">
            <span class='st_sharethis_vcount' displayText='ShareThis'></span>
<span class='st_facebook_vcount' displayText='Facebook'></span>
<span class='st_twitter_vcount' displayText='Tweet'></span>
<span class='st_linkedin_vcount' displayText='LinkedIn'></span>
<span class='st_pinterest_vcount' displayText='Pinterest'></span>
<span class='st_email_vcount' displayText='Email'></span>

</div>-->

<!--
<script type="text/javascript">
//<![CDATA[
  (function() {
    var shr = document.createElement('script');
    shr.setAttribute('data-cfasync', 'false');
    shr.src = '//dsms0mj1bbhn4.cloudfront.net/assets/pub/shareaholic.js';
    shr.type = 'text/javascript'; shr.async = 'true';
    shr.onload = shr.onreadystatechange = function() {
      var rs = this.readyState;
      if (rs && rs != 'complete' && rs != 'loaded') return;
      var site_id = 'ef757ee2f730f1e04a3abe9b00ffac9d';
      try { Shareaholic.init(site_id); } catch (e) {}
    };
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(shr, s);
  })();
//]]>
</script>
<div class='shareaholic-canvas' data-app='share_buttons' data-app-id='7396778'></div>-->

            <!-- .entry-header --> 
            
            <!-- Post Thumbnail -->
       <?php if (!empty($imgUrl)){?>     
            <div class="entry-thumb"> <img src="<?php echo $imgUrl;?>" alt="<?php echo $news['title'];?>" title="<?php echo $news['title'];?>"> </div>
      <?php }?>      
            <!-- .entry-thumb -->
            
            <div class="entry-content clearfix" itemprop="articleBody">
<?php
				$description = array(); 
				if (!empty($news['description']))
					$description = explode('###', $news['description']);
				if (!empty($description))
				{
					echo reset($description);
				}
				if (!empty($news['tweet_property']))
?>
						<div class="tw_sh">
							<div style="width: 50px;; float: left;">
								<a title="Tweet This" href="javascript:void(0)"
									class="feature-icon-hover "> <span class="v-center"> <span
										class="icon i-recommend-bw icon-color-productview fa fa-thumbs-up"></span>
								</span> </a>
							</div>
							<div style="width: auto; max-width: 92%; float: left; position: relative;">
								<div class="twt">
									<span><?php echo $news['tweet_property'];?></span>
									<span class="tw_th">Tweet This</span>
								</div>
								<div class="twt_img">
									<img border="0" src="<?php echo base_url();?>assets/images/twt_share.png">
								</div>
							</div>
						</div>
					<?php 
					if (count($description) > 1)
					{
						$i = 1;						
						foreach ($description as $k1=>$v1)
						{
							if (!empty($v1) && $i != 1)
								echo $v1;
							$i++;
						}
					}
					?>						
            </div>
            <!-- .entry-content -->
            
          <!--  <footer class="entry-meta clearfix"><span class="tag-links meta-tags"><i class="fa fa-paperclip" title="Tags"></i> <span class="tags-title">Tags:</span>
            <a href="#" rel="tag">Travel</a>, <a href="#" rel="tag">Invest</a>, <a href="#" rel="tag">Savings</a>, <a href="#" rel="tag">Lifestyle</a></span></footer>-->
            
            
            
            
            

            
            
            
            
            
            
            
          

            
            <!-- .entry-share-icons -->
            
            <div id="author-block" class="clearfix"> 
              
              <div class="author-avatar clearfix"> <img alt="" src="http://viralfave.com/wp-content/uploads/deepika-padukone-wiki-2.jpg" class="avatar avatar-75 photo" height="75" width="75"> </div>
              <!-- #author-avatar -->
              
              <div class="author-description clearfix">
                <div class="ct-athr-left">
                  <p>Hi, my name is  <strong><?php echo $author['upro_first_name']; echo isset($author['upro_last_name']) ? ' '.$author['upro_last_name'] : '';?></strong>. Mark territory stick butt in face, or climb leg use lap as chair missing until dinner time for chew foot.<br/>
                    <br/>
                     <a class="author-site sm-italic-gray" href="<?php echo base_url().'author/'.$author['uacc_username'];?>">View my other posts</a> 
                    </p>
                    
                </div>
             
              </div>
              <!-- #author-description	--> 
            </div>
            <!-- .author-block -->
            
            
            
            
            
            
            
            
            <div class="social_count  clearfix">
            
            
            <div class="col-md-6 no_pad_lr"><h3>Did you find this news useful?</h3>
            
            <div style="margin-top:-10px; float:left;">
            <div class="grid_4 your-rating ratings-wrapper  clearfix">
      <div class="rating-top">
                <div data-original-rating-num="-" class="rating-widget-num right " style="display: none;">-</div>
                
            </div>
<?php /*?>            
        <div  data-za-events="click" class="rating-widget-stars left" id="ratingDivParent">
          <div data-rating="0" data-originalclass="user_stars2_2" class="rating-cls user_stars2_2">
          <a  data-hover-rating="1.0" data-num="2" class="level-1" href="javascript:void(0);">&nbsp;</a>
          <a  data-hover-rating="2.0" data-num="4" class="level-3" href="javascript:void(0);">&nbsp;</a>
          <a  data-hover-rating="3.0" data-num="6" class="level-5" href="javascript:void(0);">&nbsp;</a>
          <a  data-hover-rating="4.0" data-num="8" class="level-7 " href="javascript:void(0);">&nbsp;</a>
          <a  data-hover-rating="5.0" data-num="10" class="level-9 level-0" href="javascript:void(0);">&nbsp;</a> 
          </div>
        </div>
*/ ?>        

		<div data-za-events="click" class="rating-widget-stars left" id="ratingDivParent">
			<div data-rating="0" data-originalclass="user_starssel_0" class="rating-cls user_starssel_0">
				<a id="rating-id-1" data-hover-rating="1.0" data-num="2" class="level-1 ratingSystem ratingHover" href="javascript:void(0);">&nbsp;</a> 
				<a id="rating-id-3" data-hover-rating="2.0" data-num="4" class="level-3 ratingSystem ratingHover" href="javascript:void(0);">&nbsp;</a> 
				<a id="rating-id-5" data-hover-rating="3.0" data-num="6" class="level-5 ratingSystem ratingHover" href="javascript:void(0);">&nbsp;</a> 
				<a id="rating-id-7" data-hover-rating="4.0" data-num="8" class="level-7 ratingSystem ratingHover big" href="javascript:void(0);">&nbsp;</a> 
				<a id="rating-id-9" data-hover-rating="5.0" data-num="10" class="level-9 ratingSystem ratingHover big bigger" href="javascript:void(0);">&nbsp;</a>
			</div>
		</div>        
        
        
        
      </div>

				<div class="tot_votes">
					<div class="avg_vote">
						<span id="ratingValueId"><?php echo (!empty($news['rating_value']) && $news['rating_value'] != 0) ? number_format($news['rating_value'], 1) : 0;?></span><span class="sm">/5</span>
					</div>
					<div class="tot_votes_m">based on <?php echo number_format($news['rating_click_count'], 1)?> Votes</div>
				</div> 
            </div>
            
            <span></span>
            </div>
            
            
            
            <div class="col-md-5 no_pad_lr" style="padding:0px; float:right;">
            <h3 style="padding-left:15px;">Social Connects</h3>
            <div style="float:right; width:100%;">
            <div class="fb_cnt col-md-3">
            <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=550187845025415&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
            <div class="fb-like" data-href="http://www.myinsuranceclub.com/news/" data-layout="box_count" data-action="like" data-show-faces="false" data-share="false"></div>
            </div>
            
            <div class="tw_cnt col-md-3">
                <a href="https://twitter.com/share" class="twitter-share-button" data-url="http://www.myinsuranceclub.com/news/" data-via="your_screen_name" data-lang="en" data-related="anywhereTheJavascriptAPI" data-count="vertical">Tweet</a>

    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
            </div>
            
            
            <div class="ln_cnt col-md-3">
            
           <script src="//platform.linkedin.com/in.js" type="text/javascript">
  lang: en_US
</script>
<script type="IN/Share" data-url="http://www.myinsuranceclub.com/news/" data-counter="top"></script>
            </div>
            
            
            <div class="gp_cnt col-md-3">
            <!-- Place this tag where you want the +1 button to render. -->
<div class="g-plusone" data-size="tall" data-href="http://www.myinsuranceclub.com/news/"></div>

<!-- Place this tag after the last +1 button tag. -->
<script type="text/javascript">
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/platform.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>
            </div>
            </div>
           </div>
            
            </div>
            
            
            
            
            
            
            <!-- .navigation --> 
            
          </div>
          <!-- #content -->
          
          <div class="single-bottom-sidebar"> 
            
            <!-- START RELATED THUMBS WIDGET --> 
          </div>
          <!-- .single-top-sidebar -->
    
          
          
          
			<?php 
			if (!empty($relatedPost))
			{	?>
					<div class="entry-comments clearfix" style="margin-top: 20px;">
						<nav class="navigation post-navigation" role="navigation"
							style=" border:none; padding-top:0px;">
						<div class="nav-links clearfix">
							<span class="meta-nav-prev">Related Posts </span>
						</div>
						<ul id="authorlist" class="post-list">
		<?php 			
						$i = 1;
						foreach ($relatedPost as $k1=>$v1)
						{	
							if ($i < 6)
							{	?>
							<li><a href="<?php echo base_url().'news/'.$v1['slug'];?>">- <?php echo $v1['title'];?></a></li>
<?php 						}
							$i++;
						}	?>
						</ul>
						<!-- .nav-links --> </nav>
					</div>
<?php 		}	?>





				<div class="entry-comments clearfix"
					style="margin-top: 20px;">
					<div id="" class="comments-area">
						<div id="" class="comment-respond">
							<div class="col-md-12">
							<?php
							$arrParams['disqus_identifier'] = $disqusUrl;
							$arrParams['disqus_url'] = $disqusUrl;
							$arrParams['disqus_title'] = $news['title'];
							//		$arrParams['disqus_category_id'] = '3125046';
							echo Disquslib::displayDisqus($arrParams);
?>
							</div>
						</div>
						<!-- #respond -->

					</div>
					<!-- #comments -->
				</div>







			</article>
        <!-- article --> 
      </div>
      <!-- .col-md-12 -->
<?php 
}	?>
			<div id="secondary" class="col-md-4  home-sidebar widget-area">

			<?php 
				//	most read news post
				echo widget::run('mostReadPost', array('top'=>$top, 'type'=>'news'));
			?>

			<?php 
				//	START CATEGORY WIDGET
				echo widget::run('categoryDropDown', array('allTags'=>$allTags, 'type'=>'news'));
			?>

				<!-- START AUTHOR WIDGET -->


				<!-- ENDAUTHOR WIDGET -->

				<!-- START ARCHIVES WIDGET -->


				<!-- END ARCHIVES WIDGET -->


				<!-- START AD WIDGET -->
				<aside class="widget widget_ad" id="" style="">
				<div id="over">
					<span class="Centerer"></span> <img class="Centered"
						src="assets/images/ad/banner-large.png" />
				</div>
				</aside>
				<!-- END AD WIDGET -->


				<!-- START POLL WIDGET -->
				<!--  <aside id="" class="widget widget_ad">
                <h1 class="widget-title" style="color:#FFFFFF;">MyinsuranceClub Poll</h1>

          <div class="tagcloud">
        <link type="text/css" rel="stylesheet" href="http://www.brolmo.com/index.php?controller=AppPP&action=css&qid=11934&skin=2" />
<script type="text/javascript" src="http://www.brolmo.com/index.php?controller=AppPP&action=load&hash=66789200d9c6993636bf2d15797faa40ee69ae61&aid=11331&qid=11934"></script>
<a id="BrolmoPoll_11934" href="http://www.brolmo.com/" target="_blank" title="Free poll by Brolmo.com">Free poll by Brolmo.com</a>
        </div>
        </aside>-->
				<!-- END POLL WIDGET -->


			</div>
			<!-- .col-md-12 --> 
    </div>
    <!-- .row --> 
  </div>
</div>

<script type="text/javascript" src="<?php echo base_url();?>assets/js/rating.js"></script>
<script type="text/javascript">

var record = "<?php echo $news['news_slug'];?>";
var ratingType = "news";
$(document).ready(function(){

});
</script>