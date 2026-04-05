<?php
session_start();
include "../config/db.php";

// Get search term if provided
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Default query
$query = "SELECT * FROM users";

// If search is not empty, add WHERE clause
if(!empty($search)){
    $search = $conn->real_escape_string($search); // prevent SQL injection
    $query .= " WHERE id LIKE '%$search%' OR name LIKE '%$search%'";
}

$result = $conn->query($query);
?>


<!DOCTYPE html>
<html>
<head>

<title>User Management</title>

<link rel="stylesheet" href="../../css/style.css">
<script src="../../js/users.js"></script>

</head>

<body>

<div class="container">

<!-- SIDEBAR -->

<div class="sidebar">

<div class="logo">OpenShelfLibrary</div>

<ul>
<li><a href="../dashboard/admin/dashboard.php">Dashboard</a></li>
<li><a href="../catalog/catalog.php">Catalog</a></li>
<li><a href="../books/books.php">Books</a></li>
<li class="active"><a href="../admin/dashboard.php">Users</a></li>
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

<h3>Admin: <?php echo $_SESSION['user']; ?></h3>

<div class="right">

<form method="GET" style="display:flex; gap:10px; align-items:center;">
    <input type="text" name="search" placeholder="Search by ID or Name" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
    <button class="add-btn" type="submit">Search</button>
</form>

<button class="add-btn" onclick="openAdd()">+ Add User</button>

</div>

</div>


<h2>User Management</h2>

<table>

<tr>
<th>ID</th>
<th>Name</th>
<th>Email</th>
<th>Username</th>
<th>Action</th>
</tr>

<?php while($row=$result->fetch_assoc()){ ?>

<tr>

<td><?= $row['id'] ?></td>
<td><?= $row['name'] ?></td>
<td><?= $row['email'] ?></td>
<td><?= $row['username'] ?></td>

<td>

<button onclick="viewUser(<?= $row['id'] ?>)">view</button>

<button onclick="editUser(<?= $row['id'] ?>)">update</button>

<button onclick="deleteUser(<?= $row['id'] ?>)">delete</button>

</td>

</tr>

<?php } ?>

</table>

</div>

</div>
<!-- ADD USER POPUP -->

<div class="popup" id="addPopup">

<div class="popup-card">

<div class="popup-header">
<div class="popup-icon">👥</div>
<h3>Add User</h3>
<span class="close" onclick="closeAdd()">✖</span>
</div>

<hr>

<form action="add_user.php" method="POST">
<input type="text" name="name" placeholder="Name" required>

<input type="email" name="email" placeholder="Email" required>

<div class="row">

<input type="text" name="username" placeholder="Username" required>

<input type="password" name="password" placeholder="Password" required>

</div>

<div class="popup-buttons">

<button type="button" class="btn-cancel" onclick="closeAdd()">CANCEL</button>

<button type="submit" class="btn-primary">ADD</button>

</div>

</form>

</div>

</div>

<!-- UPDATE USER POPUP -->

<div class="popup" id="updatePopup">

<div class="popup-card">

<div class="popup-header">

<div class="popup-icon">👥</div>

<h3>Update User</h3>

<span class="close" onclick="closeUpdate()">✖</span>

</div>

<hr>

<form action="update_user.php" method="POST">

<input type="hidden" name="id" id="update_id">

<input type="text" name="name" id="update_name" placeholder="Name">

<input type="email" name="email" id="update_email" placeholder="Email">

<div class="row">

<input type="text" name="username" id="update_username" placeholder="Username">

<input type="password" name="password" id="update_password" placeholder="Password">

</div>

<div class="popup-buttons">

<button type="button" class="btn-cancel" onclick="closeUpdate()">CANCEL</button>

<button type="submit" class="btn-primary">UPDATE</button>

</div>

</form>

</div>

</div>



<!-- VIEW USER POPUP -->

<div class="popup" id="viewPopup">

<div class="popup-card">

<div class="popup-header">

<div class="popup-icon">👥</div>

<h3>View User</h3>

<span class="close" onclick="closeView()">✖</span>

</div>

<hr>

<div class="view-box">

<p><b>User ID:</b> <span id="view_id"></span></p>
<p><b>Name:</b> <span id="view_name"></span></p>
<p><b>Email:</b> <span id="view_email"></span></p>
<p><b>Username:</b> <span id="view_username"></span></p>
<p><b>Password:</b><span id="view_password"></span></p>

</div>

<button class="btn-primary full" onclick="closeView()">CLOSE</button>

</div>

</div>





<!-- DELETE POPUP -->

<div class="popup" id="deletePopup">

<div class="popup-card">

<div class="popup-header">

<div class="popup-icon">🗑</div>

<h3>Delete Confirmation</h3>

<span class="close" onclick="closeDelete()">✖</span>

</div>

<hr>

<p class="delete-text">

Are you certain you wish to proceed with the deletion of the selected entry?

</p>

<form action="delete_user.php" method="POST">

<input type="hidden" name="id" id="delete_id">

<button type="submit" class="btn-primary full">CONFIRM</button>

</form>

</div>
</div>

<script src="/LibraryManagementSystem/js/logout.js"></script>
</body>
</html>