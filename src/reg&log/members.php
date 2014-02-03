<?php
	require 'core/init.php';

	$members		= $users->get_users();
	$member_count	= count($members);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<title>phoenix.en -- members</title>
</head>
<body>
	<div id="container">
		<ul>
			<li><a href="index.php">Home</a></li>
			<li><a href="members.php">Members</a></li>
			<li><a href="logout.php">Logout</a></li>
		</ul>
		<h1>Our members</h1>
		<p>We have a total of <strong><?php echo $member_count; ?></strong> registered users.</p>

		<?php
		#showing the username and the date of joining, using the date() function
		foreach($members as $member) {
		echo '<p>', $member['username'], ' - joined: ', date('F j, Y', $member['time']), '</p>';
		}
		?>
	</div>
</body>
</html>