<?php
session_start();
include 'config.php'; // Include your database connection file

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Prepare and execute the query to fetch user locations
    $stmt = $conn->prepare("SELECT latitude, longitude, timestamp FROM user_locations WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $locations = [];
    while ($row = $result->fetch_assoc()) {
        $locations[] = [
            'latitude' => $row['latitude'],
            'longitude' => $row['longitude'],
            'timestamp' => $row['timestamp'],
        ];
    }

    echo json_encode($locations);
} else {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
}
?>