jQuery(document).ready(function($) {
	jQuery('#newsBigHeader .col-news-data li > a').click(function(event) {
		if (!jQuery(this).hasClass('active')) {
			jQuery('#newsBigHeader .col-news-data li > a').not(this).removeClass('active');
			jQuery(this).addClass('active');
		}
		return false;//delete this if you want using hiperlink
	});
});