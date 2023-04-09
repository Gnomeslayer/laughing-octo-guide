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
    $type = $_GET['type'];
    $id = $_GET['id'];

    switch($type)
    {
        case 'nsfw':
            deletensfw($id);
            header( "refresh:0;url=?page=nsfw" );
            break;
        case 'blog':
            deleteblog($id);
            header( "refresh:0;url=?page=home" );
            break;
        case 'thing':
            deletething($id);
            header( "refresh:0;url=?page=thing" );
            break;
    }
}
    
 ?>