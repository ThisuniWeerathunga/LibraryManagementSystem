<?php
include "../config/db.php";

$username = $_POST['username'];
$email = $_POST['email'];

$check = "SELECT * FROM users WHERE username='$username' OR email='$email'";
$result = $conn->query($check);

if($result->num_rows > 0){

echo "Username or Email already exists!";

}else{

$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$phone = $_POST['phone'];
$password = $_POST['password'];

$sql = "INSERT INTO users(firstname,lastname,username,phone,email,password)
VALUES('$firstname','$lastname','$username','$phone','$email','$password')";

$conn->query($sql);

echo "Registration Successful";
}
?>