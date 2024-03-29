<?php
session_start();
header('Content-Type: application/json');
require 'database.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'User not logged in']);
    exit;
}
$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $sql = "SELECT * FROM Users WHERE id = ?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    echo json_encode($user);
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $profile_image = $_POST['profile_image'] ?? null;
    $banner_image = $_POST['banner_image'] ?? null;
    $description = $_POST['description'] ?? null;
    $sql = "UPDATE Users SET ";
    $updateData = [];
    $types = '';
    $params = [];
    $upload_path = '../uploads/';

    if (isset($_FILES['profile_image'])) {
        $profileImagePath = $upload_path . basename($_FILES['profile_image']['name']);
        if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $profileImagePath)) {
            $updateData[] = "profile_image = ?";
            $types .= "s";
            $params[] = "finalteam3/" . $profileImagePath;
        } else {
            $errorMessage = "Error uploading profile image: " . $_FILES['profile_image']['error'];
            echo json_encode(['error' => $errorMessage]);
            return;
        }
    }

    if (isset($_FILES['banner_image'])) {
        $bannerImagePath = $upload_path . basename($_FILES['banner_image']['name']);
        if (move_uploaded_file($_FILES['banner_image']['tmp_name'], $bannerImagePath)) {
            $updateData[] = "banner_image = ?";
            $types .= "s";
            $params[] = "finalteam3/" . $bannerImagePath;
        } else {
            $errorMessage = "Error uploading banner image: " . $_FILES['banner_image']['error'];
            echo json_encode(['error' => $errorMessage]);
            return;
        }
    }

    if ($description) {
        $updateData[] = "description = ?";
        $types .= "s";
        $params[] = $description;
    }

    $sql .= implode(", ", $updateData) . " WHERE id = ?";
    $types .= "i";
    $params[] = $user_id;

    if (empty($updateData)) {
        echo json_encode(['error' => 'No data provided for update']);
        exit;
    }

    $stmt = $db->prepare($sql);

    if ($stmt === false) {
        die("Error: " . $db->error);
    }

    $stmt->bind_param($types, ...$params);
    $stmt->execute();

    echo json_encode(['success' => true]);
}
$db->close();
