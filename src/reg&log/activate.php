<?php
require 'core/init.php';
$general->logged_in_protect();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta type="utf-8">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<title>phoenix.en -- activate account</title>
</head>
<body>
	<div id="container">
		<ul>
			<li><a href="index.php">Home</a></li>
			<li><a href="register.php">Register</a></li>
			<li><a href="login.php">Login</a></li>
		</ul>
		<h1>Activate your account</h1>

		<?php

		if(isset($_GET['success']) === true && empty($_GET['success']) === true) {
		?>

		<h3>Thank you, we've activated your account. Feel free to log in</h3>

		<?php
		} else if (isset($_GET['email'], $_GET['email_code'] === true) {
			$email 			= trim($_GET['email']);
			$email_code 	= trim($_GET['email_code']);
			
			if($users->email_exists($email) === false) {
				$errors[] = 'Sorry, we couldn\'t find that email address';
			} else if ($users->activate($emial, $email_code) === false) {
				$errors[] = 'Sorry, we couldn\'t activate your account';
			}

			if(empty($errors) === false)) {
				echo '<p>' . implode('</p><p>', $errors . '</p>';
			} else {
				header('Location: activatep.php?success');
				exit();
			}
		} else {
			header('Location: index.php');
			exit();
		}
		?>
	</div>
</body>
</html>