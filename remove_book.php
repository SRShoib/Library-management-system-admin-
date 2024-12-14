<?php
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $book_id = $_POST['book_id'];

    $sql = "DELETE FROM books WHERE book_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $book_id);

    if ($stmt->execute()) {
        header('Location: manage.html?status=success&message=Book removed successfully');
        exit();
    } else {
        header('Location: manage.html?status=error&message=' . urlencode($stmt->error));
        exit();
    }

    $stmt->close();
}

$conn->close();
?>
