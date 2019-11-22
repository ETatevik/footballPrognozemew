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

	// 
	{
		jQuery('#successForecasts').click(function(event) {
			jQuery(this).toggleClass('active');
			jQuery(this).children('.mobile-hide-block').children('.btn-open-fix').toggleClass('active');
		});
	}
});