jQuery(document).ready(function() {
	// when resize window width // this can testing viewport desctop
	{
		jQuery(window).resize(function(event) {

			console.log(jQuery(window).height());
			// navbar - menu # show nav-body when desctop is big 1129px
			if(jQuery(window).width() > 1128){
				jQuery('#glMenu .nav-body').removeAttr('style');
				jQuery("#glMenu .menu-tree-mb > .btn").removeClass('active');
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
				if(jQuery(window).width() < 800){
					jQuery('#ligaFootball .navbar-liga li > a').not('#ligaFootball .navbar-liga li > a.active').slideUp(0);
				}else{
					jQuery('#ligaFootball .navbar-liga li > a').not('#ligaFootball .navbar-liga li > a.active').slideDown(0);
				}
			}
			// user personal nav bar
			{
				if (jQuery(window).width() < 800 ) {
					jQuery('#personalAreaBox  .mobile-persNavbar .choose-active').text(jQuery('#personalAreaBox .personalAre-navbar li > a.active').text());
					jQuery('#personalAreaBox .personalAre-navbar-body').slideUp(0);
				}else{
					jQuery('#personalAreaBox .personalAre-navbar-body').slideDown(0);
				}
			}

			// news slider width
			{
				jQuery('.recommendBlockSlide').width(jQuery('#recommendedReadingBox').width());
    			jQuery('.recommendBlockSlide').height(jQuery('#recommend-slider').height() + 40);
    			if(jQuery(window).width() > 1405 && jQuery(window).width() < 1700){
			        jQuery('.recommendBlockSlide').width(jQuery('#recommendedReadingBox').width() - 150);
			    }
    		}
    		// modal
    		{
    			if(jQuery(window).height() < 650){
    				jQuery('.modal-body').css('marginTop', '80px');
    			}
    			if(jQuery(window).height() < 530){
    				jQuery('.modal-body').css('marginTop', '120px');
    			}
    		}
		});
	}
});