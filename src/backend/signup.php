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

if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['confirm_password'])) {
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
} else {
    echo json_encode(['error' => 'Invalid input data', 'field' => 'general']);
    exit;
}

if ($password !== $confirm_password) {
    echo json_encode(['error' => 'Passwords do not match', 'field' => 'confirm_password']);
    exit;
}

$hashed_password = password_hash($password, PASSWORD_BCRYPT);

$stmt = $conn->prepare("INSERT INTO Users (username, password) VALUES (?, ?)");

if ($stmt) {
    $stmt->bind_param("ss", $username, $hashed_password);
    $stmt->execute();
    $stmt->close();
    echo json_encode(['success' => 'Registration successful']);
} else {
    echo json_encode(['error' => 'An error occurred during registration', 'field' => 'general']);
}

$conn->close();
?>