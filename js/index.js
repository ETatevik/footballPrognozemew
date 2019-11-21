jQuery(document).ready(function(event) {
	// navbar - menu
	{
		jQuery("#glMenu .menu-tree-mb > .btn").click(function(event) {
			jQuery(this).toggleClass('active');
			jQuery('#glMenu .nav-body').slideToggle(400).css('display', 'flex');
		});
	}

	// page content # header News & successForecasts elements top fixing
	{
		jQuery('#headerNews').css('top',Math.ceil(jQuery('#glMenu').height())+2+'px');
		jQuery('#successForecasts').css('top', Math.ceil(jQuery('#glMenu').height())+2+'px');

	}

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
		});
	}

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

	// headerNews & successForecasts
	{
		jQuery('#headerNews').height((jQuery(window).height()  - jQuery('#glMenu').height() - 11) + 'px');
		jQuery('#successForecasts').height((jQuery(window).height()  - jQuery('#glMenu').height() - 11) + 'px');
	}
});
