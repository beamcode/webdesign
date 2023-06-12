CREATE DATABASE IF NOT EXISTS db;

USE db;

CREATE TABLE IF NOT EXISTS Users (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(30) NOT NULL,
    password VARCHAR(255) NOT NULL,
    description VARCHAR(255),
    profile_image VARCHAR(255) DEFAULT '../assets/uploads/profile/default_profile.png',
    banner_image VARCHAR(255) DEFAULT '../assets/uploads/profile/default_banner.png'
);

CREATE TABLE IF NOT EXISTS ChatMessages (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT(6) UNSIGNED,
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    message VARCHAR(255) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES Users(id)
);