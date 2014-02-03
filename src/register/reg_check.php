<?php
include('../inc/p-connect.php');
$error_msg = "";
//grab user input from form
$username = $_POST['username'];
$email = $_POST['email'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$password = $_POST['password'];
$reppassword = $_POST['reppassword'];

//blowfish information
$blowfish_pre = '$2a$12$';
$blowfish_end = '$';

//blowfish accepts these characters as salts
$Allowed_Chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789./';
$Chars_Len = 63;

//18 would be secure as well
$Salt_Length = 21;

//set date
$mysqli_date = date( 'y-m-d' );
$salt = "";

//create random string for salt
for($i=0; $i<$Salt_Length; $i++)
{
	$salt .= $Allowed_Chars[mt_rand(0,$Chars_Len)];
}

//join together
$bcrypt_salt = $blowfish_pre . $salt . $blowfish_end;

//lets get some checks up in here

$hashed_password = crypt($password, $bcrypt_salt);
if(isset($_POST['submit'])){
	//if there are missing $_POST values, die with an error msg
	if(empty($_POST['username']) || empty($_POST['password']) || empty($_POST['fname']) || empty($_POST['lname']) || empty($_POST['email']) || empty($_POST['reppassword'])){
		$error_msg = die('Please enter all fields required');
	}

	//if both passwords do not match, die with an error msg
	if($_POST['password'] != $_POST['reppassword']){
		$error_msg = die('Your passwords don\'t match!');
	}

	//if password is not longer than eight characters, die with an error msg
	if(strlen($_POST['password']) < 8){
		die('Please enter a password that is 8 or more characters');
	}

	//if username is already taken, die with an error msg
	$prep_stmt = "SELECT username FROM users WHERE username = ? LIMIT 1";
	$stmt = $mysqli->prepare($prep_stmt);

	if($stmt){
		$stmt->bind_param('s', $username);
		$stmt->execute();
		$stmt->store_result();

		if($stmt->num_rows == 1){
			$error_msg = die('Somebody has already registered with that username');
		}
	}

	//if email is already taken, die with an error msg
	$prep_stmt = "SELECT email FROM users WHERE email = ? LIMIT 1";
	$stmt = $mysqli->prepare($prep_stmt);

	if($stmt){
		$stmt->bind_param('s', $email);
		$stmt->execute();
		$stmt->store_result();

		if($stmt->num_rows == 1){
			$error_msg = die('Somebody has already registered with that email');
		}
	}

	//if there is an empty error msg, meaning there were no problems - insert into db with no problems
	if(empty($error_msg)){
	$sql = "INSERT INTO users (username, email, reg_date, fname, lname, salt, password) VALUES ('$username', '$email', '$mysqli_date', '$fname', '$lname', '$salt', '$hashed_password')";
	$mysqli->query($sql);
	echo 'Thanks for registering ' . $username . '.';
	}
}
?>