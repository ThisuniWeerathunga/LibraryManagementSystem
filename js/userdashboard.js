function loadPage(page){
    const content = document.getElementById("content");

    if(page === "borrowed"){
        content.innerHTML = "<h3>Your Borrowed Books</h3><p>List here...</p>";
    }

    if(page === "returned"){
        content.innerHTML = "<h3>Your Returned Books</h3><p>List here...</p>";
    }

    if(page === "browse"){
        content.innerHTML = "<h3>Browse Books</h3><p>Search and view books...</p>";
    }
}

function logout(){
    window.location.href = "../../auth/logout.php";
}