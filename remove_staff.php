<?php
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $staff_id = $_POST['staff_id'];

    $sql = "DELETE FROM staff WHERE staff_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $staff_id);

    if ($stmt->execute()) {
        header('Location: manage.html?status=success&message=Staff removed successfully');
        exit();
    } else {
        header('Location: manage.html?status=error&message=' . urlencode($stmt->error));
        exit();
    }

    $stmt->close();
}

$conn->close();
?>
