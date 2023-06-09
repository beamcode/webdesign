<?php
$servername = "db";
$username = "user";
$password = "pwd";
$dbname = "db";

// Création de la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = $_POST['username'];
$password = $_POST['password'];

// Hashage du mot de passe
$hashed_password = password_hash($password, PASSWORD_BCRYPT);

$stmt = $conn->prepare("INSERT INTO Users (username, password) VALUES (?, ?)");
$stmt->bind_param("ss", $username, $hashed_password);

$stmt->execute();

$stmt->close();
$conn->close();

echo "Inscription réussie!";
?>
