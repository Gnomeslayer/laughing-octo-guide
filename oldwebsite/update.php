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
    $title = $_GET['title'];
    $content = $_GET['content'];
    $id = $_GET['postid'];
    $type = $_GET['type'];
    switch($type)
    { 
        case "nsfw":
            $mygithub = $_GET['mygithub'];
            $mylink = $_GET['mylink'];
            sanitize_input($mygithub);
            sanitize_input($mylink);
            sanitize_input($title);
            sanitize_input($content);
            updatensfw($id, $mygithub, $content, $mylink, $title);
            break;
        
        case "thing":
            $mygithub = $_GET['mygithub'];
            $mylink = $_GET['mylink'];
            sanitize_input($mylink);
            sanitize_input($title);
            sanitize_input($content);
            updatething($id, $mygithub, $content, $mylink, $title);
            break;
        case "blog":
            sanitize_input($title);
            sanitize_input($content);
            
            updateblog($id, $title, $content);
            break;
    }
}
    
 ?>