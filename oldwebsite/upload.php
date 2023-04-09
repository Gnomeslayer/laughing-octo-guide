<?php
if(!isset($_GET))
{
    header("Location: ?page=home");
}elseif(isset($_GET) && empty($_GET))
{
    header("Location: ?page=home");
}elseif(isset($_GET) && $_GET['role'] != "Admin")
{
    header("Location: ?page=home");
}else if(isset($_GET) && $_GET['role'] == "Admin")
{
    include "functions.php";
    $errors = array();
    $name = $_FILES['image']['name'];
    $ext = explode('.',$name);
    $size = $_FILES['image']['size'];
    $tmpName = $_FILES['image']['tmp_name'];
    $validExt = array("jpg","jpeg","png","gif");//valid extensions
    $location = "";
    if(empty($errors))
    {
        echo $ext[0]." ".$ext[1];
        $randnumber = substr(session_id(),0,5).rand(0,1000);
        $fn = $ext[0].$randnumber.".";
        $newFilename = $fn.$ext[1];
        $location = "images/".$newFilename;

        $thumbnailname = $ext[0].$randnumber."_thumbnail.".$ext[1];
        move_uploaded_file($tmpName,"images/".$newFilename);

        $source = imagecreatefrompng($location);
        $width = imagesx($source);
        $height = imagesy($source);

        $newwidth = 250;
        $newheight = 250;
        $virtualimage = imagecreatetruecolor($newwidth, $newheight);
        imagecopyresampled($virtualimage, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
        $location = "images/".$thumbnailname;
        imagepng($virtualimage, $location);
        saveimages($newFilename,$thumbnailname, $name);
    }else{
        echo 'flag 1';
    }
}
    
 ?>