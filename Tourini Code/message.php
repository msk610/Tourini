<?php
$mysqli = new mysqli("127.0.0.1", "root", "ums818Ezekiel", "Tourini");

if (mysqli_connect_errno()) {
    printf("Error: %s\n", mysqli_connect_error());
    exit();
}
else {
	$caption = $_GET["message"];
	$stmt2 = $mysqli->prepare
		("INSERT into message (uid, message, timeSent)  
			VALUES (?, ?, ?)");
	$stmt2->bind_param("iss", $uid_me, $message, $ts);
	$uid_me = $uid;
	$message = $caption;
	$ts = date("Y-m-d G:i:s");
		
	$stmt2->execute();
	
	$stmt2->close();
	$mysqli->close();
	
}


?>