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
				jQuery("#chatwindow").prepend('<div class="message"><span class="time">'+ el.time +'</span> <span class="author" style="color: '+el.user.color+'">'+ el.user.name + '</span>: <span class="content">'+ el.content +'</span></div>');
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
	if (content != "")
		jQuery.getJSON("chatcontroller.php?action=createNewEntry&content=" + htmlEncode(content) +"&room=default");
}

function notifyOnline() {
	jQuery.getJSON("chatcontroller.php?action=notifyOnline&room=default");
}

function getOnlineUsers() {
	jQuery.getJSON("chatcontroller.php?action=getOnlineUsers&room=default", function (data) {
		if (data.length > 0) {
			jQuery("#userlist").empty();
			jQuery.each(data, function (i, el) {
				if (user.admin) {
					jQuery("#userlist").append('<li style="color: '+el.color+'"><a onclick="kickUser(\''+el.id+'\')" class="glyphicon glyphicon-minus" style="color: '+el.color+'"></a> '+ el.name + '</li>');
				}
				else
				{
					jQuery("#userlist").append('<li style="color: '+el.color+'">'+ el.name + '</li>');
				}
			});
		}
	});
}

function checkKick() {
	jQuery.getJSON("chatcontroller.php?action=checkKick&room=default", function (data) {
		if (data.status == 1) {
			console.log("kick");
			window.location.href = "logout.php?action=kick";
		}
	});
}

function kickUser(uid) {
	jQuery.getJSON("chatcontroller.php?action=kick&room=default&user=" + uid);
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
	
	setInterval("checkKick()", 5000);
	
  	jQuery('#chatform').on('submit', function(e){
    	e.preventDefault();
    	createNewEntry(jQuery('#content').val());
    	jQuery('#content').val("");
  	});
});
