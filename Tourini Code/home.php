<?php
include('session.php');

//on_load show circles
require_once( dirname( __FILE__ ) . '/view_circle_names.php' );

$view_circles = new view_circles();

$view_circles_results = $view_circles->view_circles($uid);

//on_load show newsfeed
require_once( dirname( __FILE__ ) . '/newsfeed.php' );

$newsfeed = new newsfeed();

$newsfeed_results = $newsfeed->newsfeed($uid);

$newsfeedm = new newsfeedm();

$newsfeedm_results = $newsfeedm->newsfeedm($uid);

$newsfeedl = new newsfeedl();

$newsfeedl_results = $newsfeedl->newsfeedl($uid);

//search
if ( isset( $_GET['s'] ) ) {
	require_once( dirname( __FILE__ ) . '/search.php' );

	$search = new search();
  
	$search_term = htmlspecialchars($_GET['s'], ENT_QUOTES);
  
	$search_results = $search->search($search_term);
}else{
	$search_term = "";
	$search_results = "";
}

//accept_friends
if ( isset( $_GET['friend'] ) ) {
	require_once( dirname( __FILE__ ) . '/accept_friends.php' );

	$friend = new friend();
  
	$friend_term = htmlspecialchars($_GET['friend'], ENT_QUOTES);
  
	$friend_results = $friend->friend($friend_term);
}else{
	$friend_term = "";
	$friend_results = "";
}

//show profile
if ( isset( $_GET['profile'] ) ) {
	require_once( dirname( __FILE__ ) . '/profile.php' );

	$profile = new profile();
  
	$profile_term = htmlspecialchars($_GET['profile'], ENT_QUOTES);
  
	$profile_results = $profile->profile($profile_term);
}else{
	$profile_term = "";
	$profile_results = "";
}

//view other profiles
if ( isset( $_GET['view'] ) ) {
	require_once( dirname( __FILE__ ) . '/profile.php' );
	require_once( dirname( __FILE__ ) . '/view_profile.php' );

	$view = new view();
  
	$view_term = htmlspecialchars($_GET['view'], ENT_QUOTES);
  
	$view_results = $view->view($view_term);
  
	$profileView = new profile();
  
	$profileView_term = htmlspecialchars($_GET['view'], ENT_QUOTES);
  
	$profileView_results = $profileView->profile($profileView_term);
}else{
	$view_term = "";
	$view_results = "";
	$profileView_term = "";
	$profileView_results = "";
}

//show friends
if ( isset( $_GET['circle'] ) ) {
	require_once( dirname( __FILE__ ) . '/profile.php' );

	$circle = new profile();
  
	$circle_term = htmlspecialchars($_GET['circle'], ENT_QUOTES);
  
	$circle_results = $circle->profile($circle_term);
}else{
	$circle_term = "";
	$circle_results = "";
}

//show circle members
if ( isset( $_GET['circle_title'] ) ) {
	require_once( dirname( __FILE__ ) . '/view_circle_members.php' );

	$view_circle_m = new view_circle_members();
  
	$view_circle_term = htmlspecialchars($_GET['circle_title'], ENT_QUOTES);
	  
	$view_circle_result = $view_circle_m->view_circle_members($view_circle_term);
}else{
	$view_circle_term = "";
	$view_circle_result = "";
}

