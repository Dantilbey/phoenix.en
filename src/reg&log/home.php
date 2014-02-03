<?php
require 'core/init.php';
$general->logged_out_protect();

$user 		= $users->userdata($_SESSION['id']);
$username	= $user['username'];

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
			<li><a href="members.php">Members</a></li>
			<li><a href="logout.php">Logout</a></li>
		</ul>
		<h1>Hello <?php echo $username, '!'?></h1>
	</div>
</body>
</html>