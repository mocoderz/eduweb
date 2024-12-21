<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = $_POST['token'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $conn = new mysqli('localhost', 'username', 'password', 'database_name');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT id FROM users WHERE reset_token = ?");
    $stmt->bind_param('s', $token);
    $stmt->execute();
    $stmt->bind_result($id);
    $stmt->fetch();

    if ($stmt->num_rows > 0) {
        $stmt = $conn->prepare("UPDATE users SET password = ?, reset_token = NULL WHERE id = ?");
        $stmt->bind_param('si', $password, $id);
        if ($stmt->execute()) {
            echo "Password has been reset.";
        } else {
            echo "Error: " . $stmt->error;
        }
    } else {
        echo "Invalid token.";
    }

    $stmt->close();
    $conn->close();
}
?>
 