<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sample";

// Create DB connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all matches
$sql = "SELECT * FROM ipl_matches ORDER BY match_date, match_time";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>IPL 2025 Match Schedule</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f8f9fa;
            margin: 0;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        h1 {
            font-weight: bold;
            text-align: center;
        }
        .match {
            width: 80%;
            max-width: 700px;
            border-left: 4px solid orange;
            margin: 20px 0;
            background: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.08);
            padding: 20px;
            border-radius: 10px;
        }
        .match-date {
            color: #555;
            font-size: 14px;
            margin-bottom: 10px;
        }
        .match-date span.match-type {
            color: orange;
            font-weight: bold;
            margin-left: 10px;
        }
        .match-details {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .teams {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
        }
        .teams .team {
            display: flex;
            align-items: center;
        }
        .teams .team.reverse {
            flex-direction: row-reverse;
        }
        .teams img {
            width: 50px;
            height: 50px;
        }
        .vs {
            font-size: 18px;
            font-weight: bold;
            color: #222;
            margin: 0 10px;
        }
        .team span {
            font-weight: 600;
        }
        .result {
            margin-top: 12px;
            color: green;
            font-weight: bold;
            font-size: 15px;
        }
    </style>
</head>
<body>
    <h1>IPL 2025 Match Schedule</h1>

    <?php if ($result->num_rows > 0): ?>
        <?php while($row = $result->fetch_assoc()): ?>
            <div class="match">
                <div class="match-date">
                    <strong>Match <?= htmlspecialchars($row['match_number']) ?></strong>
                    <?php if (!empty($row['match_type'])): ?>
                        <span class="match-type">(<?= htmlspecialchars($row['match_type']) ?>)</span>
                    <?php endif; ?>
                    <br><?= date('D, M j', strtotime($row['match_date'])) ?> at <?= date('g:i A', strtotime($row['match_time'])) ?>
                    <br><?= htmlspecialchars($row['stadium']) ?>
                </div>
                <div class="match-details">
                    <div class="teams">
                        <div class="team">
                            <img src="images/<?= htmlspecialchars($row['logo1']) ?>" alt="<?= htmlspecialchars($row['team1']) ?>">
                            <span style="margin-left: 8px;"><?= htmlspecialchars($row['team1']) ?></span>
                        </div>
                        <div class="vs">vs</div>
                        <div class="team reverse">
                            <img src="images/<?= htmlspecialchars($row['logo2']) ?>" alt="<?= htmlspecialchars($row['team2']) ?>">
                            <span style="margin-right: 8px;"><?= htmlspecialchars($row['team2']) ?></span>
                        </div>
                    </div>
                </div>

                <?php if (!empty($row['result'])): ?>
                    <div class="result">🏆 Result: <?= htmlspecialchars($row['result']) ?></div>
                <?php endif; ?>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No matches found.</p>
    <?php endif; ?>

</body>
</html>

<?php $conn->close(); ?>
