<?php
session_start();
include 'config.php'; // Include your database connection file

error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['name'], $data['last_name'], $data['email'], $data['mobile'], $data['username'], $data['password'], $data['role'])) {
        $first_name = $data['name'];
        $last_name = $data['last_name'];
        $email = $data['email'];
        $mobile = $data['mobile'];
        $username = $data['username'];
        $password = password_hash($data['password'], PASSWORD_DEFAULT);
        $role = $data['role'];

        $stmt = $conn->prepare("INSERT INTO users (name, last_name, email, mobile, username, password, role) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $first_name, $last_name, $email, $mobile, $username, $password, $role);

        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'User added successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to add user: ' . $stmt->error]);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid input data']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
?>