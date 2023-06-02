<?php
$servername = 'db';  // Nom de votre service db dans docker-compose.yml
$username = 'user';  // MYSQL_USER
$password = 'pwd';  // MYSQL_PASSWORD
$database = 'db';  // MYSQL_DATABASE

// Créer la connexion à la base de données
$conn = new mysqli($servername, $username, $password, $database);

// Vérifier la connexion
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Récupérer l'ID de l'utilisateur à partir de la requête GET
$id = $_GET['id'];

// Préparer la requête SQL pour obtenir les informations de l'utilisateur
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param("i", $id);

// Exécuter la requête et récupérer le résultat
$stmt->execute();
$result = $stmt->get_result();

// Vérifier si l'utilisateur existe
if ($result->num_rows > 0) {
  // Récupérer les informations de l'utilisateur
  $user = $result->fetch_assoc();
  
  echo "<h1>Profile of " . $user['username'] . "</h1>";
  echo "<p>Email: " . $user['email'] . "</p>";
  echo "<img src='" . $user['profile_picture'] . "' alt='Profile Picture'>";
} else {
  echo "User with ID $id does not exist.";
}

// Fermer la connexion
$conn->close();
?>