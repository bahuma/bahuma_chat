var latestid = 0;

function getLatestEntries() {
	$messages = jQuery.getJSON("../chatcontroller.php?action=getLatestEntries&latestID="+latestid+"&room=default", function (data) {
		data.each(function () {
			jQuery("#chatwindow").append('<div class="message"><div class="author">'+ jQuery(this).user + '</div><div class="content">'+jQuery(this).content+'</div></div>');
		});
	});
}

function handleLatestEntries () {
	
}

jQuery(document).ready(function () {	
	setInterval(getLatestEntries(), 1000);
});
