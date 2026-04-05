<?php
include "../config/db.php";

$id = $_POST['id'];

// Check if book is borrowed
$check = $conn->query("SELECT * FROM borrowed_books WHERE book_id = $id");

if($check->num_rows > 0){
    echo "<script>
        alert('Cannot delete book! It is already borrowed.');
        window.location='books.php';
    </script>";
    exit();
}

// Delete book
$conn->query("DELETE FROM books WHERE id = $id");

header("Location: books.php");
?>