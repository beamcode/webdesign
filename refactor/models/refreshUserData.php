<?php
require_once 'database.php';
require_once 'ExceptionWithField.php';

function refreshUserData($userId)
{
    global $db;
    try {
        $stmt = $db->prepare("SELECT id, username, description, highscore, profile_image, banner_image, friends_ids FROM Users WHERE id = ?");
        if (!$stmt) {
            throw new Exception('An error occurred while preparing the SQL statement');
        }

        $stmt->bind_param("i", $userId);
        $stmt->execute();

        $result = $stmt->get_result();
        if (!$result) {
            throw new Exception('An error occurred while executing the SQL statement');
        }

        $userData = $result->fetch_assoc();
        $stmt->close();

        $_SESSION['user_info'] = $userData;
    } catch (Exception $e) {
        $error = array('error' => $e->getMessage());
        echo json_encode($error);
    }
}
