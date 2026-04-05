<?php
include "../config/db.php";

$user=$_POST['user_id'];
$book=$_POST['book_id'];
$amount=$_POST['copies'];

$borrow_date=date("Y-m-d H:i:s");

$due_date=date("Y-m-d H:i:s", strtotime("+7 days"));

$sql="INSERT INTO borrowed_books(user_id,book_id,copies,borrow_date,due_date)
VALUES('$user','$book','$copies','$borrow_date','$due_date')";

$conn->query($sql);

header("Location: catalog.php");
?>
