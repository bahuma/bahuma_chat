jQuery(document).ready(function($) {
	jQuery("#loginbutton").bind("click", function () {
		jQuery(".intro").slideUp();
		jQuery(".login-form").slideDown();
	});
});