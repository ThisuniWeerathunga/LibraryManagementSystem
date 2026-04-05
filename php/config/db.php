<?php

$conn = new mysqli("localhost","root","","libraryms");

if($conn->connect_error){
    die("Connection Failed: " . $conn->connect_error);
}

?>