<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
echo "success";

if (isset($_POST['eventid'])) {
echo $_POST['eventid'];
}

if (isset($_POST['userid'])) {
echo $_POST['userid'];
}

$userid=$_POST['userid'];
$eventid=$_POST['eventid'];

$servername = "localhost";
$username = "saltwell_wp";
$password = "wzM1cMf5";
$dbname = "saltwell_wp";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO wp_users_events
VALUES ($userid,$eventid)";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>

