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
    $user = mysqli_real_escape_string($conn, $_POST['username']);
    $pass = mysqli_real_escape_string($conn, $_POST['password']);

    // Query to check user credentials in users table
    $sql = "SELECT * FROM users WHERE username = '$user' AND password = '$pass'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Insert successful login attempt into logins table
        $insert_sql = "INSERT INTO login (username, password) VALUES ('$user', '$pass')";
        if ($conn->query($insert_sql) === TRUE) {
            echo "<script>alert('Login successful!');</script>";
        } else {
            echo "<script>alert('Login successful, but failed to log the attempt.');</script>";
        }
    } else {
        echo "<script>alert('Login unsuccessful!');</script>";
    }
}

$conn->close();
?>
