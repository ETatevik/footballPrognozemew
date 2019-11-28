jQuery(document).ready(function($) {
	//#personalAreaBox .personalAre-navbar
	{
		jQuery('#personalAreaBox .personalAre-navbar li > a').click(function(event) {
			if (jQuery(window).width() > 800 ) {
				if (!jQuery(this).hasClass('active')) {
					jQuery('#personalAreaBox .personalAre-navbar  li > a').not(this).removeClass('active');
					jQuery(this).addClass('active');
				}
			}
		});

		if (jQuery(window).width() < 800 ) {
			jQuery('#personalAreaBox .mobile-persNavbar .choose-active').text(jQuery('#personalAreaBox .personalAre-navbar li > a.active').text());
			jQuery('#personalAreaBox .personalAre-navbar-body').slideUp(0);
		}else{
			jQuery('#personalAreaBox .personalAre-navbar-body').slideDown(0);
		}

		jQuery('#personalAreaBox  .mobile-persNavbar ').click(function(event) {
			if(!jQuery(this).children('.menu-tree-mb').children('.btn').hasClass('active')){
				jQuery('#personalAreaBox .personalAre-navbar-body').slideDown(500);
				jQuery(this).children('.menu-tree-mb').children('.btn').addClass('active');
			}else{
				jQuery('#personalAreaBox .personalAre-navbar-body').slideUp(500);
				jQuery(this).children('.menu-tree-mb').children('.btn').removeClass('active');
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

	// select tarif in user Settings 
	{
		var chooseTarifDefaultText = jQuery('#userDataSetting .select-form .show-select .choose-radio').text();
		jQuery('#userDataSetting .select-form .select-body').slideUp(0);
		jQuery('#userDataSetting .select-form .show-select').click(function(event) {
			jQuery('#userDataSetting .select-form .select-body').slideToggle(500);
			if(chooseTarifDefaultText == jQuery('#userDataSetting .select-form .show-select .choose-radio').text())
				jQuery(this).children('.choose-radio').toggleClass('active');
			else
				jQuery(this).children('.choose-radio').addClass('active');
		});

		jQuery('#userDataSetting .select-form .select-body label').click(function(event) {
			jQuery('#userDataSetting .select-form .show-select .choose-radio').html(jQuery(this).children('.select-text').html());
			jQuery('#userDataSetting .select-form .select-body').slideUp(500);
		});
	}
});