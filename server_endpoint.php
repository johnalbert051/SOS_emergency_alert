<?php
session_start();
include 'config.php'; // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the raw POST data
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['latitude']) && isset($data['longitude'])) {
        $latitude = $data['latitude'];
        $longitude = $data['longitude'];
        $user_id = $_SESSION['user_id']; // Assuming you have the user ID stored in the session

        // Check if the user already has a location entry
        $stmt = $conn->prepare("SELECT id FROM user_locations WHERE user_id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // User location exists, update it
            $stmt = $conn->prepare("UPDATE user_locations SET latitude = ?, longitude = ? WHERE user_id = ?");
            $stmt->bind_param("ddi", $latitude, $longitude, $user_id);

            if ($stmt->execute()) {
                echo json_encode(['status' => 'success', 'message' => 'Location updated successfully']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to update location: ' . $stmt->error]);
            }
        } else {
            // User location does not exist, insert a new record
            $stmt = $conn->prepare("INSERT INTO user_locations (user_id, latitude, longitude) VALUES (?, ?, ?)");
            $stmt->bind_param("idd", $user_id, $latitude, $longitude);

            if ($stmt->execute()) {
                echo json_encode(['status' => 'success', 'message' => 'Location added successfully']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to add location: ' . $stmt->error]);
            }
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid data']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
?>