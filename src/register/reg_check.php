<?php
include('../inc/p-connect.php');

if(isset($_POST['submit'])){
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

	$mysqli_date = date( 'y-m-d' );
	$salt = "";

	for($i=0; $i<$Salt_Length; $i++)
	{
    	$salt .= $Allowed_Chars[mt_rand(0,$Chars_Len)];
	}

	$bcrypt_salt = $blowfish_pre . $salt . $blowfish_end;

	if($password != $reppassword){
		die('Ooops, looks like you\'ve spilt your coffee everywhere!<br />Not to worry, just head back and <b>make sure both your passwords match - otherwise... you\'ll just end up back here!');
	} else {

	$hashed_password = crypt($password, $bcrypt_salt);

	$sql = "INSERT INTO users (email, reg_date, fname, lname, salt, password) VALUES ('$email', '$mysqli_date', '$fname', '$lname', '$salt', '$hashed_password')";
	$mysqli->query($sql);
	echo 'Thanks for registering ' . $username . '.';
	}
}
?>