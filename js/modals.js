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
		jQuery('.modal .btn-close > .btn').click(function(event) {
			jQuery(this).parent('.btn-close').parent('.modal-container').parent('.modal-body').parent('.modal').fadeOut(500);
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


	// open Registration modal
	{
		jQuery('#signUp').click(function(event) {
			jQuery('.modal#registration-modal').fadeIn(500).css('display','flex');
			jQuery('body').css('overflow-y' , 'hidden');
		});
	}

	// all modal input text active style
	{
		jQuery('.form-col > label > input').on({
			click : function(event) {
				jQuery(this).removeAttr('style');
				if(!jQuery(this).hasClass('active')){
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

				if(jQuery(this).val()){
					jQuery(this).addClass('active');
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
			send = checkValuePasswordsConfPass(jQuery('#passNewMD'),jQuery('#confirmPassMD'))
			return send;
		});
		jQuery('.modal#registration-modal form').submit(function(event) {
			var send = true;
			jQuery('#registration-modal input').each(function() {
				send  = check.call(this);
			});
			if(jQuery('.select-body input[name="chooseTarif"]:checked').length == 0){
				jQuery('#registration-modal .select-form .show-select .choose-radio').addClass('error');
				jQuery('.select-form .invalid').addClass('error');
				send = false;
			}else{
				send = checkValuePasswordsConfPass(jQuery('#regPassMD'),jQuery('#regPassConfMD'));
				jQuery('#registration-modal .select-form .show-select .choose-radio').removeClass('error').addClass('active');
				jQuery('.select-form .invalid').removeClass('error');
			}
			return send;
		});
	}
	// checkbox
	{
		jQuery('.select-selected').click(function(event) {
			if(jQuery(this).text() != "Выбрать тариф"){
				jQuery(this).removeClass('error');
				jQuery(this).parent('.custom-select').next('.invalid').removeClass('error');
			}
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

	// open login & reg in subscription-modal
	{
		jQuery('#signUpSub').click(function(event) {
			jQuery('.modal#subscription-modal').fadeOut(0);
			jQuery('.modal#registration-modal').fadeIn(500).css('display','flex');
			jQuery('body').css('overflow-y' , 'hidden');
		});

		jQuery('#signInSub').click(function(event) {
			jQuery('.modal#subscription-modal').fadeOut(0);
			jQuery('.modal#login-modal').fadeIn(500).css('display','flex');
			jQuery('body').css('overflow-y' , 'hidden');
		});
	}

	// select in registration
	{
		var chooseTarifDefaultText = jQuery('#registration-modal .select-form .show-select .choose-radio').text();
		jQuery('#registration-modal .select-form .select-body').slideUp(0);
		jQuery('#registration-modal .select-form .show-select').click(function(event) {
			jQuery('#registration-modal .select-form .select-body').slideToggle(500);
			if(chooseTarifDefaultText == jQuery('#registration-modal .select-form .show-select .choose-radio').text())
				jQuery(this).children('.choose-radio').toggleClass('active');
			else
				jQuery(this).children('.choose-radio').addClass('active');
		});

		jQuery('#registration-modal .select-form .select-body label').click(function(event) {
			jQuery('#registration-modal .select-form .show-select .choose-radio').html(jQuery(this).children('.select-text').html());
			jQuery('#registration-modal .select-form .select-body').slideUp(500);
		});
	}

	// New password modal check
	{
		// jQuery('#newPassword-modal').fadeIn(0).css('display','flex');//if you want to open this modal 
	}
	// Check your email modal
	{
		// jQuery('#checkMail-modal').fadeIn(0).css('display','flex');//if you want to open this modal
	}
	// password Success Change modal
	{
		// jQuery('#passwordSuccessChange-modal').fadeIn(0).css('display', 'flex');//if you want to open this modal
	}

});

function check(){
	var send = true;

	if(!jQuery(this).val() && jQuery(this).attr('type') != 'checkbox'){
		send = false;
		jQuery(this).parent('label').next('.invalid').addClass('error');
		jQuery(this).prev('span').css('color', '#F30D31');
		jQuery(this).css('borderColor', '#F30D31');
	}else if(jQuery(this).attr('type') == 'checkbox' && !jQuery(this).is(":checked")){
		jQuery(this).parent('label').next('.invalid').addClass('error');
		jQuery(this).next('span.checkmark').css('borderColor', '#F30D31');
		send = false;
	}else if(jQuery(this).attr('type') == 'checkbox' && jQuery(this).is(":checked")){
		jQuery(this).parent('label').next('.invalid').removeClass('error');
		jQuery(this).next('span.checkmark').removeAttr('style');
		send = true;
	}else{
		jQuery(this).parent('label').next('.invalid').removeClass('error');
		send = true;
	}

	return send;
}

function clearAllInput(){
	jQuery('body').removeAttr('style');
	jQuery('.modal input').each(function() {
		jQuery(this).parent('label').next('.invalid').removeClass('error');
		jQuery(this).prev('span').removeAttr('style');
		jQuery(this).removeAttr('style');
		jQuery(this).removeClass('active');
		jQuery(this).val('');
	});
}

function checkValuePasswordsConfPass(pass, confPass){
	var send = true;
	if (!pass.val()) return false;
	if(pass.val() !== confPass.val()){
		send = false;
		pass.parent('label').next('.invalid').addClass('error');
		pass.prev('span').css('color', '#F30D31');
		pass.css('borderColor', '#F30D31');

		confPass.parent('label').next('.invalid').addClass('error');
		confPass.prev('span').css('color', '#F30D31');
		confPass.css('borderColor', '#F30D31');
	}else{
		pass.parent('label').next('.invalid').removeClass('error');
		confPass.parent('label').next('.invalid').removeClass('error');
	}
	return send;
}
