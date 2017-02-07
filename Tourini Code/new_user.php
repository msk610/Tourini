<?php
$servername = "127.0.0.1";
$username = "root";
$password = "ums818Ezekiel";
$dbname = "Tourini";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// prepare and bind
$stmt = $conn->prepare("INSERT INTO User (uname, firstName, lastName, dob, gender, password, profilePic) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssiss", $uname, $firstName, $lastName, $dob, $gender, $password, $profilePic);

// set parameters and execute
$uname = ($_GET["username"]);
$firstName = ($_GET["fname"]);
$lastName = ($_GET["lname"]);
$dob = ($_GET["dob"]);
$gender = ($_GET["gender"]);
$password = ($_GET["password"]);
$profilePic = ($_GET["picture"]);
$stmt->execute();

echo "New account created successfully";

$stmt->close();
$conn->close();

header("Location: http://127.0.0.1/Tourini/index.php?new_user=Sign-up was successful!"); /* Redirect browser */
exit();
?>
