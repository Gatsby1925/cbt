<?php
	include 'conn.php';
	session_start();

	if(!isset($_SESSION['userid'])){
		header("Location: login.php");
	}else{
		$userid = $_SESSION['userid'];
		$user_q = mysqli_query($conn, "select * from users where id='$userid'");
		$user = mysqli_fetch_assoc($user_q);
		$name = $user['firstname']." ".$user['lastname'];
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="styles/styles.css?cache=1" />
		<title>Welcome <?php echo $name; ?>!</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script type="text/javascript" src="js/cbt-main.js"></script>
	</head>
	<body>
		<h1 align="center">Welcome!</h1>
		<p align="center"><?php echo $name; ?> (<a href="logout.php">Logout</a>)</p>
		<hr color="black" />
		<p align="center">Convenient Business Tools will help you with your business!</p>
	</body>
</html>