<?php 
class Tagit extends Widget{

      public function __construct() {

        parent::widget ();

    }

    function run(){	
    	//	get all the tags
    //	$allTags = $this->util->getAllTags();//isset($this->data['allTags']) ? $this->data['allTags'] : array();
    	//	get the existing tag
    	$selectedTags = isset($this->data['selectedTags']) ? $this->data['selectedTags'] : array();
        $tagLimit = isset($this->data['tagLimit']) ? $this->data['tagLimit'] : 1000;
        $tagFor = isset($this->data['tag_for']) ? $this->data['tag_for'] : 'general';
    	$tags = '';
        $tagExist = 'no';
        
        if (!empty($selectedTags))
        {
			$where = $tags = array();
			$where[0]['field'] = 'tag_id';
			$where[0]['value'] = $selectedTags;
			$where[0]['compare'] = 'findInSet';
						
			$record = $this->util->getTableData($modelName='Master_tags_model', $type="all", $where, $fields = array());
            if (!empty($record))
            {
               	foreach ($record as $k1=>$v1)
                {
                	if ($v1['status'] == 'active')
                   		$tags[] = $v1['name'];
                }
            }
            $tags = implode(', ', $tags);
        }
        if (!empty($tags))
            $tagExist = 'yes';

		$status = isset($this->data['status']) ? $this->data['status'] : '';
		if ($tagLimit == 1)
		{
			if ($tagExist == 'yes')
				$status = 'inactive';
		}
        	
?>    	
<script type="text/javascript">
$(document).ready(function(){
		
var allowedTags = [];
		<?php 
		/*
		if (!empty($allTags))
		{
			foreach ($allTags as $k1=>$v1)
			{	?>
				allowedTags[<?php echo $k1;?>] = '<?php echo $v1;?>';
<?php		}
		}
		*/
		if (empty($status) || !in_array($status, array( 'inactive', 'delete'))) 
		{	?>
			var tagExist = '<?php echo $tagExist;?>';
			var tagLimit = <?php echo $tagLimit;?>;
	
			$('#singleFieldTags2').tagit({
			    allowSpaces: true,
			    removeConfirmation: true,
			  //  availableTags: allowedTags,
			    tagLimit : tagLimit,
			    autocomplete: { source: function( request, response ) {
			    	var filter = request.term.toLowerCase();
			    	$.ajax({
				    	type: "GET",
				    	url: "<?php echo base_url().'admin/common/getTags'?>" + '/' + request.term,
				    	dataType: "json",
				    	success: function (data) {
					    	if(data != "")
					    	{ 	
				    			response($.map(data, function (item) {
					    		return {
						    		label: item.label,
						    		value: item.value	
					    			}    	
				    			}));
				    		}
				    	},
			    	});
			    }},
			    beforeTagAdded: function(event, ui) 
			    {
			        //if(jQuery.inArray( ui.tagLabel, allowedTags)== -1)
			        //{
			        //    return false;
			        //}
			    },
				onTagLimitExceeded: function(event, ui)
				{
					$('#tagInfoMsg').text('Only '+tagLimit+' tag is allowed');
					return false;
				},
				onTagExists: function(event, ui)
				{
					$('#tagInfoMsg').text('Tag already exists');
					return false;
				}
			});

			$('.ui-autocomplete-input').keypress(function(e){
				$('#tagInfoMsg').text('');
			});
<?php 	}
		else 
		{	?>
			 $('#singleFieldTags2').tagit({
	             readOnly: true
	         });
<?php 	}	?>
});
</script>   	

	<div class="form-group">
     	<label for="" class="col-sm-3">Tag</label>
        <div class="col-sm-9">
			    <span class="icon glyphicon glyphicon-star"></span>
                <input type="text" class="form-control" id="singleFieldTags2"  required placeholder="Tag"  name="tag[name]" value="<?php echo $tags;?>" >
                <span class="help-block"><p class="text-danger" id="tagInfoMsg"></p></span>
                <input type="hidden" id="tag_for" name="tag[tag_for]" value="<?php echo $tagFor;?>" >
		</div>
	</div>
<?php                 
	}
}
?>