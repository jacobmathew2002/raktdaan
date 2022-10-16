<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Raktdaan | Blood Banks in Kottayam</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	
	<script>
			function view() {
			  var x = document.getElementById("pass");
			  if (x.type === "password") {
				x.type = "text";
			  } else {
				x.type = "password";
			  }
			}
	</script>
	
</head>
<body>
	<div class="container" style="margin-top:120px;">
			<div class="logo"> 
			<a href="#">
				<img src="Images/logo.jpg" alt="Raktdaan_Logo" width="75%" height="100%" style="border-radius:10px;">
			</a>
			</div><br><br>

		<div class="main">
			<form method="POST" action="">
				<span>
					<input type="email" placeholder="Email address" name="Email" title="Enter your registered email address">
				</span>
				<span>
				
					<input type="password" placeholder="Password" name="Password" id="pass" title="Enter your password"><i class="view" onclick="view()" title="Click to view your password">&#128065;</i>
					
				</span>
				<button type="submit" name="submit" title="Click to Login">Login</button><br>
				Not a Member?<a href="Webpages/signup.php"> Sign up</a><br>
				<br>

</body>
</html>



<?php
if($_SERVER['REQUEST_METHOD']=="POST" && ISSET($_POST['submit'])){
	$connx=mysqli_connect("localhost:3307","root","","blood");
	if(!$connx){
		echo"<script>alert('Connection Failed!');</script>";
	}
	
	if($_POST['Email']=="Admin@login.com" && $_POST['Password']=="Admin@Password"){
		$_SESSION['Admin']=$_POST['Email'];
		header("Location:Webpages/AdminHome.php");
	}
	
	elseif(!empty($_POST['Email']) && !empty($_POST['Password'])){														//User Login
		@$Email=$_POST['Email'];
		@$Password=$_POST['Password'];
		
		$sql="SELECT `Email`,`Password` FROM tb_login_details WHERE `Email`='$Email';";
		$result = mysqli_query($connx, $sql);
		$row = mysqli_fetch_assoc($result);
		
		
		if($row){
			if($row['Password']==$Password){
					$_SESSION['Email']=$_POST['Email'];
					header("Location:Webpages/homepage.php");
			}
			else{
					echo"<script>alert('Incorrect Password!');</script>";
			}
		}
		else{
			echo"<script>alert('User not Found!');</script>";
		}
		
	}
	
	}


?>