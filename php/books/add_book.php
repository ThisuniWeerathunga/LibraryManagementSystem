<?php
include "../config/db.php";

$name=$_POST['name'];
$type=$_POST['type'];
$lang=$_POST['language'];
$qty=$_POST['quantity'];

$availability = $qty > 0 ? "Available" : "Unavailable";

$conn->query("INSERT INTO books(name,type,language,quantity,availability)
VALUES('$name','$type','$lang','$qty','$availability')");

header("Location: books.php");
?>
