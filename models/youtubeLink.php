<?php
require 'database.php';

function isValidYouTubeLink($link)
{
  if ($link === null) {
    return false;
  }

  // Regular expression to match YouTube video URLs
  $pattern = "/^(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/watch\?v=|youtu\.be\/)([\w-]{11})$/";
  return preg_match($pattern, $link) === 1;
}

function getYouTubeVideoId($link)
{
  if ($link === null) {
    return null;
  }

  // Extract the video ID from the YouTube link
  $pattern = "/^(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/watch\?v=|youtu\.be\/)([\w-]{11})$/";
  preg_match($pattern, $link, $matches);
  if (isset($matches[1])) {
    return $matches[1];
  } else {
    return null;
  }
}

// Establishing connection
try {
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $youtubeLink = $_POST["youtubeLink"];

    // Validate the YouTube link
    if (!isValidYouTubeLink($youtubeLink)) {
      $response = [
        "status" => "error",
        "message" => "Invacllid YouTube link"
      ];
      $responseCode = 400; // Bad Request
    } else {
      // Extract the video ID from the YouTube link
      $videoId = getYouTubeVideoId($youtubeLink);

      // Prepare the SQL statement with a parameter
      $sqlUpdate = "UPDATE Variables SET youtube_link = ? WHERE id = 1"; // Assuming the record you want to update has an ID of 1
      $stmt = $db->prepare($sqlUpdate);

      // Bind the parameter to the statement
      $stmt->bind_param("s", $videoId);

      // Execute the statement
      $saveResult = $stmt->execute();

      if ($saveResult) {
        $response = [
          "status" => "success",
          "message" => "YouTube link saved successfully"
        ];
        $responseCode = 200;
      } else {
        $response = [
          "status" => "error",
          "message" => "Error occurred while saving the YouTube link"
        ];
        $responseCode = 500;
      }
    }

    // Send the response as JSON
    http_response_code($responseCode);
    header("Content-Type: application/json");
    echo json_encode($response);
  }

  if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $sqlSelect = "SELECT youtube_link FROM Variables WHERE id = 1"; // Assuming the record you want to retrieve has an ID of 1
    $result = $db->query($sqlSelect);

    if ($result && $result->num_rows > 0) {
      $row = $result->fetch_assoc();
      $responseCode = 200;
      $youtubeLink = $row["youtube_link"];
      $response = [
        "status" => "success",
        "youtubeLink" => $youtubeLink
      ];
    } else {
      $response = [
        "status" => "error",
        "message" => "Error occurred while fetching the YouTube link from the database"
      ];
      $responseCode = 500;
    }

    // Send the response as JSON
    http_response_code($responseCode);
    header("Content-Type: application/json");
    echo json_encode($response);
  }
} catch (ExceptionWithField $e) {
  echo json_encode(['error' => $e->getMessage(), 'field' => $e->getField()]);
} catch (Exception $e) {
  echo json_encode(['error' => $e->getMessage()]);
} finally {
  if (isset($db)) {
    $db->close();
  }
}
