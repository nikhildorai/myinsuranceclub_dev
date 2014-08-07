<?php 
class MostReadPost extends Widget{

      public function __construct() {

        parent::widget ();

    }

    function run($ext = array())
    {
        $top = isset($ext['top']) ? $ext['top'] : array();
        $type = isset($ext['type']) ? $ext['type'] : 'topic';
?>    	

				<!-- START POPULAR POSTS WIDGET -->
				<aside id="ct-popularpost-widget-5" class="widget ct-popularpost-widget">
					<h1 class="widget-title" style="color: #FFFFFF;">
						<span>Most read <?php echo $type;?> posts</span>
					</h1>
					<ul class="popular-posts-widget popular-widget-102120577">
					<?php 
					if (!empty($top))
					{
						if ($type == 'news')
						{
							$folderUrl = $this->config->config['folder_path']['news']['thumbnail'];
							$fileUrl = $this->config->config['url_path']['news']['thumbnail'];
						}
						else if($type == 'articles')
						{
							$folderUrl = $this->config->config['folder_path']['articles']['thumbnail'];
							$fileUrl = $this->config->config['url_path']['articles']['thumbnail'];
						}
						else if($type == 'guides')
						{
							$folderUrl = $this->config->config['folder_path']['guides']['thumbnail'];
							$fileUrl = $this->config->config['url_path']['guides']['thumbnail'];
						}
						
						foreach ($top as $k1=>$v1)
						{								
							$imgUrl = "";
							$url = base_url().'news/'.$v1['slug'];
							if (isset($v1['thumbnail']) && !empty($v1['thumbnail']))
							{
								if (file_exists($folderUrl.$v1['thumbnail']))
								{
									$imgUrl = $fileUrl.$v1['thumbnail'];
								}
							}
					?>
							<li class="clearfix">
						<?php 	if (!empty($imgUrl)){?>		
								<div class="widget-post-small-thumb">
									<a href="<?php echo $url;?>" title=""> 
										<img width="75" height="75" src="<?php echo $imgUrl;?>" class="radius-3px ct-transition wp-post-image" alt="<?php echo $v1['title'];?>" title="<?php echo $v1['title'];?>">
									</a>
								</div> <!-- widget-post-small-thumb -->
						<?php 	}	?>
								<h2 class="entry-title">
									<a href="<?php echo $url;?>" rel="bookmark" title="<?php echo $v1['title'];?>" ><?php echo Util::getSubStringFromString($v1['title'], 55);?></a>
								</h2> 
								<span class="entry-date sm-italic-gray"> <?php echo $this->util->getDate($v1['publish_date'], 9)?> </span>
								<!-- .entry-date -->
		
								<div class="entry-content"><?php echo Util::getSubStringFromString($v1['description'], 120);?></div> <!-- .entry-content -->
							</li>
<?php 						}
						}
						?>	
					</ul>
				</aside>
				<!-- END POPULAR POSTS WIDGET -->


<?php                 
	}
}
?>