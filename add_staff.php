<?php
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $staff_name = $_POST['staff_name'];
    $staff_position = $_POST['staff_position'];

    $sql = "INSERT INTO staff (name, position) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss', $staff_name, $staff_position);

    if ($stmt->execute()) {
        header('Location: manage.html?status=success&message=Staff added successfully');
        exit();
    } else {
        header('Location: manage.html?status=error&message=' . urlencode($stmt->error));
        exit();
    }

    $stmt->close();
}

$conn->close();
?>
