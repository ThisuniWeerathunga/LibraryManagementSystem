<?php
include "../config/db.php";

$id=$_POST['id'];
$name=$_POST['name'];
$email=$_POST['email'];
$username=$_POST['username'];
$password=$_POST['password'];

$conn->query("UPDATE users SET
name='$name',
email='$email',
username='$username',
password='$password'
WHERE id='$id'");

header("Location: users.php");
?>