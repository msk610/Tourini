<?php
include('session.php');
$mysqli = new mysqli("127.0.0.1", "root", "ums818Ezekiel", "Tourini");

if (mysqli_connect_errno()) {
    printf("Error: %s\n", mysqli_connect_error());
    exit();
}
else {
	$keyword = strtoupper($_GET["friend"]);
	$stmt = $mysqli->prepare
		("SELECT firstName 
			FROM User 
			WHERE uid = $keyword");
	$stmt->execute();
	$stmt->bind_result($firstName);
	while($stmt->fetch()){
		echo $firstName;
	} 
	$stmt->close();
	$stmt2 = $mysqli->prepare
		("INSERT INTO Friends (uid1, uid2, requestTime) 
			VALUES (?, ?, ?)");
	$stmt2->bind_param("iis", $uid_me, $uid_friend, $ts);
	$uid_me = $uid;
	$uid_friend = $keyword;
	$ts = date("Y-m-d G:i:s");
	
		
	$stmt2->execute();
	
	$stmt2->close();
	$mysqli->close();
	
}


?>