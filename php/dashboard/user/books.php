<?php
session_start();
if(!isset($_SESSION['user'])){
    header("Location: ../../../html/login.html");
}

include "../../config/db.php"; // make sure path is correct

$result = $conn->query("SELECT * FROM books WHERE availability = 'Available'");

?>

<!DOCTYPE html>
<html>
<head>
<title>Books</title>
<link rel="stylesheet" href="../../../css/user.css">
</head>

<body>

<div class="dashboard">

<?php include("../../includes/user_sidebar.php"); ?>

<div class="main">
<div class="topbar">
<h2>Available Books</h2>
</div>

<table>

<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Type</th>
    <th>Language</th>
    <th>Available</th>
    
</tr>

<?php while($row = $result->fetch_assoc()){ ?>

<tr>
    <td><?= $row['id'] ?></td>
    <td><?= $row['name'] ?></td>
    <td><?= $row['type'] ?></td>
    <td><?= $row['language'] ?></td>
    <td><?= $row['quantity'] ?></td>

    
</tr>

<?php } ?>

</table>

</div>
</div>

<script src="../../../js/logout.js"></script>
<?php include("../../includes/logout_modal.php"); ?>
</body>
</html>