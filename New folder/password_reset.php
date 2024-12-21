<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];

    // Generate a unique token
    $token = bin2hex(random_bytes(50));

    // Save token in the database (for verification)
    $conn = new mysqli('localhost', 'username', 'password', 'database_name');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("UPDATE users SET reset_token = ? WHERE email = ?");
    $stmt->bind_param('ss', $token, $email);
    if ($stmt->execute()) {
        // Send reset email with token
        $resetLink = "https://yourdomain.com/reset_password.php?token=$token";
        mail($email, 'Password Reset', "Click here to reset your password: $resetLink");

        echo "Password reset email sent.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
