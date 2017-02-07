<?php
include('session.php');
$mysqli = new mysqli("127.0.0.1", "root", "ums818Ezekiel", "Tourini");

if (mysqli_connect_errno()) {
    printf("Error: %s\n", mysqli_connect_error());
    exit();
}
else {
	$friend = strtoupper($_GET["circle_friend"]);
	$stmt = $mysqli->prepare
		("SELECT distinct(firstName)
			from circles join User
    		where user.uid = $friend
    		group by user.uid");
	$stmt->execute();
	$stmt->bind_result($firstName_circle);
	while($stmt->fetch()){
		echo $firstName_circle;
	} 
	$stmt->close();
	$name = strtoupper($_GET["circle_name"]);
	$stmt2 = $mysqli->prepare
		("INSERT into circles (uid1, uid2, circle_name)  
			VALUES (?, ?, ?)");
	$stmt2->bind_param("iis", $uid_me, $uid_friend, $circle_name);
	$uid_me = $uid;
	$uid_friend = $friend;
	$circle_name = $name;

	$stmt2->execute();
	$stmt2->close();
	$mysqli->close();
	
}


?>