var onpage = true;

jQuery(document).ready(function ($) {
	$([window, document]).focusin(function(){
    	onpage = true;
   	}).focusout(function(){
      	onpage = false;
   	});
	
	
  	jQuery('#chatform').on('submit', function(e){
    	e.preventDefault();
    	jQuery('#content').val("");
  	});
});



/*
    ---- New Message to list ----
    jQuery("#chatwindow").prepend('<div class="message"><span class="time">'+ el.time +'</span> <span class="author" style="color: '+el.user.color+'">'+ admintext + el.user.name + '</span>: <span class="content">'+ el.content +'</span></div>');
    
    if (!onpage) {
		document.title = "(!) Bahuma Chat";
	}
	else {
		document.title = "Bahuma Chat";
	}
    
    ---- Refresh ----
    window.location.href = "chat.php";

    ---- Update User list ----
	jQuery("#userlist").empty();
	jQuery.each(data, function (i, el) {
		jQuery("#userlist").append('<li style="color: '+el.color+'">'+ el.name + '</li>');
	});
	
	----  ----
*/