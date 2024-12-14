<?php
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $book_title = $_POST['book_title'];
    $book_author = $_POST['book_author'];
    $publication_year = $_POST['publication_year'];

    $sql = "INSERT INTO books (title, author, publication_year) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssi', $book_title, $book_author, $publication_year);

    if ($stmt->execute()) {
        header('Location: manage.html?status=success&message=Book added successfully');
        exit();
    } else {
         header('Location: manage.html?status=error&message=' . urlencode($stmt->error));
        exit();
    }

    $stmt->close();
}

$conn->close();
?>
