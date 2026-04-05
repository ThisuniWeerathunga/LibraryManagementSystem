<?php
include "../config/db.php";

$result = $conn->query("SELECT * FROM books");
?>

<!DOCTYPE html>
<html>
<head>

<title>Books</title>

<link rel="stylesheet" href="../../css/style.css">



</head>

<body>

<div class="container">

<!-- SIDEBAR -->

<div class="sidebar">

<div class="logo">OpenShelfLibrary</div>

<ul>

<li><a href="../dashboard/admin/dashboard.php">Dashboard</a></li>
<li><a href="../catalog/catalog.php">Catalog</a></li>
<li class="active"><a href="../books/books.php">Books</a></li>
<li><a href="../users/users.php">Users</a></li>
<li><a href="#" onclick="confirmLogout(); return false;">Log Out</a></li>
</ul>
</div>




<!-- MAIN -->

<div class="main">

<div class="topbar">

<h3>Book Management</h3>

<button class="add-btn" onclick="openAdd()">+ Add Book</button>

</div>

<div id="clock"></div>

<table>

<tr>
<th>ID</th>
<th>Name</th>
<th>Type</th>
<th>Language</th>
<th>Quantity</th>
<th>Availability</th>
<th>Action</th>
</tr>

<?php while($row=$result->fetch_assoc()){ ?>

<tr>

<td><?= $row['id'] ?></td>
<td><?= $row['name'] ?></td>
<td><?= $row['type'] ?></td>
<td><?= $row['language'] ?></td>
<td><?= $row['quantity'] ?></td>
<td><?= $row['availability'] ?></td>

<td>

<button onclick="viewBook(<?= $row['id']?>)">view</button>

<button onclick="editBook(<?= $row['id']?>)">update</button>

<button class="btn-delete" onclick="openDelete(<?= $row['id']; ?>)">Delete</button>

</td>

</tr>

<?php } ?>

</table>

</div>

</div>


<!-- ADD POPUP -->

<div class="popup" id="addPopup">

<div class="popup-card">

<div class="popup-header">
<div class="popup-icon">📖 </div>
<h3>Add Book</h3>
<span class='close' onclick='closeAdd()'> ✖</span>
</div>
<hr>

<form action="add_book.php" method="POST">

<input type="text" name="name" placeholder="Name" required>

<input type="text" name="type" placeholder="Type">

<input type="text" name="language" placeholder="Language">

<input type="number" name="quantity" placeholder="Quantity">

<button type="submit">ADD</button>

<button type="button" onclick="closeAdd()">Cancel</button>

</form>

</div>

</div>


<!-- UPDATE POPUP -->

<div class="popup" id="updatePopup">

<div class="popup-card">

<div class="popup-header">

<div class="popup-icon">📖 </div>

<h3>Update Book</h3>

<span class="close" onclick="closebook()">✖</span>

</div>

<hr>

<form action="update_book.php" method="POST">

<input type="hidden" name="id" id="update_id">

<input type="text" name="name" id="update_name">

<input type="text" name="type" id="update_type">

<input type="text" name="language" id="update_language">

<input type="number" name="quantity" id="update_quantity">

<button type="submit">Update</button>



</form>

</div>

</div>


<!-- VIEW BOOK POPUP -->

<div class="popup" id="viewPopup">
    <div class="popup-card">

    <div class="popup-header">
        <div class="popup-icon">📖 </div>
        <h3>View Book</h3>
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
            <div classs="popup-icon">🗑</div>
            <h3>Delete Book?</h3>
            <span class="close" onclick="closeDelete()">✖</span>
        </div>

        <hr>

        <p class="deiete-text">Are you sure you want to delete this book?</p>

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
function openDelete(id){
    document.getElementById("deletePopup").style.display = "flex";
    document.getElementById("delete_id").value = id;
}

function closeDelete(){
    document.getElementById("deletePopup").style.display = "none";
}
</script>

<script src="../../js/books.js"></script>
<script src="/LibraryManagementSystem/js/logout.js"></script>

</body>
</html>
