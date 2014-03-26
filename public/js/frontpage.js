jQuery(document).ready(function($) {
	jQuery(".loginbutton").bind("click", function () {
		$("#intro").slideUp();
		$("#page").slideDown();
		$('.nav a:first').tab('show');
		$("#page h1").html("Login");
	});
	
	jQuery(".registerbutton").bind("click", function () {
		$("#intro").slideUp();
		$("#page").slideDown();
		$('.nav a:last').tab('show');
		$("#page h1").html("Registrieren");
	});
	
	jQuery(".nav a:first").bind("click", function () {
		$("#page h1").html("Login");
	});
	
	jQuery(".nav a:last").bind("click", function () {
    	$("#page h1").html("Registrieren");
  	});
});