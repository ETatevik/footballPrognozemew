jQuery(document).ready(function() {
	// navbar - menu
	{
		jQuery("#glMenu .menu-tree-mb > .btn").click(function(event) {
			jQuery(this).toggleClass('active');
			jQuery('#glMenu .nav-body').slideToggle(400).css('display', 'flex');
		});
	}//go to update

});