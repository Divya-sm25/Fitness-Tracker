<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <title>Healthy Foods</title>
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
        }

        .food-list {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .food-item {
            display: flex;
            margin-bottom: 10px;
            background-color: #fff; /* Each food item has a white background */
            border-radius: 5px;
            overflow: hidden;
        }

        .food-item > div {
            flex: 1;
            padding: 10px;
        }

        .food-item > div:nth-child(n+2) {
            background-color: #f9f9f9; /* Other columns have a slightly different background */
        }

        a {
            display: block;
            text-align: center;
            margin-top: 20px;
            text-decoration: none;
            color: #333;
        }

        a:hover {
            color: #666;
        }
        .food-table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}

.food-table th, .food-table td {
    padding: 10px 15px; /* Adjust the padding to increase space between columns */
    border-bottom: 1px solid #ddd;
    text-align: left;
}

.food-table th {
    background-color: #f2f2f2;
}

    </style>
</head>
<body>
    <h2>Healthy Foods</h2>
    <div class="food-list">
        <?php
        // Include the file containing the viewhealthy_foods function
        require_once 'fitnesstracker.php';

        // Assuming $conn is already established in fitnesstracker.php or included before this point

        // Call the viewhealthy_foods function
        viewhealthy_foods($conn);
        ?>
    </div>
    <a href="Menu.html">Back to Main Menu</a>
</body>
</html>
