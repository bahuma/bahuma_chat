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
		$query2 = "SELECT uid, name, displayname, color FROM users WHERE uid ='".$row['user']."'";
		$result2 = mysql_query($query2) or die(mysql_error());
		$user = mysql_fetch_array($result2);
		
		$messages[] = array (
			"id" => $row['id'],
			"user" => array(
				"id" => $user['id'],
				"name" => $user['name'],
				"displayname" => $user['displayname'],
				"color" => $user['color']
			),
			"content" => $row['content'],
			"time" => date("d.m.Y H:i",$row['time'])
		);
	}
	
	print json_encode($messages);	
}

function createNewEntry($user, $content, $room) {

	//HTML Tags entfernen
	$name = strip_tags($name, '');
	$nachricht = strip_tags($nachricht,''); 
	
	$query = "INSERT INTO chatroom_".mysql_real_escape_string($room)." (user, content, time) 
	VALUES ('".mysql_real_escape_string($user)."','".mysql_real_escape_string($content)."','".time()."')";
	
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