<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    // Redirect to signin if not logged in
    header("Location: signin.php");
    exit();
}

// Main content
echo "Welcome to the main page!";
?>
