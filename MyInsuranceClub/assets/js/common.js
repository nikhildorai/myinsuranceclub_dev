$(document).ready(function () {

	/*
	 * display length of charecter on keyup
	 */
	$('.charecterCount').keyup(function(e){
		$(this).parent().find('.currentLength').show().text('Current length: '+$(this).val().length +' chars');
	});
	
	$('.slug').slugify();
});

