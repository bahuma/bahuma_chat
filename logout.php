<?php
	session_start();
	unset ($_SESSION['uid']);
	session_destroy();
?>

<!doctype html>
<html>
	<head>
		<title>Logout</title>
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
				<h1>Logout</h1>
			</header>
			<?php
			if (isset($_GET['action'])) {
				if ($_GET['action'] == "kick"){
					print '<div class="alert alert-danger">Du wurdest gekickt!</div>';
				}
			}
			?>
			<div class="alert alert-success">Du wurdest erfolgreich ausgeloggt</div>
			<a href="index.html"><button type="button" class="btn btn-primary btn-lg btn-block">Zur Startseite</button></a>
		</div>
	</body>
</html>
