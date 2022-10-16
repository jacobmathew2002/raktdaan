<?php
session_start();
	$connx=mysqli_connect("localhost:3307","root","","blood");
		if(!$connx){
			echo"<script>alert('Connection Failed!');</script>";
		}
	@$User_id=$_SESSION['User_id'];
	$sql="SELECT * FROM `tb_login_details` WHERE `User_id`='$User_id';";
		$result = mysqli_query($connx, $sql);
		$row = mysqli_fetch_assoc($result);
		
	$sql1="SELECT * FROM tb_donor_details WHERE `User_id`='$User_id';";
	$result1 = mysqli_query($connx, $sql1);
	$row1 = mysqli_fetch_assoc($result1);
		
		if(mysqli_Query($connx,$sql)){
			@$F_name=$row['F_name'];
			@$L_name=$row['L_name'];
			@$Email=$row['Email'];
			@$B_grp=$row['B_grp'];
			@$Mob_no=$row['Mob_no'];
			$dob=$row['Dob'];
			$today= date("Y-m-d");
			$diff=date_diff(date_create($dob),date_create($today));
			$Dob=$diff->format('%y');
		}
		else{
			echo"<script>alert('Login Failed!');</script>";
		}

 if($_SERVER['REQUEST_METHOD']=="POST" && ISSET($_POST['Register'])){
	 
	if($row1){ 
		
		$_SESSION['alertMessage']="You are already a donor!";
		Header("Location:user_profile.php");	
	}
	else{
	 
	if(isset($_POST['none']) && isset($_POST['none1'])){ 
	 
		$connx=mysqli_connect("localhost:3307","root","","blood");
		if(!$connx){
			echo"<script>alert('Connection Failed!');</script>";
		}
		
		if(!empty($_POST['Weight'])){
			@$Weight=$_POST['Weight'];
			$sql="INSERT INTO tb_donor_details(`User_id`,`Weight`) VALUES ('$User_id','$Weight');";
			
			if(mysqli_query($connx,$sql)){
				$_SESSION['alertMessage1']="Donor Registration Success";
				Header("Location:user_profile.php");
			}
			else{
				echo"<script>alert('Donor Registration Failed!');</script>";
			}
		
		}
	}
	else{
		echo"<script>alert('Sorry, You are not Eligible to donate blood!');</script>";
	}
   }
   
 }
 ?>

<html>
<head>
	<title>Donor Registration | Raktdaan</title>
	<link rel="stylesheet" type="text/css" href="donor_style.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Acme">
</head>
<body >
<header  style="background-image: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.15)),url('../Images/home1.jpg');">
	<nav>
	<div class="logo1"> 
	<a href="homepage.php">
		<img src="../Images/logo.jpg" alt="Raktdaan_Logo" width="75%" height="100%" style="border-radius:10px;">
	</a>
	</div>
	<div class="menu">
		<a href="homepage.php">Home</a>

	<div class="dropdown" align="center">
		<a href="search_blood.php">Looking For Blood?</a>
		<div class="dropdown-content">
		
			<a href="#">Search By Blood Bank</a>
			<a href="#">Search By Blood Type</a>
			<a href="#">Search By Donor Name</a>
		</div>
    </div>
		<a href="donor_reg.php"  style="background-color:#2d0a089c;border-radius:10px;padding:15px;">Donor Registration</a>
		<a href="contact.php">Contact Blood Bank</a>
		<a href="user_profile.php">User Profile</a>
	</div>
