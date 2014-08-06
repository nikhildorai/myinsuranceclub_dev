
$(document).ready(function() {
	
	$("#ratingDivParent").delegate(".ratingHover","hover", function(e){
		if (e.type == 'mouseenter') 
		{
			var id = $(this).attr('id');
			var ratingNum = $(this).data('num');
			var hoverRating = $(this).data('hover-rating');
			$(".rating-cls.user_starssel_0").addClass('user_stars2_2').removeClass('user_starssel_0');
			for ( var j = ratingNum; j < 10; j++ ) {
				$('#rating-id-'+j).addClass('level-0');
			}
			$(".rating-widget-num").show().text(hoverRating);
	    } 
		else 
	    {
			$(".rating-cls.user_stars2_2").addClass('user_starssel_0').removeClass('user_stars2_2');
			for ( var j = 1; j < 10; j++ ) {
				$('#rating-id-'+j).removeClass('level-0');
			}
			$(".rating-widget-num").hide().text('-');
	    }
	});

	$("#ratingDivParent").delegate(".ratingSystem","click", function(e){
		var id = $(this).attr('id');
		var ratingNum = $(this).data('num');
		var hoverRating = $(this).data('hover-rating');
		var url = CI_ROOT+"common/rating";
		var formData = {ratingNum:ratingNum, hoverRating:hoverRating, record:record, ratingType:ratingType };

		$(".rating-cls.user_starssel_0").addClass('user_stars2_2').removeClass('user_starssel_0');
		for ( var j = ratingNum; j < 10; j++ ) {
			$('#rating-id-'+j).addClass('level-0');
		}
		$(".rating-widget-num").show().text(hoverRating);
		$('.ratingSystem').removeClass('ratingHover').removeClass('ratingSystem');
		$.ajax({
				url:url,
				type: "post",
				data: formData,
				success:function(result)
				{
					result = $.parseJSON(result);
					$('#ratingValueId').text(result.rating_value);
					$('.tot_votes_m').html('based on '+result.rating_click_count+' votes');
		    	}
		});	
		
	});
});

