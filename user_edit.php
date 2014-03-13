<?php
session_start();
include ("functions.php");
include ("database.php");

$userid = $_SESSION['user']['id'];
$query = "SELECT * FROM users WHERE uid = '$userid'";
$result = mysql_query($query);
$row = mysql_fetch_object($result);
?>

<!doctype html>
<html>
	<head>
		<title>Einstellungen</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		
		<link rel="stylesheet" href="libs/bootstrap/3.1.1/css/bootstrap.min.css">
		<link rel="stylesheet" href="libs/bootstrap/3.1.1/css/bootstrap-theme.min.css">
		
		<script src="libs/jquery/2.1.0/jquery-2.1.0.min.js"></script>
		<script src="libs/bootstrap/3.1.1/js/bootstrap.min.js"></script>
	</head>
	<body>
		<div class="container">
			<header class="page-header">
				<h1>Einstellungen</h1>
			</header>
			<form class="form-horizontal" action="user_edit_save.php" method="post">
				<div class="form-group">
					<label for="password" class="col-sm-2 control-label">Passwort:</label>
					<div class="col-sm-10">
						<input type="password" name="password" class="form-control">
					</div>
				</div>
				<div class="form-group">
					<label for="password2" class="col-sm-2 control-label">Passwort wiederholen:</label>
					<div class="col-sm-10">
						<input type="password" name="password2" class="form-control">
					</div>
				</div>
				<input type="submit" class="btn btn-default btn-primary btn-sm pull-right" value="Speichern">
			</form>
		</div>
	</body>
</html>