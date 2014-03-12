<?php
session_start();
include("database.php");

if (!isset($_SESSION['user'])) {
	die ("ERROR: NOT LOGGED IN");
}
?>

<!doctype html>
<html>
	<head>
		<title>Bahuma Chat</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		
		<link rel="stylesheet" href="libs/bootstrap/3.1.1/css/bootstrap.min.css">
		<link rel="stylesheet" href="libs/bootstrap/3.1.1/css/bootstrap-theme.min.css">
		<link rel="stylesheet" href="css/style.css">
		
		<script>
			var USER = <?php print $_SESSION['user'] ?>
		</script>
		
		<script src="libs/jquery/2.1.0/jquery-2.1.0.min.js"></script>
		<script src="libs/bootstrap/3.1.1/js/bootstrap.min.js"></script>
		<script src="js/chat.js"></script>
	<head>
	<body>
		<div class="container">
			<section id="main" class="row">
				<div class="col-md-12">
					<header class="page-header">
						<h1>Chat</h1>
					</header>
				</div>
				<div class="col-md-9">
					<form>
						<div class="input">
							<div class="form-group">
								<label class="control-label" for="content"></label>
								<input type="text" class="form-control" id="content" name="content">
							</div>
							<button class="btn btn-default" id="sendenbutton">Senden</button>
						</div>
					</form>
					<div id="chatwindow"></div>
				</div>
				<div class="col-md-3">
					<aside class="users">
						<ul>
							<li></li>
						</ul>
					</aside>
				</div>
			</section>
		</div>
	</body>
</html>