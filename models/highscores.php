<?php
session_start();
require_once 'database.php';

// Function to get the highscores of all players
function getHighscores($db)
{
	$sql = "SELECT Users.username, Users.profile_image, Users.highscore, Users.description
					FROM Users
					ORDER BY Users.highscore DESC";
	$result = $db->query($sql);
	// Check if the query was successful
	if ($result) {
		$data = $result->fetch_all(MYSQLI_ASSOC);
		$result->close();
		return $data;
	} else {
		// Error occurred while fetching messages
		return null;
	}
}
// Establishing connection
try {
	if ($_SERVER["REQUEST_METHOD"] == "GET") {
		// Fetch the highscores
		$data = getHighscores($db);
		$responseCode = 500;
		// Check if any messages were fetched
		if ($data) {
			$responseCode = 200;
			$response = $data;
		} else {
			// Error occurred while fetching messages
			$response = [
				"status" => "error",
				"message" => "Error occurred while fetching the data from the database"
			];
		}
		// Send the messages as JSON
		http_response_code($responseCode);
		header("Content-Type: application/json");
		echo json_encode($response);
	}
} catch (ExceptionWithField $e) {
	// Return to backup point
	$conn->rollback();
	echo json_encode(['error' => $e->getMessage(), 'field' => $e->getField()]);
} catch (Exception $e) {
	// Return to backup point
	$conn->rollback();
	echo json_encode(['error' => $e->getMessage()]);
} finally {
	if (isset($conn)) {
		$conn->close();
	}
}
