<?php
session_start();
// Include the file containing the logRunning function
require_once 'fitnesstracker.php';


    // Call logRunning function
    logFoodIntake($conn);

?>

<!DOCTYPE html>
<html>
<head>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Rajdhani', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
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
        input[type="text"],
        input[type="number"],
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
        .food-calories {
        margin-top: 20px;
        padding: 10px;
        background-color: #d4edda;
        color: black;
        border: 1px solid #c3e6cb;
        border-radius: 5px;
        text-align: center;
    }

    .total-calories {
        margin-top: 10px;
        padding: 10px;
        background-color: #d1ecf1;
        color: black;
        border: 1px solid #bee5eb;
        border-radius: 5px;
        text-align: center;
    }

    .error {
        margin-top: 20px;
        padding: 10px;
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
        border-radius: 5px;
        text-align: center;
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
    <h1>Log your food intake to calculate total calories</h1>
    <form method="post">
        <label for="foodOption">Food Option:</label>
        <input type="text" id="foodOption" name="foodOption"><br>
        <label for="amount">Amount (in grams):</label>
        <input type="number" id="amount" name="amount"><br>
        <input type="submit" name="submit" value="Log Food Intake">
        <input type="submit" name="done" value="Done">
        <?php include 'show_healthy_food.php'; ?>
    </form>
    
</body>
</html>
