<?php
	include ("database.php");
	session_start();	
	
	$errors = array();
	
	if (!isset($_POST['username'])
		$errors[] = "Sie müssen einen Usernamen eingeben";
	
	if (count($errors) == 0) {
		$username = mysql_real_escape_string($_POST['username']);
		
		$result = mysql_query ("SELECT * FROM users WHERE username = '$username'");
		
		if (mysql_num_rows() == 0) {
			mysql_query("INSERT INTO users ('username') VALUES ('$username')");
		}
		else
		{
			$errors[] = "Der gewählte Username ist schon vorhanden. Bitte wähle einen anderen!";
		}
	}
?>
<html>
	<head>
		<title>Login-Status</title>
		<meta charset="utf-8">
	</head>
	<body>
		<div class="container">
			<h1>Fehler</h1>
			<?php
			foreach ($errors as $error) {
				print '<div class="message-error">'.$error.'</div>';
			}
			?>
		</div>
	</body>
</html>