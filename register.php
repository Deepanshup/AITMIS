<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "aitmis";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if(isset($_POST['register'])){
	$name=$_POST['name'];
	$number=$_POST['number'];
	$email=$_POST['email'];
	$pass=$_POST['pass'];
	$address=$_POST['address'];
	$college=$_POST['college'];
	$course=$_POST['course'];
	$cpass=$_POST['cpass'];
	if($name=='' || $number=='' || $email=='' || $pass=='' || $address=='' || $college=='' || $course=='' || $cpass==''){
		echo '<script>alert("Fill the whole from")</script>'; 
	}
	if($pass!=$cpass){
		echo '<script>alert("Passwords doesn\'t match")</script>';
	}
	if($name!='' && $number!='' && $email!='' && $pass!='' && $address!='' && $college!='' && $course!='' && $cpass!='' && $pass==$cpass){
		$checksql="select * from register where email='$email'";
		$result = $conn->query($checksql);
		if ($result->num_rows > 0) {
			echo '<script>alert("Email already exist!!")</script>';
		}
		else
		{
			$sql = "insert into register(`name`, `c_no`, `email`, `password`, `address`, `college/institute`) values('$name','$number','$email','$pass','$address','$college')";
		    if ($conn->query($sql)) {
		        $coursesql="select U_ID from register where email='$email'";
		        $courseresult = $conn->query($coursesql);
		        if ($courseresult->num_rows > 0) {
			        while($row = $courseresult->fetch_assoc()) { 
                     $user_id= $row['U_ID']; 
                    }
		        }
		        $coursesqll="select C_ID from course where c_name ='$course'";
		        $courseresultt = $conn->query($coursesqll);
		        if ($courseresultt->num_rows > 0) {
			        while($row = $courseresultt->fetch_assoc()) { 
                     $course_id= $row['C_ID'];
                    }
		        }
		        $csql="insert into user_course(U_ID,C_ID) values('$user_id','$course_id')";
		        if ($conn->query($csql)) {
		           header("location: http://jobmafiaa.com/products/aitmis/AITMISNEW/");
		        }
		} 
	    	 else {
		        echo '<script>alert("Error occured !Please try again later!")</script>'; 
			}
		}
	}
}
$conn->close();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>AITMIS | Regsiter</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="fonts/linearicons/style.css">
		<link rel="stylesheet" href="css/style.css">
		<style type="text/css">
			form{
				height:600px;
			}
		</style>
	</head>

	<body>

		<div class="wrapper">
			<div class="inner">
				<img src="images/image-1.png" alt="" class="image-1">
				<form method="post">
					<!-- <div style="margin-top: -70px;">
						<h5 >New Account?</h5>
					</div> -->
					<div class="form-holder" style="margin-top: -50px;">
						<span class="lnr lnr-user"></span>
						<input type="text" class="form-control" name="name" placeholder="Username">
					</div>
					<div class="form-holder">
						<span class="lnr lnr-phone-handset"></span>
						<input type="text" class="form-control" name="number" placeholder="Phone Number">
					</div>
					<div class="form-holder">
						<span class="lnr lnr-envelope"></span>
						<input type="text" class="form-control" name="email" placeholder="Mail">
					</div>
					<div class="form-holder">
						<span class="lnr lnr-envelope"></span>
						<input type="text" class="form-control" name="address" placeholder="Address">
					</div>
					<div class="form-holder">
						<span class="lnr lnr-envelope"></span>
						<select name="course" class="form-control">
							<?php
							$servername = "localhost";
                            $username = "root";
                            $password = "";
                            $dbname = "aitmis";
							$conn = new mysqli($servername, $username, $password, $dbname);
							if ($conn->connect_error) {
							    die("Connection failed: " . $conn->connect_error);
							}
							$sql = "select c_name from course";
							$result = $conn->query($sql);

							if ($result->num_rows > 0) {
							while($row = $result->fetch_assoc()) { 
							     echo "<option value='".$row['c_name']."'>";
							     echo $row['c_name'];
							     echo "</option>";
							    }
							}
							$conn->close();
							?>
						</select>
					</div>
					<div class="form-holder">
						<span class="lnr lnr-envelope"></span>
						<input type="text" class="form-control" name="college" placeholder="College">
					</div>
					<div class="form-holder">
						<span class="lnr lnr-lock"></span>
						<input type="password" class="form-control" name="pass" placeholder="Password">
					</div>
					<div class="form-holder">
						<span class="lnr lnr-lock"></span>
						<input type="password" class="form-control" name="cpass" placeholder="Confirm Password">
					</div>
					<button id="register" name="register" style="margin-top:-5px;">
						Register
					</button><br><br>
					<p style="text-align:right;"><a href="index.php">Already a member ?&nbsp;&nbsp;Login here</a></p>
				</form>
				<img src="images/image-2.png" alt="" class="image-2">
			</div>
			
		</div>
		
		<script src="js/jquery-3.3.1.min.js"></script>
		<script src="js/main.js"></script>
	</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>