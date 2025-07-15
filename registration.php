<?php
// Database configuration
$servername = "localhost"; // Change if your server is different
$username = "root";        // Replace with your MySQL username
$password = "";            // Replace with your MySQL password
$dbname = "sample";        // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);

    // Check if passwords match
    if ($password === $confirm_password) {
        // Insert user details into the database
        $sql = "INSERT INTO users (fullname, email, username, password) VALUES ('$fullname', '$email', '$username', '$password')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Registration successful!');</script>";
        } else {
            echo "<script>alert('Error: " . $conn->error . "');</script>";
        }
    } else {
        echo "<script>alert('Passwords do not match!');</script>";
    }
}

$conn->close();
?>
