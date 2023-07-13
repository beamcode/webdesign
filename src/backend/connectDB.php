<?php
function connectToDatabase()
{
    // $servername = $_ENV['DB_SERVER'];
    // $dbport = $_ENV['DB_PORT'];
    // $username = $_ENV['DB_USERNAME'];
    // $password = $_ENV['DB_PASSWORD'];
    // $dbname = $_ENV['DB_NAME'];

    $servername = "172.21.82.208";
    $dbport = "3306";
    $username = "finalteam3";
    $password = "VnOXNVZv6M";
    $dbname = "finalteam3";

    $conn = new mysqli($servername, $username, $password, $dbname, $dbport);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        throw new Exception('Failed to connect to the database');
    }

    // SQL query to create the 'Users' table
    $sqlUsers = "CREATE TABLE IF NOT EXISTS Users (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(30) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        description VARCHAR(255),
        highscore INT(6) UNSIGNED DEFAULT 0,
        profile_image VARCHAR(255) DEFAULT '../assets/uploads/profile/default_profile.png',
        banner_image VARCHAR(255) DEFAULT '../assets/uploads/profile/default_banner.png')";


    // Execute the 'Users' table query
    if ($conn->query($sqlUsers) === TRUE) {
        echo "Table 'Users' created successfully!";
    } else {
        echo "Error creating table 'Users': " . $conn->error;
        return null;
    }

    // SQL query to create the 'ChatMessages' table
    $sqlChatMessages = "CREATE TABLE IF NOT EXISTS ChatMessages (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        user_id INT(6) UNSIGNED,
        timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        message VARCHAR(255) NOT NULL,
        FOREIGN KEY (user_id) REFERENCES Users(id))";

    // Execute the 'ChatMessages' table query
    if ($conn->query($sqlChatMessages) === TRUE) {
        echo "Table 'ChatMessages' created successfully!";
    } else {
        echo "Error creating table 'ChatMessages': " . $conn->error;
        return null;
    }

    // SQL query to create the 'Friends' table
    $sqlFriends = "CREATE TABLE IF NOT EXISTS Friends (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        user_id INT(6) UNSIGNED,
        friend_id INT(6) UNSIGNED,
        CONSTRAINT fk_user
            FOREIGN KEY (user_id)
            REFERENCES Users (id)
            ON DELETE CASCADE,
        CONSTRAINT fk_friend
            FOREIGN KEY (friend_id)
            REFERENCES Users (id)
            ON DELETE CASCADE)";

    // Execute the 'Friends' table query
    if ($conn->query($sqlFriends) === TRUE) {
        echo "Table 'Friends' created successfully!";
    } else {
        echo "Error creating table 'Friends': " . $conn->error;
        return null;
    }

    // Insert sample data into the 'Users' table (ignoring duplicates)
    $sqlInsertUsers = "INSERT IGNORE INTO Users (username, password, description, profile_image, highscore) VALUES 
        ('Michel', 'password', 'michel@example.com', 'path/to/profile_picture_of_a_bg.jpg', 12),
        ('Michel le boss', 'password', 'michel@example.com', 'path/to/profile_picture_of_a_bg.jpg', 200)";


    // Execute the INSERT statements
    if ($conn->query($sqlInsertUsers) === TRUE) {
        echo "Sample data inserted into 'Users' table successfully!";
    } else {
        echo "Error inserting sample data into 'Users' table: " . $conn->error;
    }

    return $conn;
}
