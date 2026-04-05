<?php
include "../config/db.php";

$id = $_POST['id'];

// Delete borrow record
$conn->query("DELETE FROM borrowed_books WHERE id = $id");

header("Location: catalog.php");
?>