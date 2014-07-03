(function($) {
	$(function() {
		$('.block.clients .carousel').each(function() {
			var $self = $(this);
			var $carousel = $('> ul', this).eq(0);
			var $temp = $('<div/>');
			$('li',$carousel).appendTo($temp);$carousel.css('margin', 0).html('');$('li',$temp).appendTo($carousel).css('margin-bottom', 0);
			var navigation = $('<div class="navigation"/>').insertAfter($self);
			$('<a href="javascript:void(0);" class="prev">Prev</a>')
				.appendTo(navigation);
			$('<a href="javascript:void(0);" class="next ">Next</a>')
				.appendTo(navigation);
			$carousel.carouFredSel({
				width: '100%',
				circular: true,
				infinity: true,
				align: 'center',
				auto: false,
				prev: $('.prev', navigation),
				next: $('.next', navigation)
			});
		});
	});
})(jQuery);

