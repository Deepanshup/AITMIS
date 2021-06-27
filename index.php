<?php
session_start();
if(isset($_SESSION['login_user'])){
header("location: dashboard.php");
}
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "aitmis";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if(isset($_POST['register'])){
	$email=$_POST['email'];
	$pass=$_POST['pass'];
	if($email==''){
		echo '<script>alert("Enter email address!)</script>'; 
	}
	if($pass==''){
		echo '<script>alert("Enter your Password!)</script>'; 
	}
	if($email!='' && $pass!=''){
		$checksql="select * from register where email='$email' and password='$pass'";
		$result = $conn->query($checksql);
		if ($result->num_rows > 0) {
			$_SESSION['login_user']=$email;
			//echo '<script>alert("LoggedIn Successfully!!")</script>';
			header('Location: dashboard.php');
		}
		else
		{
		     echo '<script>alert("Wrong Email or Password!")</script>'; 
		}
	}
}
$conn->close();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>AITMIS | Login</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="fonts/linearicons/style.css">
		<link rel="stylesheet" href="css/style.css">
		<style type="text/css">
			form{
				height:400px;
			}
			@media (max-width: 767px) {
			.image-1 {
			    bottom: 122px;
			    left: 121px;
			    height: 200px;
			    top:-100px;
			}
			.image-1, .image-2 {
				display: block;
			}
			}
		</style>
	</head>

	<body>

		<div class="wrapper">
			<div class="inner">
				<img src="images/image-1.png" alt="" class="image-1">
				<form method="post">
					<h5 >Login</h5><br>
					<div class="form-holder">
						<span class="lnr lnr-envelope"></span>
						<input type="text" class="form-control" name="email" placeholder="EMail">
					</div>
					<div class="form-holder">
						<span class="lnr lnr-lock"></span>
						<input type="password" class="form-control" name="pass" placeholder="Password">
					</div>
					<button id="register" name="register">
						Log In
					</button><br><br>
				    <p style="text-align:right;"><a href="register.php">Not a member ?&nbsp;&nbsp;Register here</a></p>
				</form>
				<img src="images/image-2.png" alt="" class="image-2">
			</div>
		</div>
		
		<script src="js/jquery-3.3.1.min.js"></script>
		<script src="js/main.js"></script>
	</body>
</html>