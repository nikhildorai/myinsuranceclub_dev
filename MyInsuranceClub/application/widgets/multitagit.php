<?php 
class Tagit extends Widget{

      public function __construct() {

        parent::widget ();

    }

    function run(){	
    	$allTags = $this->util->getAllTags();//isset($this->data['allTags']) ? $this->data['allTags'] : array();
//var_dump($allTags, $this->data);    	
    	?>    	
<script type="text/javascript">
$(document).ready(function(){
		
var allowedTags = [];
		<?php 
		if (!empty($allTags))
		{
			foreach ($allTags as $k1=>$v1)
			{	?>
				allowedTags[<?php echo $k1;?>] = '<?php echo $v1;?>';
<?php		}
		}
		$status = isset($this->data['status']) ? $this->data['status'] : '';
		if (empty($status) || !in_array($status, array( 'inactive', 'delete'))) {
		?>
$('#singleFieldTags2').tagit({
    allowSpaces: true,
    removeConfirmation: true,
    availableTags: allowedTags,
    beforeTagAdded: function(event, ui) {      
        if(jQuery.inArray( ui.tagLabel, allowedTags)== -1)
        {
            return false;
        }
    }
});
<?php 	}	?>
});
</script>   	

	<div class="form-group">
     	<label for="" class="col-sm-3">Tag</label>
        <div class="col-sm-9">
           	<?php 
    			$selectedTags = isset($this->data['selectedTags']) ? $this->data['selectedTags'] : array();
                $tags = '';
                if (!empty($selectedTags))
                {
					$where = array();
					$where[0]['field'] = 'tag_id';
					$where[0]['value'] = $selectedTags;
					$where[0]['compare'] = 'findInSet';
						
					$record = $this->util->getTableData($modelName='Master_tags_model', $type="all", $where, $fields = array());
                    if (!empty($record))
                    {
                    	foreach ($record as $k1=>$v1)
                    	{
                    		$tags[] = $v1['name'];
                    	}
                    }
                    $tags = implode(', ', $tags);
                }             
                    ?>
                <input type="text" class="form-control" id="singleFieldTags2"  required placeholder="Tag"  name="tag" value="<?php echo $tags;?>" >
		</div>
	</div>
<?php                 
	}
}
?>