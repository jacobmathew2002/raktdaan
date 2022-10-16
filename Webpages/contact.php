<?php
session_start();

/*Drop down options */
$connx=mysqli_connect("localhost:3307","root","","blood");
@$User_id=$_SESSION['User_id'];
	if(!$connx){
		echo"<script>alert('Connection Failed!');</script>";
	}
	
	$sql="SELECT DISTINCT `Bnk_location` FROM `tb_blood_bank`;";
	$result=mysqli_query($connx,$sql);
	

?>

<html>
<head>
	<title>Contact Blood Bank</title>
	<link rel="stylesheet" type="text/css" href="home_style.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Acme">
</head>


<body>

<header style="background-image: linear-gradient(rgba(0, 0, 0, 0.35), rgba(0, 0, 0, 0.15)),url('../Images/contact.jpeg');">
	
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
		<a href="#" style="background-color:#2d0a089c;border-radius:10px;padding:15px;">Contact Blood Bank</a>
		<a href="user_profile.php" >User Profile</a>
	</div>
</nav>

<main class="contact">
<section>

<div class="container">
<form action="" method="POST">
<select name="Location"  class="gen">
		<option value="" disabled selected >-- Select blood bank location --</option>
		<div class="gen1">
		
					 <?php while($row=mysqli_fetch_array($result)){ ?>
					<option value="<?php echo $row['Bnk_location'];?>"><?php echo $row['Bnk_location']; ?></option><?php }?>
		</div>							
			</select>					
		<div class="button">
		<input type="submit" value="Search" name="search" class="button-35">
		</div>

</form>
</div>
<br><br>
<div class="tble">
<?php
if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['search'])){

	if(!empty($_POST['Location'])){
		@$Location=$_POST['Location'];	
		$sql1="SELECT * FROM `tb_blood_bank` WHERE `Bnk_location`='$Location';";
		$result1=mysqli_query($connx,$sql1);
		
	echo"<table class='contb'>";
	echo"<thead>";
	echo"<tr><th class='con'>Blood Bank Name</th><th class='con'>Email</th><th class='con'>Mobile Number</th><th class='con'>Location</th></tr>";
		echo"</thead>";
			echo"<tbody>";
	while($row1=mysqli_fetch_assoc($result1)){ ?>
	<tr><td class="contd"><?php echo $row1['Bnk_name']; ?></td><td class="contd"><?php echo $row1['Bnk_email']; ?></td><td class="contd"><?php echo $row1['Bnk_mob']; ?></td><td class="contd"><?php echo $row1['Bnk_location']; ?></td></tr>
	<?php } 
	echo"</tbody>";
	echo"</table>";
	}
	else{
	  echo"<script>alert('Please Select a Location');</script>";
	}
}

?>	
<div>

</section>
</main>
</header>
</body>
</html>