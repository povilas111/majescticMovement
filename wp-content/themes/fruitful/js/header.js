(function($){
	$('body').on('mousemove',function(e){
        e.stopPropagation();
        var width = $(this).outerWidth();
        var height = $(this).outerHeight();
        var x = e.pageX;
        var y = e.pageY;
        var xPercent = x / width;
        var yPercent = y / height;

        var walk = 40;
        var xWalk = Math.round(xPercent * walk - (walk / 2));
        var yWalk = Math.round(yPercent * walk - (walk / 2));

        $('.moving-text').css({
            'text-shadow' : xWalk + 'px '+yWalk+'px 0px rgba(0, 0, 0, 0.2)'
        });

    });

})(jQuery)