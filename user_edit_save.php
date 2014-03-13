<?php
	include ("database.php");
	include ("functions.php");
	
	session_start();	
	
	$errors = array();
	
	if (!isset($_POST['password']))
		$errors[] = "Sie müssen ein Passwort eingeben!";
	
	if (!isset($_POST['password2']))
		$errors[] = "Sie müssen das Passwort zweimal eingeben!";

	if (count($errors) == 0) {
		if ($_POST['password'] != $_POST['password2'])
			$errors[] = "Die angegebenen Passwörter stimmen nicht überein";
	}
	
	if (count($errors) == 0) {
		$query = "UPDATE users Set password = '".md5($_POST['password'])."' WHERE uid = ".$_SESSION["user"]["uid"];
		$result = mysql_query($query);
		
		if (!$result)
			$errors[] = "Datenbankfehler: ".mysql_error();
		
		if (count($errors) == 0) {
			chatLogin($_SESSION['user']['uid']);
		}
	}
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
			<?php
			if (count($errors) > 0) {				
				foreach ($errors as $error) {
					print '<div class="alert alert-danger">'.$error.'</div>';
				}
				print '<a href="user_edit.php"><button type="button" class="btn btn-primary btn-lg btn-block">Zurück</button></a>';
			}
			else
			{
				print '<div class="alert alert-success">Ihr Account wurde erfolgreich geändert!</div><br>';
				print '<a href="chat.php"><button type="button" class="btn btn-primary btn-lg btn-block">Zum Chat</button></a>';
			}
			?>
		</div>
	</body>
</html>