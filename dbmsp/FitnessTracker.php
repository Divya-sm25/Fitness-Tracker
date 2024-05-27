<?php
include 'dp.php';

function loginUser($conn, $username, $password) {
    $query = "SELECT * FROM users WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->num_rows > 0;
}

function isUsernameAvailable($conn, $username) {
    $query = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->num_rows == 0;
}

function registerUser($conn, $username, $password) {
    $query = "INSERT INTO users (username, password) VALUES (?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
}

function logRunning($conn, $username, $date, $duration, $distance, $weightInKg) {
    try {
        $MET_RUNNING = 7.0;
        $caloriesBurned = $MET_RUNNING * $weightInKg * ($duration / 60.0);

        $insertSQL = "INSERT INTO running_activities (username, date, duration, distance, caloriesBurned) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($insertSQL);
        $stmt->bind_param("ssddd", $username, $date, $duration, $distance, $caloriesBurned);
        $stmt->execute();

        echo '<div class="log-message">';
        echo '<p>Jogging activity logged.</p>';
        echo '<p><strong>Calories burned:</strong> ' . number_format($caloriesBurned, 2) . '</p>';
        echo '</div>';

    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}

function logWeightlifting($conn, $username, $date, $duration, $weight, $gender, $weightInKg) {
    try {
        if ($gender == 'm') {
            $caloriesBurned = 0.0713 * $weightInKg * $duration;
        } else {
            $caloriesBurned = 0.0637 * $weightInKg * $duration;
        }

        $insertSQL = "INSERT INTO weightlifting_activities (username, date, duration, weight, caloriesBurned) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($insertSQL);
        $stmt->bind_param("ssddd", $username, $date, $duration, $weight, $caloriesBurned);
        $stmt->execute();

        echo '<div class="log-message">';
        echo '<p>Weightlifting activity logged.</p>';
        echo '<p><strong>Calories burned:</strong> ' . number_format($caloriesBurned, 2) . '</p>';
        echo '</div>';

    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}


function viewhealthy_foods($conn) {
    $query = "SELECT * FROM healthy_foods";
    $result = $conn->query($query);
    
    if ($result->num_rows > 0) {
        echo "<table class='food-table'>";
        echo "<tr><th>Healthy Food</th><th>Amount</th><th>Amount in Grams</th><th>Calories</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["Healthy_Foods"] . "</td>";
            echo "<td>" . $row["amount"] . "</td>";
            echo "<td>" . $row["amountin_grams"] . "</td>";
            echo "<td>" . $row["Calories"] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No healthy foods found";
    }
}



function getCaloriesForFoodOption($conn, $foodOption) {
    $query = "SELECT Calories, amountin_grams FROM healthy_foods WHERE Healthy_Foods = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $foodOption);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row["Calories"] / $row["amountin_grams"];
    } else {
        return 0;
    }
}




function logFoodIntake($conn) {
    try {
        // Start or resume the session
        

        // Initialize total calories if it doesn't exist in the session
        if (!isset($_SESSION['totalCalories'])) {
            $_SESSION['totalCalories'] = 0.0;
        }

        if (isset($_POST['done'])) {
            
            if (isset($_SESSION['totalCalories'])) {
                unset($_SESSION['totalCalories']);
            }

            header("Location: Menu.html");
            exit();
        }

       
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
            $foodOption = $_POST['foodOption'];
            $amount = (double)$_POST['amount'];

            $caloriesPerGram = getCaloriesForFoodOption($conn, $foodOption);

            if ($caloriesPerGram > 0) {
                $foodCalories = $caloriesPerGram * $amount;
                $_SESSION['totalCalories'] += $foodCalories;
                echo "<div class='food-calories'>Calories for $foodOption: $foodCalories</div>";
            } else {
                echo "<div class='error'>Food option not found in the database.</div>";
            }

            echo "<div class='total-calories'>Total Calories for the Meal: " . number_format($_SESSION['totalCalories'], 2) . "</div>";
        }

        


    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}




function viewRunningActivities($conn, $username) {
    try {
        $query = "SELECT date, duration, distance FROM running_activities WHERE username = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        $output = '';

        while ($row = $result->fetch_assoc()) {
            $output .= '<tr>';
            $output .= '<td>' . $row["date"] . '</td>';
            $output .= '<td>' . $row["duration"] . '</td>';
            $output .= '<td>' . $row["distance"] . '</td>';
            $output .= '</tr>';
        }

        return $output;

    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}

function viewWeightliftingActivities($conn, $username) {
    try {
        $query = "SELECT date, duration, weight FROM weightlifting_activities WHERE username = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        $output = '';

        while ($row = $result->fetch_assoc()) {
            $output .= '<tr>';
            $output .= '<td>' . $row["date"] . '</td>';
            $output .= '<td>' . $row["duration"] . '</td>';
            $output .= '<td>' . $row["weight"] . '</td>';
            $output .= '</tr>';
        }

        return $output;

    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}

?>
