<?php
session_start(); // Start the session
session_destroy(); // Destroy all session data
header("Location: index.php"); // Redirect to index.php
exit(); // Ensure no further code is executed
?>