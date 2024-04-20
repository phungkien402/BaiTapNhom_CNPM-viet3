<?php
$servername = "localhost";
$username = "admin";
$password = "123456";
$dbname = "my_database";

$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>
