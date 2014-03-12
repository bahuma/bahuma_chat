<?php
include("database.php");
session_start();

if (!isset($_SESSION['uid'])) {
	die ("ERROR: NOT LOGGED IN");
}
?>

<!doctype html>
<html>
	<head>
		<title>Bahuma Chat</title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="libs/bootstrap/3.1.1/css/bootstrap.min.css">
		<link rel="stylesheet" href="libs/bootstrap/3.1.1/css/bootstrap-theme.min.css">
		
		<script src="libs/jquery/2.1.0/jquery-2.1.0.min.js"></script>
		<script src="libs/bootstrap/3.1.1/js/bootstrap.min.js"></script>
		<script src="js/frontpage.js"></script>
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