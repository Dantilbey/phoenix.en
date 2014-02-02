<?php
include('../inc/p-connect.php');

if(isset($_POST['submit'])){
	$username = $_POST['username'];
	$username_safe = $mysqli->real_escape_string($username);
	$password = $_POST['password'];
	$password_safe = $mysqli->real_escape_string($password);
	$password2 = $_POST['password2'];
	$password2_safe = $mysqli->real_escape_string($password2);
	$email = $_POST['email'];
	$email_safe = $mysqli->real_escape_string($email);

	if($password_safe == $password2_safe){
			$sql = "INSERT INTO users (username,password,email) VALUES ('$username_safe', '$password_safe', '$email_safe')";
			$mysqli->query($sql);
			echo('Your new account awaits you!');
	} else {
		die('Fatal erorr: Your password\'s don\'t match, please go back and fix this.');
	}
}
?>