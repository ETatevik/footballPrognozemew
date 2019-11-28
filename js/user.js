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
		            if(document.querySelector('#userDataSetting .custom-select > select > option[value="0"]').innerHTML != this.innerHTML) this.parentNode.previousSibling.classList.add('active');
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
});