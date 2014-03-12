var latestid = 0;

function getLatestEntries() {
	$messages = jQuery.getJSON("chatcontroller.php?action=getLatestEntries&latestID="+latestid+"&room=default", function (data) {
		jQuery.each(data, function (i, el) {
			jQuery("#chatwindow").append('<div class="message"><div class="time">'+ el.time +'</div><div class="author">'+ el.user + '</div><div class="content">'+ el.content+'</div></div>');
		});
	});
}

function handleLatestEntries () {
	
}

jQuery(document).ready(function () {	
	setInterval(getLatestEntries(), 1000);
});
