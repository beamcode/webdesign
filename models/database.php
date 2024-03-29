<?php

// SIT
$servername = "172.21.82.208";
$dbport = 3306;
$username = "finalteam3";
$password = "VnOXNVZv6M";
$dbname = "finalteam3";

// LOCAL
// $servername = "localhost";
// $dbport = 3306;
// $username = "root";
// $password = "Beamtaker*";
// $dbname = "webdesign";

// Create a new mysqli object
$db = new mysqli($servername, $username, $password, $dbname, $dbport);

// Check the connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
    header('Location: /error');
    exit();
} else {
    $sqlGlobal = "CREATE TABLE IF NOT EXISTS Variables (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        youtube_link VARCHAR(255) DEFAULT 'Oq7PUgSbBJI'
    )";

    // Execute the 'Users' table query
    if ($db->query($sqlGlobal) !== TRUE) {
        echo "Error creating table 'Global': " . $db->error;
        return null;
    }

    $sqlInsertDefault = "INSERT INTO Variables (youtube_link)
        SELECT 'Oq7PUgSbBJI'
        WHERE NOT EXISTS (SELECT 1 FROM Variables LIMIT 1);
        ";

    if ($db->query($sqlInsertDefault) !== TRUE) {
        echo "Error adding default value: " . $db->error;
    }

    // SQL query to create the 'Users' table
    $sqlUsers = "CREATE TABLE IF NOT EXISTS Users (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(30) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        description VARCHAR(255) DEFAULT 'I love this website!',
        highscore INT(6) UNSIGNED DEFAULT 0,
        profile_image VARCHAR(255) DEFAULT 'views/assets/images/default_profile.png',
        banner_image VARCHAR(255) DEFAULT 'views/assets/images/default_banner.png'
    )";

    // Execute the 'Users' table query
    if ($db->query($sqlUsers) !== TRUE) {
        echo "Error creating table 'Users': " . $db->error;
        return null;
    }

    // SQL query to create the 'ChatMessages' table
    $sqlChatMessages = "CREATE TABLE IF NOT EXISTS ChatMessages (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        user_id INT(6) UNSIGNED NOT NULL,
        timestamp TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
        message VARCHAR(255) NOT NULL,
        FOREIGN KEY (user_id) REFERENCES Users(id)
    )";

    // Execute the 'ChatMessages' table query
    if ($db->query($sqlChatMessages) !== TRUE) {
        echo "Error creating table 'ChatMessages': " . $db->error;
        return null;
    }
}
