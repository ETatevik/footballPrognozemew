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
		if(jQuery(window).width() < 799){
			jQuery('#ligaFootball .navbar-liga li > a').not('#ligaFootball .navbar-liga li > a.active').slideUp(0);
		}//go to update
		jQuery('#ligaFootball .navbar-liga li > a').click(function(event) {
			if(jQuery(window).width() > 799){
				if (!jQuery(this).hasClass('active')) {
					jQuery('#ligaFootball .navbar-liga li > a').not(this).removeClass('active');
					jQuery(this).addClass('active');
				}
			}else{
				if (jQuery(this).hasClass('active')) {
					jQuery(this).children('.aw-bt').attr('style') ?  jQuery(this).children('.aw-bt').removeAttr('style'):jQuery(this).children('.aw-bt').css('transform','rotate(180deg)');
					jQuery('#ligaFootball .navbar-liga li > a').not(this).slideToggle(500);
				}else{
					jQuery('#ligaFootball .navbar-liga li > a').not(this).slideToggle(500);
					jQuery('#ligaFootball .navbar-liga li > a > .aw-bt').removeAttr('style')
					jQuery('#ligaFootball .navbar-liga li > a').not(this).removeClass('active');
					jQuery(this).addClass('active');
				}
			}
			
			return false;//delete this if you want using hiperlink
		});

		jQuery('#ligaFootball .col-forecasts li').click(function(event) {
			if (!jQuery(this).hasClass('active')) {

				if(jQuery(this).hasClass('pay-forecast')){
					jQuery('.modal#subscription-modal').fadeIn(500).css('display','flex');
					return false;
				}
				jQuery('#ligaFootball .col-forecasts  li').not(this).removeClass('active');
				jQuery(this).addClass('active');
			}
			return false;//delete this if you want using hiperlink
		});

		jQuery('#ligaFootball .col-data li > a').click(function(event) {
			if (!jQuery(this).hasClass('active')) {
				jQuery('#ligaFootball .col-data li > a').not(this).removeClass('active');
				jQuery(this).addClass('active');
			}
			return false;//delete this if you want using hiperlink
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
