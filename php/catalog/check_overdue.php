<?php
include "../config/db.php";

$today=date("Y-m-d H:i:s");

$sql="SELECT * FROM borrowed_books WHERE due_date < '$today'";

$result=$conn->query($sql);

while($row=$result->fetch_assoc()){

$id=$row['id'];
$user=$row['user_id'];
$book=$row['book_id'];
$due=$row['due_date'];

$conn->query("INSERT INTO overdue_books(borrow_id,user_id,book_id,due_date)
VALUES('$id','$user','$book','$due')");
}
?>
