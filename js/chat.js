var latestid = 0;
var onpage = true;

function htmlEncode(value){
    if (value) {
        return jQuery('<div />').text(value).html();
    } else {
        return '';
    }
}

function getLatestEntries() {
	jQuery.getJSON("chatcontroller.php?action=getLatestEntries&latestID="+latestid+"&room=default", function (data) {
		if (data.messages.length > 0) {
			jQuery.each(data.messages, function (i, el) {
				jQuery("#chatwindow").prepend('<div class="message"><span class="time">'+ el.time +'</span> <span class="author" style="color: '+el.user.color+'">'+ el.user.displayname + '</span>: <span class="content">'+ el.content +'</span></div>');
			});
			latestid = data.latest;
			
			if (!onpage) {
				document.title = "(!) Bahuma Chat";
			}
			else {
				document.title = "Bahuma Chat";
			}
		}	
	});	
}

function createNewEntry(content) {
	jQuery.getJSON("chatcontroller.php?action=createNewEntry&content=" + htmlEncode(content) + "&user="+ USER +"&room=default");
}

function notifyOnline() {
	jQuery.getJSON("chatcontroller.php?action=notifyOnline&uid="+ USER +"&room=default");
}

function getOnlineUsers() {
	jQuery.getJSON("chatcontroller.php?action=getOnlineUsers&room=default", function (data) {
		if (data.length > 0) {
			jQuery("#userlist").empty();
			jQuery.each(data, function (i, el) {
				jQuery("#userlist").append('<li style="color: '+el.color+'">'+ el.displayname + '</li>');
			});
		}
	});
}

function checkKick() {
	jQuery.getJSON("chatcontroller.php?action=checkKick&user="+ USER +"&room=default", function (data) {
		if (data.status == 1) {
			document.location("logout.php?action=kick");
		}
	});
}

jQuery(document).ready(function ($) {
	$([window, document]).focusin(function(){
    	onpage = true;
   	}).focusout(function(){
      	onpage = false;
   	});
	
	getLatestEntries();	
	setInterval("getLatestEntries()", 1000);
	
	notifyOnline();
	setInterval("notifyOnline()", 10000);
	
	getOnlineUsers();
	setInterval("getOnlineUsers()", 10000);
	
	setInterval("ckeckKick()", 50000);
	
  	jQuery('#chatform').on('submit', function(e){
    	e.preventDefault();
    	createNewEntry(jQuery('#content').val());
    	jQuery('#content').val("");
  	});
});
