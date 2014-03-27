jQuery(document).ready(function ($) {
	// Initialize some variables
	var onpage = true;
	
	// Get the socket
	var socket = io.connect('/socket');
	
	// Login
    $('#login').on('submit', function(e){
    	e.preventDefault();
    	var username = $('#login input[name="username"]').val();
    	socket.emit('login', username, function(success){
    	    if(success){
    	        console.log('logged in');
    	        
    	        socket.emit('test', username, function(success){
    	            console.log(success);
    	        });
    	    }
    	    else
    	        console.log('not logged in');
    	});
  	});
	
	// Send messages
    $('#chatform').on('submit', function(e){
    	e.preventDefault();
    	console.log($('#chatform input[name="content"]').val());
    	socket.emit('send message', $('#chatform input[name="content"]').val());
    	jQuery('#content').val("");
  	});
  	
  	
  	
  	
  	// Handle emits
  	socket.on('message', function (data){
  	    jQuery("#chatwindow").prepend('<div class="message"><span class="user">' + data.user.nickname + '</span>: <span class="content">'+ data.message +'</span></div>');
  	});
});



/*
    $([window, document]).focusin(function(){
    	onpage = true;
   	}).focusout(function(){
      	onpage = false;
   	});
	
	
  	jQuery('#chatform').on('submit', function(e){
    	e.preventDefault();
    	jQuery('#content').val("");
  	});
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