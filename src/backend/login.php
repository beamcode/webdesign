<?php
require 'connectDB.php';
require 'ExceptionWithField.php';
session_start();
header('Content-Type: application/json');
try {
    $conn = connectToDatabase();
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = filter_var($_POST['username']);
        $password = $_POST['password'];

        // Backup point
        $conn->begin_transaction();
        $stmt = $conn->prepare("SELECT id, password FROM Users WHERE username = ?");
        if (!$stmt) {
            throw new Exception('An error occurred while logging in');
        }
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows !== 1) {
            throw new ExceptionWithField('Username not found', 'username');
        }
        $row = $result->fetch_assoc();
        if (!password_verify($password, $row['password'])) {
            throw new ExceptionWithField('Incorrect password', 'password');
        }
        // Final backup of the user in the database (loss of backup point)
        $conn->commit();
        $_SESSION['user_id'] = $row['id'];
        echo json_encode(['success' => 'Successfully logged in']);
    } else {
        throw new Exception('Invalid input data');
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
