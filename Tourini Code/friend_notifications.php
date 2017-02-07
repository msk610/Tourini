<?php
include('session.php');
$mysqli = new mysqli("127.0.0.1", "root", "ums818Ezekiel", "Tourini");

if (mysqli_connect_errno()) {
    printf("Error: %s\n", mysqli_connect_error());
    exit();
}
else {
	$stmt = $mysqli->prepare
		("SELECT count(*) as notifications
			FROM friends 
			WHERE uid2 = $uid and request is NULL");
	$stmt->execute();
	$stmt->bind_result($notifications);
	while($stmt->fetch()){
		echo $notifications;
	} 
	$stmt->close();
	
}


?>