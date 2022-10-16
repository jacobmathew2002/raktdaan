<?php
session_start();
if(isset($_SESSION['alertMessage'])){		  //alertMessage: You are already a member
	$alertMessage=$_SESSION['alertMessage'];
	echo"<script>alert('$alertMessage');</script>";
	unset($_SESSION['alertMessage']);
}
if(isset($_SESSION['alertMessage1'])){		  //alertMessage: Donor Registration Success
	$alertMessage=$_SESSION['alertMessage1'];
	echo"<script>alert('$alertMessage');</script>";
	unset($_SESSION['alertMessage1']);
}
?>

<html>
<head>
	<title>User Profile</title>
	<link rel="stylesheet" type="text/css" href="home_style.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Acme">
</head>


<body>

<header style="background-image: linear-gradient(rgba(0, 0, 0, 0.35), rgba(0, 0, 0, 0.15)),url('../Images/userpro.jpg');">
	
<nav>
	<div class="logo" > 
	<a href="homepage.php" >
		<img src="../Images/logo.jpg" alt="Raktdaan_Logo" width="75%" height="100%" style="border-radius:10px;">
	</a>
	</div>
	<div class="menu">
		<a href="homepage.php" >Home</a>

	<div class="dropdown" align="center">
		<a href="#">Looking For Blood?</a>
		<div class="dropdown-content">
		
			<a href="#">Search By Blood Bank</a>
			<a href="#">Search By Blood Type</a>
			<a href="#">Search By Donor Name</a>
			
		</div>
    </div>
		<a href="donor_reg.php">Donor Registration</a>
		<a href="contact.php">Contact Blood Bank</a>
		<a href="#" style="background-color:#2d0a089c;border-radius:10px;padding:15px;">User Profile</a>
	</div>
</nav>

<main>
<section>
		<div class="user_container">
		<div class="user_main">
			<form action="" method="POST">

<?php
	$connx=mysqli_connect("localhost:3307","root","","blood");
		if(!$connx){
			echo"<script>alert('Connection Failed!');</script>";
		}
	@$User_id=$_SESSION['User_id'];
	$sql="SELECT * FROM `tb_login_details` WHERE `User_id`='$User_id';";
		$result = mysqli_query($connx, $sql);
		$row = mysqli_fetch_assoc($result);
		
		
		if(mysqli_Query($connx,$sql)){
			@$F_name=$row['F_name'];
			@$L_name=$row['L_name'];
			@$Email=$row['Email'];
			@$B_grp=$row['B_grp'];
			@$Mob_no=$row['Mob_no'];
			@$Gender=$row['Gender'];
		}
		else{
			echo"<script>alert('Login Failed!');</script>";
		}
	
	
echo"<table align='center'; style='padding:35px;width:70%;height:70%;' name='usertb'>";
		if("$Gender"=="Male"){
			echo"<tr><td colspan='2' align='center'><img src='../Images/male_logo.jpg' alt='User_Logo' width='85px' height='85px' style='border-radius:40px;'></td></tr>";	
		}
		if("$Gender"=="Female"){
			echo"<tr><td colspan='2' align='center'><img src='../Images/female_logo.jpg' alt='User_Logo' width='85px' height='85px' style='border-radius:40px;'></td></tr>";	
		}		
echo"<tr><th>User Id:</th><td align='right'>$User_id</td></tr>";
echo"<tr><th>Name:</th><td align='right'>$F_name $L_name</td></tr>";
echo"<tr><th>Blood Group:</th><td align='right'>$B_grp</td></tr>";
echo"<tr><th>Gender:</th><td align='right'>$Gender</td></tr>";
echo"<tr><th>Mobile No:</th><td align='right'>$Mob_no</td></tr>";
echo"<tr><th>Email:</th><td align='right'> $Email</td></tr>";

		$sql1="SELECT * FROM tb_donor_details WHERE `User_id`='$User_id';";
		$result1 = mysqli_query($connx, $sql1);
		$row1 = mysqli_fetch_assoc($result1);
		
		
		if($row1){
			echo"<tr><th>Registered Donor:</th><td align='right'> Yes</td></tr>";
		}
		else{
			echo"<tr><th>Registered Donor:</th><td align='right'> No</td></tr>";
		}

echo"<tr><td colspan='2'></td></tr>";
echo"<tr><td colspan='2'></td></tr>";
echo"<tr><td colspan='2'>
						<button type='submit' name='submit' class='signout'><div style='font-weight: bold;text-align:center; padding-right:30px;'>Sign out</div></button></td></tr>";
echo"</table>";

?>
			</form>
		</div>
		</div>

</section>
</main>



</header>
	
</body>
</html>

<?php
if($_SERVER['REQUEST_METHOD']==="POST" && ISSET($_POST["submit"])){
		session_destroy();
		header("Location:../index.php");
}

?>