jQuery(document).ready(function ($) {

	var  i = 1;
	$('.slider-home-widget').each(function (index) {
		var that = $(this);

		var owlCarousel = that.find('.home-slider-text');
		var touchDrag = window.innerWidth < 992 ? true : false;

		owlCarousel.owlCarousel({
			loop:true,
		    margin:0,
		    nav:false,
		    dots:false,
		    items: 1,
		    mouseDrag: false,
		    touchDrag: touchDrag
		});

		that.find('.slider-nav .next-btn').click(function() {
		    owlCarousel.trigger('next.owl.carousel');
		})
		// Go to the previous item
		that.find('.slider-nav .prev-btn').click(function() {
		    owlCarousel.trigger('prev.owl.carousel', [300]);
		})
	});
})