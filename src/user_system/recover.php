<?php
require 'core/init.php';
$general->logged_in_protect();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<title>phoenix.en -- recover password</title>
</head>
<body>
	<div id="container">
		<?php include 'includes/menu.php'; ?>
		<?php
		if(isset($_GET['success']) === true && empty($_GET['success']) === true) {
		?>
		<h3>Thank you, we've sent you a randomly generated password to your email.</h3>
		<?php
		} else if (isset($_GET['email'], $_GET['generated_string']) === true) {

			$email		= trim($_GET['email']);
			$string 	= trim($_get['generated_string']);

			if($users->email_exists($email) === false || $users->recover($email, $string) === false) {
				$errors = 'Sorry, something went wrong and we couldn\'t recover your password';
			}

			if(empty($errors) === false) {

				echo '<p>' . implode('</p><p>', $errors) . '</p>';
			} else {
				#redirect the user to recover.php?success if recover() funtion does not return false
				header('Location: recover.php?success');
				exit();
			}
		} else {
			header('Location: index.php'); //if the required parameters are not there in the url, redirect to index.php
			exit();
		}		
		?>
	</div>
</body>
</html>