<?php
    session_destroy();
    header( "refresh:0;url=?page=home" );
?>