</nav>





	<main>	
	<center>
	<div class="container">
    <div class="title"> Donor Registration</div>
    <div class="content">
      <form action="#" method="POST">
        <div class="user-details">
          <div class="input-box">
            <span class="details">Full Name</span>
            <?php echo"<input type='text' name='fullname' value='$F_name $L_name' readonly>"; ?>
          </div>
		  


          <div class="input-box">
            <span class="details">Blood Group</span>
            <?php echo"<input type='text' name='fname' value='$B_grp' readonly>"; ?>
          </div>		 
		
          <div class="input-box">
            <span class="details">Email</span>
            <?php echo"<input type='text' name='fname' value='$Email' readonly>"; ?>
          </div>
          <div class="input-box">
            <span class="details">Phone Number</span>
            <?php echo"<input type='text' name='fname' value='$Mob_no' readonly>"; ?>
          </div>
        
		  
		  <div class="input-box">
            <span class="details">Weight <span style="color:red"> *</span></span>
            <input type="number"  name="Weight" placeholder="Enter your Weight" min="50" style="color:black" required>
          </div>
		  
		  <div class="input-box">
            <span class="details">Age</span>
            <?php echo"<input type='text' name='fname' value='$Dob' readonly>"; ?>
          </div>
		  <div class="gender-details">
          <input type="radio" name="blood-prev" id="dot-1">
          <input type="radio" name="blood-prev" id="dot-2">
          <span class="gender-title">
Have you donated blood previously?</span>
          <div class="category">
            <label for="dot-1">
            <span class="dot one"></span>
            <span class="gender">YES</span>
          </label>
          <label for="dot-2">
            <span class="dot two"></span>
            <span class="gender">NO</span>
          </label>
          </div>
        </div>

		<br><br>	
		<label class="lc">
		
In the last six months have you had any of the following?<span style="color:red"> *</span></label><br><br>
<div class="cbox2"> 
<label class="cbox">Tattoing
  <input type="checkbox" value="Tattoing" name="tattoing">
  <span class="mark"></span>
</label>
<label class="cbox">Ear piercing
  <input type="checkbox"  name="earPiercing" value="ear piercing">
  <span class="mark"></span>
</label>
<label class="cbox">Dental Extraction
  <input type="checkbox"  name="dentalExtraction" value="Dental extraction" >
  <span class="mark"></span>
</label>
<label class="cbox">None
  <input type="checkbox"  name="none" value="None" >
  <span class="mark"></span>
</label>
</div>





<br><label class="lc">	
Do you suffer from or have suffered from any of the following diseases?<span style="color:red"> *</span></label><br><br>
<div class="cbox1"> 
<label class="cbox">Heart Disease
  <input type="checkbox" value="Heart Disease" name="ch">
  <span class="mark"></span>
</label>
<label class="cbox">Diabetes
  <input type="checkbox"  name="ch" value="Diabetes">
  <span class="mark"></span>
</label>
<label class="cbox">Sexually Transimitted diseases
  <input type="checkbox"  name="ch" value="Sexually Transimitted diseases" >
  <span class="mark"></span>
</label>

<label class="cbox">Jaundice
  <input type="checkbox"  name="ch" value="Jaundice">
  <span class="mark"></span>
</label>
<label class="cbox">Cancer
  <input type="checkbox"  name="ch" value="Cancer" >
  <span class="mark"></span>  
</label>

<label class="cbox">Severe Lung Disease
  <input type="checkbox"  name="ch" value="Lung disease">
  <span class="mark"></span>
</label>

<label class="cbox">Hepatitis B and C
  <input type="checkbox"  name="ch" value="Hepatitis">
  <span class="mark"></span>
</label>

<label class="cbox">Tuberculosis
  <input type="checkbox"  name="ch" value="Tuberculosis">
  <span class="mark"></span>
</label>
<label class="cbox">Malaria (6 months)
  <input type="checkbox"  name="ch" value="Malaria" >
  <span class="mark"></span>
 </label>
 <label class="cbox">Chronic Alchoholism
  <input type="checkbox"  name="ch" value="Tuberculosis">
  <span class="mark"></span>
</label>
<label class="cbox">None
  <input type="checkbox"  name="none1" value="Tuberculosis">
  <span class="mark"></span>
</label>

</div>
     </div>
        <div class="button">
          <input type="submit" value="Register" name="Register">
        </div>
      </form>
    </div>
  </div>
  </center>
  </header>
  </body>
  <html>
  
