<?php
if(!isset($_SESSION))
{
    header("Location: ?page=home");
}elseif(isset($_SESSION) && empty($_SESSION))
{
    header("Location: ?page=home");
}elseif(isset($_SESSION) && $_SESSION['role'] != "Admin")
{
    header("Location: ?page=home");
}
?>
<div class="box">
		<div class="boxcontent" id="mybox">
            <h2>Title of blog</h2>
            <div contenteditable="True" class="formtitle" id="formtitle"></div><br>
            <h2>Content</h2>
            <div contenteditable="True" class="formcontent" id="formcontent"></div><br>
            <button onclick="submitblog()">Submit!</button>
		</div>
        
	</div><br>
    <div class="box" id="imagebox">
		<div class="boxtitle">
            <h2>Select images to add!</h2>
		</div>
        <div class="imageupload"><input type="file" id="image" name="image"><a href="#" onclick="uploadimage()">Upload image</a></div>
		<div class="boxcontent">
            <div id="imagelist"></div>
		</div>
	</div><br>
<br>

<script>

function uploadimage(){
    if(document.getElementById("image").value != ""){
        var file = document.getElementById("image").files[0];
        var data = new FormData();
        data.append("image", file);
        var xhttp = new XMLHttpRequest();
        xhttp.open("POST", "upload.php?role=Admin", true);
        xhttp.responseType = "blob";
        xhttp.send(data);
        xhttp.onreadystatechange = function() {
        if (xhttp.readyState == 4 && xhttp.status == 200){
            document.getElementById("image").value = "";
            setTimeout(reloadimagelist(), 1000);
        }};
    }else{
        document.getElementById("error").innerHTML = "Image form was empty.";
    }
}
function submitblog()
{
    var mytitle = document.getElementById("formtitle").innerHTML;
    var mycontent = document.getElementById("formcontent").innerHTML;
    var type = "blog";
    var mybox = document.getElementById("mybox");

    var xhttp = new XMLHttpRequest();
    var myurl = "post.php?title="+mytitle+"&content="+mycontent+"&type="+type+"&role=Admin";
    xhttp.open("POST", myurl, true);
    xhttp.send();
    xhttp.onreadystatechange = function() {
        if (xhttp.readyState == 4 && xhttp.status == 200){
            mybox.innerHTML = "Submitted!";
            setTimeout(window.location.href = "?page=home", 2000);
        }};
    var imagebox = document.getElementById("imagebox");
    imagebox.remove();
}

function reloadimagelist()
        {
           var imagelist = document.getElementById("imagelist");
           var xhttp = new XMLHttpRequest();
           xhttp.onload = function()
           {
               imagelist.innerHTML = this.responseText;
           }
           xhttp.open("GET", "functions.php?action=imagelist");
           xhttp.send();

        }


        
function addimage(image)
{
    var target = document.getElementById("formcontent");
    
    var newdiv = document.createElement("div");
    newdiv.setAttribute("class", "formimage");
    newdiv.setAttribute("name", "formimage");
    newdiv.setAttribute("contenteditable", "False");
    target.appendChild(newdiv);
    newdiv.innerHTML += "<br>";
    var newimage = document.createElement("img");
    newimage.src = "images/" + image;
    newdiv.appendChild(newimage);
    target.innerHTML += "<br>";
}
        reloadimagelist();
    
</script>