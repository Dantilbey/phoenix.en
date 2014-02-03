<?php
require 'core/init.php';
$general->logged_in_protect();

if(empty($_POST) === false) {

	$username = trim($_POST['username']);
	$password = trim($_POST['password']);

	if(empty($username) === true || empty($password) === true) {
		$errors[] = 'Sorry, but we need your username and password';
	} else if ($users->user_exists($username) === false) {
		$errors[] = 'Sorry that username doesn\'t exist';
	} else if ($users->email_confirmed($username) === false) {
		$errors[] = 'Sorry, but you need to activate your account. Please check your email';
	} else {

		$login = $users->login($username, $password);

		if($login === false) {
			$errors[] = 'Sorry, that username/password is invalid';
		} else {
			//username/password is correct and the login method of the $users object returns the user's id, which is stored in $login.
			session_regenerate_id(true); // destroying the old session id and creating a new one
			$_SESSION['id'] = $login; //the user's id is now set into the user's session in the form of $_SESSION['id'].

			#redirect the user to home.php
			header('Location: home.php');
			exit();
		}
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<title>phoenix.en -- login</title>
</head>
<body>
	<div id="container">
		<?php include 'includes/menu.php'; ?>
		<h1>Login</h1>
		<?php

			if(empty($errors) === false) {
				echo '<p>' . implode('</p><p>', $errors) . '</p>';
			}
		?>
		<form method="post" action="">
			<h4>Username:</h4>
			<input type="text" name="username" value="<?php if(isset($_POST['username'])) echo htmlentities($_POST['username']); ?>">
			<h4>Password:</h4>
			<input type="password" name="password">
			<br>
			<input type="submit" name="submit">
		</form>
		<br />
		<a href="confirm-recover.php">Forgot your username/password?</a>
	</div>
</body>
</html>
