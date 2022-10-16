<!Doctype HTML>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="AdminHome_style.css" type="text/css"/>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>


<body>
	
	<div id="mySidenav" class="sidenav">
	<p class="logo"><span>R</span>aktdaan</p>
  <a href="index.html" class="icon-a"><i class="fa fa-dashboard icons"></i> &nbsp;&nbsp;Dashboard</a>
  <a href="#"class="icon-a"><i class="fa fa-users icons"></i> &nbsp;&nbsp;Blood </a>
  <a href="BankAdmin.html"class="icon-a"><i class="fa fa-list icons"></i> &nbsp;&nbsp;Manage Blood Banks</a>
  <a href="timeline.html"class="icon-a"><i class="fa fa-shopping-bag icons"></i> &nbsp;&nbsp;Post On Timeline</a>
  <a href="#"class="icon-a"><i class="fa fa-tasks icons"></i> &nbsp;&nbsp;Reports</a>
  <a href="#"class="icon-a"><i class="fa fa-user icons"></i> &nbsp;&nbsp;Profiles</a>

</div>
<div id="main">

	<div class="head">
		<div class="col-div-6">
<span style="font-size:30px;cursor:pointer; color: :#1b203d;" class="nav"  >&#9776; Dashboard</span>
<span style="font-size:30px;cursor:pointer; color: :#1b203d;" class="nav2"  >&#9776; Dashboard</span>
</div>
	
	<div class="col-div-6">
	<div class="profile">

		<img src="images/user.png" class="pro-img" />
		<p><span>Admin</span></p>
	</div>
</div>
	<div class="clearfix"></div>
</div>

	<div class="clearfix"></div>
	<br/>
	
	<div class="container">
	  <div class="title"> Blood Bank Details</div>
	<div class="content">
      <form action="#" method="POST">
        <div class="user-details">
          <div class="input-box">
            <span class="details">Blood Bank Name</span>
            <input type="text" name="Bnk_name" placeholder="Enter the Blood Bank name" required >
          </div>
		  
          <div class="input-box">
            <span class="details">Email</span>
            <input type="email" name="Bnk_email" placeholder="Enter Email ID"  required >
          </div>
		  
		<div class="input-box">
            <span class="details">Mobile No</span>
            <input type="Number" name="Bnk_mob" placeholder="Enter the Mobile Number"  required >
          </div>
	
	    <div class="input-box">
            <span class="details">Location</span>
								<select name="Bnk_location" required>
									<option disabled selected>-- Select Blood Bank Location --</option>
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

          </div>
		  
		  <div class="Button">
          <input type="submit" value="Add Blood Bank" name="addBloodBank"class="bButton">
        </div>
		
		
		
		
		 </div>
	</div>
	</div>
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>

  $(".nav").click(function(){
    $("#mySidenav").css('width','70px');
    $("#main").css('margin-left','70px');
    $(".logo").css('visibility', 'hidden');
    $(".logo span").css('visibility', 'visible');
     $(".logo span").css('margin-left', '-10px');
     $(".icon-a").css('visibility', 'hidden');
     $(".icons").css('visibility', 'visible');
     $(".icons").css('margin-left', '-8px');
      $(".nav").css('display','none');
      $(".nav2").css('display','block');
  });

$(".nav2").click(function(){
    $("#mySidenav").css('width','300px');
    $("#main").css('margin-left','300px');
    $(".logo").css('visibility', 'visible');
     $(".icon-a").css('visibility', 'visible');
     $(".icons").css('visibility', 'visible');
     $(".nav").css('display','block');
      $(".nav2").css('display','none');
 });

</script>
</body>
</html>



<?php
if($_SERVER['REQUEST_METHOD']=="POST" && ISSET($_POST["addBloodBank"])){
	$connx=mysqli_connect("localhost:3307","root","","blood");
	if(!$connx){
		echo"<script>alert('Connection Failed!');</script>";
	}

if(!empty($_POST['Bnk_name']) && !empty($_POST['Bnk_email']) && !empty($_POST['Bnk_location']) && !empty($_POST['Bnk_mob']) ){
	@$Bnk_name=$_POST['Bnk_name'];
	@$Bnk_email=$_POST['Bnk_email'];
	@$Bnk_location=$_POST['Bnk_location'];
	@$Bnk_mob=$_POST['Bnk_mob'];
	
	$sql="INSERT INTO `tb_blood_bank`(`Bnk_name`,`Bnk_email`,`Bnk_location`,`Bnk_mob`) VALUES ('$Bnk_name','$Bnk_email','$Bnk_location','$Bnk_mob');";
	if(mysqli_query($connx,$sql)){
		$sql3="SET FOREIGN_KEY_CHECKS=0;";
		if(mysqli_query($connx,$sql3)){
		$sql1="SELECT `Bnk_id` FROM `tb_blood_bank` WHERE `Bnk_email`='$Bnk_email';";
		$result1=mysqli_query($connx,$sql1);
		$row1=mysqli_fetch_assoc($result1);
		
		@$Bnk_id=$row['Bnk_id'];
		$sql2="INSERT INTO `tb_blood_availability`(`Bnk_id`) VALUES ('$Bnk_id');";
		
		if(mysqli_query($connx,$sql2)){
			echo"<script>alert('Blood Bank Succesfully Added');</script>";
		}
		else{
			echo"<script>alert('Could Not Add Blood Bank!');</script>";
		}
		}
	}
	
}
else{
	echo"<script>alert('All fields are Mandatory!');</script>";
}
}
?>