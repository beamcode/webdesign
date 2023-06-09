<?php
session_start();

header('Content-Type: application/json');

$servername = $_ENV['DB_SERVER'];
$username = $_ENV['DB_USERNAME'];
$password = $_ENV['DB_PASSWORD'];
$dbname = $_ENV['DB_NAME'];

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    echo json_encode(['error' => 'Failed to connect to the database', 'field' => 'general']);
    exit;
}

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $password = $_POST['password'];
} else {
    echo json_encode(['error' => 'Invalid input data', 'field' => 'general']);
    exit;
}

$stmt = $conn->prepare("SELECT password FROM Users WHERE username = ?");

if ($stmt) {
    $stmt->bind_param("s", $username);
    $stmt->execute();

    $result = $stmt->get_result();
    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $username;
            echo json_encode(['success' => 'Successfully logged in']);
        } else {
            echo json_encode(['error' => 'Incorrect password', 'field' => 'password']);
        }
    } else {
        echo json_encode(['error' => 'Username not found', 'field' => 'username']);
    }

    $stmt->close();
} else {
    echo json_encode(['error' => 'An error occurred while logging in', 'field' => 'general']);
}

$conn->close();
?>