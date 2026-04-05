function openAdd(){
document.getElementById("addPopup").style.display="flex";
}

function closeAdd(){
document.getElementById("addPopup").style.display="none";
}


function viewUser(id){

fetch("../../php/users/get_user.php?id="+id)
.then(res=>res.json())
.then(data=>{

document.getElementById("view_id").innerHTML= data.id;
document.getElementById("view_name").innerHTML= data.name;
document.getElementById("view_email").innerHTML= data.email;
document.getElementById("view_username").innerHTML= data.username;
document.getElementById("view_password").innerHTML= data.password;

document.getElementById("viewPopup").style.display="flex";

});
}

function closeView(){
document.getElementById("viewPopup").style.display="none";
}


function editUser(id){

fetch("../../php/users/get_user.php?id="+id)
.then(res=>res.json())
.then(data=>{

document.getElementById("update_id").value=data.id;
document.getElementById("update_name").value=data.name;
document.getElementById("update_email").value=data.email;
document.getElementById("update_username").value=data.username;
document.getElementById("update_password").value=data.password;

document.getElementById("updatePopup").style.display="flex";

});

}

function closeUpdate(){
document.getElementById("updatePopup").style.display="none";
}

function deleteUser(id){

document.getElementById("delete_id").value=id;

document.getElementById("deletePopup").style.display="flex";

}