<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INDIAN PREMIER LEAGUE</title>
    <style>
        /* Your existing styles */
    </style>
</head>
<body>
    <header class="navbar">
        <div class="logo">IPL</div>
        <nav class="nav-items">
            <a href="teams.html">Teams</a>
            <a href="http://localhost/H2_PROJECT/points_table/points_table.php">Points Table</a>
            <a href="http://localhost/H2_PROJECT/ipl_matches/index.php">Matches</a>
            <a href="#">News</a>
            <a href="login.php">Sign out</a>  <!-- Add Sign-out link -->
        </nav>
        <input type="text" placeholder="Search..." class="search-bar">
    </header>

    <!-- Welcome message for the signed-in user -->
    <div class="welcome-message">
        <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
    </div>

    <!-- Rest of your page content -->
    <div class="image-row">
        <!-- Your existing content -->
    </div>

    <footer class="footer">
        <!-- Your existing footer -->
    </footer>

</body>
</html>
