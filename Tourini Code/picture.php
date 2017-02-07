<?php
$mysqli = new mysqli("127.0.0.1", "root", "ums818Ezekiel", "Tourini");

if (mysqli_connect_errno()) {
    printf("Error: %s\n", mysqli_connect_error());
    exit();
}
else {
	$caption = $_GET["picture"];
	$stmt2 = $mysqli->prepare
		("INSERT INTO pictures (uid, timeTaken, caption) 
			VALUES (?, ?, ?)");
	$stmt2->bind_param("iss", $uid_me, $ts, $picture_link);
	$uid_me = $uid;
	$ts = date("Y-m-d G:i:s");
	$picture_link = $caption;
	
		
	$stmt2->execute();
	
	$stmt2->close();
	$mysqli->close();
	
}


?>