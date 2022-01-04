<?php
$servername = "192.168.20.222";
$username = "lmsuser";
$password = "lmsuserpassword";
$db="lms";
$conn = mysqli_connect($servername, $username, $password, $db);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>