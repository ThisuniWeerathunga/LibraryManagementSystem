<?php

session_start();
include "../config/db.php";

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM users 
WHERE (username='$username' OR email='$username') 
AND password='$password'";

$result = $conn->query($sql);

if($result->num_rows > 0){

$row = $result->fetch_assoc();

$_SESSION['user_id'] = $row['id'];

$_SESSION['user'] = $row['username'];
$_SESSION['role'] = $row['role'];

/* Redirect based on role */

if($row['role'] == "admin"){

header("Location: ../dashboard/admin/dashboard.php");

}else{

header("Location: ../dashboard/user/dashboard.php");

}

}else{

echo "Invalid Login";

}

?>