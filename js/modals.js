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
				console.log(send)

			});
			if(jQuery('.modal#registration-modal form .select-selected').text() == "Выбрать тариф"){
				jQuery('.modal#registration-modal form .select-selected').addClass('error');
				jQuery('.modal#registration-modal form .select-selected').parent('.custom-select').next('.invalid').addClass('error');
				send = false;
			}else{
				send = true;
			}
			send = checkValuePasswordsConfPass(jQuery('#regPassMD'),jQuery('#regPassConfMD'));

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

// select tarif 
{
	var x, i, j, selElmnt, a, b, c;
	/*look for any elements with the class "custom-select":*/
	x = document.querySelectorAll(".custom-select");
	for (i = 0; i < x.length; i++) {
	  selElmnt = x[i].getElementsByTagName("select")[0];
	  /*for each element, create a new DIV that will act as the selected item:*/
	  a = document.createElement("DIV");
	  a.setAttribute("class", "select-selected");
	  a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
	  x[i].appendChild(a);
	  /*for each element, create a new DIV that will contain the option list:*/
	  b = document.createElement("DIV");
	  b.setAttribute("class", "select-items select-hide");
	  for (j = 1; j < selElmnt.length; j++) {
	    /*for each option in the original select element,
	    create a new DIV that will act as an option item:*/
	    c = document.createElement("DIV");
	    c.innerHTML = makeHtmlText(selElmnt.options[j]);
	    
	    c.addEventListener("click", function(e) {
	        /*when an item is clicked, update the original select box,
	        and the selected item:*/
	        var y, i, k, s, h;
	        s = this.parentNode.parentNode.getElementsByTagName("select")[0];
	        h = this.parentNode.previousSibling;
	        for (i = 0; i < s.length; i++) {
	          if (makeHtmlText(s.options[i]) == this.innerHTML) {
	            s.selectedIndex = i;
	            h.innerHTML = this.innerHTML;
	            y = this.parentNode.getElementsByClassName("same-as-selected");
	            for (k = 0; k < y.length; k++) {
	              y[k].removeAttribute("class");
	            }
	            this.setAttribute("class", "same-as-selected");
	            if("Выбрать тариф" != this.innerHTML) this.parentNode.previousSibling.classList.add('active');
	            break;
	          }
	        }
	        h.click();
	    });
	    b.appendChild(c);
	  }
	  x[i].appendChild(b);
	  a.addEventListener("click", function(e) {
	      /*when the select box is clicked, close any other select boxes,
	      and open/close the current select box:*/
	      e.stopPropagation();
	      closeAllSelect(this);
	      this.nextSibling.classList.toggle("select-hide");
	      this.classList.toggle("select-arrow-active");
	    });
	}
	function closeAllSelect(elmnt) {
	  /*a function that will close all select boxes in the document,
	  except the current select box:*/
	  var x, y, i, arrNo = [];
	  x = document.getElementsByClassName("select-items");
	  y = document.getElementsByClassName("select-selected");
	  for (i = 0; i < y.length; i++) {
	    if (elmnt == y[i]) {
	      arrNo.push(i)
	    } else {
	      y[i].classList.remove("select-arrow-active");
	    }
	  }
	  for (i = 0; i < x.length; i++) {
	    if (arrNo.indexOf(i)) {
	      x[i].classList.add("select-hide");
	    }
	  }
	}

	function makeHtmlText(elem){
	  var text = elem.innerHTML.split('w');
	  return text[0] + '<strong>' + text[1] + '</strong>'+"<span>" + text[2] + "</span>";
	}
}