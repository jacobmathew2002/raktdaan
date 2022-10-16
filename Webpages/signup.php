<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Sign Up | Raktdaan</title>
	<link rel="stylesheet" type="text/css" href="signup_style.css">
	
	<!-- Validation -->
		<script type="text/javascript">  
			function matchpass(){  
			var firstpassword=document.getElementById("psw1").value;  
			var secondpassword=document.getElementById("psw2").value;  
			  
			if(firstpassword==secondpassword){  
			return true;  
			}  
			else{  
			alert("password must be same!");  
			return false;  
			}  
			}  
		</script>
</head>
<body style="background-image:url('../Images/signup1.jpg');background-repeat: no repeat;background-size: cover;">
	<div class="container">
				<div class="logo"> 
					<a href="#">
						<img src="../Images/logo.jpg" alt="Raktdaan_Logo" width="75%" height="100%" style="border-radius:10px;">
					</a>
				</div><br>
	
	<!--	<div class="header">
			<h1 style="color:DarkRed;">Sign Up</h1>
		</div>  -->
		<div class="main">
			<form action="" method="POST" onsubmit="return matchpass()">
				<span>
					
					<input type="text" placeholder="First Name" name="F_name"  Title="Invalid First Name" pattern="[A-Za-z]{0,25}">
				</span><br>
								<span>
					
					<input type="text" placeholder="Last Name" name="L_name" Title="Invalid Last Name" pattern="[A-Za-z]{0,25}">
				</span><br>
								<span>
					
					<input type="email" placeholder="Email" name="Email" class="fnm">
				</span><br>
								<span>
					
					<input type="tel" placeholder="Mobile Number" name="Mob_no" pattern="[6-9]{1}[0-9]{9}" title="Invalid Mobile Number" class="fnm">
				</span><br>
					
					<span>								
								<select name="B_grp" placeholder="-- Select Blood Group--" class="pla">
									<option disabled selected style="font-size:15px;color:grey;">-- Select Blood Group --</option>
									<option value="A+">A+</option>
									<option value="A-">A-</option>
									<option value="AB+">AB+</option>
									<option value="AB-">AB-</option>
									<option value="B+">B+</option>
									<option value="B-">B-</option>
									<option value="O+">O+</option>
									<option value="O-">O-</option>
								</select>
				</span>
								<span>
					
					<input type="text" placeholder="Date of Birth" onfocus="(this.type='date')" name="Dob">
				</span><br>
								<span>
								
								<span>
								<select name="Gender" placeholder="-- Select Gender --" class="gen">
									<option disabled selected>-- Select Gender --</option>
									<option value="Male">Male</option>
									<option value="Female">Female</option>
									<option value="Others">Others</option>
								</select>
								</span><br>
								<span>								
								<select name="Place" placeholder="Place" class="pla">
									<option disabled selected>-- Select Place --</option>
									<option value="Kottayam">Kottayam</option>
									<option value="Changanacherry">Changanacherry</option>
									<option value="Pala">Pala</option>
									<option value="Kanjirappally">Kanjirappally</option>
									<option value="Vaikom">Vaikom</option>
									<option value="Ponkunnam">Ponkunnam</option>
									<option value="Erattupetta">Erattupetta</option>
									<option value="Ettumanur">Ettumanur</option>
									<option value="Poonjar">Poonjar</option>
									<option value="Thalayolaparambu">Thalayolaparambu</option>
								</select>					

								<span>
					<input type="password" placeholder="Password" name="Password" id="psw1">
				</span><br>
				<span>
					<input type="password" placeholder="Confirm Password" id="psw2">
				</span><br>	
				<button type="submit" name="submit">Sign up</button><br>
                Already a member?<a href="../index.php" style="font-weight:bold;"> Login Here</a><br>
</body>
	

</html>





<?php

if($_SERVER['REQUEST_METHOD']==="POST" && ISSET($_POST["submit"])){
	$connx=mysqli_connect("localhost:3307","root","","blood");
	if(!$connx){
		echo"<script>alert('Connection Failed!');</script>";
	}
		
	
	if(!empty($_POST['F_name']) && !empty($_POST['L_name']) && !empty($_POST['Email']) && !empty($_POST['Mob_no']) && !empty($_POST['B_grp']) &&
	!empty($_POST['Dob']) && !empty($_POST['Place']) && !empty($_POST['Password']) && !empty($_POST['Gender'])){
		@$F_name=$_POST['F_name'];
		@$L_name=$_POST['L_name'];
		@$Email=$_POST['Email'];
		@$Mob_no=$_POST['Mob_no'];
		@$B_grp=$_POST['B_grp'];
		@$Dob=$_POST['Dob'];
		@$Gender=$_POST['Gender'];
		@$Place=$_POST['Place'];
		@$Password=$_POST['Password'];
		
		
		$sql1="SELECT * FROM `tb_login_details` WHERE `Email`='$Email';";		//Checking if email address already used
		$result1=mysqli_query($connx,$sql1);
		$row1=mysqli_fetch_assoc($result1);
	
		$sql2="SELECT * FROM `tb_login_details` WHERE `Mob_no`='$Mob_no';";		//Checking if Mobile No already used
		$result2=mysqli_query($connx,$sql2);
		$row2=mysqli_fetch_assoc($result2);			
		
		
		if(!$row1){    				//Email Checking
			
			if(!$row2){				//Mobile Number Checking
			
				$sql="INSERT INTO tb_login_details(`F_name`,`L_name`,`Email`,`Mob_no`,`B_grp`,`Dob`,`Gender`,`Place`,`Password`) VALUES ('$F_name','$L_name','$Email','$Mob_no','$B_grp','$Dob','$Gender','$Place','$Password');";
				if(mysqli_query($connx,$sql)){
					$_SESSION['Email']=$_POST['Email'];
					header("Location:homepage.php");
				}
				else{
					echo"<script>alert('Signup Failed!');</script>";
				}
			}
			else{
				echo"<script>alert('Mobile Number already in use, Try with a different Mobile Number!');</script>";
			}
		}
		else{
			echo"<script>alert('You are already a member, Try with a different Email Address!');</script>";
		}
		
	}
	else{		//If all the fields are not filled
		echo"<script>alert('All fields are mandatory!');</script>";
	}
}

?>