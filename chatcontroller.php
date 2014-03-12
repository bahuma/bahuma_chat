<?php
header( "Cache-Control: no-cache, must-revalidate" ); 
header( "Pragma: no-cache" );
header("Content-Type: text/json");

include("database.php");

function getLatestEntries($latestID, $room) {
	
	$query = "SELECT id, user, content, time FROM chatroom_".mysql_real_escape_string($room)." WHERE id > ".mysql_real_escape_string($latestID)." ORDER BY id DESC LIMIT 20"; 
	$result = mysql_query($query);
	
	$messages = array();
	
	while($row=mysql_fetch_array($result)) {
		$messages[] = array (
			"id" => $row['id'],
			"user" => $row['user'],
			"content" => $row['content'],
			"time" => date("d.m.Y H:i",$row['time'])
		);
	}
	
	print json_decode($messages);	
}

function createNewEntry($user, $content, $room) {

	//HTML Tags entfernen
	$name = strip_tags($name, '');
	$nachricht = strip_tags($nachricht,''); 
	
	$query = "INSERT INTO chatroom_".mysql_real_escape_string($room)." (user, content) 
	VALUES ('".mysql_real_escape_string($user)."','".mysql_real_escape_string($content)."')";
	
	if (!mysql_query($query)) {
		//Fehlerkontrolle
		print('{status: 0, message: "'.mysql_error().'"}');
	}
	else {
		print('{status: 1}');
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