$(document).ready(function () {

	/*
	 * display length of charecter on keyup
	 */
	$('.charecterCount').keyup(function(e){
		$(this).parent().find('.currentLength').show().text('Current length: '+$(this).val().length +' chars');
	});
	
	$('.slug').slugify();
	
	//	only number allowed in text element
	$(".numberValidation").keydown(function(e) 
	{
		if (e.shiftKey || e.ctrlKey || e.altKey) {
			e.preventDefault();
		} 
		else 
		{
			var key = e.keyCode;
			if (!((key == 8) || (key == 46) || (key >= 35 && key <= 40) || (key >= 48 && key <= 57) || (key >= 96 && key <= 105))) {
				e.preventDefault();
			}
		}
	});
	
	      
});


