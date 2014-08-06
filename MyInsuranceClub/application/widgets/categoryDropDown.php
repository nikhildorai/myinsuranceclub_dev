<?php 
class CategoryDropDown extends Widget{

      public function __construct() {

        parent::widget ();

    }

    function run($ext = array())
    {
        $allTags = isset($ext['allTags']) ? $ext['allTags'] : array();
        $type = isset($ext['type']) ? $ext['type'] : 'topic';
        
?>    	

				

				<?php 
				if (!empty($allTags))
				{	?>
				<!-- START CATEGORY WIDGET -->
				<aside id="tag_cloud-3" class="widget widget_tag_cloud">
					<h1 class="widget-title">
						<span>Explore <?php echo $type;?> by Category</span>
					</h1>
					<div class="tagcloud">
						<select class="input-block form-control" id="goto_page_dd_cat_dd" style="margin-bottom: 0px;">
							<option selected="" value="">Select a Category</option>
	<?php 				foreach ($allTags as $k1=>$v1)
						{	?>
							<option value="<?php echo $v1['tag_slug'];?>" data-href="<?php echo base_url().$type.'/category/'.$v1['tag_slug'];?>"><?php echo ucwords($v1['name']).' ('.$v1['count'].')';?></option>
	<?php 				}	?>
						</select>
					</div>
				</aside>
<?php 			}				?>
				<!-- END CATEGORY WIDGET -->
<script type="text/javascript">
$(document).ready(function(){
	$('#goto_page_dd_cat_dd').change(function(){
		window.location.href = $(this).find(':selected').data('href');
	});
	
});
</script>

<?php                 
	}
}
?>