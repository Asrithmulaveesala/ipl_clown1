<?php
// Database connection
$servername = "localhost";
$username = "root";     // Change if your DB username is different
$password = "";         // Change if your DB password is set
$database = "studentdb";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $student_name = $_POST['student_name'];
    $subject = $_POST['subject'];
    $marks = $_POST['marks'];

    // Insert data into database
    $sql = "INSERT INTO student_marks (student_name, subject, marks) 
            VALUES ('$student_name', '$subject', '$marks')";

    if ($conn->query($sql) === TRUE) {
        $message = "Data saved successfully!";
    } else {
        $message = "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Marks Entry</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f1f1f1;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .form-container {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0,0,0,0.2);
            width: 400px;
        }
        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        input, select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        .message {
            text-align: center;
            color: green;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Student Marks Entry</h2>
    <form action="" method="POST">
        <input type="text" name="student_name" placeholder="Student Name" required>
        
        <select name="subject" required>
            <option value="">Select Subject</option>
            <option value="Mathematics">Mathematics</option>
            <option value="Science">Science</option>
            <option value="English">English</option>
            <option value="History">History</option>
            <option value="Geography">Geography</option>
        </select>
        
        <input type="number" name="marks" placeholder="Marks" min="0" max="100" required>
        
        <button type="submit">Submit</button>
    </form>

    <?php if (isset($message)) { ?>
        <div class="message"><?php echo $message; ?></div>
    <?php } ?>
</div>

</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
