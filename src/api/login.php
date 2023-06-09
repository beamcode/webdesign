<?php
session_start();

$host = "db";
$db = "db";
$user = "user";
$pass = "pwd";

// Crée une nouvelle connexion à la base de données
$pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupère les valeurs du formulaire
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Sélectionne l'utilisateur de la base de données
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);

    if ($stmt->rowCount() == 1) {
        // L'utilisateur existe
        $user = $stmt->fetch();

        // Vérifie le mot de passe
        if (password_verify($password, $user['password'])) {
            // Le mot de passe est correct, crée la session
            $_SESSION['username'] = $username;
            echo "Vous êtes connecté en tant que $username";
        } else {
            echo "Mot de passe incorrect";
        }
    } else {
        echo "Nom d'utilisateur inconnu";
    }
}
?>