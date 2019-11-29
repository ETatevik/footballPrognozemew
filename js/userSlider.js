jQuery(document).ready(function($) {
	jQuery("#recommend-slider").lightSlider({
        loop:true,
        keyPress:true,
        item: 1,
        pager: false,
        controls: true,
        slideMargin: 5,
        autoWidth: true,
        slideMove: 1,
        speed: 400, //ms'
    	auto: true,
    	verticalHeight:500
    });

    jQuery('.recommendBlockSlide').width(jQuery('#recommendedReadingBox').width());
    // jQuery('.recommendBlockSlide').height(jQuery('#recommend-slider').height() + 100);

    if(jQuery(window).width() > 1405 && jQuery(window).width() < 1700){
        jQuery('.recommendBlockSlide').width(jQuery('#recommendedReadingBox').width() - 150);
    }
});