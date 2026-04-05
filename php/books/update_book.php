<?php
include "../config/db.php";

$id=$_POST['id'];
$name=$_POST['name'];
$type=$_POST['type'];
$lang=$_POST['language'];
$qty=$_POST['quantity'];

$availability = $qty > 0 ? "Available" : "Unavailable";

$conn->query("UPDATE books SET
name='$name',
type='$type',
language='$lang',
quantity='$qty',
availability='$availability'
WHERE id=$id");

header("Location: books.php");
?>
