<?php
session_start();
include "../config/db.php";

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM borrowed_books 
        WHERE user_id = ? 
        AND due_date < NOW()";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

echo "<table border='1'>
<tr>
<th>ID</th>
<th>User ID</th>
<th>Book ID</th>

<th>Amount</th>
<th>Borrowed Date</th>
<th>Due Date</th>
</tr>";

while($row = $result->fetch_assoc()){
    echo "<tr>
    <td>{$row['id']}</td>
    <td>{$row['user_id']}</td>
    <td>{$row['book_id']}</td>
    <td>{$row['amount']}</td>
    <td>{$row['borrowed_date']}</td>
    <td style='color:red;'>{$row['due_date']}</td>
    </tr>";
}

echo "</table>";
?>