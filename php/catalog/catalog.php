<?php
session_start();
include "../config/db.php";

$type = isset($_GET['type']) ? $_GET['type'] : 'borrowed';


$search = isset($_GET['search']) ? $_GET['search'] : '';

$user_id = $_SESSION['user_id'];
$role = $_SESSION['role'];

if($role == "admin"){

    $query = "SELECT * FROM borrowed_books WHERE 1";

   // ADMIN
    if($type == "overdue"){
        $query = "SELECT * FROM borrowed_books 
                  WHERE due_date < NOW() 
                  AND status = 'not returned'";
    } else {
        $query = "SELECT * FROM borrowed_books";
    }

} else {

     $query = "SELECT * FROM borrowed_books WHERE user_id = '$user_id'";

    if($type == "overdue"){
        $query .= " AND due_date < NOW() AND status = 'not returned'";
    }

}

// Add search by ID if provided
if(!empty($search)){
    $query .= " AND id = '$search'";
}




$result = mysqli_query($conn,$query);


?>

<!DOCTYPE html>
<html>

<head>

<title>Catalog</title>

<link rel="stylesheet" href="../../css/style.css">



</head>

<body>

<div class="container">

<!-- SIDEBAR -->

<div class="sidebar">

<div class="logo">OpenShelfLibrary</div>

<ul>

<li><a href="../dashboard/admin/dashboard.php">Dashboard</a></li>
<li class="active"><a href="../catalog/catalog.php">Catalog</a></li>
<li><a href="../books/books.php">Books</a></li>
<li><a href="../users/users.php">Users</a></li>
<li><a href="#" onclick="confirmLogout(); return false;">Log Out</a></li>
</ul>
</div>

<div id="logoutModal" class="modal">
  <div class="modal-content">
    <p>Are you sure you want to logout?</p>
    <button onclick="logout()" class="btn-yes">Logout</button>
    <button onclick="closeModal()" class="btn-no">Stay</button>
  </div>
</div>


<!-- MAIN -->

<div class="main">

<div class="topbar">

<h3>Admin: <?php echo $_SESSION['user'];?></h3>

<div id="clock"></div>

</div>


<div class="table-box">

<div class="catalog-top">

<button class="add-btn" onclick="window.location='catalog.php?type=borrowed'">Borrowed Books</button>

<button class="add-btn" onclick="window.location='catalog.php?type=overdue'">Overdue Borrowers</button>


<form method="GET" style="display:flex; gap:10px;">
    <input type="hidden" name="type" value="<?php echo $type; ?>">

    <input type="text" name="search" placeholder="Search by ID">

    <button class="add-btn">Search</button>
</form>

<button class="add-btn" onclick="openAdd()">Enter Book Purchase Details</button>

</div>

<table>

<tr>
<th>ID</th>
<th>User ID</th>
<th>Book ID</th>

<?php if($type=="borrowed"){ ?>
<th>Copies</th>
<th>Borrowed Date</th>
<th>Due Date</th>


<?php } else { ?>


<th>Due Date</th>

<?php }?>
<th>Action</th>
</tr>

<?php while($row = mysqli_fetch_assoc($result)){ 
?>

<tr>

<td><?php echo $row['id']; ?></td>
<td><?php echo $row['user_id']; ?></td>
<td><?php echo $row['book_id']; ?></td>

<?php if($type=="borrowed"){ ?>

<td><?php echo $row['copies']; ?></td>
<td><?php echo $row['borrow_date']; ?></td>
<td><?php echo $row['due_date']; ?></td>


<?php } else { ?>

<td><?php echo $row['due_date']; ?></td>
<?php } ?>

<td>
<button onclick="openView(
'<?php echo $row['id']; ?>',
'<?php echo $row['user_id']; ?>',
'<?php echo $row['book_id']; ?>',
'<?php echo $row['status']; ?>'
)">View</button>

<button onclick="openDelete('<?php echo $row['id']; ?>')">Delete</button>
</td>

</tr>

<?php } ?>

</table>

</div>

</div>

</div>


<!-- ADD BORROW POPUP -->

<div class="popup" id="addPopup">

<div class="popup-content">

<h3>Borrow Book</h3>

<form action="add_borrow.php" method="POST">

<input type="text" name="user_id" placeholder="User ID" required>

<input type="text" name="book_id" placeholder="Book ID" required>

<input type="text" name="amount" placeholder="Amount (Books)" required>

<button type="submit">Add</button>

<button type="button" onclick="closeAdd()">Cancel</button>

</form>

</div>

</div>

<!-- VIEW POPUP -->
<div class="popup" id="viewPopup">
  <div class="popup-card">

    <div class="popup-header">
      <h3>📖 View Book</h3>
      <span class="close" onclick="closeView()">✖</span>
    </div>

    <hr>

    <div id="bookDetails"></div>

  </div>
</div>

<!-- DELETE POPUP -->
<div class="popup" id="deletePopup">
  <div class="popup-card">

    <div class="popup-header">
      <h3>🗑 Delete Book</h3>
      <span class="close" onclick="closeDelete()">✖</span>
    </div>

    <hr>

    <p class="delete-text">Are you sure you want to delete this book?</p>

    <form action="delete_book.php" method="POST">
      <input type="hidden" name="id" id="delete_id">

      <div class="popup-buttons">
        <button type="button" onclick="closeDelete()">Cancel</button>
        <button type="submit" class="delete-btn">Delete</button>
      </div>
    </form>

  </div>
</div>

<script>

function updateClock(){
let now=new Date();

document.getElementById("clock").innerHTML=
now.toLocaleDateString()+" "+now.toLocaleTimeString();
}

setInterval(updateClock,1000);

</script>

<script>

// ===== VIEW POPUP =====
function openView(id, user, book, status){
  document.getElementById("viewPopup").style.display = "flex";

  document.getElementById("bookDetails").innerHTML = `
    <p><b>ID:</b> ${id}</p>
    <p><b>User ID:</b> ${user}</p>
    <p><b>Book ID:</b> ${book}</p>
    <p><b>Status:</b> ${status}</p>
  `;
}

function closeView(){
  document.getElementById("viewPopup").style.display = "none";
}


// ===== DELETE POPUP =====
function openDelete(id){
  document.getElementById("deletePopup").style.display = "flex";
  document.getElementById("delete_id").value = id;
}

function closeDelete(){
  document.getElementById("deletePopup").style.display = "none";
}

</script>

<script src="../../js/catalog.js"></script>
<script src="/LibraryManagementSystem/js/logout.js"></script>

</body>
</html>
