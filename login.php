<?php
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare and execute SQL query to fetch the plain text password
    $sql = "SELECT password FROM admin WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($stored_password);
        $stmt->fetch();

        // Verify the password (plain text comparison)
        if ($password === $stored_password) {
            // Redirect to the index page after successful login
            header('Location: index.html');
            exit();
        } else {
            echo 'Invalid password.';
        }
    } else {
        echo 'User not found.';
    }

    $stmt->close();
}

$conn->close();
?>
