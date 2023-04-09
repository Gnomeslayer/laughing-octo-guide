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
    $title = $_GET['title'];
    $content = $_GET['content'];
    #var myurl = "post.php?title="+mytitle+"&content="+mycontent+"&type="+type+"&mylink="+mylink+"&mygithub="+mygithub;
    if($_GET['type'] == "nsfw")
    {
        $mygithub = $_GET['mygithub'];
        $mylink = $_GET['mylink'];
        sanitize_input($mygithub);
        sanitize_input($mylink);
        sanitize_input($title);
        sanitize_input($content);
        creatensfw($mygithub, $content, $mylink, $title);
    }else if($_GET['type'] == 'thing')
    {
        $mygithub = $_GET['mygithub'];
        $mylink = $_GET['mylink'];
        #sanitize_input($testing);
        sanitize_input($mylink);
        sanitize_input($title);
        sanitize_input($content);
        creatething($mygithub, $content, $mylink, $title);
    }elseif($_GET['type'] == "blog")
    {
        sanitize_input($title);
        sanitize_input($content);
        createblog($title, $content);
    }
    
}
    
 ?>