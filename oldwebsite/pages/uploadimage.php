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
    <div class="box" id="imagebox">
		<div class="boxtitle">
            <h2>Image Uploader!</h2>
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
        reloadimagelist();
    
</script>