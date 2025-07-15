<?php include 'fetch_ipl_data.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>IPL Points Table</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f1f3f6;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 30px auto;
            background: white;
            border-radius: 12px;
            overflow: hidden;
        }
        th, td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }
        th {
            background: #333;
            color: white;
        }
        .logo {
            width: 30px;
        }
        .recent-form span {
            display: inline-block;
            width: 25px;
            height: 25px;
            line-height: 25px;
            border-radius: 50%;
            margin: 2px;
            font-weight: bold;
        }
        .win {
            background-color: #c8e6c9;
            color: green;
        }
        .lose {
            background-color: #ffcdd2;
            color: red;
        }
    </style>
</head>
<body>

<h2 style="text-align:center;">IPL Points Table</h2>

<table>
    <tr>
        <th>Pos</th>
        <th>Team</th>
        <th>P</th>
        <th>W</th>
        <th>L</th>
        <th>NR</th>
        <th>NRR</th>
        <th>For</th>
        <th>Against</th>
        <th>Pts</th>
        <th>Recent Form</th>
    </tr>

    <?php
    $position = 1;
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>$position</td>";
        echo "<td><img src='images/{$row['logo']}' class='logo'> </td>";
        echo "<td>{$row['played']}</td>";
        echo "<td>{$row['won']}</td>";
        echo "<td>{$row['lost']}</td>";
        echo "<td>{$row['nr']}</td>";
        echo "<td>{$row['nrr']}</td>";
        echo "<td>{$row['for_score']}</td>";
        echo "<td>{$row['against_score']}</td>";
        echo "<td>{$row['points']}</td>";
        echo "<td class='recent-form'>";
        $form = str_split($row['recent_form']);
        foreach ($form as $f) {
            $class = $f == 'W' ? 'win' : 'lose';
            echo "<span class='$class'>$f</span>";
        }
        echo "</td>";
        echo "</tr>";
        $position++;
    }
    ?>
</table>

</body>
</html>
