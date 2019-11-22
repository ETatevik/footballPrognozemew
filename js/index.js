jQuery(document).ready(function() {

	// index page slide
	{
		var i = 0;
		setInterval(function(){
			if(jQuery('#indexPageSilder .slide').eq(i).hasClass('active')){
				jQuery('#indexPageSilder .slide').eq(i).removeClass('active').fadeOut('200'); 
				i++;
				if(i >= jQuery('#indexPageSilder .slide').length){
					i = 0;
				}
				jQuery('#indexPageSilder .slide').eq(i).fadeIn('200').addClass('active'); 
			}
		}, 5000 );	
	}

	// index page ligaFootball navbar
	{
		jQuery('#ligaFootball .navbar-liga li > a').click(function(event) {
			if (!jQuery(this).hasClass('active')) {
				jQuery('#ligaFootball .navbar-liga li > a').not(this).removeClass('active');
				jQuery(this).addClass('active');
			}
			return false;
		});

		jQuery('#ligaFootball .col-forecasts li').click(function(event) {
			if (!jQuery(this).hasClass('active')) {
				jQuery('#ligaFootball .col-forecasts  li').not(this).removeClass('active');
				jQuery(this).addClass('active');
			}
			return false;
		});

		jQuery('#ligaFootball .col-data li > a').click(function(event) {
			if (!jQuery(this).hasClass('active')) {
				jQuery('#ligaFootball .col-data li > a').not(this).removeClass('active');
				jQuery(this).addClass('active');
			}
			return false;
		});
	}

	// statisticsOurForecast proggresBars
	{
		// when scrolling: show proggress
		{
			jQuery(window).scroll(function() {
			    if( jQuery(window).scrollTop() > 950) {
			       	jQuery('.proggress').animate({
						width: '0px',
						width: parseInt(jQuery(this).children('span').text())+'%'},
						10, function() {
							jQuery(this).css('width',parseInt(jQuery(this).children('span').text())+'%');
							jQuery(this).children('span').css('opacity', 1);
					});
			    }
			});
		}
	}
});
