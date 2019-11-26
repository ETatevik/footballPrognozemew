jQuery(document).ready(function() {
	
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
});