jQuery(document).ready(function() {
	// when resize window width // this can testing viewport desctop
	{
		jQuery(window).resize(function(event) {
			console.log(jQuery(window).width());
			// navbar - menu # show nav-body when desctop is big 1129px
			if(jQuery(window).width() > 1129){
				jQuery('#glMenu .nav-body').removeAttr('style');
			}

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

			// pagecontent football liga menu navbar
			{
				if(jQuery(window).width() < 799){
					jQuery('#ligaFootball .navbar-liga li > a').not('#ligaFootball .navbar-liga li > a.active').slideUp(0);
				}else{
					jQuery('#ligaFootball .navbar-liga li > a').not('#ligaFootball .navbar-liga li > a.active').slideDown(0);
				}
			}
		});
	}
});