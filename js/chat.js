var latestid = 0;

function htmlEncode(value){
    if (value) {
        return jQuery('<div />').text(value).html();
    } else {
        return '';
    }
}

function getLatestEntries() {
	jQuery.getJSON("chatcontroller.php?action=getLatestEntries&latestID="+latestid+"&room=default", function (data) {
		
		if (data.length > 0) {
			jQuery.each(data, function (i, el) {
				jQuery("#chatwindow").prepend('<div class="message"><span class="time">'+ el.time +'</span> <span class="author" style="color: '+el.user.color+'">'+ el.user.displayname + '</span>: <span class="content">'+ el.content +'</span></div>');
			});
			latestid = data[0].id;
		}	
	});	
}

function createNewEntry(content) {
	jQuery.getJSON("chatcontroller.php?action=createNewEntry&content=" + htmlEncode(content) + "&user="+ USER +"&room=default");
}

jQuery(document).ready(function () {
	getLatestEntries();	
	setInterval("getLatestEntries()", 1000);
	
	jQuery("#sendenbutton").bind("click", function (){
		createNewEntry(jQuery('#content').val());
	});
});
