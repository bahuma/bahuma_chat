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
		
		<script src="libs/jquery/2.1.0/jquery-2.1.0.min.js"></script>
		<script src="libs/bootstrap/3.1.1/js/bootstrap.min.js"></script>
		<script src="js/chat.js"></script>
		
		<script>
			var user = {
				uid: <?php print $_SESSION['user']['uid'] ?>,
				name: "<?php print $_SESSION['user']['name'] ?>",
				color: "<?php print $_SESSION['user']['color'] ?>",
				admin: <?php if ($_SESSION['user']['admin']) {print "true";} else {print "false";} ?>
			}
		</script>
	<head>
	<body>
		<div class="container">
			<section id="main" class="row">
				<div class="col-md-12">
					<header class="page-header">
						<ul class="nav nav-pills pull-right">
							<li><a href="user_edit.php">Settings</a></li>
						</ul>
						<h1>Chat</h1>
					</header>
				</div>
				<div class="col-md-9">
					<div class="input">
						<form class="form-inline" id="chatform">
							<div class="form-group">
								<label class="control-label" for="content"></label>
								<input type="text" class="form-control" id="content" name="content" autocomplete="off" autofocus required>
							</div>
							<input type="submit" class="btn btn-default" id="sendenbutton" value="Senden">
						</form>
					</div>
					<div id="chatwindow"></div>
				</div>
				<div class="col-md-3">
					<aside class="users">
						<h4>User im Chat</h4>
						<ul id="userlist">
						</ul>
					</aside>
				</div>
			</section>
		</div>
	</body>
</html>
