jQuery(document).ready(function($) {
	jQuery('.modal').click(function(event) {
		if(event.target.className == "modal"){
			jQuery(this).fadeOut(500);
		}
	});

	// open login modal
	{
		jQuery('#signIn').click(function(event) {
			jQuery('.modal#login-modal').fadeIn(500).css('display','flex');
		});
	}
});