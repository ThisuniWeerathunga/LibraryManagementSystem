<?php
session_start();

if(!isset($_SESSION['user']) || $_SESSION['role'] != "admin"){
header("Location: ../../../html/login.html");
exit();
}


include "../../config/db.php";

// Total Users
$userResult = $conn->query("SELECT COUNT(*) AS total_users FROM users");
$userData = $userResult->fetch_assoc();
$totalUsers = $userData['total_users'];

// Total Books
$bookResult = $conn->query("SELECT COUNT(*) AS total_books FROM books");
$bookData = $bookResult->fetch_assoc();
$totalBooks = $bookData['total_books'];

// Borrowed Books
$borrowedResult = $conn->query("SELECT COUNT(*) AS borrowed FROM borrowed_books WHERE status='not returned'");
$borrowedData = $borrowedResult->fetch_assoc();
$borrowed = $borrowedData['borrowed'];

// Returned Books
$returnedResult = $conn->query("SELECT COUNT(*) AS returned FROM borrowed_books WHERE status='returned'");
$returnedData = $returnedResult->fetch_assoc();
$returned = $returnedData['returned'];

?>


<!DOCTYPE html>
<html>
<head>

<title>Admin Dashboard</title>

<link rel="stylesheet" href="../../../css/admin_dashboard.css">

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body>
<div class="container">

<!-- SIDEBAR -->
<div class="sidebar">
  <h2 class="logo">OpenShelfLibrary</h2>

  <ul>
    <li><a href="../admin/dashboard.php" class="active">Dashboard</a></li>
    <li><a href="../../catalog/catalog.php">Catalog</a></li>
    <li><a href="../../books/books.php">Books</a></li>
    <li><a href="../../users/users.php">Users</a></li>
    <li><a href="#" onclick="confirmLogout(); return false;">Log Out</a></li>
  </ul>
</div>

<!-- LOGOUT MODAL -->
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
    <h2>Welcome Admin: <?php echo $_SESSION['user']; ?></h2>
  </div>

  <div class="dashboard-grid">

    <!-- LEFT -->
    <div class="left-panel">

      <!-- STATS -->
      <div class="stats">
        <div class="card">
          <h2><?php echo $totalUsers; ?></h2>
          <p>Total Users</p>
        </div>

        <div class="card">
          <h2><?php echo $totalBooks; ?></h2>
          <p>Total Books</p>
        </div>

        <div class="card">
          <h2><?php echo $borrowed; ?></h2>
          <p>Borrowed</p>
        </div>

        <div class="card">
          <h2><?php echo $returned; ?></h2>
          <p>Returned</p>
        </div>
      </div>

      <!-- RECENT -->
      <div class="card big">
        <h3>Recent Borrow Activity</h3>

        <table>
          <tr>
            <th>User</th>
            <th>Book</th>
            <th>Status</th>
          </tr>

          <?php
          $recent = $conn->query("SELECT * FROM borrowed_books ORDER BY id DESC LIMIT 5");
          while($r = $recent->fetch_assoc()){
          ?>
          <tr>
            <td><?= htmlspecialchars($r['user_id']) ?></td>
            <td><?= htmlspecialchars($r['book_id']) ?></td>
            <td><?= htmlspecialchars($r['status']) ?></td>
          </tr>
          <?php } ?>
        </table>
      </div>

    </div>

    <!-- RIGHT -->
    <div class="right-panel">

      <div class="card">
        <h3>Book Statistics</h3>
        <canvas id="bookChart"></canvas>
      </div>

      <div class="mini-cards">
        <div class="card small">
          <h3><?php echo $borrowed; ?></h3>
          <p>Active</p>
        </div>

        <div class="card small">
          <h3><?php echo $returned; ?></h3>
          <p>Completed</p>
        </div>
      </div>

      <div class="card highlight">
        <h3>Library Insights</h3>
        <p>Manage books and users efficiently.</p>
      </div>

    </div>

  </div>

</div>
</div>


<script>
const ctx = document.getElementById('bookChart');

new Chart(ctx, {
  type: 'pie',
  data: {
    labels: ['Borrowed Books','Returned Books'],
    datasets: [{
      data: [<?php echo $borrowed; ?>, <?php echo $returned; ?>]
    }]
  }
});
</script>

<script src="../../../js/logout.js"></script>
</body>
</html>