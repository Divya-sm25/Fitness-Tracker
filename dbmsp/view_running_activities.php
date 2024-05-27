<?php
session_start();
// Include the file containing the viewhealthy_foods function
require_once 'fitnesstracker.php';

// Assuming $conn is already established in fitnesstracker.php or included before this point
$username = $_SESSION['username'];
// Call the viewhealthy_foods function
$view_running_activities = viewRunningActivities($conn, $username);
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
    <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <title>Running Activities</title>
    <style>
        body {
            font-family: 'Rajdhani', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        h2 {
            text-align: center;
            margin-top: 20px;
            font-weight: 600;
            color: #415a77;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            padding: 8px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        a {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #e0e1dd;
            color: black;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            text-align: center;
        }

        a:hover {
            background-color: #c2c3bf;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Running Activities for User: <?php echo $username; ?></h2>
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Duration (min)</th>
                    <th>Distance (km)</th>
                </tr>
            </thead>
            <tbody>
                <?php echo $view_running_activities; ?>
            </tbody>
        </table>
        <a href="Menu.html">Back to Main Menu</a>
    </div>
</body>
</html>
