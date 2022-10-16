<?php
session_start();
?>

<html>
<head>
	<title>Homepage | Raktdaan</title>
	<link rel="stylesheet" type="text/css" href="home_style.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Acme">
</head>
<body>

<header  style="background-image: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.15)),url('../Images/home1.jpg');">
	
<nav style="position: fixed;">
	<div class="logo"> 
	<a href="#">
		<img src="../Images/logo.jpg" alt="Raktdaan_Logo" width="75%" height="100%" style="border-radius:10px;">
	</a>
	</div>
	<div class="menu">
		<a href="#" style="background-color:#2d0a089c;border-radius:10px;padding:15px;">Home</a>

	<div class="dropdown" align="center">
		<a href="search_blood.php">Looking For Blood?</a>
		<div class="dropdown-content">
		
			<a href="#">Search By Blood Bank</a>
			<a href="#">Search By Blood Type</a>
			<a href="#">Search By Donor Name</a>
		</div>
    </div>
		<a href="donor_reg.php">Donor Registration</a>
		<a href="contact.php">Contact Blood Bank</a>
		<a href="user_profile.php">User Profile</a>
	</div>
</nav>

	<main>
	<!-- Main Section  -->
		<section>
			<?php
				$connx=mysqli_connect("localhost:3307","root","","blood");
				if(!$connx){
				echo"<script>alert('Connection Failed!');</script>";
				}
				@$Em=$_SESSION['Email'];
				$sql1="SELECT `F_name`,`User_id`,`Place` FROM `tb_login_details` WHERE `Email`='$Em';";
				
				$result = mysqli_query($connx,$sql1);
				$row = mysqli_fetch_assoc($result);
		
		
			
					@$Nm=$row['F_name'];
					$_SESSION['User_id']=$row['User_id'];
					@$Place=$row['Place'];
				
			echo"<h3 style='font-family:Acme;font-size:50px'>Welcome $Nm ! </h3>";
			?>
			<h1><span class="change_content"> </span> <span style="margin-top: -10px;">  </span> </h1>
			<p>"Give and Let Live"</p><br><br>
			<a href="search_blood.php" class="btnone">Looking for Blood?</a>
			<a href="donor_reg.php" class="btnone">Donate Blood</a>
			<a href="contact.php" class="btnone">Contact Blood Bank</a>
		</section>
	</main>
	<!-- Timeline Section  -->
	<section id="tmline">
		<div class="tm_left"> 																				<!-- Marquee Timeline  -->
		
<?php

				$connx=mysqli_connect("localhost:3307","root","","blood");
				if(!$connx){
				echo"<script>alert('Connection Failed!');</script>";
				}
				$sql2="SELECT * FROM `tb_timeline` WHERE `Tm_status`='VIEW';";
				$result2=mysqli_query($connx,$sql2);
				
		
		
?>		
		<marquee direction="up" height="70%" width="70%" scrollamount="3" onmouseover="this.stop();" onmouseout="this.start();">
		<ul class="marquee-up">
<?php while($row2=mysqli_fetch_assoc($result2)){?>
<li>&#128073 <?php echo $row2['Tm_msg'] ; } ?> </li>

		</ul>
		
		</marquee>
		
		</div>
		<div class="tm_right">
			
			  <button onclick="document.getElementById('id01').style.display='block'" class="modalButton">Find Blood Banks Near You</button>
			
			
			  <div id="id01" class="modal">
				<div class="modal-content animate-zoom">
					<header class="modal_head"> 
						<span onclick="document.getElementById('id01').style.display='none'" class="close display-topright">&times;</span>
						<h2>Find Blood Banks Near You</h2>
					</header>
					<div class="modal_cont">
						
								<div class="tble" id="div">
							<table>
								<thead>
								<tr><th class="con">Blood Bank Name</th><th class="con">Email</th><th class="con">Mobile Number</th><th class="con">Location</th></tr>
								</thead>
<?php

	
		$sql2="SELECT * FROM `tb_blood_bank` WHERE `Bnk_location`='$Place';";
		$result1=mysqli_query($connx,$sql2);
		

			echo"<tbody>";
	while($row1=mysqli_fetch_assoc($result1)){ ?>
	<tr><td class="contd"><?php echo $row1['Bnk_name']; ?></td><td class="contd"><?php echo $row1['Bnk_email']; ?></td><td class="contd"><?php echo $row1['Bnk_mob']; ?></td><td class="contd"><?php echo $row1['Bnk_location']; ?></td></tr>
	<?php } 
	echo"</tbody>";
	echo"</table>";
?>	
<div>
						
						
						
					</div>
				</div>
			  </div>
			
			
		</div>
	</section>
	<!-- About Section  -->
		<section id="abt">
			<div class="abt_left">
				<img src="../Images/abt.jpg" alt="Donate Blood" width="100%" height="100%" style="border-radius:10px;">
			</div>
			
			<div class="abt_center">
				<a onclick="document.getElementById('div').style.display='block'" class="dntbtn">Donate Blood Now</a>
			</div>

			<div class="abt_right">
				<img src="../Images/abt_right.jpg" alt="Donate Blood" width="75%" height="100%" style="border:2px solid black;border-radius:10px">
			</div>
		</section>

</header>
	
</body>
</html>

