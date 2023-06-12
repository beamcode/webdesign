<?php

require 'connectToDatabase.php';
require 'ExceptionWithField.php';


// Function to get all messages from the database
function getMessages()
{
    global $conn;
    $sql = "SELECT * FROM ChatMessages";
    $result = $conn->query($sql);

    if ($result) {
        $messages = $result->fetch_all(MYSQLI_ASSOC);
        $result->close();
        return $messages;
    } else {
        // Error occurred while fetching messages
        return [];
    }
}

// Function to save a new message to the database
function saveMessage($userId, $message)
{
    global $conn;
    $stmt = $conn->prepare("INSERT INTO ChatMessages (user_id, message) VALUES (?, ?)");
    $stmt->bind_param("is", $userId, $message);

    if ($stmt->execute()) {
        // Message saved successfully
        $stmt->close();
        return true;
    } else {
        // Error occurred while saving the message
        $stmt->close();
        return false;
    }
}

// Establishing connection
try {
    $conn = connectToDatabase();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get the form field values
        $userId = $_POST["userId"];
        $message = $_POST["message"];
        $responseCode = 500;
    
        // Save the message to the database
        $saveResult = saveMessage($userId, $message);
    
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
        $messages = getMessages();
        $responseCode = 500;
    
        // Check if any messages were fetched
        if (!empty($messages)) {
    
            $responseCode = 200;
            $response = $messages;
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
    $conn->rollback();
    echo json_encode(['error' => $e->getMessage(), 'field' => $e->getField()]);
} catch (Exception $e) {
    // Return to backup point
    $conn->rollback();
    echo json_encode(['error' => $e->getMessage()]);
} finally {
    if (isset($conn)) {
        $conn->close();
    }
    if (isset($stmt)) {
        $stmt->close();
    }
}

?>
