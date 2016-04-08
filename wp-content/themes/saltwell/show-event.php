<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
echo "in show event ";

if (isset($_POST['eventid'])) {
echo $_POST['eventid'];
}


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "saltwell";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "select u.display_name
from wp_users_events ue, wp_users u 
where u.id = ue.user_id
and ue.event_id=$eventid";



if ($conn->query($sql) === TRUE) {
    echo "Record showed successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>