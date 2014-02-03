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
		<?php include 'includes/menu.php'; ?>
		<h1>Welcome to phoenix.en</h1>
	</div>
</body>
</html>