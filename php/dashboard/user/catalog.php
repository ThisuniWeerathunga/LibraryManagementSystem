<?php
session_start();
include "../../config/db.php";

if(!isset($_SESSION['user_id'])){
    die("User not logged in");
}

$user_id = $_SESSION['user_id'];
$type = isset($_GET['type']) ? $_GET['type'] : 'borrowed';

/* FILTER DATA FROM SAME TABLE (borrowed_books) */

if($type == "overdue"){
    $sql = "SELECT * FROM borrowed_books 
            WHERE user_id = ? 
            AND due_date < NOW()
            AND status = 'not returned'";
} else {
    $sql = "SELECT * FROM borrowed_books 
            WHERE user_id = ?";
}

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
<title>User Catalog</title>
<link rel="stylesheet" href="../../../css/user.css">
</head>

<body>

<div class="dashboard">

<?php include("../../includes/user_sidebar.php"); ?>

<div class="main">

<div class="topbar">
    
    <h2><?php echo ucfirst($type); ?> Books</h2>

    <div id="clock"></div>
</div>

<div class="table-box">

<button class="add-btn" onclick="location.href='catalog.php?type=borrowed'">
Borrowed Books
</button>

<button class="add-btn" onclick="location.href='catalog.php?type=overdue'">
Overdue Books
</button>
<br>

<table>

<tr>
<th>ID</th>
<th>Book ID</th>
<th>Amount</th>
<th>Borrow Date</th>
<th>Due Date</th>
</tr>

<?php while($row = $result->fetch_assoc()){ ?>
<tr>
<td><?php echo $row['id']; ?></td>
<td><?php echo $row['book_id']; ?></td>
<td><?php echo $row['amount']; ?></td>
<td><?php echo $row['borrow_date']; ?></td>
<td style="<?php echo ($type=='overdue') ? 'color:red;' : ''; ?>">
<?php echo $row['due_date']; ?>
</td>
</tr>
<?php } ?>

</table>

</div>

</div>
</div>
<script src="../../../js/logout.js"></script>
<?php include("../../includes/logout_modal.php"); ?>

</body>
</html>