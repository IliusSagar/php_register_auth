<?php
session_start();  // Start the session

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit;
}

// If the user is logged in, display the dashboard
echo "Welcome, " . htmlspecialchars($_SESSION['user_name']) . "!";
?>

<!-- Add your dashboard content here -->
