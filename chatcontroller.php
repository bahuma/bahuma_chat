<?php
header( "Cache-Control: no-cache, must-revalidate" ); 
header( "Pragma: no-cache" );
header("Content-Type: text/xml");

include("database.php");

function getLatestEntries($latestID, $room) {
	
	$query = "SELECT id, user, content, time FROM chatroom_".mysql_real_escape_string($room)." WHERE id > ".mysql_real_escape_string($latestID)." ORDER BY id DESC LIMIT 20"; 
	$result = mysql_query($query); 
	echo "<?xml version=\"1.0\" encoding=\"UTF-8\" standalone=\"yes\"?>";
	echo "<messages>";
	while($row=mysql_fetch_array($result)) { 
		echo "<message><id>".$row['id'];
		echo "</id><user>".$row['user'];
		echo "</user><content>".$row['content'];
		//Formatierung des Timestamps
		echo "</content><time>".date("d.m.Y H:i",$row['time']); 
		echo "</time></message>";
	}
	echo "</messages>";
}

function createNewEntry($user, $content, $room) {

	//HTML Tags entfernen
	$name = strip_tags($name, '');
	$nachricht = strip_tags($nachricht,''); 
	
	$query = "INSERT INTO chatroom_".mysql_real_escape_string($room)." (user, content) 
	VALUES ('".mysql_real_escape_string($user)."','".mysql_real_escape_string($content)."')";
	echo "<?xml version=\"1.0\" encoding=\"UTF-8\" standalone=\"yes\"?>";
	if (!mysql_query($query)) {
		//Fehlerkontrolle
		echo "<createNewEntry>0</createNewEntry>";}
	else {
		echo "<createNewEntry>1</createNewEntry>";
	}
}

// Aktion festlegen
if ($_GET['action'] == "createNewEntry") { 
	createNewEntry($_GET['user'], $_GET['content'], $_GET['room']);
}
elseif ($_GET['action'] == "getLatestEntries") {
	getLatestEntries($_GET['latestID'], $_GET['room']);
}

mysql_close();

?>