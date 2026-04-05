function openAdd(){
document.getElementById("addPopup").style.display="flex";
}

function closeAdd(){
document.getElementById("addPopup").style.display="none";
}


function viewBook(id){

fetch("../../php/books/get_book.php?id="+id)

.then(res=>res.json())

.then(data=>{

document.getElementById("bookDetails").innerHTML=
"Name: "+data.name+
"<br>Type: "+data.type+
"<br>Language: "+data.language+
"<br>Quantity: "+data.quantity;

document.getElementById("viewPopup").style.display="flex";

});

}

function closeView(){
document.getElementById("viewPopup").style.display="none";
}


function editBook(id){

fetch("../../php/books/get_book.php?id="+id)

.then(res=>res.json())

.then(data=>{

document.getElementById("update_id").value=data.id;
document.getElementById("update_name").value=data.name;
document.getElementById("update_type").value=data.type;
document.getElementById("update_language").value=data.language;
document.getElementById("update_quantity").value=data.quantity;

document.getElementById("updatePopup").style.display="flex";

});

}

function closebook(){
document.getElementById("updatePopup").style.display="none";
}

function deleteBook(id){

document.getElementById("deletePopup").style.display="flex";

document.getElementById("delete_id").value = id; // set the book id

}

function closeDelete(){
document.getElementById("deletePopup").style.display="none";
}
