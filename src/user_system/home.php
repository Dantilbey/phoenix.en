<?php
require 'core/init.php';
$general->logged_out_protect();

$username 	= $user['username']; // using the $user variable defined in init.php and getting the username.
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
		<?php include 'includes/menu.php'; ?>
		<h1>Hello <?php echo $username, '!'?></h1>
	</div>
</body>
</html>