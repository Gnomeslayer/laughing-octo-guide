<?php
if(!isset($_SESSION))
{
    header("Location: ?page=home");
}else if(isset($_SESSION) && empty($_SESSION))
{
    header("Location: ?page=home");
}else if(isset($_SESSION) && $_SESSION['role'] != "Admin")
{
    header("Location: ?page=home");
}
    if($_GET['type'] == "blog")
    {
        $blog = getsingleblog($_GET['id']);
    }elseif($_GET['type'] == "nsfw")
    {
        $blog = getsinglensfw($_GET['id']);
    }elseif($_GET['type'] == "thing")
    {
        $blog = getsinglething($_GET['id']);
    }
?>
<div class="box">
    <div id="postid" hidden="True"><?php echo $_GET['id']; ?></div><div id="type" hidden="True"><?php echo $_GET['type']; ?></div>
		<div class="boxcontent" id="mybox">
            <?php 
                if($_GET['type'] == "blog")
                {
                    echo "<h2>Title of Blog</h2>";
                }else if($_GET['type'] == "nsfw")
                {
                    echo "<h2>Title of NSFW</h2>";
                }else if($_GET['type'] == "thing")
                {
                    echo "<h2>Title of Thing</h2>";
                }
            ?>
            
            <div contenteditable="True" class="formtitle" id="formtitle"><?php echo $blog[0]['title']; ?></div>
            <?php if($_GET['type'] == "thing"): ?>
                <h2>Link to thing</h2>
                <div contenteditable="True" class="formlink" id="formlink"><?php echo $blog[0]['thing']; ?></div>
                <h2>Link to github</h2>
                <div contenteditable="True" class="formgithub" id="formgithub"><?php echo $blog[0]['github']; ?></div>
            <?php elseif($_GET['type'] == "nsfw"): ?>
                <h2>Link to NSFW</h2>
                <div contenteditable="True" class="formlink" id="formlink"><?php echo $blog[0]['nsfw']; ?></div>
                <h2>Link to github</h2>
                <div contenteditable="True" class="formgithub" id="formgithub"><?php echo $blog[0]['github']; ?></div>
            <?php endif; ?>
            <h2>Content</h2>
            <div contenteditable="True" class="formcontent" id="formcontent"><?php echo $blog[0]['content']; ?></div><br>
            
		</div>
        <?php if($_GET['type'] == "thing" | $_GET['type'] == "nsfw"): ?>
            <button onclick="submitother()">Submit!</button>
        <?php elseif($_GET['type'] == "blog"): ?>
            <button onclick="submitblog()">Submit!</button>
        <?php endif; ?>
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

function submitother()
{
    var mytitle = document.getElementById("formtitle").innerHTML;
    var mycontent = document.getElementById("formcontent").innerHTML;
    var mylink = document.getElementById("formlink").innerHTML;
    var mygithub = document.getElementById("formgithub").innerHTML;
    var postid = document.getElementById("postid").innerHTML;
    var type = document.getElementById("type").innerHTML;
    var mybox = document.getElementById("mybox");

    var xhttp = new XMLHttpRequest();
    var myurl = "update.php?title="+mytitle+"&content="+mycontent+"&type="+type+"&mylink="+mylink+"&mygithub="+mygithub+"&postid="+postid+"&role=Admin";
    xhttp.open("POST", myurl, true);
    xhttp.send();
    xhttp.onreadystatechange = function() {
        if (xhttp.readyState == 4 && xhttp.status == 200){
            mybox.innerHTML = "Edited!";
            setTimeout(window.location.href = "?page=home", 2000);
        }};
    var imagebox = document.getElementById("imagebox");
    imagebox.remove();
}

function submitblog()
{
    var mytitle = document.getElementById("formtitle").innerHTML;
    var mycontent = document.getElementById("formcontent").innerHTML;
    var type = document.getElementById("type").innerHTML;
    var postid = document.getElementById("postid").innerHTML;
    var mybox = document.getElementById("mybox");

    var xhttp = new XMLHttpRequest();
    var myurl = "update.php?title="+mytitle+"&content="+mycontent+"&type="+type+ "&postid="+postid+"&role=Admin";
    xhttp.open("POST", myurl, true);
    xhttp.send();
    xhttp.onreadystatechange = function() {
        if (xhttp.readyState == 4 && xhttp.status == 200){
            mybox.innerHTML = "Edited!";
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