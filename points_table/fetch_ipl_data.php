<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "sample";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM ipl_teams ORDER BY points DESC, nrr DESC";
$result = $conn->query($sql);
?>
