jQuery(document).ready(function() {
	// page content # header News & successForecasts elements top fixing
	{
		jQuery('#headerNews').css('top',Math.ceil(jQuery('#glMenu').height())+2+'px');
		jQuery('#successForecasts').css('top', Math.ceil(jQuery('#glMenu').height())+2+'px');

	}
	
	// headerNews & successForecasts
	{
		jQuery('#headerNews').height((jQuery(window).height()  - jQuery('#glMenu').height()) + 'px');
		jQuery('#successForecasts').height((jQuery(window).height()  - jQuery('#glMenu').height()) + 'px');
	}

	// successForecastsDescript date menu
	{
		jQuery('#successForecastsDescript .col-data li > a').click(function(event) {
			if (!jQuery(this).hasClass('active')) {
				jQuery('#successForecastsDescript .col-data li > a').not(this).removeClass('active');
				jQuery(this).addClass('active');
			}
			return false;
		});
	}

	// right and left block show or hide when decstop is small 1130px
	{
		jQuery('.mobile-hide-block').click(function(event) {
			jQuery('.mobile-hide-block').not(this).parent('section').removeClass('active');
			jQuery('.mobile-hide-block').not(this).children('.btn-open-fix').removeClass('active');
			jQuery(this).parent('section').toggleClass('active');
			jQuery(this).children('.btn-open-fix').toggleClass('active');
		});
	}
});