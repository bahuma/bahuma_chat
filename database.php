<?php
$database['host'] = "localhost";
$database['name'] = "name";
$database['username'] = "username";
$database['password'] = "password";

mysql_connect($database['host'], $database['username'], $database['password']) or die ("ERROR: DATABASE CONNECTION FAILED");
mysql_select_db($database['name']);

?>