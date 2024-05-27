<?php
session_start();
// Include the file containing the necessary functions
require_once 'fitnesstracker.php';

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve username and password from the form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if the username is available
    if (isUsernameAvailable($conn, $username)) {
        // Register the new user
        registerUser($conn, $username, $password);
        $_SESSION['username'] = $username;
        // Redirect the user to a logged-in page
        header("Location: Menu.html");
        exit();
    } else {
        // Display an error message if the username is already taken
        $error_message = "Username already exists. Please choose a different username.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <!-- Link to the external CSS file -->
    <link rel="stylesheet" type="text/css" href="styles.css">
    <style>body{
        background-image: url('fit.jpg'); /* Replace 'background-image.jpg' with the path to your image */
    background-size: cover; /* Cover the entire background */
    background-position: center;
    }</style>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Tilt+Neon&display=swap" rel="stylesheet">
</head>
<body>
    <h1 class='tilt-neon-he'> FitSync</h1>
    <?php if(isset($error_message)) echo '<p class="error-message">' . $error_message . '</p>'; ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <input type="submit" value="Register">
    </form>
</body>
</html>
