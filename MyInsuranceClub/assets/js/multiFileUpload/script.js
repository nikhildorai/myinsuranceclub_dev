var abc = 0; //Declaring and defining global increement variable

$(document).ready(function() {

//To add new input file field dynamically, on click of "Add More Files" button below function will be executed
    $('.add_more').click(function() {
    	var modelNameClassInput = $(this).parent().find('.modelNameClassInput').val();
    	var fieldNameClassInput = $(this).parent().find('.fieldNameClassInput').val();
    	var multiUploadClassInput = $(this).parent().find('.multiUploadClassInput').val();
    	if(multiUploadClassInput == "true")
    	{
	    	var addBtn = 	'<a class="file-input-wrapper btn btn-default btn-info">\
	    						<span>Choose File</span>\
	    						<input class="btn-info fileUploadAjax" type="file" value="" data-ui-file-upload="" title="Choose File" name="'+modelNameClassInput+'['+fieldNameClassInput+']'+'[]">\
	    					</a>';
    	}
    	else
    	{
	    	var addBtn = 	'<a class="file-input-wrapper btn btn-default btn-info">\
				<span>Choose File</span>\
				<input class="btn-info fileUploadAjax" type="file" value="" data-ui-file-upload="" title="Choose File" name="'+modelNameClassInput+'['+fieldNameClassInput+']'+'[]">\
			</a>';
    	}	
    		
        $(this).before($("<div/>", {class: 'filediv'}).fadeIn('slow').append(
        		addBtn,
                $("<br/><br/>")
                ));
    });

//following function will executes on change event of file input to select different file	
$('body').on('change', '.fileUploadAjax', function(){
	//console.log(this.files, this.files.length);
		var uploadLength = this.files.length;
		for ( var j = 0; j < uploadLength; j++ ) {
            if (this.files && this.files[j]) {
                 abc += 1; //increementing global variable by 1
				var z = abc - 1;
                var x = $(this).parent().parent().find('#previewimg' + z).remove();
                var prevDiv = $(this).parent().parent().parent().before("<div id='abcd"+ abc +"' class='abcd'><img id='previewimg" + abc + "' src=''  width='133' height='146'/></div>");
                //$(this).parent().parent().find('.previewImage').html("<div id='abcd"+ abc +"' class='abcd'><img id='previewimg" + abc + "' src=''/></div>");
               
			    var reader = new FileReader();
                reader.onload = imageIsLoaded;
                reader.readAsDataURL(this.files[j]);
//console.log(this.files[j]);               
			    $(this).parent().parent().hide();
               // $("#abcd"+ abc).append($("<img/>", {id: 'img', src: CI_ROOT+'assets/js/multiFileUpload/x.png', alt: 'delete'}).click(function() {
               // $(this).parent().remove();
               // }));
            }
            //$('#add_more').trigger('click');
		}
        });

//To preview image     
    function imageIsLoaded(e) {
        $('#previewimg' + abc).attr('src', e.target.result);
    };

    $('#upload').click(function(e) {
        var name = $(":file").val();
        if (!name)
        {
            alert("First Image Must Be Selected");
            e.preventDefault();
        }
    });
});