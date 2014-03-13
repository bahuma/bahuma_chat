<?php
	include ("database.php");
	session_start();	
	
	$errors = array();
	
	if (!isset($_POST['username']))
		$errors[] = "Sie müssen einen Usernamen eingeben!";
		
	if (!isset($_POST['password']))
		$errors[] = "Sie müssen ein Passwort eingeben!";
	
	if (!isset($_POST['password2']))
		$errors[] = "Sie müssen das Passwort zweimal eingeben!";
	
	if (!isset($_POST['displayname']))
		$errors[] = "Sie müssen einen Anzeigenamen eingeben!";
	
	if (!isset($_POST['color']))
		$errors[] = "Sie müssen eine Farbe eingeben!";
	
	if (count($errors) == 0) {
		if ($_POST['password'] != $_POST['password2'])
			$errors[] = "Die angegebenen Passwörter stimmen nicht überein";
	}
	
	if (count($errors) == 0) {
		$username = mysql_real_escape_string($_POST['username']);
		$password = mysql_real_escape_string($_POST['password']);
		$displayname = mysql_real_escape_string($_POST['displayname']);
		$color = mysql_real_escape_string($_POST['color']);
		
		$result = mysql_query ("SELECT * FROM users WHERE name = '$username'") or die(mysql_error());
		
		if (mysql_num_rows($result) > 0) {
			$errors[] = "Der angegebene Benutzername ist bereits in Verwendung! Bitte wählen Sie einen anderen.";
		}
		
		if (count ($errors) == 0) {
			$password = md5($password);
			
			$query = "INSERT INTO users (name, password, displayname, color) VALUES ('$username', '$password', '$displayname', '$color')";
			
			$result = mysql_query($query);

			if (!$result)
				$errors[] = "Fehler beim schreiben in die Datenbank: ".mysql_error();
			
			if (count ($errors) == 0) {
				$_SESSION['user'] = mysql_insert_id();
			}			
		}
	}
?>

<!doctype html>
<html>
	<head>
		<title>Registrierungs-Status</title>
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
				<h1>Registrierung</h1>
			</header>
			<?php
			if (count($errors) > 0) {				
				foreach ($errors as $error) {
					print '<div class="alert alert-danger">'.$error.'</div>';
				}
				print '<a href="index.html"><button type="button" class="btn btn-primary btn-lg btn-block">Zurück</button></a>';
			}
			else
			{
				print '<div class="alert alert-success">Ihr Account wurde erstellt, und Sie wurden erfolgreich eingeloggt!</div><br>';
				print '<a href="chat.php"><button type="button" class="btn btn-primary btn-lg btn-block">Zum Chat</button></a>';
			}
			?>
		</div>
	</body>
</html>