function confirmLogout() {
    document.getElementById("logoutModal").classList.add("show");
}

function closeModal() {
    document.getElementById("logoutModal").classList.remove("show");
}

function logout() {
    window.location.href = "/LibraryManagementSystem/php/auth/logout.php";
}


window.onclick = function(e) {
    let modal = document.getElementById("logoutModal");
    if (e.target === modal) {
        modal.classList.remove("show");
    }
}

