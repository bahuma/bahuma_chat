var latestid = 0;

function getLatestEntries() {
	$messages = jQuery.getJSON("../chatcontroller?action=getLatestEntries&latestID="+latestid, function (data) {
		data.each(function () {
			jQuery("#chatwindow").append('<div class="message"><div class="author">'+ jQuery(this).user + '</div><div class="content">'+jQuery(this).content+'</div></div>');
		});
	});
}

function handleLatestEntries () {
	
}

jQuery($document).ready(function () {	
});
