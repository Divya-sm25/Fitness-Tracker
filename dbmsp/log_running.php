<?php
session_start();
// Include the file containing the logRunning function
require_once 'fitnesstracker.php';


// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_SESSION['username'];
    $date = $_POST['date'];
    $duration = $_POST['duration'];
    $distance = $_POST['distance'];
    $weightInKg = $_POST['weight'];

    
    // Call logRunning function
    logRunning($conn, $username, $date, $duration, $distance, $weightInKg);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log Running Activity</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Rajdhani', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            font-size: 22px;
        }

        h1 {
            text-align: center;
            margin-top: 20px;
            font-weight: 600;
            color: #415a77;
        }

        form {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: #415a77;
        }

        input[type="date"],
        input[type="number"],
        input[type="radio"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #415a77;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #31455e;
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
        .log-message {
            font-size: 50px;
    background-color: #f2f2f2;
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 10px;
    margin-top: 20px; /* Add margin to separate from other content */
}

.log-message p {
    margin: 0; /* Remove default paragraph margins */
}

.log-message strong {
    font-weight: bold;
}
header {
    background-color: #415a77;
    color: white;
    padding: 10px 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

header h1 {
    margin: 0;
    font-weight: 600;
    color:white;
}

nav {
    display: flex;
    align-items: center; /* Align items vertically */
}

nav a {
    color: black;
    text-decoration: none;
    margin-left: 20px;
}

nav a:hover {
    text-decoration: underline;
}

    </style>
    
</head>
<body>
<header>
        <h1>FitSync</h1>
        <nav>
            <a href="home.html">Home</a>
            <a href="about.html">About</a>
            <a href="menu.html">Menu</a>
            <a href="contact.html">Contact</a>
            <a href="index.php">Login</a>
        </nav>
    </header>
    <h1 class="rajdhani-semibold">ADD JOGGING ACTIVITY</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label for="date">Date:</label><br>
        <input type="date" id="date" name="date" required><br>
        <label for="duration">Duration (minutes):</label><br>
        <input type="number" id="duration" name="duration" required><br>
        <label for="distance">Distance (km):</label><br>
        <input type="number" id="distance" name="distance" step="0.01" required><br>
        <label for="weight">Weight (kg):</label><br>
        <input type="number" id="weight" name="weight" step="0.01" required><br><br>
        <input type="submit" value="Log Activity">
        <a href="Menu.html">Back to Main Menu</a>
    </form>
 
</body>
</html>
