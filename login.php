<?php
	include ("database.php");
	include ("functions.php");
	session_start();	
	
	$errors = array();
	
	if (!isset($_POST['username']))
		$errors[] = "Sie müssen einen Usernamen eingeben!";
		
	if (!isset($_POST['password']))
		$errors[] = "Sie müssen ein Passwort eingeben!";
	
	if (count($errors) == 0) {
		$username = mysql_real_escape_string($_POST['username']);
		$password = mysql_real_escape_string($_POST['password']);
		
		$result = mysql_query ("SELECT * FROM users WHERE name = '$username'") or die(mysql_error());
		
		if (mysql_num_rows($result) == 0) {
			$errors[] = "Der angegebene Benutzer ist nicht vorhanden!";
		}
		
		if (count ($errors) == 0) {
			$row = mysql_fetch_object($result);
			
			if (md5($password) != $row->password)
				$errors[] = "Das eingegebene Passwort passt nicht zum angegebenen Benutzer!";
				
			if (count ($errors) == 0) {
				chatLogin ($row->uid);
			}			
		}
	}
?>

<!doctype html>
<html>
	<head>
		<title>Login-Status</title>
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
				<h1>Login</h1>
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
				print '<div class="alert alert-success">Sie wurden erfolgreich eingeloggt!</div><br>';
				print '<a href="chat.php"><button type="button" class="btn btn-primary btn-lg btn-block">Zum Chat</button></a>';
			}
			?>
		</div>
	</body>
</html>
