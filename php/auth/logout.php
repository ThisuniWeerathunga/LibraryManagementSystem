<?php
session_start();
session_unset();
session_destroy();

// redirect to main page
header("Location: /LibraryManagementSystem/html/index.html");
exit();
?>