<?php
#include our init.php
require 'core/init.php';
$general->logged_in_protect();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<title>phoenix.en -- home</title>
</head>
<body>
	<div id="container">
		<ul>
			<li><a href="index.php">Home</a></li>
			<li><a href="register.php">Register</a></li>
			<li><a href="login.php">Login</a></li>
		</ul>
		<h1>Welcome to the phoenix.en test</h1>
	</div>
</body>
</html>