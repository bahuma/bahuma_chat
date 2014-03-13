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
				"id" => $user['uid'],
				"name" => $user['name'],
				"displayname" => $user['displayname'],
				"color" => $user['color']
			),
			"content" => $row['content'],
			"time" => date("d.m.Y H:i", $row['time'])
		);
		
		$latest = $messages[0]['id'];
	}
	
	$json = array(
		"status" => 1,
		"latest" => $latest,
		"messages" => array_reverse($messages)
	);
	
	print json_encode($json);	
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

function notifyOnline($uid, $room){
	$query = "SELECT * FROM users_in_rooms WHERE user ='".mysql_real_escape_string($uid)."' AND room ='".mysql_real_escape_string($room)."'";
	$result = mysql_query($query);
	if (mysql_num_rows($result) == 0) {
		$query = "INSERT INTO users_in_rooms (user, room, time) VALUES ('".mysql_real_escape_string($uid)."', '".mysql_real_escape_string($room)."', '".time()."')";
		$result = mysql_query($query);
	}
	$query = "UPDATE users_in_rooms Set time = '".time()."' WHERE user ='".mysql_real_escape_string($uid)."' AND room ='".mysql_real_escape_string($room)."'";
	$result = mysql_query($query) or die(mysql_error());
}

function getOnlineUsers($room) {
	$requiredtime = time() - 20;
	
	$query = "SELECT * FROM users_in_rooms WHERE room='".mysql_real_escape_string($room)."' AND time > '".$requiredtime."'";
	$result = mysql_query($query) or die (mysql_error());
	
	$json = array();
	while ($row = mysql_fetch_array($result)) {
		$query2 = "SELECT uid, name, displayname, color FROM users WHERE uid ='".$row['user']."'";
		$result2 = mysql_query($query2) or die(mysql_error());
		$user = mysql_fetch_array($result2);
		$json[] = array (
			"id" => $user['uid'],
			"name" => $user['name'],
			"displayname" => $user['displayname'],
			"color" => $user['color']
		);
	}
	print json_encode($json);
}

function checkKick($user, $room) {
	$query = "SELECT * FROM users_kicked WHERE room='".mysql_real_escape_string($room)."' AND user = '".mysql_real_escape_string($user)."'";
	$result = mysql_query($query) or die (mysql_error());
	
	if (mysql_num_rows($result) > 0){
		print '{status: 1}';
	}
	else
	{
		print '{status: 0}';
	}
}

// Aktion festlegen
if ($_GET['action'] == "createNewEntry") { 
	createNewEntry($_GET['user'], $_GET['content'], $_GET['room']);
}
elseif ($_GET['action'] == "getLatestEntries") {
	getLatestEntries($_GET['latestID'], $_GET['room']);
}
elseif ($_GET['action'] == "notifyOnline") {
	notifyOnline($_GET['uid'], $_GET['room']);
}
elseif ($_GET['action'] == "getOnlineUsers") {
	getOnlineUsers($_GET['room']);
}
elseif ($_GET['action'] == "ckeckKick") {
	checkKick($_POST['user'], $_POST['room'])
}

mysql_close();

?>
