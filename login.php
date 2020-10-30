<?php
	include 'conn.php';

	if(isset($_POST['login'])){
		$email = $_POST['email'];
		$password = $_POST['password'];
		$login_q = mysqli_query($conn, "select * from users where email='$email' and password='$password'");

		if(mysqli_num_rows($login_q) > 0){
			if($login_q){
				session_start();
				$user = mysqli_fetch_assoc($login_q);
				$_SESSION['userid'] = $user['id'];
				header('Location: index.php');
			}else{
				header("location: login.php?error=0");
			}
		}else{
			header("location: login.php?error=1");
		}
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="styles/styles.css?cache=1" />
		<title>Login</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script type="text/javascript" src="js/cbt-main.js"></script>
	</head>
	<body>
		<!--ERRORS-->
		<?php if(isset($_GET['error'])){ 
			$error = $_GET['error'];
			switch ($error) {
				case 0:
                    $error_message = "Something went wrong.";
                    break;
				case 1:
					$error_message = "No such user found.";
					break;
				default:
					$error_message = "No errors.";
					break;
			}
		?>
			<div class="err_message">
				<span class="err_message_text"><?php echo $error_message; ?></span>
				<button class="dismiss_message">Dismiss</button>
			</div>
		<?php }else{ ?>
			<div class="err_message" style="display: none;">
				<span class="err_message_text">Error message here!</span>
				<button class="dismiss_message">Dismiss</button>
			</div>
		<?php } ?>

		<!--MAIN-->
		<div class="vertical_centered_box" align="center">
			<h2 class="title">Convenient Business Tools</h2>
			<br/>
				<div class="form_container" align="center">
					<form method="post" id="login">
						<h1 style="margin:0;">LOGIN</h1>
						<p><input type="text" placeholder="Email" name="email" /></p>
						<p><input type="password" placeholder="Password" name="password" /></p>
						<!--<p align="right" style="width: 90%;"><a href="forgot.php" id="forgot">Forgot Password?</a></p>-->
						<input type="submit" class="submit" name="login" value="Login" />
					</form>
					<br/>
				</div>
			<br/><br/>
			<div id="two">
				Haven't registered yet? <a href="register.php">Register.</a>
			</div>
		</div>
	</body>
</html>