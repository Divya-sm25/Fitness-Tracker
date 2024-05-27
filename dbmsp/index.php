<?php
session_start();
// Include the file containing the loginUser function
require_once 'fitnesstracker.php';

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve username and password from the form
    $username = $_POST['username'];
    $password = $_POST['password'];
    $action = $_POST['action']; // Added to differentiate between login and register actions

    // Check if it's a new user registration or login for an existing user
    if ($action === 'login') {
        // Call the loginUser function to authenticate user
        $isLoggedIn = loginUser($conn, $username, $password);

        // Check if the user is authenticated
        if ($isLoggedIn) {
            $_SESSION['username'] = $username;
            // Redirect the user to a logged-in page
            header("Location: Menu.html");
            exit();
        } else {
            // Display an error message if authentication fails
            $error_message = "Invalid username or password. Please try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login or Register</title>
    <!-- Link to the external CSS file -->
    <link rel="stylesheet" type="text/css" href="styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <style>body {
         background-image: url('fit.jpg'); /* Replace 'fit.jpg' with the path to your image */
    background-size: cover; /* Cover the entire background */
    font-family: 'Roboto', sans-serif;

    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center; 
    align-items: center;
    height: 100vh;
    color: #ffffff; /* White text for contrast */
}

.container {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
}

form {
    background-color: rgba(255, 255, 255, 0.1); /* Slightly opaque background */
    padding: 40px 60px; /* Adjusted padding for better spacing */
    border-radius: 15px; /* More rounded corners */
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5); /* Deeper shadow for more depth */
    max-width: 400px;
    width: 100%;
    backdrop-filter: blur(10px); /* Blur effect for a modern look */
    margin-top: 20px;
}

h1 {
    font-family: 'Tilt Neon', cursive;
    font-size: 2.5em; /* Larger font size for the heading */
    margin-bottom: 30px; /* Increased margin for better spacing */
}

label {
    display: block;
    margin-bottom: 8px;
    font-weight: bold; /* Bold labels for better readability */
}

input[type="text"],
input[type="password"] {
    width: calc(100% - 20px);
    padding: 12px;
    margin-bottom: 20px; 
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 1em; /* Increased font size */
    background: rgba(255, 255, 255, 0.2); /* Semi-transparent input background */
    color: #fff;
}

input[type="text"]::placeholder,
input[type="password"]::placeholder {
    color: #ddd; /* Placeholder color */
}

input[type="submit"] {
    width: calc(100% - 20px);
    padding: 12px;
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s, transform 0.3s; /* Added transition for transform */
    font-size: 1em; /* Increased font size */
}

input[type="submit"]:hover {
    background-color: #45a049;
    transform: scale(1.05); /* Slightly enlarge on hover */
}

.error-message {
    color: red;
    margin-bottom: 10px;
    font-weight: bold; /* Bold for emphasis */
}

p {
    text-align: center;
    margin-top: 20px;
}

a {
    color: #00bfff; /* Light blue color for links */
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
}

/* Add custom font style */
@import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Tilt+Neon&display=swap');

h1.tilt-neon-he {
    font-family: 'Tilt Neon', cursive;
    color: #00e6e6;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.6); /* Neon effect */
}

</style>
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Tilt+Neon&display=swap" rel="stylesheet">
</head>
<body>
    <h1 class='tilt-neon-he'>Fitness Tracker   -</h1>
    <?php if(isset($error_message)) echo '<p class="error-message">' . $error_message . '</p>'; ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <input type="hidden" name="action" value="login">

        <input type="submit" value="Login">

        <p>New user? <a href="register.php">Register here</a></p>
    </form>
</body>
</html>

