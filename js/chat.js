var latestid = 0;

function getLatestEntries() {
	$messages = jQuery.getJSON("chatcontroller.php?action=getLatestEntries&latestID="+latestid+"&room=default", function (data) {
		
		if (data.length > 0) {
			jQuery.each(data, function (i, el) {
				jQuery("#chatwindow").append('<div class="message"><span class="time">'+ el.time +'</span> <span class="author" style="color: '+el.user.color+'">'+ el.user.displayname + '</span>: <span class="content">'+ el.content +'</span></div>');
			});
			latestid = data[0].id;
		}	
	});	
}

jQuery(document).ready(function () {	
	setInterval("getLatestEntries()", 1000);
});