if ( isset( $_GET['city'] ) ) {
	require_once( dirname( __FILE__ ) . '/location.php' );
	$success = "Location Posted";
}else if ( isset( $_GET['picture'] ) ) {
	require_once( dirname( __FILE__ ) . '/picture.php' );
	$success = "Picture Posted";
}else if ( isset( $_GET['message'] ) ) {
	require_once( dirname( __FILE__ ) . '/message.php' );
	$success = "Message Posted";
}else{
	$success = "";
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
	<link rel="stylesheet" href="css/home.css">
	<!-- End of Page CSS -->
	
	<!-- JS -->
	<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<script src="https://fb.me/react-0.13.3.min.js"></script>
	<script type="text/javascript" 
	src="http://maps.google.com/maps/api/js?sensor=false"></script>
	<script src="js/home.js"></script>
	<script src="js/imgur.js"></script>
	<script>
	$(document).ready(function() {
		$('#circle_friends').hide();
		$('#body-circle-mod').hide();
	});
	$(document).ready(function() {
		$.ajax({
			url:'friend_notifications.php',
			complete: function (response) {
				$('#friend_notifications').html(response.responseText);
			},
			error: function () {
				$('#friend_notifications').html('error!');
			},
		});
		return false;
		//document.getElementById("friend_request").innerHTML = "firstName";
	});
	$(document).ready(function() {
		$.ajax({
			url: 'http://freegeoip.net/json/',
			dataType: 'jsonp',
			cache: true,
			jsonp: 'callback',
			success: function(data) {
				document.getElementById("map").style.width  = "100%";
				document.getElementById("map").style.height = "125px";
				$('#result').html('You are in ' + data.city + '. Lat/Lon: ' + data.latitude + ', ' + data.longitude);
				var myOptions = {
					zoom: 10,
					center: new google.maps.LatLng(data.latitude, data.longitude),
					mapTypeId: google.maps.MapTypeId.ROADMAP
				};
				var map = new google.maps.Map(document.getElementById("map"), myOptions);
				$('#latitude').attr('value', data.latitude);
				$('#longitude').attr('value', data.longitude);
				$('#city').attr('value',data.city);
			},
			error: function() {
				$('#result').append('geolocation not supported');
			}
		});
		return false;
	});
	
	function circle_name(cname){
		$('#circle_name').attr('value', cname);
		$("#update_name").attr('class', 'glyphicon glyphicon-ok-circle');
		$('#circle_friends').show();
	}
	function circle_add(uid){
		var cname = document.getElementById("circle_name").value;
		$.ajax({
			url:'circle.php?circle_friend=' + uid + '&circle_name=' + cname,
			complete: function (response) {
				$('#circle_request').html("Added " + "<b>" + response.responseText + "</b>" + " to " + "<b>" + cname );
				$('#circle_friends').show();
			},
			error: function () {
				$('#friend_request').html('error!');
			},
		});
		return false;
	}
	
	function friend_request(uid){
		$.ajax({
			url:'friend.php?friend=' + uid,
			complete: function (response) {
				$('#friend_request').html("Friend Request to " + "<b>" + response.responseText + "</b>" + " sent");
			},
			error: function () {
				$('#friend_request').html('error!');
			},
		});
		return false;
	}
	
	function friend_accept(uid){
		$.ajax({
			url:'confirm_friend.php?friend_confirm=' + uid,
			complete: function (response) {
				$('#friend_confirm').html("<b>" + response.responseText + "</b><!-- 's friend request accepted -->");
			},
			error: function () {
				$('#friend_confirm').html('error!');
			},
		});
		return false;
		document.getElementById("friend_request").innerHTML = "firstName";
	}
	</script>
	<!-- end of JS -->

</head>
<body>
	<!-- Top Navigation Bar -->
	<nav class="navbar navbar-inverse">
		<div class="container-fluid">
			<div class="navbar-header">

				<!-- Navigation Bar Collaspe Button -->
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>                        
				</button>
				<!-- End of Navigation Bar Collaspe Button -->

				<!-- Navigation Bar Logo -->
				<a class="navbar-brand" href="#">
					<img  id="logo" src="http://i.imgur.com/tb6XYt8.png" class="img-responsive img-circle img-thumbnail" alt="Tourini Logo">
				</a>
				<!--  End of Navigation Bar Logo -->

			</div>
			<div class="collapse navbar-collapse" id="myNavbar">

				<!-- Search Box -->
				<form id="searchbox" action="" class="navbar-form navbar-left" role="search">
					<div class="form-group">
						<input type="search" id="search-box" name="s" class="form-control" placeholder="Search Anything" results="5" value="<?php echo $search_term; ?>">
						<button type="submit" value="Search" class="btn btn-default" ><span class="glyphicon glyphicon-search"></span></button>
					</div>
				</form>
				<!-- End of Search Box -->
				<ul class="nav navbar-nav navbar-right">

					<!-- Friend Requests -->
					<form id="friendbox" action="" class="navbar-form navbar-left" role="friend">
						<div class="form-group">

							<!-- Friend Requests -->
							<li style = "margin-top:6px;"><input type="hidden" id="friend-box" name="friend" placeholder="Search Anything" results="5" value="<?php echo $uid; ?>">
								<a id="adduser" href="javascript:{}" onclick="document.getElementById('friendbox').submit();" role="button">
									<span class="glyphicon glyphicon-plus"></span>
									<span class="glyphicon glyphicon-user"><span id="friend_notifications" class="badge"><!--php echo num of notifications--></span></a></li>
									<!-- End of Friend Requests -->
								</div>
							</form>
							<!-- End of Friend Requests -->
							<!-- old button
								<li><a id="adduser"href="#" ><span class="glyphicon glyphicon-plus"></span>
								<span class="glyphicon glyphicon-user"><span id="friend_notifications" class="badge"></span></a></li>
								-->
								<!-- Home and Settings -->
								<li><a id="home" href="http://127.0.0.1/Tourini/home.php">Home&nbsp;<span class="glyphicon glyphicon-home"></span></a></li>
								<li class="dropdown">
									<a id="options" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-cog"></span> <span class="caret"></span></a>
									<ul class="dropdown-menu">
										<form id="profilebox" action="" class="navbar-form navbar-left" role="profile">
											<div class="form-group">
												<input type="hidden" id="profile-box" name="profile" results="5" value="<?php echo $uid; ?>">
												<a href="javascript:{}" onclick="document.getElementById('profilebox').submit();" role="button">Profile <span class="glyphicon glyphicon-user"></span></a>
												<!-- <li role="separator" class="divider"></li> -->
												<!-- <button type="submit" value="profile" class="glyphicon glyphicon-user" ></button>Profile</li> -->
											</div>
										</form>
										<li><a href="logout.php">Logout <span class="glyphicon glyphicon-log-out"></span></a></li>
									</ul>
								</li>
								<!-- End of Home and Settings -->
							</ul>
						</div>
					</div>
				</nav>
				<!-- End of Navigation Bar -->

				<!-- Page Body -->
				<div class="body">
					<div class="row">
						<!-- Side Navigation Bar -->
						<div id="side-nav" class="col-sm-3 col-lg-2 col-md-2 col-xl-2 col-xs-3">
							<a class="profile" href="#">
								<img  id="profilepic" src="<?php echo $profilePic; ?>" class="img-responsive img-circle img-thumbnail" alt="Profile Picture">
							</a>
							<h3><?php echo $fName , " " , $lName; ?></h3>
							<h4>"<?php echo $login_session; ?>"</h4>
							<br>
							<!-- circle, echo ID of circle-->
							<?php if ( $view_circles_results ) : ?>
								<?php foreach ( $view_circles_results['results'] as $view_circles_result ) : ?>
									<!-- circle -->
									
									<?php echo'<form id="memberbox',$view_circles_result->circle_name,'" action="" class="" role="member">
										<div class="form-group">
										<input type="hidden" id="member-box" name="circle_title" results="5" value=',$view_circles_result->circle_name,'>
										<a href="javascript:{}" onclick=document.getElementById("memberbox',$view_circles_result->circle_name,'").submit(); class="btn btn-group" role="button">',$view_circles_result->circle_name,'</a><br>
										</div>
										</form>' 
										?>
										
									<?php endforeach; ?>
								<?php endif; ?>
								
								<!-- end echo circles -->
								<form id="circlebox" action="" class="" role="circle">
									<div class="form-group">
										<input type="hidden" id="circle-box" name="circle" results="5" value="<?php echo $uid; ?>">
										<a href="javascript:{}" onclick="document.getElementById('circlebox').submit();" class="btn btn-group" role="button"><span class="glyphicon glyphicon-plus"></span>&nbsp;Circle</a>
									</div>
								</form>
							</div>
						
							<!-- End of Side Navigation Bar -->

							<!-- Posting Section -->
					
							<div id="content" class="col-sm-3 col-md-4 col-md-offset-1 col-sm-offset-1">
							
								<!-- Start of NewsFeed Section -->
								<div id="newsfeed">
									<ul class="nav nav-tabs posting">
										<h2 style="text-align:center">NewsFeed</h2>
									</ul>
									<!-- newsfeed-->
										<div class="row" style="margin-left:11px">
											<div id="circle-body" class="col-sm-12 col-lg-8 col-md-8 col-xl-8 col-xl-offset-2 col-md-offset-2 col-lg-offset-2 col-xs-12">
											</div>
											<div class="row">
												<h3>&nbsp;Picture Updates</h3>
												<?php $row_countn = 1;?>
												<?php foreach ( $newsfeed_results['results'] as $newsfeed_result ) : ?>
													<!-- circle -->
													<?php echo'<div class="col-sm-4" style="width:200px">
														<div class="thumbnail">
														<img  id="profile-pic" src=',$newsfeed_result->profilePic,'class="img-responsive" alt="Pic" style="height:50px">
														<div class="caption">
														<h4>',$newsfeed_result->firstName," ",$newsfeed_result->lastName,'</h4>
														<img  id="profile-pic" src=',$newsfeed_result->caption,'class="img-responsive" alt="Pic" style="height:100px">
														<form id="viewbox" action="" class="navbar-form navbar-left" role="view">
														<div class="form-group">
														<input type="hidden" id="search-box" name="view" value=',$newsfeed_result->uid,'>
														<button type="submit" value="view" class="btn btn-default"><span class="glyphicon glyphicon-search">View</span></button>
														</div>
														</form>
														</div>
														</div>
														</div>' 
														?>
														<?php
														if ($row_countn % 3 == 0){
															echo '</div><div class="row">';
														}
														?>
														<?php $row_countn++; ?>
													<?php endforeach; ?>
											</div>
											<hr><h3>Message Updates</h3>
											<div class="row">
												<?php $row_countnm = 1;?>
												<?php foreach ( $newsfeedm_results['results'] as $newsfeedm_result ) : ?>
													<!-- circle -->
													<?php echo'<div class="col-sm-4" style="width:200px">
														<div class="thumbnail">
														<img  id="profile-pic" src=',$newsfeedm_result->profilePic,'class="img-responsive" alt="Pic" style="height:50px">
														<div class="caption">
														<h4>',$newsfeedm_result->firstName," ",$newsfeedm_result->lastName,'</h4>
														<h3>',$newsfeedm_result->message,'</h3>
														<form id="viewbox" action="" class="navbar-form navbar-left" role="view">
														<div class="form-group">
														<input type="hidden" id="search-box" name="view" value=',$newsfeedm_result->uid,'>
														<button type="submit" value="view" class="btn btn-default"><span class="glyphicon glyphicon-search">View</span></button>
														</div>
														</form>
														</div>
														</div>
														</div>' 
														?>
														<?php
														if ($row_countnm % 3 == 0){
															echo '</div><div class="row">';
														}
														?>
														<?php $row_countnm++; ?>
													<?php endforeach; ?>
											</div>
											<hr><h3>Locations Updates</h3>
											<div class="row">
												<?php $row_countnl = 1;?>
												<?php foreach ( $newsfeedl_results['results'] as $newsfeedl_result ) : ?>
													<!-- circle -->
													<?php echo'<div class="col-sm-4" style="width:200px">
														<div class="thumbnail">
														<img  id="profile-pic" src=',$newsfeedl_result->profilePic,'class="img-responsive" alt="Pic" style="height:50px">
														<div class="caption">
														<h4>',$newsfeedl_result->firstName," ",$newsfeedl_result->lastName,'</h4>
														<h3>',$newsfeedl_result->city,'</h3>
														<form id="viewbox" action="" class="navbar-form navbar-left" role="view">
														<div class="form-group">
														<input type="hidden" id="search-box" name="view" value=',$newsfeedm_result->uid,'>
														<button type="submit" value="view" class="btn btn-default"><span class="glyphicon glyphicon-search">View</span></button>
														</div>
														</form>
														</div>
														</div>
														</div>' 
														?>
														<?php
														if ($row_countnl % 3 == 0){
															echo '</div><div class="row">';
														}
														?>
														<?php $row_countnl++; ?>
													<?php endforeach; ?>
											</div>
									
									</div>
								</div>
							
								<!-- End of NewsFeed Section -->
							</div>
							<div id="content" class="col-sm-3 col-sm-offset-1">
								<ul class="nav nav-tabs posting">
									<li><a href="#aaa" data-toggle="tab">Picture</a></li>
									<li><a href="#bbb" data-toggle="tab">Location</a></li>
									<li><a href="#ccc" data-toggle="tab">Journal Entry</a></li>
									<li><a href="#" style="color:green"><!-- This is ridiculous, but it will work for now -->&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $success; ?></a></li>
								</ul>
								<br>
								<div class="tab-content" id="tabs">

									<!-- picture tab -->
									<div class="tab-pane" id="aaa">
										
										<form id="picturebox" action="" class="navbar-form navbar-left" role="pic">
											<div class="form-group">
												<input id="picload" type='file' accept="image/*" />
												<img  id="myImg" src="" alt="">
												<input id="picture" name="picture" type="hidden" value="">
												<div id="icap-box"></div>
												<br>
												<button type="submit" class="btn btn-primary" id="pic-submit">
													<span class="glyphicon glyphicon-picture"></span>&nbsp; Upload Picture
												</button>
											</div>
										</form>
										<br><br><br><br>
									</div>
									<!-- End of Picture Tab -->

									<!-- Location Tab -->
									<div class="tab-pane" id="bbb">
										<!-- Button to automatically post user's location -->
										<form id="locationbox" action="" class="navbar-form navbar-left" role="loc">
											<div class="form-group">
												<button class="btn btn-lg btn-success" id="location-submit">
													<span class="glyphicon glyphicon-map-marker"></span>&nbsp; Upload Location
												</button>
												<input id="latitude" name="latitude" type="hidden" value="">
												<input id="longitude" name="longitude" type="hidden" value="">
												<input id="city" name="city" type="hidden" value="">
												<input id="country" name="country" type="hidden" value="USA">
											</div>
										</form>
										
										<br> 
									</div>
									<!-- End of Location Tab -->
          
									<!-- Journal Tab -->
									<div class="tab-pane" id="ccc">
										<div id="entry-box"></div>
										<form id="searchbox" action="" class="navbar-form navbar-left" role="search">
											<div class="form-group">
												<input type="text" id="message-box" name="message" class="form-control" placeholder="Type Anything" results="5" size = "30%" value="">
												<br><br>
												<button type="submit" class="btn btn-info" id="entry-submit">
													<span class="glyphicon glyphicon-pencil"></span>&nbsp; Upload Message
												</button>
											</div>
										</form>
										<br><br><br>
									</div>
									<!-- Journal Tab -->
									<!-- <h4>Your Location:</h4> -->
									<div id="map"></div>
									<div id ="result" style ="font-size: 80%;text-align:center" ></div>
								</div>
							</div>
							<!-- End of Posting Section -->
						</div>
					</div>
				
					<!-- End of Body -->
				
					<!-- circle view members Modal -->
					<?php if ( $view_circle_result ) : ?>
						<?php echo "<script>
							$(window).load(function(){
								$('#view-circle-profile').modal('show');
								});
								</script>";
								?>
							<?php endif; ?>
							<div id="view-circle-profile" class="modal fade" role="dialog">
								<div class="modal-dialog modal-lg">

									<!-- Modal content-->
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h2 class="modal-title-circle"><img src="imgs/back2_reverse.png"style=" width: 35%; height: 300px"><?php echo $_GET['circle_title'];?> CIRCLE<img src="imgs/back2.png"style=" width: 35%; height: 300px"></h2>
											<!-- TAKE THIS OUT TO GET RID OF FLOATING PEOPLE --></div><!-- TAKE THIS OUT TO GET RID OF FLOATING PEOPLE -->
										</div>
										<div id="friends">
											<h4 class="modal-title"><?php echo $view_circle_result['count'] ?> friends:</h4>
										</div>
										<div class="modal-body">
											<!-- search Page -->
											<div id="view_circle">
												<div class="row">
													<!-- thumbnail -->
													<div class="row">
														<div id="prof-body" class="col-sm-12 col-lg-8 col-md-8 col-xl-8 col-xl-offset-2 col-md-offset-2 col-lg-offset-2 col-xs-12">
														</div>
													</div>
													<div class="row">
														<?php if ( $view_circle_result ) : ?>
															<?php $row_countvc = 1;?>
															<?php foreach ( $view_circle_result['results'] as $view_circle_resultED ) : ?>        
																<!-- view -->
																<?php echo'<div class="col-sm-4" style="width:200px">
																	<div class="thumbnail">
																	<img  id="profile-pic" src=',$view_circle_resultED->profilePic,'class="img-responsive" alt="Profile Pic" style="height:100px">
																	<div class="caption">
																	<h3>',$view_circle_resultED->firstName," ",$view_circle_resultED->lastName,'</h3>
																	<form id="viewbox" action="" class="navbar-form navbar-left" role="view">
																	<div class="form-group">
																	<input type="hidden" id="search-box" name="view" value=',$view_circle_resultED->uid,'>
																	<button type="submit" value="view" class="btn btn-default"><span class="glyphicon glyphicon-search">View</span></button>
																	</div>
																	</form>
																	</div>
																	</div>
																	</div>' 
																	?>
																	<?php
																	if ($row_countvc % 3 == 0){
																		echo '</div><div class="row">';
																	}
																	?>
																	<?php $row_countvc++; ?>
																<?php endforeach; ?>
															<?php endif; ?>
														</div>
													</div>
												</div>
											</div>
											<!-- End of view circle member Page -->
										</div>
										<?php if ( $view_circle_result ) : ?>
											<?php echo '<div class="modal-footer">
												<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
												</div>'
												?>
											<?php endif; ?>
										</div>

									</div>
								</div>

							</div>
							<!-- end modal-->
							<!-- circle Modal -->
							<?php if ( $circle_results ) : ?>
								<?php echo "<script>
									$(window).load(function(){
										$('#modal-circle').modal('show');
										});
										</script>";
										?>
									<?php endif; ?>
									<div id="modal-circle" class="modal fade" role="dialog">
										<div class="modal-dialog">

											<!-- Modal content-->
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal">&times;</button>
													<input type="hidden" id="circle_name" name = "new_circle" value="new circle">
													<input type="text" id="circle-name" placeholder="Enter new or existing Circle" results="5" size = "60%" value="">
													<button type="button" class="btn btn-info" onclick="circle_name(document.getElementById('circle-name').value)">
														<span id = "update_name" class="glyphicon glyphicon-pencil"></span>&nbsp;Name
													</button>
													<div id="circle_request" style="color:green"></div>
					
													<?php if ( $circle_results ) : ?>
														<div id="circle_friends" class="modal-title">
															<h4 class="circle-title">Choose from your <?php echo $circle_results['count'] ?> friends:</h4>
														</div>
														<!-- TAKE THIS OUT TO GET RID OF FLOATING PEOPLE --></div><!-- TAKE THIS OUT TO GET RID OF FLOATING PEOPLE -->
										
													</div>
													<div class="modal-body">
														<!-- search Page -->
														<div id="circles">
															<div class="row">


																<!-- thumbnail -->
																<div class="row" style="margin-left:11px">
																	<div id="circle-body" class="col-sm-12 col-lg-8 col-md-8 col-xl-8 col-xl-offset-2 col-md-offset-2 col-lg-offset-2 col-xs-12">
																	</div>
																	<div class="row">
																		<?php $row_countc = 1;?>
																		<?php foreach ( $circle_results['results'] as $circle_result ) : ?>
																			<!-- circle -->
																			<?php echo'<div class="col-sm-4" style="width:200px">
																				<div class="thumbnail">
																				<img  id="profile-pic" src=',$circle_result->profilePic,'class="img-responsive" alt="circle Pic" style="height:100px">
																				<div class="caption">
																				<h3>',$circle_result->firstName," ",$circle_result->lastName,'</h3>
																				<button type="submit" value="add_user" class="btn btn-default" onclick="circle_add(',$circle_result->uid,')" ><span class="glyphicon glyphicon-plus"></span></button>
																				</div>
																				</div>
																				</div>' 
																				?>
																				<?php
																				if ($row_countc % 3 == 0){
																					echo '</div><div class="row">';
																				}
																				?>
																				<?php $row_countc++; ?>
																			<?php endforeach; ?>
																		<?php endif; ?>
																	</div>
																</div>
															</div>
														</div>
														<!-- End of circle Page -->
													</div>
													<?php if ( $circle_results ) : ?>
														<?php echo '<div class="modal-footer">
															<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
															</div>'
															?>
														<?php endif; ?>
													</div>

												</div>
											</div>

										</div>
										<!-- end modal-->

										<!-- profileview Modal -->
										<?php if ( $view_results ) : ?>
											<?php echo "<script>
												$(window).load(function(){
													$('#view-profile').modal('show');
													});
													</script>";
													?>
												<?php endif; ?>
												<div id="view-profile" class="modal fade" role="dialog">
													<div class="modal-dialog modal-lg">

														<!-- Modal content-->
														<div class="modal-content">
															<div class="modal-header">
																<button type="button" class="close" data-dismiss="modal">&times;</button>
					  
																<?php if ( $view_results ) : ?>
																	<?php $row_countv = 1;?>
																	<?php foreach ( $view_results['results'] as $view_result ) : ?>
																		<img  id="profile-pic" src="<?php echo $view_result->profilePic; ?>" class="img-responsive img-circle img-thumbnail" alt="Profile Pic" style="float:right">
																		<div class="results-count">
																			<h2 id="user-fullname"><?php echo $view_result->firstName," ",$view_result->lastName; ?></h2>
																			<h3 id="set-info">Birthday: <?php echo $view_result->dob ?></h3>
																			<h3 id="set-info">Gender: <?php  
																				if ($view_result->gender == 0){
																					echo "M";
																				}else if ($view_result->gender == 1){
																					echo "F";
																				}else {
																					echo "Undecided";
																				}
													
																				?></h3>
																			</div>
																			<!-- TAKE THIS OUT TO GET RID OF FLOATING PEOPLE --></div><!-- TAKE THIS OUT TO GET RID OF FLOATING PEOPLE -->
																		</div>
																		<div class="modal-body">
																			<!-- search Page -->
																			<div id="view">
																				<div class="row">
																					<!-- thumbnail -->
																					<div class="row">
																						<div id="prof-body" class="col-sm-12 col-lg-8 col-md-8 col-xl-8 col-xl-offset-2 col-md-offset-2 col-lg-offset-2 col-xs-12">
																
																						<?php endforeach; ?>
																					<?php endif; ?> 
						
					
																					<div id="friends">
																						<h4 class="modal-title"><?php echo $profileView_results['count'] ?> friends:</h4>
																					</div>
																				</div>
																			</div>
																			<div class="row">
																				<!--placed other piece of array into view_results here!-->
																				<?php if ( $profileView_results ) : ?>
																					<?php $row_countv = 1;?>
																					<?php foreach ( $profileView_results['results'] as $profileView_result ) : ?>        
																						<!-- view -->
																						<?php echo'<div class="col-sm-4" style="width:200px">
																							<div class="thumbnail">
																							<img  id="profile-pic" src=',$profileView_result->profilePic,'class="img-responsive" alt="Profile Pic" style="height:100px">
																							<div class="caption">
																							<h3>',$profileView_result->firstName," ",$profileView_result->lastName,'</h3>
																							<input type="hidden" id="search-box" name="friend" value=',$profileView_result->uid,'>
																							<button type="submit" value="add" class="btn btn-default" onclick="friend_request(',$profileView_result->uid,')"><span class="glyphicon glyphicon-plus"></span></button>
																							</div>
																							</div>
																							</div>' 
																							?>
																							<?php
																							if ($row_countv % 3 == 0){
																								echo '</div><div class="row">';
																							}
																							?>
																							<?php $row_countv++; ?>
																						<?php endforeach; ?>
																					<?php endif; ?>
																				</div>
																			</div>
																		</div>
																	</div>
																	<!-- End of view profile Page -->
																</div>
																<?php if ( $view_results ) : ?>
																	<?php echo '<div class="modal-footer">
																		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
																		</div>'
																		?>
																	<?php endif; ?>
																</div>

															</div>
														</div>

													</div>
													<!-- end modal-->
	
													<!-- profile Modal -->
													<?php if ( $profile_results ) : ?>
														<?php echo "<script>
															$(window).load(function(){
																$('#modal-profile').modal('show');
																});
																</script>";
																?>
															<?php endif; ?>
															<div id="modal-profile" class="modal fade" role="dialog">
																<div class="modal-dialog modal-lg">

																	<!-- Modal content-->
																	<div class="modal-content">
																		<div class="modal-header">
																			<button type="button" class="close" data-dismiss="modal">&times;</button>
					  
																			<?php if ( $profile_results ) : ?>
																				<img  id="profile-pic" src="<?php echo $profilePic; ?>" class="img-responsive img-circle img-thumbnail" alt="Profile Pic" style="width:300px; float:right">
																				<div class="results-count">
																					<h2 id="user-fullname"><?php echo $fName," ",$lName; ?></h2>
																					<h3 id="set-info">Birthday: <?php echo $dob ?></h3>
																					<h3 id="set-info">Gender: <?php  
																						if ($sex == 0){
																							echo "M";
																						}else if ($sex == 1){
																							echo "F";
																						}else {
																							echo "Undecided";
																						}
														
																						?></h3>
																					</div>
																				</div>
																				<div id="friends">
																					<h3 class="modal-title" style="color:purple">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $profile_results['count'] ?> Friends: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h3>
																				</div>
																				<!-- TAKE THIS OUT TO GET RID OF FLOATING PEOPLE --></div><!-- TAKE THIS OUT TO GET RID OF FLOATING PEOPLE -->
													
																				<div class="modal-body">
																					<!-- search Page -->
																					<div id="search">
																						<div class="row">


																							<!-- thumbnail -->
																							<div class="row">
																								<div id="prof-body" class="col-sm-12 col-lg-8 col-md-8 col-xl-8 col-xl-offset-2 col-md-offset-2 col-lg-offset-2 col-xs-12">
															
																								</div>
																							</div>
																							<div class="row">
																								<?php $row_countp = 1;?>
																								<?php foreach ( $profile_results['results'] as $profile_result ) : ?>
																									<!-- profile -->
																									<?php echo'<div class="col-sm-4" style="width:200px">
																										<div class="thumbnail">
																										<img  id="profile-pic" src=',$profile_result->profilePic,'class="img-responsive" alt="Profile Pic" style="height:100px">
																										<div class="caption">
																										<h3>',$profile_result->firstName," ",$profile_result->lastName,'</h3>
																										<form id="viewbox" action="" class="navbar-form navbar-left" role="view">
																										<div class="form-group">
																										<input type="hidden" id="search-box" name="view" value=',$profile_result->uid,'>
																										<button type="submit" value="view" class="btn btn-default"><span class="glyphicon glyphicon-search">View</span></button>
																										</div>
																										</form>
																										</div>
																										</div>
																										</div>' 
																										?>
																										<?php
																										if ($row_countp % 2 == 0){
																											echo '</div><div class="row">';
																										}
																										?>
																										<?php $row_countp++; ?>
																									<?php endforeach; ?>
																								<?php endif; ?>
																							</div>
																						</div>
																					</div>
																				</div>
																				<!-- End of profile Page -->
																			</div>
																			<?php if ( $profile_results ) : ?>
																				<?php echo '<div class="modal-footer">
																					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
																					</div>'
																					?>
																				<?php endif; ?>
																			</div>

																		</div>
																	</div>

																</div>
																<!-- end modal-->
																<!-- Modal search -->
																<?php if ( $search_results ) : ?>
																	<?php echo "<script>
																		$(window).load(function(){
																			$('#modal-search').modal('show');
																			});
																			</script>";
																			?>
																		<?php endif; ?>
																		<div id="modal-search" class="modal fade" role="dialog">
																			<div class="modal-dialog">

																				<!-- Modal content-->
																				<div class="modal-content">
																					<div class="modal-header">
																						<button type="button" class="close" data-dismiss="modal">&times;</button>
																						<?php if ( $search_results ) : ?>
																							<div class="results-count">
																								<h4 class="modal-title">Search Results: <?php echo $search_results['count']; ?> found</h4>
																								<div id="friend_request" style="color:green"></div>
																							</div>
																							<!-- TAKE THIS OUT TO GET RID OF FLOATING PEOPLE --></div><!-- TAKE THIS OUT TO GET RID OF FLOATING PEOPLE -->
																						</div>
																						<div class="modal-body">
																							<!-- search Page -->
																							<div id="search">
																								<div class="row">
																									<!-- thumbnail -->
																									<div class="row">
																										<?php $row_count = 1;?>
																										<?php foreach ( $search_results['results'] as $search_result ) : ?>
																											<!-- friend -->
																											<?php echo'<div class="col-sm-4" style="width:200px">
																												<div class="thumbnail">
																												
																												<div class="caption">
																												<h3>',$search_result->message,'</h3>
																												<h4>',$search_result->firstName," ",$search_result->lastName,'</h4>
																												<input type="hidden" id="search-box" name="friend" value=',$search_result->uid,'>
																												<button type="submit" value="add" class="btn btn-default" onclick="friend_request(',$search_result->uid,')" ><span class="glyphicon glyphicon-plus"></span></button>
																												</div>
																												</div>
																												</div>' 
																												?>
																												<?php
																												if ($row_count % 3 == 0){
																													echo '</div><div class="row">';
																												}
																												?>
																												<?php $row_count++; ?>
																											<?php endforeach; ?>
																										<?php endif; ?>
																									</div>
																								</div>
																							</div>
																						</div>
																						<!-- End of search Page -->
																					</div>
																					<?php if ( $search_results ) : ?>
																						<?php echo '<div class="modal-footer">
																							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
																							</div>'
																							?>
																						<?php endif; ?>
																					</div>
			  
																				</div>
																			</div>

																		</div>
																		<!-- end Modal search-->
	
																		<!--friend modal-->
																		<?php if ( $friend_results ) : ?>
																			<?php echo "<script>
																				$(window).load(function(){
																					$('#modal-friends').modal('show');
																					});
																					</script>";
																					?>
																				<?php endif; ?>
																				<div id="modal-friends" class="modal fade" role="dialog">
																					<div class="modal-dialog">

																						<!-- Modal content-->
																						<div class="modal-content">
																							<div class="modal-header">
																								<button type="button" class="close" data-dismiss="modal">&times;</button>
																								<?php if ( $friend_results ) : ?>
																									<div class="results-count">
																										<h4 class="modal-title">Friend Requests: <?php echo $friend_results['count']; ?> found</h4>
																										<div id="friend_confirm"></div>
																									</div>
																								</div>
																								<div class="modal-body">
																									<!-- friend Page -->
																									<div id="search">
																										<div class="row">
																			
																											<?php $row_countf = 1;?>
																											<?php foreach ( $friend_results['results'] as $friend_result ) : ?>

																												<!-- thumbnail -->
																												<div class="row">
																													<!-- friend -->
																													<?php echo'<div class="col-sm-4" style="width:200px">
																														<div class="thumbnail">
																														<img  id="profile-pic" src=',$friend_result->profilePic,'class="img-responsive" alt="Profile Pic" style="height:100px">
																														<div class="caption">
																														<h4>',$friend_result->firstName," ",$friend_result->lastName,'</h4>
				          
																														<input type="hidden" id="search-box" name="friend" value=',$friend_result->uid1,'>
																														<button type="submit" value="add" class="btn btn-default" onclick="friend_accept(',$friend_result->uid1,')" ><span class="glyphicon glyphicon-plus">Accept</span></button>
				            
																														</div>
																														</div>
																														</div>' 
																														?>
																														<?php
																														if ($row_countf % 3 == 0){
																															echo '</div><div class="row">';
																														}
																														?>
																														<?php $row_countf++; ?>
																													<?php endforeach; ?>
																												<?php endif; ?>
																											</div>
																										</div>
																									</div>
																								</div>
																								<!-- End of friend Page -->
																							</div>
																							<?php if ( $friend_results ) : ?>
																								<?php echo '<div class="modal-footer">
																									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
																									</div>'
																									?>
																								<?php endif; ?>
																							</div>

																						</div>
																					</div>

																				</div>
																				<!-- Modal -->

																			</body>
																			</html>