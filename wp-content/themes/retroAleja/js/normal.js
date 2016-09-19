(function($){
			var aukstis = $('img.attachment-shop_single.size-shop_single.wp-post-image').height();
			$('.summary.entry-summary').css('height',aukstis);
	        $('.slide-down').click(function(){
            $('.responsive-list').slideToggle('slow');
            $('.responsive-main-menu').find('.fa-plus-circle').toggleClass('rotate');

        });
		$('.responsive-list li').click(function(){
			var index = $(this).index();
			$('.sub-menu').eq(index).slideToggle('slow');
		});

		$('.flexslider').flexslider({
			animation: "slide",
			controlNav: false,
			animationLoop: false,
			slideshow: false,
			directionNav: true,
			itemWidth: 150,
			itemMargin: 5,
			minItems: 3,
			asNavFor: '#slider'
		});
})(jQuery);