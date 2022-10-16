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
	$result1=mysqli_query($connx,$sql);
?>



<html>
<head>
	<title>Search Blood | Raktdaan</title>
	<link rel="stylesheet" type="text/css" href="search_style.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Acme">
	
	<script>
			document.getElementById("BB").onclick=function(){search1()};
			function search1(){
				document.getElementById("searchByBloodGroup").style.display="none";
				document.getElementById("searchByBloodBank").style.display="block";
				document.getElementById("searchByDonorName").style.display="none";
			}

		
			function search2(){
				document.getElementById("searchByBloodGroup").style.display="block";
				document.getElementById("searchByBloodBank").style.display="none";
				document.getElementById("searchByDonorName").style.display="none";
			}

			function search3(){
				document.getElementById("searchByBloodGroup").style.display="none";
				document.getElementById("searchByBloodBank").style.display="none";
				document.getElementById("searchByDonorName").style.display="block";
			}

		function place(){
			document.getElementById("selectbank").style.display="block";
		}
	</script>
	
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
		<a href="#" style="background-color:#2d0a089c;border-radius:10px;padding:15px;">Looking For Blood?</a>
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



<section id="searchByBloodGroup">  						<!-- Search by Blood Group -->
	<div class="button">
		<input type="button" value="Search By Blood Bank" name="searchByBloodBank" class="bButton" id="BB" onclick="search1()" >
		<input type="button" value="Search By Blood Group" name="searchByBloodGroup" class="bButton" id="BG" onclick="search2()" style="box-shadow: #121212bf 0 0 0 3px, transparent 0 0 0 0;transform: translate3d(0,2px,0);background-color:#ca3737;">
		<input type="button" value="Search By Donor Name" name="searchByDonorName" class="bButton" id="DN" onclick="search3()">
	</div>
	
	<div class="container">
			<form action="" method="POST">
			
				<select name="Location" class="bg">
				<option value="" disabled selected >-- Select Location --</option>									<!--Location DropDown-->
				
				<?php while($row=mysqli_fetch_array($result1)){ ?>
				<option value="<?php echo $row['Bnk_location'];?>"><?php echo $row['Bnk_location']; ?></option><?php }?>
			
				</select><br><br>
				<select name="Blood_grp" class="bg">																<!--Blood Group DropDown-->
					<option value="" disabled selected>-- Select Blood Group --</option>
						<option value="A+">A+</option>
						<option value="A-">A-</option>
						<option value="AB+">AB+</option>
						<option value="AB-">AB-</option>
						<option value="B+">B+</option>
						<option value="B-">B-</option>
						<option value="O+">O+</option>
						<option value="O-">O-</option>
				</select><br><br>
				<button type="submit" name="bgrp" title="Search Blood Availability" class="bgbtn">Search</button><br><br>
			</form>
																													<!--Fetching Details-->
		<?php
		if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['bgrp'])){
				$connx=mysqli_connect("localhost:3307","root","","blood");
					if(!$connx){
						echo"<script>alert('Connection Failed!');</script>";
					}
				if(!empty($_POST['Location']) && !empty($_POST['Blood_grp'])){
					@$Location=$_POST['Location'];
					@$Blood_grp=$_POST['Blood_grp'];
					
					$sql2="SELECT * FROM `tb_blood_bank` INNER JOIN `tb_blood_availability`
						ON tb_blood_bank.Bnk_id=tb_blood_availability.Bnk_id
						WHERE Bnk_Location='$Location' AND `$Blood_grp`>=0;";
					$result2=mysqli_query($connx,$sql2);
					while($row2=mysqli_fetch_assoc($result2)){
					
					$nam=$row2['Bnk_name'];
					$bg=$row2[$Blood_grp];
					echo"<table style='border:2px solid Black;'><tr><td>{$row2['Bnk_name']}</td><td>{$row2[$Blood_grp]}</td></tr>";
					echo"</table>";
					}
				}
				else{
					echo"<script>alert('Please Choose the Location and Blood Group');</script>";
				}
		}

		?>		
			
	</div>		
	
	</div>
</section>





<section id="searchByBloodBank" style="display:none;" >																<!-- Search by Blood Bank -->

	<div class="button">
		<input type="button" value="Search By Blood Bank" name="searchByBloodBank" class="bButton" id="BB" onclick="search1()" style="box-shadow: #121212bf 0 0 0 3px, transparent 0 0 0 0;transform: translate3d(0,2px,0);background-color:#ca3737;">
		<input type="button" value="Search By Blood Group" name="searchByBloodGroup" class="bButton" id="BG" onclick="search2()" >
		<input type="button" value="Search By Donor Name" name="searchByDonorName" class="bButton"id="DN" onclick="search3()">
	</div>
	
	<div class="container">
			<form action="" method="POST">
			
				<div class="bb">
					<select name="Location1" class="bg">
					<option value="" disabled selected >-- Select Blood Bank Location --</option>
						<?php while($row=mysqli_fetch_array($result)){ ?>
						<option value="<?php echo $row['Bnk_location'];?>"><?php echo $row['Bnk_location']; ?></option><?php }?>
					</select><br><br>
					<input type="submit" class="bButton" value="Go" onclick="place();return false;" style="width:10%;" name="findBank">
				</div><br>																					
	
			
				
				
				<div class="bb1">
				<select name="Blood_grp" class="bg" id="selectbank" style="display:none">
					<option value="" disabled selected>-- Choose Blood Bank --</option>
																											<!--Finding Blood Banks From the given Location-->
		<?php																								
				if(isset($_POST['findBank'])){
				$connx=mysqli_connect("localhost:3307","root","","blood");
					if(!$connx){
						echo"<script>alert('Connection Failed!');</script>";
					}
					if(isset($_POST['Location1'])){
						@$Location1=$_POST['Location1'];
						
						$sql3="SELECT * FROM `tb_blood_bank` WHERE `Bnk_Location`='$Location1';";
						$result3=mysqli_query($connx,$sql3);
					}
					else{
						echo"<script>alert('Please Choose a Location!');</script>";
					}
				}
						 while($row3=mysqli_fetch_assoc($result3)){ ?>
						<option value="<?php echo $row3['Bnk_name'];?>"><?php echo $row3['Bnk_name']; ?></option><?php }?>
					
				</select><br><br>
				</div>
				<button type="submit" name="bbank" title="Search Blood Availability" class="bgbtn">Search</button><br><br>
			</form>
			

			
	</div>			
	</div>
</section>





<section id="searchByDonorName" style="display:none;">								<!-- Search By Donor Name -->
	<div class="button">
		<input type="button" value="Search By Blood Bank" name="searchByBloodBank" class="bButton" id="BB" onclick="search1()" >
		<input type="button" value="Search By Blood Group" name="searchByBloodGroup" class="bButton" id="BG" onclick="search2()">
		<input type="button" value="Search By Donor Name" name="searchByDonorName" class="bButton"id="DN" onclick="search3()" style="box-shadow: #121212bf 0 0 0 3px, transparent 0 0 0 0;transform: translate3d(0,2px,0);background-color:#ca3737;">
	</div>
	
	<div class="container">
			<form action="" method="POST">
			<div class="input-box">
				<input type="text" name="donor_name" class="input-box" placeholder="Enter Donor Name">
			</div>
			<br><br>

				<button type="submit" name="bgrp" title="Search Blood Availability" class="bgbtn">Search</button><br><br>
			</form>
	</div>		
	
	</div>

</section>

</main>


</header>
</body>
</html>