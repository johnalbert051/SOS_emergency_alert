<?php
include 'config.php'; // Include your database connection file

header('Content-Type: application/json'); // Set the content type to JSON

// Query to fetch users
$query = "SELECT id, name AS name, last_name, email, mobile, username FROM users";
$result = $conn->query($query);

$users = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $users[] = $row; // Add each user to the array
    }
}

echo json_encode($users); // Return the users as a JSON response
?>