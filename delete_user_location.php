<?php
session_start();
include 'config.php'; // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the raw POST data
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['user_id'])) {
        $user_id = $data['user_id'];

        // Prepare and execute the delete statement
        $stmt = $conn->prepare("DELETE FROM user_locations WHERE user_id = ?");
        $stmt->bind_param("i", $user_id);

        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'Location deleted successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to delete location: ' . $stmt->error]);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid data']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
?>