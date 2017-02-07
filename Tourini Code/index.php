<?php
include("config.php");
session_start();
   
if(isset($_GET["new_user"])){
	$new_user = $_GET["new_user"];	
}
else{	
	$new_user = "";
}
   
if($_SERVER["REQUEST_METHOD"] == "POST") {
	// username and password sent from form 
      
	$myusername = mysqli_real_escape_string($db,$_POST['username']);
	$mypassword = mysqli_real_escape_string($db,$_POST['password']); 

	$sql = "SELECT uname FROM User WHERE uname = '$myusername' and password = '$mypassword'";
	$result = mysqli_query($db,$sql)
		or die("Error: ".mysqli_error($db));
	  
	if(mysqli_num_rows($result) > 0){
		$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	}
	  
	$active = $row["active"];
      
	$count = mysqli_num_rows($result);
      
	// If result matched $myusername and $mypassword, table row must be 1 row
		
	if($count == 1) {
		$_SESSION['login_user'] = $myusername;
         
		header("location: home.php");
	}else {
		$error = "Your Login Name or Password is invalid";
	}
}
?>
<!doctype html>
<html>
<head>
	<!-- Meta Data -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- End of Meta Data -->

	<!-- title -->
	<title>Tourini</title>
	<!-- End of title -->

	<!-- Bootstrap -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<!-- End of Bootstrap -->

	<!-- Ubuntu Font -->
	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Ubuntu:regular,bold&subset=Latin">
	<!-- End of Ubuntu Font -->

	<!-- Animation CSS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.1/animate.min.css">
	<!-- End of Animation CSS -->

	<!-- Page CSS -->
	<link rel="stylesheet" href="css/index.css">
	<!-- End of Page CSS -->
		
	<!-- JS -->
	<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<script src="js/index.js"></script>
	<!-- End of JS -->
</head>
<body>
	<!-- Container -->
	<div class="container">
			
		<!-- Page Header -->
		<div id="heading" class="row">
			<div id="title" class="col-sm-12 col-xs-12 col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3 zoomIn animated">
				<img align="Left" src="http://i.imgur.com/tb6XYt8.png" class="img-responsive img-circle" alt="Tourini Logo">
				<h1 style="style=display:inline-block">&nbsp;Tourini</h1>
				<h3><small id="subtitle" class="fadeIn animated">&nbsp;A place to talk about your daily adventures and to connect with other travelers.</small></h3>
				<h2><?php
					if (is_null($new_user) == false){
						echo $new_user;
					}
					?>
				</div>
			</div>
			<!-- End of Page Header -->

			<!-- Sign In Box-->
			<div class="row">
				<div class="col-sm-8 col-xs-8 col-md-4 col-lg-4 fadeInRight animated signInForm">
					<div id="form">
						<h2 id="page-form-header">Sign In</h2>
						<form action="" method="post" enctype="#" id="page-form">
							<div class="form-group">
								<div class="input-group" id="user-box">
									<div class="input-group-addon" id="icon-person">
										<img id="form-icon" src="http://i.imgur.com/mZbDvx3.png" alt="user">
									</div>
									<input class="form-control" id="username" name="username" placeholder="Username" type="text"/>
								</div>
							</div>
							<div class="form-group">
								<div class="input-group" id="pwd-box">
									<div class="input-group-addon" id="icon-key">
										<img id="form-icon" src="http://i.imgur.com/cyV4ZvI.png" alt="key">
									</div>
									<input class="form-control" id="password" name="password" placeholder="Password" type="password"/>
								</div>
							</div>
							<input id="login-button" type="image" value="submit" src="http://i.imgur.com/3dGSp1G.png" alt="Login Button" onMouseOver="this.src = 'http://i.imgur.com/hlW2Hvn.png'" onMouseOut="this.src= 'http://i.imgur.com/3dGSp1G.png'">
							<div class="checkbox" id="check-box">
								<div class="row">
									<label class="col-sm-6" id="lab-1"><input type="checkbox" value="">Remember Me</label> 
									<a href="#" class="col-sm-6" id="a-1">Forget Password? </a>
								</div>
							</div>
						</form>
						<hr>
						<div id="sign-up">
							First Time Here? 
							<a class="" href="signup.html" id="signupButton"><img id="signup-pic" src="http://i.imgur.com/xuyBO4D.png" onMouseOver="this.src = 'http://i.imgur.com/za0t8qZ.png'" onMouseOut="this.src= 'http://i.imgur.com/xuyBO4D.png'"></a>
						</div>
					</div>
				</div>
				<!-- End of Sign In Box -->

			</div>
			<!-- End of Container -->

			<!-- Bottom of Page -->
			<hr id= "bottomline" class="fadeIn animated">
			<footer class="fadeIn animated">
				Copyright © 2016 MD Kabir and Jason Rosenstein. All rights reserved. Last Updated: April 28 2016
			</footer>
			<!-- End of Bottom of Page -->

		</body>
		</html>