<?php
function chatLogin($uid) {
	$result = mysql_query ("SELECT * FROM users WHERE uid = '$uid'") or die(mysql_error());
	
	$row = mysql_fetch_object($result);
	
	$_SESSION['user'] = array(
		"uid" => $row->uid,
		"name" => $row->name,
		"displayname" => $row->displayname,
		"color" => $row->color,
		"admin" => $row->admin
	);
};
?>
