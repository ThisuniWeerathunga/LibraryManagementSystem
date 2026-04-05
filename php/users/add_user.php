<?php
include "../config/db.php";

$name=$_POST['name'];
$email=$_POST['email'];
$username=$_POST['username'];
$password=$_POST['password'];

$conn->query("INSERT INTO users(name,email,username,password,role)
VALUES('$name','$email','$username','$password','admin')");

header("Location: users.php");
?>