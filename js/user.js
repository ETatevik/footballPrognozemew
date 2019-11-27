jQuery(document).ready(function($) {
	//#personalAreaBox .personalAre-navbar
	{
		jQuery('#personalAreaBox .personalAre-navbar li > a').click(function(event) {
			if (!jQuery(this).hasClass('active')) {
				jQuery('#personalAreaBox .personalAre-navbar  li > a').not(this).removeClass('active');
				jQuery(this).addClass('active');
			}
		});
	}

	// all alert show
	{
		jQuery('.alert.show').slideDown(600);
	}

	// all alert close
	{
		jQuery('.alert-close').click(function(event) {
			jQuery(this).parent('.col-alert').parent('.row').parent('.alert').slideUp(500);
		});
	}

	// show danger & blur in liga Box
	{
		if(jQuery('.alert-danger').hasClass('show')){
			jQuery('#ligaFootball .modal-danger-close').addClass('show');
			jQuery('#ligaFootball .navbar-liga, #ligaFootball .tabelForecastsLiga').addClass('blur');
		}
	}

	// subscript-notactive active
	{
		if(jQuery('#userSubscript .subscript-notactive').hasClass('show')){
			jQuery('#userSubscript .btn-continue-sub').addClass('active');
		}
	}
});