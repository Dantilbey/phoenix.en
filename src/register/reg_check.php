<?php
include('../inc/p-connect.php');

if(isset($_POST['submit'])){
	//grab the users input
	$username = $_POST['username'];
	$password = $_POST['password'];
	$password2 = $_POST['password2'];
	$email = $_POST['email'];
	$email_safe = $mysqli->real_escape_string($email);

	//santatise the input
	$username_safe = $mysqli->real_escape_string($username);
	$password_safe = $mysqli->real_escape_string($password);
	$password2_safe = $mysqli->real_escape_string($password2);
	$email_safe = $mysqli->real_escape_string($email);

	if($password_safe != $password2_safe){
		die('Fatal erorr: Your password\'s don\'t match, please go back and fix this.');
	} else {
		//create an md5 hash of the password
		$password_safe = sha1($password_safe);
		//insert into db
		$sql = "INSERT INTO users (username,password,email) VALUES ('$username_safe', '$password_safe', '$email_safe')";
		$mysqli->query($sql);
		echo('Your new account awaits you!');
	}
}
?>