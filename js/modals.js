jQuery(document).ready(function($) {
	// all modal window close
	{
		jQuery('.modal').click(function(event) {
			if(event.target.className == "modal"){
				jQuery(this).fadeOut(500);
				clearAllInput();
			}
		});
		jQuery('.modal .close-modal').click(function(event) {
			jQuery(this).parent('.modal-body').parent('.modal').fadeOut(500);
			clearAllInput();
		});
	}

	// open login modal
	{
		jQuery('#signIn').click(function(event) {
			jQuery('.modal#login-modal').fadeIn(500).css('display','flex');
			jQuery('body').css('overflow-y' , 'hidden');
		});
	}

	// all modal input text active style
	{
		jQuery('.form-col > label > input').on({
			click : function(event) {
				jQuery(this).removeAttr('style');
				if(!jQuery(this).hasClass('active')){
					if(jQuery('.form-col > label > input').not(this).hasClass('active') && !jQuery('.form-col > label > input').not(this).val()){
						jQuery('.form-col > label > input').not(this).removeClass('active');
						jQuery('.form-col > label > input').not(this).prev('span').removeAttr('style');
					}
					jQuery(this).addClass('active');
					jQuery(this).prev('span').css({
						top: '3px',
						fontSize: "10px",
						color: "#239800"
					});
				}
			},
			blur: function(event) {
				if(jQuery(this).hasClass('active') && !jQuery(this).val()){
					jQuery(this).removeClass('active');
					jQuery(this).prev('span').removeAttr('style');
				}

				if(jQuery(this).hasClass('active') && jQuery(this).val()){
					jQuery(this).parent('label').next('.invalid').removeClass('error');
					jQuery(this).prev('span').css({
						top: '3px',
						fontSize: "10px",
						color: "#239800"
					});
				}
			}
		});
	}

	// chack all modal forms
	{
		jQuery('.modal#login-modal  form').submit(function(event) {
			var send = true;
			jQuery('#login-modal input').each(function() {
				send  = check.call(this);
			});
			return send;
		});
		jQuery('.modal#passwordRecovery-modal  form').submit(function(event) {
			var send = true;
			jQuery('#passwordRecovery-modal input').each(function() {
				send  = check.call(this);
			});
			return send;
		});
		jQuery('.modal#newPassword-modal form').submit(function(event) {
			var send = true;
			jQuery('#newPassword-modal input').each(function() {
				send  = check.call(this);
			});
			return send;
		});
	}

	// password Recovery open
	{
		jQuery('.modal .forgotPassword').click(function(event) {
			jQuery('.modal').fadeOut(0);
			jQuery('.modal#passwordRecovery-modal').fadeIn(500).css('display','flex');
			jQuery('body').css('overflow-y' , 'hidden');
		});
	}

	// New password modal check
	{

	}

	{
		jQuery('#checkMail-modal').fadeIn(0);
	}
});

function check(){
	var send = true;
	if(!jQuery(this).val()){
		send = false;
		jQuery(this).parent('label').next('.invalid').addClass('error');
		jQuery(this).prev('span').css('color', '#F30D31');
		jQuery(this).css('borderColor', '#F30D31');
	}else{
		jQuery(this).parent('label').next('.invalid').removeClass('error');
	}
	return send;
}

function clearAllInput(){
	jQuery('body').removeAttr('style');
	jQuery('.modal input').each(function() {
		jQuery(this).parent('label').next('.invalid').removeClass('error');
		jQuery(this).prev('span').removeAttr('style');
		jQuery(this).removeAttr('style');
	});
}