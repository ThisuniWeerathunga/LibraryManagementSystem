<?php
session_start();

if(!isset($_SESSION['user']) || $_SESSION['role'] != "user"){
    header("Location: ../../../html/login.html");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>User Dashboard</title>
<link rel="stylesheet" href="../../../css/user.css">
</head>

<body>

<div class="dashboard">

<?php include("../../includes/user_sidebar.php"); ?>

<div class="main">

<div class="topbar">
<h2>Welcome, <?php echo $_SESSION['user']; ?></h2>

<div id="clock"></div>

</div>

<div class="cards">
    <div class="card" onclick="location.href='catalog.php?type=borrowed'">
        📖 Borrowed Books
    </div>

    <div class="card" onclick="location.href='catalog.php?type=overdue'">
        ⚠️ Overdue Books
    </div>

    <div class="card" onclick="location.href='books.php'">
        🔍 Browse Library
    </div>
</div>

</div>
</div>

<script src="../../../js/logout.js"></script>
<?php include("../../includes/logout_modal.php"); ?>

<!-- Real-time Clock & Stats -->
<script>
    // ===== Real-time Clock =====
    function updateClock() {
        const clock = document.getElementById('clock');
        const now = new Date();
        // Format: Date + Time
        clock.innerText = now.toLocaleDateString() + ' ' + now.toLocaleTimeString();
    }
    setInterval(updateClock, 1000); // update every second
    updateClock(); // initial call

    // ===== Optional: real-time borrowed/overdue counts =====
    function updateStats() {
        fetch('get_user_stats.php')
        .then(response => response.json())
        .then(data => {
            document.querySelector(".cards .card:nth-child(1) .count").innerText = data.borrowed;
            document.querySelector(".cards .card:nth-child(2) .count").innerText = data.overdue;
        })
        .catch(err => console.error('Error fetching stats', err));
    }
    setInterval(updateStats, 5000); // update every 5 seconds
    updateStats(); // initial call
</script>

</body>
</html>