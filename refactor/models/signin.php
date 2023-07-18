<?php
require_once 'database.php';
require_once 'ExceptionWithField.php';
header('Content-Type: application/json');

try {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = filter_var($_POST['username']);
        $password = $_POST['password'];

        // Backup point
        $db->begin_transaction();
        $stmt = $db->prepare("SELECT id, password FROM Users WHERE username = ?");
        if (!$stmt) {
            throw new Exception('An error occurred while signing in...');
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
        $db->commit();
        $_SESSION['user_id'] = $row['id'];
        echo json_encode(['success' => 'Successfully signed in']);
    } else {
        throw new Exception('Invalid input data');
    }
} catch (ExceptionWithField $e) {
    // Return to backup point
    $db->rollback();
    echo json_encode(['error' => $e->getMessage(), 'field' => $e->getField()]);
} catch (Exception $e) {
    // Return to backup point
    $db->rollback();
    echo json_encode(['error' => $e->getMessage()]);
} finally {
    if (isset($db)) {
        $db->close();
    }
    if (isset($stmt)) {
        $stmt->close();
    }
}
