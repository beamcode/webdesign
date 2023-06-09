<?php
require 'connectToDatabase.php';
require 'ExceptionWithField.php';
session_start();
// Function to get all messages from the database
function getMessages($conn)
{
    $sql = "SELECT ChatMessages.id AS messageId, ChatMessages.message, Users.username, Users.profile_image 
        FROM ChatMessages 
        INNER JOIN Users ON ChatMessages.user_id = Users.id
        ORDER BY ChatMessages.timestamp DESC
        LIMIT 30";

    $result = $conn->query($sql);

    if ($result) {
        $data = $result->fetch_all(MYSQLI_ASSOC);
        $result->free_result();
        return $data;
    } else {
        // Error occurred while executing the query
        // Handle the error appropriately (e.g., return an error message or log the error)
        error_log("Database error: " . $conn->error);
        return null;
    }
}
// Function to save a new message to the database
function saveMessage($userId, $message, $conn)
{
    $stmt = $conn->prepare("INSERT INTO ChatMessages (user_id, timestamp, message) VALUES (?, CURRENT_TIMESTAMP(), ?)");
    $stmt->bind_param("is", $userId, $message);
    if ($stmt->execute()) {
        // Message saved successfully
        $stmt->close();
        return true;
    } else {
        // Error occurred while saving the message
        error_log("fuck");
        $stmt->close();
        return false;
    }
}
// Establishing connection
try {
    $conn = connectToDatabase();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get the form field values
        $userId = $_SESSION["user_id"];
        $message = $_POST["message"];
        $responseCode = 500;

        // Save the message to the database
        $saveResult = saveMessage($userId, $message, $conn);

        if ($saveResult) {
            // Message saved successfully
            $response = [
                "status" => "success",
                "message" => "Data saved successfully"
            ];
            $responseCode = 200;
        } else {
            // Error occurred while saving the message
            $response = [
                "status" => "error",
                "message" => "Error occurred while saving the data"
            ];
        }

        // Send the response as JSON
        http_response_code($responseCode);
        header("Content-Type: application/json");
        echo json_encode($response);

        // Debug
        // file_put_contents("post_data.txt", "");
        // file_put_contents("post_data.txt", json_encode($response));
    }

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        // Fetch messages from the database
        $data = getMessages($conn);

        $responseCode = 500;

        // Check if any messages were fetched
        // $fileContents = json_encode($data);
        // file_put_contents("message.txt", $fileContents);
        if (!empty($data)) {
            $responseCode = 200;
            $response = $data;
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
    // Return to backup point
    // $conn->rollback();
    echo json_encode(['error' => $e->getMessage(), 'field' => $e->getField()]);
} catch (Exception $e) {
    // Return to backup point
    // $conn->rollback();
    echo json_encode(['error' => $e->getMessage()]);
} finally {
    if (isset($conn)) {
        $conn->close();
    }
}
