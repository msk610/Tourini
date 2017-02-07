<?php
$mysqli = new mysqli("127.0.0.1", "root", "ums818Ezekiel", "Tourini");

if (mysqli_connect_errno()) {
    printf("Error: %s\n", mysqli_connect_error());
    exit();
}
else {
	$longitude = strtoupper($_GET["longitude"]);
	$latitude = strtoupper($_GET["latitude"]);
	$city = strtoupper($_GET["city"]);
	$country = "USA";
	$stmt2 = $mysqli->prepare
		("INSERT INTO location (uid, longitude, latitude, city, country) 
			VALUES (?, ?, ?, ?, ?)");
	$stmt2->bind_param("iiiss", $uid_me, $lon, $lat, $city, $country);
	$uid_me = $uid;
	$lon = $longitude;
	$lat = $latitude;
	$city = $city;
	$country = $country;
	
		
	$stmt2->execute();
	
	$stmt2->close();
	$mysqli->close();
	
}


?>