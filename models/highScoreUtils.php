<?php
session_start();
require 'database.php';
require 'ExceptionWithField.php';

function setHighScore($connection, $userId, $score)
{
    // Retrieve the current high score from the database
    $query = "SELECT highscore FROM Users WHERE id = ?";
    $statement = mysqli_prepare($connection, $query);

    if ($statement) {
        mysqli_stmt_bind_param($statement, "i", $userId);
        mysqli_stmt_execute($statement);
        mysqli_stmt_bind_result($statement, $currentHighScore);
        mysqli_stmt_fetch($statement);
        mysqli_stmt_close($statement);

        // Compare the current high score with the new score
        if ($score <= $currentHighScore) {
            return false; // New score is not higher, no update needed
        }
    } else {
        return false; // Failed to fetch current high score
    }

    // Prepare the query with parameter placeholders
    $query = "UPDATE Users SET highscore = ? WHERE id = ?";
    $statement = mysqli_prepare($connection, $query);

    if ($statement) {
        // Bind the parameter values to the statement
        mysqli_stmt_bind_param($statement, "ii", $score, $userId);

        // Execute the statement
        if (mysqli_stmt_execute($statement)) {
            mysqli_stmt_close($statement);
            return true; // High score updated successfully
        }
    }

    return false; // Failed to update high score
}

function getHighScore($connection, $userId)
{
    $sql = "SELECT highscore FROM Users WHERE id = ?";
    $stmt = $connection->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $highscore = $row['highscore'];
            $result->free_result();
            $stmt->close();
            return $highscore;
        }
    }

    return false; // User not found or high score not available    
}

// Establishing connection
try {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // // Get the form field values
        $userId = $_SESSION["user_id"];
        $score = $_POST["highScore"];
        $responseCode = 200;

        if (setHighScore($db, $userId, $score)) {
            $responseCode = 200;
            $response = [
                "status" => "success",
                "message" => "All good bob"
            ];
        } else {
            // Error occurred while fetching messages
            $response = [
                "status" => "error",
                "message" => "Error occurred while setting the data in the database"
            ];
        }

        http_response_code($responseCode);
        header("Content-Type: application/json");
        echo json_encode($response);
    }

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        // Fetch messages from the database
        $userId = $_SESSION["user_id"];
        $responseCode = 500;
        $hightscore = getHighScore($db, $userId);

        if ($hightscore) {
            $responseCode = 200;
            $response = [
                "status" => "success",
                "user_id" => $_SESSION["user_id"],
                "highscore" => $hightscore
            ];
        } else {
            // Error occurred while fetching messages
            $response = [
                "status" => "error",
                "message" => "Error occurred while fetching the data from the database"
            ];
        }

        // Send the messages as JSON
        http_response_code($responseCode);
        header("Content-Type: application/json");
        echo json_encode($response);
    }
} catch (ExceptionWithField $e) {
    echo json_encode(['error' => $e->getMessage(), 'field' => $e->getField()]);
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
} finally {
    if (isset($db)) {
        $db->close();
    }
}
