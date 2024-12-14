<?php
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if passwords match
    if ($password !== $confirm_password) {
        die('Passwords do not match.');
    }

    // Hash the password for security
    // $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Insert the new user into the database
    $sql = "INSERT INTO admin (username, password) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss', $username, $password);

    if ($stmt->execute()) {
        // Redirect to the login page after successful sign-up
        header('Location: login.html');
        exit();
    } else {
        echo 'Error: ' . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
