<?php
require 'core/init.php';

# If form is submitted
if(isset($_POST['submit'])){

	if(empty($_POST['username']) || empty($_POST['username']) || empty($_POST['email'])){

		$errors[] = 'All fields are required';

	} else {

		#validating user's input with functions
		if($users->user_exists($_POST['username']) === true) {
			$errors[] = 'That username already exists';
		}
		if(!ctype_alnum($_POST['username'])) {
			$errors[] = 'Please enter a username with only alphabets and numbers.';
		}
		if(strlen($_POST['password']) < 6) {
			$errors[] = 'Your password must be at least 6 characters';
		} else if (strlen($_POST['password']) > 18) {
			$errors[] = 'Your password cannot be more than 18 characters long';
		}
		if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
			$errors[] = 'Please enter a valid email address';
		} else if ($users->email_exists($_POST['email']) === true) {
			$errors[] = 'That email already exists';
		}
	}

	if(empty($errors) === true) {

		$username 	= htmlentities($_POST['username']);
		$password 	= $_POST['password'];
		$email 		= htmlentities($_POST['email']);

		$users->register($username, $password, $email); //calling the register function
		header('Location: register.php?success');
		exit();
	}
}

if(isset($_GET['success']) && empty($_POST['success'])) {
	echo 'Thank you for registering. Please check your email';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<title>phoenix.en -- register</title>
</head>
<body>
	<div id="container">
	<?php include 'includes/menu.php'; ?>
	<h1>Register</h1>

	<form method="post" action="">
		<h4>Username:</h4>
		<input type="text" name="username" value="<?php if(isset($_POST['username'])) echo htmlentities($_POST['username']); ?>"/>
		<h4>Password:</h4>
		<input type="password" name="password" />
		<h4>Email:</h4>
		<input type="text" name="email" value="<?php if(isset($_POST['email'])) echo htmlentities($_POST['email']); ?>"/>
		<br />
		<input type="submit" name="submit" />
	</form>

	<?php
	#if there are errros, they would be displayed here
	if(empty($errors) === false) {
		echo '<p>' . implode('</p><p>', $errors) . '</p>';
	}
	?>
	</div>
</body>
</html>