<?php

require 'connectToDatabase.php';
require 'ExceptionWithField.php';

session_start();

header('Content-Type: application/json');

$conn = connectToDatabase();

$user_id = $_SESSION['user_id'];

function handleImageUpload($file, $uploadDir) {
    $targetFile = $uploadDir . basename($file["name"]);
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    
    if ($file["size"] > 500000) {
        return null;
    }
    
    if (!in_array($imageFileType, ['jpg', 'png', 'jpeg', 'gif'])) {
        return null;
    }

    if (move_uploaded_file($file["tmp_name"], $targetFile)) {
        return $targetFile;
    }
    
    return null;
}

$description = $_POST['description'];
$profile_image = handleImageUpload($_FILES["profile_image"], "../assets/uploads/profile/");
$banner_image = handleImageUpload($_FILES["banner_image"], "../assets/uploads/banner/");

$sql = "UPDATE Users SET description=?, profile_image=?, banner_image=? WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssi", $description, $profile_image, $banner_image, $user_id);
$stmt->execute();

echo json_encode(['success' => 'Profile updated']);
?>
