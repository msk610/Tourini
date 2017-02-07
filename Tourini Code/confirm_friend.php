<?php
include('session.php');
$mysqli = new mysqli("127.0.0.1", "root", "ums818Ezekiel", "Tourini");

if (mysqli_connect_errno()) {
    printf("Error: %s\n", mysqli_connect_error());
    exit();
}
else {
	$keyword = strtoupper($_GET["friend_confirm"]);
	$sql = "Update friends
			SET request = 1 
			WHERE friends.uid1 = $keyword and friends.uid2 = $uid";

	if ($mysqli->query($sql) === TRUE) {
	    echo "Friend Accepted";
	} else {
	    echo "Error updating record: " . $mysqli->error;
	}

	
}


?>