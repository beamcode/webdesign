<?php

require 'connectToDatabase.php';
require 'ExceptionWithField.php';

session_start();

header('Content-Type: application/json');

try {
    $conn = connectToDatabase();

    if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['confirm_password'])) {
        $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        // Backup point
        $conn->begin_transaction();

        formValidator($username, $password, $confirm_password);

        if (userExists($conn, $username)) {
            throw new ExceptionWithField('Username already exists', 'username');
        }

        createUser($conn, $username, $password);

        // Final backup of the user in the database (loss of backup point)
        $conn->commit();

        echo json_encode(['success' => 'Registration successful']);
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
}

function formValidator($username, $password, $confirm_password) {
    // Check the username
    if (strlen($username) < 3 || strlen($username) > 30) {
        throw new ExceptionWithField('Username must be between 3 and 30 characters', 'username');
    }

    // Check the password
    if (strlen($password) < 8 ||
        !preg_match('/[a-z]/', $password) ||
        !preg_match('/[A-Z]/', $password) ||
        !preg_match('/\d/', $password) ||
        !preg_match('/[!@#$%^&*()_+\-=\[\]{};\':"\\|,.<>\/?]+/', $password)
    ) {
        throw new ExceptionWithField('Password must be at least 8 characters long and contain at least one lowercase letter, one uppercase letter, one number, and one special character (@$!%*#?&)', 'password');
    }

    // Check if the two passwords match
    if ($password !== $confirm_password) {
        throw new ExceptionWithField('Passwords do not match', 'confirm_password');
    }
}

function userExists($conn, $username) {
    $stmt = $conn->prepare("SELECT * FROM Users WHERE username = ?");

    if (!$stmt) {
        throw new Exception('Failed to verify if user exists');
    }

    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $exists = $result->num_rows > 0;
    $stmt->close();
    return $exists;
}

function createUser($conn, $username, $password) {
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    $stmt = $conn->prepare("INSERT INTO Users (username, password) VALUES (?, ?)");

    if (!$stmt) {
        throw new Exception('Failed to prepare user creation');
    }

    $stmt->bind_param("ss", $username, $hashed_password);
    $stmt->execute();
    $stmt->close();
}
?>